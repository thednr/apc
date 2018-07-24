<?php


/*
$addr_info = array(
    0 => 27,
    1 => 445,
    3 => 4754
);
$str = 'region = ' . implode(' or region = ', $addr_info);
echo $str;
exit();
*/
//市南区
$address = '重庆市重庆市渝中区七星岗街道重庆市南岸区金紫街协信星光时代小区2-1-13可购店收';
$address = str_replace(' ', '', $address);
preg_match('/(.*?(省|自治区|北京市|天津市|重庆市))+(.*?(市|自治州|地区|区划))?+(.+?(区|县|镇|乡|街道|市))?/', $address, $matches);
$str = preg_replace('/(.*?(省|自治区|北京市|天津市))+(.*?(市|自治州|地区|区划))?+(.*?(区|县|镇|乡|街道|市))?/', '', $address);
echo $str;
echo'<pre>';
print_r($matches);
exit();

$paytime = date('Y-').str_replace('日','',str_replace('月','-',substr('6月19日下单', 0, strpos('6月19日下单','下单')))).' 10:00:00';
echo $paytime;
exit();

echo file_get_contents('https://api.fcvoid.com/lamezhi-user/user/token/getToken');
exit();
echo strtotime('+7 days', 1524104035);
exit();

echo number_format(1234, 2, '.', '');
exit();

echo urlencode('/mobile/index.php?app=goods&id=267');
exit();

echo strtotime('2018-05-08 10:35:00');
echo '<br/>';
echo date('Y-m-d H:i:s',time());
exit();

$str = '1234';

echo password_hash($str, PASSWORD_DEFAULT);
exit();




$str="您的老客户周二在2017-12-06 18:51购物";
$back = array();
$arr = array(
    ['您的新客户','在'],
    ['您的老客户','在'],
    ['辣客','在'],
    ['','成为了你的辣客会员'],
    ['下级辣客','购买','佣金'],
    ['非辣客会员','购买','佣金'],
    ['辣客','成功','佣金'],
    ['','成为'],
    ['你获得了','元'],
    ['级合伙人','购买了商品','佣金'],
    ['','成为了你的第'],
    ['','购买了商品','佣金']
);
foreach($arr as $val){
    $pattern = '/'.$val[0].'(.*?)'.$val[1].'.*?'.(isset($val[2])?$val[2]:'').'(.*?)$/';
    preg_match($pattern, $str, $matches);
    if(!empty($matches) && isset($matches[1])){
        $back['red'] = $matches[1];
        $back['title_adr'] = str_replace($matches[1],'<font color="#B4282D">'.$matches[1].'</font>',$str);
        $back['money'] = 0;
        if(isset($matches[2])&&is_numeric($matches[2])){
            $back['money'] = $matches[2];
            $back['title_adr'] = str_replace($matches[2],'<font color="#B4282D">'.$matches[2].'</font>',$back['title_adr']);
        }
        break;
    }
}
// $pattern2 = '/佣金(.*?)$/';
// preg_match($pattern2, $str, $matches2);
// if(!empty($matches2) && isset($matches2[1])){
//     $back['money'] = $matches2[1];
// }

print_r($back);
exit();

$nowtime =  date('Y-m-d H:i:s'); //当前时间
echo $nowtime;exit();

$a = new \stdClass();
if(!empty($a)){
    die('do it');
}
exit();

echo date('i');exit();
$arr = range(0,10);
//print_r($arr);exit();
foreach($arr as $k=>$v){
    echo $v.'<br/>';
    if($k % 3 == 0){
        sleep(3);
    }
}
exit();


$exchange = 'rabbit-ex';
$queue = 'rabbit';
$consumerTag = 'consumer';
$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();
//echo'<pre>';
/*
    The following code is the same both in the consumer and the producer.
    In this way we are sure we always have a queue to consume from and an
        exchange where to publish messages.
*/
/*
    name: $queue
    passive: false
    durable: true // the queue will survive server restarts
    exclusive: false // the queue can be accessed in other channels
    auto_delete: false //the queue won't be deleted once the channel is closed.
*/
var_dump($channel->queue_declare($queue, false, true, false, false));

// $msg = new AMQPMessage('Hello World for RabbitMQ!');
// $channel->basic_publish(new AMQPMessage('Hello World for RabbitMQ!'), '', 'hello');

// die(" [x] Sent 'Hello World!'");


$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume($queue, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}
die('done');
/*
    name: $exchange
    type: direct
    passive: false
    durable: true // the exchange will survive server restarts
    auto_delete: false //the exchange won't be deleted once the channel is closed.
*/

var_dump($channel->exchange_declare($exchange, 'direct', false, true, false));

var_dump($channel->queue_bind($queue, $exchange));

/**
 * @param \PhpAmqpLib\Message\AMQPMessage $message
 */
function process_message($message)
{
    echo "\n--------\n";
    echo $message->body;
    echo "\n--------\n";
    $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
    // Send a message with the string "quit" to cancel the consumer.
    if ($message->body === 'quit') {
        $message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
    }
}
/*
    queue: Queue from where to get the messages
    consumer_tag: Consumer identifier
    no_local: Don't receive messages published by this consumer.
    no_ack: Tells the server if the consumer will acknowledge the messages.
    exclusive: Request exclusive consumer access, meaning only this consumer can access the queue
    nowait:
    callback: A PHP Callback
*/

$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');
//var_dump(count($channel->callbacks));exit();
/**
 * @param \PhpAmqpLib\Channel\AMQPChannel $channel
 * @param \PhpAmqpLib\Connection\AbstractConnection $connection
 */
function shutdown($channel, $connection)
{
    $channel->close();
    $connection->close();
}
register_shutdown_function('shutdown', $channel, $connection);
// Loop as long as the channel has callbacks registered
while (count($channel->callbacks)) {
    $channel->wait();
}

echo date('m');
exit();

$order_id_array = explode(',','13418531853,12314564856');
var_dump($order_id_array);
$arr = reset($order_id_array);
var_dump($arr);
exit();

ob_start();
echo 'Text that won\'t get displayed.';
ob_end_clean();
echo 'this is a test';
exit();

echo ceil('0.00');
exit();

$str = '40,449.60';
echo number_format($str,0);
exit();
$pvs = '16:71;16:72;16:73;18:90;22:108';
$arr = explode(';',trim($pvs,';'));
echo'<pre>';print_r($arr);exit();

$str1 = '201806980342|201806964385';
$str2 = '201806980342';

$arr1 = explode('|',$str1);
$arr2 = explode('|',$str2);

var_dump($arr1);
var_dump($arr2);
exit();

echo ceil(3.9);
exit();

/**
 * 搜索数组，将遍历子数组，如果子数组中搜索成功，则返回父数组下标
 * @param int $need
 * @param array $arr 
 * @param int
 */
function searchArr($need,$arr){
    $back = 0;
    foreach($arr as $k=>$v){
        if(is_array($v)){
            foreach($v as $v_){
                if($v_ == $need){
                    $back = $k;
                }
            }
        }elseif($v == $need){
            $back = $k;
        }
    }
    return $back;
}

$statusArr = array(
    //交易状态:
    //0=>0,//未创建交易 ERP基本作废
    1=>11,//等待付款
    2=>20,//等待发货
    3=>40,//已完成
    4=>array(0,50), //已关闭
    5=>30,//等待确认
    //6=>40//已签收
);

echo searchArr(40,$statusArr);
exit();

echo date('Y-m-d H:i:s',1520387698+(60*60*24-1));
exit();

$arr = array(
    2=>array(
        array('goods_id'=>123),
        array('goods_id'=>124),
        array('goods_id'=>125),
    ),
    126=>array(
        array('goods_id'=>123),
        array('goods_id'=>124),
        array('goods_id'=>125),
    )
);
echo count($arr);
exit();

echo date('Y-m',time()).'<br/>';
echo strtotime(date('Y-m',time()).'-1 00:00:00');
exit();

echo '<script type="text/javascript">localStorage.setItem("user_ids",2923);localStorage.setItem("lakeId",62923);location.href="http://www.lamezhi.comindex.php?app=goods&id=1224&sharelkid=62921&lkuser_id=2921&from=singlemessage&isappinstalled=0";</script>';

exit();


$url = 'http://www.lamezhi.com/index.php?app=goods&sharelkid=60226&lkuser_id=226';
$str = parse_url($url,PHP_URL_QUERY);
$arr = array();
parse_str($str,$arr);
print_r($arr);
$sharelkid = 'Null';
if(!empty($sharelkid)){
    echo $sharelkid;
}

exit();
$str = '1.2';
echo substr($str,0,3);
exit();
$data= array(
    "user_id"=>"2921",  //被通知的用户ID
    "msg_title"=>"辣客成功邀请通知",
    "msg_content"=>"成功邀请{lakename}为下级辣客，{money}将对方拉入你的辣客微信群，传递辣么值理念，指导工作方法。",
    "add_time" => time(),
    'user_name'=>'发现',
    "extras"=>[
        "type"=>"lake",
        "notify_url"=>"",
        "user_id"=>"2921",
        'money'=>101.2
    ]
);
$str = str_replace('{money}', isset($data['extras']['money'])?number_format($data['extras']['money'],2):'',
            str_replace('{time}',date('Y-m-d H:i',$data['add_time']),
                str_replace('{lakename}', $data['user_name'], '成功邀请{lakename}为下级辣客，{money}将对方拉入你的辣客微信群，传递辣么值理念，指导工作方法。')
            )
        );
echo $str;
exit();

$type = 'login';
if (!in_array($type, array('register', 'find', 'change'))) {
    die('false');
}
exit();
//150012986,226472004
echo intval(226472004);
exit();


$arr = array(0=>array('user_id1'=>1,'user_id2'=>2,'user_id3'=>3));
$arr1 = array(0=>array('user_id4'=>4,'user_id5'=>5));
print_r(array_merge($arr,$arr1));
exit();

$base_info = array(
    'order_sn' =>23,
    'buyer_id'=>1,
    'buyer_name'=>2,
    'buyer_email'=>3,
    'status'=>11,
    'expiry_date'=>4,
    'order_amount'=>5,
    'created_at'=>time()
);
$str = http_build_query($base_info);
$str = str_replace('=',"='",$str);
$str = str_replace('&',"',",$str);
echo $str;
exit();
//print_r("'".implode("','",$base_info)."'");
//print_r(array_keys($base_info));
//print_r("'".implode("','",array_keys($base_info))."'");
echo 'insert into lake_vip_order ("'.implode('","',array_keys($base_info)).'") values ("'.implode('","',$base_info).'")';
exit();
$redbag = array(1=>2.88, 0.66, 1.23, 0.88, 2.66);
print_r($redbag);exit();

echo urlencode('LaMeZhi@)17#EsCNgy&');
exit();
print_r(parse_url("mysql://tenpercent:LaMeZhi@)17#EsCNgy&@118.89.23.125:3306/tenpercent_test"));
exit();

echo random_int(0,4);
exit();

echo date('z').'<br/>';
echo date('Y').sprintf('%03d', date('z')).random_int(10000, 99999);
exit();

$code ='0050081';
$str = sprintf('%05d',$code);
echo $str;exit();

$str = '{"total":1,"inventories":[{"oln_item_id":"V020111014","item_code":"V020111014","quantity":134.0000,"batchs":[],"sku_code":"V0201110140101","available":128.0000,"storage_code":"001","storage_name":"默认仓库","modified":"2018-01-12 14:44:25","oln_sku_id":"V0201110140101"}],"page":1}';
$arr = json_decode($str,1);
echo'<pre>';
print_r($arr);
exit();

$now = time();
echo $now.'<br/>';
echo $now + 5 * 60;

exit();
$str = ['辣客13510798485在2017-12-14 20:00卖出了商品',
         '您的老客户13510798485在2017-12-11 16:23购物',
         '15878521478成为了你的辣客会员',
         '您的新客户13510798485在2017-12-11 16:23购物'];
$back['red'] = array();
echo '<pre>';
$matches = array();
foreach($str as $v){
    $arr = array(
        ['您的新客户','在'],
        ['您的老客户','在'],
        ['辣客','在'],
        ['','成为了你的辣客会员']
    );
    foreach($arr as $val){
        $pattern = '/'.$val[0].'(.*?)'.$val[1].'/';
        echo $pattern.'<br/>';
        preg_match($pattern, $v, $matches);
        if(!empty($matches)){
            //print_r($matches);
            
        }
    }
}

?>