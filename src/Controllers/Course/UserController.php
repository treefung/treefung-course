<?php

namespace Treefung\Course\Controllers\Course;

use Illuminate\Support\Facades\Request;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\Course;
use Treefung\Course\Models\CourseUser;

class UserController extends BaseController {

    public function detailAction() {

        $user = $this->loginUser();
        $courseId = Request::input('courseId');

        $detail = CourseUser::query()->where('userId', $user->id)->where('courseId', $courseId)->first();

        return $this->success($detail);

    }

    public function listAction() {

        $user = $this->loginUser();

        $list = CourseUser::query()->where('userId', $user->id)->get();

        foreach ($list as $item) {
            $item->course = Course::courseDetail($item->courseId);
        }

        return $this->success($list);

    }


    // 报名
    public function createAction() {

        $user = $this->loginUser();
        $courseId = Request::input('courseId');

        $detail = new CourseUser([
            'courseId' => $courseId,
            'userId' => $user->id
        ]);

        $detail->save();

        return $this->success($detail);

    }

}
