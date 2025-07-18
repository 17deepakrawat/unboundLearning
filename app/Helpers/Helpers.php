<?php

namespace App\Helpers;

use App\Models\Academics\Vertical;
use App\Models\Leads\Opportunity;
use App\Models\User\UserReporting;
use Config;
use Illuminate\Support\Str;

class Helpers
{
  public static function appClasses()
  {

    $data = config('custom.custom');


    // default data array
    $DefaultData = [
      'myLayout' => 'vertical',
      'myTheme' => 'theme-default',
      'myStyle' => 'light',
      'myRTLSupport' => true,
      'myRTLMode' => true,
      'hasCustomizer' => true,
      'showDropdownOnHover' => true,
      'displayCustomizer' => true,
      'contentLayout' => 'compact',
      'headerType' => 'fixed',
      'navbarType' => 'fixed',
      'menuFixed' => true,
      'menuCollapsed' => false,
      'footerFixed' => false,
      'customizerControls' => [
        'rtl',
      'style',
      'headerType',
      'contentLayout',
      'layoutCollapsed',
      'showDropdownOnHover',
      'layoutNavbarOptions',
      'themes',
      ],
      //   'defaultLanguage'=>'en',
    ];

    // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
    $data = array_merge($DefaultData, $data);

    // All options available in the template
    $allOptions = [
      'myLayout' => ['vertical', 'horizontal', 'blank', 'front'],
      'menuCollapsed' => [true, false],
      'hasCustomizer' => [true, false],
      'showDropdownOnHover' => [true, false],
      'displayCustomizer' => [true, false],
      'contentLayout' => ['compact', 'wide'],
      'headerType' => ['fixed', 'static'],
      'navbarType' => ['fixed', 'static', 'hidden'],
      'myStyle' => ['light', 'dark', 'system'],
      'myTheme' => ['theme-default', 'theme-bordered', 'theme-semi-dark'],
      'myRTLSupport' => [true, false],
      'myRTLMode' => [true, false],
      'menuFixed' => [true, false],
      'footerFixed' => [true, false],
      'customizerControls' => [],
      // 'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','ar'=>'ar'),
    ];

    //if myLayout value empty or not match with default options in custom.php config file then set a default value
    foreach ($allOptions as $key => $value) {
      if (array_key_exists($key, $DefaultData)) {
        if (gettype($DefaultData[$key]) === gettype($data[$key])) {
          // data key should be string
          if (is_string($data[$key])) {
            // data key should not be empty
            if (isset($data[$key]) && $data[$key] !== null) {
              // data key should not be exist inside allOptions array's sub array
              if (!array_key_exists($data[$key], $value)) {
                // ensure that passed value should be match with any of allOptions array value
                $result = array_search($data[$key], $value, 'strict');
                if (empty($result) && $result !== 0) {
                  $data[$key] = $DefaultData[$key];
                }
              }
            } else {
              // if data key not set or
              $data[$key] = $DefaultData[$key];
            }
          }
        } else {
          $data[$key] = $DefaultData[$key];
        }
      }
    }
    $styleVal = $data['myStyle'] == "dark" ? "dark" : "light";
    if(isset($_COOKIE['mode'])){
      if($_COOKIE['mode'] === "system"){
        if(isset($_COOKIE['colorPref'])) {
          $styleVal = Str::lower($_COOKIE['colorPref']);
        }
      }
      else {
        $styleVal = $_COOKIE['mode'];
      }
    }
    isset($_COOKIE['theme']) ? $themeVal = $_COOKIE['theme'] : $themeVal = $data['myTheme'];
    //layout classes
    $layoutClasses = [
      'layout' => $data['myLayout'],
      'theme' => $themeVal,
      'themeOpt' => $data['myTheme'],
      'style' => $styleVal,
      'styleOpt' => $data['myStyle'],
      'rtlSupport' => $data['myRTLSupport'],
      'rtlMode' => $data['myRTLMode'],
      'textDirection' => $data['myRTLMode'],
      'menuCollapsed' => $data['menuCollapsed'],
      'hasCustomizer' => $data['hasCustomizer'],
      'showDropdownOnHover' => $data['showDropdownOnHover'],
      'displayCustomizer' => $data['displayCustomizer'],
      'contentLayout' => $data['contentLayout'],
      'headerType' => $data['headerType'],
      'navbarType' => $data['navbarType'],
      'menuFixed' => $data['menuFixed'],
      'footerFixed' => $data['footerFixed'],
      'customizerControls' => $data['customizerControls'],
    ];

    // sidebar Collapsed
    if ($layoutClasses['menuCollapsed'] == true) {
      $layoutClasses['menuCollapsed'] = 'layout-menu-collapsed';
    }

    // Header Type
    if ($layoutClasses['headerType'] == 'fixed') {
      $layoutClasses['headerType'] = 'layout-menu-fixed';
    }
    // Navbar Type
    if ($layoutClasses['navbarType'] == 'fixed') {
      $layoutClasses['navbarType'] = 'layout-navbar-fixed';
    } elseif ($layoutClasses['navbarType'] == 'static') {
      $layoutClasses['navbarType'] = '';
    } else {
      $layoutClasses['navbarType'] = 'layout-navbar-hidden';
    }

    // Menu Fixed
    if ($layoutClasses['menuFixed'] == true) {
      $layoutClasses['menuFixed'] = 'layout-menu-fixed';
    }


    // Footer Fixed
    if ($layoutClasses['footerFixed'] == true) {
      $layoutClasses['footerFixed'] = 'layout-footer-fixed';
    }

    // RTL Supported template
    if ($layoutClasses['rtlSupport'] == true) {
      $layoutClasses['rtlSupport'] = '/rtl';
    }

    // RTL Layout/Mode
    if ($layoutClasses['rtlMode'] == true) {
      $layoutClasses['rtlMode'] = 'rtl';
      $layoutClasses['textDirection'] = 'rtl';
    } else {
      $layoutClasses['rtlMode'] = 'ltr';
      $layoutClasses['textDirection'] = 'ltr';
    }

    // Show DropdownOnHover for Horizontal Menu
    if ($layoutClasses['showDropdownOnHover'] == true) {
      $layoutClasses['showDropdownOnHover'] = true;
    } else {
      $layoutClasses['showDropdownOnHover'] = false;
    }

    // To hide/show display customizer UI, not js
    if ($layoutClasses['displayCustomizer'] == true) {
      $layoutClasses['displayCustomizer'] = false;
    } else {
      $layoutClasses['displayCustomizer'] = false;
    }

    return $layoutClasses;
  }

  public static function updatePageConfig($pageConfigs)
  {
    $demo = 'custom';
    if (isset($pageConfigs)) {
      if (count($pageConfigs) > 0) {
        foreach ($pageConfigs as $config => $val) {
          Config::set('custom.' . $demo . '.' . $config, $val);
        }
      }
    }
  }

  public static function createCustomFieldSchema($name)
  {
    $slug = Str::slug($name);
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    $slug = str_replace('-', '_', $slug);
    return $slug;
  }

  public static function getDownline($userId)
  {
    // Initialize downline array
    $downline = UserReporting::where('parent_id', $userId)->pluck('user_id')->toArray();

    if (empty($downline)) {
      return [$userId];
    }
    // If downline is not empty, recursively fetch the downline for each user
    foreach ($downline as $id) {
      $downline = array_merge($downline, self::getDownline($id));
    }

    $downline[] = $userId;
    $downline = array_unique($downline);

    return $downline;
  }

  public static function maskString($string, $start = 1, $end = 1)
  {
    $mask = '*';
    $length = strlen($string);

    if ($length <= ($start + $end)) {
      return str_repeat($mask, $length); // If too short, mask the entire string
    }

    $masked = substr($string, 0, $start) .
      str_repeat($mask, $length - $start - $end) .
      substr($string, -$end);

    return $masked;
  }

  public static function generateStudentId($verticalId)
  {
    try {
      $vertical = Vertical::find($verticalId);
      $metaData = !empty($vertical->metadata) ? json_decode($vertical->metadata, true) : [];
      if (array_key_exists('student_id', $metaData)) {
        $studentIdConfig = $metaData['student_id'];
        $prefix = $studentIdConfig['prefix'];
        $suffix = (int)$studentIdConfig['suffix'];

        if ($suffix == 0) {
          return 0;
        }

        $randomNumber = mt_rand(1, pow(10, min($suffix, 9)) - 1);
        $studentId = $prefix . $randomNumber;
        $check = Opportunity::where('student_id', $studentId)->first();
        if ($check) {
          return self::generateStudentId($verticalId);
        }
        return $studentId;
      }
    } catch (\Exception $e) {
      return 0;
    }
  }

  public static function formatIndianCurrency($amount)
  {
    $decimal = '';
    // Check if there's a decimal part and handle it
    if (strpos((string) $amount, '.') !== false) {
      [$amount, $decimal] = explode('.', (string) $amount, 2);
      $decimal = '.' . str_pad($decimal, 2, '0'); // Ensure 2 decimal places
    } else {
      $decimal = '.00'; // Add .00 if no decimal part exists
    }

    // Format the integer part for Indian numbering system
    $amount = (string) $amount; // Ensure the amount is a string
    $length = strlen($amount);

    if ($length > 3) {
      $last3 = substr($amount, -3); // Get the last 3 digits
      $remaining = substr($amount, 0, $length - 3); // Get the rest of the number
      $remaining = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $remaining); // Add commas every 2 digits
      $formatted = $remaining . ',' . $last3;
    } else {
      $formatted = $amount;
    }

    // Combine the formatted amount with the decimal part
    return '₹ ' . $formatted . $decimal;
  }

}
