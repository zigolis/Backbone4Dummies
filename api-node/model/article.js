var mongoose  = require('mongoose')
var article   = mongoose.model('articles');

exports.getAll = function (request, response) {
  article.find(function (error, data) {
    var strOutput;
    if (error) {
      strOutput = 'Could not get the articles';
    } 
    else {
      strOutput = data;
    }
    response.json(strOutput);
    response.end();
  });
};

exports.getById = function (request, response) {
  article.findOne({_id:request.params.id},function (error, data) {
    var strOutput;
    if (error) {
      strOutput = 'Could not get the articles';
    } 
    else {
      strOutput = data;
    }
    response.json(strOutput);
    response.end();
	});
};

exports.save = function (request,response) {
	var data = {
		title : request.body.title,
		content : request.body.content
	};
	article.create(data,function(error,data){
		if (error) {
		 strOutput = 'Could not get the articles';
		}
		else {
			strOutput = data;
		}
 		response.json(strOutput);
    response.end();
	});
};