<?php

namespace Dalyio\Gitpack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class GitPull extends Command
{
    /**
     * @var string
     */
    protected $signature = 'git:pull {--p|package=}';
    
    /**
     * @var string
     */
    protected $description = 'Pull git files from origin';
    
    /**
     * @var \Dalyio\Gitpack\Services\GitService
     */
    protected $gitService;
    
    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->gitService = App::make(\Dalyio\Gitpack\Services\GitService::class);
    }
    
    /**
     * @return void
     */
    public function handle()
    {
        $this->line('');
        foreach ($this->gitService->packages($this->option('package')) as $package) {
            $this->line($package);
            $branch = trim(shell_exec(implode(' && ', [
                'cd '.$package,
                'git rev-parse --abbrev-ref HEAD'
            ])));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git pull origin '.$branch
            ]));
            $this->line('');
            $this->line('');
        }
    }
}
