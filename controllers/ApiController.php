<?php

namespace app\controllers;


use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


/*
 * Get all -> http://localhost:8000/api (GET)
 * Get one -> http://localhost:8000/api/1 (GET)
 * Create -> http://localhost:8000/api (POST)
 * Delete -> http://localhost:8000/api/1 (DELETE)
 * Update -> http://localhost:8000/api/1 (PUT)
*/

class ApiController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public $modelClass = 'app\models\News';
}