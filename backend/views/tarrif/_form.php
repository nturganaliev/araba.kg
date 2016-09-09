<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Tarrif;

/* @var $this yii\web\View */
/* @var $model common\models\Tarrif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarrif-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'create-tarrif-form',
                'enableClentValidtaion' => true,
            ]
    ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'day_count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?=
    $form->field($model, 'status')->dropDownList(Tarrif::getStatusOptions(), [
        'prompt' => Yii::t('app', 'Select'),
    ])
    ?>

    <?php ActiveForm::end(); ?>

</div>
