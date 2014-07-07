<?php

namespace Test\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Test\TestBundle\Entity\UserFormEntity;
use Test\TestBundle\Form\UserForm;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	public function indexAction()
	{
		return $this->render(
			'TestTestBundle:Default:index.html.twig', 
			array(
				'title' => 'Это title главной страницы', 
				'actionname' => __METHOD__,
				'header' => 'Тестовое задание для кандидатов на вакансию «PHP-программист».'
			)
		);
	}

	public function userformAction()
	{
		$userform = new UserFormEntity;
    $form = $this->createForm(new UserForm(), $userform);

		return $this->render(
			'TestTestBundle:Form:userform.html.twig',
			array(
				'title' => 'Это title Userform', 
				'actionname' => __METHOD__,
				'form' => $form->createView(),
				'header' => 'Заполните форму',
				'errors' => []
			)
		);
	}

	public function sendmessageAction(Request $request)
	{
		$entity = new UserFormEntity;
		$form = $this->createForm(new UserForm(), $entity);
		
		if ($request->isMethod('POST')) {
			$form->submit($request);
			
			if ($form->isValid()) {
				if(!$entity->isPasswordConfirmed()){
					return $this->render(
						'TestTestBundle:Form:userform.html.twig',
						array(
							'title' => 'Это title Userform', 
							'actionname' => __METHOD__,
							'form' => $form->createView(),
							'header' => 'Заполните форму',
							'errors' => ['Пароли не совпадают']
						)
					);
				}
				
				$data = $form->getData();
				$mailer = $this->get('mailer');
				$message = \Swift_Message::newInstance()
						->setSubject('Symfony test')
						->setFrom('send@symfony.m-teach.ru')
						->setTo($data->getEmail())
						->setContentType('text/html')
						->setBody(
							$this->renderView(
								'TestTestBundle:Mails:testmail.html.twig', 
								['data'=>[
										'mail' => [
											'label' => 'Почта:', 
											'value' => $data->getEmail()
										],
										'password' => [
											'label' => 'Пароль:', 
											'value' => $data->getPassword()
										],
										'gender' => [
											'label' => 'Пол:', 
											'value' => ($data->getGender() == '0') ? 'М' : 'Ж'
										],
										'birthday' => [
											'label' => 'Дата рождения:', 
											'value' => date('d/m/Y',$data->getBirthday()->getTimestamp())
										],
										'about' => [
											'label' => 'О себе:', 
											'value' => $data->getAbout()
										],
										'newsletter' => [
											'label' => 'Подписка:', 
											'value' => ($data->getNewsletter())?'да':'нет'
										]
									]
								]
							)
						);
				$mailer->send($message);

				return $this->render(
					'TestTestBundle:Default:aftersend.html.twig', 
					array(
						'title' => 'Это title sendmessage', 
						'actionname' => __METHOD__,
						'header' => 'Вам отправлено письмо'
					)
				);
			}
			else{
				$errors = $validator->validate($form);
				
				return $this->render(
					'TestTestBundle:Form:userform.html.twig',
					array(
						'title' => 'Это title Userform', 
						'actionname' => __METHOD__,
						'form' => $form->createView(),
						'header' => 'Заполните форму',
						'errors' => $errors
					)
				);
			}
		}
	}
}
