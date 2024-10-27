<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReportPostRequest;
use App\Http\Requests\UpdateReportPostRequest;
use App\Models\ReportPost;
use App\Models\Post;
use App\Models\User;
use App\Models\RegisterEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        return redirect()->route('posts.index');
    }

    public function store(Request $request)
    {
        $id_user = Auth::id();
        $id_post = $request['id_post'];
        $cause = $request['cause'];
        $report = DB::select('CALL create_report(?,?,?)', [$id_post, $id_user, $cause]);
        return redirect()->route('posts.index');
    }

    public function show(Request $id)
    {
        $id_user = Auth::id();
        RegisterEvent::create([
            'id_post' =>  $id,
            'id_user' => $id_user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) {}

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
