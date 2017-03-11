<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $inputs;
    protected $type;

    public function __construct(array $inputs, $type)
    {
        $this->inputs = $inputs;
        $this->type = $type;
    }

    public function handle()
    {
        $link = action($this->inputs['feature']
            ? 'AnswerController@answerPublic'
            : 'AnswerController@answerPrivate', [
                'token' => $this->inputs['token'],
        ]);
        $linkManage = '';
        $view = 'emails.email_invite';

        if ($this->type == 'mailManage') {
            $view = 'emails.email_manage';
            $linkManage = action('AnswerController@show', [
                'token' =>  $this->inputs['token_manage'],
            ]);
        }

        Mail::send($view, [
            'name' => $this->inputs['name'],
            'title' => $this->inputs['title'],
            'description' => $this->inputs['description'],
            'link' => $link,
            'link_manage' => $linkManage,
       ], function ($message) {
           $message->from(config('mail.from.address') , trans('survey.title_web'));
           $message->to($this->inputs['email']);
       });
    }
}
