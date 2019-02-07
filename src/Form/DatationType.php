<?php

namespace App\Form;

use App\Entity\Datation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DatationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postQuem', IntegerType::class, [
                'label'    => 'datation.fields.post_quem',
                'required' => false
            ])
            ->add('anteQuem', IntegerType::class, [
                'label'    => 'datation.fields.ante_quem',
                'required' => false
            ])
            ->add('postQuemCit', IntegerType::class, [
                'label'      => 'datation.fields.post_quem_cit',
                'required'   => false,
                'label_attr' => [
                    'class' => 'quote_dependent'
                ]
            ])
            ->add('anteQuemCit', IntegerType::class, [
                'label'      => 'datation.fields.ante_quem_cit',
                'required'   => false,
                'label_attr' => [
                    'class' => 'quote_dependent'
                ]
            ])
            ->add('dateAnc', IntegerType::class, [
                'label'    => 'datation.fields.date_anc',
                'required' => false
            ])
            ->add('commentaireDateFr', TextareaType::class, [
                'label'    => 'generic.fields.commentaire_fr',
                'required' => false
            ])
            ->add('commentaireDateEn', TextareaType::class, [
                'label'    => 'generic.fields.commentaire_en',
                'required' => false
            ])
            // ->add('fiabiliteDatation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Datation::class,
        ]);
    }
}
