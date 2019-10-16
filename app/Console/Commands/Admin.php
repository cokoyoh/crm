<?php

namespace App\Console\Commands;

use App\Mail\SimpleMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A simple mailer trial';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'view' => 'emails.general',
            'subject' => 'Admin Trial Email',
            'content' => 'This is a trial email',
            'firstname' => 'Ogutuz',
            'to' => 'charlesokoyoh@gmail.com'
        ];

        Mail::queue(new SimpleMail($data));

        dd('Done');
    }
}
