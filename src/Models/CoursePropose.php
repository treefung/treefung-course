<?php


namespace Treefung\Course\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePropose extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'coursePropose';

    protected $guarded = [];

    public static $snakeAttributes = false;

    public function getBannerPathAttribute($value) {
        return env('OSS_URL').$value;
    }

}
