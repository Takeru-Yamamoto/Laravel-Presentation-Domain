<?php

namespace MyCustom\Controllers;

use Illuminate\Http\RedirectResponse;

/**
 * ページのリダイレクトに関するtrait
 * 
 * redirect()をwrapし、使いやすくしたもの
 * application全体でrouteを使用するように統一する
 */
trait Redirect
{
    final protected function successRedirect(string $route, string $text, array $params = [], string $addText = null): RedirectResponse
    {
        return redirect()->route($route, $params)->with('success_message', $text . "\n" . $addText);
    }

    final protected function failureRedirect(string $route, string $text, array $params = [], string $addText = null): RedirectResponse
    {
        return redirect()->route($route, $params)->with('danger_message', $text . "\n" . $addText);
    }

    final protected function previousRedirect(string $text, string $addText = null): RedirectResponse
    {
        return redirect(url()->previous())->with('danger_message', $text . "\n" . $addText);
    }
}
