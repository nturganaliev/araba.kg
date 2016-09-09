<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Wheel */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Wheel',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wheels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wheel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
