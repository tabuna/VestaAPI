<?php

namespace VestaAPI\Services;

trait User
{
    /**
     * Registration User.
     *
     * @param $username
     * @param $password
     * @param $email
     * @param $package
     * @param $fistName
     * @param $lastName
     *
     * @return mixed
     */
    public function regUser($username, $password, $email, $package, $fistName, $lastName)
    {
        return $this->toString($this->send('v-add-user', $username, $password, $email, $package, $fistName, $lastName));
    }

    /**
     * @param $password
     *
     * @return mixed
     */
    public function changeUserPassword($password)
    {
        return $this->toString($this->send('v-change-user-password', $this->getUserName(), $password));
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function changeUserEmail($email)
    {
        return $this->toString($this->send('v-change-user-contact', $this->getUserName(), $email));
    }

    /**
     * List User Account.
     *
     * @return mixed
     */
    public function listUserAccount()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user', $this->getUserName(), 'json'));
    }

    /**
     * @return mixed
     */
    public function listUserLog()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-log', $this->getUserName(), 'json'));
    }

    /**
     * List User Backups.
     *
     * @return mixed
     */
    public function listUserBackups()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-backups', $this->getUserName(), 'json'));
    }

    /**
     * Delete backup user.
     *
     * @param $backup
     *
     * @return mixed
     */
    public function deleteUserBackup($backup)
    {
        return $this->toString($this->send('v-delete-user-backup', $this->getUserName(), $backup));
    }

    /**
     * Show Backup.
     *
     * @param $backup
     *
     * @return mixed
     */
    public function showUserBackup($backup)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-backup', $this->getUserName(), $backup, 'json'));
    }

    /**
     * @param $arg
     *
     * @return mixed
     */
    public function restoreBackup($arg)
    {
        $backup = 'no';
        $web = 'no';
        $dns = 'no';
        $mail = 'no';
        $db = 'no';
        $cron = 'no';
        $udir = 'no';
        extract($arg, EXTR_OVERWRITE);

        return $this->toString($this->send('v-schedule-user-restore', $this->getUserName(), $backup, $web, $dns, $mail,
            $db, $cron, $udir));
    }

    /**
     * @return mixed
     */
    public function suspendUser()
    {
        return $this->toString($this->send('v-suspend-user', $this->getUserName(), 'no'));
    }

    /**
     * @param $package
     *
     * @return mixed
     */
    public function changePackage($package)
    {
        return $this->toString($this->send('v-suspend-user', $this->getUserName(), $package));
    }

    /**
     * @return mixed
     */
    public function listUserPackages()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-packages', 'json'));
    }

    /**
     * @param $option
     *
     * @return mixed
     */
    public function getValue($option)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-get-user-value', $this->getUserName(), $option));
    }

    /**
     * @param string $ssh
     *
     * @return mixed
     */
    public function changeShell($ssh = 'nologin')
    {
        return $this->toString($this->send('v-change-user-shell', $this->getUserName(), $ssh));
    }

    /**
     * @return mixed
     */
    public function adminListUserAccount()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user', $this->getUserName(), 'json'));
    }

    /**
     * @return mixed
     */
    public function adminListUserPackages()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-packages', 'json'));
    }

    /**
     * @return mixed
     */
    public function adminListUserShell()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-sys-shells', 'json'));
    }
}
