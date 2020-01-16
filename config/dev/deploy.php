<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

/**
 * See https://github.com/EasyCorp/easy-deploy-bundle/blob/master/doc/default-deployer.md
 */
return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('') //TODO
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/home/symfony-project-skeleton/www')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('') //TODO
            // the repository branch to deploy
            ->repositoryBranch('master')
            ->composerInstallFlags('--prefer-dist --no-interaction')
            ;
    }

    public function beforePreparing()
    {
        $this->runRemote('echo "APP_ENV=dev" >> {{ project_dir }}/.env');
        $this->runRemote('echo "APP_SECRET=7030a9b024a876a6b5d76aac1012af8b" >> {{ project_dir }}/.env');
        $this->runRemote('echo "DATABASE_URL=mysql://user:password@localhost/base" >> {{ project_dir }}/.env');
        $this->runRemote('echo "MAILER_URL=null://localhost" >> {{ project_dir }}/.env');
    }

    public function beforeFinishingDeploy()
    {
        $this->runRemote('npm install');
        $this->runRemote('npm run-script build');
    }
};
