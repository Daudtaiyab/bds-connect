<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use App\Course;
use Response;
use App\AssignUserCourse;
use DateTime;
use App\Mail\Mailer;
class SchoolController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function Registerschool(Request $request)
    {	

    	$userList=User::select('users.id','users.first_name as full_name','users.status','users.email','users.phone_number','users.username','users.address','users.validity')
    					//->where('users.status','=','1')
                        //->join('assign_user_courses','users.id','=','assign_user_courses.user_id')
                        //->join('courses','assign_user_courses.course_id','courses.id')
    					->where('users.is_deleted','=','0')
                        ->whereIn('user_role_id',[\Config::get('constants.is_user')])
    					->whereIn('users.is_approved',[0,1]);
                if(isset($request->status) && !empty($request->status))
                {   
                    $status=$request->status;
                    if($status==2)
                    {
                        $status=0;
                    }
                    $userList=$userList->where('users.status','=',$status);
                }        
    					$userList=$userList->get()->toArray();
    					//return $userList;
                        $allUsers=[];
                if(!empty($userList))
                {
                    
                    foreach($userList as $dd)
                    {
                       $allUsers[]=[
                                'id'=>$dd['id'],
                                'full_name'=>$dd['full_name'],
                                'status'=>$dd['status'],
                                'email'=>$dd['email'],
                                'phone_number'=>$dd['phone_number'],
                                'username'=>$dd['username'],
                                'assigned_course'=>$this->UserByCourse($dd['id']),
                                'address'=>$dd['address'],
                                'validity'=>$dd['validity'],
                       ]; 
                    }
                } 
               //echo "<pre>";print_r($allUsers);die;        
    	return view('admin.school.registerd-school',['userList'=>$allUsers]);
    	
    }

    public function UserByCourse($user_id)
    {
        $userCourseData=[];
            $getcourse=AssignUserCourse::select(\DB::raw("GROUP_CONCAT(courses.course_name SEPARATOR ' | ') as usercourse"))
                                        ->join('courses','assign_user_courses.course_id','=','courses.id')
                                        ->where('assign_user_courses.user_id','=',$user_id)
                                        ->where('courses.status','=','1')
                                        ->where('courses.is_deleted','=','0')->get()->toArray();
                                        return $getcourse;
    }

    public function approvedSchool(Request $request, $id)
    {   
        $CourseList=Course::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
    	$userData=User::select('users.id','users.first_name','users.last_name','users.status','users.email','users.phone_number','users.username','users.status','users.address','users.wifi_address','users.validity')
    					->where('users.id','=',$id)
    					//->where('users.status','=','1')
    					->where('users.is_deleted','=','0')
    					->whereIn('users.is_approved',[0,1])
    					->first();
            $AssignUserCourse=AssignUserCourse::where('user_id','=',$id)->pluck('course_id','course_id')->toArray();            
    	return view('admin.school.approval_school',['userData'=>$userData,'CourseList'=>$CourseList,'AssignUserCourse'=>$AssignUserCourse]);
    }

    public function AssignCourseToUser(Request $request, $id)
    {
        $CourseList=Course::where('status','=','1')->where('is_deleted','=','0')->whereNotIn('id',\Config::get('constants.freeCourse'))->get()->toArray();
        $userData=User::select('users.id','users.first_name','users.last_name','users.status','users.email','users.phone_number','users.username')
                        ->where('users.id','=',$id)
                        //->where('users.status','=','1')
                        ->where('users.is_deleted','=','0')
                        ->whereIn('users.is_approved',[0,1])
                        ->first();
            $AssignUserCourse=AssignUserCourse::where('user_id','=',$id)->pluck('course_id','course_id')->toArray();            
        return view('admin.school.assign_course',['userData'=>$userData,'CourseList'=>$CourseList,'AssignUserCourse'=>$AssignUserCourse]);
    }

    public function AssignCourseToUserSave(Request $request)
    {
            $input=$request->all();
            //echo "<pre>";print_r($input);die;
            $userInfo=User::find($input['editId']);
            $OldCourse=[];
            $final_arr=[];
            if(isset($input['OldCourse']) && !empty($input['OldCourse']))
            {
                $OldCourse=$input['OldCourse'];
                //$courseassignCourse=$input['courseassign'];
                
                //$result=array_diff($courseassignCourse,$OldCourse);
                //echo "<pre>";print_r($result);die;
            }
            if(isset($input['courseassign']))
            {
                $courseassign=$input['courseassign'];
                //$checkAssigncourse=1;
                $courseAssignIds=[];
                //print_r($OldCourse);die;
                for($i=0;$i<count($courseassign);$i++)
                {   
                    $key = array_search($courseassign[$i],$OldCourse, true);    
                    //print_r($key);die;
                    if ($key !== false) {
                        unset($OldCourse[$key]);
                    }

                    $checkAssigncourse=AssignUserCourse::where('user_id','=',$userInfo->id)
                                                         ->where('course_id','=',$courseassign[$i])
                                                         ->count();
                    if($checkAssigncourse==0)
                    {
                        //echo "dd";die;
                      $AssignUserCourse=new AssignUserCourse;
                      $AssignUserCourse->course_id=$courseassign[$i];
                      $AssignUserCourse->user_id=$userInfo->id;
                      $AssignUserCourse->created_by=Auth::user()->id;
                      $AssignUserCourse->created_at=date('Y-m-d H:i:s');
                      $AssignUserCourse->updated_at=date('Y-m-d H:i:s');
                      $AssignUserCourse->valid_date_time=date('Y-m-d H:i:s',strtotime('+ 50years'));
                      $AssignUserCourse->save(); 
                      array_push($courseAssignIds,$AssignUserCourse->course_id);  
                    }                                        
                }
                //echo "<pre>";print_r($OldCourse);die;
                // Unassigned loogic
                AssignUserCourse::where('user_id','=',$userInfo->id)
                                  ->whereIn('course_id',$OldCourse)
                                  ->delete();  
                if(!empty($courseAssignIds))
                {
                    $activateCourse=Course::select('courses.*','assign_user_courses.valid_date_time')
                                    ->join('assign_user_courses','courses.id','=','assign_user_courses.course_id')
                                    ->where('assign_user_courses.user_id','=',$userInfo->id)
                                    ->whereIn('courses.id',$courseAssignIds)
                                    ->where('courses.status','=','1')
                                    ->where('courses.is_deleted','=','0')
                                    ->get();
                    if(!empty($activateCourse))
                    {
                        $notification_body='<p>Dear <b>'.$userInfo->first_name.'</b>,</p>
                                <p>Greetings!</p>
                                <p>Your dashboard is activated and your purchased products are assigned to it now you can access your purchased products.</p>
                                <div>
                                    <table width="100%">
                                        <tr>
                                            <th>Product Name</th>
                                        </tr>';
                                        
                        foreach($activateCourse as $listCourse)
                        {   
                                    $fdate = date('d-m-Y');
                                    $tdate =date('d-m-Y',strtotime($listCourse->valid_date_time));
                                    $datetime1 = new DateTime($fdate);
                                    $datetime2 = new DateTime($tdate);
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format('%R%a');//now do whatever you like with $days
                                

                            $notification_body.='<tr>
                                            <td>'.$listCourse->course_name.'</td>
                                        </tr>';
                        }

                        $notification_body.='</table></div>';

                        $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.welcome_approval'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $userInfo->email,
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.welcome_approval'),
                                        'notification_subject' =>\Config::get('constants.welcome_approval'),
                                        'notification_body' =>$notification_body,
                                        'mail_title' =>\Config::get('constants.welcome_approval'),
                                     ];
                            if(!empty($db_noti_data))
                            {
                                foreach($db_noti_data as $each_data)
                                {
                                   Mailer::db_mail_updated($each_data); 
                                }
                            }
                            $userInfo->is_approved=1;
                            $userInfo->status=1;
                            $userInfo->save();
                    }                
                }
            }

                if($userInfo)
                {
                    return redirect(route('Registerschool'))->with('success','Successfully assigned course to user');
                }
                else
                {
                    return back()->with('fail','Unable to assigned course to user Please try again');
                }       
    }

    public function SaveApproval(Request $request)
    {		
    		$input=$request->all();
            //echo "<pre>";print_r($input);die;
    		$userInfo=User::find($input['editId']);
    		$userInfo->status=$input['status'];
    		$userInfo->is_approved=1;
    		$userInfo->approved_date=date('Y-m-d H:i:s');
    		$userInfo->approved_by=Auth::user()->id;
            $userInfo->approved_by=Auth::user()->id;
            $userInfo->wifi_address=$input['wifi_address'];
            $userInfo->address=$input['address'];
            $userInfo->first_name=$input['first_name'];
            $userInfo->last_name=NULL;//$input['last_name'];
            $userInfo->phone_number=$input['phone_number'];
            $userInfo->username=$input['username'];
            $userInfo->validity=date('Y-m-d',strtotime($input['validity']));

            $userInfo->save();

            if(isset($input['courseassign']))
            {
                $courseassign=$input['courseassign'];
                for($i=0;$i<count($courseassign);$i++)
                {

                    $checkAssigncourse=AssignUserCourse::where('user_id','=',$userInfo->id)
                                                         ->where('course_id','=',$courseassign[$i])
                                                         ->count();
                    if($checkAssigncourse==0)
                    {
                      $AssignUserCourse=new AssignUserCourse;
                      $AssignUserCourse->course_id=$courseassign[$i];
                      $AssignUserCourse->user_id=$userInfo->id;
                      $AssignUserCourse->created_by=Auth::user()->id;
                      $AssignUserCourse->created_at=date('Y-m-d H:i:s');
                      $AssignUserCourse->updated_at=date('Y-m-d H:i:s');
                      $AssignUserCourse->valid_date_time=date('Y-m-d H:i:s');
                      $AssignUserCourse->save();   
                    }                                        

                }
            }

    		if($userInfo)
    		{
    			return redirect(route('Registerschool'))->with('success','Registered user has been updated');
    		}
    		else
    		{
    			return back()->with('fail','Unable to update user Please try again');
    		}
    }


    public function downloadSchool(Request $request)
    {
        $userList=User::select('users.id','users.first_name as full_name','users.status','users.email','users.phone_number','users.username')
                        //->where('users.status','=','1')
                        ->where('users.is_deleted','=','0')
                        ->whereIn('user_role_id',[\Config::get('constants.is_user')])
                        ->whereIn('users.is_approved',[0,1]);
                if(isset($request->status) && !empty($request->status))
                {   
                    $status=$request->status;
                    if($status==2)
                    {
                        $status=0;
                    }
                    $userList=$userList->where('users.status','=',$status);
                }        
                $userList=$userList->get()->toArray();

                $allUsers=[];
                if(!empty($userList))
                {
                    
                    foreach($userList as $dd)
                    {
                       $allUsers[]=[
                                'id'=>$dd['id'],
                                'full_name'=>$dd['full_name'],
                                'status'=>$dd['status'],
                                'email'=>$dd['email'],
                                'phone_number'=>$dd['phone_number'],
                                'username'=>$dd['username'],
                                'assigned_course'=>$this->UserByCourse($dd['id'])
                       ]; 
                    }
                }
                //echo "<pre>";print_r($allUsers);die;

        $headers = array(
            "Content-Encoding"=>"UTF-8",
            "Content-type" => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=user-list-data.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('S.No', 'School Name','Email','Phone Number','User Name','Status','Course List');
        $callback = function() use ($allUsers, $columns)
        {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            /*fputcsv($file, [' ']);
            fputcsv($file, ['India Index manual Progress Data Entry']);
            fputcsv($file, [' ']);*/
            fputcsv($file, $columns);

            if(!empty($allUsers) && count($allUsers) > 0){
                $sr=1;
                foreach($allUsers as $data) {
                    fputcsv($file, array(
                        $sr,
                        $data['full_name'],
                        $data['email'],
                        $data['phone_number'],
                        $data['username'],
                        $data['status']==1 ?"Active" : 'Inactive', 
                        $data['assigned_course'][0]['usercourse'], 
                    ));
                    $sr++;
                }
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    public function userDelete(Request $request)
    {
        $input=$request->all();
        $user=User::find($input['data_id']);
        $user->is_deleted=1;
        //print_r($Courselibraries);die;
        if($user->save())
            {
                return redirect(route('Registerschool'))->with('success','Sucessfully deleted user record.');   
            }
            else
            {
                return redirect(route('Registerschool'))->with('fail','Unable to delete user record please try again')->withInput();
            }
    }

    public function PortalActivate(Request $request)
    {
        $input=$request->all();
        $user=User::find($input['data_id']);
        $user->validity=date('Y-m-d',strtotime('+ 1years'));
        //print_r($Courselibraries);die;
        if($user->save())
            {       
                $notification_body='<p>Dear <b>'.$user->first_name.'</b>,</p>
                                        <p>Greetings!</p>
                                        <p>This mail is to inform you that your portal has been approved.</p>';

                    $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.portalActivation'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $user->email,
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.portalActivation'),
                                        'notification_subject' =>\Config::get('constants.portalActivation'),
                                        'notification_body' =>$notification_body,
                                        'mail_title' =>\Config::get('constants.portalActivation'),
                                     ];
                if(!empty($db_noti_data))
                            {
                                foreach($db_noti_data as $each_data)
                                {
                                   Mailer::db_mail_updated($each_data); 
                                }
                            }
                                                 
                return redirect(route('Registerschool'))->with('success','Sucessfully activated portal.');   
            }
            else
            {
                return redirect(route('Registerschool'))->with('fail','Unable to activate portal please try again')->withInput();
            }
    }

}
