<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $owner common\models\User */
?>

<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="color: orange;" class="fa fa-angle-right"></span> <span style="font-size: 16px"><?= Yii::t('app', 'Contact') ?></span>
            </div>
            <div class="panel-body">
                <?php if ($owner->profile->client_type == 1) {?><b><?= $owner->profile->company_name ?></b><br><?php }?>
                <?= $owner->profile->fio ?><br>
                <?= isset($owner->profile->work_phone) ? $owner->profile->work_phone.'<br>' : ''?>
                <?= $owner->profile->mobile_phone ?><br>
                <?php
                $count = \common\models\Car::find()
                    ->where(['created_by' => $owner->profile->id])
                    ->count();
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-20">
        <?php
        Pjax::begin();
        echo $this->render('_listview', [
            'dataProvider' => $dataProvider
        ]);
        Pjax::end();
        ?>

    </div>
</div>
