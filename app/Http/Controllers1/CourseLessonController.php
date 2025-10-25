<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseLession;
use App\TeachingOtption;
use App\Courselibraries;
use Auth;
use DB;
use App\Course;
use App\CourseCategory;
use App\CodeLibraryLessons;
class CourseLessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addLesson(Request $request)
    {
    	if($request->isMethod('post'))
        {
            $input=$request->all();
            //echo "<pre>";print_r($input);die;
            $this->validate($request,
            [    
            'teaching_id'=>'required',
            //'course_id'=>'required',
            //'course_cat_id'=>'required',
            //'level_id'=>'required',
            //'lesson_title'=>'required',
            //'lesson_subject'=>'required',
            //'lesson_iframe_code'=>'required',
            ]);

            $checkExist=[];
            if(!empty($checkExist))
            {
                return back()->with('fail','Course alredy exist')->withInput(); 
            }
            else
            {
                $courseLesson=new CourseLession;

                $courseLesson->teaching_id=$input['teaching_id'];
                $courseLesson->course_id=$input['course_id'];
                $courseLesson->cat_id=$input['course_cat_id'];
                $courseLesson->level_id=$input['level_id'];
                $courseLesson->lesson_title=$input['lesson_title'];
                $courseLesson->lesson_subject=$input['lesson_subject'];
                $courseLesson->lesson_iframe_code=$input['lesson_iframe_code'];
                $courseLesson->lesson_video=$input['lesson_video'];
                $courseLesson->created_by=Auth::user()->id;
                $courseLesson->updated_at=date('Y-m-d H:i:s');
                //$courseLesson->updated_at=date('Y-m-d H:i:s');

                if($request->hasFile('lesson_document'))
                {
                    //echo "sdfsd";die;
                    $imagename1=time().'_'.$request->lesson_document->getClientOriginalName();
                    //echo $imagename1; die;
                    $request->lesson_document->move(public_path('uploads/codeproduct/'),$imagename1);
                    $courseLesson->lesson_document=$imagename1;
                }

                if($courseLesson->save())
                {   

                    if(in_array($input['course_cat_id'],[\Config::get('constants.freeProject'),\Config::get('constants.paidProject')]))
                    {
                        if($request->hasfile('code_file'))
                         {  
                            $i=0;
                            $data=[];
                            foreach($request->file('code_file') as $file)
                            {
                                $name = time().'.'.$file->getClientOriginalName();
                                $file->move(public_path().'/uploads/code_lib', $name);  
                                $data[] = [
                                    'code_file'=>$name,
                                    'code_title'=>$request->code_title[$i],
                                    'lesson_id'=>$courseLesson->id,
                                    'cat_id'=>$courseLesson->cat_id,
                                    'level_id'=>$courseLesson->level_id,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                ];
                                 $i++;
                            }
                            CodeLibraryLessons::insert($data); 
                         }  
                    }
                    
                    return redirect(route('GetallLesson'))->with('success','Sucessfully created course level.');   
                }
                else
                {
                    return redirect(route('GetallLesson'))->with('fail','Unable to create course level please try again')->withInput();
                }
            }
        }
        $TeachingOtption=TeachingOtption::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
        $courseProduct=Course::where('teaching_id','=',\Config::get('constants.paidOption'))->where('is_deleted','=','0')->get();
        $CourseCategory=CourseCategory::where('teaching_id','=',\Config::get('constants.paidOption'))->where('status','=','1')->where('is_deleted','=','0')->get();
    	return view('admin.course_lesson.add_lesson',['TeachingOtption'=>$TeachingOtption,'courseProduct'=>$courseProduct,'CourseCategory'=>$CourseCategory]);
    }

    public function GetallLesson()
    {   
        $get_all_lesson=[];
        $get_all_lesson_sprite=[];
        $get_all_lesson=CourseLession::select('course_lessons.id','course_lessons.lesson_title','course_lessons.lesson_subject','course_lessons.lesson_document','course_lessons.lesson_iframe_code','course_lessons.lesson_video','courses.course_name','coursecategories.category_name','courselibraries.name as level_name','teachingoptions.option_name','course_lessons.status','course_lessons.cat_id')
                                        ->join('courses','course_lessons.course_id','=','courses.id')
                                        ->join('coursecategories','course_lessons.cat_id','=','coursecategories.id')
                                        ->join('courselibraries','course_lessons.level_id','=','courselibraries.id')
                                        ->join('teachingoptions','course_lessons.teaching_id','=','teachingoptions.id')
                                        ->where('course_lessons.status','=','1')
                                        ->where('course_lessons.is_deleted','=','0')
                                        ->where('course_lessons.course_id','>','0')
                                        ->get()->toArray();

        // $get_all_lesson_sprite=CourseLession::select('course_lessons.id','course_lessons.lesson_title','course_lessons.lesson_subject','course_lessons.lesson_document','course_lessons.lesson_iframe_code','course_lessons.lesson_video',DB::raw('"" as course_name'),'coursecategories.category_name','courselibraries.name as level_name','teachingoptions.option_name','course_lessons.status')
        //                                 //->join('courses','course_lessons.course_id','=','courses.id')
        //                                 ->join('coursecategories','course_lessons.cat_id','=','coursecategories.id')
        //                                 ->join('courselibraries','course_lessons.level_id','=','courselibraries.id')
        //                                 ->join('teachingoptions','course_lessons.teaching_id','=','teachingoptions.id')
        //                                 ->where('course_lessons.status','=','1')
        //                                 ->where('course_lessons.is_deleted','=','0')
        //                                  ->where('course_lessons.course_id','=','0')
        //                                 ->get()->toArray();                                
            //echo "<pre>";print_r($get_all_lesson);die;
            //$get_all_lesson= array_merge($get_all_lesson,$get_all_lesson_sprite);
            return view('admin.course_lesson.lesson_list',['get_all_lesson'=>$get_all_lesson]);                            
    }

    public function editLesson(Request $request, $id)
    {
        
            if($request->isMethod('post'))
            {   
                //print_r($request->all());die;
                //print_r($request->hasFile('code_file'));die;
                $input=$request->all();
                //echo "<pre>";print_r($input);die;
                $this->validate($request,
                [    
                'teaching_id'=>'required',
                //'course_id'=>'required',
                //'course_cat_id'=>'required',
                //'level_id'=>'required',
                //'lesson_title'=>'required',
                //'lesson_subject'=>'required',
                //'lesson_iframe_code'=>'required',
                ]);

                $checkExist=[];
                if(!empty($checkExist))
                {
                    return back()->with('fail','Course alredy exist')->withInput(); 
                }
                else
                {
                    $courseLesson=CourseLession::find($id);

                    $courseLesson->teaching_id=$input['teaching_id'];
                    $courseLesson->course_id=$input['course_id'];
                    $courseLesson->cat_id=$input['course_cat_id'];
                    $courseLesson->level_id=$input['level_id'];
                    $courseLesson->lesson_title=$input['lesson_title'];
                    $courseLesson->lesson_subject=$input['lesson_subject'];
                    $courseLesson->lesson_iframe_code=$input['lesson_iframe_code'];
                    $courseLesson->lesson_video=$input['lesson_video'];
                    $courseLesson->updated_at=date('Y-m-d H:i:s');

                    if($courseLesson->save())
                    {   

                        if(in_array($input['course_cat_id'],[\Config::get('constants.freeProject'),\Config::get('constants.paidProject')]))
                    {   
                        if(isset($request->lib_id) && !empty($request->lib_id))
                        {
                            $libIDs=$request->lib_id;
                            for($n=0;$n<count($libIDs);$n++)
                            {
                                $CodeLibraryLessons=CodeLibraryLessons::find($libIDs[$n]);
                                $CodeLibraryLessons->code_title=$request->code_title_edit[$n];
                                $CodeLibraryLessons->updated_at=date('Y-m-d H:i:s');
                               // echo "<pre>";print_r($CodeLibraryLessons);die;
                               if($request->hasfile('code_file_edit'.$libIDs[$n]))
                                {
                                    //return $request->hasfile('code_file_edit'.$libIDs[$n]);
                                    //echo $libIDs[$n];die;
                                    //echo "sdfsd";die;
                                    //echo $request->code_file_edit_."7";die;
                                   // echo $request->code_file_edit.'_'.$libIDs[$n];die;
                                    //echo $request->file('code_file_edit'.$libIDs[$n]);die;
                                    //echo $request->code_file_edit.$libIDs[$n];die;
                                    $imagename1=time().'_'.$request->file('code_file_edit'.$libIDs[$n])->getClientOriginalName();
                                    //echo $imagename1; die;
                                    $request->file('code_file_edit'.$libIDs[$n])->move(public_path('uploads/code_lib/'),$imagename1);
                                    $CodeLibraryLessons->code_file=$imagename1;
                                } 
                                $CodeLibraryLessons->save();
                            }
                        }
                        
                         if($request->hasfile('code_file'))
                         {  
                            //echo "sdsd";die;
                            $i=0;
                            $data=[];
                            foreach($request->file('code_file') as $file)
                            {   

                                $name = time().'.'.$file->getClientOriginalName();
                                $file->move(public_path().'/uploads/code_lib', $name);  
                                $data[] = [
                                    'code_file'=>$name,
                                    'code_title'=>$request->code_title[$i],
                                    'lesson_id'=>$courseLesson->id,
                                    'cat_id'=>$courseLesson->cat_id,
                                    'level_id'=>$courseLesson->level_id,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                ];
                                 $i++;
                            }
                            CodeLibraryLessons::insert($data); 
                         }
                          
                    }

                        return redirect(route('GetallLesson'))->with('success','Sucessfully updated course lesson.');   
                    }
                    else
                    {
                        return redirect(route('GetallLesson'))->with('fail','Unable to updated course lesson please try again')->withInput();
                    }
                }
            }
               
            $Edit_lesson=CourseLession::select('course_lessons.id','course_lessons.lesson_title','course_lessons.lesson_subject','course_lessons.lesson_document','course_lessons.lesson_iframe_code','course_lessons.lesson_video','courses.course_name','coursecategories.category_name','courselibraries.name as level_name','teachingoptions.option_name','course_lessons.teaching_id','course_lessons.course_id','course_lessons.level_id','course_lessons.cat_id')
                                        ->join('courses','course_lessons.course_id','=','courses.id')
                                        ->join('coursecategories','course_lessons.cat_id','=','coursecategories.id')
                                        ->join('courselibraries','course_lessons.level_id','=','courselibraries.id')
                                        ->join('teachingoptions','course_lessons.teaching_id','=','teachingoptions.id')
                                        ->where('course_lessons.status','=','1')
                                        ->where('course_lessons.is_deleted','=','0')
                                        ->where('course_lessons.id','=',$id)
                                        ->first();
            
           
        $TeachingOtption=TeachingOtption::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
        $Course=Course::where('teaching_id','=',$Edit_lesson->teaching_id)->where('status','=','1')->where('is_deleted','=','0')->get();
        $course_level=Courselibraries::where('teaching_id','=',$Edit_lesson->teaching_id)
                                        ->where('course_id','=',$Edit_lesson->course_id)
                                        ->where('status','=','1')
                                        ->where('is_deleted','=','0')
                                        ->get();
        $categorylist=CourseCategory::where('teaching_id','=',$Edit_lesson->teaching_id)
                                      ->where('status','=','1')
                                      ->where('is_deleted','=','0')
                                      ->get();

        $codeLib=CodeLibraryLessons::where('lesson_id','=',$Edit_lesson->id)
                                    ->where('status','=','1')
                                    ->where('is_deleted','=','0')
                                    ->get();                                                                

        return view('admin.course_lesson.edit_lesson',['Edit_lesson'=>$Edit_lesson,'TeachingOtption'=>$TeachingOtption,'Course'=>$Course,'course_level'=>$course_level,'categorylist'=>$categorylist,'codeLib'=>$codeLib]);                                 
    }

    public function getcourseLevel(Request $request)
    {   
        $input=$request->all();

        $courseLevel=Courselibraries::where('teaching_id','=',$input['teaching_id']);
        if(in_array($input['teaching_id'], [\Config::get('constants.paidOtion')]))
        {
            $courseLevel=$courseLevel->where('course_id','=',$input['course_id']);            
        }

        
        $courseLevel=$courseLevel->where('course_cat_id','=',$input['course_cat_id'])->where('status','=','1')->where('is_deleted','=','0')->get();
       if(in_array($input['course_cat_id'], [\Config::get('constants.freeVideo'),\Config::get('constants.paidVideo')]))
       {
            return view('admin.course_lesson.getcourseLevelVideo',['courseLevel'=>$courseLevel]);
       }
       else
       {
        return view('admin.course_lesson.getcourseLevel',['courseLevel'=>$courseLevel]);
       } 
        
    }

    public function UploadBulk(Request $request)
    {   
        echo "<pre>";print_r($request->hasFile('code_file'));die;
        if($request->hasFile('code_file'))
            {
                echo "dsfsdf";die;
                    $allowedfileExtension=['pdf','jpg','png','docx'];
                    $files = $request->file('code_file');
                    print_r($files);die;
                    foreach($files as $file)
                    {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    //$check=in_array($extension,$allowedfileExtension);
                    //dd($check);
                            //if($check)
                            //{
                            $items= CodeLibraryLessons::create($request->all());
                            //foreach ($request->code_file as $myfile) 
                                //{   
                                    $SaveData=new CodeLibraryLessons;
                                    $imagename1=time().'_'.$file->getClientOriginalName();
                                    //echo $imagename1; die;
                                    $file->move(public_path('uploads/codeproduct/'),$imagename1);
                                    $SaveData->code_file=$imagename1;
                                    $SaveData->lesson_id=1;
                                    $SaveData->cat_id=1;
                                    $SaveData->level_id=1;
                                    $SaveData->code_file=1;
                                    $SaveData->code_title=1;
                                    print_r($SaveData);die;
                                    $SaveData->save();

                                //}
                            //}
                    }
            }
    }

    public function DeleteCourse(Request $request)
    {
        $input=$request->all();
        $Courselibraries=CourseLession::find($input['data_id']);
        $Courselibraries->is_deleted=1;
        
        if($Courselibraries->save())
            {
                return redirect(route('GetallLesson'))->with('success','Sucessfully deleted course lesson.');   
            }
            else
            {
                return redirect(route('GetallLesson'))->with('fail','Unable to delete course lesson please try again')->withInput();
            }

    }
}
