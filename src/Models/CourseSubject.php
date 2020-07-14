<?php

namespace Treefung\Course\Models;


use Illuminate\Database\Eloquent\SoftDeletes;


class CourseSubject extends BaseModel {

    use SoftDeletes;

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';
    const DELETED_AT = 'deleteTime';

    protected  $table = 'courseSubject';

    protected $guarded = [];




}
