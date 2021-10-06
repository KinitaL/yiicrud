<?php

namespace app\models;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);

    }

    public static function findIdentity($id)
    {
    }


    public static function findByUsername($username)
    {
    }


    public function getId()
    {
    }


    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {}
    public function validatePassword($password)
    {}
}
