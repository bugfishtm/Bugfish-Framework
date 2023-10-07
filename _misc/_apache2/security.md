	Header always set Strict-Transport-Security "max-age=63072000; includeSubDomains"
	Header set X-XSS-Protection "1; mode=block" 
	Header set X-Content-Type-Options nosniff
	Header set X-Frame-Options "sameorigin"
	Header add Content-Security-Policy "default-src *  data: blob: filesystem: about: ws: wss: 'unsafe-inline' 'unsafe-eval' 'unsafe-dynamic'; script-src * data: blob: 'unsafe-inline' 'unsafe-eval'; connect-src * data: blob: 'unsafe-inline'; img-src * data: blob: 'unsafe-inline'; frame-src * data: blob: ; style-src * data: blob: 'unsafe-inline'; font-src * data: blob: 'unsafe-inline';"
	Header set Referrer-Policy "same-origin"