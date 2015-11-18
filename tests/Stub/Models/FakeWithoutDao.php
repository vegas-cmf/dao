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


use Vegas\ODM\Collection;

class FakeWithoutDao extends Collection
{
    public function getSource()
    {
        return 'fake_without_dao';
    }

    public function getId()
    {
        return 'fake_without_dao_id';
    }

    public function getTitle()
    {
        return 'Fake without DAO';
    }
}