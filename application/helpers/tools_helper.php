<?php
if (!function_exists('generate_random_string'))
{
    function generate_random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $value = '';

        for ($i = 0; $i < $length; $i++) {
            $value .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $value;
    }
}