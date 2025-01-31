<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlaskApiController extends Controller
{
    private $flaskApiUrl;

    public function __construct()
    {
        $this->flaskApiUrl = env('FLASK_API_URL', 'http://127.0.0.1:5000');
    }

    /**
     * Upload a single file to Flask API.
     */
    public function uploadFile(Request $request) 
    {
        $file = $request->file('file');

        if (!$file) {
            return redirect()->back()->with('error', 'No file provided.');
        }

        // Validate file type and size
        $allowedExtensions = ['docx', 'pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes

        if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
            return redirect()->back()->with('error', 'Invalid file type. Only DOCX and PDF are allowed.');
        }

        if ($file->getSize() > $maxFileSize) {
            return redirect()->back()->with('error', 'File size exceeds the 5MB limit.');
        }

        try {
            // Attach the file and send it to Flask API
            $response = Http::attach(
                'file',  
                fopen($file->getPathname(), 'r'),
                $file->getClientOriginalName()
            )->post("$this->flaskApiUrl/store-files");

            if ($response->failed()) {
                return redirect()->back()->with('error', 'Failed to upload file.');
            }

            return redirect()->back()->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



    /**
     * Get the file list from Flask API.
     */
    public function getFileList()
    {
        try {
            $response = Http::get("$this->flaskApiUrl/get-file-list");

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to retrieve file list'], $response->status());
            }

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete files using serial numbers from Flask API.
     */
   
}
