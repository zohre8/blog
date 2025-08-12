<?php

namespace Database\Seeders;

use App\Models\SitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = [
            [
                'slug' => 'about',
                'title' => 'درباره ما',
                'content' => 'متن پیش‌فرض درباره ما...',
            ],
            [
                'slug' => 'contact',
                'title' => 'تماس با ما',
                'content' => 'متن پیش‌فرض تماس با ما...',
            ],
            [
                'slug' => 'rules',
                'title' => 'قوانین سایت',
                'content' => 'متن پیش‌فرض درباره ما...',
            ],
        ];

        foreach ($page as $p) {
            SitePage::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
