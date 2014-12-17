<?php

namespace BionicUniversity\Bundle\ExportImportBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    private $path = 'var/backups/';

    protected function configure()
    {
        $this
            ->setName('product:import')
            ->setDescription('Import products from CSV')
            ->addArgument(
                'file',
                InputArgument::OPTIONAL,
                'name of the file'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('file');

        $em = $this->getContainer()->get('doctrine')->getManager();
        try {
            $file = new \SplFileObject($this->path . $fileName, 'r');
        } catch (RuntimeException $e) {
            $text = 'Error openning csv:' . $e->getMessage();
            $output->writeln($text);

            return;
        }

        $mode = '';
        while (!$file->eof() && ($row = $file->fgetcsv(';')) && $row[0] !== null) {
            switch ($row[0]) {
                case 'category.id':
                    $mode['name'] = 'category';
                    $mode['keys'] = $row;
                    break;
                case 'product.id':
                    $mode['name'] = 'product';
                    $mode['keys'] = $row;
                    break;
            }
            $data = [];
            foreach ($mode['keys'] as $i => $key) {
                $data = array_merge($data, array($key => $row[$i]));
            }
            if (($mode['name'] == 'category') && ($row[0] !== 'category.id')) {
                $entity = $em->getRepository('BionicUniversityCatalogBundle:Category')->find($data['category.id']);
                $parent = $em->getRepository('BionicUniversityCatalogBundle:Category')->find(
                    $data['category.parent.id']
                );

                if (!$entity) { // add if not exist
                    $entity = new \BionicUniversity\Bundle\CatalogBundle\Entity\Category();
                }
                $entity->setName($data['category.name']);
                if ($parent) {
                    $entity->setParent($parent);
                }
                $em->persist($entity);
                $em->flush();
            }
            if (($mode['name'] == 'product') && ($row[0] !== 'product.id')) {
                $product = $em->getRepository('BionicUniversityProductBundle:Product')->find($data['product.id']);
                $productStatus = $em->getRepository('BionicUniversityProductBundle:Product\Status')->find(
                    $data['product.status.id']
                );
                $category = $em->getRepository('BionicUniversityCatalogBundle:Category')->find(
                    $data['product.category.id']
                );
                if (!$product) {
                    $product = new Product();
                }
                $product->setName($data['product.name']);
                $product->setDescription($data['product.description']);
                $product->setPrice($data['product.price']);
                if ($category) {
                    $product->setCategory($category);
                }
                if ($productStatus) {
                    $product->setStatus($productStatus);
                }
                $em->persist($product);
                $em->flush();
            }
        }

        $text = 'File ' . $this->path . $fileName . ' is loaded.';
        $output->writeln($text);
    }
} 