<?php

namespace App\Http\Controllers;

use App\Models\Entities\Course;
use App\Models\Entities\Developers;
use App\Models\Entities\ITType;
use App\Models\Entities\UserCourses;

class TestController extends Controller
{
    public function test()
    {
        return UserCourses::all();
//        $developer = Developer::where('userId', 1)->first();
//        return $developer.getUser();
    }
}


/*
 * вернет все курсы, принадлежащие этому типу
 *
  $itType = ITType::find(1)->courses;
  return $itType;
 */


/*
 * Вернет ITType текущего курса
       $course = Course::find(1);
        return $course->ittype;
 */
