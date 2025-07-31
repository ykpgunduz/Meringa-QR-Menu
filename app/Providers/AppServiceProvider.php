<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Validator::extend('unique_category_key', function ($attribute, $value, $parameters, $validator) {
            $jsonPath = public_path('js/products.json');

            if (!File::exists($jsonPath)) {
                return true; // File doesn't exist, so it's unique
            }

            $jsonContent = File::get($jsonPath);
            $data = json_decode($jsonContent, true);

            if (!isset($data['categories'])) {
                return true; // No categories, so it's unique
            }

            foreach ($data['categories'] as $category) {
                if ($category['key'] === $value) {
                    return false; // Key already exists
                }
            }

            return true; // Key is unique
        });

        Validator::replacer('unique_category_key', function ($message, $attribute, $rule, $parameters) {
            return 'Bu anahtar zaten kullanılıyor. Farklı bir anahtar seçin.';
        });
    }
}
