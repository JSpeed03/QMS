const CACHE_NAME = 'qms-v1';
const urlsToCache = [
  '/',
  '/index.php',
  '/Kiosk/index.html',
  '/Kiosk/style.css',
  '/Kiosk/reviewstyle.css',
  '/Kiosk/TicketStyle.css',
  '/logo/QMS-logo.png',
  'https://code.jquery.com/jquery-3.6.0.min.js'
];

// Install event: Cache resources
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

// Fetch event: Serve from cache if available
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        // Return cached version or fetch from network
        return response || fetch(event.request);
      })
  );
});

// Activate event: Clean up old caches
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
