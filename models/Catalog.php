<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 */
class Catalog extends ActiveRecord
{
    public static function tableName()
    {
        return 'catalog';
    }

    public function rules()
    {
        return [
            [['title', 'price'], RequiredValidator::class],

            ['title', StringValidator::class, 'min' => 1, 'max' => 255],
            ['description', StringValidator::class],
            ['price', NumberValidator::class, 'min' => 0],

        ];
    }
}
