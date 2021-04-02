<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/7 8:37 下午
 * description : 响应图片
 */

class Gring_Hi_Messages_Image extends Gring_Hi_Messages_Message {

    private $proxy;

    /**
     * @return array|string[]
     */
    public function getContent() {
        return array('content' => $this->fileToBase64($this->attributes['content'])."\n");
    }

    /**
     * @param $proxy
     * @return $this
     */
    public function setProxy($proxy) {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProxy() {
        return $this->proxy;
    }

    /**
     * @param $file
     * @return string
     */
    private function fileToBase64($file, $folder = 'hi_robot') {
        $folder = DATA_PATH."/uploads/images/$folder/".date("Ym/d", time());
        $this->directory($folder);
        $filename = $folder.'/'.time();
        $curl = new Gring_Service_Curl();
        $curl->withProxy($this->getProxy())
            ->to($file)
            ->download($filename);
        $image_info = getimagesize($filename);
        $image_data = file_get_contents($filename);

        return 'data:'.$image_info['mime'].';base64,'.base64_encode($image_data);
    }

    /**
     * @param $dir
     * @return bool
     */
    public function directory($dir) {
        return is_dir($dir) or $this->directory(dirname($dir)) and mkdir($dir, 0777);
    }
}