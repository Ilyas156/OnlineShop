<?php

/** @var yii\web\View $this */
/** @var User $user */

use shop\entities\User\User;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->verification_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
