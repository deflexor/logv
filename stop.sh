
set -e

echo "Stopping containers..."
docker stop yktoo-db yktoo-app

echo "Removing containers..."
docker rm yktoo-db yktoo-app

echo "Done."
