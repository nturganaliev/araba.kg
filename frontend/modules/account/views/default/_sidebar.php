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
        <?= \yii\helpers\Html::a(yii::t('app', 'Refill balance'), \yii\helpers\Url::to('/account/refill_balance')) ?>
    </li>
</ul>
