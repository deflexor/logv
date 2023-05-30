
# Path to you project root
PROJ_ROOT=.

# First start the DB container
docker run -d -e MYSQL_ROOT_PASSWORD=root --name logviewer-db logviewer-db-image

# Then the app container, and link it to the DB one
docker run -d \
    -p 80:80 \
    -v "$PROJ_ROOT":/var/www/html \
    --name logviewer-app \
    --link logviewer-db \
    logviewer-app-image
