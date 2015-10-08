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

namespace Vegas\Tests\Stub\Models;


use Vegas\Db\Decorator\CollectionAbstract;

class FakeWithDao extends CollectionAbstract
{
    public function getSource()
    {
        return 'fake_with_dao';
    }
}