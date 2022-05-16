<?php

namespace App\Http\Controllers;

use App\Models\TeamLeader;
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
     * Create Team Page 建立組別頁面
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
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $permission = User::query()->where('id', '=', Auth::user()->getAuthIdentifier())->pluck('identity_id')[0];
        $team = new Team;
        $teammate = new Teammate;
        $teamleader = new TeamLeader;
        if ($permission == 1) {
            //學生
            $class_relation = User::query()->where('id', '=', Auth::id())->with('classmodel')->get()[0]->classmodel;

            //新增到組別
            $team->class_id = $class_relation->id;
            $team->creator = Auth::id();
            $team->save();

            //新增到組員
            $teammate->team_id = $team->id;
            $teammate->user_id = Auth::id();
            $teammate->save();

            //新增到組長
            $teamleader->team_id = $team->id;
            $teamleader->user_id = $teammate->id;
            $teamleader->save();
        } elseif ($permission == 2) {
            //老師
            //驗證使用者傳送過來的資訊，是否真的有這個id
            $class_query = ClassModel::query()->where('id', '=', $request->teacher_years_select);
            if ($class_query->count() == 0) {
                return back()->withErrors([
                    'form_tamper' => '401 表單->年度班級欄位，資料值不存在!',
                ]);
            }
            $user_query = User::query()->where('id', '=', $request->teacher_team_leader_select);
            //如果傳送過來的使用者id不存在 或是 班級與資料庫裡的班級不同 拋出錯誤
            if ($user_query->count() == 0 || $user_query->pluck('class_id')[0] != $request->teacher_years_select) {
                return back()->withErrors([
                    'form_tamper' => '401 表單->組長欄位，資料值不存在!',
                ]);
            }

            //驗證使用者傳送過來的資訊，是否真的有這個id
//            if (ClassModel::query()->where('id', '=', $request->teacher_years_select)->count() == 0) {
//                return 'error';
//            }


        }
//        dd($team);
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
