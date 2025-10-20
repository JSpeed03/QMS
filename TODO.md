# PWA Conversion for ECA-LB-SSQMS (Root to Kiosk)

- [x] Create manifest.json with app metadata and icons (Kiosk only)
- [x] Create service-worker.js for caching static assets (Kiosk only)
- [x] Edit index.html to reference manifest and register service worker (Kiosk only)
- [x] Move manifest.json to root directory
- [x] Update manifest.json for full app (change start_url to "/index.php", update name and description)
- [x] Update service-worker.js to cache root assets (index.php, Home_bg_Video videos, logos) and existing Kiosk assets
- [x] Edit index.php to link manifest and register service worker
- [x] Test PWA installation on mobile (manifest and service worker accessible, valid JSON, correct paths)
