<div class="modal" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit fa-lg"></i> Edit your profile</h4>
            </div>
            <div class="modal-body">
                <?php
                $data = array(
                    'class' => 'smart-form',

                    'name' => 'user_form'
                );

                echo form_open("user/edit_user", $data)
                ?>
                <fieldset>
                    <div class="row">
                        <div class="col col-md-6">
                            <section>
                                <label class="input">
                                    First Name:
                                    <input type="text" name="first_name" class="input" value="<?=$first_name?>"
                                           autocomplete="off"/>
                                </label>
                            </section>
                        </div>

                        <div class="col col-md-6">
                            <section>
                                <label class="input">
                                    Last Name:
                                    <input type="text" name="last_name" class="input" value="<?=$last_name?>"
                                           autocomplete="off"/>
                                </label>
                            </section>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <div class="col col-md-6">
                            <section style="border-right: solid #808080 1px">
                                <div class="inline-group">
                                    <label class="radio">
                                        <input type="radio" name="academic_year" value="M1" <?=$ac_year ==
                                        "M1"?'checked':''; ?>><i></i> M1 Student
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="academic_year" value="M2" <?=$ac_year ==
                                        "M2"?'checked':''; ?>><i></i> M2 Student
                                    </label>
                                </div>
                            </section>
                        </div>

                        <div class="col col-md-6">
                            <section>
                                <div class="inline-group">
                                    <label class="radio">
                                        <input type="radio" name="course_type" value="Innovator" <?=$course_ty ==
                                        "Innovator"?'checked':''; ?>><i></i> Innovator
                                    </label>
                                    <input type="hidden" value="<?=$logged_userid?>" name="user_id">
                                    <label class="radio">
                                        <input type="radio" name="course_type" value="Professional" <?=$course_ty ==
                                        "Professional"?'checked':''; ?>><i></i> Professional
                                    </label>
                                </div>
                            </section>
                        </div>
                    </div>
                </fieldset>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-labeled" data-dismiss="modal">
                    <span class="btn-label"><i class="fa fa-close"></i></span> Cancel</button>
                <button type="submit" class="btn btn-vermilion btn-labeled">
                    <span class="btn-label"><i class="fa fa-save"></i></span>
                    Save
                </button>
            </div>
            <?php echo form_close()?>
        </div>
    </div>

    <!-- aJax way of saving -->
    <script>
        $(document).ready(function () {
            //pageSetUp();

            $("#user_form").validate({

                // Rules for form validation
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    myfile: {
                        required: true
                    }
                },
                // Messages for form validation
                messages: {
                    first_name: {
                        required: 'Enter your first name '
                    },
                    last_name: {
                        required: 'Enter your last name'
                    },
                    myfile: {
                        required: 'Select A file'
                    }
                },
                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

                // if the validation passes, submit using ajax
                submitHandler: function (user_form) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('user/edit_user');?>",
                        data: $(user_form).serialize(),
                        success: function (data) {
                            window.location.reload();
                        }
                    });

                }
            });
        });
    </script>
    <!-- END aJax way of saving -->

</div>