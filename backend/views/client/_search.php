<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php
    $form = ActiveForm::begin([
            'id' => 'client-search-form',
            'action' => ['index'],
            'method' => 'get',
    ]);
    ?>
    <div class="row">
        <?=
        $form->field($model, 'user_id', [
            'options' => [
                'class' => 'col-sm-2'
            ]
        ])
        ?>
        <?=
        $form->field($model, 'email', [
            'options' => [
                'class' => 'col-sm-2'
            ]
        ])
        ?>

        <?=
        $form->field($model, 'fio', [
            'options' => [
                'class' => 'col-sm-3'
            ]
        ])
        ?>

        <?=
        $form->field($model, 'company_name', [
            'options' => [
                'class' => 'col-sm-3'
            ]
        ])
        ?>
        <?=
        $form->field($model, 'client_type', [
            'options' => [
                'class' => 'col-sm-2'
            ]
        ])->dropDownList(common\models\UserProfile::getTypeOptions(), [
            'prompt' => Yii::t('app', 'Select ...')
        ])
        ?>
    </div>





    <?php // echo $form->field($model, 'work_phone') ?>

    <?php // echo $form->field($model, 'client_type')  ?>

    <?php // echo $form->field($model, 'created_at')  ?>

    <?php // echo $form->field($model, 'updated_at')   ?>

    <?php ActiveForm::end(); ?>

</div>
