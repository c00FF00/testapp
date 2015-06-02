<?php

class UserIdentity extends CUserIdentity
{
    private $dbid;

    public function authenticate()
    {
        $users = Users::model()->findByAttributes(['username' => $this->username]);

        $this->dbid = $users->id;

        var_dump($users); die;

//
//        if('Администратор' !== $this->getRole()) {
//            echo $this->getRole();
//            $this->errorCode = self::ERROR_USERNAME_INVALID;
//        }
//
//        if (!isset($users->username)) {
//            $this->errorCode = self::ERROR_USERNAME_INVALID;
//        }
//        elseif (!CPasswordHelper::verifyPassword($this->password, $users->password)) {
//            $this->errorCode = self::ERROR_PASSWORD_INVALID;
//        } else {
//            $this->dbid = $users->id;
//            $this->setState('username', $users->username);
//            $this->errorCode = self::ERROR_NONE;
//            if ($role = $this->getRole()) {
//                $this->setState('role', $role);
//            }
//        }
//
//        return !$this->errorCode;
//    }
//
//
//    public function getRole() {
//        return Roles::model()->findByAttributes(['name' => $this->getId()]);
//    }
//
//    public function getId()
//    {
//        return $this->dbid;
    }
}

