<?php

namespace Webthink\GuzzleJwt\Token;

use Webthink\GuzzleJwt\Encoder\EncoderInterface;
use Webthink\GuzzleJwt\TokenInterface;

abstract class AbstractToken implements TokenInterface
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var array
     */
    protected $header;

    /**
     * @var array
     */
    protected $payload;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var EncoderInterface
     */
    protected $encoder;

    public function __construct($token, EncoderInterface $encoder)
    {
        list($header, $payload, $signature) = $this->parse($token);

        $this->token = $token;
        $this->header = $header;
        $this->payload = $payload;
        $this->signature = $signature;
        $this->encoder = $encoder;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return string
     */
    public function getTokenString()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function parse($token)
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            throw new \InvalidArgumentException('Token form is invalid');
        }

        $header = json_decode($this->encoder->decode($parts[0]), true);
        $payload = json_decode($this->encoder->decode($parts[1]), true);
        $signature = $parts[2];
        return [$header, $payload, $signature];
    }
}