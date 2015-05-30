var app = app || {};

app.HomeView = Backbone.View.extend({
  el: 'header',

  events: {
    'click h1' : 'print'
  },

  initialize: function() {
    this.$('span').text('home/this');
  },

  print: function() {
    this.$('span').css('background', '#ccc');
  }
});
