var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section',

  events: {
    'submit form' : 'createArticle'
  },

  initialize: function () {
    this.model = new app.ArticleModel();
    this.listenTo(this.model,'sync', this.success);
    this.listenTo(this.model,'error', this.error);
  },

  success: function () {
    this.showMsg('Success');
    this.resetForm();
  },

  error: function (data) {
    this.showMsg('Error: ' + data);
  },

  createArticle: function(e) {
    this.model.set('title', this.$('[name="title"]').val());
    this.model.set('content', this.$('[name="content"]').val());
    this.model.saveArticle()
    e.preventDefault();
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
