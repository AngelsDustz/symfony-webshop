# Symfony Webshop
This is an example symfony project to show to recruiters and other people that are interested in my PHP skills. Also to laugh at in a few months to see how much I improved.

**IMPORTANT!** This code should not be used to host an actual webshop or any kind of production setting. I will not be responsible for any kind of hacks/security issues that occur when using this in a production enviorment.

## Thanks!
This project makes use of the [bitnami symfony docker box](https://hub.docker.com/r/bitnami/symfony) I want to thank them for creating the box allowing me an easy development experience.

Furthermore this project was created using [Symfony 5](https://symfony.com/) and [Doctrine](https://www.doctrine-project.org/).

## Installation Guide
In order to enjoy this little project a few programs need to be installed:

The minimum needed to run this project is:

1. [Docker](https://www.docker.com/)
1. [Docker-compose](https://docs.docker.com/compose/)

Nice to haves are:
1. [PHP](https://www.php.net/)
1. [Composer](https://getcomposer.org/)
1. [Node](https://nodejs.org/en/)
1. [NPM](https://www.npmjs.com/)

The rest of the installation assumes that a minimal installation has been done, the nice to haves are to run some commands locally.

### 0. Configure project

First thing to do is create a `.env.local` in the `myapp` directory, this local environment file should contain a database DSN. You can use the following if you are unsure what to fill in:

`DATABASE_URL=mysql://root:@mariadb:3306/symfony_webshop`

This tells symfony to use the mariadb container to use as database server and `symfony_webshop` as database name.

### 1. Create the docker containers

**Important** if your user id and group id are not 1000:1000, make sure to edit the `docker-compose.yml` before continueing!

The first thing we need to do is create our docker containers so that we have a php server, a database and some fancy tools.
In order to do this we need to run `docker-compose up -d` this command will start all the containers defined in our `docker-compose.yml` feel free to check it out. The `-d` flag tells it to detatch so that we can still use our terminal.

### 2. Bash into the symfony container

After the first command has ran successfully and we have our terminal back it is time to get access to our container, if you peeked into the `docker-compose.yml` you can see we defined two services (Well, Bitnami did) a `myapp` and `mariadb` we are going to start a new bash process in the `myapp` container so we can run our `composer` and `symfony` commands.

To start a new bash in `myapp` we run `docker-compose exec myapp bash` the `exec` tells docker-compose to run a new process the `myapp` tells it in which service and the `bash` is the process we start.

If all went correctly we end up with a terminal saying something among the lines of:
`bitnami@{hash}:/app` now we run `cd myapp` and we are ready for step 3.

### 3. Setting up the Symfony project

Now that we are in our container we can start getting our packages, the first thing we have to do is install the composer packages.

We do this by running `composer install` this installs all our packages from `composer.json` with the versions defined in `composer.lock`.

Next we should create our database and run migrations we do this by calling Symfony's console functions like so:

`bin/console d:database:create` this will create our database as we configured in our `.env.local`. When this is done we can run `bin/console d:m:m` this is short for `doctrine:migrations:migrate`.

Now our project is set up and ready to go, if you want test data follow step 4.

### 4. Running fixtures

TODO.