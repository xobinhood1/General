window.CLOSURE_NO_DEPS = true;
(function() {
    var l = window.jwplayer.jwpsrv = window.jwplayer.jwpsrv || {};

    function n(b, a, c, e) {
        this.f = u;
        this.extend = window.jwplayer.utils.extend;
        this.G = "http" + ("https:" === document.location.protocol ? "s://ssl." : "://") + "p.jwpcdn.com/6/jwpsrv_frq.js";
        this.H = e;
        this.debug = a;
        this.O = c;
        this.B = 0;
        this.C = "p pt pd pm pi pf ps psf psl psd pk pkl pkd pkt pkc pkp b bp bpb bpr bl ble blb bat bal bdt bfb bfp bhp bsp bsv sth stn ste stu stf bar bas bcr bht bte bpy bph bpf brt bsk bwi a acv acg at ak am an av ad ap ab abp abm abo abl abn aci acw ach y ym yp g gi gt s sl sc sh r rf ro rc rh rd c cc cs cf co cb ct ce cw cd m mb ms mt l lf lh ll lm lp".split(" ");
        this.A =
            "dev.jwpltx.com";
        this.F = "n.jwpltx.com";
        this.D = "v1/playerconfig/ping.gif?";
        this.d = window.jwplayer.utils.exists;
        this.e = b;
        this.u = new window.jwplayer.utils.scriptloader(this.G);
        this.u.load();
        l.setSampleFrequency = l.setSampleFrequency || function(b) {
            l.sampling_frequency = parseFloat(b)
        };
        l.parseConfig = l.parseConfig || w(this)
    }

    function w(b) {
        return function(a) {
            var c = {};
            b.f(b.C, function(b, a) {
                c[a] = 0
            });
            b.d(a.i) || (a = new x(a));
            a = a.i();
            y(b, c, a);
            z(b, a);
            F(b, c, a.playlist);
            b.d(a.listbar) && G(b, c, a.listbar);
            b.d(a.captions) && H(b, c, a.captions);
            b.d(a.rtmp) && I(b, c, a.rtmp);
            b.d(a.logo) && J(b, c, a.logo);
            b.d(a.related) && K(b, c, a.related);
            b.d(a.sharing) && L(b, c, a.sharing);
            var e;
            b.d(a.plugins) && b.f(a.plugins, function(b, a) {
                a.client && (a.client.match("vast") || a.client.match("googima")) && (e = a)
            });
            b.d(e) && M(b, c, e);
            b.d(a.sitecatalyst) && P(b, c, a.sitecatalyst);
            b.d(a.ga) && Q(b, c, a.ga);
            return c
        }
    }
    n.prototype.o = function() {
        if (void 0 === l.sampling_frequency) this.u.addEventListener("COMPLETE", this.o);
        else {
            var b = l.sampling_frequency || this.B;
            if (!(Math.random() >= b)) {
                var a = w(this)(this.e),
                    b = aa(this, a, b);
                (new Image).src = b
            }
        }
    };

    function aa(b, a, c) {
        var e = [];
        e.push("n=" + Math.random().toFixed(16).substr(2, 16));
        e.push("aid=" + encodeURIComponent(b.O));
        e.push("ed=" + b.H);
        e.push("f=" + c);
        e.push("pv=" + window.jwplayer.version);
        var d;
        if (window.top !== window.self) {
            d = document.referrer;
            try {
                d = d || window.top.location.href
            } catch (t) {}
        }
        d = d || window.location.href;
        b.f(a, function(b, a) {
            e.push(b + "=" + encodeURIComponent(a))
        });
        e.push("pu=" + encodeURIComponent(d));
        return ["http" + ("https:" === document.location.protocol ? "s://s." : "://i."), b.debug ? b.A : b.F, "/",
            b.D, e.join("&")
        ].join("")
    }

    function F(b, a, c) {
        "string" === typeof c ? a.pf++ : b.f(c, function(c, d) {
            a.p++;
            b.d(d.title) && a.pt++;
            b.d(d.description) && a.pd++;
            b.d(d.mediaid) && a.pm++;
            b.d(d.image) && a.pi++;
            b.d(d.sources) && ca(b, a, d.sources);
            b.d(d.tracks) && da(b, a, d.tracks)
        })
    }

    function K(b, a, c) {
        a.r++;
        b.d(c.file) && a.rf++;
        b.d(c.onclick) && a.ro++;
        b.d(c.oncomplete) && a.rc++;
        b.d(c.heading) && a.rh++;
        b.d(c.dimensions) && a.rd++
    }

    function L(b, a, c) {
        a.s++;
        b.d(c.link) && a.sl++;
        b.d(c.code) && a.sc++
    }

    function G(b, a, c) {
        a.b++;
        b.d(c.position) && (a.bp++, "bottom" === c.position && a.bpb++, "right" === c.position && a.bpr++);
        b.d(c.layout) && (a.bl++, "extended" === c.layout && a.ble++, "basic" === c.position && a.blb++)
    }

    function ca(b, a, c) {
        b.f(c, function(c, d) {
            a.ps++;
            b.d(d.label) && a.psl++;
            b.d(d["default"]) && d["default"] && a.psd++
        })
    }

    function da(b, a, c) {
        b.f(c, function(c, d) {
            a.pk++;
            b.d(d.label) && a.pkl++;
            b.d(d["default"]) && d["default"] && a.pkd++;
            b.d(d.kind) && ("captions" === d.kind && a.pkp++, "thumbnails" === d.kind && a.pkt++, "chapters" === d.kind && a.pkc++)
        })
    }

    function y(b, a, c) {
        b.d(c.abouttext) && a.bat++;
        b.d(c.aboutlink) && a.bal++;
        b.d(c.displaytitle) && c.displaytitle && a.bdt++;
        b.d(c.fallback) && c.fallback && a.bfb++;
        b.d(c.flashplayer) && a.bfp++;
        b.d(c.html5player) && a.bhp++;
        b.d(c.startparam) && a.bsp++;
        b.d(c.stagevideo) && !c.stagevideo && a.bsv++;
        b.d(c.stretching) && a.sth++;
        b.d(c.stretching) && "none" == c.stretching && a.stn++;
        b.d(c.stretching) && "exactfit" == c.stretching && a.ste++;
        b.d(c.stretching) && "uniform" == c.stretching && a.stu++;
        b.d(c.stretching) && "fill" == c.stretching && a.stf++;
        b.d(c.aspectratio) && a.bar++;
        b.d(c.autostart) && c.autostart && a.bas++;
        b.d(c.controls) && !c.controls && a.bcr++;
        b.d(c.height) && a.bht++;
        b.d(c.mute) && c.mute && a.bte++;
        b.d(c.primary) && a.bpy++;
        b.d(c.primary) && "html5" == c.primary && a.bph++;
        b.d(c.primary) && "flash" == c.primary && a.bpf++;
        b.d(c.repeat) && a.brt++;
        b.d(c.skin) && a.bsk++;
        b.d(c.width) && a.bwi++
    }

    function H(b, a, c) {
        a.c++;
        b.d(c.color) && a.cc++;
        b.d(c.fontSize) && a.cs++;
        b.d(c.fontFamily) && a.cf++;
        b.d(c.fontOpacity) && a.co++;
        b.d(c.backgroundColor) && a.cb++;
        b.d(c.backgroundOpacity) && a.ct++;
        b.d(c.edgeStyle) && a.ce++;
        b.d(c.windowColor) && a.cw++;
        b.d(c.windowOpacity) && a.cd++
    }

    function I(b, a, c) {
        a.m++;
        b.d(c.bufferlength) && a.mb++;
        b.d(c.subscribe) && a.mb++;
        b.d(c.securetoken) && a.mt++
    }

    function J(b, a, c) {
        a.l++;
        b.d(c.file) && a.lf++;
        b.d(c.hide) && a.lh++;
        b.d(c.link) && a.ll++;
        b.d(c.margin) && a.lm++;
        b.d(c.position) && a.lp++
    }

    function M(b, a, c) {
        a.a++;
        b.d(c.client) && c.client.match("vast") && a.acv++;
        b.d(c.client) && c.client.match("googima") && a.acg++;
        b.d(c.tag) && (a.at++, a.abp++);
        b.d(c.vastxml) && a.av++;
        b.d(c.skipoffset) && a.ak++;
        b.d(c.admessage) && a.am++;
        b.d(c.companiondiv) && "object" === typeof c.companiondiv && a.an++;
        b.d(c.schedule) && "string" === typeof c.schedule && a.ap++;
        b.d(c.schedule) && "object" === typeof c.schedule && ea(b, a, c.schedule)
    }

    function ea(b, a, c) {
        a.ad++;
        b.f(c, function(c, d) {
            switch (d.offset) {
                case "pre":
                    a.abp++;
                    break;
                case "post":
                    a.abo++;
                    break;
                default:
                    a.abm++
            }
            b.d(d.ad) ? R(b, a, d.ad) : R(b, a, d)
        })
    }

    function R(b, a, c) {
        b.d(c.type) && ("linear" === c.type && a.abl++, "nonlinear" === c.type && a.abn++);
        b.d(c.tag) && a.at++;
        b.d(c.vastxml) && a.av++
    }

    function P(b, a, c) {
        a.y++;
        b.d(c.mediaName) && a.ym++;
        b.d(c.playerName) && a.yp++
    }

    function Q(b, a, c) {
        a.g++;
        b.d(c.idstring) && a.gi++;
        b.d(c.trackingobject) && a.gt++
    }

    function z(b, a) {
        var c = {
            description: "",
            I: "",
            J: "",
            title: "",
            N: [],
            P: []
        };
        if (!a.playlist) {
            var e = {};
            b.f(c, function(c) {
                S(b, a, e, c)
            });
            e.sources || (a.levels ? (e.sources = a.levels, delete a.levels) : (c = {}, S(b, a, c, "file"), S(b, a, c, "type"), e.sources = c.file ? [c] : []));
            a.playlist = [T(b, e)]
        } else if ("string" !== typeof a.playlist)
            for (c = 0; c < a.playlist.length; c++) a.playlist[c] = T(b, a.playlist[c])
    }

    function T(b, a) {
        var c = b.extend({}, {
                description: "",
                I: "",
                J: "",
                title: "",
                N: [],
                P: []
            }, a),
            e;
        c.tracks = a && b.d(a.tracks) ? a.tracks : [];
        0 === c.sources.length && (c.sources = [U(b, c)]);
        for (var d = 0; d < c.sources.length; d++) e = c.sources[d]["default"], c.sources[d]["default"] = e ? "true" == e.toString() : !1, c.sources[d] = U(b, c.sources[d]);
        if (c.captions && !b.d(a.tracks)) {
            for (e = 0; e < c.captions.length; e++) c.tracks.push(c.captions[e]);
            delete c.captions
        }
        for (d = 0; d < c.tracks.length; d++) c.tracks[d] = fa(b, c.tracks[d]);
        return c
    }

    function U(b, a) {
        var c = {
                file: null,
                label: null,
                type: null,
                "default": null
            },
            e = b.extend({}, c);
        b.f(c, function(c) {
            b.d(a[c]) && (e[c] = a[c], delete a[c])
        });
        return e
    }

    function fa(b, a) {
        var c = {
                file: null,
                label: null,
                kind: "captions",
                "default": !1
            },
            e = b.extend({}, c);
        b.f(c, function(c) {
            b.d(a[c]) && (e[c] = a[c], delete a[c])
        });
        return e
    }

    function S(b, a, c, e) {
        b.d(a[e]) && (c[e] = a[e], delete a[e])
    };

    function V(b, a, c) {
        this.key = b;
        this.value = a;
        this.w = c
    }
    V.prototype.getKey = function() {
        return this.key
    };

    function u(b, a) {
        var c, e;
        for (c in b) "function" == window.jwplayer.utils.typeOf(b.hasOwnProperty) ? b.hasOwnProperty(c) && (e = b[c], a(c, e)) : (e = b[c], a(c, e))
    };

    function ga(b) {
        if (window.jwplayer._tracker) return window.jwplayer._tracker;
        window.jwplayer._tracker = this;
        this.h = {};
        this.M = "n.jwpltx.com";
        this.L = "v1/jwplayer6/ping.gif?";
        this.K = window.jwplayer.version;
        if (this.q = window.top === window.self ? 0 : 1) {
            this.j = document.referrer;
            try {
                this.j = this.j || window.top.location.href, this.k = window.top.document.title
            } catch (a) {}
        }
        this.j = this.j || window.location.href;
        this.k = this.k || document.title;
        this.trackerVersion = 8;
        this.v = "complete" == document.readyState;
        this.n = [];
        (this.debug = b) && (this.eventObjs = [])
    }(function(b) {
        var a = window.onload;
        window.onload = "function" != typeof window.onload ? b : function() {
            a && a();
            b()
        }
    })(function() {
        var b = window.jwplayer._tracker;
        if (b) {
            for (; 0 < b.n.length;) {
                var a = b.n.shift();
                W(b, a)
            }
            b.v = !0
        }
    });

    function X(b, a, c, e) {
        b.h[a] || (b.h[a] = {});
        b.h[a][c] || (b.h[a][c] = {});
        var d = Y(b, a, c, e, !1);
        b.h[a][c][d] && (d += "&dup=1");
        b.debug && (e = Y(b, a, c, e, !0), e.url = d, e.fired = !1, b.eventObjs.push(e));
        b.v ? W(b, d) : b.n.push(d);
        b.h[a][c][d] = !0
    }

    function Y(b, a, c, e, d) {
        a = [new V("tv", b.trackerVersion, 0), new V("n", Math.random().toFixed(16).substr(2, 16), 2), new V("aid", a, 4), new V("e", c, 5), new V("i", b.q, 6), new V("pv", b.K, 7), new V("pu", b.j, 101), new V("pt", b.k, 103)].concat(e).sort(function(b, a) {
            return b.w > a.w ? 1 : -1
        });
        if (d) {
            b = {};
            for (d = 0; d < a.length; d++) b[a[d].getKey()] = a[d].value;
            return b
        }
        c = [];
        for (d = 0; d < a.length; d++) c.push(a[d].getKey() + "=" + encodeURIComponent(a[d].value));
        return ["http" + ("https:" === document.location.protocol ? "s://s." : "://i."), b.M, "/",
            b.L, c.join("&")
        ].join("")
    }

    function W(b, a) {
        (new Image).src = a;
        b.debug && u(b.eventObjs, function(b, e) {
            e.url == a && (e.fired = !0)
        })
    };

    function x(b) {
        this.e = b
    }

    function ha(b, a) {
        b.e.onReady(a)
    }

    function ia(b, a) {
        b.e.onComplete(a)
    }

    function ja(b, a) {
        b.e.onTime(a)
    }

    function Z(b) {
        return b.e.getPlaylistItem()
    }

    function $(b) {
        return b.e.getRenderingMode()
    }
    x.prototype.i = function() {
        return this.e.config
    };

    function ka(b, a, c) {
        function e() {
            k = {};
            A = !1;
            h = 0
        }

        function d(b) {
            return function(a) {
                if (!s) {
                    var c = k[b];
                    if ("meta" === b && (a = a.metadata || a, c && (a.width = a.width || c.width, a.height = a.height || c.height, a.duration = a.duration || c.duration), "html5" === $(f).toLowerCase() && (100 === a.duration || 0 === a.duration) && 0 === a.width && 0 === a.height)) return;
                    k[b] = a;
                    "play" === b && (c || (p = 0), r = f.e.getPosition());
                    if (k.play && k.meta && k.levels && !A) {
                        var d = Z(f);
                        a = B(d);
                        c = d.title || "";
                        a: {
                            var e = k.levels;
                            if (e && e.t && e.t.length && (e = e.t[0]) && "auto" === ("" +
                                    e.label).toLowerCase()) {
                                d = 5;
                                break a
                            }
                            if ((d = d.sources) && d.length && (d = d[0].type, "aac" == d || "mp3" == d || "vorbis" == d)) {
                                d = 6;
                                break a
                            }
                            d = k.meta || {};
                            e = d.width | 0;
                            d = 0 === e ? 0 < (d.height | 0) ? 0 : 6 : 320 >= e ? 1 : 640 >= e ? 2 : 1280 >= e ? 3 : 4
                        }
                        var e = t(),
                            h;
                        h = e | 0;
                        X(C, q, "s", [g("ph", D, 1), g("pi", E, 8), g("a", f.i().autostart ? 1 : 0, 11), g("ed", m, 20), g("vs", d, 21), g("l", 0 >= h ? 0 : 15 > h ? 1 : 300 >= h ? 2 : 1200 >= h ? 3 : 4, 22), g("q", v(e), 23), g("mu", a, 100), g("t", c, 102)]);
                        A = !0
                    }
                }
            }
        }

        function t() {
            var a = f.e.getDuration();
            if (0 >= a) {
                var b = k.meta;
                b && (a = b.duration)
            }
            return a | 0
        }

        function v(a) {
            a |=
                0;
            return 0 >= a ? 0 : 30 > a ? 1 : 60 > a ? 4 : 180 > a ? 8 : 300 > a ? 16 : 32
        }

        function ba() {
            r = f.e.getPosition();
            h = 0
        }

        function B(a) {
            var b;
            if (b = a.sources) {
                a = [];
                for (var c = b.length; c--;) b[c].file && a.push(b[c].file);
                a.sort();
                b = a[0]
            } else b = a.file;
            var d;
            var e = b;
            if (e.match(/^[a-zA-Z]+:\/\//)) d = e;
            else {
                d = d || document.location.href;
                b = d.substring(0, d.indexOf("://") + 3);
                a = d.substring(b.length, d.indexOf("/", b.length + 1));
                c = e.split("/");
                0 !== e.indexOf("/") && (d = d.split("?")[0], d = d.substring(b.length + a.length + 1, d.lastIndexOf("/")), c = d.split("/").concat(c));
                d = [];
                for (e = 0; e < c.length; e++) c[e] && "." != c[e] && (".." == c[e] ? d.pop() : d.push(c[e]));
                d = b + a + "/" + d.join("/")
            }
            return d
        }

        function la() {
            var a = f.i(),
                b = f.e.getWidth(),
                d = /\d+%/.test(a.width || b);
            if (d && a.aspectratio) return 4;
            if (a.height) {
                var e = 0;
                a.listbar && "bottom" === a.listbar.position && (e = a.listbar.size);
                if (40 >= a.height - e) return 5
            }
            d && c && c.parentNode && (b = c.parentNode.offsetWidth);
            b |= 0;
            return 0 === b ? 0 : 320 >= b ? 1 : 640 >= b ? 2 : 3
        }

        function N(a, b, c) {
            var d = Z(f),
                e = B(d),
                d = d.title || "";
            b = b + 0.5 | 0;
            0 < b && X(C, q, "t", [g("ph", D, 1), g("pi",
                E, 8), g("ed", m, 20), g("ti", b, 21), g("pw", a | 0, 22), g("q", c, 23), g("mu", e, 100), g("t", d, 102)])
        }

        function ma(a) {
            a.Q ? s = !0 : s = !1
        }
        if (!1 !== a.enabled) {
            var g = function(a, b, c) {
                    return new V(a, b, c)
                },
                O = false || !0 === a.debug,
                f = new x(b),
                E = String(a.id || "").substring(0, 34),
                D = (b = window.jwplayer.defaults) && b.ph ? b.ph : 0,
                m = 0,
                q;
            window.jwplayer.key && (b = new window.jwplayer.utils.key(window.jwplayer.key), a = b.edition(), "invalid" != a && (q = b.token()), "enterprise" == a ? m = 6 : "invalid" == a ? m = 4 : "ads" == a ? m = 3 : "premium" == a ? m = 2 : "pro" == a && (m = 1));
            q || (q = "_");
            var na = new n(f, O, q, m),
                C = new ga(O),
                k, A, h, p = 0,
                r = null,
                s = !1;
            ha(f, function() {
                var a = Z(f),
                    b = B(a),
                    a = a.title || "",
                    c = la();
                X(C, q, "e", [g("ph", D, 1), g("pi", E, 8), g("a", f.i().autostart ? 1 : 0, 11), g("ed", m, 20), g("ps", c, 21), g("mu", b, 100), g("t", a, 102)]);
                na.o()
            });
            f.e.onPlay(d("play"));
            f.e.onMeta(d("meta"));
            f.e.onQualityLevels(d("levels"));
            if (f.e.onCast) f.e.onCast(ma);
            ja(f, function(a) {
                if (!s) {
                    var b = a.position,
                        c = a.duration;
                    if (b) {
                        if (1 < b) {
                            if (!k.meta) {
                                a = {
                                    duration: c
                                };
                                if ("html5" === $(f).toLowerCase()) {
                                    var e = "html5" ===
                                        $(f).toLowerCase() ? f.e.getContainer().getElementsByTagName("video")[0] : null;
                                    e && (a.width = e.videoWidth, a.height = e.videoHeight)
                                }
                                d("meta")(a)
                            }
                            k.levels || d("levels")({})
                        }
                        a = v(c);
                        c = b / (c / a) + 1 | 0;
                        0 === h && (h = c);
                        null === r && (r = b);
                        e = b - r;
                        r = b;
                        e = Math.min(Math.max(0, e), 4);
                        p += e;
                        c === h + 1 && (b = 128 * h / a, h = 0, c > a || (N(b, p, a), p = 0))
                    }
                }
            });
            ia(f, function() {
                if (!s) {
                    var a = t();
                    0 >= a || (N(128, p, v(a)), p = 0)
                }
            });
            f.e.onSeek(ba);
            f.e.onIdle(e);
            f.e.onPlaylistItem(e);
            e()
        }
    }
    window.jwplayer && window.jwplayer() && window.jwplayer().registerPlugin("jwpsrv", "6.0", ka);
})();