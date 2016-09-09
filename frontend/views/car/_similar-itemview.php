<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\timeago\TimeAgo;
?>

<div class="cars-wrapper">
    <div class="car-photo">
        <a href="<?= Url::to(['/car/view', 'id' => $model->id]) ?>">
            <?php
            echo Yii::$app->imageCache->thumb($model->getMainImagePath(), 'thumb', [
                'class' => 'img-responsive',
            ]);
            ?>
        </a>
    </div>
    <div class="car-price-wrapper">
        <?= ($model->price ? '<span class="car-price">'. number_format($model->price) . Yii::t('value', 'KGS') .'</span>' : Yii::t('value', 'price negotiable')) ?>
        <div class="upload-date"><?=
            TimeAgo::widget([
                'timestamp' => date(DATE_ISO8601, $model->created_at),
                'language' => 'ru',
            ]);
            ?>
        </div>
    </div>
    <div class="car-description-wrapper">
        <div class="car-description-content">
            <div>

                <div class="pull-right">

                    <?php if ($model->rent): ?>
                        <label class="label label-success"><?= Yii::t('app', 'Rent') ?> </label>
                    <?php endif; ?>
                </div>
                <a href="<?= Url::to(['/car/view', 'id' => $model->id]) ?>" class="car-model-name">
                    <?= $model->name . ' ' . $model->engine_displacement . 'л' ?>
                </a>
            </div>
            <div class="car-details">
                <?= $model->getFullname() ?>
            </div>
            <div>tel: <?= $model->owner->profile->mobile_phone ?></div>
        </div>
    </div>
</div>
