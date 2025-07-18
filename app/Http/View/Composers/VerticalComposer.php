<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Academics\Vertical;

class VerticalComposer
{
  public function compose(View $view)
  {
    $verticals = Vertical::where('for_website', 1)->where('is_active', 1)->orderBy('id', 'asc')->get(['name', 'vertical_name', 'slug', 'logo']);
    $view->with('verticalList', $verticals);
  }
}
