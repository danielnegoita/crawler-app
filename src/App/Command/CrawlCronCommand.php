<?php

namespace App\Command;

use App\Services\AdminService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CrawlCronCommand extends Command
{
    protected static $defaultName = 'app:crawl';
    protected static $defaultDescription = 'Crawl homepage and save the internal links to DB';

    private AdminService $adminService;

    public function __construct(string $name = null, AdminService $adminService)
    {
        parent::__construct($name);

        $this->adminService = $adminService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>crawler started</info>');

        $links = $this->adminService->crawl('http://0.0.0.0:8001');

        if(!$links) {
            $output->writeln('<info>no links found</info>');
            return Command::SUCCESS;
        }

        foreach ($links as $link) {
            $output->writeln('<comment>' . $link->link . '</comment>');
        }

        $output->writeln('<info>crawler action complete</info>');

        return Command::SUCCESS;
    }
}