# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.box_url = "https://cloud-images.ubuntu.com/vagrant/trusty/current/trusty-server-cloudimg-amd64-vagrant-disk1.box"
  config.vm.host_name = "interstellar.dev"
  config.vm.network "private_network", ip: "192.168.66.15"

  config.vm.synced_folder ".", "/var/www/interstellar.dev", type: "nfs"

  config.vm.provider "virtualbox" do |v|
      v.name = "interstellar.dev"
      v.update_guest_tools = true
      v.memory = 2048
      v.cpus = 2
  end

  config.vm.provision :ansible do |a|
       a.playbook = "playbooks/provision.yml"
       a.inventory_path = "environments.ini"
       a.limit = "all"
  end
end