<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CarModelQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-model-search">

    <?php
    $form = ActiveForm::begin([
          'action' => ['index'],
          'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'marka_id') ?>

    <?= $form->field($model, 'seria')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\CarModel::findMergedNames(), 'id', 'name'), ['prompt' => 'Select model ...', 'encodeSpaces' => true]) ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
