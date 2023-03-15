<?php

namespace MyCustom\Controllers;

use Illuminate\Contracts\View\View as ViewResponse;

/**
 * viewに関するtrait
 */
trait View
{
    final protected function pagesView(string $pagesView, array $data = []): ViewResponse
    {
        return view("pages." . $pagesView, $data);
    }
}
