<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\Storage;

class LeadsImportStatusExport implements FromArray
{
  /**
   * @return \Illuminate\Support\FromArray
   */
  protected $statuses;

  public function __construct($statuses)
  {
    $this->statuses = $statuses;
  }

  public function array(): array
  {
    return array_merge(
      [['Row', 'Status', 'Error']], // CSV headers
      array_map(function ($status) {
        return [$status['row'], $status['status'], $status['error'] ?? 'N/A'];
      }, $this->statuses)
    );
  }
}
