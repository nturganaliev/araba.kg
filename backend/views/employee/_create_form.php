<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Employee;
use backend\models\EmployeeProfile;
use backend\models\Office;

/* @var $this yii\web\View */
/* @var $model backend\models\EmployeeCreateForm */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
    '$("document").ready(function(){
        $("#new_user").on("pjax:end", function() {
            $.pjax.reload({container:"#users"});  //Reload GridView
        });
    });'
);
?>

<div class="user-form">

    <?php
    yii\widgets\Pjax::begin([
        'id' => 'new_user',
    ]);
    $form = ActiveForm::begin([
            'id' => 'new_user_form',
            'options' => ['data-pjax' => true]
    ]);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?=
            $form->field($model, 'email')->textInput()
            ?>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'password')->input('password');
            ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'password_repeat')->input('password')
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'fio')->textInput()
            ?>

        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'phone')->textInput()
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?=
            $form->field($model, 'office')->dropDownList(ArrayHelper::map(Office::find()->all(), 'id', 'name'), [
                'prompt' => Yii::t('app', 'Select office ...'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'role')->dropDownList(EmployeeProfile::getRolesOptions(), [
                'prompt' => Yii::t('app', 'Select role ...'),
            ])
            ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'status')->dropDownList(Employee::getStatusOptions(), [
                'prompt' => Yii::t('app', 'Select status ...'),
            ])
            ?>
        </div>
    </div>

    <?php
    ActiveForm::end();
    yii\widgets\Pjax::end();
    ?>

</div>
