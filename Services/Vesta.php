<?php

namespace VestaAPI\Services;

use GuzzleHttp\Client;
use VestaAPI\Exceptions\VestaExceptions;

class Vesta
{
    use BD, DNS, User, Web, Service, Cron, FileSystem;

    /**
     * @var
     */
    public $vestaUserName;

    /**
     * return no|yes|json.
     *
     * @var string
     */
    public $returnCode = 'yes';

    /**
     * @var string
     */
    private $key;

    /**
     * @var
     */
    private $host;

    /**
     * Vesta constructor.
     *
     * @param      $vestaUserName
     * @param null $server
     */
    public function __construct($vestaUserName = null, $server = null)
    {
        if (is_null($server)) {
            $config = config('vesta.servers')[config('vesta.primary')];
        } else {
            $config = config('vesta.servers.'.$server);
        }

        $this->vestaUserName = $vestaUserName;
        $this->key = (string) $config['key'];
        $this->host = (string) $config['host'];
    }

    /**
     * @param $server
     *
     * @return $this
     */
    public function server($server)
    {
        $config = config('vesta.servers.'.$server);
        $this->key = (string) $config['key'];
        $this->host = (string) $config['host'];

        return $this;
    }

    /**
     * @param $vestaUserName
     *
     * @return $this
     */
    public function user($vestaUserName)
    {
        $this->vestaUserName = $vestaUserName;

        return $this;
    }

    /**
     * @param      $cmd
     * @param null $arg1
     * @param null $arg2
     * @param null $arg3
     * @param null $arg4
     * @param null $arg5
     * @param null $arg6
     * @param null $arg7
     * @param null $arg8
     * @param null $arg9
     *
     * @throws VestaExceptions
     *
     * @return mixed
     */
    public function send(
        $cmd,
        $arg1 = null,
        $arg2 = null,
        $arg3 = null,
        $arg4 = null,
        $arg5 = null,
        $arg6 = null,
        $arg7 = null,
        $arg8 = null,
        $arg9 = null
    ) {
        $postVars = [
            'hash'       => $this->key,
            'returncode' => $this->returnCode,
            'cmd'        => $cmd,
            'arg1'       => $arg1,
            'arg2'       => $arg2,
            'arg3'       => $arg3,
            'arg4'       => $arg4,
            'arg5'       => $arg5,
            'arg6'       => $arg6,
            'arg7'       => $arg7,
            'arg8'       => $arg8,
            'arg9'       => $arg9,
        ];

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
