# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "ubuntu/xenial64"

    config.vm.network :private_network, ip: "192.168.3.14"

    config.vm.hostname = "todora.dev"
    config.hostsupdater.aliases = ["stage.todora.dev"]

     config.vm.synced_folder ".",
        "/vagrant",
        type: "rsync",
        rsync__exclude: [
            ".git/",
            ".idea/",
            "vendor/",
            ".vagrant/"
        ]

    if Vagrant::Util::Platform.windows? then
        config.winnfsd.uid = 1000
        config.winnfsd.gid = 1000
    end

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "1536"
        vb.cpus = 4
        vb.name = "todora.dev"
    end

    config.vm.provision "shell", path: "vagrant/apt.sh"
    config.vm.provision "shell", path: "vagrant/ssl.sh"
    config.vm.provision "shell", path: "vagrant/nginx.sh"
    config.vm.provision "shell", path: "vagrant/php.sh"
    config.vm.provision "shell", path: "vagrant/ruby.sh"
    config.vm.provision "shell", path: "vagrant/nodejs.sh"
    config.vm.provision "shell", path: "vagrant/pgsql.sh"
    config.vm.provision "shell", path: "vagrant/phars.sh", privileged: false
    config.vm.provision "shell", path: "vagrant/provision-project.sh", privileged: false
end
