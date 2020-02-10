<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = storage_path() . "/json/users.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\User::create([
                'id' => $obj->id,
                'role_id' => $obj->role_id,
                'username' => $obj->username,
                'email' => $obj->email,
                'password' => bcrypt($obj->password),
                'first_name' => $obj->first_name,
                'middle_name' => $obj->middle_name,
                'last_name' => $obj->last_name,
                'gender' => $obj->gender,
                'contact_no' => $obj->contact_no
            ]);
        }
    }
}
