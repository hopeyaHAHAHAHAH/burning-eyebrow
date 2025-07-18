const CACHE_NAME = 'burning-eyebrow-v1';
const URLS_TO_CACHE = [
  '/',
  '/register.html',
  'https://cdn.tailwindcss.com', // optional
  '/images/icon-192.png',
  '/images/icon-512.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(URLS_TO_CACHE))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => response || fetch(event.request))
  );
});
