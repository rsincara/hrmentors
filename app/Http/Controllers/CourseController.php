<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses()
    {
        return Course::all();
    }

    public function getCourse($id)
    {
        $course = Course::where('id', $id)->first();

        return $course ?? response()->json(['message' => 'Not Found!'], 404);
    }
}
