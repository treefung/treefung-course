<?php

namespace Treefung\Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'course';

    protected $guarded = [];

    public static $snakeAttributes = false;




    public function getBannerPathAttribute($value) {
        if($value) {
            return env('OSS_URL').$value;
        }
    }

    // 虚拟数据 用户数量 播放次数 附加公式
    // 需要剔除 公式内 除数字和运算符的字符
    public function getUserNumAttribute($value) {

//        if($this->userNumFormula) {
//            $value = $value.$this->userNumFormula;
//        }

        // return intval(eval("return $value;"));

        if($this->userNumFormula) {
            $value = $value + $this->userNumFormula;
        }

        return $value;

    }

    public function getPlayNumAttribute($value) {
//        if($this->playNumFormula) {
//            $value = $value.$this->playNumFormula;
//        }
//
//        return intval(eval("return $value;"));
        if($this->playNumFormula) {
            $value = $value + $this->playNumFormula;
        }

        return $value;

    }


    public static function courseList($limit, $categoryId = null, $typeId = null, $subjectId = null, $title = null) {

        $list = Course::query()

            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('categoryId', $categoryId);
            })

            ->when($typeId, function ($query, $typeId) {
                return $query->where('typeId', $typeId);
            })

            ->when($subjectId, function ($query, $subjectId) {
                return $query->where('subjectId', $subjectId);
            })

            ->when($title, function ($query, $title) {
                return $query->where('title', 'like', '%'.$title.'%');
            })

            ->when($limit, function ($query, $limit) {
                return $query->limit($limit);
            })

            ->where('enabled', true)

            ->where(function ($query)  {
                $query->whereNull('enabledTime')->orWhere('enabledTime','<=', now()); //  未设置开启时间 或者已经超过开启时间 二者满足其一
            })



            ->orderBy('createTime', 'desc')
            ->get();

        foreach ($list as $item) {

            $item->tags;
            $item->teachers;
        }

        return $list;
    }

    // 课程详情
    public static function courseDetail($id) {

        $course = Course::query()->find($id);

        $course->tags;
        $course->sections;
        $course->teachers;
        // $course->comments;

        return $course;
    }

    // 多个节
    public function sections() {
        return $this->hasMany('Treefung\Course\Models\CourseSection', 'courseId','id');
    }


    // 多个评论
    public function comments() {
        return $this->hasMany('Treefung\Course\Models\CourseComment', 'courseId','id');
    }


    // 一对一反向 大类 belongsTo
    public function category() {
        return $this->belongsTo('Treefung\Course\Models\CourseCategory', 'categoryId','id');
    }

    // 一对一反向 小类 belongsTo
    public function type() {
        return $this->belongsTo('Treefung\Course\Models\CourseType', 'typeId','id');
    }

    // 一对一反向 主题 belongsTo
    public function subject() {
        return $this->belongsTo('Treefung\Course\Models\CourseSubject', 'subjectId','id');
    }


    // 多对多 标签 belongsToMany
    public function tags() {
        return $this->belongsToMany(CourseTag::class,'courseTagRelation', 'courseId','tagId');
    }

    // 多对多 授课教师 belongsToMany
    public function teachers() {
        return $this->belongsToMany(CourseTeacher::class,'courseTeacherRelation', 'courseId','teacherId');
    }

}
