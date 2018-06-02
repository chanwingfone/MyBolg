<?php

namespace backend\controllers;

use backend\models\ResetpwdForm;
use common\models\AuthAssignment;
use common\models\AuthItem;
use Yii;
use common\models\Adminuser;
use common\models\AdminuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupForm;

/**
 * AdminuserController implements the CRUD actions for Adminuser model.
 */
class AdminuserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Adminuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adminuser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Adminuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if($user = $model->signup())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionResetpwd($id)
    {
        $model = new ResetpwdForm();

        if ($model->load(Yii::$app->request->post())) {
            if($user = $model->resetPassword($id))
            {
                return $this->redirect(['index']);
            }

        }
        return $this->render('resetpwd', [
            'model' => $model,
        ]);
    }

    public function actionPrivilege($id)
    {

        //找出所有权限，提供给CheckBox；
        $allPrivilege = AuthItem::find()->select(['name','description'])->where(['type'=>1])
            ->indexBy('description')->all();


        foreach ($allPrivilege as $pri)
        {
            $allPrivilegeArray[$pri->name] = $pri->description;
        }

        //当前管理员目前所拥有的权限
        $authAssignments = AuthAssignment::find()->select(['item_name'])->where(['user_id' => $id])
            ->all();

            $AuthAssignmentArray = array();
        foreach ($authAssignments as $ass)
        {
            array_push($AuthAssignmentArray,$ass->item_name);
        }

        if(isset($_POST['newPri']))
        {
            AuthAssignment::deleteAll('user_id=:id',[':id'=>$id]);
            $newPri = $_POST['newPri'];
            $arrlength = count($newPri);
            for($x = 0;$x < $arrlength;$x++)
            {
                $aPri = new AuthAssignment();
                $aPri->item_name = $newPri[$x];
                $aPri->user_id = $id;
                $aPri->created_at = time();
                $aPri->save();
            }
            return $this->redirect(['index']);
        }
//var_dump($allPrivilegeArray);var_dump($AuthAssignmentArray);exit(0);
        return $this->render('privilege',['id'=>$id,'allPrivilegeArray'=>$allPrivilegeArray,'AuthAssignmentArray'=>$AuthAssignmentArray]);
    }




    /**
     * Updates an existing Adminuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Adminuser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Adminuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adminuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adminuser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
