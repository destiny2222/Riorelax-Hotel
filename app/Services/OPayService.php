<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OPayService
{
    private $secretKey;
    private $merchantId;
    private $baseUrl;

    public function __construct()
    {
        $this->merchantId = config('services.opay.merchant_id');
        $this->secretKey = config('services.opay.secret_key');
        $this->baseUrl = config('services.opay.base_url');
    }

    /**
     * Create payment
     */
    public function createPayment(array $paymentData)
    {
       
        try {
            $url = $this->baseUrl . '/api/v1/international/payment/create';
            
            $data = [
                'amount' => $paymentData['amount'],
                'bankcard' => $paymentData['bankcard'] ?? null,
                'callback_url' => $paymentData['callback_url'],
                'country' => $paymentData['country'] ?? 'NG',
                'payMethod' => $paymentData['pay_method'] ?? 'BankCard',
                'product' => $paymentData['product'],
                'reference' => $paymentData['reference'],
                'returnUrl' => $paymentData['return_url']
            ];

             

            // Remove null values
            $data = array_filter($data, function($value) {
                return $value !== null;
            });

            $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
            $auth = $this->generateAuth($jsonData);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $auth,
                'MerchantId' => $this->merchantId
            ])->post($url, $data);
             
            // $result = $response;
            // dd($response);
            // return $result;

            

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Payment creation failed: ' . $response->body());

        } catch (Exception $e) {
            Log::error('OPay Payment Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate HMAC authentication
     */
    private function generateAuth(string $data): string
    {
        return hash_hmac('sha512', $data, $this->secretKey);
    }

    /**
     * Verify callback signature
     */
    public function verifyCallback(array $callbackData): bool
    {
        $signature = $callbackData['signature'] ?? '';
        unset($callbackData['signature']);
        
        $dataString = json_encode($callbackData, JSON_UNESCAPED_SLASHES);
        $expectedSignature = $this->generateAuth($dataString);
        
        return hash_equals($expectedSignature, $signature);
    }
}