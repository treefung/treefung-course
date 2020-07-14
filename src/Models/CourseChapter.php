<?php


namespace Treefung\Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class CourseChapter extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseChapter';

    protected $guarded = [];


    public static $snakeAttributes = false;


    // 需要改存储内容 覆写 File 方法
    public function getVideoPathAttribute($value) {

        return env('OSS_URL').$value;

    }

    // 课程问答
    public function questions() {
        return $this->hasMany('Treefung\Course\Models\CourseQuestion', 'chapterId','id');
    }

    // 资料下载

    public function materials() {
        return $this->hasMany('Treefung\Course\Models\CourseMaterial', 'chapterId','id');
    }


    // 章节详情
    public static function chapterDetail($chapterId) {

        $chapter = CourseChapter::query()->find($chapterId);

        $chapter->questions;
        $chapter->materials;

        return $chapter;
    }



}
