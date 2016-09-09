<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MotoTypeQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Moto Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moto-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => 'Moto Type',
            ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        return Html::a(Html::encode($model->name . ' kdkskskksksk '), ['view', 'id' => $model->id]);
    }
    ]);
    ?>

</div>
