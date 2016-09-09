<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Automobiles');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-2">
        <?php echo $this->render('_sidebar'); ?>
    </div>
    <div class="col-lg-10">
        <?php
        echo $this->render('_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
        ?>
    </div>
</div>