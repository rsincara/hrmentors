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

    protected function getDeveloperById($id)
    {
        $db_developer = Developers::where('userId', $id)->first();

        $resultDeveloper = User::find($db_developer->userId);
        $resultDeveloper->mentor = User::find($db_developer->mentor_id);
        $coursesArray = array();
        foreach (UserCourses::where('developer_user_id', $db_developer->userId)->get() as $userCourse) {
            $course = Course::find($userCourse->course_id);
            $courseProgress = UserCourses::where([
                ['developer_user_id', $db_developer->userId],
                ['course_id', $course->id],
            ])->first()->progress;
            $course->progress = $courseProgress;
            $coursesArray[] = $course;
        }
        $resultDeveloper->courses = $coursesArray;

        return $resultDeveloper;
    }

    public function getDevelopers()
    {
        $result = array();

        foreach (Developers::all() as $db_developer) {
            $resultDeveloper = $this->getDeveloperById($db_developer->userId);
            $result[] = $resultDeveloper;
        }

        return response()->json($result, 200);
    }

    public function getDeveloper($id)
    {
        return $this->getDeveloperById($id);
    }
}
