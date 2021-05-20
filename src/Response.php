<?php

namespace Brandshopru\Tele2;

class Response
{
    private $content;
    private $httpCode;
    private $reasonPhrase;

    public function __construct($response)
    {
        $this->content = $response->getBody()->getContents();
        $this->httpCode = $response->getStatusCode();
        $this->reasonPhrase = $response->getReasonPhrase();
        if (!json_decode($this->content, true) || json_last_error()) {
            throw new \Exception("Unable to decode JSON: ".json_last_error_msg().".\n Http code: ".$this->httpCode."; Reason phrase: ".$this->reasonPhrase.";");
        }
    }

    public function isOk()
    {
        return $this->getHttpCode() >= 200 && $this->getHttpCode() <= 299;
    }

    public function getContent()
    {
        return json_decode($this->getRawContent(), true);
    }

    public function getRawContent()
    {
        return $this->content;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }
}