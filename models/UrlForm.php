<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UrlForm extends Model
{
    public $url;

    public function rules()
    {
        return [
            [['url'], 'required'],
        ];
    }
}
