# Docker + Worpress


### List of Docker IDs
  sudo docker ps -aqf "name=wp"

### Enter ID volume
  docker exec -u root -it <id> /bin/bash

### Allow WP auto delete
  ```
    chown -R www-data wp-content
    chmod -R 755 wp-content
  ```