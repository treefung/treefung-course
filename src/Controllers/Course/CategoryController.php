<?php

namespace Treefung\Course\Controllers\Course;

use Illuminate\Support\Facades\Request;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\Course;
use Treefung\Course\Models\CourseCategory;
use Treefung\Course\Models\CourseType;

class CategoryController extends BaseController {


    /**
     * @return \Illuminate\Http\JsonResponse
     * 一级分类列表
     * 取出不多于6门归属一级分类的课程
     */
    public function listAction() {

        $courseCategory = CourseCategory::query()->where('enabled', true)->get();

        foreach ($courseCategory as $item) {

            $item->courses = Course::courseList(6,$item->id);
        }

        return $this->success($courseCategory);
    }

    public function detailAction() {

        $categoryId = Request::input('categoryId');

        $category = CourseCategory::query()->find($categoryId);

        $types = CourseType::query()->where('categoryId', $categoryId)->get();

        foreach ($types as $item) {
            $item->courses = Course::courseList(6,$category->id, $item->id);
        }

        $category->types = $types;

        return $this->success($category);
    }


}
