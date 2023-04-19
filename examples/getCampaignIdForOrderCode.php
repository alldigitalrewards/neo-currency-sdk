<?php

use AllDigitalRewards\NeoCurrency\Campaigns\Campaign;
use AllDigitalRewards\NeoCurrency\Campaigns\CampaignListRequest;
use AllDigitalRewards\NeoCurrency\Campaigns\CampaignListResponse;
use AllDigitalRewards\NeoCurrency\Funds\FundListResponse;
use AllDigitalRewards\NeoCurrency\Funds\FundListRequest;
use AllDigitalRewards\NeoCurrency\Client;

require __DIR__ . '/../vendor/autoload.php';

$request = new CampaignListRequest('a-fake-token');
$client = new Client();
/** @var CampaignListResponse $response */
$campaignsResponse = $client->request($request);
/** @var Campaign[] $campaigns */
$campaigns = $campaignsResponse->getCampaigns();

//To get the Campaign ID for a Currency you will need to fetch Funds list
//and then get the currency_id from the Fund object where the currency_code matches the Currency passed
$request = new FundListRequest('a-fake-token');
$client = new Client();
/** @var FundListResponse $fundsResponse */
$fundsResponse = $client->request($request);
$fundId = $fundsResponse->getFundIdByCurrencyCode('EUR');

//then search the Campaigns list for the Campaign with the matching fund id
//and thats the Campaign we want to be used to create an order code
foreach ($campaigns as $campaign) {
    if ($campaign->getFundId() === $fundId) {
        var_dump($campaign->getId());
    }
}
