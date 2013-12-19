TYPO3 extension sf_ttnews_catmenu
=================================

## What is it and what does it do?

If you use the default tt_news category menu with **plugin.tt_news.displayCatMenu.mode = nestedWraps**, you may notice
that category images are not rendered and there is no way to render images in this mode.

This extension uses XCLASS to overwrite the default method for generating the nested category menu. It adds the
category image to the output and uses the TS config **plugin.tt_news.displayCatMenu.catmenuIconFile** for image rendering

To set a wrap around the rendered image, use the TC **config plugin.tt_news.displayCatMenu.catmenuIconWrap**

## Support and updates

The extension is hosted on Github. Please report feedback, bugs and changerequest directly at https://github.com/derhansen/sf_ttnews_catmenu

