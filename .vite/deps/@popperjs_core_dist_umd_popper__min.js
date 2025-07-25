import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/@popperjs/core/dist/umd/popper.min.js
var require_popper_min = __commonJS({
  "node_modules/@popperjs/core/dist/umd/popper.min.js"(exports, module) {
    !function(e, t) {
      "object" == typeof exports && "undefined" != typeof module ? t(exports) : "function" == typeof define && define.amd ? define(["exports"], t) : t((e = "undefined" != typeof globalThis ? globalThis : e || self).Popper = {});
    }(exports, function(e) {
      "use strict";
      function t(e2) {
        if (null == e2)
          return window;
        if ("[object Window]" !== e2.toString()) {
          var t2 = e2.ownerDocument;
          return t2 && t2.defaultView || window;
        }
        return e2;
      }
      function n(e2) {
        return e2 instanceof t(e2).Element || e2 instanceof Element;
      }
      function r(e2) {
        return e2 instanceof t(e2).HTMLElement || e2 instanceof HTMLElement;
      }
      function o(e2) {
        return "undefined" != typeof ShadowRoot && (e2 instanceof t(e2).ShadowRoot || e2 instanceof ShadowRoot);
      }
      var i = Math.max, a = Math.min, s = Math.round;
      function f() {
        var e2 = navigator.userAgentData;
        return null != e2 && e2.brands && Array.isArray(e2.brands) ? e2.brands.map(function(e3) {
          return e3.brand + "/" + e3.version;
        }).join(" ") : navigator.userAgent;
      }
      function c() {
        return !/^((?!chrome|android).)*safari/i.test(f());
      }
      function p(e2, o2, i2) {
        void 0 === o2 && (o2 = false), void 0 === i2 && (i2 = false);
        var a2 = e2.getBoundingClientRect(), f2 = 1, p2 = 1;
        o2 && r(e2) && (f2 = e2.offsetWidth > 0 && s(a2.width) / e2.offsetWidth || 1, p2 = e2.offsetHeight > 0 && s(a2.height) / e2.offsetHeight || 1);
        var u2 = (n(e2) ? t(e2) : window).visualViewport, l2 = !c() && i2, d2 = (a2.left + (l2 && u2 ? u2.offsetLeft : 0)) / f2, h2 = (a2.top + (l2 && u2 ? u2.offsetTop : 0)) / p2, m2 = a2.width / f2, v2 = a2.height / p2;
        return { width: m2, height: v2, top: h2, right: d2 + m2, bottom: h2 + v2, left: d2, x: d2, y: h2 };
      }
      function u(e2) {
        var n2 = t(e2);
        return { scrollLeft: n2.pageXOffset, scrollTop: n2.pageYOffset };
      }
      function l(e2) {
        return e2 ? (e2.nodeName || "").toLowerCase() : null;
      }
      function d(e2) {
        return ((n(e2) ? e2.ownerDocument : e2.document) || window.document).documentElement;
      }
      function h(e2) {
        return p(d(e2)).left + u(e2).scrollLeft;
      }
      function m(e2) {
        return t(e2).getComputedStyle(e2);
      }
      function v(e2) {
        var t2 = m(e2), n2 = t2.overflow, r2 = t2.overflowX, o2 = t2.overflowY;
        return /auto|scroll|overlay|hidden/.test(n2 + o2 + r2);
      }
      function y(e2, n2, o2) {
        void 0 === o2 && (o2 = false);
        var i2, a2, f2 = r(n2), c2 = r(n2) && function(e3) {
          var t2 = e3.getBoundingClientRect(), n3 = s(t2.width) / e3.offsetWidth || 1, r2 = s(t2.height) / e3.offsetHeight || 1;
          return 1 !== n3 || 1 !== r2;
        }(n2), m2 = d(n2), y2 = p(e2, c2, o2), g2 = { scrollLeft: 0, scrollTop: 0 }, b2 = { x: 0, y: 0 };
        return (f2 || !f2 && !o2) && (("body" !== l(n2) || v(m2)) && (g2 = (i2 = n2) !== t(i2) && r(i2) ? { scrollLeft: (a2 = i2).scrollLeft, scrollTop: a2.scrollTop } : u(i2)), r(n2) ? ((b2 = p(n2, true)).x += n2.clientLeft, b2.y += n2.clientTop) : m2 && (b2.x = h(m2))), { x: y2.left + g2.scrollLeft - b2.x, y: y2.top + g2.scrollTop - b2.y, width: y2.width, height: y2.height };
      }
      function g(e2) {
        var t2 = p(e2), n2 = e2.offsetWidth, r2 = e2.offsetHeight;
        return Math.abs(t2.width - n2) <= 1 && (n2 = t2.width), Math.abs(t2.height - r2) <= 1 && (r2 = t2.height), { x: e2.offsetLeft, y: e2.offsetTop, width: n2, height: r2 };
      }
      function b(e2) {
        return "html" === l(e2) ? e2 : e2.assignedSlot || e2.parentNode || (o(e2) ? e2.host : null) || d(e2);
      }
      function x(e2) {
        return ["html", "body", "#document"].indexOf(l(e2)) >= 0 ? e2.ownerDocument.body : r(e2) && v(e2) ? e2 : x(b(e2));
      }
      function w(e2, n2) {
        var r2;
        void 0 === n2 && (n2 = []);
        var o2 = x(e2), i2 = o2 === (null == (r2 = e2.ownerDocument) ? void 0 : r2.body), a2 = t(o2), s2 = i2 ? [a2].concat(a2.visualViewport || [], v(o2) ? o2 : []) : o2, f2 = n2.concat(s2);
        return i2 ? f2 : f2.concat(w(b(s2)));
      }
      function O(e2) {
        return ["table", "td", "th"].indexOf(l(e2)) >= 0;
      }
      function j(e2) {
        return r(e2) && "fixed" !== m(e2).position ? e2.offsetParent : null;
      }
      function E(e2) {
        for (var n2 = t(e2), i2 = j(e2); i2 && O(i2) && "static" === m(i2).position; )
          i2 = j(i2);
        return i2 && ("html" === l(i2) || "body" === l(i2) && "static" === m(i2).position) ? n2 : i2 || function(e3) {
          var t2 = /firefox/i.test(f());
          if (/Trident/i.test(f()) && r(e3) && "fixed" === m(e3).position)
            return null;
          var n3 = b(e3);
          for (o(n3) && (n3 = n3.host); r(n3) && ["html", "body"].indexOf(l(n3)) < 0; ) {
            var i3 = m(n3);
            if ("none" !== i3.transform || "none" !== i3.perspective || "paint" === i3.contain || -1 !== ["transform", "perspective"].indexOf(i3.willChange) || t2 && "filter" === i3.willChange || t2 && i3.filter && "none" !== i3.filter)
              return n3;
            n3 = n3.parentNode;
          }
          return null;
        }(e2) || n2;
      }
      var D = "top", A = "bottom", L = "right", P = "left", M = "auto", k = [D, A, L, P], W = "start", B = "end", H = "viewport", T = "popper", R = k.reduce(function(e2, t2) {
        return e2.concat([t2 + "-" + W, t2 + "-" + B]);
      }, []), S = [].concat(k, [M]).reduce(function(e2, t2) {
        return e2.concat([t2, t2 + "-" + W, t2 + "-" + B]);
      }, []), V = ["beforeRead", "read", "afterRead", "beforeMain", "main", "afterMain", "beforeWrite", "write", "afterWrite"];
      function q(e2) {
        var t2 = /* @__PURE__ */ new Map(), n2 = /* @__PURE__ */ new Set(), r2 = [];
        function o2(e3) {
          n2.add(e3.name), [].concat(e3.requires || [], e3.requiresIfExists || []).forEach(function(e4) {
            if (!n2.has(e4)) {
              var r3 = t2.get(e4);
              r3 && o2(r3);
            }
          }), r2.push(e3);
        }
        return e2.forEach(function(e3) {
          t2.set(e3.name, e3);
        }), e2.forEach(function(e3) {
          n2.has(e3.name) || o2(e3);
        }), r2;
      }
      function C(e2, t2) {
        var n2 = t2.getRootNode && t2.getRootNode();
        if (e2.contains(t2))
          return true;
        if (n2 && o(n2)) {
          var r2 = t2;
          do {
            if (r2 && e2.isSameNode(r2))
              return true;
            r2 = r2.parentNode || r2.host;
          } while (r2);
        }
        return false;
      }
      function N(e2) {
        return Object.assign({}, e2, { left: e2.x, top: e2.y, right: e2.x + e2.width, bottom: e2.y + e2.height });
      }
      function I(e2, r2, o2) {
        return r2 === H ? N(function(e3, n2) {
          var r3 = t(e3), o3 = d(e3), i2 = r3.visualViewport, a2 = o3.clientWidth, s2 = o3.clientHeight, f2 = 0, p2 = 0;
          if (i2) {
            a2 = i2.width, s2 = i2.height;
            var u2 = c();
            (u2 || !u2 && "fixed" === n2) && (f2 = i2.offsetLeft, p2 = i2.offsetTop);
          }
          return { width: a2, height: s2, x: f2 + h(e3), y: p2 };
        }(e2, o2)) : n(r2) ? function(e3, t2) {
          var n2 = p(e3, false, "fixed" === t2);
          return n2.top = n2.top + e3.clientTop, n2.left = n2.left + e3.clientLeft, n2.bottom = n2.top + e3.clientHeight, n2.right = n2.left + e3.clientWidth, n2.width = e3.clientWidth, n2.height = e3.clientHeight, n2.x = n2.left, n2.y = n2.top, n2;
        }(r2, o2) : N(function(e3) {
          var t2, n2 = d(e3), r3 = u(e3), o3 = null == (t2 = e3.ownerDocument) ? void 0 : t2.body, a2 = i(n2.scrollWidth, n2.clientWidth, o3 ? o3.scrollWidth : 0, o3 ? o3.clientWidth : 0), s2 = i(n2.scrollHeight, n2.clientHeight, o3 ? o3.scrollHeight : 0, o3 ? o3.clientHeight : 0), f2 = -r3.scrollLeft + h(e3), c2 = -r3.scrollTop;
          return "rtl" === m(o3 || n2).direction && (f2 += i(n2.clientWidth, o3 ? o3.clientWidth : 0) - a2), { width: a2, height: s2, x: f2, y: c2 };
        }(d(e2)));
      }
      function _(e2, t2, o2, s2) {
        var f2 = "clippingParents" === t2 ? function(e3) {
          var t3 = w(b(e3)), o3 = ["absolute", "fixed"].indexOf(m(e3).position) >= 0 && r(e3) ? E(e3) : e3;
          return n(o3) ? t3.filter(function(e4) {
            return n(e4) && C(e4, o3) && "body" !== l(e4);
          }) : [];
        }(e2) : [].concat(t2), c2 = [].concat(f2, [o2]), p2 = c2[0], u2 = c2.reduce(function(t3, n2) {
          var r2 = I(e2, n2, s2);
          return t3.top = i(r2.top, t3.top), t3.right = a(r2.right, t3.right), t3.bottom = a(r2.bottom, t3.bottom), t3.left = i(r2.left, t3.left), t3;
        }, I(e2, p2, s2));
        return u2.width = u2.right - u2.left, u2.height = u2.bottom - u2.top, u2.x = u2.left, u2.y = u2.top, u2;
      }
      function F(e2) {
        return e2.split("-")[0];
      }
      function U(e2) {
        return e2.split("-")[1];
      }
      function z(e2) {
        return ["top", "bottom"].indexOf(e2) >= 0 ? "x" : "y";
      }
      function X(e2) {
        var t2, n2 = e2.reference, r2 = e2.element, o2 = e2.placement, i2 = o2 ? F(o2) : null, a2 = o2 ? U(o2) : null, s2 = n2.x + n2.width / 2 - r2.width / 2, f2 = n2.y + n2.height / 2 - r2.height / 2;
        switch (i2) {
          case D:
            t2 = { x: s2, y: n2.y - r2.height };
            break;
          case A:
            t2 = { x: s2, y: n2.y + n2.height };
            break;
          case L:
            t2 = { x: n2.x + n2.width, y: f2 };
            break;
          case P:
            t2 = { x: n2.x - r2.width, y: f2 };
            break;
          default:
            t2 = { x: n2.x, y: n2.y };
        }
        var c2 = i2 ? z(i2) : null;
        if (null != c2) {
          var p2 = "y" === c2 ? "height" : "width";
          switch (a2) {
            case W:
              t2[c2] = t2[c2] - (n2[p2] / 2 - r2[p2] / 2);
              break;
            case B:
              t2[c2] = t2[c2] + (n2[p2] / 2 - r2[p2] / 2);
          }
        }
        return t2;
      }
      function Y(e2) {
        return Object.assign({}, { top: 0, right: 0, bottom: 0, left: 0 }, e2);
      }
      function G(e2, t2) {
        return t2.reduce(function(t3, n2) {
          return t3[n2] = e2, t3;
        }, {});
      }
      function J(e2, t2) {
        void 0 === t2 && (t2 = {});
        var r2 = t2, o2 = r2.placement, i2 = void 0 === o2 ? e2.placement : o2, a2 = r2.strategy, s2 = void 0 === a2 ? e2.strategy : a2, f2 = r2.boundary, c2 = void 0 === f2 ? "clippingParents" : f2, u2 = r2.rootBoundary, l2 = void 0 === u2 ? H : u2, h2 = r2.elementContext, m2 = void 0 === h2 ? T : h2, v2 = r2.altBoundary, y2 = void 0 !== v2 && v2, g2 = r2.padding, b2 = void 0 === g2 ? 0 : g2, x2 = Y("number" != typeof b2 ? b2 : G(b2, k)), w2 = m2 === T ? "reference" : T, O2 = e2.rects.popper, j2 = e2.elements[y2 ? w2 : m2], E2 = _(n(j2) ? j2 : j2.contextElement || d(e2.elements.popper), c2, l2, s2), P2 = p(e2.elements.reference), M2 = X({ reference: P2, element: O2, strategy: "absolute", placement: i2 }), W2 = N(Object.assign({}, O2, M2)), B2 = m2 === T ? W2 : P2, R2 = { top: E2.top - B2.top + x2.top, bottom: B2.bottom - E2.bottom + x2.bottom, left: E2.left - B2.left + x2.left, right: B2.right - E2.right + x2.right }, S2 = e2.modifiersData.offset;
        if (m2 === T && S2) {
          var V2 = S2[i2];
          Object.keys(R2).forEach(function(e3) {
            var t3 = [L, A].indexOf(e3) >= 0 ? 1 : -1, n2 = [D, A].indexOf(e3) >= 0 ? "y" : "x";
            R2[e3] += V2[n2] * t3;
          });
        }
        return R2;
      }
      var K = { placement: "bottom", modifiers: [], strategy: "absolute" };
      function Q() {
        for (var e2 = arguments.length, t2 = new Array(e2), n2 = 0; n2 < e2; n2++)
          t2[n2] = arguments[n2];
        return !t2.some(function(e3) {
          return !(e3 && "function" == typeof e3.getBoundingClientRect);
        });
      }
      function Z(e2) {
        void 0 === e2 && (e2 = {});
        var t2 = e2, r2 = t2.defaultModifiers, o2 = void 0 === r2 ? [] : r2, i2 = t2.defaultOptions, a2 = void 0 === i2 ? K : i2;
        return function(e3, t3, r3) {
          void 0 === r3 && (r3 = a2);
          var i3, s2, f2 = { placement: "bottom", orderedModifiers: [], options: Object.assign({}, K, a2), modifiersData: {}, elements: { reference: e3, popper: t3 }, attributes: {}, styles: {} }, c2 = [], p2 = false, u2 = { state: f2, setOptions: function(r4) {
            var i4 = "function" == typeof r4 ? r4(f2.options) : r4;
            l2(), f2.options = Object.assign({}, a2, f2.options, i4), f2.scrollParents = { reference: n(e3) ? w(e3) : e3.contextElement ? w(e3.contextElement) : [], popper: w(t3) };
            var s3, p3, d2 = function(e4) {
              var t4 = q(e4);
              return V.reduce(function(e5, n2) {
                return e5.concat(t4.filter(function(e6) {
                  return e6.phase === n2;
                }));
              }, []);
            }((s3 = [].concat(o2, f2.options.modifiers), p3 = s3.reduce(function(e4, t4) {
              var n2 = e4[t4.name];
              return e4[t4.name] = n2 ? Object.assign({}, n2, t4, { options: Object.assign({}, n2.options, t4.options), data: Object.assign({}, n2.data, t4.data) }) : t4, e4;
            }, {}), Object.keys(p3).map(function(e4) {
              return p3[e4];
            })));
            return f2.orderedModifiers = d2.filter(function(e4) {
              return e4.enabled;
            }), f2.orderedModifiers.forEach(function(e4) {
              var t4 = e4.name, n2 = e4.options, r5 = void 0 === n2 ? {} : n2, o3 = e4.effect;
              if ("function" == typeof o3) {
                var i5 = o3({ state: f2, name: t4, instance: u2, options: r5 }), a3 = function() {
                };
                c2.push(i5 || a3);
              }
            }), u2.update();
          }, forceUpdate: function() {
            if (!p2) {
              var e4 = f2.elements, t4 = e4.reference, n2 = e4.popper;
              if (Q(t4, n2)) {
                f2.rects = { reference: y(t4, E(n2), "fixed" === f2.options.strategy), popper: g(n2) }, f2.reset = false, f2.placement = f2.options.placement, f2.orderedModifiers.forEach(function(e5) {
                  return f2.modifiersData[e5.name] = Object.assign({}, e5.data);
                });
                for (var r4 = 0; r4 < f2.orderedModifiers.length; r4++)
                  if (true !== f2.reset) {
                    var o3 = f2.orderedModifiers[r4], i4 = o3.fn, a3 = o3.options, s3 = void 0 === a3 ? {} : a3, c3 = o3.name;
                    "function" == typeof i4 && (f2 = i4({ state: f2, options: s3, name: c3, instance: u2 }) || f2);
                  } else
                    f2.reset = false, r4 = -1;
              }
            }
          }, update: (i3 = function() {
            return new Promise(function(e4) {
              u2.forceUpdate(), e4(f2);
            });
          }, function() {
            return s2 || (s2 = new Promise(function(e4) {
              Promise.resolve().then(function() {
                s2 = void 0, e4(i3());
              });
            })), s2;
          }), destroy: function() {
            l2(), p2 = true;
          } };
          if (!Q(e3, t3))
            return u2;
          function l2() {
            c2.forEach(function(e4) {
              return e4();
            }), c2 = [];
          }
          return u2.setOptions(r3).then(function(e4) {
            !p2 && r3.onFirstUpdate && r3.onFirstUpdate(e4);
          }), u2;
        };
      }
      var $ = { passive: true };
      var ee = { name: "eventListeners", enabled: true, phase: "write", fn: function() {
      }, effect: function(e2) {
        var n2 = e2.state, r2 = e2.instance, o2 = e2.options, i2 = o2.scroll, a2 = void 0 === i2 || i2, s2 = o2.resize, f2 = void 0 === s2 || s2, c2 = t(n2.elements.popper), p2 = [].concat(n2.scrollParents.reference, n2.scrollParents.popper);
        return a2 && p2.forEach(function(e3) {
          e3.addEventListener("scroll", r2.update, $);
        }), f2 && c2.addEventListener("resize", r2.update, $), function() {
          a2 && p2.forEach(function(e3) {
            e3.removeEventListener("scroll", r2.update, $);
          }), f2 && c2.removeEventListener("resize", r2.update, $);
        };
      }, data: {} };
      var te = { name: "popperOffsets", enabled: true, phase: "read", fn: function(e2) {
        var t2 = e2.state, n2 = e2.name;
        t2.modifiersData[n2] = X({ reference: t2.rects.reference, element: t2.rects.popper, strategy: "absolute", placement: t2.placement });
      }, data: {} }, ne = { top: "auto", right: "auto", bottom: "auto", left: "auto" };
      function re(e2) {
        var n2, r2 = e2.popper, o2 = e2.popperRect, i2 = e2.placement, a2 = e2.variation, f2 = e2.offsets, c2 = e2.position, p2 = e2.gpuAcceleration, u2 = e2.adaptive, l2 = e2.roundOffsets, h2 = e2.isFixed, v2 = f2.x, y2 = void 0 === v2 ? 0 : v2, g2 = f2.y, b2 = void 0 === g2 ? 0 : g2, x2 = "function" == typeof l2 ? l2({ x: y2, y: b2 }) : { x: y2, y: b2 };
        y2 = x2.x, b2 = x2.y;
        var w2 = f2.hasOwnProperty("x"), O2 = f2.hasOwnProperty("y"), j2 = P, M2 = D, k2 = window;
        if (u2) {
          var W2 = E(r2), H2 = "clientHeight", T2 = "clientWidth";
          if (W2 === t(r2) && "static" !== m(W2 = d(r2)).position && "absolute" === c2 && (H2 = "scrollHeight", T2 = "scrollWidth"), W2 = W2, i2 === D || (i2 === P || i2 === L) && a2 === B)
            M2 = A, b2 -= (h2 && W2 === k2 && k2.visualViewport ? k2.visualViewport.height : W2[H2]) - o2.height, b2 *= p2 ? 1 : -1;
          if (i2 === P || (i2 === D || i2 === A) && a2 === B)
            j2 = L, y2 -= (h2 && W2 === k2 && k2.visualViewport ? k2.visualViewport.width : W2[T2]) - o2.width, y2 *= p2 ? 1 : -1;
        }
        var R2, S2 = Object.assign({ position: c2 }, u2 && ne), V2 = true === l2 ? function(e3, t2) {
          var n3 = e3.x, r3 = e3.y, o3 = t2.devicePixelRatio || 1;
          return { x: s(n3 * o3) / o3 || 0, y: s(r3 * o3) / o3 || 0 };
        }({ x: y2, y: b2 }, t(r2)) : { x: y2, y: b2 };
        return y2 = V2.x, b2 = V2.y, p2 ? Object.assign({}, S2, ((R2 = {})[M2] = O2 ? "0" : "", R2[j2] = w2 ? "0" : "", R2.transform = (k2.devicePixelRatio || 1) <= 1 ? "translate(" + y2 + "px, " + b2 + "px)" : "translate3d(" + y2 + "px, " + b2 + "px, 0)", R2)) : Object.assign({}, S2, ((n2 = {})[M2] = O2 ? b2 + "px" : "", n2[j2] = w2 ? y2 + "px" : "", n2.transform = "", n2));
      }
      var oe = { name: "computeStyles", enabled: true, phase: "beforeWrite", fn: function(e2) {
        var t2 = e2.state, n2 = e2.options, r2 = n2.gpuAcceleration, o2 = void 0 === r2 || r2, i2 = n2.adaptive, a2 = void 0 === i2 || i2, s2 = n2.roundOffsets, f2 = void 0 === s2 || s2, c2 = { placement: F(t2.placement), variation: U(t2.placement), popper: t2.elements.popper, popperRect: t2.rects.popper, gpuAcceleration: o2, isFixed: "fixed" === t2.options.strategy };
        null != t2.modifiersData.popperOffsets && (t2.styles.popper = Object.assign({}, t2.styles.popper, re(Object.assign({}, c2, { offsets: t2.modifiersData.popperOffsets, position: t2.options.strategy, adaptive: a2, roundOffsets: f2 })))), null != t2.modifiersData.arrow && (t2.styles.arrow = Object.assign({}, t2.styles.arrow, re(Object.assign({}, c2, { offsets: t2.modifiersData.arrow, position: "absolute", adaptive: false, roundOffsets: f2 })))), t2.attributes.popper = Object.assign({}, t2.attributes.popper, { "data-popper-placement": t2.placement });
      }, data: {} };
      var ie = { name: "applyStyles", enabled: true, phase: "write", fn: function(e2) {
        var t2 = e2.state;
        Object.keys(t2.elements).forEach(function(e3) {
          var n2 = t2.styles[e3] || {}, o2 = t2.attributes[e3] || {}, i2 = t2.elements[e3];
          r(i2) && l(i2) && (Object.assign(i2.style, n2), Object.keys(o2).forEach(function(e4) {
            var t3 = o2[e4];
            false === t3 ? i2.removeAttribute(e4) : i2.setAttribute(e4, true === t3 ? "" : t3);
          }));
        });
      }, effect: function(e2) {
        var t2 = e2.state, n2 = { popper: { position: t2.options.strategy, left: "0", top: "0", margin: "0" }, arrow: { position: "absolute" }, reference: {} };
        return Object.assign(t2.elements.popper.style, n2.popper), t2.styles = n2, t2.elements.arrow && Object.assign(t2.elements.arrow.style, n2.arrow), function() {
          Object.keys(t2.elements).forEach(function(e3) {
            var o2 = t2.elements[e3], i2 = t2.attributes[e3] || {}, a2 = Object.keys(t2.styles.hasOwnProperty(e3) ? t2.styles[e3] : n2[e3]).reduce(function(e4, t3) {
              return e4[t3] = "", e4;
            }, {});
            r(o2) && l(o2) && (Object.assign(o2.style, a2), Object.keys(i2).forEach(function(e4) {
              o2.removeAttribute(e4);
            }));
          });
        };
      }, requires: ["computeStyles"] };
      var ae = { name: "offset", enabled: true, phase: "main", requires: ["popperOffsets"], fn: function(e2) {
        var t2 = e2.state, n2 = e2.options, r2 = e2.name, o2 = n2.offset, i2 = void 0 === o2 ? [0, 0] : o2, a2 = S.reduce(function(e3, n3) {
          return e3[n3] = function(e4, t3, n4) {
            var r3 = F(e4), o3 = [P, D].indexOf(r3) >= 0 ? -1 : 1, i3 = "function" == typeof n4 ? n4(Object.assign({}, t3, { placement: e4 })) : n4, a3 = i3[0], s3 = i3[1];
            return a3 = a3 || 0, s3 = (s3 || 0) * o3, [P, L].indexOf(r3) >= 0 ? { x: s3, y: a3 } : { x: a3, y: s3 };
          }(n3, t2.rects, i2), e3;
        }, {}), s2 = a2[t2.placement], f2 = s2.x, c2 = s2.y;
        null != t2.modifiersData.popperOffsets && (t2.modifiersData.popperOffsets.x += f2, t2.modifiersData.popperOffsets.y += c2), t2.modifiersData[r2] = a2;
      } }, se = { left: "right", right: "left", bottom: "top", top: "bottom" };
      function fe(e2) {
        return e2.replace(/left|right|bottom|top/g, function(e3) {
          return se[e3];
        });
      }
      var ce = { start: "end", end: "start" };
      function pe(e2) {
        return e2.replace(/start|end/g, function(e3) {
          return ce[e3];
        });
      }
      function ue(e2, t2) {
        void 0 === t2 && (t2 = {});
        var n2 = t2, r2 = n2.placement, o2 = n2.boundary, i2 = n2.rootBoundary, a2 = n2.padding, s2 = n2.flipVariations, f2 = n2.allowedAutoPlacements, c2 = void 0 === f2 ? S : f2, p2 = U(r2), u2 = p2 ? s2 ? R : R.filter(function(e3) {
          return U(e3) === p2;
        }) : k, l2 = u2.filter(function(e3) {
          return c2.indexOf(e3) >= 0;
        });
        0 === l2.length && (l2 = u2);
        var d2 = l2.reduce(function(t3, n3) {
          return t3[n3] = J(e2, { placement: n3, boundary: o2, rootBoundary: i2, padding: a2 })[F(n3)], t3;
        }, {});
        return Object.keys(d2).sort(function(e3, t3) {
          return d2[e3] - d2[t3];
        });
      }
      var le = { name: "flip", enabled: true, phase: "main", fn: function(e2) {
        var t2 = e2.state, n2 = e2.options, r2 = e2.name;
        if (!t2.modifiersData[r2]._skip) {
          for (var o2 = n2.mainAxis, i2 = void 0 === o2 || o2, a2 = n2.altAxis, s2 = void 0 === a2 || a2, f2 = n2.fallbackPlacements, c2 = n2.padding, p2 = n2.boundary, u2 = n2.rootBoundary, l2 = n2.altBoundary, d2 = n2.flipVariations, h2 = void 0 === d2 || d2, m2 = n2.allowedAutoPlacements, v2 = t2.options.placement, y2 = F(v2), g2 = f2 || (y2 === v2 || !h2 ? [fe(v2)] : function(e3) {
            if (F(e3) === M)
              return [];
            var t3 = fe(e3);
            return [pe(e3), t3, pe(t3)];
          }(v2)), b2 = [v2].concat(g2).reduce(function(e3, n3) {
            return e3.concat(F(n3) === M ? ue(t2, { placement: n3, boundary: p2, rootBoundary: u2, padding: c2, flipVariations: h2, allowedAutoPlacements: m2 }) : n3);
          }, []), x2 = t2.rects.reference, w2 = t2.rects.popper, O2 = /* @__PURE__ */ new Map(), j2 = true, E2 = b2[0], k2 = 0; k2 < b2.length; k2++) {
            var B2 = b2[k2], H2 = F(B2), T2 = U(B2) === W, R2 = [D, A].indexOf(H2) >= 0, S2 = R2 ? "width" : "height", V2 = J(t2, { placement: B2, boundary: p2, rootBoundary: u2, altBoundary: l2, padding: c2 }), q2 = R2 ? T2 ? L : P : T2 ? A : D;
            x2[S2] > w2[S2] && (q2 = fe(q2));
            var C2 = fe(q2), N2 = [];
            if (i2 && N2.push(V2[H2] <= 0), s2 && N2.push(V2[q2] <= 0, V2[C2] <= 0), N2.every(function(e3) {
              return e3;
            })) {
              E2 = B2, j2 = false;
              break;
            }
            O2.set(B2, N2);
          }
          if (j2)
            for (var I2 = function(e3) {
              var t3 = b2.find(function(t4) {
                var n3 = O2.get(t4);
                if (n3)
                  return n3.slice(0, e3).every(function(e4) {
                    return e4;
                  });
              });
              if (t3)
                return E2 = t3, "break";
            }, _2 = h2 ? 3 : 1; _2 > 0; _2--) {
              if ("break" === I2(_2))
                break;
            }
          t2.placement !== E2 && (t2.modifiersData[r2]._skip = true, t2.placement = E2, t2.reset = true);
        }
      }, requiresIfExists: ["offset"], data: { _skip: false } };
      function de(e2, t2, n2) {
        return i(e2, a(t2, n2));
      }
      var he = { name: "preventOverflow", enabled: true, phase: "main", fn: function(e2) {
        var t2 = e2.state, n2 = e2.options, r2 = e2.name, o2 = n2.mainAxis, s2 = void 0 === o2 || o2, f2 = n2.altAxis, c2 = void 0 !== f2 && f2, p2 = n2.boundary, u2 = n2.rootBoundary, l2 = n2.altBoundary, d2 = n2.padding, h2 = n2.tether, m2 = void 0 === h2 || h2, v2 = n2.tetherOffset, y2 = void 0 === v2 ? 0 : v2, b2 = J(t2, { boundary: p2, rootBoundary: u2, padding: d2, altBoundary: l2 }), x2 = F(t2.placement), w2 = U(t2.placement), O2 = !w2, j2 = z(x2), M2 = "x" === j2 ? "y" : "x", k2 = t2.modifiersData.popperOffsets, B2 = t2.rects.reference, H2 = t2.rects.popper, T2 = "function" == typeof y2 ? y2(Object.assign({}, t2.rects, { placement: t2.placement })) : y2, R2 = "number" == typeof T2 ? { mainAxis: T2, altAxis: T2 } : Object.assign({ mainAxis: 0, altAxis: 0 }, T2), S2 = t2.modifiersData.offset ? t2.modifiersData.offset[t2.placement] : null, V2 = { x: 0, y: 0 };
        if (k2) {
          if (s2) {
            var q2, C2 = "y" === j2 ? D : P, N2 = "y" === j2 ? A : L, I2 = "y" === j2 ? "height" : "width", _2 = k2[j2], X2 = _2 + b2[C2], Y2 = _2 - b2[N2], G2 = m2 ? -H2[I2] / 2 : 0, K2 = w2 === W ? B2[I2] : H2[I2], Q2 = w2 === W ? -H2[I2] : -B2[I2], Z2 = t2.elements.arrow, $2 = m2 && Z2 ? g(Z2) : { width: 0, height: 0 }, ee2 = t2.modifiersData["arrow#persistent"] ? t2.modifiersData["arrow#persistent"].padding : { top: 0, right: 0, bottom: 0, left: 0 }, te2 = ee2[C2], ne2 = ee2[N2], re2 = de(0, B2[I2], $2[I2]), oe2 = O2 ? B2[I2] / 2 - G2 - re2 - te2 - R2.mainAxis : K2 - re2 - te2 - R2.mainAxis, ie2 = O2 ? -B2[I2] / 2 + G2 + re2 + ne2 + R2.mainAxis : Q2 + re2 + ne2 + R2.mainAxis, ae2 = t2.elements.arrow && E(t2.elements.arrow), se2 = ae2 ? "y" === j2 ? ae2.clientTop || 0 : ae2.clientLeft || 0 : 0, fe2 = null != (q2 = null == S2 ? void 0 : S2[j2]) ? q2 : 0, ce2 = _2 + ie2 - fe2, pe2 = de(m2 ? a(X2, _2 + oe2 - fe2 - se2) : X2, _2, m2 ? i(Y2, ce2) : Y2);
            k2[j2] = pe2, V2[j2] = pe2 - _2;
          }
          if (c2) {
            var ue2, le2 = "x" === j2 ? D : P, he2 = "x" === j2 ? A : L, me2 = k2[M2], ve2 = "y" === M2 ? "height" : "width", ye2 = me2 + b2[le2], ge2 = me2 - b2[he2], be2 = -1 !== [D, P].indexOf(x2), xe2 = null != (ue2 = null == S2 ? void 0 : S2[M2]) ? ue2 : 0, we2 = be2 ? ye2 : me2 - B2[ve2] - H2[ve2] - xe2 + R2.altAxis, Oe = be2 ? me2 + B2[ve2] + H2[ve2] - xe2 - R2.altAxis : ge2, je = m2 && be2 ? function(e3, t3, n3) {
              var r3 = de(e3, t3, n3);
              return r3 > n3 ? n3 : r3;
            }(we2, me2, Oe) : de(m2 ? we2 : ye2, me2, m2 ? Oe : ge2);
            k2[M2] = je, V2[M2] = je - me2;
          }
          t2.modifiersData[r2] = V2;
        }
      }, requiresIfExists: ["offset"] };
      var me = { name: "arrow", enabled: true, phase: "main", fn: function(e2) {
        var t2, n2 = e2.state, r2 = e2.name, o2 = e2.options, i2 = n2.elements.arrow, a2 = n2.modifiersData.popperOffsets, s2 = F(n2.placement), f2 = z(s2), c2 = [P, L].indexOf(s2) >= 0 ? "height" : "width";
        if (i2 && a2) {
          var p2 = function(e3, t3) {
            return Y("number" != typeof (e3 = "function" == typeof e3 ? e3(Object.assign({}, t3.rects, { placement: t3.placement })) : e3) ? e3 : G(e3, k));
          }(o2.padding, n2), u2 = g(i2), l2 = "y" === f2 ? D : P, d2 = "y" === f2 ? A : L, h2 = n2.rects.reference[c2] + n2.rects.reference[f2] - a2[f2] - n2.rects.popper[c2], m2 = a2[f2] - n2.rects.reference[f2], v2 = E(i2), y2 = v2 ? "y" === f2 ? v2.clientHeight || 0 : v2.clientWidth || 0 : 0, b2 = h2 / 2 - m2 / 2, x2 = p2[l2], w2 = y2 - u2[c2] - p2[d2], O2 = y2 / 2 - u2[c2] / 2 + b2, j2 = de(x2, O2, w2), M2 = f2;
          n2.modifiersData[r2] = ((t2 = {})[M2] = j2, t2.centerOffset = j2 - O2, t2);
        }
      }, effect: function(e2) {
        var t2 = e2.state, n2 = e2.options.element, r2 = void 0 === n2 ? "[data-popper-arrow]" : n2;
        null != r2 && ("string" != typeof r2 || (r2 = t2.elements.popper.querySelector(r2))) && C(t2.elements.popper, r2) && (t2.elements.arrow = r2);
      }, requires: ["popperOffsets"], requiresIfExists: ["preventOverflow"] };
      function ve(e2, t2, n2) {
        return void 0 === n2 && (n2 = { x: 0, y: 0 }), { top: e2.top - t2.height - n2.y, right: e2.right - t2.width + n2.x, bottom: e2.bottom - t2.height + n2.y, left: e2.left - t2.width - n2.x };
      }
      function ye(e2) {
        return [D, L, A, P].some(function(t2) {
          return e2[t2] >= 0;
        });
      }
      var ge = { name: "hide", enabled: true, phase: "main", requiresIfExists: ["preventOverflow"], fn: function(e2) {
        var t2 = e2.state, n2 = e2.name, r2 = t2.rects.reference, o2 = t2.rects.popper, i2 = t2.modifiersData.preventOverflow, a2 = J(t2, { elementContext: "reference" }), s2 = J(t2, { altBoundary: true }), f2 = ve(a2, r2), c2 = ve(s2, o2, i2), p2 = ye(f2), u2 = ye(c2);
        t2.modifiersData[n2] = { referenceClippingOffsets: f2, popperEscapeOffsets: c2, isReferenceHidden: p2, hasPopperEscaped: u2 }, t2.attributes.popper = Object.assign({}, t2.attributes.popper, { "data-popper-reference-hidden": p2, "data-popper-escaped": u2 });
      } }, be = Z({ defaultModifiers: [ee, te, oe, ie] }), xe = [ee, te, oe, ie, ae, le, he, me, ge], we = Z({ defaultModifiers: xe });
      e.applyStyles = ie, e.arrow = me, e.computeStyles = oe, e.createPopper = we, e.createPopperLite = be, e.defaultModifiers = xe, e.detectOverflow = J, e.eventListeners = ee, e.flip = le, e.hide = ge, e.offset = ae, e.popperGenerator = Z, e.popperOffsets = te, e.preventOverflow = he, Object.defineProperty(e, "__esModule", { value: true });
    });
  }
});
export default require_popper_min();
//# sourceMappingURL=@popperjs_core_dist_umd_popper__min.js.map
