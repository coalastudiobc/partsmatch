<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPages = [
            [
                'name' => 'About Us',
                'slug' => 'about-us',
                'page_content' => 'This is the about us page',
            ],
            [
                'name' => 'FAQ',
                'slug' => 'faq',
                'page_content' => 'This is the faq page',
            ],
            [
                'name' => 'How it Works',
                'slug' => 'how it works',
                'page_content' => 'This is the how it works page',
            ],
            [
                'name' => 'Terms & Conditions',
                'slug' => 'terms & conditions',
                'page_content' => 'This is the terms & conditions page',
            ],
            [
                'name' => 'Privacy Policy',
                'slug' => 'privacy policy',
                'page_content' => 'This is the privacy policy page',
            ],
            [
                'name' => 'Contact us',
                'slug' => 'contact-us',
                'page_content' => 'This is the contact-us page',
            ],

        ];

        CmsPage::insert($cmsPages);
    }
}
