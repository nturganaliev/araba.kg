<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\timeago\TimeAgo;
use yii\web\View;

/* @var $this yii\web\View */

$url = Url::to(['/account/car/up']);
$result_success = Yii::t('app', 'Upping updated');
$result_failure = Yii::t('app', 'Upping failed');
$label_active = '<label class="label label-warning">'. Yii::t('app', 'Active') .'</label>';
$this->registerJs("function up(id) {
    $.ajax({
        url: '{$url}?id='+id,
        type: 'GET',
        success: function(result) {
            if (result) {
                $('.cars-wrapper').find('label#car_'+result).replaceWith('{$label_active}');
                alert('{$result_success}');
            } else {
                alert('{$result_failure}');
            }
        },
      });
}", \yii\web\View::POS_END, 'upping');
?>
<div class="row">
    <div class="col-sm-21">
        <div class="cars-wrapper">
            <div class="car-photo account-car-photo">
                <a href="<?= Url::to(['/account/car/view', 'id' => $model->id]) ?>">
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
                        'language' => Yii::$app->language,
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
                            &nbsp;
                            <?php if ($model->isArchive()): ?>
                                <label class="label label-danger" id="car_<?= $model->id ?>"><?= Yii::t('app', 'In archive (Upping)') ?></label>
                            <?php else: ?>
                                <label class="label label-warning"><?= Yii::t('app', 'Active') ?></label>
                            <?php endif; ?>
                        </div>
                        <a href="<?= Url::to(['/account/car/view', 'id' => $model->id]) ?>" class="car-model-name">
                            <?= $model->getTname() . ' ' . $model->engine_displacement . 'л' ?>
                        </a>
                    </div>
                    <div class="car-details">
                        <?= $model->getFullname() ?>
                    </div>
                    <?php if ($model->isPremium()): ?>
                        <span style="color: #bc0004; font-size: 13px;"><?= Yii::t('app', 'Premium') ?>: <?= $model->getBeginAndEndDate() ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="pull-right">
            <div class="btn-group-vertical" role="group" aria-label="..." style="margin-top: 5px;margin-bottom: 5px;">
                <?=
                Html::a(Yii::t('app', 'Premium'), '#', [
                    'value' => Url::to(['/account/car/premium', 'id' => $model->id]),
                    'form' => '',
                    'title' => Yii::t('app', 'Уважаемый') . ' ' . $model->owner->profile->fio . ',',
                    'class' => 'btn btn-danger showPremiumModalButton'
                ]);
                ?>
                <a href="<?= Url::to(['/account/car/update', 'id' => $model->id]) ?>" class="btn btn-default"><?= Yii::t('app', 'Edit') ?></a>
                <a href="<?= Url::to(['/account/car/delete', 'id' => $model->id]) ?>" class="btn btn-default"
                   title = "<?= Yii::t('yii', 'Delete') ?>"
                   aria-label = "<?= Yii::t('yii', 'Delete') ?>"
                   data-confirm = "<?= Yii::t('yii', 'Delete') . ' ' . $model->getTname() . ' ' . $model->engine_displacement . ' '. Yii::t('value', 'л.') .' ' . $model->issue_date . '?' ?>"
                   data-method = "post"
                   data-pjax = "0"><?= Yii::t('app', 'Delete') ?></a>
                <button type="button" class="btn btn-default" onclick="up(<?= $model->id ?>)"><?= Yii::t('app', 'Upping') ?></button>
            </div>
        </div>
    </div>
</div>
