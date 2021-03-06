<?php

namespace App\Service;

use App\Message\MailMessage;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{
  public const TYPE_CHARACTER = 1;
  public const TYPE_CHARACTER_LIGHT = 2;

  private $mailer;
  private $from;

  public function __construct(MailerInterface $mailer, String $from)
  {
      $this->mailer = $mailer;
      $this->from = $from;
  }
  
  public function sendHtmlMail(MailMessage $message)
  {
    $this->mailer->send(
      (new TemplatedEmail())
          ->from( $message->getFrom() ? $message->getFrom() : $this->from )
          ->to($message->getTo())
          ->subject( $this->getSubject( $message->getType() ) )
          ->htmlTemplate( $this->getHtmlTemplate( $message->getType() ) )
          ->context([
            'data' =>$message->getData()
          ])
    );
  }

  private function getSubject(int $type)
  {
    switch($type) {
      case MailService::TYPE_CHARACTER_LIGHT:
        return 'Fiche personnage light';
        break;
      default:
        return 'Fiche personnage';
        break;
    }
  }

  private function getHtmlTemplate(int $type)
  {
    switch($type) {
      case MailService::TYPE_CHARACTER_LIGHT:
        return 'emails/character_light.html.twig';
        break;
      default:
        return 'emails/character.html.twig';
        break;
    }
  }
}