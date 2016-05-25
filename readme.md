# AlgoliaSearch for Nette

This extention integrates [algolia/algoliasearch-client-php](https://github.com/algolia/algoliasearch-client-php) into Nette framework.

More information about Algolia can be found on it's [website](https://www.algolia.com) or in [the offical documentation](https://www.algolia.com/doc).

[![Build Status](https://travis-ci.org/algolia/algoliasearch-nette.svg?branch=master)](https://travis-ci.org/algolia/algoliasearch-nette)

## Installation

Install the extension by using Composer command:
```sh
$ composer require algolia/algoliasearch-nette
```

and register it in `config.neon`:

```yaml
extensions:
    algoliaSearch: AlgoliaSearch\Nette\DI\AlgoliaSearchExtension
```

## Minimal configuration

```yaml
algoliaSearch:
    applicationId: <your_app_id>
    apiKey: <your_api_key>
```