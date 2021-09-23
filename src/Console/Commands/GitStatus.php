<?php

namespace Dalyio\Gitpack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class GitStatus extends Command
{
    /**
     * @var string
     */
    protected $signature = 'git:status {--p|package=}';
    
    /**
     * @var string
     */
    protected $description = 'Check the status of the git repository';
    
    /**
     * @var \Cruiserweight\Platform\Services\GitService
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
     * @return mixed
     */
    public function handle()
    {
        $this->line('');
        foreach ($this->gitService->packages($this->option('package')) as $package) {
            $this->line($package);
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git status',
            ]));
            $this->line('');
            $this->line('');
        }
    }
}
