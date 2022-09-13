<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemMaster;
use App\ItemType;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dump($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }
    public function index(Request $request)
    {
        $masters = ItemMaster::where('deleted_at', null)->get();
        $types = ItemType::where('deleted_at', null)->get();
        #$this->dump($masters);        
        return view('items.index')
            ->with('masters', $masters)
            ->with('types', $types)
            ->with('menu', 'item');
    }


    /*
    ===================
    =====REPORTS=======
    ===================
    */
    public function viewReports()
    {
        $masters = ItemMaster::where('deleted_at', null)->get();
        $types = ItemType::where('deleted_at', null)->get();
        // dd(ItemMaster::with('type')->get());
        return view('reports.index')
            ->with('masters', $masters)
            ->with('types', $types)
            ->with('menu', 'report');
    }

    /*
    ===================
    =====ITEM TYPE=====
    ===================
    */

    public function getTypes(Request $request){

        $types = ItemType::where('deleted_at', null)->get();
        $selected_item = '';

        if($request->input('item') == 'master'){
            if($request->input('id')){
                $selected_item = ItemMaster::where('deleted_at', null)->where('id',$request->input('id'))->first();
            }
        }else if($request->input('item') == 'type'){
            if($request->input('id')){
                $selected_item = ItemType::where('deleted_at', null)->where('id',$request->input('id'))->first();
            }
        }
        
        return response()->json([
            'items' => $types,
            'result' => 'get',
            'selected' => $selected_item
        ]);
    }

    
    public function storeType(Request $request){
        $validator = Validator::make(
            [
                'code' => $request->input('code'),
                'description' => $request->input('description'),
            ],
            [
                'code' => 'required|unique:item_types',
                'description' => 'required'
            ]
        );
        if ($validator->fails()){
            return back()->withErrors($validator->messages())->withInput();
        }

        $type = new ItemType;
        $type->code = $request->input('code');
        $type->description = $request->input('description');
        $type->save();


        return back()->with('success', 'Item Type Successfully Added');
        
    }

    public function updateType(Request $request, $id){
        $validator = Validator::make(
            [
                'code' => $request->input('code'),
                'description' => $request->input('description'),
            ],
            [
                'code' => 'required|unique:item_types,code,'.$id.',id,deleted_at,NULL',
                'description' => 'required'
            ]
        );
        if ($validator->fails()){
            return back()->withErrors($validator->messages())->withInput();
        }

        ItemType::where('id', $id)->update([
            'code' => $request->input('code'),
            'description' => $request->input('description')
        ]);

        return back()->with('success', 'Item Type Successfully Updated');
    }

    public function deleteType(Request $request, $id){

        $ItemMaster = ItemMaster::where('type_id', $id)->where('deleted_at', null)->first();
        if($ItemMaster):
            return response()->json([
                'items' => 'has_master',
                'result' => 'delete'
            ]);
        endif;
        ItemType::where('id', $id)->update(['deleted_at' => now()]);  
        \Session::flash('success', "Item Type Successfully Deleted");
        return response()->json([
            'items' => 'deleted',
            'result' => 'delete'
        ]);
    }

    /*
    ===================
    =====Item Master===
    ===================
    */
    public function storeMaster(Request $request){
        $validator = Validator::make(
            [
                'type' => $request->input('type'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
            ],
            [
                'type' => 'required',
                'code' => 'required|unique:item_masters',
                'description' => 'required'
            ]
        );
        if ($validator->fails()){
            return back()->withErrors($validator->messages())->withInput();
        }

        $master = new ItemMaster;
        $master->type_id = $request->input('type');
        $master->code = $request->input('code');
        $master->description = $request->input('description');
        $master->save();

        return back()->with('success', 'Item Master Successfully Added');
    }

    public function updateMaster(Request $request, $id){
        $validator = Validator::make(
            [
                'type_id' => $request->input('type'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
            ],
            [
                'type_id' => 'required',
                'code' => 'required|unique:item_masters,code,'.$id.',id,deleted_at,NULL',
                'description' => 'required'
            ]
        );
        if ($validator->fails()){
            return back()->withErrors($validator->messages())->withInput();
        }

        ItemMaster::where('id', $id)->update([
            'type_id' => $request->input('type'),
            'code' => $request->input('code'),
            'description' => $request->input('description')
        ]);

        return back()->with('success', 'Item Type Successfully Updated');
    }

    public function deleteMaster(Request $request, $id){

        ItemMaster::where('id', $id)->update(['deleted_at' => now()]);  
        \Session::flash('success', "Item Type Successfully Deleted");
        return response()->json([
            'items' => 'deleted',
            'result' => 'delete'
        ]);
    }
}
