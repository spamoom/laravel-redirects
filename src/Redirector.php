<?php

namespace Spamoom;

use Illuminate\Routing\Redirector as LaravelRedirector;

class Redirector extends LaravelRedirector
{
    protected function createRedirect($path, $status, $headers)
    {
        $redirect = new RedirectResponse($path, $status, $headers);

        if (isset($this->session)) {
            $redirect->setSession($this->session);
        }

        $redirect->setRequest($this->generator->getRequest());

        return $redirect;
    }
}
