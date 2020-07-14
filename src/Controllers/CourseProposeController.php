<?php

namespace Treefung\Course\Controllers;

use Illuminate\Support\Facades\Request;
use Treefung\Course\Models\Course;
use Treefung\Course\Models\CoursePropose;

class CourseProposeController extends BaseController {

    public function listAction() {

        $categoryId = Request::input('categoryId');

        $result = CoursePropose::query()->where('categoryId', $categoryId)->get();

        foreach ($result as $item) {

            $item->course = Course::courseDetail($item->courseId);
        }

        return $this->success($result);
    }

}
