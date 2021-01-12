<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin", name="admin_login")
     */
    public function loginAction(Request $request)
    {

        if($request->isMethod('POST'))
        {
            $em=$this->getDoctrine()->getManager();
            $user=$em->getRepository('AppBundle:User')->findOneBy(['email'=>$request->get('email')]);
            if(!empty($user))
            {
                $factory = $this->get('security.encoder_factory');
                /// Start verification
                $encoder = $factory->getEncoder($user);
                if (!$encoder->isPasswordValid($user->getPassword(), $request->get('password'), $user->getSalt())) {
                    return $this->redirectToRoute('admin_login');

                }
                else
                {
                    $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                    $this->get('security.token_storage')->setToken($token);

                    // If the firewall name is not main, then the set value would be instead:
                    // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
                    $this->get('session')->set('_security_main', serialize($token));

                    // Fire the login event manually
                    $event = new InteractiveLoginEvent($request, $token);
                    $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
                    return $this->redirectToRoute('easyadmin');

                }
            }

            return $this->redirectToRoute('admin_login');
        }
        // replace this example code with whatever you need
        return $this->render('@App/Default/index.html.twig',[]);
    }
}
