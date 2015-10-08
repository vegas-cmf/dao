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


class DefaultRepository implements DaoInterface
{
    /**
     * @var string|null
     */
    protected $classname;

    /**
     * {@inheritdoc}
     */
    public function setRecordClassname($name = null)
    {
        $this->classname = $name;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecordClassname()
    {
        return $this->classname;
    }

    /**
     * Resolves user-friendly name of a record - in case of none found, provides ID
     * @param mixed $record
     * @return mixed
     */
    protected function getRecordLabel($record)
    {
        foreach (['__toString', 'getName', 'getTitle'] as $method) {
            if (method_exists($record, $method)) {
                return $record->{$method}();
            }
        }
        foreach (['name', 'title'] as $property) {
            if (property_exists($record, $property)) {
                return $record->{$property};
            }
        }
        return $record->getId();
    }

    /**
     * Retrieves key => value array suitable for select inputs.
     * @return array
     */
    public function getForSelect()
    {
        $options = [];

        foreach ($this->find() as $record) {
            $key = (string)$record->getId();
            $val = (string)$this->getRecordLabel($record);
            $options[$key] = $val;
        }

        return $options;
    }

    /**
     * Proxy to static find method
     * @param mixed $parameters
     * @return mixed
     */
    public function find($parameters = null)
    {
        $classname = $this->getRecordClassname();
        return $classname::find($parameters);
    }

    /**
     * Proxy to static findFirst method
     * @param mixed $parameters
     * @return mixed
     */
    public function findFirst($parameters = null)
    {
        $classname = $this->getRecordClassname();
        return $classname::findFirst($parameters);
    }

    /**
     * Proxy to static findById method
     * @param mixed $id
     * @return mixed
     */
    public function findById($id)
    {
        $classname = $this->getRecordClassname();
        return $classname::findById($id);
    }

    /**
     * Proxy to static count method
     * @param mixed $parameters
     * @return mixed
     */
    public function count($parameters = null)
    {
        $classname = $this->getRecordClassname();
        return $classname::count($parameters);
    }
}