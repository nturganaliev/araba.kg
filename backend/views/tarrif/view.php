<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tarrif */

$this->title = $model->title;
?>
<div class="tarrif-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'day_count',
            'price',
            'description',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ])
    ?>

</div>
