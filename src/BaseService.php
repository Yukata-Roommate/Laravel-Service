<?php

namespace YukataRm\Laravel\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Collection as IlluminateCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

use YukataRm\Laravel\Mail\Client;

use YukataRm\Laravel\Db\Facades\Transaction;
use YukataRm\Laravel\Exception\Facades\Exception;

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
     * @return \Illuminate\Foundation\Auth\User
     */
    protected function user(): User
    {
        return Auth::user();
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
     * Pagination
     *----------------------------------------*/

    /**
     * convert to paginator
     *
     * @param array|\Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection $items
     * @param int $total
     * @param int $perPage
     * @param int|null $currentPage
     * @param array $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginator(array|IlluminateCollection|EloquentCollection $items, int $total, int $perPage, int|null $currentPage = null, array $options = []): LengthAwarePaginator
    {
        if (is_array($items)) $items = collect($items);

        if ($items instanceof EloquentCollection) $items = $items->toBase();

        $paginator = new LengthAwarePaginator($items, $total, $perPage, $currentPage, $options);

        $paginator = $paginator->withPath(request()->url());

        $paginator = $paginator->withQueryString();

        return $paginator;
    }

    /*----------------------------------------*
     * Email
     *----------------------------------------*/

    /**
     * Client instance
     *
     * @var \YukataRm\Laravel\Mail\Client|null
     */
    protected Client|null $client = null;

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

            Exception::handle($exception);

            return false;
        }
    }
}
