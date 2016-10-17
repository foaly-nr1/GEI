Vagrant.require_version ">= 1.7.0"

Vagrant.configure(2) do |config|

  config.vm.define "LAMP" do |machine|

    machine.vm.box = "ubuntu/trusty64"

    # Disable the new default behavior introduced in Vagrant 1.7, to
    # ensure that all Vagrant machines will use the same SSH key pair.
    # See https://github.com/mitchellh/vagrant/issues/5005
    machine.ssh.insert_key = false

    machine.vm.network "private_network", ip: "192.168.33.17"

    machine.vm.hostname = "gei"

    machine.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]

    # Patch for https://github.com/mitchellh/vagrant/issues/6793
    config.vm.provision :shell do |s|
      s.inline = '[[ ! -f $1 ]] || grep -F -q "$2" $1 || sed -i "/__main__/a \\    $2" $1'
      s.args = ['/usr/bin/ansible-galaxy', "if sys.argv == ['/usr/bin/ansible-galaxy', '--help']: sys.argv.insert(1, 'info')"]
    end

    machine.vm.provision :ansible_local do |ansible|
      ansible.verbose = true
      ansible.install = true
      ansible.version = "latest"
      ansible.provisioning_path = "/var/www"
      ansible.playbook = "ansible/playbook.yml"
    end

    machine.vm.provider "virtualbox" do |vb|
      vb.name = "GEI_LAMP"

      vb.memory = "4096"
    end

  end


end
