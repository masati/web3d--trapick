<?php

use SleepingOwl\Admin\Navigation\Page;

AdminNavigation::setAccessLogic(function(Page $page) {
    die("!!!");
    return auth()->user()->isAdmin();
});

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

return [
    [
        'title' => 'Admin',
        'pages' => [
            (new Page(App\Models\User::class))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(App\Models\Feedback::class))
                ->setIcon('fa fa-document')
                ->setTitle('Feedback')
                ->setPriority(10),
            (new Page(App\Models\Tag::class))
                ->setIcon('fa fa-document')
                ->setTitle('Tags')
                ->setPriority(10),
            (new Page(App\Models\Category::class))
                ->setIcon('fa fa-document')
                ->setTitle('Categories')
                ->setPriority(20),
            (new Page(App\Models\Page::class))
                ->setIcon('fa fa-document')
                ->setTitle('Pages')
                ->setPriority(30),
        ]
    ],
    [
        'title' => 'Sessions',
        'pages' => [
            /*(new Page(App\Models\SourceTag::class))
                ->setIcon('fa fa-document')
                ->setPriority(1),*/
            (new Page(App\Models\Source::class))
                ->setIcon('fa fa-document')
                ->setPriority(0),
            (new Page(App\Models\Lesson::class))
                ->setIcon('fa fa-document')
                ->setTitle('Sessions')
                ->setPriority(0),
/*            (new Page(App\Models\LessonBackup::class))
                ->setIcon('fa fa-document')
                ->setTitle('Sessions backup')
                ->setPriority(10),*/
        ]
    ],

    [
        'title' => 'Information',
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
    ],

    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
	//		      ));
    //
	//		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];
