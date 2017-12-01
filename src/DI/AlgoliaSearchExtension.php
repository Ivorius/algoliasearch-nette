<?php

namespace AlgoliaSearch\Nette\DI;

use AlgoliaSearch\Nette\InvalidArgumentException;
use Nette;

class AlgoliaSearchExtension extends Nette\DI\CompilerExtension
{
    public $defaults = array(
        'applicationId' => null,
        'apiKey' => null,
        'searchOnlyKey' => null,
        'hosts' => null,
        'options' => array(),
    );

    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);

        $applicationId = $config['applicationId'];
        $apiKey = $config['apiKey'];
        $searchOnlyKey = $config['searchOnlyKey'];
        $hosts = $config['hosts'];
        $options = $config['options'];

        if (!$applicationId) {
            throw new InvalidArgumentException('Parameter applicationId is required.');
        }

        if (!$apiKey) {
            throw new InvalidArgumentException('Parameter apiKey is required.');
        }

        if (!is_string($applicationId)) {
            throw new InvalidArgumentException('Parameter applicationId must be type of string.');
        }

        if (!is_string($apiKey)) {
            throw new InvalidArgumentException('Parameter apiKey must be type of string.');
        }

        if ($hosts && !is_array($hosts)) {
            throw new InvalidArgumentException('Parameter hosts must be type of array.');
        }

        if (!is_array($options)) {
            throw new InvalidArgumentException('Parameter options must be type of array.');
        }

        $builder = $this->getContainerBuilder();
        $algoliaClient = $builder->addDefinition($this->prefix('algoliaSearch'))
            ->setClass('\AlgoliaSearch\Nette\Client', array($applicationId, $apiKey, $hosts, $options));

        if($searchOnlyKey) {
        	$algoliaClient->addSetup('setSearchOnlyKey', [$searchOnlyKey]);
		}
    }
}