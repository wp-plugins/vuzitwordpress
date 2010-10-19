=== VuzitWordPress ===
Contributors: Brent Matzelle
Tags: vuzit, ajax document, html5 document
Requires at least: N/K
Tested up to: 3.0.1
Stable tag: 1.0.0

Plugin that adds Vuzit AJAX document viewer features into WordPress.

== Description ==

This plugin allows you to very easily embed a Vuzit (http://www.vuzit.com) viewer into a WordPress page.  The document needs to be uploaded to the Vuzit web site first.  Go to the web site to learn more.  The basic syntax is below:

Basic example by ID: 

  [vuzit_viewer id="DOC_ID" pub_key="PUBLIC_KEY" pri_key="SECRET"]

Basic example by URL: 

  [vuzit_viewer url="http://example.com/test.pdf" pub_key="PUBLIC_KEY" pri_key="SECRET"]

== Installation ==

1. Extract all files from the ZIP file, *making sure to keep the file/folder structure intact*, and then upload it to '/wp-content/plugins/'
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

See the Vuzit FAQs for questions:

http://www.vuzit.com/faq

http://www.vuzit.com/api/faq

== Usage ==

In order to add a Vuzit viewer to a post you need to add the proper `[vuzit_viewer]` tag.  All of the parameters you can use are below along with short examples of how to use it.   

= Required Paramters =

One of the two options below are required.  Either you need the "id" which is the special Vuzit ID that you receive after the document is uploaded or the document URL.  

* id: The Vuzit document ID. This or 'url' is required.  
* url: Loads a document by a URL. This or 'id' is required.  
* pub_key: Vuzit account public key. 
* pri_key: Vuzit account private key.  This is not required unless it's a private document.  

= Optional Parameters =

* height: Height of the viewer in pixels. The default is 600.
* width: Width of the viewer in pixels. The default is 400. 
* page: Page of the document to show. The default is page 1. 
* zoom: Zoom level of the document. The default is zoom 0. 
* include: Sets the number of pages that can be previewed in a document. 
* watermark: The watermark that will show up on a document. 

= Examples =

In the examples below substitute your DOC_ID with your document's ID, PUBLIC_KEY for your account public key and SECRET for your private key.  

Basic example by ID: 

  [vuzit_viewer id="DOC_ID" pub_key="PUBLIC_KEY" pri_key="SECRET"]

Basic example by URL: 

  [vuzit_viewer url="http://example.com/test.pdf" pub_key="PUBLIC_KEY" pri_key="SECRET"]

Set the width and height: 

  [vuzit_viewer id="DOC_ID" pub_key="PUBLIC_KEY" pri_key="SECRET" height="600" width="400"]

Show a document starting on page 9 (pages start at index 0 so 8 is page 9): 

  [vuzit_viewer id="DOC_ID" pub_key="PUBLIC_KEY" pri_key="SECRET" page="8"]

Only show pages 5 - 10: 

  [vuzit_viewer id="DOC_ID" pub_key="PUBLIC_KEY" pri_key="SECRET" include="4-9"]

Show a watermark of "John Smith": 

  [vuzit_viewer id="DOC_ID" pub_key="PUBLIC_KEY" pri_key="SECRET" watermark="John Smith"]

== Changelog ==

= 1.0.0 =
* First public release.  All basic document viewer code is included.  

