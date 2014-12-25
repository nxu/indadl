indadl
======

A simple Indavideo downloader service written in PHP. Needs cURL to be allowed and configured properly (will not run on most free webhosts).

Usage
------
1. Send a `GET` request to `loader.php` with one parameter, `url`.
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
