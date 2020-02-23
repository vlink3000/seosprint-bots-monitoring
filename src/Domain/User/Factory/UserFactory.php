<?php

namespace App\Domain\User\Factory;

use App\Application\Validator\UserValidator;
use App\Domain\User\Entity\User;

class UserFactory
{
    /**
     * @param array $userArray
     *
     * @return User
     */
    public function createFromRequest(array $userArray): User
    {
        $validator = new UserValidator();
        $validatedUser = $validator->validateUserData($userArray);

        $user = new User();

        $user->setUserId($validatedUser['userId']);
        $user->setUserName($validatedUser['userName']);
        $user->setBalance($validatedUser['balance']);
        $user->setTime(date("h:i:s"));

        return $user;
    }
}