<?php

namespace Treefung\Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSection extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseSection';

    protected $guarded = [];


    public static $snakeAttributes = false;

    public static function boot() {

        parent::boot();

        self::saved(function (self $self) {

            $sectionNum = $self::query()->where('courseId', $self->courseId)->count();
            $course = Course::query()->find($self->courseId);
            $course->sectionNum = $sectionNum;
            $course->save();

        });

        /* 此方法不适用统计数量 循环查询检出同样执行
        self::retrieved(function (self $self) {
            // 检索读出数据时 section 播放次数+1
            self::query()->where('id', $self->id)->increment('playNum');

            // 检索读出数据时 course 播放次数+1
            Course::query()->where('id', $self->courseId)->increment('playNum');
        });
        */

    }


    // 需要改存储内容 覆写 File 方法
    public function getVideoPathAttribute($value) {

        $value = env('OSS_URL').$value;

        return $value;
    }

    // 课程问答
    public function questions() {
        return $this->hasMany('Treefung\Course\Models\CourseQuestion', 'sectionId','id');
    }

    // 资料下载

    public function materials() {
        return $this->hasMany('Treefung\Course\Models\CourseMaterial', 'sectionId','id');
    }


    // 节详情
    public static function sectionDetail($sectionId) {

        $section = CourseSection::query()->find($sectionId);

        // 成功读取执行 PlayNum ++
        if($section) {

            // 检索读出数据时 section 播放次数+1
            CourseSection::query()->where('id', $section->id)->increment('playNum');

            // 检索读出数据时 course 播放次数+1
            Course::query()->where('id', $section->courseId)->increment('playNum');
        }

        $section->questions;
        $section->materials;

        return $section;
    }

}
