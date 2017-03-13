<?php

return array(
    'project_name' => '4HQ',
    'notify_emails' => array('eugene@mednikov.info'),
    'email_template' => "bugonemail::email.notifyException",
    'notify_environment' => array('local','production'),
    'prevent_exception' => array('Symfony\Component\HttpKernel\Exception\NotFoundHttpException','Illuminate\Session\TokenMismatchException'),
);
