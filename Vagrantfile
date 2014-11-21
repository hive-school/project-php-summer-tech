# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "parallels/ubuntu-14.04"
  config.vm.host_name = "interstellar.localhost"
  config.vm.network "private_network", ip: "192.168.66.15"

  config.vm.synced_folder ".", "/var/www/interstellar", type: "nfs"

  config.vm.provider "parallels" do |v|
      v.name = "interstellar.localhost"
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