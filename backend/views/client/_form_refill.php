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
        $("#refill-form-pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#payments-list", async:false});
            $.pjax.reload({container:"#user-detail", async:false});
        });
    });'
);
?>

<div class="payment-form">
    <div class="col-sm-12">
        <?php
        Pjax::begin([
            'id' => 'refill-form-pjax',
            'enablePushState' => false,
        ]);
        $form = ActiveForm::begin([
                'id' => 'refill-form',
                'action' => ['/client/refill', 'id' => $clientId],
                'layout' => 'horizontal',
                'options' => [
                    'data-pjax' => true,
                ],
        ]);
        ?>
        <div class="pull-right">
            <label class="control-label col-sm-5" for="transaction-amount">Amount Amount Amount </label>
            <div class="col-sm-5">
                <input type="number" id="transaction-amount" class="form-control" name="Transaction[amount]">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-success">Пополнить</button>
            </div>

        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="clearfix"></div>
</div>
