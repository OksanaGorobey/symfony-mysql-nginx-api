<?php declare(strict_types=1);
namespace App\Form;

/**
 * Class LoginFormType
 * @package App\Form
 */
class LoginFormType extends BaseFormType
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
                                'message' => $this->_core->l10n('form_nickname_is_required'),
                            ]
                        ),
                        new \Symfony\Component\Validator\Constraints\Regex(
                            \App\lib\consts::PATTERN_NICKNAME,
                            $this->_core->l10n('form_nickname_is_invalid')
                        ),
                        new \Symfony\Component\Validator\Constraints\Length(
                            [
                                'min' => \App\lib\consts::NAME_MINLENGTH,
                                'max' => \App\lib\consts::NAME_MAXLENGTH,
                                'minMessage' => $this->_core->l10n(
                                    'form_nickname_is_invalid_minlength',
                                    [ '%limit%' => \App\lib\consts::PASSWORD_MINLENGTH ] ),
                                'maxMessage' => $this->_core->l10n(
                                    'form_nickname_is_invalid_maxlength',
                                    [ '%limit%' => \App\lib\consts::PASSWORD_MAXLENGTH ] )
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
                                'message' => $this->_core->l10n('form_password_is_required'),
                            ]
                        ),
                        new \Symfony\Component\Validator\Constraints\Length(
                            [
                                'min' => \App\lib\consts::PASSWORD_MINLENGTH,
                                'max' => \App\lib\consts::PASSWORD_MAXLENGTH,
                                'minMessage' => $this->_core->l10n(
                                    'form_password_is_invalid_minlength',
                                    [ '%limit%' => \App\lib\consts::PASSWORD_MINLENGTH ] ),
                                'maxMessage' => $this->_core->l10n(
                                    'form_password_is_invalid_maxlength',
                                    [ '%limit%' => \App\lib\consts::PASSWORD_MAXLENGTH ] )
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
                'intention'       => 'user',
            ]
        );
    }
}
