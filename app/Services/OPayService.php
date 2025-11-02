<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OPayService
{
    protected $baseUrl;
    protected $merchantId;
    protected $publicKey;
    protected $privateKey;

    public function __construct()
    {
        $this->baseUrl   = config('opay.base_url');
        $this->merchantId = config('opay.merchant_id');
        $this->publicKey  = config('opay.public_key');
        $this->privateKey = config('opay.private_key');
    }

    /**
     * Create Order (Cashier Create)
     * Uses Bearer + MerchantId headers (NO signature here).
     */
    public function createOrder(array $data)
    {
        $url = "{$this->baseUrl}/api/v1/international/cashier/create";

        // $data['merchantId'] = $this->merchantId;

        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->publicKey,
            'MerchantId'    => $this->merchantId,
        ])->post($url, $data);

        // Log::info('OPay Create Order Response', ['body' => $response->json()]);

        return $response->json();
    }

    /**
 * Verify Transaction (Query Payment Status)
 * Uses Authorization (Bearer signature) + MerchantId header.
 */
public function verifyTransaction(string $reference)
{
    $url = "{$this->baseUrl}/api/v1/international/cashier/status";

    // Build request body - these fields will be used to generate signature
    $dataForSignature = [
        'country'    => 'NG',
        'merchantId' => $this->merchantId,
        'reference'  => $reference,
    ];

    // Generate signature from the data (without the signature field itself)
    $signature = $this->generateSignature($dataForSignature);

    // Now build the complete request body including the signature
    $requestBody = [
        'country'    => 'NG',
        'merchantId' => $this->merchantId,
        'reference'  => $reference,
        'signature'  => $signature,  // Add signature to body
    ];

    // Debug log
    Log::info('OPay Verify Request Debug', [
        'url' => $url,
        'headers' => [
            'Authorization' => 'Bearer ' . substr($signature, 0, 20) . '...',
            'MerchantId' => $this->merchantId,
        ],
        'body' => $requestBody,
        'privateKeyLength' => strlen($this->privateKey),
        'publicKeyLength' => strlen($this->publicKey),
    ]);

    $response = Http::withHeaders([
        'Content-Type'  => 'application/json',
        'Authorization' => 'Bearer ' . $signature,  // Use signature in Authorization
        'MerchantId'    => $this->merchantId,
    ])->post($url, $requestBody);

    Log::info('OPay Verify Transaction Response', [
        'reference' => $reference, 
        'status' => $response->status(),
        'body' => $response->json()
    ]);

    return $response->json();
}


//  public function verifyTransaction(string $reference)
// {
//     $url = "https://testapi.opaycheckout.com/api/v1/international/cashier/status";

//     $payload = [
//         "country"   => "NG",
//         "reference" => $reference,
//     ];

//     $jsonString = json_encode($payload, JSON_UNESCAPED_SLASHES);

//     $signature = hash_hmac('sha512', $jsonString, $this->privateKey);

//     $response = Http::withHeaders([
//         'Content-Type'  => 'application/json',
//         'MerchantId'    => $this->merchantId,
//         'Authorization' => 'Bearer ' . $signature,
//     ])->withBody($jsonString, 'application/json') // 🔑 exact JSON string
//       ->post($url);

//     return $response->json();
// }



    /**
     * Verify Webhook Callback
     * OPay sends { payload, sha512, type }.
     */
    public function verifyCallback(array $payload, string $signature): ?array
    {
        if (!$payload || !$signature) {
            return null;
        }

        $expected = hash_hmac(
            'sha512',
            json_encode($payload, JSON_UNESCAPED_SLASHES),
            $this->privateKey
        );

        if (!hash_equals($expected, $signature)) {
            Log::error("Invalid OPay callback signature", [
                'expected' => $expected,
                'provided' => $signature,
            ]);
            return null;
        }

        return $payload;
    }

    /**
     * Generate Signature for Query Status
     */
    private function generateSignature(array $data): string
    {
        ksort($data);
        $json = json_encode($data, JSON_UNESCAPED_SLASHES);
        $signature = hash_hmac('sha512', $json, $this->privateKey);

        Log::info('OPay Signature Debug', [
            'input_data' => $data,
            'sorted_json' => $json,
            'signature' => $signature,
            'signature_length' => strlen($signature)  // Should be 128
        ]);

        return $signature;
    }
}
