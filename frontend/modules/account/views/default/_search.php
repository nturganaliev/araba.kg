<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AutomobileQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automobile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'marka_id') ?>

    <?= $form->field($model, 'model_id') ?>

    <?= $form->field($model, 'wheel_id') ?>

    <?php // echo $form->field($model, 'kuzov_id') ?>

    <?php // echo $form->field($model, 'privod_id') ?>

    <?php // echo $form->field($model, 'transmission_id') ?>

    <?php // echo $form->field($model, 'engine_id') ?>

    <?php // echo $form->field($model, 'engine_displacement') ?>

    <?php // echo $form->field($model, 'color_id') ?>

    <?php // echo $form->field($model, 'state_id') ?>

    <?php // echo $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'issue_date') ?>

    <?php // echo $form->field($model, 'run_length') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'premium_date') ?>

    <?php // echo $form->field($model, 'rent')->checkbox() ?>

    <?php // echo $form->field($model, 'rent_price') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
