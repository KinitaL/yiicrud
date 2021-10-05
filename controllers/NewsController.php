<?php

namespace app\controllers;

use app\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionIndex(){
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
        return $this->render('view', [
            'model' => News::findOne($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new News();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
        $model = News::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        News::findOne($id)->delete();

        return $this->redirect(['index']);
    }
}