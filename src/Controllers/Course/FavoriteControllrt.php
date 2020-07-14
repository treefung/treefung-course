<?php


namespace Treefung\Course\Controllers\Course;


use Illuminate\Support\Facades\Request;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\CourseFavorite;

class FavoriteControllrt extends BaseController {

    public function createAction() {

        $courseId = Request::input('courseId');


        $favorite = new CourseFavorite([
            'courseId' => $courseId,
            'userId' => 1
        ]);

        $favorite->save();

        return $this->success($favorite);
    }

    public function deleteAction() {

        $courseId = Request::input('courseId');

        $favorite = new CourseFavorite([
            'courseId' => $courseId,
            'userId' => 1
        ]);

        $favorite->save();

        return $this->success($favorite);
    }

}
