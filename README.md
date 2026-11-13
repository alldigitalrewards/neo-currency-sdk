# NeoCurrency SDK

PHP client for the NeoCurrency B2B API v1 — docs: https://api.yourdigitalreward.com/index.html

`ENVIRONMENT=production` targets `https://api.yourdigitalreward.com/v1` (IP whitelisted); anything else targets
`https://stage.api.yourdigitalreward.com/v1`.

## Usage

```php
use AllDigitalRewards\NeoCurrency\Client;
use AllDigitalRewards\NeoCurrency\Auth\TokenRequest;
use AllDigitalRewards\NeoCurrency\Products\Product;
use AllDigitalRewards\NeoCurrency\Products\ProductsRequest;
use AllDigitalRewards\NeoCurrency\Orders\GetOrderRequest;
use AllDigitalRewards\NeoCurrency\Orders\Order;
use AllDigitalRewards\NeoCurrency\Orders\OrderRequest;
use AllDigitalRewards\NeoCurrency\Orders\OrderRequestLineItem;
use AllDigitalRewards\NeoCurrency\Exceptions\ConflictingOrderException;

$client = new Client(new \GuzzleHttp\Client(['proxy' => getenv('PROXY_URL') ?: null]));

$token = $client->request(new TokenRequest($email, $accessToken));
$bearer = $token->getValue();          // cache for $token->getExpiresIn() minutes

$page = 1;
do {
    $products = $client->request(new ProductsRequest($bearer, $page++, productType: Product::TYPE_DIGITAL));
    foreach ($products->getProducts() as $product) {
        $product->getId();                // string
        $product->getDenominations();     // Fixed: every value; Variable/VariableNoCents: [min, max]
    }
} while ($products->hasMorePages());

try {
    $order = $client->request(new OrderRequest(
        $bearer,
        Order::TYPE_LINKS,
        $guid,                            // poNumber — unique, makes retries idempotent
        [new OrderRequestLineItem($productId, 25.0, 1, $guid)]
    ))->getOrder();
} catch (ConflictingOrderException $e) {
    $order = $client->request(new GetOrderRequest($bearer, $e->getPreviousOrderIds()[0]))->getOrder();
}

$order->isFulfilled();                    // false while the order or any line item is still Pending
$order->getClaimLinks();
```

## Errors

Every non-2xx response throws `Exceptions\ApiException` (`getStatusCode()`), or one of its subclasses:

| HTTP | Exception | Details |
|---|---|---|
| 400 | `ValidationException` | `getErrors()` — property => messages |
| 409 | `ConflictingOrderException` | `getPoNumber()`, `getPreviousOrderIds()` |
| 422 | `InsufficientFundsException` | `getAvailableBalance()`, `getOrderCost()` |

## Tests

```bash
docker run --rm -v "$PWD":/app -w /app composer:2 composer install
docker run --rm -v "$PWD":/app -w /app php:8.2-cli vendor/bin/phpunit --no-coverage
docker run --rm -v "$PWD":/app -w /app php:8.2-cli vendor/bin/phpcs -p --standard=phpcs.xml src tests
```
