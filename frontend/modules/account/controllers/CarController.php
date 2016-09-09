<?php

namespace frontend\modules\account\controllers;

use Yii;
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
use common\models\UploadForm;
use common\models\Tarrif;
use common\models\PremiumLog;

class CarController extends \yii\web\Controller {

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
                            'automobile',
                            'image-upload',
                            'view',
                            'up',
                            'premium',
                            'images',
                            'make-main',
                            'delete-image',
                            'time',
                            'test',
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

    public function actionTest() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\Marka::find()->lorry()->select('id')->asArray()->column();
    }

    public function actionIndex() {
        $searchModel = new CarQuery();
        $searchModel->created_by = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('/car/listview', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->created_by != \Yii::$app->user->identity->id) {
            throw new \yii\web\ForbiddenHttpException(\Yii::t('app', 'You are not allowed.'));
        }
        switch ($model->type_id) {
            case Car::CAR_TYPE_AUTOMOBILE:
                $modelAutomobile = Automobile::findOne($id);
                if ($modelAutomobile->load(Yii::$app->request->post()) && $modelAutomobile->save()) {
                    return $this->redirect(['/account/car/images', 'id' => $modelAutomobile->id]);
                } else {
                    return $this->render('update', [
                            'model' => $modelAutomobile,
                    ]);
                }
                break;
            case Car::CAR_TYPE_MOTOCYCLE:
                $modelMotocycle = Motocycle::findOne($id);
                if ($modelMotocycle->load(Yii::$app->request->post())) {
                    if ($modelMotocycle->validate(['marka_id'])) {
                        $carModel = \common\models\CarModel::find()
                            ->where(['marka_id' => $modelMotocycle->marka_id, 'name' => $modelMotocycle->model_name])
                            ->one();
                        if ($carModel) {
                            $modelMotocycle->model_id = $carModel->id;
                        } else {
                            $newCarModel = new \common\models\CarModel();
                            $newCarModel->marka_id = $modelMotocycle->marka_id;
                            $newCarModel->is_seria = false;
                            $newCarModel->name = $modelMotocycle->model_name;
                            if ($newCarModel->save()) {
                                $modelMotocycle->model_id = $newCarModel->id;
                            } else {
                                $modelMotocycle->addError('model_name', 'Something get wrong on car model saving.');
                            }
                        }
                    }
                    if ($modelMotocycle->save()) {
                        return $this->redirect(['/account/car/images', 'id' => $modelMotocycle->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $modelMotocycle,
                        ]);
                    }
                } else {
                    return $this->render('update', [
                            'model' => $modelMotocycle,
                    ]);
                }
                break;
            case Car::CAR_TYPE_LORRY:
                $modelLorry = Lorry::findOne($id);
                if ($modelLorry->load(Yii::$app->request->post())) {
                    if ($modelLorry->validate(['marka_id'])) {
                        $carModel = \common\models\CarModel::find()
                            ->where(['marka_id' => $modelLorry->marka_id, 'name' => $modelLorry->model_name])
                            ->one();
                        if ($carModel) {
                            $modelLorry->model_id = $carModel->id;
                        } else {
                            $newCarModel = new \common\models\CarModel();
                            $newCarModel->marka_id = $modelLorry->marka_id;
                            $newCarModel->is_seria = false;
                            $newCarModel->name = $modelLorry->model_name;
                            if ($newCarModel->save()) {
                                $modelLorry->model_id = $newCarModel->id;
                            } else {
                                $modelLorry->addError('model_name', 'Something get wrong on car model saving.');
                            }
                        }
                    }
                    if ($modelLorry->save()) {
                        return $this->redirect(['/account/car/images', 'id' => $modelLorry->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $modelLorry,
                        ]);
                    }
                } else {
                    return $this->render('update', [
                            'model' => $modelLorry,
                    ]);
                }
                break;
            case Car::CAR_TYPE_BUS:
                $modelBus = Bus::findOne($id);
                if ($modelBus->load(Yii::$app->request->post())) {
                    if ($modelBus->validate(['marka_id'])) {
                        $carModel = \common\models\CarModel::find()
                            ->where(['marka_id' => $modelBus->marka_id, 'name' => $modelBus->model_name])
                            ->one();
                        if ($carModel) {
                            $modelBus->model_id = $carModel->id;
                        } else {
                            $newCarModel = new \common\models\CarModel();
                            $newCarModel->marka_id = $modelBus->marka_id;
                            $newCarModel->is_seria = false;
                            $newCarModel->name = $modelBus->model_name;
                            if ($newCarModel->save()) {
                                $modelBus->model_id = $newCarModel->id;
                            } else {
                                $modelBus->addError('model_name', 'Something get wrong on car model saving.');
                            }
                        }
                    }
                    if ($modelBus->save()) {
                        return $this->redirect(['/account/car/images', 'id' => $modelBus->id]);
                    } else {
                        return $this->render('update', [
                                'model' => $modelBus,
                        ]);
                    }
                } else {
                    return $this->render('update', [
                            'model' => $modelBus,
                    ]);
                }
                break;
            case Car::CAR_TYPE_SPECIAL_EQUIPMENT:
                $modelSQ = SpecialEquipment::findOne($id);
                if ($modelSQ->load(Yii::$app->request->post())) {
                    if ($modelSQ->validate(['marka_id'])) {
                        $carModel = \common\models\CarModel::find()
                            ->where(['marka_id' => $modelSQ->marka_id, 'name' => $modelSQ->model_name])
                            ->one();
                        if ($carModel) {
                            $modelSQ->model_id = $carModel->id;
                        } else {
                            $newCarModel = new \common\models\CarModel();
                            $newCarModel->marka_id = $modelSQ->marka_id;
                            $newCarModel->is_seria = false;
                            $newCarModel->name = $modelSQ->model_name;
                            if ($newCarModel->save()) {
                                $modelSQ->model_id = $newCarModel->id;
                            } else {
                                $modelSQ->addError('model_name', 'Something get wrong on car model saving.');
                            }
                        }
                    }
                    if ($modelSQ->save()) {
                        return $this->redirect(['/account/car/images', 'id' => $modelSQ->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $modelSQ,
                        ]);
                    }
                } else {
                    return $this->render('update', [
                            'model' => $modelSQ,
                    ]);
                }
                break;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/account/car/images', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Car model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Car();

        $modelAutomobile = new Automobile();
        $modelAutomobile->type_id = Car::CAR_TYPE_AUTOMOBILE;
        $modelMoto = new Motocycle();
        $modelMoto->type_id = Car::CAR_TYPE_MOTOCYCLE;
        $modelLorry = new Lorry();
        $modelLorry->type_id = Car::CAR_TYPE_LORRY;
        $modelSQ = new SpecialEquipment();
        $modelSQ->type_id = Car::CAR_TYPE_SPECIAL_EQUIPMENT;
        $modelBus = new Bus();
        $modelBus->type_id = Car::CAR_TYPE_BUS;

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            if ($modelAutomobile->load(Yii::$app->request->post())) {

                $modelAutomobile->images = UploadedFile::getInstances($modelAutomobile, 'images');//$uploadform
                $modelAutomobile->premium_date = date('Y-m-d H:i:s', time() - 5);
                Yii::warning('Creating automobile');
                if ($modelAutomobile->save()) {
                    if ($modelAutomobile->images && $modelAutomobile->validate()) {
                        foreach ($modelAutomobile->images as $image) {
                            $unique = uniqid();
                            $filename = $unique;
                            $upload = new Photo();
                            $upload->car_id = $modelAutomobile->id;
                            $upload->filename = $filename;
                            $upload->extension = $image->extension;
                            $upload->save();
                            $image->saveAs(\Yii::getAlias('@adv_upload_path') . "/{$filename}.{$upload->extension}");
                        }
                    }
                    $transaction->commit();
                    return $this->redirect([
                            'view',
                            'id' => $modelAutomobile->id]);
                }
            } else
            if ($modelBus->load(Yii::$app->request->post())) {
                $modelBus->images = UploadedFile::getInstances($modelBus, 'images');
                $modelBus->premium_date = date('Y-m-d H:i:s', time() - 5);
                Yii::warning('Creating bus');
                if ($modelBus->validate(['marka_id'])) {
                    $carModel = \common\models\CarModel::find()
                        ->where(['marka_id' => $modelBus->marka_id, 'name' => $modelBus->model_name])
                        ->one();
                    if ($carModel) {
                        $modelBus->model_id = $carModel->id;
                    } else {
                        $newCarModel = new \common\models\CarModel();
                        $newCarModel->marka_id = $modelBus->marka_id;
                        $newCarModel->is_seria = false;
                        $newCarModel->name = $modelBus->model_name;
                        if ($newCarModel->save()) {
                            $modelBus->model_id = $newCarModel->id;
                        } else {
                            $modelBus->addError('model_name', 'Something get wrong on car model saving.');
                        }
                    }
                }
                if ($modelBus->save()) {
                    if ($modelBus->images && $modelBus->validate()) {
                        foreach ($modelBus->images as $image) {
                            $unique = uniqid();
                            $filename = $unique;
                            $upload = new Photo();
                            $upload->car_id = $modelBus->id;
                            $upload->filename = $filename;
                            $upload->extension = $image->extension;
                            $upload->save();
                            $image->saveAs(\Yii::getAlias('@adv_upload_path') . "/{$filename}.{$upload->extension}");
                        }
                    }
                    $transaction->commit();
                    return $this->redirect([
                            'view',
                            'id' => $modelBus->id]);
                }
            } else
            if ($modelSQ->load(Yii::$app->request->post())) {
                $modelSQ->images = UploadedFile::getInstances($modelSQ, 'images');
                $modelSQ->premium_date = date('Y-m-d H:i:s', time() - 5);
                Yii::warning('Creating special equipment');
                if ($modelSQ->validate(['marka_id'])) {
                    $carModel = \common\models\CarModel::find()
                        ->where(['marka_id' => $modelSQ->marka_id, 'name' => $modelSQ->model_name])
                        ->one();
                    if ($carModel) {
                        $modelSQ->model_id = $carModel->id;
                    } else {
                        $newCarModel = new \common\models\CarModel();
                        $newCarModel->marka_id = $modelSQ->marka_id;
                        $newCarModel->is_seria = false;
                        $newCarModel->name = $modelSQ->model_name;
                        if ($newCarModel->save()) {
                            $modelSQ->model_id = $newCarModel->id;
                        } else {
                            $modelSQ->addError('model_name', 'Something get wrong on car model saving.');
                        }
                    }
                }
                if ($modelSQ->save()) {
                    if ($modelSQ->images && $modelSQ->validate()) {
                        foreach ($modelSQ->images as $image) {
                            $unique = uniqid();
                            $filename = $unique;
                            $upload = new Photo();
                            $upload->car_id = $modelSQ->id;
                            $upload->filename = $filename;
                            $upload->extension = $image->extension;
                            $upload->save();
                            $image->saveAs(\Yii::getAlias('@adv_upload_path') . "/{$filename}.{$upload->extension}");
                        }
                    }
                    $transaction->commit();
                    return $this->redirect([
                            'view',
                            'id' => $modelSQ->id]);
                }
            } else
            if ($modelLorry->load(Yii::$app->request->post())) {
                $modelLorry->images = UploadedFile::getInstances($modelLorry, 'images');
                $modelLorry->premium_date = date('Y-m-d H:i:s', time() - 5);
                if ($modelLorry->validate(['marka_id'])) {
                    $carModel = \common\models\CarModel::find()
                        ->where(['marka_id' => $modelLorry->marka_id, 'name' => $modelLorry->model_name])
                        ->one();
                    if ($carModel) {
                        $modelLorry->model_id = $carModel->id;
                    } else {
                        Yii::warning('Car model not founded');
                        $newCarModel = new \common\models\CarModel();
                        $newCarModel->marka_id = $modelLorry->marka_id;
                        $newCarModel->is_seria = false;
                        $newCarModel->name = $modelLorry->model_name;
                        if ($newCarModel->save()) {
                            $modelLorry->model_id = $newCarModel->id;
                        } else {
                            $modelLorry->addError('model_name', 'Something get wrong on car model saving.');
                        }
                    }
                }
                if ($modelLorry->save()) {
                    if ($modelLorry->images && $modelLorry->validate()) {
                        foreach ($modelLorry->images as $image) {
                            $unique = uniqid();
                            $filename = $unique;
                            $upload = new Photo();
                            $upload->car_id = $modelLorry->id;
                            $upload->filename = $filename;
                            $upload->extension = $image->extension;
                            $upload->save();
                            $image->saveAs(\Yii::getAlias('@adv_upload_path') . "/{$filename}.{$upload->extension}");
                        }
                    }
                    $transaction->commit();
                    return $this->redirect([
                            'view',
                            'id' => $modelLorry->id]);
                }
            } else
            if ($modelMoto->load(Yii::$app->request->post())) {
                $modelMoto->images = UploadedFile::getInstances($modelMoto, 'images');
                $modelMoto->premium_date = date('Y-m-d H:i:s', time() - 5);
                Yii::warning('Creating motocycle');
                if ($modelMoto->validate(['marka_id'])) {
                    $carModel = \common\models\CarModel::find()
                        ->where(['marka_id' => $modelMoto->marka_id, 'name' => $modelMoto->model_name])
                        ->one();
                    if ($carModel) {
                        $modelMoto->model_id = $carModel->id;
                    } else {
                        Yii::warning('Car model not founded');
                        $newCarModel = new \common\models\CarModel();
                        $newCarModel->marka_id = $modelMoto->marka_id;
                        $newCarModel->is_seria = false;
                        $newCarModel->name = $modelMoto->model_name;
                        if ($newCarModel->save()) {
                            $modelMoto->model_id = $newCarModel->id;
                        } else {
                            $modelMoto->addError('model_name', Yii::t('app', 'Something get wrong on car model saving.'));
                        }
                    }
                }
                if ($modelMoto->save()) {
                    if ($modelMoto->images && $modelMoto->validate()) {
                        foreach ($modelMoto->images as $image) {
                            $unique = uniqid();
                            $filename = $unique;
                            $upload = new Photo();
                            $upload->car_id = $modelMoto->id;
                            $upload->filename = $filename;
                            $upload->extension = $image->extension;
                            $upload->save();
                            $image->saveAs(\Yii::getAlias('@adv_upload_path') . "/{$filename}.{$upload->extension}");
                        }
                    }
                    $transaction->commit();
                    return $this->redirect([
                            'view',
                            'id' => $modelMoto->id]);
                }
            }

            return $this->render('create', [
                    'modelAutomobile' => $modelAutomobile,
                    'modelBus' => $modelBus,
                    'modelLorry' => $modelLorry,
                    'modelMoto' => $modelMoto,
                    'modelSQ' => $modelSQ,
            ]);
        } catch (Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }
    }

    public function actionImages($id) {
        $model = $this->findModel($id);
        return $this->render('image_gallery', [
                'model' => $model
        ]);
    }

    public function actionMakeMain($id, $imageId) {
        $model = $this->findModel($id);
        if ($image = Photo::findOne($imageId)) {
            if ($model->id == $image->car_id) {
                if ($mainImage = Photo::find()->where(['car_id' => $id, 'is_main' => true])->one()) {
                    $mainImage->is_main = false;
                    $mainImage->save();
                }
                $image->is_main = true;
                $image->save();
            }
        }
        return $this->redirect(['/account/car/images', 'id' => $id]);
    }

    public function actionDeleteImage($id) {
        if ($image = Photo::findOne($id)) {
            if (!$image->is_main) {
                $image->delete();
            }
            return $this->redirect(['/account/car/images', 'id' => $image->car_id]);
        } else {
            return $this->goBack();
        }
    }

    /**
     * Displays a single Car model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {

        $model = $this->findModel($id);
        if ($model->created_by != \Yii::$app->user->identity->id) {
            throw new \yii\web\ForbiddenHttpException(\Yii::t('app', 'You are not allowed.'));
        }

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

    public function actionUp($id) {

        $model = $this->findModel($id);
        if (Yii::$app->user->identity->id == $model->created_by) {
            $model->premium_date = date('Y-m-d H:i:s', time());
            $model->save(false, ['premium_date']);
            return $model->id;
        }
        return false;
    }

    public function actionPremium($id) {

        $model = $this->findModel($id);
        $tarrifs = Tarrif::find()->active()->all();
        if (Yii::$app->request->isPost && $tarifId = Yii::$app->request->post('tarrif')) {
            if ($tarifModel = Tarrif::findOne($tarifId)) {
                $client = \common\models\UserProfile::find()
                    ->where(['id' => Yii::$app->user->identity->id])
                    ->one();
                if ($client->balance >= $tarifModel->price) {
                    $client->balance = $client->balance - $tarifModel->price;
                    $client->save();
//                $pDate = ($model->premium_date == null) ? date('Y-m-d h:i:s', time()) : $model->premium_date;
                    $premiumLog = new PremiumLog();
                    $premiumLog->car_id = $model->id;
                    $premiumLog->tarrif_id = $tarifModel->id;
                    $premiumLog->premium_begin = date('Y-m-d h:i:s', time());
                    $premiumLog->premium_end = date('Y-m-d h:i:s', strtotime("+{$tarifModel->day_count} days"));
                    $premiumLog->save();
                    $model->premium_date = date('Y-m-d h:i:s', strtotime("+{$tarifModel->day_count} days"));
                    $model->save(false);
                    $message = "Услуга премиум удачно продлена";
                    return "<div id='modalContent'>{$message}</div>";
                } else {
                    $message = "Недостаточно средств";
                    return "<div id='modalContent'><span style='color:red'>{$message}</span></div>";
                }
            }
        }
        return $this->renderAjax('_premium', [ 'model' => $model,
                'tarrifs' => $tarrifs,
        ]);
    }

    public function actionImageUpload() {
//        $car = Car::find()->where('id=:id and created_by=:owner', [
//                ':id' => $id,
//                ':owner' => Yii::$app->user->identity->id,
//            ])->one();
//        if ($car == null) {
////            return Yii::$app->request->
//            return '';
//        }
        ini_set('memory_limit','512M');
        $model = new UploadForm();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->images = UploadedFile::getInstances($model, 'images');

            if ($model->images && $model->validate()) {
                if ($car = Car::findOne($model->car_id)) {
                    $count = count($car->uploadedImages);
                    $status = false;
                    if ((count($model->images) + $count) > 10) {
                        $status = true;
                        Yii::$app->session->setFlash('info', 'Max limit is 15 pictures. Please make sure the count of images uploaded.');
                    }
                    foreach ($model->images as $image) {
                        if ($count > 14)
                            break;
                        $unique = uniqid();
                        $filename = $unique;
                        $upload = new Photo();
                        $upload->car_id = $model->car_id;
                        $upload->filename = $filename;
                        $upload->extension = $image->extension;
                        $upload->is_main = false;
                        $upload->save();
                        $image->saveAs(\Yii::getAlias('@adv_upload_path') . "/{$filename}.{$upload->extension}");
                        $count++;
                    }
                }
            }
        }
        $this->redirect(['/account/car/images', 'id' => $model->car_id]);
    }

    public function actionDelete($id) {
        $model = $this->findModel($id);

        foreach ($model->uploadedImages as $image) {
            $image->delete();
        }
        foreach ($model->comments as $comment) {
            $comment->delete();
        }

        $model->delete();

        return $this->redirect(['index']);
    }

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
            throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist or was deleted'));
        }
    }

    public function actionTime() {
        return date('d.m.Y h:i:s', strtotime("+3 days"));
//        return strtotime('now');
    }

}
