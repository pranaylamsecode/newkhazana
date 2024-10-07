<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jodi;
use App\Models\Panel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array();
        $data['current_date']  = $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:

            $data['all_data_jodies'] =  Jodi::join('category', 'jodis.category_id', '=', 'category.id')
            ->where('jodis.name', $current_date)
            ->select('jodis.*', 'category.name as category_name')
            ->get();
            $data['categories'] =   Category::get();

            $data['all_data_panels'] =  Panel::join('category', 'panels.category_id', '=', 'category.id')
            ->where('panels.name', $current_date)
            ->select('panels.*', 'category.name as category_name')
            ->get();





        return view('welcome', $data);
    }

    public function jodiDisplay(Request $request)
    {
        $data = array();
        $data['current_date']  = $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:

            $data['all_data_jodies'] =  Jodi::join('category', 'jodis.category_id', '=', 'category.id')
            ->where('jodis.name', $current_date)
            ->select('jodis.*', 'category.name as category_name')
            ->get();
            $data['categories'] =   Category::get();


        return view('frontendcustom.express', $data);
    }


    public function PanelDisplay(Request $request)
    {
        $data = array();
        $data['current_date']  = $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:


            $data['categories'] =   Category::get();

            $data['all_data_panels'] =  Panel::join('category', 'panels.category_id', '=', 'category.id')
            ->where('panels.name', $current_date)
            ->select('panels.*', 'category.name as category_name')
            ->get();


        return view('frontendcustom.mahal', $data);
    }



}
