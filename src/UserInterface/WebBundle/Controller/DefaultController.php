<?php

namespace UserInterface\WebBundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    private $mailer;
    private $twig;
    private $connection;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, Connection $connection)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->connection = $connection;
    }

    public function indexAction()
    {
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello subject!')
        ->setFrom('admin@demo.dev', 'Roxot Team')
        ->setTo('demo@demo.dev')
        ->setBody($this->twig->render('WebBundle:Default:index.html.twig'), 'text/html');

        $this->mailer->send($message);

        $stmt = $this->connection->prepare('select * from users');
        $stmt->execute();

        return $this->render('WebBundle:Default:index.html.twig');
    }
}
