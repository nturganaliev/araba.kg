<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$provider = new ActiveDataProvider([
    'query' => common\models\Photo::find()->where(['car_id' => $model->id]),
    'pagination' => [
        'pageSize' => 20,
    ],
    ]);
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
                    <br><br><br><?= Yii::t('app', 'Edit pictures') ?> . <span style="color: #337ab7;"><?= "{$model->name} {$model->issue_date}г., " ?></span><span style="color:#bc0004">$<?= $model->price ?></span>
                </span>
                <div class="clearfix"></div>
            </div>
            <hr style="margin-top: 0px;">
            <div class="gallery">
                <div class="panel panel-default">
                    <div class="panel-body" style="background-color: #f9f9f9;">
                        <?php
                        \yii\widgets\Pjax::begin([
                            'id' => 'images-gallery',
                        ]);
                        ?>
                        <div class="row">

                            <div class="col-sm-24">
                                <?php
                                echo $this->render('_images_listview', [
                                    'dataProvider' => $provider,
                                    'carId' => $model->id,
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">

                                <?php
                                $imagesUploadForm = new common\models\UploadForm();
                                $imagesUploadForm->car_id = $model->id;
                                echo $this->render('_image_upload_form', [
                                    'model' => $imagesUploadForm,
                                    'carId' => $model->id
                                ]);
                                ?>
                            </div>
                        </div>
                        <?php \yii\widgets\Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>