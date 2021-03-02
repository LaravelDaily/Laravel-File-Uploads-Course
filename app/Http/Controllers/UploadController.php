<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use File;
use Illuminate\Http\Request;
use Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $folder = uniqid() . '-' . now()->timestamp;

        mkdir(storage_path('app/public/avatars/tmp/' . $folder), 0777, true);

        file_put_contents(storage_path('app/public/avatars/tmp/' . $folder . '/file.part'), '');

        return $folder;
    }

    public function update(Request $request)
    {
        $path = storage_path('app/public/avatars/tmp/' . $request->query('patch') . '/file.part');

        File::append($path, $request->getContent());

        // The code below should probably be going into a POST controller method
        // As the documentation recommends us to actually move the file once it's done.
        if (filesize($path) == $request->header('Upload-Length')) {
            $name = $request->header('Upload-Name');

            File::move($path, storage_path("app/public/avatars/{$name}"));
        }

        return response()->json(['uploaded' => true]);
    }

}
