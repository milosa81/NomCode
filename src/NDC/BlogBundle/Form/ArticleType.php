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
            ->add('tech', 'entity', array(
                'label' => 'Techno',
                'class' => 'NDC\BlogBundle\Entity\Tech',
            ))
            ->add('state', 'choice', array(
                'label' => 'Etat',
                'choices' => array(
                    'published' => 'Publié',
                    'draft' => 'Brouillon',
                    'removed' => 'Supprimé',
                )
            ))
            ->add('createdAt', 'datetime', array(
                'label' => 'Créé le',
            ))
            ->add('html', 'textarea', array(
                'label' => 'HTML',
                'attr' => array(
                    'data-ckeditor' => '',
                )
            ))
            ->add('Enregistrer et quitter', 'submit')
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
