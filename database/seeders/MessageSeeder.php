<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            [
                'subject' => "Hi Again",
                'content' => 'Just wanted to check on you',
                'isRead' => 1,
                'sender_id' => 2,
                'reciver_id' => 1,
            ],
            [
                'subject' => "Hi Friend",
                'content' => 'Just wanted to let you know I’ m good',
                'isRead' => 0,
                'sender_id' => 2,
                'reciver_id' => 1,
            ],
            [
                'subject' => "message1",
                'content' => 'this is message1',
                'isRead' => 0,
                'sender_id' => 2,
                'reciver_id' => 1,
            ],
            [
                'subject' => "title 1",
                'content' => 'aaaaaa aAAAAAAAAAaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'isRead' => 1,
                'sender_id' => 2,
                'reciver_id' => 1,
            ],
            [
                'subject' => "message 2",
                'content' => 'Just wanted to check on you',
                'isRead' => 0,
                'sender_id' => 2,
                'reciver_id ' => 1,
            ],

        ]);
    }
}
