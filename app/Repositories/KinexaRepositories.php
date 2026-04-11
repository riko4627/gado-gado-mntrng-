<?php

namespace App\Repositories;

use App\Interfaces\KinexaInterfaces;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KinexaRepositories implements KinexaInterfaces
{
    private $baseUrl;
    private $apiKey;
    private $apiSecret;

    public function __construct()
    {
        $this->baseUrl = config('services.kinexa.base_url', env('KINEXA_BASE_URL'));
        $this->apiKey = config('services.kinexa.api_key', env('KINEXA_API_KEY'));
        $this->apiSecret = config('services.kinexa.api_secret', env('KINEXA_API_SECRET'));
    }

    /**
     * Get the Bearer token from Kinexa API or Cache
     */
    private function getBearerToken()
    {
        return Cache::remember('kinexa_bearer_token', 3500, function () {
            if (empty($this->apiKey) || empty($this->apiSecret)) {
                Log::error('Kinexa: Missing API credentials');
                return null;
            }

            if (empty($this->baseUrl)) {
                Log::error('Kinexa: Missing base_url config');
                return null;
            }

            Log::info('Kinexa: Requesting token', ['url' => $this->baseUrl . 'api/v1/client/grant-token']);

            $response = Http::timeout(30)->post($this->baseUrl . 'api/v1/client/grant-token', [
                'api_key' => $this->apiKey,
                'api_secret' => $this->apiSecret,
            ]);

            Log::info('Kinexa token response', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                $jsonData = $response->json();
                $token = $jsonData['data'] ?? null;
                if ($token) {
                    return $token;
                }
            }

            Log::error('Kinexa: Failed to get token', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        });
    }

    /**
     * Fetch the Pegawai Summary data
     */
    public function getPegawaiSummary()
    {
        $token = $this->getBearerToken();

        if (!$token) {
            return [
                'status' => 'error',
                'message' => 'Failed to obtain access token. Check storage/logs/laravel.log for details.'
            ];
        }

        Log::info('Kinexa: Fetching summary data', ['url' => $this->baseUrl . 'api/v1/ex/pegawai/summary']);

        $response = Http::timeout(30)
            ->withToken($token)
            ->get($this->baseUrl . 'api/v1/ex/pegawai/summary');

        Log::info('Kinexa summary response', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->successful()) {
            // $data = $response->json();
            // return [
            //     'status' => 'success',
            //     'data' => $data
            // ];
            $data = $response->json();

            return [
                'status' => 'success',
                'data' => $data['data'] ?? []
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Failed to fetch summary data: ' . $response->status(),
            'details' => $response->body()
        ];
    }
}
