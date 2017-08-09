<?php

namespace SON\Form;

use Kris\LaravelFormBuilder\Form;

class ClassInformationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('date_start', 'date', [
                'label' => 'Data Início',
                'rules' => 'required|date',
            ])
            ->add('date_end', 'date', [
                'label' => 'Data Final',
                'rules' => 'required|date',
            ])
            ->add('cycle', 'number', [
                'label' => 'Ciclo',
                'rules' => 'required|integer'
            ])
            ->add('subdivision', 'number', [
                'label' => 'Sub-divisão',
                'rules' => 'integer'
            ])
            ->add('semester', 'number', [
                'label' => 'Semestre (1 ou 2)',
                'rules' => 'required|in:1,2'
            ])
            ->add('year', 'number', [
                'label' => 'Ano',
                'rules' => 'required|integer'
            ]);
    }
}
