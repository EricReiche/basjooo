<?php

namespace App\Controller;

use App\Entity\Bed;
use App\Repository\BedRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BedController extends AbstractController
{
    #[Route('/bed', name: 'app_bed')]
    public function index(BedRepository $bedRepository): Response
    {
        return $this->render('bed/index.html.twig', [
            'beds' => $bedRepository->findAll(),
        ]);
    }
    #[Route('/bed/{id}', name: 'app_bed_show')]
    public function show(Request $request, Bed $bed, CommentRepository $commentRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($bed, $offset);

        return $this->render('bed/show.html.twig', [
            'bed' => $bed,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
        ]);
    }
}
