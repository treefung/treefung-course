<?php

namespace Treefung\Course\Controllers\Course;

use Illuminate\Support\Facades\Request;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\CourseSectionUser;

class SectionUserController extends BaseController {

    // 视频播放完毕 节学习完毕
    public function createAction() {

        $user = $this->loginUser();

        $courseId = Request::input('courseId');
        $sectionId = Request::input('sectionId');

        $detail = CourseSectionUser::query()->where('sectionId', $sectionId)->where('userId', $user->id)->first();

        if(!$detail) {
            $detail = new CourseSectionUser();
        }

        $detail->courseId = $courseId;
        $detail->sectionId = $sectionId;
        $detail->userId = $user->id;
        $detail->updateTime = time(); // 其他自动没有变化所以要手动更新

        $detail->save();

        return $this->success($detail);

    }

}
