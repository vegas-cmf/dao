<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Phalcon\DiInterface;
use Phalcon\Mvc\Url as UrlResolver;
use Vegas\DI\ServiceProviderInterface;

/**
 * Class UrlServiceProvider
 */
class MongoServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'mongo';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function() use ($di) {
            $mongo = new \MongoClient();
            return $mongo->selectDb($di->get('config')->mongo->db);
        }, true);
    }

    public function getDependencies()
    {
        return array(
            CollectionManagerServiceProvider::SERVICE_NAME
        );
    }
} 