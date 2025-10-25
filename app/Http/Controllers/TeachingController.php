<?php
namespace App\Http\Controllers;

use App\AssignUserCourse;
use App\CodeLibraryLessons;
use App\Course;
use App\CourseLession;
use App\CourseRequest;
use App\Mail\Mailer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class TeachingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function spritesForm(Request $request)
    {
        $input = $request->all();
        FacadesAuth::user()->setAttribute('teach_id', '1');
        Session::forget('teach_id');
        Session::forget('product_id');
        if ($request->isMethod('post')) {
            Session::forget('teach_id');
            Session::forget('product_id');
            Auth::user()->setAttribute('teach_id', $input['teach_id']);
        }
        //echo \Session::get('teach_id');die;
        //echo "<pre>";print_r(Auth::user()->teach_id);die;
        return view('users.pdf.pdf_library');
    }

    public function PaidForm(Request $request)
    {
        $input = $request->all();
        //print_r($input);die;
        Auth::user()->setAttribute('teach_id', Session::get('teach_id'));
        Auth::user()->setAttribute('product_id', Session::get('product_id'));
        //\Session::forget('teach_id');
        //echo \Session::get('product_id');die;
        //echo \Session::get('product_id');die;
        if ($request->isMethod('post')) {
            // session()->forget('product_id');
            // session()->flush();
            Session::put('teach_id', $input['teach_id']);
            Session::put('product_id', $input['product_id']);
            Auth::user()->setAttribute('teach_id', $input['teach_id']);
        }
        //\Session::forget('product_id');
        //echo \Session::get('product_id');die;
        //echo "<pre>";print_r(Auth::user()->teach_id);die;
        return view('users.pdf.pdf_library');
    }

    public function deviceForm(Request $request)
    {
        $input = $request->all();
        Auth::user()->setAttribute('teach_id', '2');
        if ($request->isMethod('post')) {
            Auth::user()->setAttribute('teach_id', $input['teach_id']);
        }
        //echo "<pre>";print_r(Auth::user()->teach_id);die;
        $user_id       = Auth::user()->id;
        $getUsercourse = Course::select('courses.*', 'assign_user_courses.valid_date_time')
            ->join('assign_user_courses', 'courses.id', '=', 'assign_user_courses.course_id')
            ->where('assign_user_courses.user_id', '=', $user_id)
            ->where('courses.teaching_id', '=', Config::get('constants.paidOption'))
            ->where('courses.status', '=', '1')
            ->where('courses.is_deleted', '=', '0')
            ->get();
//print_r($getUsercourse);die;
        //return setAttribute('teach_id');
        $switch = $request->session()->get('teach_id');
        if (isset($input['teach_id']) && $input['teach_id'] != '') {
            $switch = $input['teach_id'];
        }
        //echo $switch;die;
        return view('users.code.device_product', ['getUsercourse' => $getUsercourse, 'switch' => $switch]);
    }

    public function MoreProduct(Request $request)
    {
        $input = $request->all();
        Auth::user()->setAttribute('teach_id', '2');
        if ($request->isMethod('post')) {
            Auth::user()->setAttribute('teach_id', $input['teach_id']);
        }
        //echo "<pre>";print_r(Auth::user()->teach_id);die;
        $user_id   = Auth::user()->id;
        $myproduct = AssignUserCourse::where('user_id', '=', $user_id)->pluck('course_id');
        //print_r($myproduct);die;
        $getUsercourse = Course::select('courses.*')
        //->join('assign_user_courses','courses.id','=','assign_user_courses.course_id')
        //->where('assign_user_courses.user_id','=',$user_id)
            ->whereNotIn('courses.id', $myproduct)
            ->where('courses.teaching_id', '=', \Config::get('constants.paidOption'))
            ->where('courses.status', '=', '1')
            ->where('courses.is_deleted', '=', '0')
            ->get();
//print_r($getUsercourse);die;
        return view('users.code.more_product', ['getUsercourse' => $getUsercourse]);
    }

    public function getLessonData(Request $request)
    {
        $input         = $request->all();
        $data          = [];
        $data['nextP'] = '';
        $data['preP']  = '';
        /*$nextP='';
        $preP='';*/
        $data_caourse = CourseLession::find($input['lesson_id']);
        if (in_array($data_caourse->cat_id, [\Config::get('constants.freePdf'), \Config::get('constants.paidPdf')])) {
            //echo "<pre>";print_r($input['myArr']);die;
            $IndexKey = array_search($input['lesson_id'], $input['myArr']);
            if ($IndexKey >= 0) {
                if (isset($input['myArr'][$IndexKey + 1])) {
                    $data['nextP'] = $input['myArr'][$IndexKey + 1];
                }

            }
            if ($IndexKey >= 1) {
                if (isset($input['myArr'][$IndexKey - 1])) {
                    $data['preP'] = $input['myArr'][$IndexKey - 1];
                }
            }
            //echo "pre=".$data['preP']." next=".$data['nextP'];die;
        }

        if (in_array($data_caourse->cat_id, [Config::get('constants.freeVideo'), Config::get('constants.paidVideo')])) {
            $data['lessonData'] = CourseLession::select('course_lessons.*', 'coursecategories.category_name')
            //->join('courselibraries','course_lessons.level_id','=','courselibraries.id')
                ->join('coursecategories', 'course_lessons.cat_id', '=', 'coursecategories.id')
                ->where('course_lessons.id', '=', $input['lesson_id'])
                ->first();
            $IndexKey = array_search($input['lesson_id'], $input['myArr']);
            if ($IndexKey >= 0) {
                if (isset($input['myArr'][$IndexKey + 1])) {
                    $data['nextP'] = $input['myArr'][$IndexKey + 1];
                }

            }
            if ($IndexKey >= 1) {
                if (isset($input['myArr'][$IndexKey - 1])) {
                    $data['preP'] = $input['myArr'][$IndexKey - 1];
                }
            }
        } else {
            $data['lessonData'] = CourseLession::select('course_lessons.*', 'courselibraries.name as level_name', 'coursecategories.category_name')
                ->join('courselibraries', 'course_lessons.level_id', '=', 'courselibraries.id')
                ->join('coursecategories', 'course_lessons.cat_id', '=', 'coursecategories.id')
                ->where('course_lessons.id', '=', $input['lesson_id'])
                ->first();
            if (! empty($data['lessonData']) && in_array($data['lessonData']->cat_id, [\Config::get('constants.freeProject'), \Config::get('constants.paidProject')])) {
                $data['lessonData'] = CodeLibraryLessons::where('level_id', '=', $data['lessonData']->level_id)
                    ->where('cat_id', '=', $data['lessonData']->cat_id)
                    ->where('lesson_id', '=', $input['lesson_id'])
                    ->where('status', '=', '1')
                    ->where('is_deleted', '=', '0')
                    ->orderBy('code_title', 'ASC')
                    ->get()->toArray();
                //echo "<pre>";print_r($data['lessonData']);die;
                return view('users.code.code_data', ['data' => $data]);
            }
        }

        //echo"<pre>";print_r($data);die;
        return view('users.pdf.lesson_data', ['data' => $data]);
    }

    public function senEnquiry(Request $request)
    {

        $input             = $request->all();
        $userEmail         = FacadesAuth::user()->email;
        $userName          = FacadesAuth::user()->first_name;
        $notification_body = '<p>Hello <b>Admin</b>,</p>
            <p>' . $userName . ' from bdseducation.in asked a question about this ' . $input['subject'] . '</p>
            <p>From Email: ' . $userEmail . '</p>
            <p><b>Q.</b> ' . $input['question'] . '</p>';

        $db_noti_data[] = [
            'mail_subject'         => Config::get('constants.sendQuery'),
            'mail_sent_from'       => $userEmail,
            'mail_sent_to'         => Config::get('constants.AdminEmail'),
            'mail_page_action'     => "#",
            'notification_type'    => 1, // 1: Alert 2:Information 3:Escalation
            'notifiable_type'      => Config::get('constants.sendQuery'),
            'notification_subject' => Config::get('constants.sendQuery'),
            'notification_body'    => $notification_body,
            'mail_title'           => Config::get('constants.sendQuery'),
        ];
        if (! empty($db_noti_data)) {
            foreach ($db_noti_data as $each_data) {
                Mailer::db_mail_updated($each_data);
            }
        }
        echo "sent";die;exit;
    }

    public function buyCourseRequest(Request $request)
    {
        $input = $request->all();

        $course_request = new CourseRequest;

        $course_request->course_id    = $input['course_id'];
        $course_request->user_id      = Auth::user()->id;
        $course_request->is_approved  = 0;
        $course_request->request_type = 0;
        $course_request->created_at   = date('Y-m-d h:i:s');
        $course_request->updated_at   = date('Y-m-d h:i:s');
        $couseData                    = Course::find($input['course_id']);

        $notification_body = '<p>Hello <b>Admin</b>,</p>
            <p>' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' has been sent new course as: <b>' . $couseData->course_name . '</b>request</p>';

        $db_noti_data[] = [
            'mail_subject'         => \Config::get('constants.NewCourseRequest'),
            'mail_sent_from'       => Auth::user()->email,
            'mail_sent_to'         => \Config::get('constants.AdminEmail'),
            'mail_page_action'     => "#",
            'notification_type'    => 1, // 1: Alert 2:Information 3:Escalation
            'notifiable_type'      => \Config::get('constants.NewCourseRequest'),
            'notification_subject' => \Config::get('constants.NewCourseRequest'),
            'notification_body'    => $notification_body,
            'mail_title'           => \Config::get('constants.NewCourseRequest'),
        ];
        if (! empty($db_noti_data)) {
            foreach ($db_noti_data as $each_data) {
                Mailer::db_mail_updated($each_data);
            }
        }

        if ($course_request->save()) {
            return redirect(route('MoreProduct'))->with('success', 'Sucessfully course request sent.');
        } else {
            return redirect(route('MoreProduct'))->with('fail', 'Unable to sent course request please try again')->withInput();
        }

    }

}