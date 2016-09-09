<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MotoType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Moto Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moto Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moto-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
