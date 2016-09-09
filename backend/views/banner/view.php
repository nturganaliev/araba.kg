<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = $model->id;
?>
<div class="banner-view">
    <div class="row">
        <div class="col-sm-7">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'page',
                        'value' => $model->getPageText()
                    ],
                    'url:url',
                    'position',
                    [
                        'attribute' => 'status',
                        'value' => $model->getStatusText()
                    ]
                ],
            ])
            ?>


        </div>
        <div class="col-sm-5">
            <?= Yii::$app->imageCache->thumb($model->getFilePath(), 'medium', ['class' => 'img-thumbnail img-responsive']) ?>
        </div>
    </div>

</div>
