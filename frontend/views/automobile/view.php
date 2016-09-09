<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Automobile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Automobiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="automobile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type_id',
            'marka_id',
            'model_id',
            'wheel_id',
            'kuzov_id',
            'privod_id',
            'transmission_id',
            'engine_id',
            'engine_displacement',
            'color_id',
            'state_id',
            'region_id',
            'price',
            'issue_date',
            'run_length',
            'description:ntext',
            'premium_date',
            'rent:boolean',
            'rent_price',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
