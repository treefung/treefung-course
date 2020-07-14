<?php

namespace Treefung\Course\Models;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model {


    /**
     * BaseModel constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = []){

        /** 定义数据库连接名称 @var string */
        $this->connection = env('DB_CONNECTION_MAIN', 'mysql_main');
        parent::__construct($attributes);
    }


}
