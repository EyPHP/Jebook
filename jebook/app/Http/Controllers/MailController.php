<?php
/**
 * MailController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-12 11:02
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;

class MailController
{
    static function send($title,$toEmail,$param = [],$temp = 'mail.userVerify')
    {
        Mail::send($temp,$param,function($message)use($title,$toEmail){
            $to = $toEmail;
            $message->to($to)->subject($title);
        });
        if(Mail::failures()){
            return false;
        }
        return true;
    }
}