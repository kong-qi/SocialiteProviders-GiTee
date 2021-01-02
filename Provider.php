<?php

namespace SocialiteProviders\GiTee;

use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    public const IDENTIFIER = 'GiTee';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = ['user_info'];

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getAuthUrl()
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://gitee.com/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getTokenUrl()
     */
    protected function getTokenUrl()
    {
        return 'https://gitee.com/oauth/token';
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getUserByToken()
     */
    protected function getUserByToken($token)
    {
        $url = 'https://gitee.com/api/v5/user?access_token='.$token;

        $response = $this->getHttpClient()->get($url);

        $user = json_decode($response->getBody(), true);

        return $user;
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::mapUserToObject()
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'   => $user['id'],
            'nickname' => $user['name'],
            'name' => $user['name'],
            'email' => null,
            'avatar' => $user['avatar_url'],
        ]);
    }




}
