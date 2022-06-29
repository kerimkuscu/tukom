<?php

if (!function_exists('setting')) {
    function setting($key): ?string
    {
        $model = \App\Models\Setting::query()
            ->where('name', $key)
            ->first();

        return $model->value;
    }
}
