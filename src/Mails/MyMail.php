<?php

namespace MyCustom\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * メール送信クラス
 */
class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 使用するviewのbladeファイル名
     * emailsディレクトリ配下に配置する
     *
     * @var string
     */
    private string $viewName;

    /**
     * viewName 内で使用するデータ
     *
     * @var array
     */
    private array $data;

    /**
     * 送信先アドレス
     *
     * @var string
     */
    private string $to;

    /**
     * 送信元アドレス
     *
     * @var string
     */
    private string $fromAddress;

    /**
     * 送信元名
     *
     * @var string
     */
    private string $fromName;

    /**
     * 件名
     * mycustom/sns.php の email_subject にviewNameをkeyとして定義しておく
     *
     * @var string
     */
    private string $subject;

    function __construct(string $viewName, array $data, string $to, string $fromAddress = null, string $fromName = null)
    {
        $this->viewName    = $viewName;
        $this->data        = $data;
        $this->to          = $to;

        $this->subject     = isset(config("mycustoms.presentation-domain.email_subject")[$viewName]) ? config("mycustoms.presentation-domain.email_subject_head") . config("mycustoms.presentation-domain.email_subject")[$viewName] : "";

        $this->fromAddress = is_null($fromAddress) ? config("mycustoms.presentation-domain.email_from_address") : $fromAddress;
        $this->fromName    = is_null($fromName) ? config("mycustoms.presentation-domain.email_from_name") : $fromName;
    }

    public function build()
    {
        return $this->view("emails." . $this->viewName)
            ->subject($this->subject)
            ->to($this->to)
            ->from($this->fromAddress, $this->fromName)
            ->with($this->data);
    }
}
