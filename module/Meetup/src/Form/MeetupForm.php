<?php

declare(strict_types=1);

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('meetup');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'organisateur',
            'options' => [
                'label' => 'Organisateur(s)'
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'entreprise',
            'options' => [
                'label' => 'Entreprise'
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'participant',
            'options' => [
                'label' => 'Nombre de Participants'
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'date',
            'options' => [
                'label' => 'Date'
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 40,
                        ],
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 40,
                        ],
                    ],
                ],
            ],
            'organisateur' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 40,
                        ],
                    ],
                ],
            ],
            'entreprise' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 40,
                        ],
                    ],
                ],
            ],
        ];
    }
}
