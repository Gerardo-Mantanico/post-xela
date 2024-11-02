<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\RegisterEvent;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class AttendEventController extends Controller
{


    public function show($id)
    {
        $iduser = Auth::id();
        try {
            RegisterEvent::create([
                'id_post' => $id,
                'id_user' => $iduser
            ]);
            session()->flash('success', 'Evento  registrado');
        } catch (QueryException $e) {
            session()->flash('alert', 'Ya has participado en este evento.');
        }

        return redirect()->route('posts.index');
    }
}
