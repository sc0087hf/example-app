<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PositiveMessage;

class PositiceMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            ['message' => 'good!'],
            ['message' => 'nice!'],
            ['message' => 'ok!'],
            ['message' => 'great!'],
            ['message' => 'god!'],
            ['message' => 'いい感じ!'],
            ['message' => 'いいよ!'],
            ['message' => '素晴らしい!'],
            ['message' => '天才です!'],
        ];

        foreach($messages as $message) {
            PositiveMessage::create($message);
        }
    }
}
