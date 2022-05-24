<?php

namespace App\Http\Controllers;

use App\Events\Invite;
use App\Models\TeamInvite;
use App\Models\TeamLeader;
use App\Models\Teammate;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//ParameterBag::
class TeamController extends Controller
{
    /**
     * Check team state 檢查組別狀態
     *
     * @return boolean
     */
    private function check_team_state(): bool
    {

        //沒有組別的話 return 1
        return Teammate::query()->where('user_id', '=', Auth::user()->getAuthIdentifier())->get()->count() == 0;
    }

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
     * Teams 所有組別
     * Check team state , then return view 檢查是否有加入組別，回傳頁面給使用者
     *
     * @param null $year
     * @param string $class_type
     * @return Application|Factory|View|RedirectResponse
     */
    public function index($year = null, string $class_type = 'A'): View|Factory|RedirectResponse|Application
    {
        //如果任何班級都沒有組別
        if (Team::all()->count() == 0) {
            return view('manage.teams')->with(['teams' => null, 'select_class_data' => null, 'inbox_number' => $this->check_inbox_message_number()]);
        }
        //不重複的班級id 有就代表該班級底下有隊伍
        $distinct_class_id = Team::query()->distinct()->pluck('class_id');
        $available_class = ClassModel::query()->whereIn('id', $distinct_class_id)->where('years', '!=', '老師')->get();
        if ($year == null) {
            //如果使用者沒有輸入年度，回傳資料庫裡最新有組別的年度
            $year = $available_class[0]->years;
            return redirect()->route('teams', ['year' => $year, 'class_type' => $class_type]);
        }
        switch ($class_type) {
            case 'A':
                $class_type = '甲';
                break;
            case 'B':
                $class_type = '乙';
                break;
        }
        $class_query = ClassModel::query()->where([['years', '=', $year], ['class_type', '=', $class_type]]);
        //如果找不到使用者所選的年度班級 return 404 page
        if ($class_query->count() == 0) {
            abort(404);
        }
        $class_id = $class_query->pluck('id')[0];
        $teams = Team::query()->where('class_id', '=', $class_id)->with('classmodel', 'teammates.user', 'teamleader.teammate.user')->get();
        if ($teams->count() == 0) {
            $teams = null;
        }
        $select_class_data = $available_class;
        return view('manage.teams')->with(['teams' => $teams, 'select_class_data' => $select_class_data, 'hasTeam' => $this->check_team_state(), 'inbox_number' => $this->check_inbox_message_number()]);
    }

    /**
     * Team 我的組別
     * Check team state , then return view 檢查是否有組別，回傳頁面給使用者
     *
     * @return Application|Factory|View
     */
    public function my_team_index(): View|Factory|Application
    {
        if (Teammate::query()->where('user_id', '=', Auth::id())->count() == 0) {

            return view('manage.team')->with(['hasTeam' => !($this->check_team_state()), 'inbox_number' => $this->check_inbox_message_number()]);
        }
        $team = Teammate::query()->where('user_id', '=', Auth::id())->with('team', 'team.teaminvite.user', 'team.teamleader.user', 'team.teammates', 'team.classmodel','team.topic')->get()[0];
        return view('manage.team')->with(['team' => $team, 'hasTeam' => !($this->check_team_state()), 'inbox_number' => $this->check_inbox_message_number()]);
    }

    /**
     * Create Team Page 建立組別頁面
     * Check team state , then return view 檢查是否有組別，回傳頁面給使用者
     *
     * @param Request $request
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
        $class_query = ClassModel::query()->where('years', '!=', '老師');
        if ($class_query->count() == 0) {
            $class_data = null;
        } else {
            $class_data = $class_query->get();
        }
        return view('manage.create-team')->with(['user' => $user, 'class_data' => $class_data, 'api_token' => $api_token, 'inbox_number' => $this->check_inbox_message_number()]);
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
     * @throws Exception
     */
    public function store(Request $request)
    {
        $permission = User::query()->where('id', '=', Auth::id())->pluck('identity_id')[0];
        $team = new Team;
        $teammate = new Teammate;
        $teamleader = new TeamLeader;
        if ($request->student_id != null) {
            foreach ($request->student_id as $student_id) {
                //檢查要邀請的使用者存不存在
                if (User::query()->where('id', '=', $student_id)->count() == 0) {
                    return redirect()->back()->withErrors([
                        'insert_error' => '404 表單->要邀請的組員，不存在!',
                    ]);
                }
                //檢查受邀請的使用者是否加入了隊伍
                if (Teammate::query()->where('user_id', '=', $student_id)->get()->count() != 0) {
                    return redirect()->back()->withErrors([
                        'insert_error' => '要邀請的組員:' . User::query()->where('id', '=', $student_id)->pluck('name')[0] . '，已經加入其他組別了!',
                    ]);
                }
            }
        }
        if ($permission == 1) { //學生
            $class_relation = User::query()->where('id', '=', Auth::id())->with('classmodel')->get()[0]->classmodel;
            //如果已經加入其他隊伍，回傳錯誤訊息
            if (Teammate::query()->where('user_id', '=', Auth::id())->count() > 0) {
                return redirect()->back()->withErrors([
                    'insert_error' => '資料重複新增!',
                ]);
            }

            DB::beginTransaction();
            try {
                //將該使用者所受到的邀請全部拒絕
                TeamInvite::query()->where([['state', '=', 'pending'], ['recipient', '=', Auth::id()]])->update(['state' => 'reject']);

                //將自己新增到組別
                $team->class_id = $class_relation->id;
                $team->creator = Auth::id();
                $team->save();

                //將自己新增到組員
                $teammate->team_id = $team->id;
                $teammate->user_id = Auth::id();
                $teammate->save();

                //將自己新增到組長
                $teamleader->team_id = $team->id;
                $teamleader->user_id = $teammate->id;
                $teamleader->save();
                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors([
//                    'insert_error' => $e->getMessage(),
                    'insert_error' => '新增到資料庫失敗!請聯絡系統管理員。',
                ]);
            }

            if ($request->student_id != null) {
                //建立事件 並通知使用者
                foreach ($request->student_id as $student_id) {
                    $new_team_data = Team::query()->where('id', '=', $team->id)->with('classmodel', 'teamleader.user')->get()[0];
                    event(new Invite(["team_id" => strval($team->id), "recipient" => strval($student_id), "team_data" => $new_team_data, "inbox_number" => TeamInvite::query()->where([['recipient', '=', $student_id], ['state', '=', 'pending']])->count()]));
                }
            }
            return redirect()->route('my_team')->with('insert_success', "新增組別成功! 你是組長，加油!");

        } elseif ($permission == 2 || $permission == 3) {   //老師

            $class_query = ClassModel::query()->where('id', '=', $request->teacher_years_select);
            //驗證使用者傳送過來的資訊，是否真的有這個id
            if ($class_query->count() == 0) {
                return redirect()->back()->withErrors([
                    'form_tamper' => '年度班級欄位，資料值不存在!',
                ]);
            }
            $user_query = User::query()->where('id', '=', $request->teacher_team_leader_select);
            //如果傳送過來的使用者id不存在 或是 班級與資料庫裡的班級不同 拋出錯誤
            if ($user_query->count() == 0 || $user_query->pluck('class_id')[0] != $request->teacher_years_select) {
                return redirect()->back()->withErrors([
                    'form_tamper' => '組長欄位，資料值不存在!',
                ]);
            }

            DB::beginTransaction();
            try {
                TeamInvite::query()->where([['state', '=', 'pending'], ['recipient', '=', $user_query->pluck('id')[0]]])->update(['state' => 'reject']);
                //新增到組別
                $team->class_id = $user_query->pluck('class_id')[0];
                $team->creator = Auth::id();
                $team->save();

                //新增到組員
                $teammate->team_id = $team->id;
                $teammate->user_id = $user_query->pluck('id')[0];
                $teammate->save();
                //新增到組長
                $teamleader->team_id = $team->id;
                $teamleader->user_id = $teammate->id;
                $teamleader->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors([
//                    'insert_error' => $e->getMessage(),
                    'insert_error' => '新增到資料庫失敗!請聯絡系統管理員。',
                ]);
            }
            if ($request->student_id != null) {
                //建立事件 並通知使用者
                foreach ($request->student_id as $student_id) {
                    $new_team_data = Team::query()->where('id', '=', $team->id)->with('classmodel', 'teamleader.user')->get()[0];
                    event(new Invite(["team_id" => strval($team->id), "recipient" => strval($student_id), "team_data" => $new_team_data, "inbox_number" => TeamInvite::query()->where([['recipient', '=', $student_id], ['state', '=', 'pending']])->count()]));
                }
            }
            return redirect()->back()->with('insert_success', "新增組別成功! 組長為: " . $user_query->pluck('name')[0] . "，創建者為: " . Auth::user()->name);

        }
        return redirect()->back()->withErrors([
            'error' => '403 權限錯誤',
        ]);
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
     * Edit Team Intive State 修改組別邀請狀態
     *
     * @param $team_id
     * @param $action_type
     * @return RedirectResponse
     */
    public function edit($team_id, $action_type)
    {
        //檢查有沒有這個隊伍
        if (Team::query()->where('id', '=', $team_id)->count() == 0) {
            return redirect()->back()->withErrors([
                'team_dont_exist' => '404 該組別資料值不存在!',
            ]);
        }
        //動作不支援
        if ($action_type != 'accept' && $action_type != 'reject') {
            return redirect()->back()->withErrors([
                'action_method_dont_accept' => '動作不支援。',
            ]);
        }
        $team_invite_query = TeamInvite::query()->where([['team_id', '=', $team_id], ['recipient', '=', Auth::id()]]);
        if ($team_invite_query->pluck('state')[0] == 'reject') {
            return redirect()->back()->withErrors([
                'action_reply' => '動作失敗! 此邀請已是拒絕狀態。',
            ]);
        };
        if ($action_type == 'reject') {
            DB::beginTransaction();
            try {
                $team_invite_query->update(['state' => strval($action_type)]);
                DB::commit();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors([
                    'reject_team_fail' => '拒絕組別時與資料庫互動失敗，請聯繫系統管理員。',
                ]);
            }
            return redirect()->back()->with('edit_success', "動作成功! 已拒絕該邀請。");
        }
        //加入組別前，先檢查是不是有加入過了
        if (Teammate::query()->where('user_id', '=', Auth::id())->count() != 0) {
            return redirect()->back()->withErrors([
                'already_is_teammate' => '加入組別失敗! 你已經是其他組的組員了。',
            ]);
        }
        if (!$team_invite_query->update(['state' => strval($action_type)])) {
            return redirect()->back()->withErrors([
                'edit_fail' => '動作更新失敗。',
            ]);
        }
        DB::beginTransaction();
        try {
            TeamInvite::query()->where([['team_id', '!=', $team_id], ['recipient', '=', Auth::id()]])->update(['state' => 'reject']);
            $teammate = new Teammate;
            $teammate->team_id = $team_id;
            $teammate->user_id = Auth::id();
            $teammate->save();
            DB::commit();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'join_team_fail' => '加入組別時與資料庫互動失敗，請聯繫系統管理員。',
            ]);
        }
        return redirect()->back()->with('edit_success', "動作成功! 已接受該邀請。 你現在是該組別的一員了，加油!");
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
