<?php
namespace App\Libs;
use App\Jobs\SendMailJob;
use App\Models\Setting;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class MailLib
{
    /**
     * Function switch send email direct and via queue
     * @param $emailConfig array
     *  - smtp_host
     *  - smtp_port
     *  - smtp_encrypt
     *  - smtp_user
     *  - smtp_password
     *  - smtp_email
     *  - email_name
     * @param $to
     * @param array $cc
     * @param array $bcc
     * @param $title
     * @param $template
     * @param $data
     * @param bool $queue
     * @return bool
     * @throws \Exception
     */
    public static function sendSMTP($emailConfig, $to, $cc = [], $bcc = [], $title, $template, $data, $queue = true, $contentType = 'text/html')
    {
        LogFile::writeLog('send-mail', 'Title: '.$title.' | To: '.$to.' | CC: '.json_encode($cc).' | BCC: '.json_encode($bcc).
            ' | Template: '.$template.' | Data: '.json_encode($data).' | Queue: '.$queue.' | '.'Config: '.json_encode($emailConfig));
        if($queue){
            SendMailJob::dispatch($emailConfig, $to,  $cc, $bcc, $title, $template, $data, $contentType);
            return true;
        }else{
            try{
                $transport = new Swift_SmtpTransport($emailConfig['smtp_host'], $emailConfig['smtp_port'], $emailConfig['smtp_encrypt']);
                $transport->setUsername($emailConfig['smtp_user']);
                $transport->setPassword($emailConfig['smtp_password']);
                $mailer = new Swift_Mailer($transport);
                $message = (new Swift_Message($title))
                    ->setFrom([$emailConfig['smtp_email'] => $emailConfig['email_name']])
                    ->setTo([$to]);
                if(!empty($cc)){
                    foreach($cc as $k => $v){
                        $message->setCc($v);
                    }
                }
                if(!empty($bcc)){
                    foreach($bcc as $k => $v){
                        $message->setBcc($v);
                    }
                }
                $message->setCharset('utf-8');
                $view = view($template, $data);
                $message->setBody($view->render(), $contentType);
                $result = $mailer->send($message);
                return true;
            }catch (\Exception $ex){
                throw $ex;
            }
        }
    }


    /**
     * Function get email config of company
     * @param $companyId
     * @return bool|mixed
     */
}
?>
