<?php 

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\Show;
use DateTime;
use DateTimeZone;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setShowCreatedAt'],
        ];
    }

    public function setShowCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Show)) {
            return;
        }

        $date = new DateTime('now' , new DateTimeZone('Europe/Paris'));
        $entity->setCreatedAt($date);
    }
}