<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function uploadFile(Request $request) {
        $request->validate([
            'file' => 'required|file|max:20480'
        ], [
            'file.max' => 'That file is too large. Maximum size is 20 MB',
        ]);

        $file = $request->file('file');

        // Check if user has enough space to store new file
        $user = auth()->user;
        $size = round($file->getSize() / 1024, 2);
        $max_space = 3145728; // 3 GB in kilobytes

        if ($user->usedSpace() + $size > $max_space) {
            return back()
            ->withErrors(['file' => 'Not enough storage on your cloud.']);
        }

        // Handle uploading files with same name
        $originalName = $file->getClientOriginalName();
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
    
        $name = $originalName;
        $counter = 1;
    
        while (Storage::exists('uploads/' . $name)) {
            $name = $baseName . ' (' . $counter . ')' . ($extension ? '.' . $extension : '');
            $counter++;
        }

        $fields['url'] = $file->storeAs('uploads', $name);
        $fields['name'] = $name;
        $fields['file_type'] = $extension;
        $fields['size'] = $size;
        $fields['user_id'] = auth()->id();

        File::create($fields);

        return redirect('/');
    }

    public function downloadFile(File $file) {
        return Storage::download($file->url, $file->name);
    }

    public function deleteFile(File $file) {
        if (auth()->user()->id == $file['user_id'] || auth()->user()->role == 'super') {
            $file->delete();
        }

        return redirect('/');
    }

    public function index() {
        $files = [];

        if (auth()->check()) {
            $user = auth()->user();

            if ($user instanceof User) {
                $query = $user->isSuper()
                    ? File::with('user')
                    : $user->files();

                $files = $query->latest()->paginate(5);
            }
        }
    
        return view('pages.home', compact('files'));
    }
}
