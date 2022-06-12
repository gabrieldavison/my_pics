<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        return view('post.create', ['parent' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function getFolderLocation(Int $id)
    {
        $parent_id = $id;
        $folder_string = '';
        while ($parent_id !== 1) {
            $parent = Post::where('id', '=', $parent_id)->first();
            error_log($parent['parent_id']);

            // This enters an infinite loop
            $parent_directory = $parent['filename'] . '/';
            $folder_string = $parent_directory . $folder_string;
            // dd($parent_directory, $folder_string);
            $parent_id = $parent['parent_id'];
        }
        return 'root/' . $folder_string;
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $extension = '.' . $file->extension();
        $uuid = Str::uuid();
        $time = Carbon::now()->toDateTimeLocalString();
        $filename = $time . "_" . $uuid;
        // check if has parent
        $folder = $this->getFolderLocation($request->parent_id);
        $location = $folder . '/' . $filename . $extension;
        // set foldername to parent
        // else set foldername to filename
        // create location and save there


        Storage::disk('public')->put($location, file_get_contents($file));


        $p = new Post($request->all());
        $p->file = Storage::url($location);
        $p->filename = $filename;
        $p->save();

        return redirect("/posts/" . $request->parent_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();
        return view('post.show', [
            'post' => $post,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
