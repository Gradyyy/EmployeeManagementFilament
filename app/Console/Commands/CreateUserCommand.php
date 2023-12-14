<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name = $this->ask('Enter the user name:');
        $email = $this->ask('Enter the user email:');
        do{
            $password = $this->ask('EnterPassword');
        } while(empty($password));

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $teamName = $this->ask('Enter the team name:');
        $slug = $this->ask('enter slug');

        $team = Team::create([
            'name' => $teamName,
            'slug' => $slug
        ]);

        $user->teams()->attach($team->id);
        $this->info('User and team created successfully');
    }
}
