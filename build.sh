# Build the app container image
docker build -t logviewer-app-image -f "Dockerfile-app" .

# Build the DB container image
docker build -t logviewer-db-image -f "Dockerfile-db" .