<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Course;
use App\CourseLession;
use App\TeachingOtption;
use App\Courselibraries;
use App\CodeLibraryLessons;
use App\AssignUserCourse;
use App\Mail\Mailer;
use App\CourseRequest;
use App\User;
use DateTime;
class CourseApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function approvalCourse(Request $request)
    {

    	$approvalCourse=User::select('users.id','users.email','users.phone_number',DB::raw('CONCAT(users.first_name," ",users.last_name) as full_name'),'course_requests.user_id')
    						  ->join('course_requests','users.id','=','course_requests.user_id')
    						  ->where('users.status','=','1')
    						  ->where('users.is_deleted','=','0')
    						  ->where('course_requests.is_approved','0')
    						  ->groupBy('course_requests.user_id')
    						  ->get()
                              ->toArray();	
    						  //echo "<pre>";print_r($approvalCourse);die;
    	return view('admin.course_approval.approval_list',['approvalCourse'=>$approvalCourse]);	
    }

    public function viewApproval(Request $request, $id)
    {
        if($request->isMethod('post'))
        {

        }

        $data=[];
        $data['approvalCourse']=CourseRequest::select('course_requests.id as req_id','courses.course_name','courses.id as course_id','courses.course_img')
                              ->join('courses','course_requests.course_id','=','courses.id')
                              ->where('course_requests.user_id','=',$id)
                              ->where('courses.status','=','1')
                              ->where('courses.is_deleted','=','0')
                              ->where('course_requests.is_approved','0')
                              ->groupBy('course_requests.course_id')
                              ->get()
                              ->toArray();
                            //echo "<pre>";print_r($data['approvalCourse']);die;
        $data['userDetail']=User::find($id);                      

        return view('admin.course_approval.view_approval',['data'=>$data]);
    }

    public function SaveApprovedRejectCourse(Request $request)
    {

            $input=$request->all();
            //echo "<pre>";print_r($input);die;
            $userInfo=User::find($input['editId']);
            if(isset($input['courseassign']))
            {
                $courseassign=$input['courseassign'];
                //$checkAssigncourse=1;
                $courseAssignIds=[];
                for($i=0;$i<count($courseassign);$i++)
                {

                    $checkAssigncourse=AssignUserCourse::where('user_id','=',$userInfo->id)
                                                         ->where('course_id','=',$courseassign[$i])
                                                         ->count();
                    if($checkAssigncourse==0)
                    {
                        $AssignUserCourse=new AssignUserCourse;
                    }
                    $AssignUserCourse=new AssignUserCourse;
                        //echo "dd";die;
                      $AssignUserCourse->course_id=$courseassign[$i];
                      $AssignUserCourse->user_id=$userInfo->id;
                      $AssignUserCourse->created_by=Auth::user()->id;
                      $AssignUserCourse->created_at=date('Y-m-d H:i:s');
                      $AssignUserCourse->updated_at=date('Y-m-d H:i:s');
                      $AssignUserCourse->valid_date_time=date('Y-m-d H:i:s',strtotime('+ 1years'));
                      $AssignUserCourse->save(); 
                      array_push($courseAssignIds,$AssignUserCourse->course_id);
                      CourseRequest::where('user_id',$userInfo->id)->where('course_id','=',$AssignUserCourse->course_id)->update(['is_approved'=>$input['is_approved']]);

                                                            
                }

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
                                            <th>Product Duration</th>
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
                                            <td>'.$days.' Days</td>
                                        </tr>';
                        }

                        $notification_body.='</table></div>';

                        $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.approved_course'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $userInfo->email,
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.approved_course'),
                                        'notification_subject' =>\Config::get('constants.approved_course'),
                                        'notification_body' =>$notification_body,
                                        'mail_title' =>\Config::get('constants.approved_course'),
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
                    return redirect(route('approvalCourse'))->with('success','Successfully approved course to user');
                }
                else
                {
                    return back()->with('fail','Unable to assigned course to user Please try again');
                }
    }



    public function allrew()
    {   
        $allUser=User::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();

        $user_course_exp_notification=User::select('users.*','courses.course_name','assign_user_courses.valid_date_time')
                                            ->join('assign_user_courses','users.id','assign_user_courses.user_id')
                                            ->join('courses','assign_user_courses.course_id','=','courses.id')
                                            ->where('users.is_deleted','=','0')
                                            ->get()->toArray();
                                            $user_course_exp_notification[]=['email'=>'programmerskills2018@gmail.com','valid_date_time'=>date('d-m-Y'),'course_name'=>'Test Course'];
                                           // echo "<pre>";print_r($user_course_exp_notification);die;exit;
                        if(!empty($allUser))
                        {           
                            
                            $db_noti_data=[];
                            foreach($allUser as $userRec)
                            {     

                                    $renewalCourse=AssignUserCourse::select('assign_user_courses.valid_date_time','courses.course_name','courses.id as course_id')
                                            ->join('courses','assign_user_courses.course_id','=','courses.id')
                                            ->where('assign_user_courses.user_id','=',$userRec['id'])
                                            ->get()->toArray();

                                    $notification_body='';
                                    $notification='';
                                    $count_body=0;

                                    if(!empty($renewalCourse))
                                    {   
                                        $notification_body='<p>Dear <b>'.$userRec['first_name'].'</b>,</p>
                                        <p>Greetings!</p>
                                        <p>Your dashboard purchased course has been expire soon!</p>
                                        <div>
                                            <table width="100%">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Product Duration</th>
                                                </tr>';
                                        foreach($renewalCourse as $courseRenew)
                                        {
                                             $date_before_20_day=date('d-m-Y', strtotime($courseRenew['valid_date_time'] . ' -20 day'));
                                             $date_before_5_day=date('d-m-Y', strtotime($courseRenew['valid_date_time'] . ' -5 day'));
                                             $date_before_1_day=date('d-m-Y', strtotime($courseRenew['valid_date_time'] . ' -1 day'));
                                             $date_current_day=date('d-m-Y', strtotime($courseRenew['valid_date_time'] ));     
                                             
                                             $curent_date=date('d-m-Y');   
                                             $date_before_20_day=date('d-m-Y');
                                            
                                            if(date('d-m-Y',strtotime($date_before_20_day))==date('d-m-Y',strtotime($curent_date)))
                                            {
                                                $notification='Notification1';
                                                $count_body++;

                                            }
                                            elseif(date('d-m-Y',strtotime($date_before_5_day))==date('d-m-Y',strtotime($curent_date)))
                                            {
                                                $notification='Notification2';
                                                $count_body++;
                                                                
                                            }
                                            elseif(date('d-m-Y',strtotime($date_before_1_day))==date('d-m-Y',strtotime($curent_date)))
                                            {
                                                $notification='Notification2';
                                                $count_body++;
                                                                 
                                            }
                                            elseif(date('d-m-Y',strtotime($date_current_day))==date('d-m-Y',strtotime($curent_date)))
                                            {
                                                $notification='Notification2';
                                                $count_body++;

                                                                
                                            }
                                            if($notification!='')
                                            {
                                                $notification_body.='<tr>
                                                            <td>'.$courseRenew['course_name'].'</td>
                                                            <td>'.$courseRenew['valid_date_time'].'</td>
                                                        </tr>'; 
                                                 
                                            }
                                    }

                                $notification_body.='</table></div>';
                                    }
                                    if($count_body!='0')
                                    {
                                        $db_noti_data[]=[
                                        'mail_subject' => $notification,
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $userRec['email'],
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => 'Renew Course',
                                        'notification_subject' =>'Rewnew course',
                                            'notification_body' =>$notification_body,
                                        'mail_title' =>$notification
                                         ];
                                          /*$db_noti_data[]=[
                                            'mail_subject' => $notification,
                                            'mail_sent_from' => '',
                                            'mail_sent_to' => \Config::get('constants.AdminEmail'),
                                            'mail_page_action' => "#",
                                            'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                            'notifiable_type' => 'Renew Course',
                                            'notification_subject' =>'Rewnew course',
                                            'notification_body' =>$notification_body,
                                            'mail_title' =>$notification
                                         ]; */   
                                    }
                                            
                                    
                            }
                            //echo "<pre>";print_r($db_noti_data);die;
                            if(!empty($db_noti_data))
                            {
                                foreach($db_noti_data as $each_data)
                                {
                                   Mailer::db_mail_updated($each_data); 
                                }
                            }   
                        }
    }


    public function portE()
    {
        //return 1;
        $allUser=User::where('status','=','1')->where('is_deleted','=','0')->get()->toArray();
        if(!empty($allUser))
        {   
            $notification='';
            $db_noti_data=[];
            $notification_body='';
            $notification_adminbody='';
            $count_body=0;
            foreach($allUser as $user)
            {
                    $date_before_20_day=date('d-m-Y', strtotime($user['validity'] . ' -20 day'));
                     $date_before_5_day=date('d-m-Y', strtotime($user['validity'] . ' -5 day'));
                     $date_before_1_day=date('d-m-Y', strtotime($user['validity'] . ' -1 day'));
                     $date_current_day=date('d-m-Y', strtotime($user['validity'] ));     
                     $curent_date=date('d-m-Y');   
                     $date_before_20_day=date('d-m-Y');
                    
                    if(date('d-m-Y',strtotime($date_before_20_day))==date('d-m-Y',strtotime($curent_date)))
                    {
                        $notification='Notification1';
                        $count_body++;

                    }
                    elseif(date('d-m-Y',strtotime($date_before_5_day))==date('d-m-Y',strtotime($curent_date)))
                    {
                        $notification='Notification2';
                        $count_body++;
                                        
                    }
                    elseif(date('d-m-Y',strtotime($date_before_1_day))==date('d-m-Y',strtotime($curent_date)))
                    {
                        $notification='Notification2';
                        $count_body++;
                                         
                    }
                    elseif(date('d-m-Y',strtotime($date_current_day))==date('d-m-Y',strtotime($curent_date)))
                    {
                        $notification='Notification2';
                        $count_body++;
                                        
                    }

                    if($notification!='' && $count_body!='0')
                    {
                            $notification_body='<p>Dear <b>'.$user['first_name'].'</b>,</p>
                                        <p>Greetings!</p>
                                        <p>This mail is to inform you that your registration will be expire on '.$user['validity'].'</p>';

                    $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.portalExp'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $user['email'],
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.portalExp'),
                                        'notification_subject' =>\Config::get('constants.portalExp'),
                                        'notification_body' =>$notification_body,
                                        'mail_title' =>\Config::get('constants.portalExp'),
                                    ];

                      $notification_adminbody='<p>Dear <b>Admin</b>,</p>
                                        <p>Greetings!</p>
                                        <p>This mail is to inform you that '.$user['email'].' user portal will be expire on '.$user['validity'].'</p>'; 
                    $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.portalExpToAdmin'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => \Config::get('constants.AdminEmail'),
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.portalExpToAdmin'),
                                        'notification_subject' =>\Config::get('constants.portalExpToAdmin'),
                                        'notification_body' =>$notification_adminbody,
                                        'mail_title' =>\Config::get('constants.portalExpToAdmin'),
                                    ];                                  
                    }
            }

            //echo"<pre>";print_r($db_noti_data);die;
            if(!empty($db_noti_data))
                            {
                                foreach($db_noti_data as $each_data)
                                {
                                   Mailer::db_mail_updated($each_data); 
                                }
                                return redirect(route('home'));
                                echo "sent";die;
                            }
        }
    } // portE


}
