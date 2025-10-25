<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail;
use App\Mail\Mailer;
use App\Course;
class NotificationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
                     //$date_before_20_day=date('d-m-Y');
                    
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
                                // return redirect(route('home'));
                                // echo "sent";die;
                            }
        }                     
    }
}
