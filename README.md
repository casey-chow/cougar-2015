Cougar 2013
===========

So named because I just gave up giving creative names to these themes.

CSS Naming Convention
---------------------

Pseudo BEM, SMACSS or whatever. Anyway.

**Block**: Unit of structure. Named as name of block.  
**Element**: Unit of HTML. Named as `block__element`.  
**Modifier**: Unit of state. Named as `block__element-modifier-state`.  
**Page**: For page specific CSS. Named as `page--block__element`.  

Yoast Breadcrumbs Recommended Configuration
-------------------------------------------
**Separator between breadcrumbs**: &lt;Space&gt;
**Anchor text for the Homepage**: `Home`  
**Prefix for the breadcrumbs path**: &lt;leave blank&gt;  
**Prefix for Archive breadcrumbs**: `Archives`  
**Prefix for Search Page breadcrumbs**: `Search`  

Galleries
------------

There are two types of galleries in this theme: the mosaic and the slider.

The mosaic is based off of Jetpack's mosaic functionality and thus requires Jetpack, 
or preferably Slim Jetpack. Simply use the `[gallery]` shortcode as always for this.
This gallery is recommended for a large amount of photos

The slider gallery uses a carousel instead to display photos. Simple use the
shortcode `[cougar-gallery]`. The attributes for the shortcode are as follows:

`script`: the script to use (currently only [Nivo Slider][nivo], but you never know)  
`ids`: a list of image attachment ids (this allows you to use Wordpress's build in gallery selector and then just rename the shortcode)
`theme`: the nivo slider theme (`default` and `light` are installed)

[nivo]: http://dev7studios.com/nivo-slider/#/features

### Front Page Gallery

On the front page gallery, things correspond a bit differently than what the attachment says.

`caption`: Still the caption, but it accepts HTML, specifically `<h1>`.
`description`: If the description is a URL, it'll automatically link to the picture.

Front Page Configuration
------------------------------------

### Events

Go into Google Calendar events and create a new feed with the following specs: 

**Date Format**: `M jS`
**Event Display Builder**:

```html
<a href="[url]" target="_blank">
<h2 class="event__title">[event-title]</h2>
<p class="event__date">[start-date] to [end-date]</p>
[if-location]<p class="event__location">[location]</p>[/if-location]
<span class="event__followthrough">View Event</span>
</a>
```

Place a Google Calendar Events widget under the `Front Events Section` widget with
the corresponding feed number above. **Make sure a limit of 4 events is set on the widget.**

### Home Page

The information section of the front page simply prints out the content of the 
front page.


```html
<p>Cougar Robotics (Team 1403) is a FIRST Robotics team based in Montgomery High
School in Skillman, NJ. Since 2004 we’ve been demonstrating the importance of
the STEM disciplines.</p>

<ul class="block-grid three-up info__grid">
<li><a href="#"><h3>Our Team</h3><img src="http://placehold.it/320x220"></a></li>
<li><a href="#"><h3>FIRST</h3><img src="http://placehold.it/320x220"></a></li>
<li><a href="#"><h3>Sponsors</h3><img src="http://placehold.it/320x220"></a></li>
<li><a href="#"><h3>The Game</h3><img src="http://placehold.it/320x220"></a></li>
<li><a href="#"><h3>Resources</h3><img src="http://placehold.it/320x220"></a></li>
<li><a href="#"><h3>Madness</h3><img src="http://placehold.it/320x220"></a></li>
</ul>
```

Miscellaneous Quirks to Watch For
---------------------------------

These quirks could probably be fixed if I dropped more browser support,
had more time, or were a better web developer, but for now, they stand.

- The navigation bar **only** works with one row. Otherwise, the positioning within it screws up and even though the items don't show they kind of ghost.
- The footer links looks far better with only one row. It'll handle two rows fine, but I would recommend reducing the number of items on that menu.
- The BJ Lazy Load plugin works great, but its "Responsive Image" feature
  does not. When using the plugin, ensure that this feature is disabled.
- To hide the section nav, add custom field called `hide_section_nav` and set
  it to `1`.
