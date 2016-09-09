<?php

namespace backend\controllers;

use Yii;
use common\models\Tarrif;
use common\models\TarrifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TarrifController implements the CRUD actions for Tarrif model.
 */
class TarrifController extends Controller {

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
     * Lists all Tarrif models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TarrifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarrif model.
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
     * Creates a new Tarrif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tarrif();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/tarrif']);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Tarrif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/tarrif']);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tarrif model.
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
        $model->status = Tarrif::STATUS_ACTIVE;
        $model->save(false);

//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    public function actionStatusDown($id) {
        $model = $this->findModel($id);
        $model->status = Tarrif::STATUS_DELETED;
        $model->save(false);

//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    /**
     * Finds the Tarrif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tarrif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tarrif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
