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
            'option' => 'objective',
            'description' => 'What is the objective of this material?',
        ]);
        DB::table('options')->insert([
            'option' => 'level',
            'description' => 'What level is this material for?',
        ]);
        DB::table('options')->insert([
            'option' => 'time_needed_prep',
            'description' => 'How much time is needed for preparation? (mins)',
        ]);
        DB::table('options')->insert([
            'option' => 'time_needed_class',
            'description' => 'How much time is needed in class? (mins)',
        ]);
        DB::table('options')->insert([
            'option' => 'language_focus',
            'description' => 'What is the language focus of the material?',
        ]);
        DB::table('options')->insert([
            'option' => 'activity_use',
            'description' => 'What type of activity will the material be used for?',
        ]);
        DB::table('options')->insert([
            'option' => 'pupil_task',
            'description' => 'What tasks will the pupils do?',
        ]);
        DB::table('options')->insert([
            'option' => 'materials',
            'description' => 'What materials are needed?',
        ]);
        DB::table('options')->insert([
            'option' => 'follow_up',
            'description' => 'Are there any follow up activities',
        ]);
        DB::table('options')->insert([
            'option' => 'variations',
            'description' => 'Are there different ways to use the material?',
        ]);
        DB::table('options')->insert([
            'option' => 'tips',
            'description' => 'Tips:',
        ]);
        DB::table('options')->insert([
            'option' => 'notes',
            'description' => 'notes',
        ]);
        DB::table('options')->insert([
            'option' => 'category',
            'description' => 'What educational institute is the material for?',
        ]);
        DB::table('options')->insert([
            'option' => 'target_language',
            'description' => 'What is the target language?',
        ]);
        DB::table('options')->insert([
            'option' => 'procedure_in',
            'description' => 'Describe the procedure in the classroom',
        ]);
        DB::table('options')->insert([
            'option' => 'procedure_before',
            'description' => 'Describe preparation procedure',
        ]);
        DB::table('options')->insert([
            'option' => 'book',
            'description' => 'What book is the material based upon?',
        ]);
        DB::table('options')->insert([
            'option' => 'page',
            'description' => 'What page of the book?',
        ]);
    }
}
