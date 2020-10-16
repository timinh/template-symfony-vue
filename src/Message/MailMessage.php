<?php
namespace App\Message;

use App\Service\MailService;

class MailMessage
{
  private $to;
  private $subject;
  private $data;
  private $type;

  public function __construct(String $to, String $subject, Array $data, int $type = MailService::TYPE_CHARACTER)
  {
    $this->to = $to;
    $this->subject = $subject;
    $this->data = $data;
    $this->type = $type;
  }
  
  public function getTo()
  {
    return $this->to;
  }

  public function getSubject()
  {
    return $this->subject;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getData()
  {
    return $this->data;
  }
}