var app = app || {};

app.HomeView = Backbone.View.extend({
  template: _.template($('#tmp').html()),
  el: 'header',

  events: {
    'click button' : 'render'
  },

  render: function() {
    this.$('h1').html(this.template({
      'section' : 'home'
    }));
  }
});
