<?php

namespace App\Lib;

use Illuminate\Support\Facades\Http;

class Wappin
{
    protected $baseUrl;

    protected $authToken;

    /**
     * Initializes the Wappin class with base URL and authentication token.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseUrl   = config('wappin.base_url');
        $this->authToken = config('wappin.auth_key');
    }

    public function getToken()
    {
        $endpoint = '/users/login';
        $response = Http::withHeaders([
            'Authorization' => 'Basic '.$this->authToken,
            'Accept'        => 'application/json',
        ])->post($this->baseUrl.$endpoint);

        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['users'][0]['token'])) {
                return $responseData['users'][0]['token'];
            }
        }

        return null;
    }

    public function sendMessage($phoneNumber, $message)
    {
        $endpoint    = '/messages';
        $phoneNumber = self::formatPhoneNumber($phoneNumber);

        $body = [
            'to'       => $phoneNumber,
            'type'     => 'template',
            'template' => [
                'name'      => 'sipetir_general',
                'namespace' => 'sipetir_general',
                'language'  => [
                    'policy' => 'deterministic',
                    'code'   => 'id',
                ],
                'components' => [
                    [
                        'type'       => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $message,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->getToken(),
            'Accept'        => 'application/json',
        ])->post($this->baseUrl.$endpoint, $body);

        if ($response->successful()) {
            return $response;
        }
    }

    /**
     * Formats a phone number to a standardized format.
     *
     * @param  string  $phoneNumber  The phone number to be formatted.
     * @return string The formatted phone number.
     */
    public function formatPhoneNumber($phoneNumber)
    {
        // Check if the phone number starts with '+62'
        if (strpos($phoneNumber, '+62') === 0) {
            return $phoneNumber;
        }

        // Check if the phone number starts with '0'
        if (strpos($phoneNumber, '0') === 0) {
            return '+62'.substr($phoneNumber, 1);
        }

        // Check if the phone number starts with '62'
        if (strpos($phoneNumber, '62') === 0) {
            return '+'.$phoneNumber;
        }

        // Check if the phone number is 11 or 12 digits long and starts with any other digit
        if (ctype_digit($phoneNumber) && (strlen($phoneNumber) == 11 || strlen($phoneNumber) == 12)) {
            return '+62'.$phoneNumber;
        }

        // Return the original phone number if none of the above conditions are met
        return $phoneNumber;
    }
}
