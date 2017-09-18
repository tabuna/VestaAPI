<?php
/**
 * File:    Sender.php
 * Project: VestaAPI
 * User:    evgen
 * Date:    18.09.17
 * Time:    16:32
 */

namespace VestaAPI\Services;


class Sender
{
    /**
     * @var string
     */
    private $uri = '';

    /**
     * @var string
     */
    private $postString = '';

    /**
     * @var int
     */
    private $timeout = 0;

    /**
     * @var bool
     */
    private $sslVerify = false;

    /**
     * for static call
     * @return Sender
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param string $uri
     *
     * @return Sender
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array $postString
     *
     * @return Sender
     */
    public function setPostString($postString)
    {
        $this->postString = http_build_query($postString);
        return $this;
    }

    /**
     * @param int $timeout
     *
     * @return Sender
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @param bool $sslVerify
     *
     * @return Sender
     */
    public function setSslVerify($sslVerify)
    {
        $this->sslVerify = $sslVerify;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRaw()
    {
        return $this->get();
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->toArray($this->get());
    }

    /**
     * @return mixed
     */
    private function get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postString);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        if (!$this->sslVerify) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @param $json
     *
     * @return mixed
     */
    private function toArray($json)
    {
        if (empty($json)) {
            return [];
        }
        return json_decode($json, true);
    }

}