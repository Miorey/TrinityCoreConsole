<?php
/**
 * Created by PhpStorm.
 * User: clem
 * Date: 18/12/18
 * Time: 01:07
 */

namespace App\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\TrinityCore\TrinityClient;
use Psr\Log\LoggerInterface;

class CommandController
{
    private $trinityClient;

    public function __construct(TrinityClient $trinityClient)
    {
        $this->setTrinityClient($trinityClient);
    }


    /**
     * @return TrinityClient
     */
    public function getTrinityClient()
    {
        return $this->trinityClient;
    }

    /**
     * @param TrinityClient $trinityClient
     */
    public function setTrinityClient($trinityClient): void
    {
        $this->trinityClient = $trinityClient;
    }


    /**
     * @return View
     * @Rest\Get("/command/test")
     */
    public function getCommand() : View
    {
        $ret = $this->getTrinityClient()->executeCommand("send message test Hello");
        return View::create($ret, Response::HTTP_ACCEPTED);
    }
}