<?php


namespace Treefung\Course\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class CourseUser extends BaseModel {
    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseUser';

    protected $guarded = [];

    public static function boot() {

        parent::boot();

        self::created(function (self $self) {
            // 创建完毕 section 报名人数+1
            Course::query()->where('id', $self->courseId)->increment('userNum');
        });

    }


}
