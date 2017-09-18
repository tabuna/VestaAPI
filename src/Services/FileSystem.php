<?php

namespace VestaAPI\Services;

trait FileSystem
{
    /**
     * @var string
     */
    protected $delimiter = '|';

    /**
     * @var array
     */
    protected $info_positions = [
        'TYPE'        => 0,
        'PERMISSIONS' => 1,
        'DATE'        => 2,
        'TIME'        => 3,
        'OWNER'       => 4,
        'GROUP'       => 5,
        'SIZE'        => 6,
        'NAME'        => 7,
    ];

    /**
     * @param $src
     * @param $dst
     *
     * @return mixed
     */
    public function moveFile($src, $dst)
    {
        $this->setReturnCode('no');

        return $this->send('v-move-fs-file', $this->getUserName(), $src, $dst);
    }

    /**
     * @param string $path
     *
     * @return mixed
     */
    public function openFile($path = '')
    {
        $path = '/home/'.$this->getUserName().'/'.$path;
        $this->setReturnCode('no');

        return $this->send('v-open-fs-file', $this->getUserName(), $path);
    }

    /**
     * @param $patch
     *
     * @return mixed
     */
    public function addDir($patch)
    {
        $this->returnCode = 'no';

        return $this->send('v-add-fs-directory', $this->getUserName(), $patch);
    }

    /**
     * @param $patch
     *
     * @return mixed
     */
    public function addFile($patch)
    {
        $this->returnCode = 'no';

        return $this->send('v-add-fs-file', $this->getUserName(), $patch);
    }

    /**
     * @param $srcFile
     * @param $permissions
     *
     * @return mixed
     */
    public function changePermission($srcFile, $permissions)
    {
        $srcFile = '/home/'.$this->getUserName().'/'.$srcFile;
        $this->returnCode = 'no';

        return $this->send('v-change-fs-file-permission', $this->getUserName(), $srcFile, $permissions);
    }

    /**
     * @param $srcDir
     * @param $dstDir
     *
     * @return mixed
     */
    public function copyDir($srcDir, $dstDir)
    {
        $this->setReturnCode('no');

        return $this->send('v-copy-fs-directory', $this->getUserName(), $srcDir, $dstDir);
    }

    /**
     * @param $srcDir
     * @param $dstDir
     *
     * @return mixed
     */
    public function copyFile($srcDir, $dstDir)
    {
        $this->setReturnCode('no');

        return $this->send('v-copy-fs-file', $this->getUserName(), $srcDir, $dstDir);
    }

    /**
     * @param $dstDir
     *
     * @return mixed
     */
    public function deleteDir($dstDir)
    {
        $this->returnCode = 'no';
        $dstDir = '/home/'.$this->getUserName().'/'.$dstDir;

        return $this->send('v-delete-fs-dir', $this->getUserName(), $dstDir);
    }

    /**
     * @param $dstFile
     *
     * @return mixed
     */
    public function deleteFile($dstFile)
    {
        $this->setReturnCode('no');
        $dstFile = '/home/'.$this->getUserName().'/'.$dstFile;

        return $this->send('v-delete-fs-file', $this->getUserName(), $dstFile);
    }

    /**
     * @param $srcFile
     * @param $dstDir
     *
     * @return mixed
     */
    public function extractArchive($srcFile, $dstDir)
    {
        $this->setReturnCode('no');

        return $this->send('v-extract-fs-archive', $this->getUserName(), $srcFile, $dstDir);
    }

    /**
     * @param $path
     *
     * @return mixed
     */
    public function listDirectory($path = '')
    {
        $path = '/home/'.$this->getUserName().'/'.$path;
        $this->setReturnCode('no');
        $responseVesta = $this->send('v-list-fs-directory', $this->getUserName(), $path);

        return $this->parseListing($responseVesta);
    }

    /**
     * @param $raw
     *
     * @return array
     */
    public function parseListing($raw)
    {
        $raw = explode(PHP_EOL, $raw);
        $raw = array_filter($raw);
        $data = [];

        foreach ($raw as $o) {
            $info = explode($this->delimiter, $o);
            if (empty($info)) {
                continue;
            }
            $value = [
                'type'        => $info[$this->info_positions['TYPE']],
                'permissions' => $info[$this->info_positions['PERMISSIONS']],
                'date'        => $info[$this->info_positions['DATE']],
                'time'        => $info[$this->info_positions['TIME']],
                'owner'       => $info[$this->info_positions['OWNER']],
                'group'       => $info[$this->info_positions['GROUP']],
                'size'        => $info[$this->info_positions['SIZE']],
                'name'        => (!empty($info[$this->info_positions['NAME']])) ? $info[$this->info_positions['NAME']] : '../',
            ];
            array_push($data, $value);
        }

        return $data;
    }
}
