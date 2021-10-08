<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use \yii\db\ActiveQuery;

class NewsSearch extends News
{
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['name', 'body'], 'safe'],
            [['name', 'body'], 'string']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, ActiveQuery $data)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $data,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'rating' => SORT_DESC,
                ]
            ],
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        /*Изменяем запрос добавляя в его фильтрацию
        В данном случае оба метода "ИЛИ", чтобы поиск был более широкий.
        Альтернатива  andFilterWhere
        */
        $data->orFilterWhere(['like', 'name', $this->name]);
        $data->orFilterWhere(['like', 'body', $this->body]);


        return $dataProvider;
    }
}