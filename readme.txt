=== Bible Buddy ===
Contributors: jtgraham38
Donate link: https://www.paypal.com/donate?token=H4r-2z2I2p-76k9n6dWm6zF1H8_DKPUIIne_6g1mwe72rTGpmx4ULSD8a5p_JHog70czN-MyDcGlJ2WM
Tags: bible-buddy, bible, christian, theology, kjv, vulgate
Requires at least: 4.7
Tested up to: 6.2.2
Stable tag: 1.0.0
Requires PHP: 7.0
License: Apache License, Version 2.0
License URI: https://apache.org/licenses/LICENSE-2.0
A helpful Wordpress plugin that automatically adds a helpful popup to any Bible verses you type in your posts that displays the verse.

== Description ==
This plugin helps theologians, churches, and any online authors who want to share God's word in their posts do so in a more concise, user-friedly way.
Whenever you add a verse reference to your post (ex. Genesis 1:1), this plugin will automatically add a clickable link to it.  When clicked, that link 
will open a popup that displays the actual contents of that verse.  This plugin helps increase the visual appeal of your posts while also making them
quicker to write!  This plugin has four color themes (traditional, cool, light, and dark), four languages, six versions (including the Latin Vulgate!), a custom verse 
format specifier (so you can determine how your verse references should look, ex. Genesis 1:1 vs Genesis ch. 1 v. 1), and much more.

== Installation ==
1. Upload the plugin folder to your /wp-content/plugins/ folder.
1. Go to the **Plugins** page and activate the plugin.

== Frequently Asked Questions ==
= How do change the color of the verse popup? =
After activating the plugin, open the plugin details (menu page with a book on it).  This will open the plugin settings.  Then, simply select a theme
from the "Theme" dropdown, and click the save changes button.  Now, your popup should change color according to the theme you selected.

= How do I make verses in my post display the popup when clicked? =
After activating the plugin, open the plugin details (menu page with a book on it).  This will open the plugin settings.  Then, click into the "Verse Format"
text box.  Notice the tooltip that shares what the three special tokens mean.  Based on the format you write verses in, enter the appropriate phrase in the box.
For instance, if you want the popup to appear for verses following the format "Genesis 1:1", enter "\B \C:\V".  Click the save changes button.  
Now, your verse references should trigger the popup upon being clicked.

= Why are my verse references not able to make the popup appear? =
Ensure you have entered your regular expression incorrectly.  Watch out for whitespace characters!  Any small innaccuracy will cause the links to not generate in 
the post.

= Are multiple verse formats supported? =
No, at this time, only one site-wide verse format is supported.

== Changelog ==
= 1.0 =
* Plugin released. 