<?php
namespace Test\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserForm extends AbstractType
{
	public function getName()
	{
		return 'userinfo';
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('email', 'email', [
			'label' => 'Почта'
		]);
		
		$builder->add('password', 'password', [
			'label' => 'Пароль'
		]);
		
		$builder->add('confirm', 'password', [
			'label' => 'Подтверждение'
		]);
		
		$builder->add('gender', 'choice' ,[
			'label' => 'Пол',
			'choices'  => \Test\TestBundle\Entity\Gender::getTypes(),
			'expanded' => true,
		]);
				
		$builder->add('birthday', 'birthday', [ 
			'empty_value' => array('day' => 'число', 'month' => 'месяц', 'year' => 'год'),
			'format' => 'dd-MM-yyyy',
			'label' => 'Дата рождения'
		]);
		
		$builder->add('about', 'textarea', [
			'max_length' => 500,
			'label' => 'Немного о себе (не более 500 символов)',
			'required' => false
		]);
		
		$builder->add('newsletter', 'checkbox', [
			'required' => false,
			'label' => 'Подписаться на новости',
			'attr' => ['checked' => true]
		]);
	}

	public function getDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Test\TestBundle\Entity\UserFormEntity',
		));
	}
}

