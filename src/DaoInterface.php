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

namespace Vegas\Db\Dao;

/**
 * Interface DaoInterface
 * @package Vegas\Db\Dao
 */
interface DaoInterface
{
    /**
     * Stores related collection/model classname for default find/create methods
     * @param string|null $name
     * @return $this
     */
    public function setRecordClassname($name);

    /**
     * Gets related collection/model classname
     * @return string|null
     */
    public function getRecordClassname();
}