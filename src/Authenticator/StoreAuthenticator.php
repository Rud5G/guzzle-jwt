<?php

namespace Webthink\GuzzleJwt\Authenticator;

use Webthink\GuzzleJwt\AuthenticatorInterface;
use Webthink\GuzzleJwt\StorageInterface;

/**
 * Class StoreAuthenticator
 *
 * @package Webthink\GuzzleJwt\Authenticator
 */
class StoreAuthenticator implements AuthenticatorInterface
{
    /**
     * @var \Webthink\GuzzleJwt\StorageInterface
     */
    private $storage;

    /**
     * @var \Webthink\GuzzleJwt\AuthenticatorInterface
     */
    private $authenticator;

    /**
     * StoreAuthenticator constructor.
     *
     * @param \Webthink\GuzzleJwt\AuthenticatorInterface $authenticator
     * @param \Webthink\GuzzleJwt\StorageInterface $storage
     * @throws \InvalidArgumentException
     */
    public function __construct(AuthenticatorInterface $authenticator, StorageInterface $storage)
    {
        if ($authenticator instanceof StoreAuthenticator) {
            throw new \InvalidArgumentException(
                sprintf('You can not pass a %s into another', self::class)
            );
        }
        $this->storage = $storage;
        $this->authenticator = $authenticator;
    }

    /**
     * @inheritdoc
     */
    public function authenticate($username, $password)
    {
        $token = $this->storage->getToken();
        if ($token !== null && $token->isValid() !== false) {
            return $token;
        }

        $token = $this->authenticator->authenticate($username, $password);
        $this->storage->storeToken($token);
        return $token;
    }
}
