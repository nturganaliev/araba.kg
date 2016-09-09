<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\account\models\UserSettings */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'update-user-settings-form',
            'action' => ['/account/update-settings'],
    ]);
    if ($model->type == \common\models\UserProfile::CLIENT_TYPE_LEG) {
        echo $form->field($model, 'companyName');
        echo $form->field($model, 'workPhone');
    }
    ?>
    <?= $form->field($model, 'fio') ?>
    <?= $form->field($model, 'mobilePhone') ?>

    <?php ActiveForm::end(); ?>

</div>

