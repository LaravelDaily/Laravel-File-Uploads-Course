<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $folder = uniqid() . '-' . now()->timestamp;
        mkdir(storage_path('app/public/avatars/tmp/' . $folder));
        return $folder;

        // Old version - if done without chunking
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('avatars/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }

    public function update(Request $request)
    {
        // TODO:
        // - process the chunk and save it somewhere
        // - somehow catch if it's the last chunk, and then combine
        // - return success to the filepond
    }

}
