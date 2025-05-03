<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class WebhookController extends Controller
{
    public function biteship(Request $request)
    {
        $data = [
            'shipper_contact_name' => 'Amir',
            'shipper_contact_phone' => '088888888888',
            'shipper_contact_email' => 'biteship@test.com',
            'shipper_organization' => 'Biteship Org Test',
            'origin_contact_name' => 'Amir',
            'origin_contact_phone' => '088888888888',
            'origin_address' => 'Plaza Senayan, Jalan Asia Afrika',
            'origin_note' => 'Dekat pintu masuk STC',
            'origin_postal_code' => 12440,
            'destination_contact_name' => 'John Doe',
            'destination_contact_phone' => '088888888888',
            'destination_address' => 'Lebak Bulus MRT',
            'destination_postal_code' => 12950,
            'destination_note' => 'Near the gas station',
            'courier_company' => 'jne',
            'courier_type' => 'reg',
            'courier_insurance' => 500000,
            'delivery_type' => 'now',
            'order_note' => 'Please be careful',
            'metadata' => [],
            'items' => [
                [
                    'name' => 'Black L',
                    'description' => 'White Shirt',
                    'category' => 'fashion',
                    'value' => 165000,
                    'quantity' => 1,
                    'height' => 10,
                    'length' => 10,
                    'weight' => 200,
                    'width' => 10,
                ],
                [
                    'name' => 'Black X',
                    'description' => 'White Shirt',
                    'category' => 'fashion',
                    'value' => 165000,
                    'quantity' => 1,
                    'height' => 10,
                    'length' => 10,
                    'weight' => 200,
                    'width' => 10,
                ]
            ]
        ];
        
        // Mengirim permintaan POST ke API Biteship
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.biteship.key'),
        ])->post('https://api.biteship.com/v1/orders', $data);
        
        // Menangani respons
        if ($response->successful()) {
            return response()->json([
                'message' => 'Order berhasil dibuat',
                'data' => $response->json()
            ]);
        } else {
            return response()->json([
                'message' => 'Gagal membuat order',
                'error' => $response->json()
            ], 400);
        }
    }
}
