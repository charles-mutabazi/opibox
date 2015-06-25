<!-- Edit Modal-->
<div class="modal" id="edit_modal_<?=$post_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-info"><i class="fa fa-lg fa-edit"></i> Editing...</h4>
            </div>
            <div class="modal-body">
                <?php
                $setup = array(
                    'id' => 'edit_form_'.$post_id,
                    'class' => 'smart-form',
                    'name' => 'edit_form'
                );
                echo form_open('javascript:void(0)', $setup)
                ?>
                <fieldset class="padding-5">
                    <section>
                        <label class="textarea">
                            <i class="icon-append fa fa-edit"></i>
                                            <textarea rows="4" placeholder="" class="post-textarea"
                                                      name="post_edit"><?=$text?></textarea>
                        </label>
                        <input type="hidden" name="post_edit_id" value="<?=$post_id?>">
                    </section>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-labeled btn-default" data-dismiss="modal">
                                 <span class="btn-label">
                                  <i class="fa fa-remove"></i>
                                 </span>Cancel
                </button>
                <button type="submit" class="btn btn-labeled btn-vermilion">
                                 <span class="btn-label">
                                  <i class="fa fa-save"></i>
                                 </span>Update
                </button>
            </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>
<!-- Modals end here -->


<script>
    $(document).ready(function () {

        $("#edit_form_<?=$post_id;?>").validate({

            // Rules for form validation
            rules: {
                post_edit: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                post_edit: {
                    required: 'You cannot post an empty form, please enter the edit'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },

            // if the validation passes, submit using ajax
            submitHandler: function (edit_form) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('post/edit_post');?>",
                    data: $(edit_form).serialize(),
                    success: function (data) {
                        window.location.reload();
                    }
                });

            }
        });

        $("#comment_<?php echo $post_id;?>").validate({

            // Rules for form validation
            rules: {
                comment_text: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                comment_text: {
                    required: 'You cannot post an empty form, please first enter a comment'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },

            // if the validation passes, submit using ajax
            submitHandler: function (comment_form) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('post/add_comment');?>",
                    data: $(comment_form).serialize(),
                    success: function (data) {
                        window.location.reload();
                    }
                });

            }
        });
    });
</script>