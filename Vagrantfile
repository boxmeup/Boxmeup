# encoding: utf-8
# This file originally created at http://rove.io/cfd19e3baf8e45889ef5ca4056fe7560

# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "trusty64"
  config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/trusty/current/trusty-server-cloudimg-amd64-vagrant-disk1.box"
  config.vm.network :private_network, ip: "33.33.0.80"
  config.vm.hostname = "boxmeup.dev"
  config.ssh.forward_agent = true
  config.omnibus.chef_version = "12.3.0"
  config.vm.provider :virtualbox do |vb|
    vb.name = "Boxmeup Dev"
    vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/graph", "1"]
  end

  # Workaround for a bug in sync folder caching in vagrant 1.7.2
  config.trigger.before [:reload, :up, :provision], stdout: true do
    SYNCED_FOLDER = ".vagrant/machines/default/virtualbox/synced_folders"
    info "Deleting cached synced folder reference."
    begin
      File.delete(SYNCED_FOLDER)
    rescue Exception => ex
      warn "Could not delete folder #{SYNCED_FOLDER}."
      warn ex.message
    end
  end

  config.vm.provision :chef_solo do |chef|
    chef.cookbooks_path = ["cookbooks", "site-cookbooks"]
    chef.add_recipe :apt
    chef.add_recipe 'vim'
    chef.add_recipe 'nginx'
    chef.add_recipe 'mysql::client'
    chef.add_recipe 'mysql::server'
    chef.add_recipe 'php-fpm'
    chef.add_recipe 'sphinx'
    chef.add_recipe 'boxmeup::nginx'
    chef.add_recipe 'boxmeup::php'
    chef.json = {
      "mysql" => {
        "server_root_password" => "root",
        "server_repl_password" => "root",
        "server_debian_password" => "root",
        "bind_address" => "33.33.0.80",
        "allow_remote_root" => true
      }
    }
  end
end
