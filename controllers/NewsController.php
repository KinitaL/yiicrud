<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\components\NewsService;
use yii\base\Exception;
use Yii;

/*
* NewsController is used as controller in mvc system.
*
* It manages routes with actions in order to give appropriate view and data
* for each request.
*
*
* Контроллер используется для обработке запросов по определнным путям.
*
* Каждому пути сопоставлен определенный метод, внутри которого будут получены необходимые
* данные, которые будут отображены во view
*
 */
class NewsController extends Controller{

    /*
     * Returns all data, that would be found in database.
     *
     * Метод возвращает все записи из БД и использует их для рендера view.
     */
    public function actionIndex()
    {
        try {
            $model = NewsService::find();
        } catch (Exception $e){
            Yii::$app->session->setFlash('error', "Неожиданная ошибка");
            return $this->redirect('../');
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $model,

            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'rating' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * Returns one entry by id
     *
     * Возвращает едиственную запись, которая содержит id, переданный в параметрах
     */
    public function actionView(int $id)
    {
        try {
            $news = NewsService::findOne($id);
        } catch (Exception $e){
            Yii::$app->session->setFlash('error', "Такой новости не существует.");
            return $this->redirect('index');
        }
        return $this->render('view', [
            'model' => $news,
        ]);
    }

    /*
    * Method, that used in order to create new record in DB.
    * Returns id of new record, that is used to render view with new record.
    *
    * Метод, используемый для создания новой записи в БД.
    * Возвращает id новой записи, чтобы на его основе получить отображение с новой
    * записью
    * Также, если метод GET, то просто рендерит страницу с формой.
    */
    public function actionCreate()
    {
        $model = NewsService::create();

        if ($this->request->isPost) {
            try {
                $id = NewsService::loadAndSave($model);
                return $this->redirect(['view', 'id' => $id]);
            } catch (Exception $e){
                Yii::$app->session->setFlash('error', "Ошибка при создании новости.");
                return $this->redirect('../index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /*
     * Method which used in order to update record in DB. If request's method is POST,
     * it takes one record from DB and update data there according data from user.
     * If request's method is GET, it shows view with form, that contains data from record.
     *
     * Метод используется для обновления данных записи БД. Если он запрошен методом POST,
     * тогда он просто обновляет данные в записи. Если GET, то отображает форму, в которой
     * можно внести изменения в запись БД.
     *
     */
    public function actionUpdate($id)
    {
        try{
            $model = NewsService::findOne($id);         
        } catch (Exception $e){
            Yii::$app->session->setFlash('error', "Такой новости не существует.");
            return $this->redirect('../index');
        }

        if ($this->request->isPost) {
            try {
                $id = NewsService::loadAndSave($model);
                return $this->redirect(['view', 'id' => $id]);
            } catch (Exception $e){
                Yii::$app->session->setFlash('error', "Ошибка при обновлении новости.");
                return $this->redirect('../index');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /*
     * It deletes record in DB, that has id received from request.
     * Then it shows index page.
     *
     * Удаляет запись из базы данных и возвращает начальную страницу.
     */
    public function actionDelete($id)
    {
        try{
            $model = NewsService::findOne($id);
        } catch (Exception $e){
            Yii::$app->session->setFlash('error', "Ошибка при удалении новости.");
            return $this->redirect('../index');
        }
        $model->delete();
        return $this->redirect(['index']);
    }
}