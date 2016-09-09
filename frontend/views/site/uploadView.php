<?php

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'file[]')->fileInput(['multiple' => true]);
?>
<button>Submit</button>

<?php ActiveForm::end() ?>