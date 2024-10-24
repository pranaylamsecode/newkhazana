<?php

namespace App\Http\Controllers;

use App\Models\Panel as Table;
use Spatie\Permission\Models\Role;

use Exception;
use App\Http\Requests\PanelRequests\UpdatePanel as UpdateRequest;
use App\Http\Requests\PanelRequests\AddPanel as AddRequest;
use App\Models\Category;
use App\Models\Panel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{
    protected $handle_name = "panel";
    protected $handle_name_plural = "panel";

    public function index()
    {
        $all_count = Table::count();
        $trashed_count = Table::onlyTrashed()->count();
        return kview($this->handle_name_plural.'.index', [
            'ajax_route' => route('admin.'.$this->handle_name_plural.'.ajax'),
            'delete_route'=> route('admin.'.$this->handle_name_plural.'.delete'),
            'create_route' => route('admin.'.$this->handle_name_plural.'.create'),
            'table_status'=> 'all', //all , trashed
            'all_count'=>$all_count,
            'trashed_count'=>$trashed_count,
        ]);

    }
    public function create()
    {
        $roles = Role::get();

        $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');  // Example:

            $all_data_for_date =   Panel::join('category', 'panels.category_id', '=', 'category.id')
            ->where('panels.name', $current_date)
            ->select('panels.*', 'category.name as category_name')
            ->get();


            $categories =   Category::get();

        return kview($this->handle_name_plural.'.manage', [
            'form_action' => route('admin.'.$this->handle_name_plural.'.store'),
            'edit' => 0,
            'roles'=>$roles,
            'current_date' => $current_date,
               'all_data_for_date' => $all_data_for_date,
               'categories' =>$categories
        ]);
    }
    public function edit(Request $request)
    {
        $roles = Role::get();
        return kview($this->handle_name_plural.'.manage', [
            'form_action' => route('admin.'.$this->handle_name_plural.'.update'),
            'edit' => 1,
            'data' => Table::where('id', '=', $request->id)->first(),
            'roles'=>$roles,
        ]);
    }
    public function store(Request $request)
    {
        try {
            // Check if the record already exists with the same name and category_id
            $existingRecord = Table::where('name', $request->name)
                                    ->where('category_id', $request->category_id)
                                    ->first();

            // Prepare the data to update/create
            $data = [
                'name' => $request->name,

                'category_id' => $request->category_id,
                'left_number' => $request->left_number,
                'right_number' => $request->right_number,
                'special_style' => $request->special_style,
            ];

            if ($existingRecord) {
                // If the record exists, update it
                $existingRecord->update($data);
                $user = $existingRecord;
            } else {
                // If the record doesn't exist, create a new one
                $user = Table::create($data);
            }

            // If role is present, sync the roles
            if (isset($request->role)) {
                $user->syncRoles($request->role);
            }

            // Redirect with success message
            return redirect()->route('admin.' . $this->handle_name_plural . '.index')
                             ->with('success', ucfirst($this->handle_name) . ' has been successfully ' . ($existingRecord ? 'updated' : 'created') . '.');

        } catch (Exception $e) {
            // Handle any exception and return back with an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            /* if(isset($request->two_factor_enable) && $request->two_factor_enable=="on"){
                $two_factor_enable = 1;
            }else{
                $two_factor_enable = 0;
            } */
            $update_data = [
                'name'=>$request->name,
                'email'=>$request->email,

            ];

            if(isset($request->old_password)){
                // $password=  Hash::make($request->password);
                $userObj = Table::where([
                    'id'=>$request->id,
                ])->first();
                if (Hash::check($request->old_password, $userObj->password)) {
                    $update_data['password'] = bcrypt($request->password);
                }else{
                    return redirect()->back()->with('error', "Old password is incorrect.");
                }
            }
            $where = [
                'id'=>$request->id
            ];

            $user = Table::updateOrCreate($where,$update_data);
            if(isset($request->role)){
              $user->syncRoles($request->role);
            }

            return redirect()->back()->with('success', ucfirst($this->handle_name).' has been updated');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function ajax(Request $request)
    {
        $edit_route = route('admin.'.$this->handle_name_plural.'.edit');
        $current_page = $request->page_number;
        if (isset($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 10;
        }
        $offset = (($current_page - 1) * $limit);
        $modalObject = new Table();
        if (isset($request->string)) {
            $string = $request->string;
            $modalObject = $modalObject->where('name', 'like', "%" . $request->string . "%");
            // $modalObject = $modalObject->orWhere('name','like',"%".$request->string."%");
        }

        $all_trashed = $request->all_trashed;
        if($all_trashed=="trashed"){
            $modalObject = $modalObject->onlyTrashed();
        }

        $total_records = $modalObject->count();
        $modalObject = $modalObject->offset($offset);
        $modalObject = $modalObject->take($limit);
        $data = $modalObject->get();

        if (isset($request->page_number) && $request->page_number != 1) {
            $page_number = $request->page_number + $limit - 1;
        } else {
            $page_number = 1;
        }
        $pagination = array(
            "offset" => $offset,
            "total_records" => $total_records,
            "item_per_page" => $limit,
            "total_pages" => ceil($total_records / $limit),
            "current_page" => $current_page,
        );

        return kview($this->handle_name_plural.'.ajax', compact('edit_route', 'data', 'page_number', 'limit', 'offset', 'pagination'));
    }
    public function delete(Request $request)
    {
        if(isset($request->action)){
            $action = $request->action;
            $is_bulk = $request->is_bulk;
            $data_id = $request->data_id;
        }
        switch ($action){
            case 'restore':
                try{
                    if($is_bulk==1){
                        $data_id = explode(",",$data_id);
                        $table = Table::onlyTrashed()->whereIn('id',$data_id);
                        $table->restore();
                        return 1;
                    }else{
                        $table = Table::onlyTrashed()->find($data_id);
                        $table->restore();
                        return 1;
                    }
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
                break;
            case 'trash' :
                try{
                    if($is_bulk==1){
                        $data_id = explode(",",$data_id);
                        $table = Table::whereIn('id',$data_id);
                        $table->delete();
                        return 1;
                    }else{
                        $table = Table::find($data_id);
                        $table->delete();
                        return 1;
                    }
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
                break;
            case 'delete' :
                try{
                    if($is_bulk==1){
                        $data_id = explode(",",$data_id);
                        $table = Table::withTrashed()->whereIn('id',$data_id)->get();
                        foreach($table as $tbl){
                            $tbl->forceDelete();
                        }
                        return 1;
                    }else{
                        $table = Table::withTrashed()->find($data_id);
                        $data = $table->forceDelete();
                        return 1;
                    }
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
                break;
            default :
               return 0;
        }
    }
}
