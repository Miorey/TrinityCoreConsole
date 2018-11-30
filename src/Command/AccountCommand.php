<?php
/**
 * Created by PhpStorm.
 * User: clem
 * Date: 20/11/18
 * Time: 21:58
 */

namespace App\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\TrinityCore\Client;

class AccountCommand extends Command
{
    protected function configure()
    {

        $this
            // the name of the command (the part after "bin/console")
            ->setName('trinity:account:create')

            // the short description shown while running "php bin/console list"
            ->setDescription('Create account')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('No Help 4 U');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \App\TrinityCore\Exceptions\SoapException
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $console = new Client('gabknight', 'GAB13naki');
        $console->send()->message('test', 'Message in the middle of the screen by administrator');

    }
}