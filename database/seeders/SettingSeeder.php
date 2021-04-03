<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    /**
     * @var array
     */
    protected $settings = [
        [
            'key'                       =>  'site_name',
            'value'                     =>  'قهوتنا',
        ],
        [
            'key'                       =>  'site_title',
            'value'                     =>  'قهوتنا',
        ],
        [
            'key'                       =>  'default_email_address',
            'value'                     =>  'admin@admin.com',
        ],
        [
            'key'                       =>  'default_country',
            'value'                     =>  'المملكة العربية السعودية',
        ],
        [
            'key'                       =>  'default_city',
            'value'                     =>  'بريدة',
        ],
        [
            'key'                       =>  'default_address',
            'value'                     =>  'شارع الخبيب',
        ],
        [
            'key'                       =>  'default_phone',
            'value'                     =>  '123456789',
        ],
        [
            'key'                       =>  'currency_code',
            'value'                     =>  'SAR',
        ],
        [
            'key'                       =>  'site_logo',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_facebook',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_twitter',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_instagram',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_youtube',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'moyasar_payment_method',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'moyasar_key',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'moyasar_secret_key',
            'value'                     =>  '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting)
        {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info($index."فشل في عملية الاضافة ");
                return;
            }
        }
        $this->command->info('من السجلات '.count($this->settings). ' تم إضافة');
    }
}
