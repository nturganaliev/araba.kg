<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
        var unsaved = false;

        $(":input").change(function(){ //triggers change in all input fields including text type
            unsaved = true;
        });

        $("#btn_finish").click(function(){
            if (unsaved) {
                if (confirm("'. Yii::t('app','You have unsaved images. Continue anyway?') .'")) {
                    window.location.href="'. \yii\helpers\Url::to(['/account/car/view', 'id' => $carId]) .'";
                }
            } else {
                window.location.href="'. \yii\helpers\Url::to(['/account/car/view', 'id' => $carId]) .'";
            }
        });
    });'
);
?>

<div class="automobile-form">
    <?php
    $form = ActiveForm::begin([
//          'layout' => '',
            'action' => ['/account/car/image-upload'],
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
            'fieldConfig' => [
//                'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-4">{error}</div>',
//                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-4',
                    'error' => '',
                    'hint' => '',
                ],
            ],
    ]);
    ?>
    <div class="form-group">
        <?=
        Html::activeHiddenInput($model, 'car_id');
        ?>
        <br>
        <br>
        <br>
        <?php
        echo $form->field($model, 'images[]', [
            'options' => [
                'class' => 'col-sm-24'
            ],
        ])->widget(FileInput::classname(), [
            'options' => [
//                    'accept' => 'image/*',
                'multiple' => true,
            ],
            'pluginOptions' => [
//                'showUpload' => true,
                'uploadClass' => 'btn btn-success',
//                'uploadUrl' => \yii\helpers\Url::to(['/account/car/image-upload', 'id' => $model->car_id]),
                'fileUpload' => false,
                'maxFileCount' => 15,
                'initialPreviewShowDelete' => true,
                'allowedFileTypes' => [
                    'image'
                ]
            ]
        ])->label(Yii::t('app','Select pictures to upload'))->hint(Yii::t('app', '*Max allowed pictures count'));
        ?>

        <div class="form-group">
            <div class="col-lg-24 col-md-24 col-sm-24">
                <p class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-primary" id="btn_finish">
                        <?=Yii::t('app', 'Complete')?>
                    </a>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

