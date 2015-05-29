var app = app || {};

app.HomeView = Backbone.View.extend({
  el: 'header',

  events: {
    'click h1' : 'printBackground'
  },

  initialize: function() {
    this.$('span').text('home/this.$');
  },

  printBackground: function() {
    this.$('span').css('background', '#ccc');
  }
});
