<?php
namespace App\MessageHandler;

use App\Message\MailMessage;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MailMessageHandler implements MessageHandlerInterface
{
  private $mailer;

  public function __construct(MailerInterface $mailer)
  {
      $this->mailer = $mailer;
  }
  
  public function __invoke(MailMessage $message)
  {
    $this->mailer->send(
      (new TemplatedEmail())
          ->from($message->getFrom())
          ->to($message->getTo())
          ->subject($message->getSubject())
          ->htmlTemplate('emails/character.html.twig')
          ->context([
            'character' =>$message->getCharacter()
          ])
    );
  }

  
}