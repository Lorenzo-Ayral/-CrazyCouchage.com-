<?php

namespace App\Service;

use Symfony\Component\Form\Form;

class RegisterImage
{
    private Form $form;
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function saveImage(): string
    {
        $file = $this->form->get('image')->getData();
        $file->move('image_directory', $file->getClientOriginalName());

        return $file->getClientOriginalName();
    }
}