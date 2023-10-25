<?php

use yii\db\Migration;

class m231023_184407_add_catalog_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'catalog',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'description' => $this->text(),
                'price' => $this->integer()->unsigned()->defaultValue(0),

                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('catalog');
    }

}
