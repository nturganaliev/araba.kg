<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CarModelQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => 'Car Model',
            ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Car type',
                'value' => 'marka.carType.name',
            ],
            [
                'attribute' => 'marka_id',
                'value' => 'marka.name',
            ],
            [
                'attribute' => 'seria',
                'value' => 'seriaName',
            ],
            'is_seria:boolean',
            'name',
            // 'created_by',
            // 'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
