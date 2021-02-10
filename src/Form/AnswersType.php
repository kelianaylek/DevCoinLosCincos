<?php

namespace App\Form;

use App\Entity\Answers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AnswersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('answer_title')
            ->add('answer_description')
            // ->add('answer_author')
            // ->add('answer_date')
            // ->add('answer_likes')
            ->add('answer_code_1')
            ->add('answer_code_2')
            ->add('answer_code_3')
            ->add('answer_code_4')
            ->add('answer_code_5')
            // ->add('question_id');
            ->add("envoyer", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answers::class,
        ]);
    }
}
