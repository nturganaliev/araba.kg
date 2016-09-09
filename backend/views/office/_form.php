<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Office */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="office-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'create-office-form',
                'enableClentValidtaion' => true,
            ]
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>


    <?php ActiveForm::end(); ?>

</div>
