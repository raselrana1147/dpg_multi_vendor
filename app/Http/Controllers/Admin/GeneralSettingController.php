<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\GeneralSetting;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

class GeneralSettingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	$general_setting=GeneralSetting::first();
    	return view('admin.setting.index',compact("general_setting"));
    }

    public function update_general_setting(Request $request)
    {
         
       

          if ($request->isMethod('post'))
            {
                DB::beginTransaction();

                try{

                    //general setting update

                   $setting=GeneralSetting::findOrFail($request->id);
                   $setting->site_name=$request->site_name;
                   $setting->title=$request->title;
                   $setting->site_name=$request->site_name;
                   $setting->copyright=$request->copyright;
                   $setting->currency=$request->currency;
                   $setting->company_address=$request->company_address;
                   $setting->description=$request->description;
                   $setting->company_phone=$request->company_phone;
                   $setting->company_email=$request->company_email;
                   $setting->facebook=$request->facebook;
                   $setting->instrgram=$request->instrgram;
                   $setting->youtube=$request->youtube;
                   $setting->twitter=$request->twitter;
                   $setting->linkedin=$request->linkedin;

            
                    if($request->hasFile('logo')){

                            // delete current image

                          if (File::exists(base_path('/assets/backend/image/logo/'.$setting->logo))) 
                            {
                              File::delete(base_path('/assets/backend/image/logo/'.$setting->logo));
                            }
                          
                            // upload new logo
                            $logo=$request->logo;
                            $logo_name=strtolower(Str::random(10)).time().".".$logo->getClientOriginalExtension();
                            $logo_path = base_path().'/assets/backend/image/logo/'.$logo_name;
                           
                            Image::make($logo)->save($logo_path);
                            $setting->logo = $logo_name;
                        
                    }

                       if($request->hasFile('favicon')){

                            // delete current image

                          if (File::exists(base_path('/assets/backend/image/logo/'.$setting->favicon))) 
                            {
                              File::delete(base_path('/assets/backend/image/logo/'.$setting->favicon));
                            }
                          
                            // upload new logo
                            $favicon=$request->favicon;
                            $favicon_name=strtolower(Str::random(10)).time().".".$favicon->getClientOriginalExtension();
                            $favicon_path = base_path().'/assets/backend/image/logo/'.$favicon_name;
                           
                            Image::make($favicon)->save($favicon_path);
                            $setting->favicon = $favicon_name;
                        
                     }



                     if($request->hasFile('default_image')){

                            // delete current image

                          if (File::exists(base_path('/assets/backend/image/'.$setting->default_image))) 
                            {
                              File::delete(base_path('/assets/backend/image/'.$setting->default_image));
                            }
                          
                            // upload new logo
                            $default_image=$request->default_image;
                            $default_image_name=strtolower(Str::random(10)).time().".".$default_image->getClientOriginalExtension();
                            $default_image_path = base_path().'/assets/backend/image/'.$default_image_name;
                           
                            Image::make($default_image)->save($default_image_path);
                            $setting->default_image = $default_image_name;
                     }



                      if($request->hasFile('loader')){

                            // delete current image

                          if (File::exists(base_path('/assets/backend/image/logo/'.$setting->loader))) 
                            {
                              File::delete(base_path('/assets/backend/image/logo/'.$setting->loader));
                            }
                          
                            // upload new logo
                            $loader=$request->loader;
                            $loader_name=strtolower(Str::random(10)).time().".".$loader->getClientOriginalExtension();
                            $loader_path = base_path().'/assets/backend/image/logo/'.$loader_name;
                           
                            Image::make($loader)->save($loader_path);
                            $setting->loader = $loader_name;
                        
                     }


                     if($request->hasFile('slider_background')){

                            // delete current image

                          if (File::exists(base_path('/assets/backend/image/logo/'.$setting->slider_background))) 
                            {
                              File::delete(base_path('/assets/backend/image/logo/'.$setting->slider_background));
                            }
                          
                            // upload new logo
                            $slider_background=$request->slider_background;
                            $slider_background_name=strtolower(Str::random(10)).time().".".$slider_background->getClientOriginalExtension();
                            $slider_background_path = base_path().'/assets/backend/image/logo/'.$slider_background_name;
                           
                            Image::make($slider_background)->save($slider_background_path);
                            $setting->slider_background = $slider_background_name;
                        
                     }

                    $setting->save();

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
}
