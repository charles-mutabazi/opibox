<?php
class Image_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    function image_manuplation(){
        $image_data = $this->upload->data();

        $image_path = $image_data['full_path'];

        //Resizing the image
        $config['image_library'] = 'gd2';
        $config['source_image']	= $image_path;
        $config['maintain_ratio'] = true;
        $config['width'] = 200;
        $config['height'] = 200;
        $config['overwrite'] = TRUE;

        //Initialize the new config
        $this->image_lib->initialize($config);

        if(!$this->image_lib->resize()){

            echo $this->image_lib->display_errors('<p>', '</p>');
            return false;

        }

        //Cropping the image
        $config['source_image']	= $image_path;
        $config['maintain_ratio'] = false;
        $config['width'] = 200;
        $config['height'] = 200;

        $vals = @getimagesize($image_path);
        $width = $vals['0'];
        $height = $vals['1'];
        $config['x_axis'] = ($width - 200)/2;
        $config['y_axis'] = ($height - 200)/2;

        //Initialize the new config
        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        if(!$this->image_lib->crop()){

            echo $this->image_lib->display_errors('<p>', '</p>');
            return false;

        }
    }
} 