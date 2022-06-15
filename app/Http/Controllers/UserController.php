<?php

namespace App\Http\Controllers;

use App\Models\DeveloperInfo;
use App\Models\Entities\Course;
use App\Models\Entities\Developers;
use App\Models\Entities\User;
use App\Models\Entities\UserCourses;
use Illuminate\Http\Request;
use function Sodium\add;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function getDevelopers()
    {
        $result = array();

        foreach (Developers::all() as $db_developer) {
            $resultDeveloper = User::find($db_developer->userId);
            $resultDeveloper->mentor = User::find($db_developer->mentor_id);
            $coursesArray = array();
            foreach (UserCourses::where('developer_user_id', $db_developer->userId)->get() as $userCourse) {
                $course = Course::find($userCourse->course_id);
                array_push($coursesArray, $course);
            }
            $resultDeveloper->courses = $coursesArray;
            array_push($result, $resultDeveloper);
        }

        return response()->json($result, 200);
    }

}
