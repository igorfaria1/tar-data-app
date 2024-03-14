<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Services\FileService;

class UploadController extends Controller
{
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function show()
    {
        return view('upload');
    }

    public function handleUpload(Request $request)
    {
        $results = $this->fileService->compareCSVs($request);

        return view('diff', [
            'results' => $results,
        ]);
    }
}
