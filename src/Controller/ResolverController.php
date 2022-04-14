<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ticket;
use App\Entity\Tickettype;
use App\Form\ResolverType;
use App\Repository\TicketkindRepository;
use App\Repository\TickettypeRepository;
use Symfony\Component\HttpFoundation\Request;

class ResolverController extends AbstractController
{
    /**
     * @Route("/resolver/", name="resolver")
     */
    public function index(): Response
    {
        $t= new Ticket();
        $form=$this->createForm(ResolverType::class,$t);


        $ticket=$this->getDoctrine()->getManager()->getRepository(Ticket::class)->findAll();
        $typ=$this->getDoctrine()->getManager()->getRepository(Tickettype::class)->findAll();
        return $this->render('resolver/index.html.twig',['t'=>$ticket,'typ'=>$typ]);
    }

     /**
     * @Route("/resolver/supp/{id}", name="d")
     */
    public function Delete($id,TicketRepository $rep,TicketkindRepository $rep2): Response
    {
        $ticket=$rep->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($ticket);
        $em->flush();

        $kind=$rep2->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($kind);
        $em->flush();

        return $this->redirectToRoute('resolver');
    }

    /**
     * @Route("/resolver/update/resolved/{id}", name="resolved")
     */
    public function updateR($id,TicketRepository $rep): Response
    {
        $ticket=$rep->find($id);
          $ticket->setstatus("Resolved");
         // $ticket->setresolverid($res);
        $em=$this->getDoctrine()->getManager();
        
        $em->flush();
        return $this->redirectToRoute('resolver');
    }

      /**
     * @Route("/resolver/update/pending/{id}", name="pending")
     */
    public function updateP($id,TicketRepository $rep): Response
    {
        $ticket=$rep->find($id);
          $ticket->setstatus("Pending");
        $em=$this->getDoctrine()->getManager();
        
        $em->flush();
        return $this->redirectToRoute('resolver');
    }

      /**
     * @Route("/resolver/search/", name="rech")
     */
    public function search(TicketRepository $rep,Request $req): Response
    {
        $data=$req->get('rech');
        if($data=='')
        {
            $t= new Ticket();
            $form=$this->createForm(ResolverType::class,$t);
    
            $ticket=$this->getDoctrine()->getManager()->getRepository(Ticket::class)->findAll();
            $typ=$this->getDoctrine()->getManager()->getRepository(Tickettype::class)->findAll();
            return $this->render('resolver/index.html.twig', [
                't'=>$ticket,'typ'=>$typ]);
        } else{
            $typ=$this->getDoctrine()->getManager()->getRepository(Tickettype::class)->findAll();
            $ticket=$rep->findBy(['id'=>$data]);
            return $this->render('resolver/index.html.twig',['t'=>$ticket,'typ'=>$typ]);
        }

        
    }


        /**
     * @Route("/resolver/type/", name="addType")
     */
    public function addType(Request $req): Response
    {
        
        $t=new Tickettype;
         $data=$req->get('type');
         if($data!='')
         {
         $t->settype($data);
         $em=$this->getDoctrine()->getManager();
         $em->persist($t);
         $em->flush();
         return $this->redirectToRoute('resolver');
        }
    }



      /**
     * @Route("/resolver/suppt/{tp}", name="dt")
     */
    public function DeleteT($tp,TickettypeRepository $rep): Response
    {
        $t=$rep->find($tp);
        $em=$this->getDoctrine()->getManager();
        $em->remove($t);
        $em->flush();
        return $this->redirectToRoute('resolver');
    }
    
    


}
