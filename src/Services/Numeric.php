<?php

namespace MyCustom\Services;

/**
 * 数値に関するtrait
 */
trait Numeric
{
    /**
     * num の2乗を取得する
     *
     * @param integer|float $num
     */
    final protected function squared(int|float $num): int|float|object
    {
        return pow($num, 2);
    }

    /**
     * num の3乗を取得する
     *
     * @param integer|float $num
     */
    final protected function cubed(int|float $num): int|float|object
    {
        return pow($num, 3);
    }

    /**
     * num が素数かどうか
     *
     * @param integer $num
     */
    final protected function isPrime(int $num): bool
    {
        /* 1以下 */
        if ($num <= 1) return false;

        /* 2以外の偶数 */
        if ($num !== 2 && $num % 2 === 0) return false;

        /* 平方根が整数 */
        if (is_int(sqrt($num))) return false;

        $max = floor(sqrt($num));
        for ($i = 3; $i <= $max; $i += 2) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * num 番目のフィボナッチ数列の一般項を取得する(計算結果を丸めて取得する)
     *
     * @param integer $num
     */
    final protected function fibonacci(int $num): int
    {
        return round(1 / sqrt(5) * (((1 + sqrt(5)) / 2) ** $num - ((1 - sqrt(5)) / 2) ** $num));
    }
}
