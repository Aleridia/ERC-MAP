<?php

namespace App\Form;

use App\Entity\CategorieElement;
use App\Entity\Element;
use App\Entity\NatureElement;

use App\Form\Type\SelectOrCreateType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locale = $options['locale'];
        $builder
            ->add('traduireFr', CheckboxType::class, [
                'label'    => 'languages.fr',
                'required' => false
            ])
            ->add('traduireEn', CheckboxType::class, [
                'label'    => 'languages.en',
                'required' => false
            ])
            ->add('etatAbsolu', TextType::class, [
                'label'    => 'element.fields.etat_absolu',
                'required' => false
            ])
            ->add('betaCode', TextType::class, [
                'label'    => 'element.fields.beta_code',
                'required' => false
            ])
            ->add('traductions', CollectionType::class, [
                'label'         => 'element.fields.traductions',
                'entry_type'    => TraductionElementType::class,
                'by_reference'  => false,
                'allow_add'     => true,
                'allow_delete'  => true,
                'required'      => false,
            ])
            ->add('natureElement', EntityType::class, [
                'label'        => 'element.fields.nature',
                'required'     => false,
                'multiple'     => false,
                'expanded'     => false,
                'class'        => NatureElement::class,
                'choice_label' => 'nom'.ucfirst($locale),
                'attr'         => [
                    'class' => 'autocomplete',
                    'data-placeholder' => $options['translations']['autocomplete.select_element']
                ],
                'query_builder' => function (EntityRepository $er) use ($locale) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom'.ucfirst($locale), 'ASC');
                }
            ])
            ->add('categories', EntityType::class, [
                'label'        => 'element.fields.categories_invariantes',
                'required'     => false,
                'multiple'     => true,
                'expanded'     => false,
                'class'        => CategorieElement::class,
                'choice_label' => 'nom'.ucfirst($locale),
                'attr'         => [
                    'class' => 'autocomplete autocomplete-max-3',
                    'data-placeholder' => $options['translations']['autocomplete.select_multiple']
                ],
                'query_builder' => function (EntityRepository $er) use ($locale) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom'.ucfirst($locale), 'ASC');
                }
            ])
            ->add('aReference', CheckboxType::class, [
                'label'      => 'element.fields.a_reference',
                'label_attr' => [
                    'class' => 'dependent_field_areference_main'
                ],
                'required' => false,
            ])
            ->add('theonymesImplicites', CollectionType::class, [
                'label'         => 'element.fields.theonymes_implicites',
                'entry_type'    => SelectOrCreateType::class,
                'entry_options' => [
                    'locale'                  => $options['locale'],
                    'translations'            => $options['translations'],
                    'field_name'              => 'theonymesImplicites',
                    'object_class'            => Element::class,
                    'creation_form_class'     => ElementMiniType::class,
                    'selection_choice_label'  => 'affichage',
                    'selection_query_builder' => function (EntityRepository $er) use ($options) {
                        $qb = $er->createQueryBuilder('e');
                        if($options['element']->getId() !== null){
                            $qb = $qb->where($qb->expr()->neq('e.id', $options['element']->getId()));
                        }
                        return $qb->orderBy('e.id', 'DESC');
                    }
                ],
                'allow_add'     => true,
                'allow_delete'  => true,
                'required'      => false,
            ])
            ->add('theonymesConstruits', CollectionType::class, [
                'label'         => 'element.fields.theonymes_construits',
                'entry_type'    => SelectOrCreateType::class,
                'entry_options' => [
                    'locale'                  => $options['locale'],
                    'translations'            => $options['translations'],
                    'field_name'              => 'theonymesConstruits',
                    'object_class'            => Element::class,
                    'creation_form_class'     => ElementMiniType::class,
                    'selection_choice_label'  => 'affichage',
                    'selection_query_builder' => function (EntityRepository $er) use ($options) {
                        $qb = $er->createQueryBuilder('e');
                        if($options['element']->getId() !== null){
                            $qb = $qb->where($qb->expr()->neq('e.id', $options['element']->getId()));
                        }
                        return $qb->orderBy('e.id', 'DESC');
                    }
                ],
                'allow_add'     => true,
                'allow_delete'  => true,
                'required'      => false,
            ])
            ->add('estLocalisee', CheckboxType::class, [
                'label'      => 'generic.fields.est_localisee',
                'label_attr' => [
                    'class' => 'dependent_field_estlocalisee_main'
                ],
                'required' => false,
            ])
            ->add('localisation', LocalisationType::class, [
                'label'           => 'generic.fields.localisation',
                'required'        => false,
                'region_required' => false,
                'attr'            => ['class' => 'localisation_form'],
                'locale'          => $options['locale'],
                'translations'    => $options['translations'],
            ])
            ->add('elementBiblios', CollectionType::class, [
                'label'         => false,
                'entry_type'    => ElementBiblioType::class,
                'entry_options' => array_intersect_key($options, array_flip(["translations","locale"])),
                'allow_add'     => true,
                'allow_delete'  => true,
                'required'      => false,
            ])
            ->add('commentaireFr', CKEditorType::class, array(
                'config_name' => 'text_styling_only',
                'label'       => 'generic.fields.commentaire_fr',
                'attr'        => ['rows' => 2],
                'required'    => false
            ))
            ->add('commentaireEn', CKEditorType::class, array(
                'config_name' => 'text_styling_only',
                'label'       => 'generic.fields.commentaire_en',
                'attr'        => ['rows' => 2],
                'required'    => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
        $resolver->setRequired('locale');
        $resolver->setRequired('translations');
        $resolver->setRequired('element');
    }
}
