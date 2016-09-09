<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupFormLegalClient */
?>
<?php
$form = ActiveForm::begin([
        'id' => 'individual-signup',
        'layout' => 'horizontal',
        'action' => ['site/signup', 'type' => 0],
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-10',
                'offset' => 'col-sm-offset-10',
                'wrapper' => 'col-sm-14',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]);
?>
<?= $form->field($model, 'fio') ?>
<?= $form->field($model, 'mobilePhone') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'password_repeat')->passwordInput() ?>
<?= $form->field($model, 'using_rules')->checkbox()->label(Yii::t('app', 'I agree with the') . '<a href="#using-rule-modal" data-toggle="modal"> ' . Yii::t('app', 'Terms of use') . '</a>') ?>

<?= Html::submitButton(yii::t('app', 'Signup'), ['class' => 'btn btn-primary pull-right', 'name' => 'signup-button']) ?>
<div class="clearfix"></div>
<?php ActiveForm::end(); ?>
