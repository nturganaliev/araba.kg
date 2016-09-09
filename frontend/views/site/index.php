<?php

use common\models\Banner;
use common\models\Partner;
use yii\helpers\Url;
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;

/* @var $this yii\web\View */
/* @var $model common\models\AutomobileQuery */
/* @var $model common\models\BusQuery */
/* @var $model common\models\LorryQuery */
/* @var $model common\models\MotocycleQuery */
/* @var $model common\models\SpecialEquipmentQuery */

$this->title = Yii::t('app', 'araba.kg - онлайн авто базар - купить, продать и обменять авто. Кыргызстан');


$this->registerJs("
    $('.partner').hover( function () {
        $(this).toggleClass('partner_img');
    });
    ", yii\web\View::POS_END);
?>

<div class="row">
    <div class='col-sm-24'>
        <hr>
    </div>

</div>
<div class="row">
    <div class="col-sm-19">
        <div class="row">
            <div class="col-sm-24">
                <p align='center'>
                    <?php
                    $imageModel = Banner::find()->where(['position' => 2, 'page' => Banner::PAGE_MAIN])->active()->one();
                    if ($imageModel != null) {
                        $imageUrl = Yii::getAlias('@admin_url') . "/uploads/{$imageModel->image}";
                        echo Html::a(Html::img($imageUrl, ['class' => 'img-responsive']), $imageModel->url, [
                            'target' => '_blank'
                        ]);
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-24">
                <?php
                echo $this->render('/car/_mainpage', [
                    'models' => \common\models\Car::getHighRated()
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-24">
                <p class="pull-right">
                    <a href="<?= Url::to(['/car', 'type' => 1]) ?>">
                        <?= Yii::t('app', 'Show all') ?>
                    </a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-24 col-md-24 col-sm-24">
                <?php
                $partners = Partner::find()->where('status=:status', [
                        ':status' => Partner::STATUS_ACTIVE
                    ])->all();
                if ($partners != NULL) {
                    echo Html::tag('h4', Yii::t('app', 'Our partners'));
                    $items = [];
                    foreach ($partners as $partnerModel) {
                        $imageUrl = Yii::getAlias('@admin_url') . "/uploads/{$partnerModel->image}";
                        $items[] = Html::a(Html::img($imageUrl, [
                                    'class' => 'partner img-responsive partner_img',
                                    'style' => 'height: 40px',
                                ]), $partnerModel->url, [
                                'target' => '_blank',
                        ]);
                    }
                    if ($items != null) {
                        echo Slick::widget([
                            'itemContainer' => 'div',
                            // HTML attributes for widget container
                            // 'containerOptions' => ['class' => 'row'],
                            // Items for carousel. Empty array not allowed, exception will be throw, if empty
                            'items' => $items,
                            // HTML attribute for every carousel item
                            'itemOptions' => [
                                'class' => 'col-lg-4'
                            ],
                            // settings for js plugin
                            // @see http://kenwheeler.github.io/slick/#settings
                            'clientOptions' => [
                                'autoplay' => true,
                                'dots' => false,
                                'arrows' => false,
                                // 'centerMode' => true,
                                'slidesToShow' => 4,
                                'slidesToScroll' => 1,
                            // note, that for params passing function you should use JsExpression object
                            // 'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                            ],
                        ]);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <?php
        foreach (Banner::find()->where('page=:page and position>:position', [
            ':page' => Banner::PAGE_MAIN, ':position' => 2])->active()->all() as $imageModel) {
            $imageUrl = Yii::getAlias('@admin_url') . "/uploads/{$imageModel->image}";
            echo "<p>";
            echo Html::a(Html::img($imageUrl, [
                    'class' => 'img-responsive',
                ]), $imageModel->url, [
                'target' => '_blank',
            ]);
            echo "</p>";
        }
        ?>
    </div>
</div>