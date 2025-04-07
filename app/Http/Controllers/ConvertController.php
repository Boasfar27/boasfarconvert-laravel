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
     * Convert image to WebP
     */
    public function convertImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if user can convert
        if (!auth()->user()->canConvert()) {
            return redirect()->back()->with([
                'error' => 'Anda telah mencapai batas konversi harian. Upgrade ke premium untuk konversi tak terbatas.',
            ]);
        }

        $image = $request->file('image');
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        
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
        
        // Record conversion usage
        auth()->user()->recordConversion();
        
        return redirect()->back()->with([
            'success' => 'Gambar berhasil dikonversi ke WebP!',
            'webp_path' => asset('storage/converted/webp/' . $webpName),
            'webp_name' => $webpName,
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
}
