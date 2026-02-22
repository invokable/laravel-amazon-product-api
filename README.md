# Amazon Product Advertising API for Laravel

[![Maintainability](https://qlty.sh/badges/0b83095f-5fbb-441c-906f-60a51d064f5b/maintainability.svg)](https://qlty.sh/gh/invokable/projects/laravel-amazon-product-api)
[![Code Coverage](https://qlty.sh/badges/0b83095f-5fbb-441c-906f-60a51d064f5b/test_coverage.svg)](https://qlty.sh/gh/invokable/projects/laravel-amazon-product-api)

## End of active support (2020/06)
The recent Amazon Product Advertising API has become more restrictive and difficult to use.  
Although we support the latest Laravel/PHP, it is in maintenance mode with no other development work.

## Requirements
- PHP >= 8.3
- Laravel >= 12.0

## Installation

```
composer require revolution/laravel-amazon-product-api
```

### Uninstall
```
composer remove revolution/laravel-amazon-product-api
```

### Publishing config (Optional)
```bash
php artisan vendor:publish --tag=amazon-product-config
```

### .env
```bash
AMAZON_API_KEY=
AMAZON_API_SECRET_KEY=
AMAZON_ASSOCIATE_TAG=
AMAZON_HOST=webservices.amazon.com
AMAZON_REGION=us-east-1
```

### Country lists
https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html

## Note
- API Rate limit https://webservices.amazon.com/paapi5/documentation/troubleshooting/api-rates.html

## Usage

```php
<?php
use Revolution\Amazon\ProductAdvertising\Facades\AmazonProduct;

# string $category, string $keyword = null, int $page = 1
$response = AmazonProduct::search(category: 'All', keyword: 'amazon' , page: 1);
dd($response);
# returns normal array

# string $browse Browse node
$response = AmazonProduct::browse(node: '1');

# string $asin ASIN
$response = AmazonProduct::item(asin: 'ASIN1');

# array $asin ASIN
$response = AmazonProduct::items(asin: ['ASIN1', 'ASIN2']);

# setIdType: support only item() and items()
$response = AmazonProduct::setIdType(idType: 'EAN')->item(asin: 'EAN');
# reset to ASIN
AmazonProduct::setIdType(idType: 'ASIN');
# PA-APIv5 not support EAN?
```

`browse()` is not contains detail data.

```php
use Revolution\Amazon\ProductAdvertising\Facades\AmazonProduct;

$response = AmazonProduct::browse(node: '1');
$nodes = data_get($response, 'BrowseNodesResult');
$items = data_get($nodes, 'BrowseNodes.TopSellers.TopSeller');
$asins = data_get($items, '*.ASIN');
$results = AmazonProduct::items(asin: $asins);
# PA-APIv5 not support TopSeller?
```

Probably, you need try-catch or Laravel's `rescue()` helper.

```php
use Revolution\Amazon\ProductAdvertising\Facades\AmazonProduct;

try {
    $response = AmazonProduct::browse(node: '1');
} catch(ApiException $e) {

}

$response = rescue(function () use ($browse_id) {
                return AmazonProduct::browse(node: $browse_id);
            }, []);
```

## LICENSE
MIT  
Copyright kawax
