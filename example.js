(function(w, d, s, u) {
	w.RocketChat = function(c) { w.RocketChat._.push(c) }; w.RocketChat._ = []; w.RocketChat.url = u;
	var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
	j.async = true; j.src = 'http://chat.inumio.com:3000/livechat/rocketchat-livechat.min.js?';
	h.parentNode.insertBefore(j, h);
})(window, document, 'script', 'http://chat.inumio.com:3000/livechat');
