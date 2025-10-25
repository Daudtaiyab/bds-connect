<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::match(['get', 'post'], '/userregister', 'RegisterController@userRegister')->name('userregister');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

/*Route::get('/user-register', function () {
    return view('register');
});*/
Route::get('/home', function () {
    switch (\Illuminate\Support\Facades\Auth::user()->user_role_id) {
        case 1:
            return redirect(route('home'));
            break;
        case 2:
            return redirect(route('deviceForm'));
            break;
        default:
            return '/login';
            break;
    }
});
Auth::routes();

Route::group(['middleware' => ['auth', 'is_admin']], function () {

    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('register-school', 'SchoolController@Registerschool')->name('Registerschool');
    Route::get('download-school', 'SchoolController@downloadSchool')->name('downloadSchool');
    Route::get('user-delete', 'SchoolController@userDelete')->name('userDelete');
    Route::get('school-approval/{id}', 'SchoolController@approvedSchool')->name('approvedSchool');
    Route::get('get-course-to-user/{id}', 'SchoolController@AssignCourseToUser')->name('AssignCourseToUser');
    Route::post('assign-course-to-user', 'SchoolController@AssignCourseToUserSave')->name('AssignCourseToUserSave');
    Route::post('save-approval', 'SchoolController@SaveApproval')->name('SaveApproval');

    Route::match(['get', 'post'], 'add-course', 'CourseController@addCourse')->name('addCourse');
    Route::match(['get', 'post'], 'edit-course/{id}', 'CourseController@editCourse')->name('editCourse');
    Route::get('course-list', 'CourseController@getallCourse')->name('getallCourse');
    Route::get('course-remove', 'CourseController@courseRemove')->name('courseRemove');

    Route::match(['get', 'post'], 'add-library', 'CourselibrariesController@addLibrary')->name('addLibrary');
    Route::match(['get', 'post'], 'edit-library/{id}', 'CourselibrariesController@editLibrary')->name('editLibrary');
    Route::get('gel-all-library', 'CourselibrariesController@GelallLibrary')->name('GelallLibrary');
    Route::post('get-category-course', 'CourselibrariesController@getcategoryCourse')->name('ajax.getcategoryCourse');
    Route::post('getcategory-Course-PDFProject', 'CourselibrariesController@getcategoryCoursePDFProject')->name('ajax.getcategoryCoursePDFProject');
    Route::post('get-course-product', 'CourselibrariesController@getcourseProduct')->name('ajax.getcourseProduct');
    Route::get('delete_library', 'CourselibrariesController@delete_library')->name('delete_library');

    Route::match(['get', 'post'], 'add-lesson', 'CourseLessonController@addLesson')->name('addLesson');
    Route::match(['get', 'post'], 'edit-lesson/{id}', 'CourseLessonController@editLesson')->name('editLesson');
    Route::get('get-all-lesson', 'CourseLessonController@GetallLesson')->name('GetallLesson');
    Route::post('get-course-level', 'CourseLessonController@getcourseLevel')->name('ajax.getcourseLevel');
    Route::get('delete_cousrse', 'CourseLessonController@DeleteCourse')->name('DeleteCourse');

//course approval on request and renew
    Route::get('approval-course-request', 'CourseApprovalController@approvalCourse')->name('approvalCourse');
    Route::match(['get', 'post'], 'view-approval/{id}', 'CourseApprovalController@viewApproval')->name('viewApproval');
    Route::post('save-approved-reject-course', 'CourseApprovalController@SaveApprovedRejectCourse')->name('SaveApprovedRejectCourse');
    Route::get('allrew', 'CourseApprovalController@allrew')->name('allrew');

});

Route::group(['middleware' => ['auth', 'is_user']], function () {

//Route::get('/userdashboard_old', 'HomeController@userdashboard')->name('userdashboard');
    Route::match(['get', 'post'], '/userdashboard', 'TeachingController@deviceForm')->name('deviceForm');
    Route::match(['get', 'post'], '/sprites-form', 'TeachingController@spritesForm')->name('spritesForm');
    Route::match(['get', 'post'], '/userdashboard', 'TeachingController@deviceForm')->name('deviceForm');
    Route::match(['get', 'post'], '/more-product', 'TeachingController@MoreProduct')->name('MoreProduct');
    Route::match(['get', 'post'], '/deviceform', 'TeachingController@PaidForm')->name('PaidForm');
    Route::post('get-lesson-data', 'TeachingController@getLessonData')->name('ajax.getLessonData');
    Route::post('sen-enquiry', 'TeachingController@senEnquiry')->name('ajax.senEnquiry');
    Route::post('buy-course-request', 'TeachingController@buyCourseRequest')->name('buyCourseRequest');

});
