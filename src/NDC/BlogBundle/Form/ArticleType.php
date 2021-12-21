<?php

namespace NDC\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'Titre'
            ))
            ->add('author', 'entity', array(
                'label' => 'Auteur',
                'class' => 'NDC\UserBundle\Entity\User',
            ))
            ->add('techs', 'entity', array(
                'label' => 'Technos',
                'class' => 'NDC\BlogBundle\Entity\Tech',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('createdAt', 'datetime', array(
                'label' => 'Créé le',
            ))
            ->add('html', 'textarea', array(
                'label' => 'HTML',
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
            'data_class' => 'NDC\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ndc_blogbundle_article';
    }
}
