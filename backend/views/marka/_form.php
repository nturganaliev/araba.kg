<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\CarType;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Marka */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marka-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'car_type_id')->dropDownList(ArrayHelper::map(CarType::find()->all(), 'id', 'name'), [
        'prompt' => 'Select ...',
    ])
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
