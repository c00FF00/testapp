<?php

class UserIdentity extends CUserIdentity
{
    private $dbid;
    const ERROR_USER_DONOT_LOGIN = 50;
    public $errorCode=self::ERROR_USER_DONOT_LOGIN;
    public function authenticate()
    {
        $users = Users::model()->findByAttributes(['username' => $this->username]);

        $this->dbid = $users->id;

        if (!isset($this->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ('Administrator' !== $this->getRole()) {
            $this->errorCode = self::ERROR_USER_DONOT_LOGIN;
        } elseif ($this->password == $users->password) {
            $this->setState('username', $users->username);
            $this->setState('role', $this->getRole());
            $this->errorCode = self::ERROR_NONE;
        } else {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }

        return !$this->errorCode;
    }

    public function getRole()
    {
        $res = Roles::model()->findByAttributes(['id' => $this->dbid]);
        return $res->name;
    }
}


