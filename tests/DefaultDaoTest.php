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


use Phalcon\DI;
use Vegas\Db\Dao\Manager;
use Vegas\Test\TestCase;
use Vegas\Tests\Stub\Models\FakeWithDao;

class DefaultDaoTest extends TestCase
{
    /**
     * @var Manager
     */
    private $dao;

    public static function setUpBeforeClass()
    {
        $di = DI::getDefault();
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
        $di = DI::getDefault();
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

    public function testShouldFindRecordByItsId()
    {
        $dao = $this->dao->get('Vegas\Tests\Stub\Models\FakeWithDao');

        $collection = new FakeWithDao;
        $collection->save();
        $id = $collection->getId();

        $found = $dao->findById($id);
        $this->assertInstanceOf('\Vegas\Tests\Stub\Models\FakeWithDao', $found);

        $this->assertSame((string)$id, (string)$found->getId());

        $found->delete();

        $notFound = $dao->findById($id);
        $this->assertEmpty($notFound);
    }
}