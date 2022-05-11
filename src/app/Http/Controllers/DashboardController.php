<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamLeader;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Teammate::query()->where('user_id', '=', Auth::user()->id)->count() > 0) {
            return view('manage.dashboard')->with('hasTeam', false);
        }
        $team = Teammate::query()->where('user_id', '=', Auth::user()->id)->with('team', 'team.classmodel')->get()[0];
        $teammate_id = Teammate::query()->where('user_id', '=', Auth::user()->id)->pluck('id')[0];
//    職位
        $position = (TeamLeader::query()->where('user_id', '=', $teammate_id)->with('user')->get()->count() == 0) ? false : true;
        return view('manage.dashboard')->with(['team' => $team, 'position' => $position, 'hasTeam' => true]);
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
