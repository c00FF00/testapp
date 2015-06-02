<?php

class UserIdentity extends CUserIdentity
{


    public function authenticate()
    {
        $users = Users::model()->findByAttributes(['username' => $this->username]);

        //var_dump($this->getRole($users->id)); die;

        if(!isset($users->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }   elseif ('Администратор' !== $this->getRole($users->id)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }

    }


    public function getRole($id)
    {
        return Roles::model()->findByAttributes(['id' => $id]);
    }

}


