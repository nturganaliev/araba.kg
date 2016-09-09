<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'ARABA.KG',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItemsLeft = [
                [
                    'label' => Yii::t('app', 'Баннеры'),
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Main page'),
                            'url' => ['/banner', 'BannerQuery[page]' => 0],
                        ],
                        [
                            'label' => Yii::t('app', 'Search results page'),
                            'url' => ['/banner', 'BannerQuery[page]' => 1],
                        ],
                        [
                            'label' => Yii::t('app', 'Add advertisement page'),
                            'url' => ['/banner', 'BannerQuery[page]' => 2],
                        ],
                        [
                            'label' => Yii::t('app', 'Login page'),
                            'url' => ['/banner', 'BannerQuery[page]' => 3],
                        ],
                    ]
                ],
                [
                    'label' => Yii::t('app', 'Тарифы'),
                    'url' => ['/tarrif', 'sort' => 'day_count'],
                ],
                [
                    'label' => Yii::t('app', 'Отчеты'),
                    'url' => ['/complete-set'],
                ],
                [
                    'label' => Yii::t('app', 'Texts'),
                    'url' => ['/post'],
                ],
                [
                    'label' => Yii::t('app', 'Платежи'),
                    'url' => ['/client'],
                ],
                [
                    'label' => Yii::t('app', 'Пользователи'),
                    'url' => ['/employee'],
                ],
                [
                    'label' => Yii::t('app', 'Справочники'),
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Офисы'),
                            'url' => ['/office'],
                        ],
                        [
                            'label' => Yii::t('app', 'Партнеры'),
                            'url' => ['/partner'],
                        ],
                        [
                            'label' => Yii::t('app', 'Модель машины'),
                            'url' => ['/car-model/index'],
                        ],
                        [
                            'label' => Yii::t('app', 'Виды транспорта'),
                            'url' => ['/car-type'],
                        ],
                        [
                            'label' => Yii::t('app', 'Марка'),
                            'url' => ['/marka'],
                        ],
//                        [
//                            'label' => Yii::t('app', 'Привод'),
//                            'url' => ['/privod'],
//                        ],
                        [
                            'label' => Yii::t('app', 'Регион'),
                            'url' => ['/region'],
                        ],
                        [
                            'label' => Yii::t('app', 'Категория спец. техн.'),
                            'url' => ['/sq-category'],
                        ],
                        [
                            'label' => Yii::t('app', 'Типы мотоциклов'),
                            'url' => ['/moto-type'],
                        ],
                        [
                            'label' => Yii::t('app', 'Переводы'),
                            'url' => ['/translations'],
                        ],
//                        [
//                            'label' => Yii::t('app', 'Цвет'),
//                            'url' => ['/color'],
//                        ],
//                        [
//                            'label' => Yii::t('app', 'Комплектация'),
//                            'url' => ['/complete-set'],
//                        ],
                    ],
                ],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => '<span class="glyphicon glyphicon-log-out"></span> (' . Yii::$app->user->identity->email . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $menuItemsLeft,
                'encodeLabels' => false,
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; araba.kg <?= date('Y') ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
        <?php
        yii\bootstrap\Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modal',
            'size' => 'modal-md',
            'footerOptions' => ['id' => 'modalFooter'],
            'footer' => '<button id="modalSubmitButton" type="submit" class="btn btn-primary" form="">' . Yii::t('app', 'Save changes') . '</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">' . Yii::t('app', 'Cancel') . '</button>',
            //keeps from closing modal with esc key or by clicking out of the modal.
            // user must click cancel or X to close
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
        ]);
        echo "<div id='modalContent'></div>";
        yii\bootstrap\Modal::end();
        ?>
    </body>
</html>
<?php $this->endPage() ?>
