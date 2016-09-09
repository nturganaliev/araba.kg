<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CarTypeQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-type-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($data) {
                    return Html::a($data->name, ['/car-type/view', 'id' => $data->id]);
                }
                ]
            ],
        ]);
        ?>

</div>
