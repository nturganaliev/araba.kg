<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
        $("#comment-form-pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#comments-list"});  //Reload GridView
        });
    });'
);
?>

<div class="comment-form">
    <div class="col-sm-24">
        <?php
        Pjax::begin([
            'id' => 'comment-form-pjax',
            'enablePushState' => false,
        ]);
        $form = ActiveForm::begin([
                'id' => 'comment-form',
                'action' => ['/car/view', 'id' => $carId],
                'layout' => 'horizontal',
                'options' => [
                    'data-pjax' => true,
                ],
        ]);
        ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="pull-right">
                    <label class="control-label pull-left"><?= Yii::t('app', 'Message') ?></label>
                </div>
            </div>
            <div class="col-sm-13">
                <div class="message-content" style="margin-left: 0px;">
                    <textarea id="comment-message" class="message-content-area" name="Comment[message]" maxlength="100"></textarea>
                </div>
            </div>
            <div class="col-sm-5">
                <?= Html::submitButton(Yii::t('app', 'Опубликовать'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="clearfix"></div>
    <p>&nbsp;</p>
</div>
