<?php

namespace MyCustom\PresentationDomain;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * publications配下をpublishする際に使うルートパス
     *
     * @var string
     */
    private string $publicationsPath = __DIR__ . "/publications";


    public function boot(): void
    {
        $this->loadViews();
        $this->publications();
    }

    /**
     * Viewを登録する
     */
    private function loadViews(): void
    {
        // 共通タグ
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mycustom');

        // Presentation Domain のみ
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mycustom-pd');
    }

    /**
     * publicationsディレクトリ配下を公開する
     */
    private function publications()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/package-require.json" => base_path("package-require.json"),
            $this->publicationsPath . "/app"                  => app_path(),
            $this->publicationsPath . "/config"               => config_path(),
            $this->publicationsPath . "/lang"                 => lang_path(),
            $this->publicationsPath . "/resources"            => resource_path(),
        ], "mycustom");

        // Presentation Domain のみ
        $this->publishes([
            $this->publicationsPath . "/package-require.json" => base_path("package-require.json"),
            $this->publicationsPath . "/app"                  => app_path(),
            $this->publicationsPath . "/config"               => config_path(),
            $this->publicationsPath . "/lang"                 => lang_path(),
            $this->publicationsPath . "/resources"            => resource_path(),
        ], "mycustom-pd");
    }
}
