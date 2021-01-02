<?php

namespace SocialiteProviders\GiTee;

use SocialiteProviders\Manager\SocialiteWasCalled;

class GiTeeExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('gitee', Provider::class);
    }
}
