<?php


namespace Zedstar16\Logger;

use pocketmine\scheduler\AsyncTask;

class AsyncDispatch extends AsyncTask
{

    private $data;
    private $url;

    public function __construct(String $url, String $data)
    {
       $this->url = $url;
       $this->data = $data;
    }

    public function onRun() : void
    {
        $ch = curl_init($this->url);
        curl_setopt_array($ch, [
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => json_encode(['content' => $this->data]),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_FORBID_REUSE => 1,
                CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_AUTOREFERER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT_MS => (int) (10 * 1000),
                CURLOPT_TIMEOUT_MS => (int) (10 * 1000),
                CURLOPT_HTTPHEADER => array_merge(["User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0 " . \pocketmine\NAME], ['Content-Type' => 'application/json']),
                CURLOPT_HEADER => true
            ]);
        curl_exec($ch);
        curl_close($ch);
    }



}