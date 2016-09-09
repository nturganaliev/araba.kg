<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'create-banner-form',
                'enableClentValidtaion' => true,
                'enctype' => 'multipart/form-data'
            ]
    ]);
    ?>

    <?=
    $form->field($model, 'page')->dropDownList(common\models\Banner::getPageOptions(), [
        'prompt' => 'Выберите страницу'
    ])
    ?>

    <?=
    $form->field($model, 'url')->input('url', [
        'maxlength' => 255,
    ])
    ?>

    <?= $form->field($model, 'image')->fileInput() ?>


    <?=
    $form->field($model, 'status')->dropDownList(common\models\Banner::getStatusOptions(), [
        'prompt' => 'Выберите статус'
    ])
    ?>

    <?php ActiveForm::end(); ?>

</div>
