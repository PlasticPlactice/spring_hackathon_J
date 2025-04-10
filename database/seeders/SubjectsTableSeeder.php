<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'Scratch基礎',
            'detail' => 'Scratchの基本操作を習得する',
            'tech' => 'Scratch'
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'name' => '応用情報対策(午前試験)',
            'detail' => '	応用情報技術者試験午前試験の問題演習を通して試験問題が解けるようになること',
            'tech' => '-'
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'name' => 'テスト基礎',
            'detail' => 'ソフトウェアをテストする意味と方法を学ぶ。職業としてのソフトウェアエンジニアが、品質の高いシステムを構築する方法を身につける。',
            'tech' => '各種フレームワークを活用したWebアプリケーションの開発、クラウドを活用したサーバーレスアプリケーションの開発、TypeScriptを利用したSPAアプリケーションの開発、企業や団体のDX推進、オープンソースソフトウェアへのコントリビュート。'
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'name' => 'Unity基礎',
            'detail' => 'ゲームエンジン「Unity」を用いて、PC/Androidゲームを開発する技術を学習します。',
            'tech' => 'Unity'
        ];
        DB::table('subjects')->insert($param);

        $param = [
            'name' => 'Java応用(JavaFX)',
            'detail' => 'データベースと連携したアプリケーション開発ができるようになる',
            'tech' => 'Java'
        ];
        DB::table('subjects')->insert($param);
        
        $param = [
            'name' => 'php基礎',
            'detail' => 'PHPの基礎を理解し、簡易的なアプリケーションが作成できる。',
            'tech' => 'PHP'
        ];
        DB::table('subjects')->insert($param);
    }
}
