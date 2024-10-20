<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReportPostRequest;
use App\Http\Requests\UpdateReportPostRequest;
use App\Models\ReportPost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = ReportPost::get();
        return view('reportPost.index', compact('report'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $iduser = Auth::id();
        ReportPost::create([
            'id_post' => 2,
            'id_user_report' => $iduser,
            'cause' => "reporte"
        ]);
        return redirect()->route('posts.index');
    }

    public function store(Request $request)
    {
        if ($request['cause'] == null) {
            return redirect()->route('posts.index');
        } else {
            $iduser = Auth::id();
            ReportPost::create([
                'id_post' => $request['id_post'],
                'id_user_report' => $iduser,
                'cause' => $request['cause'],
            ]);
            return redirect()->route('posts.index');
        }
    }

    public function show(ReportPost $reportPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportPost $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportPostRequest $request, ReportPost $reportPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportPost $reportPost)
    {
        //
    }
}
