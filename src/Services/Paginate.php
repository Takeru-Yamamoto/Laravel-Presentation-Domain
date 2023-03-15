<?php

namespace MyCustom\Services;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Viewで使用するページネーションに関するtrait
 */
trait Paginate
{
    final protected function paginator(array $items, int $total, int $limit, int $page, array $options = []): LengthAwarePaginator
    {
        if (!isset($options["path"])) {
            $path = explode("/", request()->path());
            $options["path"] = end($path);
        }
        return new LengthAwarePaginator($items, $total, $limit, $page, $options);
    }
}
