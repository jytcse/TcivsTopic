<?php

namespace App\Http\Controllers\Api;

use App\Events\Invite;
use App\Events\TopicEdit;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamInvite;
use App\Models\Teammate;
use App\Models\Topic;
use App\Models\TopicDoc;
use App\Models\TopicKeyword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class TopicApiController extends Controller
{
    private function check_topic_exist($team_id)
    {
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
    }

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
     * @param Request $request
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload_thumbnail(Request $request)
    {
        if (!$request->hasFile('thumbnail')) {
            return response()->json(["success" => false, "message" => '沒有上傳檔案.', "data" => null], 400);
        }
        $validator = Validator::make($request->all(), ['thumbnail' => ['image', 'required', 'max:15000']]);
        if ($validator->fails()) {
            return response()->json(["success" => false, 'message' => 'Not Acceptable. 最大15MB', "data" => null], 406);
        }
        if (Teammate::query()->where('user_id', '=', Auth::id())->count() == 0) {
            return response()->json(["success" => false, 'message' => 'Team not found', "data" => null], 404);
        }

        $team_id = Teammate::query()->where('user_id', '=', Auth::id())->pluck('team_id')[0];
        $this->check_topic_exist($team_id);
        $path = $request->file('thumbnail')->store('topic/thumbnail', 'public');
        $topic_query = Topic::query()->where('team_id', '=', $team_id);
        //更新圖片，要把舊的刪除
        if ($topic_query->pluck('topic_thumbnail')[0] != null) {
            $before_path = str_replace('/storage', '/public', $topic_query->pluck('topic_thumbnail')[0]);
            if (Storage::exists($before_path)) {
                Storage::delete($before_path);
            } else {
                return response()->json(['success' => false, 'message' => 'resource not found'], 404);
            }
        }
        Topic::query()->where('team_id', '=', $team_id)->update(['topic_thumbnail' => Storage::url($path)]);
        return response()->json(["success" => true, 'message' => 'Upload success.', "data" => Storage::url($path)], 200);
    }


    /**
     * 上傳文檔 pdf word
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload_doc(Request $request)
    {
        if (!$request->hasFile('doc')) {
            return response()->json(["success" => false, "message" => '沒有上傳檔案.', "data" => null], 400);
        }
        $validator = Validator::make($request->all(), ['doc' => ['file', 'max:10000', 'mimes:pdf,doc,docx']]);
        if ($validator->fails()) {
            return response()->json(["success" => false, 'message' => 'Not Acceptable. 只接受pdf,doc,docx並小於10MB的檔案', "data" => $validator->errors()], 406);
        }
        $team_id = Teammate::query()->where('user_id', '=', Auth::id())->pluck('team_id')[0];
        $this->check_topic_exist($team_id);
        $topic_id = Topic::query()->where('team_id', '=', $team_id)->pluck('id')[0];
        $file_name = $request->file('doc')->getClientOriginalName();

        if (TopicDoc::query()->where('topic_id', '=', $topic_id)->count() == 0) {
            DB::beginTransaction();
            try {
                $path = $request->file('doc')->store('topic/doc', 'public');
                $topic_doc = new TopicDoc();
                $topic_doc->topic_id = $topic_id;
                $topic_doc->file_name = $file_name;
                $topic_doc->file_path = Storage::url($path);
                $topic_doc->save();
                DB::commit();
                return response()->json(["success" => true, 'message' => 'Upload success.', "data" => ['url'=>Storage::url($path),'name'=>$file_name]], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Data to DataBase Error.', 'status_code' => 500, 'data' => $e->getMessage()], 500);
            }
        }
        DB::beginTransaction();
        try {
            $before_path = str_replace('/storage', '/public', TopicDoc::query()->where('topic_id','=',$topic_id)->pluck('file_path')[0]);
            if (Storage::exists($before_path)) {
                Storage::delete($before_path);
            } else {
                return response()->json(['success' => false, 'message' => 'Delete resource not found'], 404);
            }
            $path = $request->file('doc')->store('topic/doc', 'public');
            TopicDoc::query()->where('topic_id','=',$topic_id)->update(['file_name'=>$file_name,'file_path'=>Storage::url($path)]);
            DB::commit();
            return response()->json(["success" => true, 'message' => 'Upload success.', "data" => ['url'=>Storage::url($path),'name'=>$file_name]], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data to DataBase Error.', 'status_code' => 500, 'data' => $e->getMessage()], 500);
        }
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
     * @param Request $request
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
        $this->check_topic_exist($team_id);
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
