# **ORMAPKER** #
**Ormapker** is a wordpress plugin to embbed a multilocations map easily.

## Prerequisites
- You need to have a Google Maps JS API key ([how to get your key](https://developers.google.com/maps/documentation/javascript/get-api-key))

## Installation
1. Download the zip file ([from here](https://github.com/saidgamih/ormapker/archive/refs/heads/master.zip))
2. Install the plugin from wordpress dashboard

## Configuration
After installation the plugin will create a custom post type for you called `marker`, but before start adding new *markers* you should fill the plugin options with the appropriate values.

Click *Ormapker* menu item in your dashboard

The option page has the following fields:

1. `Google Maps API key`: you can find this in your google developer console.
2. `Centre latitude`: the latitude of the central point of your map.
3. `Centre logitude`: the logitude of the central point of your map.
4. `Zoom level`: the zoom of your map.

## Display the map
To display your map you need just to put this shortcode `[ormapker_short_code]` anywhere in your website(theme / pages / widget).