##Steps to run the project on your local machine

Clone the project to your local machine

    git clone https://mhshuvro@bitbucket.org/mhshuvro/chronext.git

Go inside the project folder

	cd chronext

Run the following command to install homestead directly in the project
  	
  	composer require laravel/homestead --dev

Now create the `Homestead.yaml` and `vagrantfile` inside the project
	
for Mac/linux
	
	php vendor/bin/homestead make
	
for windows
	
    vendor\\bin\\homestead make`

Open the newly created `Homestead.yaml` file and update the following things. I used my configurations here. I have used virtualbox, change yours accordingly.
  	
  	ip: 192.168.10.10
    memory: 2048
    cpus: 1
    provider: virtualbox
    authorize: ~/.ssh/id_rsa.pub
    keys:
       - ~/.ssh/id_rsa
    folders:
       -
           map: 'C:\Users\shuvr\Sites\test\chronext'
           to: /home/vagrant/code
    sites:
       -
           map: mywatch.test
           to: /home/vagrant/code/public
    databases:
       - mywatch
    name: mywatch
    hostname: mywatch

Add the following entry in your machines `/etc/hosts/` file
	
	192.168.10.10  mywatch.test

Copy the .env.example and create .env file. Update DB_ section as follows
	
	DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mywatch
    DB_USERNAME=homestead
    DB_PASSWORD=secret

Now run the command 

    vagrant up

Run following command to generate an application key in your .env file

    php artisan key:generate

Run this to SSH into your running vagrant machine

    vagrant ssh

Use `cd code` to enter in the project folder. Using `ls` will give you all the files inside the project like below
	
	after.sh  bootstrap      database        public     server.php   vendor
    aliases   composer.json  Homestead.yaml  readme.md  storage      webpack.mix.js
    app       composer.lock  package.json    resources  tests
    artisan   config         phpunit.xml     routes     Vagrantfile

Now run the following commands to create database tables and populate them with some demo data
	
	php artisan migrate
	php artisan db:seed

Now you can visit the project at `http:/mywatch.test`

I have used my configuration and used the commands accordingly. Please change the commands according to your configurations from `Homestead.yaml`.

