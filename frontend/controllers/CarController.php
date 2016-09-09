<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Automobile;
use common\models\Car;
use common\models\CarQuery;
use common\models\Bus;
use common\models\Lorry;
use common\models\Motocycle;
use common\models\SpecialEquipment;
use common\models\Photo;
use common\models\Comment;
use common\models\CommentQuery;
use common\models\CarModel;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * AutomobileController implements the CRUD actions for Automobile model.
 */
class CarController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['fieldset', 'owner', 'index', 'search', 'series', 'view', 'iframe-test'],
                        'allow' => true,
                    ],
//                    [
//                        'actions' => [ '', 'update', 'delete', 'create',],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
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
     * Lists all Automobile models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new CarQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('accountAutomobiles', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Automobile models.
     * @return mixed
     */
    public function actionSearch($type = 1) {

        $searchModelAutomobile = new \common\models\AutomobileQuery();
        $searchModelLorry = new \common\models\LorryQuery();
        $searchModelEquipment = new \common\models\SpecialEquipmentQuery();
        $searchModelBus = new \common\models\BusQuery();
        $searchModelMotocycle = new \common\models\MotocycleQuery();
        $searchModelCar = new \common\models\CarQuery();

        switch ($type) {
            case Car::CAR_TYPE_AUTOMOBILE:
                $dataProvider = $searchModelAutomobile->search(Yii::$app->request->queryParams);
                break;
            case Car::CAR_TYPE_MOTOCYCLE:
                $dataProvider = $searchModelMotocycle->search(Yii::$app->request->queryParams);
                break;
            case Car::CAR_TYPE_LORRY:
                $dataProvider = $searchModelLorry->search(Yii::$app->request->queryParams);
                break;
            case Car::CAR_TYPE_BUS:
                $dataProvider = $searchModelBus->search(Yii::$app->request->queryParams);
                break;
            case Car::CAR_TYPE_SPECIAL_EQUIPMENT:
                $dataProvider = $searchModelEquipment->search(Yii::$app->request->queryParams);
                break;
            default:
                $dataProvider = $searchModelCar->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
                'searchModel' => function() {
                    switch ($type) {
                        case Car::CAR_TYPE_AUTOMOBILE: return $searchModelAutomobile;
                        case Car::CAR_TYPE_MOTOCYCLE: return $searchModelMotocycle;
                        case Car::CAR_TYPE_LORRY: return $searchModelLorry;
                        case Car::CAR_TYPE_BUS: return $searchModelBus;
                        case Car::CAR_TYPE_SPECIAL_EQUIPMENT: return $searchModelEquipment;
                        default: return $searchModelCar;
                    }
                },
                'dataProvider' => $dataProvider,
                'type' => $type,
                'modelAutomobile' => $searchModelAutomobile,
                'modelLorry' => $searchModelLorry,
                'modelBus' => $searchModelBus,
                'modelMoto' => $searchModelMotocycle,
                'modelSQ' => $searchModelEquipment,
                'rent' => Yii::$app->request->get('rent') ? true : false
        ]);
    }

    /**
     * Displays a single Automobile model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $comment = new Comment();

        if ($comment->load(Yii::$app->request->post())) {
            $comment->user_id = \Yii::$app->user->identity->id;
            $comment->car_id = $id;
            if ($comment->save()) {
                $comment = new Comment();
            }
        }

        $searchModel = new CommentQuery();
        $searchModel->car_id = $comment->car_id;
        $dataProvider = $searchModel->searchByCar($id);

        return $this->render('view', [
                'model' => $model,
                'searchModelComment' => $searchModel,
                'dataProviderComment' => $dataProvider,
                'comment' => $comment
        ]);
    }

    /**
     * Creates a new Automobile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate() {
//        $model = new Car();
//
//        $modelAutomobile = new Automobile();
//        $modelAutomobile->type_id = Car::CAR_TYPE_AUTOMOBILE;
//        $modelMoto = new Motocycle();
//        $modelMoto->type_id = Car::CAR_TYPE_MOTOCYCLE;
//        $modelLorry = new Lorry();
//        $modelLorry->type_id = Car::CAR_TYPE_LORRY;
//        $modelSQ = new SpecialEquipment();
//        $modelSQ->type_id = Car::CAR_TYPE_SPECIAL_EQUIPMENT;
//        $modelBus = new Bus();
//        $modelBus->type_id = Car::CAR_TYPE_BUS;
//
//        $db = Yii::$app->db;
//        $transaction = $db->beginTransaction();
//        try {
//            if ($modelAutomobile->load(Yii::$app->request->post())) {
//                $modelAutomobile->images = UploadedFile::getInstances($modelAutomobile, 'images');
//
//
//                Yii::warning($modelAutomobile->images);
//
//                if ($modelAutomobile->save()) {
//                    if ($modelAutomobile->images && $modelAutomobile->validate()) {
//                        foreach ($modelAutomobile->images as $image) {
//                            $unique = uniqid();
//                            $filename = $unique . '.' . $image->extension;
//                            $upload = new Upload();
//                            $upload->car_id = $modelAutomobile->id;
//                            $upload->filename = $filename;
//                            $upload->save();
//                            $image->saveAs('uploads/' . $filename);
//                        }
//                    }
//                    $transaction->commit();
//                    return $this->redirect([
//                            'view',
//                            'id' => $modelAutomobile->id]);
//                }
//            } else
//            if ($modelBus->load(Yii::$app->request->post())) {
//                if ($modelBus->save()) {
//                    $transaction->commit();
//                    return $this->redirect(['view', 'id' => $modelBus->id]);
//                }
//            } else
//            if ($modelSQ->load(Yii::$app->request->post())) {
//                if ($modelSQ->save()) {
//                    $transaction->commit();
//                    return $this->redirect(['view', 'id' => $modelSQ->id]);
//                }
//            } else
//            if ($modelLorry->load(Yii::$app->request->post())) {
//                if ($modelLorry->save()) {
//                    $transaction->commit();
//                    return $this->redirect(['view', 'id' => $modelLorry->id]);
//                }
//            } else
//            if ($modelMoto->load(Yii::$app->request->post())) {
//                if ($modelMoto->save()) {
//                    $transaction->commit();
//                    return $this->redirect(['view', 'id' => $modelMoto->id]);
//                }
//            }
//
//            return $this->render('create', [
//                    'modelAutomobile' => $modelAutomobile,
//                    'modelBus' => $modelBus,
//                    'modelLorry' => $modelLorry,
//                    'modelMoto' => $modelMoto,
//                    'modelSQ' => $modelSQ,
//            ]);
//        } catch (Exception $ex) {
//            $transaction->rollBack();
//            throw $e;
//        }
//    }

    /**
     * Updates an existing Automobile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
//    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                    'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Automobile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
//    public function actionDelete($id) {
//
//        $model = $this->findModel($id);
//
//        $tran = Yii::$app->db->beginTransaction();
//        try {
//            $model->delete();
//            $tran->commit();
//        } catch (Exception $ex) {
//            $tran->rollBack();
//            throw $ex;
//        }
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Automobile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Automobile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Car::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSeries() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];

        if (Yii::$app->request->isPost) {
            $parents = Yii::$app->request->post('depdrop_parents');
            if ($parents != null) {
                $marka_id = intval($parents[0]);
                $out = CarModel::findMergedNames($marka_id);
            }
        }
        return ['output' => $out, 'selected' => ''];
    }

    public function actionFieldset() {
        return $this->render('fieldset');
    }

    public function actionIframeTest() {
        return $this->render('iframe');
    }

    public function actionOwner($id) {
        $owner = \common\models\User::findOne($id);
        if ($owner === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $provider = new ActiveDataProvider([
            'query' => Car::find()
                ->where(['created_by' => $owner->id])
                ->orderBy(['premium_date' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        return $this->render('owner', [
                'owner' => $owner,
                'dataProvider' => $provider,
        ]);
    }

}
