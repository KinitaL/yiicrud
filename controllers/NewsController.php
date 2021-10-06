<?php

namespace app\controllers;

use app\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class NewsController extends Controller{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),

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

    public function actionView($id)
    {
        try {
            $news = News::findOne($id);
            if (!$news){
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e){
            return $this->redirect('index');
        }
        return $this->render('view', [
            'model' => News::findOne($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new News();

        if ($this->request->isPost) {
            try {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new HttpException(406);
                }
            } catch (HttpException $e){
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
            $model = News::findOne($id);
            if (!$model){
                throw new NotFoundHttpException();
            }

        } catch (NotFoundHttpException $e){
            return $this->redirect('../index');
        }
        if ($this->request->isPost) {
            try {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new HttpException(406);
                }
            } catch (HttpException $e){
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
            $model = News::findOne($id);
            if (!$model){
                throw new NotFoundHttpException();
            }

        } catch (NotFoundHttpException $e){
            return $this->redirect('../index');
        }
        $model->delete();
        return $this->redirect(['index']);
    }
}