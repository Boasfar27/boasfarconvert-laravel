<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\File;
use TCPDF;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Reader\XLSX\Reader;
use OpenSpout\Common\Entity\Row;
use Smalot\PdfParser\Parser as PdfParser;
use CloudConvert\Laravel\Facades\CloudConvert;
use CloudConvert\Models\Job;
use CloudConvert\Models\Task;

class ConvertController extends Controller
{
    /**
     * Display the convert index page
     */
    public function index()
    {
        return view('convert.index');
    }

    /**
     * Display the form to upload images
     */
    public function showImageForm()
    {
        return view('convert.image');
    }

    /**
     * Convert images to WebP
     */
    public function convertImage(Request $request)
    {
        // Atur batas memori dan eksekusi
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');
        ini_set('post_max_size', '8M');
        
        $request->validate([
            'images' => 'required|array|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }

        $convertedImages = [];
        $images = $request->file('images');
        
        // Limit to maximum 5 images
        $imagesToProcess = array_slice($images, 0, 5);
        
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

        foreach ($imagesToProcess as $image) {
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $img = $manager->read($image);
            
            // Create WebP image
            $webpName = $originalName . '_' . time() . '.webp';
            
            // Simpan langsung ke public, tanpa storage
            $origPublicDir = public_path('uploads/originals');
            $webpPublicDir = public_path('converted/webp');
            
            // Make sure directories exist
            if (!File::exists($origPublicDir)) {
                File::makeDirectory($origPublicDir, 0755, true);
            }
            
            if (!File::exists($webpPublicDir)) {
                File::makeDirectory($webpPublicDir, 0755, true);
            }
            
            // Store original file
            $originalFilePath = $origPublicDir . '/' . $image->getClientOriginalName();
            $image->move($origPublicDir, $image->getClientOriginalName());
            
            // Save WebP file directly to public folder
            $webpFilePath = $webpPublicDir . '/' . $webpName;
            $img->encodeByExtension('webp', 80)
                ->save($webpFilePath);

            // Get original and converted sizes
            $originalSize = filesize($originalFilePath);
            $convertedSize = filesize($webpFilePath);
            $compressionRatio = ($originalSize > 0) ? (1 - ($convertedSize / $originalSize)) * 100 : 0;
                
            $convertedImages[] = [
                'name' => $webpName,
                'path' => asset('converted/webp/' . $webpName)
            ];
            
            // Record conversion usage
            auth()->user()->recordConversion();
            
            // Save relative paths to database for easier URL generation later
            \App\Models\ConvertedImage::create([
                'user_id' => auth()->id(),
                'original_filename' => $image->getClientOriginalName(),
                'original_path' => 'uploads/originals/' . $image->getClientOriginalName(),
                'converted_filename' => $webpName,
                'converted_path' => 'converted/webp/' . $webpName,
                'conversion_type' => 'webp',
                'original_size' => $originalSize,
                'converted_size' => $convertedSize,
                'compression_ratio' => $compressionRatio,
            ]);
            
            // Save conversion statistics
            \App\Models\ConversionStatistic::create([
                'conversion_type' => 'image_to_webp',
                'user_id' => auth()->id(),
                'original_filename' => $image->getClientOriginalName(),
                'converted_filename' => $webpName,
                'original_size' => $originalSize,
                'converted_size' => $convertedSize,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
        
        // If only one image was converted, use the old format for backward compatibility
        if (count($convertedImages) === 1) {
            return redirect()->back()->with([
                'success' => 'Gambar berhasil dikonversi ke WebP!',
                'webp_path' => $convertedImages[0]['path'],
                'webp_name' => $convertedImages[0]['name'],
            ]);
        }
        
        return redirect()->back()->with([
            'success' => 'Gambar berhasil dikonversi ke WebP!',
            'converted_images' => $convertedImages,
        ]);
    }

    /**
     * Display the PDF to Word conversion form
     */
    public function showPdfToWordForm()
    {
        // Additional check for role 0 users to prevent direct URL access
        if (auth()->user()->isUser()) {
            return redirect()->route('convert.index')->with('error', 'Fitur ini hanya tersedia untuk pengguna premium.');
        }
        
        return view('convert.pdf-to-word');
    }

    /**
     * Display the Word to PDF conversion form
     */
    public function showWordToPdfForm()
    {
        // Additional check for role 0 users to prevent direct URL access
        if (auth()->user()->isUser()) {
            return redirect()->route('convert.index')->with('error', 'Fitur ini hanya tersedia untuk pengguna premium.');
        }
        
        return view('convert.word-to-pdf');
    }

    /**
     * Convert PDF to Word
     */
    public function pdfToWord(Request $request)
    {
        // Atur batas memori dan eksekusi
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');
        ini_set('post_max_size', '8M');
        
        // Additional check for role 0 users to prevent direct access
        if (auth()->user()->isUser()) {
            return redirect()->route('convert.index')->with('error', 'Fitur ini hanya tersedia untuk pengguna premium.');
        }
        
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }
        
        try {
            // Get the PDF file
            $pdfFile = $request->file('pdf');
            $originalFilename = $pdfFile->getClientOriginalName();
            $originalSize = filesize($pdfFile->getPathname());
            
            // Create filename for output - using DOCX format
            $outputFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . time() . '.docx';
            
            // Make sure directory exists
            $outputDir = storage_path('app/public/converted/docx');
            if (!File::exists($outputDir)) {
                File::makeDirectory($outputDir, 0755, true);
            }
            
            $outputPath = $outputDir . '/' . $outputFilename;
            
            // Move the PDF to storage for processing
            $pdfPath = storage_path('app/temp/' . $originalFilename);
            if (!File::exists(storage_path('app/temp'))) {
                File::makeDirectory(storage_path('app/temp'), 0755, true);
            }
            
            $pdfFile->move(storage_path('app/temp'), $originalFilename);
            
            // Use Smalot PDF Parser to extract text
            $parser = new PdfParser();
            $pdf = $parser->parseFile($pdfPath);
            
            // Create a new PHPWord document
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            
            // Set document properties
            $properties = $phpWord->getDocInfo();
            $properties->setCreator(config('app.name'));
            $properties->setCompany(config('app.name'));
            $properties->setTitle(pathinfo($originalFilename, PATHINFO_FILENAME));
            $properties->setDescription('Converted from PDF using ' . config('app.name'));
            $properties->setCategory('Converted Document');
            $properties->setLastModifiedBy(auth()->user()->name);
            $properties->setCreated(time());
            $properties->setModified(time());
            
            // Set default styles for better document appearance
            $phpWord->setDefaultFontName('Arial');
            $phpWord->setDefaultFontSize(11);
            
            // Create a section in the document with proper margins
            $section = $phpWord->addSection([
                'marginLeft' => 720,    // 0.5 inch in twips
                'marginRight' => 720,   // 0.5 inch in twips
                'marginTop' => 1440,    // 1 inch in twips
                'marginBottom' => 1440, // 1 inch in twips
                'headerHeight' => 720,  // 0.5 inch in twips
                'footerHeight' => 720,  // 0.5 inch in twips
            ]);
            
            // Process each page from the PDF more carefully to preserve format
            $pages = $pdf->getPages();
            foreach ($pages as $pageNum => $page) {
                $text = $page->getText();
                
                // Only remove truly problematic control characters
                $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $text);
                
                // Keep exact line breaks to preserve original formatting
                $lines = preg_split('/(\r\n|\n|\r)/', $text);
                
                // Process each line individually to preserve indentation and line breaks
                foreach ($lines as $line) {
                    // Check if line is empty (preserve empty lines as paragraph breaks)
                    if (trim($line) === '') {
                        $section->addTextBreak();
                        continue;
                    }
                    
                    // Preserve leading spaces for indentation by counting them
                    $leadingSpaces = strlen($line) - strlen(ltrim($line));
                    $indentation = $leadingSpaces * 120; // Convert spaces to twips (approx. 120 twips per space)
                    
                    // Create paragraph with proper indentation
                    $textRun = $section->addTextRun([
                        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
                        'indent' => $indentation,
                        'spaceBefore' => 0,
                        'spaceAfter' => 0,
                    ]);
                    
                    // Add the text preserving its original formatting
                    $textRun->addText(
                        htmlspecialchars(trim($line)),
                        [
                            'name' => 'Arial',
                            'size' => 11,
                            'color' => '000000',
                        ]
                    );
                }
                
                // Add page break between pages (except for the last page)
                if ($pageNum < count($pages) - 1) {
                    $section->addPageBreak();
                }
            }
            
            // Save as Microsoft Word 2007 file (.docx)
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($outputPath);
            
            $convertedSize = filesize($outputPath);
            
            // Clean up temp file
            if (File::exists($pdfPath)) {
                File::delete($pdfPath);
            }
            
            // Record conversion usage
            auth()->user()->recordConversion();
            
            // Save conversion statistics
            \App\Models\ConversionStatistic::create([
                'conversion_type' => 'pdf_to_word',
                'user_id' => auth()->id(),
                'original_filename' => $originalFilename,
                'converted_filename' => $outputFilename,
                'original_size' => $originalSize,
                'converted_size' => $convertedSize,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            
            return redirect()->back()->with([
                'success' => 'PDF berhasil dikonversi ke Word dengan mempertahankan format asli!',
                'docx_path' => asset('storage/converted/docx/' . $outputFilename),
                'docx_name' => $outputFilename,
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('PDF to Word conversion error: ' . $e->getMessage());
            
            // Return a fallback message
            return redirect()->back()->with([
                'info' => 'Terjadi kesalahan saat konversi PDF ke Word: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Convert Word to PDF
     */
    public function wordToPdf(Request $request)
    {
        // Atur batas memori dan eksekusi
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');
        ini_set('post_max_size', '8M');
        
        // Additional check for role 0 users to prevent direct access
        if (auth()->user()->isUser()) {
            return redirect()->route('convert.index')->with('error', 'Fitur ini hanya tersedia untuk pengguna premium.');
        }
        
        $request->validate([
            'word' => 'required|mimes:doc,docx|max:10240',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }
        
        try {
            // Get the Word file
            $wordFile = $request->file('word');
            $originalFilename = $wordFile->getClientOriginalName();
            $originalSize = filesize($wordFile->getPathname());
            
            // Create filename for output
            $outputFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . time() . '.pdf';
            
            // Make sure directory exists
            $outputDir = storage_path('app/public/converted/pdf');
            if (!File::exists($outputDir)) {
                File::makeDirectory($outputDir, 0755, true);
            }
            
            $outputPath = $outputDir . '/' . $outputFilename;
            
            // Move the Word file to storage for processing
            $wordPath = storage_path('app/temp/' . $originalFilename);
            if (!File::exists(storage_path('app/temp'))) {
                File::makeDirectory(storage_path('app/temp'), 0755, true);
            }
            
            $wordFile->move(storage_path('app/temp'), $originalFilename);
            
            // Create a new PDF document with better formatting options
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            
            // Remove header and footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            
            // Set document information
            $pdf->SetCreator(config('app.name'));
            $pdf->SetAuthor(auth()->user()->name);
            $pdf->SetTitle(pathinfo($originalFilename, PATHINFO_FILENAME));
            
            // Set better default font and margins
            $pdf->SetMargins(15, 15, 15);
            $pdf->SetAutoPageBreak(true, 15);
            
            // Add a page
            $pdf->AddPage();
            
            // Load the Word document
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($wordPath);
            
            // Set default font
            $pdf->SetFont('helvetica', '', 11);
            
            // Keep track of current Y position
            $currentY = $pdf->GetY();
            
            // Process each section of the Word document
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    // Process different types of elements to preserve formatting
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        // For TextRun elements, handle inline text formatting
                        $content = '';
                        $htmlContent = '';
                        
                        // Collect formatted text from the TextRun
                        foreach ($element->getElements() as $textElement) {
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $text = $textElement->getText();
                                $fontStyle = $textElement->getFontStyle();
                                
                                // Apply basic formatting (bold, italic, etc.)
                                $htmlStyle = '';
                                if ($fontStyle) {
                                    // Penggunaan objek Font harus melalui getter methods, bukan array access
                                    // If it's bold
                                    if (method_exists($fontStyle, 'isBold') && $fontStyle->isBold()) {
                                        $htmlStyle .= 'font-weight: bold;';
                                    }
                                    // If it's italic
                                    if (method_exists($fontStyle, 'isItalic') && $fontStyle->isItalic()) {
                                        $htmlStyle .= 'font-style: italic;';
                                    }
                                    // If it's underlined
                                    if (method_exists($fontStyle, 'getUnderline') && $fontStyle->getUnderline() != 'none') {
                                        $htmlStyle .= 'text-decoration: underline;';
                                    }
                                    // Font size
                                    if (method_exists($fontStyle, 'getSize')) {
                                        $htmlStyle .= 'font-size: ' . $fontStyle->getSize() . 'pt;';
                                    }
                                    // Font name
                                    if (method_exists($fontStyle, 'getName')) {
                                        $htmlStyle .= 'font-family: ' . $fontStyle->getName() . ';';
                                    }
                                    // Text color
                                    if (method_exists($fontStyle, 'getColor')) {
                                        $htmlStyle .= 'color: #' . $fontStyle->getColor() . ';';
                                    }
                                }
                                
                                // Add the text with its style
                                if ($htmlStyle) {
                                    $htmlContent .= '<span style="' . $htmlStyle . '">' . htmlspecialchars($text) . '</span>';
                                } else {
                                    $htmlContent .= htmlspecialchars($text);
                                }
                                
                                $content .= $text;
                            }
                        }
                        
                        // Add the formatted text to the PDF
                        if (!empty($htmlContent)) {
                            $pdf->writeHTML($htmlContent, true, false, true, false, '');
                        } else if (!empty($content)) {
                            $pdf->Write(0, $content, '', 0, 'L', true, 0, false, false, 0);
                        }
                        
                        // Add some spacing after paragraphs
                        $pdf->Ln(2);
                    }
                    // Handle direct text elements
                    else if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                        $text = $element->getText();
                        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
                        $pdf->Ln(2);
                    }
                    // Handle paragraph elements with their styles
                    else if ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
                        $pdf->Ln(5);
                    }
                    // Handle table elements (basic support)
                    else if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                        $pdf->Ln(2);
                        $rowCount = count($element->getRows());
                        
                        for ($r = 0; $r < $rowCount; $r++) {
                            $row = $element->getRow($r);
                            $cellCount = count($row->getCells());
                            $rowText = '';
                            
                            for ($c = 0; $c < $cellCount; $c++) {
                                $cell = $row->getCell($c);
                                foreach ($cell->getElements() as $cellElement) {
                                    if ($cellElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                        $rowText .= $cellElement->getText() . "\t";
                                    } else if ($cellElement instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                        foreach ($cellElement->getElements() as $textElement) {
                                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                                $rowText .= $textElement->getText();
                                            }
                                        }
                                        $rowText .= "\t";
                                    }
                                }
                            }
                            
                            $pdf->Write(0, $rowText, '', 0, 'L', true, 0, false, false, 0);
                        }
                        
                        $pdf->Ln(5);
                    }
                }
            }
            
            // Save the PDF document
            $pdf->Output($outputPath, 'F');
            
            $convertedSize = filesize($outputPath);
            
            // Clean up temp file
            if (File::exists($wordPath)) {
                File::delete($wordPath);
            }
            
            // Record conversion usage
            auth()->user()->recordConversion();
            
            // Save conversion statistics
            \App\Models\ConversionStatistic::create([
                'conversion_type' => 'word_to_pdf',
                'user_id' => auth()->id(),
                'original_filename' => $originalFilename,
                'converted_filename' => $outputFilename,
                'original_size' => $originalSize,
                'converted_size' => $convertedSize,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            
            return redirect()->back()->with([
                'success' => 'Word berhasil dikonversi ke PDF dengan mempertahankan format asli!',
                'pdf_path' => asset('storage/converted/pdf/' . $outputFilename),
                'pdf_name' => $outputFilename,
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('Word to PDF conversion error: ' . $e->getMessage());
            
            // Return a fallback message
            return redirect()->back()->with([
                'info' => 'Terjadi kesalahan saat konversi Word ke PDF: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Convert Word to PDF using CloudConvert API (supports tables and images)
     */
    public function wordToPdfCloudConvert(Request $request)
    {
        // Atur batas memori dan eksekusi
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');
        ini_set('post_max_size', '8M');
        
        // Additional check for role 0 users to prevent direct access
        if (auth()->user()->isUser()) {
            return redirect()->route('convert.index')->with('error', 'Fitur ini hanya tersedia untuk pengguna premium.');
        }
        
        $request->validate([
            'word' => 'required|mimes:doc,docx|max:10240',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }
        
        try {
            // Get the Word file
            $wordFile = $request->file('word');
            $originalFilename = $wordFile->getClientOriginalName();
            $originalSize = filesize($wordFile->getPathname());
            
            // Create output filename
            $outputFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . time() . '.pdf';
            
            // Setup temporary directories
            $tempDir = storage_path('app/temp');
            $outputDir = storage_path('app/public/converted/pdf');
            
            if (!File::exists($tempDir)) {
                File::makeDirectory($tempDir, 0755, true);
            }
            
            if (!File::exists($outputDir)) {
                File::makeDirectory($outputDir, 0755, true);
            }
            
            $tempFilePath = $tempDir . '/' . $originalFilename;
            $outputPath = $outputDir . '/' . $outputFilename;
            
            // Move the uploaded file to temp directory
            $wordFile->move($tempDir, $originalFilename);
            
            // Create CloudConvert job
            $job = (new Job())
                ->setTag('word-to-pdf-' . auth()->id())
                ->addTask(
                    (new Task('import/upload', 'upload-word-file'))
                )
                ->addTask(
                    (new Task('convert', 'convert-word-to-pdf'))
                        ->set('input', 'upload-word-file')
                        ->set('output_format', 'pdf')
                        ->set('engine', 'office') // Use microsoft office engine for best compatibility
                        ->set('timeout', 180) // 3 minutes timeout
                )
                ->addTask(
                    (new Task('export/url', 'export-pdf-file'))
                        ->set('input', 'convert-word-to-pdf')
                );
            
            // Create the job on CloudConvert
            CloudConvert::jobs()->create($job);
            
            // Find upload task
            $uploadTask = $job->getTasks()->whereName('upload-word-file')[0];
            
            // Upload the file
            $uploadFile = fopen($tempFilePath, 'r');
            CloudConvert::tasks()->upload($uploadTask, $uploadFile);
            
            // Wait for job completion (with timeout)
            $success = CloudConvert::jobs()->wait($job, 180); // 3 minutes timeout
            
            if (!$success) {
                throw new \Exception('Konversi memakan waktu terlalu lama. Silakan coba lagi nanti.');
            }
            
            // Download the file
            foreach ($job->getExportUrls() as $file) {
                $source = CloudConvert::getHttpTransport()->download($file->url)->detach();
                $dest = fopen($outputPath, 'w');
                stream_copy_to_stream($source, $dest);
                fclose($dest);
                break; // Just download the first file
            }
            
            // Check if output file exists
            if (!File::exists($outputPath)) {
                throw new \Exception('File PDF hasil konversi tidak ditemukan.');
            }
            
            $convertedSize = filesize($outputPath);
            
            // Clean up temp file
            if (File::exists($tempFilePath)) {
                File::delete($tempFilePath);
            }
            
            // Record conversion usage
            auth()->user()->recordConversion();
            
            // Save conversion statistics
            \App\Models\ConversionStatistic::create([
                'conversion_type' => 'word_to_pdf_cloud',
                'user_id' => auth()->id(),
                'original_filename' => $originalFilename,
                'converted_filename' => $outputFilename,
                'original_size' => $originalSize,
                'converted_size' => $convertedSize,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            
            return redirect()->back()->with([
                'success' => 'Word berhasil dikonversi ke PDF dengan CloudConvert!',
                'pdf_path' => asset('storage/converted/pdf/' . $outputFilename),
                'pdf_name' => $outputFilename,
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('CloudConvert Word to PDF error: ' . $e->getMessage());
            
            // Return a fallback message
            return redirect()->back()->with([
                'info' => 'Terjadi kesalahan saat konversi dengan CloudConvert: ' . $e->getMessage(),
            ]);
        }
    }
    
    /**
     * Convert PDF to Word using CloudConvert API (supports tables and images)
     */
    public function pdfToWordCloudConvert(Request $request)
    {
        // Atur batas memori dan eksekusi
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');
        ini_set('post_max_size', '8M');
        
        // Additional check for role 0 users to prevent direct access
        if (auth()->user()->isUser()) {
            return redirect()->route('convert.index')->with('error', 'Fitur ini hanya tersedia untuk pengguna premium.');
        }
        
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }
        
        try {
            // Get the PDF file
            $pdfFile = $request->file('pdf');
            $originalFilename = $pdfFile->getClientOriginalName();
            $originalSize = filesize($pdfFile->getPathname());
            
            // Create output filename
            $outputFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . time() . '.docx';
            
            // Setup temporary directories
            $tempDir = storage_path('app/temp');
            $outputDir = storage_path('app/public/converted/docx');
            
            if (!File::exists($tempDir)) {
                File::makeDirectory($tempDir, 0755, true);
            }
            
            if (!File::exists($outputDir)) {
                File::makeDirectory($outputDir, 0755, true);
            }
            
            $tempFilePath = $tempDir . '/' . $originalFilename;
            $outputPath = $outputDir . '/' . $outputFilename;
            
            // Move the uploaded file to temp directory
            $pdfFile->move($tempDir, $originalFilename);
            
            // Create CloudConvert job
            $job = (new Job())
                ->setTag('pdf-to-word-' . auth()->id())
                ->addTask(
                    (new Task('import/upload', 'upload-pdf-file'))
                )
                ->addTask(
                    (new Task('convert', 'convert-pdf-to-word'))
                        ->set('input', 'upload-pdf-file')
                        ->set('output_format', 'docx')
                        ->set('engine', 'libreoffice') // Use libreoffice engine for PDF to Word
                        ->set('timeout', 180) // 3 minutes timeout
                )
                ->addTask(
                    (new Task('export/url', 'export-word-file'))
                        ->set('input', 'convert-pdf-to-word')
                );
            
            // Create the job on CloudConvert
            CloudConvert::jobs()->create($job);
            
            // Find upload task
            $uploadTask = $job->getTasks()->whereName('upload-pdf-file')[0];
            
            // Upload the file
            $uploadFile = fopen($tempFilePath, 'r');
            CloudConvert::tasks()->upload($uploadTask, $uploadFile);
            
            // Wait for job completion (with timeout)
            $success = CloudConvert::jobs()->wait($job, 180); // 3 minutes timeout
            
            if (!$success) {
                throw new \Exception('Konversi memakan waktu terlalu lama. Silakan coba lagi nanti.');
            }
            
            // Download the file
            foreach ($job->getExportUrls() as $file) {
                $source = CloudConvert::getHttpTransport()->download($file->url)->detach();
                $dest = fopen($outputPath, 'w');
                stream_copy_to_stream($source, $dest);
                fclose($dest);
                break; // Just download the first file
            }
            
            // Check if output file exists
            if (!File::exists($outputPath)) {
                throw new \Exception('File Word hasil konversi tidak ditemukan.');
            }
            
            $convertedSize = filesize($outputPath);
            
            // Clean up temp file
            if (File::exists($tempFilePath)) {
                File::delete($tempFilePath);
            }
            
            // Record conversion usage
            auth()->user()->recordConversion();
            
            // Save conversion statistics
            \App\Models\ConversionStatistic::create([
                'conversion_type' => 'pdf_to_word_cloud',
                'user_id' => auth()->id(),
                'original_filename' => $originalFilename,
                'converted_filename' => $outputFilename,
                'original_size' => $originalSize,
                'converted_size' => $convertedSize,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            
            return redirect()->back()->with([
                'success' => 'PDF berhasil dikonversi ke Word dengan CloudConvert!',
                'docx_path' => asset('storage/converted/docx/' . $outputFilename),
                'docx_name' => $outputFilename,
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('CloudConvert PDF to Word error: ' . $e->getMessage());
            
            // Return a fallback message
            return redirect()->back()->with([
                'info' => 'Terjadi kesalahan saat konversi dengan CloudConvert: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Download all converted images as a ZIP file
     */
    public function downloadAllImages(Request $request)
    {
        // Get files from query parameters
        $files = $request->query('files');
        
        if (empty($files)) {
            return redirect()->route('convert.image.form')
                ->with('error', 'Tidak ada file yang dipilih untuk diunduh');
        }
        
        $fileNames = explode(',', $files);
        
        // Create new ZIP archive
        $zipName = 'converted_images_' . time() . '.zip';
        $zipPath = storage_path('app/public/converted/zip');
        
        // Make sure directory exists
        if (!File::exists($zipPath)) {
            File::makeDirectory($zipPath, 0755, true);
        }
        
        $zipFilePath = $zipPath . '/' . $zipName;
        
        $zip = new \ZipArchive();
        
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) !== TRUE) {
            return redirect()->route('convert.image.form')
                ->with('error', 'Tidak dapat membuat file ZIP');
        }
        
        // Add files to ZIP
        $webpPath = storage_path('app/public/converted/webp');
        $filesToAdd = [];
        
        foreach ($fileNames as $fileName) {
            $filePath = $webpPath . '/' . $fileName;
            if (File::exists($filePath)) {
                $zip->addFile($filePath, $fileName);
                $filesToAdd[] = $fileName;
            }
        }
        
        if (empty($filesToAdd)) {
            $zip->close();
            File::delete($zipFilePath);
            return redirect()->route('convert.image.form')
                ->with('error', 'Tidak ada file yang ditemukan untuk diunduh');
        }
        
        $zip->close();
        
        // Return ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    /**
     * Format bytes to KB, MB, etc
     */
    private function formatBytes($bytes, $precision = 2) 
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
