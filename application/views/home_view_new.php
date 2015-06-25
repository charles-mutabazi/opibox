<div class="row">
    <div class="col-md-8">

        <!--Post Form-->
        <?php include_once(APPPATH.'views/template/post_form.php');?>

        <!-- Posts List-->

        <?php foreach ($all_posts as $post):

            $user = $this->user_model->get_user_by_id($post->user_id);
            $post_id = $post->id;

            $did_vote = $this->post_model->did_vote($post_id, $logged_userid);
            $disabled = "";
            if ($did_vote) {
                $disabled = "disabled";
            }
            ?>
            <br>
            <div class="panel panel-default animated fadeInUp">
                <!-- Post Description -->
                <div class="panel-body my_panel">
                    <div class="row">

                        <!-- Poster details -->
                        <div class="col-xs-3 pull-left">
                            <div class="row text-align-center">
                                <div class="col-sm-12">
                                    <a href="#">
                                        <img src="<?php echo $this->user_model->image_path($user->profile_pic); ?>"
                                             class="img-circle post-pic">
                                    </a>
                                </div>
                            </div>
                            <div class="row text-align-center">
                                <div class="col-xs-12">
                                    <span><a
                                            href="<?= base_url('user/' . $user->id) ?>"><strong><?php print $user->first_name . ' ' . $user->last_name;
                                                ?></strong></a></span>
                                </div>
                            </div>

                            <div class="row text-align-center hidden-xs">
                                <div class="col-xs-12">
                                <span class="font-xs text-muted"><?php print $user->academic_year; ?>
                                    Student - <?= $user->course_type; ?></span>
                                </div>
                            </div>

                            <div class="row text-align-center">
                                <div class="col-xs-12">
                                    <small class="ultra-light"><?= post_model::getDate($post->date_added) ?></small>
                                </div>
                            </div>
                        </div>
                        <!-- End of Poster details -->

                        <!-- Post Vote UP/Down -->
                        <div class="col-xs-2 pull-right text-align-center">

                            <form action="javascript:void(0)" name="vote_handles_<?= $post_id ?>" method="post"
                                  id="vote_handles_<?= $post_id ?>" enctype="multipart/form-data">
                                <div class="row font-xl">
                                    <div class="col-xs-12">
                                        <button id="vote_up_<?= $post_id ?>" name="vote_up" type="submit"
                                                class="btn btn-success btn-circle <?= $disabled ?>">
                                            <i class="fa fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>

                                <input type="hidden" name="user_id"
                                       value="<?= $logged_userid; ?>">
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                                <div class="row font-xl">
                                    <div class="col-xs-12">
                                        <span id="vote_weight_<?= $post_id ?>"><?= $post->votes; ?></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
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
                        <div class="col-xs-7 ">
                            <?php
                            //The Regular Expression filter
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                            // The Text you want to filter for urls
                            $text = $post->post_text;

                            // Check if there is a url in the text
                            if (preg_match($reg_exUrl, $text, $url)) {
                                ?>
                                <p><?php echo preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a> ", $text); ?></p>
                            <?php } else { ?>
                                <p><?= $text ?></p>
                            <?php }?>
                        </div>
                        <!-- End of Post Text-->
                    </div>
                </div>
                <!-- End of Post Description -->

                <!-- Post Comments -->
                <div class="panel-footer">
                    <?php
                    $comments = post_model::get_post_comments($post_id);
                    ?>
                    <p><a href="#">Comments (<?= count($comments); ?>)</a></p>

                    <?php if (count($comments) > 0): ?>
                        <?php foreach ($comments as $item): ?>
                            <div class="comments">

                                <?php $postedby = $this->user_model->get_user_by_id($item['user_id']); ?>

                                <div class="row">
                                    <div class="col-xs-1">
                                        <img src="<?php echo $this->user_model->image_path($postedby->profile_pic); ?>"
                                             alt="" class="img-rounded small-pic">
                                    </div>

                                    <div class="col-xs-11">
                                        <p>
                                            <strong>
                                                <a href="<?= base_url('user/' . $postedby->id) ?>">
                                                    <?= $postedby->last_name . " " . $postedby->first_name; ?>
                                                </a>
                                            </strong>
                                        </p>
                                        <!--The Comment text-->
                                        <?= $item['comment']; ?>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php
                    $attributes = array(
                        'class' => 'smart-form',
                        'name' => 'comment_form',
                        'id' => 'comment_' . $post_id

                    );
                    echo form_open("javascript:void(0)", $attributes);
                    ?>
                    <label class="input">
                        <i class="icon-append fa fa-comment"></i>
                        <input type="text" name="comment_text" placeholder="Comment..." autocomplete="off"/>
                        <b class="tooltip tooltip-bottom-right">Press Enter to Comment</b>
                    </label>
                    <input type="hidden" name="user_id" id="user_id"
                           value="<?php echo $logged_userid; ?>">
                    <input type="hidden" name="post_id" id="post_id"
                           value="<?php echo $post_id; ?>">
                    <?php echo form_close(); ?>
                </div>
                <!-- End of Post Comments -->

            </div>

            <!-- aJax way of saving -->
            <script type="text/javascript">
                $(document).ready(function () {
                    //pageSetUp();

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
            <!-- END aJax way of saving -->

        <?php endforeach; ?>
    </div>

    <!-- This is the user side-bar-->
    <div class="col-md-4 hidden-sm hidden-xs animated fadeIn">
        <div class="row text-align-center">
            <div class="col-xs-12">
                <img src="<?php echo $pic_path; ?>" alt=""
                     class="img-circle text-align-center prof-pic">
            </div>
        </div>
        <div class="row text-align-center">
            <div class="col-xs-12">
                <h1 class="txt-color-blueDark">
                    <a href="<?= base_url('user/' . $logged_userid) ?>"><?= $logged_user->first_name ?> <span
                            class="semi-bold"><?= $logged_user->last_name ?></span></a>
                    <br>
                    <small>M1 Student - Innovators Course</small>
                </h1>
            </div>
        </div>

        <div class="row text-align-center">
            <div class="col-xs-12">
                <p>
                    <span class="label label-warning font-sm">Profession</span> |
                    <span class="badge bg-color-red font-sm">232</span>
                    <small>Points</small>
                </p>

            </div>
        </div>

        <br>

        <div class="text-align-center">
            <ul class="list-inline">
                <li class="text-warning"><a href="#"><i class="fa fa-briefcase"></i> Go to Moodle</a></li>
                <li class="text-danger"><a href="#"><i class="fa fa-bullhorn"></i> Anouncements </a></li>
                <li class="txt-color-greenDark"><a href="#"><i class="fa fa-globe"></i> KIC Website</a></li>
            </ul>
        </div>
    </div>

</div>