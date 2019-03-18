Ready-to-use docker microservice for file uploading. Resize, rotate, crop API. Imagemagick is used for image manipulation.

Installation
============

```bash
docker run \
-p 80:80/tcp \
-e UPLOAD_HOST=example.com \
-v files:/opt/upload/files \
-v postgresql:/var/lib/postgresql \
-d perfumerlabs/upload:v1.1.0
```

Environment variables
=====================

- UPLOAD_HOST - server domain (without http://). Required.
- UPLOAD_PORT - exposed port of host, to set correct download urls in the response. Optional. The default value is 80.
- UPLOAD_MAX_FILESIZE - maximum allowed size of file. Optional. The default value is 10M.
- UPLOAD_DIGEST_PREFIX - after every file is uploaded, a unique identificator, called "digest", is returned in response (for example, "abcdeAce4VKD2Wg"), UPLOAD_DIGEST_PREFIX (in the example "abcde") will be set at the beginning of the digest. If you have multiple upload servers this prefix will help to determine which server preserved a file. Optional. The default value is "abcde".
- UPLOAD_DIGEST_LENGTH - length of the meaningful part of the digest (without UPLOAD_DIGEST_PREFIX). Optional. The default value is 10.
- PHP_MAX_EXECUTION_TIME - max_execution_time option in php.ini. Optional. The default value is 60.
- PHP_MEMORY_LIMIT - memory_limit option in php.ini. Optional. The default value is 512M.

Volumes
=======

- /opt/upload/files - directory with all uploaded files.
- /var/lib/postgresql - PostgreSQL data directory.

If you want to make any additional configuration of container, mount your bash script to /opt/setup.sh. This script will be executed on container setup.

Software
========

1. Ubuntu 16.04 Xenial
2. PostgreSQL 9.6
3. Nginx 1.14
4. PHP 7.1

API Reference
=============

###### Upload a file

POST /file - upload a file, provide a file within form-data body with a key "file".

Response: JSON with 3 fields - status, digest, download.

Response example:

```javascript
{
    "status": true,
    "digest": "abcdeAce4VKD2Wg",
    "download": "http://example.com/file/abcdeAce4VKD2Wg"
}
```

###### Download a file

GET /file/{digest} - get a file with the digest {digest}.

Example:

```
GET /file/abcdeAce4VKD2Wg
```


###### Upload an image

POST /image - upload an image, provide a file within form-data body with a key "file".

Response: JSON with 4 fields - status, digest, download, thumbnail.

Response example:

```javascript
{
    "status": true,
    "digest": "abcdeAce4VKD2Wg",
    "download": "http://example.com/file/abcdeAce4VKD2Wg",
    "thumbnail": "http://example.com/image/abcdeAce4VKD2Wg"
}
```

###### Download an image thumbnail

GET /image/{digest} - get an image with the digest {digest}.

Parameters:
- w - resize an image to this width;
- h - resize an image to this height;
- m - resize mode: c - crop-resize, r - preserve dimensions (default).

Example:

```
GET /image/abcdeAce4VKD2Wg?w=500&h=500&m=c
```

###### Rotate an image

POST /image/{digest}/rotate - rotate an image with the digest {digest}.

Parameters (json):
- d - degrees to rotate with. Clockwise, only divisible by 90 values are allowed.

Request example:

```
POST /image/abcdeAce4VKD2Wg/rotate
```

```javascript
{
    "d": 180
}
```

Result of the rotation is a new file. Response example:

```javascript
{
    "status": true,
    "digest": "abcdeT3pNjL7RaD",
    "download": "http://example.com/file/abcdeT3pNjL7RaD",
    "thumbnail": "http://example.com/image/abcdeT3pNjL7RaD"
}
```

###### Crop an image

POST /image/{digest}/crop - crop an image with the digest {digest}.

Parameters (json):
- x - x-coordinate to start with;
- y - y-coordinate to start with;
- w - number of pixels to go to right from the x-coordinate;
- h - number of pixels to go to down from the y-coordinate.

Request example:

```
POST /image/abcdeAce4VKD2Wg/crop
```

```javascript
{
    "x": 90,
    "y": 100,
    "w": 500,
    "h": 400
}
```

Result of the cropping is a new file. Response example:

```javascript
{
    "status": true,
    "digest": "abcdeT3pNjL7RaD",
    "download": "http://example.com/file/abcdeT3pNjL7RaD",
    "thumbnail": "http://example.com/image/abcdeT3pNjL7RaD"
}
```
