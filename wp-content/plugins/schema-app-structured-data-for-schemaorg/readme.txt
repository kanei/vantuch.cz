=== Schema App Structured Data ===
Contributors: vberkel
Plugin Name: Schema App Structured Data
Tags: schema, structured data, schema.org, rich snippets
Author URI: https://www.hunchmanifest.com
Author: Mark van Berkel (vberkel)
Requires at least: 3.5
Tested up to: 4.6
Stable tag: 1.1.4
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get Schema.org structured data for all pages, posts, category and profile pages on activation. Use Schema App to customize any schema.org markup. 

== Description ==
This plugin, working with the [Schema App Tools](https://www.schemaapp.com) makes doing structured data easy. 

By default, the Schema App Plugin optimizes all your pages, posts, author pages and more using information that already exists on your Wordpress website.  All you have to do is do the basic setup and then the optimiation is done for you.  The plugin also optimizes your pages for [Accelerated Mobile Page](https://www.ampproject.org/) (AMP), a project from Google and Twitter designed to make really fast mobile pages.

Want to optimize your entire site? The [Schema App JSON-LD Markup Generator](https://www.schemaapp.com/schema-org-json-ld-markup-generator/) allows you to add additional schema.org markup to your Wordpress site without having to be a structured data expert. Now you can optimize your homepage with your business information, your about page with information about the people at your company, services you sell, events, job postings, etc. If there is something strategic on your site you want Google to know about, you can optimize it with Schema App JSON-LD Markup Generator.

Schema App JSON-LD Markup Generator has the entire Schema.org vocabulary and automates validation of inputs, and creation/deployment of schema.org code. You don't need a developer to use our tools and you can update your markup anytime without having to do re-work.

Manage multiple sites? [Schema App](https://www.schemaapp.com) also allows you to manage markup across domains, making it easy to scale your schema.org deployments and manage them easily. If you want to add structured data to your WordPress website in the most productive and smart way, you have found it!

> <strong>Premium Features</strong><br>
> Schema App has a freemium pricing model. Advanced features like Validation, Crawler & Reporting are available with [Schema App Pro and Agency](http://www.schemaapp.com/product-pricing/) accounts. 
> 
> <strong>Schema App WooCommerce</strong><br>
> An ecommerce add-on [Schema App WooCommerce](https://www.schemaapp.com/product/schema-app-woocommerce/) integrates with this Schema App plugin. This add-on plugin is the most comprehensive Schema.org plugin for WooCommerce, doubling the structured data available to search engines.
> 
> <strong>Premium Support</strong><br>
> Want some help to get all the benefits of structured data on a small website but don’t need a Pro account? Buy the [Premium Support package](http://www.schemaapp.com/product-pricing/#premium-support) so that you get direct (email) access to our professional support team who will answer all your questions related to implementing Schema App.
> 
> We know that Structured Data and Schema.org can be a bit overwhelming, so don’t hesitate to ask our support team if you don’t understand how to achieve your desired results. Our support is made up of semantic search experts so know that you’re going to get great support.

= Baseline Schema.org Markup =
Just by installing the plugin you will get the schema.org AMP compliant markup for the all your page and post content. Page types such as Search, Author and Category also get default markup. 

* Page : http://schema.org/Article
* Post : http://schema.org/BlogPosting
* Search : http://search.org/SearchResultsPage
* Author : http://schema.org/ProfilePage
* Category : http://schema.org/CollectionPage
* Blog : http://schema.org/Blog

= Schema App Enabled Features =
Extend your schema.org structured data to speak to Google's many advanced search features with your Wordpress site using [Schema App](http://www.schemaapp.com). Common features include:

* Customize Knowledge Graph (Logo, Corporate Contacts, Social Profile Links)
* Event Promotion (for Performers, Venues, Ticketers)
* Actions (Music Play, Movie Watch, Promote Critic Reviews)
* Content Carousels (Live Blogs)
* Rich Snippets (Products, Reviews, Recipe, Events, Articles, Videos)
* Local Business (Place Actions, e.g. Reservation, Order)
* Style Search Results (Breadcrumbs, Sitelinks Search Box, Show Name in Search)

== Installation ==

Installation is straightforward

1. Upload hunch-schema to the /wp-content/plugins/ directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Configure AMP publisher settings for Plugin in Wordpress under Settings>Schema App
1. For greater organic search results [register with Schema App](https://hunchmanifest.leadpages.co/leadbox/143ff4a73f72a2%3A1601ca700346dc/5764878782431232/) to extend your content structured data. 
1. Add the Account ID to WP Admin > Settings > Schema App from the registration email and found at http://app.schemaapp.com/wordpress

== Frequently Asked Questions ==
You\'ll find the [FAQ on SchemaApp.com] (http://www.schemaapp.com/wordpress/faq/).

== Screenshots ==
1. Schema App Tools Admin
2. Settings Menu Navigation
3. Schema.org Page Meta Box
4. Schema.org Editor UI
5. Link to Validation

== Changelog ==
= 1.1.4 = 
- Fix, Show Custom Markup for Latest Blog Homepages

= 1.1.3 = 
- Fix, Author details on Post edit screen
- Fix, Loading of assets on plugin settings page for SSL site
- Fix, jQuery conflict on Post edit screen
- Feature, Added link in Toolbar to test markup

= 1.1.2 = 
- Fix, Javascript version to force reload

= 1.1.1 = 
- Fix, Add to Default Markup button

= 1.1.0 = 
- Feature, extend posts and page markup
- Documentation, improve setup page instructions and descriptions

= 1.0.0 = 
- Feature, Pages option for more specific types
- Feature, Disable markup option
- Feature, Author's ProfilePage improvement
- Feature, Add 10 comments, total commentCount to blogPosting, Blog and Category pages
- Feature, BlogPosting add keywords using tags
- Feature, Add the Blog page as type schema.org/Blog

= 0.5.9 = 
- Feature, Default markup if no featured image set add first image in content
- Fix, Publisher logo fallback markup
- Fix, Canonical URL check with get_permalink

= 0.5.8 = 
- Fix, Improve Category (CollectionPage) data
- Documentation, Improve Quick Guide and Settings instructions

= 0.5.7 = 
- Fix, Publisher image dimensions
- Fix, Author name for Pages
- Fix, API results filter null

= 0.5.6 = 
- Feature, Rename menu item 'Schema Settings' as 'Schema App'
- Feature, Admin Settings redesign as tabs
- Feature, Tab for Quick Guide
- Feature, License Tab for enabling WooCommerce plugin extension

= 0.5.5 = 
- Fix, Setting Publisher Image Upload
- Feature, Add Admin Notices
- Security, Prevent scripts being accessed directly

= 0.5.4 = 
- Fix for Publisher Logo Upload

= 0.5.3 = 
- Fix Editor JSON-LD Preview

= 0.5.2 = 
- Timeout after 5 seconds
- Tested up to WP 4.4.1

= 0.5.1 = 
- Suppress Warning when no content found

= 0.5.0 = 
- Extend Page and Post Markup for Accelerated Mobile Pages

= 0.4.4 = 
- Plugin Description Update
- Fix Meta Box Update (Create) Link

= 0.4.3 = 
- Fix Meta Box Update Link

= 0.4.2 = 
- Fix Category page error

= 0.4.1 = 
- Fix PHP Warning from empty Graph ID

= 0.4.0 = 
- Add Author, Category and Search page types
- Show formatted and default markup in Meta Box
- Change date formats to ISO8601
- Code refactoring
- Add Banner and Icon

= 0.3.3 = 
- Fixes to getResource routine

= 0.3.2 = 
- Fix PHP warning

= 0.3.1 = 
- Fix server file_get_contents warning

= 0.3.0 =
- When no data found in Schema App, add some default page and post structured data

= 0.2.0 =
- Add Post and Page Edit meta box
- Server does caching, switch from Javascript to PHP API to retrieve data for header

= 0.1.0 =
- First version 