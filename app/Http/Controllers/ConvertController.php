<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\File;

class ConvertController extends Controller
{
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
        $request->validate([
            'images' => 'required|array|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $webpPath = storage_path('app/public/converted/webp/' . $webpName);
            
            // Make sure directory exists
            if (!File::exists(storage_path('app/public/converted/webp'))) {
                File::makeDirectory(storage_path('app/public/converted/webp'), 0755, true);
            }
            
            // Save as WebP format
            $img->encodeByExtension('webp', 80)
                ->save($webpPath);

            // Get original and converted sizes
            $originalSize = filesize($image->getPathname());
            $convertedSize = filesize($webpPath);
            $compressionRatio = ($originalSize > 0) ? (1 - ($convertedSize / $originalSize)) * 100 : 0;
                
            $convertedImages[] = [
                'name' => $webpName,
                'path' => asset('storage/converted/webp/' . $webpName)
            ];
            
            // Record conversion usage
            auth()->user()->recordConversion();
            
            // Save converted image in database
            \App\Models\ConvertedImage::create([
                'user_id' => auth()->id(),
                'original_filename' => $image->getClientOriginalName(),
                'original_path' => $image->getClientOriginalName(), // We don't store the original
                'converted_filename' => $webpName,
                'converted_path' => 'converted/webp/' . $webpName,
                'conversion_type' => 'webp',
                'original_size' => $this->formatBytes($originalSize),
                'converted_size' => $this->formatBytes($convertedSize),
                'compression_ratio' => $compressionRatio,
            ]);
            
            // Save conversion statistics
            \App\Models\ConversionStatistic::create([
                'conversion_type' => 'image_to_webp',
                'user_id' => auth()->id(),
                'original_filename' => $image->getClientOriginalName(),
                'converted_filename' => $webpName,
                'original_size' => $this->formatBytes($originalSize),
                'converted_size' => $this->formatBytes($convertedSize),
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
        return view('convert.pdf-to-word');
    }

    /**
     * Display the Word to PDF conversion form
     */
    public function showWordToPdfForm()
    {
        return view('convert.word-to-pdf');
    }

    /**
     * Convert PDF to Word
     */
    public function pdfToWord(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }
        
        // Record conversion usage
        auth()->user()->recordConversion();

        // Get information about the file
        $file = $request->file('pdf');
        $originalSize = filesize($file->getPathname());
        
        // Save conversion statistics even though conversion isn't implemented
        \App\Models\ConversionStatistic::create([
            'conversion_type' => 'pdf_to_word',
            'user_id' => auth()->id(),
            'original_filename' => $file->getClientOriginalName(),
            'converted_filename' => str_replace('.pdf', '.docx', $file->getClientOriginalName()),
            'original_size' => $this->formatBytes($originalSize),
            'converted_size' => 'N/A', // Not applicable since conversion isn't implemented
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Implementation will need a library like PhpWord
        // This is just a placeholder - actual implementation requires a third-party service
        // or more complex library like Spatie PDF to HTML + HTML to Word conversion
        
        return redirect()->back()->with([
            'info' => 'Fitur konversi PDF ke Word sedang dalam pengembangan.',
        ]);
    }

    /**
     * Convert Word to PDF
     */
    public function wordToPdf(Request $request)
    {
        $request->validate([
            'word' => 'required|mimes:doc,docx|max:10240',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }
        
        // Record conversion usage
        auth()->user()->recordConversion();

        // Get information about the file
        $file = $request->file('word');
        $originalSize = filesize($file->getPathname());
        
        // Save conversion statistics even though conversion isn't implemented
        \App\Models\ConversionStatistic::create([
            'conversion_type' => 'word_to_pdf',
            'user_id' => auth()->id(),
            'original_filename' => $file->getClientOriginalName(),
            'converted_filename' => str_replace(['.doc', '.docx'], '.pdf', $file->getClientOriginalName()),
            'original_size' => $this->formatBytes($originalSize),
            'converted_size' => 'N/A', // Not applicable since conversion isn't implemented
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Implementation will need a library like PhpWord
        // This is just a placeholder - actual implementation requires a third-party service
        // or more complex library
        
        return redirect()->back()->with([
            'info' => 'Fitur konversi Word ke PDF sedang dalam pengembangan.',
        ]);
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
