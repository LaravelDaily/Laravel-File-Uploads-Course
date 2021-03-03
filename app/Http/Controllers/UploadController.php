<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use File;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('avatars')) {
            $folder = uniqid() . '-' . now()->timestamp;
            foreach ($request->file('avatars') as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('avatars/tmp/' . $folder, $filename);

                TemporaryFile::create([
                    'folder' => $folder,
                    'filename' => $filename
                ]);
            }
            return $folder;
        }

        return '';
    }
}
