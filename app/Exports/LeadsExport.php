<?php

namespace App\Exports;

use App\Helpers\Helpers;
use App\Models\Leads\Lead;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);

    return Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('source', 'subSource', 'stage', 'subStage', 'user', 'program', 'specialization', 'country', 'state', 'city')->get();
  }

  public function headings(): array
  {
    return [
      'Lead ID',
      'Name',
      'Email',
      'Phone',
      'DOB',
      'Source',
      'Sub Source',
      'Stage',
      'Sub Stage',
      'Program',
      'Specialization',
      'Country',
      'State',
      'City',
      'Zip Code',
      'Source Campaign',
      'Source Medium',
      'Ad Group',
      'Ad',
      'Website',
      'Email Verified',
      'Phone Verified',
      'User',
      'Created At',
      'Updated At',
    ];
  }

  public function map($lead): array
  {
    return [
      $lead->id,
      $lead->first_name . ' ' . $lead->last_name,
      $lead->email,
      $lead->phone,
      $lead->dob,
      $lead->source?->name,
      $lead->subSource?->name,
      $lead->stage?->name,
      $lead->subStage?->name,
      $lead->program?->name,
      $lead->specialization?->name,
      $lead->country?->name,
      $lead->state?->name,
      $lead->city?->name,
      $lead->zip_code,
      $lead->source_campaign,
      $lead->source_medium,
      $lead->ad_group,
      $lead->ad_name,
      $lead->website,
      $lead->email_verified,
      $lead->phone_verified,
      $lead->user->name,
      $lead->created_at,
      $lead->updated_at,
    ];
  }
}
