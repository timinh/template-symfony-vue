<?php

namespace App\Controller;

use App\Message\MailMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/sendmail", methods={"POST"})
     */
    public function sendMail(Request $request, MessageBusInterface $bus)
    {
        $content = json_decode($request->getContent(), true);
        $bus->dispatch(new MailMessage('topeti@topeto.com', 'Essai de message', $content));
        return $this->json('Votre message a été mis dans la file d\'envoi...');
    }
}
