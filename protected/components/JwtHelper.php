<?php

// protected/components/JwtHelper.php
class JwtHelper
{
    private static $secretKey = 'your-secret-key';

    public static function generateToken($payload)
    {
        $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', "$header.$payload", self::$secretKey, true);
        $signature = base64_encode($signature);
        return "$header.$payload.$signature";
    }

    public static function validateToken($token)
    {
        list($header, $payload, $signature) = explode('.', $token);
        $validSignature = hash_hmac('sha256', "$header.$payload", self::$secretKey, true);
        $validSignature = base64_encode($validSignature);
        return hash_equals($validSignature, $signature);
    }
}
