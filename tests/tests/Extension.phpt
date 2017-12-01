<?php

namespace AlgoliaSearch\Nette\Tests;

use Nette;
use AlgoliaSearch\Nette\Client;
use Tester;
use Tester\Assert;

require_once __DIR__.'/../bootstrap.php';

class ExtensionTest extends Tester\TestCase
{
    /**
     * @param $configFile
     * @return Nette\DI\Container
     */
    public function createContainer($configFile)
    {
        $config = new Nette\Configurator();

        $config->setTempDirectory(TEMP_DIR);
        $config->addParameters(array('container' => array('class' => 'SystemContainer_'.md5($configFile))));
        $config->addConfig(__DIR__.'/config/'.$configFile.'.neon');

        return $config->createContainer();
    }

    public function testExtensionRegistration()
    {
        $container = $this->createContainer('default');
        $algoliaSearch = $container->getByType('AlgoliaSearch\Nette\Client');
        
        Assert::true($algoliaSearch instanceof Client);
    }

    public function testExtensionParameters()
    {
        $self = $this;

        Assert::throws(function () use ($self) {
            $self->createContainer('emptyParameters');
        }, 'AlgoliaSearch\Nette\InvalidArgumentException', 'Parameter applicationId is required.');

        Assert::throws(function () use ($self) {
            $self->createContainer('missingApiKey');
        }, 'AlgoliaSearch\Nette\InvalidArgumentException', 'Parameter apiKey is required.');

        Assert::throws(function () use ($self) {
            $self->createContainer('invalidHosts');
        }, 'AlgoliaSearch\Nette\InvalidArgumentException', 'Parameter hosts must be type of array.');

        Assert::throws(function () use ($self) {
            $self->createContainer('invalidOptions');
        }, 'AlgoliaSearch\Nette\InvalidArgumentException', 'Parameter options must be type of array.');
    }

    public function testFullConfiguration()
    {
        $container = $this->createContainer('fullConfiguration');
        $algoliaSearch = $container->getByType('AlgoliaSearch\Nette\Client');

        Assert::true($algoliaSearch instanceof Client);
    }

    public function testSearchOnlyKey()
	{
		$container = $this->createContainer('searchOnlyKey');
		/** @var Client $algoliaSearch */
		$algoliaSearch = $container->getByType('AlgoliaSearch\Nette\Client');

		Assert::same($algoliaSearch->getSearchOnlyKey(), 'aabb1122');

		Assert::throws(function () use ($algoliaSearch) {
			$algoliaSearch->setSearchOnlyKey(null);
		}, 'TypeError');
	}
}

$testCase = new ExtensionTest();
$testCase->run();