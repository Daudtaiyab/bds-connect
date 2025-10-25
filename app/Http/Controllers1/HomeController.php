<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Course;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //print_r(Auth());die;
        //return "sdf";
        //getenv("REMOTE_ADDR");
        $data=[];
        $data['all_school']=User::where('is_deleted','=','0')->count();
        $data['active_active']=User::where('is_deleted','=','0')->where('status','=','1')->count();
        $data['school_inactive']=User::where('is_deleted','=','0')->where('status','=','0')->count();
        $data['all_course']=Course::where('is_deleted','=','0')->where('status','=','1')->where('teaching_id','=',\Config::get('constants.paidOption'))->count();

        return view('admin.school-registration',['data'=>$data]);
    }

    public function userdashboard()
    {
        //return "ddd";
        //print_r(Auth());die;
        return view('users.user_dashboard');
    }

}
