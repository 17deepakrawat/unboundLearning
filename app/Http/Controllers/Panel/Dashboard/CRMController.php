<?php

namespace App\Http\Controllers\Panel\Dashboard;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Leads\Lead;
use App\Models\Leads\LeadTask;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Leads\Stage;
use Illuminate\Support\Facades\Auth;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class CRMController extends Controller
{
  public function index()
  {

    $downline = Auth::user()->hasRole('Super Admin') ? [] : Helpers::getDownline(Auth::user()->id);

    $stagesCount = Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('stage')->get()->groupBy('stage_id')->mapWithKeys(function ($item, $stageId) {
      $stageName = optional($item->first()->stage)->name; // Get the stage name
      return [$stageName => $item->count()]; // Map stage name to count
    });

    $opportunitiesCount = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('stage')->get()->groupBy('stage_id')->mapWithKeys(function ($item, $stageId) {
      $stageName = optional($item->first()->stage)->name; // Get the stage name
      return [$stageName => $item->count()]; // Map stage name to count
    });

    $sourcesCount = Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('source')->get()->groupBy('source_id')->mapWithKeys(function ($item, $sourceId) {
      $sourceName = optional($item->first()->source)->name; // Get the source name
      return [$sourceName => $item->count()]; // Map source name to count
    });

    $sourceCampaignsCount = Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->get()->groupBy('source_campaign')->mapWithKeys(function ($item) {
      $sourceCampaignName = $item->first()->source_campaign ?? 'Unknown';
      return [$sourceCampaignName => $item->count()]; // Map source campaign name to count
    });

    $totalLeadCount = Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->count();

    $totalOpportunityCount = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->count();

    $finalStage = Stage::where('is_final', 1)->first();

    $totalAdmissionCount = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->where('stage_id', $finalStage->id)->count();

    $totalTaskCount = LeadTask::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->count();

    $pendingTaskCount = LeadTask::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->whereNull('completed_on')->count();

    $completedTaskCount = LeadTask::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->whereNotNull('completed_on')->count();

    $admissionDoneCount = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('subStage')->where('stage_id', $finalStage->id)->get()->groupBy('sub_stage_id')->mapWithKeys(function ($item) {
      return [$item->first()->subStage->name => $item->count()];
    });

    $leadUserCount = Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('user')->get()->groupBy('user_id')->mapWithKeys(function ($item) {
      return [$item->first()->user->name => $item->count()];
    });

    $taskUserCount = LeadTask::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })->with('user')->get()->groupBy('user_id')->mapWithKeys(function ($item) {
      return [$item->first()->user->name => $item->count()];
    });

    $totalRevenue = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
      return $query->whereIn('user_id', $downline);
    })
      ->with('opportunityLedger') // Eager load the ledger
      ->get()
      ->sum(function ($opportunity) {
        return $opportunity->opportunityLedger->sum('amount');
      });
    $totalRevenue = Helpers::formatIndianCurrency($totalRevenue);
    return view('panel.dashboards.index', compact('stagesCount', 'opportunitiesCount', 'sourcesCount', 'sourceCampaignsCount', 'totalLeadCount', 'totalOpportunityCount', 'totalAdmissionCount', 'admissionDoneCount', 'leadUserCount', 'taskUserCount', 'totalTaskCount', 'pendingTaskCount', 'completedTaskCount', 'totalRevenue', 'finalStage'));
  }
}
