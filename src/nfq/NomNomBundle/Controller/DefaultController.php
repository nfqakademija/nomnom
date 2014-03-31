<?php

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NfqNomNomBundle:Default:index.html.twig',array('error'=> ''));
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

    public function eventAction($eventId)
    {
        $user = $this->getUser();
        if($user != ''){
            return $this->render('NfqNomNomBundle:Default:event.html.twig');
        }
        else{
            return $this->render('NfqNomNomBundle:Default:index.html.twig',array('error'=> 'log  in first'));
        }
    }

    public function eventManagerAction()
    {
        $user = $this->getUser();
        if($user != ''){
            return $this->render('NfqNomNomBundle:Default:eventmanager.html.twig',array('error'=> ''));
        }
        else{
            return $this->render('NfqNomNomBundle:Default:index.html.twig',array('error'=> 'log in  first'));
        }
    }
}