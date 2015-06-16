var app = app || {};

app.ArticleCollection = Backbone.Collection.extend({
	model : app.ArticleModel,

	initialize: function() {
    this.fetch();
  },

  url: function() {
    return '/articles'
  }
});



