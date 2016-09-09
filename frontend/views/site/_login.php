<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
?>
<div class="site-login">
    <?php
    $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'action' => ['site/login'],
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
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group field-loginform-password">
        <div class="col-sm-14 col-sm-offset-10">
            <?= Html::a(yii::t('app', 'forgotPassword'), ['site/request-password-reset']) ?>.
        </div>
    </div>

</div>
<div>
    <?= Html::submitButton(yii::t('app', 'Login'), ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>
