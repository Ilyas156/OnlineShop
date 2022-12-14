<?php

use kartik\date\DatePicker;
use shop\entities\User\User;
use shop\helpers\UserHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'value' => function (User $model) {
                    return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'filter' => UserHelper::statusList(),
                'value' => function (User $model) {
                    return UserHelper::statusLabel($model->status);
                },
                'format' => 'raw',
            ],
            'email:email',
            [
                'attribute' => 'created_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'dateFrom',
                    'attribute2' => 'dateTo',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
                'format' => 'datetime',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>