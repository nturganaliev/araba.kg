<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;

/* @var $this yii\web\View */
/* @var $model common\models\CarType */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

$form = ActiveForm::begin([
        'id' => 'engines-update-form',
        'action' => ['/car-type/engines-update', 'id' => $model->id],
        'options' => [
            'data-pjax' => '1'
        ]
    ]);
?>
<?=

$form->field($model, 'tagEngines')->widget(SelectizeTextInput::className(), [
    'loadUrl' => ['/car-type/engines-list'],
    'options' => [
        'class' => 'form-control',
        'placeholder' => Yii::t('app', 'Select or create new engine ...')
    ],
    'clientOptions' => [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ],
])->hint(Yii::t('app', 'Use commas to separate engines names'))->label(false)
?>
<?php ActiveForm::end(); ?>
