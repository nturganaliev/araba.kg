<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CarModel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
           'class' => 'btn btn-danger',
           'data' => [
              'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
              'method' => 'post',
           ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
       'model' => $model,
       'attributes' => [
          'id',
          [
             'label' => 'marka_id',
             'value' => $model->marka->name,
          ],
          [
             'label' => 'seria',
             'value' => $model->seriaName,
          ],
          'is_seria:boolean',
          'name',
       ],
    ])
    ?>

</div>
