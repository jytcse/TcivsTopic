<?php

namespace App\Http\Controllers;

use Hoa\File\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function topic_store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ckeditor_store(Request $request): JsonResponse
    {
        if (!$request->hasFile('upload')) {
            return response()->json(["url" => null, "message" => '沒有上傳檔案.'], 400);
        }
        $path = $request->file('upload')->store('ckeditorMedia', 'public');


        return response()->json(["url" => Storage::url($path)], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ckeditor_destroy(Request $request)
    {
        $path = str_replace('/storage', '/public', $request->path[0]);
        if (Storage::exists($path)) {
            Storage::delete($path);
            return response()->json(['success' => true, 'message' => ''], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'resource not found'], 404);
        }
    }
}
