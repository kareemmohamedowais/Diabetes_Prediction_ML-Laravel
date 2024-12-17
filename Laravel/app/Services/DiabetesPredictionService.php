<?php
namespace App\Services;

use GuzzleHttp\Client;

class DiabetesPredictionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:5000', // رابط Flask API
        ]);
    }


    public function predict(array $data)
    {
        try {
            $response = $this->client->post('/predict', [
                'json' => $data
            ]);
            // dd(json_decode($response->getBody(), true));

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
