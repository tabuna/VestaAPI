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
    public function changeUserPassword($user, $password)
    {
        return $this->toString($this->send('v-change-user-password', $user, $password));
    }

    /**
     * @param $user
     * @param $email
     *
     * @return mixed
     */
    public function changeUserEmail($user, $email)
    {
        return $this->toString($this->send('v-change-user-contact', $user, $email));
    }

    /**
     * List User Account.
     *
     * @param $user
     *
     * @return mixed
     */
    public function listUserAccount($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user', $user, 'json'));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function listUserLog($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-log', $user, 'json'));
    }

    /**
     * List User Backups.
     *
     * @param $user
     *
     * @return mixed
     */
    public function listUserBackups($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-backups', $user, 'json'));
    }

    /**
     * Delete backup user.
     *
     * @param $user
     * @param $backup
     *
     * @return mixed
     */
    public function deleteUserBackup($user, $backup)
    {
        return $this->toString($this->send('v-delete-user-backup', $user, $backup));
    }

    /**
     * Show Backup.
     *
     * @param $user
     * @param $backup
     *
     * @return mixed
     */
    public function showUserBackup($user, $backup)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user-backup', $user, $backup, 'json'));
    }

    /**
     * @param $user
     * @param $arg
     *
     * @return mixed
     */
    public function restoreBackup($user, $arg)
    {
        $backup = 'no';
        $web = 'no';
        $dns = 'no';
        $mail = 'no';
        $db = 'no';
        $cron = 'no';
        $udir = 'no';
        extract($arg, EXTR_OVERWRITE);

        return $this->toString($this->send('v-schedule-user-restore', $user, $backup, $web, $dns, $mail,
            $db, $cron, $udir));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function suspendUser($user)
    {
        return $this->toString($this->send('v-suspend-user', $user, 'no'));
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
     * @param $user
     * @param $option
     *
     * @return mixed
     */
    public function getValue($user, $option)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-get-user-value', $user, $option));
    }

    /**
     * @param        $user
     * @param string $ssh
     *
     * @return mixed
     */
    public function changeShell($user, $ssh = 'nologin')
    {
        return $this->toString($this->send('v-change-user-shell', $user, $ssh));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function adminListUserAccount($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-user', $user, 'json'));
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
