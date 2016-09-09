<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Privod */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Privod',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
