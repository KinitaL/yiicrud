<?php

namespace app\components;

use app\models\News;
use yii\base\Exception;
use Yii;

class NewsService 
{
    public static function find()
    {
        if ($model = News::find()){
            return $model;
        } else {
            throw new Exception();
        }
    }

    public static function findOne(int $id)
    {
        if ($model = News::findOne($id)){
            return $model;
        } else {
            throw new Exception();
        }
    }

    public static function create()
    {
        if ($model = new News()){
            return $model;
        } else {
            throw new Exception();
        }
    }

    public static function loadAndSave(News $model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $model->id;
        } else {
            throw new Exception();
        }
    }
}