<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kuzov */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Kuzov',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kuzovs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kuzov-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
