<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('app', 'Admin panel');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>


                </div>
                <div class="panel-footer">
                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>


                    <?php ActiveForm::end(); ?>
                    <div class="clearfix"></div>
                </div>

            </div>

        </div>
    </div>
</div>
