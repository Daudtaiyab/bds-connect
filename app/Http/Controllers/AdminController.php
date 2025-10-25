<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function allrew()
    {
        $user_course_exp_notification=User::select('users.*','courses.course_name','assign_user_courses.valid_date_time')
                                            ->join('assign_user_courses','users.id','assign_user_courses.user_id')
                                            ->join('courses','assign_user_courses.course_id','=','courses.id')
                                            ->where('users.is_deleted','=','0')
                                            ->get()->toArray();
                                            $user_course_exp_notification[]=['email'=>'programmerskills2018@gmail.com','valid_date_time'=>date('d-m-Y'),'course_name'=>'Test Course'];
                                            //echo "<pre>";print_r($user_course_exp_notification);die;exit;
                        if(!empty($user_course_exp_notification))
                        {           
                            $db_noti_data=[];

                            foreach($user_course_exp_notification as $notification_data)
                            {       
                                    $notification='';
                                     $date_before_20_day=date('d-m-Y', strtotime($notification_data['valid_date_time'] . ' -20 day'));
                                     $date_before_5_day=date('d-m-Y', strtotime($notification_data['valid_date_time'] . ' -5 day'));
                                     $date_before_1_day=date('d-m-Y', strtotime($notification_data['valid_date_time'] . ' -1 day'));
                                     $date_current_day=date('d-m-Y', strtotime($notification_data['valid_date_time'] ));     
                                     
                                     $curent_date=date('d-m-Y');   
                                     $date_before_20_day=date('d-m-Y');
                                    
                                    if(date('d-m-Y',strtotime($date_before_20_day))==date('d-m-Y',strtotime($curent_date)))
                                    {
                                        $notification='Notification1';          
                                    }
                                    elseif(date('d-m-Y',strtotime($date_before_5_day))==date('d-m-Y',strtotime($curent_date)))
                                    {
                                        $notification='Notification2';          
                                    }
                                    elseif(date('d-m-Y',strtotime($date_before_1_day))==date('d-m-Y',strtotime($curent_date)))
                                    {
                                        $notification='Notification2';          
                                    }
                                    elseif(date('d-m-Y',strtotime($date_current_day))==date('d-m-Y',strtotime($curent_date)))
                                    {
                                        $notification='Notification2';          
                                    }
                                    if($notification!='')
                                    {
                                     $db_noti_data[]=[
                                        'mail_subject' => $notification,
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $notification_data['email'],
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => 'Renew Course',
                                        'notification_subject' =>'Rewnew course',
                                        'notification_body' =>$notification_data['course_name']." will be expire on ".$notification_data['valid_date_time'],
                                        'mail_title' =>$notification
                                     ];
                                      $db_noti_data[]=[
                                        'mail_subject' => $notification,
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => \Config::get('constants.AdminEmail'),
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => 'Renew Course',
                                        'notification_subject' =>'Rewnew course',
                                        'notification_body' =>$notification_data['course_name']." will be expire on ".$notification_data['valid_date_time']."of ".$notification_data['email']." user",
                                        'mail_title' =>$notification
                                     ];  
                                    }
                            }
                            if(!empty($db_noti_data))
                            {
                                foreach($db_noti_data as $each_data)
                                {
                                   Mailer::db_mail_updated($each_data); 
                                }
                            }   
                        }
    }
}
