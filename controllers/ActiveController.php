<?php

namespace app\controllers;


use app\components\filters\HttpHeaderAuth;

class ActiveController extends \yii\rest\ActiveController
{
    public function behaviors()
    {
        return [
            'basicAuth' => [
                'class' => HttpHeaderAuth::class,
            ],
        ];
    }
}