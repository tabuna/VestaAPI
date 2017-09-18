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
     * @param string $user
     * @param        $src
     * @param        $dst
     *
     * @return mixed
     */
    public function moveFile($user, $src, $dst)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-move-fs-file', $user, $src, $dst));
    }

    /**
     * @param string $user
     * @param string $path
     *
     * @return mixed
     */
    public function openFile($user, $path = '')
    {
        $path = '/home/'.$this->getUserName().'/'.$path;
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-open-fs-file', $user, $path));
    }

    /**
     * @param $user
     * @param $path
     *
     * @return mixed
     */
    public function addDir($user, $path)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-add-fs-directory', $user, $path));
    }

    /**
     * @param $user
     * @param $path
     *
     * @return mixed
     */
    public function addFile($user, $path)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-add-fs-file', $user, $path));
    }

    /**
     * @param string $user
     * @param        $srcFile
     * @param        $permissions
     *
     * @return mixed
     */
    public function changePermission($user, $srcFile, $permissions)
    {
        $srcFile = '/home/'.$this->getUserName().'/'.$srcFile;
        return $this->setReturnCode('no')->toArray($this->send('v-change-fs-file-permission', $user, $srcFile, $permissions));
    }

    /**
     * @param $user
     * @param $srcDir
     * @param $dstDir
     *
     * @return mixed
     */
    public function copyDir($user, $srcDir, $dstDir)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-copy-fs-directory', $user, $srcDir, $dstDir));
    }

    /**
     * @param $user
     * @param $srcDir
     * @param $dstDir
     *
     * @return mixed
     */
    public function copyFile($user, $srcDir, $dstDir)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-copy-fs-file', $user, $srcDir, $dstDir));
    }

    /**
     * @param string $user
     * @param        $dstDir
     *
     * @return mixed
     */
    public function deleteDir($user, $dstDir)
    {
        $dstDir = '/home/'.$this->getUserName().'/'.$dstDir;
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-delete-fs-dir', $user, $dstDir));
    }

    /**
     * @param $user
     * @param $dstFile
     *
     * @return mixed
     */
    public function deleteFile($user, $dstFile)
    {
        $dstFile = '/home/'.$this->getUserName().'/'.$dstFile;
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-delete-fs-file', $user, $dstFile));
    }

    /**
     * @param $user
     * @param $srcFile
     * @param $dstDir
     *
     * @return mixed
     */
    public function extractArchive($user, $srcFile, $dstDir)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-extract-fs-archive', $user, $srcFile, $dstDir));
    }

    /**
     * @param        $user
     * @param string $path
     *
     * @return mixed
     */
    public function listDirectory($user, $path = '')
    {
        $path = '/home/'.$this->getUserName().'/'.$path;
        $responseVesta = $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-fs-directory', $user,  $path));

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
