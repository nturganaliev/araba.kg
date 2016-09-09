<?php

namespace frontend\modules\account\controllers;

use Yii;
use common\models\Comment;
use common\models\CommentQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex() {

        $model = new Comment();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = \Yii::$app->user->identity->id;
            if ($model->save()) {
                $car_id = $model->car_id;
                $model = new Comment();
                $model->car_id = $car_id;
            }
        }

        $searchModel = new CommentQuery();
        $searchModel->car_id = $model->car_id;
        $dataProvider = $searchModel->search(null);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $model = $this->findAdvertisement($id);

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

        return $this->render('/comment/index', [
                'searchModel' => $searchModelComment,
                'dataProvider' => $dataProviderComment,
                'model' => $comment,
                'carId' => $model->id,
        ]);
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);
        if ($model->car->owner->id == \Yii::$app->user->identity->id) {
            $model->delete();
//            return 'success';
        }
        $searchModel = new CommentQuery();
        $searchModel->car_id = $model->car_id;
        $dataProvider = $searchModel->searchByCar($model->car_id);

        return $this->render('/comment/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'carId' => $model->car_id,
        ]);
//        return 'failed';
//        $this->redirect(['/account/car/view', 'id' => $model->car_id]);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAdvertisement($id) {
        if (($model = \common\models\Car::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
