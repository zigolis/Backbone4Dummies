var mongoose = require('mongoose');

var article = new mongoose.Schema({
	title: String,
	content: String,
	id : String
});

var collectionName = 'articles'
var articles = module.exports = mongoose.model(collectionName, article, collectionName);