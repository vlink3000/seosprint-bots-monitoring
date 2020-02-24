<?php

namespace App\Domain\User\Factory;

use App\Application\Validator\UserValidator;
use App\Domain\User\Entity\User;
use Carbon\Carbon;

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

        $user->setSeosprintId($validatedUser['seosprintId']);
        $user->setUserName($validatedUser['userName']);
        $user->setBalance($validatedUser['balance']);
        $user->setDateTime(Carbon::now());

        return $user;
    }
}