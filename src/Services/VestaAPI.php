<?php

namespace VestaAPI\Services;

use VestaAPI\Exceptions\VestaExceptions;

class VestaAPI
{
    use Db, Dns, User, Web, Service, Cron, FileSystem;

    const RETURN_CODE_YES = 'yes',
          RETURN_CODE_NO = 'no';
    /**
     * @var string
     */
    private $userName = '';

    /**
     * return no|yes|json.
     *
     * @var string
     */
    private $returnCode = 'yes';

    /**
     * @var string
     */
    private $key = '';

    /**
     * @var
     */
    private $host = '';

    /**
     * @var bool
     */
    private $toArray = false;

    /**
     * @param string $server
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function server($server = '')
    {
        if (empty($server)) {
            throw new \Exception('Server is not specified');
        }
        $allServers = config('vesta.servers');

        if (!isset($allServers[$server])) {
            throw new \Exception('Specified server not found in config');
        }

        if ($this->keysCheck($server, $allServers)) {
            throw new \Exception('Specified server config does not contain host or key');
        }

        $this->key = (string) $allServers[$server]['key'];
        $this->host = (string) $allServers[$server]['host'];

        return $this;
    }

    /**
     * @param string $server
     * @param array  $config
     *
     * @return bool
     */
    private function keysCheck($server, $config)
    {
        return !isset($config[$server]['key']) || !isset($config[$server]['host']);
    }

    /**
     * @param string $userName
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setUserName($userName = '')
    {
        if (empty($userName)) {
            throw new \Exception('User is not specified');
        }
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @param string $returnCode
     *
     * @return VestaAPI
     */
    public function setReturnCode($returnCode)
    {
        $this->returnCode = $returnCode;
        return $this;
    }

    /**
     * @param bool $toArray
     *
     * @return VestaAPI
     */
    public function setToArray($toArray)
    {
        $this->toArray = $toArray;
        return $this;
    }

    /**
     * @param string $cmd
     *
     * @return Sender
     * @throws VestaExceptions
     */
    public function send($cmd)
    {
        $postVars = [
            'user'       => $this->userName,
            'hash'       => $this->key, // api key
            'returncode' => $this->returnCode,
            'cmd'        => $cmd,
        ];
        $args = func_get_args();
        foreach ($args as $num => $arg) {
            if ($num === 0) {
                continue;
            }
            $postVars['arg'.$num] = $args[$num];
        }

        $query = Sender::create()
            ->setUri('https://' . $this->host . ':8083/api/')
            ->setPostString($postVars)
            ->setTimeout(10);

        if ($this->getReturnCode() == 'yes' && $query != 0) {
            throw new VestaExceptions($query);
        }
        return $query;
    }

    /**
     * @param Sender $sender
     *
     * @return mixed
     */
    public function toString(Sender $sender)
    {
        return $sender->getRaw();
    }

    /**
     * @param Sender $sender
     *
     * @return array
     */
    public function toArray(Sender $sender)
    {
        return $sender->getArray();
    }
}
