<?php

namespace Dalyio\Gitpack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class GitPush extends Command
{
    /**
     * @var string
     */
    protected $signature = 'git:push {--p|package=} {--m|message=}';
    
    /**
     * @var string
     */
    protected $description = 'Add, commit and push git files to origin'; 
    
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
     * @return mixed
     */
    public function handle()
    {
        $message = ($this->option('message')) ?: config('git.message');
        
        $this->line('');
        foreach ($this->gitService->packages($this->option('package')) as $package) {
            $this->line($package);
            $branch = trim(shell_exec(implode(' && ', [
                'cd '.$package,
                'git rev-parse --abbrev-ref HEAD'
            ])));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git add .',
                'git commit -m "'.$message.'"',
                'git push origin '.$branch
            ]));
            $this->line('');
            $this->line('');
        }
    }
}
