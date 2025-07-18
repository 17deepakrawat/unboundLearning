<?php

namespace App\Providers;

use App\Http\View\Composers\CourseComposer;
use App\Http\View\Composers\VerticalComposer;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuData = json_decode($verticalMenuJson);
    $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    $horizontalMenuData = json_decode($horizontalMenuJson);
    $studentVerticalMenuJson = file_get_contents(base_path('resources/menu/studentVerticalMenu.json'));
    $studentVerticalMenuData = json_decode($studentVerticalMenuJson);
    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData, $horizontalMenuData, $studentVerticalMenuData]);
    \View::composer('*', VerticalComposer::class);
    \View::composer('*', CourseComposer::class);
  }
}
