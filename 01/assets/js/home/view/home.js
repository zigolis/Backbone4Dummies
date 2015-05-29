var app = app || {};

app.HomeView = Backbone.View.extend({
  initialize: function() {
    $('h1 span').text('home');
  }
});
