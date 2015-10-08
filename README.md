Vegas CMF DAO
======================

[![Build Status](https://travis-ci.org/vegas-cmf/dao.png?branch=master)](https://travis-ci.org/vegas-cmf/dao)
[![Coverage Status](https://coveralls.io/repos/vegas-cmf/dao/badge.png?branch=master)](https://coveralls.io/r/vegas-cmf/dao?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/vegas-cmf/dao.svg)](https://packagist.org/packages/vegas-cmf/dao)
[![Total Downloads](https://img.shields.io/packagist/dt/vegas-cmf/dao.svg)](https://packagist.org/packages/vegas-cmf/dao)

DAO library adapts the Data Access Object pattern to your application.

**Installation**

Set `\Vegas\Db\Dao\Manager` class as a service by adding following snippet into your `services` directory:
```php
use Phalcon\DiInterface;
use Vegas\DI\ServiceProviderInterface;

/**
 * Class DaoServiceProvider
 */
class DaoServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'dao';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function() use ($di) {
            $dao = new \Vegas\Db\Dao\Manager;
            return $dao->setDI($di);
        }, true);
    }

    public function getDependencies()
    {
        return [];
    }
}
```

**Example usage:**

Inside injection-aware class:
```php
$modelName = '\Foo\Models\Bar';
$model = new $modelName;

$daoManager = $this->getDI()->get('dao');

/** @var \Foo\Models\Dao\Bar $dao */
$dao = $daoManager->get($modelName);
// or
$dao = $daoManager->get($model);

/** @var \Foo\Models\Bar $result */
$result = $dao->findById('example_id');

/** @var \Foo\Models\Bar[] $results */
$results = $dao->findAll();
```

For the full list of available methods please examine `\Vegas\Db\Dao\DefaultDao` class.