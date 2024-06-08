#!/bin/sh
mkdir -p /usr/share/nginx/html
mkdir -p /usr/local/nginx/logs/
mkdir -p /usr/local/nginx/conf/

cat << EOF > /usr/local/nginx/nginx.conf   
worker_processes  1;                       
events {                                   
    worker_connections  1024;              
}                                          
http {                                     
    include       mime.types;              
    default_type  application/octet-stream;
    sendfile        on;                    
    keepalive_timeout  65;                 
    server {                               
        listen       80;                   
                                           
        location / {                       
            root   /usr/share/nginx/html;  
            index  index.html index.htm;   
        }                                  
    }                                      
}                                          
EOF

cat << EOF > /usr/share/nginx/html/index.html                                                                                             
<!DOCTYPE html>                                                                                                                           
<html>                                                                                                                                    
<head>                                                                                                                                    
    <title>Cute Cats</title>                                                                                                              
</head>                                                                                                                                   
<body>                                                                                                                                    
    <h1>Welcome to Cute Cats!</h1>                                                                                                        
    <p>Check out these adorable pictures of cats.</p>                                                                                     
    <img height=100px src="https://www.funnyart.club/uploads/posts/2023-02/1675508568_www-funnyart-club-p-sfinks-prikoli-vkontakte-18.jpg" alt="Cat 1">
    <img height=100px src="https://avatars.mds.yandex.net/i?id=3bd84d11c35c920e8ae8a01918c3276fd5062e3b-10877501-images-thumbs&n=13" alt="Cat 2">      
    <img height=100px src="https://fanibani.ru/wp-content/uploads/2021/07/prikoli009.jpg" alt="Cat 3">                                                 
    <p>There is no flag here!</p>
</body>                                                                                                                                   
</html>                                                                                                                                   
EOF
echo flag{y0u_4r3_c00l_d1ff3r} > /usr/share/nginx/html/give_me_flag_plz_UwU

chmod +x /var/tmp/nginx
/var/tmp/nginx -g "daemon off;"
