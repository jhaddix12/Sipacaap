<?php namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
class ContactType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder ->add('Nombre', TextType::class) ->add('Correo', EmailType::class) ->add('Telefono', TextType::class) ->add('Comentario', TextAreaType::class)
        ->add('captcha',CaptchaType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ // Configure your form options here

            'dataclass'=>Contact::class,

            ]);
    }
}