BACKWARD COMPATIBILITY BREAK with version 1.x!
PostgreSQL was removed from the container, make sure to migrate your database to any external PostgreSQL instance.

What is it
===========

This is ready-to-use docker microservice for file uploading. Resize, rotate, crop API. 
Imagemagick is used for image manipulation.

Installation
============

```bash
docker run \
-p 80:80/tcp \
-e UPLOAD_HOST=example.com \
-e PG_HOST=postgresql \
-e PG_DATABASE=database \
-e PG_USER=user \
-e PG_PASSWORD=password \
-v files:/opt/upload/files \
-v cache:/opt/upload/web/cache \
-d perfumerlabs/upload:v2.3.0
```

Database must be created before container startup.

Environment variables
=====================

- UPLOAD_HOST - host, to set correct download urls in the response (without http://). Required.
- UPLOAD_PORT - exposed port of host, to set correct download urls in the response. Optional. The default value is 80.
- UPLOAD_MAX_FILESIZE - maximum allowed size of file. Optional. The default value is 10M.
- UPLOAD_MAX_DIMENSION - maximum allowed dimension of image. Optional. The default value is 1000. If image is more than this value, uploader will resize the image.
- UPLOAD_DIGEST_PREFIX - after every file is uploaded, a unique identificator, called "digest", is returned in response (for example, "abcdeAce4VKD2Wg"), UPLOAD_DIGEST_PREFIX (in the example "abcde") will be set at the beginning of the digest. If you have multiple upload servers this prefix will help to determine which server preserved a file. Optional.
- UPLOAD_DIGEST_LENGTH - length of the meaningful part of the digest (without UPLOAD_DIGEST_PREFIX). Optional. The default and minimum allowed value is 10.
- UPLOAD_AUTH - File download authentication (see below). The default value is false.
- UPLOAD_AUTH_SALT - File download authentication salt (see below). The default value is false.
- PHP_MAX_EXECUTION_TIME - max_execution_time option in php.ini. Optional. The default value is 60.
- PHP_MEMORY_LIMIT - memory_limit option in php.ini. Optional. The default value is 512M.
- PHP_PM_MAX_CHILDREN - number of FPM workers. Default value is 10.
- PHP_PM_MAX_REQUESTS - number of FPM max requests. Default value is 500.
- PG_HOST - PostgreSQL host. Required.
- PG_PORT - PostgreSQL port. Default value is 5432.
- PG_DATABASE - PostgreSQL database name. Required.
- PG_USER - PostgreSQL user name. Required.
- PG_PASSWORD - PostgreSQL user password. Required.

Volumes
=======

- /opt/upload/files - directory with all uploaded files.
- /opt/upload/web/cache - directory with cached thumbnails.

If you want to make any additional configuration of container, mount your bash script to /opt/setup.sh. This script will be executed on container setup.

API Reference
=============

### Upload a file

POST /file - upload a file, provide a file within form-data body with a key "file".

Response: JSON with 3 fields - status, digest, download.

Response example:

```json
{
    "status": true,
    "digest": "abcdeAce4VKD2Wg",
    "name": "example",
    "extension": "txt",
    "size": 123,
    "mimetype": "text/plain",
    "download": "http://example.com/file/abcdeAce4VKD2Wg"
}
```

### Download a file

GET /file/{digest} - get a file with the digest {digest}.

Example:

```
GET /file/abcdeAce4VKD2Wg
```

### Get file info

GET /file/{digest}/info - get a file info with the digest {digest}.

Example:

```
GET /file/abcdeAce4VKD2Wg/info
```

Response example:

```json
{
    "status": true,
    "digest": "abcdeAce4VKD2Wg",
    "name": "example",
    "extension": "txt",
    "size": 123,
    "mimetype": "text/plain",
    "download": "http://example.com/file/abcdeAce4VKD2Wg"
}
```

### Upload an image

POST /image - upload an image, provide a file within form-data body with a key "file".

Response: JSON with 4 fields - status, digest, download, thumbnail.

Response example:

```json
{
    "status": true,
    "digest": "abcdeAce4VKD2Wg",
    "name": "example",
    "extension": "jpg",
    "mimetype": "image/jpeg",
    "size": 123,
    "download": "http://example.com/file/abcdeAce4VKD2Wg",
    "thumbnail": "http://example.com/image/abcdeAce4VKD2Wg"
}
```

### Download an image thumbnail

GET /image/{digest} - get an image with the digest {digest}.

Parameters:
- w - resize an image to this width;
- h - resize an image to this height;
- m - resize mode: c - crop-resize, r - preserve dimensions (default).

Example:

```
GET /image/abcdeAce4VKD2Wg?w=500&h=500&m=c
```

### Rotate an image

POST /image/{digest}/rotate - rotate an image with the digest {digest}.

Parameters (json):
- d - degrees to rotate with. Clockwise, only divisible by 90 values are allowed.

Request example:

```
POST /image/abcdeAce4VKD2Wg/rotate
```

```json
{
    "d": 180
}
```

Result of the rotation is a new file. Response example:

```json
{
    "status": true,
    "digest": "abcdeT3pNjL7RaD",
    "download": "http://example.com/file/abcdeT3pNjL7RaD",
    "thumbnail": "http://example.com/image/abcdeT3pNjL7RaD"
}
```

### Crop an image

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

```json
{
    "x": 90,
    "y": 100,
    "w": 500,
    "h": 400
}
```

Result of the cropping is a new file. Response example:

```json
{
    "status": true,
    "digest": "abcdeT3pNjL7RaD",
    "download": "http://example.com/file/abcdeT3pNjL7RaD",
    "thumbnail": "http://example.com/image/abcdeT3pNjL7RaD"
}
```

Software
========

1. Ubuntu 16.04 Xenial
3. Nginx 1.16
4. PHP 7.4
