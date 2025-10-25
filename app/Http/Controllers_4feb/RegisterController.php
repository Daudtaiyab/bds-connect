<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Mail\Mailer;
class RegisterController extends Controller
{
    public function userRegister(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		//return $request->all();
    		$input=$request->all();
    		$this->validate($request,
            [    
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email'=>'required|email',
            'phone_number'=>'required|min:10|max:10',
            'username'=>'required',
            'password' => 'required|confirmed|min:6',
            'address'=>'required',

            ]);


    		$userExist=User::where('email','=',$input['email'])
    						->where('is_deleted','=','0')
    						->get()->toArray();
            //print_r($userExist);die;                
    		if(!empty($userExist))
    		{ 
                //echo "d";die;
				return back()->with('fail','User alredy exist')->withInput();    			
    		}				
    		else
    		{
	    		$userData=new User();

	    		$userData->first_name=$input['first_name'];
	    		$userData->last_name=$input['last_name'];
	    		$userData->email=$input['email'];
	    		$userData->phone_number=$input['phone_number'];
	    		$userData->username=$input['username'];
                $userData->address=$input['address'];
	    		$userData->password=Hash::make($input['password']);
	    		$userData->status=0;
	    		$userData->is_approved=0;
	    		$userData->is_deleted=0;
	    		$userData->user_role_id=2; // normal user
	    		$userData->created_at=date('Y-m-d H:i:s');
	    		$userData->updated_at=date('Y-m-d H:i:s');
	    		
	    		if($userData->save())
	    		{    
                    $notification_body='<p>Dear <b>'.$userData->first_name.'</b>,</p>
                                        <p>Greetings!</p>
                                        <p>This mail is to inform you that your registration is confirmed on our website bdseducation.in our team will activate your account and assign your purchased courses to your dashboard within 24 hours after that you will receive a mail of course assignation.</p>';

                    $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.welcome'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' => $userData->email,
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.welcome'),
                                        'notification_subject' =>\Config::get('constants.welcome'),
                                        'notification_body' =>$notification_body,
                                        'mail_title' =>\Config::get('constants.welcome'),
                                     ];

                    $notification_body_admin='<p>Dear <b>Admin </b>,</p>
                                        <p>Greetings!</p>
                                        <p>This '.$userData->email.' user has been register with us.please veirfy and approve and assigned course to that user</p>';

                    $db_noti_data[]=[
                                        'mail_subject' => \Config::get('constants.newRegister'),
                                        'mail_sent_from' => '',
                                        'mail_sent_to' =>\Config::get('constants.AdminEmail'),
                                        'mail_page_action' => "#",
                                        'notification_type' => 1, // 1: Alert 2:Information 3:Escalation
                                        'notifiable_type' => \Config::get('constants.newRegister'),
                                        'notification_subject' =>\Config::get('constants.newRegister'),
                                        'notification_body' =>$notification_body_admin,
                                        'mail_title' =>\Config::get('constants.newRegister'),
                                     ];                 
                    if(!empty($db_noti_data))
                            {
                                foreach($db_noti_data as $each_data)
                                {
                                   Mailer::db_mail_updated($each_data); 
                                }
                            }

	    			return back()->with('success','Register sucessfully. Please wait for approval');	
	    		}
	    		else
	    		{
	    			return back()->with('fail','Unable to Register please try again')->withInput();
	    		}
	    		    			
    		}


    	}
    	return view('register');
    }
}
