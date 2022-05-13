<?php

namespace App\Http\Controllers;

use App\Models\Teammate;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

//ParameterBag::
class TeamController extends Controller
{
    /**
     * Check team state 檢查組別狀態
     *
     * @return boolean
     */
    private function check_team_state()
    {
        //沒有組別的話 return 1
        return Teammate::query()->where('user_id', '=', Auth::user()->getAuthIdentifier())->get()->count() == 0;
    }

    /**
     * Teams 所有組別
     * Check team state , then return view 檢查是否有加入組別，回傳頁面給使用者
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $teams = Team::with('classmodel', 'teammates.user', 'teamleader.teammate.user')->get();
        return view('manage.teams')->with(['teams' => $teams, 'hasTeam' => $this->check_team_state()]);
    }

    /**
     * Team 我的組別
     * Check team state , then return view 檢查是否有組別，回傳頁面給使用者
     *
     * @return Application|Factory|View
     */
    public function my_team_index(): View|Factory|Application
    {
        $team = Team::with('classmodel', 'teammates.user', 'teamleader.teammate.user')->get();
        return view('manage.team')->with(['team' => $team, 'hasTeam' => !($this->check_team_state())]);
    }

    /**
     * Create Team 建立組別
     * Check team state , then return view 檢查是否有組別，回傳頁面給使用者
     *
     * @return RedirectResponse|Application|Factory|View
     */
    public function create_team_page(Request $request): View|Factory|RedirectResponse|Application
    {
        $user_id = Auth::user()->getAuthIdentifier();
        $api_token = $request->cookie('x-access-token');
        if (!$this->check_team_state()) {
            return redirect()->route('my_team');
        }
        $user = User::query()->where('id', '=', $user_id)->with('classmodel')->get()[0];
        $class_data = ClassModel::query()->where('years', '!=', '老師')->get();
        return view('manage.create-team')->with(['user' => $user, 'class_data' => $class_data, 'api_token' => $api_token]);
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
     * Create new Team 建立新的組別
     * Get form data form frontend and store to database 從前端取得表單資料，儲存在資料庫裡
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * 查看單一組別
     * Display the specified Team. 利用id來尋找組別，並回傳資料
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
