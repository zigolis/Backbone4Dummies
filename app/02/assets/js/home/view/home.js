var app = app || {};

app.HomeView = Backbone.View.extend({
  el: 'header',

  initialize: function() {
    this.$('span').text('home');
  }
});
