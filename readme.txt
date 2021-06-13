=== Embed Calendly Scheduling ===
Contributors: turn2honey
Donate link: https://flutterwave.com/pay/spantuskqg2
Tags: appointment, appointment booking, appointment scheduling, booking calendar
Requires at least: 4.0
Tested up to: 5.7
Stable tag: 5.7
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple and cleaner way to embed Calendly scheduling on WordPress.

== Description ==

Embed Calendly scheduling on your WordPress website in a cleaner and simpler way. Schedule meetings easily on your WordPress website through Calendly.

== Features ==

1. Supports inline, text popup and button popup embed.
2. Customize embed form, link and button. 

== Shortcode ==

Embed scheduling form with default options using:

`
[calendly type=3 url=https://calendly.com/example/call]
`


== Customization == 

You can customize the booking form with the following shortcode options:

*   `type` - Embed form type. 1 - inline embed, 2 - popup button embed, 3 - popup text embed

*   `url` - Scheduling link

*   `text` - Button/Link text

*   `button_color` - Button color. Any hexadecimal color code is supported here

*   `text_color` - Text color

*   `branding` - true/false. Show or hide branding

*   `hide_details` - true/false. Hide or show details

*   `style_class` - CSS style name for customizing the embed form/button


== Example ==

`[calendly type=3 url=https://calendly.com/example/call text="Book us now" button_color=#444444 text_color=#000000 branding=false hide_details=false style_class=custom_form_style]`

== Frequently Asked Questions ==

= How do I display scheduling form on my pages? =

Try adding `[calendly type=3 url=https://calendly.com/example/call]` shortcode to any page you want to display the form on.

= How do I style scheduling form? =

Use the `style_class` option when adding the shortcode. Example: [calendly type=1 url=https://calendly.com/example/call style_class=custom_form_style]