<?php

namespace backend\controllers;

use Yii;
use common\models\Banner;
use common\models\BannerQuery;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'delete',
                            'create',
                            'update',
                            'view',
                            'position-up',
                            'position-down',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BannerQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Banner();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->image && $model->validate()) {
                $unique = uniqid();
                $filename = $unique . '.' . $model->image->extension;
//                $fileName = $model->image->baseName . '.' . $model->image->extension;
                $model->image->saveAs('uploads/' . $filename);
                $model->image = $filename;
                if ($model->save(false)) {
                    return $this->redirect(['/banner']);
                }
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $unique = uniqid();
                $filename = $unique . '.' . $image->extension;
//                $fileName = $image->baseName . '.' . $image->extension;
                $model->image = $filename;
                if ($model->validate()) {
                    $oldAttributes = $model->oldAttributes;
                    unlink("uploads/{$oldAttributes['image']}");
                    $image->saveAs('uploads/' . $filename);
                    if ($model->save(false)) {
                        return $this->redirect(['/banner']);
                    }
                }
            } else {
                $oldAttributes = $model->oldAttributes;
                $model->image = $oldAttributes['image'];
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['/banner']);
                }
            }
        } else {
            return $this->renderAjax('_form', [
                    'model' => $model,
            ]);
        }
    }

    public function actionPositionUp($id) {
        $model = $this->findModel($id);
        if ($model->position != 1) {
            $previous = Banner::find()
                ->where('page=:page and position=:position', [
                    ':page' => $model->page,
                    ':position' => $model->position - 1
                ])
                ->one();
            if ($previous != null) {
                $previous->position = $previous->position + 1;
                $previous->save(false);
            }
            $model->position = $model->position - 1;
            $model->save(false);
        }
//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    public function actionPositionDown($id) {
        $model = $this->findModel($id);
        $max = Banner::find()
            ->where('page = :page', [':page' => $model->page])
            ->max('position');
        if ($model->position != $max) {
            $next = Banner::find()
                ->where('page=:page and position=:position', [
                    ':page' => $model->page,
                    ':position' => $model->position + 1
                ])
                ->one();
            if ($next != null) {
                $next->position = $next->position - 1;
                $next->save(false);
            }
            $model->position = $model->position + 1;
            $model->save(false);
        }
//        \Yii::$app->session->setFlash('message', 'Действие совершилось!');
        return true;
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
