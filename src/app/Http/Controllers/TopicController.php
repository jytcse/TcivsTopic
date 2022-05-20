<?php

namespace App\Http\Controllers;

use App\Models\TeamInvite;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Check Invite Message Number 檢查通知數量
     *
     * @return int
     */
    private function check_inbox_message_number(): int
    {
        return TeamInvite::query()->where([['recipient', '=', Auth::id()], ['state', '=', 'pending']])->count();
    }

    /**
     * All Topic Page 所有專題頁面
     * Display All Topic On the Page.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * My Topic Page 我的專題頁面
     * Display User's Topic on Page.
     *
     * @return Application|Factory|View
     */
    public function my_topic()
    {
        //如果他沒有組別，轉跳到我的組別
        if (Teammate::query()->where('user_id', '=', Auth::id())->count() == 0) {
            return redirect()->route('my_team');
        }
        //
//        dd('123');
        return view('manage.my-topic')->with(['inbox_number' => $this->check_inbox_message_number()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
