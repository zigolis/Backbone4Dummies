var app = app || {};

app.ArticleModel = Backbone.Model.extend({
  defaults: {
    title:   'No title',
    content: 'No content'
  },

  urlRoot: function() {
    return '/articles';
  },

  getTitle: function() {
    return this.get('title');
  },

  getContent: function() {
    return this.get('content');
  },

  fetchAllArticles:function (id) {
    // this.set("id","557ad7d6327e2affa06dcf32");
    this.fetch();
  }
});
