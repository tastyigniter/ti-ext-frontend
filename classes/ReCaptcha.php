<?php

namespace Igniter\Frontend\Classes;

use GuzzleHttp\Client;

class ReCaptcha
{
    /**
     * The API request URI
     */
    const API_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $version;

    protected $httpClient;

    /**
     * ReCaptcha constructor.
     *
     * @param string $secretKey
     * @param string $version
     */
    public function __construct($secretKey, $version = 'v2')
    {
        $this->secretKey = $secretKey;
        $this->version = $version;
    }

    /**
     * @param mixed $httpClient
     */
    public function setHttpClient($httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient ?? new Client();
    }

    /**
     * Call out to reCAPTCHA and process the response
     *
     * @param string $response
     * @param string $clientIp
     *
     * @return boolean
     */
    public function verifyResponse($response, $clientIp = null)
    {
        if (empty($response))
            return FALSE;

        if (is_null($clientIp))
            $clientIp = request()->getClientIp();

        $httpResponse = $this->getHttpClient()->post(static::API_VERIFY_URL, [
            'form_params' => $this->buildRequestQuery($response, $clientIp),
        ]);

        $parsedResponse = json_decode($httpResponse->getBody(), TRUE);

        return isset($parsedResponse['success']) AND $parsedResponse['success'] === TRUE;
    }

    protected function buildRequestQuery($response, $clientIp)
    {
        return [
            'secret' => $this->secretKey,
            'response' => $response,
            'remoteip' => $clientIp,
        ];
    }
}