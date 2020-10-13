<?php
namespace App\Message;

class MailMessage
{
  private $from;
  private $to;
  private $subject;
  private $character;

  public function __construct(String $from, String $to, String $subject, Array $character)
  {
    $this->from = $from;
    $this->to = $to;
    $this->subject = $subject;
    $this->character = $character;
  }

  public function getFrom()
  {
    return $this->from;
  }
  
  public function getTo()
  {
    return $this->to;
  }

  public function getSubject()
  {
    return $this->subject;
  }

  public function getCharacter()
  {
    return $this->character;
  }
}