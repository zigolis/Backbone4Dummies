var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section',

  events: {
    'submit form' : 'updateArticle'
  },

  updateArticle: function(e) {
    this.model = new app.ArticleModel({
      'id'      : 15,
      'title'   : this.$('[name="title"]').val(),
      'content' : this.$('[name="content"]').val()
    });

    this.model.save()

    .done(_.bind(function() {
      this.showMsg('Success!');
      this.resetForm();
    }, this))

    .error(_.bind(function(data) {
      this.showMsg('Error: ' + data);
    }, this));

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
