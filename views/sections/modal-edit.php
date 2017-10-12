<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Task</h4>
      </div>
      <div class="modal-body" id="edit-container">
          <div><p id="msjEditForm"></p></div>
          <form id="edit-form" method="POST">
               <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $item->getTitle(); ?>" >
              </div>
              <div class="form-group">
                <label for="duedate">Due Date</label>
                <input type="date" class="form-control" id="dueDate" name="duedate" placeholder="yyyy-mm-dd" value="<?php echo $item->getDueDate(); ?>">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" ><?php echo $item->getDescription(); ?></textarea>
              </div>
              <div class="form-group">
                <label><input type="checkbox" id="done" name="done" value="1" <?php if($item->getDone()==1){echo 'checked';}?> >Done</label>
              </div>
               <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $item->getId(); ?>">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
          </form>
      </div>
      <div class="modal-footer">
        
      </div>

