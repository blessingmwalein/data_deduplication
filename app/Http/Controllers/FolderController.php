<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Http\Resources\FolderResource;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //paginate folders and order by desc date
        $folders = Folder::orderBy('created_at', 'desc')->paginate(50);

        return inertia('Admin/Folders', [
            'folders' => FolderResource::collection($folders),
        ]);
    }

    public function userIndex(Request $request)
    {
        $user = Auth::user();
        return inertia('Admin/Folders', [
            'folders' => FolderResource::collection($user->folders),
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


        //get user recent 10 files
        $recentFiles = $files->take(10);
        return Inertia::render('Admin/Files', [
            'folders' => FolderResource::collection(Folder::all()->take(4)),
            'images' => FileResource::collection($images),
            'files' => FileResource::collection($files),
            'videos' => FileResource::collection($videos),
            'audios' => FileResource::collection($audios),
            'recentFiles' => FileResource::collection($recentFiles),
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
            'user_id' => 'required'
        ]);


        $user = User::find($data['user_id']);
        //check for duplicate folder name or path
        $folder = Folder::where('name', $data['name'])->first();
        if ($folder) {
            return back()->with('error', 'Folder already exists');
        }
        //remove inbetween space in user name

        $data['path'] =  str_replace(' ', '', $user->name) . '/' . str_replace(' ', '', date('Y-m-d H:i:s'));

        //create hash of path with md5
        $data['hash'] = md5($data['path']);

        //create folder path with user name and current date and time 

        $folder = Folder::create($data);
        return back()->with('success', 'Folder created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        $data = $request->only([
            'name',
        ]);

        $folder->update($data);
        return back()->with('success', 'Folder updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //check if folder has files
        if ($folder->files->count() > 0) {
            return back()->with('error', 'Folder has files');
        }
        $folder->delete();
        return back()->with('success', 'Folder deleted successfully');
    }
}
