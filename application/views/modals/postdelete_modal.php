<div class="modal" id="trash_modal_<?=$post_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-danger"><i class="fa fa-lg fa-trash-o"></i> Deleting...</h4>
            </div>
            <div class="modal-body">
                <blockquote style="margin-bottom: 0" class="text-info">
                    <p>Are you sure? </p>
                    <small>This can not be undone</small>
                </blockquote>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-labeled btn-default" data-dismiss="modal">
                 <span class="btn-label">
                  <i class="fa fa-remove"></i>
                 </span>Cancel
                </button>
                <button id="post_delete_<?=$post_id?>" class="btn btn-labeled btn-danger">
                 <span class="btn-label">
                  <i class="fa fa-trash-o"></i>
                 </span>Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $( "#post_<?=$post_id?>" ).click(function() {
        $( "#post_field_<?=$post_id?>" ).focus();
    });

    $('#post_delete_<?=$post_id?>').click(function () {
        $.ajax({
            url: "<?php echo site_url('post/delete/'.$post_id);?>",
            type: "GET",
            success: function (data) {
                $("#post_panel_<?=$post_id?>").fadeTo("fast", 0.01, function () { //fade
                    $(this).slideUp("fast", function () { //slide up
                        $(this).remove(); //then remove from the DOM
                        window.location.reload();
                    });
                });
            }
        });
    });
</script>