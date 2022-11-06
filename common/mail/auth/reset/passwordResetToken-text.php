<?php

/** @var yii\web\View $this */
/** @var User $user */

use shop\entities\User\User;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
