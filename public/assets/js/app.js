//=============================================
// Model
//=============================================
var Item = Backbone.Model.extend({
  defaults: {
    text: "",
    isDone: false,
    editMode: false,
    isShow: true
  }
});
var Form = Backbone.Model.extend({
  defaults: {
    val: "",
    hasError: false,
    errorMsg: ""
  }
});
var form = new Form();

var Search = Backbone.Model.extend({
  defaults: {
    key: ""
  }
});
var search = new Search();

//=============================================
// Collection
//=============================================
var LIST = Backbone.Collection.extend({
  model: Item
});

var item1 = new Item({ text: "sample todo1" });
var item2 = new Item({ text: "sample todo2" });
var list = new LIST([item1, item2]);

//=============================================
// View
//=============================================
var ItemView = Backbone.View.extend({
  template: _.template($("#template-list-item").html()),
  events: {
    "click .js-toggle-done": "toggleDone",
    "click .js-click-trash": "remove",
    "click .js-todo_list-text": "showEdit",
    "keyup .js-todo_list-editForm": "closeEdit"
  },
  initialize: function(options) {
    _.bindAll(this, "toggleDone", "render", "remove", "showEdit", "closeEdit");

    this.model.bind("change", this.render);
    this.model.bind("destroy", this.remove);
  },
  toggleDone: function() {
    this.model.set({ isDone: !this.model.get("isDone") });
  },
  remove: function() {
    this.$el.remove();
    return this;
  },
  showEdit: function() {
    this.model.set({ editMode: true });
  },
  closeEdit: function(e) {
    if (e.keyCode === 13 && e.shiftKey === true) {
      this.model.set({ text: e.currentTarget.value, editMode: false });
    }
  },
  render: function() {
    console.log("render item");
    var template = this.template(this.model.attributes);

    this.$el.html(template);
    return this;
  }
});

// 検索フォーム
var SearchView = Backbone.View.extend({
  el: $(".p-searchBox"),
  model: search,
  events: {
    "keyup .js-search": "searchTodo"
  },
  initialize: function() {
    _.bindAll(this, "searchTodo");
  },
  searchTodo: function() {
    var key = $(".js-search").val();
    this.model.set({ key: key });
    listView.searchItem(this.model.get("key"));
  }
});
new SearchView();

var ListView = Backbone.View.extend({
  el: $(".js-todo_list"),
  collection: list,
  initialize: function() {
    _.bindAll(this, "render", "addItem", "appendItem", "searchItem");
    this.collection.bind("add", this.appendItem);
    this.render();
  },
  addItem: function(text) {
    var model = new Item({ text: text });
    this.collection.add(model);
  },
  appendItem: function(model) {
    var itemView = new ItemView({ model: model });
    this.$el.append(itemView.render().el);
  },
  searchItem: function(key) {
    var regexp = new RegExp("^" + key);
    this.collection.each(function(model, i) {
      var text = model.get("text");
      if (text && text.match(regexp)) {
        model.set({ isShow: true });
      } else {
        model.set({ isShow: false });
      }
    });
  },
  render: function() {
    console.log("render list");
    var that = this;
    this.collection.each(function(model, i) {
      that.appendItem(model);
    });
    return this;
  }
});
var listView = new ListView({ collection: list });

var FormView = Backbone.View.extend({
  el: $(".js-form"),
  template: _.template($("#template-form").html()),
  model: form,
  events: {
    "click .js-add-todo": "addTodo"
  },
  initialize: function() {
    _.bindAll(this, "render", "addTodo");
    this.model.bind("change", this.render);
    this.render();
  },
  addTodo: function(e) {
    e.preventDefault();
    if ($(".js-get-val").val() === "") {
      this.model.set({ hasError: true });
      this.model.set({ errorMsg: "文字を入力してください" });
      $(".p-inputArea__error").show();
    } else {
      this.model.set({ val: $(".js-get-val").val() });
      listView.addItem(this.model.get("val"));
    }
  },
  render: function() {
    var template = this.template(this.model.attributes);
    this.$el.html(template);
    return this;
  }
});
new FormView();
