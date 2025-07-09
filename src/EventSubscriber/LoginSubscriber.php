<?php

namespace  App\EventSubscriber;



use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class LoginSubscriber implements  EventSubscriberInterface
{
    private $em;
    private $security;
    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->security = $security;
    }
    public function onLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if (in_array('ROLE_BANNED', $user->getRoles(), true)) {
            throw new CustomUserMessageAuthenticationException('Votre compte a été suspendu.');
        }
        $user->setLastLoginAt(new DateTime());
        $this->em->flush();
    }
    public static function getSubscribedEvents(): array
    {
        return [
            InteractiveLoginEvent::class => 'onLogin',

        ];
    }
}
