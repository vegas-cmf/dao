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

use Phalcon\Di\InjectionAwareInterface;
use Vegas\Di\InjectionAwareTrait;

/**
 * Class Manager
 * @package Vegas\Db\Dao
 */
class Manager implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * Used to lookup for DAO classes - relative to model/collection fully qualified classname
     */
    const NAMESPACE_SUFFIX = 'Dao';

    /**
     * @var array
     */
    protected $repositories = [];

    /**
     * Shorthand method for retrieving DAO for scaffolding-aware area.
     * @todo rewrite scaffolding to Vegas 2.0
     * @return mixed DAO-type
     */
    public function getDefault()
    {
        return $this->get($this->getDI()->get('scaffolding')->getRecord());
    }

    /**
     * @param mixed $name a model/collection name or instance
     * @return mixed requested DAO
     */
    public function get($name)
    {
        $classname = $this->resolveRecordName($name);
        if (!isset($this->repositories[$classname])) {
            $this->set($name, $this->resolveRepositoryName($classname));
        }
        return $this->repositories[$classname];
    }

    /**
     * Allows to override default DAO for specific class.
     * @param mixed $name a model/collection name or instance
     * @param string $daoName DAO classname
     * @return $this
     */
    public function set($name, $daoName)
    {
        $classname = $this->resolveRecordName($name);

        $dao = $this->createInstanceWithFallback($daoName);
        if ($dao instanceof InjectionAwareInterface) {
            $dao->setDI($this->getDI());
        }
        if ($dao instanceof DaoInterface) {
            $dao->setRecordClassname($classname);
        }

        $this->repositories[$classname] = $dao;
        return $this;
    }

    /**
     * Converts input parameter into valid model/collection name.
     * Note that it doesn't have to exist, a DAO class file is enough.
     * @param mixed $name a model/collection name or instance
     * @return string
     */
    protected function resolveRecordName($name)
    {
        if (is_object($name)) {
            return get_class($name);
        }
        return ltrim((string)$name, '\\');
    }

    /**
     * Converts model/collection name into repository classname
     * Example:
     * \Foo\Models\Bar -> \Foo\Models\Dao\Bar
     * @param string $recordName
     * @return string
     */
    protected function resolveRepositoryName($recordName)
    {
        $classnameChunks = explode('\\', $recordName);
        $classname = array_pop($classnameChunks);
        $classnameChunks[] = static::NAMESPACE_SUFFIX;
        $classnameChunks[] = $classname;
        return '\\' . ltrim(implode('\\', $classnameChunks), '\\');
    }

    /**
     * Creates an instance of DAO provided either in code or the default one.
     * @param string $classname
     * @return mixed
     */
    protected function createInstanceWithFallback($classname)
    {
        if (class_exists($classname)) {
            return new $classname;
        } else {
            return new DefaultDao;
        }
    }
}