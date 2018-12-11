 # LaraHome

LaraHome is a Web Controller for [MySensors](https://www.mysensors.org/) system. It is based on Laravel
The main goal is to built my own controller for my new house so i can easily customize it.

![LaraHome Dashboard](https://github.com/tchoblond59/LaraHome/raw/master/screenshots/dashboard_screen.png)

## How does it work

![LaraHome WorkFlow](https://github.com/tchoblond59/LaraHome/raw/master/screenshots/WorkFlow.png)

The mysensors node send their payload to the MySensors MQTT Gateway. The gateway publish the payload to the MQTT Broker
on the mysensors-out topic. The M2L (MQTT To Larahome) service had subscribe to the topic and send the payload with a post request
to LaraHome which store it into the database and dispatch the event to the plugin and the final UI to make it real time.

On the other side when LaraHome has to send something to the node it simply send a message to the broker on the mysensors-in topic.
The gateway will handle it and dipatch to the nodes.

## Pre Requisite

You need to have a MySensors MQTT gateway running. I use a raspberry to do this. MySensors provide a good tutorial [here](https://www.mysensors.org/build/raspberry)
You also need a MQTT Broker like ``mosquitto``. You can install it on your raspberry. 

## Install

Let's see how to install this on a fresh new Debian 9 for example. In this example i install LaraHome on apache2 with mariadb but you can do it with mysql and nginx if you know what you are doing.

First we need to install all the necessary packages. (Do this as root)

```
apt-get install -y git composer curl redis-server apache2 mariadb-server phpmyadmin
```
 We also need the latest npm. You can find more information [here](https://nodejs.org/en/download/package-manager/). In our case we can do
```
curl -sL https://deb.nodesource.com/setup_6.x | bash -
apt-get install -y nodejs
```

Now we gonna clone this repository, so go in the directory you want and this will create a new directory **LaraHome/**. At this point you should not stay as root. And create a dedicated user or use an existing one.
You should create a vhost wich point to ``LaraHome/public`` with your user privilege. You can do this with apache module such as ``libapache2_mtm_itk``. But if you want to this quick and dirty you can stay as root.

```
git clone https://github.com/tchoblond59/LaraHome.git
cd LaraHome
composer install
```

Now we have to configure some things on LaraHome like add a key to our app, running the migrations etc...
But first we need to create the ``.env`` file. You can use the example file ``.env.example``

```
cp .env.example .env
vim .env #use your favorite editor to modify .env
```

At this point i'll assume you have a redis-server instance up and running and sql server as well with the right database, user, password you set in ``.env``. So don't forget to create the database first.

```
php artisan key:generate
php artisan migrate
php artisan larahome install
```

Now you should see your app running if you go to [laratest.dev](http://laratest.dev) (depending on your ``.env`` file). **Default login is admin@admin.com and password is admin.**
If you make all the install in root you will need to set the correct permissions for some folders
```
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
```

LaraHome use [Laravel echo](https://laravel.com/docs/5.4/broadcasting#installing-laravel-echo) to deal with real-time using web-sockets so we need to install it.

```
npm install -g laravel-echo-server
laravel-echo-server start
```
If all is correct you should see something like this
```
L A R A V E L  E C H O  S E R V E R

version 1.3.0

⚠ Starting server in DEV mode...

✔  Running at localhost on port 6001
✔  Channels are ready.
✔  Listening for http events...
✔  Listening for redis events...

Server ready!
```

Finally you have to run M2L (MQTT To LaraHome). [link](https://github.com/tchoblond59/M2L)

At this point everything should be ok.

### Bonus
Here's my vhost conf
```
<VirtualHost *:80>
	# The ServerName directive sets the request scheme, hostname and port that
	# the server uses to identify itself. This is used when creating
	# redirection URLs. In the context of virtual hosts, the ServerName
	# specifies what hostname must appear in the request's Host: header to
	# match this virtual host. For the default virtual host (this file) this
	# value is not decisive as it is used as a last resort host regardless.
	# However, you must set it for any further virtual host explicitly.
	ServerName laratest.dev
	ServerAlias www.laratest.dev
	ServerAdmin postmaster@laratest.dev
	DocumentRoot /home/julien/Dev/LaraHome/public
	<Directory /home/julien/Dev/LaraHome/public>
		Require all granted
		Options -Indexes +FollowSymLinks
		AllowOverride All
	</Directory>
	
	<IfModule mpm_itk_module>
		AssignUserId julien julien
	</IfModule>
	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
	# error, crit, alert, emerg.
	# It is also possible to configure the loglevel for particular
	# modules, e.g.
	#LogLevel info ssl:warn

	ErrorLog ${APACHE_LOG_DIR}/larahome.dev-error.log
	CustomLog ${APACHE_LOG_DIR}/larahome.dev-access.log combined

	# For most configuration files from conf-available/, which are
	# enabled or disabled at a global level, it is possible to
	# include a line for only one particular virtual host. For example the
	# following line enables the CGI configuration for this host only
	# after it has been globally disabled with "a2disconf".
	#Include conf-available/serve-cgi-bin.conf
</VirtualHost>

```

## Features

For the moment you can create scenarios and schedule them using the Laravel cron scheduler.
LaraHome can react to MySensors incomming message and do some stuff.
You can define permissions of each user.
You can create many dashboard with different widgets.

## Dev

For created your personal widget , we need of this files :
```
LaraHome     
│
└───packages
    │
    └───name of your widget
    |   │   
    |   └───src   
    |        |     
    |        └───asset
    |        |     └──js
    |        |	       widget.js
    |        |
    |	     └───Controllers
    |	     |   	WidgetControlleurs.php
    |	     |
    |	     └───EventListener
    |	     |		WidgetEventListener.php
    |	     |
    |	     └───Events
    |	     |	     WidgetEvent.php
    |	     |
    |	     └───migration
    |	     |        ...
    |	     |
    |	     └───Models
    |	     |	     Widget.php
    |	     |
    |	     └───views
    |	     |	     widget.blade.php
    |	     |
    |	     
    WidgetServiceProvider.php
    routes.php
    composer.json
```



### First
You need to creat  3 directorys : 
- packages
- ex: lightcontrol
- src

Every package needs to have composer.json file, which contains not only potential dependancies, but also information about the package itself. So you go to your folder and run this command:


    composer init
In your composer.json 

    {
        "name": "name of your widget",
        "description": "",
        "authors": [
            {
                "name": "Your Name",
                "email": "mail address"
            }
        ],
        "autoload": {
            "psr-4": {
                "name of your widget\\": "src"
            }
        },
    
        "require": {},
     
    }
    
And then we run this command from main folder:

    composer update
**Creating a Service Provider**
There’s an **Artisan** command to create a service provider:   

     php artisan make:provider WidgetServiceProvider
   From Laravel 5.5 there’s a great function called **auto-discovery**, so here’s what we need to add into our package’s **composer.json**:
  

     "extra": {
            "laravel": {
                "providers": [
                    "name of your widget\\WidgetServiceProvider"
                ]
            }
        }

**Create a Controller**
Our example package will have only one Controller, let’s call it **WidgetController** – and we create it in the same **src** folder of our package.

  

      namespace  name of your widget;
      
      use  App\Http\Controllers\Controller;
        
      class  WidgetController  extends  Controller
      {
	     public  function  index()
	     {
		 
	     }
      }
**Create our Routes file**
You are probably familiar with usual **routes/web.php** file, so we have to create our own similar file in our package folder. Again, it will be a simple one-liner:

**packages\widget\src\routes.php**:

     Route::group(['middleware' => ['web']], function () {
	     Route::get('widget','widget\widgetController@index');
	});
Now, how does Laravel know about this **routes/web.php** file and our **Controller**? This is where our **Service Provider** comes in: we add these lines to its method **register()**:

    class  TimezonesServiceProvider  extends  ServiceProvider
    {
	    public  function  register()
	    {
		   include  __DIR__.'/routes/web.php';
		    $this->app->make('widget\WidgetController');
	    }
    
    }
**load URL in the browser!**

    larahome.test/widget
**Creat the view**

**src/views/widget.blade.php**
In this file it's simple html
[Example](https://github.com/ugowarembourg/CompteurCycle/blob/master/src/views/compteur.blade.php)

Now, let’s return to our **Service Provider** and this time we will use **boot()** method by adding a command, where to load our views from. The second parameter is our Namespace which we will use in the next step.


        public  function  boot()
	   {
		    $this->loadViewsFrom(__DIR__.'/views',  'widget');
	   }
Next thing – we need to change our **Controller** to load this view with a parameter. Now, notice that we are loading the view with the specific namespace of our package that we just specified in Service Provider.

    return view('widgets::widget');

For an example of a finished widget click [here.](https://github.com/ugowarembourg/CompteurCycle)

Documentation is not finished yet but if you want to make a plugin you can already look some ressources.
The only thing you have to do is a Laravel Package.

[Tutorial i use to do it](http://laraveldaily.com/how-to-create-a-laravel-5-package-in-10-easy-steps/)

[A plugin who works](https://github.com/tchoblond59/SSRelay)

[Laravel Documentation](https://laravel.com/docs/5.4/packages)

### Translation

You can help me to translate LaraHome. Translation can be found in `ressources/lang/`.
So to translate in french you have to copy the en directory to fr and change the translation.
Then go to `config/app.php` and change the `locale` to fr. 

If the translation hasn't be done yet: Find the view in `ressources/views` and replace the hardcoded text with `{{ __('messages.welcome') }}`
and add the translation in the lang directory in `ressources/lang/en/messages.php`.

[More information here](https://laravel.com/docs/5.4/localization)

#### **Feel free to pull request !**

**This is still under heavy development**
