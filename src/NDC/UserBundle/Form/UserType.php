<?php

namespace NDC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => 'Login',
            ))
            ->add('email', 'email', array(
                'label' => 'Email',
            ))
            ->add('plain_password', 'repeated', array(
                'type' => 'password',
                'first_options'  => array(
                    'label' => 'Nouveau mot de passe',
                    'attr' => array(
                        'placeholder' => 'Mot de passe',
                    )
                ),
                'second_options' => array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Confirmation du mot de passe',
                    )
                ),
                'required' => false,
            ))
            ->add('file', 'file', array(
                'label' => 'Photo',
                'required' => false,
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'Activé',
                'required' => false,
            ))
            ->add('locked', 'checkbox', array(
                'label' => 'Bloqué',
                'required' => false,
            ))
            // ->add('expired', 'checkbox', array(
            //     'label' => 'Expiré',
            //     'required' => false,
            // ))
            // ->add('expires_at', 'datetime', array(
            //     'label' => 'Expiré l',
            //     'required' => false,
            // ))
            ->add('roles', 'choice', array(
                'label' => 'Droits',
                'multiple' => true,
                'expanded' => true,
                'choices' => array(
                    'ROLE_ADMIN' => 'Administrateur',
                ),
            ))
            ->add('facebook', 'url', array(
                'label' => 'Facebook',
                'required' => false,
            ))
            ->add('twitter', 'url', array(
                'label' => 'Twitter',
                'required' => false,
            ))
            ->add('github', 'url', array(
                'label' => 'GitHub',
                'required' => false,
            ))
            ->add('linkedin', 'url', array(
                'label' => 'LinkedIn',
                'required' => false,
            ))
            ->add('website', 'url', array(
                'label' => 'Site perso',
                'required' => false,
            ))
            ->add('Enregistrer', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NDC\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ndc_userbundle_user';
    }
}
