<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Category;
use DOMDocument;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        // Obtener los datos validados
        $data = $request->validated();
        print_r($data['description']);

        $description = $data['description'];

        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time() . $key . '.png';
            file_put_contents(public_path() . $image_name, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $description = $dom->saveHTML();


        $data['id_user'] = 1;
        $data['confirmed'] = $data['confirmed'] ?? 0;
        $data['description'] = $description;
        Post::create($data);

        // return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }




    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
