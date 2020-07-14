<?php

namespace Treefung\Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseCategory';

    protected $guarded = [];

    public static $snakeAttributes = false;

    public function getBannerPathAttribute($value) {
        if($value) {
            return env('OSS_URL').$value;
        }
    }


    public static function list() {

        return CourseCategory::query()->where('enabled', true)->get();

    }



    // 多个二级类
    public function types() {
        return $this->hasMany('Treefung\Course\Models\CourseType', 'categoryId','id');
    }



}
