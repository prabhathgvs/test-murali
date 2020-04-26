<?php
header('Content-Type: text/xml');
$data = $_REQUEST;
//print_r($data);
if($_SERVER['REQUEST_METHOD'] == 'PUT') {
        parse_str(file_get_contents("php://input"),$put_data);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_data = $_REQUEST;
}
$xml = new SimpleXMLElement('<notes/>');
$data = array( 'pbk' => array(
        'to' => 'prabhath',
        'from' => 'murali',
        'heading' => 'This is a note'
),
'kmk' => array(
        'to' => 'ishaan',
        'from' => 'pratibha',
        'heading' => 'hello'
)
);
if ($post_data) {
        $pkey = $_POST['id'];
        $data[$pkey] = array(
                                'to' => $post_data['to'],
                                'from' => $post_data['from'],
                                'heading' => $post_data['note']
                );
}
if ($put_data) {
        $pkey = $_POST['id'];
        $data[$pkey] = array(
                                'to' => $put_data['to'],
                                'from' => $put_data['from'],
                                'heading' => $put_data['note']
                        );
}
//print_r($data);
foreach ($data as $key => $item) {
        $track = $xml->addChild('note');
        $track->addChild('id', $key);
        $track->addChild('to', $item['to']);
        $track->addChild('from', $item['from']);
        $track->addChild('heading', $item['note']);
}
        Header('Content-type: text/xml');
        print($xml->asXML());
exit();
