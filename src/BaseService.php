<?php

namespace YukataRm\Laravel\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\RedirectResponse;

use YukataRm\Laravel\Mail\Client;

use YukataRm\Laravel\Transaction\Facade\Transaction;
use YukataRm\Laravel\Exception\Facade\Handler;

/**
 * Base Service
 * 
 * @package YukataRm\Laravel\Service
 */
abstract class BaseService
{
    /*----------------------------------------*
     * User
     *----------------------------------------*/

    /**
     * get logged in user
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    protected function user(): Authenticatable
    {
        $user = Auth::user();

        if (is_null($user)) throw new \RuntimeException("user not authenticated");

        return $user;
    }

    /*----------------------------------------*
     * Redirect
     *----------------------------------------*/

    /**
     * redirect to url
     * 
     * @param string $url
     * @param int $status
     * @param array $headers
     * @param bool|null $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect(string $url, int $status = 302, array $headers = [], bool|null $secure = null): RedirectResponse
    {
        return redirect($url, $status, $headers, $secure);
    }

    /**
     * redirect to route
     * 
     * @param string $route
     * @param array $parameters
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectRoute(string $route, array $parameters = [], int $status = 302, array $headers = []): RedirectResponse
    {
        return redirect()->route($route, $parameters, $status, $headers);
    }

    /**
     * redirect to action
     * 
     * @param string|array<string, string> $action
     * @param array $parameters
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectAction(string|array $action, array $parameters = [], int $status = 302, array $headers = []): RedirectResponse
    {
        return redirect()->action($action, $parameters, $status, $headers);
    }

    /**
     * redirect to away
     * 
     * @param string $url
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectAway(string $url, int $status = 302, array $headers = []): RedirectResponse
    {
        return redirect()->away($url, $status, $headers);
    }

    /**
     * redirect to back
     * 
     * @param int $status
     * @param array $headers
     * @param mixed $fallback
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack(int $status = 302, array $headers = [], mixed $fallback = false): RedirectResponse
    {
        return redirect()->back($status, $headers, $fallback);
    }

    /*----------------------------------------*
     * Email
     *----------------------------------------*/

    /**
     * Client instance
     * 
     * @var \YukataRm\Laravel\Mail\Client|null
     */
    private Client|null $client = null;

    /**
     * get Client instance
     * 
     * @return \YukataRm\Laravel\Mail\Client
     */
    protected function emailClient(): Client
    {
        if (is_null($this->client)) $this->client = new Client();

        return $this->client;
    }

    /**
     * send email
     * 
     * @return bool
     */
    protected function sendEmail(): bool
    {
        return $this->emailClient()->send();
    }

    /*----------------------------------------*
     * Transaction
     *----------------------------------------*/

    /**
     * run transaction
     * 
     * @param \Closure $transactional
     * @param bool $onlySystemAlert
     * @return bool
     */
    protected function runTransaction(\Closure $transactional, bool $onlySystemAlert = false): bool
    {
        try {
            Transaction::execute($transactional);

            return true;
        } catch (\Throwable $exception) {
            if (!$onlySystemAlert) throw $exception;

            Handler::handle($exception);

            return false;
        }
    }
}
