<?php


namespace Unit\models;

use app\fixtures\CatalogFixture;
use app\models\Catalog;
use \UnitTester;

class CatalogTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'cars' => [
                'class' => CatalogFixture::class,
                'dataFile' => codecept_data_dir() . '_catalog.php'
            ]
        ]);
    }

    public function testCreate()
    {
        $catalog = new Catalog();
        $catalog->title = 'Название';
        $catalog->price = 55;
        verify($catalog->save())->true();
    }

    public function testCreateEmpty()
    {
        $catalog = new Catalog();
        verify($catalog->validate())->false();
    }

    public function testDelete()
    {
        $catalog = Catalog::findOne(1);
        verify(isset($catalog))->true();

        verify($catalog->delete())->isInt();
    }

    public function testUpdate()
    {
        $catalog = Catalog::findOne(['title' => 'test1']);
        verify(isset($catalog))->true();

        $catalog->title = 'new_test_name_1';
        verify($catalog->save())->true();

        $updatedCatalog = Catalog::findOne(['title' => 'new_test_name_1']);
        verify(isset($updatedCatalog))->true();
    }
}
