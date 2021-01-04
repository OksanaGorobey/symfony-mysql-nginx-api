<?php declare(strict_types=1);
namespace App\Form;

/**
 * Class UsersListFiltersFormFormType
 * @package App\Form
 */
class UsersListFiltersFormFormType extends \Symfony\Component\Form\AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( \Symfony\Component\Form\FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add(
                'params',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                [
                    'constraints' =>
                    [
                        new \Symfony\Component\Validator\Constraints\NotBlank(
                            [
                                'message' => 'Params not blank',
                            ]
                        ),
                        new \Symfony\Component\Validator\Constraints\Choice(
                            [
                                'choices' =>
                                [
                                    'email',
                                    'nickname'
                                ],
                                'message' => 'Choose a valid genre.',
                            ]
                        )
                    ]
                ]
            )
        ;

    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions( \Symfony\Component\OptionsResolver\OptionsResolver $resolver ): void
    {
        $resolver->setDefaults(
            [
                'csrf_protection' => false,
                'csrf_field_name' => '_token',
                // a unique key to help generate the secret token
                'intention'       => 'user_item'
            ]
        );
    }
}
