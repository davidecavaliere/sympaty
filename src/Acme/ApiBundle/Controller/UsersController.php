<?php
/**
 * Created by PhpStorm.
 * User: damny
 * Date: 06/08/14
 * Time: 21:43
 */

namespace Acme\ApiBundle\Controller;
use Acme\ApiBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/users")
 *
 */
class UsersController extends Controller {

    /**
     * @Route("/")
     * @Method("GET")
     */
    public function getUsers() {

        $repository = $this->getDoctrine()->getRepository("AcmeApiBundle:User");
        $users = $repository->findAll();

        return new JsonResponse($users);
    }

    /**
     * @Route("/add/{user}")
     * @Method("POST")
     *
     */
    public function saveUser(Request $request, User $user) {
//        $service =  $this->get('acme_api.userservice');
//        $user = new \Acme\ApiBundle\Entity\User();
//        $user->setAlias('Turi');
//        $user->setPin(1234);
//        $user = $service->saveUser($user);

        var_dump($request->request->all());
        var_dump($user);
        exit();
        $service =  $this->get('acme_api.userService');

        $user = new \Acme\ApiBundle\Entity\User();
        $user->setAlias('Turi');
        $user->setPin(1234);

        $service->saveUser($user);

        return new JsonResponse($user);
    }

    /**
     * @Route("/{id}")
     * @ParamConverter(name="user")
     */
    public function getUserById(User $user) {
        //$repository = $this->getDoctrine()->getRepository("AcmeApiBundle:User");

        //$user = $repository->find($id);

        return new JsonResponse($user);
    }


} 