[![N|Solid](https://filemanager.tahirafridi.com/images/logo-wide.svg)](https://filemanager.tahirafridi.com/)
# TK File Manager
## A self-host file manager
A self-host file manager built for file hosting.

## Features
- Self hosted and independent file manager.
- Unlimited file uploads/downloads accordingly to your server specs.
- Manual and remote uploads.
- Signed sharing temporary URLs, after certain time(minutes) it will be expired and can not be use anymore.
- You can create folders and upload files there.
- Your bandwidth will be no more stolen by your competitors due to singed URLs, no more hot-link protection.

## Tech
TK file manager uses a number of open source projects to work properly:

- [Laravel] - The PHP Framework
for Web Artisans.
- [Livewire] - A full-stack framework for Laravel that takes the pain out of building dynamic UIs.
- [Admin LTE] - AdminLTE Bootstrap Admin Dashboard Template.
- [Bootstrap] - Build fast, responsive sites with Bootstrap.
- [Alpine.js] - Your new, lightweight, JavaScript framework.
- [jQuery] - jQuery is a fast, small, and feature-rich JavaScript library.

And of course Dillinger itself is open source with a [public repository][dill]
 on GitHub.

## Installation

Dillinger requires [Node.js](https://nodejs.org/) v10+ to run.

Install the dependencies and devDependencies and start the server.

```sh
cd dillinger
npm i
node app
```

For production environments...

```sh
npm install --production
NODE_ENV=production node app
```

## Plugins

Dillinger is currently extended with the following plugins.
Instructions on how to use them in your own application are linked below.

| Plugin | README |
| ------ | ------ |
| Dropbox | [plugins/dropbox/README.md][PlDb] |
| GitHub | [plugins/github/README.md][PlGh] |
| Google Drive | [plugins/googledrive/README.md][PlGd] |
| OneDrive | [plugins/onedrive/README.md][PlOd] |
| Medium | [plugins/medium/README.md][PlMe] |
| Google Analytics | [plugins/googleanalytics/README.md][PlGa] |

## Development

Want to contribute? Great!

Dillinger uses Gulp + Webpack for fast developing.
Make a change in your file and instantaneously see your updates!

Open your favorite Terminal and run these commands.

First Tab:

```sh
node app
```

Second Tab:

```sh
gulp watch
```

(optional) Third:

```sh
karma test
```

#### Building for source

For production release:

```sh
gulp build --prod
```

Generating pre-built zip archives for distribution:

```sh
gulp build dist --prod
```

## Docker

Dillinger is very easy to install and deploy in a Docker container.

By default, the Docker will expose port 8080, so change this within the
Dockerfile if necessary. When ready, simply use the Dockerfile to
build the image.

```sh
cd dillinger
docker build -t <youruser>/dillinger:${package.json.version} .
```

This will create the dillinger image and pull in the necessary dependencies.
Be sure to swap out `${package.json.version}` with the actual
version of Dillinger.

Once done, run the Docker image and map the port to whatever you wish on
your host. In this example, we simply map port 8000 of the host to
port 8080 of the Docker (or whatever port was exposed in the Dockerfile):

```sh
docker run -d -p 8000:8080 --restart=always --cap-add=SYS_ADMIN --name=dillinger <youruser>/dillinger:${package.json.version}
```

> Note: `--capt-add=SYS-ADMIN` is required for PDF rendering.

Verify the deployment by navigating to your server address in
your preferred browser.

```sh
127.0.0.1:8000
```

## License

MIT

**Free Software, Hell Yeah!**

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [Laravel]: <https://laravel.com>
   [Livewire]: <https://livewire.laravel.com>
   [Admin LTE]: <https://adminlte.io>
   [Bootstrap]: <https://getbootstrap.com>
   [Alpine.js]: <https://alpinejs.dev>
   [jQuery]: <http://jquery.com>
