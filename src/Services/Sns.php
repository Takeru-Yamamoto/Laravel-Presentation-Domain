<?php

namespace MyCustom\Services;

use Illuminate\Support\Facades\Mail;
use MyCustom\Mails\MyMail;

use LINE\LINEBot as LineBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient as LineClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder as LineMessageBuilder;
use LINE\LINEBot\Response as LineResponse;

use Twilio\Rest\Client as TwilioClient;
use Twilio\Rest\Api\V2010\Account\MessageInstance as TwilioResponse;

/**
 * SNSに関するtrait
 */
trait Sns
{
    /**
     * viewName のBladeファイルに data を使用したHTMLメールを to に送信する
     * 
     * デフォルト値
     * fromAddress: config("mycustoms.presentation-domain.email_from_address")
     * fromName   : config("mycustoms.presentation-domain.email_from_name")
     *
     * @param string $viewName
     * @param array $data
     * @param string $to
     * @param string|null $fromAddress
     * @param string|null $fromName
     */
    final protected function sendMail(string $viewName, array $data, string $to, string $fromAddress = null, string $fromName = null): bool
    {
        $fromAddress = is_null($fromAddress) ? config("mycustoms.presentation-domain.email_from_address") : $fromAddress;
        $fromName    = is_null($fromName) ? config("mycustoms.presentation-domain.email_from_name") : $fromName;

        if (empty($fromAddress) || empty($fromName)) {
            dividerLog();
            infoLog("MAIL CANNOT SEND");
            infoLog("PLEASE CHECK .env AND SET ABOUT MAIL IF YOU WANT TO SEND MAIL");
            dividerLog();

            return false;
        }

        emphasisLog('MAIL SEND TO ' . $to);
        return !is_null(Mail::send(new MyMail($viewName, $data, $to, $fromAddress, $fromName)));
    }

    /**
     * message を to に送信する
     * 
     * デフォルト値
     * accessToken  : config("mycustoms.presentation-domain.line_access_token")
     * channelSecret: config("mycustoms.presentation-domain.line_channel_secret")
     *
     * @param string $to
     * @param string $message
     * @param string|null $accessToken
     * @param string|null $channelSecret
     */
    final protected function sendLine(string $to, string $message, ?string $accessToken = null, ?string $channelSecret = null): bool
    {
        /* 
            $response: LineResponse
        */

        if (is_null($accessToken)) $accessToken = config("mycustoms.presentation-domain.line_access_token");
        if (is_null($channelSecret)) $channelSecret = config("mycustoms.presentation-domain.line_channel_secret");

        if (is_null($accessToken) || is_null($channelSecret)) return false;

        emphasisLog('LINE SEND TO ' . $to . ' MESSAGE ' . $message);

        $client   = new LineClient($accessToken);
        $bot      = new LineBot($client, ['channelSecret' => $channelSecret]);
        $response = $bot->pushMessage($to, new LineMessageBuilder($message));

        if (!$response instanceof LineResponse) return false;

        emphasisLogStart("LINE");
        infoLog("header: " . jsonEncode($response->getHeaders()));
        infoLog("body: " . jsonEncode($response->getJSONDecodedBody()));
        infoLog("status: " . jsonEncode($response->getHTTPStatus()));
        emphasisLogEnd("LINE");

        return $response->isSucceeded();
    }

    /**
     * message を to に送信する
     *
     * デフォルト値
     * from          : config("mycustoms.presentation-domain.twilio_from")
     * accountSid    : config("mycustoms.presentation-domain.twilio_account_sid")
     * authToken     : config("mycustoms.presentation-domain.twilio_auth_token")
     * statusCallback: config("mycustoms.presentation-domain.twilio_status_callback")
     * 
     * @param string $to
     * @param string $message
     * @param string|null $from
     * @param string|null $accountSid
     * @param string|null $authToken
     * @param string|null $statusCallback
     */
    final protected function sendSMS(string $to, string $message, ?string $from = null, ?string $accountSid = null, ?string $authToken = null, ?string $statusCallback = null): bool
    {
        /* 
            $response: TwilioResponse
        */

        if (is_null($from)) $from = config("mycustoms.presentation-domain.twilio_from");
        if (is_null($accountSid)) $accountSid = config("mycustoms.presentation-domain.twilio_account_sid");
        if (is_null($authToken)) $authToken = config("mycustoms.presentation-domain.twilio_auth_token");
        if (is_null($statusCallback)) $statusCallback = config("mycustoms.presentation-domain.twilio_status_callback");

        if (is_null($from) || is_null($accountSid) || is_null($authToken) || is_null($statusCallback)) return false;

        emphasisLog('SMS SEND TO ' . $to . ' MESSAGE ' . $message);

        $client = new TwilioClient($accountSid, $authToken);
        $response = $client->messages->create($to, ['from' => $from, 'body' => $message, "statusCallback" => $statusCallback]);

        if (!$response instanceof TwilioResponse) return false;

        $responseArray = $response->toArray();

        if (!is_null($responseArray["errorCode"]) || !is_null($responseArray["errorMessage"])) return false;

        emphasisLogStart("SMS");
        infoLog("to: " . jsonEncode($responseArray["to"]));
        infoLog("from: " . jsonEncode($responseArray["from"]));
        infoLog("body: " . jsonEncode($responseArray["body"]));
        infoLog("status: " . jsonEncode($responseArray["status"]));
        infoLog("errorCode: " . jsonEncode($responseArray["errorCode"]));
        infoLog("errorMessage: " . jsonEncode($responseArray["errorMessage"]));
        emphasisLogEnd("SMS");

        return true;
    }
}
