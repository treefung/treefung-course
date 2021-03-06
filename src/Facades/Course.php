<?php

namespace Treefung\Course\Facades;

use Illuminate\Support\Facades\Facade;

class Course extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Treefung\Course\Course::class;
    }
}
