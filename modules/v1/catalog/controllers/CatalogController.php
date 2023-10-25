<?php

namespace app\modules\v1\catalog\controllers;

use app\models\Catalog;
use yii\base\DynamicModel;

class CatalogController extends \yii\rest\ActiveController
{
    public $modelClass = Catalog::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => (new DynamicModel(['title']))->addRule(['title'], 'string'),
        ];

        return $actions;
    }


}