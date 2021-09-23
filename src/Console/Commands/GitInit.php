<?php

namespace Dalyio\Gitpack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class GitInit extends Command
{
    /**
     * @var string
     */
    protected $signature = 'git:init {--p|package=} {--u|username=} {--e|email=}';
    
    /**
     * @var string
     */
    protected $description = 'Initialize a package git repository';
    
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
        $username = ($this->option('username')) ?: config('git.username');
        $email = ($this->option('email')) ?: config('git.email');
        $package = $this->gitService->package($this->option('package'));
        
        if (!$package) $this->line('The git package "'.$this->option('package').'" is not registered');
        if (!$username) $this->line('A git username must be provided');
        if (!$email) $this->line('A git email must be provided');
        
        if ($package && $username && $email) {
            $this->line('');
            $this->line($package);
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git init',
            ]));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git config user.name '.$username,
            ]));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git config user.email '.$email,
            ]));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git remote add origin git@github.com:'.$this->option('package').'.git',
            ]));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git remote -v',
            ]));
            echo shell_exec(implode(' && ', [
                'cd '.$package,
                'git pull origin master',
            ]));
            $this->line('');
        }
    }
}

