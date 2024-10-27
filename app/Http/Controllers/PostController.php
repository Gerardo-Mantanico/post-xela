<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Category;
use DOMDocument;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('state_publication', 'ACTIVATED')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $description = $request->description;
        $cleaned_description = preg_replace('/<!DOCTYPE.*?>|<html.*?>|<\/html>|<body.*?>|<\/body>/', '', $description);

        // Cargar el HTML limpio en DOMDocument
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Para evitar advertencias sobre HTML mal formado
        $dom->loadHTML($cleaned_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD); // Carga HTML

        $images = $dom->getElementsByTagName('img');

        // Crear el contenedor Swiper
        $swiperContainer = $dom->createElement('div');
        $swiperContainer->setAttribute('class', 'swiper mySwiper mb-6');

        // Crear el contenedor de las diapositivas
        $swiperWrapper = $dom->createElement('div');
        $swiperWrapper->setAttribute('class', 'swiper-wrapper');

        // Recorrer las imágenes y agregar cada una como un div.swiper-slide
        for ($i = $images->length - 1; $i >= 0; $i--) {
            $img = $images->item($i);

            // Decodificar la imagen y guardar
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time() . $i . '.png';
            file_put_contents(public_path() . $image_name, $data);

            // Crear el div para la imagen
            $slide = $dom->createElement('div', '');
            $slide->setAttribute('class', 'swiper-slide');

            // Crear el elemento de imagen
            $imageElement = $dom->createElement('img', '');
            $imageElement->setAttribute('src', $image_name);
            $imageElement->setAttribute('style', 'width: 100%; height: 100%; object-fit: cover;'); // Ocupa todo el contenedor  // O usando Tailwind: $imageElement->setAttribute('class', 'w-[300px] h-[200px] object-cover rounded-lg');
            $imageElement->setAttribute('alt', 'Slide ' . ($i + 1));

            // Añadir la imagen al div de diapositiva
            $slide->appendChild($imageElement);

            // Añadir el div de diapositiva al contenedor swiper-wrapper
            $swiperWrapper->appendChild($slide);

            // Eliminar la imagen original del DOM
            $img->parentNode->removeChild($img);
        }

        // Añadir el swiper-wrapper al swiper-container
        $swiperContainer->appendChild($swiperWrapper);

        // Agregar botones de navegación
        $nextButton = $dom->createElement('div', '');
        $nextButton->setAttribute('class', 'swiper-button-next text-white');
        $swiperContainer->appendChild($nextButton);

        $prevButton = $dom->createElement('div', '');
        $prevButton->setAttribute('class', 'swiper-button-prev text-white');
        $swiperContainer->appendChild($prevButton);

        // Agregar paginación
        $pagination = $dom->createElement('div', '');
        $pagination->setAttribute('class', 'swiper-pagination');
        $swiperContainer->appendChild($pagination);

        // Añadir el contenedor de Swiper al DOM
        $dom->appendChild($swiperContainer); // Añadir al documento

        // Guardar el HTML modificado
        $description = $dom->saveHTML();
        // Crear el post (ejemplo básico, ajusta según tu modelo)
        $user_id = $iduser = Auth::id();
        Post::create([
            'title' => $request['title'],
            'id_user' => $user_id,
            'date_event' => $request['date_event'],
            'time_event' => $request['time_event'],
            'capacity' => $request['capacity'],
            'id_category' => $request['id_category'],
            'description' => $description,
            'address' => $request['address'],

        ]);
        return redirect()->route('posts.index');
    }

    public function show()
    {
        $posts = Post::get();
        return view('post.show', compact('posts'));
    }

    public function publication()
    {
        $posts = Post::get();
        return view('post.show', compact('posts'));
    }

    public function reportEvent(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.index');
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

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
