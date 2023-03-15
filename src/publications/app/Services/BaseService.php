<?php

namespace App\Services;

use MyCustom\Services\ServiceTraits;

/**
 * 基底Serviceクラス
 * 
 * ServiceはControllerと1対1であり、ビジネスロジック部分担当。
 * 各Repositoryのインスタンスをメンバ変数として保持しておく。
 * ServiceはControllerのConstructでインスタンス化し、保持する。
 */
abstract class BaseService
{
    use ServiceTraits;
}
