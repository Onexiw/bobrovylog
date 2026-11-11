<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/lib/phpmailer/class.phpmailer.php');//не работает с cron
//require_once ("../../conf.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/phpmailer/class.phpmailer.php');
//require_once('/var/www/html/sebesto.ru/lib/phpmailer/class.smtp.php');

class FreakMailer extends PHPMailer
{
    var $priority = null;
    var $to_name;
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;
  
    function FreakMailer()
    {
      global $site;
      
      // Берем из файла config.php массив $site
      
      if($site['smtp_mode'] == 'enabled')
      {
        $this->Host = $site['smtp_host'];
        $this->Port = $site['smtp_port'];
        if($site['smtp_username'] != '')
        {
         $this->SMTPAuth  = true;
         $this->Username  = $site['smtp_username'];
         $this->Password  =  $site['smtp_password'];
        }
        $this->Mailer = "smtp";
      }
      if(!$this->From)
      {
        $this->From = $site['from_email'];
      }
      if(!$this->FromName)
      {
        $this-> FromName = $site['from_name'];
      }
      if(!$this->Sender)
      {
        $this->Sender = $site['from_email'];
      }
      $this->Priority = $this->priority;
    }
}
?>