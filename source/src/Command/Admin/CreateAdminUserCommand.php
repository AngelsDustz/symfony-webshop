<?php

declare(strict_types=1);

namespace App\Command\Admin;

use App\DTO\AdminDTO;
use App\Factory\AdminFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreateAdminUserCommand.
 */
class CreateAdminUserCommand extends Command
{
    protected static $defaultName = 'admin:user:create';

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var AdminFactory
     */
    private $adminFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CreateAdminUserCommand constructor.
     *
     * @param ValidatorInterface     $validator
     * @param AdminFactory           $adminFactory
     * @param EntityManagerInterface $entityManager
     * @param string|null            $name
     */
    public function __construct(ValidatorInterface $validator, AdminFactory $adminFactory, EntityManagerInterface $entityManager, string $name = null)
    {
        parent::__construct($name);

        $this->validator     = $validator;
        $this->adminFactory  = $adminFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * Configure command.
     */
    protected function configure(): void
    {
        parent::configure();

        $this
            ->setDescription('Creates an Admin account.')
            ->setHelp('This commands helps you creating a new Admin account.')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('This commands helps you create a new admin account.');

        /** @var QuestionHelper $helper */
        $helper     = $this->getHelper('question');
        $question   = new Question('Username: ');

        $username = $helper->ask($input, $output, $question);

        $question = new Question('Password: ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        $password = $helper->ask($input, $output, $question);

        $adminDTO           = new AdminDTO();
        $adminDTO->username = $username;
        $adminDTO->password = $password;

        $errors = $this->validator->validate($adminDTO);

        if (\count($errors) > 0) {
            if ($errors instanceof ConstraintViolationList) {
                $output->writeln((string) $errors);
            }

            return 1;
        }

        $admin = $this->adminFactory->createFromDTO($adminDTO);

        $this->entityManager->persist($admin);
        $this->entityManager->flush();

        $output->writeln(sprintf('Created admin with user name %s!', $admin->getUsername()));

        return 0;
    }
}
