<?php

namespace App\Http\Controllers\Api;

use App\Events\Invite;
use App\Events\TopicEdit;
use App\Http\Controllers\Controller;
use App\Models\TeamInvite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
//        dd($request->all());
//        return $request['info'];
        //
//        return  $request->all();
        event(new TopicEdit(['team_id' => $request->info['team_id'], "wrapper" => $request->all()]));
        return response()->json(['success' => true, 'message' => '', 'status_code' => 200, 'data' => $request->info['team_id']], 200);
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
