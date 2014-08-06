<?php
/**
 * Created by PhpStorm.
 * User: damny
 * Date: 06/08/14
 * Time: 21:43
 */

namespace Acme\ApiBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/add")
     * @Method("POST")
     */
    public function saveUser(Request $request) {
        var_dump($request);

        return new JsonResponse();
    }

    /**
     * @Route("/{id}")
     */
    public function getUserById($id) {
        $repository = $this->getDoctrine()->getRepository("AcmeApiBundle:User");

        $user = $repository->find($id);

        return new JsonResponse($user);
    }


} 