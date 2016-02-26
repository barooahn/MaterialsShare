<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'option' => 'title',
            'description' => 'Give your material a title',
        ]);
        DB::table('options')->insert([
            'option' => 'files',
            'description' => 'Add files to your material',
        ]);
        DB::table('options')->insert([
            'option' => 'category',
            'description' => 'Educational institute',
        ]);
        DB::table('options')->insert([
            'option' => 'objective',
            'description' => 'Objective of this material',
        ]);
        DB::table('options')->insert([
            'option' => 'level',
            'description' => 'What level is this material for?',
        ]);
        DB::table('options')->insert([
            'option' => 'language_focus',
            'description' => 'Language focus of the material',
        ]);
        DB::table('options')->insert([
            'option' => 'activity_use',
            'description' => 'Activity the material be used for',
        ]);
        DB::table('options')->insert([
            'option' => 'pupil_task',
            'description' => 'What tasks will the pupils do?',
        ]);
        DB::table('options')->insert([
            'option' => 'target_language',
            'description' => 'What is the target language?',
        ]);
        DB::table('options')->insert([
            'option' => 'materials',
            'description' => 'Additional materials needed',
        ]);
        DB::table('options')->insert([
            'option' => 'time_needed_prep',
            'description' => 'Time is needed for preparation (minutes)',
        ]);
        DB::table('options')->insert([
            'option' => 'time_needed_class',
            'description' => 'Time is needed in class (minutes)',
        ]);
        DB::table('options')->insert([
            'option' => 'procedure_before',
            'description' => 'Describe preparation procedure',
        ]);
        DB::table('options')->insert([
            'option' => 'procedure_in',
            'description' => 'Describe the classroom procedure ',
        ]);
        DB::table('options')->insert([
            'option' => 'book',
            'description' => 'Textbook the material is based upon?',
        ]);
        DB::table('options')->insert([
            'option' => 'page',
            'description' => 'What page of the book?',
        ]);
        DB::table('options')->insert([
            'option' => 'follow_up',
            'description' => 'Are there follow up activities?',
        ]);
        DB::table('options')->insert([
            'option' => 'variations',
            'description' => 'Different ways to use the material',
        ]);
        DB::table('options')->insert([
            'option' => 'tips',
            'description' => 'Tips for using the material',
        ]);
        DB::table('options')->insert([
            'option' => 'notes',
            'description' => 'Notes about the material',
        ]);
    }
}
