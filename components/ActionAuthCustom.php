<?php
namespace app\components;

use Yii;
use yii\base\ActionFilter;
use app\models\Token;

class ActionAuthCustom extends ActionFilter
{
    public function beforeAction($action)
    {
        $headers = Yii::$app->request->headers;
        $token = $headers->get('Authorization');
        $data=[];
        $data['value'] = $token;
        $access = Token::findOne($data);
        if ($access){
            return parent::beforeAction($action);
        }
        else{
            var_dump('11');die;
            return false;
        }
    }
}
?>