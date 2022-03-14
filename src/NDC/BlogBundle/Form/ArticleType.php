<?php

namespace NDC\BlogBundle\Form;

use NDC\BlogBundle\Entity\Article;
use NDC\BlogBundle\Repository\DemoRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /** @var  Article */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

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
            ->add('category', 'entity', array(
                'label' => 'Catégorie',
                'class' => 'NDC\BlogBundle\Entity\Category',
            ))
            ->add('tech', 'entity', array(
                'label' => 'Techno',
                'class' => 'NDC\BlogBundle\Entity\Tech',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('state', 'choice', array(
                'label' => 'Etat',
                'choices' => array(
                    'published' => 'Publié',
                    'draft' => 'Brouillon',
                    'removed' => 'Supprimé',
                )
            ))
            ->add('demo', null, array(
                'label' => 'Démo',
                'query_builder' => function(DemoRepository $repo) {
                    return $repo->queryDemoWithoutArticle($this->article);
                },
            ))
            ->add('createdAt', 'datetime', array(
                'label' => 'Publié le',
            ))
            ->add('html', 'textarea', array(
                'label' => 'HTML',
                'attr' => array(
                    'data-ckeditor' => '',
                )
            ))
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
