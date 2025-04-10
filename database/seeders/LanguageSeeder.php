<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\LanguageLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::insert([
            ['name' => 'English', 'code' => 'en', 'native_name' => 'English'],
            ['name' => 'Mandarin', 'code' => 'zh', 'native_name' => '普通话'],
            ['name' => 'Spanish', 'code' => 'es', 'native_name' => 'Español'],
            ['name' => 'French', 'code' => 'fr', 'native_name' => 'Français'],
            ['name' => 'Arabic', 'code' => 'ar', 'native_name' => 'العربية'],
            ['name' => 'Hindi', 'code' => 'hi', 'native_name' => 'हिन्दी'],
            ['name' => 'Bengali', 'code' => 'bn', 'native_name' => 'বাংলা'],
            ['name' => 'Portuguese', 'code' => 'pt', 'native_name' => 'Português'],
            ['name' => 'Russian', 'code' => 'ru', 'native_name' => 'Русский'],
            ['name' => 'Japanese', 'code' => 'ja', 'native_name' => '日本語'],
        ]);

        LanguageLevel::insert([
            ['name' => 'Beginner'],
            ['name' => 'Intermediate'],
            ['name' => 'Advanced'],
            ['name' => 'Fluent'],
            ['name' => 'Native'],
        ]);
    }
}
