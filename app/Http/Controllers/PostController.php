<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // $view_data = [
        //     'posts' => "Ini postingan.",
        //     'comments' => "Ini komentar."
        // ];

        // $view_data = [
        //     'posts' => ['satu', 'dua', 'tiga', 'empat', 'lima']
        // ];

        // $view_data = [
        //     'posts' => [
        //         // Title            Content
        //         ["Mengenal Laravel", "Ini adalah blog tentang Laravel"],
        //         ["Mengapa PHP?", "PHP adalah bahasa pemrograman yang populer"]
        //     ]
        // ];

        $posts = Storage::get('posts.txt');
        $posts = explode("\n", $posts);
        // dd($posts);

        $view_data = [
            'posts' => $posts
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

        // dibaca data terbaru
        $posts = Storage::get('posts.txt');
        $posts = explode("\n", $posts);

        // tambah data baru
        $new_post = [
            count($posts) + 1,
            $title,
            $content,
            date('Y-m-d H:i:s')
        ];

        // menggabungkan array menjadi satu string
        $new_post = implode(",", $new_post);
        // dd($new_post);

        array_push($posts, $new_post); // menambahkan data baru ke dalam array $posts
        $posts = implode("\n", $posts); // menggabungkan array $posts menjadi string dengan pemisah baris baru
        // dd($posts);

        Storage::write('posts.txt', $posts); // menulis data baru ke dalam file posts.txt

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
        // echo "Halaman detail dari post dengan ID: $id";

        $posts = Storage::get('posts.txt');
        $posts = explode("\n", $posts);
        $selected_post = Array();
        
        foreach($posts as $post){
            $post = explode(",", $post);
            if($post[0] == $id) {
                $selected_post = $post;
            }
        }
        $view_data = [
            'post' => $selected_post
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
