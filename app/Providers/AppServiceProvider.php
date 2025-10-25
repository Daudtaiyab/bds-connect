<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Course;
use App\Courselibraries;
use App\CourseCategory;
use Auth;
use App\CourseLession;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        //echo"<pre>";print_r(Auth::user()->teach_id);die;
        //print_r($teach_id);die;
        view()->composer(['users.inc.sidebar','users.pdf.pdf_library'],function($view){

            $teach_id=Auth::user()->teach_id;
            $paidcourse_id=0;
           // echo Session::get('product_id');die;
            if(Session::has('product_id'))
            {
                $paidcourse_id=Session::get('product_id');
            }
            $cate=CourseCategory::where('teaching_id',$teach_id)
                                  ->where('status','1')
                                  ->where('is_deleted','0')
                                  ->get()->toArray();
            $sidebarArr=[];
            if(isset($cate) && !empty($cate))
            {   
                foreach($cate as $clist)
                {   
                    $videoArr=[];
                    if(in_array($clist['id'], [\Config::get('constants.paidVideo'),\Config::get('constants.freeVideo')]))
                    {
                       $videoArr=self::lessonData_video($level_id=null,$teach_id,$clist['id'],$paidcourse_id); 
                    }
                    else
                    {
                       $videoArr=$this->category_level($clist['id'],$teach_id,$paidcourse_id); 
                    }
                    $sidebarArr[]=[
                    'cat_id'=>$clist['id'],
                    'cat_name'=>$clist['category_name'],
                    'cat_level'=>$videoArr,//$this->category_level($clist['id'],$teach_id),
                    ];    
                }
                
            }                        
        $view->with(['sidebarArr'=>$sidebarArr]);
            });
    }

    public static function category_level($cat_id,$teach_id,$paidcourse_id)
    {   
        $CourselibrariesList=[];

        $Courselibraries=Courselibraries::where('teaching_id',$teach_id)
                                    ->where('course_cat_id',$cat_id)
                                    ->where('status','1')
                                    ->where('is_deleted','0');
                                    if($paidcourse_id>0)
                                    {
                                     $Courselibraries=$Courselibraries->where('course_id','=',$paidcourse_id);   
                                    }
                                    $Courselibraries=$Courselibraries->get();
        if(!empty($Courselibraries))
        {
            foreach($Courselibraries as $level)
            {
               $CourselibrariesList[]=
                        [
                            'level_id'=>$level->id,
                            'level_name'=>$level->name,
                            'cat_id'=>$level->course_cat_id,
                            'lesson_data'=>self::lessonData($level->id,$level->teaching_id,$level->course_cat_id,$paidcourse_id),
                        ];
               
            }
        }                            
        
        //$arr=[['id'=>1],['id'=>2]];
        return $CourselibrariesList;
    }

     public static function lessonData($level_id,$teach_id,$cat_id,$paidcourse_id)
    {   
        $CourselessonList=[];

        $Courselesson=CourseLession::where('teaching_id',$teach_id)
                                    ->where('cat_id',$cat_id)
                                    ->where('level_id',$level_id)
                                    ->where('status','1')
                                    ->where('is_deleted','0');
                                    if($paidcourse_id>0)
                                    {
                                        $Courselesson=$Courselesson->where('course_id','=',$paidcourse_id);
                                    }
                                    $Courselesson=$Courselesson->get();
        if(!empty($Courselesson))
        {
            foreach($Courselesson as $lessonInfo)
            {
               $CourselessonList[]=
                        [
                            'lesson_id'=>$lessonInfo->id,
                            'lesson_title'=>$lessonInfo->lesson_title,
                        ];
               
            }
        }                            
        
        //$arr=[['id'=>1],['id'=>2]];
        return $CourselessonList;
    }

    public static function lessonData_video($level_id,$teach_id,$cat_id,$paidcourse_id)
    {   
        $CourselessonList=[];

        $Courselesson=CourseLession::where('teaching_id',$teach_id)
                                    ->where('cat_id',$cat_id)
                                    //->where('level_id',$level_id)
                                    ->where('status','1')
                                    ->where('is_deleted','0');
                                    if($paidcourse_id>0)
                                    {
                                        $Courselesson=$Courselesson->where('course_id','=',$paidcourse_id);
                                    }
                                    $Courselesson=$Courselesson->get();
        if(!empty($Courselesson))
        {
            foreach($Courselesson as $lessonInfo)
            {
               $CourselessonList[]=
                        [
                            'lesson_id'=>$lessonInfo->id,
                            'lesson_title'=>$lessonInfo->lesson_title,
                        ];
               
            }
        }                            
        
        //$arr=[['id'=>1],['id'=>2]];
        return $CourselessonList;
    }

}
