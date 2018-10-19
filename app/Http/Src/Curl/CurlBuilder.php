<?php

namespace App\Http\Src\Curl;

use App;
use App\Http\Src\Solr\SolrConfig;

class CurlBuilder
{
    protected $curlHandle;

    protected $config;

    public function __construct()
    {
        $this->config = App::make(SolrConfig::class);

        $this->init();
        $this->setReturnResults();
        $this->setHttpHeader();
        $this->login();
    }

    public function setData($data)
    {
        $this->setOption(CURLOPT_POSTFIELDS, $data);
    }

    public function setPost()
    {
        $this->setOption(CURLOPT_POST, true);
    }

    public function setHttpHeader(string $header = null)
    {
        if (is_null($header)) {
            $header = 'application/json';
        }

        $this->setOption(CURLOPT_HTTPHEADER, ['Content-Type: ' . $header]);
    }

    public function login(string $username = null, string $password = null)
    {
        if (is_null($username)) {
            $username = $this->config->username;
        }

        if (is_null($password)) {
            $password = $this->config->password;
        }

        $this->setOption(CURLOPT_USERPWD, "$username:$password");
    }

    public function setReturnResults(bool $bool = true)
    {
        $this->setOption(CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
    }

    public function setUrl(string $url)
    {
        $this->setOption(CURLOPT_URL, $url);
//        curl_setopt($this->curlHandle, CURLOPT_URL, $url);
    }

    public function init()
    {
        $this->curlHandle = curl_init();
    }

    /**
     * Set curl_setopt.
     *
     * @param int $option
     * @param mixed|callable $value
     */
    public function setOption(int $option, $value)
    {
        curl_setopt($this->curlHandle, $option, $value);
    }

    public function exec()
    {
        dd(curl_exec($this->curlHandle));
        return ;
    }

    public function close()
    {
        curl_close($this->curlHandle);
    }


}
