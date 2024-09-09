<?php

namespace App\Http\Controllers;

use App\Libraries\AesCipher;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use DB;
use Exception;

class GloadController extends Controller
{
    public function ocr_adhaar_verification($docType, $file_name = null)
    {
        
         if(config('app.env') != "production"){
             return 0;
         }
        $newdocType = $docType;
        if ($docType == 4) {
            $newdocType = 1;
        } else if ($docType == 5) {
            // Bank Statement Fetch
            $newdocType = 416;
        }
        $data = json_decode($this->step1('https://www.truthscreen.com/api/v2.2/idocr/token', array('transID' => '13123', 'docType' => $newdocType)));
        // print_r($data); die;
        if (empty($data->responseData)) {
            $array = array('status' => false);
            return (object)$array;
            die;
        }
        // print_r($data->responseData); die;
       
        $decrypted = json_decode(AesCipher::decrypt('India@2608', $data->responseData));
        
        
        $secretToken = $decrypted->msg->secretToken;
        $tsTransID = $decrypted->msg->tsTransID;
        
        
        $token = $this->step1('https://www.truthscreen.com/api/v2.2/idocr/tokenEncrypt', array('token' => $secretToken));
        $reqData = [];
        $fileType = '';
        if ($docType == 7) {
            $fileType = 'aadhar_card_f';
            $reqData = array('tsTransID' => $tsTransID, 'secretToken' => $token, 'front_image' => new \CURLFile($_FILES['front']['tmp_name'], $_FILES['front']['type'], $_FILES['front']['name']));
        } else if ($docType == 1) {
            $fileType = 'aadhar_card_fb';
            $reqData = array('tsTransID' => $tsTransID, 'secretToken' => $token, 'front_image' => new \CURLFile($_FILES['idProofFront']['tmp_name'], $_FILES['idProofFront']['type'], $_FILES['idProofFront']['name']), 'back_image' => new \CURLFile($_FILES['idProofBack']['tmp_name'], $_FILES['idProofBack']['type'], $_FILES['idProofBack']['name']));
        } else if ($docType == 3) {
            $fileType = 'aadhar_card_pancard';
            $reqData = array('tsTransID' => $tsTransID, 'secretToken' => $token, 'front_image' => new \CURLFile($_FILES[$file_name ?? 'panCardFront']['tmp_name'], $_FILES[$file_name ?? 'panCardFront']['type'], $_FILES[$file_name ?? 'panCardFront']['name']));
        } else if ($docType == 4) {
            $fileType = 'address_proof_fb';
            $reqData = array('tsTransID' => $tsTransID, 'secretToken' => $token, 'front_image' => new \CURLFile($_FILES['addressProofFront']['tmp_name'], $_FILES['addressProofFront']['type'], $_FILES['addressProofFront']['name']), 'back_image' => new \CURLFile($_FILES['addressProofBack']['tmp_name'], $_FILES['addressProofBack']['type'], $_FILES['addressProofBack']['name']));
        } else if ($docType == 5) {
            $fileType = 'address_proof_f';
            $reqData = array('tsTransID' => $tsTransID, 'secretToken' => $token, 'front_image' => new \CURLFile($_FILES['addressProofFront']['tmp_name'], $_FILES['addressProofFront']['type'], $_FILES['addressProofFront']['name']));
        } else {
            $fileType = 'image_f';
            $reqData = array('tsTransID' => $tsTransID, 'secretToken' => $token, 'front_image' => new \CURLFile($_FILES['front']['tmp_name'], $_FILES['front']['type'], $_FILES['front']['name']), 'back_image' => new CURLFile($_FILES['back']['tmp_name'], $_FILES['back']['type'], $_FILES['back']['name']));
        }

        $response_data = json_decode($this->step1('https://www.truthscreen.com/api/v2.2/ocrverification/verify', $reqData));

        $apih = DB::table('apihits')->insertGetId(['name' => 'truthscreen', 'type' => $fileType, 'api_url' => 'https://www.truthscreen.com/api/v2.2/ocrverification/verify', 'request_data' => json_encode($reqData)]);

        if (empty($response_data->responseData)) {
            DB::table('apihits')->where('id', $apih)->update(['status' => '0']);
            $array = array('status' => false);
            return (object)$array;
            die;
        }
        DB::table('apihits')->where('id', $apih)->update(['respont_data' => $response_data->responseData, 'status' => '1']);
        return json_decode(AesCipher::decrypt('India@2608', $response_data->responseData));
        // print_r($decrypted);
    }

    public static function adhaarlocation($lat, $long, $address)
    {
        if (config('app.env') != "production") {
            return 0;
        }
        $docType = 348;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.truthscreen.com/InstantSearch/encrypted_string",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{ "transID" : 1234,
                              "lat" : "' . $lat . '",
                              "long" : "' . $long . '",
                              "docType" : "348",
                              "address" :"' . $address . '"
                              }
             ',
            CURLOPT_HTTPHEADER => array(
                'username: prod.microcare@authbridge.com',
                'Content-Type: application/json',
                'Cookie: CAKEPHP=4vnfv01ag5alv6p37vvu3mu5j3'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.truthscreen.com/geotagging/idsearch',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"requestData":"' . $response . '"}',
            CURLOPT_HTTPHEADER => array(
                'username: prod.microcare@authbridge.com',
                'Content-Type: application/json',
                'Cookie: CAKEPHP=4vnfv01ag5alv6p37vvu3mu5j3'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        // print_r($response->responseData);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.truthscreen.com/InstantSearch/decrypt_encrypted_string',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"responseData":"' . $response->responseData . '"}',
            CURLOPT_HTTPHEADER => array(
                'username: prod.microcare@authbridge.com',
                'Content-Type: application/json',
                'Cookie: CAKEPHP=4vnfv01ag5alv6p37vvu3mu5j3'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // print_r('$response'); die;
        return json_decode($response);
    }

    public function step1($url, $data)
    {
        // if(config('app.env') != "production"){
        //     return 0;
        // }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'username: prod.microcare@authbridge.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function pancard_verification($pancard)
    {
        //dd('--'); 
        if (config('app.env') != "production") {
            return 0;
        }
        $url = "https://www.truthscreen.com/api/v2.2/idsearch";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array('Content-Type: application/json', 'username: prod.microcare@authbridge.com');

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $iv = AesCipher::getIV();

        $encrypted = AesCipher::encrypt('India@2608', $iv, '{"transID":"1234567","docType":2,"docNumber": "' . $pancard . '"}');
        // return $encrypted;
        $data = <<<DATA
		{
		"requestData" : "$encrypted"
		}
		DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);

        $res = json_decode($resp);
        // print_r($res); die;
        // var_dump($res->responseData);


        $decrypted = AesCipher::decrypt('India@2608', $res->responseData);
        $decrypted = json_decode($decrypted);
        // print_r($decrypted);
        // dd()

        DB::table('apihits')->insert(['name' => 'truthscreen', 'type' => 'pancard_number', 'api_url' => 'https://www.truthscreen.com/api/v2.2/idsearch', 'request_data' => $data, 'respont_data' => json_encode($decrypted), 'status' => 1]);
        return $decrypted;
        // var_dump($decrypted);

        // exit();
    }

    public static function addLocal($lat, $long, $address)
    {
        if (config('app.env') != "production") {
            return 0;
        }
        $url = "https://www.truthscreen.com/geotagging/idsearch";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array('Content-Type: application/json', 'username: production.microcare@equifax.com');

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $iv = AesCipher::getIV();

        $encrypted = AesCipher::encrypt('Auth@123', $iv, '{"transID":"134","docType":"348","lat": "' . $lat . '", "long": "' . $long . '", "address": "' . $address . '"}');

        $data = <<<DATA
		{
		"requestData" : "$encrypted"
		}
		DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);

        $res = json_decode($resp);
        print_r($res);
        die;
        // var_dump($res->responseData);

        $decrypted = AesCipher::decrypt('Auth@123', $res->responseData);
        $decrypted = json_decode($decrypted);

        return $decrypted;
        // var_dump($decrypted);

        // exit();
    }

    public static function adhaar_verification($adhaar = 'dbvpk2018f')
    {

        if (config('app.env') != "production") {
            return 0;
        }
        $url = "https://www.truthscreen.com/api/v2.2/idsearch";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array('Content-Type: application/json', 'username: prod.microcare@authbridge.com');

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $iv = AesCipher::getIV();

        $encrypted = AesCipher::encrypt('India@2608', $iv, '{"transID":"13","docType":"53","docNumber": "' . $adhaar . '"}');

        $data = <<<DATA
		{
		"requestData" : "$encrypted"
		}
		DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);

        $res = json_decode($resp);
        $apih = DB::table('apihits')->insertGetId(['name' => 'truthscreen', 'type' => 'aadhar_number', 'api_url' => $url, 'request_data' => $data, 'respont_data' => $res->responseData]);
        // print_r($res); die;
        // var_dump($res->responseData);
        if ($res && $res->responseData) {
            $decrypted = AesCipher::decrypt('India@2608', $res->responseData);
            $decrypted = json_decode($decrypted);
            DB::table('apihits')->where('id', $apih)->update(['status' => 1]);
            // dd($decrypted);
            return $decrypted;
        } else {
            DB::table('apihits')->where('id', $apih)->update(['status' => 0]);
            return false;
        }
    }

    public static function credit_report($data = '')
    {

        if (config('app.env') != "production") {
            return 0;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "https://eportuat.equifax.co.in/cir360Report/cir360Report",
            CURLOPT_URL => "https://ists.equifax.co.in/cir360service/cir360report",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            // CURLOPT_POSTFIELDS =>"{\r\n    \"RequestHeader\": {\r\n        \"CustomerId\": \"21\",\r\n        \"UserId\": \"UAT_MICTEC\",\r\n        \"Password\": \"abcd*1234\",\r\n        \"MemberNumber\": \"027FZ01852\",\r\n        \"SecurityCode\": \"FU1\",\r\n        \"CustRefField\": \"123456\",\r\n        \"ProductCode\": [\r\n            \"IDCCR\"\r\n        ]\r\n    },\r\n    \"RequestBody\": {\r\n        \"InquiryPurpose\": \"05\",\r\n        \"FirstName\": \"SANGITA\",\r\n        \"MiddleName\": \"BHARAT\",\r\n        \"LastName\": \"PATIL\",\r\n        \"DOB\": \"1978-10-12\",\r\n        \"InquiryAddresses\": [\r\n            {\r\n                \"seq\": \"1\",\r\n                \"AddressType\": [\r\n                    \"H\"\r\n                ],\r\n                \"AddressLine1\": \"A P MALWADI KALBE TARF THANE KARAVEER KOLHAPUR 416007\",\r\n                \"State\": \"MH\",\r\n                \"Postal\": \"416007\"\r\n            }\r\n        ],\r\n        \"InquiryPhones\": [\r\n            {\r\n                \"seq\": \"1\",\r\n                \"Number\": \"9767348858\",\r\n                \"PhoneType\": [\r\n                    \"M\"\r\n                ]\r\n            },\r\n            {\r\n                \"seq\": \"2\",\r\n                \"Number\": \"\",\r\n                \"PhoneType\": [\r\n                    \"M\"\r\n                ]\r\n            }\r\n        ],\r\n        \"IDDetails\": [\r\n            {\r\n                \"seq\": \"1\",\r\n                \"IDType\": \"T\",\r\n                \"IDValue\": \"BYWPP5444A\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"2\",\r\n                \"IDType\": \"P\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"3\",\r\n                \"IDType\": \"V\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"4\",\r\n                \"IDType\": \"D\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"5\",\r\n                \"IDType\": \"M\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            }\r\n        ],\r\n        \"MFIDetails\": {\r\n            \"FamilyDetails\": [\r\n                {\r\n                    \"seq\": \"1\",\r\n                    \"AdditionalNameType\": \"K02\",\r\n                    \"AdditionalName\": \"BHARAT KRUSHNAT PATIL\"\r\n                }\r\n            ]\r\n        }\r\n    },\r\n    \"Score\": [\r\n        {\r\n            \"Type\": \"ERS\",\r\n            \"Version\": \"3.1\"\r\n        }\r\n    ]\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Cookie: TS0185b412=0191ea91a4967760b41c3e578bc6002c6206f8c24631e7e4ec03f6b3ba0a95d1a3d345440b166a58bb20d4e0c8e4dcfc3f11bcab30"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public  function bankstatementData($file_data, $password = null)
    {
        if (config('app.env') != "production") {
            return 0;
        }
        $file = $file_data;
        $apiEndpoint = 'https://portal.finbox.in/bank-connect/v1/statement/bankless_upload/?identity=true';
        $xApiKey = 'bTd21RCMkYNa0EBjlbFHZSWsRl3utW5155pp9EI4';

        try {
            $client = new Client();

            $response = $client->post($apiEndpoint, [
                'headers' => [
                    'x-api-key' => $xApiKey,
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ],
                    [
                        'name' => 'pdf_password',
                        'contents' => $password,
                    ],
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();
            DB::table('apihits')->insert(['name' => 'finbox', 'type' => 'bankless_upload', 'api_url' => $apiEndpoint, 'respont_data' => json_encode($responseData), 'status' => 1]);
            return json_decode($responseData);
        } catch (RequestException $e) {
            return $e;
        }
    }


    public function finboxurlPdfupload($pdfImage, $userID, $password = null)
    {
        if (config('app.env') != "production") {
            return 0;
        }
        $apiEndpoint = 'https://portal.finbox.in/bank-connect/v1/statement/bankless_upload/?identity=true';
        $xApiKey = 'bTd21RCMkYNa0EBjlbFHZSWsRl3utW5155pp9EI4';

        try {
            $client = new Client();

            $response = $client->post($apiEndpoint, [
                'headers' => [
                    'x-api-key' => $xApiKey,
                ],
                'multipart' => [
                    [
                        'name' => 'file_url',
                        'contents' => $pdfImage
                    ],
                    [
                        'name' => 'pdf_password',
                        'contents' => $password,
                    ],
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody()->getContents(), true);
            DB::table('apihits')->insert(['name' => 'finbox', 'type' => 'bankless_upload', 'api_url' => $apiEndpoint, 'respont_data' => json_encode($responseData), 'status' => 1]);
            // dd($responseData);
            if ($responseData && isset($responseData['entity_id'])) {
                DB::table('user_docs')->where('userId', $userID)->update(['bank_entity_id' => $responseData['entity_id']]);
                $linkshow = $this->finboxexcleReport($responseData['entity_id']);
                // dd($responseData,$responseData['entity_id']);
                if ($linkshow) {
                    return $linkshow;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (RequestException $e) {
            return $e;
        }
    }


    public function finboxexcleReport($entity_id)
    {
        if (config('app.env') != "production") {
            return 0;
        }
        $apiEndpoint = "https://portal.finbox.in/bank-connect/v1/entity/$entity_id/xlsx_report/";

        $xApiKey = 'bTd21RCMkYNa0EBjlbFHZSWsRl3utW5155pp9EI4';
        try {
            $client = new Client();

            $response = $client->get($apiEndpoint, [
                'headers' => [
                    'x-api-key' => $xApiKey,
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody()->getContents(), true);
            DB::table('apihits')->insert(['name' => 'finbox', 'type' => 'xlsx_report', 'api_url' => $apiEndpoint, 'respont_data' => json_encode($responseData), 'status' => 1]);
            if ($responseData && isset($responseData['reports'][0]['link'])) {
                return $responseData['reports'][0]['link'];
            } else {
                return false;
            }
        } catch (RequestException $e) {
            return false;
        }
    }

    public function eportuatData($customerData)
    {
        if (config('app.env') != "production") {
            return 0;
        }
        // Initialize cURL session
        $ch = curl_init();


        // Set cURL options

        $url = 'https://ists.equifax.co.in/cir360service/cir360report';
        $data = '{
        "RequestHeader": {
            "CustomerId": "9198",
            "UserId": "STS_MAXPCS",
            "Password": "W3#QeicsB",
            "MemberNumber": "007FP13413",
            "SecurityCode": "2AI",
            "CustRefField": "123456",
            "ProductCode": [
                "PCS"
            ]
        },
        "RequestBody": {
            "InquiryPurpose": "00",
            "TransactionAmount": "0",
            "FirstName": "' . $customerData['name'] . '",
            "MiddleName": "",
            "LastName": "",
            "InquiryAddresses": [
                {
                    "seq": "1",
                    "AddressLine1": "' . $customerData['addressLine1'] . '",
                    "City": "' . $customerData['city'] . '",
                    "State": "' . $customerData['state'] . '",
                    "AddressType": [
                        "H"
                    ],
                    "Postal": "' . $customerData['pincode'] . '"
                }
            ],
            "InquiryPhones": [
                {
                    "seq": "1",
                    "Number": "' . $customerData['mobile'] . '",
                    "PhoneType": [
                        "M"
                    ]
                }
            ],
            "EmailAddresses": [
                {
                    "seq": "1",
                    "Email": "' . $customerData['email'] . '",
                    "EmailType": [
                        "O"
                    ]
                }
            ],
            "IDDetails": [
                {
                    "seq": "1",
                    "IDValue": "' . $customerData['pancard_no'] . '",
                    "IDType": "T",
                    "Source": "Inquiry"
                },
                {
                    "seq": "2",
                    "IDValue": "",
                    "IDType": "P",
                    "Source": "Inquiry"
                },
                {
                    "seq": "3",
                    "IDValue": "",
                    "IDType": "V",
                    "Source": "Inquiry"
                },
                {
                    "seq": "4",
                    "IDValue": "",
                    "IDType": "D",
                    "Source": "Inquiry"
                },
                {
                    "seq": "5",
                    "IDValue": "",
                    "IDType": "M",
                    "Source": "Inquiry"
                }
            ],
            "DOB": "' . $customerData['dateOfBirth'] . '",
            "Gender": "' . $customerData['gender'] . '"
        },
        "Score": [
            {
                "Type": "ERS",
                "Version": "3.1"
            }
        ]
        }';
        $headers = array(
            "Content-Type: application/json",
            "Cookie: TS0185b412=0191ea91a4967760b41c3e578bc6002c6206f8c24631e7e4ec03f6b3ba0a95d1a3d345440b166a58bb20d4e0c8e4dcfc3f11bcab30",
            "CustomerId:9198",
            "UserId:STS_MAXPCS",
            "Password:W3#QeicsB",
            "MemberNumber:007FP13413",
            "SecurityCode:2AI",
            "CustRefField:123456",
            "ProductCode:PCS"
        );

        // Set headers
        // dd($data);

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // Increase the connection timeout to 30 seconds (adjust as needed).
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute cURL request and get the response
        $response = curl_exec($ch);

        $apih = DB::table('apihits')->insertGetId(['name' => 'equifax', 'api_url' => $url, 'request_data' => $data, 'respont_data' => json_encode($response)]);
        // Check for cURL errors
        if (curl_errno($ch)) {
            DB::table('apihits')->where('id', $apih)->update(['status' => 0]);
            $errorMessage = curl_error($ch);
            curl_close($ch);
            return $errorMessage;
        } else {
            DB::table('apihits')->where('id', $apih)->update(['status' => 1]);
            curl_close($ch);
            $responseData = json_decode($response, true);
            //dd($response);
            return $responseData;
        }
    }

    public function enashAuthorization()
    {
        if (config('app.env') != "production") {
            return 0;
        }
        $client = new Client();

        try {
            $response = $client->request('POST', 'https://dashboard.easebuzz.in/initiate_seamless_payment/', [
                'form_params' => [
                    'access_key' => 'BBTX2XUUMH',
                    'payment_mode' => 'EN',
                    'ifsc' => 'PUNB0010410',
                    'account_type' => 'SAVINGS',
                    'account_no' => '51462171013571',
                    'auth_mode' => 'DebitCard',
                    'bank_code' => 'PNBCB'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
            ]);

            //dd(json_decode($response->getBody(),true));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function enashRequest()
    {

        $client = new Client();

        $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateDirectDebitRequest/', [
            'form_params' => [
                'key' => '',
                'txnid' => '',
                'amount' => '',
                'productinfo' => '',
                'firstname' => '',
                'phone' => '',
                'email' => '',
                'surl' => '',
                'furl' => '',
                'hash' => '',
                'udf1' => '',
                'udf2' => '',
                'udf3' => '',
                'udf4' => '',
                'udf5' => '',
                'udf6' => '',
                'udf7' => '',
                'udf8' => '',
                'udf9' => '',
                'udf10' => '',
                'address1' => '',
                'address2' => '',
                'city' => '',
                'state' => '',
                'country' => '',
                'zipcode' => '',
                'customer_authentication_id' => '',
                'merchant_debit_id' => '',
                'auto_debit_access_key' => '',
                'sub_merchant_id' => ''
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        echo $response->getBody();
    }
}
