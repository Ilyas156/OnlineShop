<?php

namespace shop\helpers;

use Exception;
use shop\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelper
{

    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active'
        ];
    }

    /**
     * @throws Exception
     */
    public static function statusName(int $status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @throws Exception
     */
    public static function statusLabel(int $status): string
    {
        $class = match ($status) {
            User::STATUS_ACTIVE => 'label labels-success',
            default => 'label label-default',
        };

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}