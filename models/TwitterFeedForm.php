<?php
namespace app\models;
use yii\base\Model;

class TwitterFeedForm extends Model
{
    public $id;
    public $secret;

    public function rules()
    {
        return [
            [['id', 'secret'], 'required'],
            ['id', 'string', 'min' => 32, 'max' => 32],
            ['secret', 'string', 'min' => 32],
        ];
    }
}