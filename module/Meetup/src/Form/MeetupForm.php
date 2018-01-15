<?php

declare(strict_types=1);

namespace Meetup\Form;


use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Zend\Validator;


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
            'type' => Element\Textarea::class,
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
                'value' => 'Envoyer',
            ],
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'participant',
            'options' => [
                'label' => 'Nombre de Participants'
            ],
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'startDate',
            'options' => [
                'label' => 'Date de début'
            ],
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'endDate',
            'options' => [
                'label' => 'Date de fin'
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
            'participant' => [
                'validators' => [
                    [
                        'name' => Digits::class,
                        'step' => "1",
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
            'startDate' => [
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d',
                        ],
                    ]
                ]
            ],
            'endDate' => [
                'validators' => [
                    [
                        'name' => Validator\Callback::class,
                        'options' => [
                            'callback' => [$this, 'diff'],
                            'messages' => [
                                Validator\Callback::INVALID_VALUE => 'La date de fin ne doit pas être inférieure à la date de début.',
                            ],
                        ],
                    ],
                ],
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d',
                        ],
                    ]
                ]

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
    
    public function diff($value, $context) :bool
    {
        return $value <= $context['endDate'];
    }
}
