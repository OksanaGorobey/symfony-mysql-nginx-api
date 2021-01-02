<?php

namespace App\Form;

/**
 * Class LoginFormType
 * @package App\Form
 */
class LoginFormType extends \Symfony\Component\Form\AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options): void
    {
        $builder
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

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class'      => 'App\Entity\User',
                'csrf_protection' => false,
                'csrf_field_name' => '_token',
                // a unique key to help generate the secret token
                'intention'       => 'user_item',
            ]
        );
    }
}
