	SSLProxyEngine On  
	SSLProxyVerify none  
	SSLProxyCheckPeerName off  
	SSLProxyCheckPeerCN off  
	SSLProxyCheckPeerExpire off  
	ProxyPreserveHost On  
	ProxyPass "/"  "http://localhost:80/"  
	ProxyPassReverse "/"  "http://localhost:80/"  
	ProxyPass "/.well-known" !  