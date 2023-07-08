<?php
/*
Plugin Name: Bible Buddy
Plugin URI: https://jacob-t-graham.com/projects
Description: This plugin automatically displays a helpful popup next to any Bible verse reference you enter in your posts.
Version: 1.0.0
Author: Jacob Graham
Author URI: https://jacob-t-graham.com/
Text Domain: bible-buddy
*/

// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// define plugin controller
class Bible_Buddy
{
    // Constructor.
    public function __construct()
    {
        // enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_resources'));

        // add triggers to tokens based on regular expression
        add_filter('the_content', array($this, 'add_verse_triggers'));

        // add a card to the end of each post
        add_filter('the_content', array($this, 'add_verse_card'));
        
        // set up plugin settings
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'settings_init'));
    }

    // enqueue scripts and styles
    public function enqueue_resources()
    {
        //holds info about the current post
        global $post;

        // enqueue the scripts and styles to make the verse card work
        if (is_single()) { // check if it is a post
            //only include the scripts if a verse format match is found in the post
            if (preg_match($this->verse_regex()['regex'], get_the_content($post->ID))) {
                wp_enqueue_style( 'verse_card_style', plugin_dir_url(__FILE__) . 'assets/css/verse_card_style.css');

                wp_register_script('popperjs', 'https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js', array(), '2.11.8', true);
                wp_enqueue_script('popperjs');
                wp_enqueue_script('verse_card', plugin_dir_url(__FILE__) . 'assets/js/verse_card_autoposition.js', array('popperjs'), '', true);
                wp_enqueue_script('verse_functions', plugin_dir_url(__FILE__) . 'assets/js/verse_functions.js', array('verse_card'), '', true);
                
                
                //wp_enqueue_script('verse_card', plugin_dir_url(__FILE__) . 'assets/js/verse_card.js', array('verse_functions'), '', true);
            }
        }
    }

    // add verse pop-up links to post bodies
    public function add_verse_triggers($body)
    {
        if (is_single() && in_the_loop() && is_main_query()){
            //get the regex and locations of verse and chapter
            $res = $this->verse_regex();
            $regex = $res['regex'];
            $chapter_idx = $res['chapter_idx'];
            $verse_idx = $res['verse_idx'];

            // books of bible
            $books = ["Genesis","Exodus", "Leviticus","Numbers","Deuteronomy","Joshua","Judges","Ruth","1 Samuel","2 Samuel","1 Kings","2 Kings","1 Chronicles","2 Chronicles","Ezra","Nehemiah","Esther","Job","Psalms","Proverbs","Ecclesiastes","Song of Solomon","Isaiah","Jeremiah","Lamentations","Ezekiel","Daniel","Hosea","Joel","Amos","Obadiah","Jonah","Micah","Nahum","Habakkuk","Zephaniah","Haggai","Zechariah","Malachi","Matthew","Mark","Luke","John","Acts","Romans","1 Corinthians","2 Corinthians","Galatians","Ephesians","Philippians","Colossians","1 Thessalonians","2 Thessalonians","1 Timothy","2 Timothy","Titus","Philemon","Hebrews","James","1 Peter","2 Peter","1 John","2 John","3 John","Jude","Revelation"];
            $books_impl = '(' . implode('|', $books) . ')';

            //use the regex to wrap the verse references in the appropriate markup
            $body = preg_replace_callback($regex, function($refs) use ($books_impl, $chapter_idx, $verse_idx){
                
                //surround each reference in a trigger span
                return '<span class="verse_card_trigger" data-b_book="' . $refs[1] . '" data-b_chapter="' . $refs[$chapter_idx] . '" data-b_verse="' . $refs[$verse_idx]. '">' . $refs[0] . '</span>';
            }, $body);

        }

        return $body;
    }

    // add a verse card to the end of post bodies
    public function add_verse_card($body)
    {
        if (is_single() && in_the_loop() && is_main_query()){
            if (preg_match($this->verse_regex()['regex'], $body)){
                $verse_card_html = file_get_contents( plugin_dir_path( __FILE__ ) . 'elements/verse_card.php' );
                $verse_card_html = preg_replace('/123THEME456/u', esc_attr(get_option('theme', 'traditional')), $verse_card_html);
                $body .= $verse_card_html;
            }
        }
        return $body;
    }

    public function verse_regex(){
        // get format for verses to be matched
        $format = trim(esc_attr(get_option('format', '\B \C:\V')));

        // books of bible
        $books = ["Genesis","Exodus", "Leviticus","Numbers","Deuteronomy","Joshua","Judges","Ruth","1 Samuel","2 Samuel","1 Kings","2 Kings","1 Chronicles","2 Chronicles","Ezra","Nehemiah","Esther","Job","Psalms","Proverbs","Ecclesiastes","Song of Solomon","Isaiah","Jeremiah","Lamentations","Ezekiel","Daniel","Hosea","Joel","Amos","Obadiah","Jonah","Micah","Nahum","Habakkuk","Zephaniah","Haggai","Zechariah","Malachi","Matthew","Mark","Luke","John","Acts","Romans","1 Corinthians","2 Corinthians","Galatians","Ephesians","Philippians","Colossians","1 Thessalonians","2 Thessalonians","1 Timothy","2 Timothy","Titus","Philemon","Hebrews","James","1 Peter","2 Peter","1 John","2 John","3 John","Jude","Revelation"];
        $books_impl = '(' . implode('|', $books) . ')';
        // generate a regex based on the format, and save book, chapter, and verse
        $regex = '/';
        $found_num = false;
        $chapter_first = 1;
        for ($i = 0; $i < strlen($format); $i++)
        {
            $char = $format[$i];
            
            switch ($char)
            {
                case '\\':
                    if ($i+1 < strlen($format))
                        switch ($format[$i+1]){
                            case 'B':
                                $regex .= $books_impl;
                                break;
                            case 'C':
                                $regex .= '(\d+-\d+|\d+)';
                                if (!$found_num){
                                    $found_num = true;
                                }
                                break;
                            case 'V':
                                $regex .= '(\d+-\d+|\d+)';
                                if (!$found_num){
                                    $chapter_first = 0;
                                    $found_num = true;
                                }
                                break;
                        }
                        $i=$i+1;
                        break;
                default:
                    $regex .= $char;
                    break;
            }
        }
        $regex .= '/u';

        //assemble return array
        $arr = [
            'regex' => $regex,
            'verse_idx' => 2 + ($chapter_first),
            'chapter_idx' => 2 + (1 - $chapter_first)
        ];
        return $arr;
    }

    //add plugin settings page
    public function add_settings_page()
    {
        // add the settings page
        add_menu_page(
            'Bible Buddy Settings',
            'Bible Buddy',
            'manage_options',
            'bible-buddy-settings',
            function(){
                require_once plugin_dir_path(__FILE__) . 'elements/bible_buddy_settings.php';
            },
            'dashicons-book'
        );
    }

    //initialize plugin settings
    public function settings_init(){
        // create section for settings
        add_settings_section(
            'bible_buddy_settings',
            '',
            function(){
                echo 'Configure reference format and theme for Bible Buddy!';
            },
            'bible-buddy-settings'
        );

        // create the settings fields
        add_settings_field(
            'bible_buddy_theme',
            'Theme:',
            function(){
                require_once plugin_dir_path(__FILE__) . 'elements/theme_select_option.php';
            },
            'bible-buddy-settings',
            'bible_buddy_settings'
        );

        add_settings_field(
            'bible_buddy_format',
            'Verse Format:',
            function(){
                require_once plugin_dir_path(__FILE__) . 'elements/verse_format_text_option.php';
            },
            'bible-buddy-settings',
            'bible_buddy_settings'
        );

        // create the settings themselves
        register_setting(
            'bible_buddy_settings',
            'theme',
            array(
                'traditional'
            )
        );

        register_setting(
            'bible_buddy_settings',
            'format',
            array(
                'B C:V'
            )
        );
    }
}

$plugin = new Bible_Buddy();

?>