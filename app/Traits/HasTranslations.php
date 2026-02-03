<?php

namespace App\Traits;

trait HasTranslations {
    public function translate(string $field): ?string {
        $lang = substr(request()->header('Accept-Language', 'pl'), 0, 2);
        $supported = ['pl', 'en', 'de'];

        if (!in_array($lang, $supported)) {
            $lang = 'pl';
        }

        $column = "{$field}_{$lang}";

        return $this->$column ?? $this->{"{$field}_pl"} ?? null;
    }
}
