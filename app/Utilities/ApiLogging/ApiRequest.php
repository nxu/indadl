<?php

namespace App\Utilities\ApiLogging;

use JsonSerializable;

class ApiRequest implements JsonSerializable
{
    private $timestamp;
    private $ip;
    private $responseCode;

    public function __construct(int $timestamp, string $ip, int $responseCode)
    {
        $this->timestamp = $timestamp;
        $this->ip = $ip;
        $this->responseCode = $responseCode;
    }

    public function jsonSerialize()
    {
        return [
            'timestamp' => $this->timestamp,
            'ip' => $this->ip,
            'response_code' => $this->responseCode,
        ];
    }
}
