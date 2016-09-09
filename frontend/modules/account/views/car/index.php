<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Cars list');
?>
<div class="car-index">

    <div class="row">
        <div class="col-lg-4">
            <?php
            $user = \yii::$app->user->identity;
            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php if ($user->profile->client_type == 1) {?><b><?= $user->profile->company_name ?></b><br><?php }?>
                    <?= $user->profile->fio ?><br>
                    <?= isset($user->profile->work_phone) ? $user->profile->work_phone.'<br>' : ''?>
                    <?= $user->profile->mobile_phone ?><br>
                </li>
                <li class="list-group-item">
                    <?= yii::t('app', 'Cars') ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Settings'), \yii\helpers\Url::to('/account/settings')) ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Refill balance'), \yii\helpers\Url::to('/account/refill-balance')) ?>
                </li>
            </ul>
        </div>

        <div class="col-lg-20">
            <h1><?= Html::encode($this->title) ?></h1>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table'
                ],
                'showHeader' => false,
                'columns' => [
                    [
                        'format' => 'html',
                        'value' => function($data) {
                            return '<ul class="list-group">
    <li class="list-group-item">Премиум</li>
                </ul>';
                        }
                    ],
                    [
                        'format' => 'html',
                        'value' => function($data) {
                            return $this->render('image_column');
                        },
                        'contentOptions' => ['class' => 'come-class']
                    ],
                    [
                        'format' => 'html',
                        'attribute' => 'updated_at',
                        'value' => function($data) {
                            return $this->render('/car/_gridItem', [
                                    'model' => $data
                            ]);
                        },
                            'label' => false,
                        ],
                        [
                            'attribute' => 'price'
                        ],
                        [
                            'format' => 'html',
                            'value' => function($data) {
                                return '<ul class="list-group">
    <li class="list-group-item">Посмотреть</li>
    <li class="list-group-item">Редактировать</li>
    <li class="list-group-item">Удалить</li>
                </ul>';
                            }
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
        </div>
    </div>
</div>
