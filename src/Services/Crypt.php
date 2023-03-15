<?php

namespace MyCustom\Services;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * 暗号化に関するtrait
 */
trait Crypt
{
    /**
     * params をAPP_KEYを用いて暗号化する
     *
     * @param array $params
     */
    final protected function encryptParams(array $params): string
    {
        return encrypt($params);
    }

    /**
     * APP_KEYを用いて暗号化された encrypted を復号する
     *
     * @param string $encrypted
     */
    final protected function decryptParams(string $encrypted): array
    {
        try {
            $decrypt = decrypt($encrypted);
            return is_array($decrypt) ? $decrypt : [];
        } catch (\Exception $ex) {
            return [];
        }
    }

    /**
     * text をハッシュ化する
     *
     * @param string $text
     */
    final protected function makeHash(string $text): string
    {
        return Hash::make($text);
    }

    /**
     * ハッシュ化された hashedText と text が一致するか
     *
     * @param string $text
     * @param string $hashedText
     */
    final protected function checkHash(string $text, string $hashedText): bool
    {
        return Hash::check($text, $hashedText);
    }

    /**
     * 現在時刻から minute 分後の時刻を取得する
     *
     * @param integer $minute
     */
    final protected function expirationDate(int $minute): string
    {
        return (new Carbon())->addMinutes($minute)->toDateTimeString();
    }
}
