<?php

use Illuminate\Support\Str;

/**
 * Format The Date
 * @param $date
 * @param string $format default='d/m/y'
 * @return false|string
 */
function formatDate($date, $format = "d/m/Y")
{
    if (is_null($date)) {
        return '-';
    }
    return date($format, strtotime($date));
}

/**
 * Format the datetime
 * @param $dateTime
 * @param string $format default= 'd/m/Y h:i A'
 * @return false|string
 */
function formatDateTime($dateTime, $format = "d/m/Y h:i A")
{
    if (is_null($dateTime)) {
        return '-';
    }
    return ($dateTime) ? date($format, strtotime($dateTime)) : $dateTime;
}



function DateThai($strDate)
{
$strYear = date("Y", strtotime($strDate)) + 543;
$strMonth = date("n", strtotime($strDate));
$strDay = date("j", strtotime($strDate));
$strHour = date("H", strtotime($strDate));
$strMinute = date("i", strtotime($strDate));
$strSeconds = date("s", strtotime($strDate));
$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
$strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
}

function DateThai2($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

/**
 * Format The Time
 * @param $time
 * @param string $format default= 'h:i A'
 * @return false|string
 */
function formatTime($time, $format = "h:i A")
{
    if (is_null($time)) {
        return '-';
    }
    return ($time) ? date($format, strtotime($time)) : $time;
}

/**
 * Format The Currency
 * @param $money
 * @param bool $withCurrency Rs symbol prefix
 * @return string
 */
function moneyFormat($money, $withCurrency = false)
{
    if (is_null($money))
        return $money;
    $currency = 'THB. ';
    $num = number_format($money, 2, '.', ',');
    if ($withCurrency)
        $num = $currency . $num;

    return $num;
}

/**
 * Check if mime-type is image
 * @param string $mimeType Mime-Type of file.
 * @return bool true if is image false otherwise.
 */
function isImage($mimeType)
{
    return Str::startsWith($mimeType, "image/");
}

/**
 * Check if file is
 * @param $filepath string a original dir file name or full path.
 * @return bool
 */
function checkIsFileIsImage($filepath)
{
    if (!file_exists($filepath)) {
        $filepath = storage_path('app/files/original/') . $filepath;
    }
    return isImage(mime_content_type($filepath));
}

/**
 * Generate a preview url(a thumb) for given file.
 * @param $file string A File name
 * @return string preview url
 */
function buildPreviewUrl($file)
//    if else preview box จ้า
{
    $extension = last(explode('.', $file));
    if ($extension == 'pdf' || $extension == 'PDF') {
        return checkIsFileIsImage($file) ?
            route('files.showfile', ['dir' => 'thumb', 'file' => $file]) :
            'http://dummyimage.com/400x200/FF5733/FFFFFF&text=PDF';
    } elseif ($extension == 'doc' || $extension == 'DOC') {
        return checkIsFileIsImage($file) ?
            route('files.showfile', ['dir' => 'thumb', 'file' => $file]) :
            'https://dummyimage.com/400x200/338AFF/FFFFFF&text=DOC';
    } elseif ($extension == 'docx' || $extension == 'DOCX') {
        return checkIsFileIsImage($file) ?
            route('files.showfile', ['dir' => 'thumb', 'file' => $file]) :
            'https://dummyimage.com/400x200/338AFF/FFFFFF&text=DOCX';
    } elseif ($extension == 'xls' || $extension == 'XLS') {
        return checkIsFileIsImage($file) ?
            route('files.showfile', ['dir' => 'thumb', 'file' => $file]) :
            'https://dummyimage.com/400x200/2E8E37/FFFFFF&text=XLS';
    } elseif ($extension == 'xlsx' || $extension == 'XLSX') {
        return checkIsFileIsImage($file) ?
            route('files.showfile', ['dir' => 'thumb', 'file' => $file]) :
            'https://dummyimage.com/400x200/2E8E37/FFFFFF&text=EXCEL';
    }
    else {
        return checkIsFileIsImage($file) ?
            route('files.showfile', ['dir' => 'thumb', 'file' => $file]) :
            'http://dummyimage.com/400x200/FF5733/FFFFFF&text='.$extension;
    }

}

/**
 * @param $permissions array|\Illuminate\Support\Collection
 * @return \Illuminate\Support\Collection|array
 */
function groupTagsPermissions($permissions)
{
    if (is_null($permissions))
        return [];

    $tagsWise = [];
    for ($i = 0; $i < $permissions->count(); $i++) {
        preg_match_all('/([\D]+) documents in tag ([\d]+)/m',
            $permissions[$i]->name, $matches, PREG_SET_ORDER, 0);
        if (!empty($matches)) {
            if (isset($tagsWise[$matches[0][2]])) {
                $tagsWise[$matches[0][2]]['permissions'][] = $matches[0][1];
            } else {
                $tagsWise[$matches[0][2]] = [
                    'tag_id' => $matches[0][2],
                    'permissions' => [$matches[0][1]]
                ];
            }
        }
    }
    return $tagsWise;
}

/**
 * @param $permissions array|\Illuminate\Support\Collection
 * @return \Illuminate\Support\Collection|array
 */
function groupDocumentsPermissions($permissions)
{
    if (is_null($permissions))
        return [];

    $docWise = [];
    for ($i = 0; $i < $permissions->count(); $i++) {
        preg_match_all('/([\D]+) document ([\d]+)/m',
            $permissions[$i]->name, $matches, PREG_SET_ORDER, 0);
        if (!empty($matches)) {
            if (isset($docWise[$matches[0][2]])) {
                $docWise[$matches[0][2]]['permissions'][] = $matches[0][1];
            } else {
                $docWise[$matches[0][2]] = [
                    'doc_id' => $matches[0][2],
                    'permissions' => [$matches[0][1]]
                ];
            }
        }
    }
    return $docWise;
}

/**
 * Check if validation rule syntax is valid.
 * @param $rules array|string the rules given.
 * @return bool true if validation rule syntax is valid, false otherwise.
 */
function isValidationRulesValid($rules)
{
    try {
        $vr = \Validator::make(['test' => 'x'], ['test' => $rules]);
        $vr->passes();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
