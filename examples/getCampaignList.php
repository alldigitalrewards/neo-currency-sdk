<?php

use AllDigitalRewards\NeoCurrency\Campaigns\CampaignListRequest;
use AllDigitalRewards\NeoCurrency\Campaigns\CampaignListResponse;
use AllDigitalRewards\NeoCurrency\Client;

require __DIR__ . '/../vendor/autoload.php';

$request = new CampaignListRequest('a-fake-token');
$client = new Client();
/** @var CampaignListResponse $response */
$response = $client->request($request);
var_dump($response->getCampaigns());
