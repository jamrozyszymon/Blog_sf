<?php

namespace App\Core\Services;

use App\Core\Services\CreateUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Core\ValueObject\UserValueObject;
use App\Core\Services\ValidUser;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegisterUser
{
    /** @var $createUser */

    /** @var ValidUser */
    private $validUser;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->createUser = new CreateUser($entityManagerInterface, $userPasswordHasherInterface);
        $this->validUser = new ValidUser;
    }

    public function registerFromRequest(Request $request): void
    {
        $this->validUser->validLogin($request);
        $this->validUser->validLengthLogin($request);
        $this->validUser->validEmail($request);
        $this->validUser->validPasswords($request);
        $this->validUser->validLengthPassword($request);
  
        $userValueObject = new UserValueObject;
        $userValueObject->name = $request->get('name');
        $userValueObject->email = $request->get('email');
        $userValueObject->password = $request->get('password');
        $this->createUser->create($userValueObject);
        
    }
}
