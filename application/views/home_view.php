<section class="row">
    <div class="col-md-8">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" class="smart-form post-form" id="post_form"
              name="post_form">
            <fieldset class="padding-5">
                <section>
                    <label class="textarea">
                        <i class="icon-append fa fa-edit"></i>
                        <textarea rows="4" placeholder="What is on your mind?" class="post-textarea"
                                  name="post_text"></textarea>
                    </label>
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id') ?>">
                </section>
            </fieldset>
            <footer>
                <button class="btn btn-purple" type="submit">Post</button>
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


        <!-- Posts List-->
        <?php foreach ($all_posts as $post):

            $user = $this->user_model->get_user_by_id($post->user_id);
            $post_id = $post->id;

            $did_vote = $this->post_model->did_vote($post_id, $this->session->userdata('user_id'));
            $disabled = "";
            if ($did_vote) {
                $disabled = "disabled";
            }
            ?>
            <br>
            <div class="panel panel-default">
                <!-- Post Description -->
                <div class="panel-body">
                    <div class="row">
                        <!-- Post Vote UP/Down -->
                        <div class="col-sm-1">

                            <form action="javascript:void(0)" name="vote_handles_<?= $post_id ?>" method="post"
                                  id="vote_handles_<?= $post_id ?>" enctype="multipart/form-data">
                                <div class="row font-xl">
                                    <div class="col-sm-12">
                                        <button id="vote_up_<?= $post_id ?>" name="vote_up" type="submit"
                                                class="btn btn-success btn-circle <?= $disabled ?>">
                                            <i class="fa fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id"
                                       value="<?php echo $this->session->userdata('user_id'); ?>">
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                                <div class="row font-xl text-center">
                                    <div class="col-sm-12">
                                        <span id="vote_weight_<?= $post_id ?>"><?= $post->votes; ?></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <button id="vote_down_<?= $post_id ?>" name="vote_down" type="submit"
                                                class="btn btn-danger btn-circle <?= $disabled ?>">
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>


                            <script>

                                //Vote Up button Codes
                                $("#vote_up_<?=$post_id?>").click(function () {
                                    var form_id = $("#vote_handles_<?=$post_id?>");
                                    var weight = parseInt($("#vote_weight_<?=$post_id?>").text());
                                    $("#vote_weight_<?=$post_id?>").text(weight + 1);

                                    form_id.submit(function (event) {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('post/voted_up')?>",
                                            data: $(this).serialize(),
                                            success: function (data) {
                                                //alert(incr+1);
                                                $('#vote_up_<?=$post_id?>').addClass('disabled');
                                                $('#vote_down_<?=$post_id?>').addClass('disabled');
                                            }
                                        });
                                    });
                                });

                                //Vote Down Codes
                                $("#vote_down_<?=$post_id?>").click(function () {
                                    var form_id = $("#vote_handles_<?=$post_id?>");
                                    var weight = parseInt($("#vote_weight_<?=$post_id?>").text());
                                    $("#vote_weight_<?=$post_id?>").text(weight - 1);

                                    form_id.submit(function (event) {

                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('post/voted_down')?>",
                                            data: $(this).serialize(),
                                            success: function (data) {
                                                //alert(incr+1);
                                                $('#vote_up_<?=$post_id?>').addClass('disabled');
                                                $('#vote_down_<?=$post_id?>').addClass('disabled');
                                            }
                                        });
                                    });
                                });
                            </script>


                        </div>
                        <!-- End of Post Vote UP/Down -->

                        <!-- Post Description -->
                        <div class="col-sm-11">
                            <?php
                            //The Regular Expression filter
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                            // The Text you want to filter for urls
                            $text = $post->post_text;

                            // Check if there is a url in the text
                            if (preg_match($reg_exUrl, $text, $url)) {
                                ?>
                                <p><?php echo preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a> ", $text);?></p>
                            <?php } else { ?>
                                <p><?= $text ?></p>
                            <?php }?>
                        </div>
                        <!-- End of Post Text-->
                    </div>

                    <hr>

                    <!-- Poster details -->
                    <div class="row">
                        <div class="col-sm-1">
                            <a href="#">
                                <img src="<?php echo base_url() . "styling/js/placeholder/holder.js/40x40"; ?>" alt=""
                                     class="img-circle">
                            </a>
                        </div>
                        <div class="col-sm-11">
                            <div class="row">
                                <div class="col-sm-8">
                                    <span
                                        class="font-md"><?php print $user->first_name . ' ' . $user->last_name;?></span>
                                    <br/>
                                    <span class="font-xs text-muted"><?= $user->academic_year; ?>
                                        Student - <?= $user->course_type; ?></span>
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    $datestring = "%M %j, %Y at %h:%i %a";
                                    $datetime = $post->date_added;

                                    $unix = mysql_to_unix($datetime);
                                    ?>
                                    <small class="text-muted pull-right ultra-light">Posted Yesterday</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Poster details -->
                </div>
                <!-- End of Post Description -->


                <!-- Post Comments -->
                <div class="panel-footer">

                    <p><a href="#">Comments</a></p>

                    <form action="#" method="post" class="smart-form" accept-charset="utf-8">
                        <label class="input">
                            <i class="icon-append fa fa-comment"></i>
                            <input type="text" placeholder="Comment..."/>
                        </label>
                    </form>
                </div>
                <!-- End of Post Comments -->

            </div>
        <?php endforeach; ?>
    </div>

    <div class="col-md-4">
        <div class="well">
            <h3>My Profile</h3>

            <p>This is my profile</p>
        </div>
    </div>

</section>
