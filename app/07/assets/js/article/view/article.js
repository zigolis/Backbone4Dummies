var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section',

  initialize: function() {
    this.model = new app.ArticleModel();
    this.listenTo(this.model, "error", this.error);
    this.listenTo(this.model, "sync", this.sucess);
    this.getArticleById(1);
  },
  error:function(){
    debugger
  },
  sucess:function(){
    debugger
  },
  getArticleById: function(id) {
    this.model.fetchArticleById(id)
  },

  showMsg: function(msg) {
    this.$('span').text(msg);
  }
});
