<?php
/**
 * This file is part of Vegas package
 *
 * @author Radosław Fąfara <radek@amsterdamstandard.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Shared;

use Phalcon\DiInterface;
use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class Db
 * @package App\Shared
 */
class Db implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'db';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider(DiInterface $di)
    {
        return function() use ($di) {
            return new \Phalcon\Db\Adapter\Pdo\Mysql($di->get('config')->db->toArray());
        };
    }
} 