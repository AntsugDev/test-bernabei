<?php

namespace App\Service;

use App\Entity\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorService
{

    public function validate(ValidatorInterface $validator): JsonResponse
    {
        $auth = new Auth();

        $errors = $validator->validate($auth);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new JsonResponse($errorsString, 403);
        }
    }
}
