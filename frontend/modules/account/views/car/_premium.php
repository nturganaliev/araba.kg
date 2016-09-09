<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\Automobile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automobile-form">
    <p>
        <?php
        $premiumDescription = \common\models\Post::find()
                ->where(['like', 'name', 'Условия премиума'])->one();
        if ($premiumDescription != NULL) {
            foreach ($premiumDescription->mposts as $post) {
                if ($post->lang == Yii::$app->language) {
                    echo $post->body;
                }
            }
        } else {
            echo Yii::t('app', 'Не найден текст');
        }
        ?>
    </p>

    <?php
    $form = ActiveForm::begin([
            'id' => 'payment-form',
            'options' => [
                'data-pjax' => true
            ],
    ]);
    ?>
    <div class="form-group">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <?php foreach ($tarrifs as $tarrif): ?>
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-default"
                            name="tarrif" value="<?= $tarrif->id ?>">
                                <?= "{$tarrif->title}={$tarrif->price} сом" ?>
                    </button>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

    <?php
    ActiveForm::end();
    ?>
</div>
