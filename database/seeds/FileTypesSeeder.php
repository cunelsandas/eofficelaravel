<?php

use Illuminate\Database\Seeder;

class FileTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\FileType::create([
            'name' => 'General',
            'no_of_files' => 2,
            'labels' => 'page1,page2',
            'file_validations' => 'mimes:jpeg,bmp,png,jpg',
            'file_maxsize' => 8
        ]);
        \App\FileType::create([
            'name' => 'File',
            'no_of_files' => 2,
            'labels' => 'file1,file2',
            'file_validations' => 'mimes:pdf',
            'file_maxsize' => 8
        ]);
    }
}
