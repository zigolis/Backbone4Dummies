var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section',

  events: {
    'click .del' : 'deleteArticle'
  },

  deleteArticle: function(e) {
    this.model = new app.ArticleModel({
      'id' : 'abc'
    });

    this.model.destroy()

    .done(_.bind(function() {
      this.showMsg('Success!');
    }, this))

    .error(_.bind(function(data) {
      this.showMsg('Error: ' + data);
      console.log(data)
    }, this));

    e.preventDefault();
  },

  showMsg: function(msg) {
    this.$('span').text(msg);
  }
});
