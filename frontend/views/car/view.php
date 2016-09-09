<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use nirvana\prettyphoto\PrettyPhoto;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use common\models\CommentQuery;
use common\models\Comment;
use common\models\Banner;

/* @var $this yii\web\View */
/* @var $model common\models\Car */
/* @var $sets array */

$this->title = $model->id;
?>
<p>&nbsp;</p>
<div class="car-view">
    <div class="row">
        <div class="col-lg-24">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="row">
                        <div class="col-lg-24">
                            <div id="image-container" align="center" valign="">
                                <?php
                                echo Html::a(Yii::$app->imageCache->thumb($model->mainImagePath, 'medium', [
                                        'class' => 'img-responsive img-gal',
                                    ]), $model->mainImageUrl, [
                                    'rel' => 'prettyPhoto[pp_gal]'
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-24">
                            <?php
                            PrettyPhoto::widget([
                                'target' => "a[rel^='prettyPhoto']",
                                'pluginOptions' => [
                                    'opacity' => 0.60,
                                    'theme' => PrettyPhoto::THEME_LIGHT_SQUARE,
                                    'social_tools' => false,
                                    'autoplay_slideshow' => false,
                                    'modal' => false,
                                    'allow_resize' => true,
                                    'default_height' => 350,
                                ],
                            ]);

                            $items = [];

                            foreach ($model->uploadedImages as $image) {
                                $items[] = Html::a(Yii::$app->imageCache->thumb($image->getFilePath(), 'thumb', [
                                            'class' => 'img-responsive'
                                        ]), $image->largeFilePath, [
                                        'rel' => 'prettyPhoto[pp_gal]'
                                ]);
                            }
                            if (count($items) == 0) {
                                $items[] = Html::a(Yii::$app->imageCache->thumb($model->getMainImagePath(), 'thumb', [
                                            'class' => 'img-responsive'
                                        ]), $model->getMainImagePath(), [
                                        'rel' => 'prettyPhoto[pp_gal]'
                                ]);
                            }

                            echo Slick::widget([

                                'id' => 'gallery',
                                // HTML tag for container. Div is default.
                                'itemContainer' => 'div',
                                // HTML attributes for widget container
                                'containerOptions' => [
                                    'class' => 'gallery-container',
                                ],
                                // Items for carousel. Empty array not allowed, exception will be throw, if empty
                                'items' => $items,
                                // HTML attribute for every carousel item
                                'itemOptions' => [
                                    'class' => 'img-thumb-car'
                                ],
                                // settings for js plugin
                                // @see http://kenwheeler.github.io/slick/#settings
                                'clientOptions' => [
                                    'autoplay' => false,
                                    'dots' => false,
                                    'arrows' => true,
//                                    'centerMode' => true,
                                    'slidesToShow' => 3,
                                    'slidesToScroll' => 1,
                                // note, that for params passing function you should use JsExpression object
//                                    'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                                ],
                            ]);
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <span class="fa fa-angle-right" style="color: orange;"></span> <strong style="font-size: 15px"><?= Yii::t('app', 'Contact') ?>:</strong><br>
                                    <?php if ($model->owner->profile->client_type == 1) {?><b><?= $model->owner->profile->company_name ?></b><br><?php }?>
                                    <?= $model->owner->profile->fio ?><br>
                                    <?= isset($model->owner->work_phone) ? $model->owner->work_phone.'<br>' : ''?>
                                    <?= $model->owner->profile->mobile_phone ?><br>
                                    <?= $model->owner->email ?><br>
                                    <?= $model->region->tname ?><br>
                                    <?php
                                    $count = \common\models\Car::find()
                                        ->where(['created_by' => $model->owner->profile->id])
                                        ->count();
                                    ?>
                                    <?= Html::a(Yii::t('app', 'Posts') . ": {$count}", ['/car/owner', 'id' => $model->owner->profile->id]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'template' => "<tr><td>{value}</td></tr>",
                        'options' => [
                            'class' => 'detail-view'
                        ],
                        'attributes' => [
                            [
                                'format' => 'html',
                                'attribute' => 'marka_id',
                                'value' => "<span style='font-size: 20px;'>{$model->tname} {$model->engine_displacement}". Yii::t('value', 'л.') ." ". Yii::t('value', 'за') ." <span style='color: #bc0004; '>" . ($model->price ? number_format($model->price) . Yii::t('value', 'KGS') : Yii::t('value', 'price negotiable')) ."</span></span></span>"
                            ],
                            [
                                'attribute' => 'transmission_id',
                                'value' => "{$model->issue_date} / {$model->transmission->tname} / ". ($model->kuzov ? $model->kuzov->tname : ($model->type_id == 5 ? $model->motoType->tname : $model->sqCategory->tname)),

                            ],
                            [
                                'attribute' => 'wheel_id',
                                'value' => ($model->wheel ? $model->wheel->tname ." ". Yii::t('value', 'руль') : " " )
                            ],
                            [
                                'attribute' => 'engine_id',
                                'value' => $model->engine->tname
                            ],
                            [
                                'attribute' => 'privod_id',
                                'value' => "{$model->privod->tname} ". Yii::t('value', 'привод'),
                            ],
                            [
                                'attribute' => 'color_id',
                                'value' => $model->color->tname
                            ],
                            [
                                'attribute' => 'state_id',
                                'value' => Yii::t('value', 'Condition') . ' ' . mb_strtolower($model->state->tname, 'UTF-8'),
//                                'value' => "Состояние " . mb_strtolower("Елвдыд", 'UTF-8'),
                            ],
                            [
                                'attribute' => 'run_length',
                                'value' => "{$model->run_length}" . Yii::t('value', 'км'),
                            ],
                            [
                                'attribute' => 'loading_capacity',
                                'value' => ($model->loading_capacity) ? Yii::t('value','Loading capacity') ." {$model->loading_capacity}" . Yii::t('value', 'тонн') : '',
                            ]
                        ],
                    ])
                    ?>
                    <fieldset>
                        <br><span class="fa fa-angle-right" style="color: orange;"></span> <strong style="font-size: 15px"><?= Yii::t('app', 'Features') ?>:</strong><br>
                        <ul class="two-col-special">
                            <?php foreach ($model->orderedSets as $set): ?>
                                <li><?= $set->tname ?></li>
                            <?php endforeach; ?>
                        </ul>

                    </fieldset>
                    <fieldset>
                        <br><span class="fa fa-angle-right" style="color: orange;"></span> <strong style="font-size: 15px"><?= Yii::t('app', 'Additional information') ?>:</strong><br>
                        <p><?= $model->description ?></p>
                    </fieldset>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php
                    foreach (Banner::find()->where('page=:page', [
                        ':page' => Banner::PAGE_CAR_VIEW])->active()->all() as $bannerModel):
                        ?>
                        <?php $imageUrl = "http://104.218.120.138/uploads/{$bannerModel->image}"; ?>
                        <p>
                            <?=
                            Html::a(Html::img($imageUrl, ['class' => 'img-responsive']), $bannerModel->url, [
                                'target' => '_blank'
                            ]);
                            ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-18">
            <span style="font-size: 18px;"><?= Yii::t('app', 'Comments') ?></span>
            <hr style="margin-top: 0px;">
            <?php
            echo $this->render('/comment/index', [
                'searchModel' => $searchModelComment,
                'dataProvider' => $dataProviderComment,
                'model' => $comment,
                'carId' => $model->id,
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-24">
            <?php
            $similarModels = $model->similar();
            if ($similarModels != NULL):
                ?>
                <span style="font-size: 18px;"><?= Yii::t('app', 'Similar listings') ?></span>
                <hr style="margin-top: 0px;">
                <?php
                echo $this->render('/car/_similarCars', [
                    'similarModels' => $similarModels
                ]);
                ?>
            <?php endif; ?>
        </div>
    </div>

</div>
