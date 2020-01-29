<?php

namespace Gaardee\PHPcpsms;

class SMS
{
    protected $apiUrl = "https://api.cpsms.dk/v2", $apiKey;

    public $recipient, $sender, $message, $dlr_url, $encoding, $timestamp, $reference, $flash, $format;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function send()
    {
        return $this->makeRequest("POST", "send", $this->createParameters());
    }

    public function credits()
    {
        return $this->makeRequest("GET", "creditvalue", []);
    }

    protected function createParameters()
    {
        $parameters = [
            "to" => (strlen($this->recipient) < 10 ? '45' . $this->recipient : $this->recipient),
            "message" => $this->message,
            "from" => $this->sender,
        ];

        $variables = array("dlr_url", "encoding", "timestamp", "reference", "flash", "format");

        foreach ($variables as $variable) {
            if (isset($this->$variable))
                $parameters[$variable] = $this->$variable;
        }

        return $parameters;
    }

    protected function makeRequest($method, $endpoint, $data)
    {
        $opts = array(
            'http' => array(
                'method' => $method,
                'header' => "Authorization: Basic " . $this->apiKey . "\r\n" .
                    "Content-Type: application/x-www-form-urlencoded\r\n",
            )
        );
        if (count($data) > 1) {
            $opts['http']['content'] = json_encode($data);
        }

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        $file = file_get_contents($this->apiUrl . '/' . $endpoint, false, $context);

        return $file;
    }
}
