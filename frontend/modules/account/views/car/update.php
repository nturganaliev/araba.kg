<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Car;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\Car */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Car Model',
    ]) . ' ' . $model->id;
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
        <div class="automobile-update">
            <div>
                <div class="well well-sm pull-right">
                    <?= Yii::t('app', 'Your account number') ?>: <?= $user->profile->user_id ?>
                    <br>
                    <?= Yii::t('app', 'Your balance') ?>: <?= $user->profile->balance ?> <?= Yii::t('app', 'сом') ?>
                </div>
                <span class="pull-left" style="font-size: 18px; color: #0a0a0a;">
                    <br><br><br><?= Yii::t('app', 'Change data') ?> <span style="color: #337ab7;"><?= $model->getTname() ."{$model->issue_date}г.,"?></span><span style="color:#bc0004"><?= ($model->price ? number_format($model->price) . Yii::t('value', 'KGS') : Yii::t('value', 'price negotiable')) ?></span>
                </span>
                <div class="clearfix"></div>
            </div>
            <hr style="margin-top: 0px;">
            <div class="car-model-update">
                <div class="panel panel-default">
                    <div class="panel-body" style="background-color: #f9f9f9;">
                        <?php
                        switch ($model->type_id) {
                            case Car::CAR_TYPE_AUTOMOBILE:
                                echo $this->render('/automobile/_update_form', [
                                    'model' => $model,
                                ]);
                                break;
                            case Car::CAR_TYPE_MOTOCYCLE:
                                echo $this->render('/motocycle/_update_form', [
                                    'model' => $model,
                                ]);
                                break;
                            case Car::CAR_TYPE_LORRY:
                                echo $this->render('/lorry/_update_form', [
                                    'model' => $model,
                                ]);
                                break;
                            case Car::CAR_TYPE_BUS:
                                echo $this->render('/bus/_update_form', [
                                    'model' => $model,
                                ]);
                                break;
                            case Car::CAR_TYPE_SPECIAL_EQUIPMENT:
                                echo $this->render('/special-equipment/_update_form', [
                                    'model' => $model,
                                ]);
                                break;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

