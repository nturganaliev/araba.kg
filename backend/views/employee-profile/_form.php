<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Office;
use backend\models\EmployeeProfile;

/* @var $this yii\web\View */
/* @var $model backend\models\EmployeeProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'update-profile-form',
                'enableClentValidtaion' => true,
            ]
    ]);
    ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'fio')->textInput(['maxlength' => 100]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => 20]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'office_id')->dropDownList(ArrayHelper::map(Office::find()->orderBy('name')->all(), 'id', 'name'), [
                'prompt' => Yii::t('app', 'Select ...'),
            ])
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'role')->dropDownList(EmployeeProfile::getRolesOptions()) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
