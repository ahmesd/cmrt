<?php

namespace App\Controller;

use App\Entity\Payement;
use App\Form\PayementType;
use App\Form\PayementSearchType;
use App\Repository\PayementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/payement")
 */
class PayementController extends AbstractController
{
    /**
     * @Route("/list", name="payement_list", methods={"GET"})
     */
    public function list(PayementRepository  $interventionsRepository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $inter=$interventionsRepository->findAll();
        //l'image est située au niveau du dossier public
        $png = file_get_contents("logocmr.jpg");
        $pngbase64 = base64_encode($png);



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('payement/list.html.twig', [
            'payements' => $inter ,
            "img64"=>$pngbase64
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Historiques des payements.pdf", [
            "Attachment" => true
        ]);
    }





    /**
     * @Route("/aaa", name="formmattion_index", methods={"GET","POST"})
     */



    public function indexxxx(Request $request,PayementRepository $formmattionRepository): Response
    {

        // $Formations = new Formmattion();
        $form = $this->createForm(PayementSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $term = $form['nom']->getData();
            $description = $form['description']->getData();

            $allformations= $formmattionRepository->search($term,$description);

        }
        else
        {
            $allformations= $formmattionRepository->findAll();
        }
        return $this->render('payement/index.html.twig', [
            'payements' => $formmattionRepository->findAll(),
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/admin/utilisateur/search", name="utilsearch")
     */
    public function searchPlanajax(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Payement::class);
        $requestString = $request->get('searchValue');
        $plan = $repository->findPlanBySujet($requestString);
        return $this->render('payement/utilajax.html.twig', [
            'payements' => $plan,
        ]);
    }


    /**
     * @Route("/", name="payement_index", methods={"GET"})
     */
    public function index(PayementRepository $payementRepository): Response
    {
        return $this->render('payement/index.html.twig', [
            'payements' => $payementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paye", name="paye_index", methods={"GET"})
     */
    public function indexx(PayementRepository $payementRepository): Response
    {
        return $this->render('payement/debit.html.twig', [
            'payements' => $payementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="payement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payement = new Payement();
        $form = $this->createForm(PayementType::class, $payement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($payement);
            $entityManager->flush();

            return $this->redirectToRoute('payement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payement/new.html.twig', [
            'payement' => $payement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="payement_show", methods={"GET"})
     */
    public function show(Payement $payement): Response
    {
        return $this->render('payement/show.html.twig', [
            'payement' => $payement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="payement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Payement $payement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PayementType::class, $payement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('payement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payement/edit.html.twig', [
            'payement' => $payement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="payement_delete", methods={"POST"})
     */
    public function delete(Request $request, Payement $payement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($payement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('payement_index', [], Response::HTTP_SEE_OTHER);
    }
}
