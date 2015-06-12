var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section',

  initialize: function () {
    this.model = new app.ArticleModel();
    this.listenTo(this.model,'sync', this.success);
    this.listenTo(this.model,'error', this.error);
  },
  events: {
    'submit form' : 'createArticle'
  },
  success: function () {
    this.showMsg('Success');
    this.resetForm();
  },
  error: function () {
    this.showMsg('Error: ' + data);
  },
  createArticle: function(e) {
    e.preventDefault();
    this.model.set('title', this.$('[name="title"]').val());
    this.model.set('content', this.$('[name="content"]').val());
    this.model.saveArticle()
  },
  showMsg: function(msg) {
    this.$('span').text(msg);
  },
  resetForm: function(){
    this.$('input[type=text], textarea').each(function(){
      $(this).val('');
    });
  }
});
