<?php

namespace App\Http\Controllers\Api;

use App\Events\Invite;
use App\Events\TopicEdit;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamInvite;
use App\Models\Topic;
use App\Models\TopicKeyword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(Request $request)
    {

        event(new TopicEdit(['team_id' => $request->info['team_id'], "wrapper" => $request->all()]));
        return response()->json(['success' => true, 'message' => '廣播成功', 'status_code' => 200, 'data' => $request->info['team_id']], 200);
    }

    /**
     * 儲存專題資料
     * save topic data.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function save(Request $request)
    {
        $team_id = $request->info['team_id'];
        //隊伍不存在
        if (Team::query()->where('id', '=', $team_id)->count() == 0) {
            return response()->json(['success' => false, 'message' => 'resource not found.', 'status_code' => 404, 'data' => null], 404);
        }
        //如果專題不存在，就先建立一個預設專題
        if (Topic::query()->where('team_id', '=', $team_id)->count() == 0) {
            DB::beginTransaction();
            try {
                $topic = new Topic();
                $topic->team_id = $team_id;
                $topic->topic_name = '組別' . $team_id . '的專題';
                $topic->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Data to DataBase Error.', 'status_code' => 500, 'data' => null], 500);
            }
        }
        $topic_id = Topic::query()->where('team_id', '=', $team_id)->pluck('id')[0];
        if (array_key_exists('topic_keyword', $request->topic_data)) {
            if ($request->topic_data['topic_keyword'] == null) {
                TopicKeyword::query()->where('topic_id', '=', $topic_id)->delete();
            } else {
                $keyword_array = explode(',', $request->topic_data['topic_keyword']);
                TopicKeyword::query()->where('topic_id', '=', $topic_id)->whereNotIn('keyword', $keyword_array)->delete();
                foreach ($keyword_array as $keyword) {
                    //如果這個專題沒有重複的關鍵詞，並且輸入的關鍵詞不是空的
                    if (TopicKeyword::query()->where([['keyword', '=', trim($keyword)], ['topic_id', '=', $topic_id]])->count() == 0 && trim($keyword) != null) {
                        $topic_keyword = new TopicKeyword();
                        $topic_keyword->topic_id = $topic_id;
                        $topic_keyword->keyword = trim($keyword);
                        $topic_keyword->save();
                    }
                }
            }
        } else {
            $update_data = $request->topic_data;
            if (array_key_exists('topic_name', $request->topic_data) && empty($request->topic_data['topic_name'])) {
                //如果專題名子是空的話，就給他一個預設名子
                $update_data = ['topic_name' => ('組別' . $team_id . '的專題')];
            }
            $topic_update = Topic::query()->where('team_id', '=', $team_id)->update($update_data);
        }
        return response()->json(['success' => true, 'message' => 'update success. 儲存成功', 'status_code' => 200, 'data' => null], 200);
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
