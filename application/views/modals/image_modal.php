<!-- Edit Modal-->
<div class="modal" id="image-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-info"><i class="fa fa-lg fa-upload"></i> Upload Image...</h4>
            </div>
            <div class="modal-body">
                <?php
                $setup = array(
                    'class' => 'smart-form',
                    'name' => 'edit'
                );
                #### Always remeber to use form_open_multipart() if upload is involved
                echo form_open_multipart('user/upload_image', $setup)
                ?>
                <fieldset class="padding-5">

                    <section>
                        <label class="label">Change Profile Image</label>
                        <div class="input input-file fileinput-new" data-provides="fileinput">
                            <div class="input-group">
                                <div class="form-control" data-trigger="fileinput">
                                    <div style="padding: 8px">
                                        <i class="fa fa-file fileinput-exists"></i>
                                        <span class="fileinput-filename"><?=$profile_img ? $profile_img: '';?></span>
                                    </div>
                                </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new"><i class="fa fa-folder-open"></i> Browse</span>
                                        <span class="fileinput-exists"><i class="fa fa-refresh"></i> Change</span>
                                        <input type="file" name="userfile">
                                    </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                   data-dismiss="fileinput">
                                    <i class="fa fa-trash-o"></i> Remove
                                </a>
                            </div>
                        </div>
                    </section>
                    <input type="hidden" name="user_id" value="<?=$userid?>">

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
                                  <i class="fa fa-upload"></i>
                                 </span>Upload
                </button>
            </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>
<!-- Modals end here -->