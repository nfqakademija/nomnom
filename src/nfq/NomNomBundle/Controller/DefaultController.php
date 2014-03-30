<?php

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NfqNomNomBundle:Default:index.html.twig');
    }

    public function getAvatarAction($avatarId)
    {
        $userProfile = $this->getDoctrine()
            ->getRepository("NfqNomNomBundle:myUserProfile")
            ->find($avatarId);

        $img =  base64_decode(stream_get_contents($userProfile->getAvatar()));

        $response  = new Response(
        $img,
        Response::HTTP_OK,
        array('content-type' => 'image/png',
            'Content-transfer-encoding' => 'binary')
        );
        return $response;
    }
}