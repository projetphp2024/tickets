<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\Tickets;
use App\Entity\Comments;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Ticket; // Assurez-vous d'importer la classe Ticket si ce n'est pas déjà fait

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    private function getCommentIds(ObjectManager $manager): array
    {
        // Récupérer tous les IDs des commentaires
        $commentIds = $manager->getRepository(Comments::class)->createQueryBuilder('c')
            ->select('c.id')
            ->getQuery()
            ->getScalarResult();

        // Transformer le résultat en un tableau simple d'IDs
        $commentIds = array_column($commentIds, 'id');

        return $commentIds;
    }

    private function getTicketIds(ObjectManager $manager): array
    {
        // Récupérer tous les IDs des tickets
        $ticketIds = $manager->getRepository(Tickets::class)->createQueryBuilder('t')
            ->select('t.id')
            ->getQuery()
            ->getScalarResult();

        // Transformer le résultat en un tableau simple d'IDs
        $ticketIds = array_column($ticketIds, 'id');

        return $ticketIds;
    }

    public function load(ObjectManager $manager): void
    {
        $basePath = 'public/images/';
        $commentIds = $this->getCommentIds($manager);
        $ticketIds = $this->getTicketIds($manager);

        for ($i = 1; $i <= 40; $i++) {
            $image = new Images();

            // Choisissez un ID de commentaire au hasard
            $randomCommentId = $commentIds[array_rand($commentIds)];
            $randomTicketId = $ticketIds[array_rand($ticketIds)];

            // Définir le chemin de l'image en utilisant le chemin de base et le numéro d'itération
            $imagePath = $basePath . "image{$i}.jpg";
            $image->setPath($imagePath);

           
            if ($i <= 20) {
                $comment = $manager->getRepository(Comments::class)->find($randomCommentId);
                $image->setComment($comment);
            } else {
                $ticket = $manager->getRepository(Tickets::class)->find($randomTicketId);
                $image->setTicket($ticket);
            }



            // Utilisez l'ID de commentaire choisi au hasard
       

            // Choisissez un ID de ticket au hasard (décommentez si vous utilisez des tickets)
            // $randomTicketId = $ticketIds[array_rand($ticketIds)];
            // $ticket = $manager->getRepository(Ticket::class)->find($randomTicketId);
            // $image->setTicket($ticket);

            $manager->persist($image);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [

            TicketsFixtures::class, // Assuming you have a CommentsFixtures class
            CommentsFixtures::class, // Assuming you have a CommentsFixtures class
        ];
    }
}
