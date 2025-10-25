<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use DB;
use App\TeachingOtption;
use App\Courselibraries;
use App\CourseCategory;
class CourselibrariesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addLibrary(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$input=$request->all();
    		$this->validate($request,
            [    
            'teaching_id'=>'required',
            //'name'=>'required|string|max:255',
            'course_cat_id'=>'required'
            ]);

            $checkExist=Courselibraries::where('teaching_id','=',$input['teaching_id'])->where('name','=',$input['name'])->where('course_cat_id','=',$input['course_cat_id'])->where('is_deleted','=','0')->get()->toArray();
            if(!empty($checkExist))
            {
            	return back()->with('fail','Course alredy exist')->withInput(); 
            }
            else
            {
            	$course=new Courselibraries;
            	$course->teaching_id=$input['teaching_id'];
                $course->course_id=$input['course_id'];
            	$course->name=$input['name'] ?? 'Not Level';
            	$course->course_cat_id=$input['course_cat_id'];
            	$course->created_at=date('Y-m-d H:i:s');
            	$course->updated_at=date('Y-m-d H:i:s');

            	if($course->save())
	    		{
	    			return redirect(route('GelallLibrary'))->with('success','Sucessfully created course level.');	
	    		}
	    		else
	    		{
	    			return redirect(route('GelallLibrary'))->with('fail','Unable to create course level please try again')->withInput();
	    		}
            }
    	}

    	$TeachingOtption=TeachingOtption::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
    	return view('admin.course_library.add_library',['TeachingOtption'=>$TeachingOtption]);
    }

    public function editLibrary(Request $request, $id)
    {	
    	$EditData=Courselibraries::find($id);
		if($request->isMethod('post'))
    	{
    		$input=$request->all();
    		$this->validate($request,
            [    
            'teaching_id'=>'required',
            //'name'=>'required|string|max:255',
            'course_cat_id'=>'required'
            ]);

            
            	$course=Courselibraries::find($id);
            	$course->teaching_id=$input['teaching_id'];
                $course->course_id=$input['course_id'];
            	$course->name=$input['name'] ?? 'Not Level';
            	$course->course_cat_id=$input['course_cat_id'];
            	$course->created_at=date('Y-m-d H:i:s');
            	$course->updated_at=date('Y-m-d H:i:s');

            	if($course->save())
	    		{
	    			return redirect(route('GelallLibrary'))->with('success','Sucessfully updated course level.');	
	    		}
	    		else
	    		{
	    			return redirect(route('GelallLibrary'))->with('fail','Unable to create update level please try again')->withInput();
	    		}
            
    	}
    	$TeachingOtption=TeachingOtption::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
    	$CourseCategory=CourseCategory::where('teaching_id','=',$EditData->teaching_id)->where('status','=','1')->where('is_deleted','=','0')->whereNotIn('id',[2,5])->get()->toArray();

        $CourseProduct=Course::where('teaching_id','=',$EditData->teaching_id)->where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
    	return view('admin.course_library.edit_library',['TeachingOtption'=>$TeachingOtption,'CourseCategory'=>$CourseCategory,'EditData'=>$EditData,'CourseProduct'=>$CourseProduct]);    	
    }

    public function GelallLibrary(Request $request)
    {   
        $libraries_List=[];
        $libraries_List_sprite=[];
    	$libraries_List=Courselibraries::select('courselibraries.id','courselibraries.name','courselibraries.status','coursecategories.category_name','teachingoptions.option_name','courses.course_name','courses.id as course_id','courselibraries.teaching_id','courselibraries.course_cat_id')
    								->join('coursecategories','courselibraries.course_cat_id','=','coursecategories.id')
    								->join('teachingoptions','coursecategories.teaching_id','=','teachingoptions.id')
                                    ->join('courses','courselibraries.course_id','=','courses.id')
                                    ->where('courselibraries.status','=','1')
                                    ->where('courselibraries.is_deleted','=','0')
                                    //->orwhereIn('courselibraries.course_id',[0])                        
    								->get()->toArray();

            /*$libraries_List_sprite=Courselibraries::select('courselibraries.id','courselibraries.name','courselibraries.status','coursecategories.category_name','teachingoptions.option_name',DB::raw('"" as course_name'))
                                    ->join('coursecategories','courselibraries.course_cat_id','=','coursecategories.id')
                                    ->join('teachingoptions','coursecategories.teaching_id','=','teachingoptions.id')
                                    //->join('courses','courselibraries.course_id','=','courses.id')
                                    ->where('courselibraries.status','=','1')
                                    ->whereIn('courselibraries.course_id',[0])                        
                                    ->get()->toArray(); */                       

    								//echo "<pre>";print_r($libraries_List_sprite);die;
                                    //array_unshift($libraries_List_sprite, $libraries_List);
                                   //$libraries_List= array_merge($libraries_List,$libraries_List_sprite);
				return view('admin.course_library.library_list',['libraries_List'=>$libraries_List]);	
    }

    public function getcategoryCourse(Request $request)
    {
    	$input=$request->all();

    	$CourseCategory=CourseCategory::where('teaching_id','=',$input['teaching_id'])->where('status','=','1')->where('is_deleted','=','0')->get();
    	return view('admin.course_library.getcategoryCourse',['CourseCategory'=>$CourseCategory]);

    }

    public function getcategoryCoursePDFProject(Request $request)
    {
        $input=$request->all();

        $CourseCategory=CourseCategory::where('teaching_id','=',$input['teaching_id'])->where('status','=','1')->where('is_deleted','=','0')->whereNotIn('id',[2,5])->get();
        return view('admin.course_library.getcategoryCourse',['CourseCategory'=>$CourseCategory]);

    }

    public function getcourseProduct(Request $request)
    {
        $input=$request->all();
        $courseProduct=Course::where('teaching_id','=',$input['teaching_id'])->where('is_deleted','=','0')->get()->toArray();
        /*if($input['teaching_id']==\Config::get('constants.freeOption'))
        {
            $courseProduct[]=['id'=>0,'course_name'=>"free",'teaching_id'=>1];
        }*/
        //print_r($courseProduct);die;exit;
        return view('admin.course_library.getcourseProduct',['courseProduct'=>$courseProduct]);

    }

    public function delete_library(Request $request)
    {
        $input=$request->all();
        $Courselibraries=Courselibraries::find($input['data_id']);
        $Courselibraries->is_deleted=1;
        //print_r($Courselibraries);die;
        if($Courselibraries->save())
            {
                return redirect(route('GelallLibrary'))->with('success','Sucessfully deleted level.');   
            }
            else
            {
                return redirect(route('GelallLibrary'))->with('fail','Unable to delete level please try again')->withInput();
            }

    }
}
