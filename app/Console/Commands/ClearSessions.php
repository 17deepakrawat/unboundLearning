<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearSessions extends Command
{
  protected $signature = 'clear:session';
  protected $description = 'Clear all session data';

  public function handle()
  {
    $files = glob(storage_path('framework/sessions/*'));
    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file);
      }
    }

    $this->info('Session data cleared!');
  }
}
