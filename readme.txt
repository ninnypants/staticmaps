=== Static Maps ===
Contributors: ninnypants
Donate link: https://ninnypants.com/plugins/
Tags: maps, google maps, static maps
Requires at least: 3.0
Tested up to: 4.4
Stable tag: 0.1.0
License: GPLv2

Use shortcodes to easily generate Google static maps with markers.

== Description ==

Maps on most sites use the Google's iFrame or javascript apis when all they need is a simple map with a few markers. This can cause a decent amount of frustration for users of your site with long load times and scroll capturing. This plugin allows you to avoid all that by using the [static maps api](https://developers.google.com/maps/documentation/static-maps/intro) that is also provided by Google.

Static Maps provides a set of shortcodes that allow you to build static map images without having to build the urls yourself.

### Shortcodes

#### map
The map shortcode provides the base that the rest of the short codes work in.

##### Parameters
* `center` default `Provo, UT` defines the center of the map, equidistant from all edges of the map. This parameter takes a location as either a comma-separated {latitude,longitude} pair (e.g. "40.714728,-73.998672") or a string address (e.g. "city hall, new york, ny") identifying a unique location on the face of the earth.
* `zoom` default `12` defines the zoom level of the map, which determines the magnification level of the map. This parameter takes a numerical value corresponding to the zoom level of the region desired.
* `width` default `500` Width in pixels of the map image.
* `height` default `400` Height in pixels of the map image.
* `scale` default `1` pixel density of the generated image for display on retina screens. Available sizes are 1 and 2. Google also supports a scale of 4 with an api key, but that isn't supported currently.
* `format` default `png` Format of the returned image. Acceptable parameters are `png`, `gif`, `jpg`, and `jpg-baseline`. [View more information on image formats.](https://developers.google.com/maps/documentation/static-maps/intro#ImageFormats)
* `maptype` default `roadmap` Type of map used to make the image. Available parameters `roadmap`, `satellite`, `hybrid`, and `terrain`. [View more information on the maptypes.](https://developers.google.com/maps/documentation/static-maps/intro#MapTypes)
* `language` defines the language to use for display of labels on map tiles. No details on format provided by Google.
* `region` defines the appropriate borders to display, based on geo-political sensitivities. Accepts a region code specified as a two-character ccTLD ('top-level domain') value.

#### marker
The marker shortcode allows custom styling of the contained locations.

##### Parameters
* `color` default `red` color of the marker when it is displayed. Color can take a hex value or one of these color names `black`, `brown`, `green`, `purple`, `yellow`, `blue`, `gray`, `orange`, `red`, and `white`.
* `size` default `normal` Size of the marker. Available sizes are `tiny`, `med`, `small`, and `normal`. `normal` and `mid` are the only sizes that will display a label.
* `label` single uppercase character that displays on the marker. The default label is a bullet.

#### location
The location shortcode only uses it's content there are no parameters. Input either longitude and latitude or an address into the content of `[label]` and a marker will be shown in that location.

== Installation ==

1. Upload plugin directory to `/wp-content/plugins`
1. Activate in the Plugins section of the admin.
1. Enjoy

== Changelog ==

= 0.1.0 =
* Initial Release
