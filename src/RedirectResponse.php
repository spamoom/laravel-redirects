<?php

namespace Spamoom\LaravelRedirects;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Http\RedirectResponse as LaravelRedirectResponse;

class RedirectResponse extends LaravelRedirectResponse
{
    public function withNotices($provider, $key = 'default')
    {
        return $this->withAlerts('notices', $provider, $key);
    }

    public function withSuccesses($provider, $key = 'default')
    {
        return $this->withAlerts('successes', $provider, $key);
    }

    public function withAlerts($alertKey, $provider, $key = 'default')
    {
        $value = $this->parseAlerts($provider);

        $flashData = $this->session->get($alertKey, new ViewErrorBag())->put($key, $value);

        $this->session->flash($alertKey, $flashData);

        return $this;
    }

    protected function parseAlerts($provider)
    {
        return $this->parseErrors($provider);
    }
}
