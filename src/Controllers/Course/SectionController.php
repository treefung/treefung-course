<?php


namespace Treefung\Course\Controllers\Course;


use Illuminate\Support\Facades\Request;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\CourseChapter;
use Treefung\Course\Models\CourseSection;

class SectionController extends BaseController {

    public function detailAction() {

        $sectionId = Request::input('sectionId');

        $section = CourseSection::sectionDetail($sectionId);

        return $this->success($section);
    }

}
