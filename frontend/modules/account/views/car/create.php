<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $modelAutomobile common\models\Automobile */
/* @var $modelBus common\models\Bus */
/* @var $modelLorry common\models\Lorry */
/* @var $modelMoto common\models\Motocycle */
/* @var $modelSQ common\models\SpecialEquipment */

$this->title = Yii::t('app', 'Добавить {modelClass}', [
        'modelClass' => Yii::t('app', 'объявление'),
    ]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Automobiles'), 'url' => ['/account/automobile']];
//$this->params['breadcrumbs'][] = $this->title;

$items = [
    [
        'label' => '<img src="/images/icons/auto-t.png" class="search_icon" />',
        'content' => $this->render('/automobile/_form', [
            'model' => $modelAutomobile,
        ]),
        'active' => true
    ],
    [
        'label' => '<img src="/images/icons/bus-t.png" class="search_icon" />',
        'content' => $this->render('/bus/_form', [
            'model' => $modelBus,
        ]),
//        'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
    ],
    [
        'label' => '<img src="/images/icons/truck-t.png" class="search_icon" />',
        'content' => $this->render('/lorry/_form', [
            'model' => $modelLorry,
        ]),
    ],
    [
        'label' => '<img src="/images/icons/moto-t.png" class="search_icon" />',
        'content' => $this->render('/motocycle/_form', [
            'model' => $modelMoto,
        ]),
    ],
    [
        'label' => '<img src="/images/icons/sq-t.png" class="search_icon" />',
        'content' => $this->render('/special-equipment/_form', [
            'model' => $modelSQ,
        ]),
    ],
];
?>
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
                <?= \yii\helpers\Html::a(yii::t('app', 'Cars'), \yii\helpers\Url::to('/account/car')) ?>
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
        <div class="automobile-create">
            <div>
                <div class="well well-sm pull-right">
                    <?= Yii::t('app', 'Your account number') ?>: <?= $user->profile->user_id ?>
                    <br>
                    <?= Yii::t('app', 'Your balance') ?>: <?= $user->profile->balance ?> <?= Yii::t('app', 'сом') ?>
                </div>
                <span class="pull-left" style="font-size: 18px; color: #0a0a0a;">
                    <br><br><br><?= Yii::t('app', 'Add new auto') ?>
                </span>
                <div class="clearfix"></div>
            </div>
            <hr style="margin-top: 0px;">
            <?=
            TabsX::widget([
                'items' => $items,
                'position' => TabsX::POS_ABOVE,
                'encodeLabels' => false,
                'bordered' => true,
            ]);
            ?>

        </div>

    </div>
</div>
