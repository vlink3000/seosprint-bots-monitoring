<?php

namespace App\Application\Validator;

class UserValidator implements UserValidatorInterface
{
    /***
     * @param array $userData
     *
     * @return array
     */
    public function validateUserData(array $userData): array
    {
        $keys = [
            'seosprintId',
            'userName',
            'balance'
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $userData)) {
                $userData[$key] = null;
            }
        }

        return $userData;
    }
}