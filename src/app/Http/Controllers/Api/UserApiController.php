<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamInvite;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 顯示可以被邀請的使用者
     * Show Can be invited User
     *
     * @param Request $request
     * @param $class_id
     * @return JsonResponse
     */
    public function show(Request $request, $class_id): JsonResponse
    {
        //身分是學生，年度班級符合篩選條件，不包括自己
        $teammate_query = Teammate::all()->pluck('user_id');
        $search_user = User::query()->where([['identity_id', '=', '1'], ['class_id', '=', $class_id], ['id', '!=', Auth::id()]])->whereNotIn('id', $teammate_query)->orderBy('student_id');
        $search_user = $search_user->get();
        if ($search_user->count() == 0) {
            return response()->json(['success' => false, 'message' => '找不到資源 Resource not found. ', 'status_code' => 404], 404);
        }
        return response()->json(['success' => true, 'message' => '', 'status_code' => 200, 'data' => $search_user], 200);
    }

    /**
     * 顯示使用者接受到的邀請
     * Show User's invite
     *
     * @param $user_id
     * @return JsonResponse
     */
    public function show_inbox_invite($user_id): JsonResponse
    {
//        $team_invite_query = TeamInvite::query()->where([['recipient', '=', $user_id], ['state', '=', 'pending']]);
//        if ($team_invite_query->count() == 0) {
//            return response()->json(['success' => false, 'message' => '找不到資源 Resource not found. ', 'status_code' => 404], 404);
//        }
//        return response()->json(['success' => true, 'message' => '', 'status_code' => 200, 'data' => $team_invite_query->get()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
