var app = app || {};

app.ArticleModel = Backbone.Model.extend({
  defaults: {
    title:   'No title',
    content: 'No content'
  },

  url: function() {
    return '/Backbone4Dummies/api/articles';
  }
});
