<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Class PaymobService.
 */
class PaymobService
{
    protected $client;
    protected $apiKey;
    protected $integrationId;
    protected $iframeId;
    protected $hmacSecret;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://accept.paymobsolutions.com/api/']);
        $this->apiKey = env('PAYMOB_API_KEY');
        $this->integrationId = env('PAYMOB_INTEGRATION_ID');
        $this->iframeId = env('PAYMOB_IFRAME_ID');
        $this->hmacSecret = env('PAYMOB_HMAC');
    }

    public function authenticate()
    {
        $response = $this->client->post('auth/tokens', [
            'json' => ['api_key' => $this->apiKey]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
    public function createOrder($data)
    {
        $token = $this->authenticate()['token'];

        $response = $this->client->post('ecommerce/orders', [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createPaymentKey($data)
    {
        $token = $this->authenticate()['token'];

        $response = $this->client->post('acceptance/payment_keys', [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
    public function getIframeUrl($paymentKey)
    {
        return "https://accept.paymobsolutions.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentKey}";
    }

    public function getIntegrationId()
    {
        return $this->integrationId;
    }
}
