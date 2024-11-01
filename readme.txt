=== Plugin Name ===
Contributors: jondor
Donate link: http://plugins.funsite.eu/simplevote/
Tags: score,page,vote
Requires at least: 3.0.1
Tested up to: 4.7
Stable tag: 1.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simplevote implements a simple "hot or not" style voting for pages and posts.

== Description ==

Simplevote implements an widget with a simple "hot or not" style voting for pages and posts. I wrote it in the hope to generate a little more feedback
on my photography.

Scores are shown directly after voting. The admin can see the resulting scores in their own columns in the posts/pages overview and on the seperate post/page editpage.

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add the widget to a widgetarea. You can edit the hot/not texts/

== Frequently Asked Questions ==

= Why did you write this widget? =
I couldn't really find what I was looking for.

= Why only javascript =
Well, where I don't make a point out of multiple votes, even the basic reload page protection doesn't work when voting through an url. That is,
I couldn't sort out the session stuff which would be needed yet. So that's for an update.

== Screenshots ==

1. Widget as presented to the user (using Alizee theme in this case)
2. The widget settings
3. The column in the post/page overview

== Changelog ==
= 1.7 =
Some changes to the basic_plugin_class which, regretfully, isn't allowed to have it's own plugin anymore.

= 1.6 =
Fixes for WP 4.3

= 1.5 =
Fixes in the basic_class. Please update to prevent collisions with my
otherplugins if you install them.

= 1.4 =
Hmm.. Weird.. nothing for 1.3..  Sorry..
Changed the score column back to nummeric values. It shows the score. Go over it with the mouse and you will see the + and - votes in the mouseover.
Did some recoding again to standarize some of the code and stuff I use.
You might notice an "funsite" page in the settings menu. The idea is that all my plugins add themselfs on this page instead of adding settings and
info pages for themselfs. Just to simplify things. Reactions are welcome.

= 1.2 =
Code cleanup
Added a metabox with the current score to the page/post pages.
simplified the post/page column with scores. See the screenshots for the new form.

= 1.1 =
Since this is a fairly simple plugin I used it to sort out translating plugins. For now there's an extra dutch translation.
Other languages are appriciated. I used the "CodeStyling Localization" for my translation and it worked like a dream.

= 1.0 =
* First release

== Upgrade Notice ==

