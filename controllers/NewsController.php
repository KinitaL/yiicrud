<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\components\NewsService;
use yii\base\Exception;
use Yii;

class NewsController extends Controller{

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