<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Http\Resources\FolderResource;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Termwind\Components\Dd;

class UserController extends Controller
{
    function index()
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

        $users = User::all();
        return Inertia::render('Admin/Users', [
            'folders' => FolderResource::collection(Folder::all()->take(4)),
            'images' => FileResource::collection($images),
            'files' => FileResource::collection($files),
            'videos' => FileResource::collection($videos),
            'audios' => FileResource::collection($audios),
            'recentFiles' => FileResource::collection($recentFiles),
            'users' => $users,
        ]);
    }

    //create new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'status' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    //update user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'status' => 'required',
        ]);

        //check if password is not empty
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    //delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
