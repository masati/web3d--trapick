<?php

// PackageManager::load('admin-default')
//    ->css('extend', resources_url('css/extend.css'));

WysiwygManager::register('ckeditor')
    ->js(null, '//cdn.ckeditor.com/4.5.7/standard-all/ckeditor.js', ['jquery']);
