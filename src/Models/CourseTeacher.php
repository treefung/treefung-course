<?php


namespace Treefung\Course\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTeacher extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseTeacher';

    protected $guarded = [];

    public static $snakeAttributes = false;

    protected $hidden = ['pivot'];

    public function getPhotoPathAttribute($value) {
        if($value) {
            return env('OSS_URL').$value;
        }

    }




}
