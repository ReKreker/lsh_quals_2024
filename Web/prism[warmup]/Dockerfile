# Sử dụng hình ảnh Nginx chính thức từ Docker Hub
FROM nginx:alpine


COPY app  /usr/share/nginx/html/

EXPOSE 80

# Khởi động Nginx
CMD ["nginx", "-g", "daemon off;"]
