<?php

namespace backend\controllers;

use Yii;
use common\models\CarType;
use common\models\CarTypeQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\Request;

/**
 * CarTypeController implements the CRUD actions for CarType model.
 */
class CarTypeController extends Controller {

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
                            'view',
                            'colors-list',
                            'colors-update',
                            'wheels-list',
                            'wheels-update',
                            'engines-list',
                            'engines-update',
                            'kuzovs-list',
                            'kuzovs-update',
                            'privods-list',
                            'privods-update',
                            'transmissions-list',
                            'transmissions-update',
                            'complete-sets-list',
                            'complete-sets-update',
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

    public function actionColorsList() {
        $models = \common\models\Color::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionColorsUpdate($id) {
        $model = $this->findModel($id);
        $model->tagColors = Yii::$app->request->post('CarType')['tagColors'];

        if (!$model->save()) {
            Yii::error('Before: ' . $model->tagColors);
            Yii::error($model->errors);
        } else {
            Yii::info('Success');
        }
        return $this->renderAjax('_form_colors_update', [
                'model' => $model,
        ]);
    }

    public function actionWheelsList() {
        $models = \common\models\Wheel::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionWheelsUpdate($id) {
        $model = $this->findModel($id);
        $model->tagWheels = Yii::$app->request->post('CarType')['tagWheels'];

        $model->save();

        return $this->renderAjax('_form_wheels_update', [
                'model' => $model,
        ]);
    }

    public function actionEnginesList() {
        $models = \common\models\Engine::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionEnginesUpdate($id) {
        $model = $this->findModel($id);
        $model->tagEngines = Yii::$app->request->post('CarType')['tagEngines'];

        $model->save();

        return $this->renderAjax('_form_engines_update', [
                'model' => $model,
        ]);
    }

    public function actionKuzovsList() {
        $models = \common\models\Kuzov::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionKuzovsUpdate($id) {
        $model = $this->findModel($id);
        $model->tagKuzovs = Yii::$app->request->post('CarType')['tagKuzovs'];

        $model->save();

        return $this->renderAjax('_form_kuzovs_update', [
                'model' => $model,
        ]);
    }

    public function actionPrivodsList() {
        $models = \common\models\Privod::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionPrivodsUpdate($id) {
        $model = $this->findModel($id);
        $model->tagPrivods = Yii::$app->request->post('CarType')['tagPrivods'];

        $model->save();

        return $this->renderAjax('_form_privods_update', [
                'model' => $model,
        ]);
    }

    public function actionTransmissionsList() {
        $models = \common\models\Transmission::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionTransmissionsUpdate($id) {
        $model = $this->findModel($id);
        $model->tagTransmissions = Yii::$app->request->post('CarType')['tagTransmissions'];

        $model->save();

        return $this->renderAjax('_form_transmissions_update', [
                'model' => $model,
        ]);
    }

    public function actionCompleteSetsList() {
        $models = \common\models\CompleteSet::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;
    }

    public function actionCompleteSetsUpdate($id) {
        $model = $this->findModel($id);
        $model->tagCompleteSets = Yii::$app->request->post('CarType')['tagCompleteSets'];

        $model->save();

        return $this->renderAjax('_form_complete_sets_update', [
                'model' => $model,
        ]);
    }

    /**
     * Lists all CarType models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CarTypeQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CarType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CarType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CarType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CarType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CarType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CarType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CarType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
