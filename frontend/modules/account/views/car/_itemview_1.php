<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\timeago\TimeAgo;
use yii\web\View;

/* @var $this yii\web\View */

$url = Url::to(['/account/car/up']);
$this->registerJs("function up(id) {
    $.ajax({
        url: '{$url}?id='+id,
        type: 'GET',
        success: function(result) { alert(result);},
      });
}", View::POS_END, 'upping');
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
    <div class="car-tools-wrapper">
        <div class="btn-group-vertical" role="group" aria-label="...">
            <button type="button" class="btn btn-default">Премиум</button>
            <button type="button" class="btn btn-default">Редактировать</button>
            <button type="button" class="btn btn-default" onclick="up(<?= $model->id ?>)">Апнуть</button>
        </div>
    </div>
    <div class="car-price-wrapper">
        <span class="car-price">$<?= $model->price ?></span>
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
            <a href="<?= Url::to([ '/account/car/view', 'id' => $model->id]) ?>" class="car-model-name">
                <?= $model->marka->name ?>
                <?= $model->carModel->name ?>
            </a>
            <div class="car-details">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Alias, atque beatae deserunt eaque eveniet expedita,
                explicabo fugiat harum illo libero magnam magni mollitia nam nesciunt
                porro similique tempore.
            </div>
            <div>Tel: <span class="car-contact"><?= $model->owner->profile->mobile_phone ?></span></div>
        </div>
    </div>
</div>
