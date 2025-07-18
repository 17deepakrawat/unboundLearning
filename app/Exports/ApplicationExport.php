<?php

namespace App\Exports;

use App\Helpers\Helpers;
use App\Models\Academics\ApplicationSteps;
use App\Models\Leads\Opportunity;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationExport implements FromCollection, WithHeadings, WithMapping
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
    return Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline)->orWhereIn('application_owner_id', $downline);
    })->whereNotNull('conversion_date')->with(['vertical', 'admissionSession', 'admissionType', 'applicationOwner', 'studentStatus', 'stage', 'subStage', 'program', 'specialization', 'user', 'scheme', 'opportunityCustomFields'])->get();
  }

  public function headings(): array
  {
    return [
      'Application ID',
      'Name',
      'Email',
      'Phone',
      'Addmission Session',
      'Addmission Type',
      'Applciation Owner Name',
      'Status',
      'Scheme',
      'Addmission Duration',
      'Stage',
      'Sub Stage',
      'Vertical',
      'Program',
      'Specialization',
      'Source Campaign',
      'Source Medium',
      'Ad Group',
      'Ad',
      'Website',
      'Conversion Date',
      'User',
      'Created At',
      'Updated At',
    ];
  }

  public function map($application): array
  {
    return [
      $application->id,
      $application->name,
      $application->email,
      $application->phone,
      $application->admissionsession?->name,
      $application->admissiontype?->name,
      $application->applicationowner?->name,
      $application->studentstatus?->name,
      $application->scheme?->name,
      $application->admission_duration,
      $application->stage?->name,
      $application->substage?->name,
      $application->vertical?->name,
      $application->program?->name,
      $application->specialization?->name,
      $application->source_campaign,
      $application->source_medium,
      $application->ad_group,
      $application->ad_name,
      $application->website,
      $application->conversion_date,
      $application->user->name,
      $application->created_at,
      $application->updated_at,
    ];
  }
}
