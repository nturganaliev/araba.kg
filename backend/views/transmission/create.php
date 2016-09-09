<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Transmission */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Transmission',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transmissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transmission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
