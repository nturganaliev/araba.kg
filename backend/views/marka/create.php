<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Marka */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Marka',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Markas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
