<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
                    ->select('id', 'title', 'content', 'created_at')
                    ->where('active', true)
                    ->get();
        // dd($posts);
        $view_data = [
            'posts' => $posts,
        ];

        return view('posts.index', $view_data); // posts.index (posts adalah nama folder, index adalah nama file)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); //  disini hanya menampilkan form saja
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // disini proses form akan dijalankan
        $title = $request->input('title'); // name=title yang ada di form create.blade.php
        $content = $request->input('content'); // name=content yang ada di form create.blade.php

        DB::table('posts')->insert([
            'title' => $title,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s'), // kapan tgl ditambahkan
            'updated_at' => date('Y-m-d H:i:s'), // kapan tgl diubah
        ]);

        return redirect('posts'); // redirect ke halaman posts setelah data berhasil ditambahkan
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table('posts')
            ->select('id', 'title', 'content', 'created_at')
            ->where('id', $id) // SELECT * FROM posts WHERE id = $id
            ->first(); // first berfungsi untuk mendapatkan data pertama dari atasnya

        $view_data = [
            'post' => $post
        ];
        return view('posts.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::table('posts')
            ->select('id', 'title', 'content', 'created_at')
            ->where('id', $id)
            ->first();

        $view_data = [
            'post' => $post
        ];

        return view('posts.edit', $view_data);
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
        $title = $request->input('title');
        $content = $request->input('content');

        DB::table('posts')
            ->where('id', $id) // secara default operator yang digunakan yaitu sama dengan (=)
            ->update([
                'title' => $title,
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s'), // kapan tgl diubah
            ]);

        return redirect("posts/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('posts')
        ->where('id', $id)
        ->delete();

        return redirect('posts');
    }
}
