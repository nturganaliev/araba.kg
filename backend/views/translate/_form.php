<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Zelenin\yii\modules\I18n\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="translate-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'create-translate-form',
                'enableClentValidtaion' => true,
            ]
    ]);
    ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => 255]) ?>

    <?php ActiveForm::end(); ?>

</div>
