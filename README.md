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

Miscellaneous Quirks to Watch For
---------------------------------

These quirks could probably be fixed if I dropped more browser support,
had more time, or were a better web developer, but for now, they stand.

- The navigation bar **only** works with one row. Otherwise, the positioning within it screws up and even though the items don't show they kind of ghost.
- The footer links looks far better with only one row. It'll handle two rows fine, but I would recommend reducing the number of items on that menu.
