=== RSS Icon Widget ===
Contributors: brandondove, jeffreyzinn, nateconley
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3497105
Tags: RSS Feed, Feed Icon, Widget, Sidebar
Requires at least: 2.8
Tested up to: 5.0.3
Stable tag: 5.2

== Description ==

We had a client who want to be able to put a link to his rss feed in his sidebar. Oddly enough we didn’t find anything readily available to do that without adding code to his theme files. We decided to create a little widget to handle this functionality. It has the following features and is freely available right here:

1. Customizable link text
2. Customizable link color
3. Selection of Standard Feed Icon (feedicons.com) in six different sizes
4. Enter any feed URL

http://www.youtube.com/watch?v=piDZibMb8NU

We've added a new widget that will dynamically construct the Feed URL for the archive that the user is looking at. This means if a user is looking at the blog home page, the feed will be the main blog feed. However if the user is looking at a specific category, the URL for the feed will be of that specific category. If the user is not visiting an archive page, the widget will not be displayed.

If you have any problems with this widget, please don't hesitate to let us know. If you use the widget and like it, please rate it.

== Installation ==

1. Upload `rss-icon-widget` folder and it's contents to your `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to the "Appearance" section of the WordPress Admin.
4. Click on the "Widgets" sub-navigation.
5. Add the widget from the left on to the sidebar of your choice and rearrange its position to your liking.
6. Configure the widget to your liking.

== Frequently Asked Questions ==

= Widgets? What's a Widget? =

Ok. If you don't see mention of widgets in the WordPress admin, you're not crazy. Most themes utilize the widgets feature of WordPress, but some don't. You'll need to either switch your theme, or find someone who can widgetize your theme for you. If you don't know any widgeteers, let us know and we'll do our best to help you out.

== Changelog ==

= 3.0 =
- Cleaned up code
- Removed legacy (pre-2.8) support
- Added escaping for security purposes
- Added translation support

= 4.0 =
- Added option to open links in a new window (props B.Chamberlain)

= 5.0 =
- Changed widget constructors

= 5.1 =
- Added new Dynamic RSS Icon Widget that dynamically constructs the URL of the feed for the archive that the user is looking at

= 5.2 =
- Removes deprecated functions
- Updates the colorpicker to WordPress' built-in library
- Adds changelog
