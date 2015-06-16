var express       = require('express');
var request       = require('request');
var cors          = require('cors');
var bodyParser    = require('body-parser');
var app           = express();
var dataBase			= require('./database/dbConfig')
var serveStatic   = require ('serve-static');
var Api           = require("./api");
var Router        = require("./routes");


app.use(bodyParser.json());
app.use(cors());

app.use("/node_modules", express.static(__dirname + '/../node_modules'));
app.use("/app", express.static(__dirname + '/../app'));

Api.setup(app);
Router.setup(app);

app.set('port', process.env.PORT || 8000);
app.listen(app.get('port'));
console.log('Server listening at port ' + app.get('port'));