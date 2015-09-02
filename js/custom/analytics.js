$(function() {
    _linkTracker = {
        "init": function(affID) {
            var cID = this.getGa();
            if (!affID) {
            	return;
            }
            this.appendQuery(cID, affID);
        },
        "trackOutbound": function(url, href, loc) {
            ga('send', 'event', 'outbound', loc, url, {
                'hitCallback': function() {
                    document.location = href;
                }
            });
            ga('send', 'pageview', {
                'page': 'outbound: ' + url
            }, {
                'hitCallback': function() {
                    document.location = href;
                }
            });
        },
        "appendQuery": function(cID, affID) {
            var $that = this;
            $('a').filter(function() {
                return this.hostname && this.hostname !== location.hostname;
            }).each(function() {
                var href = $(this).attr("href");
                if (href.indexOf("?") > -1) {
                    $(this).attr("href", href + "&" + "vis=" + cID + affID + "_");
                } else {
                    $(this).attr("href", href + "?" + "vis=" + cID + affID + "_");
                }
            }).on("click", function(e) {
                e.preventDefault();
                var url = this.hostname.replace("www.", "");
                var href = $(this).attr("href");
                var loc = $(this).attr("data-name");
                $that.trackOutbound(url, href, loc);
                setTimeout(function() {
                    window.open(href, '_self');
                }, 600);
            });
        },
        "getGa": function() {
            var cID;
            ga(function(tracker) {
                cID = tracker.get('clientId');
            });
            return cID;
        }
    };
});