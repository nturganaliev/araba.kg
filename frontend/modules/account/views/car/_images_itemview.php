<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="col-sm-6">

    <?php
    echo Yii::$app->imageCache->thumb($model->getFilePath(), 'medium', [
        'class' => 'img-responsive adv-image-list-item'
    ])
    ?>
    <div>
        <?php if ($model->is_main): ?>
            <label class="label label-success"><?= Yii::t('app', 'Main picture') ?></label>
        <?php else: ?>
            <span>
                <?=
                Html::a(Yii::t('app', 'Main picture'), ['/account/car/make-main', 'id' => $carId, 'imageId' => $model->id], [
                    'data-pjax' => 1,
                ])
                ?>
            </span>
            <span class="pull-right">
                <?=
                Html::a(Yii::t('app', 'Delete'), ['/account/car/delete-image', 'id' => $model->id], [
                    'data-pjax' => 1,
                ])
                ?>
            </span>
        <?php endif; ?>

    </div>
</div>
