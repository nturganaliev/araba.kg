<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\timeago\TimeAgo;
use common\models\Banner;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Search results page');
?>
<div class="car-index">

    <p style="display: none;"><?=
        TimeAgo::widget([
            'timestamp' => date(DATE_ISO8601, time()),
            'language' => 'ru',
        ]);
        ?></p>
    <div class="row">
        <div class="col-sm-19">
            <?php
            echo $this->render('/car/_searchExtended', [
                'modelAutomobile' => $modelAutomobile,
                'modelBus' => $modelBus,
                'modelLorry' => $modelLorry,
                'modelMoto' => $modelMoto,
                'modelSQ' => $modelSQ,
                'type' => $type,
                'rent' => $rent
            ]);

            echo $this->render('_listview', [
                'dataProvider' => $dataProvider
            ]);
            ?>
        </div>
        <div class="col-sm-5">

            <?php
            foreach (Banner::find()->where('page=:page', [
                ':page' => Banner::PAGE_SEARCH_RESULT])->active()->all() as $imageModel):
                ?>
                <?php $imageUrl = "http://admin.araba.kg/uploads/{$imageModel->image}"; ?>
                <p>
                    <?=
                    Html::a(Html::img($imageUrl, ['class' => 'img-responsive']), $imageModel->url, [
                        'target' => '_blank'
                    ]);
                    ?>
                </p>
            <?php endforeach; ?>

        </div>
    </div>
    <?php ?>

</div>
