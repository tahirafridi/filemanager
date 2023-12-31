<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

function setToastrSettings($type='error', $message=null, $options=[])
{
    return [
        'type'              => $type,
        'heading'           => ucwords($type) . "!",
        'message'           => $message,
        'timeOut'           => $options['timeOut'] ?? 5000,
        'closeButton'       => $options['closeButton'] ?? true,
        'preventDuplicates' => true,
    ];
}

function getFirstWord($str="")
{
    if (!empty($str)) {
      $str = explode(" ", $str);

      return $str[0];
    }

    return '';
}

//  Set Datatable <th> html attributes like (class, width, style)
function setAttributes($keys)
{
    $allowed_attr = ['class', 'style', 'width'];

    $attributes = "";

    foreach ($keys as $key => $value) {
        if (in_array($key, $allowed_attr) && !empty($value)) {
            $attributes .= $key . "=" . $value . " ";
        }
    }

    return $attributes;
}

function printStatus($status)
{
    $badge = "success";

    if ($status == 'Draft') {
        $badge = "secondary";
    } else if ($status == 'Inactive') {
        $badge = "danger";
    } else {
        $badge = $badge;
    }

    return "<span class='badge badge-{$badge}'>{$status}</span>";
}

function niceFileSize($size, $precision = 2)
{
    // return number_format($size / (1000*1000), 2) . ' MB';
    if ($size > 0) {
        $size = (int) $size;
        $base = log($size) / log(1024);
        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    } else {
        return $size;
    }
}

function getLogo()
{
    $setting = Setting::where('name', 'logo')->first();

    if (!empty($setting->value) && Storage::exists("photos/" . $setting->value)) {
        return Storage::url("photos/" . $setting->value);
    }

    return asset('images/logo-wide.svg');
}
