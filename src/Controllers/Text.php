<?php

namespace MyCustom\Controllers;

/**
 * ページのリダイレクト際に表示するテキストに関するtrait
 */
trait Text
{
    /**
     * target をcreateしたことを示すテキストを取得する
     *
     * @param string $textKey
     */
    function createdText(string $textKey): string
    {
        return ___("mycustom.message.created", ["target" => ___($textKey), "create" => ___("mycustom.word.create")]);
    }


    /**
     * target をupdateしたことを示すテキストを取得する
     *
     * @param string $textKey
     */
    function updatedText(string $textKey): string
    {
        return ___("mycustom.message.updated", ["target" => ___($textKey), "update" => ___("mycustom.word.update")]);
    }


    /**
     * target をdeleteしたことを示すテキストを取得する
     *
     * @param string $textKey
     */
    function deletedText(string $textKey): string
    {
        return ___("mycustom.message.deleted", ["target" => ___($textKey), "delete" => ___("mycustom.word.delete")]);
    }


    /**
     * target がsuccessしたことを示すテキストを取得する
     *
     * @param string $textKey
     */
    function succeededText(string $textKey): string
    {
        return ___("mycustom.message.succeeded", ["target" => ___($textKey), "success" => ___("mycustom.word.success")]);
    }


    /**
     * target がfailureしたことを示すテキストを取得する
     *
     * @param string $textKey
     */
    function failedText(string $textKey): string
    {
        return ___("mycustom.message.failed", ["target" => ___($textKey), "failure" => ___("mycustom.word.failure")]);
    }
}
