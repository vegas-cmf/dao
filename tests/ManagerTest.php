<?php
/**
 * This file is part of Vegas package
 *
 * @author Radosław Fąfara <radek@amsterdamstandard.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://cmf.vegas
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegas\Tests\Db\Dao;


use Vegas\Tests\Stub\Models\FakeWithDao;
use Vegas\Tests\Stub\Models\FakeWithoutDao;
use Phalcon\Di;
use Vegas\Db\Dao\Manager;
use Vegas\Test\TestCase;

class ManagerTest extends TestCase
{
    /**
     * @var Manager
     */
    private $dao;

    public static function setUpBeforeClass()
    {
        $di = Di::getDefault();
        $di->get('db')->execute('DROP TABLE IF EXISTS fake_table ');
        $di->get('db')->execute(
            'CREATE TABLE fake_table(
            id int not null primary key auto_increment,
            title varchar(250) null,
            content text null,
            category_id int null,
            created_at int null
            )'
        );
        $di->get('mongo')->selectCollection('fake_with_dao')->remove([]);
        $di->get('mongo')->selectCollection('fake_without_dao')->remove([]);
    }

    public static function tearDownAfterClass()
    {
        $di = Di::getDefault();
        $di->get('db')->execute('DROP TABLE IF EXISTS fake_table ');
        $di->get('mongo')->selectCollection('fake_with_dao')->remove([]);
        $di->get('mongo')->selectCollection('fake_without_dao')->remove([]);
    }

    public function setUp()
    {
        parent::setUp();
        $this->dao = new Manager;
        $this->dao->setDI($this->di);
    }

    public function testWillGetDefaultDaoForModelsWithoutCustomImpl()
    {
        $daoByName = $this->dao->get('\Vegas\Tests\Stub\Models\FakeWithoutDao');
        $this->assertInstanceOf('\Vegas\Db\Dao\DefaultDao', $daoByName);

        $collection = new FakeWithoutDao;
        $daoByObject = $this->dao->get($collection);

        $this->assertSame($daoByName, $daoByObject);
    }

    public function testWillGetCustomDaoImplWhenPossible()
    {
        $daoByName = $this->dao->get('\Vegas\Tests\Stub\Models\FakeWithDao');
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\Dao\FakeWithDao', $daoByName);

        $collection = new FakeWithDao;
        $daoByObject = $this->dao->get($collection);

        $this->assertSame($daoByName, $daoByObject);
    }

    public function testDaoCanBeOverriden()
    {
        $daoOriginal = $this->dao->get('\Vegas\Tests\Stub\Models\FakeWithDao');
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\Dao\FakeWithDao', $daoOriginal);

        $classname = $daoOriginal->getRecordClassname();
        $this->assertInternalType('string', $classname);

        $this->dao->set($classname, '\Vegas\Tests\Stub\Models\Dao\StaticData');

        $daoOverriden = $this->dao->get('\Vegas\Tests\Stub\Models\FakeWithDao');
        $this->assertNotInstanceOf('\Vegas\Tests\Stub\Models\Dao\FakeWithDao', $daoOverriden);
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\Dao\StaticData', $daoOverriden);

        $this->assertNotSame($daoOverriden, $daoOriginal);
    }

    public function testDaoCannotBeOverridenUsingInvalidClass()
    {
        $daoOriginal = $this->dao->get('\Vegas\Tests\Stub\Models\FakeWithDao');
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\Dao\FakeWithDao', $daoOriginal);

        $classname = $daoOriginal->getRecordClassname();
        $this->assertInternalType('string', $classname);

        $this->dao->set($classname, '\Vegas\Tests\Stub\Models\Dao\StaticData');

        $daoOverriden = $this->dao->get('\Vegas\Tests\Stub\Models\FakeWithDao');
        $this->assertNotInstanceOf('\Vegas\Tests\Stub\Models\Dao\FakeWithDao', $daoOverriden);
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\Dao\StaticData', $daoOverriden);

        $this->assertNotSame($daoOverriden, $daoOriginal);
    }

    public function testDaoDoesNotRequireChildModel()
    {
        $this->assertFalse(class_exists('\Vegas\Tests\Stub\Models\StaticData'));
        $dao = $this->dao->get('\Vegas\Tests\Stub\Models\StaticData');
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\Dao\StaticData', $dao);

        $staticData = [
            'foo' => 'bar',
            'xyz' => 'zyx'
        ];
        $this->assertSame($staticData, $dao->findAll());
    }
}