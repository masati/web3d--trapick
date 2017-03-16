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
                AdminColumn::text('full_name')->setLabel('Full name'),
                AdminColumn::text('phone')->setLabel('Phone'),
                AdminColumn::text('is_sa')->setLabel('Admin'),

            ])->paginate(25);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('email', 'Email')->required(),
            AdminFormElement::text('full_name', 'Full name')->required(),
            AdminFormElement::text('phone', 'Phone'),
            AdminFormElement::checkbox('is_sa', 'Admin'),
            AdminFormElement::password('password', 'Password')->required()->addValidationRule('min:6'),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Transport::class, function (ModelConfiguration $model) {
    $model->setTitle('Transport');
    // Display
    $model->onDisplay(function () {
        return AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('name')->setLabel('Name'),
                AdminColumn::text('cost')->setLabel('Cost'),
                AdminColumn::text('capacity')->setLabel('Capacity'),
                AdminColumn::text('bags')->setLabel('Bags'),

            ])->paginate(25);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Name')->required(),
            AdminFormElement::text('cost', 'Cost')->required(),
            AdminFormElement::text('capacity', 'Capacity'),
            AdminFormElement::text('bags', 'Bags'),
        ]);
    });
});

AdminSection::registerModel(\App\Models\Extra::class, function (ModelConfiguration $model) {
    $model->setTitle('Extras');
    // Display
    $model->onDisplay(function () {
        return AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('cost')->setLabel('Cost'),
            ])->paginate(25);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::text('cost', 'Cost')->required(),
        ]);
    });
});
