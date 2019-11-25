<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



// user routes
$route['register'] = 'register';
$route['forgotpassword'] = 'forgotpassword';
$route['forgotpassword/requestpassword'] = 'forgotpassword/request_new_password';
$route['recoverpassword'] = 'forgotpassword/recover_password';
$route['confirmpassword/(:any)'] = 'forgotpassword/confirm_password/$1';
$route['email-sent'] = 'forgotpassword/email_sent';
$route['update-password'] = 'forgotpassword/update_password';



$route['verify'] = 'login/verify_account';
$route['login'] = 'login';
$route['register_account'] = 'register/save_account';



// admin
$route['admin/dashboard'] = 'admin';
$route['admin/'] = 'admin';
$route['admin/createtodo'] = 'admin/create_todo';
$route['admin/savetodo'] = 'admin/save_todo';
$route['admin/edittodo/(:num)'] = 'admin/edit_todo/$1';
$route['admin/deletetodo/(:num)'] = 'admin/destroy_todo/$1';
$route['admin/studenttodos/(:num)'] = 'admin/view_student_todos/$1';

// admin student
$route['admin/students'] = 'admin/students';
$route['admin/students'] = 'admin/students';
$route['admin/addstudent'] = 'admin/add_student';
$route['admin/editstudent/(:num)'] = 'admin/edit_student/$1';
$route['admin/deletestudent/(:num)'] = 'admin/destroy_user/$1';
$route['admin/pendingstudent'] = 'admin/pending_student';

$route['admin/approveduser/(:num)'] = 'admin/approved_user/$1';
$route['admin/rejectuser/(:num)'] = 'admin/reject_user/$1';

// student
$route['students/dashboard'] = 'Student';
$route['students/takeexam'] = 'Student/take_exam';
$route['students/answerexam/(:num)'] = 'Student/answer_exam/$1';
$route['students'] = 'Student';
$route['students/edittodos/(:num)'] = 'Student/edit_todos/$1';
$route['students/updatetodo'] = 'Student/update_todo/';
$route['students/profile'] = 'Student/student_profile/';
$route['students/todos'] = 'Student/view_todos/';
$route['students/viewtodo/(:num)'] = 'Student/view_todo_info/$1';
$route['students/examresults'] = 'Student/exam_results/';
$route['students/examhistory'] = 'Student/exam_history/';
$route['students/viewexamresult/(:num)'] = 'Student/view_exam_result/$1';

// api's
$route['api/todos/(:any)'] = 'api/todos/$1';
$route['api/addtodoinstruction'] = 'api/todo_add_instruction/';
$route['api/deletetodo'] = 'api/delete_todo/';
$route['api/updatetodo'] = 'api/update_todo/';
$route['api/todosinstruction/(:num)'] = 'api/get_todos_instruction/$1';
$route['api/saveexam'] = 'api/save_exam';
$route['api/checkquestion'] = 'api/check_question';
$route['api/submitresult'] = 'api/submit_exam_result';
$route['api/savecategory'] = 'api/save_category';
$route['api/updatecategory'] = 'api/update_category';
$route['api/deleteexam'] = 'api/delete_exam';

// exam
$route['admin/exams'] = 'admin/exams';
$route['admin/viewexam/(:num)'] = 'admin/view_exam/$1';
$route['admin/createexam'] = 'admin/create_exam';


