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


use Vegas\Db\Decorator\ModelAbstract;

class FakeModel extends ModelAbstract
{
    public $id;

    public $title;

    public $content;

    public $category_id;

    public $created_at;

    public $updated_at;

    public function getSource()
    {
        return 'fake_table';
    }
}