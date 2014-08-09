<?php
/**
 * Created by PhpStorm.
 * User: damny
 * Date: 09/08/14
 * Time: 10:40
 */

namespace Acme\ApiBundle\Service;


use Acme\ApiBundle\Entity\User;
use Acme\ApiBundle\Entity\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class UserService {

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var UserRepository
     */
    protected $rep;

    public function __construct(EntityManager $em) {
        $this->setEm($em);
    }

    public function saveUser(User $user) {
        $this->em->persist($user);
        $this->em->flush($user);

        return $user;
    }

    /**
     * @return \Acme\ApiBundle\Entity\UserRepository
     */
    public function getRep()
    {
        return $this->rep;
    }

    /**
     * @param \Acme\ApiBundle\Entity\UserRepository $rep
     */
    public function setRep($rep)
    {
        $this->rep = $rep;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

} 