<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends \Symfony\Component\Form\AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( \Symfony\Component\Form\FormBuilderInterface $builder, array $options ): void
    {
        $builder
            // validation firstname
            ->add(
                'firstname',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                [
                    'constraints' =>
                        [
                            new \Symfony\Component\Validator\Constraints\NotBlank(
                                [
                                    'message' => 'firstname not blank',
                                ]
                            ),
                            new \Symfony\Component\Validator\Constraints\Regex(
                                \App\lib\consts::PATTERN_NAME,
                                'firstname regexp'
                            ),
                            new \Symfony\Component\Validator\Constraints\Length(
                                [
                                    'min' => \App\lib\consts::NAME_MINLENGTH,
                                    'max' => \App\lib\consts::NAME_MAXLENGTH,
                                    'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                                    'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                                ]
                            ),
                        ]
                ]
            )

            // validation lastname
            ->add(
                'lastname',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                [
                    'constraints' =>
                        [
                            new \Symfony\Component\Validator\Constraints\NotBlank(
                                [
                                    'message' => 'lastname not blank',
                                ]
                            ),
                            new \Symfony\Component\Validator\Constraints\Regex(
                                \App\lib\consts::PATTERN_NAME,
                                'lastname regexp'
                            ),
                            new \Symfony\Component\Validator\Constraints\Length(
                                [
                                    'min' => \App\lib\consts::NAME_MINLENGTH,
                                    'max' => \App\lib\consts::NAME_MAXLENGTH,
                                    'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                                    'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                                ]
                            ),
                        ]
                ]
            )

            ->add(
                'nickname',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                [
                    'constraints' =>
                        [
                            new \Symfony\Component\Validator\Constraints\NotBlank(
                                [
                                    'message' => 'nickname not blank',
                                ]
                            ),
                            new \Symfony\Component\Validator\Constraints\Regex(
                                \App\lib\consts::PATTERN_NICKNAME,
                                'nickname regexp'
                            ),
                            new \Symfony\Component\Validator\Constraints\Length(
                                [
                                    'min' => \App\lib\consts::NAME_MINLENGTH,
                                    'max' => \App\lib\consts::NAME_MAXLENGTH,
                                    'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                                    'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                                ]
                            ),
                        ]
                ]
            )

            ->add(
                'email',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                [
                    'constraints' =>
                        [
                            new \Symfony\Component\Validator\Constraints\NotBlank(
                                [
                                    'message' => 'email not blank',
                                ]
                            ),
                            new \Symfony\Component\Validator\Constraints\Email(
                                [
                                    'message' => 'The email "{{ value }}" is not a valid email.',
                                ]
                            ),
                        ]
                ]
            )

            ->add(
                'age',
                \Symfony\Component\Form\Extension\Core\Type\IntegerType::class,
                [
                    'constraints' =>
                        [
                            new \Symfony\Component\Validator\Constraints\NotBlank(
                                [
                                    'message' => 'age not blank',
                                ]
                            ),
                            new \Symfony\Component\Validator\Constraints\Range(
                                [
                                    'min' => \App\lib\consts::AGE_MIN,
                                    'max' => \App\lib\consts::AGE_MAX,
                                    'notInRangeMessage' => 'You must be between {{ min }}cm and {{ max }}cm tall to enter',
                                ]
                            ),
                        ]
                ]
            )

            ->add(
                'password',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                [
                    'constraints' =>
                        [
                            new \Symfony\Component\Validator\Constraints\NotBlank(
                                [
                                    'message' => 'password not blank',
                                ]
                            ),
                            new \Symfony\Component\Validator\Constraints\Length(
                                [
                                    'min' => \App\lib\consts::PASSWORD_MINLENGTH,
                                    'max' => \App\lib\consts::PASSWORD_MAXLENGTH,
                                    'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                                    'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                                ]
                            ),
                        ]
                ]
            )
        ;
    }

    public function configureOptions( \Symfony\Component\OptionsResolver\OptionsResolver $resolver )
    {
        $resolver->setDefaults(
            [
                'data_class' => \App\Entity\User::class,
            ]
        );
    }
}
