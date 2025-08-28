<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JitsiService
{
    public static function generateToken($room, $userName, $isModerator = false)
    {
        $appId = "vpaas-magic-cookie-fa422a39574648a2b419082d4b2e784b";
        $apiKey = "YOUR_API_KEY";   // from JaaS dashboard
        $secret = "YOUR_API_SECRET"; // from JaaS dashboard

        $payload = [
            "aud" => "jitsi",
            "iss" => "chat",
            "sub" => $appId,
            "room" => $room,
            "exp" => time() + 3600, // 1 hour expiry
            "moderator" => $isModerator,
            "context" => [
                "user" => [
                    "name" => $userName,
                ]
            ]
        ];

        return JWT::encode($payload, $secret, 'HS256');
    }
}
