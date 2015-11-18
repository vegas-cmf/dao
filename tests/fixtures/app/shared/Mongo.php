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
 * Class Mongo
 * @package App\Shared
 */
class Mongo implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'mongo';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider(DiInterface $di)
    {
        return function() use ($di) {
            $mongo = new \MongoClient();
            return $mongo->selectDb($di->get('config')->mongo->db);
        };
    }
} 