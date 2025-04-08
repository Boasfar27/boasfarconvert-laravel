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
                
            $convertedImages[] = [
                'name' => $webpName,
                'path' => asset('storage/converted/webp/' . $webpName)
            ];
            
            // Record conversion usage
            auth()->user()->recordConversion();
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
}
