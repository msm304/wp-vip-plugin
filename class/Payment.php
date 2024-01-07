<?php
class Payment
{

    protected static $merchant_id;
    public static $amount;
    protected static $callback_url;
    protected static $description;
    protected static $metadata;
    protected static $refNamber;

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

    public static function payment_result()
    {

        if ($_GET['success'] == 1) {
            // echo "شناسه سفارش: " . $_GET['orderId'] . "<br>";
            //start verfication
            $parameters = array(
                "merchant" => self::$merchant_id, //required
                "trackId" => $_GET['trackId'], //required

            );

            $response = postToZibal('verify', $parameters);
            if ($response->result == 100) {
                self::$refNamber = $response->refNumber;
                // echo "<pre>"; //for pretty view :)
                // var_dump($response);
                //update database or something else
                $transaction = new Transaction;
                $transaction->update($response->refNumber, Session::get('user_plan_data')['order_number']);
                User::add_vip_user(Session::get('user_plan_data')['plan_type'], get_current_user_id());
            } else {
                // echo "result: " . $response->result . "<br>";
                // echo "message: " . $response->message;
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
        $vip_setting = get_option('_vip_setting');
        self::$merchant_id = $vip_setting['merchant_id'];
        self::$callback_url = site_url(get_option('_vip_setting')['callback_url']);
    }

    public static function get_refNmber()
    {
        return self::$refNamber;
    }
}
