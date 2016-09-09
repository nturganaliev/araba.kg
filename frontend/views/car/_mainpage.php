<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $models array common\models\Car */
?>
<div class="row">
    <div class="col-sm-24">
        <?php foreach ($models as $model): ?>
            <div class="newrow">
                <a class="newlink" href="<?= Url::to(['/car/view', 'id' => $model->id]) ?>">
                    <?=
                    Yii::$app->imageCache->thumb($model->getMainImagePath(), 'thumb', [
                        'class' => 'img-responsive'
                    ])
                    ?>
                </a>
                <div class="someinfo">
                    <a href="<?= Url::to(['/car/view', 'id' => $model->id]) ?>">
                        <?php
                        echo $model->name;
                        ?></a><br>
                    <div class="car-year"><?= $model->issue_date ?> г. </div>
                    <?= ($model->price ? '<span class="car-price">'. number_format($model->price) . Yii::t('value', 'KGS') . '</span>' : Yii::t('value', 'price negotiable')) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

