var app = app || {};

app.ArticleModel = Backbone.Model.extend({
  defaults: {
    title:   'No title',
    content: 'No content'
  },

  url: function() {
    return 'http://127.0.0.1/Backbone4Dummies/api/articles/2';
  }
});
