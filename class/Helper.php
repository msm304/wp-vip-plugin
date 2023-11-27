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
}
