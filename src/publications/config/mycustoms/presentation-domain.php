<?php

return [
    /**
     * 
     * Basic
     * 
     * 基本設定
     * 
     * site_name: string サイト名。ログイン画面やサイドバー、titleタグに設定される
     * 
     */
    "site_name" => "Laravel CMS",


    /**
     * Color
     * 
     * ページカラー設定
     * 
     * 設定可能カラー: [
     *      light
     *      dark
     *      primary
     *      secondary
     *      success
     *      info
     *      warning
     *      danger
     * 
     *      account
     *      white
     *      black
     *      blue
     *      gray
     *      green
     *      cyan
     *      yellow
     *      red
     *      indigo
     *      navy
     *      purple
     *      fuchsia
     *      pink
     *      maroon
     *      orange
     *      lime
     *      teal
     *      olive
     * ]
     * 
     * color_navbar: navbarの背景
     * color_navbar_text: navbarのテキスト
     * 
     * color_sidebar          : sidebarの背景
     * color_sidebar_title    : sidebar上部に表示されるサイトタイトル
     * color_sidebar_item     : sidebarに表示するアイテムがアクティブな際の背景
     * color_sidebar_item_text: sidebarに表示するアイテムのテキスト
     * 
     */
    "color_navbar"      => "white",
    "color_navbar_text" => "gray",

    "color_sidebar"           => "dark",
    "color_sidebar_title"     => "light",
    "color_sidebar_item"      => "primary",
    "color_sidebar_item_text" => "white",

    "color_content"      => "account",
    "color_content_text" => "black",


    /**
     * Sidebar
     * 
     * サイドバー設定
     * 
     * ページURLプレフィックス: vendor/takeru-yamamoto/laravel-presentation-domain/src/Helpers/blade.php 
     * 
     * pages => [
     *      (ページURLプレフィックス) => [
     *          Basic
     *              can  : サイドバーを表示する権限
     *              class: サイドバーに付与するクラス名
     * 
     *          Title
     *              title      : サイドバーで表示するページタイトル
     *              title_class: サイドバーで表示するページタイトルクラス
     * 
     *          URL
     *              route: サイドバーで使用するURLのRoute
     *              url  : サイドバーで使用するサイトURL
     *              link : サイドバーで使用するURLリンク
     * 
     *          Icon
     *              icon      : サイドバーで使用するFont Awesome Icon
     *              icon_class: サイドバーで使用するアイコンクラス
     * 
     *          Etc.
     *              children: サイドバーに表示する下部メニュー 配列の形で使用する
     *      ]
     * ]
     * 
     * 
     */
    "pages" => [
        // "login_info" => [
        //     "title" => "login_info.title",
        //     "route" => "login_info.index",
        //     "icon"  => "fa-solid fa-gear",
        //     "can"   => "user-higher",
        // ],
        // "user" => [
        //     "title" => "user.title",
        //     "route" => "user.index",
        //     "icon"  => "fa-solid fa-user",
        //     "can"   => "admin-higher",
        // ],
    ],


    /**
     * User Menu
     * 
     * ユーザーメニュー設定
     * ページ右上に表示されるログイン中のユーザー名をクリックすると表示されるメニュー
     * 
     * usermenu_header: usermenu_header セッションを使用するかどうか
     * usermenu_body  : usermenu_body セッションを使用するかどうか
     * usermenu_footer: usermenu_footer セッションを使用するかどうか
     * 
     * btn_login : 未ログイン時にユーザーメニューのフッターにログインボタンを表示するかどうか 
     * btn_logout: ログイン時にユーザーメニューのフッターにログアウトボタンを表示するかどうか
     * 
     */
    "usermenu_header" => false,
    "usermenu_body"   => false,
    "usermenu_footer" => false,

    "btn_login"  => true,
    "btn_logout" => true,


    /**
     * Logging
     * 
     * 各項目でログを出力するかどうか
     * 
     * logging_event: bool Eventの公開
     * 
     */
    "logging_event" => true,


    /**
     * 
     * SNS
     * 
     * email_expiration_minute: 認証コードやURLなどの有効期限(分)
     * email_from_address     : メールの送信元アドレス
     * email_from_name        : メールの送信元名
     * email_subject_head     : メールの件名の接頭語
     * email_subject          : 各メールの件名 使用するbladeテンプレート名をキーとして登録する
     * 
     * line_access_token      : sendLine()で使用するLINE Messaging APIのアクセストークン
     * line_channel_secret    : sendLine()で使用するLINE Messaging APIのチャンネルシークレットキー
     * 
     * twilio_from            : sendSMS()で使用するTwilioの送信元電話番号
     * twilio_account_sid     : sendSMS()で使用するTwilioの送信元アカウントSID
     * twilio_auth_token      : sendSMS()で使用するTwilioのオーストークン
     * twilio_status_callback : sendSMS()で使用するTwilioの送信結果を受け取るURL
     * 
     */
    "email_expiration_minute" => 30,
    "email_from_address"      => env('GLOBAL_MAIL_FROM_ADDRESS'),
    "email_from_name"         => env('GLOBAL_MAIL_FROM_NAME'),
    "email_subject_head"      => "[Laravel CMS]",
    "email_subject"           => [
        "passwordForgot" => "パスワード変更のお知らせ",
        "emailReset"     => "メールアドレス変更のお知らせ",
    ],


    "line_access_token"       => env('LINE_ACCESS_TOKEN'),
    "line_channel_secret"     => env('LINE_CHANNEL_SECRET'),

    "twilio_from"             => env('TWILIO_FROM'),
    "twilio_account_sid"      => env('TWILIO_ACCOUNT_SID'),
    "twilio_auth_token"       => env('TWILIO_AUTH_TOKEN'),
    "twilio_status_callback"  => env('TWILIO_STATUS_CALLBACK'),


    /**
     * 
     * etc.
     * 
     * page_footer           : bool サイトのフッターを表示するかどうか
     * copyright_holder_name : string サイトの著作権者名
     * first_publication_year: int 著作権発生年
     * 
     * view_icon: bool ログイン画面やサイドバーなどにアイコンを表示するかどうか
     * icon_path: string 表示するアイコンのパス。public_path()
     * 
     */
    "page_footer"            => false,
    "copyright_holder_name"  => "",
    "first_publication_year" => 0,

    "view_icon" => false,
    "icon_path" => "",
];
