<?php

namespace backend\controllers;

use Yii;
use backend\models\Employee;
use backend\models\ChangeEmployeePasswordForm;
use backend\models\EmployeeCreateForm;
use backend\models\EmployeeQuery;
use backend\models\EmployeeProfileQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class EmployeeController extends Controller {

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
                            'update-profile',
                            'update-password',
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EmployeeProfileQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new EmployeeCreateForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->create()) {
                $model = new EmployeeCreateForm();
            }
        }

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                    'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionStatusUp($id) {
        $model = $this->findModel($id);
        $model->status = Employee::STATUS_ACTIVE;
        $model->save(false);

//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    public function actionStatusDown($id) {
        $model = $this->findModel($id);
        $model->status = Employee::STATUS_DELETED;
        $model->save(false);

//        \Yii::$app->session->setFlash('message', 'Действие вверх на одну позицию за!');
        return true;
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EmployeeCreateForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->create();
            if ($user != null) {
                return $this->redirect(['/employee']);
            }
        }
        return $this->render('create', [
                'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
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

    public function actionUpdateProfile($id) {
        $model = $this->findModel($id);
        $profile = $model->profile;
        if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
            return $this->redirect(['/employee']);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('/employee-profile/_form', [
                    'model' => $profile,
            ]);
        } else {
            return $this->render('/employee-profile/_form', [
                    'model' => $profile,
            ]);
        }
    }

    public function actionUpdatePassword($id) {
        $model = $this->findModel($id);
        $passwordForm = new ChangeEmployeePasswordForm();
        if ($passwordForm->load(Yii::$app->request->post()) && $passwordForm->validate()) {
            $model->setPassword($passwordForm->newPassword);
            $model->save();
            return $this->redirect(['/employee']);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('/employee/_update_password_form', [
                    'model' => $passwordForm,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
