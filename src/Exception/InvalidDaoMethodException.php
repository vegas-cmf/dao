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

namespace Vegas\Db\Dao\Exception;

use Vegas\Db\Exception;

/**
 * Class InvalidDaoMethodException
 * @package Vegas\Db\Dao\Exception
 */
class InvalidDaoMethodException extends Exception
{
    protected $message = 'Dao method does not exist.';
}