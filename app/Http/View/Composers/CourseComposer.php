<?php

namespace App\Http\View\Composers;

use App\Models\Academics\Specialization;
use Illuminate\View\View;

class CourseComposer
{
  public function compose(View $view)
  {
    $list = array();
    $specializations = Specialization::with('department', 'program', 'programType', 'mode')->where('for_website', 1)->get();
    foreach ($specializations as $specialization) {
      $programType = $specialization->programType;

      $department = $specialization->department;
      $departmentImages = !empty($department->images) ? json_decode($department->images, true) : array("icons" => array("icon" => "", "image" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAESElEQVR4nO2a7U9bZRiHzx/hB+Ul2XhrhwHGYIxt4JguMkpLgBaKKxQoSAtMP/hawsyMDmOiiYnGD0uWKdPMmRA1zi3bsKjjL1F0JiZLdHxijlzmZj2G1XPaB3peMPRKruT8zjl3fzdbE54PaFqBAgUKFCiwJUpfIFAyTar0NKulp8FWp7lXMs1iyRQntZ3Anine2TMFLnnW1R9+bwJ/+SSUTbJWliDpmabI7s7KOMXlk8yWTXJfusvd/CZ44ix6EuCNM+N4d4Iz0l2V4JbmFvsmuFs9Ad4JnjB6Ls+ymU93zTgl6c/5U3OLmudBrJ7i8WzPzbSqX3OL/WOQ9g03+zW3aIyB2BDjQcMoc03j7HWjX3OLQ6Ow4Qjr/167bNMI95pGWGweduC3w5FhEFsGOXQ4yoKed4xRm88JrVEQzXLLMEfT99Zah0geidl/TmiOUtwyxGzrEPelu8XOb8LxQRDNcluEb9P3HD8nHB/kjHS3RWw8J5yIgGiaT7EiuT1ifE6wk2MRStL72HdOaD8FYq7s6zM+J9hN5j6W4xsAMVfuCBufE04+h88XZkV/7z+GWekI02HVfpbTFQYxVw6EedDVz1yg79FzQqCfFf0dMwP9/GLVfpbT0wdirtwdYl2/NnLutrHZZszs7uOPnj6u9/bzVOY+lhMKgZgrB4PUhkIsBIPc1e9t9qMlY43e3Y62/QOEgyCqZrP5+UVjB0LZ540Y6KIoHOT1cC9rufrzJtIDomo2m//6hrGDvdnns+7WTTJXf95Eu0FUzWbzS9/BV5/Bmy8/VK7l3nBP9vlsxLooytWfN6NdIKpms/nP34Oxbtb1LNdyL5Zjfqv7Wc54AETVnMmYnzv6Oxv6+XTDTffGAvxq1X6Wk+gEUTVnMuEnkPDxc9zHb/FOopvmhhOd3Il38nuiA79V+1nOtA9E1ew0tve/2AGianYa2/tfagdRNTuN7f2vPguianYa2/uTJ0BUzWbz+aq6n+XMPgOiajabz1fV/Szn7NMgqmansb3/rTYQVbPT2N4/dwxE1Ww2v123up/lvNsKomo2m9+uW93Pct5vAVE1O43t/R8cBVE1O43t/R8eBlE1m82rmu9+lvNxM4iq2Wxe1Xz3s5zzTSCqZqexvf/CQVYvHITzDTyWzoibnj+Sncb2/ouNLH3SCBcbeUWyXIv688ycif7czHz3s+pzTJk/gP/SAZiv5+9L9bwm16L+PDNnoj83U8sTqz4nK5f3c+5yPWRTcwnH+r+oxX+ljtSVOla/rINMNZdwu19bqAVxt/Zr39SAuFv7tatPgrhb+7Vr+1i9Xg23PPb/cVQmVysplu5r1fylucVNL0s3vXDDS9KF7pl0d0pzi0Uv/pQHUlWspapIOvFN+L6S4pSXmY1ODyxV0qm5yQ9VnPuxClzybW0ncLsC/3IFqeVyVpcrwFYfdqR+cvt/vkCBAgUKaP8//gH9M7mO9uJkjQAAAABJRU5ErkJggg=="));
      $departmentIcon = !empty($departmentImages['icons']['icon']) ? $departmentImages['icons']['icon'] : $departmentImages['icons']['image'];

      if (strcasecmp($specialization->name, 'general') == 0) {
        continue;
      }

      $specializationDetail = array("name" => $specialization->name, "slug" => $specialization->slug, "mode" => $specialization->mode->name, "duration" => $specialization->min_duration);
      if (!array_key_exists($programType->id, $list)) { // Program Type
        $list[$programType->id] = array("name" => $programType->name, "slug" => $programType->slug, 'id' => $programType->id, 'is_skill' => $programType->is_skill);
        $list[$programType->id]["departments"][$department->id] = array("name" => $department->name, "icon" => $departmentIcon, "slug" => $department->slug);
        $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id] = ["name" => $specialization->program->name, "slug" => $specialization->program->slug];
        $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id]["specializations"][] = $specializationDetail;
      } else {
        if (!array_key_exists($department->id, $list[$programType->id]["departments"])) { //Department
          $list[$programType->id]["departments"][$department->id] = array("name" => $department->name, "icon" => $departmentIcon, "slug" => $department->slug);
          $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id] = ["name" => $specialization->program->name, "slug" => $specialization->program->slug];
          $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id]["specializations"][] = $specializationDetail;
        } else { // Programs
          if (!array_key_exists($specialization->program_id, $list[$programType->id]["departments"][$department->id]["programs"])) {
            $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id] = ["name" => $specialization->program->name, "slug" => $specialization->program->slug];
            $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id]["specializations"][] = $specializationDetail;
          } else {
            $list[$programType->id]["departments"][$department->id]["programs"][$specialization->program->id]["specializations"][] = $specializationDetail;
          }
        }
      }
    }

    usort($list, function ($a, $b) {
      return strcmp($a['name'], $b['name']);
    });

    $view->with('courseList', $list);
  }
}
