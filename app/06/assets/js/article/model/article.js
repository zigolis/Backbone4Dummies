var app = app || {};

app.ArticleModel = Backbone.Model.extend({
  defaults: {
    title:   'No title',
    content: 'No content'
  },

  urlRoot: function() {
    return 'http://localhost:8080/article'
  }
});
