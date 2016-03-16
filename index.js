var connect = require('connect'),
	serveStatic = require('serve-static'),
    directory = './public';

var port = process.env.PORT || 8080;

connect()
    .use(serveStatic(directory))
    .listen(port);

console.log('Listening on port ' + port + '.');