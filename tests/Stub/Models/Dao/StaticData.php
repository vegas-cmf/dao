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


/**
 * Class StaticData
 * Sample of a DAO class without related model/collection.
 * @package Vegas\Tests\Stub\Models\Dao
 */
class StaticData
{
    public function findAll()
    {
        return [
            'foo' => 'bar',
            'xyz' => 'zyx'
        ];
    }
}