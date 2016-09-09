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
        'id' => 'kuzovs-update-form',
        'action' => ['/car-type/kuzovs-update', 'id' => $model->id],
        'options' => [
            'data-pjax' => '1'
        ]
    ]);
?>
<?=

$form->field($model, 'tagKuzovs')->widget(SelectizeTextInput::className(), [
    'loadUrl' => ['/car-type/kuzovs-list'],
    'options' => [
        'class' => 'form-control',
        'placeholder' => Yii::t('app', 'Select or create new kuzov ...')
    ],
    'clientOptions' => [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ],
])->hint(Yii::t('app', 'Use commas to separate kuzov names'))->label(false)
?>
<?php ActiveForm::end(); ?>
