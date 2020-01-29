
<?php
$conn = mysqli_connect("www.delycomps.com", "carlosfarro", "IfarroPAD12solrac", "carlosfa_ToursCix");
        
if ($conn->connect_error) {
	die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
$conn->query("SET NAMES 'utf8'");
$sql = "update festividad SET 
        fecha_fest = DATE_ADD(fecha_fest, INTERVAL IF(STRCMP(concurrencia, 'Mensual') = 0, 1, 0) month),
        fecha_fest = DATE_ADD(fecha_fest, INTERVAL IF(STRCMP(concurrencia, 'Anual') = 0, 1, 0) year),
        estado = 'I'
        where (concurrencia = 'Mensual' or concurrencia = 'Anual') and  date_add(fecha_fest, INTERVAL duracion_fest DAY) <= date_add(now(), INTERVAL 1 DAY)";
$conn->query($sql);

$sql = "SELECT f.nombre_fest, f.ruta_foto, f.cod_fest, f.fecha_fest
        FROM festividad f 
        WHERE (DATEDIFF(fecha_fest, NOW()) = 1 or DATEDIFF(fecha_fest, NOW()) = 7 or DATEDIFF(fecha_fest, NOW()) = 0) and estado = 'H'";
$res = $conn->query($sql);

while($fes = $res->fetch_object()) {
    
    $fields = array(
        'to' => '/topics/allu',
        'data' =>  array(
                'title' => $fes->nombre_fest,
                'message' => 'Preparate que está a ' . $fes->daysto . ' días.',
                'image-url' => $fes->ruta_foto,
                'cod_fest' => $fes->cod_fest,
                'action' => '',
                'action_destination' => ''
            ),
    );
    // Set POST variables
    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array(
                'Authorization: key=AAAAyzKccRg:APA91bFamALRtsrYPn-A_BMwPdAbXzfpQeM6kJz40_ZbG3qEDmZFAldte12owPmLWmYIJh0ytV5UUSwcms_mAhUh_b689JVUoz7RE7aPDjC1B094zds-zHbxe0KqMVlF8eF3AQW2ULby',
                'Content-Type: application/json'
                );        
    // Open connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Disabling SSL Certificate support temporarily
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));       
    
    $result = curl_exec($ch);
    
    var_dump($fields);    
    if($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);

}


$conn->close();