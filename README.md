Ready-to-use file upload server docker container. Imagemagick is used for image manipulation.

Installation
============

```bash
docker run \
-p 80:80/tcp \
-e UPLOAD_HOST=example.com \
-v files:/opt/upload/files \
-v postgresql:/var/lib/postgresql \
-d perfumerlabs/upload:1.0.0
```

Environment variables
=====================

- UPLOAD_HOST - server domain (without http://).
- UPLOAD_MAX_FILESIZE - maximum allowed size of file. The default value is 10M.
- UPLOAD_DIGEST_PREFIX - after every file is uploaded, a unique identificator, called "digest", is returned in response (for example, "abcdeAce4VKD2Wg"), UPLOAD_DIGEST_PREFIX (in the example "abcde") will be set at the beginning of the digest. If you have multiple upload servers this prefix will help to determine which server preserved a file. The default value is "abcde".
- UPLOAD_DIGEST_LENGTH - length of the meaningful part of the digest (without UPLOAD_DIGEST_PREFIX). The default value is 10.
- PHP_MAX_EXECUTION_TIME - max_execution_time option in php.ini. The default value is 60.
- PHP_MEMORY_LIMIT - memory_limit option in php.ini. The default value is 512M.

Volumes
=======

- /opt/upload/files - directory with all uploaded files.
- /var/lib/postgresql - PostgreSQL data directory.

If you want to make any additional configuration of container, mount your bash script to /opt/setup.sh. This script will be executed on container setup.

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
