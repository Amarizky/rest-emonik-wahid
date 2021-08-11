<?
if($response['errorCode'] == 200){
$params = json_decode(file_get_contents('php://input'), TRUE);
$config['upload_path'] = './uploads/';
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size'] = 100;
$config['max_width'] = 1024;
$config['max_height'] = 768;

$this->load->library('upload', $config);

$encrypted_gambar = md5($params['orig_filename']);
$params['orig_filename'] = $params['orig_filename'];
$params['filename'] = $encrypted_gambar;
$params['urlgambar']="http://kahftekno.com/rest-emonik/uploads/$encrypted_gambar";
$resp = $this->m_gambar_produk->create_data($params);

if ($resp['errorCode'] == 200) {
$stat = "SUCCESS";
}else{
$stat = "ERROR";
}
$count = array($resp);
$jsonAr = array(
"_meta" => array('status' => $stat,'count' => count($count)),
"result" => $resp
);
json_output($resp['errorCode'],$jsonAr);
}else{
$respStatus = 201;
$jsonAr = array(
"_meta" => array('Status' => 'ERROR','count' => 1),
"result" => array('errorCode' => 201,'userMessage' => 'Title & Author can\'t empty')
);
$resp = $jsonAr;
json_output($respStatus,$resp);
}
