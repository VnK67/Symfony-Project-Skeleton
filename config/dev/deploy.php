<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

/**
 * See https://github.com/EasyCorp/easy-deploy-bundle/blob/master/doc/default-deployer.md
 */
return new class extends DefaultDeployer
{
    /**
     * DEFINE HERE YOUR PROJECT'S SETTINGS
     */
    private const REPO_URL = 'git@git.canari.io:canari/symfony-project-skeleton.git';
    private const PATH_ON_SERVER = '/home/symfony-project-skeleton/www';
    private const SSH_DSN = 'symfony-project-skeleton@nest.canari.io';

    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server(self::SSH_DSN)
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir(self::PATH_ON_SERVER)
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl(self::REPO_URL)
            // the repository branch to deploy
            ->repositoryBranch('master')
            ->composerInstallFlags('--prefer-dist --no-interaction')
        ;
    }

    public function beforePreparing()
    {
        $this->runRemote('echo "APP_ENV=dev" >> {{ project_dir }}/.env');
        $this->runRemote('echo "APP_SECRET=d2104a400c7f629a197f33bb33fe80c0" >> {{ project_dir }}/.env');
        $this->runRemote('echo "DATABASE_URL=mysql://mober:kuIef4TaWmWXJjRn@localhost/mober" >> {{ project_dir }}/.env');
        $this->runRemote('echo "MAILER_URL=null://localhost" >> {{ project_dir }}/.env');
    }

    public function beforeFinishingDeploy()
    {
        $this->runRemote('npm install');
        $this->runRemote('npm run-script build');
    }
};
