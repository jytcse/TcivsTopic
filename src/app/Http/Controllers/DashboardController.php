<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamInvite;
use App\Models\TeamLeader;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->getAuthIdentifier();
        if (!Teammate::query()->where('user_id', '=', $user_id)->count() > 0) {
            return view('manage.dashboard')->with(['hasTeam' => false, 'inbox_number' => $this->check_inbox_message_number()]);
        }
        $team = Teammate::query()->where('user_id', '=', $user_id)->with('team', 'team.classmodel','team.topic')->get()[0];
        $teammate_id = Teammate::query()->where('user_id', '=', $user_id)->pluck('id')[0];
        //職位
        $position = !((TeamLeader::query()->where('user_id', '=', $teammate_id)->with('user')->get()->count() == 0));

        return view('manage.dashboard')->with(['team' => $team, 'position' => $position, 'hasTeam' => true, 'inbox_number' => $this->check_inbox_message_number()]);
    }

    public function inbox(Request $request)
    {
//        dd(TeamInvite::query()->where('recipient', '=', Auth::id())->get());
        $team_invite_query = TeamInvite::query()->where([['recipient', '=', Auth::id()], ['state', '=', 'pending']]);
        if ($team_invite_query->count() != 0) {
            $team_invite = $team_invite_query->with('team', 'team.classmodel', 'team.teammates', 'team.teamleader')->get();
        } else {
            $team_invite = null;
        }
        return view('manage.inbox')->with(['team_invite' => $team_invite, 'inbox_number' => $this->check_inbox_message_number()]);
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
