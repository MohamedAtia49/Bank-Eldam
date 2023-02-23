<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Atia',
            'email' => 'atia@admin.com',
            'password' => bcrypt('2480123m'), // password
        ]);
        ########################################################
        Setting::create([
            'notification_settings_id' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.',
            'about_app'=>'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.',
            'email' => 'blood_bank@gmail.com',
            'phone' => '+201020659763',
            'fb_link' => 'https://www.facebook.com/profile.php?id=100003822760783',
            'tw_link' => 'https://www.facebook.com/profile.php?id=100003822760783',
            'insta_link' => 'https://www.facebook.com/profile.php?id=100003822760783',
        ]);
        ########################################################
        Role::create([
            'name' => 'super-admin',
            // 'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'mange-site',
        ]);

        Role::find(1)->givePermissionTo('mange-site');

        User::find(1)->assignRole('super-admin');
        ########################################################
        Governorate::create([
            'name' => 'الدقهلية',
        ]);
        Governorate::create([
            'name' => 'الغربية',
        ]);
        Governorate::create([
            'name' => 'دمياط',
        ]);
        ########################################################
        City::create([
            'name' => 'المنصورة',
            'governorate_id' => 1,
        ]);
        City::create([
            'name' => 'بلقاس',
            'governorate_id' => 1,
        ]);
        City::create([
            'name' => 'طنطا',
            'governorate_id' => 2,
        ]);
        City::create([
            'name' => 'بيلا',
            'governorate_id' => 2,
        ]);
        City::create([
            'name' => 'دمياط الجديدة',
            'governorate_id' => 3,
        ]);
        ########################################################
        BloodType::create([
            'name' => 'O-',
        ]);
        BloodType::create([
            'name' => 'AB+',
        ]);
        BloodType::create([
            'name' => 'O+',
        ]);
        ########################################################
        Client::create([
            'name' => 'Mohamed Atia',
            'email' => 'atia@client.com',
            'password' => bcrypt('123'),
            'phone' => '01020659763',
            'blood_type_id' => 1,
            'city_id' => 1,
            'd_o_b' => '1999-4-4',
            'last_donation_date' => '2016-2-4',
            'api_token' => Str::random(60),
        ]);
        ########################################################
        Category::create([
            'name' => 'معلومات صحية',
        ]);
        Category::create([
            'name' => 'كل يوم معلومة جديدة',
        ]);
        ########################################################
        Post::create([
            'category_id' =>1,
            'title' => 'معلومات صحية',
            'image' => '../../public/front/imgs/p2.jpg',
            'content' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق'
        ]);
        Post::create([
            'category_id' =>2,
            'title' => 'كل يوم معلومة جديدة',
            'image' => '../../public/front/imgs/p1.jpg',
            'content' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق'
        ]);
    }
}
