<?php

namespace Dalyio\Gitpack\Services;

use Illuminate\Support\Facades\App;

class GitService
{   
    /**
     * Returns the package directory of registered git repository 
     * 
     * @param string $package
     * @return string
     */
    public function package($package)
    {
        $gitPackages = config('git.packages', []);
        return isset($gitPackages[$package]) ? $gitPackages[$package] : null;
    }
    
    /**
     * Returns an array of the package directory of registered git repositories 
     * 
     * @param string $package
     * @return array
     */
    public function packages($package = null)
    {
        $gitPackages = config('git.packages', []);
        if ($package) {
            return isset($gitPackages[$package]) ? [$gitPackages[$package]] : null;
        } else {
            return $gitPackages;
        }
    }
}
