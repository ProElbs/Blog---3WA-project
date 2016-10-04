<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a newsletter for bad users';

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
        $users = User::getBadUser();
        foreach ($users as $user) {

          // 'email/welcome' est la vue, [] est le transporteur pour des infos etc puis function
          Mail::send('mail/newsletter', ['user' => $user],
            function ($m) use ($user) {
              $m->from('d.lebosse@groupe-esigelec.fr', 'Damien Lebossé');
              $m->to($user->email, $user->nom)
                ->subject('Comment is life !');
            });
        }
        $this->info('Newsletter envoyé à '.count($users).' utilisateurs');
    }
}
