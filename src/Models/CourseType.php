<?php


namespace Treefung\Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CourseType extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseType';

    protected $guarded = [];

    public static $snakeAttributes = false;

    public function getBannerPathAttribute($value) {
        return env('OSS_URL').$value;
    }

    public static function list($categoryId) {

        return CourseType::query()->where('categoryId', $categoryId)->get();

    }



}
