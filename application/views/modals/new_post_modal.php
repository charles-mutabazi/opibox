<!-- Edit Modal-->
<div class="modal" id="post_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-info"><i class="fa fa-lg fa-edit"></i> Demand...</h4>
            </div>
            <div class="modal-body">
                <?php
                $config = array(
                    'class' => 'smart-form',
                    'id' => 'post_form_modal',
                    'name' => 'post_form_modal'
                );

                echo form_open('javascript:void(0)',$config)
                ?>
                <fieldset class="padding-5">
                    <section>
                        <label class="textarea">
                            <i class="icon-append fa fa-edit"></i>
                    <textarea rows="4" placeholder="What is on your mind?" class="post-textarea"
                              name="post_text" id="txtarea"></textarea>
                        </label>
                        <input type="hidden" name="user_id" value="<?php echo $logged_userid ?>">
                    </section>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-labeled btn-default" data-dismiss="modal">
                                 <span class="btn-label">
                                  <i class="fa fa-remove"></i>
                                 </span>Cancel
                </button>
                <button type="submit" class="btn btn-vermilion btn-labeled">
                                 <span class="btn-label">
                                  <i class="fa fa-edit"></i>
                                 </span>Post
                </button>
            </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>
<!-- Modals end here -->

<script>
    //aJax way of saving
    $(document).ready(function () {
        $("#post_form_modal").validate({
            // Rules for form validation
            rules: {
                post_text: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                post_text: {
                    required: 'You cannot post an empty form, please first enter your opinion'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },

            // if the validation passes, submit using ajax
            submitHandler: function (post_form_modal) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('post/new_post');?>",
                    data: $(post_form_modal).serialize(),
                    success: function (data) {
                        $('#txtarea').val('');
                        window.location.reload();
                    }
                });

            }
        });
        //END aJax way of saving
    });
</script>