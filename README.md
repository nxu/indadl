indadl
======

A very simple and lightweight Indavideo downloader service written in PHP. Needs cURL to be allowed and configured properly (will not run on most free webhosts).

Usage
------
1. Send a `GET` request to `downloader.php` with one parameter, `url`.
2. The response is a JSON encoded object with the following format:

In case of error (please bear with me, error messages are in Hungarian): 
```
{ 
  'success': false, 
  'message': 'Error message'
}
```

If successful:
```
{
  'success'  : true,
  'video_url': 'http://video.url'
}
```

License
-------
Licensed under GNU GPLv3

Changelog
---------

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
I've also published the layout and JS of the original site found at https://nxu.hu/indavideo. The same license is applied to it, feel free to reuse.
