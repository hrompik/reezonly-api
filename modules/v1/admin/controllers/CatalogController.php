<?php

namespace app\modules\v1\admin\controllers;


use app\models\Catalog;
use yii\base\DynamicModel;

class CatalogController extends \app\controllers\ActiveController
{
    public $modelClass = Catalog::class;

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['title']))->addRule(['title'], 'string'),
        ];

        return $actions;
    }
}