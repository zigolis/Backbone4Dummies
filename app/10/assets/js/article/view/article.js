var app = app || {};

app.ArticleView = Backbone.View.extend({
  el: 'section div',
  template : _.template("<a class='list-group-item active'> <h4 class='list-group-item-heading'> <%=title%> </h4> <p class='list-group-item-text'> <%=content%> </p></a><br>"),

  initialize: function () {
    this.collection = new app.ArticleCollection();
    this.listenTo(this.collection,'sync', this.render);
    this.listenTo(this.collection,'error', this.error);
  },

  render: function () {
    _.each(this.collection.models, function (model) {
      this.$el.append(this.template(model.toJSON()))
    }.bind(this));
  },

  error: function (data) {
    this.$('.error').text("Could not get the articles")
  }
});
