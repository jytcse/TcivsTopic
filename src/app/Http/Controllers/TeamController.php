<?php

namespace App\Http\Controllers;

use App\Models\Teammate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        所有組別
        $teams = Team::with('classmodel', 'teammates.user', 'teamleader.teammate.user')->get();
//        dd($teams);
        $hasTeam = (Teammate::query()->where('user_id', '=', Auth::user()->id)->get()->count() == 0) ? true : false;
//        dd($hasTeam);
        return view('manage.teams')->with(['teams' => $teams, 'hasTeam' => $hasTeam]);
    }

    public function my_team_index()
    {
//        我的組別
        if (!Teammate::query()->where('user_id', '=', Auth::user()->id)->count() > 0) {
            return view('manage.team')->with('hasTeam', false);
        }
        $team = Team::with('classmodel', 'teammates.user', 'teamleader.teammate.user')->get();
        return view('manage.team')->with(['team' => $team, 'hasTeam' => true]);
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
