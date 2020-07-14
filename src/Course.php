<?php

namespace Treefung\Course;

use Illuminate\Routing\Router;

class Course {

    public static function routes() {
        require __DIR__.'/../routes/course.php';
    }


}
