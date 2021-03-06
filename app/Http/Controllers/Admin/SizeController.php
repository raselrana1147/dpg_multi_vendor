<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Admin\Size;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('admin');
     }
     
     public function datatable()
     {
        $datas=Size::orderBy('id','DESC')->get();
       
         return DataTables::of($datas)
         ->editColumn('action',function(Size $data){
                  return '<a href="'.route('admin.size_edit',$data->id).'" class="btn btn-success btn-sm">
                   <i class="fa fa-edit"></i>
                   </a>
                    <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('admin.size_delete').'"  item_id="'.$data->id.'">
                    <i class="fa fa-trash"></i>
                   </a>';
         })
        ->rawColumns(['action'])
         ->make(true);
     }


     public function index()
     {
     	return view('admin.size.index');
     }
     
     public function edit($id)
     {
       $data=Size::findOrFail($id);
        return view('admin.size.edit',compact('data'));
     }

    public function create()
    {
      
    	 return view('admin.size.create');
    }

    public function store(Request $request)
    {


    	 $this->validate($request,[
            'size'=>'unique:sizes',
           ]);

       if ($request->isMethod('post'))
         {
             DB::beginTransaction();

             try{

                 //create size

                 $size = new Size();

                 $size->size_name = $request->size_name;
                 $size->size = $request->size;
              
                 $size->save();

                 DB::commit();

                 return \response()->json([
                     'message' => 'Successfully created',
                     'status_code' => 200
                 ], Response::HTTP_OK);

             }catch (QueryException $e){
                 DB::rollBack();

                 $error = $e->getMessage();

                 return \response()->json([
                     'error' => $error,
                     'status_code' => 500
                 ], Response::HTTP_INTERNAL_SERVER_ERROR);
             }
         }

    }


    public function update(Request $request)
    {
     
    $size=Size::findOrFail($request->id);
      $this->validate($request,[
          'size'=>'unique:sizes,size,'.$size->id,
      ]);

       if ($request->isMethod('post'))
         {
             DB::beginTransaction();

             try{

                 //Size update

                 $size->size_name = $request->size_name;
                 $size->size = $request->size;
              
                 $size->save();

                

                 DB::commit();

                 return \response()->json([
                     'message' => 'Successfully updated',
                     'status_code' => 200
                 ], Response::HTTP_OK);

             }catch (QueryException $e){
                 DB::rollBack();

                 $error = $e->getMessage();

                 return \response()->json([
                     'error' => $error,
                     'status_code' => 500
                 ], Response::HTTP_INTERNAL_SERVER_ERROR);
             }
         }
    }


    public function delete(Request $request){

     $data=Size::findOrFail($request->item_id);
     $data->delete();
     $notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

     return \response()->json([
         'message' => 'Successfully deleted',
         'status_code' => 200
     ], Response::HTTP_OK);

    }
}
