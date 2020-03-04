<?php

namespace App\Application\Validator;

interface UserValidatorInterface
{
    /**
     * @param array $userData
     *
     * @return array
     */
    public function validateUserData(array $userData): array;
}