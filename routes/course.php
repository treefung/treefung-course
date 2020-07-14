<?php

Route::namespace('\Treefung\Course\Controllers')->prefix('course')->group(function () {

    /**
     * 课程相关
     */
    # 课程详情
    Route::any('/detail','CourseController@detailAction');

    /**
     * 课程分类相关
     */
    # 课程分类列表
    Route::any('/category/list','Course\CategoryController@listAction');

    # 课程分类详情
    Route::any('/category/detail','Course\CategoryController@detailAction');



    # 课程列表
    Route::any('/list','CourseController@listAction');

    # 课程大类小类菜单
    Route::any('/menu','CourseMenuController@indexAction');

    /**
     * 课程推荐相关
     */
    # 课程推荐
    Route::any('/propose/list','CourseProposeController@listAction');

    /**
     * 课程章相关
     */
    # 章详情
    Route::any('/chapter/detail','Course\ChapterController@detailAction');

    /**
     * 课程节相关
     */
    # 节详情
    Route::any('/section/detail','Course\SectionController@detailAction');

    # 节学习完毕
    Route::any('/section/user/create','Course\SectionUserController@createAction');


    /**
     * 课程评论相关
     */
    # 创建评论
    Route::any('/comment/create','Course\CommentController@createAction');

    # 拉取评论
    Route::any('/comment/list','Course\CommentController@listAction');

    # 拉取子评论
    Route::any('/comment/sublist','Course\CommentController@subListAction');

    # 评论平均分
    Route::any('/comment/score','Course\CommentController@scoreAction');

    /**
     * 课程用户相关
     */
    # 拉取用户报名信息
    Route::any('/user/detail','Course\UserController@detailAction');

    # 报名
    Route::any('/user/create','Course\UserController@createAction');

    # 我的全部课程
    Route::any('/user/list','Course\UserController@listAction');





});
