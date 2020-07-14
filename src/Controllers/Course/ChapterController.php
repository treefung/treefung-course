<?php

namespace Treefung\Course\Controllers\Course;

use Illuminate\Support\Facades\Request;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\Course;
use Treefung\Course\Models\CourseChapter;

class ChapterController extends BaseController {

    public function detailAction() {

        $chapterId = Request::input('chapterId');

        $chapter = CourseChapter::chapterDetail($chapterId);

        return $this->success($chapter);
    }

}
