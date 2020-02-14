WooCommerce PCN OrderSync
==========================

License: MIT

This plugin is provided as is and without warranties.
Feel free to fork this plugin and modify it to suit your needs.

_**Do not redistribute or use the version from this repository for monetary gains!**_

# Description

This plugin is used for WooCommerce to keep your orders synchronized with PCN/PakkecenterNord order status (http://pakkecenternord.dk). 

**> Check for updates every 5 minute**

This module will with your PCN informations check every 5 minute if PCN has handled any of your orders and if so change the status picked in the settings page.

<small>NOTE; This plugin requires WooCommerce and PCN StockSync</small>

# Installation

**> Installing using folder structure**

Download the folder "coolrunner-pcn-ordersync" and inside your Wordpress solution upload it to wp-content/plugins, then it should be installed by itself.

**> Installing using pre-packaged version**

Use the pre-packaged version: [woocommerce_pcn_ordersync.zip](https://github.com/CoolRunner-dk/woocommerce-pcn-ordersync/raw/master/woocommerce_pcn_ordersync.zip)

Go to your Wordpress website (with woocommerce enabled) and go to "Plugins -> Add New -> Upload Plugin" and select the zip-archive you've packaged or downloaded containing the plugin.

Once the archive has been selected click "Install Now". Activate the plugin and set it up.

# Settings

![Image of the plugin - Coolrunner](https://i.imgur.com/mffhXT9.png)

Within Woocommerce > Settings > "PCN OrderSync - Settings" you will need to insert which status you want the order to have when it should check against PCN, and then you have to select the status wanted if PCN have packed the order.

<small>NOTE: The packaged version may not be the latest version depending on the updates being pushed. Please keep this in mind</small>
