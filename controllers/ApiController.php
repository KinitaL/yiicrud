<?php

namespace app\controllers;

use app\models\News;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use Yii;
use yii\helpers\Json;

class ApiController extends ActiveController
{
    /*public function behaviors()
    {
        return [
            [
                'class' => 'app\components\ActionAuthCustom',
            ],
        ];
    }*/

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        return $behaviors;
    }*/


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public $modelClass = 'app\models\News';

    //Get all -> http://localhost:8000/api (GET)
    //Get one -> http://localhost:8000/api/view?id=3 (GET)
    //Create -> http://localhost:8000/api/create (POST)
    //Delete -> http://localhost:8000/api/delete?id=6 (DELETE)
    //Update -> http://localhost:8000/api/update?id=6 (PUT)
}