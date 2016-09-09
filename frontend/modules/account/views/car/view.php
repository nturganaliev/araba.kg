<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use nirvana\prettyphoto\PrettyPhoto;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Car */
/* @var $sets array */

$this->title = $model->id;
$this->registerJs("
    $('document').ready(function(){
        $('#premium_form').on('pjax:end', function() {
            $.pjax.reload({container:'#premium_box'});
        });
    });
    ", \yii\web\View::POS_END);
$url = Url::to(['/account/car/up']);
$result_success = Yii::t('app', 'Upping updated');
$result_failure = Yii::t('app', 'Upping failed');
$label_active = '<label class="label label-warning">'. Yii::t('app', 'Active') .'</label>';
$this->registerJs("function up(id) {
    $.ajax({
        url: '{$url}?id='+id,
        type: 'GET',
        success: function(result) {
            if (result) {
                $('.cars-wrapper').find('label#car_'+result).replaceWith('{$label_active}');
                alert('{$result_success}');
            } else {
                alert('{$result_failure}');
            }
        },
      });
}", \yii\web\View::POS_END, 'upping');
?>
<p>&nbsp;</p>
<div class="car-view">
    <div class="row">
        <div class="col-lg-4">
            <?php
            $user = \yii::$app->user->identity;
            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php if ($user->profile->client_type == 1) {?><b><?= $user->profile->company_name ?></b><br><?php }?>
                    <?= $user->profile->fio ?><br>
                    <?= isset($user->profile->work_phone) ? $user->profile->work_phone.'<br>' : ''?>
                    <?= $user->profile->mobile_phone ?><br>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Cars'), \yii\helpers\Url::to('/account/car')) ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Settings'), \yii\helpers\Url::to('/account/settings')) ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Refill balance'), \yii\helpers\Url::to('/account/refill-balance')) ?>
                </li>
            </ul>
        </div>
        <div class="col-lg-20">
            <div class="row">
                <div class="col-lg-24">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="row">
                                <div class="col-lg-24">
                                    <div id="image-container" align="center" valign="">
                                        <?=
                                        Html::a(Yii::$app->imageCache->thumb($model->mainImagePath, 'medium', [
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
                                            'theme' => PrettyPhoto::THEME_DARK_SQUARE,
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
                                            <?= $model->owner->profile->fio ?><br>
                                            <?= $model->owner->profile->mobile_phone ?><br>
                                            <?= $model->owner->email ?><br>
                                            <?= $model->region->tname ?><br>
                                            <?php
                                            $count = \common\models\Car::find()
                                                ->where(['created_by' => $model->owner->profile->id])
                                                ->count();
                                            ?>
                                            <?= Html::a(Yii::t('app', 'Posts') . ':' . $count, ['/car/owner', 'id' => $model->owner->profile->id]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-15 col-md-15 col-sm-15">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'template' => "<tr><td>{value}</td></tr>",
                                'options' => [
                                    'class' => 'detail-view'
                                ],
                                'attributes' => [
                                    [
                                        'format' => 'raw',
                                        'attribute' => 'marka_id',
                                            'value' => ($model->rent == 1 ) ? "<span><span style='font-size: 20px'>{$model->tname} {$model->engine_displacement}". Yii::t('value', 'л.')." ". Yii::t('value', 'за') ." </span></span> <sup class='label label-success' style='padding: .1em .3em .1em;'>Rent</sup>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style='font-size: 20px; color: #bc0004;'>" . ($model->price ? number_format($model->price) . Yii::t('value', 'KGS') : Yii::t('value', 'price negotiable')) ."</span>" : "<span><span style='font-size: 20px'>{$model->tname} {$model->engine_displacement}". Yii::t('value', 'л.') ." ". Yii::t('value', 'за') ." </span></span> <span style='font-size:20px; color: #bc0004; '> " . ($model->price ? number_format($model->price) . Yii::t('value', 'KGS') : Yii::t('value', 'price negotiable')) ."</span>"
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
                                        'value' => Yii::t('value','condition') ." " . mb_strtolower($model->state->tname, 'UTF-8'),
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
                                <br><span class="fa fa-angle-right" style="color: orange;"></span> <strong style="font-size: 15px"><?= Yii::t('app', 'Complectation') ?>:</strong><br>
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
                            <?php if ($model->isPremium()): ?>
                                <?php
                                yii\widgets\Pjax::begin([
                                    'id' => 'premium_box'
                                ]);
                                ?>
                                <p style="color: #bc0004; font-size: 13px;">Premium: <?= $model->getBeginAndEndDate() ?></p>
                                <?php yii\widgets\Pjax::end(); ?>
                            <?php endif; ?>
                            <div class="btn-group-horizontal" role="group" aria-label="..." style="margin-top: 5px;margin-bottom: 5px;">
                                <?=
                                Html::a(Yii::t('app', 'Premium'), '#', [
                                    'value' => Url::to(['/account/car/premium', 'id' => $model->id]),
                                    'form' => '',
                                    'title' => Yii::t('app', 'Dear') . ' ' . $model->owner->profile->fio . ',',
                                    'class' => 'btn btn-danger showPremiumModalButton'
                                ]);
                                ?>
                                <a href="<?= Url::to(['/account/car/update', 'id' => $model->id]) ?>" class="btn btn-default"><?= Yii::t('app', 'Edit') ?></a>
                                <a href="<?= Url::to(['/account/car/delete', 'id' => $model->id]) ?>" class="btn btn-default"
                                   title = "<?= Yii::t('yii', 'Delete') ?>"
                                   aria-label = "<?= Yii::t('yii', 'Delete') ?>"
                                   data-confirm = "<?= Yii::t('yii', 'Delete ' . $model->tname . ' ' . $model->engine_displacement . ' '. Yii::t('value', 'л.') .' ' . $model->issue_date . '?') ?>"
                                   data-method = "post"
                                   data-pjax = "0"><?= Yii::t('app', 'Delete') ?></a>
                                <button type="button" class="btn btn-default" onclick="up(<?= $model->id ?>)"><?= Yii::t('app', 'Upping') ?></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-24">
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
        </div>
    </div>
</div>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'premiumModal',
    'size' => 'modal-md',
    'footerOptions' => ['id' => 'modalFooter'],
    'footer' => '<button id="modalSubmitButton" type="submit" class="btn btn-primary" form="">' . Yii::t('app', 'Save') . '</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">' . Yii::t('app', 'Close') . '</button>',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
yii\widgets\Pjax::begin([
    'id' => 'premium_form',
    'enablePushState' => false,
]);

echo "<div id='modalContent'></div>";

yii\widgets\Pjax::end();
yii\bootstrap\Modal::end();
?>
