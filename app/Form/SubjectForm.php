<?php

namespace SON\Form;

use Kris\LaravelFormBuilder\Form;

class SubjectForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
           'label' => 'Nome',
           'rules' => 'required|max:255'
        ]);
    }
}
