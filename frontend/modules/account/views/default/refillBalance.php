<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use common\models\UserProfile;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = \yii::t('app', 'Refill balance');
?>
<div class="refill-balance-view">
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
                    <?= \yii::t('app', 'Refill balance') ?>
                </li>
            </ul>
        </div>

        <div class="col-lg-20">
            <div>
                <div class="well well-sm pull-right">
                    <?= Yii::t('app', 'Your account number') ?>: <?= $user->profile->user_id ?>
                    <br>
                    <?= Yii::t('app', 'Your balance') ?>: <?= $user->profile->balance ?> <?= Yii::t('app', 'сом') ?>
                </div>
                <span class="pull-left" style="font-size: 18px; color: #0a0a0a;">
                    <br><br><br><?= Yii::t('app', 'How to refill balance / Terms of extention') ?>
                </span>
                <div class="clearfix"></div>
            </div>
            <hr style="margin: 0px;">
            <p>
                <?php
                $post = \common\models\Post::find()
                    ->where(['like', 'name', 'Условия пополнения баланса'])
                    ->one();
                if ($post != NULL) {
                    $mpost = $post->findByLang(Yii::$app->language);
                    if ($mpost) {
                        echo $mpost->body;
                    }
                }
                ?>
            </p>

        </div>
    </div>

</div>

