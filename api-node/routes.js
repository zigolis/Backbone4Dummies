var path          = require("path");

function setup(app) {
  app.get('/:id', function (request, response) {
    response.sendFile(path.join(__dirname + '/../app/'+request.params.id+'/index.html'));
  });
}
 
exports.setup = setup;
