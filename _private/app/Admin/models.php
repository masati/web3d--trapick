<?php

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(\App\Models\User::class, function (ModelConfiguration $model) {
    $model->setTitle('Users');
    // Display
    $model->onDisplay(function () {
        return AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('email')->setLabel('Email'),
                AdminColumn::text('first_name')->setLabel('First name'),
                AdminColumn::text('last_name')->setLabel('Last name'),
                AdminColumn::text('job_title')->setLabel('Job title'),
                AdminColumn::text('institution')->setLabel('Institution'),
                AdminColumn::text('city')->setLabel('City'),
                AdminColumn::text('country.name')->setLabel('Country'),
                AdminColumn::text('phone')->setLabel('Phone'),
                AdminColumn::text('is_sa')->setLabel('Admin'),
                AdminColumn::text('is_active')->setLabel('Active'),
                AdminColumn::text('course_date')->setLabel('Course date'),
                #AdminColumnEditable::checkbox('is_active')->setLabel('Active'),
                #AdminColumnEditable::checkbox('to_approve')->setLabel('To approve'),
                AdminColumn::text('to_approve')->setLabel('To approve'),
                AdminColumn::custom('membership_expiration', function($item) {
                    if ($item->membership_expiration <= date('Y-m-d'))
                        return '<span style="color:red;">' . $item->membership_expiration . '</span>';
                    else
                        return $item->membership_expiration;
                })->setLabel('Exp. date'),
            ])->paginate(25);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::checkbox('is_active', 'Active'),
            AdminFormElement::checkbox('to_approve', 'To approve'),
            AdminFormElement::text('email', 'Email')->required(),
            AdminFormElement::text('first_name', 'First name')->required(),
            AdminFormElement::text('last_name', 'Last name')->required(),
            AdminFormElement::text('job_title', 'Job title'),
            AdminFormElement::text('institution', 'Institution'),
            AdminFormElement::text('city', 'City'),
            AdminFormElement::select('country_id', 'Country')->setModelForOptions(new App\Models\Country())->setDisplay('name')->required(),
            AdminFormElement::text('phone', 'Phone'),
            AdminFormElement::date('membership_expiration', 'Membership expiration'),
            AdminFormElement::date('course_date', 'Course date'),
            AdminFormElement::checkbox('is_sa', 'Admin'),
            AdminFormElement::password('password', 'Password')->required()->addValidationRule('min:6'),
        ]);
    });
});



AdminSection::registerModel(\App\Models\Source::class, function (ModelConfiguration $model) {
    $model->setTitle('Sources');
    // Display
    $model->onDisplay(function () {
        return AdminDisplay::datatablesAsync()
            ->with('source_type', 'categories', 'tags', 'user')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('lang')->setLabel('Lang'),
                AdminColumn::text('is_active')->setLabel('Active'),
                AdminColumn::text('source_type_id')
                    ->append(AdminColumn::text('source_type.name'))
                    ->setLabel('Source type'),
                AdminColumn::text('summary')->setLabel('Summary'),
                AdminColumn::lists('categories.name')->setLabel('Categories'),
                AdminColumn::lists('tags.name')->setLabel('Tags'),
                AdminColumn::text('user.full_name')->setLabel('Added by'),
            ])->paginate(25);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::checkbox('is_active', 'Active'),
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::select('lang', 'Lang', ['en' => 'english', 'he' => 'hebrew'] )->setDisplay('locale'),
            AdminFormElement::textarea('summary', 'Summary'),
            AdminFormElement::select('user_id', 'Added by')->setModelForOptions(new App\Models\User())->setDisplay('full_name')->required(),
            AdminFormElement::select('source_type_id', 'Source type')->setModelForOptions(new App\Models\SourceType())->setDisplay('name')->required(),
            AdminFormElement::multiselect('categories', 'Categories')->setModelForOptions(new App\Models\Category())->setDisplay('name')->required(),
            AdminFormElement::multiselect('tags', 'Tags')->setModelForOptions(new App\Models\Tag())->setDisplay('name'),

            AdminFormElement::text('video', 'Video url'),
            AdminFormElement::file('audio', 'Audio (mp3)'),
            AdminFormElement::file('document', 'File (any)'),
            #AdminFormElement::image('image', 'Image'),
            AdminFormElement::images('gallery', 'Gallery'),
            AdminFormElement::wysiwyg('text', 'Text'),
        ]);
    });
});


AdminSection::registerModel(\App\Models\SourceBackup::class, function (ModelConfiguration $model) {
    $model->setTitle('Sources Backups');
    // Display
    $model->onDisplay(function () {
        return AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('locale')->setLabel('Lang'),
                AdminColumn::text('is_active')->setLabel('Active'),
                AdminColumn::text('source_type.name')->setLabel('Source type'),
                AdminColumn::text('summary')->setLabel('Summary'),
                AdminColumn::lists('categories.name')->setLabel('Categories'),
                AdminColumn::lists('tags.name')->setLabel('Tags'),
                AdminColumn::text('user.full_name')->setLabel('Added by'),
            ])->paginate(25);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::checkbox('is_active', 'Active'),
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::textarea('summary', 'Summary'),
            AdminFormElement::select('locale', 'Lang', ['en' => 'english', 'he' => 'hebrew'] )->setDisplay('locale'),
            AdminFormElement::select('user_id', 'Added by')->setModelForOptions(new App\Models\User())->setDisplay('full_name')->required(),
            AdminFormElement::select('source_type_id', 'Source type')->setModelForOptions(new App\Models\SourceType())->setDisplay('name')->required(),
            AdminFormElement::multiselect('categories', 'Categories')->setModelForOptions(new App\Models\Category())->setDisplay('name'),
            AdminFormElement::multiselect('tags', 'Tags')->setModelForOptions(new App\Models\Tag())->setDisplay('name'),

            AdminFormElement::text('video', 'Video url'),
            AdminFormElement::file('audio', 'Audio (mp3)'),
            AdminFormElement::file('document', 'File (any)'),
            #AdminFormElement::image('image', 'Image'),
            AdminFormElement::images('gallery', 'Gallery'),
            AdminFormElement::wysiwyg('text', 'Text'),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Lesson::class, function (ModelConfiguration $model) {
    $model->setTitle('Sessions');
    // Display
    $model->onDisplay(function () {

        return AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('lang')->setLabel('Lang'),
                AdminColumn::text('is_public')->setLabel('Public'),
                AdminColumn::text('is_published')->setLabel('Published'),
                AdminColumn::text('has_video')->setLabel('Video'),
                AdminColumn::text('has_sound')->setLabel('Audio'),
                #AdminColumn::text('requires_printouts')->setLabel('Printouts'),
                #AdminColumn::text('shabat_friendly')->setLabel('Shabbat'),
                #AdminColumnEditable::checkbox('is_public')->setLabel('Public'),
                #AdminColumnEditable::checkbox('is_published')->setLabel('Published'),
                #AdminColumnEditable::checkbox('has_video')->setLabel('Video'),
                #AdminColumnEditable::checkbox('has_sound')->setLabel('Audio'),
                #AdminColumnEditable::checkbox('requires_printouts')->setLabel('Printouts'),
                #AdminColumnEditable::checkbox('shabat_friendly')->setLabel('Shabat'),
                AdminColumn::text('summary')->setLabel('Summary'),
                AdminColumn::lists('categories.name')->setLabel('Categories'),
                AdminColumn::lists('tags.name')->setLabel('Tags'),
                AdminColumn::text('user.full_name')->setLabel('Author'),
            ]);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::select('lang', 'Lang', ['en' => 'english', 'he' => 'hebrew'] )->setDisplay('locale'),
            AdminFormElement::textarea('summary', 'Summary'),
            AdminFormElement::ckeditor('aims', 'Aims'),
            AdminFormElement::select('user_id', 'Author')->setModelForOptions(new App\Models\User())->setDisplay('full_name')->required(),
            #AdminFormElement::select('age_group', 'Age group')->setOptions(App\Models\Lesson::getGroups())->setDisplay('name'),
            AdminFormElement::multiselect('categories', 'Categories')->setModelForOptions(new App\Models\Category())->setDisplay('name')->required(),
            AdminFormElement::multiselect('tags', 'Tags')->setModelForOptions(new App\Models\Tag())->setDisplay('name'),
            AdminFormElement::multiselect('age_groups', 'Age groups')->setModelForOptions(new App\Models\AgeGroup())->setDisplay('name')->required(),
            AdminFormElement::checkbox('is_public', 'Public (guests can see)'),
            AdminFormElement::checkbox('is_published', 'Published (users can see)'),
            AdminFormElement::checkbox('requires_printouts', 'Requires printouts'),
            AdminFormElement::checkbox('shabat_friendly', 'Shabbat friendly'),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Tag::class, function (ModelConfiguration $model) {
    $model->setTitle('List of tags');
    // Display
    $model->onDisplay(function () {

        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('#'),
                AdminColumn::text('name')->setLabel('Tag name'),
            ]);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Tag name')->required(),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Category::class, function (ModelConfiguration $model) {
    $model->setTitle('List of categories');
    // Display
    $model->onDisplay(function () {

        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('#'),
                AdminColumn::text('name')->setLabel('Category name'),
            ]);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Category name')->required(),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Page::class, function (ModelConfiguration $model) {
    $model->setTitle('Static pages');
    // Display
    $model->onDisplay(function () {

        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('#'),
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('url')->setLabel('Link'),
                AdminColumn::text('users.full_name')->setLabel('Author'),
                AdminColumnEditable::checkbox('is_published')->setLabel('Published'),
                AdminColumn::text('locale')->setLabel('Lang'),
            ]);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::text('url', 'Link')->required(),
            AdminFormElement::select('user_id', 'Author')->setModelForOptions(new App\Models\User())->setDisplay('full_name'),
            AdminFormElement::select('locale', 'Lang', ['en' => 'english', 'he' => 'hebrew'] )->setDisplay('locale'),
            AdminFormElement::wysiwyg('content', 'Content'),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Feedback::class, function (ModelConfiguration $model) {
    $model->setTitle('Feedback');
    // Display
    $model->onDisplay(function () {

        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                #AdminColumn::text('id')->setLabel('#'),
                AdminColumn::datetime('updated_at')->setLabel('Date'),
                AdminColumn::text('first_name')->setLabel('First Name'),
                AdminColumn::text('last_name')->setLabel('Last Name'),
                AdminColumn::text('institution')->setLabel('Institution'),
                AdminColumn::text('email')->setLabel('Email'),
                AdminColumn::text('query')->setLabel('Message'),
           ]);
    });
});
