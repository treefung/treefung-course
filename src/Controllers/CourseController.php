<?php

namespace Treefung\Course\Controllers;

use Illuminate\Support\Facades\Request;
use Treefung\Course\Models\Course;
use Treefung\Course\Models\CourseSectionUser;

class CourseController extends BaseController {

    public function detailAction() {


        $courseId = Request::input('courseId');

        $course = Course::courseDetail($courseId);

        // 追加是否学习
        foreach ($course->sections as $item) {
            $item->user = CourseSectionUser::query()->where('sectionId', $item->id)->first();
        }


        return $this->success($course);
    }

    public function listAction() {

        $categoryId = Request::input('categoryId');
        $typeId = Request::input('typeId');
        $subjectId = Request::input('subjectId');
        $title = Request::input('keyword');

        $course = Course::courseList(null,$categoryId, $typeId, $subjectId, $title);

        return $this->success($course);
    }

}
