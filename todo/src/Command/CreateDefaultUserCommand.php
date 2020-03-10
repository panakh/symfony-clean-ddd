<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateDefaultUserCommand extends Command
{
    protected static $defaultName = 'app:create-default-user';
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;


    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');


        $existing = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'hashin']);
        if (null !== $existing) {
            $io->note('Default user exists');
            return 0;
        }

        $user = (new User())
            ->setUsername('hashin');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Created user');

        return 0;
    }
}
