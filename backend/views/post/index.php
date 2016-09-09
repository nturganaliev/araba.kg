<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Texts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Text'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'value' => function($model) {
                    $items = [];
                    foreach ($model->mposts as $mpost) {
                        $items[] = Html::a($mpost->lang, ['/post/mpost-update', 'id' => $model->id, 'lang' => $mpost->lang]);
                    }

                    return implode(' ', $items);
                },
                    'format' => 'html',
                ],
                // 'updated_at',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>

</div>
