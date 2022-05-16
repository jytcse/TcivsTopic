<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\ClassModel;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request, $class_id)
    {
//        dd(Teammate::query()->where())
        //身分是學生，年度班級符合篩選條件，不包括自己
        $teammate_query = Teammate::all()->pluck('user_id');
//        return $teammate_query;
        $search_user = User::query()->where([['identity_id', '=', '1'], ['class_id', '=', $class_id], ['id', '!=', Auth::id()]])->whereNotIn('id', $teammate_query)->orderBy('student_id');
        $search_user = $search_user->get();


        if ($search_user->count() == 0) {
            return response()->json(['success' => false, 'message' => '找不到資源 Resource not found. ', 'status_code' => 404], 404);
        }

        return response()->json(['success' => true, 'message' => '', 'status_code' => 200, 'data' => $search_user], 200);
//        return ;

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
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
