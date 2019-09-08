<?php

namespace app\models;
use yii\base\Model;

class TwitterForm extends Model
{
    public $id;
    public $username;
    public $secret;

    public function rules()
    {
        return [
            [['id', 'username', 'secret'], 'required'],
            ['id', 'string', 'min' => 32, 'max' => 32],
            ['username', 'string', 'min' => 3, 'max' => 12],
            ['secret', 'string', 'min' => 32],
        ];
    }
}