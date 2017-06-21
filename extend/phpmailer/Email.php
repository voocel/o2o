<?php
namespace phpmailer;
use phpmailer\Phpmailer;
class Email{
    public static function send ($to,$title,$content){
        //header("content-type:text/html;charset=utf-8");
        date_default_timezone_set('PRC');
        if(empty($to)){
            return false;
        }
        try{
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //设置编码
        $mail->CharSet = "utf-8";
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //调试信息
        //$mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = config('email.host');
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = config('email.port');

        //Set the encryption system to use - ssl (deprecated) or tls
        //$mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = config('email.username');

        //Password to use for SMTP authentication
        $mail->Password = config('email.password');

        //Set who the message is to be sent from
        $mail->setFrom(config('email.username'), config('email.nickname'));

        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($to);

        //Set the subject line
        $mail->Subject = $title;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($content);

        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            return false;
        } else {
            return 'success!';
        }
        }catch(phpmailerException $e){
            return false;
        }
      }
    }