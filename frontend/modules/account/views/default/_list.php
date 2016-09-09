<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="automobile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => 'Automobile',
            ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'type_id',
            'marka_id',
            'model_id',
            'wheel_id',
            // 'kuzov_id',
            // 'privod_id',
            // 'transmission_id',
            // 'engine_id',
            // 'engine_displacement',
            // 'color_id',
            // 'state_id',
            // 'region_id',
            // 'price',
            // 'issue_date',
            // 'run_length',
            // 'description:ntext',
            // 'premium_date',
            // 'rent:boolean',
            // 'rent_price',
            // 'created_by',
            // 'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
