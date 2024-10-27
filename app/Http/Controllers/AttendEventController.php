<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\RegisterEvent;
use Illuminate\Support\Facades\Auth;

class AttendEventController extends Controller
{


    public function show($id)
    {
        $iduser = Auth::id();
        RegisterEvent::create([
            'id_post' => $id,
            'id_user' => $iduser,


        ]);
        return redirect()->route('posts.index');
    }
}
