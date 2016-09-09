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
        'id' => 'wheels-update-form',
        'action' => ['/car-type/wheels-update', 'id' => $model->id],
        'options' => [
            'data-pjax' => '1'
        ]
    ]);
?>
<?=

$form->field($model, 'tagWheels')->widget(SelectizeTextInput::className(), [
    'loadUrl' => ['/car-type/wheels-list'],
    'options' => [
        'class' => 'form-control',
        'placeholder' => Yii::t('app', 'Select or create new wheel ...')
    ],
    'clientOptions' => [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ],
])->hint(Yii::t('app', 'Use commas to separate wheels names'))->label(false)
?>
<?php ActiveForm::end(); ?>
