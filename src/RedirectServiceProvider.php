<?php

namespace Spamoom;

use Illuminate\Support\ServiceProvider;

class RedirectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerNewRedirector();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }

    public function registerNewRedirector()
    {
        $this->app['redirect'] = $this->app->share(function ($app) {
            $redirector = new Redirector($app['url']);

            // If the session is set on the application instance, we'll inject it into
            // the redirector instance. This allows the redirect responses to allow
            // for the quite convenient "with" methods that flash to the session.
            if (isset($app['session.store'])) {
                $redirector->setSession($app['session.store']);
            }

            return $redirector;
        });
    }
}
