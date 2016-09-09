<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use common\models\Marka;

/* @var $this yii\web\View */
/* @var $model common\models\CarModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-model-form">

    <?php ini_set( 'memory_limit', '512M' );
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marka_id')->dropDownList(ArrayHelper::map(Marka::find()->all(), 'id', 'name', 'carType.name'), ['id' => 'marka-id']) ?>

    <?=
    $form->field($model, 'seria')->widget(DepDrop::classname(), [
        'options' => ['id' => 'seria-id'],
        'data' => ($model->isNewRecord) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'name'),
        'pluginOptions' => [
            'depends' => ['marka-id'],
            'placeholder' => 'Select...',
            'url' => yii\helpers\Url::to(['/car-model/series'])
        ]
    ]);
    ?>

    <?= $form->field($model, 'is_seria')->checkbox() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
