<?php

use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('setting')) {
    function setting($key): ?string
    {
        $model = \App\Models\Setting::query()
            ->where('name', $key)
            ->first();

        return $model?->value;
    }
}

if (!function_exists('hashids_encode')) {

    function hashids_encode($value)
    {
        return Hashids::connection('main')->encode($value);
    }
}

if (!function_exists('hashids_decode')) {

    function hashids_decode($hash, $default = null)
    {
        $value = Hashids::connection('main')->decode($hash);

        return $value[0] ?? $default;
    }
}
