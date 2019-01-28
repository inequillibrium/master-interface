# master-interface
A simple Interface to manage Nodes on your Cluster and get more information about them.

## What is this?

The Webinterface offers a clean way to manage your cluster and you get some useful information about instances running & nodes usage.
For detailed information about the Load Balancer, please read this README.

### Installation

1. Prerequisites:
    1. Webserver with PHP 7.1
2. Installation:
    1. clone the Repository into your web-root: `git clone https://github.com/bennetgallein/TS3AB-BalancerDashboard`
    2. if you want, rename the Directory to be served by default.
    3. `cd` into the folder.
    4. run `composer install && composer dump-autoload -o`
    5. copy the `config.json.example` file to `config.json` and edit the required fields
    6. if you are not using the Interface on the Balancer/Router, you have to edit the MongoDB fields to (not recommended)
    7. Start your Browser and navigate to the IP. 

### Thanks to
MongoDB for their Driver: `https://github.com/mongodb/mongo-php-library`<br>
codecalm for the Frontend: `https://github.com/tabler/tabler`

### Issues
Issues and Pull Request are open and welcome. If you face any issues try to comment them as detailed as possible to everyone understands them.

### License
This Project is released under the GPL-3.0: [LICENSE](LICENSE.md)
