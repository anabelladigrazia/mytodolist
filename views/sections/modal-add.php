<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Task</h4>
      </div>
      <div class="modal-body" id="add-container">
          <div><p id="msjAddForm"></p></div>
          <form id="add-form" method="POST">
               <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
              <div class="form-group">
                <label for="duedate">Due date</label>
                <input type="date" class="form-control" id="dueDate" name="duedate" placeholder="yyyy-mm-dd">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
              </div>
              <div class="form-group">
                <label><input type="checkbox" value="1" id="done" name="done">Done</label>
              </div>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
          </form>
      </div>
      <div class="modal-footer">
        
      </div>