<?php

namespace Treefung\Course\Controllers\Course;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Qcmaker\Bjkjcloud\Models\User;
use Treefung\Course\Controllers\BaseController;
use Treefung\Course\Models\CourseComment;
use Treefung\Passport\Models\Account;

class CommentController extends BaseController {

    public function listAction() {

        $courseId = Request::input('courseId');
        $page = Request::input('page');

        $comment = CourseComment::query()->where('courseId', $courseId)->whereNull('parentId')->orderBy('createTime', 'desc')->paginate(5);

        foreach ($comment as $item) {
            // 拉取子评论第一页 伪装成 laravel 分页
            $subComment = new \stdClass();
            $subComment->data = CourseComment::query()->where('parentId', $item->id)->orderBy('createTime', 'desc')->limit(5)->get();
            $subComment->total = CourseComment::query()->where('parentId', $item->id)->count();
            foreach ($subComment->data as $list) {
                $list->user = User::userBaseInfo($list->userId);
            }

            $item->subComment = $subComment;
            $item->user = User::userBaseInfo($item->userId);
        }

        return $this->success($comment);
    }


    public function subListAction() {

        $parentId = Request::input('parentId');
        $page = Request::input('page');

        $comment = CourseComment::query()->where('parentId', $parentId)->orderBy('createTime', 'desc')->paginate(5);

        foreach ($comment as $item) {
            $item->user = User::userBaseInfo($item->userId);
        }

        return $this->success($comment);
    }

    public function createAction() {

       // $user = User::loginUser();

        $courseId = Request::input('courseId');
        $content = Request::input('content');
        $score = Request::input('score');
        $parentId = Request::input('parentId');


        $comment = new CourseComment([
            'courseId' => $courseId,
            'content' => $content,
            'score' => $score,
            'parentId'=> $parentId,
            'userId' => 1
        ]);

        $comment->save();

        return $this->success($comment);
    }

    public function scoreAction() {

        $courseId = Request::input('courseId');

        $scoreTotal = CourseComment::query()->whereNull('parentId')->where('courseId', $courseId)->sum('score');

        $scoreNum = CourseComment::query()->whereNull('parentId')->where('courseId', $courseId)->count();

        $scoreAverage = 0;

        if($scoreNum) {
            $scoreAverage = $scoreTotal / $scoreNum;
        }

        return $this->success($scoreAverage);
    }
}
