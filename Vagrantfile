# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box-pro"
    config.vm.hostname = "scotchbox"
    config.vm.network "forwarded_port", guest: 80, host: 8080
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]

    $script = <<-SCRIPT
        echo Setting up Laravel
        composer global require laravel/installer
        export PATH=$PATH:$HOME/.config/composer/vendor/bin

        echo Creating Databases
        mysql -e "CREATE DATABASE laravel;" -u root -proot

        cd /var/www

        echo Migrating the tables
        php artisan migrate:refresh --seed

        echo All Done! Check out http://192.168.33.10
    SCRIPT

    config.vm.provision "shell", inline: $script


end