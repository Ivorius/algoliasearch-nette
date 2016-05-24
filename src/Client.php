<?php

namespace AlgoliaSearch\Nette;

class Client extends \AlgoliaSearch\Client
{
    /**
     * @inheritdoc
     */
    public function __construct($applicationID, $apiKey, $hostsArray = null, $options = array())
    {
        parent::__construct($applicationID, $apiKey, $hostsArray, $options);
    }
}