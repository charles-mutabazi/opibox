<!--
The following views use this template

1. profile_page view
2. home_view_new view

-->

<form action="javascript:void(0)" method="post" accept-charset="utf-8" class="smart-form post-form animated fadeIn"
      id="post_form"
      name="post_form">
    <fieldset class="padding-5">
        <section>
            <label class="textarea">
                <i class="icon-append fa fa-edit"></i>
                        <textarea rows="4" placeholder="Type your demand here..." class="post-textarea"
                                  name="post_text"></textarea>
            </label>
            <input type="hidden" name="user_id" value="<?php echo $logged_userid ?>">
        </section>
    </fieldset>
    <footer>
        <button class="btn btn-vermilion btn-labeled" type="submit" style="padding: 0 12px">
            <span class="btn-label"><i class="fa fa-edit"></i></span>Post
        </button>
    </footer>
</form>

<!-- aJax way of saving -->
<script>
    $(document).ready(function () {
        //pageSetUp();

        $("#post_form").validate({

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
            submitHandler: function (post_form) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('post/new_post');?>",
                    data: $(post_form).serialize(),
                    success: function (data) {
                        window.location.reload();
                    }
                });

            }
        });
    });
</script>
<!-- END aJax way of saving -->