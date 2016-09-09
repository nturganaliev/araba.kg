<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
?>

<div class="row">
    <div class="col-sm-24">
        <?php foreach ($similarModels as $similarModel): ?>
            <div class="newrow similar-newrow">
                <a class="newlink similar-newlink" href="<?= Url::to(['/car/view', 'id' => $similarModel->id]) ?>">
                    <!--<img title="Lexus LX 570 " itemprop="image" src="images/product1.jpg" alt="Lexus LX 570 ">-->
                    <?=
                    Yii::$app->imageCache->thumb($similarModel->getMainImagePath(), 'thumb', [
                        'class' => 'img-responsive'
                    ])
                    ?>
                </a>
                <div class="someinfo">
                    <a href="<?= Url::to(['/car/view', 'id' => $similarModel->id]) ?>">
                        <?php
                        echo $similarModel->name;
                        ?></a><br>
                    <div class="car-year"><?= $similarModel->issue_date ?> г. </div>
                    <?= ($similarModel->price ? '<span class="car-price">'. number_format($similarModel->price) . Yii::t('value', 'KGS') .'</span>' : Yii::t('value', 'price negotiable')) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>