<?php

function remove_invalid_charcaters($str)
{
    return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
}

function translate($key)
{
    $local = app()->getLocale();

    try {
        $lang_array = include(base_path('resources/lang/' . $local . '/lang.php'));
        $processed_key = ucfirst(str_replace('_', ' ', remove_invalid_charcaters($key)));

        if (!array_key_exists($key, $lang_array)) {
            $lang_array[$key] = $processed_key;
            $str = "<?php return " . var_export($lang_array, true) . ";";
            file_put_contents(base_path('resources/lang/' . $local . '/lang.php'), $str);
            $result = $processed_key;
        } else {
            $result = __('lang.' . $key);
        }
    } catch (\Exception $exception) {
        $result = __('lang.' . $key);
    }

    return $result;
}
