<?php
class Payment
{

    protected static $merchant_id;
    public static $amount;
    protected static $callback_url;
    protected static $description;
    protected static $metadata;

    // public static function gateway()
    // {
    //     $data = array(
    //         'merchant' => self::$merchant_id,
    //         'amount' => intval(self::$amount * 10),
    //         'callbackUrl' => self::$callback_url,
    //         "description" => 'پرداخت جهت عضویت ویژه پلن : ' . self::$description,
    //         "metadata" => ["email" => self::$metadata['email'], "phone" => self::$metadata['phone']],
    //     );

    //     $ch = curl_init('https://gateway.zibal.ir/v1/request');
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //         'Content-Type: application/json',
    //     ));

    //     $result = curl_exec($ch);
    //     $err = curl_error($ch);
    //     curl_close($ch);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         $result = json_decode($result, true);

    //         if ($result['result'] == 100) {
    //             header('Location: https://gateway.zibal.ir/start/' . $result['trackId']);
    //         } else {
    //             echo 'Error Code: ' . $result['result'];
    //             echo 'Message: ' . $result['message'];
    //         }
    //     }
    // }

    public static function gateway()
    {
        $parameters = array(
            "merchant" => self::$merchant_id, //required
            "callbackUrl" => self::$callback_url, //required
            "amount" => intval(self::$amount * 10), //required

            "orderId" => time(), //optional
            "mobile" => "09120582028", //optional for mpg
        );

        $response = postToZibal('request', $parameters);
        var_dump($response);
        if ($response->result == 100) {
            $startGateWayUrl = "https://gateway.zibal.ir/start/" . $response->trackId;
            header('location: ' . $startGateWayUrl);
        } else {
            echo "errorCode: " . $response->result . "<br>";
            echo "message: " . $response->message;
        }
    }

    // public static function payment_result()
    // {
    //     $Authority = $_GET['Authority'];
    //     $data = array(
    //         "merchant_id" => self::$merchant_id,
    //         "authority" => $Authority,
    //         "amount" => intval(self::$amount * 10)
    //     );
    //     $jsonData = json_encode($data);
    //     $ch = curl_init('https://gateway.zibal.ir/v1/verify.json'); // آدرس جدید برای درگاه زیبال
    //     curl_setopt($ch, CURLOPT_USERAGENT, 'Zibal Rest Api v1'); // نام کاربری API زیبال
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //         'Content-Type: application/json',
    //         'Content-Length: ' . strlen($jsonData),
    //         'Authorization: Bearer YOUR_ZIBAL_API_KEY' // کلید API زیبال
    //     ));

    //     $result = curl_exec($ch);
    //     curl_close($ch);
    //     $result = json_decode($result, true);
    //     if (isset($result['result']) && $result['result'] == 100) {
    //         echo 'Transaction success. RefID:' . $result['track_id'];
    //     } else {
    //         echo 'code: ' . $result['result'];
    //         echo 'message: ' .  $result['message'];
    //     }
    // }

    public static function payment_result()
    {

        if ($_GET['success'] == 1) {
            echo "شناسه سفارش: " . $_GET['orderId'] . "<br>";

            //start verfication
            $parameters = array(
                "merchant" => self::$merchant_id, //required
                "trackId" => $_GET['trackId'], //required

            );

            $response = postToZibal('verify', $parameters);

            if ($response->result == 100) {
                echo "<pre>"; //for pretty view :)
                var_dump($response);
                //update database or something else
            } else {
                echo "result: " . $response->result . "<br>";
                echo "message: " . $response->message;
            }
        } else {
            echo "پرداخت با شکست مواجه شد.";
        }
    }

    public static function setter($data, $description = null)
    {
        // self::$amount = $amount;
        // self::$description = $description;
        self::$amount = $data['price'];
        self::$description = $description;
        self::$metadata = [
            'email' => $data['email'],
            'mobile' => '09022207077'
        ];
        $vip_setting = get_option('_merchandID');
        self::$merchant_id = $vip_setting;
        self::$callback_url = site_url('vip-payment-result');
    }
}
