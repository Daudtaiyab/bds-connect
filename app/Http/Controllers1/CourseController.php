<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mail\Mailer;
use App\Course;
use DB;
use App\TeachingOtption;
use App\Courselibraries;
use App\CourseCategory;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCourse(Request $request)
    {

    	if($request->isMethod('post'))
    	{
    		$input=$request->all();
    		$this->validate($request,
            [    
            'teaching_id'=>'required',
            'course_name'=>'required|string|max:255',
            ]);

            $checkExist=Course::where('teaching_id','=',$input['teaching_id'])->where('course_name','=',$input['course_name'])->where('is_deleted','=','0')->get()->toArray();
            if(!empty($checkExist))
            {
            	return back()->with('fail','Course alredy exist')->withInput(); 
            }
            else
            {
            	$course=new Course;
            	$course->teaching_id=$input['teaching_id'];
            	$course->course_name=$input['course_name'];
            	$course->created_by=Auth::user()->id;
            	$course->created_at=date('Y-m-d H:i:s');
            	$course->updated_at=date('Y-m-d H:i:s');

                if($request->hasFile('course_img'))
                {
                    $imagename1=time().'_'.$request->course_img->getClientOriginalName();
                    //echo $imagename;
                    $request->course_img->move(public_path('uploads/product/'),$imagename1);
                    $course->course_img=$imagename1;
                }
            	if($course->save())
	    		{	
	    	
	    			return redirect(route('getallCourse'))->with('success','Sucessfully created course.');	
	    		}
	    		else
	    		{
	    			return redirect(route('getallCourse'))->with('fail','Unable to create course please try again')->withInput();
	    		}
            }

    	}
    	$TeachingOtption=TeachingOtption::where('status','=','1')->where('is_deleted','=','0')->where('free_paid','=',\Config::get('constants.paidOption'))->get()->toArray();
    	return view('admin.course.addcourse',['TeachingOtption'=>$TeachingOtption]);

    }

    public function editCourse(Request $request, $id)
    {

    	if($request->isMethod('post'))
    	{
    		$input=$request->all();
            //print_r($input);die;
    		$this->validate($request,
            [    
            'teaching_id'=>'required',
            'course_name'=>'required|string|max:255',
            ]);

            	$course=Course::find($id);
            	$course->teaching_id=$input['teaching_id'];
            	$course->course_name=$input['course_name'];
            	$course->created_by=Auth::user()->id;
            	$course->updated_at=date('Y-m-d H:i:s');

                if($request->hasFile('course_img'))
                {
                    //echo "sdfsd";die;
                    $imagename1=time().'_'.$request->course_img->getClientOriginalName();
                    //echo $imagename1; die;
                    $request->course_img->move(public_path('uploads/product/'),$imagename1);
                    $course->course_img=$imagename1;
                }
                //echo"<pre>";print_r($course);die;
            	if($course->save())
	    		{
	    			return redirect(route('getallCourse'))->with('success','Sucessfully updated course.');	
	    		}
	    		else
	    		{
	    			return redirect(route('getallCourse'))->with('fail','Unable to update course please try again')->withInput();
	    		}
    	}	
    	$EditData=Course::select('courses.id','courses.course_name','courses.status','teachingoptions.option_name','courses.teaching_id')
    								->join('teachingoptions','courses.teaching_id','=','teachingoptions.id')
    								->where('courses.id','=',$id)
    								->first();
                                    //echo"<pre>";print_r($EditData);die;
    		$TeachingOtption=TeachingOtption::where('status','=','1')->where('is_deleted','=','0')->where('free_paid','=',\Config::get('constants.paidOption'))->get()->toArray();						
   			return view('admin.course.editcourse',['EditData'=>$EditData,'TeachingOtption'=>$TeachingOtption]); 									
    }

    public function getallCourse(Request $request)
    {
    	$data['course_list']=Course::select('courses.id','courses.course_name','courses.status','teachingoptions.option_name')
    								->join('teachingoptions','courses.teaching_id','=','teachingoptions.id')
    								->where('courses.is_deleted','=','0')
                                    ->whereNotIn('courses.id',\Config::get('constants.freeCourse'))
    								->get()
    								->toArray();
    	return view('admin.course.courselist',['data'=>$data]);
    }

    public function courseRemove(Request $request)
    {
        $input=$request->all();
        $course=Course::find($input['data_id']);
        $course->is_deleted=1;
        //print_r($Courselibraries);die;
        if($course->save())
            {
                return redirect(route('getallCourse'))->with('success','Sucessfully deleted course.');   
            }
            else
            {
                return redirect(route('getallCourse'))->with('fail','Unable to delete course please try again')->withInput();
            }
    }	
}
