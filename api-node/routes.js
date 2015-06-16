var path          = require("path");

function setup(app) {

  app.get('/01', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/01/index.html'));
  });

  app.get('/02', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/02/index.html'));
  });

  app.get('/03', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/03/index.html'));
  });

  app.get('/04', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/04/index.html'));
  });

  app.get('/05', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/05/index.html'));
  });

  app.get('/06', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/06/index.html'));
  });

  app.get('/07', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/07/index.html'));
  });

  app.get('/08', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/08/index.html'));
  });
}
 
exports.setup = setup;
