<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Http\Resources\FolderResource;
use App\Models\File;
use App\Models\FileReport;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //paginate folders and order by desc date
        $folders = File::orderBy('created_at', 'desc')->paginate(50);

        return inertia('Admin/Files', [
            'folders' => FolderResource::collection($folders),
        ]);
    }

    public function userIndex(Request $request)
    {

        $user = Auth::user();

        //get image files only

        $images = $user->files->map(function ($file) {
            if ($file->isImage()) {
                return $file;
            }
        })->filter();



        $files = $user->files->map(function ($file) {
            if (!$file->isFile()) {
                return $file;
            }
        })->filter();


        $videos = $user->files->map(function ($file) {
            if ($file->isVideo()) {
                return $file;
            }
        })->filter();

        $audios = $user->files->map(function ($file) {
            if ($file->isAudio()) {
                return $file;
            }
        })->filter();

        return Inertia::render('User/Files', [
            'folders' => FolderResource::collection($user->folders),
            'images' => FileResource::collection($images),
            'files' => FileResource::collection($files),
            'videos' => FileResource::collection($videos),
            'audios' => FileResource::collection($audios),

        ]);
    }
    public function userDash(Request $request)
    {

        $user = Auth::user();

        //get image files only

        $images = $user->files->map(function ($file) {
            if ($file->isImage()) {
                return $file;
            }
        })->filter();



        $files = $user->files->map(function ($file) {
            if (!$file->isFile()) {
                return $file;
            }
        })->filter();


        $videos = $user->files->map(function ($file) {
            if ($file->isVideo()) {
                return $file;
            }
        })->filter();

        $audios = $user->files->map(function ($file) {
            if ($file->isAudio()) {
                return $file;
            }
        })->filter();


        //get user recent 10 files
        $recentFiles = $user->files->take(10);
        return Inertia::render('User/Dashboard', [
            'folders' => FolderResource::collection($user->folders->take(4)),
            'images' => FileResource::collection($images),
            'files' => FileResource::collection($files),
            'videos' => FileResource::collection($videos),
            'audios' => FileResource::collection($audios),
            'recentFiles' => FileResource::collection($recentFiles),
        ]);
    }
    public function adminIndex(Request $request)
    {


        //get image files only
        $files = File::all();
        $images = $files->map(function ($file) {
            if ($file->isImage()) {
                return $file;
            }
        })->filter();



        $files = $files->map(function ($file) {
            if (!$file->isFile()) {
                return $file;
            }
        })->filter();


        $videos = $files->map(function ($file) {
            if ($file->isVideo()) {
                return $file;
            }
        })->filter();

        $audios = $files->map(function ($file) {
            if ($file->isAudio()) {
                return $file;
            }
        })->filter();


        $recentFiles = File::orderBy('created_at', 'desc')->take(10)->get();
        return Inertia::render('Admin/Dashboard', [
            'folders' => FolderResource::collection(Folder::all()->take(4)),
            'images' => FileResource::collection($images),
            'files' => FileResource::collection($files),
            'videos' => FileResource::collection($videos),
            'audios' => FileResource::collection($audios),
            'recentFiles' => FileResource::collection($recentFiles),
        ]);
    }
    public function adminFileReport(Request $request)
    {


        //get image files only
        $files = File::all();
        $images = $files->map(function ($file) {
            if ($file->isImage()) {
                return $file;
            }
        })->filter();



        $files = $files->map(function ($file) {
            if (!$file->isFile()) {
                return $file;
            }
        })->filter();


        $videos = $files->map(function ($file) {
            if ($file->isVideo()) {
                return $file;
            }
        })->filter();

        $audios = $files->map(function ($file) {
            if ($file->isAudio()) {
                return $file;
            }
        })->filter();

        //filter files with duplicates relation only
        $allFiles = FileResource::collection(File::all());
        $duplicateFiles = $allFiles->map(function ($file) {
            if ($file->getDuplicateFiles()->count() > 0) {
                return $file;
            }
        })->filter();

        //group files with same hash and return only files with more than one hash in an array
        $similarFiles = $allFiles->groupBy('hash')->filter(function ($file) {
            return $file->count() > 1;
        });


        //convert collection to array
        $similarFiles = $similarFiles->toArray();

        return Inertia::render('Admin/FilesReport', [
            'folders' => FolderResource::collection(Folder::all()->take(4)),
            'images' => FileResource::collection($images),
            'files' => FileResource::collection($files),
            'videos' => FileResource::collection($videos),
            'audios' => FileResource::collection($audios),
            'duplicateFiles' => FileResource::collection($duplicateFiles),
            'similarFiles' => $similarFiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'folder_id' => 'required',
            'user_id' => 'required'
        ]);

        //check for duplicate file name or path
        $file = File::where('name', $data['name'])->first();


        if ($file) {
            return back()->with('error', 'Use a different name for the file');
        }

        //get file size in kb 
        $data['size'] = $request->file('file')->getSize() / 1024;

        //check for existing file with same hash

        $file = File::where('hash', sha1_file($request->file('file')))->first();

        if ($file) {
            //generate fake 4 integer number

            FileReport::create([
                'user_id' => $data['user_id'],
                'name' => 'Duplicate file' . rand(1000, 9999),
                'hash' => $file->hash,
                'size' => $data['size'],
            ]);

            if ($file->user_id == $data['user_id']) {
                return back()->with('error', 'You have aready uploaded this file');
            } else {
                File::create([
                    'name' => $data['name'],
                    'folder_id' => $data['folder_id'],
                    'user_id' => $data['user_id'],
                    'path' => $file->path,
                    'hash' => $file->hash,
                    'size' => $data['size'],
                ]);
                return back()->with('success', 'File uploaded successfully');
            }
        }

        $data['path'] = $this->uploadImage($request->file('file'), 'files');


        //create hash of the file
        $data['hash'] = sha1_file($request->file('file'));

        $file = File::create($data);
        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    public function uploadImage($image, $path)
    {
        return  $image->store($path, ['disk' => 'public']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $data = $request->only([
            'name',
            'folder_id',
        ]);
        //check for duplicate file name or path
        $foundFile = File::where('name', $data['name'])->first();
        if ($foundFile) {
            return back()->with('error', 'Use a different name for the file');
        }
        //check if there is file
        if ($request->hasFile('file')) {
            //get file size in kb 
            $data['size'] = $request->file('file')->getSize() / 1024;
            $data['path'] = $this->uploadImage($request->file('file'), 'files');
            //compare duplicate files with md5 hash
            $file = File::where('hash', md5($data['path']))->first();
            if ($file) {
                return back()->with('error', 'File already exists');
            }
            //create hash of path with md5
            $data['hash'] = md5($data['path']);
        }

        $file->update($data);
        return back()->with('success', 'File updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //check if file has files
        if ($file->files->count() > 0) {
            return back()->with('error', 'File has files');
        }
        $file->delete();
        return back()->with('success', 'File deleted successfully');
    }
}
