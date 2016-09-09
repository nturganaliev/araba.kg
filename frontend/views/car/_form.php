<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(\common\models\CarType::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'marka_id')->dropDownList(ArrayHelper::map(\common\models\Marka::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'model_id')->dropDownList(ArrayHelper::map(\common\models\CarModel::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'wheel_id')->dropDownList(ArrayHelper::map(\common\models\Wheel::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'kuzov_id')->dropDownList(ArrayHelper::map(\common\models\Kuzov::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'privod_id')->dropDownList(ArrayHelper::map(\common\models\Privod::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'transmission_id')->dropDownList(ArrayHelper::map(\common\models\Transmission::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'engine_id')->dropDownList(ArrayHelper::map(\common\models\Engine::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'engine_displacement')->textInput() ?>

	<?= $form->field($model, 'color_id')->dropDownList(ArrayHelper::map(\common\models\Color::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'state_id')->dropDownList(ArrayHelper::map(\common\models\State::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'name')) ?>

	<?= $form->field($model, 'price')->textInput() ?>

	<?= $form->field($model, 'issue_date')->textInput() ?>

	<?= $form->field($model, 'run_length')->textInput() ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'premium_date')->textInput() ?>

	<?= $form->field($model, 'rent')->checkbox() ?>

	<?= $form->field($model, 'rent_price')->textInput() ?>

	<?= $form->field($model, 'created_by')->textInput() ?>

	<?= $form->field($model, 'updated_by')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
