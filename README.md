# Docker + Worpress
### List of Docker images w/ custom format
  `docker ps --format "table {{.ID}}\t{{.Image}}\t{{.Names}}\t{{.Ports}}"`

### Enter ID volume
  `docker exec -u root -it <id> /bin/bash`

### Allow WP handle itself
  ```
  chown -R www-data wp-content
  chmod -R 777 wp-content
  ```
  ```
  chown -R www-data wp-admin
  chmod -R 777 wp-admin
  ```
  ```
  chown -R www-data wp-includes
  chmod -R 777 wp-includes
  ```