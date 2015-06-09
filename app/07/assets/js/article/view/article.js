var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section',

  initialize: function() {
    this.getArticleById();
  },

  getArticleById: function() {
    this.model = new app.ArticleModel({
      'id' : 1,
    });

    this.model.fetch()

    .done(_.bind(function() {
      this.showMsg('Success!');
      this.$('[name="title"]').val(this.model.getTitle());
      this.$('[name="content"]').val(this.model.getContent());
    }, this))

    .error(_.bind(function(data) {
      this.showMsg('Error: ' + data);
    }, this));
  },

  showMsg: function(msg) {
    this.$('span').text(msg);
  }
});
