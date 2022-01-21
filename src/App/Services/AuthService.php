<?php

namespace App\Services;

use Auth0\SDK\Auth0;

class AuthService
{
    private Auth0 $auth0;

    public function __construct()
    {
        $this->auth0 = new Auth0([
            'domain' => $_ENV['AUTH0_DOMAIN'],
            'clientId' => $_ENV['AUTH0_CLIENT_ID'],
            'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
            'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET']
        ]);
    }

    public function login(string $callback): string
    {
        $this->auth0->clear();

        return $this->auth0->login($callback);
    }

    public function logout(string $callback): string
    {
        return $this->auth0->logout($callback);
    }

    public function exchange(string $callback): bool
    {
        return $this->auth0->exchange($callback);
    }

    public function getCredentials(): ?object
    {
        return $this->auth0->getCredentials();
    }
}