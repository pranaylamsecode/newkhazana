<?php

namespace App\Http\Controllers;

use App\Models\Jodi;
use App\Models\Panel;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Preparing count for Dashboard Array
        $users = User::count();

        $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:

        $jodi_data = Jodi::where('name', $current_date)->first();

        $panel_data  = Panel::where('name', $current_date)->first();



        // Preparing Dashboard card Array.
        $dashboard_cards = [
            ['Users', $users, Route('admin.users.index'),'fa fa-dashboard'],

            // ['News', $news, 'news.index'],
        ];
        return kview('home',compact('dashboard_cards','jodi_data','panel_data'));
    }
}
