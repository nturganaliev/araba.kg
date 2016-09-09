<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChangeEmployeePasswordForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="password-change-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'update-password-form',
                'enableClentValidtaion' => true,
            ]
    ]);
    ?>

    <?=
    $form->field($model, 'newPassword')->input('password');
    ?>
    <?=
    $form->field($model, 'repeatPassword')->input('password')
    ?>
    <?php
    ActiveForm::end();
    ?>

</div>
