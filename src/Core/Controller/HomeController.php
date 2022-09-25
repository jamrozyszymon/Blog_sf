<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     *  @Route ("/", name="home")
     */
    public function index()
    {
        return $this->render('Home/home.html.twig');

    }

}
