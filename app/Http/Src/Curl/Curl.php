<?php

namespace App\Http\Src\Curl;

use App;

class Curl
{
    protected $curl;

    public function __construct()
    {
        $this->curl = new CurlBuilder;
    }

    public function get(string $url)
    {
        $this->curl->setUrl($url);

        $response = $this->curl->exec();

        $this->curl->close();

        return json_decode($response, true);
    }

    public function send($url)
    {
        $this->curl->setUrl($url);

        $this->curl->setReturnResults();

        $this->curl->setHttpHeader();

        $response = $this->curl->exec();

        $this->curl->close();

        return json_decode($response, true)['response']['docs'];
    }

    public function post(string $url, array $data)
    {
        $this->curl->setPost();

        $this->curl->setData(json_encode($data));

        $this->curl->setUrl($url);

        $response = $this->curl->exec();

        $this->curl->close();

        return json_decode($response, true);
    }
}
