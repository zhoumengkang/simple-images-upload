    //上传图片用
    public function uploadImage(){
        include_once './UploadFile.class.php';
        $config['maxSize'] = 3145728;
        $config['savePath'] = './Uploads/';
        $config['allowExts'] = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $config['thumb'] = true;
        $config['thumbPrefix'] = 'm_';
        $config['thumbMaxWidth'] = '200';
        $config['thumbMaxHeight'] = '200';
        $upload = new UploadFile($config);
        if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
            echo '<script>ui.error('.$upload->getErrorMsg().');</script>';
        }else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
            //存放到qk_attachment附件表
            $data['filename'] = $info[0]['name'];
            $data['filesize'] = $info[0]['size'];
            $data['fileext'] = $info[0]['extension'];
            $data['userid'] = $this->userid;
            $data['uploadtime'] = time();
            $data['uploadip'] = get_client_ip();
            $data['module'] = 'contents';
            $data['isimage'] = 1;
            $data['status'] = 1;
            $data['filepath'] = $info[0]['savepath'].$info[0]['savename'];

            $aid = M('attachment')->add($data);
            $res['url'] = $info[0]['savepath'].$info[0]['savename'];
            $res['aid'] = $aid;
            $res = json_encode($res);
            echo '<script>window.parent.updataface('.$res.');</script>';
        }
        //$this->success('数据保存成功！');
    }
