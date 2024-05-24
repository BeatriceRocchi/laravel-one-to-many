<?php

namespace App\Functions;

use Illuminate\Support\Str;

class Helper
{
    public static function generateSlug($string, $model)
    {
        $slug = Str::slug($string, '-');
        $original_slug = $slug;

        $exists = $model::where('slug', $slug)->first();
        $counter = 1;

        while ($exists) {
            $slug = $original_slug . '-' . $counter;
            $exists = $model::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}
