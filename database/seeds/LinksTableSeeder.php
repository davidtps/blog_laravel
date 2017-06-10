<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'link_name' => "百度",
            'link_title' => "百度一下，你就知道",
            'link_url' => "http://baidu.com",
            'link_order' => "1",
        ], [
            'link_name' => "google",
            'link_title' => "let me tell you everything!",
            'link_url' => "http://google.com",
            'link_order' => "2",
        ], [
            'link_name' => "凤凰网",
            'link_title' => "你你你纳爱斯",
            'link_url' => "http://www.ifeng.com/",
            'link_order' => "0",
        ]];
        DB::table('links')->insert($data);
    }
}
