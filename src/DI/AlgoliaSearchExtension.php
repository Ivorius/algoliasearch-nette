<?php

namespace petrjirasek\AlgoliaSearch\DI;

use Nette;
use petrjirasek\AlgoliaSearch\InvalidArgumentException;

/**
 * @author Petr Jirásek
 */
class AlgoliaSearchExtension extends Nette\DI\CompilerExtension
{
    public $defaults = array(
        'applicationId' => null,
        'apiKey' => null,
        'hosts' => null,
        'options' => array(),
    );

    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);

        $builder = $this->getContainerBuilder();
        $applicationId = $config['applicationId'];
        $apiKey = $config['apiKey'];
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

        $builder->addDefinition($this->prefix('algoliaSearch'))
            ->setClass('petrjirasek\AlgoliaSearch\Client', array($applicationId, $apiKey, $hosts, $options));
    }
}