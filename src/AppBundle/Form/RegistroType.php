<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apaterno')
            ->add('amaterno')
            ->add('sexo','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Femenino' => 'F',
                    'Masculino' => 'M',
                ),
                'choices_as_values' => true,
            ))
            ->add('ciudad')
            ->add('estado')
            ->add('telefono', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                'label' => 'Teléfono'
            ))
            ->add('email')
            ->add('universidad')
            ->add('estatus','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Maestría' => 'Maestría',
                    'Doctorado' => 'Doctorado',
                    'Otro' => 'Otro',
                ),
                'choices_as_values' => true,
            ))
            ->add('semestre','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'choices_as_values' => true,
            ))
            ->add('credencialFile', 'Symfony\Component\Form\Extension\Core\Type\FileType', array(
                'required' => false,
            ))
            ->add('historialFile', 'Symfony\Component\Form\Extension\Core\Type\FileType', array(
                'required' => false,
            ))
            ->add('formatoFile', 'Symfony\Component\Form\Extension\Core\Type\FileType', array(
                'required' => false,
            ))
            ->add('toggleTalk', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'mapped' => false,
                'required' => false,
            ))
            ->add('titulo', 'Symfony\Component\Form\Extension\Core\Type\TextType',  array(
                'label' => 'Título'
            ))
            ->add('abstract', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',  array(
                'label' => 'Resumen'
            ))
             ->add('beca', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'required' => false,
            ))
            ->add('nombreProfesor', null, array(
                'label' =>'Nombre del profesor'
            ))
            ->add('emailProfesor', null, array(
                'label' =>'Email del profesor'
            ))
            ->add('nombreEmergencia', null, array(
                'label' =>'Nombre del contacto de emergencia'
            ))
            ->add('telEmergencia', null, array(
                'label' =>'Teléfono del contacto de emergencia'
            ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Registro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_registro';
    }


}
