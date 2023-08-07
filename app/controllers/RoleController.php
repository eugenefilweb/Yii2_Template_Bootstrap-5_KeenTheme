<?php

namespace app\controllers;

use Yii;
use app\models\Role;
use app\models\search\RoleSearch;
// use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\CustomController;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends CustomController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // guest actions
        $behaviors['AccessControl']['rules'][] = Yii::$app->Navigation->setGuestActions([]);

        $behaviors['VerbsFilter'] = [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ];

        return $behaviors;
    }

    /**
     * Lists all Role models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        $model->level = $model::lastRoleLevel() + 1;

        if (Yii::$app->request->isAjax) {

            $post = Yii::$app->request->post();

            if ($model->load($post)) {

                $model->module_access = isset($post['Role']['module_access']) ? json_encode($model->module_access) : ""; 
                $model->role_access = isset($post['Role']['role_access']) ? json_encode($model->role_access) : ""; 

                $new_navs = Yii::$app->Navigation->generateNavigationsFromNestable(['navigations' => $post['navigation']]);
                $model->navigations = json_encode($new_navs);

                if ($model->save()) {

                    return json_encode([
                        'error' => false,
                        'url' => Url::to(['view', 'id' => $model->id])
                    ]);

                }

            }

            return json_encode([
                'error' => true,
                'message' => 'Unable to save.',
            ]);

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {

            $post = Yii::$app->request->post();

            if ($model->load($post)) {

                $model->module_access = isset($post['Role']['module_access']) ? json_encode($model->module_access) : ""; 
                $model->role_access = isset($post['Role']['role_access']) ? json_encode($model->role_access) : ""; 

                $new_navs = Yii::$app->Navigation->generateNavigationsFromNestable(['navigations' => $post['navigation']]);
                $model->navigations = json_encode($new_navs);

                if ($model->save()) {

                    return json_encode([
                        'error' => false,
                        'url' => Url::to(['view', 'id' => $model->id])
                    ]);

                }

            }

            return json_encode([
                'error' => true,
                'message' => 'Unable to save.',
            ]);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateNavigation($id)
    {
        $model = $this->findModel($id);

        if($post = Yii::$app->request->post()){

            if(isset($post['navigation'])){

                $new_navs = Yii::$app->Navigation->generateNavigationsFromNestable(['navigations' => $post['navigation']]);
                $model->navigations = json_encode($new_navs);
 
                $model->save(false); 

                return true;
            }

            return false;

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionResetModuleAccess($id)
    {
        $model = $this->findModel($id);

        if ($_GET['role'] && isset(Yii::$app->params['roles'][$_GET['role']])) {
            $model->module_access = json_encode(Yii::$app->params['roles'][$_GET['role']]['module_access']);
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Successfully reset module access.');
            }else{
                Yii::$app->session->setFlash('danger', Html::errorSummary($model));
            }
        }else{
            Yii::$app->session->setFlash('danger', 'Unable to reset, no default.');
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    public function actionResetNavigation($id)
    {
        $model = $this->findModel($id);

        if ($_GET['role'] && isset(Yii::$app->params['roles'][$_GET['role']])) {
            $model->navigations = json_encode(Yii::$app->params['roles'][$_GET['role']]['navigations']);
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Successfully reset navigations.');
            }else{
                Yii::$app->session->setFlash('danger', Html::errorSummary($model));
            }
        }else{
            Yii::$app->session->setFlash('danger', 'Unable to reset, no default.');
        }
            
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $model->record_status = 0;
        $model->save();
        
        // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
