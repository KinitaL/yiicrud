<?php
namespace app\models;

class Token extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'tokens';
    }

    public function rules(){
        return [
            [['value'], 'required'],
        ];
    }

}