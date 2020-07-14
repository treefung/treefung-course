<?php


namespace Treefung\Course\Controllers;


use Treefung\Course\Models\CourseCategory;
use Treefung\Course\Models\CourseType;

class CourseMenuController extends BaseController {

    public function indexAction() {

        $category = CourseCategory::list();

        foreach ($category as $item) {
            $item->subMenu = CourseType::list($item->id);
        }

        return $this->success($category);
    }

}
