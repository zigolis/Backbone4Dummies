var app = app || {};

app.ArticleModel = Backbone.Model.extend({
  defaults: {
    title:   'No title',
    content: 'No content'
  },

  urlRoot: function() {
    return 'http://localhost:8000/article';
  },

  getTitle: function() {
    return this.get('title');
  },

  getContent: function() {
    return this.get('content');
  },
  fetchArticleById:function (id) {
    this.set("id",id);
    this.fetch();
  }
});
