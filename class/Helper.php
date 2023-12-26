<?php

class Helper
{
    public static function accountType($type)
    {
        switch ($type) {
            case 1:
                return 'طلایی';
                break;
            case 2:
                return 'نقره ای';
                break;
            case 3:
                return 'برنزی';
                break;
        }
    }

    public static function dropZero($price)
    {
        return rtrim($price, '0');
    }

    public static function benefits($benefits)
    {
        $benefits = explode('|', $benefits);
        $item = '';
        foreach ($benefits as $benefit) {
            $item .= '<li>' . $benefit . '</li>';
        }
        return $item;
    }

    public static function orderNumber()
    {
        return jdate('Ynj') . rand(10000, 99999);
    }

    public static function vipStatus($status)
    {
        switch ($status) {
            case 0:
                return '<span class="uk-badge">غیرفعال</span>';
                break;
            case 1:
                return '<span class="uk-badge">فعال</span>';
        }
    }

    public static function toJalali($date, $separator)
    {
        if (empty($date)) {
            return 'تاریخی ثبت نشده است!';
        }
        switch ($separator) {
            case '-':
                $date = explode('-', $date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                return gregorian_to_jalali($year, $month, $day, '-');
                break;
            case '/':
                $date = explode('-', $date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                return gregorian_to_jalali($year, $month, $day, '/');
                break;
        }
    }

    public static function toGregorian($date, $separator)
    {
        if (empty($date)) {
            return 'تاریخی ثبت نشده است!';
        }
        switch ($separator) {
            case '-':
                $date = explode('-', $date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                return jalali_to_gregorian($year, $month, $day, '-');
                break;
            case '/':
                $date = explode('-', $date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                return jalali_to_gregorian($year, $month, $day, '/');
                break;
        }
    }

    public static function calculateRemainingVipCredit($expiredDate)
    {
        $currentDate = strtotime(date('Y-m-d'));
        $expiredDate = strtotime($expiredDate);
        $remainingTime = round(($expiredDate - $currentDate) / (60 * 60 * 24))  . ' روز';
        if($remainingTime >= 0){
            return $remainingTime;
        } else {
            return 'منقضی شده';
        }
    }
}
