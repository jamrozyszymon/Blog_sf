<?php

namespace App\Core\Controller;

use Symfony\Component\HttpFoundation\Request;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\Services\RegisterUser;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;


class RegisterController extends AbstractController
{
    /**
    *  @Route("/user/register", name="register")
    */
    public function register(Request $request, RegisterUser $registerUser)
    {
        $submittedToken = $request->request->get('token');

        if($this->isCsrfTokenValid('register-item', $submittedToken) && $request->isMethod('Post')) {
            try {
                $registerUser->registerFromRequest($request);
                $this->addFlash('success', 'Udana rejestracja. Teraz możesz zalogować się na swoje konto.');
                return $this->render('User/registration.html.twig');

            } catch (Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }

        }
        return $this->render('User/registration.html.twig');
    }

}
