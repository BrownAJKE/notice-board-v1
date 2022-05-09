<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\User;
use App\Events\NoticeNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewNoticeAdded;
use Illuminate\Support\Facades\URL;

class NoticeBoardController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices  = Notice::where('approved', true)->paginate(10);

        return view('notice-board', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notice-board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $notice =  auth()->user()->notices()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        $admin = User::where('isAdmin', true)->first();

        Notification::send($admin, new NewNoticeAdded($notice));

        return redirect()->route('dashboard')->with('success', 'Notice created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        return view('notice-board.show', compact('notice'));   
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
    public function destroy(Request $request, Notice $notice)
    {
        $notice->delete();
        return redirect()->back()->with('success', 'Notice deleted successfully');
    }

    public function approveNotice(Notice $notice){

        $notice->update(['approved' => true]);
        $notice->save;

        event( new NoticeNotification($notice));

        return redirect()->back()->with('success', 'Notice approved successfully');
    }
}
