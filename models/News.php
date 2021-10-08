<?php
namespace app\models;

class News extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['name','body'], 'required'],
            [['name'], 'string'],
            [['rating'],'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Заголовок',
            'body' => 'Новость',
            'rating'=> 'Рейтинг'
        ];
    }
}
