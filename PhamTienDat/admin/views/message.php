<?php if(has_flash('message')) : ?>
    <?php $arr=get_flash('message'); ?>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-<?php echo $arr['type']; ?>">Thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong class="text-<?php echo $arr['type']; ?>"><?php echo $arr['msg']; ?></strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#myModal').modal('show');
});
</script>
<?php endif; ?>