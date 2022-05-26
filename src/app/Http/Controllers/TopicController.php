<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Team;
use App\Models\TeamInvite;
use App\Models\Teammate;
use App\Models\Topic;
use App\Models\TopicKeyword;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    private function get_has_topic_class()
    {
        //有專題的team->id
        $has_topic_team_id = Topic::all('team_id');
        //有專題的class->id
        $has_topic_class_id = Team::query()->whereIn('id', $has_topic_team_id)->distinct()->pluck('class_id');
        $class_query = ClassModel::query()->whereIn('id', $has_topic_class_id)->where('years', '!=', '老師');
        if ($class_query->count() == 0) {
            return null;
        } else {
            return $class_query->get();
        }
    }

    /**
     * All Topic Page 前台所有專題頁面
     * Display All Topic On the Page.
     * @return Application|Factory|View
     */
    public function all_topic()
    {
        $class_data = $this->get_has_topic_class();
//        dd($class_data);
        return redirect()->route('single_class_topic', ["year" => $class_data[0]->years, "class_type" => $class_data[0]->class_type]);
//        dd('123');
//        return view('topic')->with(['class_data' => $this->get_has_topic_class()]);
    }

    /**
     * 顯示指定年度班級的專題
     * Display the specified class's topic.
     *
     * @param $year
     * @param $class_type
     * @return Application|Factory|View
     */
    public function single_class_topic($year, $class_type)
    {
        $class_query = ClassModel::query()->where([['years', '=', $year], ['class_type', '=', $class_type]]);
        if ($class_query->count() == 0) {
            abort(404);
        }
        $class_id = $class_query->get('id');
        $team_id = Team::query()->whereIn('class_id', $class_id)->get('id');
        $topic_query = Topic::query()->whereIn('team_id', $team_id);
        $topic_id_for_keyword = $topic_query->get('id')->toArray();
        $topic_data = $topic_query->with('keywords', 'team.teamleader.user')->orderByDesc('topic_thumbnail')->get();
        $keyword_data = TopicKeyword::query()->whereIn('topic_id', $topic_id_for_keyword)->distinct()->get('keyword');

        return view('topic')->with(['class_data' => $this->get_has_topic_class(), 'keyword_data' => $keyword_data, 'topic_data' => $topic_data, 'route_parameter' => ['year' => $year, 'type' => $class_type]]);
        //
    }

    /**
     * 顯示指定年度班級的專題
     * Display the specified class's topic.
     *
     * @param $year
     * @param $class_type
     * @return Application|Factory|View
     */
    public function specified_topic($year, $class_type, $topic_id)
    {
        $class_query = ClassModel::query()->where([['years', '=', $year], ['class_type', '=', $class_type]]);
        $topic_query = Topic::query()->where('id', '=', $topic_id);
        if ($topic_query->count() == 0 || $class_query->count() == 0) {
            abort(404);
        }
        $topic_data = $topic_query->with('keywords','team.classmodel','team.teamleader.user','team.teammates.user')->get()[0];

        return view('specified-topic')->with(['class_data' => $this->get_has_topic_class(), "topic_data" => $topic_data]);
        //
    }

    /**
     * 顯示指定關鍵詞的專題
     * Display the specified class's topic.
     *
     * @param $year
     * @param $class_type
     * @return Application|Factory|View
     */
    public function specified_keyword_topic($keyword)
    {
        $keyword_query = TopicKeyword::query()->where('keyword', '=', $keyword);
        if ($keyword_query->count() == 0) {
            return abort(404);
        }
        $topic_id = $keyword_query->distinct()->get('topic_id');

        $keyword_data = TopicKeyword::query()->whereIn('topic_id', $topic_id)->distinct()->get('keyword');
        $topic_data = Topic::query()->whereIn('id', $topic_id)->orderByDesc('topic_thumbnail')->with('team.teamleader')->get();
        $team_id = Topic::query()->whereIn('id', $topic_id)->distinct()->get('team_id');
        $class_id = Team::query()->whereIn('id', $team_id)->distinct()->get('class_id');
        $class_data = ClassModel::query()->whereIn('id', $class_id)->get();
        return view('topic')->with(['class_data' => $this->get_has_topic_class(), "keyword_data" => $keyword_data, "topic_data" => $topic_data, 'route_parameter' => ['keyword' => $keyword]]);
    }

    /**
     * My Topic Page 我的專題頁面
     * Display User's Topic on Page.
     *
     * @return Application|Factory|View
     */
    public function my_topic(Request $request)
    {
        //如果他沒有組別，轉跳到我的組別
        if (Teammate::query()->where('user_id', '=', Auth::id())->count() == 0) {
            return redirect()->route('my_team');
        }
        $team_data = Teammate::query()->where('user_id', '=', Auth::id())->with('team')->get()[0];
        $team_id = Teammate::query()->where('user_id', '=', Auth::id())->pluck('team_id')[0];
        if (Topic::query()->where('team_id', '=', $team_id)->count() == 0) {
            return view('manage.my-topic')->with(['team_data' => $team_data, 'topic_database_data' => null, 'inbox_number' => $this->check_inbox_message_number(), 'api_token' => $request->cookie('x-access-token')]);
        }
        $topic_database_data = Topic::query()->where('team_id', '=', $team_id)->with('keywords', 'doc')->get()[0];
        return view('manage.my-topic')->with(['team_data' => $team_data, 'topic_database_data' => $topic_database_data, 'inbox_number' => $this->check_inbox_message_number(), 'api_token' => $request->cookie('x-access-token')]);
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
