var app = app || {};

app.ArticleModel = Backbone.Model.extend({
  defaults: {
    title:   'No title',
    content: 'No content'
  },

  urlRoot: function() {
    return '/Backbone4Dummies/api/articles';
  },

  getTitle: function() {
    return this.get('title');
  },

  getContent: function() {
    return this.get('content');
  }
});
