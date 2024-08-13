<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v15.0/115984441430416/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "messaging_product": "whatsapp", "to": "918485079273", "type": "template", "template": { "name": "hello_world", "language": { "code": "en_US" } } }');

//curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "messaging_product": "whatsapp", "to": "918485079273", "type": "image", "image": { "link": "https://www.w3schools.com/html/img_girl.jpg" } }');


$headers = array();
$headers[] = 'Authorization: Bearer EAAKidsaLsjcBAAOFjIwhGGITsOSMVrvGlC0fdYwEghnHi5HrLvzr7QLLZATTmWI55UeL36HLoNbYojh7JnM1Re27eVW2NpUZB115gOKDNOQ0IUbpVjTujlmnh18lJgcrB4AJArrTpRCjafrQj2MsuSUxiHuNSJCh8CqZCxlKFIZAEZAb2yiGIPPvM7tYIfyR7mtfE0CZB96JGqxw9ggdhn';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo "Success";
}
curl_close($ch);
?>