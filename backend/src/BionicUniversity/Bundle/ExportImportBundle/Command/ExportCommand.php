<?php

namespace BionicUniversity\Bundle\ExportImportBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends ContainerAwareCommand
{
    private $path = 'var/backups/';

    protected function configure()
    {
        $this
            ->setName('product:export')
            ->setDescription('Export products to CSV');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $fileName = 'base' . date('d_m_Y_H_i_s') . '.csv';
        $file = new \SplFileObject($this->path . $fileName, 'w');

        $entities = $em->getRepository('BionicUniversityCatalogBundle:Category')->findAll();

        $fields = [
            'category.id',
            'category.name',
            'category.parent.id'
        ];
        $file->fputcsv($fields, ';');
        $i = 0;
        foreach ($entities as $entity) {
            if ($entity->getParent()) {
                $parentId = $entity->getParent()->getId();
            } else {
                $parentId = '';
            }
            $fields = [$entity->getId(), $entity->getName(), $parentId];
            $file->fputcsv($fields, ';');
            $i++;
        }


        $entities = $em->getRepository('BionicUniversityProductBundle:Product')->findAll();

        $fields = [
            'product.id',
            'product.name',
            'product.description',
            'product.category.id',
            'product.price',
            'product.status.id'
        ];
        $file->fputcsv($fields, ';');
        $i2 = 0;

        foreach ($entities as $entity) {
            if ($entity->getCategory()) {
                $categoryId = $entity->getCategory()->getId();
            } else {
                $categoryId = '';
            }
            if ($entity->getStatus()) {
                $statusId = $entity->getStatus()->getId();
            } else {
                $statusId = '';
            }
            $fields = [
                $entity->getId(),
                $entity->getName(),
                $entity->getDescription(),
                $categoryId,
                $entity->getPrice(),
                $statusId
            ];
            $file->fputcsv($fields, ';');
            $i2++;
        }
        $text = 'Created file ' . $this->path . $fileName;
        $output->writeln($text);
    }
} 