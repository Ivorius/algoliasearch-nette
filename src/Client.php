<?php

namespace AlgoliaSearch\Nette;

use AlgoliaSearch\Version;

class Client extends \AlgoliaSearch\Client
{
    /**
     * @inheritdoc
     */
    public function __construct($applicationID, $apiKey, $hostsArray = null, $options = array())
    {
        Version::addPrefixUserAgentSegment('Nette integration', '1.0.1');

        parent::__construct($applicationID, $apiKey, $hostsArray, $options);
    }
}