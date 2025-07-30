<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MissaelAnda\Whatsapp\Facade\Whatsapp;
use MissaelAnda\Whatsapp\Messages\TemplateMessage;

class WhatsAppController extends Controller
{
    public function sendHelloWorld(Request $request)
    {
        try {
            // Send the template message
            Whatsapp::send(
                '6285971883066',
                TemplateMessage::create()
                    ->name('welcome')
                    ->language('id')
            );

            return response()->json([
                'status' => 'success',
                'message' => 'WhatsApp message sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // public function handleWebhook(Request $request) {
    //     // Handle the incoming webhook request from WhatsApp
    //     // You can process the request data as needed
    //     // For example, you might log the request or respond to it

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Webhook received successfully'
    //     ]);
    // }
}
