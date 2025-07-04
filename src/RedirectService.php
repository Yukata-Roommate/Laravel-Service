<?php

namespace YukataRm\Laravel\Service;

use YukataRm\Laravel\Service\HandleService;

use Illuminate\Http\RedirectResponse;

/**
 * Redirect Service
 *
 * @package YukataRm\Laravel\Service
 */
abstract class RedirectService extends HandleService
{
    /*----------------------------------------*
     * Redirect Route
     *----------------------------------------*/

    /**
     * success redirect session key
     *
     * @var string
     */
    protected string $successRedirectSessionKey = "alert.success";

    /**
     * store success redirect message key
     *
     * @var string
     */
    protected string $storeSuccessRedirectMessageKey = "yr-service::message.success.store";

    /**
     * update success redirect message key
     *
     * @var string
     */
    protected string $updateSuccessRedirectMessageKey = "yr-service::message.success.update";

    /**
     * delete success redirect message key
     *
     * @var string
     */
    protected string $deleteSuccessRedirectMessageKey = "yr-service::message.success.delete";

    /**
     * failure redirect session key
     *
     * @var string
     */
    protected string $failureRedirectSessionKey = "alert.failure";

    /**
     * store failure redirect message key
     *
     * @var string
     */
    protected string $storeFailureRedirectMessageKey = "yr-service::message.failure.store";

    /**
     * update failure redirect message key
     *
     * @var string
     */
    protected string $updateFailureRedirectMessageKey = "yr-service::message.failure.update";

    /**
     * delete failure redirect message key
     *
     * @var string
     */
    protected string $deleteFailureRedirectMessageKey = "yr-service::message.failure.delete";

    /**
     * fetch failure redirect message key
     *
     * @var string
     */
    protected string $fetchFailureRedirectMessageKey = "yr-service::message.failure.fetch";

    /**
     * success redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @param string|null $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function successRedirect(string $route, array $params = [], string|null $message = null): RedirectResponse
    {
        return $this->redirectRoute($route, $params)->with($this->successRedirectSessionKey, $message);
    }

    /**
     * store success redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storeSuccessRedirect(string $route, array $params = []): RedirectResponse
    {
        return $this->successRedirect($route, $params, __($this->storeSuccessRedirectMessageKey));
    }

    /**
     * update success redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateSuccessRedirect(string $route, array $params = []): RedirectResponse
    {
        return $this->successRedirect($route, $params, __($this->updateSuccessRedirectMessageKey));
    }

    /**
     * delete success redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function deleteSuccessRedirect(string $route, array $params = []): RedirectResponse
    {
        return $this->successRedirect($route, $params, __($this->deleteSuccessRedirectMessageKey));
    }

    /**
     * failure redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @param array<string, mixed> $input
     * @param string|null $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failureRedirect(string $route, array $params = [], array $input = [], string|null $message = null): RedirectResponse
    {
        return $this->redirectRoute($route, $params)->with($this->failureRedirectSessionKey, $message)->withInput($input);
    }

    /**
     * store failure redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storeFailureRedirect(string $route, array $params = [], array $input = []): RedirectResponse
    {
        return $this->failureRedirect($route, $params, $input, __($this->storeFailureRedirectMessageKey));
    }

    /**
     * update failure redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateFailureRedirect(string $route, array $params = [], array $input = []): RedirectResponse
    {
        return $this->failureRedirect($route, $params, $input, __($this->updateFailureRedirectMessageKey));
    }

    /**
     * delete failure redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function deleteFailureRedirect(string $route, array $params = [], array $input = []): RedirectResponse
    {
        return $this->failureRedirect($route, $params, $input, __($this->deleteFailureRedirectMessageKey));
    }

    /**
     * fetch failure redirect to route
     *
     * @param string $route
     * @param array<string, mixed> $params
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function fetchFailureRedirect(string $route, array $params = [], array $input = []): RedirectResponse
    {
        return $this->failureRedirect($route, $params, $input, __($this->fetchFailureRedirectMessageKey));
    }

    /*----------------------------------------*
     * Redirect Back
     *----------------------------------------*/

    /**
     * success redirect to back session key
     *
     * @var string
     */
    protected string $successRedirectBackSessionKey = "alert.success";

    /**
     * store success redirect to back message key
     *
     * @var string
     */
    protected string $storeSuccessRedirectBackMessageKey = "yr-service::message.success.store";

    /**
     * update success redirect to back message key
     *
     * @var string
     */
    protected string $updateSuccessRedirectBackMessageKey = "yr-service::message.success.update";

    /**
     * delete success redirect to back message key
     *
     * @var string
     */
    protected string $deleteSuccessRedirectBackMessageKey = "yr-service::message.success.delete";

    /**
     * failure redirect to back session key
     *
     * @var string
     */
    protected string $failureRedirectBackSessionKey = "alert.failure";

    /**
     * store failure redirect to back message key
     *
     * @var string
     */
    protected string $storeFailureRedirectBackMessageKey = "yr-service::message.failure.store";

    /**
     * update failure redirect to back message key
     *
     * @var string
     */
    protected string $updateFailureRedirectBackMessageKey = "yr-service::message.failure.update";

    /**
     * delete failure redirect to back message key
     *
     * @var string
     */
    protected string $deleteFailureRedirectBackMessageKey = "yr-service::message.failure.delete";

    /**
     * fetch failure redirect to back message key
     *
     * @var string
     */
    protected string $fetchFailureRedirectBackMessageKey = "yr-service::message.failure.fetch";

    /**
     * success redirect to back
     *
     * @param string|null $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function successRedirectBack(string|null $message = null): RedirectResponse
    {
        return $this->redirectBack()->with($this->successRedirectBackSessionKey, $message);
    }

    /**
     * store success redirect to back
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storeSuccessRedirectBack(): RedirectResponse
    {
        return $this->successRedirectBack(__($this->storeSuccessRedirectBackMessageKey));
    }

    /**
     * update success redirect to back
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateSuccessRedirectBack(): RedirectResponse
    {
        return $this->successRedirectBack(__($this->updateSuccessRedirectBackMessageKey));
    }

    /**
     * delete success redirect to back
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function deleteSuccessRedirectBack(): RedirectResponse
    {
        return $this->successRedirectBack(__($this->deleteSuccessRedirectBackMessageKey));
    }

    /**
     * failure redirect to back
     *
     * @param array<string, mixed> $input
     * @param string|null $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failureRedirectBack(array $input = [], string|null $message = null): RedirectResponse
    {
        return $this->redirectBack()->with($this->failureRedirectBackSessionKey, $message)->withInput($input);
    }

    /**
     * store failure redirect to back
     *
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storeFailureRedirectBack(array $input = []): RedirectResponse
    {
        return $this->failureRedirectBack($input, __($this->storeFailureRedirectBackMessageKey));
    }

    /**
     * update failure redirect to back
     *
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateFailureRedirectBack(array $input = []): RedirectResponse
    {
        return $this->failureRedirectBack($input, __($this->updateFailureRedirectBackMessageKey));
    }

    /**
     * delete failure redirect to back
     *
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function deleteFailureRedirectBack(array $input = []): RedirectResponse
    {
        return $this->failureRedirectBack($input, __($this->deleteFailureRedirectBackMessageKey));
    }

    /**
     * fetch failure redirect to back
     *
     * @param array<string, mixed> $input
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function fetchFailureRedirectBack(array $input = []): RedirectResponse
    {
        return $this->failureRedirectBack($input, __($this->fetchFailureRedirectBackMessageKey));
    }
}
