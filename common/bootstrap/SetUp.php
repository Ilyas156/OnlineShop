<?php

namespace common\bootstrap;


use shop\services\SignupService;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use Symfony\Component\Mailer\Mailer;

class SetUp implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->set(SignupService::class, [], [
            'supportEmail' => $app->params['supportEmail'],
        ]);
    }
}