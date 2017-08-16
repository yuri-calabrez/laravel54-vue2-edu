<?php

use Illuminate\Database\Seeder;

class ClassInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = \SON\Models\Student::all();
        $teachers = \SON\Models\Teacher::all();
        $subjects = \SON\Models\Subject::all();
        factory(\SON\Models\ClassInformation::class, 50)
            ->create()
            ->each(function(\SON\Models\ClassInformation $model) use ($students, $teachers, $subjects){
                $studentCol = $students->random(10);
                $model->students()->attach($studentCol->pluck('id'));

                $teaching = rand(3, 6);
                $teacherCol = $teachers->random($teaching);
                $subjectCol = $subjects->random($teaching);

                foreach (range(1, $teaching) as $value) {
                    $model->teachings()->create([
                       'subject_id' => $subjectCol->get($value-1)->id,
                       'teacher_id' => $teacherCol->get($value-1)->id
                    ]);
                }
            });
    }
}
