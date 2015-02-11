<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        // !!! All existing users are deleted !!!
        DB::table('users')->delete();

        User::create(array(
            'id'        => 0,
            'username'  => 'admin',
            'password'  => Hash::make('password'),
            'email'     => 'admin@admin.com'
        ));
    }
}