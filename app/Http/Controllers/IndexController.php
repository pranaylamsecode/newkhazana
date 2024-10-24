<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jodi;
use App\Models\Panel;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

            $data['current_date']  = $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');

            $data['yesterday_date'] = $yesterday_date = Carbon::now('Asia/Kolkata')->subDay()->format('Y-m-d');


            // Example:
            $data['categories'] =   Category::get();



            $data['all_data_panels'] =  Panel::join('category', 'panels.category_id', '=', 'category.id')
            ->where('panels.name', $current_date)
            ->select('panels.*', 'category.name as category_name')
            ->get();

            $get_path = Setting::where('key','front_image')->first();


            $data['path'] =   $get_path->value;

            $get_path = Setting::where('key','front_color_background')->first();


            $data['front_color_background'] =   $get_path->value;

            $get_path = Setting::where('key','front_color_card_header')->first();


            $data['front_color_card_header'] =   $get_path->value;


            $get_path = Setting::where('key','front_title')->first();


            $data['front_title'] =   $get_path->value;

            $get_path = Setting::where('key','site_name')->first();


            $data['site_name'] =   $get_path->value;





        return view('welcome', $data);
    }

    public function jodiDisplay(Request $request)
    {
        $data = array();
        $data['current_date']  = $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:
            $lastSegment = request()->segment(count(request()->segments()));

            $data['all_data_jodies'] =  Jodi::join('category', 'jodis.category_id', '=', 'category.id')
            ->where('jodis.category_id', $lastSegment)
            ->select('jodis.*', 'category.name as category_name')
            ->get();



            $data['categories'] =   Category::where('id',$lastSegment)->first();



        return view('frontendcustom.express', $data);
    }


    public function PanelDisplay(Request $request)
    {
        $data = array();
        $data['current_date']  = $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:
            $lastSegment = request()->segment(count(request()->segments()));

            $data['all_data_jodies'] =  Jodi::join('category', 'jodis.category_id', '=', 'category.id')
            ->where('jodis.category_id', $lastSegment)
            ->select('jodis.*', 'category.name as category_name')
            ->get();

            /* print_r($data['all_data_jodies']);die; */


            $data['categories'] =   Category::where('id',$lastSegment)->first();


        return view('frontendcustom.mahal', $data);
    }


    public function clearLaravelCache()
    {
        // Clear application cache
        Artisan::call('cache:clear');

        // Clear route cache
        Artisan::call('route:clear');

        // Clear config cache
        Artisan::call('config:clear');

        // Clear view cache
        Artisan::call('view:clear');

        return redirect()->back()->with('success', 'Application cache cleared!');
    }


}
