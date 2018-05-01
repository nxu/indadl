indadl
======
Indavideo downloader, the second attempt.

Usage
------
You can either visit [https://indavideo.nxu.hu](https://indavideo.nxu.hu) or use the provided API. Please be nice.

License
-------
Licensed under GNU GPLv3.
 
Changelog
---------
#### 2018-05-01
- Add download attribute to the download button

#### 2018-04-19
- Add support for multiple resolutions
- Refactor Indavideo response parsing and output formatting
- Add back (reset) button

#### 2017-08-31
- Complete rewrite in Laravel. Very new design and backend code.

#### 2016-11-14
- Add file token to the retrieved URL to avoid 403 errors

#### 2016-01-31
- Now automatically adds `http://` to the URL if not already set
- Better pattern for validaint URLs (no more need to strip query strings)
- Download is now triggered with an ENTER keypress
- Updated user agent
- Updated CURL code
- Added back button
- Renamed main script do `downloader.php`

Site layout
-----------
I've also published the layout and JS of the original site found at https://indavideo.nxu.hu/. The same license is applied to it, feel free to reuse.
