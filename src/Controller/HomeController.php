<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/private", name="home")
     * @Route("/private/{page}", name="private_pages")
     * @Route("/private/{page}/{id}", name="private_pages2")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}
