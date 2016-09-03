<?php

namespace Chat\Form;

use Zend\Form\Form;

class ChatForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('chat');

        $this->add([
            'name' => 'text',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Let\'s type something here!',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Send',
                'id' => 'submitForm',
                'class' => 'btn btn-success',
            ],
        ]);
    }

}