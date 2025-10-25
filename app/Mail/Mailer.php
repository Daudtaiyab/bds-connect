<?php
namespace App\Mail;

use App\TblNotification;
use Illuminate\Support\Facades\Mail;

class Mailer
{
    public static function db_mail_updated($arr)
    {
        //return true;
        $details = [
            'mail_subject'      => $arr['mail_subject'],
            'mail_sent_to'      => $arr['mail_sent_to'],
            'notification_body' => $arr['notification_body'],
        ];
        //print_r($details);die;
        /*if($arr['mail_sent_from']!='')
                {
                    $message=\Mail::from($arr['mail_sent_from'])->to($arr['mail_sent_to']);
                }*/

        $message = Mail::to($arr['mail_sent_to']); //->replyTo('raja@gmail.com', 'Reply');

        $message = $message->send(new Sendmail($details, $arr['mail_subject']));

        // save logic data notification
        $tbl_notification                    = new TblNotification;
        $tbl_notification->mail_subject      = $arr['mail_subject'] ?? '';
        $tbl_notification->mail_sent_to      = $arr['mail_sent_to'] ?? '';
        $tbl_notification->notification_body = $arr['notification_body'] ?? '';
        $tbl_notification->save();

        return;
    }

    public function updated_db_notiffication($data)
    {
        $tbl_notification                    = new TblNotification;
        $tbl_notification->mail_subject      = $data['mail_subject'] ?? '';
        $tbl_notification->mail_sent_to      = $data['mail_sent_to'] ?? '';
        $tbl_notification->notification_body = $data['notification_body'] ?? '';
        $tbl_notification->save();

        return;
    }
}