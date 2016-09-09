<?php

namespace backend\controllers;

use Yii;
use common\models\Partner;
use common\models\PartnerQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller {

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
                            'status-up',
                            'status-down',
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
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PartnerQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param integer $id
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
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Partner();
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
                    return $this->redirect(['/partner']);
                }
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
                        return $this->redirect(['/partner']);
                    }
                }
            } else {
                $oldAttributes = $model->oldAttributes;
                $model->image = $oldAttributes['image'];
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['/partner']);
                }
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStatusUp($id) {
        $model = $this->findModel($id);
        $model->status = Partner::STATUS_ACTIVE;
        $model->save(false);

//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    public function actionStatusDown($id) {
        $model = $this->findModel($id);
        $model->status = Partner::STATUS_DELETED;
        $model->save(false);

//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
