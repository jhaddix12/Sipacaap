<?php namespace App\Form;

use App\Entity\Proyecto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProyectoType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder ->add('nombreProyecto',TextType::class) ->add('nombreGuia',TextType::class) ->add('ubicacion') ->add('fecha',DateType::class) ->add('foto', FileType::class,array(
            "label" => "Imagen:",
            "attr" =>array("class" => "form-control"),
            "data_class" => null
        )) ->add('descripcion', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ 'data_class'=> Proyecto::class,
            ]);
    }
}