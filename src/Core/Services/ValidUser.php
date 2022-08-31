<?php

namespace App\Core\Services;

use Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 * Validate input from Registration Form
 */
class ValidUser
{
    public function validLogin(Request $request): void
    {
        if(empty($request->get('name'))) {
            throw new Exception('Wprowadź login');
        }
    }

    public function validLengthLogin(Request $request): void
    {
        if(strlen($request->get('name'))>20) {
            throw new Exception('Login nie może być dłuższy niż 20 znaków.');
        }
    }

    public function validEmail(Request $request): void
    {
        if(empty($request->get('email'))) {
            throw new Exception('Wprowadź e-mail');
        }
    }

    public function validPasswords(Request $request): void
    {
        if($request->get('password') != $request->get('confirmpassword')) {
            throw new Exception('Podane hasła nie są takie same');
        }
    }

    public function validLengthPassword(Request $request): void
    {
        if(strlen($request->get('password'))<8) {
            throw new Exception('Hasło musi zawierać co najmniej 8 znaków.');
        }
    }



}
