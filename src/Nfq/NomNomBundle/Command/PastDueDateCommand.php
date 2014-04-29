<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 4/29/14
 * Time: 2:00 PM
 */

namespace Nfq\NomNomBundle\Command;


use Doctrine\ORM\EntityManager;
use Nfq\NomNomBundle\Entity\MyEvent;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PastDueDateCommand extends ContainerAwareCommand{
    protected function configure()
    {
        $this
            ->setName('nomnom:datecheck')
            ->setDescription('Check if the due date has passed')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $myEventRepository = $em->getRepository('NfqNomNomBundle:MyEvent');


        $events = $myEventRepository->findAll();
        $now = new \DateTime();
        $text = 'event statuses updated';
        foreach($events as $event)
        {
            /** @var MyEvent $event */
            if($now > $event->getEventDate()){
                $event->setEventPhase(3);
            }
        }
        $em->flush();
        $output->writeln($text);
    }
} 