<?php

use Illuminate\Database\Seeder;
use Faker\Generator;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //獲取Faker實例
        $faker=app(Faker\Generator::class);
        //頭像假數據
        $avatars=[
           'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
           'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
           'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
           'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
           'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
           'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
          ];
        //生成數據集合
        $users=factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function($user,$index)use($faker,$avatars)
        {
             //隨機給用戶的頭像賦值
             $user->avatar=$faker->randomElement($avatars);
        });
        //讓隱藏字段可見，并轉換成數組
        $user_array=$users->makeVisible(['password','remember_token'])->toArray();
      //處理用戶數據
        User::insert($user_array);
        $user=User::find(1);
        $user->name="Summer";
        $user->email="summer@yousails.com";
        $user->avatar='https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->save();
    }
}
