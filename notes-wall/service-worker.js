var dataCacheName = 'tvn-notewall-data-v1.1';
var cacheName = 'tvn-notewall-1.1';
var filesToCache = [
	'',
	'index.php',
	'scripts/app.js',
	'styles/inline.css',
	'styles/icon.woff',
	'../0common/common.css',
	'images/icons/icon.png',
	'images/icons/icon-32x32.png',
	'images/icons/icon-128x128.png',
	'images/icons/icon-144x144.png',
	'images/icons/icon-152x152.png',
	'images/icons/icon-192x192.png',
	'images/icons/icon-256x256.png',
	'images/icons/icon-512x512.png',
	'images/icons/lhv-384x384.png',
];

self.addEventListener('install', function(e) {
	e.waitUntil(
		caches.open(cacheName).then(function(cache) {
			return cache.addAll(filesToCache);
		})
	);
});

self.addEventListener('activate', function(e) {
	e.waitUntil(
		caches.keys().then(function(keyList) {
			return Promise.all(keyList.map(function(key) {
				if (key !== cacheName && key !== dataCacheName) {
					return caches.delete(key);
				}
			}));
		})
	);
	return self.clients.claim();
});
