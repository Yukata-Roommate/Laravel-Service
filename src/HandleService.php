<?php

namespace YukataRm\Laravel\Service;

use YukataRm\Laravel\Service\BaseService;

/**
 * Handle Service
 *
 * @package YukataRm\Laravel\Service
 *
 * @method static mixed handle(...$args)
 */
abstract class HandleService extends BaseService
{
    /*----------------------------------------*
     * Method Proxy
     *----------------------------------------*/

    /**
     * execute service
     *
     * @return mixed
     */
    abstract public function execute(): mixed;

    /**
     * call static
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic(string $name, array $args): mixed
    {
        if ($name !== "handle") return null;

        $service = new static(...$args);

        return $service->execute();
    }
}
