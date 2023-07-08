# BibleBuddy
A helpful Wordpress plugin that automatically adds a helpful popup to any Bible verses you type in your posts that displays the verse. <br />

![image](https://github.com/jtgraham38/BibleBuddy/assets/88167136/c0325090-f01e-4a57-af69-fc4cd61250f7) <br />

**Setup and Configuration** <br />
![image](https://github.com/jtgraham38/BibleBuddy/assets/88167136/a6199348-0c93-4861-b272-6316a0ac3668) <br />
This plugin adds a pop-up to all posts on your blog that contain a _verse reference_.  A _verse reference_ is a simple set of characters that meet a format specified in the plugin settings page.  The _verse reference_
will contain three special tokens: 
- '\B' = book of the Bible
- '\C' = chapter of that book of the bible
- '\V' = verse from that chapter.
Any time a _verse reference_ is found in a post, the plugin will automatically underline it with a dashed line, and it will become clickable.  Upon being clicked, the _verse popup_ will appear.  This is a popup card that
will stick to the _verse reference_ and it will show what that verse actually says.  This is meant to save space and time for the author, so they can reference Bible verses in their posts without making their posts
unnecessarily long and verbose.

There are currently four themes supported in this plugin:
- traditional <br />
![image](https://github.com/jtgraham38/BibleBuddy/assets/88167136/b6d4ef7b-5720-444f-a308-5618049d77b5) <br />
- cool <br />
![image](https://github.com/jtgraham38/BibleBuddy/assets/88167136/d4d32561-9e38-4f96-a727-079784f73c23) <br />
- light <br />
![image](https://github.com/jtgraham38/BibleBuddy/assets/88167136/5f95e7ab-a7b1-4bc1-aae1-5be3de3b5693) <br />
- dark <br />
![image](https://github.com/jtgraham38/BibleBuddy/assets/88167136/ca8e603e-db15-4110-8e25-353c744dd5c8) <br />

**Dependencies and APIs** <br />
Currently, this plugin utilizes the api provided by https://bible-api.com to pull all verses.  As some versions are incomplete, the plugin only supports a selection of the versions offered by the api.  This source is subject
to change in the future! <br />
This plugin was also built using popper.js.  Check that project out here: https://popper.js.org

**Open Source!** <br />
This plugin is offered for free to anyone who wants to add wisdom from the Bible to their posts.  Support and development may or may not continue, but any work anyone can do to improve this plugin to help it accomplish its
purpose of helping spread the word of God would be much appreciated!

**Attention Bloggers** <br />
If you find this plugin useful, and you make posts that implement it, I'd love to see them!  Contact me at https://jacob-t-graham.com/contact with a link to your blog so I can give it a read!
