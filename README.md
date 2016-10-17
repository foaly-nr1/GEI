# Golden Eagle CRM

## Requirements

1. [Download Vagrant](https://www.vagrantup.com/downloads.html) and install.
2. [Download VirtualBox](https://www.virtualbox.org/wiki/Downloads) and install.

## Installation

Open a command console, enter the directory where you cloned this repository and execute the following command to start the server:

``` bash
vagrant up
```

Then add the IP on which the Golden Eagle CRM server is accessible to your hosts file (**might differ if not on OS X**):

``` bash
echo '192.168.33.32   golden-eagle.dev' | sudo tee -a /etc/hosts > /dev/null
```

## Usage

You can now access the Golden Eagle CRM server on `https://golden-eagle.dev`.

#### Start your server

``` bash
vagrant up
```

#### Pause your server

You should do this before shutting down your computer.

``` bash
vagrant suspend
```

#### Resume your server

``` bash
vagrant up
```

#### Delete your server

``` bash
vagrant destroy
```

#### SSH into your server

``` bash
vagrant ssh
```
