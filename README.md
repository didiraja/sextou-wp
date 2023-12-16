# Docker + Worpress

### List of Docker images w/ custom format

`docker ps --format "table {{.ID}}\t{{.Image}}\t{{.Names}}\t{{.Ports}}"`

### Enter ID volume

`docker exec -u root -it <id> /bin/bash`

### Allow Docker update WP

`chown -R www-data:www-data /var/www/html`

### Log machine

`docker logs -f --details <name>`
