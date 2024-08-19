<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all User Password based Current APP_KEY';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! $this->confirm('Apakah Anda yakin ingin mereset semua password user?')) {
            $this->info('Operasi dibatalkan.');

            return;
        }

        $this->info('Memulai reset password user');

        $userData = User::all();

        $userDataCount = $userData->count();
        $progressBar   = $this->output->createProgressBar($userDataCount);
        $progressBar->start();

        foreach ($userData as $user) {
            $user->update([
                'password' => Hash::make($user->username),
            ]);
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line('');
        $this->info('Reset password berhasil');
    }
}
