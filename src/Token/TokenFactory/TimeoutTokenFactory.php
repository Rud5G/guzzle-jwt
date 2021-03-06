<?php

namespace Webthink\GuzzleJwt\Token\TokenFactory;

use Webthink\GuzzleJwt\Encoder\EncoderInterface;
use Webthink\GuzzleJwt\Token\TimeoutToken;

/**
 * @author George Mponos <gmponos@xm.com>
 */
class TimeoutTokenFactory implements TokenFactoryInterface
{
    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var int
     */
    private $offset;

    /**
     * TimeoutTokenFactory constructor.
     *
     * @param \Webthink\GuzzleJwt\Encoder\EncoderInterface|null $encoder
     * @param int $offset
     */
    public function __construct(EncoderInterface $encoder = null, $offset = 0)
    {
        $this->encoder = $encoder;
        $this->offset = $offset;
    }

    /**
     * @param string $token
     * @return \Webthink\GuzzleJwt\Token\TimeoutToken
     */
    public function create($token)
    {
        return new TimeoutToken($token, $this->encoder, $this->offset);
    }
}
