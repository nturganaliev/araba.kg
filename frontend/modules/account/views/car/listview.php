<?php

use yii\widgets\ListView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cars list');
$this->registerJs("
    $('document').ready(function(){
        $('#premium_form').on('pjax:end', function() {
            $.pjax.reload({container:'#cars_list'});
        });
    });
    ", \yii\web\View::POS_END);
?>

<?php
yii\widgets\Pjax::begin([
    'id' => 'cars_list',
//    'options' => ['class' => 'pjax-wraper']
]);
?>
<br>
<div class="car-index">
    <div class="row">
        <div class="col-sm-4">
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
                    <?= yii::t('app', 'Cars') ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Settings'), \yii\helpers\Url::to('/account/settings')) ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Refill balance'), \yii\helpers\Url::to('/account/refill-balance')) ?>
                </li>
            </ul>
        </div>

        <div class="col-sm-20">
            <div>
                <div class="well well-sm pull-right">
                    <?= Yii::t('app', 'Your account number') ?>: <?= $user->profile->user_id ?>
                    <br>
                    <?= Yii::t('app', 'Your balance') ?>: <?= $user->profile->balance ?> <?= Yii::t('app', 'сом') ?>
                </div>
                <span class="pull-left" style="font-size: 18px; color: #0a0a0a;">
                    <br><br><br><?= Yii::t('app', 'Auto') ?>
                </span>
                <div class="clearfix"></div>
            </div>
            <hr style="margin: 0px;">
            <?php
            $sort = $dataProvider->sort;
            ?>
            <br/>
            <p class="pull-right" style="font-size: 13px;">
                <?= $sort->link('created_at') . ' | ' . $sort->link('price') . ' | ' . $sort->link('issue_date'); ?>
            </p>
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_itemview',
                'separator' => "<hr style='margin: 1px'>",
                'layout' => "<div style='font-size: 13px;'>{summary}</div>\n{items}\n<div class='pagination-wrapper'>{pager}</div>",
            ]);
            ?>
        </div>
    </div>
</div>

<?php yii\widgets\Pjax::end(); ?>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'premiumModal',
    'size' => 'modal-md',
    'footerOptions' => ['id' => 'modalFooter'],
    'footer' => '<button id="modalSubmitButton" type="submit" class="btn btn-primary" form="">' . Yii::t('app', 'Save') . '</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">' . Yii::t('app', 'Close') . '</button>',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
yii\widgets\Pjax::begin([
    'id' => 'premium_form',
    'enablePushState' => false,
]);

echo "<div id='modalContent'></div>";

yii\widgets\Pjax::end();
yii\bootstrap\Modal::end();
?>
