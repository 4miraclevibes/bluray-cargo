<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Sender;
use App\Models\ShipmentOrder;
use App\Models\ShipmentItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipmentController extends Controller
{
    public function store(Request $request){

        try {
            // Simpan order pengiriman
            $shipmentOrder = ShipmentOrder::create([
                'user_id' => Auth::user()->id,
                'tracking' => null,
                'courier_name' => $request->courier,
                'service_name' => $request->service,
                'courier_insurance' => 0,
                'status' => 'pending'
            ]);
        
            // Simpan data pengirim
            $sender = Sender::create([
                'shipment_order_id' => $shipmentOrder->id,
                'name' => $shipmentOrder->user->name,
                'phone' => $shipmentOrder->user->phone,
                'address' => $request->address
            ]);
    
            // Simpan data penerima
            $recipient = Recipient::create([
                'shipment_order_id' => $shipmentOrder->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
    
            // Simpan item
            $item = ShipmentItem::create([
                'shipment_order_id' => $shipmentOrder->id,
                'name' => 'Baju rombengan',
                'description' => 'Baju bolong',
                'price' => $request->price,
                'weight' => $request->weight
            ]);
    
            // Data untuk dikirim ke API
            $data = [
                'shipper_contact_name' => $shipmentOrder->user->name,
                'shipper_contact_phone' => $shipmentOrder->user->phone,
                'shipper_contact_email' => $shipmentOrder->user->email,
                'shipper_organization' => $shipmentOrder->service_name,
                'origin_contact_name' => $sender->name,
                'origin_contact_phone' => $sender->phone,
                'origin_address' => $sender->address,
                'origin_note' => 'Dekat pintu masuk STC',
                'origin_postal_code' => 12440,
                'destination_contact_name' => $recipient->name,
                'destination_contact_phone' => $recipient->phone,
                'destination_address' => $recipient->address,
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
                        'name' => $item->name,
                        'description' => $item->description,
                        'category' => 'fashion',
                        'value' => $item->price,
                        'quantity' => 1,
                        'height' => 10,
                        'length' => 10,
                        'weight' => $item->weight,
                        'width' => 10,
                    ]
                ]
            ];
    
            // Kirim ke API Biteship
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.biteship.key'),
            ])->post('https://api.biteship.com/v1/orders', $data);
    
            $result = $response->successful()
                ? [
                    'status' => 'success',
                    'message' => 'Order berhasil dibuat',
                    'data' => $response->json()
                ]
                : [
                    'status' => 'fail',
                    'message' => 'Gagal membuat order',
                    'data' => $response->json()
                ];
    
        } catch (\Exception $e) {
            $result = [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ];
        }

        $shipmentOrder->update([
            'tracking' => $result['data']['courier']['link'] ?? null
        ]);

        // return back()->with('success', 'SUKSES UYY');
    
        return response()
        ->json([
            'status' => $result['status'],
            'message' => $result['message'],
            'data' => $result['data'],
            'courier_tracking_link' => $shipmentOrder->tracking
        ], $result['status'] === 'success' ? 200 : 500)
        ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}
