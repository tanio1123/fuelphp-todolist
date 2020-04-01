<div class="main" id="app">

  <form class="p-form-main js-form"></form>


  <div class="p-searchBox">
    <i class="fa fa-search p-searchBox__icon" aria-hidden="true"></i>
    <input type="text" class="p-searchBox__input js-search" value="" placeholder="ここに絞り込みたいキーワードを入力する" />
  </div>

  <ul class="p-list js-todo_list"></ul>

  <script type="text/template" id="template-list-item">
    <% if (isShow){ %>
        <li class="p-list__item  js-todo_list-item <% if (isDone){ %>p-list__item--done<% }%>">
          <i class="fa <% if (isDone){ %>fa-check-square<% }else{ %>fa-square-o<% } %>
          c-icon c-icon__check js-toggle-done" aria-hidden="true"></i>
          <% if (!editMode){ %>
          <span class="js-todo_list-text"><%= text %></span>
          <% }else{ %>
          <input type="text" class="c-editText js-todo_list-editForm" value="<%= text %>">
          <% } %>
          <i class="fa fa-trash c-icon c-icon__trash js-click-trash" aria-hidden="true"></i>
        </li>
        <% } %>
      </script>

  <script type="text/template" id="template-form">
    <div class="p-inputArea">
          <input type="text" class="p-inputArea__inputText js-get-val" value="" placeholder="ここにTODO内容を書く">
          <% if(hasError){ %>
          <span class="p-inputArea__error"><%= errorMsg %></span>
          <% } %>
        </div>
        <button class="c-btn js-add-todo">TODOを追加</button>
      </script>
</div>
<?= Asset::js('app.js') ?>