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
#### 2020-07-03
- Update Indavideo API parser, use correct referer

#### 2020-05-22
- Update Indavideo API parser (fix non-working URLs)

#### 2020-05-01
- Update Indavideo API parser (fix non-working URLs)
- Bump faked user agent version

#### 2019-12-27
- Use 360p token for all resolutions (tip from bleachhun)
- Add uptime status page link

#### 2019-12-22
- Merge 360p bugfix, courtesy of bleachhun
- Minor refactor

#### 2019-10-16
- Merge HD video fix, courtesy of golddragon007

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
