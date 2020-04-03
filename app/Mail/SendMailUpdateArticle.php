<?php

namespace App\Mail;

use App\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUpdateArticle extends Mailable
{
    use Queueable, SerializesModels;

    protected $article;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail_update')->with([
            'articleTitle' => $this->article->title,
            'articleDateUpdated' => $this->article->updated_at,
            'articleAuthor' => $this->article->user->name
        ]);
    }
}
