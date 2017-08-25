<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use SON\Models\{ClassTeaching, ClassTest, Question, QuestionChoice, Teacher};

class ClassTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classTeachings = ClassTeaching::all();
        $teacherDefault = Teacher::find(1);
        $self = $this;
        /**
         * Criando avaliação para o professor de tste
         */
        factory(ClassTest::class, 30)
            ->make()
            ->each(function(ClassTest $model) use ($classTeachings, $teacherDefault, $self){
                $classTeaching = $classTeachings
                    ->where('teacher_id', $teacherDefault->id)
                    ->random();
                $model->classTeaching()->associate($classTeaching);
                $model->save();
                $self->createQustions($model);
            });

        factory(ClassTest::class, 100)
            ->make()
            ->each(function(ClassTest $model) use ($classTeachings, $self){
                if(!$model->class_teaching_id) {
                    $classTeaching = $classTeachings->random();
                    $model->classTeaching()->associate($classTeaching);
                    $model->save();
                    $self->createQustions($model);
                }
            });
    }

    protected function createQustions(ClassTest $classTest)
    {
        $questions = factory(Question::class, 4)->create([
           'class_test_id' => $classTest->id
        ]);

        $this->createChoices($questions);
    }

    protected function createChoices(Collection $question)
    {
        $question->each(function(Question $question){
            $choices = factory(QuestionChoice::class, 4)->create([
                'question_id' => $question->id
            ]);
            $choiceFirst = $choices->first();
            $choiceFirst->true = true;
            $choiceFirst->save();
        });
    }
}
