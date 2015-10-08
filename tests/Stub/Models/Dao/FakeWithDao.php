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

namespace Vegas\Tests\Stub\Models\Dao;


use Vegas\Db\Dao\DefaultDao;

/**
 * Class FakeWithDao
 * Sample of custom implementation of DAO for specific class
 * @package Vegas\Tests\Stub\Models\Dao
 */
class FakeWithDao extends DefaultDao
{
    public function findOnlyActive()
    {
        return $this->find([
            ['active' => true]
        ]);
    }
}