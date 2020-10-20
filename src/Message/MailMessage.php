<?php
namespace App\Message;

use App\Service\MailService;

class MailMessage
{
  private $to;
  private $from;
  private $subject;
  private $data;
  private $type;

  public function __construct(String $to, String $from=null, String $subject, Array $data, int $type = MailService::TYPE_CHARACTER)
  {
    $this->to = $to;
    $this->from = $from;
    $this->subject = $subject;
    $this->data = $data;
    $this->type = $type;
  }
  
  public function getTo()
  {
    return $this->to;
  }

  public function getFrom()
  {
    return $this->from;
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