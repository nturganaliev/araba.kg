<?php

namespace backend\controllers;

use Yii;
use common\models\UserProfile;
use common\models\UserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Transaction;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * ClientController implements the CRUD actions for UserProfile model.
 */
class ClientController extends Controller {

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
                            'refill',
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
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $provider = new ActiveDataProvider([
            'query' => Transaction::find()->refills()->where(['client_id' => $id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view', [
                'model' => $this->findModel($id),
                'dataProvider' => $provider
        ]);
    }

    public function actionRefill($id) {
        $model = $this->findModel($id);
        $provider = new ActiveDataProvider([
            'query' => Transaction::find()->refills()->where(['client_id' => $id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $payment = new Transaction();
        if ($payment->load(Yii::$app->request->post())) {
            $payment->client_id = $id;
            $payment->employee_id = \Yii::$app->user->identity->id;
            $payment->type = Transaction::OPERATION_TYPE_REFILL;
            $payment->description = 'Testing';

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($payment->save()) {
                    Yii::$app->db
                        ->createCommand('update users_profiles set balance=balance+:amount where id=:userId')
                        ->bindValue(':amount', $payment->amount)
                        ->bindValue(':userId', $payment->client_id)
                        ->execute();

                    $transaction->commit();
                    Yii::$app->session->setFlash('payment_success', Yii::t('app', 'Счет пополнен на сумму {0} сом', $payment->amount));
                    return $this->render('_index_payments', [
                            'dataProvider' => $provider,
                            'clientId' => $id,
                            'model' => new Transaction()
                    ]);
                } else {
                    Yii::$app->session->setFlash('payment_success', Yii::t('app', 'Минимальная сумма равна 10 сомам'));
                }
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }
        }

        return $this->render('_index_payments', [
                'dataProvider' => $provider,
                'clientId' => $id,
                'model' => $payment
        ]);
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserProfile model.
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
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
