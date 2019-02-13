<?php

namespace App\Jobs;

use App\Libs\LogFile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $config, $to, $cc, $bcc, $title, $template, $data, $contentType;

    public function __construct($config, $to, $cc = [], $bcc = [], $title, $template, $data, $contentType)
    {
        $this->config = $config;
        $this->to = $to;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->title = $title;
        $this->template = $template;
        $this->data = $data;
        $this->contentType = $contentType;
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     */
    public function handle()
    {
        try {
            $transport = new Swift_SmtpTransport($this->config['smtp_host'], $this->config['smtp_port'], $this->config['smtp_encrypt']);
            $transport->setUsername($this->config['smtp_user']);
            $transport->setPassword($this->config['smtp_password']);
            $mailer = new Swift_Mailer($transport);
            $message = (new Swift_Message($this->title))
                ->setFrom([$this->config['smtp_email'] => $this->config['email_name']])
                ->setTo([$this->to]);
            if (!empty($this->cc)) {
                foreach ($this->cc as $k => $v) {
                    $message->setCc($v);
                }
            }
            if (!empty($bcc)) {
                foreach ($bcc as $k => $v) {
                    $message->setBcc($v);
                }
            }
            $message->setCharset('utf-8');
            $view = view($this->template, $this->data);
            $message->setBody($view->render(), $this->contentType);
            $result = $mailer->send($message);
            LogFile::writeLog('send-mail', 'Title: ' . $this->title . ' | To: ' . $this->to . ' | Result: ' . json_encode($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
