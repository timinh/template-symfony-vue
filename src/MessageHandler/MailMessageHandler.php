<?php
namespace App\MessageHandler;

use App\Message\MailMessage;
use App\Service\MailService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MailMessageHandler implements MessageHandlerInterface
{
  private $mailService;

  public function __construct(MailService $mailService)
  {
    $this->mailService = $mailService;
  }
  
  public function __invoke(MailMessage $message)
  {
    $this->mailService->sendHtmlMail($message);
  }

  
}