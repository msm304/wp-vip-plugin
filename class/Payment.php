<?php
class Payment
{
    
    protected static $merchant_id;
    public static $amount;
    protected static $callback_url;
    protected static $description;
    protected static $metadata;

    public static function gateway()
    {
        $data = array(
            'merchant' => self::$merchant_id,
            'amount' => intval(self::$amount * 10),
            'callbackUrl' => self::$callback_url,
            "description" => 'پرداخت جهت عضویت ویژه پلن : ' . self::$description,
            "metadata" => ["email" => self::$metadata['email'], "phone" => self::$metadata['phone']],
        );
        
        $ch = curl_init('https://gateway.zibal.ir/v1/request');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($result, true);

            if ($result['result'] == 100) {
                header('Location: https://gateway.zibal.ir/start/' . $result['trackId']);
            } else {
                echo 'Error Code: ' . $result['result'];
                echo 'Message: ' . $result['message'];
            }
        }
    }

    public static function paymentCallback()
    {
        // این متد باید توسط درگاه زیبال فراخوانی شود تا پرداخت با موفقیت انجام شده یا نشده را بررسی و اقدامات لازم انجام شود.
        // اطلاعات بیشتر در مستندات زیبال قابل دریافت است.
    }

    public static function setter($data, $description)
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
        self::$callback_url = site_url('/payment-callback');
    }
}
