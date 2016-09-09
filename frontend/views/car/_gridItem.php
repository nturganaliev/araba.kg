<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\timeago\TimeAgo;

/* @var $this yii\web\View */
/* @var $model common\models\Automobile */
?>

<div class="cars-wrapper">
    <div class="car-photo">
        <?=
        Html::img(yii\helpers\Url::to($model->getMainImagePath()), [
            'class' => 'img-bordered',
            'width' => 200
        ]);
        ?>
    </div>
    <div class="car-price-wrapper">
        <span class="car-price">$8000</span>
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
            <a href="<?= Url::to(['/car/view', 'id' => $model->id]) ?>" class="car-model-name">
                <?= $model->marka->name ?>
                <?= $model->carModel->name ?>
            </a>
            <div class="car-details">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Alias, atque beatae deserunt eaque eveniet expedita,
                explicabo fugiat harum illo libero magnam magni mollitia nam nesciunt
                porro similique tempore.
            </div>
            <div>Tel: <span class="car-contact">123456789</span></div>
        </div>
    </div>
</div>

<!--<div>
    <p>
</div>-->

