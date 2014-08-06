<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Post;
use Acme\DemoBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

	/**
	 * @Route("/json")
	 */
	public function jsonAction() {

		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizer = new GetSetMethodNormalizer();
		$normalizer->setIgnoredAttributes(array('user'));
		$serializer = new Serializer(array($normalizer), $encoders);

		$postRepo = $this->getDoctrine()->getRepository('AcmeDemoBundle:Post');
		$userRepo = $this->getDoctrine()->getRepository('AcmeDemoBundle:User');
		$em = $this->getDoctrine()->getManager();

		$post = new Post();
		$user = $userRepo->find(1);

		$post->setTitle('Test Title');
		$post->setBody('Hello body');
		$post->setUser($user);

		$em->persist($post);
		$em->flush();

		$posts = $postRepo->findAll();

		$res = new Response($serializer->serialize($posts, 'json'));

		return $res;
	}

	/**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mailer = $this->get('mailer');

            // .. setup a message and send it
            // http://symfony.com/doc/current/cookbook/email.html

            $request->getSession()->getFlashBag()->set('notice', 'Message sent!');

            return new RedirectResponse($this->generateUrl('_demo'));
        }

        return array('form' => $form->createView());
    }
}
