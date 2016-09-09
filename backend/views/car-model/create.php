<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CarModel */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Car Model',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
