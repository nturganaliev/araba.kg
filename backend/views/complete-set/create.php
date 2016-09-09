<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CompleteSet */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Complete Set',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complete Sets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complete-set-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
