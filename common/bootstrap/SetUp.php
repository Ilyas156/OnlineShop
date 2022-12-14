<?php

namespace common\bootstrap;


use shop\services\ContactService;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->set(ContactService::class, [], [
            'adminEmail' => $app->params['supportEmail'],
        ]);
    }
}