<?php

namespace App\Http\Controllers;

use App\Models\Teammate;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Home 首頁
     * Return home blade ,and topic data
     *
     * @return Application|Factory|View
     */
    public function home(): View|Factory|Application
    {
//SELECT * FROM `users` ORDER BY RAND() LIMIT 3;
        $topic_data = Topic::query()->where('topic_thumbnail','!=',null)->with('team.teamleader.user','team.classmodel')->inRandomOrder()->limit(5)->get();

        return view('home')->with(['topic_data' => $topic_data]);
    }
}
