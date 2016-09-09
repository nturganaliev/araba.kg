<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\account\models\ChangePasswordForm */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="password-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'update-user-password-form',
            'action' => ['/account/update-password'],
    ]);
    echo $form->field($model, 'oldPassword')->passwordInput(['placeholder' => Yii::t('app', 'Current password')]);
    echo $form->field($model, 'newPassword')->passwordInput(['placeholder' => Yii::t('app', 'New password')]);
    echo $form->field($model, 'repeatPassword')->passwordInput(['placeholder' => Yii::t('app', 'Repeat new password')]);

    ActiveForm::end();
    ?>

</div>