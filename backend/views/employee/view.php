<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = $model->id;
?>
<div class="user-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'fio',
                'value' => $model->profile->fio,
            ],
            [
                'attribute' => 'role',
                'value' => $model->profile->getRoleText(),
            ],
            'email:email',
            [
                'attribute' => 'phone',
                'value' => $model->profile->phone,
            ],
            [
                'attribute' => 'office',
                'value' => $model->profile->office->name,
            ],
            [
                'attribute' => 'office_address',
                'value' => $model->profile->office->address,
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusText(),
            ],
        ],
    ])
    ?>

</div>
