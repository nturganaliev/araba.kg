<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Mpost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpost-form">
    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($model, 'post_id')->hiddenInput()->label(false);
//            $form->field($model, 'post_id')->dropDownList(ArrayHelper::map(common\models\Post::find()->all(), 'id', 'name'), [
//                'prompt' => Yii::t('app', 'Select post')
//            ])
    ?>

    <?=
    $form->field($model, 'lang')->hiddenInput()->label(false);
    ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'body')->widget(CKEditor::className(), [
        'options' => ['rows' => 10],
        'preset' => 'basic'
    ])
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

</div>

<?php ActiveForm::end(); ?>

</div>
