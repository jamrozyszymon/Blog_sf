<?php

namespace App\Core\Services;

use App\Core\ValueObject\UserValueObject;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Exception;

class CreateUser
{
    /** @var $entityManagerInterface */
    private $entityManagerInterface;

    /** @var UserPasswordHasherInterface */
    private $userPasswordHasherInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->entityManagerInterface=$entityManagerInterface;
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    /**
     * Create user with validation of duplicate login od e-mail in Database
     */
    public function create(UserValueObject $userValueObject): void
    {
        $user = new User();
        $user->setName($userValueObject->name);
        $user->setEmail($userValueObject->email);
        $passwordHashed = $this->userPasswordHasherInterface->hashPassword($user, $userValueObject->password);
        $user->setRoles($userValueObject->roles ?? ['ROLE_USER']);
        $user->setPassword($passwordHashed);
        $this->entityManagerInterface->persist($user);

        /**
         * check duplication login or email by key's value from UniqueConstraintViolationException
         */
        try {
            $this->entityManagerInterface->flush();
        } catch (UniqueConstraintViolationException $e) {
            if (is_int(strpos($e->getPrevious()->getMessage(), 'UNIQ_8D93D6495E237E06'))) {
                throw new Exception('Podany login jest już zajęty.');
            } else {
                throw new Exception('Istnieje już konto przypisane do tego e-maila.');
            }
        }

    }

}

//'user.UNIQ_8D93D6495E237E06'
//'user.UNIQ_8D93D649E7927C74'
