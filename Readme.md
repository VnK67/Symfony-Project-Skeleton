# Welcome

This project is meant to be run with docker. If you don't have docker installed on your machine, well... [https://docs.docker.com/install/](https://docs.docker.com/install/)
You'll need `make` too. If you're on Windows, [https://docs.microsoft.com/en-gb/windows/wsl/install-win10](https://docs.microsoft.com/en-gb/windows/wsl/install-win10)

## First run
`make init` will create all necessary folder / files, init the database, and make sure everything is ready

At initialization's end, your project will be available on [http://localhost:8000](http://localhost:8000).

## Day-to-day use
`make up` will start the project and make it available on [http://localhost:8000](http://localhost:8000).

Once the project started, an instance of PhpMyAdmin will be available on [http://localhost:8001](http://localhost:8001) and an instance of MailHog (email capture interface) will be available on [http://localhost:8002](http://localhost:8002)

## Development
The Symfony Maker Bundle comes pre-installed. Use it to facilitate your work :) [https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html)