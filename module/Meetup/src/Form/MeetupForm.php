<?php

declare(strict_types=1);

namespace Meetup\Form;

use Doctrine\DBAL\Types\IntegerType;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Date;

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
                        'name' => IntegerType::class,
                        'options' => [
                            'min' => 2,
                            'max' => 100,
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
            'startDate' => [
                'validators' => [
                    [
                        'name' => Date::class,
                    ],
                ],
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d H:i',
                        ],
                    ]
                ]
            ],
            'endDate' => [
                'validators' => [
                    [
                        'name' => Date::class,
                    ],
                ],
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d H:i',
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
}
