<?php

namespace Webthink\GuzzleJwt\Token\TokenFactory;

use Webthink\GuzzleJwt\TokenInterface;

/**
 * @author George Mponos <gmponos@gmail.com>
 */
interface TokenFactoryInterface
{
    /**
     * @param string $token
     * @return TokenInterface
     */
    public function create($token);
}
