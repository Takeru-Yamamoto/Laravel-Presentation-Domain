<?php

namespace MyCustom\Functions\View;

final class ViewFunctions
{
    /**
     * 現在のrouteプレフィックスを使用して
     * config/mycustoms/presentation-domain.php の pages に定義してあるrouteプレフィックスの title を翻訳する
     */
    public static function pageTitle(): string
    {
        $content  = routePrefix();
        $pages    = config("mycustoms.presentation-domain.pages");
        $siteName = config('mycustoms.presentation-domain.site_name');

        return isset($pages[$content])
            && isset($pages[$content]["title"])
            ? ___($pages[$content]["title"]) . " | " . $siteName
            : $siteName;
    }


    /**
     * config/mycustoms/presentation-domain.php の first_publication_year と copyright_holder_name を用いてフッターに表示するテキストを取得する
     */
    public static function pageFooter(): string
    {
        $year                 = date("Y");
        $firstPublicationYear = config("mycustoms.presentation-domain.first_publication_year");
        $copyrightHolderName  = config("mycustoms.presentation-domain.copyright_holder_name");

        return $year === $firstPublicationYear ? "© " . $year . " " . $copyrightHolderName : "© " . $firstPublicationYear . " - " . $year . " " . $copyrightHolderName;
    }


    /**
     * mycustoms/color.php に記載されているクラス名からカラーコードを取得する
     *
     * @param string $class
     */
    public static function convertToColorCode(string $class): string
    {
        $classColor = config("mycustoms.color.class_color");
        $classCode  = config("mycustoms.color.class_code");

        if (isset($classColor[$class]) && is_string($classColor[$class])) $class = $classColor[$class];
        
        return isset($classCode[$class]) && is_string($classCode[$class]) ? $classCode[$class] : "";
    }


    /**
     * 現在のrouteを用いてformに使用するidを取得する
     * form submit btn と併用する
     * num は現在のページにformが複数存在するときの重複回避用
     *
     * @param integer|null $num
     */
    public static function formId(?int $num = null): string
    {
        return str_replace("/", "-", request()->path()) . "-form" . $num;
    }


    /**
     * radioやcheckboxをcheckedな状態にするかを簡単に記述しやすくする
     *
     * @param boolean $bool
     */
    public static function isChecked(bool $bool): string
    {
        return $bool ? "checked" : "";
    }


    /**
     * selectのoptionをselectedな状態にするかを簡単に記述しやすくする
     *
     * @param boolean $bool
     */
    public static function isSelected(bool $bool): string
    {
        return $bool ? "selected" : "";
    }
}
