<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Partner;

/* @var $this yii\web\View */
/* @var $model common\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'create-partner-form',
                'enableClentValidtaion' => true,
                'enctype' => 'multipart/form-data'
            ]
    ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'url')->input('url', ['maxlength' => 255]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?=
    $form->field($model, 'status')->dropDownList(Partner::getStatusOptions(), [
        'prompt' => Yii::t('app', 'Select'),
    ])
    ?>

    <?php ActiveForm::end(); ?>

</div>
