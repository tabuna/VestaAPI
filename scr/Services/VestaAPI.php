<?php

namespace Tabuna\Vesta\Services;

use GuzzleHttp\Client;
use Tabuna\Vesta\Exceptions\VestaExceptions;

class VestaAPI
{
    use BD, DNS, User, Web, Service, Cron, FileSystem;

    /**
     * @var
     */
    public $userName = '';

    /**
     * return no|yes|json.
     *
     * @var string
     */
    public $returnCode = 'yes';

    /**
     * @var string
     */
    private $key = '';

    /**
     * @var
     */
    private $host = '';

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
            throw new \Exception('Server is not specified');
        }
        $this->userName = $userName;

        return $this;
    }

    /**
     * @param string $cmd
     *
     * @throws VestaExceptions
     *
     * @return string
     */
    public function send($cmd)
    {
        $postVars = [
            'user'       => $this->userName,
            'password'   => $this->key,
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

        $client = new Client([
            'base_uri'    => 'https://'.$this->host.':8083/api/',
            'timeout'     => 10.0,
            'verify'      => false,
            'form_params' => $postVars,
        ]);

        $query = $client->post('index.php')
            ->getBody()
            ->getContents();

        if ($this->returnCode == 'yes' && $query != 0) {
            throw new VestaExceptions($query);
        }

        return $query;
    }
}
