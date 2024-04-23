<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UploadService;
class UploadController extends Controller
{
    protected $upload;
    public function __construct(UploadService $upload){
        $this->upload = $upload;
    }
    public function store(Request $request){
        $url = $this->upload->store($request);
        if($url !== false){
            return response()->json([
                'error' => false,
                'rul' => $url
            ]);
        }
        return response()->json(['error' => true]);
    }
}
