<?php

namespace App\Http\Controllers\Common;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class PusheController extends Controller
{

   static public function sendPushNotification($data,$options, $to) 
    {      

        $client = new Client();
        $url = 'https://api.pushy.me/push?api_key=5acef1218e88c8e7d98a2d65e5e47070821b2d3c552947ee250c35cbc1d6489d';

        $notificationData = [
            // 'content_available' => true,
            // 'mutable_content'=>true,
            'to' => $to,
	        'data' => $data,
            'notification'=>$options
        ];
        // dd($notificationData);
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $notificationData,
        ]);
        $response->getBody()->getContents();
    }

    static public function unsubscribe($token) 
    {      

        $client = new Client();
        $url = 'https://api.pushy.me/topics/unsubscribe?api_key=5acef1218e88c8e7d98a2d65e5e47070821b2d3c552947ee250c35cbc1d6489d';

        $postData = [
            'token' => $token,
	        'topics' => ['GoDirect']
        ];
        
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $postData,
        ]);
        $response->getBody()->getContents();
    }

    static public function subscribe($token) 
    {      

        $client = new Client();
        $url = 'https://api.pushy.me/topics/subscribe?api_key=5acef1218e88c8e7d98a2d65e5e47070821b2d3c552947ee250c35cbc1d6489d';

        $postData = [
            'token' => $token,
	        'topics' => ["GoDirect"]
        ];
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $postData,
        ]);
        $response->getBody()->getContents();
    }

    
}
