import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/apexcharts-clevision/dist/apexcharts.common.js
var require_apexcharts_common = __commonJS({
  "node_modules/apexcharts-clevision/dist/apexcharts.common.js"(exports, module) {
    function t(t2, e2) {
      var i2 = Object.keys(t2);
      if (Object.getOwnPropertySymbols) {
        var a2 = Object.getOwnPropertySymbols(t2);
        e2 && (a2 = a2.filter(function(e3) {
          return Object.getOwnPropertyDescriptor(t2, e3).enumerable;
        })), i2.push.apply(i2, a2);
      }
      return i2;
    }
    function e(e2) {
      for (var i2 = 1; i2 < arguments.length; i2++) {
        var a2 = null != arguments[i2] ? arguments[i2] : {};
        i2 % 2 ? t(Object(a2), true).forEach(function(t2) {
          o(e2, t2, a2[t2]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e2, Object.getOwnPropertyDescriptors(a2)) : t(Object(a2)).forEach(function(t2) {
          Object.defineProperty(e2, t2, Object.getOwnPropertyDescriptor(a2, t2));
        });
      }
      return e2;
    }
    function i(t2) {
      return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t3) {
        return typeof t3;
      } : function(t3) {
        return t3 && "function" == typeof Symbol && t3.constructor === Symbol && t3 !== Symbol.prototype ? "symbol" : typeof t3;
      })(t2);
    }
    function a(t2, e2) {
      if (!(t2 instanceof e2))
        throw new TypeError("Cannot call a class as a function");
    }
    function s(t2, e2) {
      for (var i2 = 0; i2 < e2.length; i2++) {
        var a2 = e2[i2];
        a2.enumerable = a2.enumerable || false, a2.configurable = true, "value" in a2 && (a2.writable = true), Object.defineProperty(t2, a2.key, a2);
      }
    }
    function r(t2, e2, i2) {
      return e2 && s(t2.prototype, e2), i2 && s(t2, i2), t2;
    }
    function o(t2, e2, i2) {
      return e2 in t2 ? Object.defineProperty(t2, e2, { value: i2, enumerable: true, configurable: true, writable: true }) : t2[e2] = i2, t2;
    }
    function n(t2, e2) {
      if ("function" != typeof e2 && null !== e2)
        throw new TypeError("Super expression must either be null or a function");
      t2.prototype = Object.create(e2 && e2.prototype, { constructor: { value: t2, writable: true, configurable: true } }), e2 && h(t2, e2);
    }
    function l(t2) {
      return (l = Object.setPrototypeOf ? Object.getPrototypeOf : function(t3) {
        return t3.__proto__ || Object.getPrototypeOf(t3);
      })(t2);
    }
    function h(t2, e2) {
      return (h = Object.setPrototypeOf || function(t3, e3) {
        return t3.__proto__ = e3, t3;
      })(t2, e2);
    }
    function c(t2, e2) {
      if (e2 && ("object" == typeof e2 || "function" == typeof e2))
        return e2;
      if (void 0 !== e2)
        throw new TypeError("Derived constructors may only return object or undefined");
      return function(t3) {
        if (void 0 === t3)
          throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return t3;
      }(t2);
    }
    function d(t2) {
      var e2 = function() {
        if ("undefined" == typeof Reflect || !Reflect.construct)
          return false;
        if (Reflect.construct.sham)
          return false;
        if ("function" == typeof Proxy)
          return true;
        try {
          return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function() {
          })), true;
        } catch (t3) {
          return false;
        }
      }();
      return function() {
        var i2, a2 = l(t2);
        if (e2) {
          var s2 = l(this).constructor;
          i2 = Reflect.construct(a2, arguments, s2);
        } else
          i2 = a2.apply(this, arguments);
        return c(this, i2);
      };
    }
    function g(t2) {
      return function(t3) {
        if (Array.isArray(t3))
          return u(t3);
      }(t2) || function(t3) {
        if ("undefined" != typeof Symbol && null != t3[Symbol.iterator] || null != t3["@@iterator"])
          return Array.from(t3);
      }(t2) || function(t3, e2) {
        if (!t3)
          return;
        if ("string" == typeof t3)
          return u(t3, e2);
        var i2 = Object.prototype.toString.call(t3).slice(8, -1);
        "Object" === i2 && t3.constructor && (i2 = t3.constructor.name);
        if ("Map" === i2 || "Set" === i2)
          return Array.from(t3);
        if ("Arguments" === i2 || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i2))
          return u(t3, e2);
      }(t2) || function() {
        throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
      }();
    }
    function u(t2, e2) {
      (null == e2 || e2 > t2.length) && (e2 = t2.length);
      for (var i2 = 0, a2 = new Array(e2); i2 < e2; i2++)
        a2[i2] = t2[i2];
      return a2;
    }
    var p = function() {
      function t2() {
        a(this, t2);
      }
      return r(t2, [{ key: "shadeRGBColor", value: function(t3, e2) {
        var i2 = e2.split(","), a2 = t3 < 0 ? 0 : 255, s2 = t3 < 0 ? -1 * t3 : t3, r2 = parseInt(i2[0].slice(4), 10), o2 = parseInt(i2[1], 10), n2 = parseInt(i2[2], 10);
        return "rgb(" + (Math.round((a2 - r2) * s2) + r2) + "," + (Math.round((a2 - o2) * s2) + o2) + "," + (Math.round((a2 - n2) * s2) + n2) + ")";
      } }, { key: "shadeHexColor", value: function(t3, e2) {
        var i2 = parseInt(e2.slice(1), 16), a2 = t3 < 0 ? 0 : 255, s2 = t3 < 0 ? -1 * t3 : t3, r2 = i2 >> 16, o2 = i2 >> 8 & 255, n2 = 255 & i2;
        return "#" + (16777216 + 65536 * (Math.round((a2 - r2) * s2) + r2) + 256 * (Math.round((a2 - o2) * s2) + o2) + (Math.round((a2 - n2) * s2) + n2)).toString(16).slice(1);
      } }, { key: "shadeColor", value: function(e2, i2) {
        return t2.isColorHex(i2) ? this.shadeHexColor(e2, i2) : this.shadeRGBColor(e2, i2);
      } }], [{ key: "bind", value: function(t3, e2) {
        return function() {
          return t3.apply(e2, arguments);
        };
      } }, { key: "isObject", value: function(t3) {
        return t3 && "object" === i(t3) && !Array.isArray(t3) && null != t3;
      } }, { key: "listToArray", value: function(t3) {
        var e2, i2 = [];
        for (e2 = 0; e2 < t3.length; e2++)
          i2[e2] = t3[e2];
        return i2;
      } }, { key: "extend", value: function(t3, e2) {
        var i2 = this;
        "function" != typeof Object.assign && (Object.assign = function(t4) {
          if (null == t4)
            throw new TypeError("Cannot convert undefined or null to object");
          for (var e3 = Object(t4), i3 = 1; i3 < arguments.length; i3++) {
            var a3 = arguments[i3];
            if (null != a3)
              for (var s2 in a3)
                a3.hasOwnProperty(s2) && (e3[s2] = a3[s2]);
          }
          return e3;
        });
        var a2 = Object.assign({}, t3);
        return this.isObject(t3) && this.isObject(e2) && Object.keys(e2).forEach(function(s2) {
          i2.isObject(e2[s2]) && s2 in t3 ? a2[s2] = i2.extend(t3[s2], e2[s2]) : Object.assign(a2, o({}, s2, e2[s2]));
        }), a2;
      } }, { key: "extendArray", value: function(e2, i2) {
        var a2 = [];
        return e2.map(function(e3) {
          a2.push(t2.extend(i2, e3));
        }), e2 = a2;
      } }, { key: "monthMod", value: function(t3) {
        return t3 % 12;
      } }, { key: "clone", value: function(t3) {
        if ("[object Array]" === Object.prototype.toString.call(t3)) {
          for (var e2 = [], a2 = 0; a2 < t3.length; a2++)
            e2[a2] = this.clone(t3[a2]);
          return e2;
        }
        if ("[object Null]" === Object.prototype.toString.call(t3))
          return null;
        if ("[object Date]" === Object.prototype.toString.call(t3))
          return t3;
        if ("object" === i(t3)) {
          var s2 = {};
          for (var r2 in t3)
            t3.hasOwnProperty(r2) && (s2[r2] = this.clone(t3[r2]));
          return s2;
        }
        return t3;
      } }, { key: "log10", value: function(t3) {
        return Math.log(t3) / Math.LN10;
      } }, { key: "roundToBase10", value: function(t3) {
        return Math.pow(10, Math.floor(Math.log10(t3)));
      } }, { key: "roundToBase", value: function(t3, e2) {
        return Math.pow(e2, Math.floor(Math.log(t3) / Math.log(e2)));
      } }, { key: "parseNumber", value: function(t3) {
        return null === t3 ? t3 : parseFloat(t3);
      } }, { key: "randomId", value: function() {
        return (Math.random() + 1).toString(36).substring(4);
      } }, { key: "noExponents", value: function(t3) {
        var e2 = String(t3).split(/[eE]/);
        if (1 === e2.length)
          return e2[0];
        var i2 = "", a2 = t3 < 0 ? "-" : "", s2 = e2[0].replace(".", ""), r2 = Number(e2[1]) + 1;
        if (r2 < 0) {
          for (i2 = a2 + "0."; r2++; )
            i2 += "0";
          return i2 + s2.replace(/^-/, "");
        }
        for (r2 -= s2.length; r2--; )
          i2 += "0";
        return s2 + i2;
      } }, { key: "getDimensions", value: function(t3) {
        var e2 = getComputedStyle(t3, null), i2 = t3.clientHeight, a2 = t3.clientWidth;
        return i2 -= parseFloat(e2.paddingTop) + parseFloat(e2.paddingBottom), [a2 -= parseFloat(e2.paddingLeft) + parseFloat(e2.paddingRight), i2];
      } }, { key: "getBoundingClientRect", value: function(t3) {
        var e2 = t3.getBoundingClientRect();
        return { top: e2.top, right: e2.right, bottom: e2.bottom, left: e2.left, width: t3.clientWidth, height: t3.clientHeight, x: e2.left, y: e2.top };
      } }, { key: "getLargestStringFromArr", value: function(t3) {
        return t3.reduce(function(t4, e2) {
          return Array.isArray(e2) && (e2 = e2.reduce(function(t5, e3) {
            return t5.length > e3.length ? t5 : e3;
          })), t4.length > e2.length ? t4 : e2;
        }, 0);
      } }, { key: "hexToRgba", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "#999999", e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0.6;
        "#" !== t3.substring(0, 1) && (t3 = "#999999");
        var i2 = t3.replace("#", "");
        i2 = i2.match(new RegExp("(.{" + i2.length / 3 + "})", "g"));
        for (var a2 = 0; a2 < i2.length; a2++)
          i2[a2] = parseInt(1 === i2[a2].length ? i2[a2] + i2[a2] : i2[a2], 16);
        return void 0 !== e2 && i2.push(e2), "rgba(" + i2.join(",") + ")";
      } }, { key: "getOpacityFromRGBA", value: function(t3) {
        return parseFloat(t3.replace(/^.*,(.+)\)/, "$1"));
      } }, { key: "rgb2hex", value: function(t3) {
        return (t3 = t3.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i)) && 4 === t3.length ? "#" + ("0" + parseInt(t3[1], 10).toString(16)).slice(-2) + ("0" + parseInt(t3[2], 10).toString(16)).slice(-2) + ("0" + parseInt(t3[3], 10).toString(16)).slice(-2) : "";
      } }, { key: "isColorHex", value: function(t3) {
        return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)|(^#[0-9A-F]{8}$)/i.test(t3);
      } }, { key: "getPolygonPos", value: function(t3, e2) {
        for (var i2 = [], a2 = 2 * Math.PI / e2, s2 = 0; s2 < e2; s2++) {
          var r2 = {};
          r2.x = t3 * Math.sin(s2 * a2), r2.y = -t3 * Math.cos(s2 * a2), i2.push(r2);
        }
        return i2;
      } }, { key: "polarToCartesian", value: function(t3, e2, i2, a2) {
        var s2 = (a2 - 90) * Math.PI / 180;
        return { x: t3 + i2 * Math.cos(s2), y: e2 + i2 * Math.sin(s2) };
      } }, { key: "escapeString", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "x", i2 = t3.toString().slice();
        return i2 = i2.replace(/[` ~!@#$%^&*()_|+\-=?;:'",.<>{}[\]\\/]/gi, e2);
      } }, { key: "negToZero", value: function(t3) {
        return t3 < 0 ? 0 : t3;
      } }, { key: "moveIndexInArray", value: function(t3, e2, i2) {
        if (i2 >= t3.length)
          for (var a2 = i2 - t3.length + 1; a2--; )
            t3.push(void 0);
        return t3.splice(i2, 0, t3.splice(e2, 1)[0]), t3;
      } }, { key: "extractNumber", value: function(t3) {
        return parseFloat(t3.replace(/[^\d.]*/g, ""));
      } }, { key: "findAncestor", value: function(t3, e2) {
        for (; (t3 = t3.parentElement) && !t3.classList.contains(e2); )
          ;
        return t3;
      } }, { key: "setELstyles", value: function(t3, e2) {
        for (var i2 in e2)
          e2.hasOwnProperty(i2) && (t3.style.key = e2[i2]);
      } }, { key: "isNumber", value: function(t3) {
        return !isNaN(t3) && parseFloat(Number(t3)) === t3 && !isNaN(parseInt(t3, 10));
      } }, { key: "isFloat", value: function(t3) {
        return Number(t3) === t3 && t3 % 1 != 0;
      } }, { key: "isSafari", value: function() {
        return /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
      } }, { key: "isFirefox", value: function() {
        return navigator.userAgent.toLowerCase().indexOf("firefox") > -1;
      } }, { key: "isIE11", value: function() {
        if (-1 !== window.navigator.userAgent.indexOf("MSIE") || window.navigator.appVersion.indexOf("Trident/") > -1)
          return true;
      } }, { key: "isIE", value: function() {
        var t3 = window.navigator.userAgent, e2 = t3.indexOf("MSIE ");
        if (e2 > 0)
          return parseInt(t3.substring(e2 + 5, t3.indexOf(".", e2)), 10);
        if (t3.indexOf("Trident/") > 0) {
          var i2 = t3.indexOf("rv:");
          return parseInt(t3.substring(i2 + 3, t3.indexOf(".", i2)), 10);
        }
        var a2 = t3.indexOf("Edge/");
        return a2 > 0 && parseInt(t3.substring(a2 + 5, t3.indexOf(".", a2)), 10);
      } }]), t2;
    }();
    var f = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.setEasingFunctions();
      }
      return r(t2, [{ key: "setEasingFunctions", value: function() {
        var t3;
        if (!this.w.globals.easing) {
          switch (this.w.config.chart.animations.easing) {
            case "linear":
              t3 = "-";
              break;
            case "easein":
              t3 = "<";
              break;
            case "easeout":
              t3 = ">";
              break;
            case "easeinout":
              t3 = "<>";
              break;
            case "swing":
              t3 = function(t4) {
                var e2 = 1.70158;
                return (t4 -= 1) * t4 * ((e2 + 1) * t4 + e2) + 1;
              };
              break;
            case "bounce":
              t3 = function(t4) {
                return t4 < 1 / 2.75 ? 7.5625 * t4 * t4 : t4 < 2 / 2.75 ? 7.5625 * (t4 -= 1.5 / 2.75) * t4 + 0.75 : t4 < 2.5 / 2.75 ? 7.5625 * (t4 -= 2.25 / 2.75) * t4 + 0.9375 : 7.5625 * (t4 -= 2.625 / 2.75) * t4 + 0.984375;
              };
              break;
            case "elastic":
              t3 = function(t4) {
                return t4 === !!t4 ? t4 : Math.pow(2, -10 * t4) * Math.sin((t4 - 0.075) * (2 * Math.PI) / 0.3) + 1;
              };
              break;
            default:
              t3 = "<>";
          }
          this.w.globals.easing = t3;
        }
      } }, { key: "animateLine", value: function(t3, e2, i2, a2) {
        t3.attr(e2).animate(a2).attr(i2);
      } }, { key: "animateMarker", value: function(t3, e2, i2, a2, s2, r2) {
        e2 || (e2 = 0), t3.attr({ r: e2, width: e2, height: e2 }).animate(a2, s2).attr({ r: i2, width: i2.width, height: i2.height }).afterAll(function() {
          r2();
        });
      } }, { key: "animateCircle", value: function(t3, e2, i2, a2, s2) {
        t3.attr({ r: e2.r, cx: e2.cx, cy: e2.cy }).animate(a2, s2).attr({ r: i2.r, cx: i2.cx, cy: i2.cy });
      } }, { key: "animateRect", value: function(t3, e2, i2, a2, s2) {
        t3.attr(e2).animate(a2).attr(i2).afterAll(function() {
          return s2();
        });
      } }, { key: "animatePathsGradually", value: function(t3) {
        var e2 = t3.el, i2 = t3.realIndex, a2 = t3.j, s2 = t3.fill, r2 = t3.pathFrom, o2 = t3.pathTo, n2 = t3.speed, l2 = t3.delay, h2 = this.w, c2 = 0;
        h2.config.chart.animations.animateGradually.enabled && (c2 = h2.config.chart.animations.animateGradually.delay), h2.config.chart.animations.dynamicAnimation.enabled && h2.globals.dataChanged && "bar" !== h2.config.chart.type && (c2 = 0), this.morphSVG(e2, i2, a2, "line" !== h2.config.chart.type || h2.globals.comboCharts ? s2 : "stroke", r2, o2, n2, l2 * c2);
      } }, { key: "showDelayedElements", value: function() {
        this.w.globals.delayedElements.forEach(function(t3) {
          t3.el.classList.remove("apexcharts-element-hidden");
        });
      } }, { key: "animationCompleted", value: function(t3) {
        var e2 = this.w;
        e2.globals.animationEnded || (e2.globals.animationEnded = true, this.showDelayedElements(), "function" == typeof e2.config.chart.events.animationEnd && e2.config.chart.events.animationEnd(this.ctx, { el: t3, w: e2 }));
      } }, { key: "morphSVG", value: function(t3, e2, i2, a2, s2, r2, o2, n2) {
        var l2 = this, h2 = this.w;
        s2 || (s2 = t3.attr("pathFrom")), r2 || (r2 = t3.attr("pathTo"));
        var c2 = function(t4) {
          return "radar" === h2.config.chart.type && (o2 = 1), "M 0 ".concat(h2.globals.gridHeight);
        };
        (!s2 || s2.indexOf("undefined") > -1 || s2.indexOf("NaN") > -1) && (s2 = c2()), (!r2 || r2.indexOf("undefined") > -1 || r2.indexOf("NaN") > -1) && (r2 = c2()), h2.globals.shouldAnimate || (o2 = 1), t3.plot(s2).animate(1, h2.globals.easing, n2).plot(s2).animate(o2, h2.globals.easing, n2).plot(r2).afterAll(function() {
          p.isNumber(i2) ? i2 === h2.globals.series[h2.globals.maxValsInArrayIndex].length - 2 && h2.globals.shouldAnimate && l2.animationCompleted(t3) : "none" !== a2 && h2.globals.shouldAnimate && (!h2.globals.comboCharts && e2 === h2.globals.series.length - 1 || h2.globals.comboCharts) && l2.animationCompleted(t3), l2.showDelayedElements();
        });
      } }]), t2;
    }();
    var x = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "getDefaultFilter", value: function(t3, e2) {
        var i2 = this.w;
        t3.unfilter(true), new window.SVG.Filter().size("120%", "180%", "-5%", "-40%"), "none" !== i2.config.states.normal.filter ? this.applyFilter(t3, e2, i2.config.states.normal.filter.type, i2.config.states.normal.filter.value) : i2.config.chart.dropShadow.enabled && this.dropShadow(t3, i2.config.chart.dropShadow, e2);
      } }, { key: "addNormalFilter", value: function(t3, e2) {
        var i2 = this.w;
        i2.config.chart.dropShadow.enabled && !t3.node.classList.contains("apexcharts-marker") && this.dropShadow(t3, i2.config.chart.dropShadow, e2);
      } }, { key: "addLightenFilter", value: function(t3, e2, i2) {
        var a2 = this, s2 = this.w, r2 = i2.intensity;
        t3.unfilter(true);
        new window.SVG.Filter();
        t3.filter(function(t4) {
          var i3 = s2.config.chart.dropShadow;
          (i3.enabled ? a2.addShadow(t4, e2, i3) : t4).componentTransfer({ rgb: { type: "linear", slope: 1.5, intercept: r2 } });
        }), t3.filterer.node.setAttribute("filterUnits", "userSpaceOnUse"), this._scaleFilterSize(t3.filterer.node);
      } }, { key: "addDarkenFilter", value: function(t3, e2, i2) {
        var a2 = this, s2 = this.w, r2 = i2.intensity;
        t3.unfilter(true);
        new window.SVG.Filter();
        t3.filter(function(t4) {
          var i3 = s2.config.chart.dropShadow;
          (i3.enabled ? a2.addShadow(t4, e2, i3) : t4).componentTransfer({ rgb: { type: "linear", slope: r2 } });
        }), t3.filterer.node.setAttribute("filterUnits", "userSpaceOnUse"), this._scaleFilterSize(t3.filterer.node);
      } }, { key: "applyFilter", value: function(t3, e2, i2) {
        var a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 0.5;
        switch (i2) {
          case "none":
            this.addNormalFilter(t3, e2);
            break;
          case "lighten":
            this.addLightenFilter(t3, e2, { intensity: a2 });
            break;
          case "darken":
            this.addDarkenFilter(t3, e2, { intensity: a2 });
        }
      } }, { key: "addShadow", value: function(t3, e2, i2) {
        var a2 = i2.blur, s2 = i2.top, r2 = i2.left, o2 = i2.color, n2 = i2.opacity, l2 = t3.flood(Array.isArray(o2) ? o2[e2] : o2, n2).composite(t3.sourceAlpha, "in").offset(r2, s2).gaussianBlur(a2).merge(t3.source);
        return t3.blend(t3.source, l2);
      } }, { key: "dropShadow", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 0, a2 = e2.top, s2 = e2.left, r2 = e2.blur, o2 = e2.color, n2 = e2.opacity, l2 = e2.noUserSpaceOnUse, h2 = this.w;
        return t3.unfilter(true), p.isIE() && "radialBar" === h2.config.chart.type || (o2 = Array.isArray(o2) ? o2[i2] : o2, t3.filter(function(t4) {
          var e3 = null;
          e3 = p.isSafari() || p.isFirefox() || p.isIE() ? t4.flood(o2, n2).composite(t4.sourceAlpha, "in").offset(s2, a2).gaussianBlur(r2) : t4.flood(o2, n2).composite(t4.sourceAlpha, "in").offset(s2, a2).gaussianBlur(r2).merge(t4.source), t4.blend(t4.source, e3);
        }), l2 || t3.filterer.node.setAttribute("filterUnits", "userSpaceOnUse"), this._scaleFilterSize(t3.filterer.node)), t3;
      } }, { key: "setSelectionFilter", value: function(t3, e2, i2) {
        var a2 = this.w;
        if (void 0 !== a2.globals.selectedDataPoints[e2] && a2.globals.selectedDataPoints[e2].indexOf(i2) > -1) {
          t3.node.setAttribute("selected", true);
          var s2 = a2.config.states.active.filter;
          "none" !== s2 && this.applyFilter(t3, e2, s2.type, s2.value);
        }
      } }, { key: "_scaleFilterSize", value: function(t3) {
        !function(e2) {
          for (var i2 in e2)
            e2.hasOwnProperty(i2) && t3.setAttribute(i2, e2[i2]);
        }({ width: "200%", height: "200%", x: "-50%", y: "-50%" });
      } }]), t2;
    }();
    var b = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "drawLine", value: function(t3, e2, i2, a2) {
        var s2 = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : "#a8a8a8", r2 = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : 0, o2 = arguments.length > 6 && void 0 !== arguments[6] ? arguments[6] : null, n2 = arguments.length > 7 && void 0 !== arguments[7] ? arguments[7] : "butt", l2 = this.w, h2 = l2.globals.dom.Paper.line().attr({ x1: t3, y1: e2, x2: i2, y2: a2, stroke: s2, "stroke-dasharray": r2, "stroke-width": o2, "stroke-linecap": n2 });
        return h2;
      } }, { key: "drawRect", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0, e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0, i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 0, a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 0, s2 = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : 0, r2 = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : "#fefefe", o2 = arguments.length > 6 && void 0 !== arguments[6] ? arguments[6] : 1, n2 = arguments.length > 7 && void 0 !== arguments[7] ? arguments[7] : null, l2 = arguments.length > 8 && void 0 !== arguments[8] ? arguments[8] : null, h2 = arguments.length > 9 && void 0 !== arguments[9] ? arguments[9] : 0, c2 = this.w, d2 = c2.globals.dom.Paper.rect();
        return d2.attr({ x: t3, y: e2, width: i2 > 0 ? i2 : 0, height: a2 > 0 ? a2 : 0, rx: s2, ry: s2, opacity: o2, "stroke-width": null !== n2 ? n2 : 0, stroke: null !== l2 ? l2 : "none", "stroke-dasharray": h2 }), d2.node.setAttribute("fill", r2), d2;
      } }, { key: "drawPolygon", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "#e1e1e1", i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1, a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : "none", s2 = this.w, r2 = s2.globals.dom.Paper.polygon(t3).attr({ fill: a2, stroke: e2, "stroke-width": i2 });
        return r2;
      } }, { key: "drawCircle", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null, i2 = this.w;
        t3 < 0 && (t3 = 0);
        var a2 = i2.globals.dom.Paper.circle(2 * t3);
        return null !== e2 && a2.attr(e2), a2;
      } }, { key: "drawPath", value: function(t3) {
        var e2 = t3.d, i2 = void 0 === e2 ? "" : e2, a2 = t3.stroke, s2 = void 0 === a2 ? "#a8a8a8" : a2, r2 = t3.strokeWidth, o2 = void 0 === r2 ? 1 : r2, n2 = t3.fill, l2 = t3.fillOpacity, h2 = void 0 === l2 ? 1 : l2, c2 = t3.strokeOpacity, d2 = void 0 === c2 ? 1 : c2, g2 = t3.classes, u2 = t3.strokeLinecap, p2 = void 0 === u2 ? null : u2, f2 = t3.strokeDashArray, x2 = void 0 === f2 ? 0 : f2, b2 = this.w;
        return null === p2 && (p2 = b2.config.stroke.lineCap), (i2.indexOf("undefined") > -1 || i2.indexOf("NaN") > -1) && (i2 = "M 0 ".concat(b2.globals.gridHeight)), b2.globals.dom.Paper.path(i2).attr({ fill: n2, "fill-opacity": h2, stroke: s2, "stroke-opacity": d2, "stroke-linecap": p2, "stroke-width": o2, "stroke-dasharray": x2, class: g2 });
      } }, { key: "group", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null, e2 = this.w, i2 = e2.globals.dom.Paper.group();
        return null !== t3 && i2.attr(t3), i2;
      } }, { key: "move", value: function(t3, e2) {
        var i2 = ["M", t3, e2].join(" ");
        return i2;
      } }, { key: "line", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null, a2 = null;
        return null === i2 ? a2 = ["L", t3, e2].join(" ") : "H" === i2 ? a2 = ["H", t3].join(" ") : "V" === i2 && (a2 = ["V", e2].join(" ")), a2;
      } }, { key: "curve", value: function(t3, e2, i2, a2, s2, r2) {
        var o2 = ["C", t3, e2, i2, a2, s2, r2].join(" ");
        return o2;
      } }, { key: "quadraticCurve", value: function(t3, e2, i2, a2) {
        return ["Q", t3, e2, i2, a2].join(" ");
      } }, { key: "arc", value: function(t3, e2, i2, a2, s2, r2, o2) {
        var n2 = arguments.length > 7 && void 0 !== arguments[7] && arguments[7], l2 = "A";
        n2 && (l2 = "a");
        var h2 = [l2, t3, e2, i2, a2, s2, r2, o2].join(" ");
        return h2;
      } }, { key: "renderPaths", value: function(t3) {
        var i2, a2 = t3.j, s2 = t3.realIndex, r2 = t3.pathFrom, o2 = t3.pathTo, n2 = t3.stroke, l2 = t3.strokeWidth, h2 = t3.strokeLinecap, c2 = t3.fill, d2 = t3.animationDelay, g2 = t3.initialSpeed, u2 = t3.dataChangeSpeed, p2 = t3.className, b2 = t3.shouldClipToGrid, v2 = void 0 === b2 || b2, m2 = t3.bindEventsOnPaths, y2 = void 0 === m2 || m2, w2 = t3.drawShadow, k2 = void 0 === w2 || w2, A2 = this.w, S2 = new x(this.ctx), C2 = new f(this.ctx), L2 = this.w.config.chart.animations.enabled, P2 = L2 && this.w.config.chart.animations.dynamicAnimation.enabled, T2 = !!(L2 && !A2.globals.resized || P2 && A2.globals.dataChanged && A2.globals.shouldAnimate);
        T2 ? i2 = r2 : (i2 = o2, A2.globals.animationEnded = true);
        var M2 = A2.config.stroke.dashArray, I2 = 0;
        I2 = Array.isArray(M2) ? M2[s2] : A2.config.stroke.dashArray;
        var z2 = this.drawPath({ d: i2, stroke: n2, strokeWidth: l2, fill: c2, fillOpacity: 1, classes: p2, strokeLinecap: h2, strokeDashArray: I2 });
        if (z2.attr("index", s2), v2 && z2.attr({ "clip-path": "url(#gridRectMask".concat(A2.globals.cuid, ")") }), "none" !== A2.config.states.normal.filter.type)
          S2.getDefaultFilter(z2, s2);
        else if (A2.config.chart.dropShadow.enabled && k2 && (!A2.config.chart.dropShadow.enabledOnSeries || A2.config.chart.dropShadow.enabledOnSeries && -1 !== A2.config.chart.dropShadow.enabledOnSeries.indexOf(s2))) {
          var X2 = A2.config.chart.dropShadow;
          S2.dropShadow(z2, X2, s2);
        }
        y2 && (z2.node.addEventListener("mouseenter", this.pathMouseEnter.bind(this, z2)), z2.node.addEventListener("mouseleave", this.pathMouseLeave.bind(this, z2)), z2.node.addEventListener("mousedown", this.pathMouseDown.bind(this, z2))), z2.attr({ pathTo: o2, pathFrom: r2 });
        var E2 = { el: z2, j: a2, realIndex: s2, pathFrom: r2, pathTo: o2, fill: c2, strokeWidth: l2, delay: d2 };
        return !L2 || A2.globals.resized || A2.globals.dataChanged ? !A2.globals.resized && A2.globals.dataChanged || C2.showDelayedElements() : C2.animatePathsGradually(e(e({}, E2), {}, { speed: g2 })), A2.globals.dataChanged && P2 && T2 && C2.animatePathsGradually(e(e({}, E2), {}, { speed: u2 })), z2;
      } }, { key: "drawPattern", value: function(t3, e2, i2) {
        var a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : "#a8a8a8", s2 = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : 0, r2 = this.w, o2 = r2.globals.dom.Paper.pattern(e2, i2, function(r3) {
          "horizontalLines" === t3 ? r3.line(0, 0, i2, 0).stroke({ color: a2, width: s2 + 1 }) : "verticalLines" === t3 ? r3.line(0, 0, 0, e2).stroke({ color: a2, width: s2 + 1 }) : "slantedLines" === t3 ? r3.line(0, 0, e2, i2).stroke({ color: a2, width: s2 }) : "squares" === t3 ? r3.rect(e2, i2).fill("none").stroke({ color: a2, width: s2 }) : "circles" === t3 && r3.circle(e2).fill("none").stroke({ color: a2, width: s2 });
        });
        return o2;
      } }, { key: "drawGradient", value: function(t3, e2, i2, a2, s2) {
        var r2, o2 = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : null, n2 = arguments.length > 6 && void 0 !== arguments[6] ? arguments[6] : null, l2 = arguments.length > 7 && void 0 !== arguments[7] ? arguments[7] : null, h2 = arguments.length > 8 && void 0 !== arguments[8] ? arguments[8] : 0, c2 = this.w;
        e2.length < 9 && 0 === e2.indexOf("#") && (e2 = p.hexToRgba(e2, a2)), i2.length < 9 && 0 === i2.indexOf("#") && (i2 = p.hexToRgba(i2, s2));
        var d2 = 0, g2 = 1, u2 = 1, f2 = null;
        null !== n2 && (d2 = void 0 !== n2[0] ? n2[0] / 100 : 0, g2 = void 0 !== n2[1] ? n2[1] / 100 : 1, u2 = void 0 !== n2[2] ? n2[2] / 100 : 1, f2 = void 0 !== n2[3] ? n2[3] / 100 : null);
        var x2 = !("donut" !== c2.config.chart.type && "pie" !== c2.config.chart.type && "polarArea" !== c2.config.chart.type && "bubble" !== c2.config.chart.type);
        if (r2 = null === l2 || 0 === l2.length ? c2.globals.dom.Paper.gradient(x2 ? "radial" : "linear", function(t4) {
          t4.at(d2, e2, a2), t4.at(g2, i2, s2), t4.at(u2, i2, s2), null !== f2 && t4.at(f2, e2, a2);
        }) : c2.globals.dom.Paper.gradient(x2 ? "radial" : "linear", function(t4) {
          (Array.isArray(l2[h2]) ? l2[h2] : l2).forEach(function(e3) {
            t4.at(e3.offset / 100, e3.color, e3.opacity);
          });
        }), x2) {
          var b2 = c2.globals.gridWidth / 2, v2 = c2.globals.gridHeight / 2;
          "bubble" !== c2.config.chart.type ? r2.attr({ gradientUnits: "userSpaceOnUse", cx: b2, cy: v2, r: o2 }) : r2.attr({ cx: 0.5, cy: 0.5, r: 0.8, fx: 0.2, fy: 0.2 });
        } else
          "vertical" === t3 ? r2.from(0, 0).to(0, 1) : "diagonal" === t3 ? r2.from(0, 0).to(1, 1) : "horizontal" === t3 ? r2.from(0, 1).to(1, 1) : "diagonal2" === t3 && r2.from(1, 0).to(0, 1);
        return r2;
      } }, { key: "drawText", value: function(t3) {
        var e2, i2 = t3.x, a2 = t3.y, s2 = t3.text, r2 = t3.textAnchor, o2 = t3.fontSize, n2 = t3.fontFamily, l2 = t3.fontWeight, h2 = t3.foreColor, c2 = t3.opacity, d2 = t3.cssClass, g2 = void 0 === d2 ? "" : d2, u2 = t3.isPlainText, p2 = void 0 === u2 || u2, f2 = this.w;
        return void 0 === s2 && (s2 = ""), r2 || (r2 = "start"), h2 && h2.length || (h2 = f2.config.chart.foreColor), n2 = n2 || f2.config.chart.fontFamily, l2 = l2 || "regular", (e2 = Array.isArray(s2) ? f2.globals.dom.Paper.text(function(t4) {
          for (var e3 = 0; e3 < s2.length; e3++)
            0 === e3 ? t4.tspan(s2[e3]) : t4.tspan(s2[e3]).newLine();
        }) : p2 ? f2.globals.dom.Paper.plain(s2) : f2.globals.dom.Paper.text(function(t4) {
          return t4.tspan(s2);
        })).attr({ x: i2, y: a2, "text-anchor": r2, "dominant-baseline": "auto", "font-size": o2, "font-family": n2, "font-weight": l2, fill: h2, class: "apexcharts-text " + g2 }), e2.node.style.fontFamily = n2, e2.node.style.opacity = c2, e2;
      } }, { key: "drawMarker", value: function(t3, e2, i2) {
        t3 = t3 || 0;
        var a2 = i2.pSize || 0, s2 = null;
        if ("square" === i2.shape || "rect" === i2.shape) {
          var r2 = void 0 === i2.pRadius ? a2 / 2 : i2.pRadius;
          null !== e2 && a2 || (a2 = 0, r2 = 0);
          var o2 = 1.2 * a2 + r2, n2 = this.drawRect(o2, o2, o2, o2, r2);
          n2.attr({ x: t3 - o2 / 2, y: e2 - o2 / 2, cx: t3, cy: e2, class: i2.class ? i2.class : "", fill: i2.pointFillColor, "fill-opacity": i2.pointFillOpacity ? i2.pointFillOpacity : 1, stroke: i2.pointStrokeColor, "stroke-width": i2.pointStrokeWidth ? i2.pointStrokeWidth : 0, "stroke-opacity": i2.pointStrokeOpacity ? i2.pointStrokeOpacity : 1 }), s2 = n2;
        } else
          "circle" !== i2.shape && i2.shape || (p.isNumber(e2) || (a2 = 0, e2 = 0), s2 = this.drawCircle(a2, { cx: t3, cy: e2, class: i2.class ? i2.class : "", stroke: i2.pointStrokeColor, fill: i2.pointFillColor, "fill-opacity": i2.pointFillOpacity ? i2.pointFillOpacity : 1, "stroke-width": i2.pointStrokeWidth ? i2.pointStrokeWidth : 0, "stroke-opacity": i2.pointStrokeOpacity ? i2.pointStrokeOpacity : 1 }));
        return s2;
      } }, { key: "pathMouseEnter", value: function(t3, e2) {
        var i2 = this.w, a2 = new x(this.ctx), s2 = parseInt(t3.node.getAttribute("index"), 10), r2 = parseInt(t3.node.getAttribute("j"), 10);
        if ("function" == typeof i2.config.chart.events.dataPointMouseEnter && i2.config.chart.events.dataPointMouseEnter(e2, this.ctx, { seriesIndex: s2, dataPointIndex: r2, w: i2 }), this.ctx.events.fireEvent("dataPointMouseEnter", [e2, this.ctx, { seriesIndex: s2, dataPointIndex: r2, w: i2 }]), ("none" === i2.config.states.active.filter.type || "true" !== t3.node.getAttribute("selected")) && "none" !== i2.config.states.hover.filter.type && "none" !== i2.config.states.active.filter.type && !i2.globals.isTouchDevice) {
          var o2 = i2.config.states.hover.filter;
          a2.applyFilter(t3, s2, o2.type, o2.value);
        }
      } }, { key: "pathMouseLeave", value: function(t3, e2) {
        var i2 = this.w, a2 = new x(this.ctx), s2 = parseInt(t3.node.getAttribute("index"), 10), r2 = parseInt(t3.node.getAttribute("j"), 10);
        "function" == typeof i2.config.chart.events.dataPointMouseLeave && i2.config.chart.events.dataPointMouseLeave(e2, this.ctx, { seriesIndex: s2, dataPointIndex: r2, w: i2 }), this.ctx.events.fireEvent("dataPointMouseLeave", [e2, this.ctx, { seriesIndex: s2, dataPointIndex: r2, w: i2 }]), "none" !== i2.config.states.active.filter.type && "true" === t3.node.getAttribute("selected") || "none" !== i2.config.states.hover.filter.type && a2.getDefaultFilter(t3, s2);
      } }, { key: "pathMouseDown", value: function(t3, e2) {
        var i2 = this.w, a2 = new x(this.ctx), s2 = parseInt(t3.node.getAttribute("index"), 10), r2 = parseInt(t3.node.getAttribute("j"), 10), o2 = "false";
        if ("true" === t3.node.getAttribute("selected")) {
          if (t3.node.setAttribute("selected", "false"), i2.globals.selectedDataPoints[s2].indexOf(r2) > -1) {
            var n2 = i2.globals.selectedDataPoints[s2].indexOf(r2);
            i2.globals.selectedDataPoints[s2].splice(n2, 1);
          }
        } else {
          if (!i2.config.states.active.allowMultipleDataPointsSelection && i2.globals.selectedDataPoints.length > 0) {
            i2.globals.selectedDataPoints = [];
            var l2 = i2.globals.dom.Paper.select(".apexcharts-series path").members, h2 = i2.globals.dom.Paper.select(".apexcharts-series circle, .apexcharts-series rect").members, c2 = function(t4) {
              Array.prototype.forEach.call(t4, function(t5) {
                t5.node.setAttribute("selected", "false"), a2.getDefaultFilter(t5, s2);
              });
            };
            c2(l2), c2(h2);
          }
          t3.node.setAttribute("selected", "true"), o2 = "true", void 0 === i2.globals.selectedDataPoints[s2] && (i2.globals.selectedDataPoints[s2] = []), i2.globals.selectedDataPoints[s2].push(r2);
        }
        if ("true" === o2) {
          var d2 = i2.config.states.active.filter;
          "none" !== d2 && a2.applyFilter(t3, s2, d2.type, d2.value);
        } else
          "none" !== i2.config.states.active.filter.type && a2.getDefaultFilter(t3, s2);
        "function" == typeof i2.config.chart.events.dataPointSelection && i2.config.chart.events.dataPointSelection(e2, this.ctx, { selectedDataPoints: i2.globals.selectedDataPoints, seriesIndex: s2, dataPointIndex: r2, w: i2 }), e2 && this.ctx.events.fireEvent("dataPointSelection", [e2, this.ctx, { selectedDataPoints: i2.globals.selectedDataPoints, seriesIndex: s2, dataPointIndex: r2, w: i2 }]);
      } }, { key: "rotateAroundCenter", value: function(t3) {
        var e2 = t3.getBBox();
        return { x: e2.x + e2.width / 2, y: e2.y + e2.height / 2 };
      } }, { key: "getTextRects", value: function(t3, e2, i2, a2) {
        var s2 = !(arguments.length > 4 && void 0 !== arguments[4]) || arguments[4], r2 = this.w, o2 = this.drawText({ x: -200, y: -200, text: t3, textAnchor: "start", fontSize: e2, fontFamily: i2, foreColor: "#fff", opacity: 0 });
        a2 && o2.attr("transform", a2), r2.globals.dom.Paper.add(o2);
        var n2 = o2.bbox();
        return s2 || (n2 = o2.node.getBoundingClientRect()), o2.remove(), { width: n2.width, height: n2.height };
      } }, { key: "placeTextWithEllipsis", value: function(t3, e2, i2) {
        if ("function" == typeof t3.getComputedTextLength && (t3.textContent = e2, e2.length > 0 && t3.getComputedTextLength() >= i2 / 1.1)) {
          for (var a2 = e2.length - 3; a2 > 0; a2 -= 3)
            if (t3.getSubStringLength(0, a2) <= i2 / 1.1)
              return void (t3.textContent = e2.substring(0, a2) + "...");
          t3.textContent = ".";
        }
      } }], [{ key: "setAttrs", value: function(t3, e2) {
        for (var i2 in e2)
          e2.hasOwnProperty(i2) && t3.setAttribute(i2, e2[i2]);
      } }]), t2;
    }();
    var v = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.annoCtx = e2;
      }
      return r(t2, [{ key: "setOrientations", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null, i2 = this.w;
        if ("vertical" === t3.label.orientation) {
          var a2 = null !== e2 ? e2 : 0, s2 = i2.globals.dom.baseEl.querySelector(".apexcharts-xaxis-annotations .apexcharts-xaxis-annotation-label[rel='".concat(a2, "']"));
          if (null !== s2) {
            var r2 = s2.getBoundingClientRect();
            s2.setAttribute("x", parseFloat(s2.getAttribute("x")) - r2.height + 4), "top" === t3.label.position ? s2.setAttribute("y", parseFloat(s2.getAttribute("y")) + r2.width) : s2.setAttribute("y", parseFloat(s2.getAttribute("y")) - r2.width);
            var o2 = this.annoCtx.graphics.rotateAroundCenter(s2), n2 = o2.x, l2 = o2.y;
            s2.setAttribute("transform", "rotate(-90 ".concat(n2, " ").concat(l2, ")"));
          }
        }
      } }, { key: "addBackgroundToAnno", value: function(t3, e2) {
        var i2 = this.w;
        if (!t3 || !e2.label.text || e2.label.text && !e2.label.text.trim())
          return null;
        var a2 = i2.globals.dom.baseEl.querySelector(".apexcharts-grid").getBoundingClientRect(), s2 = t3.getBoundingClientRect(), r2 = e2.label.style.padding.left, o2 = e2.label.style.padding.right, n2 = e2.label.style.padding.top, l2 = e2.label.style.padding.bottom;
        "vertical" === e2.label.orientation && (n2 = e2.label.style.padding.left, l2 = e2.label.style.padding.right, r2 = e2.label.style.padding.top, o2 = e2.label.style.padding.bottom);
        var h2 = s2.left - a2.left - r2, c2 = s2.top - a2.top - n2, d2 = this.annoCtx.graphics.drawRect(h2 - i2.globals.barPadForNumericAxis, c2, s2.width + r2 + o2, s2.height + n2 + l2, e2.label.borderRadius, e2.label.style.background, 1, e2.label.borderWidth, e2.label.borderColor, 0);
        return e2.id && d2.node.classList.add(e2.id), d2;
      } }, { key: "annotationsBackground", value: function() {
        var t3 = this, e2 = this.w, i2 = function(i3, a2, s2) {
          var r2 = e2.globals.dom.baseEl.querySelector(".apexcharts-".concat(s2, "-annotations .apexcharts-").concat(s2, "-annotation-label[rel='").concat(a2, "']"));
          if (r2) {
            var o2 = r2.parentNode, n2 = t3.addBackgroundToAnno(r2, i3);
            n2 && o2.insertBefore(n2.node, r2);
          }
        };
        e2.config.annotations.xaxis.map(function(t4, e3) {
          i2(t4, e3, "xaxis");
        }), e2.config.annotations.yaxis.map(function(t4, e3) {
          i2(t4, e3, "yaxis");
        }), e2.config.annotations.points.map(function(t4, e3) {
          i2(t4, e3, "point");
        });
      } }, { key: "getStringX", value: function(t3) {
        var e2 = this.w, i2 = t3;
        e2.config.xaxis.convertedCatToNumeric && e2.globals.categoryLabels.length && (t3 = e2.globals.categoryLabels.indexOf(t3) + 1);
        var a2 = e2.globals.labels.indexOf(t3), s2 = e2.globals.dom.baseEl.querySelector(".apexcharts-xaxis-texts-g text:nth-child(" + (a2 + 1) + ")");
        return s2 && (i2 = parseFloat(s2.getAttribute("x"))), i2;
      } }]), t2;
    }();
    var m = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.annoCtx = e2, this.invertAxis = this.annoCtx.invertAxis;
      }
      return r(t2, [{ key: "addXaxisAnnotation", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = this.invertAxis ? a2.globals.minY : a2.globals.minX, r2 = this.invertAxis ? a2.globals.maxY : a2.globals.maxX, o2 = this.invertAxis ? a2.globals.yRange[0] : a2.globals.xRange, n2 = (t3.x - s2) / (o2 / a2.globals.gridWidth);
        this.annoCtx.inversedReversedAxis && (n2 = (r2 - t3.x) / (o2 / a2.globals.gridWidth));
        var l2 = t3.label.text;
        "category" !== a2.config.xaxis.type && !a2.config.xaxis.convertedCatToNumeric || this.invertAxis || a2.globals.dataFormatXNumeric || (n2 = this.annoCtx.helpers.getStringX(t3.x));
        var h2 = t3.strokeDashArray;
        if (p.isNumber(n2)) {
          if (null === t3.x2 || void 0 === t3.x2) {
            var c2 = this.annoCtx.graphics.drawLine(n2 + t3.offsetX, 0 + t3.offsetY, n2 + t3.offsetX, a2.globals.gridHeight + t3.offsetY, t3.borderColor, h2, t3.borderWidth);
            e2.appendChild(c2.node), t3.id && c2.node.classList.add(t3.id);
          } else {
            var d2 = (t3.x2 - s2) / (o2 / a2.globals.gridWidth);
            if (this.annoCtx.inversedReversedAxis && (d2 = (r2 - t3.x2) / (o2 / a2.globals.gridWidth)), "category" !== a2.config.xaxis.type && !a2.config.xaxis.convertedCatToNumeric || this.invertAxis || a2.globals.dataFormatXNumeric || (d2 = this.annoCtx.helpers.getStringX(t3.x2)), d2 < n2) {
              var g2 = n2;
              n2 = d2, d2 = g2;
            }
            var u2 = this.annoCtx.graphics.drawRect(n2 + t3.offsetX, 0 + t3.offsetY, d2 - n2, a2.globals.gridHeight + t3.offsetY, 0, t3.fillColor, t3.opacity, 1, t3.borderColor, h2);
            u2.node.classList.add("apexcharts-annotation-rect"), u2.attr("clip-path", "url(#gridRectMask".concat(a2.globals.cuid, ")")), e2.appendChild(u2.node), t3.id && u2.node.classList.add(t3.id);
          }
          var f2 = "top" === t3.label.position ? 4 : a2.globals.gridHeight, x2 = this.annoCtx.graphics.getTextRects(l2, parseFloat(t3.label.style.fontSize)), b2 = this.annoCtx.graphics.drawText({ x: n2 + t3.label.offsetX, y: f2 + t3.label.offsetY - ("vertical" === t3.label.orientation ? "top" === t3.label.position ? x2.width / 2 - 12 : -x2.width / 2 : 0), text: l2, textAnchor: t3.label.textAnchor, fontSize: t3.label.style.fontSize, fontFamily: t3.label.style.fontFamily, fontWeight: t3.label.style.fontWeight, foreColor: t3.label.style.color, cssClass: "apexcharts-xaxis-annotation-label ".concat(t3.label.style.cssClass, " ").concat(t3.id ? t3.id : "") });
          b2.attr({ rel: i2 }), e2.appendChild(b2.node), this.annoCtx.helpers.setOrientations(t3, i2);
        }
      } }, { key: "drawXAxisAnnotations", value: function() {
        var t3 = this, e2 = this.w, i2 = this.annoCtx.graphics.group({ class: "apexcharts-xaxis-annotations" });
        return e2.config.annotations.xaxis.map(function(e3, a2) {
          t3.addXaxisAnnotation(e3, i2.node, a2);
        }), i2;
      } }]), t2;
    }();
    var y = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "getStackedSeriesTotals", value: function() {
        var t3 = this.w, e2 = [];
        if (0 === t3.globals.series.length)
          return e2;
        for (var i2 = 0; i2 < t3.globals.series[t3.globals.maxValsInArrayIndex].length; i2++) {
          for (var a2 = 0, s2 = 0; s2 < t3.globals.series.length; s2++)
            void 0 !== t3.globals.series[s2][i2] && (a2 += t3.globals.series[s2][i2]);
          e2.push(a2);
        }
        return t3.globals.stackedSeriesTotals = e2, e2;
      } }, { key: "getSeriesTotalByIndex", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
        return null === t3 ? this.w.config.series.reduce(function(t4, e2) {
          return t4 + e2;
        }, 0) : this.w.globals.series[t3].reduce(function(t4, e2) {
          return t4 + e2;
        }, 0);
      } }, { key: "isSeriesNull", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
        return 0 === (null === t3 ? this.w.config.series.filter(function(t4) {
          return null !== t4;
        }) : this.w.config.series[t3].data.filter(function(t4) {
          return null !== t4;
        })).length;
      } }, { key: "seriesHaveSameValues", value: function(t3) {
        return this.w.globals.series[t3].every(function(t4, e2, i2) {
          return t4 === i2[0];
        });
      } }, { key: "getCategoryLabels", value: function(t3) {
        var e2 = this.w, i2 = t3.slice();
        return e2.config.xaxis.convertedCatToNumeric && (i2 = t3.map(function(t4, i3) {
          return e2.config.xaxis.labels.formatter(t4 - e2.globals.minX + 1);
        })), i2;
      } }, { key: "getLargestSeries", value: function() {
        var t3 = this.w;
        t3.globals.maxValsInArrayIndex = t3.globals.series.map(function(t4) {
          return t4.length;
        }).indexOf(Math.max.apply(Math, t3.globals.series.map(function(t4) {
          return t4.length;
        })));
      } }, { key: "getLargestMarkerSize", value: function() {
        var t3 = this.w, e2 = 0;
        return t3.globals.markers.size.forEach(function(t4) {
          e2 = Math.max(e2, t4);
        }), t3.globals.markers.largestSize = e2, e2;
      } }, { key: "getSeriesTotals", value: function() {
        var t3 = this.w;
        t3.globals.seriesTotals = t3.globals.series.map(function(t4, e2) {
          var i2 = 0;
          if (Array.isArray(t4))
            for (var a2 = 0; a2 < t4.length; a2++)
              i2 += t4[a2];
          else
            i2 += t4;
          return i2;
        });
      } }, { key: "getSeriesTotalsXRange", value: function(t3, e2) {
        var i2 = this.w;
        return i2.globals.series.map(function(a2, s2) {
          for (var r2 = 0, o2 = 0; o2 < a2.length; o2++)
            i2.globals.seriesX[s2][o2] > t3 && i2.globals.seriesX[s2][o2] < e2 && (r2 += a2[o2]);
          return r2;
        });
      } }, { key: "getPercentSeries", value: function() {
        var t3 = this.w;
        t3.globals.seriesPercent = t3.globals.series.map(function(e2, i2) {
          var a2 = [];
          if (Array.isArray(e2))
            for (var s2 = 0; s2 < e2.length; s2++) {
              var r2 = t3.globals.stackedSeriesTotals[s2], o2 = 0;
              r2 && (o2 = 100 * e2[s2] / r2), a2.push(o2);
            }
          else {
            var n2 = 100 * e2 / t3.globals.seriesTotals.reduce(function(t4, e3) {
              return t4 + e3;
            }, 0);
            a2.push(n2);
          }
          return a2;
        });
      } }, { key: "getCalculatedRatios", value: function() {
        var t3, e2, i2, a2, s2 = this.w.globals, r2 = [], o2 = 0, n2 = [], l2 = 0.1, h2 = 0;
        if (s2.yRange = [], s2.isMultipleYAxis)
          for (var c2 = 0; c2 < s2.minYArr.length; c2++)
            s2.yRange.push(Math.abs(s2.minYArr[c2] - s2.maxYArr[c2])), n2.push(0);
        else
          s2.yRange.push(Math.abs(s2.minY - s2.maxY));
        s2.xRange = Math.abs(s2.maxX - s2.minX), s2.zRange = Math.abs(s2.maxZ - s2.minZ);
        for (var d2 = 0; d2 < s2.yRange.length; d2++)
          r2.push(s2.yRange[d2] / s2.gridHeight);
        if (e2 = s2.xRange / s2.gridWidth, i2 = Math.abs(s2.initialMaxX - s2.initialMinX) / s2.gridWidth, t3 = s2.yRange / s2.gridWidth, a2 = s2.xRange / s2.gridHeight, (o2 = s2.zRange / s2.gridHeight * 16) || (o2 = 1), s2.minY !== Number.MIN_VALUE && 0 !== Math.abs(s2.minY) && (s2.hasNegs = true), s2.isMultipleYAxis) {
          n2 = [];
          for (var g2 = 0; g2 < r2.length; g2++)
            n2.push(-s2.minYArr[g2] / r2[g2]);
        } else
          n2.push(-s2.minY / r2[0]), s2.minY !== Number.MIN_VALUE && 0 !== Math.abs(s2.minY) && (l2 = -s2.minY / t3, h2 = s2.minX / e2);
        return { yRatio: r2, invertedYRatio: t3, zRatio: o2, xRatio: e2, initialXRatio: i2, invertedXRatio: a2, baseLineInvertedY: l2, baseLineY: n2, baseLineX: h2 };
      } }, { key: "getLogSeries", value: function(t3) {
        var e2 = this, i2 = this.w;
        return i2.globals.seriesLog = t3.map(function(t4, a2) {
          return i2.config.yaxis[a2] && i2.config.yaxis[a2].logarithmic ? t4.map(function(t5) {
            return null === t5 ? null : e2.getLogVal(t5, a2);
          }) : t4;
        }), i2.globals.invalidLogScale ? t3 : i2.globals.seriesLog;
      } }, { key: "getLogVal", value: function(t3, e2) {
        var i2 = this.w;
        return (Math.log(t3) - Math.log(i2.globals.minYArr[e2])) / (Math.log(i2.globals.maxYArr[e2]) - Math.log(i2.globals.minYArr[e2]));
      } }, { key: "getLogYRatios", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = this.w.globals;
        return a2.yLogRatio = t3.slice(), a2.logYRange = a2.yRange.map(function(t4, s2) {
          if (i2.config.yaxis[s2] && e2.w.config.yaxis[s2].logarithmic) {
            var r2, o2 = -Number.MAX_VALUE, n2 = Number.MIN_VALUE;
            return a2.seriesLog.forEach(function(t5, e3) {
              t5.forEach(function(t6) {
                i2.config.yaxis[e3] && i2.config.yaxis[e3].logarithmic && (o2 = Math.max(t6, o2), n2 = Math.min(t6, n2));
              });
            }), r2 = Math.pow(a2.yRange[s2], Math.abs(n2 - o2) / a2.yRange[s2]), a2.yLogRatio[s2] = r2 / a2.gridHeight, r2;
          }
        }), a2.invalidLogScale ? t3.slice() : a2.yLogRatio;
      } }], [{ key: "checkComboSeries", value: function(t3) {
        var e2 = false, i2 = 0, a2 = 0;
        return t3.length && void 0 !== t3[0].type && t3.forEach(function(t4) {
          "bar" !== t4.type && "column" !== t4.type && "candlestick" !== t4.type && "boxPlot" !== t4.type || i2++, void 0 !== t4.type && a2++;
        }), a2 > 1 && (e2 = true), { comboBarCount: i2, comboCharts: e2 };
      } }, { key: "extendArrayProps", value: function(t3, e2, i2) {
        return e2.yaxis && (e2 = t3.extendYAxis(e2, i2)), e2.annotations && (e2.annotations.yaxis && (e2 = t3.extendYAxisAnnotations(e2)), e2.annotations.xaxis && (e2 = t3.extendXAxisAnnotations(e2)), e2.annotations.points && (e2 = t3.extendPointAnnotations(e2))), e2;
      } }]), t2;
    }();
    var w = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.annoCtx = e2;
      }
      return r(t2, [{ key: "addYaxisAnnotation", value: function(t3, e2, i2) {
        var a2, s2 = this.w, r2 = t3.strokeDashArray, o2 = this._getY1Y2("y1", t3), n2 = t3.label.text;
        if (null === t3.y2 || void 0 === t3.y2) {
          var l2 = this.annoCtx.graphics.drawLine(0 + t3.offsetX, o2 + t3.offsetY, this._getYAxisAnnotationWidth(t3), o2 + t3.offsetY, t3.borderColor, r2, t3.borderWidth);
          e2.appendChild(l2.node), t3.id && l2.node.classList.add(t3.id);
        } else {
          if ((a2 = this._getY1Y2("y2", t3)) > o2) {
            var h2 = o2;
            o2 = a2, a2 = h2;
          }
          var c2 = this.annoCtx.graphics.drawRect(0 + t3.offsetX, a2 + t3.offsetY, this._getYAxisAnnotationWidth(t3), o2 - a2, 0, t3.fillColor, t3.opacity, 1, t3.borderColor, r2);
          c2.node.classList.add("apexcharts-annotation-rect"), c2.attr("clip-path", "url(#gridRectMask".concat(s2.globals.cuid, ")")), e2.appendChild(c2.node), t3.id && c2.node.classList.add(t3.id);
        }
        var d2 = "right" === t3.label.position ? s2.globals.gridWidth : 0, g2 = this.annoCtx.graphics.drawText({ x: d2 + t3.label.offsetX, y: (a2 || o2) + t3.label.offsetY - 3, text: n2, textAnchor: t3.label.textAnchor, fontSize: t3.label.style.fontSize, fontFamily: t3.label.style.fontFamily, fontWeight: t3.label.style.fontWeight, foreColor: t3.label.style.color, cssClass: "apexcharts-yaxis-annotation-label ".concat(t3.label.style.cssClass, " ").concat(t3.id ? t3.id : "") });
        g2.attr({ rel: i2 }), e2.appendChild(g2.node);
      } }, { key: "_getY1Y2", value: function(t3, e2) {
        var i2, a2 = "y1" === t3 ? e2.y : e2.y2, s2 = this.w;
        if (this.annoCtx.invertAxis) {
          var r2 = s2.globals.labels.indexOf(a2);
          s2.config.xaxis.convertedCatToNumeric && (r2 = s2.globals.categoryLabels.indexOf(a2));
          var o2 = s2.globals.dom.baseEl.querySelector(".apexcharts-yaxis-texts-g text:nth-child(" + (r2 + 1) + ")");
          o2 && (i2 = parseFloat(o2.getAttribute("y")));
        } else {
          var n2;
          if (s2.config.yaxis[e2.yAxisIndex].logarithmic)
            n2 = (a2 = new y(this.annoCtx.ctx).getLogVal(a2, e2.yAxisIndex)) / s2.globals.yLogRatio[e2.yAxisIndex];
          else
            n2 = (a2 - s2.globals.minYArr[e2.yAxisIndex]) / (s2.globals.yRange[e2.yAxisIndex] / s2.globals.gridHeight);
          i2 = s2.globals.gridHeight - n2, s2.config.yaxis[e2.yAxisIndex] && s2.config.yaxis[e2.yAxisIndex].reversed && (i2 = n2);
        }
        return i2;
      } }, { key: "_getYAxisAnnotationWidth", value: function(t3) {
        var e2 = this.w;
        e2.globals.gridWidth;
        return (t3.width.indexOf("%") > -1 ? e2.globals.gridWidth * parseInt(t3.width, 10) / 100 : parseInt(t3.width, 10)) + t3.offsetX;
      } }, { key: "drawYAxisAnnotations", value: function() {
        var t3 = this, e2 = this.w, i2 = this.annoCtx.graphics.group({ class: "apexcharts-yaxis-annotations" });
        return e2.config.annotations.yaxis.map(function(e3, a2) {
          t3.addYaxisAnnotation(e3, i2.node, a2);
        }), i2;
      } }]), t2;
    }();
    var k = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.annoCtx = e2;
      }
      return r(t2, [{ key: "addPointAnnotation", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = 0, r2 = 0, o2 = 0;
        this.annoCtx.invertAxis && console.warn("Point annotation is not supported in horizontal bar charts.");
        var n2 = parseFloat(t3.y);
        if ("string" == typeof t3.x) {
          var l2 = a2.globals.labels.indexOf(t3.x);
          a2.config.xaxis.convertedCatToNumeric && (l2 = a2.globals.categoryLabels.indexOf(t3.x)), s2 = this.annoCtx.helpers.getStringX(t3.x), null === t3.y && (n2 = a2.globals.series[t3.seriesIndex][l2]);
        } else
          s2 = (t3.x - a2.globals.minX) / (a2.globals.xRange / a2.globals.gridWidth);
        for (var h2, c2 = [], d2 = 0, g2 = 0; g2 <= t3.seriesIndex; g2++) {
          var u2 = a2.config.yaxis[g2].seriesName;
          if (u2)
            for (var f2 = g2 + 1; f2 <= t3.seriesIndex; f2++)
              a2.config.yaxis[f2].seriesName === u2 && -1 === c2.indexOf(u2) && (d2++, c2.push(u2));
        }
        if (a2.config.yaxis[t3.yAxisIndex].logarithmic) {
          h2 = (n2 = new y(this.annoCtx.ctx).getLogVal(n2, t3.yAxisIndex)) / a2.globals.yLogRatio[t3.yAxisIndex];
        } else {
          var x2 = t3.yAxisIndex + d2;
          h2 = (n2 - a2.globals.minYArr[x2]) / (a2.globals.yRange[x2] / a2.globals.gridHeight);
        }
        if (r2 = a2.globals.gridHeight - h2 - parseFloat(t3.label.style.fontSize) - t3.marker.size, o2 = a2.globals.gridHeight - h2, a2.config.yaxis[t3.yAxisIndex] && a2.config.yaxis[t3.yAxisIndex].reversed && (r2 = h2 + parseFloat(t3.label.style.fontSize) + t3.marker.size, o2 = h2), p.isNumber(s2)) {
          var b2 = { pSize: t3.marker.size, pointStrokeWidth: t3.marker.strokeWidth, pointFillColor: t3.marker.fillColor, pointStrokeColor: t3.marker.strokeColor, shape: t3.marker.shape, pRadius: t3.marker.radius, class: "apexcharts-point-annotation-marker ".concat(t3.marker.cssClass, " ").concat(t3.id ? t3.id : "") }, v2 = this.annoCtx.graphics.drawMarker(s2 + t3.marker.offsetX, o2 + t3.marker.offsetY, b2);
          e2.appendChild(v2.node);
          var m2 = t3.label.text ? t3.label.text : "", w2 = this.annoCtx.graphics.drawText({ x: s2 + t3.label.offsetX, y: r2 + t3.label.offsetY, text: m2, textAnchor: t3.label.textAnchor, fontSize: t3.label.style.fontSize, fontFamily: t3.label.style.fontFamily, fontWeight: t3.label.style.fontWeight, foreColor: t3.label.style.color, cssClass: "apexcharts-point-annotation-label ".concat(t3.label.style.cssClass, " ").concat(t3.id ? t3.id : "") });
          if (w2.attr({ rel: i2 }), e2.appendChild(w2.node), t3.customSVG.SVG) {
            var k2 = this.annoCtx.graphics.group({ class: "apexcharts-point-annotations-custom-svg " + t3.customSVG.cssClass });
            k2.attr({ transform: "translate(".concat(s2 + t3.customSVG.offsetX, ", ").concat(r2 + t3.customSVG.offsetY, ")") }), k2.node.innerHTML = t3.customSVG.SVG, e2.appendChild(k2.node);
          }
          if (t3.image.path) {
            var A2 = t3.image.width ? t3.image.width : 20, S2 = t3.image.height ? t3.image.height : 20;
            this.annoCtx.addImage({ x: s2 + t3.image.offsetX - A2 / 2, y: r2 + t3.image.offsetY - S2 / 2, width: A2, height: S2, path: t3.image.path, appendTo: ".apexcharts-point-annotations" });
          }
        }
      } }, { key: "drawPointAnnotations", value: function() {
        var t3 = this, e2 = this.w, i2 = this.annoCtx.graphics.group({ class: "apexcharts-point-annotations" });
        return e2.config.annotations.points.map(function(e3, a2) {
          t3.addPointAnnotation(e3, i2.node, a2);
        }), i2;
      } }]), t2;
    }();
    var A = { name: "en", options: { months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"], shortDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"], toolbar: { exportToSVG: "Download SVG", exportToPNG: "Download PNG", exportToCSV: "Download CSV", menu: "Menu", selection: "Selection", selectionZoom: "Selection Zoom", zoomIn: "Zoom In", zoomOut: "Zoom Out", pan: "Panning", reset: "Reset Zoom" } } };
    var S = function() {
      function t2() {
        a(this, t2), this.yAxis = { show: true, showAlways: false, showForNullSeries: true, seriesName: void 0, opposite: false, reversed: false, logarithmic: false, tickAmount: void 0, forceNiceScale: false, max: void 0, min: void 0, floating: false, decimalsInFloat: void 0, labels: { show: true, minWidth: 0, maxWidth: 160, offsetX: 0, offsetY: 0, align: void 0, rotate: 0, padding: 20, style: { colors: [], fontSize: "11px", fontWeight: 400, fontFamily: void 0, cssClass: "" }, formatter: void 0 }, axisBorder: { show: false, color: "#e0e0e0", width: 1, offsetX: 0, offsetY: 0 }, axisTicks: { show: false, color: "#e0e0e0", width: 6, offsetX: 0, offsetY: 0 }, title: { text: void 0, rotate: -90, offsetY: 0, offsetX: 0, style: { color: void 0, fontSize: "11px", fontWeight: 900, fontFamily: void 0, cssClass: "" } }, tooltip: { enabled: false, offsetX: 0 }, crosshairs: { show: true, position: "front", stroke: { color: "#b6b6b6", width: 1, dashArray: 0 } } }, this.pointAnnotation = { x: 0, y: null, yAxisIndex: 0, seriesIndex: 0, marker: { size: 4, fillColor: "#fff", strokeWidth: 2, strokeColor: "#333", shape: "circle", offsetX: 0, offsetY: 0, radius: 2, cssClass: "" }, label: { borderColor: "#c2c2c2", borderWidth: 1, borderRadius: 2, text: void 0, textAnchor: "middle", offsetX: 0, offsetY: 0, style: { background: "#fff", color: void 0, fontSize: "11px", fontFamily: void 0, fontWeight: 400, cssClass: "", padding: { left: 5, right: 5, top: 2, bottom: 2 } } }, customSVG: { SVG: void 0, cssClass: void 0, offsetX: 0, offsetY: 0 }, image: { path: void 0, width: 20, height: 20, offsetX: 0, offsetY: 0 } }, this.yAxisAnnotation = { y: 0, y2: null, strokeDashArray: 1, fillColor: "#c2c2c2", borderColor: "#c2c2c2", borderWidth: 1, opacity: 0.3, offsetX: 0, offsetY: 0, width: "100%", yAxisIndex: 0, label: { borderColor: "#c2c2c2", borderWidth: 1, borderRadius: 2, text: void 0, textAnchor: "end", position: "right", offsetX: 0, offsetY: -3, style: { background: "#fff", color: void 0, fontSize: "11px", fontFamily: void 0, fontWeight: 400, cssClass: "", padding: { left: 5, right: 5, top: 2, bottom: 2 } } } }, this.xAxisAnnotation = { x: 0, x2: null, strokeDashArray: 1, fillColor: "#c2c2c2", borderColor: "#c2c2c2", borderWidth: 1, opacity: 0.3, offsetX: 0, offsetY: 0, label: { borderColor: "#c2c2c2", borderWidth: 1, borderRadius: 2, text: void 0, textAnchor: "middle", orientation: "vertical", position: "top", offsetX: 0, offsetY: 0, style: { background: "#fff", color: void 0, fontSize: "11px", fontFamily: void 0, fontWeight: 400, cssClass: "", padding: { left: 5, right: 5, top: 2, bottom: 2 } } } }, this.text = { x: 0, y: 0, text: "", textAnchor: "start", foreColor: void 0, fontSize: "13px", fontFamily: void 0, fontWeight: 400, appendTo: ".apexcharts-annotations", backgroundColor: "transparent", borderColor: "#c2c2c2", borderRadius: 0, borderWidth: 0, paddingLeft: 4, paddingRight: 4, paddingTop: 2, paddingBottom: 2 };
      }
      return r(t2, [{ key: "init", value: function() {
        return { annotations: { position: "front", yaxis: [this.yAxisAnnotation], xaxis: [this.xAxisAnnotation], points: [this.pointAnnotation], texts: [], images: [], shapes: [] }, chart: { animations: { enabled: true, easing: "easeinout", speed: 800, animateGradually: { delay: 150, enabled: true }, dynamicAnimation: { enabled: true, speed: 350 } }, background: "transparent", locales: [A], defaultLocale: "en", dropShadow: { enabled: false, enabledOnSeries: void 0, top: 2, left: 2, blur: 4, color: "#000", opacity: 0.35 }, events: { animationEnd: void 0, beforeMount: void 0, mounted: void 0, updated: void 0, click: void 0, mouseMove: void 0, mouseLeave: void 0, legendClick: void 0, markerClick: void 0, selection: void 0, dataPointSelection: void 0, dataPointMouseEnter: void 0, dataPointMouseLeave: void 0, beforeZoom: void 0, beforeResetZoom: void 0, zoomed: void 0, scrolled: void 0, brushScrolled: void 0 }, foreColor: "#373d3f", fontFamily: "Helvetica, Arial, sans-serif", height: "auto", parentHeightOffset: 15, redrawOnParentResize: true, redrawOnWindowResize: true, id: void 0, group: void 0, offsetX: 0, offsetY: 0, selection: { enabled: false, type: "x", fill: { color: "#24292e", opacity: 0.1 }, stroke: { width: 1, color: "#24292e", opacity: 0.4, dashArray: 3 }, xaxis: { min: void 0, max: void 0 }, yaxis: { min: void 0, max: void 0 } }, sparkline: { enabled: false }, brush: { enabled: false, autoScaleYaxis: true, target: void 0 }, stacked: false, stackType: "normal", toolbar: { show: true, offsetX: 0, offsetY: 0, tools: { download: true, selection: true, zoom: true, zoomin: true, zoomout: true, pan: true, reset: true, customIcons: [] }, export: { csv: { filename: void 0, columnDelimiter: ",", headerCategory: "category", headerValue: "value", dateFormatter: function(t3) {
          return new Date(t3).toDateString();
        } }, png: { filename: void 0 }, svg: { filename: void 0 } }, autoSelected: "zoom" }, type: "line", width: "100%", zoom: { enabled: true, type: "x", autoScaleYaxis: false, zoomedArea: { fill: { color: "#90CAF9", opacity: 0.4 }, stroke: { color: "#0D47A1", opacity: 0.4, width: 1 } } } }, plotOptions: { area: { fillTo: "origin" }, bar: { horizontal: false, columnWidth: "70%", barHeight: "70%", distributed: false, borderRadius: 0, startingShape: "flat", endingShape: "flat", rangeBarOverlap: true, rangeBarGroupRows: false, colors: { ranges: [], backgroundBarColors: [], backgroundBarOpacity: 1, backgroundBarRadius: 0 }, dataLabels: { position: "top", maxItems: 100, hideOverflowingLabels: true, orientation: "horizontal" } }, bubble: { minBubbleRadius: void 0, maxBubbleRadius: void 0 }, candlestick: { colors: { upward: "#00B746", downward: "#EF403C" }, wick: { useFillColor: true } }, boxPlot: { colors: { upper: "#00E396", lower: "#008FFB" } }, heatmap: { radius: 2, enableShades: true, shadeIntensity: 0.5, reverseNegativeShade: false, distributed: false, useFillColorAsStroke: false, colorScale: { inverse: false, ranges: [], min: void 0, max: void 0 } }, treemap: { enableShades: true, shadeIntensity: 0.5, distributed: false, reverseNegativeShade: false, useFillColorAsStroke: false, colorScale: { inverse: false, ranges: [], min: void 0, max: void 0 } }, radialBar: { inverseOrder: false, startAngle: 0, endAngle: 360, offsetX: 0, offsetY: 0, hollow: { margin: 5, size: "50%", background: "transparent", image: void 0, imageWidth: 150, imageHeight: 150, imageOffsetX: 0, imageOffsetY: 0, imageClipped: true, position: "front", dropShadow: { enabled: false, top: 0, left: 0, blur: 3, color: "#000", opacity: 0.5 } }, track: { show: true, startAngle: void 0, endAngle: void 0, background: "#f2f2f2", strokeWidth: "97%", opacity: 1, margin: 5, dropShadow: { enabled: false, top: 0, left: 0, blur: 3, color: "#000", opacity: 0.5 } }, dataLabels: { show: true, name: { show: true, fontSize: "16px", fontFamily: void 0, fontWeight: 600, color: void 0, offsetY: 0, formatter: function(t3) {
          return t3;
        } }, value: { show: true, fontSize: "14px", fontFamily: void 0, fontWeight: 400, color: void 0, offsetY: 16, formatter: function(t3) {
          return t3 + "%";
        } }, total: { show: false, label: "Total", fontSize: "16px", fontWeight: 600, fontFamily: void 0, color: void 0, formatter: function(t3) {
          return t3.globals.seriesTotals.reduce(function(t4, e2) {
            return t4 + e2;
          }, 0) / t3.globals.series.length + "%";
        } } } }, pie: { customScale: 1, offsetX: 0, offsetY: 0, startAngle: 0, endAngle: 360, expandOnClick: true, dataLabels: { offset: 0, minAngleToShowLabel: 10 }, donut: { size: "65%", background: "transparent", labels: { show: false, name: { show: true, fontSize: "16px", fontFamily: void 0, fontWeight: 600, color: void 0, offsetY: -10, formatter: function(t3) {
          return t3;
        } }, value: { show: true, fontSize: "20px", fontFamily: void 0, fontWeight: 400, color: void 0, offsetY: 10, formatter: function(t3) {
          return t3;
        } }, total: { show: false, showAlways: false, label: "Total", fontSize: "16px", fontWeight: 400, fontFamily: void 0, color: void 0, formatter: function(t3) {
          return t3.globals.seriesTotals.reduce(function(t4, e2) {
            return t4 + e2;
          }, 0);
        } } } } }, polarArea: { rings: { strokeWidth: 1, strokeColor: "#e8e8e8" }, spokes: { strokeWidth: 1, connectorColors: "#e8e8e8" } }, radar: { size: void 0, offsetX: 0, offsetY: 0, polygons: { strokeWidth: 1, strokeColors: "#e8e8e8", connectorColors: "#e8e8e8", fill: { colors: void 0 } } } }, colors: void 0, dataLabels: { enabled: true, enabledOnSeries: void 0, formatter: function(t3) {
          return null !== t3 ? t3 : "";
        }, textAnchor: "middle", distributed: false, offsetX: 0, offsetY: 0, style: { fontSize: "12px", fontFamily: void 0, fontWeight: 600, colors: void 0 }, background: { enabled: true, foreColor: "#fff", borderRadius: 2, padding: 4, opacity: 0.9, borderWidth: 1, borderColor: "#fff", dropShadow: { enabled: false, top: 1, left: 1, blur: 1, color: "#000", opacity: 0.45 } }, dropShadow: { enabled: false, top: 1, left: 1, blur: 1, color: "#000", opacity: 0.45 } }, fill: { type: "solid", colors: void 0, opacity: 0.85, gradient: { shade: "dark", type: "horizontal", shadeIntensity: 0.5, gradientToColors: void 0, inverseColors: true, opacityFrom: 1, opacityTo: 1, stops: [0, 50, 100], colorStops: [] }, image: { src: [], width: void 0, height: void 0 }, pattern: { style: "squares", width: 6, height: 6, strokeWidth: 2 } }, forecastDataPoints: { count: 0, fillOpacity: 0.5, strokeWidth: void 0, dashArray: 4 }, grid: { show: true, borderColor: "#e0e0e0", strokeDashArray: 0, position: "back", xaxis: { lines: { show: false } }, yaxis: { lines: { show: true } }, row: { colors: void 0, opacity: 0.5 }, column: { colors: void 0, opacity: 0.5 }, padding: { top: 0, right: 10, bottom: 0, left: 12 } }, labels: [], legend: { show: true, showForSingleSeries: false, showForNullSeries: true, showForZeroSeries: true, floating: false, position: "bottom", horizontalAlign: "center", inverseOrder: false, fontSize: "12px", fontFamily: void 0, fontWeight: 400, width: void 0, height: void 0, formatter: void 0, tooltipHoverFormatter: void 0, offsetX: -20, offsetY: 4, customLegendItems: [], labels: { colors: void 0, useSeriesColors: false }, markers: { width: 12, height: 12, strokeWidth: 0, fillColors: void 0, strokeColor: "#fff", radius: 12, customHTML: void 0, offsetX: 0, offsetY: 0, onClick: void 0 }, itemMargin: { horizontal: 5, vertical: 2 }, onItemClick: { toggleDataSeries: true }, onItemHover: { highlightDataSeries: true } }, markers: { discrete: [], size: 0, colors: void 0, strokeColors: "#fff", strokeWidth: 2, strokeOpacity: 0.9, strokeDashArray: 0, fillOpacity: 1, shape: "circle", width: 8, height: 8, radius: 2, offsetX: 0, offsetY: 0, onClick: void 0, onDblClick: void 0, showNullDataPoints: true, hover: { size: void 0, sizeOffset: 3 } }, noData: { text: void 0, align: "center", verticalAlign: "middle", offsetX: 0, offsetY: 0, style: { color: void 0, fontSize: "14px", fontFamily: void 0 } }, responsive: [], series: void 0, states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "lighten", value: 0.1 } }, active: { allowMultipleDataPointsSelection: false, filter: { type: "darken", value: 0.5 } } }, title: { text: void 0, align: "left", margin: 5, offsetX: 0, offsetY: 0, floating: false, style: { fontSize: "14px", fontWeight: 900, fontFamily: void 0, color: void 0 } }, subtitle: { text: void 0, align: "left", margin: 5, offsetX: 0, offsetY: 30, floating: false, style: { fontSize: "12px", fontWeight: 400, fontFamily: void 0, color: void 0 } }, stroke: { show: true, curve: "smooth", lineCap: "butt", width: 2, colors: void 0, dashArray: 0 }, tooltip: { enabled: true, enabledOnSeries: void 0, shared: true, followCursor: false, intersect: false, inverseOrder: false, custom: void 0, fillSeriesColor: false, theme: "light", style: { fontSize: "12px", fontFamily: void 0 }, onDatasetHover: { highlightDataSeries: false }, x: { show: true, format: "dd MMM", formatter: void 0 }, y: { formatter: void 0, title: { formatter: function(t3) {
          return t3 ? t3 + ": " : "";
        } } }, z: { formatter: void 0, title: "Size: " }, marker: { show: true, fillColors: void 0 }, items: { display: "flex" }, fixed: { enabled: false, position: "topRight", offsetX: 0, offsetY: 0 } }, xaxis: { type: "category", categories: [], convertedCatToNumeric: false, offsetX: 0, offsetY: 0, overwriteCategories: void 0, labels: { show: true, rotate: -45, rotateAlways: false, hideOverlappingLabels: true, trim: false, minHeight: void 0, maxHeight: 120, showDuplicates: true, style: { colors: [], fontSize: "12px", fontWeight: 400, fontFamily: void 0, cssClass: "" }, offsetX: 0, offsetY: 0, format: void 0, formatter: void 0, datetimeUTC: true, datetimeFormatter: { year: "yyyy", month: "MMM 'yy", day: "dd MMM", hour: "HH:mm", minute: "HH:mm:ss", second: "HH:mm:ss" } }, axisBorder: { show: true, color: "#e0e0e0", width: "100%", height: 1, offsetX: 0, offsetY: 0 }, axisTicks: { show: true, color: "#e0e0e0", height: 6, offsetX: 0, offsetY: 0 }, tickAmount: void 0, tickPlacement: "on", min: void 0, max: void 0, range: void 0, floating: false, decimalsInFloat: void 0, position: "bottom", title: { text: void 0, offsetX: 0, offsetY: 0, style: { color: void 0, fontSize: "12px", fontWeight: 900, fontFamily: void 0, cssClass: "" } }, crosshairs: { show: true, width: 1, position: "back", opacity: 0.9, stroke: { color: "#b6b6b6", width: 1, dashArray: 3 }, fill: { type: "solid", color: "#B1B9C4", gradient: { colorFrom: "#D8E3F0", colorTo: "#BED1E6", stops: [0, 100], opacityFrom: 0.4, opacityTo: 0.5 } }, dropShadow: { enabled: false, left: 0, top: 0, blur: 1, opacity: 0.4 } }, tooltip: { enabled: true, offsetY: 0, formatter: void 0, style: { fontSize: "12px", fontFamily: void 0 } } }, yaxis: this.yAxis, theme: { mode: "light", palette: "palette1", monochrome: { enabled: false, color: "#008FFB", shadeTo: "light", shadeIntensity: 0.65 } } };
      } }]), t2;
    }();
    var C = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.graphics = new b(this.ctx), this.w.globals.isBarHorizontal && (this.invertAxis = true), this.helpers = new v(this), this.xAxisAnnotations = new m(this), this.yAxisAnnotations = new w(this), this.pointsAnnotations = new k(this), this.w.globals.isBarHorizontal && this.w.config.yaxis[0].reversed && (this.inversedReversedAxis = true), this.xDivision = this.w.globals.gridWidth / this.w.globals.dataPoints;
      }
      return r(t2, [{ key: "drawAxesAnnotations", value: function() {
        var t3 = this.w;
        if (t3.globals.axisCharts) {
          for (var e2 = this.yAxisAnnotations.drawYAxisAnnotations(), i2 = this.xAxisAnnotations.drawXAxisAnnotations(), a2 = this.pointsAnnotations.drawPointAnnotations(), s2 = t3.config.chart.animations.enabled, r2 = [e2, i2, a2], o2 = [i2.node, e2.node, a2.node], n2 = 0; n2 < 3; n2++)
            t3.globals.dom.elGraphical.add(r2[n2]), !s2 || t3.globals.resized || t3.globals.dataChanged || "scatter" !== t3.config.chart.type && "bubble" !== t3.config.chart.type && t3.globals.dataPoints > 1 && o2[n2].classList.add("apexcharts-element-hidden"), t3.globals.delayedElements.push({ el: o2[n2], index: 0 });
          this.helpers.annotationsBackground();
        }
      } }, { key: "drawImageAnnos", value: function() {
        var t3 = this;
        this.w.config.annotations.images.map(function(e2, i2) {
          t3.addImage(e2, i2);
        });
      } }, { key: "drawTextAnnos", value: function() {
        var t3 = this;
        this.w.config.annotations.texts.map(function(e2, i2) {
          t3.addText(e2, i2);
        });
      } }, { key: "addXaxisAnnotation", value: function(t3, e2, i2) {
        this.xAxisAnnotations.addXaxisAnnotation(t3, e2, i2);
      } }, { key: "addYaxisAnnotation", value: function(t3, e2, i2) {
        this.yAxisAnnotations.addYaxisAnnotation(t3, e2, i2);
      } }, { key: "addPointAnnotation", value: function(t3, e2, i2) {
        this.pointsAnnotations.addPointAnnotation(t3, e2, i2);
      } }, { key: "addText", value: function(t3, e2) {
        var i2 = t3.x, a2 = t3.y, s2 = t3.text, r2 = t3.textAnchor, o2 = t3.foreColor, n2 = t3.fontSize, l2 = t3.fontFamily, h2 = t3.fontWeight, c2 = t3.cssClass, d2 = t3.backgroundColor, g2 = t3.borderWidth, u2 = t3.strokeDashArray, p2 = t3.borderRadius, f2 = t3.borderColor, x2 = t3.appendTo, b2 = void 0 === x2 ? ".apexcharts-annotations" : x2, v2 = t3.paddingLeft, m2 = void 0 === v2 ? 4 : v2, y2 = t3.paddingRight, w2 = void 0 === y2 ? 4 : y2, k2 = t3.paddingBottom, A2 = void 0 === k2 ? 2 : k2, S2 = t3.paddingTop, C2 = void 0 === S2 ? 2 : S2, L2 = this.w, P2 = this.graphics.drawText({ x: i2, y: a2, text: s2, textAnchor: r2 || "start", fontSize: n2 || "12px", fontWeight: h2 || "regular", fontFamily: l2 || L2.config.chart.fontFamily, foreColor: o2 || L2.config.chart.foreColor, cssClass: c2 }), T2 = L2.globals.dom.baseEl.querySelector(b2);
        T2 && T2.appendChild(P2.node);
        var M2 = P2.bbox();
        if (s2) {
          var I2 = this.graphics.drawRect(M2.x - m2, M2.y - C2, M2.width + m2 + w2, M2.height + A2 + C2, p2, d2 || "transparent", 1, g2, f2, u2);
          T2.insertBefore(I2.node, P2.node);
        }
      } }, { key: "addImage", value: function(t3, e2) {
        var i2 = this.w, a2 = t3.path, s2 = t3.x, r2 = void 0 === s2 ? 0 : s2, o2 = t3.y, n2 = void 0 === o2 ? 0 : o2, l2 = t3.width, h2 = void 0 === l2 ? 20 : l2, c2 = t3.height, d2 = void 0 === c2 ? 20 : c2, g2 = t3.appendTo, u2 = void 0 === g2 ? ".apexcharts-annotations" : g2, p2 = i2.globals.dom.Paper.image(a2);
        p2.size(h2, d2).move(r2, n2);
        var f2 = i2.globals.dom.baseEl.querySelector(u2);
        f2 && f2.appendChild(p2.node);
      } }, { key: "addXaxisAnnotationExternal", value: function(t3, e2, i2) {
        return this.addAnnotationExternal({ params: t3, pushToMemory: e2, context: i2, type: "xaxis", contextMethod: i2.addXaxisAnnotation }), i2;
      } }, { key: "addYaxisAnnotationExternal", value: function(t3, e2, i2) {
        return this.addAnnotationExternal({ params: t3, pushToMemory: e2, context: i2, type: "yaxis", contextMethod: i2.addYaxisAnnotation }), i2;
      } }, { key: "addPointAnnotationExternal", value: function(t3, e2, i2) {
        return void 0 === this.invertAxis && (this.invertAxis = i2.w.globals.isBarHorizontal), this.addAnnotationExternal({ params: t3, pushToMemory: e2, context: i2, type: "point", contextMethod: i2.addPointAnnotation }), i2;
      } }, { key: "addAnnotationExternal", value: function(t3) {
        var e2 = t3.params, i2 = t3.pushToMemory, a2 = t3.context, s2 = t3.type, r2 = t3.contextMethod, o2 = a2, n2 = o2.w, l2 = n2.globals.dom.baseEl.querySelector(".apexcharts-".concat(s2, "-annotations")), h2 = l2.childNodes.length + 1, c2 = new S(), d2 = Object.assign({}, "xaxis" === s2 ? c2.xAxisAnnotation : "yaxis" === s2 ? c2.yAxisAnnotation : c2.pointAnnotation), g2 = p.extend(d2, e2);
        switch (s2) {
          case "xaxis":
            this.addXaxisAnnotation(g2, l2, h2);
            break;
          case "yaxis":
            this.addYaxisAnnotation(g2, l2, h2);
            break;
          case "point":
            this.addPointAnnotation(g2, l2, h2);
        }
        var u2 = n2.globals.dom.baseEl.querySelector(".apexcharts-".concat(s2, "-annotations .apexcharts-").concat(s2, "-annotation-label[rel='").concat(h2, "']")), f2 = this.helpers.addBackgroundToAnno(u2, g2);
        return f2 && l2.insertBefore(f2.node, u2), i2 && n2.globals.memory.methodsToExec.push({ context: o2, id: g2.id ? g2.id : p.randomId(), method: r2, label: "addAnnotation", params: e2 }), a2;
      } }, { key: "clearAnnotations", value: function(t3) {
        var e2 = t3.w, i2 = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-yaxis-annotations, .apexcharts-xaxis-annotations, .apexcharts-point-annotations");
        e2.globals.memory.methodsToExec.map(function(t4, i3) {
          "addText" !== t4.label && "addAnnotation" !== t4.label || e2.globals.memory.methodsToExec.splice(i3, 1);
        }), i2 = p.listToArray(i2), Array.prototype.forEach.call(i2, function(t4) {
          for (; t4.firstChild; )
            t4.removeChild(t4.firstChild);
        });
      } }, { key: "removeAnnotation", value: function(t3, e2) {
        var i2 = t3.w, a2 = i2.globals.dom.baseEl.querySelectorAll(".".concat(e2));
        a2 && (i2.globals.memory.methodsToExec.map(function(t4, a3) {
          t4.id === e2 && i2.globals.memory.methodsToExec.splice(a3, 1);
        }), Array.prototype.forEach.call(a2, function(t4) {
          t4.parentElement.removeChild(t4);
        }));
      } }]), t2;
    }();
    var L = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.opts = null, this.seriesIndex = 0;
      }
      return r(t2, [{ key: "clippedImgArea", value: function(t3) {
        var e2 = this.w, i2 = e2.config, a2 = parseInt(e2.globals.gridWidth, 10), s2 = parseInt(e2.globals.gridHeight, 10), r2 = a2 > s2 ? a2 : s2, o2 = t3.image, n2 = 0, l2 = 0;
        void 0 === t3.width && void 0 === t3.height ? void 0 !== i2.fill.image.width && void 0 !== i2.fill.image.height ? (n2 = i2.fill.image.width + 1, l2 = i2.fill.image.height) : (n2 = r2 + 1, l2 = r2) : (n2 = t3.width, l2 = t3.height);
        var h2 = document.createElementNS(e2.globals.SVGNS, "pattern");
        b.setAttrs(h2, { id: t3.patternID, patternUnits: t3.patternUnits ? t3.patternUnits : "userSpaceOnUse", width: n2 + "px", height: l2 + "px" });
        var c2 = document.createElementNS(e2.globals.SVGNS, "image");
        h2.appendChild(c2), c2.setAttributeNS(window.SVG.xlink, "href", o2), b.setAttrs(c2, { x: 0, y: 0, preserveAspectRatio: "none", width: n2 + "px", height: l2 + "px" }), c2.style.opacity = t3.opacity, e2.globals.dom.elDefs.node.appendChild(h2);
      } }, { key: "getSeriesIndex", value: function(t3) {
        var e2 = this.w;
        return ("bar" === e2.config.chart.type || "rangeBar" === e2.config.chart.type) && e2.config.plotOptions.bar.distributed || "heatmap" === e2.config.chart.type || "treemap" === e2.config.chart.type ? this.seriesIndex = t3.seriesNumber : this.seriesIndex = t3.seriesNumber % e2.globals.series.length, this.seriesIndex;
      } }, { key: "fillPath", value: function(t3) {
        var e2 = this.w;
        this.opts = t3;
        var i2, a2, s2, r2 = this.w.config;
        this.seriesIndex = this.getSeriesIndex(t3);
        var o2 = this.getFillColors()[this.seriesIndex];
        void 0 !== e2.globals.seriesColors[this.seriesIndex] && (o2 = e2.globals.seriesColors[this.seriesIndex]), "function" == typeof o2 && (o2 = o2({ seriesIndex: this.seriesIndex, dataPointIndex: t3.dataPointIndex, value: t3.value, w: e2 }));
        var n2 = this.getFillType(this.seriesIndex), l2 = Array.isArray(r2.fill.opacity) ? r2.fill.opacity[this.seriesIndex] : r2.fill.opacity;
        t3.color && (o2 = t3.color);
        var h2 = o2;
        if (-1 === o2.indexOf("rgb") ? o2.length < 9 && (h2 = p.hexToRgba(o2, l2)) : o2.indexOf("rgba") > -1 && (l2 = p.getOpacityFromRGBA(o2)), t3.opacity && (l2 = t3.opacity), "pattern" === n2 && (a2 = this.handlePatternFill(a2, o2, l2, h2)), "gradient" === n2 && (s2 = this.handleGradientFill(o2, l2, this.seriesIndex)), "image" === n2) {
          var c2 = r2.fill.image.src, d2 = t3.patternID ? t3.patternID : "";
          this.clippedImgArea({ opacity: l2, image: Array.isArray(c2) ? t3.seriesNumber < c2.length ? c2[t3.seriesNumber] : c2[0] : c2, width: t3.width ? t3.width : void 0, height: t3.height ? t3.height : void 0, patternUnits: t3.patternUnits, patternID: "pattern".concat(e2.globals.cuid).concat(t3.seriesNumber + 1).concat(d2) }), i2 = "url(#pattern".concat(e2.globals.cuid).concat(t3.seriesNumber + 1).concat(d2, ")");
        } else
          i2 = "gradient" === n2 ? s2 : "pattern" === n2 ? a2 : h2;
        return t3.solid && (i2 = h2), i2;
      } }, { key: "getFillType", value: function(t3) {
        var e2 = this.w;
        return Array.isArray(e2.config.fill.type) ? e2.config.fill.type[t3] : e2.config.fill.type;
      } }, { key: "getFillColors", value: function() {
        var t3 = this.w, e2 = t3.config, i2 = this.opts, a2 = [];
        return t3.globals.comboCharts ? "line" === t3.config.series[this.seriesIndex].type ? Array.isArray(t3.globals.stroke.colors) ? a2 = t3.globals.stroke.colors : a2.push(t3.globals.stroke.colors) : Array.isArray(t3.globals.fill.colors) ? a2 = t3.globals.fill.colors : a2.push(t3.globals.fill.colors) : "line" === e2.chart.type ? Array.isArray(t3.globals.stroke.colors) ? a2 = t3.globals.stroke.colors : a2.push(t3.globals.stroke.colors) : Array.isArray(t3.globals.fill.colors) ? a2 = t3.globals.fill.colors : a2.push(t3.globals.fill.colors), void 0 !== i2.fillColors && (a2 = [], Array.isArray(i2.fillColors) ? a2 = i2.fillColors.slice() : a2.push(i2.fillColors)), a2;
      } }, { key: "handlePatternFill", value: function(t3, e2, i2, a2) {
        var s2 = this.w.config, r2 = this.opts, o2 = new b(this.ctx), n2 = void 0 === s2.fill.pattern.strokeWidth ? Array.isArray(s2.stroke.width) ? s2.stroke.width[this.seriesIndex] : s2.stroke.width : Array.isArray(s2.fill.pattern.strokeWidth) ? s2.fill.pattern.strokeWidth[this.seriesIndex] : s2.fill.pattern.strokeWidth, l2 = e2;
        Array.isArray(s2.fill.pattern.style) ? t3 = void 0 !== s2.fill.pattern.style[r2.seriesNumber] ? o2.drawPattern(s2.fill.pattern.style[r2.seriesNumber], s2.fill.pattern.width, s2.fill.pattern.height, l2, n2, i2) : a2 : t3 = o2.drawPattern(s2.fill.pattern.style, s2.fill.pattern.width, s2.fill.pattern.height, l2, n2, i2);
        return t3;
      } }, { key: "handleGradientFill", value: function(t3, e2, i2) {
        var a2, s2 = this.w.config, r2 = this.opts, o2 = new b(this.ctx), n2 = new p(), l2 = s2.fill.gradient.type, h2 = t3, c2 = void 0 === s2.fill.gradient.opacityFrom ? e2 : Array.isArray(s2.fill.gradient.opacityFrom) ? s2.fill.gradient.opacityFrom[i2] : s2.fill.gradient.opacityFrom;
        h2.indexOf("rgba") > -1 && (c2 = p.getOpacityFromRGBA(h2));
        var d2 = void 0 === s2.fill.gradient.opacityTo ? e2 : Array.isArray(s2.fill.gradient.opacityTo) ? s2.fill.gradient.opacityTo[i2] : s2.fill.gradient.opacityTo;
        if (void 0 === s2.fill.gradient.gradientToColors || 0 === s2.fill.gradient.gradientToColors.length)
          a2 = "dark" === s2.fill.gradient.shade ? n2.shadeColor(-1 * parseFloat(s2.fill.gradient.shadeIntensity), t3.indexOf("rgb") > -1 ? p.rgb2hex(t3) : t3) : n2.shadeColor(parseFloat(s2.fill.gradient.shadeIntensity), t3.indexOf("rgb") > -1 ? p.rgb2hex(t3) : t3);
        else if (s2.fill.gradient.gradientToColors[r2.seriesNumber]) {
          var g2 = s2.fill.gradient.gradientToColors[r2.seriesNumber];
          a2 = g2, g2.indexOf("rgba") > -1 && (d2 = p.getOpacityFromRGBA(g2));
        } else
          a2 = t3;
        if (s2.fill.gradient.inverseColors) {
          var u2 = h2;
          h2 = a2, a2 = u2;
        }
        return h2.indexOf("rgb") > -1 && (h2 = p.rgb2hex(h2)), a2.indexOf("rgb") > -1 && (a2 = p.rgb2hex(a2)), o2.drawGradient(l2, h2, a2, c2, d2, r2.size, s2.fill.gradient.stops, s2.fill.gradient.colorStops, i2);
      } }]), t2;
    }();
    var P = function() {
      function t2(e2, i2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "setGlobalMarkerSize", value: function() {
        var t3 = this.w;
        if (t3.globals.markers.size = Array.isArray(t3.config.markers.size) ? t3.config.markers.size : [t3.config.markers.size], t3.globals.markers.size.length > 0) {
          if (t3.globals.markers.size.length < t3.globals.series.length + 1)
            for (var e2 = 0; e2 <= t3.globals.series.length; e2++)
              void 0 === t3.globals.markers.size[e2] && t3.globals.markers.size.push(t3.globals.markers.size[0]);
        } else
          t3.globals.markers.size = t3.config.series.map(function(e3) {
            return t3.config.markers.size;
          });
      } }, { key: "plotChartMarkers", value: function(t3, e2, i2, a2) {
        var s2, r2 = arguments.length > 4 && void 0 !== arguments[4] && arguments[4], o2 = this.w, n2 = e2, l2 = t3, h2 = null, c2 = new b(this.ctx);
        if ((o2.globals.markers.size[e2] > 0 || r2) && (h2 = c2.group({ class: r2 ? "" : "apexcharts-series-markers" })).attr("clip-path", "url(#gridRectMarkerMask".concat(o2.globals.cuid, ")")), Array.isArray(l2.x))
          for (var d2 = 0; d2 < l2.x.length; d2++) {
            var g2 = i2;
            1 === i2 && 0 === d2 && (g2 = 0), 1 === i2 && 1 === d2 && (g2 = 1);
            var u2 = "apexcharts-marker";
            "line" !== o2.config.chart.type && "area" !== o2.config.chart.type || o2.globals.comboCharts || o2.config.tooltip.intersect || (u2 += " no-pointer-events");
            var f2 = Array.isArray(o2.config.markers.size) ? o2.globals.markers.size[e2] > 0 : o2.config.markers.size > 0;
            if (f2 || r2) {
              p.isNumber(l2.y[d2]) ? u2 += " w".concat(p.randomId()) : u2 = "apexcharts-nullpoint";
              var v2 = this.getMarkerConfig({ cssClass: u2, seriesIndex: e2, dataPointIndex: g2 });
              o2.config.series[n2].data[g2] && (o2.config.series[n2].data[g2].fillColor && (v2.pointFillColor = o2.config.series[n2].data[g2].fillColor), o2.config.series[n2].data[g2].strokeColor && (v2.pointStrokeColor = o2.config.series[n2].data[g2].strokeColor)), a2 && (v2.pSize = a2), (s2 = c2.drawMarker(l2.x[d2], l2.y[d2], v2)).attr("rel", g2), s2.attr("j", g2), s2.attr("index", e2), s2.node.setAttribute("default-marker-size", v2.pSize);
              var m2 = new x(this.ctx);
              m2.setSelectionFilter(s2, e2, g2), this.addEvents(s2), h2 && h2.add(s2);
            } else
              void 0 === o2.globals.pointsArray[e2] && (o2.globals.pointsArray[e2] = []), o2.globals.pointsArray[e2].push([l2.x[d2], l2.y[d2]]);
          }
        return h2;
      } }, { key: "getMarkerConfig", value: function(t3) {
        var e2 = t3.cssClass, i2 = t3.seriesIndex, a2 = t3.dataPointIndex, s2 = void 0 === a2 ? null : a2, r2 = t3.finishRadius, o2 = void 0 === r2 ? null : r2, n2 = this.w, l2 = this.getMarkerStyle(i2), h2 = n2.globals.markers.size[i2], c2 = n2.config.markers;
        return null !== s2 && c2.discrete.length && c2.discrete.map(function(t4) {
          t4.seriesIndex === i2 && t4.dataPointIndex === s2 && (l2.pointStrokeColor = t4.strokeColor, l2.pointFillColor = t4.fillColor, h2 = t4.size, l2.pointShape = t4.shape);
        }), { pSize: null === o2 ? h2 : o2, pRadius: c2.radius, width: Array.isArray(c2.width) ? c2.width[i2] : c2.width, height: Array.isArray(c2.height) ? c2.height[i2] : c2.height, pointStrokeWidth: Array.isArray(c2.strokeWidth) ? c2.strokeWidth[i2] : c2.strokeWidth, pointStrokeColor: l2.pointStrokeColor, pointFillColor: l2.pointFillColor, shape: l2.pointShape || (Array.isArray(c2.shape) ? c2.shape[i2] : c2.shape), class: e2, pointStrokeOpacity: Array.isArray(c2.strokeOpacity) ? c2.strokeOpacity[i2] : c2.strokeOpacity, pointStrokeDashArray: Array.isArray(c2.strokeDashArray) ? c2.strokeDashArray[i2] : c2.strokeDashArray, pointFillOpacity: Array.isArray(c2.fillOpacity) ? c2.fillOpacity[i2] : c2.fillOpacity, seriesIndex: i2 };
      } }, { key: "addEvents", value: function(t3) {
        var e2 = this.w, i2 = new b(this.ctx);
        t3.node.addEventListener("mouseenter", i2.pathMouseEnter.bind(this.ctx, t3)), t3.node.addEventListener("mouseleave", i2.pathMouseLeave.bind(this.ctx, t3)), t3.node.addEventListener("mousedown", i2.pathMouseDown.bind(this.ctx, t3)), t3.node.addEventListener("click", e2.config.markers.onClick), t3.node.addEventListener("dblclick", e2.config.markers.onDblClick), t3.node.addEventListener("touchstart", i2.pathMouseDown.bind(this.ctx, t3), { passive: true });
      } }, { key: "getMarkerStyle", value: function(t3) {
        var e2 = this.w, i2 = e2.globals.markers.colors, a2 = e2.config.markers.strokeColor || e2.config.markers.strokeColors;
        return { pointStrokeColor: Array.isArray(a2) ? a2[t3] : a2, pointFillColor: Array.isArray(i2) ? i2[t3] : i2 };
      } }]), t2;
    }();
    var T = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.initialAnim = this.w.config.chart.animations.enabled, this.dynamicAnim = this.initialAnim && this.w.config.chart.animations.dynamicAnimation.enabled;
      }
      return r(t2, [{ key: "draw", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = new b(this.ctx), r2 = i2.realIndex, o2 = i2.pointsPos, n2 = i2.zRatio, l2 = i2.elParent, h2 = s2.group({ class: "apexcharts-series-markers apexcharts-series-".concat(a2.config.chart.type) });
        if (h2.attr("clip-path", "url(#gridRectMarkerMask".concat(a2.globals.cuid, ")")), Array.isArray(o2.x))
          for (var c2 = 0; c2 < o2.x.length; c2++) {
            var d2 = e2 + 1, g2 = true;
            0 === e2 && 0 === c2 && (d2 = 0), 0 === e2 && 1 === c2 && (d2 = 1);
            var u2 = 0, p2 = a2.globals.markers.size[r2];
            if (n2 !== 1 / 0) {
              p2 = a2.globals.seriesZ[r2][d2] / n2;
              var f2 = a2.config.plotOptions.bubble;
              f2.minBubbleRadius && p2 < f2.minBubbleRadius && (p2 = f2.minBubbleRadius), f2.maxBubbleRadius && p2 > f2.maxBubbleRadius && (p2 = f2.maxBubbleRadius);
            }
            a2.config.chart.animations.enabled || (u2 = p2);
            var x2 = o2.x[c2], v2 = o2.y[c2];
            if (u2 = u2 || 0, null !== v2 && void 0 !== a2.globals.series[r2][d2] || (g2 = false), g2) {
              var m2 = this.drawPoint(x2, v2, u2, p2, r2, d2, e2);
              h2.add(m2);
            }
            l2.add(h2);
          }
      } }, { key: "drawPoint", value: function(t3, e2, i2, a2, s2, r2, o2) {
        var n2 = this.w, l2 = s2, h2 = new f(this.ctx), c2 = new x(this.ctx), d2 = new L(this.ctx), g2 = new P(this.ctx), u2 = new b(this.ctx), p2 = g2.getMarkerConfig({ cssClass: "apexcharts-marker", seriesIndex: l2, dataPointIndex: r2, finishRadius: "bubble" === n2.config.chart.type || n2.globals.comboCharts && n2.config.series[s2] && "bubble" === n2.config.series[s2].type ? a2 : null });
        a2 = p2.pSize;
        var v2, m2 = d2.fillPath({ seriesNumber: s2, dataPointIndex: r2, color: p2.pointFillColor, patternUnits: "objectBoundingBox", value: n2.globals.series[s2][o2] });
        if ("circle" === p2.shape ? v2 = u2.drawCircle(i2) : "square" !== p2.shape && "rect" !== p2.shape || (v2 = u2.drawRect(0, 0, p2.width - p2.pointStrokeWidth / 2, p2.height - p2.pointStrokeWidth / 2, p2.pRadius)), n2.config.series[l2].data[r2] && n2.config.series[l2].data[r2].fillColor && (m2 = n2.config.series[l2].data[r2].fillColor), v2.attr({ x: t3 - p2.width / 2 - p2.pointStrokeWidth / 2, y: e2 - p2.height / 2 - p2.pointStrokeWidth / 2, cx: t3, cy: e2, fill: m2, "fill-opacity": p2.pointFillOpacity, stroke: p2.pointStrokeColor, r: a2, "stroke-width": p2.pointStrokeWidth, "stroke-dasharray": p2.pointStrokeDashArray, "stroke-opacity": p2.pointStrokeOpacity }), n2.config.chart.dropShadow.enabled) {
          var y2 = n2.config.chart.dropShadow;
          c2.dropShadow(v2, y2, s2);
        }
        if (!this.initialAnim || n2.globals.dataChanged || n2.globals.resized)
          n2.globals.animationEnded = true;
        else {
          var w2 = n2.config.chart.animations.speed;
          h2.animateMarker(v2, 0, "circle" === p2.shape ? a2 : { width: p2.width, height: p2.height }, w2, n2.globals.easing, function() {
            window.setTimeout(function() {
              h2.animationCompleted(v2);
            }, 100);
          });
        }
        if (n2.globals.dataChanged && "circle" === p2.shape)
          if (this.dynamicAnim) {
            var k2, A2, S2, C2, T2 = n2.config.chart.animations.dynamicAnimation.speed;
            null != (C2 = n2.globals.previousPaths[s2] && n2.globals.previousPaths[s2][o2]) && (k2 = C2.x, A2 = C2.y, S2 = void 0 !== C2.r ? C2.r : a2);
            for (var M2 = 0; M2 < n2.globals.collapsedSeries.length; M2++)
              n2.globals.collapsedSeries[M2].index === s2 && (T2 = 1, a2 = 0);
            0 === t3 && 0 === e2 && (a2 = 0), h2.animateCircle(v2, { cx: k2, cy: A2, r: S2 }, { cx: t3, cy: e2, r: a2 }, T2, n2.globals.easing);
          } else
            v2.attr({ r: a2 });
        return v2.attr({ rel: r2, j: r2, index: s2, "default-marker-size": a2 }), c2.setSelectionFilter(v2, s2, r2), g2.addEvents(v2), v2.node.classList.add("apexcharts-marker"), v2;
      } }, { key: "centerTextInBubble", value: function(t3) {
        var e2 = this.w;
        return { y: t3 += parseInt(e2.config.dataLabels.style.fontSize, 10) / 4 };
      } }]), t2;
    }();
    var M = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "dataLabelsCorrection", value: function(t3, e2, i2, a2, s2, r2, o2) {
        var n2 = this.w, l2 = false, h2 = new b(this.ctx).getTextRects(i2, o2), c2 = h2.width, d2 = h2.height;
        e2 < 0 && (e2 = 0), e2 > n2.globals.gridHeight + d2 && (e2 = n2.globals.gridHeight + d2 / 2), void 0 === n2.globals.dataLabelsRects[a2] && (n2.globals.dataLabelsRects[a2] = []), n2.globals.dataLabelsRects[a2].push({ x: t3, y: e2, width: c2, height: d2 });
        var g2 = n2.globals.dataLabelsRects[a2].length - 2, u2 = void 0 !== n2.globals.lastDrawnDataLabelsIndexes[a2] ? n2.globals.lastDrawnDataLabelsIndexes[a2][n2.globals.lastDrawnDataLabelsIndexes[a2].length - 1] : 0;
        if (void 0 !== n2.globals.dataLabelsRects[a2][g2]) {
          var p2 = n2.globals.dataLabelsRects[a2][u2];
          (t3 > p2.x + p2.width + 2 || e2 > p2.y + p2.height + 2 || t3 + c2 < p2.x) && (l2 = true);
        }
        return (0 === s2 || r2) && (l2 = true), { x: t3, y: e2, textRects: h2, drawnextLabel: l2 };
      } }, { key: "drawDataLabel", value: function(t3, e2, i2) {
        var a2 = this, s2 = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : 2, r2 = this.w, o2 = new b(this.ctx), n2 = r2.config.dataLabels, l2 = 0, h2 = 0, c2 = i2, d2 = null;
        if (!n2.enabled || !Array.isArray(t3.x))
          return d2;
        d2 = o2.group({ class: "apexcharts-data-labels" });
        for (var g2 = 0; g2 < t3.x.length; g2++)
          if (l2 = t3.x[g2] + n2.offsetX, h2 = t3.y[g2] + n2.offsetY + s2, !isNaN(l2)) {
            1 === i2 && 0 === g2 && (c2 = 0), 1 === i2 && 1 === g2 && (c2 = 1);
            var u2 = r2.globals.series[e2][c2], p2 = "", f2 = function(t4) {
              return r2.config.dataLabels.formatter(t4, { ctx: a2.ctx, seriesIndex: e2, dataPointIndex: c2, w: r2 });
            };
            if ("bubble" === r2.config.chart.type) {
              p2 = f2(u2 = r2.globals.seriesZ[e2][c2]), h2 = t3.y[g2];
              var x2 = new T(this.ctx), v2 = x2.centerTextInBubble(h2, e2, c2);
              h2 = v2.y;
            } else
              void 0 !== u2 && (p2 = f2(u2));
            this.plotDataLabelsText({ x: l2, y: h2, text: p2, i: e2, j: c2, parent: d2, offsetCorrection: true, dataLabelsConfig: r2.config.dataLabels });
          }
        return d2;
      } }, { key: "plotDataLabelsText", value: function(t3) {
        var e2 = this.w, i2 = new b(this.ctx), a2 = t3.x, s2 = t3.y, r2 = t3.i, o2 = t3.j, n2 = t3.text, l2 = t3.textAnchor, h2 = t3.fontSize, c2 = t3.parent, d2 = t3.dataLabelsConfig, g2 = t3.color, u2 = t3.alwaysDrawDataLabel, p2 = t3.offsetCorrection;
        if (!(Array.isArray(e2.config.dataLabels.enabledOnSeries) && e2.config.dataLabels.enabledOnSeries.indexOf(r2) < 0)) {
          var f2 = { x: a2, y: s2, drawnextLabel: true };
          p2 && (f2 = this.dataLabelsCorrection(a2, s2, n2, r2, o2, u2, parseInt(d2.style.fontSize, 10))), e2.globals.zoomed || (a2 = f2.x, s2 = f2.y), f2.textRects && (a2 < -10 - f2.textRects.width || a2 > e2.globals.gridWidth + f2.textRects.width + 10) && (n2 = "");
          var v2 = e2.globals.dataLabels.style.colors[r2];
          (("bar" === e2.config.chart.type || "rangeBar" === e2.config.chart.type) && e2.config.plotOptions.bar.distributed || e2.config.dataLabels.distributed) && (v2 = e2.globals.dataLabels.style.colors[o2]), "function" == typeof v2 && (v2 = v2({ series: e2.globals.series, seriesIndex: r2, dataPointIndex: o2, w: e2 })), g2 && (v2 = g2);
          var m2 = d2.offsetX, y2 = d2.offsetY;
          if ("bar" !== e2.config.chart.type && "rangeBar" !== e2.config.chart.type || (m2 = 0, y2 = 0), f2.drawnextLabel) {
            var w2 = i2.drawText({ width: 100, height: parseInt(d2.style.fontSize, 10), x: a2 + m2, y: s2 + y2, foreColor: v2, textAnchor: l2 || d2.textAnchor, text: n2, fontSize: h2 || d2.style.fontSize, fontFamily: d2.style.fontFamily, fontWeight: d2.style.fontWeight || "normal" });
            if (w2.attr({ class: "apexcharts-datalabel", cx: a2, cy: s2 }), d2.dropShadow.enabled) {
              var k2 = d2.dropShadow;
              new x(this.ctx).dropShadow(w2, k2);
            }
            c2.add(w2), void 0 === e2.globals.lastDrawnDataLabelsIndexes[r2] && (e2.globals.lastDrawnDataLabelsIndexes[r2] = []), e2.globals.lastDrawnDataLabelsIndexes[r2].push(o2);
          }
        }
      } }, { key: "addBackgroundToDataLabel", value: function(t3, e2) {
        var i2 = this.w, a2 = i2.config.dataLabels.background, s2 = a2.padding, r2 = a2.padding / 2, o2 = e2.width, n2 = e2.height, l2 = new b(this.ctx).drawRect(e2.x - s2, e2.y - r2 / 2, o2 + 2 * s2, n2 + r2, a2.borderRadius, "transparent" === i2.config.chart.background ? "#fff" : i2.config.chart.background, a2.opacity, a2.borderWidth, a2.borderColor);
        a2.dropShadow.enabled && new x(this.ctx).dropShadow(l2, a2.dropShadow);
        return l2;
      } }, { key: "dataLabelsBackground", value: function() {
        var t3 = this.w;
        if ("bubble" !== t3.config.chart.type)
          for (var e2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-datalabels text"), i2 = 0; i2 < e2.length; i2++) {
            var a2 = e2[i2], s2 = a2.getBBox(), r2 = null;
            if (s2.width && s2.height && (r2 = this.addBackgroundToDataLabel(a2, s2)), r2) {
              a2.parentNode.insertBefore(r2.node, a2);
              var o2 = a2.getAttribute("fill");
              t3.config.chart.animations.enabled && !t3.globals.resized && !t3.globals.dataChanged ? r2.animate().attr({ fill: o2 }) : r2.attr({ fill: o2 }), a2.setAttribute("fill", t3.config.dataLabels.background.foreColor);
            }
          }
      } }, { key: "bringForward", value: function() {
        for (var t3 = this.w, e2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-datalabels"), i2 = t3.globals.dom.baseEl.querySelector(".apexcharts-plot-series:last-child"), a2 = 0; a2 < e2.length; a2++)
          i2 && i2.insertBefore(e2[a2], i2.nextSibling);
      } }]), t2;
    }();
    var I = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.barCtx = e2;
      }
      return r(t2, [{ key: "handleBarDataLabels", value: function(t3) {
        var e2 = t3.x, i2 = t3.y, a2 = t3.y1, s2 = t3.y2, r2 = t3.i, o2 = t3.j, n2 = t3.realIndex, l2 = t3.series, h2 = t3.barHeight, c2 = t3.barWidth, d2 = t3.barYPosition, g2 = t3.visibleSeries, u2 = t3.renderedPath, p2 = this.w, f2 = new b(this.barCtx.ctx), x2 = Array.isArray(this.barCtx.strokeWidth) ? this.barCtx.strokeWidth[n2] : this.barCtx.strokeWidth, v2 = e2 + parseFloat(c2 * g2), m2 = i2 + parseFloat(h2 * g2);
        p2.globals.isXNumeric && !p2.globals.isBarHorizontal && (v2 = e2 + parseFloat(c2 * (g2 + 1)), m2 = i2 + parseFloat(h2 * (g2 + 1)) - x2);
        var y2 = e2, w2 = i2, k2 = {}, A2 = p2.config.dataLabels, S2 = this.barCtx.barOptions.dataLabels;
        void 0 !== d2 && this.barCtx.isTimelineBar && (m2 = d2, w2 = d2);
        var C2 = A2.offsetX, L2 = A2.offsetY, P2 = { width: 0, height: 0 };
        if (p2.config.dataLabels.enabled) {
          var T2 = this.barCtx.series[r2][o2];
          P2 = f2.getTextRects(p2.globals.yLabelFormatters[0](T2), parseFloat(A2.style.fontSize));
        }
        var M2 = { x: e2, y: i2, i: r2, j: o2, renderedPath: u2, bcx: v2, bcy: m2, barHeight: h2, barWidth: c2, textRects: P2, strokeWidth: x2, dataLabelsX: y2, dataLabelsY: w2, barDataLabelsConfig: S2, offX: C2, offY: L2 };
        return k2 = this.barCtx.isHorizontal ? this.calculateBarsDataLabelsPosition(M2) : this.calculateColumnsDataLabelsPosition(M2), u2.attr({ cy: k2.bcy, cx: k2.bcx, j: o2, val: l2[r2][o2], barHeight: h2, barWidth: c2 }), this.drawCalculatedDataLabels({ x: k2.dataLabelsX, y: k2.dataLabelsY, val: this.barCtx.isTimelineBar ? [a2, s2] : l2[r2][o2], i: n2, j: o2, barWidth: c2, barHeight: h2, textRects: P2, dataLabelsConfig: A2 });
      } }, { key: "calculateColumnsDataLabelsPosition", value: function(t3) {
        var e2, i2 = this.w, a2 = t3.i, s2 = t3.j, r2 = t3.y, o2 = t3.bcx, n2 = t3.barWidth, l2 = t3.barHeight, h2 = t3.textRects, c2 = t3.dataLabelsY, d2 = t3.barDataLabelsConfig, g2 = t3.strokeWidth, u2 = t3.offX, p2 = t3.offY;
        l2 = Math.abs(l2);
        var f2 = "vertical" === i2.config.plotOptions.bar.dataLabels.orientation;
        o2 -= g2 / 2;
        var x2 = i2.globals.gridWidth / i2.globals.dataPoints;
        if (e2 = i2.globals.isXNumeric ? o2 - n2 / 2 + u2 : o2 - x2 + n2 / 2 + u2, f2) {
          e2 = e2 + h2.height / 2 - g2 / 2 - 2;
        }
        var b2 = this.barCtx.series[a2][s2] < 0;
        "rounded" !== i2.config.plotOptions.bar.startingShape && "rounded" !== i2.config.plotOptions.bar.endingShape || 0 === a2 || (r2 -= i2.config.plotOptions.bar.borderRadius);
        var v2 = r2;
        switch (this.barCtx.isReversed && (v2 = r2 - l2 + (b2 ? 2 * l2 : 0), r2 -= l2), d2.position) {
          case "center":
            c2 = f2 ? b2 ? v2 + l2 / 2 + p2 : v2 + l2 / 2 - p2 : b2 ? v2 - l2 / 2 + h2.height / 2 + p2 : v2 + l2 / 2 + h2.height / 3 - p2;
            break;
          case "bottom":
            c2 = f2 ? b2 ? v2 + l2 + p2 : v2 + l2 - p2 : b2 ? v2 - l2 + h2.height + g2 + p2 : v2 + l2 - h2.height / 2 + g2 - p2;
            break;
          case "top":
            c2 = f2 ? b2 ? v2 + p2 : v2 - p2 : b2 ? v2 - h2.height / 2 - p2 : v2 + h2.height + p2;
        }
        return i2.config.chart.stacked || (c2 < 0 ? c2 = 0 + g2 : c2 + h2.height / 3 > i2.globals.gridHeight && (c2 = i2.globals.gridHeight - g2)), { bcx: o2, bcy: r2, dataLabelsX: e2, dataLabelsY: c2 };
      } }, { key: "calculateBarsDataLabelsPosition", value: function(t3) {
        var e2 = this.w, i2 = t3.x, a2 = t3.i, s2 = t3.j, r2 = t3.bcy, o2 = t3.barHeight, n2 = t3.barWidth, l2 = t3.textRects, h2 = t3.dataLabelsX, c2 = t3.strokeWidth, d2 = t3.barDataLabelsConfig, g2 = t3.offX, u2 = t3.offY, p2 = e2.globals.gridHeight / e2.globals.dataPoints;
        n2 = Math.abs(n2);
        var f2 = r2 - (this.barCtx.isTimelineBar ? 0 : p2) + o2 / 2 + l2.height / 2 + u2 - 3, x2 = this.barCtx.series[a2][s2] < 0, b2 = i2;
        switch (this.barCtx.isReversed && (b2 = i2 + n2 - (x2 ? 2 * n2 : 0), i2 = e2.globals.gridWidth - n2), d2.position) {
          case "center":
            h2 = x2 ? b2 + n2 / 2 - g2 : Math.max(l2.width / 2, b2 - n2 / 2) + g2;
            break;
          case "bottom":
            h2 = x2 ? b2 + n2 - c2 - Math.round(l2.width / 2) - g2 : b2 - n2 + c2 + Math.round(l2.width / 2) + g2;
            break;
          case "top":
            h2 = x2 ? b2 - c2 + Math.round(l2.width / 2) - g2 : b2 - c2 - Math.round(l2.width / 2) + g2;
        }
        return e2.config.chart.stacked || (h2 < 0 ? h2 = h2 + l2.width + c2 : h2 + l2.width / 2 > e2.globals.gridWidth && (h2 = e2.globals.gridWidth - l2.width - c2)), { bcx: i2, bcy: r2, dataLabelsX: h2, dataLabelsY: f2 };
      } }, { key: "drawCalculatedDataLabels", value: function(t3) {
        var i2 = t3.x, a2 = t3.y, s2 = t3.val, r2 = t3.i, o2 = t3.j, n2 = t3.textRects, l2 = t3.barHeight, h2 = t3.barWidth, c2 = t3.dataLabelsConfig, d2 = this.w, g2 = "rotate(0)";
        "vertical" === d2.config.plotOptions.bar.dataLabels.orientation && (g2 = "rotate(-90, ".concat(i2, ", ").concat(a2, ")"));
        var u2 = new M(this.barCtx.ctx), p2 = new b(this.barCtx.ctx), f2 = c2.formatter, x2 = null, v2 = d2.globals.collapsedSeriesIndices.indexOf(r2) > -1;
        if (c2.enabled && !v2) {
          x2 = p2.group({ class: "apexcharts-data-labels", transform: g2 });
          var m2 = "";
          void 0 !== s2 && (m2 = f2(s2, { seriesIndex: r2, dataPointIndex: o2, w: d2 }));
          var y2 = d2.globals.series[r2][o2] < 0, w2 = d2.config.plotOptions.bar.dataLabels.position;
          if ("vertical" === d2.config.plotOptions.bar.dataLabels.orientation && ("top" === w2 && (c2.textAnchor = y2 ? "end" : "start"), "center" === w2 && (c2.textAnchor = "middle"), "bottom" === w2 && (c2.textAnchor = y2 ? "end" : "start")), this.barCtx.isTimelineBar && this.barCtx.barOptions.dataLabels.hideOverflowingLabels)
            h2 < p2.getTextRects(m2, parseFloat(c2.style.fontSize)).width && (m2 = "");
          d2.config.chart.stacked && this.barCtx.barOptions.dataLabels.hideOverflowingLabels && (this.barCtx.isHorizontal ? n2.width / 1.6 > Math.abs(h2) && (m2 = "") : n2.height / 1.6 > Math.abs(l2) && (m2 = ""));
          var k2 = e({}, c2);
          this.barCtx.isHorizontal && s2 < 0 && ("start" === c2.textAnchor ? k2.textAnchor = "end" : "end" === c2.textAnchor && (k2.textAnchor = "start")), u2.plotDataLabelsText({ x: i2, y: a2, text: m2, i: r2, j: o2, parent: x2, dataLabelsConfig: k2, alwaysDrawDataLabel: true, offsetCorrection: true });
        }
        return x2;
      } }]), t2;
    }();
    var z = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.legendInactiveClass = "legend-mouseover-inactive";
      }
      return r(t2, [{ key: "getAllSeriesEls", value: function() {
        return this.w.globals.dom.baseEl.getElementsByClassName("apexcharts-series");
      } }, { key: "getSeriesByName", value: function(t3) {
        return this.w.globals.dom.baseEl.querySelector(".apexcharts-inner .apexcharts-series[seriesName='".concat(p.escapeString(t3), "']"));
      } }, { key: "isSeriesHidden", value: function(t3) {
        var e2 = this.getSeriesByName(t3), i2 = parseInt(e2.getAttribute("data:realIndex"), 10);
        return { isHidden: e2.classList.contains("apexcharts-series-collapsed"), realIndex: i2 };
      } }, { key: "addCollapsedClassToSeries", value: function(t3, e2) {
        var i2 = this.w;
        function a2(i3) {
          for (var a3 = 0; a3 < i3.length; a3++)
            i3[a3].index === e2 && t3.node.classList.add("apexcharts-series-collapsed");
        }
        a2(i2.globals.collapsedSeries), a2(i2.globals.ancillaryCollapsedSeries);
      } }, { key: "toggleSeries", value: function(t3) {
        var e2 = this.isSeriesHidden(t3);
        return this.ctx.legend.legendHelpers.toggleDataSeries(e2.realIndex, e2.isHidden), e2.isHidden;
      } }, { key: "showSeries", value: function(t3) {
        var e2 = this.isSeriesHidden(t3);
        e2.isHidden && this.ctx.legend.legendHelpers.toggleDataSeries(e2.realIndex, true);
      } }, { key: "hideSeries", value: function(t3) {
        var e2 = this.isSeriesHidden(t3);
        e2.isHidden || this.ctx.legend.legendHelpers.toggleDataSeries(e2.realIndex, false);
      } }, { key: "resetSeries", value: function() {
        var t3 = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0], e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2], a2 = this.w, s2 = p.clone(a2.globals.initialSeries);
        a2.globals.previousPaths = [], i2 ? (a2.globals.collapsedSeries = [], a2.globals.ancillaryCollapsedSeries = [], a2.globals.collapsedSeriesIndices = [], a2.globals.ancillaryCollapsedSeriesIndices = []) : s2 = this.emptyCollapsedSeries(s2), a2.config.series = s2, t3 && (e2 && (a2.globals.zoomed = false, this.ctx.updateHelpers.revertDefaultAxisMinMax()), this.ctx.updateHelpers._updateSeries(s2, a2.config.chart.animations.dynamicAnimation.enabled));
      } }, { key: "emptyCollapsedSeries", value: function(t3) {
        for (var e2 = this.w, i2 = 0; i2 < t3.length; i2++)
          e2.globals.collapsedSeriesIndices.indexOf(i2) > -1 && (t3[i2].data = []);
        return t3;
      } }, { key: "toggleSeriesOnHover", value: function(t3, e2) {
        var i2 = this.w, a2 = i2.globals.dom.baseEl.querySelectorAll(".apexcharts-series, .apexcharts-datalabels");
        if ("mousemove" === t3.type) {
          var s2 = parseInt(e2.getAttribute("rel"), 10) - 1, r2 = null, o2 = null;
          i2.globals.axisCharts || "radialBar" === i2.config.chart.type ? i2.globals.axisCharts ? (r2 = i2.globals.dom.baseEl.querySelector(".apexcharts-series[data\\:realIndex='".concat(s2, "']")), o2 = i2.globals.dom.baseEl.querySelector(".apexcharts-datalabels[data\\:realIndex='".concat(s2, "']"))) : r2 = i2.globals.dom.baseEl.querySelector(".apexcharts-series[rel='".concat(s2 + 1, "']")) : r2 = i2.globals.dom.baseEl.querySelector(".apexcharts-series[rel='".concat(s2 + 1, "'] path"));
          for (var n2 = 0; n2 < a2.length; n2++)
            a2[n2].classList.add(this.legendInactiveClass);
          null !== r2 && (i2.globals.axisCharts || r2.parentNode.classList.remove(this.legendInactiveClass), r2.classList.remove(this.legendInactiveClass), null !== o2 && o2.classList.remove(this.legendInactiveClass));
        } else if ("mouseout" === t3.type)
          for (var l2 = 0; l2 < a2.length; l2++)
            a2[l2].classList.remove(this.legendInactiveClass);
      } }, { key: "highlightRangeInSeries", value: function(t3, e2) {
        var i2 = this, a2 = this.w, s2 = a2.globals.dom.baseEl.getElementsByClassName("apexcharts-heatmap-rect"), r2 = function(t4) {
          for (var e3 = 0; e3 < s2.length; e3++)
            s2[e3].classList[t4](i2.legendInactiveClass);
        };
        if ("mousemove" === t3.type) {
          var o2 = parseInt(e2.getAttribute("rel"), 10) - 1;
          r2("add"), function(t4) {
            for (var e3 = 0; e3 < s2.length; e3++) {
              var a3 = parseInt(s2[e3].getAttribute("val"), 10);
              a3 >= t4.from && a3 <= t4.to && s2[e3].classList.remove(i2.legendInactiveClass);
            }
          }(a2.config.plotOptions.heatmap.colorScale.ranges[o2]);
        } else
          "mouseout" === t3.type && r2("remove");
      } }, { key: "getActiveConfigSeriesIndex", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] && arguments[0], e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "asc", i2 = this.w, a2 = 0;
        if (i2.config.series.length > 1) {
          for (var s2 = i2.config.series.map(function(e3, a3) {
            var s3 = false;
            return t3 && (s3 = "bar" === i2.config.series[a3].type || "column" === i2.config.series[a3].type), e3.data && e3.data.length > 0 && !s3 ? a3 : -1;
          }), r2 = "asc" === e2 ? 0 : s2.length - 1; "asc" === e2 ? r2 < s2.length : r2 >= 0; "asc" === e2 ? r2++ : r2--)
            if (-1 !== s2[r2]) {
              a2 = s2[r2];
              break;
            }
        }
        return a2;
      } }, { key: "getPreviousPaths", value: function() {
        var t3 = this.w;
        function e2(e3, i3, a3) {
          for (var s3 = e3[i3].childNodes, r2 = { type: a3, paths: [], realIndex: e3[i3].getAttribute("data:realIndex") }, o2 = 0; o2 < s3.length; o2++)
            if (s3[o2].hasAttribute("pathTo")) {
              var n2 = s3[o2].getAttribute("pathTo");
              r2.paths.push({ d: n2 });
            }
          t3.globals.previousPaths.push(r2);
        }
        t3.globals.previousPaths = [];
        ["line", "area", "bar", "rangebar", "candlestick", "radar"].forEach(function(i3) {
          for (var a3, s3 = (a3 = i3, t3.globals.dom.baseEl.querySelectorAll(".apexcharts-".concat(a3, "-series .apexcharts-series"))), r2 = 0; r2 < s3.length; r2++)
            e2(s3, r2, i3);
        }), this.handlePrevBubbleScatterPaths("bubble"), this.handlePrevBubbleScatterPaths("scatter");
        var i2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-".concat(t3.config.chart.type, " .apexcharts-series"));
        if (i2.length > 0)
          for (var a2 = function(e3) {
            for (var i3 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-".concat(t3.config.chart.type, " .apexcharts-series[data\\:realIndex='").concat(e3, "'] rect")), a3 = [], s3 = function(t4) {
              var e4 = function(e5) {
                return i3[t4].getAttribute(e5);
              }, s4 = { x: parseFloat(e4("x")), y: parseFloat(e4("y")), width: parseFloat(e4("width")), height: parseFloat(e4("height")) };
              a3.push({ rect: s4, color: i3[t4].getAttribute("color") });
            }, r2 = 0; r2 < i3.length; r2++)
              s3(r2);
            t3.globals.previousPaths.push(a3);
          }, s2 = 0; s2 < i2.length; s2++)
            a2(s2);
        t3.globals.axisCharts || (t3.globals.previousPaths = t3.globals.series);
      } }, { key: "handlePrevBubbleScatterPaths", value: function(t3) {
        var e2 = this.w, i2 = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-".concat(t3, "-series .apexcharts-series"));
        if (i2.length > 0)
          for (var a2 = 0; a2 < i2.length; a2++) {
            for (var s2 = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-".concat(t3, "-series .apexcharts-series[data\\:realIndex='").concat(a2, "'] circle")), r2 = [], o2 = 0; o2 < s2.length; o2++)
              r2.push({ x: s2[o2].getAttribute("cx"), y: s2[o2].getAttribute("cy"), r: s2[o2].getAttribute("r") });
            e2.globals.previousPaths.push(r2);
          }
      } }, { key: "clearPreviousPaths", value: function() {
        var t3 = this.w;
        t3.globals.previousPaths = [], t3.globals.allSeriesCollapsed = false;
      } }, { key: "handleNoData", value: function() {
        var t3 = this.w, e2 = t3.config.noData, i2 = new b(this.ctx), a2 = t3.globals.svgWidth / 2, s2 = t3.globals.svgHeight / 2, r2 = "middle";
        if (t3.globals.noData = true, t3.globals.animationEnded = true, "left" === e2.align ? (a2 = 10, r2 = "start") : "right" === e2.align && (a2 = t3.globals.svgWidth - 10, r2 = "end"), "top" === e2.verticalAlign ? s2 = 50 : "bottom" === e2.verticalAlign && (s2 = t3.globals.svgHeight - 50), a2 += e2.offsetX, s2 = s2 + parseInt(e2.style.fontSize, 10) + 2 + e2.offsetY, void 0 !== e2.text && "" !== e2.text) {
          var o2 = i2.drawText({ x: a2, y: s2, text: e2.text, textAnchor: r2, fontSize: e2.style.fontSize, fontFamily: e2.style.fontFamily, foreColor: e2.style.color, opacity: 1, class: "apexcharts-text-nodata" });
          t3.globals.dom.Paper.add(o2);
        }
      } }, { key: "setNullSeriesToZeroValues", value: function(t3) {
        for (var e2 = this.w, i2 = 0; i2 < t3.length; i2++)
          if (0 === t3[i2].length)
            for (var a2 = 0; a2 < t3[e2.globals.maxValsInArrayIndex].length; a2++)
              t3[i2].push(0);
        return t3;
      } }, { key: "hasAllSeriesEqualX", value: function() {
        for (var t3 = true, e2 = this.w, i2 = this.filteredSeriesX(), a2 = 0; a2 < i2.length - 1; a2++)
          if (i2[a2][0] !== i2[a2 + 1][0]) {
            t3 = false;
            break;
          }
        return e2.globals.allSeriesHasEqualX = t3, t3;
      } }, { key: "filteredSeriesX", value: function() {
        var t3 = this.w.globals.seriesX.map(function(t4) {
          return t4.length > 0 ? t4 : [];
        });
        return t3;
      } }]), t2;
    }();
    var X = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.barCtx = e2;
      }
      return r(t2, [{ key: "initVariables", value: function(t3) {
        var e2 = this.w;
        this.barCtx.series = t3, this.barCtx.totalItems = 0, this.barCtx.seriesLen = 0, this.barCtx.visibleI = -1, this.barCtx.visibleItems = 1;
        for (var i2 = 0; i2 < t3.length; i2++)
          if (t3[i2].length > 0 && (this.barCtx.seriesLen = this.barCtx.seriesLen + 1, this.barCtx.totalItems += t3[i2].length), e2.globals.isXNumeric)
            for (var a2 = 0; a2 < t3[i2].length; a2++)
              e2.globals.seriesX[i2][a2] > e2.globals.minX && e2.globals.seriesX[i2][a2] < e2.globals.maxX && this.barCtx.visibleItems++;
          else
            this.barCtx.visibleItems = e2.globals.dataPoints;
        0 === this.barCtx.seriesLen && (this.barCtx.seriesLen = 1), this.barCtx.zeroSerieses = [], this.barCtx.radiusOnSeriesNumber = t3.length - 1, e2.globals.comboCharts || this.checkZeroSeries({ series: t3 });
      } }, { key: "initialPositions", value: function() {
        var t3, e2, i2, a2, s2, r2, o2, n2, l2 = this.w, h2 = l2.globals.dataPoints;
        this.barCtx.isTimelineBar && (h2 = l2.globals.labels.length);
        var c2 = this.barCtx.seriesLen;
        if (l2.config.plotOptions.bar.rangeBarGroupRows && (c2 = 1), this.barCtx.isHorizontal)
          s2 = (i2 = l2.globals.gridHeight / h2) / c2, l2.globals.isXNumeric && (s2 = (i2 = l2.globals.gridHeight / this.barCtx.totalItems) / this.barCtx.seriesLen), s2 = s2 * parseInt(this.barCtx.barOptions.barHeight, 10) / 100, n2 = this.barCtx.baseLineInvertedY + l2.globals.padHorizontal + (this.barCtx.isReversed ? l2.globals.gridWidth : 0) - (this.barCtx.isReversed ? 2 * this.barCtx.baseLineInvertedY : 0), e2 = (i2 - s2 * this.barCtx.seriesLen) / 2;
        else {
          if (a2 = l2.globals.gridWidth / this.barCtx.visibleItems, l2.config.xaxis.convertedCatToNumeric && (a2 = l2.globals.gridWidth / l2.globals.dataPoints), r2 = a2 / this.barCtx.seriesLen * parseInt(this.barCtx.barOptions.columnWidth, 10) / 100, l2.globals.isXNumeric) {
            var d2 = this.barCtx.xRatio;
            l2.config.xaxis.convertedCatToNumeric && (d2 = this.barCtx.initialXRatio), l2.globals.minXDiff && 0.5 !== l2.globals.minXDiff && l2.globals.minXDiff / d2 > 0 && (a2 = l2.globals.minXDiff / d2), (r2 = a2 / this.barCtx.seriesLen * parseInt(this.barCtx.barOptions.columnWidth, 10) / 100) < 1 && (r2 = 1);
          }
          o2 = l2.globals.gridHeight - this.barCtx.baseLineY[this.barCtx.yaxisIndex] - (this.barCtx.isReversed ? l2.globals.gridHeight : 0) + (this.barCtx.isReversed ? 2 * this.barCtx.baseLineY[this.barCtx.yaxisIndex] : 0), t3 = l2.globals.padHorizontal + (a2 - r2 * this.barCtx.seriesLen) / 2;
        }
        return { x: t3, y: e2, yDivision: i2, xDivision: a2, barHeight: s2, barWidth: r2, zeroH: o2, zeroW: n2 };
      } }, { key: "getPathFillColor", value: function(t3, e2, i2, a2) {
        var s2 = this.w, r2 = new L(this.barCtx.ctx), o2 = null, n2 = this.barCtx.barOptions.distributed ? i2 : e2;
        this.barCtx.barOptions.colors.ranges.length > 0 && this.barCtx.barOptions.colors.ranges.map(function(a3) {
          t3[e2][i2] >= a3.from && t3[e2][i2] <= a3.to && (o2 = a3.color);
        });
        return s2.config.series[e2].data[i2] && s2.config.series[e2].data[i2].fillColor && (o2 = s2.config.series[e2].data[i2].fillColor), r2.fillPath({ seriesNumber: this.barCtx.barOptions.distributed ? n2 : a2, dataPointIndex: i2, color: o2, value: t3[e2][i2] });
      } }, { key: "getStrokeWidth", value: function(t3, e2, i2) {
        var a2 = 0, s2 = this.w;
        return void 0 === this.barCtx.series[t3][e2] || null === this.barCtx.series[t3][e2] ? this.barCtx.isNullValue = true : this.barCtx.isNullValue = false, s2.config.stroke.show && (this.barCtx.isNullValue || (a2 = Array.isArray(this.barCtx.strokeWidth) ? this.barCtx.strokeWidth[i2] : this.barCtx.strokeWidth)), a2;
      } }, { key: "barBackground", value: function(t3) {
        var e2 = t3.j, i2 = t3.i, a2 = t3.x1, s2 = t3.x2, r2 = t3.y1, o2 = t3.y2, n2 = t3.elSeries, l2 = this.w, h2 = new b(this.barCtx.ctx), c2 = new z(this.barCtx.ctx).getActiveConfigSeriesIndex();
        if (this.barCtx.barOptions.colors.backgroundBarColors.length > 0 && c2 === i2) {
          e2 >= this.barCtx.barOptions.colors.backgroundBarColors.length && (e2 -= this.barCtx.barOptions.colors.backgroundBarColors.length);
          var d2 = this.barCtx.barOptions.colors.backgroundBarColors[e2], g2 = h2.drawRect(void 0 !== a2 ? a2 : 0, void 0 !== r2 ? r2 : 0, void 0 !== s2 ? s2 : l2.globals.gridWidth, void 0 !== o2 ? o2 : l2.globals.gridHeight, this.barCtx.barOptions.colors.backgroundBarRadius, d2, this.barCtx.barOptions.colors.backgroundBarOpacity);
          n2.add(g2), g2.node.classList.add("apexcharts-backgroundBar");
        }
      } }, { key: "getColumnPaths", value: function(t3) {
        var e2 = t3.barWidth, i2 = t3.barXPosition, a2 = t3.yRatio, s2 = t3.y1, r2 = t3.y2, o2 = t3.strokeWidth, n2 = t3.series, l2 = t3.realIndex, h2 = t3.i, c2 = t3.j, d2 = t3.w, g2 = new b(this.barCtx.ctx);
        (o2 = Array.isArray(o2) ? o2[l2] : o2) && 0 !== n2[h2][c2] || (o2 = 0), 0 === n2[h2][c2] && (e2 = 0);
        var u2 = { barWidth: e2, strokeWidth: o2, yRatio: a2, barXPosition: i2, y1: s2, y2: r2 }, p2 = this.getRoundedBars(d2, u2, n2, h2, c2), f2 = i2, x2 = i2 + e2, v2 = g2.move(f2, p2.y1), m2 = g2.move(f2, p2.y1), y2 = g2.line(x2 - o2, p2.y1);
        return d2.globals.previousPaths.length > 0 && (m2 = this.barCtx.getPreviousPath(l2, c2, false)), v2 = v2 + g2.line(f2, p2.y2) + p2.startingShape + g2.line(x2 - o2, p2.y2) + y2 + p2.endingShape + "z", m2 = m2 + g2.line(f2, p2.y1) + y2 + y2 + y2 + y2 + y2 + g2.line(f2, p2.y1), d2.config.chart.stacked && (this.barCtx.yArrj.push(p2.y2), this.barCtx.yArrjF.push(Math.abs(s2 - p2.y2)), this.barCtx.yArrjVal.push(this.barCtx.series[h2][c2])), { pathTo: v2, pathFrom: m2 };
      } }, { key: "getBarpaths", value: function(t3) {
        var e2 = t3.barYPosition, i2 = t3.barHeight, a2 = t3.x1, s2 = t3.x2, r2 = t3.strokeWidth, o2 = t3.series, n2 = t3.realIndex, l2 = t3.i, h2 = t3.j, c2 = t3.w, d2 = new b(this.barCtx.ctx);
        (r2 = Array.isArray(r2) ? r2[n2] : r2) && !o2[l2][h2] || (r2 = 0), 0 === o2[l2][h2] && (i2 = 0);
        var g2 = { barHeight: i2, strokeWidth: r2, barYPosition: e2, x2: s2, x1: a2 }, u2 = this.getRoundedBars(c2, g2, o2, l2, h2), p2 = d2.move(u2.x1, e2), f2 = d2.move(u2.x1, e2);
        c2.globals.previousPaths.length > 0 && (f2 = this.barCtx.getPreviousPath(n2, h2, false));
        var x2 = e2, v2 = e2 + i2, m2 = d2.line(u2.x1, v2 - r2);
        return p2 = p2 + d2.line(u2.x2, x2) + u2.startingShape + d2.line(u2.x2, v2 - r2) + m2 + m2 + u2.endingShape + "z", f2 = f2 + d2.line(u2.x1, x2) + m2 + m2 + m2 + m2 + m2 + d2.line(u2.x1, x2), c2.config.chart.stacked && (this.barCtx.xArrj.push(u2.x2), this.barCtx.xArrjF.push(Math.abs(u2.x1 - u2.x2)), this.barCtx.xArrjVal.push(this.barCtx.series[l2][h2])), { pathTo: p2, pathFrom: f2 };
      } }, { key: "getRoundedBars", value: function(t3, e2, i2, a2, s2) {
        var r2 = new b(this.barCtx.ctx), o2 = 0, n2 = t3.config.plotOptions.bar.borderRadius;
        Array.isArray(n2) ? o2 = n2[a2 > n2.length - 1 ? n2.length - 1 : a2] : o2 = n2;
        if (this.barCtx.isHorizontal) {
          var l2 = "", h2 = "", c2 = o2, d2 = o2, g2 = e2.x1, u2 = e2.x2;
          if (Math.abs(e2.x1 - e2.x2) < o2 && (o2 = Math.abs(e2.x1 - e2.x2)), void 0 !== i2[a2][s2] || null !== i2[a2][s2]) {
            var p2 = this.barCtx.isReversed ? i2[a2][s2] > 0 : i2[a2][s2] < 0;
            p2 && (o2 *= -1), c2 = d2 = o2, "flat" === this.barCtx.barOptions.startingShape && (c2 = 0), "flat" === this.barCtx.barOptions.endingShape && (d2 = 0), "flat" === this.barCtx.barOptions.startingShape && "flat" === this.barCtx.barOptions.endingShape && (o2 = 0), t3.config.chart.stacked && i2.length > 1 && 0 !== a2 ? "flat" === this.barCtx.barOptions.endingShape || "flat" === this.barCtx.barOptions.startingShape ? g2 += o2 : g2 += 2 * d2 : (g2 += d2, u2 -= c2), l2 = r2.quadraticCurve(u2 + c2, e2.barYPosition, u2 + c2, e2.barYPosition + (p2 ? -1 * c2 : c2)) + r2.line(u2 + c2, e2.barYPosition + e2.barHeight - e2.strokeWidth - (p2 ? -1 * c2 : c2)) + r2.quadraticCurve(u2 + c2, e2.barYPosition + e2.barHeight - e2.strokeWidth, u2, e2.barYPosition + e2.barHeight - e2.strokeWidth), h2 = r2.quadraticCurve(g2 - d2, e2.barYPosition + e2.barHeight - e2.strokeWidth, g2 - d2, e2.barYPosition + e2.barHeight - e2.strokeWidth - (p2 ? -1 * d2 : d2)) + r2.line(g2 - d2, e2.barYPosition + (p2 ? -1 * d2 : d2)) + r2.quadraticCurve(g2 - d2, e2.barYPosition, g2, e2.barYPosition);
          }
          return { startingShape: l2, endingShape: h2, x1: g2, x2: u2 };
        }
        var f2 = "", x2 = "", v2 = o2, m2 = o2, y2 = e2.y2, w2 = e2.y1;
        if (Math.abs(e2.y1 - e2.y2) < o2 && (o2 = Math.abs(e2.y1 - e2.y2)), void 0 !== i2[a2][s2] || null !== i2[a2][s2]) {
          var k2 = i2[a2][s2] < 0;
          k2 && (o2 *= -1), v2 = m2 = o2, "flat" === this.barCtx.barOptions.startingShape && (v2 = 0), "flat" === this.barCtx.barOptions.endingShape && (m2 = 0), "flat" === this.barCtx.barOptions.startingShape && "flat" === this.barCtx.barOptions.endingShape && (o2 = 0), t3.config.chart.stacked && i2.length > 1 && 0 !== a2 ? "flat" === this.barCtx.barOptions.endingShape || "flat" === this.barCtx.barOptions.startingShape ? w2 -= o2 : w2 -= 2 * m2 : (w2 -= m2, y2 += v2), f2 = r2.quadraticCurve(e2.barXPosition, y2 - v2, e2.barXPosition + (k2 ? -1 * v2 : v2), y2 - v2) + r2.line(e2.barXPosition + e2.barWidth - e2.strokeWidth - (k2 ? -1 * v2 : v2), y2 - v2) + r2.quadraticCurve(e2.barXPosition + e2.barWidth - e2.strokeWidth, y2 - v2, e2.barXPosition + e2.barWidth - e2.strokeWidth, y2), x2 = r2.quadraticCurve(e2.barXPosition + e2.barWidth - e2.strokeWidth, w2 + m2, e2.barXPosition + e2.barWidth - e2.strokeWidth - (k2 ? -1 * m2 : m2), w2 + m2) + r2.line(e2.barXPosition + (k2 ? -1 * m2 : m2), w2 + m2) + r2.quadraticCurve(e2.barXPosition, w2 + m2, e2.barXPosition, w2);
        }
        return { startingShape: f2, endingShape: x2, y1: w2, y2 };
      } }, { key: "checkZeroSeries", value: function(t3) {
        for (var e2 = t3.series, i2 = this.w, a2 = 0; a2 < e2.length; a2++) {
          for (var s2 = 0, r2 = 0; r2 < e2[i2.globals.maxValsInArrayIndex].length; r2++)
            s2 += e2[a2][r2];
          0 === s2 && this.barCtx.zeroSerieses.push(a2);
        }
        for (var o2 = e2.length - 1; o2 >= 0; o2--)
          this.barCtx.zeroSerieses.indexOf(o2) > -1 && o2 === this.radiusOnSeriesNumber && (this.barCtx.radiusOnSeriesNumber -= 1);
        for (var n2 = e2.length - 1; n2 >= 0; n2--)
          i2.globals.collapsedSeriesIndices.indexOf(this.barCtx.radiusOnSeriesNumber) > -1 && (this.barCtx.radiusOnSeriesNumber -= 1);
      } }, { key: "getXForValue", value: function(t3, e2) {
        var i2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2], a2 = i2 ? e2 : null;
        return null != t3 && (a2 = e2 + t3 / this.barCtx.invertedYRatio - 2 * (this.barCtx.isReversed ? t3 / this.barCtx.invertedYRatio : 0)), a2;
      } }, { key: "getYForValue", value: function(t3, e2) {
        var i2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2], a2 = i2 ? e2 : null;
        return null != t3 && (a2 = e2 - t3 / this.barCtx.yRatio[this.barCtx.yaxisIndex] + 2 * (this.barCtx.isReversed ? t3 / this.barCtx.yRatio[this.barCtx.yaxisIndex] : 0)), a2;
      } }, { key: "getGoalValues", value: function(t3, e2, i2, a2, s2) {
        var r2 = this, n2 = this.w, l2 = [];
        return n2.globals.seriesGoals[a2] && n2.globals.seriesGoals[a2][s2] && Array.isArray(n2.globals.seriesGoals[a2][s2]) && n2.globals.seriesGoals[a2][s2].forEach(function(a3) {
          var s3;
          l2.push((o(s3 = {}, t3, "x" === t3 ? r2.getXForValue(a3.value, e2, false) : r2.getYForValue(a3.value, i2, false)), o(s3, "attrs", a3), s3));
        }), l2;
      } }, { key: "drawGoalLine", value: function(t3) {
        var e2 = t3.barXPosition, i2 = t3.barYPosition, a2 = t3.goalX, s2 = t3.goalY, r2 = t3.barWidth, o2 = t3.barHeight, n2 = new b(this.barCtx.ctx), l2 = n2.group({ className: "apexcharts-bar-goals-groups" }), h2 = null;
        return this.barCtx.isHorizontal ? Array.isArray(a2) && a2.forEach(function(t4) {
          var e3 = void 0 !== t4.attrs.strokeHeight ? t4.attrs.strokeHeight : o2 / 2, a3 = i2 + e3 + o2 / 2;
          h2 = n2.drawLine(t4.x, a3 - 2 * e3, t4.x, a3, t4.attrs.strokeColor ? t4.attrs.strokeColor : void 0, t4.attrs.strokeDashArray, t4.attrs.strokeWidth ? t4.attrs.strokeWidth : 2, t4.attrs.strokeLineCap), l2.add(h2);
        }) : Array.isArray(s2) && s2.forEach(function(t4) {
          var i3 = void 0 !== t4.attrs.strokeWidth ? t4.attrs.strokeWidth : r2 / 2, a3 = e2 + i3 + r2 / 2;
          h2 = n2.drawLine(a3 - 2 * i3, t4.y, a3, t4.y, t4.attrs.strokeColor ? t4.attrs.strokeColor : void 0, t4.attrs.strokeDashArray, t4.attrs.strokeHeight ? t4.attrs.strokeHeight : 2, t4.attrs.strokeLineCap), l2.add(h2);
        }), l2;
      } }]), t2;
    }();
    var E = function() {
      function t2(e2, i2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var s2 = this.w;
        this.barOptions = s2.config.plotOptions.bar, this.isHorizontal = this.barOptions.horizontal, this.strokeWidth = s2.config.stroke.width, this.isNullValue = false, this.isTimelineBar = "datetime" === s2.config.xaxis.type && s2.globals.seriesRangeBarTimeline.length, this.xyRatios = i2, null !== this.xyRatios && (this.xRatio = i2.xRatio, this.initialXRatio = i2.initialXRatio, this.yRatio = i2.yRatio, this.invertedXRatio = i2.invertedXRatio, this.invertedYRatio = i2.invertedYRatio, this.baseLineY = i2.baseLineY, this.baseLineInvertedY = i2.baseLineInvertedY), this.yaxisIndex = 0, this.seriesLen = 0, this.barHelpers = new X(this);
      }
      return r(t2, [{ key: "draw", value: function(t3, i2) {
        var a2 = this.w, s2 = new b(this.ctx), r2 = new y(this.ctx, a2);
        t3 = r2.getLogSeries(t3), this.series = t3, this.yRatio = r2.getLogYRatios(this.yRatio), this.barHelpers.initVariables(t3);
        var o2 = s2.group({ class: "apexcharts-bar-series apexcharts-plot-series" });
        a2.config.dataLabels.enabled && this.totalItems > this.barOptions.dataLabels.maxItems && console.warn("WARNING: DataLabels are enabled but there are too many to display. This may cause performance issue when rendering.");
        for (var n2 = 0, l2 = 0; n2 < t3.length; n2++, l2++) {
          var h2, c2, d2, g2, u2 = void 0, f2 = void 0, x2 = [], v2 = [], m2 = a2.globals.comboCharts ? i2[n2] : n2, w2 = s2.group({ class: "apexcharts-series", rel: n2 + 1, seriesName: p.escapeString(a2.globals.seriesNames[m2]), "data:realIndex": m2 });
          this.ctx.series.addCollapsedClassToSeries(w2, m2), t3[n2].length > 0 && (this.visibleI = this.visibleI + 1);
          var k2 = 0, A2 = 0;
          this.yRatio.length > 1 && (this.yaxisIndex = m2), this.isReversed = a2.config.yaxis[this.yaxisIndex] && a2.config.yaxis[this.yaxisIndex].reversed;
          var S2 = this.barHelpers.initialPositions();
          f2 = S2.y, k2 = S2.barHeight, c2 = S2.yDivision, g2 = S2.zeroW, u2 = S2.x, A2 = S2.barWidth, h2 = S2.xDivision, d2 = S2.zeroH, this.horizontal || v2.push(u2 + A2 / 2);
          for (var C2 = s2.group({ class: "apexcharts-datalabels", "data:realIndex": m2 }), L2 = s2.group({ class: "apexcharts-bar-goals-markers", style: "pointer-events: none" }), P2 = 0; P2 < a2.globals.dataPoints; P2++) {
            var T2 = this.barHelpers.getStrokeWidth(n2, P2, m2), M2 = null, I2 = { indexes: { i: n2, j: P2, realIndex: m2, bc: l2 }, x: u2, y: f2, strokeWidth: T2, elSeries: w2 };
            this.isHorizontal ? (M2 = this.drawBarPaths(e(e({}, I2), {}, { barHeight: k2, zeroW: g2, yDivision: c2 })), A2 = this.series[n2][P2] / this.invertedYRatio) : (M2 = this.drawColumnPaths(e(e({}, I2), {}, { xDivision: h2, barWidth: A2, zeroH: d2 })), k2 = this.series[n2][P2] / this.yRatio[this.yaxisIndex]);
            var z2 = this.barHelpers.drawGoalLine({ barXPosition: M2.barXPosition, barYPosition: M2.barYPosition, goalX: M2.goalX, goalY: M2.goalY, barHeight: k2, barWidth: A2 });
            z2 && L2.add(z2), f2 = M2.y, u2 = M2.x, P2 > 0 && v2.push(u2 + A2 / 2), x2.push(f2);
            var X2 = this.barHelpers.getPathFillColor(t3, n2, P2, m2);
            this.renderSeries({ realIndex: m2, pathFill: X2, j: P2, i: n2, pathFrom: M2.pathFrom, pathTo: M2.pathTo, strokeWidth: T2, elSeries: w2, x: u2, y: f2, series: t3, barHeight: k2, barWidth: A2, elDataLabelsWrap: C2, elGoalsMarkers: L2, visibleSeries: this.visibleI, type: "bar" });
          }
          a2.globals.seriesXvalues[m2] = v2, a2.globals.seriesYvalues[m2] = x2, o2.add(w2);
        }
        return o2;
      } }, { key: "renderSeries", value: function(t3) {
        var e2 = t3.realIndex, i2 = t3.pathFill, a2 = t3.lineFill, s2 = t3.j, r2 = t3.i, o2 = t3.pathFrom, n2 = t3.pathTo, l2 = t3.strokeWidth, h2 = t3.elSeries, c2 = t3.x, d2 = t3.y, g2 = t3.y1, u2 = t3.y2, p2 = t3.series, f2 = t3.barHeight, v2 = t3.barWidth, m2 = t3.barYPosition, y2 = t3.elDataLabelsWrap, w2 = t3.elGoalsMarkers, k2 = t3.visibleSeries, A2 = t3.type, S2 = this.w, C2 = new b(this.ctx);
        a2 || (a2 = this.barOptions.distributed ? S2.globals.stroke.colors[s2] : S2.globals.stroke.colors[e2]), S2.config.series[r2].data[s2] && S2.config.series[r2].data[s2].strokeColor && (a2 = S2.config.series[r2].data[s2].strokeColor), this.isNullValue && (i2 = "none");
        var L2 = s2 / S2.config.chart.animations.animateGradually.delay * (S2.config.chart.animations.speed / S2.globals.dataPoints) / 2.4, P2 = C2.renderPaths({ i: r2, j: s2, realIndex: e2, pathFrom: o2, pathTo: n2, stroke: a2, strokeWidth: l2, strokeLineCap: S2.config.stroke.lineCap, fill: i2, animationDelay: L2, initialSpeed: S2.config.chart.animations.speed, dataChangeSpeed: S2.config.chart.animations.dynamicAnimation.speed, className: "apexcharts-".concat(A2, "-area") });
        P2.attr("clip-path", "url(#gridRectMask".concat(S2.globals.cuid, ")"));
        var T2 = S2.config.forecastDataPoints;
        T2.count > 0 && s2 >= S2.globals.dataPoints - T2.count && (P2.node.setAttribute("stroke-dasharray", T2.dashArray), P2.node.setAttribute("stroke-width", T2.strokeWidth), P2.node.setAttribute("fill-opacity", T2.fillOpacity)), void 0 !== g2 && void 0 !== u2 && (P2.attr("data-range-y1", g2), P2.attr("data-range-y2", u2)), new x(this.ctx).setSelectionFilter(P2, e2, s2), h2.add(P2);
        var M2 = new I(this).handleBarDataLabels({ x: c2, y: d2, y1: g2, y2: u2, i: r2, j: s2, series: p2, realIndex: e2, barHeight: f2, barWidth: v2, barYPosition: m2, renderedPath: P2, visibleSeries: k2 });
        return null !== M2 && y2.add(M2), h2.add(y2), w2 && h2.add(w2), h2;
      } }, { key: "drawBarPaths", value: function(t3) {
        var e2 = t3.indexes, i2 = t3.barHeight, a2 = t3.strokeWidth, s2 = t3.zeroW, r2 = t3.x, o2 = t3.y, n2 = t3.yDivision, l2 = t3.elSeries, h2 = this.w, c2 = e2.i, d2 = e2.j;
        h2.globals.isXNumeric && (o2 = (h2.globals.seriesX[c2][d2] - h2.globals.minX) / this.invertedXRatio - i2);
        var g2 = o2 + i2 * this.visibleI;
        r2 = this.barHelpers.getXForValue(this.series[c2][d2], s2);
        var u2 = this.barHelpers.getBarpaths({ barYPosition: g2, barHeight: i2, x1: s2, x2: r2, strokeWidth: a2, series: this.series, realIndex: e2.realIndex, i: c2, j: d2, w: h2 });
        return h2.globals.isXNumeric || (o2 += n2), this.barHelpers.barBackground({ j: d2, i: c2, y1: g2 - i2 * this.visibleI, y2: i2 * this.seriesLen, elSeries: l2 }), { pathTo: u2.pathTo, pathFrom: u2.pathFrom, x: r2, y: o2, goalX: this.barHelpers.getGoalValues("x", s2, null, c2, d2), barYPosition: g2 };
      } }, { key: "drawColumnPaths", value: function(t3) {
        var e2 = t3.indexes, i2 = t3.x, a2 = t3.y, s2 = t3.xDivision, r2 = t3.barWidth, o2 = t3.zeroH, n2 = t3.strokeWidth, l2 = t3.elSeries, h2 = this.w, c2 = e2.realIndex, d2 = e2.i, g2 = e2.j, u2 = e2.bc;
        if (h2.globals.isXNumeric) {
          var p2 = c2;
          h2.globals.seriesX[c2].length || (p2 = h2.globals.maxValsInArrayIndex), i2 = (h2.globals.seriesX[p2][g2] - h2.globals.minX) / this.xRatio - r2 * this.seriesLen / 2;
        }
        var f2 = i2 + r2 * this.visibleI;
        a2 = this.barHelpers.getYForValue(this.series[d2][g2], o2);
        var x2 = this.barHelpers.getColumnPaths({ barXPosition: f2, barWidth: r2, y1: o2, y2: a2, strokeWidth: n2, series: this.series, realIndex: e2.realIndex, i: d2, j: g2, w: h2 });
        return h2.globals.isXNumeric || (i2 += s2), this.barHelpers.barBackground({ bc: u2, j: g2, i: d2, x1: f2 - n2 / 2 - r2 * this.visibleI, x2: r2 * this.seriesLen + n2 / 2, elSeries: l2 }), { pathTo: x2.pathTo, pathFrom: x2.pathFrom, x: i2, y: a2, goalY: this.barHelpers.getGoalValues("y", null, o2, d2, g2), barXPosition: f2 };
      } }, { key: "getPreviousPath", value: function(t3, e2) {
        for (var i2, a2 = this.w, s2 = 0; s2 < a2.globals.previousPaths.length; s2++) {
          var r2 = a2.globals.previousPaths[s2];
          r2.paths && r2.paths.length > 0 && parseInt(r2.realIndex, 10) === parseInt(t3, 10) && void 0 !== a2.globals.previousPaths[s2].paths[e2] && (i2 = a2.globals.previousPaths[s2].paths[e2].d);
        }
        return i2;
      } }]), t2;
    }();
    var Y = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.months31 = [1, 3, 5, 7, 8, 10, 12], this.months30 = [2, 4, 6, 9, 11], this.daysCntOfYear = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
      }
      return r(t2, [{ key: "isValidDate", value: function(t3) {
        return !isNaN(this.parseDate(t3));
      } }, { key: "getTimeStamp", value: function(t3) {
        return Date.parse(t3) ? this.w.config.xaxis.labels.datetimeUTC ? new Date(new Date(t3).toISOString().substr(0, 25)).getTime() : new Date(t3).getTime() : t3;
      } }, { key: "getDate", value: function(t3) {
        return this.w.config.xaxis.labels.datetimeUTC ? new Date(new Date(t3).toUTCString()) : new Date(t3);
      } }, { key: "parseDate", value: function(t3) {
        var e2 = Date.parse(t3);
        if (!isNaN(e2))
          return this.getTimeStamp(t3);
        var i2 = Date.parse(t3.replace(/-/g, "/").replace(/[a-z]+/gi, " "));
        return i2 = this.getTimeStamp(i2);
      } }, { key: "parseDateWithTimezone", value: function(t3) {
        return Date.parse(t3.replace(/-/g, "/").replace(/[a-z]+/gi, " "));
      } }, { key: "formatDate", value: function(t3, e2) {
        var i2 = this.w.globals.locale, a2 = this.w.config.xaxis.labels.datetimeUTC, s2 = ["\0"].concat(g(i2.months)), r2 = [""].concat(g(i2.shortMonths)), o2 = [""].concat(g(i2.days)), n2 = [""].concat(g(i2.shortDays));
        function l2(t4, e3) {
          var i3 = t4 + "";
          for (e3 = e3 || 2; i3.length < e3; )
            i3 = "0" + i3;
          return i3;
        }
        var h2 = a2 ? t3.getUTCFullYear() : t3.getFullYear();
        e2 = (e2 = (e2 = e2.replace(/(^|[^\\])yyyy+/g, "$1" + h2)).replace(/(^|[^\\])yy/g, "$1" + h2.toString().substr(2, 2))).replace(/(^|[^\\])y/g, "$1" + h2);
        var c2 = (a2 ? t3.getUTCMonth() : t3.getMonth()) + 1;
        e2 = (e2 = (e2 = (e2 = e2.replace(/(^|[^\\])MMMM+/g, "$1" + s2[0])).replace(/(^|[^\\])MMM/g, "$1" + r2[0])).replace(/(^|[^\\])MM/g, "$1" + l2(c2))).replace(/(^|[^\\])M/g, "$1" + c2);
        var d2 = a2 ? t3.getUTCDate() : t3.getDate();
        e2 = (e2 = (e2 = (e2 = e2.replace(/(^|[^\\])dddd+/g, "$1" + o2[0])).replace(/(^|[^\\])ddd/g, "$1" + n2[0])).replace(/(^|[^\\])dd/g, "$1" + l2(d2))).replace(/(^|[^\\])d/g, "$1" + d2);
        var u2 = a2 ? t3.getUTCHours() : t3.getHours(), p2 = u2 > 12 ? u2 - 12 : 0 === u2 ? 12 : u2;
        e2 = (e2 = (e2 = (e2 = e2.replace(/(^|[^\\])HH+/g, "$1" + l2(u2))).replace(/(^|[^\\])H/g, "$1" + u2)).replace(/(^|[^\\])hh+/g, "$1" + l2(p2))).replace(/(^|[^\\])h/g, "$1" + p2);
        var f2 = a2 ? t3.getUTCMinutes() : t3.getMinutes();
        e2 = (e2 = e2.replace(/(^|[^\\])mm+/g, "$1" + l2(f2))).replace(/(^|[^\\])m/g, "$1" + f2);
        var x2 = a2 ? t3.getUTCSeconds() : t3.getSeconds();
        e2 = (e2 = e2.replace(/(^|[^\\])ss+/g, "$1" + l2(x2))).replace(/(^|[^\\])s/g, "$1" + x2);
        var b2 = a2 ? t3.getUTCMilliseconds() : t3.getMilliseconds();
        e2 = e2.replace(/(^|[^\\])fff+/g, "$1" + l2(b2, 3)), b2 = Math.round(b2 / 10), e2 = e2.replace(/(^|[^\\])ff/g, "$1" + l2(b2)), b2 = Math.round(b2 / 10);
        var v2 = u2 < 12 ? "AM" : "PM";
        e2 = (e2 = (e2 = e2.replace(/(^|[^\\])f/g, "$1" + b2)).replace(/(^|[^\\])TT+/g, "$1" + v2)).replace(/(^|[^\\])T/g, "$1" + v2.charAt(0));
        var m2 = v2.toLowerCase();
        e2 = (e2 = e2.replace(/(^|[^\\])tt+/g, "$1" + m2)).replace(/(^|[^\\])t/g, "$1" + m2.charAt(0));
        var y2 = -t3.getTimezoneOffset(), w2 = a2 || !y2 ? "Z" : y2 > 0 ? "+" : "-";
        if (!a2) {
          var k2 = (y2 = Math.abs(y2)) % 60;
          w2 += l2(Math.floor(y2 / 60)) + ":" + l2(k2);
        }
        e2 = e2.replace(/(^|[^\\])K/g, "$1" + w2);
        var A2 = (a2 ? t3.getUTCDay() : t3.getDay()) + 1;
        return e2 = (e2 = (e2 = (e2 = (e2 = e2.replace(new RegExp(o2[0], "g"), o2[A2])).replace(new RegExp(n2[0], "g"), n2[A2])).replace(new RegExp(s2[0], "g"), s2[c2])).replace(new RegExp(r2[0], "g"), r2[c2])).replace(/\\(.)/g, "$1");
      } }, { key: "getTimeUnitsfromTimestamp", value: function(t3, e2, i2) {
        var a2 = this.w;
        void 0 !== a2.config.xaxis.min && (t3 = a2.config.xaxis.min), void 0 !== a2.config.xaxis.max && (e2 = a2.config.xaxis.max);
        var s2 = this.getDate(t3), r2 = this.getDate(e2), o2 = this.formatDate(s2, "yyyy MM dd HH mm ss fff").split(" "), n2 = this.formatDate(r2, "yyyy MM dd HH mm ss fff").split(" ");
        return { minMillisecond: parseInt(o2[6], 10), maxMillisecond: parseInt(n2[6], 10), minSecond: parseInt(o2[5], 10), maxSecond: parseInt(n2[5], 10), minMinute: parseInt(o2[4], 10), maxMinute: parseInt(n2[4], 10), minHour: parseInt(o2[3], 10), maxHour: parseInt(n2[3], 10), minDate: parseInt(o2[2], 10), maxDate: parseInt(n2[2], 10), minMonth: parseInt(o2[1], 10) - 1, maxMonth: parseInt(n2[1], 10) - 1, minYear: parseInt(o2[0], 10), maxYear: parseInt(n2[0], 10) };
      } }, { key: "isLeapYear", value: function(t3) {
        return t3 % 4 == 0 && t3 % 100 != 0 || t3 % 400 == 0;
      } }, { key: "calculcateLastDaysOfMonth", value: function(t3, e2, i2) {
        return this.determineDaysOfMonths(t3, e2) - i2;
      } }, { key: "determineDaysOfYear", value: function(t3) {
        var e2 = 365;
        return this.isLeapYear(t3) && (e2 = 366), e2;
      } }, { key: "determineRemainingDaysOfYear", value: function(t3, e2, i2) {
        var a2 = this.daysCntOfYear[e2] + i2;
        return e2 > 1 && this.isLeapYear() && a2++, a2;
      } }, { key: "determineDaysOfMonths", value: function(t3, e2) {
        var i2 = 30;
        switch (t3 = p.monthMod(t3), true) {
          case this.months30.indexOf(t3) > -1:
            2 === t3 && (i2 = this.isLeapYear(e2) ? 29 : 28);
            break;
          case this.months31.indexOf(t3) > -1:
          default:
            i2 = 31;
        }
        return i2;
      } }]), t2;
    }();
    var F = function(t2) {
      n(s2, E);
      var i2 = d(s2);
      function s2() {
        return a(this, s2), i2.apply(this, arguments);
      }
      return r(s2, [{ key: "draw", value: function(t3, i3) {
        var a2 = this.w, s3 = new b(this.ctx);
        this.rangeBarOptions = this.w.config.plotOptions.rangeBar, this.series = t3, this.seriesRangeStart = a2.globals.seriesRangeStart, this.seriesRangeEnd = a2.globals.seriesRangeEnd, this.barHelpers.initVariables(t3);
        for (var r2 = s3.group({ class: "apexcharts-rangebar-series apexcharts-plot-series" }), o2 = 0; o2 < t3.length; o2++) {
          var n2, l2, h2, c2 = void 0, d2 = void 0, g2 = void 0, u2 = a2.globals.comboCharts ? i3[o2] : o2, f2 = s3.group({ class: "apexcharts-series", seriesName: p.escapeString(a2.globals.seriesNames[u2]), rel: o2 + 1, "data:realIndex": u2 });
          t3[o2].length > 0 && (this.visibleI = this.visibleI + 1);
          var x2 = 0, v2 = 0;
          this.yRatio.length > 1 && (this.yaxisIndex = u2);
          var m2 = this.barHelpers.initialPositions();
          d2 = m2.y, h2 = m2.zeroW, c2 = m2.x, v2 = m2.barWidth, n2 = m2.xDivision, l2 = m2.zeroH;
          for (var y2 = s3.group({ class: "apexcharts-datalabels", "data:realIndex": u2 }), w2 = s3.group({ class: "apexcharts-rangebar-goals-markers", style: "pointer-events: none" }), k2 = 0; k2 < a2.globals.dataPoints; k2++) {
            var A2 = this.barHelpers.getStrokeWidth(o2, k2, u2), S2 = this.seriesRangeStart[o2][k2], C2 = this.seriesRangeEnd[o2][k2], L2 = null, P2 = null, T2 = { x: c2, y: d2, strokeWidth: A2, elSeries: f2 };
            if (g2 = m2.yDivision, x2 = m2.barHeight, this.isHorizontal) {
              P2 = d2 + x2 * this.visibleI;
              var M2 = this.seriesLen;
              a2.config.plotOptions.bar.rangeBarGroupRows && (M2 = 1);
              var I2 = (g2 - x2 * M2) / 2;
              if (void 0 === a2.config.series[o2].data[k2])
                break;
              if (this.isTimelineBar && a2.config.series[o2].data[k2].x) {
                var z2 = this.detectOverlappingBars({ i: o2, j: k2, barYPosition: P2, srty: I2, barHeight: x2, yDivision: g2, initPositions: m2 });
                x2 = z2.barHeight, P2 = z2.barYPosition;
              }
              v2 = (L2 = this.drawRangeBarPaths(e({ indexes: { i: o2, j: k2, realIndex: u2 }, barHeight: x2, barYPosition: P2, zeroW: h2, yDivision: g2, y1: S2, y2: C2 }, T2))).barWidth;
            } else
              x2 = (L2 = this.drawRangeColumnPaths(e({ indexes: { i: o2, j: k2, realIndex: u2 }, zeroH: l2, barWidth: v2, xDivision: n2 }, T2))).barHeight;
            var X2 = this.barHelpers.drawGoalLine({ barXPosition: L2.barXPosition, barYPosition: P2, goalX: L2.goalX, goalY: L2.goalY, barHeight: x2, barWidth: v2 });
            X2 && w2.add(X2), d2 = L2.y, c2 = L2.x;
            var E2 = this.barHelpers.getPathFillColor(t3, o2, k2, u2), Y2 = a2.globals.stroke.colors[u2];
            this.renderSeries({ realIndex: u2, pathFill: E2, lineFill: Y2, j: k2, i: o2, x: c2, y: d2, y1: S2, y2: C2, pathFrom: L2.pathFrom, pathTo: L2.pathTo, strokeWidth: A2, elSeries: f2, series: t3, barHeight: x2, barYPosition: P2, barWidth: v2, elDataLabelsWrap: y2, elGoalsMarkers: w2, visibleSeries: this.visibleI, type: "rangebar" });
          }
          r2.add(f2);
        }
        return r2;
      } }, { key: "detectOverlappingBars", value: function(t3) {
        var e2 = t3.i, i3 = t3.j, a2 = t3.barYPosition, s3 = t3.srty, r2 = t3.barHeight, o2 = t3.yDivision, n2 = t3.initPositions, l2 = this.w, h2 = [], c2 = l2.config.series[e2].data[i3].rangeName, d2 = l2.config.series[e2].data[i3].x, g2 = l2.globals.labels.indexOf(d2), u2 = l2.globals.seriesRangeBarTimeline[e2].findIndex(function(t4) {
          return t4.x === d2 && t4.overlaps.length > 0;
        });
        return a2 = l2.config.plotOptions.bar.rangeBarGroupRows ? s3 + o2 * g2 : s3 + r2 * this.visibleI + o2 * g2, u2 > -1 && !l2.config.plotOptions.bar.rangeBarOverlap && (h2 = l2.globals.seriesRangeBarTimeline[e2][u2].overlaps).indexOf(c2) > -1 && (a2 = (r2 = n2.barHeight / h2.length) * this.visibleI + o2 * (100 - parseInt(this.barOptions.barHeight, 10)) / 100 / 2 + r2 * (this.visibleI + h2.indexOf(c2)) + o2 * g2), { barYPosition: a2, barHeight: r2 };
      } }, { key: "drawRangeColumnPaths", value: function(t3) {
        var e2 = t3.indexes, i3 = t3.x;
        t3.strokeWidth;
        var a2 = t3.xDivision, s3 = t3.barWidth, r2 = t3.zeroH, o2 = this.w, n2 = e2.i, l2 = e2.j, h2 = this.yRatio[this.yaxisIndex], c2 = e2.realIndex, d2 = this.getRangeValue(c2, l2), g2 = Math.min(d2.start, d2.end), u2 = Math.max(d2.start, d2.end);
        o2.globals.isXNumeric && (i3 = (o2.globals.seriesX[n2][l2] - o2.globals.minX) / this.xRatio - s3 / 2);
        var p2 = i3 + s3 * this.visibleI;
        void 0 === this.series[n2][l2] || null === this.series[n2][l2] ? g2 = r2 : (g2 = r2 - g2 / h2, u2 = r2 - u2 / h2);
        var f2 = Math.abs(u2 - g2), x2 = this.barHelpers.getColumnPaths({ barXPosition: p2, barWidth: s3, y1: g2, y2: u2, strokeWidth: this.strokeWidth, series: this.seriesRangeEnd, realIndex: e2.realIndex, i: c2, j: l2, w: o2 });
        return o2.globals.isXNumeric || (i3 += a2), { pathTo: x2.pathTo, pathFrom: x2.pathFrom, barHeight: f2, x: i3, y: u2, goalY: this.barHelpers.getGoalValues("y", null, r2, n2, l2), barXPosition: p2 };
      } }, { key: "drawRangeBarPaths", value: function(t3) {
        var e2 = t3.indexes, i3 = t3.y, a2 = t3.y1, s3 = t3.y2, r2 = t3.yDivision, o2 = t3.barHeight, n2 = t3.barYPosition, l2 = t3.zeroW, h2 = this.w, c2 = l2 + a2 / this.invertedYRatio, d2 = l2 + s3 / this.invertedYRatio, g2 = Math.abs(d2 - c2), u2 = this.barHelpers.getBarpaths({ barYPosition: n2, barHeight: o2, x1: c2, x2: d2, strokeWidth: this.strokeWidth, series: this.seriesRangeEnd, i: e2.realIndex, realIndex: e2.realIndex, j: e2.j, w: h2 });
        return h2.globals.isXNumeric || (i3 += r2), { pathTo: u2.pathTo, pathFrom: u2.pathFrom, barWidth: g2, x: d2, goalX: this.barHelpers.getGoalValues("x", l2, null, e2.realIndex, e2.j), y: i3 };
      } }, { key: "getRangeValue", value: function(t3, e2) {
        var i3 = this.w;
        return { start: i3.globals.seriesRangeStart[t3][e2], end: i3.globals.seriesRangeEnd[t3][e2] };
      } }, { key: "getTooltipValues", value: function(t3) {
        var e2 = t3.ctx, i3 = t3.seriesIndex, a2 = t3.dataPointIndex, s3 = t3.y1, r2 = t3.y2, o2 = t3.w, n2 = o2.globals.seriesRangeStart[i3][a2], l2 = o2.globals.seriesRangeEnd[i3][a2], h2 = o2.globals.labels[a2], c2 = o2.config.series[i3].name ? o2.config.series[i3].name : "", d2 = o2.config.tooltip.y.formatter, g2 = o2.config.tooltip.y.title.formatter, u2 = { w: o2, seriesIndex: i3, dataPointIndex: a2, start: n2, end: l2 };
        "function" == typeof g2 && (c2 = g2(c2, u2)), Number.isFinite(s3) && Number.isFinite(r2) && (n2 = s3, l2 = r2, o2.config.series[i3].data[a2].x && (h2 = o2.config.series[i3].data[a2].x + ":"), "function" == typeof d2 && (h2 = d2(h2, u2)));
        var p2 = "", f2 = "", x2 = o2.globals.colors[i3];
        if (void 0 === o2.config.tooltip.x.formatter)
          if ("datetime" === o2.config.xaxis.type) {
            var b2 = new Y(e2);
            p2 = b2.formatDate(b2.getDate(n2), o2.config.tooltip.x.format), f2 = b2.formatDate(b2.getDate(l2), o2.config.tooltip.x.format);
          } else
            p2 = n2, f2 = l2;
        else
          p2 = o2.config.tooltip.x.formatter(n2), f2 = o2.config.tooltip.x.formatter(l2);
        return { start: n2, end: l2, startVal: p2, endVal: f2, ylabel: h2, color: x2, seriesName: c2 };
      } }, { key: "buildCustomTooltipHTML", value: function(t3) {
        var e2 = t3.color, i3 = t3.seriesName;
        return '<div class="apexcharts-tooltip-rangebar"><div> <span class="series-name" style="color: ' + e2 + '">' + (i3 || "") + '</span></div><div> <span class="category">' + t3.ylabel + ' </span> <span class="value start-value">' + t3.start + '</span> <span class="separator">-</span> <span class="value end-value">' + t3.end + "</span></div></div>";
      } }]), s2;
    }();
    var R = function() {
      function t2(e2) {
        a(this, t2), this.opts = e2;
      }
      return r(t2, [{ key: "line", value: function() {
        return { chart: { animations: { easing: "swing" } }, dataLabels: { enabled: false }, stroke: { width: 5, curve: "straight" }, markers: { size: 0, hover: { sizeOffset: 6 } }, xaxis: { crosshairs: { width: 1 } } };
      } }, { key: "sparkline", value: function(t3) {
        this.opts.yaxis[0].show = false, this.opts.yaxis[0].title.text = "", this.opts.yaxis[0].axisBorder.show = false, this.opts.yaxis[0].axisTicks.show = false, this.opts.yaxis[0].floating = true;
        return p.extend(t3, { grid: { show: false, padding: { left: 0, right: 0, top: 0, bottom: 0 } }, legend: { show: false }, xaxis: { labels: { show: false }, tooltip: { enabled: false }, axisBorder: { show: false }, axisTicks: { show: false } }, chart: { toolbar: { show: false }, zoom: { enabled: false } }, dataLabels: { enabled: false } });
      } }, { key: "bar", value: function() {
        return { chart: { stacked: false, animations: { easing: "swing" } }, plotOptions: { bar: { dataLabels: { position: "center" } } }, dataLabels: { style: { colors: ["#fff"] }, background: { enabled: false } }, stroke: { width: 0, lineCap: "round" }, fill: { opacity: 0.85 }, legend: { markers: { shape: "square", radius: 2, size: 8 } }, tooltip: { shared: false, intersect: true }, xaxis: { tooltip: { enabled: false }, tickPlacement: "between", crosshairs: { width: "barWidth", position: "back", fill: { type: "gradient" }, dropShadow: { enabled: false }, stroke: { width: 0 } } } };
      } }, { key: "candlestick", value: function() {
        var t3 = this;
        return { stroke: { width: 1, colors: ["#333"] }, fill: { opacity: 1 }, dataLabels: { enabled: false }, tooltip: { shared: true, custom: function(e2) {
          var i2 = e2.seriesIndex, a2 = e2.dataPointIndex, s2 = e2.w;
          return t3._getBoxTooltip(s2, i2, a2, ["Open", "High", "", "Low", "Close"], "candlestick");
        } }, states: { active: { filter: { type: "none" } } }, xaxis: { crosshairs: { width: 1 } } };
      } }, { key: "boxPlot", value: function() {
        var t3 = this;
        return { chart: { animations: { dynamicAnimation: { enabled: false } } }, stroke: { width: 1, colors: ["#24292e"] }, dataLabels: { enabled: false }, tooltip: { shared: true, custom: function(e2) {
          var i2 = e2.seriesIndex, a2 = e2.dataPointIndex, s2 = e2.w;
          return t3._getBoxTooltip(s2, i2, a2, ["Minimum", "Q1", "Median", "Q3", "Maximum"], "boxPlot");
        } }, markers: { size: 5, strokeWidth: 1, strokeColors: "#111" }, xaxis: { crosshairs: { width: 1 } } };
      } }, { key: "rangeBar", value: function() {
        return { stroke: { width: 0, lineCap: "square" }, plotOptions: { bar: { borderRadius: 0, dataLabels: { position: "center" } } }, dataLabels: { enabled: false, formatter: function(t3, e2) {
          e2.ctx;
          var i2 = e2.seriesIndex, a2 = e2.dataPointIndex, s2 = e2.w, r2 = s2.globals.seriesRangeStart[i2][a2];
          return s2.globals.seriesRangeEnd[i2][a2] - r2;
        }, background: { enabled: false }, style: { colors: ["#fff"] } }, tooltip: { shared: false, followCursor: true, custom: function(t3) {
          return t3.w.config.plotOptions && t3.w.config.plotOptions.bar && t3.w.config.plotOptions.bar.horizontal ? function(t4) {
            var e2 = new F(t4.ctx, null), i2 = e2.getTooltipValues(t4), a2 = i2.color, s2 = i2.seriesName, r2 = i2.ylabel, o2 = i2.startVal, n2 = i2.endVal;
            return e2.buildCustomTooltipHTML({ color: a2, seriesName: s2, ylabel: r2, start: o2, end: n2 });
          }(t3) : function(t4) {
            var e2 = new F(t4.ctx, null), i2 = e2.getTooltipValues(t4), a2 = i2.color, s2 = i2.seriesName, r2 = i2.ylabel, o2 = i2.start, n2 = i2.end;
            return e2.buildCustomTooltipHTML({ color: a2, seriesName: s2, ylabel: r2, start: o2, end: n2 });
          }(t3);
        } }, xaxis: { tickPlacement: "between", tooltip: { enabled: false }, crosshairs: { stroke: { width: 0 } } } };
      } }, { key: "area", value: function() {
        return { stroke: { width: 4 }, fill: { type: "gradient", gradient: { inverseColors: false, shade: "light", type: "vertical", opacityFrom: 0.65, opacityTo: 0.5, stops: [0, 100, 100] } }, markers: { size: 0, hover: { sizeOffset: 6 } }, tooltip: { followCursor: false } };
      } }, { key: "brush", value: function(t3) {
        return p.extend(t3, { chart: { toolbar: { autoSelected: "selection", show: false }, zoom: { enabled: false } }, dataLabels: { enabled: false }, stroke: { width: 1 }, tooltip: { enabled: false }, xaxis: { tooltip: { enabled: false } } });
      } }, { key: "stacked100", value: function(t3) {
        t3.dataLabels = t3.dataLabels || {}, t3.dataLabels.formatter = t3.dataLabels.formatter || void 0;
        var e2 = t3.dataLabels.formatter;
        return t3.yaxis.forEach(function(e3, i2) {
          t3.yaxis[i2].min = 0, t3.yaxis[i2].max = 100;
        }), "bar" === t3.chart.type && (t3.dataLabels.formatter = e2 || function(t4) {
          return "number" == typeof t4 && t4 ? t4.toFixed(0) + "%" : t4;
        }), t3;
      } }, { key: "convertCatToNumeric", value: function(t3) {
        return t3.xaxis.convertedCatToNumeric = true, t3;
      } }, { key: "convertCatToNumericXaxis", value: function(t3, e2, i2) {
        t3.xaxis.type = "numeric", t3.xaxis.labels = t3.xaxis.labels || {}, t3.xaxis.labels.formatter = t3.xaxis.labels.formatter || function(t4) {
          return p.isNumber(t4) ? Math.floor(t4) : t4;
        };
        var a2 = t3.xaxis.labels.formatter, s2 = t3.xaxis.categories && t3.xaxis.categories.length ? t3.xaxis.categories : t3.labels;
        return i2 && i2.length && (s2 = i2.map(function(t4) {
          return Array.isArray(t4) ? t4 : String(t4);
        })), s2 && s2.length && (t3.xaxis.labels.formatter = function(t4) {
          return p.isNumber(t4) ? a2(s2[Math.floor(t4) - 1]) : a2(t4);
        }), t3.xaxis.categories = [], t3.labels = [], t3.xaxis.tickAmount = t3.xaxis.tickAmount || "dataPoints", t3;
      } }, { key: "bubble", value: function() {
        return { dataLabels: { style: { colors: ["#fff"] } }, tooltip: { shared: false, intersect: true }, xaxis: { crosshairs: { width: 0 } }, fill: { type: "solid", gradient: { shade: "light", inverse: true, shadeIntensity: 0.55, opacityFrom: 0.4, opacityTo: 0.8 } } };
      } }, { key: "scatter", value: function() {
        return { dataLabels: { enabled: false }, tooltip: { shared: false, intersect: true }, markers: { size: 6, strokeWidth: 1, hover: { sizeOffset: 2 } } };
      } }, { key: "heatmap", value: function() {
        return { chart: { stacked: false }, fill: { opacity: 1 }, dataLabels: { style: { colors: ["#fff"] } }, stroke: { colors: ["#fff"] }, tooltip: { followCursor: true, marker: { show: false }, x: { show: false } }, legend: { position: "top", markers: { shape: "square", size: 10, offsetY: 2 } }, grid: { padding: { right: 20 } } };
      } }, { key: "treemap", value: function() {
        return { chart: { zoom: { enabled: false } }, dataLabels: { style: { fontSize: 14, fontWeight: 600, colors: ["#fff"] } }, stroke: { show: true, width: 2, colors: ["#fff"] }, legend: { show: false }, fill: { gradient: { stops: [0, 100] } }, tooltip: { followCursor: true, x: { show: false } }, grid: { padding: { left: 0, right: 0 } }, xaxis: { crosshairs: { show: false }, tooltip: { enabled: false } } };
      } }, { key: "pie", value: function() {
        return { chart: { toolbar: { show: false } }, plotOptions: { pie: { donut: { labels: { show: false } } } }, dataLabels: { formatter: function(t3) {
          return t3.toFixed(1) + "%";
        }, style: { colors: ["#fff"] }, background: { enabled: false }, dropShadow: { enabled: true } }, stroke: { colors: ["#fff"] }, fill: { opacity: 1, gradient: { shade: "light", stops: [0, 100] } }, tooltip: { theme: "dark", fillSeriesColor: true }, legend: { position: "right" } };
      } }, { key: "donut", value: function() {
        return { chart: { toolbar: { show: false } }, dataLabels: { formatter: function(t3) {
          return t3.toFixed(1) + "%";
        }, style: { colors: ["#fff"] }, background: { enabled: false }, dropShadow: { enabled: true } }, stroke: { colors: ["#fff"] }, fill: { opacity: 1, gradient: { shade: "light", shadeIntensity: 0.35, stops: [80, 100], opacityFrom: 1, opacityTo: 1 } }, tooltip: { theme: "dark", fillSeriesColor: true }, legend: { position: "right" } };
      } }, { key: "polarArea", value: function() {
        return this.opts.yaxis[0].tickAmount = this.opts.yaxis[0].tickAmount ? this.opts.yaxis[0].tickAmount : 6, { chart: { toolbar: { show: false } }, dataLabels: { formatter: function(t3) {
          return t3.toFixed(1) + "%";
        }, enabled: false }, stroke: { show: true, width: 2 }, fill: { opacity: 0.7 }, tooltip: { theme: "dark", fillSeriesColor: true }, legend: { position: "right" } };
      } }, { key: "radar", value: function() {
        return this.opts.yaxis[0].labels.offsetY = this.opts.yaxis[0].labels.offsetY ? this.opts.yaxis[0].labels.offsetY : 6, { dataLabels: { enabled: false, style: { fontSize: "11px" } }, stroke: { width: 2 }, markers: { size: 3, strokeWidth: 1, strokeOpacity: 1 }, fill: { opacity: 0.2 }, tooltip: { shared: false, intersect: true, followCursor: true }, grid: { show: false }, xaxis: { labels: { formatter: function(t3) {
          return t3;
        }, style: { colors: ["#a8a8a8"], fontSize: "11px" } }, tooltip: { enabled: false }, crosshairs: { show: false } } };
      } }, { key: "radialBar", value: function() {
        return { chart: { animations: { dynamicAnimation: { enabled: true, speed: 800 } }, toolbar: { show: false } }, fill: { gradient: { shade: "dark", shadeIntensity: 0.4, inverseColors: false, type: "diagonal2", opacityFrom: 1, opacityTo: 1, stops: [70, 98, 100] } }, legend: { show: false, position: "right" }, tooltip: { enabled: false, fillSeriesColor: true } };
      } }, { key: "_getBoxTooltip", value: function(t3, e2, i2, a2, s2) {
        var r2 = t3.globals.seriesCandleO[e2][i2], o2 = t3.globals.seriesCandleH[e2][i2], n2 = t3.globals.seriesCandleM[e2][i2], l2 = t3.globals.seriesCandleL[e2][i2], h2 = t3.globals.seriesCandleC[e2][i2];
        return t3.config.series[e2].type && t3.config.series[e2].type !== s2 ? '<div class="apexcharts-custom-tooltip">\n          '.concat(t3.config.series[e2].name ? t3.config.series[e2].name : "series-" + (e2 + 1), ": <strong>").concat(t3.globals.series[e2][i2], "</strong>\n        </div>") : '<div class="apexcharts-tooltip-box apexcharts-tooltip-'.concat(t3.config.chart.type, '">') + "<div>".concat(a2[0], ': <span class="value">') + r2 + "</span></div>" + "<div>".concat(a2[1], ': <span class="value">') + o2 + "</span></div>" + (n2 ? "<div>".concat(a2[2], ': <span class="value">') + n2 + "</span></div>" : "") + "<div>".concat(a2[3], ': <span class="value">') + l2 + "</span></div>" + "<div>".concat(a2[4], ': <span class="value">') + h2 + "</span></div></div>";
      } }]), t2;
    }();
    var H = function() {
      function t2(e2) {
        a(this, t2), this.opts = e2;
      }
      return r(t2, [{ key: "init", value: function(t3) {
        var e2 = t3.responsiveOverride, a2 = this.opts, s2 = new S(), r2 = new R(a2);
        this.chartType = a2.chart.type, "histogram" === this.chartType && (a2.chart.type = "bar", a2 = p.extend({ plotOptions: { bar: { columnWidth: "99.99%" } } }, a2)), a2 = this.extendYAxis(a2), a2 = this.extendAnnotations(a2);
        var o2 = s2.init(), n2 = {};
        if (a2 && "object" === i(a2)) {
          var l2 = {};
          l2 = -1 !== ["line", "area", "bar", "candlestick", "boxPlot", "rangeBar", "histogram", "bubble", "scatter", "heatmap", "treemap", "pie", "polarArea", "donut", "radar", "radialBar"].indexOf(a2.chart.type) ? r2[a2.chart.type]() : r2.line(), a2.chart.brush && a2.chart.brush.enabled && (l2 = r2.brush(l2)), a2.chart.stacked && "100%" === a2.chart.stackType && (a2 = r2.stacked100(a2)), this.checkForDarkTheme(window.Apex), this.checkForDarkTheme(a2), a2.xaxis = a2.xaxis || window.Apex.xaxis || {}, e2 || (a2.xaxis.convertedCatToNumeric = false), ((a2 = this.checkForCatToNumericXAxis(this.chartType, l2, a2)).chart.sparkline && a2.chart.sparkline.enabled || window.Apex.chart && window.Apex.chart.sparkline && window.Apex.chart.sparkline.enabled) && (l2 = r2.sparkline(l2)), n2 = p.extend(o2, l2);
        }
        var h2 = p.extend(n2, window.Apex);
        return o2 = p.extend(h2, a2), o2 = this.handleUserInputErrors(o2);
      } }, { key: "checkForCatToNumericXAxis", value: function(t3, e2, i2) {
        var a2 = new R(i2), s2 = "bar" === t3 && i2.plotOptions && i2.plotOptions.bar && i2.plotOptions.bar.horizontal, r2 = "pie" === t3 || "polarArea" === t3 || "donut" === t3 || "radar" === t3 || "radialBar" === t3 || "heatmap" === t3, o2 = "datetime" !== i2.xaxis.type && "numeric" !== i2.xaxis.type, n2 = i2.xaxis.tickPlacement ? i2.xaxis.tickPlacement : e2.xaxis && e2.xaxis.tickPlacement;
        return s2 || r2 || !o2 || "between" === n2 || (i2 = a2.convertCatToNumeric(i2)), i2;
      } }, { key: "extendYAxis", value: function(t3, e2) {
        var i2 = new S();
        (void 0 === t3.yaxis || !t3.yaxis || Array.isArray(t3.yaxis) && 0 === t3.yaxis.length) && (t3.yaxis = {}), t3.yaxis.constructor !== Array && window.Apex.yaxis && window.Apex.yaxis.constructor !== Array && (t3.yaxis = p.extend(t3.yaxis, window.Apex.yaxis)), t3.yaxis.constructor !== Array ? t3.yaxis = [p.extend(i2.yAxis, t3.yaxis)] : t3.yaxis = p.extendArray(t3.yaxis, i2.yAxis);
        var a2 = false;
        t3.yaxis.forEach(function(t4) {
          t4.logarithmic && (a2 = true);
        });
        var s2 = t3.series;
        return e2 && !s2 && (s2 = e2.config.series), a2 && s2.length !== t3.yaxis.length && s2.length && (t3.yaxis = s2.map(function(e3, a3) {
          if (e3.name || (s2[a3].name = "series-".concat(a3 + 1)), t3.yaxis[a3])
            return t3.yaxis[a3].seriesName = s2[a3].name, t3.yaxis[a3];
          var r2 = p.extend(i2.yAxis, t3.yaxis[0]);
          return r2.show = false, r2;
        })), a2 && s2.length > 1 && s2.length !== t3.yaxis.length && console.warn("A multi-series logarithmic chart should have equal number of series and y-axes. Please make sure to equalize both."), t3;
      } }, { key: "extendAnnotations", value: function(t3) {
        return void 0 === t3.annotations && (t3.annotations = {}, t3.annotations.yaxis = [], t3.annotations.xaxis = [], t3.annotations.points = []), t3 = this.extendYAxisAnnotations(t3), t3 = this.extendXAxisAnnotations(t3), t3 = this.extendPointAnnotations(t3);
      } }, { key: "extendYAxisAnnotations", value: function(t3) {
        var e2 = new S();
        return t3.annotations.yaxis = p.extendArray(void 0 !== t3.annotations.yaxis ? t3.annotations.yaxis : [], e2.yAxisAnnotation), t3;
      } }, { key: "extendXAxisAnnotations", value: function(t3) {
        var e2 = new S();
        return t3.annotations.xaxis = p.extendArray(void 0 !== t3.annotations.xaxis ? t3.annotations.xaxis : [], e2.xAxisAnnotation), t3;
      } }, { key: "extendPointAnnotations", value: function(t3) {
        var e2 = new S();
        return t3.annotations.points = p.extendArray(void 0 !== t3.annotations.points ? t3.annotations.points : [], e2.pointAnnotation), t3;
      } }, { key: "checkForDarkTheme", value: function(t3) {
        t3.theme && "dark" === t3.theme.mode && (t3.tooltip || (t3.tooltip = {}), "light" !== t3.tooltip.theme && (t3.tooltip.theme = "dark"), t3.chart.foreColor || (t3.chart.foreColor = "#f6f7f8"), t3.chart.background || (t3.chart.background = "#424242"), t3.theme.palette || (t3.theme.palette = "palette4"));
      } }, { key: "handleUserInputErrors", value: function(t3) {
        var e2 = t3;
        if (e2.tooltip.shared && e2.tooltip.intersect)
          throw new Error("tooltip.shared cannot be enabled when tooltip.intersect is true. Turn off any other option by setting it to false.");
        if ("bar" === e2.chart.type && e2.plotOptions.bar.horizontal) {
          if (e2.yaxis.length > 1)
            throw new Error("Multiple Y Axis for bars are not supported. Switch to column chart by setting plotOptions.bar.horizontal=false");
          e2.yaxis[0].reversed && (e2.yaxis[0].opposite = true), e2.xaxis.tooltip.enabled = false, e2.yaxis[0].tooltip.enabled = false, e2.chart.zoom.enabled = false;
        }
        return "bar" !== e2.chart.type && "rangeBar" !== e2.chart.type || e2.tooltip.shared && "barWidth" === e2.xaxis.crosshairs.width && e2.series.length > 1 && (e2.xaxis.crosshairs.width = "tickWidth"), "candlestick" !== e2.chart.type && "boxPlot" !== e2.chart.type || e2.yaxis[0].reversed && (console.warn("Reversed y-axis in ".concat(e2.chart.type, " chart is not supported.")), e2.yaxis[0].reversed = false), e2.chart.group && 0 === e2.yaxis[0].labels.minWidth && console.warn("It looks like you have multiple charts in synchronization. You must provide yaxis.labels.minWidth which must be EQUAL for all grouped charts to prevent incorrect behaviour."), Array.isArray(e2.stroke.width) && "line" !== e2.chart.type && "area" !== e2.chart.type && (console.warn("stroke.width option accepts array only for line and area charts. Reverted back to Number"), e2.stroke.width = e2.stroke.width[0]), e2;
      } }]), t2;
    }();
    var D = function() {
      function t2() {
        a(this, t2);
      }
      return r(t2, [{ key: "initGlobalVars", value: function(t3) {
        t3.series = [], t3.seriesCandleO = [], t3.seriesCandleH = [], t3.seriesCandleM = [], t3.seriesCandleL = [], t3.seriesCandleC = [], t3.seriesRangeStart = [], t3.seriesRangeEnd = [], t3.seriesRangeBarTimeline = [], t3.seriesPercent = [], t3.seriesGoals = [], t3.seriesX = [], t3.seriesZ = [], t3.seriesNames = [], t3.seriesTotals = [], t3.seriesLog = [], t3.seriesColors = [], t3.stackedSeriesTotals = [], t3.seriesXvalues = [], t3.seriesYvalues = [], t3.labels = [], t3.categoryLabels = [], t3.timescaleLabels = [], t3.noLabelsProvided = false, t3.resizeTimer = null, t3.selectionResizeTimer = null, t3.delayedElements = [], t3.pointsArray = [], t3.dataLabelsRects = [], t3.isXNumeric = false, t3.xaxisLabelsCount = 0, t3.skipLastTimelinelabel = false, t3.skipFirstTimelinelabel = false, t3.isDataXYZ = false, t3.isMultiLineX = false, t3.isMultipleYAxis = false, t3.maxY = -Number.MAX_VALUE, t3.minY = Number.MIN_VALUE, t3.minYArr = [], t3.maxYArr = [], t3.maxX = -Number.MAX_VALUE, t3.minX = Number.MAX_VALUE, t3.initialMaxX = -Number.MAX_VALUE, t3.initialMinX = Number.MAX_VALUE, t3.maxDate = 0, t3.minDate = Number.MAX_VALUE, t3.minZ = Number.MAX_VALUE, t3.maxZ = -Number.MAX_VALUE, t3.minXDiff = Number.MAX_VALUE, t3.yAxisScale = [], t3.xAxisScale = null, t3.xAxisTicksPositions = [], t3.yLabelsCoords = [], t3.yTitleCoords = [], t3.barPadForNumericAxis = 0, t3.padHorizontal = 0, t3.xRange = 0, t3.yRange = [], t3.zRange = 0, t3.dataPoints = 0, t3.xTickAmount = 0;
      } }, { key: "globalVars", value: function(t3) {
        return { chartID: null, cuid: null, events: { beforeMount: [], mounted: [], updated: [], clicked: [], selection: [], dataPointSelection: [], zoomed: [], scrolled: [] }, colors: [], clientX: null, clientY: null, fill: { colors: [] }, stroke: { colors: [] }, dataLabels: { style: { colors: [] } }, radarPolygons: { fill: { colors: [] } }, markers: { colors: [], size: t3.markers.size, largestSize: 0 }, animationEnded: false, isTouchDevice: "ontouchstart" in window || navigator.msMaxTouchPoints, isDirty: false, isExecCalled: false, initialConfig: null, initialSeries: [], lastXAxis: [], lastYAxis: [], columnSeries: null, labels: [], timescaleLabels: [], noLabelsProvided: false, allSeriesCollapsed: false, collapsedSeries: [], collapsedSeriesIndices: [], ancillaryCollapsedSeries: [], ancillaryCollapsedSeriesIndices: [], risingSeries: [], dataFormatXNumeric: false, capturedSeriesIndex: -1, capturedDataPointIndex: -1, selectedDataPoints: [], goldenPadding: 35, invalidLogScale: false, ignoreYAxisIndexes: [], yAxisSameScaleIndices: [], maxValsInArrayIndex: 0, radialSize: 0, selection: void 0, zoomEnabled: "zoom" === t3.chart.toolbar.autoSelected && t3.chart.toolbar.tools.zoom && t3.chart.zoom.enabled, panEnabled: "pan" === t3.chart.toolbar.autoSelected && t3.chart.toolbar.tools.pan, selectionEnabled: "selection" === t3.chart.toolbar.autoSelected && t3.chart.toolbar.tools.selection, yaxis: null, mousedown: false, lastClientPosition: {}, visibleXRange: void 0, yValueDecimal: 0, total: 0, SVGNS: "http://www.w3.org/2000/svg", svgWidth: 0, svgHeight: 0, noData: false, locale: {}, dom: {}, memory: { methodsToExec: [] }, shouldAnimate: true, skipLastTimelinelabel: false, skipFirstTimelinelabel: false, delayedElements: [], axisCharts: true, isDataXYZ: false, resized: false, resizeTimer: null, comboCharts: false, dataChanged: false, previousPaths: [], allSeriesHasEqualX: true, pointsArray: [], dataLabelsRects: [], lastDrawnDataLabelsIndexes: [], hasNullValues: false, easing: null, zoomed: false, gridWidth: 0, gridHeight: 0, rotateXLabels: false, defaultLabels: false, xLabelFormatter: void 0, yLabelFormatters: [], xaxisTooltipFormatter: void 0, ttKeyFormatter: void 0, ttVal: void 0, ttZFormatter: void 0, LINE_HEIGHT_RATIO: 1.618, xAxisLabelsHeight: 0, xAxisLabelsWidth: 0, yAxisLabelsWidth: 0, scaleX: 1, scaleY: 1, translateX: 0, translateY: 0, translateYAxisX: [], yAxisWidths: [], translateXAxisY: 0, translateXAxisX: 0, tooltip: null };
      } }, { key: "init", value: function(t3) {
        var e2 = this.globalVars(t3);
        return this.initGlobalVars(e2), e2.initialConfig = p.extend({}, t3), e2.initialSeries = p.clone(t3.series), e2.lastXAxis = p.clone(e2.initialConfig.xaxis), e2.lastYAxis = p.clone(e2.initialConfig.yaxis), e2;
      } }]), t2;
    }();
    var N = function() {
      function t2(e2) {
        a(this, t2), this.opts = e2;
      }
      return r(t2, [{ key: "init", value: function() {
        var t3 = new H(this.opts).init({ responsiveOverride: false });
        return { config: t3, globals: new D().init(t3) };
      } }]), t2;
    }();
    var O = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.twoDSeries = [], this.threeDSeries = [], this.twoDSeriesX = [], this.seriesGoals = [], this.coreUtils = new y(this.ctx);
      }
      return r(t2, [{ key: "isMultiFormat", value: function() {
        return this.isFormatXY() || this.isFormat2DArray();
      } }, { key: "isFormatXY", value: function() {
        var t3 = this.w.config.series.slice(), e2 = new z(this.ctx);
        if (this.activeSeriesIndex = e2.getActiveConfigSeriesIndex(), void 0 !== t3[this.activeSeriesIndex].data && t3[this.activeSeriesIndex].data.length > 0 && null !== t3[this.activeSeriesIndex].data[0] && void 0 !== t3[this.activeSeriesIndex].data[0].x && null !== t3[this.activeSeriesIndex].data[0])
          return true;
      } }, { key: "isFormat2DArray", value: function() {
        var t3 = this.w.config.series.slice(), e2 = new z(this.ctx);
        if (this.activeSeriesIndex = e2.getActiveConfigSeriesIndex(), void 0 !== t3[this.activeSeriesIndex].data && t3[this.activeSeriesIndex].data.length > 0 && void 0 !== t3[this.activeSeriesIndex].data[0] && null !== t3[this.activeSeriesIndex].data[0] && t3[this.activeSeriesIndex].data[0].constructor === Array)
          return true;
      } }, { key: "handleFormat2DArray", value: function(t3, e2) {
        for (var i2 = this.w.config, a2 = this.w.globals, s2 = "boxPlot" === i2.chart.type || "boxPlot" === i2.series[e2].type, r2 = 0; r2 < t3[e2].data.length; r2++)
          if (void 0 !== t3[e2].data[r2][1] && (Array.isArray(t3[e2].data[r2][1]) && 4 === t3[e2].data[r2][1].length && !s2 ? this.twoDSeries.push(p.parseNumber(t3[e2].data[r2][1][3])) : t3[e2].data[r2].length >= 5 ? this.twoDSeries.push(p.parseNumber(t3[e2].data[r2][4])) : this.twoDSeries.push(p.parseNumber(t3[e2].data[r2][1])), a2.dataFormatXNumeric = true), "datetime" === i2.xaxis.type) {
            var o2 = new Date(t3[e2].data[r2][0]);
            o2 = new Date(o2).getTime(), this.twoDSeriesX.push(o2);
          } else
            this.twoDSeriesX.push(t3[e2].data[r2][0]);
        for (var n2 = 0; n2 < t3[e2].data.length; n2++)
          void 0 !== t3[e2].data[n2][2] && (this.threeDSeries.push(t3[e2].data[n2][2]), a2.isDataXYZ = true);
      } }, { key: "handleFormatXY", value: function(t3, e2) {
        var i2 = this.w.config, a2 = this.w.globals, s2 = new Y(this.ctx), r2 = e2;
        a2.collapsedSeriesIndices.indexOf(e2) > -1 && (r2 = this.activeSeriesIndex);
        for (var o2 = 0; o2 < t3[e2].data.length; o2++)
          void 0 !== t3[e2].data[o2].y && (Array.isArray(t3[e2].data[o2].y) ? this.twoDSeries.push(p.parseNumber(t3[e2].data[o2].y[t3[e2].data[o2].y.length - 1])) : this.twoDSeries.push(p.parseNumber(t3[e2].data[o2].y))), void 0 !== t3[e2].data[o2].goals && Array.isArray(t3[e2].data[o2].goals) ? (void 0 === this.seriesGoals[e2] && (this.seriesGoals[e2] = []), this.seriesGoals[e2].push(t3[e2].data[o2].goals)) : (void 0 === this.seriesGoals[e2] && (this.seriesGoals[e2] = []), this.seriesGoals[e2].push(null));
        for (var n2 = 0; n2 < t3[r2].data.length; n2++) {
          var l2 = "string" == typeof t3[r2].data[n2].x, h2 = Array.isArray(t3[r2].data[n2].x), c2 = !h2 && !!s2.isValidDate(t3[r2].data[n2].x.toString());
          if (l2 || c2)
            if (l2 || i2.xaxis.convertedCatToNumeric) {
              var d2 = a2.isBarHorizontal && a2.isRangeData;
              "datetime" !== i2.xaxis.type || d2 ? (this.fallbackToCategory = true, this.twoDSeriesX.push(t3[r2].data[n2].x)) : this.twoDSeriesX.push(s2.parseDate(t3[r2].data[n2].x));
            } else
              "datetime" === i2.xaxis.type ? this.twoDSeriesX.push(s2.parseDate(t3[r2].data[n2].x.toString())) : (a2.dataFormatXNumeric = true, a2.isXNumeric = true, this.twoDSeriesX.push(parseFloat(t3[r2].data[n2].x)));
          else
            h2 ? (this.fallbackToCategory = true, this.twoDSeriesX.push(t3[r2].data[n2].x)) : (a2.isXNumeric = true, a2.dataFormatXNumeric = true, this.twoDSeriesX.push(t3[r2].data[n2].x));
        }
        if (t3[e2].data[0] && void 0 !== t3[e2].data[0].z) {
          for (var g2 = 0; g2 < t3[e2].data.length; g2++)
            this.threeDSeries.push(t3[e2].data[g2].z);
          a2.isDataXYZ = true;
        }
      } }, { key: "handleRangeData", value: function(t3, e2) {
        var i2 = this.w.config, a2 = this.w.globals, s2 = {};
        return this.isFormat2DArray() ? s2 = this.handleRangeDataFormat("array", t3, e2) : this.isFormatXY() && (s2 = this.handleRangeDataFormat("xy", t3, e2)), a2.seriesRangeStart.push(s2.start), a2.seriesRangeEnd.push(s2.end), "datetime" === i2.xaxis.type && a2.seriesRangeBarTimeline.push(s2.rangeUniques), a2.seriesRangeBarTimeline.forEach(function(t4, e3) {
          t4 && t4.forEach(function(t5, e4) {
            t5.y.forEach(function(e5, i3) {
              for (var a3 = 0; a3 < t5.y.length; a3++)
                if (i3 !== a3) {
                  var s3 = e5.y1, r2 = e5.y2, o2 = t5.y[a3].y1;
                  s3 <= t5.y[a3].y2 && o2 <= r2 && (t5.overlaps.indexOf(e5.rangeName) < 0 && t5.overlaps.push(e5.rangeName), t5.overlaps.indexOf(t5.y[a3].rangeName) < 0 && t5.overlaps.push(t5.y[a3].rangeName));
                }
            });
          });
        }), s2;
      } }, { key: "handleCandleStickBoxData", value: function(t3, e2) {
        var i2 = this.w.globals, a2 = {};
        return this.isFormat2DArray() ? a2 = this.handleCandleStickBoxDataFormat("array", t3, e2) : this.isFormatXY() && (a2 = this.handleCandleStickBoxDataFormat("xy", t3, e2)), i2.seriesCandleO[e2] = a2.o, i2.seriesCandleH[e2] = a2.h, i2.seriesCandleM[e2] = a2.m, i2.seriesCandleL[e2] = a2.l, i2.seriesCandleC[e2] = a2.c, a2;
      } }, { key: "handleRangeDataFormat", value: function(t3, e2, i2) {
        var a2 = [], s2 = [], r2 = e2[i2].data.filter(function(t4, e3, i3) {
          return e3 === i3.findIndex(function(e4) {
            return e4.x === t4.x;
          });
        }).map(function(t4, e3) {
          return { x: t4.x, overlaps: [], y: [] };
        }), o2 = "Please provide [Start, End] values in valid format. Read more https://apexcharts.com/docs/series/#rangecharts", n2 = new z(this.ctx).getActiveConfigSeriesIndex();
        if ("array" === t3) {
          if (2 !== e2[n2].data[0][1].length)
            throw new Error(o2);
          for (var l2 = 0; l2 < e2[i2].data.length; l2++)
            a2.push(e2[i2].data[l2][1][0]), s2.push(e2[i2].data[l2][1][1]);
        } else if ("xy" === t3) {
          if (2 !== e2[n2].data[0].y.length)
            throw new Error(o2);
          for (var h2 = function(t4) {
            var o3 = p.randomId(), n3 = e2[i2].data[t4].x, l3 = { y1: e2[i2].data[t4].y[0], y2: e2[i2].data[t4].y[1], rangeName: o3 };
            e2[i2].data[t4].rangeName = o3;
            var h3 = r2.findIndex(function(t5) {
              return t5.x === n3;
            });
            r2[h3].y.push(l3), a2.push(l3.y1), s2.push(l3.y2);
          }, c2 = 0; c2 < e2[i2].data.length; c2++)
            h2(c2);
        }
        return { start: a2, end: s2, rangeUniques: r2 };
      } }, { key: "handleCandleStickBoxDataFormat", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = "boxPlot" === a2.config.chart.type || "boxPlot" === a2.config.series[i2].type, r2 = [], o2 = [], n2 = [], l2 = [], h2 = [];
        if ("array" === t3)
          if (s2 && 6 === e2[i2].data[0].length || !s2 && 5 === e2[i2].data[0].length)
            for (var c2 = 0; c2 < e2[i2].data.length; c2++)
              r2.push(e2[i2].data[c2][1]), o2.push(e2[i2].data[c2][2]), s2 ? (n2.push(e2[i2].data[c2][3]), l2.push(e2[i2].data[c2][4]), h2.push(e2[i2].data[c2][5])) : (l2.push(e2[i2].data[c2][3]), h2.push(e2[i2].data[c2][4]));
          else
            for (var d2 = 0; d2 < e2[i2].data.length; d2++)
              Array.isArray(e2[i2].data[d2][1]) && (r2.push(e2[i2].data[d2][1][0]), o2.push(e2[i2].data[d2][1][1]), s2 ? (n2.push(e2[i2].data[d2][1][2]), l2.push(e2[i2].data[d2][1][3]), h2.push(e2[i2].data[d2][1][4])) : (l2.push(e2[i2].data[d2][1][2]), h2.push(e2[i2].data[d2][1][3])));
        else if ("xy" === t3)
          for (var g2 = 0; g2 < e2[i2].data.length; g2++)
            Array.isArray(e2[i2].data[g2].y) && (r2.push(e2[i2].data[g2].y[0]), o2.push(e2[i2].data[g2].y[1]), s2 ? (n2.push(e2[i2].data[g2].y[2]), l2.push(e2[i2].data[g2].y[3]), h2.push(e2[i2].data[g2].y[4])) : (l2.push(e2[i2].data[g2].y[2]), h2.push(e2[i2].data[g2].y[3])));
        return { o: r2, h: o2, m: n2, l: l2, c: h2 };
      } }, { key: "parseDataAxisCharts", value: function(t3) {
        var e2 = this, i2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.ctx, a2 = this.w.config, s2 = this.w.globals, r2 = new Y(i2), o2 = a2.labels.length > 0 ? a2.labels.slice() : a2.xaxis.categories.slice();
        s2.isTimelineBar = "rangeBar" === a2.chart.type && "datetime" === a2.xaxis.type;
        for (var n2 = function() {
          for (var t4 = 0; t4 < o2.length; t4++)
            if ("string" == typeof o2[t4]) {
              if (!r2.isValidDate(o2[t4]))
                throw new Error("You have provided invalid Date format. Please provide a valid JavaScript Date");
              e2.twoDSeriesX.push(r2.parseDate(o2[t4]));
            } else
              e2.twoDSeriesX.push(o2[t4]);
        }, l2 = 0; l2 < t3.length; l2++) {
          if (this.twoDSeries = [], this.twoDSeriesX = [], this.threeDSeries = [], void 0 === t3[l2].data)
            return void console.error("It is a possibility that you may have not included 'data' property in series.");
          if ("rangeBar" !== a2.chart.type && "rangeArea" !== a2.chart.type && "rangeBar" !== t3[l2].type && "rangeArea" !== t3[l2].type || (s2.isRangeData = true, this.handleRangeData(t3, l2)), this.isMultiFormat())
            this.isFormat2DArray() ? this.handleFormat2DArray(t3, l2) : this.isFormatXY() && this.handleFormatXY(t3, l2), "candlestick" !== a2.chart.type && "candlestick" !== t3[l2].type && "boxPlot" !== a2.chart.type && "boxPlot" !== t3[l2].type || this.handleCandleStickBoxData(t3, l2), s2.series.push(this.twoDSeries), s2.labels.push(this.twoDSeriesX), s2.seriesX.push(this.twoDSeriesX), s2.seriesGoals = this.seriesGoals, l2 !== this.activeSeriesIndex || this.fallbackToCategory || (s2.isXNumeric = true);
          else {
            "datetime" === a2.xaxis.type ? (s2.isXNumeric = true, n2(), s2.seriesX.push(this.twoDSeriesX)) : "numeric" === a2.xaxis.type && (s2.isXNumeric = true, o2.length > 0 && (this.twoDSeriesX = o2, s2.seriesX.push(this.twoDSeriesX))), s2.labels.push(this.twoDSeriesX);
            var h2 = t3[l2].data.map(function(t4) {
              return p.parseNumber(t4);
            });
            s2.series.push(h2);
          }
          s2.seriesZ.push(this.threeDSeries), void 0 !== t3[l2].name ? s2.seriesNames.push(t3[l2].name) : s2.seriesNames.push("series-" + parseInt(l2 + 1, 10)), void 0 !== t3[l2].color ? s2.seriesColors.push(t3[l2].color) : s2.seriesColors.push(void 0);
        }
        return this.w;
      } }, { key: "parseDataNonAxisCharts", value: function(t3) {
        var e2 = this.w.globals, i2 = this.w.config;
        e2.series = t3.slice(), e2.seriesNames = i2.labels.slice();
        for (var a2 = 0; a2 < e2.series.length; a2++)
          void 0 === e2.seriesNames[a2] && e2.seriesNames.push("series-" + (a2 + 1));
        return this.w;
      } }, { key: "handleExternalLabelsData", value: function(t3) {
        var e2 = this.w.config, i2 = this.w.globals;
        if (e2.xaxis.categories.length > 0)
          i2.labels = e2.xaxis.categories;
        else if (e2.labels.length > 0)
          i2.labels = e2.labels.slice();
        else if (this.fallbackToCategory) {
          if (i2.labels = i2.labels[0], i2.seriesRangeBarTimeline.length && (i2.seriesRangeBarTimeline.map(function(t4) {
            t4.forEach(function(t5) {
              i2.labels.indexOf(t5.x) < 0 && t5.x && i2.labels.push(t5.x);
            });
          }), i2.labels = i2.labels.filter(function(t4, e3, i3) {
            return i3.indexOf(t4) === e3;
          })), e2.xaxis.convertedCatToNumeric)
            new R(e2).convertCatToNumericXaxis(e2, this.ctx, i2.seriesX[0]), this._generateExternalLabels(t3);
        } else
          this._generateExternalLabels(t3);
      } }, { key: "_generateExternalLabels", value: function(t3) {
        var e2 = this.w.globals, i2 = this.w.config, a2 = [];
        if (e2.axisCharts) {
          if (e2.series.length > 0)
            for (var s2 = 0; s2 < e2.series[e2.maxValsInArrayIndex].length; s2++)
              a2.push(s2 + 1);
          e2.seriesX = [];
          for (var r2 = 0; r2 < t3.length; r2++)
            e2.seriesX.push(a2);
          e2.isXNumeric = true;
        }
        if (0 === a2.length) {
          a2 = e2.axisCharts ? [] : e2.series.map(function(t4, e3) {
            return e3 + 1;
          });
          for (var o2 = 0; o2 < t3.length; o2++)
            e2.seriesX.push(a2);
        }
        e2.labels = a2, i2.xaxis.convertedCatToNumeric && (e2.categoryLabels = a2.map(function(t4) {
          return i2.xaxis.labels.formatter(t4);
        })), e2.noLabelsProvided = true;
      } }, { key: "parseData", value: function(t3) {
        var e2 = this.w, i2 = e2.config, a2 = e2.globals;
        if (this.excludeCollapsedSeriesInYAxis(), this.fallbackToCategory = false, this.ctx.core.resetGlobals(), this.ctx.core.isMultipleY(), a2.axisCharts ? this.parseDataAxisCharts(t3) : this.parseDataNonAxisCharts(t3), this.coreUtils.getLargestSeries(), "bar" === i2.chart.type && i2.chart.stacked) {
          var s2 = new z(this.ctx);
          a2.series = s2.setNullSeriesToZeroValues(a2.series);
        }
        this.coreUtils.getSeriesTotals(), a2.axisCharts && this.coreUtils.getStackedSeriesTotals(), this.coreUtils.getPercentSeries(), a2.dataFormatXNumeric || a2.isXNumeric && ("numeric" !== i2.xaxis.type || 0 !== i2.labels.length || 0 !== i2.xaxis.categories.length) || this.handleExternalLabelsData(t3);
        for (var r2 = this.coreUtils.getCategoryLabels(a2.labels), o2 = 0; o2 < r2.length; o2++)
          if (Array.isArray(r2[o2])) {
            a2.isMultiLineX = true;
            break;
          }
      } }, { key: "excludeCollapsedSeriesInYAxis", value: function() {
        var t3 = this, e2 = this.w;
        e2.globals.ignoreYAxisIndexes = e2.globals.collapsedSeries.map(function(i2, a2) {
          if (t3.w.globals.isMultipleYAxis && !e2.config.chart.stacked)
            return i2.index;
        });
      } }]), t2;
    }();
    var W = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.tooltipKeyFormat = "dd MMM";
      }
      return r(t2, [{ key: "xLabelFormat", value: function(t3, e2, i2, a2) {
        var s2 = this.w;
        if ("datetime" === s2.config.xaxis.type && void 0 === s2.config.xaxis.labels.formatter && void 0 === s2.config.tooltip.x.formatter) {
          var r2 = new Y(this.ctx);
          return r2.formatDate(r2.getDate(e2), s2.config.tooltip.x.format);
        }
        return t3(e2, i2, a2);
      } }, { key: "defaultGeneralFormatter", value: function(t3) {
        return Array.isArray(t3) ? t3.map(function(t4) {
          return t4;
        }) : t3;
      } }, { key: "defaultYFormatter", value: function(t3, e2, i2) {
        var a2 = this.w;
        return p.isNumber(t3) && (t3 = 0 !== a2.globals.yValueDecimal ? t3.toFixed(void 0 !== e2.decimalsInFloat ? e2.decimalsInFloat : a2.globals.yValueDecimal) : a2.globals.maxYArr[i2] - a2.globals.minYArr[i2] < 5 ? t3.toFixed(1) : t3.toFixed(0)), t3;
      } }, { key: "setLabelFormatters", value: function() {
        var t3 = this, e2 = this.w;
        return e2.globals.xaxisTooltipFormatter = function(e3) {
          return t3.defaultGeneralFormatter(e3);
        }, e2.globals.ttKeyFormatter = function(e3) {
          return t3.defaultGeneralFormatter(e3);
        }, e2.globals.ttZFormatter = function(t4) {
          return t4;
        }, e2.globals.legendFormatter = function(e3) {
          return t3.defaultGeneralFormatter(e3);
        }, void 0 !== e2.config.xaxis.labels.formatter ? e2.globals.xLabelFormatter = e2.config.xaxis.labels.formatter : e2.globals.xLabelFormatter = function(t4) {
          if (p.isNumber(t4)) {
            if (!e2.config.xaxis.convertedCatToNumeric && "numeric" === e2.config.xaxis.type) {
              if (p.isNumber(e2.config.xaxis.decimalsInFloat))
                return t4.toFixed(e2.config.xaxis.decimalsInFloat);
              var i2 = e2.globals.maxX - e2.globals.minX;
              return i2 > 0 && i2 < 100 ? t4.toFixed(1) : t4.toFixed(0);
            }
            if (e2.globals.isBarHorizontal) {
              if (e2.globals.maxY - e2.globals.minYArr < 4)
                return t4.toFixed(1);
            }
            return t4.toFixed(0);
          }
          return t4;
        }, "function" == typeof e2.config.tooltip.x.formatter ? e2.globals.ttKeyFormatter = e2.config.tooltip.x.formatter : e2.globals.ttKeyFormatter = e2.globals.xLabelFormatter, "function" == typeof e2.config.xaxis.tooltip.formatter && (e2.globals.xaxisTooltipFormatter = e2.config.xaxis.tooltip.formatter), (Array.isArray(e2.config.tooltip.y) || void 0 !== e2.config.tooltip.y.formatter) && (e2.globals.ttVal = e2.config.tooltip.y), void 0 !== e2.config.tooltip.z.formatter && (e2.globals.ttZFormatter = e2.config.tooltip.z.formatter), void 0 !== e2.config.legend.formatter && (e2.globals.legendFormatter = e2.config.legend.formatter), e2.config.yaxis.forEach(function(i2, a2) {
          void 0 !== i2.labels.formatter ? e2.globals.yLabelFormatters[a2] = i2.labels.formatter : e2.globals.yLabelFormatters[a2] = function(s2) {
            return e2.globals.xyCharts ? Array.isArray(s2) ? s2.map(function(e3) {
              return t3.defaultYFormatter(e3, i2, a2);
            }) : t3.defaultYFormatter(s2, i2, a2) : s2;
          };
        }), e2.globals;
      } }, { key: "heatmapLabelFormatters", value: function() {
        var t3 = this.w;
        if ("heatmap" === t3.config.chart.type) {
          t3.globals.yAxisScale[0].result = t3.globals.seriesNames.slice();
          var e2 = t3.globals.seriesNames.reduce(function(t4, e3) {
            return t4.length > e3.length ? t4 : e3;
          }, 0);
          t3.globals.yAxisScale[0].niceMax = e2, t3.globals.yAxisScale[0].niceMin = e2;
        }
      } }]), t2;
    }();
    var B = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "getLabel", value: function(t3, e2, i2, a2) {
        var s2 = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : [], r2 = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : "12px", o2 = this.w, n2 = void 0 === t3[a2] ? "" : t3[a2], l2 = n2, h2 = o2.globals.xLabelFormatter, c2 = o2.config.xaxis.labels.formatter, d2 = false, g2 = new W(this.ctx), u2 = n2;
        l2 = g2.xLabelFormat(h2, n2, u2, { i: a2, dateFormatter: new Y(this.ctx).formatDate, w: o2 }), void 0 !== c2 && (l2 = c2(n2, t3[a2], { i: a2, dateFormatter: new Y(this.ctx).formatDate, w: o2 }));
        var p2 = function(t4) {
          var i3 = null;
          return e2.forEach(function(t5) {
            "month" === t5.unit ? i3 = "year" : "day" === t5.unit ? i3 = "month" : "hour" === t5.unit ? i3 = "day" : "minute" === t5.unit && (i3 = "hour");
          }), i3 === t4;
        };
        e2.length > 0 ? (d2 = p2(e2[a2].unit), i2 = e2[a2].position, l2 = e2[a2].value) : "datetime" === o2.config.xaxis.type && void 0 === c2 && (l2 = ""), void 0 === l2 && (l2 = ""), l2 = Array.isArray(l2) ? l2 : l2.toString();
        var f2 = new b(this.ctx), x2 = {};
        x2 = o2.globals.rotateXLabels ? f2.getTextRects(l2, parseInt(r2, 10), null, "rotate(".concat(o2.config.xaxis.labels.rotate, " 0 0)"), false) : f2.getTextRects(l2, parseInt(r2, 10));
        var v2 = !o2.config.xaxis.labels.showDuplicates && this.ctx.timeScale;
        return !Array.isArray(l2) && (0 === l2.indexOf("NaN") || 0 === l2.toLowerCase().indexOf("invalid") || l2.toLowerCase().indexOf("infinity") >= 0 || s2.indexOf(l2) >= 0 && v2) && (l2 = ""), { x: i2, text: l2, textRect: x2, isBold: d2 };
      } }, { key: "checkLabelBasedOnTickamount", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = a2.config.xaxis.tickAmount;
        return "dataPoints" === s2 && (s2 = Math.round(a2.globals.gridWidth / 120)), s2 > i2 || t3 % Math.round(i2 / (s2 + 1)) == 0 || (e2.text = ""), e2;
      } }, { key: "checkForOverflowingLabels", value: function(t3, e2, i2, a2, s2) {
        var r2 = this.w;
        if (0 === t3 && r2.globals.skipFirstTimelinelabel && (e2.text = ""), t3 === i2 - 1 && r2.globals.skipLastTimelinelabel && (e2.text = ""), r2.config.xaxis.labels.hideOverlappingLabels && a2.length > 0) {
          var o2 = s2[s2.length - 1];
          e2.x < o2.textRect.width / (r2.globals.rotateXLabels ? Math.abs(r2.config.xaxis.labels.rotate) / 12 : 1.01) + o2.x && (e2.text = "");
        }
        return e2;
      } }, { key: "checkForReversedLabels", value: function(t3, e2) {
        var i2 = this.w;
        return i2.config.yaxis[t3] && i2.config.yaxis[t3].reversed && e2.reverse(), e2;
      } }, { key: "isYAxisHidden", value: function(t3) {
        var e2 = this.w, i2 = new y(this.ctx);
        return !e2.config.yaxis[t3].show || !e2.config.yaxis[t3].showForNullSeries && i2.isSeriesNull(t3) && -1 === e2.globals.collapsedSeriesIndices.indexOf(t3);
      } }, { key: "getYAxisForeColor", value: function(t3, e2) {
        var i2 = this.w;
        return Array.isArray(t3) && i2.globals.yAxisScale[e2] && this.ctx.theme.pushExtraColors(t3, i2.globals.yAxisScale[e2].result.length, false), t3;
      } }, { key: "drawYAxisTicks", value: function(t3, e2, i2, a2, s2, r2, o2) {
        var n2 = this.w, l2 = new b(this.ctx), h2 = n2.globals.translateY;
        if (a2.show && e2 > 0) {
          true === n2.config.yaxis[s2].opposite && (t3 += a2.width);
          for (var c2 = e2; c2 >= 0; c2--) {
            var d2 = h2 + e2 / 10 + n2.config.yaxis[s2].labels.offsetY - 1;
            n2.globals.isBarHorizontal && (d2 = r2 * c2), "heatmap" === n2.config.chart.type && (d2 += r2 / 2);
            var g2 = l2.drawLine(t3 + i2.offsetX - a2.width + a2.offsetX, d2 + a2.offsetY, t3 + i2.offsetX + a2.offsetX, d2 + a2.offsetY, a2.color);
            o2.add(g2), h2 += r2;
          }
        }
      } }]), t2;
    }();
    var V = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "scaleSvgNode", value: function(t3, e2) {
        var i2 = parseFloat(t3.getAttributeNS(null, "width")), a2 = parseFloat(t3.getAttributeNS(null, "height"));
        t3.setAttributeNS(null, "width", i2 * e2), t3.setAttributeNS(null, "height", a2 * e2), t3.setAttributeNS(null, "viewBox", "0 0 " + i2 + " " + a2);
      } }, { key: "fixSvgStringForIe11", value: function(t3) {
        if (!p.isIE11())
          return t3;
        var e2 = 0, i2 = t3.replace(/xmlns="http:\/\/www.w3.org\/2000\/svg"/g, function(t4) {
          return 2 === ++e2 ? 'xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"' : t4;
        });
        return i2 = (i2 = i2.replace(/xmlns:NS\d+=""/g, "")).replace(/NS\d+:(\w+:\w+=")/g, "$1");
      } }, { key: "getSvgString", value: function(t3) {
        var e2 = this.w.globals.dom.Paper.svg();
        if (1 !== t3) {
          var i2 = this.w.globals.dom.Paper.node.cloneNode(true);
          this.scaleSvgNode(i2, t3), e2 = new XMLSerializer().serializeToString(i2);
        }
        return this.fixSvgStringForIe11(e2);
      } }, { key: "cleanup", value: function() {
        var t3 = this.w, e2 = t3.globals.dom.baseEl.getElementsByClassName("apexcharts-xcrosshairs"), i2 = t3.globals.dom.baseEl.getElementsByClassName("apexcharts-ycrosshairs"), a2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-zoom-rect, .apexcharts-selection-rect");
        Array.prototype.forEach.call(a2, function(t4) {
          t4.setAttribute("width", 0);
        }), e2 && e2[0] && (e2[0].setAttribute("x", -500), e2[0].setAttribute("x1", -500), e2[0].setAttribute("x2", -500)), i2 && i2[0] && (i2[0].setAttribute("y", -100), i2[0].setAttribute("y1", -100), i2[0].setAttribute("y2", -100));
      } }, { key: "svgUrl", value: function() {
        this.cleanup();
        var t3 = this.getSvgString(), e2 = new Blob([t3], { type: "image/svg+xml;charset=utf-8" });
        return URL.createObjectURL(e2);
      } }, { key: "dataURI", value: function(t3) {
        var e2 = this;
        return new Promise(function(i2) {
          var a2 = e2.w, s2 = t3 ? t3.scale || t3.width / a2.globals.svgWidth : 1;
          e2.cleanup();
          var r2 = document.createElement("canvas");
          r2.width = a2.globals.svgWidth * s2, r2.height = parseInt(a2.globals.dom.elWrap.style.height, 10) * s2;
          var o2 = "transparent" === a2.config.chart.background ? "#fff" : a2.config.chart.background, n2 = r2.getContext("2d");
          n2.fillStyle = o2, n2.fillRect(0, 0, r2.width * s2, r2.height * s2);
          var l2 = e2.getSvgString(s2);
          if (window.canvg && p.isIE11()) {
            var h2 = window.canvg.Canvg.fromString(n2, l2, { ignoreClear: true, ignoreDimensions: true });
            h2.start();
            var c2 = r2.msToBlob();
            h2.stop(), i2({ blob: c2 });
          } else {
            var d2 = "data:image/svg+xml," + encodeURIComponent(l2), g2 = new Image();
            g2.crossOrigin = "anonymous", g2.onload = function() {
              if (n2.drawImage(g2, 0, 0), r2.msToBlob) {
                var t4 = r2.msToBlob();
                i2({ blob: t4 });
              } else {
                var e3 = r2.toDataURL("image/png");
                i2({ imgURI: e3 });
              }
            }, g2.src = d2;
          }
        });
      } }, { key: "exportToSVG", value: function() {
        this.triggerDownload(this.svgUrl(), this.w.config.chart.toolbar.export.svg.filename, ".svg");
      } }, { key: "exportToPng", value: function() {
        var t3 = this;
        this.dataURI().then(function(e2) {
          var i2 = e2.imgURI, a2 = e2.blob;
          a2 ? navigator.msSaveOrOpenBlob(a2, t3.w.globals.chartID + ".png") : t3.triggerDownload(i2, t3.w.config.chart.toolbar.export.png.filename, ".png");
        });
      } }, { key: "exportToCSV", value: function(t3) {
        var e2 = this, i2 = t3.series, a2 = t3.columnDelimiter, s2 = t3.lineDelimiter, r2 = void 0 === s2 ? "\n" : s2, o2 = this.w, n2 = [], l2 = [], h2 = "data:text/csv;charset=utf-8,\uFEFF", c2 = new O(this.ctx), d2 = new B(this.ctx), g2 = function(t4) {
          var i3 = "";
          if (o2.globals.axisCharts) {
            if ("category" === o2.config.xaxis.type || o2.config.xaxis.convertedCatToNumeric)
              if (o2.globals.isBarHorizontal) {
                var s3 = o2.globals.yLabelFormatters[0], r3 = new z(e2.ctx).getActiveConfigSeriesIndex();
                i3 = s3(o2.globals.labels[t4], { seriesIndex: r3, dataPointIndex: t4, w: o2 });
              } else
                i3 = d2.getLabel(o2.globals.labels, o2.globals.timescaleLabels, 0, t4).text;
            "datetime" === o2.config.xaxis.type && (o2.config.xaxis.categories.length ? i3 = o2.config.xaxis.categories[t4] : o2.config.labels.length && (i3 = o2.config.labels[t4]));
          } else
            i3 = o2.config.labels[t4];
          return Array.isArray(i3) && (i3 = i3.join(" ")), p.isNumber(i3) ? i3 : i3.split(a2).join("");
        };
        n2.push(o2.config.chart.toolbar.export.csv.headerCategory), i2.map(function(t4, e3) {
          var i3 = t4.name ? t4.name : "series-".concat(e3);
          o2.globals.axisCharts && n2.push(i3.split(a2).join("") ? i3.split(a2).join("") : "series-".concat(e3));
        }), o2.globals.axisCharts || (n2.push(o2.config.chart.toolbar.export.csv.headerValue), l2.push(n2.join(a2))), i2.map(function(t4, e3) {
          o2.globals.axisCharts ? function(t5, e4) {
            if (n2.length && 0 === e4 && l2.push(n2.join(a2)), t5.data && t5.data.length)
              for (var s3 = 0; s3 < t5.data.length; s3++) {
                n2 = [];
                var r3 = g2(s3);
                if (r3 || (c2.isFormatXY() ? r3 = i2[e4].data[s3].x : c2.isFormat2DArray() && (r3 = i2[e4].data[s3] ? i2[e4].data[s3][0] : "")), 0 === e4) {
                  n2.push((d3 = r3, "datetime" === o2.config.xaxis.type && String(d3).length >= 10 ? o2.config.chart.toolbar.export.csv.dateFormatter(r3) : p.isNumber(r3) ? r3 : r3.split(a2).join("")));
                  for (var h3 = 0; h3 < o2.globals.series.length; h3++)
                    n2.push(o2.globals.series[h3][s3]);
                }
                ("candlestick" === o2.config.chart.type || t5.type && "candlestick" === t5.type) && (n2.pop(), n2.push(o2.globals.seriesCandleO[e4][s3]), n2.push(o2.globals.seriesCandleH[e4][s3]), n2.push(o2.globals.seriesCandleL[e4][s3]), n2.push(o2.globals.seriesCandleC[e4][s3])), ("boxPlot" === o2.config.chart.type || t5.type && "boxPlot" === t5.type) && (n2.pop(), n2.push(o2.globals.seriesCandleO[e4][s3]), n2.push(o2.globals.seriesCandleH[e4][s3]), n2.push(o2.globals.seriesCandleM[e4][s3]), n2.push(o2.globals.seriesCandleL[e4][s3]), n2.push(o2.globals.seriesCandleC[e4][s3])), "rangeBar" === o2.config.chart.type && (n2.pop(), n2.push(o2.globals.seriesRangeStart[e4][s3]), n2.push(o2.globals.seriesRangeEnd[e4][s3])), n2.length && l2.push(n2.join(a2));
              }
            var d3;
          }(t4, e3) : ((n2 = []).push(o2.globals.labels[e3].split(a2).join("")), n2.push(o2.globals.series[e3]), l2.push(n2.join(a2)));
        }), h2 += l2.join(r2), this.triggerDownload(encodeURI(h2), o2.config.chart.toolbar.export.csv.filename, ".csv");
      } }, { key: "triggerDownload", value: function(t3, e2, i2) {
        var a2 = document.createElement("a");
        a2.href = t3, a2.download = (e2 || this.w.globals.chartID) + i2, document.body.appendChild(a2), a2.click(), document.body.removeChild(a2);
      } }]), t2;
    }();
    var G = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var i2 = this.w;
        this.axesUtils = new B(e2), this.xaxisLabels = i2.globals.labels.slice(), i2.globals.timescaleLabels.length > 0 && !i2.globals.isBarHorizontal && (this.xaxisLabels = i2.globals.timescaleLabels.slice()), i2.config.xaxis.overwriteCategories && (this.xaxisLabels = i2.config.xaxis.overwriteCategories), this.drawnLabels = [], this.drawnLabelsRects = [], "top" === i2.config.xaxis.position ? this.offY = 0 : this.offY = i2.globals.gridHeight + 1, this.offY = this.offY + i2.config.xaxis.axisBorder.offsetY, this.isCategoryBarHorizontal = "bar" === i2.config.chart.type && i2.config.plotOptions.bar.horizontal, this.xaxisFontSize = i2.config.xaxis.labels.style.fontSize, this.xaxisFontFamily = i2.config.xaxis.labels.style.fontFamily, this.xaxisForeColors = i2.config.xaxis.labels.style.colors, this.xaxisBorderWidth = i2.config.xaxis.axisBorder.width, this.isCategoryBarHorizontal && (this.xaxisBorderWidth = i2.config.yaxis[0].axisBorder.width.toString()), this.xaxisBorderWidth.indexOf("%") > -1 ? this.xaxisBorderWidth = i2.globals.gridWidth * parseInt(this.xaxisBorderWidth, 10) / 100 : this.xaxisBorderWidth = parseInt(this.xaxisBorderWidth, 10), this.xaxisBorderHeight = i2.config.xaxis.axisBorder.height, this.yaxis = i2.config.yaxis[0];
      }
      return r(t2, [{ key: "drawXaxis", value: function() {
        var t3, e2 = this, i2 = this.w, a2 = new b(this.ctx), s2 = a2.group({ class: "apexcharts-xaxis", transform: "translate(".concat(i2.config.xaxis.offsetX, ", ").concat(i2.config.xaxis.offsetY, ")") }), r2 = a2.group({ class: "apexcharts-xaxis-texts-g", transform: "translate(".concat(i2.globals.translateXAxisX, ", ").concat(i2.globals.translateXAxisY, ")") });
        s2.add(r2);
        for (var o2 = i2.globals.padHorizontal, n2 = [], l2 = 0; l2 < this.xaxisLabels.length; l2++)
          n2.push(this.xaxisLabels[l2]);
        var h2 = n2.length;
        if (i2.globals.isXNumeric) {
          var c2 = h2 > 1 ? h2 - 1 : h2;
          t3 = i2.globals.gridWidth / c2, o2 = o2 + t3 / 2 + i2.config.xaxis.labels.offsetX;
        } else
          t3 = i2.globals.gridWidth / n2.length, o2 = o2 + t3 + i2.config.xaxis.labels.offsetX;
        for (var d2 = function(s3) {
          var l3 = o2 - t3 / 2 + i2.config.xaxis.labels.offsetX;
          0 === s3 && 1 === h2 && t3 / 2 === o2 && 1 === i2.globals.dataPoints && (l3 = i2.globals.gridWidth / 2);
          var c3 = e2.axesUtils.getLabel(n2, i2.globals.timescaleLabels, l3, s3, e2.drawnLabels, e2.xaxisFontSize), d3 = 28;
          i2.globals.rotateXLabels && (d3 = 22);
          if ((c3 = void 0 !== i2.config.xaxis.tickAmount && "dataPoints" !== i2.config.xaxis.tickAmount && "datetime" !== i2.config.xaxis.type ? e2.axesUtils.checkLabelBasedOnTickamount(s3, c3, h2) : e2.axesUtils.checkForOverflowingLabels(s3, c3, h2, e2.drawnLabels, e2.drawnLabelsRects)).text && i2.globals.xaxisLabelsCount++, i2.config.xaxis.labels.show) {
            var g3 = a2.drawText({ x: c3.x, y: e2.offY + i2.config.xaxis.labels.offsetY + d3 - ("top" === i2.config.xaxis.position ? i2.globals.xAxisHeight + i2.config.xaxis.axisTicks.height - 2 : 0), text: c3.text, textAnchor: "middle", fontWeight: c3.isBold ? 600 : i2.config.xaxis.labels.style.fontWeight, fontSize: e2.xaxisFontSize, fontFamily: e2.xaxisFontFamily, foreColor: Array.isArray(e2.xaxisForeColors) ? i2.config.xaxis.convertedCatToNumeric ? e2.xaxisForeColors[i2.globals.minX + s3 - 1] : e2.xaxisForeColors[s3] : e2.xaxisForeColors, isPlainText: false, cssClass: "apexcharts-xaxis-label " + i2.config.xaxis.labels.style.cssClass });
            r2.add(g3);
            var u3 = document.createElementNS(i2.globals.SVGNS, "title");
            u3.textContent = Array.isArray(c3.text) ? c3.text.join(" ") : c3.text, g3.node.appendChild(u3), "" !== c3.text && (e2.drawnLabels.push(c3.text), e2.drawnLabelsRects.push(c3));
          }
          o2 += t3;
        }, g2 = 0; g2 <= h2 - 1; g2++)
          d2(g2);
        if (void 0 !== i2.config.xaxis.title.text) {
          var u2 = a2.group({ class: "apexcharts-xaxis-title" }), p2 = a2.drawText({ x: i2.globals.gridWidth / 2 + i2.config.xaxis.title.offsetX, y: this.offY + parseFloat(this.xaxisFontSize) + i2.globals.xAxisLabelsHeight + i2.config.xaxis.title.offsetY, text: i2.config.xaxis.title.text, textAnchor: "middle", fontSize: i2.config.xaxis.title.style.fontSize, fontFamily: i2.config.xaxis.title.style.fontFamily, fontWeight: i2.config.xaxis.title.style.fontWeight, foreColor: i2.config.xaxis.title.style.color, cssClass: "apexcharts-xaxis-title-text " + i2.config.xaxis.title.style.cssClass });
          u2.add(p2), s2.add(u2);
        }
        if (i2.config.xaxis.axisBorder.show) {
          var f2 = i2.globals.barPadForNumericAxis, x2 = a2.drawLine(i2.globals.padHorizontal + i2.config.xaxis.axisBorder.offsetX - f2, this.offY, this.xaxisBorderWidth + f2, this.offY, i2.config.xaxis.axisBorder.color, 0, this.xaxisBorderHeight);
          s2.add(x2);
        }
        return s2;
      } }, { key: "drawXaxisInversed", value: function(t3) {
        var e2, i2, a2 = this, s2 = this.w, r2 = new b(this.ctx), o2 = s2.config.yaxis[0].opposite ? s2.globals.translateYAxisX[t3] : 0, n2 = r2.group({ class: "apexcharts-yaxis apexcharts-xaxis-inversed", rel: t3 }), l2 = r2.group({ class: "apexcharts-yaxis-texts-g apexcharts-xaxis-inversed-texts-g", transform: "translate(" + o2 + ", 0)" });
        n2.add(l2);
        var h2 = [];
        if (s2.config.yaxis[t3].show)
          for (var c2 = 0; c2 < this.xaxisLabels.length; c2++)
            h2.push(this.xaxisLabels[c2]);
        e2 = s2.globals.gridHeight / h2.length, i2 = -e2 / 2.2;
        var d2 = s2.globals.yLabelFormatters[0], g2 = s2.config.yaxis[0].labels;
        if (g2.show)
          for (var u2 = function(o3) {
            var n3 = void 0 === h2[o3] ? "" : h2[o3];
            n3 = d2(n3, { seriesIndex: t3, dataPointIndex: o3, w: s2 });
            var c3 = a2.axesUtils.getYAxisForeColor(g2.style.colors, t3), u3 = 0;
            Array.isArray(n3) && (u3 = n3.length / 2 * parseInt(g2.style.fontSize, 10));
            var p3 = r2.drawText({ x: g2.offsetX - 15, y: i2 + e2 + g2.offsetY - u3, text: n3, textAnchor: a2.yaxis.opposite ? "start" : "end", foreColor: Array.isArray(c3) ? c3[o3] : c3, fontSize: g2.style.fontSize, fontFamily: g2.style.fontFamily, fontWeight: g2.style.fontWeight, isPlainText: false, cssClass: "apexcharts-yaxis-label " + g2.style.cssClass });
            l2.add(p3);
            var f3 = document.createElementNS(s2.globals.SVGNS, "title");
            if (f3.textContent = Array.isArray(n3) ? n3.join(" ") : n3, p3.node.appendChild(f3), 0 !== s2.config.yaxis[t3].labels.rotate) {
              var x3 = r2.rotateAroundCenter(p3.node);
              p3.node.setAttribute("transform", "rotate(".concat(s2.config.yaxis[t3].labels.rotate, " 0 ").concat(x3.y, ")"));
            }
            i2 += e2;
          }, p2 = 0; p2 <= h2.length - 1; p2++)
            u2(p2);
        if (void 0 !== s2.config.yaxis[0].title.text) {
          var f2 = r2.group({ class: "apexcharts-yaxis-title apexcharts-xaxis-title-inversed", transform: "translate(" + o2 + ", 0)" }), x2 = r2.drawText({ x: 0, y: s2.globals.gridHeight / 2, text: s2.config.yaxis[0].title.text, textAnchor: "middle", foreColor: s2.config.yaxis[0].title.style.color, fontSize: s2.config.yaxis[0].title.style.fontSize, fontWeight: s2.config.yaxis[0].title.style.fontWeight, fontFamily: s2.config.yaxis[0].title.style.fontFamily, cssClass: "apexcharts-yaxis-title-text " + s2.config.yaxis[0].title.style.cssClass });
          f2.add(x2), n2.add(f2);
        }
        var v2 = 0;
        this.isCategoryBarHorizontal && s2.config.yaxis[0].opposite && (v2 = s2.globals.gridWidth);
        var m2 = s2.config.xaxis.axisBorder;
        if (m2.show) {
          var y2 = r2.drawLine(s2.globals.padHorizontal + m2.offsetX + v2, 1 + m2.offsetY, s2.globals.padHorizontal + m2.offsetX + v2, s2.globals.gridHeight + m2.offsetY, m2.color, 0);
          n2.add(y2);
        }
        return s2.config.yaxis[0].axisTicks.show && this.axesUtils.drawYAxisTicks(v2, h2.length, s2.config.yaxis[0].axisBorder, s2.config.yaxis[0].axisTicks, 0, e2, n2), n2;
      } }, { key: "drawXaxisTicks", value: function(t3, e2) {
        var i2 = this.w, a2 = t3;
        if (!(t3 < 0 || t3 - 2 > i2.globals.gridWidth)) {
          var s2 = this.offY + i2.config.xaxis.axisTicks.offsetY, r2 = s2 + i2.config.xaxis.axisTicks.height;
          if ("top" === i2.config.xaxis.position && (r2 = s2 - i2.config.xaxis.axisTicks.height), i2.config.xaxis.axisTicks.show) {
            var o2 = new b(this.ctx).drawLine(t3 + i2.config.xaxis.axisTicks.offsetX, s2 + i2.config.xaxis.offsetY, a2 + i2.config.xaxis.axisTicks.offsetX, r2 + i2.config.xaxis.offsetY, i2.config.xaxis.axisTicks.color);
            e2.add(o2), o2.node.classList.add("apexcharts-xaxis-tick");
          }
        }
      } }, { key: "getXAxisTicksPositions", value: function() {
        var t3 = this.w, e2 = [], i2 = this.xaxisLabels.length, a2 = t3.globals.padHorizontal;
        if (t3.globals.timescaleLabels.length > 0)
          for (var s2 = 0; s2 < i2; s2++)
            a2 = this.xaxisLabels[s2].position, e2.push(a2);
        else
          for (var r2 = i2, o2 = 0; o2 < r2; o2++) {
            var n2 = r2;
            t3.globals.isXNumeric && "bar" !== t3.config.chart.type && (n2 -= 1), a2 += t3.globals.gridWidth / n2, e2.push(a2);
          }
        return e2;
      } }, { key: "xAxisLabelCorrections", value: function() {
        var t3 = this.w, e2 = new b(this.ctx), i2 = t3.globals.dom.baseEl.querySelector(".apexcharts-xaxis-texts-g"), a2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-xaxis-texts-g text"), s2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-yaxis-inversed text"), r2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-xaxis-inversed-texts-g text tspan");
        if (t3.globals.rotateXLabels || t3.config.xaxis.labels.rotateAlways)
          for (var o2 = 0; o2 < a2.length; o2++) {
            var n2 = e2.rotateAroundCenter(a2[o2]);
            n2.y = n2.y - 1, n2.x = n2.x + 1, a2[o2].setAttribute("transform", "rotate(".concat(t3.config.xaxis.labels.rotate, " ").concat(n2.x, " ").concat(n2.y, ")")), a2[o2].setAttribute("text-anchor", "end");
            i2.setAttribute("transform", "translate(0, ".concat(-10, ")"));
            var l2 = a2[o2].childNodes;
            t3.config.xaxis.labels.trim && Array.prototype.forEach.call(l2, function(i3) {
              e2.placeTextWithEllipsis(i3, i3.textContent, t3.globals.xAxisLabelsHeight - ("bottom" === t3.config.legend.position ? 20 : 10));
            });
          }
        else
          !function() {
            for (var i3 = t3.globals.gridWidth / (t3.globals.labels.length + 1), s3 = 0; s3 < a2.length; s3++) {
              var r3 = a2[s3].childNodes;
              t3.config.xaxis.labels.trim && "datetime" !== t3.config.xaxis.type && Array.prototype.forEach.call(r3, function(t4) {
                e2.placeTextWithEllipsis(t4, t4.textContent, i3);
              });
            }
          }();
        if (s2.length > 0) {
          var h2 = s2[s2.length - 1].getBBox(), c2 = s2[0].getBBox();
          h2.x < -20 && s2[s2.length - 1].parentNode.removeChild(s2[s2.length - 1]), c2.x + c2.width > t3.globals.gridWidth && !t3.globals.isBarHorizontal && s2[0].parentNode.removeChild(s2[0]);
          for (var d2 = 0; d2 < r2.length; d2++)
            e2.placeTextWithEllipsis(r2[d2], r2[d2].textContent, t3.config.yaxis[0].labels.maxWidth - 2 * parseFloat(t3.config.yaxis[0].title.style.fontSize) - 20);
        }
      } }]), t2;
    }();
    var _ = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var i2 = this.w;
        this.xaxisLabels = i2.globals.labels.slice(), this.axesUtils = new B(e2), this.isTimelineBar = "datetime" === i2.config.xaxis.type && i2.globals.seriesRangeBarTimeline.length, i2.globals.timescaleLabels.length > 0 && (this.xaxisLabels = i2.globals.timescaleLabels.slice());
      }
      return r(t2, [{ key: "drawGridArea", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null, e2 = this.w, i2 = new b(this.ctx);
        null === t3 && (t3 = i2.group({ class: "apexcharts-grid" }));
        var a2 = i2.drawLine(e2.globals.padHorizontal, 1, e2.globals.padHorizontal, e2.globals.gridHeight, "transparent"), s2 = i2.drawLine(e2.globals.padHorizontal, e2.globals.gridHeight, e2.globals.gridWidth, e2.globals.gridHeight, "transparent");
        return t3.add(s2), t3.add(a2), t3;
      } }, { key: "drawGrid", value: function() {
        var t3 = null;
        return this.w.globals.axisCharts && (t3 = this.renderGrid(), this.drawGridArea(t3.el)), t3;
      } }, { key: "createGridMask", value: function() {
        var t3 = this.w, e2 = t3.globals, i2 = new b(this.ctx), a2 = Array.isArray(t3.config.stroke.width) ? 0 : t3.config.stroke.width;
        if (Array.isArray(t3.config.stroke.width)) {
          var s2 = 0;
          t3.config.stroke.width.forEach(function(t4) {
            s2 = Math.max(s2, t4);
          }), a2 = s2;
        }
        e2.dom.elGridRectMask = document.createElementNS(e2.SVGNS, "clipPath"), e2.dom.elGridRectMask.setAttribute("id", "gridRectMask".concat(e2.cuid)), e2.dom.elGridRectMarkerMask = document.createElementNS(e2.SVGNS, "clipPath"), e2.dom.elGridRectMarkerMask.setAttribute("id", "gridRectMarkerMask".concat(e2.cuid)), e2.dom.elForecastMask = document.createElementNS(e2.SVGNS, "clipPath"), e2.dom.elForecastMask.setAttribute("id", "forecastMask".concat(e2.cuid)), e2.dom.elNonForecastMask = document.createElementNS(e2.SVGNS, "clipPath"), e2.dom.elNonForecastMask.setAttribute("id", "nonForecastMask".concat(e2.cuid));
        var r2 = t3.config.chart.type, o2 = 0, n2 = 0;
        ("bar" === r2 || "rangeBar" === r2 || "candlestick" === r2 || "boxPlot" === r2 || t3.globals.comboBarCount > 0) && t3.globals.isXNumeric && !t3.globals.isBarHorizontal && (o2 = t3.config.grid.padding.left, n2 = t3.config.grid.padding.right, e2.barPadForNumericAxis > o2 && (o2 = e2.barPadForNumericAxis, n2 = e2.barPadForNumericAxis)), e2.dom.elGridRect = i2.drawRect(-a2 / 2 - o2 - 2, -a2 / 2, e2.gridWidth + a2 + n2 + o2 + 4, e2.gridHeight + a2, 0, "#fff"), new y(this).getLargestMarkerSize();
        var l2 = t3.globals.markers.largestSize + 1;
        e2.dom.elGridRectMarker = i2.drawRect(2 * -l2, 2 * -l2, e2.gridWidth + 4 * l2, e2.gridHeight + 4 * l2, 0, "#fff"), e2.dom.elGridRectMask.appendChild(e2.dom.elGridRect.node), e2.dom.elGridRectMarkerMask.appendChild(e2.dom.elGridRectMarker.node);
        var h2 = e2.dom.baseEl.querySelector("defs");
        h2.appendChild(e2.dom.elGridRectMask), h2.appendChild(e2.dom.elForecastMask), h2.appendChild(e2.dom.elNonForecastMask), h2.appendChild(e2.dom.elGridRectMarkerMask);
      } }, { key: "_drawGridLines", value: function(t3) {
        var e2 = t3.i, i2 = t3.x1, a2 = t3.y1, s2 = t3.x2, r2 = t3.y2, o2 = t3.xCount, n2 = t3.parent, l2 = this.w;
        0 === e2 && l2.globals.skipFirstTimelinelabel || e2 === o2 - 1 && l2.globals.skipLastTimelinelabel && !l2.config.xaxis.labels.formatter || "radar" === l2.config.chart.type || (l2.config.grid.xaxis.lines.show && this._drawGridLine({ x1: i2, y1: a2, x2: s2, y2: r2, parent: n2 }), new G(this.ctx).drawXaxisTicks(i2, this.elg));
      } }, { key: "_drawGridLine", value: function(t3) {
        var e2 = t3.x1, i2 = t3.y1, a2 = t3.x2, s2 = t3.y2, r2 = t3.parent, o2 = this.w, n2 = r2.node.classList.contains("apexcharts-gridlines-horizontal"), l2 = o2.config.grid.strokeDashArray, h2 = o2.globals.barPadForNumericAxis, c2 = new b(this).drawLine(e2 - (n2 ? h2 : 0), i2, a2 + (n2 ? h2 : 0), s2, o2.config.grid.borderColor, l2);
        c2.node.classList.add("apexcharts-gridline"), r2.add(c2);
      } }, { key: "_drawGridBandRect", value: function(t3) {
        var e2 = t3.c, i2 = t3.x1, a2 = t3.y1, s2 = t3.x2, r2 = t3.y2, o2 = t3.type, n2 = this.w, l2 = new b(this.ctx), h2 = n2.globals.barPadForNumericAxis;
        if ("column" !== o2 || "datetime" !== n2.config.xaxis.type) {
          var c2 = n2.config.grid[o2].colors[e2], d2 = l2.drawRect(i2 - ("row" === o2 ? h2 : 0), a2, s2 + ("row" === o2 ? 2 * h2 : 0), r2, 0, c2, n2.config.grid[o2].opacity);
          this.elg.add(d2), d2.attr("clip-path", "url(#gridRectMask".concat(n2.globals.cuid, ")")), d2.node.classList.add("apexcharts-grid-".concat(o2));
        }
      } }, { key: "_drawXYLines", value: function(t3) {
        var e2 = this, i2 = t3.xCount, a2 = t3.tickAmount, s2 = this.w;
        if (s2.config.grid.xaxis.lines.show || s2.config.xaxis.axisTicks.show) {
          var r2, o2 = s2.globals.padHorizontal, n2 = s2.globals.gridHeight;
          s2.globals.timescaleLabels.length ? function(t4) {
            for (var a3 = t4.xC, s3 = t4.x1, r3 = t4.y1, o3 = t4.x2, n3 = t4.y2, l3 = 0; l3 < a3; l3++)
              s3 = e2.xaxisLabels[l3].position, o3 = e2.xaxisLabels[l3].position, e2._drawGridLines({ i: l3, x1: s3, y1: r3, x2: o3, y2: n3, xCount: i2, parent: e2.elgridLinesV });
          }({ xC: i2, x1: o2, y1: 0, x2: r2, y2: n2 }) : (s2.globals.isXNumeric && (i2 = s2.globals.xAxisScale.result.length), s2.config.xaxis.convertedCatToNumeric && (i2 = s2.globals.xaxisLabelsCount), function(t4) {
            var a3 = t4.xC, r3 = t4.x1, o3 = t4.y1, n3 = t4.x2, l3 = t4.y2;
            if (void 0 !== s2.config.xaxis.tickAmount && "dataPoints" !== s2.config.xaxis.tickAmount)
              s2.globals.dom.baseEl.querySelectorAll(".apexcharts-text.apexcharts-xaxis-label tspan:not(:empty)").forEach(function(t5, a4) {
                var s3 = t5.getBBox();
                e2._drawGridLines({ i: a4, x1: s3.x + s3.width / 2, y1: o3, x2: s3.x + s3.width / 2, y2: l3, xCount: i2, parent: e2.elgridLinesV });
              });
            else
              for (var h3 = 0; h3 < a3 + (s2.globals.isXNumeric ? 0 : 1); h3++)
                0 === h3 && 1 === a3 && 1 === s2.globals.dataPoints && (n3 = r3 = s2.globals.gridWidth / 2), e2._drawGridLines({ i: h3, x1: r3, y1: o3, x2: n3, y2: l3, xCount: i2, parent: e2.elgridLinesV }), n3 = r3 += s2.globals.gridWidth / (s2.globals.isXNumeric ? a3 - 1 : a3);
          }({ xC: i2, x1: o2, y1: 0, x2: r2, y2: n2 }));
        }
        if (s2.config.grid.yaxis.lines.show) {
          var l2 = 0, h2 = 0, c2 = s2.globals.gridWidth, d2 = a2 + 1;
          this.isTimelineBar && (d2 = s2.globals.labels.length);
          for (var g2 = 0; g2 < d2 + (this.isTimelineBar ? 1 : 0); g2++)
            this._drawGridLine({ x1: 0, y1: l2, x2: c2, y2: h2, parent: this.elgridLinesH }), h2 = l2 += s2.globals.gridHeight / (this.isTimelineBar ? d2 : a2);
        }
      } }, { key: "_drawInvertedXYLines", value: function(t3) {
        var e2 = t3.xCount, i2 = this.w;
        if (i2.config.grid.xaxis.lines.show || i2.config.xaxis.axisTicks.show)
          for (var a2, s2 = i2.globals.padHorizontal, r2 = i2.globals.gridHeight, o2 = 0; o2 < e2 + 1; o2++) {
            i2.config.grid.xaxis.lines.show && this._drawGridLine({ x1: s2, y1: 0, x2: a2, y2: r2, parent: this.elgridLinesV }), new G(this.ctx).drawXaxisTicks(s2, this.elg), a2 = s2 = s2 + i2.globals.gridWidth / e2 + 0.3;
          }
        if (i2.config.grid.yaxis.lines.show)
          for (var n2 = 0, l2 = 0, h2 = i2.globals.gridWidth, c2 = 0; c2 < i2.globals.dataPoints + 1; c2++)
            this._drawGridLine({ x1: 0, y1: n2, x2: h2, y2: l2, parent: this.elgridLinesH }), l2 = n2 += i2.globals.gridHeight / i2.globals.dataPoints;
      } }, { key: "renderGrid", value: function() {
        var t3 = this.w, e2 = new b(this.ctx);
        this.elg = e2.group({ class: "apexcharts-grid" }), this.elgridLinesH = e2.group({ class: "apexcharts-gridlines-horizontal" }), this.elgridLinesV = e2.group({ class: "apexcharts-gridlines-vertical" }), this.elg.add(this.elgridLinesH), this.elg.add(this.elgridLinesV), t3.config.grid.show || (this.elgridLinesV.hide(), this.elgridLinesH.hide());
        for (var i2, a2 = t3.globals.yAxisScale.length ? t3.globals.yAxisScale[0].result.length - 1 : 5, s2 = 0; s2 < t3.globals.series.length && (void 0 !== t3.globals.yAxisScale[s2] && (a2 = t3.globals.yAxisScale[s2].result.length - 1), !(a2 > 2)); s2++)
          ;
        return !t3.globals.isBarHorizontal || this.isTimelineBar ? (i2 = this.xaxisLabels.length, this.isTimelineBar && (a2 = t3.globals.labels.length, t3.config.xaxis.tickAmount && t3.config.xaxis.labels.formatter && (i2 = t3.config.xaxis.tickAmount)), this._drawXYLines({ xCount: i2, tickAmount: a2 })) : (i2 = a2, a2 = t3.globals.xTickAmount, this._drawInvertedXYLines({ xCount: i2, tickAmount: a2 })), this.drawGridBands(i2, a2), { el: this.elg, xAxisTickWidth: t3.globals.gridWidth / i2 };
      } }, { key: "drawGridBands", value: function(t3, e2) {
        var i2 = this.w;
        if (void 0 !== i2.config.grid.row.colors && i2.config.grid.row.colors.length > 0)
          for (var a2 = 0, s2 = i2.globals.gridHeight / e2, r2 = i2.globals.gridWidth, o2 = 0, n2 = 0; o2 < e2; o2++, n2++)
            n2 >= i2.config.grid.row.colors.length && (n2 = 0), this._drawGridBandRect({ c: n2, x1: 0, y1: a2, x2: r2, y2: s2, type: "row" }), a2 += i2.globals.gridHeight / e2;
        if (void 0 !== i2.config.grid.column.colors && i2.config.grid.column.colors.length > 0)
          for (var l2 = i2.globals.isBarHorizontal || "category" !== i2.config.xaxis.type && !i2.config.xaxis.convertedCatToNumeric ? t3 : t3 - 1, h2 = i2.globals.padHorizontal, c2 = i2.globals.padHorizontal + i2.globals.gridWidth / l2, d2 = i2.globals.gridHeight, g2 = 0, u2 = 0; g2 < t3; g2++, u2++)
            u2 >= i2.config.grid.column.colors.length && (u2 = 0), this._drawGridBandRect({ c: u2, x1: h2, y1: 0, x2: c2, y2: d2, type: "column" }), h2 += i2.globals.gridWidth / l2;
      } }]), t2;
    }();
    var j = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "niceScale", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 10, a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 0, s2 = arguments.length > 4 ? arguments[4] : void 0, r2 = this.w, o2 = Math.abs(e2 - t3);
        if ("dataPoints" === (i2 = this._adjustTicksForSmallRange(i2, a2, o2)) && (i2 = r2.globals.dataPoints - 1), t3 === Number.MIN_VALUE && 0 === e2 || !p.isNumber(t3) && !p.isNumber(e2) || t3 === Number.MIN_VALUE && e2 === -Number.MAX_VALUE) {
          t3 = 0, e2 = i2;
          var n2 = this.linearScale(t3, e2, i2);
          return n2;
        }
        t3 > e2 ? (console.warn("axis.min cannot be greater than axis.max"), e2 = t3 + 0.1) : t3 === e2 && (t3 = 0 === t3 ? 0 : t3 - 0.5, e2 = 0 === e2 ? 2 : e2 + 0.5);
        var l2 = [];
        o2 < 1 && s2 && ("candlestick" === r2.config.chart.type || "candlestick" === r2.config.series[a2].type || "boxPlot" === r2.config.chart.type || "boxPlot" === r2.config.series[a2].type || r2.globals.isRangeData) && (e2 *= 1.01);
        var h2 = i2 + 1;
        h2 < 2 ? h2 = 2 : h2 > 2 && (h2 -= 2);
        var c2 = o2 / h2, d2 = Math.floor(p.log10(c2)), g2 = Math.pow(10, d2), u2 = Math.round(c2 / g2);
        u2 < 1 && (u2 = 1);
        var f2 = u2 * g2, x2 = f2 * Math.floor(t3 / f2), b2 = f2 * Math.ceil(e2 / f2), v2 = x2;
        if (s2 && o2 > 2) {
          for (; l2.push(v2), !((v2 += f2) > b2); )
            ;
          return { result: l2, niceMin: l2[0], niceMax: l2[l2.length - 1] };
        }
        var m2 = t3;
        (l2 = []).push(m2);
        for (var y2 = Math.abs(e2 - t3) / i2, w2 = 0; w2 <= i2; w2++)
          m2 += y2, l2.push(m2);
        return l2[l2.length - 2] >= e2 && l2.pop(), { result: l2, niceMin: l2[0], niceMax: l2[l2.length - 1] };
      } }, { key: "linearScale", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 10, a2 = arguments.length > 3 ? arguments[3] : void 0, s2 = Math.abs(e2 - t3);
        "dataPoints" === (i2 = this._adjustTicksForSmallRange(i2, a2, s2)) && (i2 = this.w.globals.dataPoints - 1);
        var r2 = s2 / i2;
        i2 === Number.MAX_VALUE && (i2 = 10, r2 = 1);
        for (var o2 = [], n2 = t3; i2 >= 0; )
          o2.push(n2), n2 += r2, i2 -= 1;
        return { result: o2, niceMin: o2[0], niceMax: o2[o2.length - 1] };
      } }, { key: "logarithmicScale", value: function(t3) {
        for (var e2 = [], i2 = Math.ceil(Math.log10(t3)) + 1, a2 = 0; a2 < i2; a2++)
          e2.push(Math.pow(10, a2));
        return { result: e2, niceMin: e2[0], niceMax: e2[e2.length - 1] };
      } }, { key: "_adjustTicksForSmallRange", value: function(t3, e2, i2) {
        var a2 = t3;
        if (void 0 !== e2 && this.w.config.yaxis[e2].labels.formatter && void 0 === this.w.config.yaxis[e2].tickAmount) {
          var s2 = this.w.config.yaxis[e2].labels.formatter(1);
          p.isNumber(Number(s2)) && !p.isFloat(s2) && (a2 = Math.ceil(i2));
        }
        return a2 < t3 ? a2 : t3;
      } }, { key: "setYScaleForIndex", value: function(t3, e2, i2) {
        var a2 = this.w.globals, s2 = this.w.config, r2 = a2.isBarHorizontal ? s2.xaxis : s2.yaxis[t3];
        void 0 === a2.yAxisScale[t3] && (a2.yAxisScale[t3] = []);
        var o2 = Math.abs(i2 - e2);
        if (r2.logarithmic && o2 <= 5 && (a2.invalidLogScale = true), r2.logarithmic && o2 > 5)
          a2.allSeriesCollapsed = false, a2.yAxisScale[t3] = this.logarithmicScale(i2);
        else if (i2 !== -Number.MAX_VALUE && p.isNumber(i2))
          if (a2.allSeriesCollapsed = false, void 0 === r2.min && void 0 === r2.max || r2.forceNiceScale) {
            var n2 = void 0 === s2.yaxis[t3].max && void 0 === s2.yaxis[t3].min || s2.yaxis[t3].forceNiceScale;
            a2.yAxisScale[t3] = this.niceScale(e2, i2, r2.tickAmount ? r2.tickAmount : o2 < 5 && o2 > 1 ? o2 + 1 : 5, t3, n2);
          } else
            a2.yAxisScale[t3] = this.linearScale(e2, i2, r2.tickAmount, t3);
        else
          a2.yAxisScale[t3] = this.linearScale(0, 5, 5);
      } }, { key: "setXScale", value: function(t3, e2) {
        var i2 = this.w, a2 = i2.globals, s2 = i2.config.xaxis, r2 = Math.abs(e2 - t3);
        return e2 !== -Number.MAX_VALUE && p.isNumber(e2) ? a2.xAxisScale = this.linearScale(t3, e2, s2.tickAmount ? s2.tickAmount : r2 < 5 && r2 > 1 ? r2 + 1 : 5, 0) : a2.xAxisScale = this.linearScale(0, 5, 5), a2.xAxisScale;
      } }, { key: "setMultipleYScales", value: function() {
        var t3 = this, e2 = this.w.globals, i2 = this.w.config, a2 = e2.minYArr.concat([]), s2 = e2.maxYArr.concat([]), r2 = [];
        i2.yaxis.forEach(function(e3, o2) {
          var n2 = o2;
          i2.series.forEach(function(t4, i3) {
            t4.name === e3.seriesName && (n2 = i3, o2 !== i3 ? r2.push({ index: i3, similarIndex: o2, alreadyExists: true }) : r2.push({ index: i3 }));
          });
          var l2 = a2[n2], h2 = s2[n2];
          t3.setYScaleForIndex(o2, l2, h2);
        }), this.sameScaleInMultipleAxes(a2, s2, r2);
      } }, { key: "sameScaleInMultipleAxes", value: function(t3, e2, i2) {
        var a2 = this, s2 = this.w.config, r2 = this.w.globals, o2 = [];
        i2.forEach(function(t4) {
          t4.alreadyExists && (void 0 === o2[t4.index] && (o2[t4.index] = []), o2[t4.index].push(t4.index), o2[t4.index].push(t4.similarIndex));
        }), r2.yAxisSameScaleIndices = o2, o2.forEach(function(t4, e3) {
          o2.forEach(function(i3, a3) {
            var s3, r3;
            e3 !== a3 && (s3 = t4, r3 = i3, s3.filter(function(t5) {
              return -1 !== r3.indexOf(t5);
            })).length > 0 && (o2[e3] = o2[e3].concat(o2[a3]));
          });
        });
        var n2 = o2.map(function(t4) {
          return t4.filter(function(e3, i3) {
            return t4.indexOf(e3) === i3;
          });
        }).map(function(t4) {
          return t4.sort();
        });
        o2 = o2.filter(function(t4) {
          return !!t4;
        });
        var l2 = n2.slice(), h2 = l2.map(function(t4) {
          return JSON.stringify(t4);
        });
        l2 = l2.filter(function(t4, e3) {
          return h2.indexOf(JSON.stringify(t4)) === e3;
        });
        var c2 = [], d2 = [];
        t3.forEach(function(t4, i3) {
          l2.forEach(function(a3, s3) {
            a3.indexOf(i3) > -1 && (void 0 === c2[s3] && (c2[s3] = [], d2[s3] = []), c2[s3].push({ key: i3, value: t4 }), d2[s3].push({ key: i3, value: e2[i3] }));
          });
        });
        var g2 = Array.apply(null, Array(l2.length)).map(Number.prototype.valueOf, Number.MIN_VALUE), u2 = Array.apply(null, Array(l2.length)).map(Number.prototype.valueOf, -Number.MAX_VALUE);
        c2.forEach(function(t4, e3) {
          t4.forEach(function(t5, i3) {
            g2[e3] = Math.min(t5.value, g2[e3]);
          });
        }), d2.forEach(function(t4, e3) {
          t4.forEach(function(t5, i3) {
            u2[e3] = Math.max(t5.value, u2[e3]);
          });
        }), t3.forEach(function(t4, e3) {
          d2.forEach(function(t5, i3) {
            var o3 = g2[i3], n3 = u2[i3];
            s2.chart.stacked && (n3 = 0, t5.forEach(function(t6, e4) {
              t6.value !== -Number.MAX_VALUE && (n3 += t6.value), o3 !== Number.MIN_VALUE && (o3 += c2[i3][e4].value);
            })), t5.forEach(function(i4, l3) {
              t5[l3].key === e3 && (void 0 !== s2.yaxis[e3].min && (o3 = "function" == typeof s2.yaxis[e3].min ? s2.yaxis[e3].min(r2.minY) : s2.yaxis[e3].min), void 0 !== s2.yaxis[e3].max && (n3 = "function" == typeof s2.yaxis[e3].max ? s2.yaxis[e3].max(r2.maxY) : s2.yaxis[e3].max), a2.setYScaleForIndex(e3, o3, n3));
            });
          });
        });
      } }, { key: "autoScaleY", value: function(t3, e2, i2) {
        t3 || (t3 = this);
        var a2 = t3.w;
        if (a2.globals.isMultipleYAxis || a2.globals.collapsedSeries.length)
          return console.warn("autoScaleYaxis is not supported in a multi-yaxis chart."), e2;
        var s2 = a2.globals.seriesX[0], r2 = a2.config.chart.stacked;
        return e2.forEach(function(t4, o2) {
          for (var n2 = 0, l2 = 0; l2 < s2.length; l2++)
            if (s2[l2] >= i2.xaxis.min) {
              n2 = l2;
              break;
            }
          var h2, c2, d2 = a2.globals.minYArr[o2], g2 = a2.globals.maxYArr[o2], u2 = a2.globals.stackedSeriesTotals;
          a2.globals.series.forEach(function(o3, l3) {
            var p2 = o3[n2];
            r2 ? (p2 = u2[n2], h2 = c2 = p2, u2.forEach(function(t5, e3) {
              s2[e3] <= i2.xaxis.max && s2[e3] >= i2.xaxis.min && (t5 > c2 && null !== t5 && (c2 = t5), o3[e3] < h2 && null !== o3[e3] && (h2 = o3[e3]));
            })) : (h2 = c2 = p2, o3.forEach(function(t5, e3) {
              if (s2[e3] <= i2.xaxis.max && s2[e3] >= i2.xaxis.min) {
                var r3 = t5, o4 = t5;
                a2.globals.series.forEach(function(i3, a3) {
                  null !== t5 && (r3 = Math.min(i3[e3], r3), o4 = Math.max(i3[e3], o4));
                }), o4 > c2 && null !== o4 && (c2 = o4), r3 < h2 && null !== r3 && (h2 = r3);
              }
            })), void 0 === h2 && void 0 === c2 && (h2 = d2, c2 = g2), (c2 *= c2 < 0 ? 0.9 : 1.1) < 0 && c2 < g2 && (c2 = g2), (h2 *= h2 < 0 ? 1.1 : 0.9) < 0 && h2 > d2 && (h2 = d2), e2.length > 1 ? (e2[l3].min = void 0 === t4.min ? h2 : t4.min, e2[l3].max = void 0 === t4.max ? c2 : t4.max) : (e2[0].min = void 0 === t4.min ? h2 : t4.min, e2[0].max = void 0 === t4.max ? c2 : t4.max);
          });
        }), e2;
      } }]), t2;
    }();
    var U = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.scales = new j(e2);
      }
      return r(t2, [{ key: "init", value: function() {
        this.setYRange(), this.setXRange(), this.setZRange();
      } }, { key: "getMinYMaxY", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : Number.MAX_VALUE, i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : -Number.MAX_VALUE, a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null, s2 = this.w.config, r2 = this.w.globals, o2 = -Number.MAX_VALUE, n2 = Number.MIN_VALUE;
        null === a2 && (a2 = t3 + 1);
        var l2 = r2.series, h2 = l2, c2 = l2;
        "candlestick" === s2.chart.type ? (h2 = r2.seriesCandleL, c2 = r2.seriesCandleH) : "boxPlot" === s2.chart.type ? (h2 = r2.seriesCandleO, c2 = r2.seriesCandleC) : r2.isRangeData && (h2 = r2.seriesRangeStart, c2 = r2.seriesRangeEnd);
        for (var d2 = t3; d2 < a2; d2++) {
          r2.dataPoints = Math.max(r2.dataPoints, l2[d2].length);
          for (var g2 = 0; g2 < r2.series[d2].length; g2++) {
            var u2 = l2[d2][g2];
            null !== u2 && p.isNumber(u2) ? (void 0 !== c2[d2][g2] && (o2 = Math.max(o2, c2[d2][g2])), void 0 !== h2[d2][g2] && (e2 = Math.min(e2, h2[d2][g2]), i2 = Math.max(i2, h2[d2][g2])), "candlestick" !== this.w.config.chart.type && "boxPlot" !== this.w.config.chart.type || (void 0 !== r2.seriesCandleC[d2][g2] && (o2 = Math.max(o2, r2.seriesCandleO[d2][g2]), o2 = Math.max(o2, r2.seriesCandleH[d2][g2]), o2 = Math.max(o2, r2.seriesCandleL[d2][g2]), o2 = Math.max(o2, r2.seriesCandleC[d2][g2]), "boxPlot" === this.w.config.chart.type && (o2 = Math.max(o2, r2.seriesCandleM[d2][g2]))), !s2.series[d2].type || "candlestick" === s2.series[d2].type && "boxPlot" === s2.series[d2].type || (o2 = Math.max(o2, r2.series[d2][g2]), e2 = Math.min(e2, r2.series[d2][g2])), i2 = o2), r2.seriesGoals[d2] && r2.seriesGoals[d2][g2] && Array.isArray(r2.seriesGoals[d2][g2]) && r2.seriesGoals[d2][g2].forEach(function(t4) {
              n2 !== Number.MIN_VALUE && (n2 = Math.min(n2, t4.value), e2 = n2), o2 = Math.max(o2, t4.value), i2 = o2;
            }), p.isFloat(u2) && (u2 = p.noExponents(u2), r2.yValueDecimal = Math.max(r2.yValueDecimal, u2.toString().split(".")[1].length)), n2 > h2[d2][g2] && h2[d2][g2] < 0 && (n2 = h2[d2][g2])) : r2.hasNullValues = true;
          }
        }
        return "rangeBar" === s2.chart.type && r2.seriesRangeStart.length && r2.isBarHorizontal && "datetime" === s2.xaxis.type && (n2 = e2), "bar" === s2.chart.type && (n2 < 0 && o2 < 0 && (o2 = 0), n2 === Number.MIN_VALUE && (n2 = 0)), { minY: n2, maxY: o2, lowestY: e2, highestY: i2 };
      } }, { key: "setYRange", value: function() {
        var t3 = this.w.globals, e2 = this.w.config;
        t3.maxY = -Number.MAX_VALUE, t3.minY = Number.MIN_VALUE;
        var i2 = Number.MAX_VALUE;
        if (t3.isMultipleYAxis)
          for (var a2 = 0; a2 < t3.series.length; a2++) {
            var s2 = this.getMinYMaxY(a2, i2, null, a2 + 1);
            t3.minYArr.push(s2.minY), t3.maxYArr.push(s2.maxY), i2 = s2.lowestY;
          }
        var r2 = this.getMinYMaxY(0, i2, null, t3.series.length);
        if (t3.minY = r2.minY, t3.maxY = r2.maxY, i2 = r2.lowestY, e2.chart.stacked && this._setStackedMinMax(), ("line" === e2.chart.type || "area" === e2.chart.type || "candlestick" === e2.chart.type || "boxPlot" === e2.chart.type || "rangeBar" === e2.chart.type && !t3.isBarHorizontal) && t3.minY === Number.MIN_VALUE && i2 !== -Number.MAX_VALUE && i2 !== t3.maxY) {
          var o2 = t3.maxY - i2;
          (i2 >= 0 && i2 <= 10 || void 0 !== e2.yaxis[0].min || void 0 !== e2.yaxis[0].max) && (o2 = 0), t3.minY = i2 - 5 * o2 / 100, i2 > 0 && t3.minY < 0 && (t3.minY = 0), t3.maxY = t3.maxY + 5 * o2 / 100;
        }
        if (e2.yaxis.forEach(function(e3, i3) {
          void 0 !== e3.max && ("number" == typeof e3.max ? t3.maxYArr[i3] = e3.max : "function" == typeof e3.max && (t3.maxYArr[i3] = e3.max(t3.isMultipleYAxis ? t3.maxYArr[i3] : t3.maxY)), t3.maxY = t3.maxYArr[i3]), void 0 !== e3.min && ("number" == typeof e3.min ? t3.minYArr[i3] = e3.min : "function" == typeof e3.min && (t3.minYArr[i3] = e3.min(t3.isMultipleYAxis ? t3.minYArr[i3] === Number.MIN_VALUE ? 0 : t3.minYArr[i3] : t3.minY)), t3.minY = t3.minYArr[i3]);
        }), t3.isBarHorizontal) {
          ["min", "max"].forEach(function(i3) {
            void 0 !== e2.xaxis[i3] && "number" == typeof e2.xaxis[i3] && ("min" === i3 ? t3.minY = e2.xaxis[i3] : t3.maxY = e2.xaxis[i3]);
          });
        }
        return t3.isMultipleYAxis ? (this.scales.setMultipleYScales(), t3.minY = i2, t3.yAxisScale.forEach(function(e3, i3) {
          t3.minYArr[i3] = e3.niceMin, t3.maxYArr[i3] = e3.niceMax;
        })) : (this.scales.setYScaleForIndex(0, t3.minY, t3.maxY), t3.minY = t3.yAxisScale[0].niceMin, t3.maxY = t3.yAxisScale[0].niceMax, t3.minYArr[0] = t3.yAxisScale[0].niceMin, t3.maxYArr[0] = t3.yAxisScale[0].niceMax), { minY: t3.minY, maxY: t3.maxY, minYArr: t3.minYArr, maxYArr: t3.maxYArr, yAxisScale: t3.yAxisScale };
      } }, { key: "setXRange", value: function() {
        var t3 = this.w.globals, e2 = this.w.config, i2 = "numeric" === e2.xaxis.type || "datetime" === e2.xaxis.type || "category" === e2.xaxis.type && !t3.noLabelsProvided || t3.noLabelsProvided || t3.isXNumeric;
        if (t3.isXNumeric && function() {
          for (var e3 = 0; e3 < t3.series.length; e3++)
            if (t3.labels[e3])
              for (var i3 = 0; i3 < t3.labels[e3].length; i3++)
                null !== t3.labels[e3][i3] && p.isNumber(t3.labels[e3][i3]) && (t3.maxX = Math.max(t3.maxX, t3.labels[e3][i3]), t3.initialMaxX = Math.max(t3.maxX, t3.labels[e3][i3]), t3.minX = Math.min(t3.minX, t3.labels[e3][i3]), t3.initialMinX = Math.min(t3.minX, t3.labels[e3][i3]));
        }(), t3.noLabelsProvided && 0 === e2.xaxis.categories.length && (t3.maxX = t3.labels[t3.labels.length - 1], t3.initialMaxX = t3.labels[t3.labels.length - 1], t3.minX = 1, t3.initialMinX = 1), t3.isXNumeric || t3.noLabelsProvided || t3.dataFormatXNumeric) {
          var a2;
          if (void 0 === e2.xaxis.tickAmount ? (a2 = Math.round(t3.svgWidth / 150), "numeric" === e2.xaxis.type && t3.dataPoints < 30 && (a2 = t3.dataPoints - 1), a2 > t3.dataPoints && 0 !== t3.dataPoints && (a2 = t3.dataPoints - 1)) : "dataPoints" === e2.xaxis.tickAmount ? (t3.series.length > 1 && (a2 = t3.series[t3.maxValsInArrayIndex].length - 1), t3.isXNumeric && (a2 = t3.maxX - t3.minX - 1)) : a2 = e2.xaxis.tickAmount, t3.xTickAmount = a2, void 0 !== e2.xaxis.max && "number" == typeof e2.xaxis.max && (t3.maxX = e2.xaxis.max), void 0 !== e2.xaxis.min && "number" == typeof e2.xaxis.min && (t3.minX = e2.xaxis.min), void 0 !== e2.xaxis.range && (t3.minX = t3.maxX - e2.xaxis.range), t3.minX !== Number.MAX_VALUE && t3.maxX !== -Number.MAX_VALUE)
            if (e2.xaxis.convertedCatToNumeric && !t3.dataFormatXNumeric) {
              for (var s2 = [], r2 = t3.minX - 1; r2 < t3.maxX; r2++)
                s2.push(r2 + 1);
              t3.xAxisScale = { result: s2, niceMin: s2[0], niceMax: s2[s2.length - 1] };
            } else
              t3.xAxisScale = this.scales.setXScale(t3.minX, t3.maxX);
          else
            t3.xAxisScale = this.scales.linearScale(1, a2, a2), t3.noLabelsProvided && t3.labels.length > 0 && (t3.xAxisScale = this.scales.linearScale(1, t3.labels.length, a2 - 1), t3.seriesX = t3.labels.slice());
          i2 && (t3.labels = t3.xAxisScale.result.slice());
        }
        return t3.isBarHorizontal && t3.labels.length && (t3.xTickAmount = t3.labels.length), this._handleSingleDataPoint(), this._getMinXDiff(), { minX: t3.minX, maxX: t3.maxX };
      } }, { key: "setZRange", value: function() {
        var t3 = this.w.globals;
        if (t3.isDataXYZ) {
          for (var e2 = 0; e2 < t3.series.length; e2++)
            if (void 0 !== t3.seriesZ[e2])
              for (var i2 = 0; i2 < t3.seriesZ[e2].length; i2++)
                null !== t3.seriesZ[e2][i2] && p.isNumber(t3.seriesZ[e2][i2]) && (t3.maxZ = Math.max(t3.maxZ, t3.seriesZ[e2][i2]), t3.minZ = Math.min(t3.minZ, t3.seriesZ[e2][i2]));
        }
      } }, { key: "_handleSingleDataPoint", value: function() {
        var t3 = this.w.globals, e2 = this.w.config;
        if (t3.minX === t3.maxX) {
          var i2 = new Y(this.ctx);
          if ("datetime" === e2.xaxis.type) {
            var a2 = i2.getDate(t3.minX);
            a2.setUTCDate(a2.getDate() - 2), t3.minX = new Date(a2).getTime();
            var s2 = i2.getDate(t3.maxX);
            s2.setUTCDate(s2.getDate() + 2), t3.maxX = new Date(s2).getTime();
          } else
            ("numeric" === e2.xaxis.type || "category" === e2.xaxis.type && !t3.noLabelsProvided) && (t3.minX = t3.minX - 2, t3.initialMinX = t3.minX, t3.maxX = t3.maxX + 2, t3.initialMaxX = t3.maxX);
        }
      } }, { key: "_getMinXDiff", value: function() {
        var t3 = this.w.globals;
        t3.isXNumeric && t3.seriesX.forEach(function(e2, i2) {
          1 === e2.length && e2.push(t3.seriesX[t3.maxValsInArrayIndex][t3.seriesX[t3.maxValsInArrayIndex].length - 1]);
          var a2 = e2.slice();
          a2.sort(function(t4, e3) {
            return t4 - e3;
          }), a2.forEach(function(e3, i3) {
            if (i3 > 0) {
              var s2 = e3 - a2[i3 - 1];
              s2 > 0 && (t3.minXDiff = Math.min(s2, t3.minXDiff));
            }
          }), 1 === t3.dataPoints && t3.minXDiff === Number.MAX_VALUE && (t3.minXDiff = 0.5);
        });
      } }, { key: "_setStackedMinMax", value: function() {
        var t3 = this.w.globals, e2 = [], i2 = [];
        if (t3.series.length)
          for (var a2 = 0; a2 < t3.series[t3.maxValsInArrayIndex].length; a2++)
            for (var s2 = 0, r2 = 0, o2 = 0; o2 < t3.series.length; o2++)
              null !== t3.series[o2][a2] && p.isNumber(t3.series[o2][a2]) && (t3.series[o2][a2] > 0 ? s2 = s2 + parseFloat(t3.series[o2][a2]) + 1e-4 : r2 += parseFloat(t3.series[o2][a2])), o2 === t3.series.length - 1 && (e2.push(s2), i2.push(r2));
        for (var n2 = 0; n2 < e2.length; n2++)
          t3.maxY = Math.max(t3.maxY, e2[n2]), t3.minY = Math.min(t3.minY, i2[n2]);
      } }]), t2;
    }();
    var q = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var i2 = this.w;
        this.xaxisFontSize = i2.config.xaxis.labels.style.fontSize, this.axisFontFamily = i2.config.xaxis.labels.style.fontFamily, this.xaxisForeColors = i2.config.xaxis.labels.style.colors, this.isCategoryBarHorizontal = "bar" === i2.config.chart.type && i2.config.plotOptions.bar.horizontal, this.xAxisoffX = 0, "bottom" === i2.config.xaxis.position && (this.xAxisoffX = i2.globals.gridHeight), this.drawnLabels = [], this.axesUtils = new B(e2);
      }
      return r(t2, [{ key: "drawYaxis", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = new b(this.ctx), s2 = i2.config.yaxis[t3].labels.style, r2 = s2.fontSize, o2 = s2.fontFamily, n2 = s2.fontWeight, l2 = a2.group({ class: "apexcharts-yaxis", rel: t3, transform: "translate(" + i2.globals.translateYAxisX[t3] + ", 0)" });
        if (this.axesUtils.isYAxisHidden(t3))
          return l2;
        var h2 = a2.group({ class: "apexcharts-yaxis-texts-g" });
        l2.add(h2);
        var c2 = i2.globals.yAxisScale[t3].result.length - 1, d2 = i2.globals.gridHeight / c2, g2 = i2.globals.translateY, u2 = i2.globals.yLabelFormatters[t3], p2 = i2.globals.yAxisScale[t3].result.slice();
        p2 = this.axesUtils.checkForReversedLabels(t3, p2);
        var f2 = "";
        if (i2.config.yaxis[t3].labels.show)
          for (var x2 = function(l3) {
            var x3 = p2[l3];
            x3 = u2(x3, l3, i2);
            var b2 = i2.config.yaxis[t3].labels.padding;
            i2.config.yaxis[t3].opposite && 0 !== i2.config.yaxis.length && (b2 *= -1);
            var v3 = e2.axesUtils.getYAxisForeColor(s2.colors, t3), m3 = a2.drawText({ x: b2, y: g2 + c2 / 10 + i2.config.yaxis[t3].labels.offsetY + 1, text: x3, textAnchor: i2.config.yaxis[t3].opposite ? "start" : "end", fontSize: r2, fontFamily: o2, fontWeight: n2, foreColor: Array.isArray(v3) ? v3[l3] : v3, isPlainText: false, cssClass: "apexcharts-yaxis-label " + s2.cssClass });
            l3 === c2 && (f2 = m3), h2.add(m3);
            var y3 = document.createElementNS(i2.globals.SVGNS, "title");
            if (y3.textContent = Array.isArray(x3) ? x3.join(" ") : x3, m3.node.appendChild(y3), 0 !== i2.config.yaxis[t3].labels.rotate) {
              var w3 = a2.rotateAroundCenter(f2.node), k3 = a2.rotateAroundCenter(m3.node);
              m3.node.setAttribute("transform", "rotate(".concat(i2.config.yaxis[t3].labels.rotate, " ").concat(w3.x, " ").concat(k3.y, ")"));
            }
            g2 += d2;
          }, v2 = c2; v2 >= 0; v2--)
            x2(v2);
        if (void 0 !== i2.config.yaxis[t3].title.text) {
          var m2 = a2.group({ class: "apexcharts-yaxis-title" }), y2 = 0;
          i2.config.yaxis[t3].opposite && (y2 = i2.globals.translateYAxisX[t3]);
          var w2 = a2.drawText({ x: y2, y: i2.globals.gridHeight / 2 + i2.globals.translateY + i2.config.yaxis[t3].title.offsetY, text: i2.config.yaxis[t3].title.text, textAnchor: "end", foreColor: i2.config.yaxis[t3].title.style.color, fontSize: i2.config.yaxis[t3].title.style.fontSize, fontWeight: i2.config.yaxis[t3].title.style.fontWeight, fontFamily: i2.config.yaxis[t3].title.style.fontFamily, cssClass: "apexcharts-yaxis-title-text " + i2.config.yaxis[t3].title.style.cssClass });
          m2.add(w2), l2.add(m2);
        }
        var k2 = i2.config.yaxis[t3].axisBorder, A2 = 31 + k2.offsetX;
        if (i2.config.yaxis[t3].opposite && (A2 = -31 - k2.offsetX), k2.show) {
          var S2 = a2.drawLine(A2, i2.globals.translateY + k2.offsetY - 2, A2, i2.globals.gridHeight + i2.globals.translateY + k2.offsetY + 2, k2.color, 0, k2.width);
          l2.add(S2);
        }
        return i2.config.yaxis[t3].axisTicks.show && this.axesUtils.drawYAxisTicks(A2, c2, k2, i2.config.yaxis[t3].axisTicks, t3, d2, l2), l2;
      } }, { key: "drawYaxisInversed", value: function(t3) {
        var e2 = this.w, i2 = new b(this.ctx), a2 = i2.group({ class: "apexcharts-xaxis apexcharts-yaxis-inversed" }), s2 = i2.group({ class: "apexcharts-xaxis-texts-g", transform: "translate(".concat(e2.globals.translateXAxisX, ", ").concat(e2.globals.translateXAxisY, ")") });
        a2.add(s2);
        var r2 = e2.globals.yAxisScale[t3].result.length - 1, o2 = e2.globals.gridWidth / r2 + 0.1, n2 = o2 + e2.config.xaxis.labels.offsetX, l2 = e2.globals.xLabelFormatter, h2 = e2.globals.yAxisScale[t3].result.slice(), c2 = e2.globals.timescaleLabels;
        c2.length > 0 && (this.xaxisLabels = c2.slice(), r2 = (h2 = c2.slice()).length), h2 = this.axesUtils.checkForReversedLabels(t3, h2);
        var d2 = c2.length;
        if (e2.config.xaxis.labels.show)
          for (var g2 = d2 ? 0 : r2; d2 ? g2 < d2 : g2 >= 0; d2 ? g2++ : g2--) {
            var u2 = h2[g2];
            u2 = l2(u2, g2, e2);
            var p2 = e2.globals.gridWidth + e2.globals.padHorizontal - (n2 - o2 + e2.config.xaxis.labels.offsetX);
            if (c2.length) {
              var f2 = this.axesUtils.getLabel(h2, c2, p2, g2, this.drawnLabels, this.xaxisFontSize);
              p2 = f2.x, u2 = f2.text, this.drawnLabels.push(f2.text), 0 === g2 && e2.globals.skipFirstTimelinelabel && (u2 = ""), g2 === h2.length - 1 && e2.globals.skipLastTimelinelabel && (u2 = "");
            }
            var x2 = i2.drawText({ x: p2, y: this.xAxisoffX + e2.config.xaxis.labels.offsetY + 30 - ("top" === e2.config.xaxis.position ? e2.globals.xAxisHeight + e2.config.xaxis.axisTicks.height - 2 : 0), text: u2, textAnchor: "middle", foreColor: Array.isArray(this.xaxisForeColors) ? this.xaxisForeColors[t3] : this.xaxisForeColors, fontSize: this.xaxisFontSize, fontFamily: this.xaxisFontFamily, fontWeight: e2.config.xaxis.labels.style.fontWeight, isPlainText: false, cssClass: "apexcharts-xaxis-label " + e2.config.xaxis.labels.style.cssClass });
            s2.add(x2), x2.tspan(u2);
            var v2 = document.createElementNS(e2.globals.SVGNS, "title");
            v2.textContent = u2, x2.node.appendChild(v2), n2 += o2;
          }
        return this.inversedYAxisTitleText(a2), this.inversedYAxisBorder(a2), a2;
      } }, { key: "inversedYAxisBorder", value: function(t3) {
        var e2 = this.w, i2 = new b(this.ctx), a2 = e2.config.xaxis.axisBorder;
        if (a2.show) {
          var s2 = 0;
          "bar" === e2.config.chart.type && e2.globals.isXNumeric && (s2 -= 15);
          var r2 = i2.drawLine(e2.globals.padHorizontal + s2 + a2.offsetX, this.xAxisoffX, e2.globals.gridWidth, this.xAxisoffX, a2.color, 0, a2.height);
          t3.add(r2);
        }
      } }, { key: "inversedYAxisTitleText", value: function(t3) {
        var e2 = this.w, i2 = new b(this.ctx);
        if (void 0 !== e2.config.xaxis.title.text) {
          var a2 = i2.group({ class: "apexcharts-xaxis-title apexcharts-yaxis-title-inversed" }), s2 = i2.drawText({ x: e2.globals.gridWidth / 2 + e2.config.xaxis.title.offsetX, y: this.xAxisoffX + parseFloat(this.xaxisFontSize) + parseFloat(e2.config.xaxis.title.style.fontSize) + e2.config.xaxis.title.offsetY + 20, text: e2.config.xaxis.title.text, textAnchor: "middle", fontSize: e2.config.xaxis.title.style.fontSize, fontFamily: e2.config.xaxis.title.style.fontFamily, fontWeight: e2.config.xaxis.title.style.fontWeight, foreColor: e2.config.xaxis.title.style.color, cssClass: "apexcharts-xaxis-title-text " + e2.config.xaxis.title.style.cssClass });
          a2.add(s2), t3.add(a2);
        }
      } }, { key: "yAxisTitleRotate", value: function(t3, e2) {
        var i2 = this.w, a2 = new b(this.ctx), s2 = { width: 0, height: 0 }, r2 = { width: 0, height: 0 }, o2 = i2.globals.dom.baseEl.querySelector(" .apexcharts-yaxis[rel='".concat(t3, "'] .apexcharts-yaxis-texts-g"));
        null !== o2 && (s2 = o2.getBoundingClientRect());
        var n2 = i2.globals.dom.baseEl.querySelector(".apexcharts-yaxis[rel='".concat(t3, "'] .apexcharts-yaxis-title text"));
        if (null !== n2 && (r2 = n2.getBoundingClientRect()), null !== n2) {
          var l2 = this.xPaddingForYAxisTitle(t3, s2, r2, e2);
          n2.setAttribute("x", l2.xPos - (e2 ? 10 : 0));
        }
        if (null !== n2) {
          var h2 = a2.rotateAroundCenter(n2);
          n2.setAttribute("transform", "rotate(".concat(e2 ? -1 * i2.config.yaxis[t3].title.rotate : i2.config.yaxis[t3].title.rotate, " ").concat(h2.x, " ").concat(h2.y, ")"));
        }
      } }, { key: "xPaddingForYAxisTitle", value: function(t3, e2, i2, a2) {
        var s2 = this.w, r2 = 0, o2 = 0, n2 = 10;
        return void 0 === s2.config.yaxis[t3].title.text || t3 < 0 ? { xPos: o2, padd: 0 } : (a2 ? (o2 = e2.width + s2.config.yaxis[t3].title.offsetX + i2.width / 2 + n2 / 2, 0 === (r2 += 1) && (o2 -= n2 / 2)) : (o2 = -1 * e2.width + s2.config.yaxis[t3].title.offsetX + n2 / 2 + i2.width / 2, s2.globals.isBarHorizontal && (n2 = 25, o2 = -1 * e2.width - s2.config.yaxis[t3].title.offsetX - n2)), { xPos: o2, padd: n2 });
      } }, { key: "setYAxisXPosition", value: function(t3, e2) {
        var i2 = this.w, a2 = 0, s2 = 0, r2 = 18, o2 = 1;
        i2.config.yaxis.length > 1 && (this.multipleYs = true), i2.config.yaxis.map(function(n2, l2) {
          var h2 = i2.globals.ignoreYAxisIndexes.indexOf(l2) > -1 || !n2.show || n2.floating || 0 === t3[l2].width, c2 = t3[l2].width + e2[l2].width;
          n2.opposite ? i2.globals.isBarHorizontal ? (s2 = i2.globals.gridWidth + i2.globals.translateX - 1, i2.globals.translateYAxisX[l2] = s2 - n2.labels.offsetX) : (s2 = i2.globals.gridWidth + i2.globals.translateX + o2, h2 || (o2 = o2 + c2 + 20), i2.globals.translateYAxisX[l2] = s2 - n2.labels.offsetX + 20) : (a2 = i2.globals.translateX - r2, h2 || (r2 = r2 + c2 + 20), i2.globals.translateYAxisX[l2] = a2 + n2.labels.offsetX);
        });
      } }, { key: "setYAxisTextAlignments", value: function() {
        var t3 = this.w, e2 = t3.globals.dom.baseEl.getElementsByClassName("apexcharts-yaxis");
        (e2 = p.listToArray(e2)).forEach(function(e3, i2) {
          var a2 = t3.config.yaxis[i2];
          if (a2 && void 0 !== a2.labels.align) {
            var s2 = t3.globals.dom.baseEl.querySelector(".apexcharts-yaxis[rel='".concat(i2, "'] .apexcharts-yaxis-texts-g")), r2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-yaxis[rel='".concat(i2, "'] .apexcharts-yaxis-label"));
            r2 = p.listToArray(r2);
            var o2 = s2.getBoundingClientRect();
            "left" === a2.labels.align ? (r2.forEach(function(t4, e4) {
              t4.setAttribute("text-anchor", "start");
            }), a2.opposite || s2.setAttribute("transform", "translate(-".concat(o2.width, ", 0)"))) : "center" === a2.labels.align ? (r2.forEach(function(t4, e4) {
              t4.setAttribute("text-anchor", "middle");
            }), s2.setAttribute("transform", "translate(".concat(o2.width / 2 * (a2.opposite ? 1 : -1), ", 0)"))) : "right" === a2.labels.align && (r2.forEach(function(t4, e4) {
              t4.setAttribute("text-anchor", "end");
            }), a2.opposite && s2.setAttribute("transform", "translate(".concat(o2.width, ", 0)")));
          }
        });
      } }]), t2;
    }();
    var Z = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.documentEvent = p.bind(this.documentEvent, this);
      }
      return r(t2, [{ key: "addEventListener", value: function(t3, e2) {
        var i2 = this.w;
        i2.globals.events.hasOwnProperty(t3) ? i2.globals.events[t3].push(e2) : i2.globals.events[t3] = [e2];
      } }, { key: "removeEventListener", value: function(t3, e2) {
        var i2 = this.w;
        if (i2.globals.events.hasOwnProperty(t3)) {
          var a2 = i2.globals.events[t3].indexOf(e2);
          -1 !== a2 && i2.globals.events[t3].splice(a2, 1);
        }
      } }, { key: "fireEvent", value: function(t3, e2) {
        var i2 = this.w;
        if (i2.globals.events.hasOwnProperty(t3)) {
          e2 && e2.length || (e2 = []);
          for (var a2 = i2.globals.events[t3], s2 = a2.length, r2 = 0; r2 < s2; r2++)
            a2[r2].apply(null, e2);
        }
      } }, { key: "setupEventHandlers", value: function() {
        var t3 = this, e2 = this.w, i2 = this.ctx, a2 = e2.globals.dom.baseEl.querySelector(e2.globals.chartClass);
        this.ctx.eventList.forEach(function(t4) {
          a2.addEventListener(t4, function(t5) {
            var a3 = Object.assign({}, e2, { seriesIndex: e2.globals.capturedSeriesIndex, dataPointIndex: e2.globals.capturedDataPointIndex });
            "mousemove" === t5.type || "touchmove" === t5.type ? "function" == typeof e2.config.chart.events.mouseMove && e2.config.chart.events.mouseMove(t5, i2, a3) : "mouseleave" === t5.type || "touchleave" === t5.type ? "function" == typeof e2.config.chart.events.mouseLeave && e2.config.chart.events.mouseLeave(t5, i2, a3) : ("mouseup" === t5.type && 1 === t5.which || "touchend" === t5.type) && ("function" == typeof e2.config.chart.events.click && e2.config.chart.events.click(t5, i2, a3), i2.ctx.events.fireEvent("click", [t5, i2, a3]));
          }, { capture: false, passive: true });
        }), this.ctx.eventList.forEach(function(i3) {
          e2.globals.dom.baseEl.addEventListener(i3, t3.documentEvent, { passive: true });
        }), this.ctx.core.setupBrushHandler();
      } }, { key: "documentEvent", value: function(t3) {
        var e2 = this.w, i2 = t3.target.className;
        if ("click" === t3.type) {
          var a2 = e2.globals.dom.baseEl.querySelector(".apexcharts-menu");
          a2 && a2.classList.contains("apexcharts-menu-open") && "apexcharts-menu-icon" !== i2 && a2.classList.remove("apexcharts-menu-open");
        }
        e2.globals.clientX = "touchmove" === t3.type ? t3.touches[0].clientX : t3.clientX, e2.globals.clientY = "touchmove" === t3.type ? t3.touches[0].clientY : t3.clientY;
      } }]), t2;
    }();
    var $ = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "setCurrentLocaleValues", value: function(t3) {
        var e2 = this.w.config.chart.locales;
        window.Apex.chart && window.Apex.chart.locales && window.Apex.chart.locales.length > 0 && (e2 = this.w.config.chart.locales.concat(window.Apex.chart.locales));
        var i2 = e2.filter(function(e3) {
          return e3.name === t3;
        })[0];
        if (!i2)
          throw new Error("Wrong locale name provided. Please make sure you set the correct locale name in options");
        var a2 = p.extend(A, i2);
        this.w.globals.locale = a2.options;
      } }]), t2;
    }();
    var J = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "drawAxis", value: function(t3, e2) {
        var i2, a2, s2 = this.w.globals, r2 = this.w.config, o2 = new G(this.ctx), n2 = new q(this.ctx);
        s2.axisCharts && "radar" !== t3 && (s2.isBarHorizontal ? (a2 = n2.drawYaxisInversed(0), i2 = o2.drawXaxisInversed(0), s2.dom.elGraphical.add(i2), s2.dom.elGraphical.add(a2)) : (i2 = o2.drawXaxis(), s2.dom.elGraphical.add(i2), r2.yaxis.map(function(t4, e3) {
          -1 === s2.ignoreYAxisIndexes.indexOf(e3) && (a2 = n2.drawYaxis(e3), s2.dom.Paper.add(a2));
        })));
      } }]), t2;
    }();
    var Q = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "drawXCrosshairs", value: function() {
        var t3 = this.w, e2 = new b(this.ctx), i2 = new x(this.ctx), a2 = t3.config.xaxis.crosshairs.fill.gradient, s2 = t3.config.xaxis.crosshairs.dropShadow, r2 = t3.config.xaxis.crosshairs.fill.type, o2 = a2.colorFrom, n2 = a2.colorTo, l2 = a2.opacityFrom, h2 = a2.opacityTo, c2 = a2.stops, d2 = s2.enabled, g2 = s2.left, u2 = s2.top, f2 = s2.blur, v2 = s2.color, m2 = s2.opacity, y2 = t3.config.xaxis.crosshairs.fill.color;
        if (t3.config.xaxis.crosshairs.show) {
          "gradient" === r2 && (y2 = e2.drawGradient("vertical", o2, n2, l2, h2, null, c2, null));
          var w2 = e2.drawRect();
          1 === t3.config.xaxis.crosshairs.width && (w2 = e2.drawLine());
          var k2 = t3.globals.gridHeight;
          (!p.isNumber(k2) || k2 < 0) && (k2 = 0);
          var A2 = t3.config.xaxis.crosshairs.width;
          (!p.isNumber(A2) || A2 < 0) && (A2 = 0), w2.attr({ class: "apexcharts-xcrosshairs", x: 0, y: 0, y2: k2, width: A2, height: k2, fill: y2, filter: "none", "fill-opacity": t3.config.xaxis.crosshairs.opacity, stroke: t3.config.xaxis.crosshairs.stroke.color, "stroke-width": t3.config.xaxis.crosshairs.stroke.width, "stroke-dasharray": t3.config.xaxis.crosshairs.stroke.dashArray }), d2 && (w2 = i2.dropShadow(w2, { left: g2, top: u2, blur: f2, color: v2, opacity: m2 })), t3.globals.dom.elGraphical.add(w2);
        }
      } }, { key: "drawYCrosshairs", value: function() {
        var t3 = this.w, e2 = new b(this.ctx), i2 = t3.config.yaxis[0].crosshairs, a2 = t3.globals.barPadForNumericAxis;
        if (t3.config.yaxis[0].crosshairs.show) {
          var s2 = e2.drawLine(-a2, 0, t3.globals.gridWidth + a2, 0, i2.stroke.color, i2.stroke.dashArray, i2.stroke.width);
          s2.attr({ class: "apexcharts-ycrosshairs" }), t3.globals.dom.elGraphical.add(s2);
        }
        var r2 = e2.drawLine(-a2, 0, t3.globals.gridWidth + a2, 0, i2.stroke.color, 0, 0);
        r2.attr({ class: "apexcharts-ycrosshairs-hidden" }), t3.globals.dom.elGraphical.add(r2);
      } }]), t2;
    }();
    var K = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "checkResponsiveConfig", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = i2.config;
        if (0 !== a2.responsive.length) {
          var s2 = a2.responsive.slice();
          s2.sort(function(t4, e3) {
            return t4.breakpoint > e3.breakpoint ? 1 : e3.breakpoint > t4.breakpoint ? -1 : 0;
          }).reverse();
          var r2 = new H({}), o2 = function() {
            var t4 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}, a3 = s2[0].breakpoint, o3 = window.innerWidth > 0 ? window.innerWidth : screen.width;
            if (o3 > a3) {
              var n3 = y.extendArrayProps(r2, i2.globals.initialConfig, i2);
              t4 = p.extend(n3, t4), t4 = p.extend(i2.config, t4), e2.overrideResponsiveOptions(t4);
            } else
              for (var l2 = 0; l2 < s2.length; l2++)
                o3 < s2[l2].breakpoint && (t4 = y.extendArrayProps(r2, s2[l2].options, i2), t4 = p.extend(i2.config, t4), e2.overrideResponsiveOptions(t4));
          };
          if (t3) {
            var n2 = y.extendArrayProps(r2, t3, i2);
            n2 = p.extend(i2.config, n2), o2(n2 = p.extend(n2, t3));
          } else
            o2({});
        }
      } }, { key: "overrideResponsiveOptions", value: function(t3) {
        var e2 = new H(t3).init({ responsiveOverride: true });
        this.w.config = e2;
      } }]), t2;
    }();
    var tt = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.colors = [], this.w = e2.w;
        var i2 = this.w;
        this.isColorFn = false, this.isHeatmapDistributed = "treemap" === i2.config.chart.type && i2.config.plotOptions.treemap.distributed || "heatmap" === i2.config.chart.type && i2.config.plotOptions.heatmap.distributed, this.isBarDistributed = i2.config.plotOptions.bar.distributed && ("bar" === i2.config.chart.type || "rangeBar" === i2.config.chart.type);
      }
      return r(t2, [{ key: "init", value: function() {
        this.setDefaultColors();
      } }, { key: "setDefaultColors", value: function() {
        var t3 = this, e2 = this.w, i2 = new p();
        if (e2.globals.dom.elWrap.classList.add("apexcharts-theme-".concat(e2.config.theme.mode)), void 0 === e2.config.colors ? e2.globals.colors = this.predefined() : (e2.globals.colors = e2.config.colors, Array.isArray(e2.config.colors) && e2.config.colors.length > 0 && "function" == typeof e2.config.colors[0] && (e2.globals.colors = e2.config.series.map(function(i3, a3) {
          var s3 = e2.config.colors[a3];
          return s3 || (s3 = e2.config.colors[0]), "function" == typeof s3 ? (t3.isColorFn = true, s3({ value: e2.globals.axisCharts ? e2.globals.series[a3][0] ? e2.globals.series[a3][0] : 0 : e2.globals.series[a3], seriesIndex: a3, dataPointIndex: a3, w: e2 })) : s3;
        }))), e2.globals.seriesColors.map(function(t4, i3) {
          t4 && (e2.globals.colors[i3] = t4);
        }), e2.config.theme.monochrome.enabled) {
          var a2 = [], s2 = e2.globals.series.length;
          (this.isBarDistributed || this.isHeatmapDistributed) && (s2 = e2.globals.series[0].length * e2.globals.series.length);
          for (var r2 = e2.config.theme.monochrome.color, o2 = 1 / (s2 / e2.config.theme.monochrome.shadeIntensity), n2 = e2.config.theme.monochrome.shadeTo, l2 = 0, h2 = 0; h2 < s2; h2++) {
            var c2 = void 0;
            "dark" === n2 ? (c2 = i2.shadeColor(-1 * l2, r2), l2 += o2) : (c2 = i2.shadeColor(l2, r2), l2 += o2), a2.push(c2);
          }
          e2.globals.colors = a2.slice();
        }
        var d2 = e2.globals.colors.slice();
        this.pushExtraColors(e2.globals.colors);
        ["fill", "stroke"].forEach(function(i3) {
          void 0 === e2.config[i3].colors ? e2.globals[i3].colors = t3.isColorFn ? e2.config.colors : d2 : e2.globals[i3].colors = e2.config[i3].colors.slice(), t3.pushExtraColors(e2.globals[i3].colors);
        }), void 0 === e2.config.dataLabels.style.colors ? e2.globals.dataLabels.style.colors = d2 : e2.globals.dataLabels.style.colors = e2.config.dataLabels.style.colors.slice(), this.pushExtraColors(e2.globals.dataLabels.style.colors, 50), void 0 === e2.config.plotOptions.radar.polygons.fill.colors ? e2.globals.radarPolygons.fill.colors = ["dark" === e2.config.theme.mode ? "#424242" : "none"] : e2.globals.radarPolygons.fill.colors = e2.config.plotOptions.radar.polygons.fill.colors.slice(), this.pushExtraColors(e2.globals.radarPolygons.fill.colors, 20), void 0 === e2.config.markers.colors ? e2.globals.markers.colors = d2 : e2.globals.markers.colors = e2.config.markers.colors.slice(), this.pushExtraColors(e2.globals.markers.colors);
      } }, { key: "pushExtraColors", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null, a2 = this.w, s2 = e2 || a2.globals.series.length;
        if (null === i2 && (i2 = this.isBarDistributed || this.isHeatmapDistributed || "heatmap" === a2.config.chart.type && a2.config.plotOptions.heatmap.colorScale.inverse), i2 && a2.globals.series.length && (s2 = a2.globals.series[a2.globals.maxValsInArrayIndex].length * a2.globals.series.length), t3.length < s2)
          for (var r2 = s2 - t3.length, o2 = 0; o2 < r2; o2++)
            t3.push(t3[o2]);
      } }, { key: "updateThemeOptions", value: function(t3) {
        t3.chart = t3.chart || {}, t3.tooltip = t3.tooltip || {};
        var e2 = t3.theme.mode || "light", i2 = t3.theme.palette ? t3.theme.palette : "dark" === e2 ? "palette4" : "palette1", a2 = t3.chart.foreColor ? t3.chart.foreColor : "dark" === e2 ? "#f6f7f8" : "#373d3f";
        return t3.tooltip.theme = e2, t3.chart.foreColor = a2, t3.theme.palette = i2, t3;
      } }, { key: "predefined", value: function() {
        switch (this.w.config.theme.palette) {
          case "palette1":
            this.colors = ["#008FFB", "#00E396", "#FEB019", "#FF4560", "#775DD0"];
            break;
          case "palette2":
            this.colors = ["#3f51b5", "#03a9f4", "#4caf50", "#f9ce1d", "#FF9800"];
            break;
          case "palette3":
            this.colors = ["#33b2df", "#546E7A", "#d4526e", "#13d8aa", "#A5978B"];
            break;
          case "palette4":
            this.colors = ["#4ecdc4", "#c7f464", "#81D4FA", "#fd6a6a", "#546E7A"];
            break;
          case "palette5":
            this.colors = ["#2b908f", "#f9a3a4", "#90ee7e", "#fa4443", "#69d2e7"];
            break;
          case "palette6":
            this.colors = ["#449DD1", "#F86624", "#EA3546", "#662E9B", "#C5D86D"];
            break;
          case "palette7":
            this.colors = ["#D7263D", "#1B998B", "#2E294E", "#F46036", "#E2C044"];
            break;
          case "palette8":
            this.colors = ["#662E9B", "#F86624", "#F9C80E", "#EA3546", "#43BCCD"];
            break;
          case "palette9":
            this.colors = ["#5C4742", "#A5978B", "#8D5B4C", "#5A2A27", "#C4BBAF"];
            break;
          case "palette10":
            this.colors = ["#A300D6", "#7D02EB", "#5653FE", "#2983FF", "#00B1F2"];
            break;
          default:
            this.colors = ["#008FFB", "#00E396", "#FEB019", "#FF4560", "#775DD0"];
        }
        return this.colors;
      } }]), t2;
    }();
    var et = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "draw", value: function() {
        this.drawTitleSubtitle("title"), this.drawTitleSubtitle("subtitle");
      } }, { key: "drawTitleSubtitle", value: function(t3) {
        var e2 = this.w, i2 = "title" === t3 ? e2.config.title : e2.config.subtitle, a2 = e2.globals.svgWidth / 2, s2 = i2.offsetY, r2 = "middle";
        if ("left" === i2.align ? (a2 = 10, r2 = "start") : "right" === i2.align && (a2 = e2.globals.svgWidth - 10, r2 = "end"), a2 += i2.offsetX, s2 = s2 + parseInt(i2.style.fontSize, 10) + i2.margin / 2, void 0 !== i2.text) {
          var o2 = new b(this.ctx).drawText({ x: a2, y: s2, text: i2.text, textAnchor: r2, fontSize: i2.style.fontSize, fontFamily: i2.style.fontFamily, fontWeight: i2.style.fontWeight, foreColor: i2.style.color, opacity: 1 });
          o2.node.setAttribute("class", "apexcharts-".concat(t3, "-text")), e2.globals.dom.Paper.add(o2);
        }
      } }]), t2;
    }();
    var it = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.dCtx = e2;
      }
      return r(t2, [{ key: "getTitleSubtitleCoords", value: function(t3) {
        var e2 = this.w, i2 = 0, a2 = 0, s2 = "title" === t3 ? e2.config.title.floating : e2.config.subtitle.floating, r2 = e2.globals.dom.baseEl.querySelector(".apexcharts-".concat(t3, "-text"));
        if (null !== r2 && !s2) {
          var o2 = r2.getBoundingClientRect();
          i2 = o2.width, a2 = e2.globals.axisCharts ? o2.height + 5 : o2.height;
        }
        return { width: i2, height: a2 };
      } }, { key: "getLegendsRect", value: function() {
        var t3 = this.w, e2 = t3.globals.dom.baseEl.querySelector(".apexcharts-legend");
        t3.config.legend.height || "top" !== t3.config.legend.position && "bottom" !== t3.config.legend.position || (e2.style.maxHeight = t3.globals.svgHeight / 2 + "px");
        var i2 = Object.assign({}, p.getBoundingClientRect(e2));
        return null !== e2 && !t3.config.legend.floating && t3.config.legend.show ? this.dCtx.lgRect = { x: i2.x, y: i2.y, height: i2.height, width: 0 === i2.height ? 0 : i2.width } : this.dCtx.lgRect = { x: 0, y: 0, height: 0, width: 0 }, "left" !== t3.config.legend.position && "right" !== t3.config.legend.position || 1.5 * this.dCtx.lgRect.width > t3.globals.svgWidth && (this.dCtx.lgRect.width = t3.globals.svgWidth / 1.5), this.dCtx.lgRect;
      } }, { key: "getLargestStringFromMultiArr", value: function(t3, e2) {
        var i2 = t3;
        if (this.w.globals.isMultiLineX) {
          var a2 = e2.map(function(t4, e3) {
            return Array.isArray(t4) ? t4.length : 1;
          }), s2 = Math.max.apply(Math, g(a2));
          i2 = e2[a2.indexOf(s2)];
        }
        return i2;
      } }]), t2;
    }();
    var at = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.dCtx = e2;
      }
      return r(t2, [{ key: "getxAxisLabelsCoords", value: function() {
        var t3, e2 = this.w, i2 = e2.globals.labels.slice();
        if (e2.config.xaxis.convertedCatToNumeric && 0 === i2.length && (i2 = e2.globals.categoryLabels), e2.globals.timescaleLabels.length > 0) {
          var a2 = this.getxAxisTimeScaleLabelsCoords();
          t3 = { width: a2.width, height: a2.height }, e2.globals.rotateXLabels = false;
        } else {
          this.dCtx.lgWidthForSideLegends = "left" !== e2.config.legend.position && "right" !== e2.config.legend.position || e2.config.legend.floating ? 0 : this.dCtx.lgRect.width;
          var s2 = e2.globals.xLabelFormatter, r2 = p.getLargestStringFromArr(i2), o2 = this.dCtx.dimHelpers.getLargestStringFromMultiArr(r2, i2);
          e2.globals.isBarHorizontal && (o2 = r2 = e2.globals.yAxisScale[0].result.reduce(function(t4, e3) {
            return t4.length > e3.length ? t4 : e3;
          }, 0));
          var n2 = new W(this.dCtx.ctx), l2 = r2;
          r2 = n2.xLabelFormat(s2, r2, l2, { i: void 0, dateFormatter: new Y(this.dCtx.ctx).formatDate, w: e2 }), o2 = n2.xLabelFormat(s2, o2, l2, { i: void 0, dateFormatter: new Y(this.dCtx.ctx).formatDate, w: e2 }), (e2.config.xaxis.convertedCatToNumeric && void 0 === r2 || "" === String(r2).trim()) && (o2 = r2 = "1");
          var h2 = new b(this.dCtx.ctx), c2 = h2.getTextRects(r2, e2.config.xaxis.labels.style.fontSize), d2 = c2;
          if (r2 !== o2 && (d2 = h2.getTextRects(o2, e2.config.xaxis.labels.style.fontSize)), (t3 = { width: c2.width >= d2.width ? c2.width : d2.width, height: c2.height >= d2.height ? c2.height : d2.height }).width * i2.length > e2.globals.svgWidth - this.dCtx.lgWidthForSideLegends - this.dCtx.yAxisWidth - this.dCtx.gridPad.left - this.dCtx.gridPad.right && 0 !== e2.config.xaxis.labels.rotate || e2.config.xaxis.labels.rotateAlways) {
            if (!e2.globals.isBarHorizontal) {
              e2.globals.rotateXLabels = true;
              var g2 = function(t4) {
                return h2.getTextRects(t4, e2.config.xaxis.labels.style.fontSize, e2.config.xaxis.labels.style.fontFamily, "rotate(".concat(e2.config.xaxis.labels.rotate, " 0 0)"), false);
              };
              c2 = g2(r2), r2 !== o2 && (d2 = g2(o2)), t3.height = (c2.height > d2.height ? c2.height : d2.height) / 1.5, t3.width = c2.width > d2.width ? c2.width : d2.width;
            }
          } else
            e2.globals.rotateXLabels = false;
        }
        return e2.config.xaxis.labels.show || (t3 = { width: 0, height: 0 }), { width: t3.width, height: t3.height };
      } }, { key: "getxAxisTitleCoords", value: function() {
        var t3 = this.w, e2 = 0, i2 = 0;
        if (void 0 !== t3.config.xaxis.title.text) {
          var a2 = new b(this.dCtx.ctx).getTextRects(t3.config.xaxis.title.text, t3.config.xaxis.title.style.fontSize);
          e2 = a2.width, i2 = a2.height;
        }
        return { width: e2, height: i2 };
      } }, { key: "getxAxisTimeScaleLabelsCoords", value: function() {
        var t3, e2 = this.w;
        this.dCtx.timescaleLabels = e2.globals.timescaleLabels.slice();
        var i2 = this.dCtx.timescaleLabels.map(function(t4) {
          return t4.value;
        }), a2 = i2.reduce(function(t4, e3) {
          return void 0 === t4 ? (console.error("You have possibly supplied invalid Date format. Please supply a valid JavaScript Date"), 0) : t4.length > e3.length ? t4 : e3;
        }, 0);
        return 1.05 * (t3 = new b(this.dCtx.ctx).getTextRects(a2, e2.config.xaxis.labels.style.fontSize)).width * i2.length > e2.globals.gridWidth && 0 !== e2.config.xaxis.labels.rotate && (e2.globals.overlappingXLabels = true), t3;
      } }, { key: "additionalPaddingXLabels", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = i2.globals, s2 = i2.config, r2 = s2.xaxis.type, o2 = t3.width;
        a2.skipLastTimelinelabel = false, a2.skipFirstTimelinelabel = false;
        var n2 = i2.config.yaxis[0].opposite && i2.globals.isBarHorizontal, l2 = function(t4, n3) {
          (function(t5) {
            return -1 !== a2.collapsedSeriesIndices.indexOf(t5);
          })(n3) || function(t5) {
            if (e2.dCtx.timescaleLabels && e2.dCtx.timescaleLabels.length) {
              var n4 = e2.dCtx.timescaleLabels[0], l3 = e2.dCtx.timescaleLabels[e2.dCtx.timescaleLabels.length - 1].position + o2 / 1.75 - e2.dCtx.yAxisWidthRight, h2 = n4.position - o2 / 1.75 + e2.dCtx.yAxisWidthLeft, c2 = "right" === i2.config.legend.position && e2.dCtx.lgRect.width > 0 ? e2.dCtx.lgRect.width : 0;
              l3 > a2.svgWidth - a2.translateX - c2 && (a2.skipLastTimelinelabel = true), h2 < -(t5.show && !t5.floating || "bar" !== s2.chart.type && "candlestick" !== s2.chart.type && "rangeBar" !== s2.chart.type && "boxPlot" !== s2.chart.type ? 10 : o2 / 1.75) && (a2.skipFirstTimelinelabel = true);
            } else
              "datetime" === r2 ? e2.dCtx.gridPad.right < o2 && !a2.rotateXLabels && (a2.skipLastTimelinelabel = true) : "datetime" !== r2 && e2.dCtx.gridPad.right < o2 / 2 - e2.dCtx.yAxisWidthRight && !a2.rotateXLabels && !i2.config.xaxis.labels.trim && ("between" !== i2.config.xaxis.tickPlacement || i2.globals.isBarHorizontal) && (e2.dCtx.xPadRight = o2 / 2 + 1);
          }(t4);
        };
        s2.yaxis.forEach(function(t4, i3) {
          n2 ? (e2.dCtx.gridPad.left < o2 && (e2.dCtx.xPadLeft = o2 / 2 + 1), e2.dCtx.xPadRight = o2 / 2 + 1) : l2(t4, i3);
        });
      } }]), t2;
    }();
    var st = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.dCtx = e2;
      }
      return r(t2, [{ key: "getyAxisLabelsCoords", value: function() {
        var t3 = this, e2 = this.w, i2 = [], a2 = 10, s2 = new B(this.dCtx.ctx);
        return e2.config.yaxis.map(function(r2, o2) {
          var n2 = e2.globals.yAxisScale[o2], l2 = 0;
          if (!s2.isYAxisHidden(o2) && r2.labels.show && void 0 !== r2.labels.minWidth && (l2 = r2.labels.minWidth), !s2.isYAxisHidden(o2) && r2.labels.show && n2.result.length) {
            var h2 = e2.globals.yLabelFormatters[o2], c2 = n2.niceMin === Number.MIN_VALUE ? 0 : n2.niceMin, d2 = String(c2).length > String(n2.niceMax).length ? c2 : n2.niceMax, g2 = h2(d2, { seriesIndex: o2, dataPointIndex: -1, w: e2 }), u2 = g2;
            if (void 0 !== g2 && 0 !== g2.length || (g2 = d2), e2.globals.isBarHorizontal) {
              a2 = 0;
              var f2 = e2.globals.labels.slice();
              g2 = h2(g2 = p.getLargestStringFromArr(f2), { seriesIndex: o2, dataPointIndex: -1, w: e2 }), u2 = t3.dCtx.dimHelpers.getLargestStringFromMultiArr(g2, f2);
            }
            var x2 = new b(t3.dCtx.ctx), v2 = "rotate(".concat(r2.labels.rotate, " 0 0)"), m2 = x2.getTextRects(g2, r2.labels.style.fontSize, r2.labels.style.fontFamily, v2, false), y2 = m2;
            g2 !== u2 && (y2 = x2.getTextRects(u2, r2.labels.style.fontSize, r2.labels.style.fontFamily, v2, false)), i2.push({ width: (l2 > y2.width || l2 > m2.width ? l2 : y2.width > m2.width ? y2.width : m2.width) + a2, height: y2.height > m2.height ? y2.height : m2.height });
          } else
            i2.push({ width: 0, height: 0 });
        }), i2;
      } }, { key: "getyAxisTitleCoords", value: function() {
        var t3 = this, e2 = this.w, i2 = [];
        return e2.config.yaxis.map(function(e3, a2) {
          if (e3.show && void 0 !== e3.title.text) {
            var s2 = new b(t3.dCtx.ctx), r2 = "rotate(".concat(e3.title.rotate, " 0 0)"), o2 = s2.getTextRects(e3.title.text, e3.title.style.fontSize, e3.title.style.fontFamily, r2, false);
            i2.push({ width: o2.width, height: o2.height });
          } else
            i2.push({ width: 0, height: 0 });
        }), i2;
      } }, { key: "getTotalYAxisWidth", value: function() {
        var t3 = this.w, e2 = 0, i2 = 0, a2 = 0, s2 = t3.globals.yAxisScale.length > 1 ? 10 : 0, r2 = new B(this.dCtx.ctx), o2 = function(o3, n2) {
          var l2 = t3.config.yaxis[n2].floating, h2 = 0;
          o3.width > 0 && !l2 ? (h2 = o3.width + s2, function(e3) {
            return t3.globals.ignoreYAxisIndexes.indexOf(e3) > -1;
          }(n2) && (h2 = h2 - o3.width - s2)) : h2 = l2 || r2.isYAxisHidden(n2) ? 0 : 5, t3.config.yaxis[n2].opposite ? a2 += h2 : i2 += h2, e2 += h2;
        };
        return t3.globals.yLabelsCoords.map(function(t4, e3) {
          o2(t4, e3);
        }), t3.globals.yTitleCoords.map(function(t4, e3) {
          o2(t4, e3);
        }), t3.globals.isBarHorizontal && !t3.config.yaxis[0].floating && (e2 = t3.globals.yLabelsCoords[0].width + t3.globals.yTitleCoords[0].width + 15), this.dCtx.yAxisWidthLeft = i2, this.dCtx.yAxisWidthRight = a2, e2;
      } }]), t2;
    }();
    var rt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.dCtx = e2;
      }
      return r(t2, [{ key: "gridPadForColumnsInNumericAxis", value: function(t3) {
        var e2 = this.w;
        if (e2.globals.noData || e2.globals.allSeriesCollapsed)
          return 0;
        var i2 = function(t4) {
          return "bar" === t4 || "rangeBar" === t4 || "candlestick" === t4 || "boxPlot" === t4;
        }, a2 = e2.config.chart.type, s2 = 0, r2 = i2(a2) ? e2.config.series.length : 1;
        if (e2.globals.comboBarCount > 0 && (r2 = e2.globals.comboBarCount), e2.globals.collapsedSeries.forEach(function(t4) {
          i2(t4.type) && (r2 -= 1);
        }), e2.config.chart.stacked && (r2 = 1), (i2(a2) || e2.globals.comboBarCount > 0) && e2.globals.isXNumeric && !e2.globals.isBarHorizontal && r2 > 0) {
          var o2, n2, l2 = Math.abs(e2.globals.initialMaxX - e2.globals.initialMinX);
          l2 <= 3 && (l2 = e2.globals.dataPoints), o2 = l2 / t3, e2.globals.minXDiff && e2.globals.minXDiff / o2 > 0 && (n2 = e2.globals.minXDiff / o2), n2 > t3 / 2 && (n2 /= 2), (s2 = n2 / r2 * parseInt(e2.config.plotOptions.bar.columnWidth, 10) / 100) < 1 && (s2 = 1), s2 = s2 / (r2 > 1 ? 1 : 1.5) + 5, e2.globals.barPadForNumericAxis = s2;
        }
        return s2;
      } }, { key: "gridPadFortitleSubtitle", value: function() {
        var t3 = this, e2 = this.w, i2 = e2.globals, a2 = this.dCtx.isSparkline || !e2.globals.axisCharts ? 0 : 10;
        ["title", "subtitle"].forEach(function(i3) {
          void 0 !== e2.config[i3].text ? a2 += e2.config[i3].margin : a2 += t3.dCtx.isSparkline || !e2.globals.axisCharts ? 0 : 5;
        }), !e2.config.legend.show || "bottom" !== e2.config.legend.position || e2.config.legend.floating || e2.globals.axisCharts || (a2 += 10);
        var s2 = this.dCtx.dimHelpers.getTitleSubtitleCoords("title"), r2 = this.dCtx.dimHelpers.getTitleSubtitleCoords("subtitle");
        i2.gridHeight = i2.gridHeight - s2.height - r2.height - a2, i2.translateY = i2.translateY + s2.height + r2.height + a2;
      } }, { key: "setGridXPosForDualYAxis", value: function(t3, e2) {
        var i2 = this.w, a2 = new B(this.dCtx.ctx);
        i2.config.yaxis.map(function(s2, r2) {
          -1 !== i2.globals.ignoreYAxisIndexes.indexOf(r2) || s2.floating || a2.isYAxisHidden(r2) || (s2.opposite && (i2.globals.translateX = i2.globals.translateX - (e2[r2].width + t3[r2].width) - parseInt(i2.config.yaxis[r2].labels.style.fontSize, 10) / 1.2 - 12), i2.globals.translateX < 2 && (i2.globals.translateX = 2));
        });
      } }]), t2;
    }();
    var ot = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.lgRect = {}, this.yAxisWidth = 0, this.yAxisWidthLeft = 0, this.yAxisWidthRight = 0, this.xAxisHeight = 0, this.isSparkline = this.w.config.chart.sparkline.enabled, this.dimHelpers = new it(this), this.dimYAxis = new st(this), this.dimXAxis = new at(this), this.dimGrid = new rt(this), this.lgWidthForSideLegends = 0, this.gridPad = this.w.config.grid.padding, this.xPadRight = 0, this.xPadLeft = 0;
      }
      return r(t2, [{ key: "plotCoords", value: function() {
        var t3 = this.w.globals;
        this.lgRect = this.dimHelpers.getLegendsRect(), t3.axisCharts ? this.setDimensionsForAxisCharts() : this.setDimensionsForNonAxisCharts(), this.dimGrid.gridPadFortitleSubtitle(), t3.gridHeight = t3.gridHeight - this.gridPad.top - this.gridPad.bottom, t3.gridWidth = t3.gridWidth - this.gridPad.left - this.gridPad.right - this.xPadRight - this.xPadLeft;
        var e2 = this.dimGrid.gridPadForColumnsInNumericAxis(t3.gridWidth);
        t3.gridWidth = t3.gridWidth - 2 * e2, t3.translateX = t3.translateX + this.gridPad.left + this.xPadLeft + (e2 > 0 ? e2 + 4 : 0), t3.translateY = t3.translateY + this.gridPad.top;
      } }, { key: "setDimensionsForAxisCharts", value: function() {
        var t3 = this, e2 = this.w, i2 = e2.globals, a2 = this.dimYAxis.getyAxisLabelsCoords(), s2 = this.dimYAxis.getyAxisTitleCoords();
        e2.globals.yLabelsCoords = [], e2.globals.yTitleCoords = [], e2.config.yaxis.map(function(t4, i3) {
          e2.globals.yLabelsCoords.push({ width: a2[i3].width, index: i3 }), e2.globals.yTitleCoords.push({ width: s2[i3].width, index: i3 });
        }), this.yAxisWidth = this.dimYAxis.getTotalYAxisWidth();
        var r2 = this.dimXAxis.getxAxisLabelsCoords(), o2 = this.dimXAxis.getxAxisTitleCoords();
        this.conditionalChecksForAxisCoords(r2, o2), i2.translateXAxisY = e2.globals.rotateXLabels ? this.xAxisHeight / 8 : -4, i2.translateXAxisX = e2.globals.rotateXLabels && e2.globals.isXNumeric && e2.config.xaxis.labels.rotate <= -45 ? -this.xAxisWidth / 4 : 0, e2.globals.isBarHorizontal && (i2.rotateXLabels = false, i2.translateXAxisY = parseInt(e2.config.xaxis.labels.style.fontSize, 10) / 1.5 * -1), i2.translateXAxisY = i2.translateXAxisY + e2.config.xaxis.labels.offsetY, i2.translateXAxisX = i2.translateXAxisX + e2.config.xaxis.labels.offsetX;
        var n2 = this.yAxisWidth, l2 = this.xAxisHeight;
        i2.xAxisLabelsHeight = this.xAxisHeight - o2.height, i2.xAxisLabelsWidth = this.xAxisWidth, i2.xAxisHeight = this.xAxisHeight;
        var h2 = 10;
        ("radar" === e2.config.chart.type || this.isSparkline) && (n2 = 0, l2 = i2.goldenPadding), this.isSparkline && (this.lgRect = { height: 0, width: 0 }), (this.isSparkline || "treemap" === e2.config.chart.type) && (n2 = 0, l2 = 0, h2 = 0), this.isSparkline || this.dimXAxis.additionalPaddingXLabels(r2);
        var c2 = function() {
          i2.translateX = n2, i2.gridHeight = i2.svgHeight - t3.lgRect.height - l2 - (t3.isSparkline || "treemap" === e2.config.chart.type ? 0 : e2.globals.rotateXLabels ? 10 : 15), i2.gridWidth = i2.svgWidth - n2;
        };
        switch ("top" === e2.config.xaxis.position && (h2 = i2.xAxisHeight - e2.config.xaxis.axisTicks.height - 5), e2.config.legend.position) {
          case "bottom":
            i2.translateY = h2, c2();
            break;
          case "top":
            i2.translateY = this.lgRect.height + h2, c2();
            break;
          case "left":
            i2.translateY = h2, i2.translateX = this.lgRect.width + n2, i2.gridHeight = i2.svgHeight - l2 - 12, i2.gridWidth = i2.svgWidth - this.lgRect.width - n2;
            break;
          case "right":
            i2.translateY = h2, i2.translateX = n2, i2.gridHeight = i2.svgHeight - l2 - 12, i2.gridWidth = i2.svgWidth - this.lgRect.width - n2 - 5;
            break;
          default:
            throw new Error("Legend position not supported");
        }
        this.dimGrid.setGridXPosForDualYAxis(s2, a2), new q(this.ctx).setYAxisXPosition(a2, s2);
      } }, { key: "setDimensionsForNonAxisCharts", value: function() {
        var t3 = this.w, e2 = t3.globals, i2 = t3.config, a2 = 0;
        t3.config.legend.show && !t3.config.legend.floating && (a2 = 20);
        var s2 = "pie" === i2.chart.type || "polarArea" === i2.chart.type || "donut" === i2.chart.type ? "pie" : "radialBar", r2 = i2.plotOptions[s2].offsetY, o2 = i2.plotOptions[s2].offsetX;
        if (!i2.legend.show || i2.legend.floating)
          return e2.gridHeight = e2.svgHeight - i2.grid.padding.left + i2.grid.padding.right, e2.gridWidth = e2.gridHeight, e2.translateY = r2, void (e2.translateX = o2 + (e2.svgWidth - e2.gridWidth) / 2);
        switch (i2.legend.position) {
          case "bottom":
            e2.gridHeight = e2.svgHeight - this.lgRect.height - e2.goldenPadding, e2.gridWidth = e2.svgWidth, e2.translateY = r2 - 10, e2.translateX = o2 + (e2.svgWidth - e2.gridWidth) / 2;
            break;
          case "top":
            e2.gridHeight = e2.svgHeight - this.lgRect.height - e2.goldenPadding, e2.gridWidth = e2.svgWidth, e2.translateY = this.lgRect.height + r2 + 10, e2.translateX = o2 + (e2.svgWidth - e2.gridWidth) / 2;
            break;
          case "left":
            e2.gridWidth = e2.svgWidth - this.lgRect.width - a2, e2.gridHeight = "auto" !== i2.chart.height ? e2.svgHeight : e2.gridWidth, e2.translateY = r2, e2.translateX = o2 + this.lgRect.width + a2;
            break;
          case "right":
            e2.gridWidth = e2.svgWidth - this.lgRect.width - a2 - 5, e2.gridHeight = "auto" !== i2.chart.height ? e2.svgHeight : e2.gridWidth, e2.translateY = r2, e2.translateX = o2 + 10;
            break;
          default:
            throw new Error("Legend position not supported");
        }
      } }, { key: "conditionalChecksForAxisCoords", value: function(t3, e2) {
        var i2 = this.w;
        this.xAxisHeight = (t3.height + e2.height) * (i2.globals.isMultiLineX ? 1.2 : i2.globals.LINE_HEIGHT_RATIO) + (i2.globals.rotateXLabels ? 22 : 10), this.xAxisWidth = t3.width, this.xAxisHeight - e2.height > i2.config.xaxis.labels.maxHeight && (this.xAxisHeight = i2.config.xaxis.labels.maxHeight), i2.config.xaxis.labels.minHeight && this.xAxisHeight < i2.config.xaxis.labels.minHeight && (this.xAxisHeight = i2.config.xaxis.labels.minHeight), i2.config.xaxis.floating && (this.xAxisHeight = 0);
        var a2 = 0, s2 = 0;
        i2.config.yaxis.forEach(function(t4) {
          a2 += t4.labels.minWidth, s2 += t4.labels.maxWidth;
        }), this.yAxisWidth < a2 && (this.yAxisWidth = a2), this.yAxisWidth > s2 && (this.yAxisWidth = s2);
      } }]), t2;
    }();
    var nt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.lgCtx = e2;
      }
      return r(t2, [{ key: "getLegendStyles", value: function() {
        var t3 = document.createElement("style");
        t3.setAttribute("type", "text/css");
        var e2 = document.createTextNode("	\n    	\n      .apexcharts-legend {	\n        display: flex;	\n        overflow: auto;	\n        padding: 0 10px;	\n      }	\n      .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {	\n        flex-wrap: wrap	\n      }	\n      .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {	\n        flex-direction: column;	\n        bottom: 0;	\n      }	\n      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {	\n        justify-content: flex-start;	\n      }	\n      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {	\n        justify-content: center;  	\n      }	\n      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {	\n        justify-content: flex-end;	\n      }	\n      .apexcharts-legend-series {	\n        cursor: pointer;	\n        line-height: normal;	\n      }	\n      .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{	\n        display: flex;	\n        align-items: center;	\n      }	\n      .apexcharts-legend-text {	\n        position: relative;	\n        font-size: 14px;	\n      }	\n      .apexcharts-legend-text *, .apexcharts-legend-marker * {	\n        pointer-events: none;	\n      }	\n      .apexcharts-legend-marker {	\n        position: relative;	\n        display: inline-block;	\n        cursor: pointer;	\n        margin-right: 3px;	\n        border-style: solid;\n      }	\n      	\n      .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{	\n        display: inline-block;	\n      }	\n      .apexcharts-legend-series.apexcharts-no-click {	\n        cursor: auto;	\n      }	\n      .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {	\n        display: none !important;	\n      }	\n      .apexcharts-inactive-legend {	\n        opacity: 0.45;	\n      }");
        return t3.appendChild(e2), t3;
      } }, { key: "getLegendBBox", value: function() {
        var t3 = this.w.globals.dom.baseEl.querySelector(".apexcharts-legend").getBoundingClientRect(), e2 = t3.width;
        return { clwh: t3.height, clww: e2 };
      } }, { key: "appendToForeignObject", value: function() {
        var t3 = this.w.globals;
        t3.dom.elLegendForeign = document.createElementNS(t3.SVGNS, "foreignObject");
        var e2 = t3.dom.elLegendForeign;
        e2.setAttribute("x", 0), e2.setAttribute("y", 0), e2.setAttribute("width", t3.svgWidth), e2.setAttribute("height", t3.svgHeight), t3.dom.elLegendWrap.setAttribute("xmlns", "http://www.w3.org/1999/xhtml"), e2.appendChild(t3.dom.elLegendWrap), e2.appendChild(this.getLegendStyles()), t3.dom.Paper.node.insertBefore(e2, t3.dom.elGraphical.node);
      } }, { key: "toggleDataSeries", value: function(t3, e2) {
        var i2 = this, a2 = this.w;
        if (a2.globals.axisCharts || "radialBar" === a2.config.chart.type) {
          a2.globals.resized = true;
          var s2 = null, r2 = null;
          if (a2.globals.risingSeries = [], a2.globals.axisCharts ? (s2 = a2.globals.dom.baseEl.querySelector(".apexcharts-series[data\\:realIndex='".concat(t3, "']")), r2 = parseInt(s2.getAttribute("data:realIndex"), 10)) : (s2 = a2.globals.dom.baseEl.querySelector(".apexcharts-series[rel='".concat(t3 + 1, "']")), r2 = parseInt(s2.getAttribute("rel"), 10) - 1), e2)
            [{ cs: a2.globals.collapsedSeries, csi: a2.globals.collapsedSeriesIndices }, { cs: a2.globals.ancillaryCollapsedSeries, csi: a2.globals.ancillaryCollapsedSeriesIndices }].forEach(function(t4) {
              i2.riseCollapsedSeries(t4.cs, t4.csi, r2);
            });
          else
            this.hideSeries({ seriesEl: s2, realIndex: r2 });
        } else {
          var o2 = a2.globals.dom.Paper.select(" .apexcharts-series[rel='".concat(t3 + 1, "'] path")), n2 = a2.config.chart.type;
          if ("pie" === n2 || "polarArea" === n2 || "donut" === n2) {
            var l2 = a2.config.plotOptions.pie.donut.labels;
            new b(this.lgCtx.ctx).pathMouseDown(o2.members[0], null), this.lgCtx.ctx.pie.printDataLabelsInner(o2.members[0].node, l2);
          }
          o2.fire("click");
        }
      } }, { key: "hideSeries", value: function(t3) {
        var e2 = t3.seriesEl, i2 = t3.realIndex, a2 = this.w, s2 = p.clone(a2.config.series);
        if (a2.globals.axisCharts) {
          var r2 = false;
          if (a2.config.yaxis[i2] && a2.config.yaxis[i2].show && a2.config.yaxis[i2].showAlways && (r2 = true, a2.globals.ancillaryCollapsedSeriesIndices.indexOf(i2) < 0 && (a2.globals.ancillaryCollapsedSeries.push({ index: i2, data: s2[i2].data.slice(), type: e2.parentNode.className.baseVal.split("-")[1] }), a2.globals.ancillaryCollapsedSeriesIndices.push(i2))), !r2) {
            a2.globals.collapsedSeries.push({ index: i2, data: s2[i2].data.slice(), type: e2.parentNode.className.baseVal.split("-")[1] }), a2.globals.collapsedSeriesIndices.push(i2);
            var o2 = a2.globals.risingSeries.indexOf(i2);
            a2.globals.risingSeries.splice(o2, 1);
          }
        } else
          a2.globals.collapsedSeries.push({ index: i2, data: s2[i2] }), a2.globals.collapsedSeriesIndices.push(i2);
        for (var n2 = e2.childNodes, l2 = 0; l2 < n2.length; l2++)
          n2[l2].classList.contains("apexcharts-series-markers-wrap") && (n2[l2].classList.contains("apexcharts-hide") ? n2[l2].classList.remove("apexcharts-hide") : n2[l2].classList.add("apexcharts-hide"));
        a2.globals.allSeriesCollapsed = a2.globals.collapsedSeries.length === a2.config.series.length, s2 = this._getSeriesBasedOnCollapsedState(s2), this.lgCtx.ctx.updateHelpers._updateSeries(s2, a2.config.chart.animations.dynamicAnimation.enabled);
      } }, { key: "riseCollapsedSeries", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = p.clone(a2.config.series);
        if (t3.length > 0) {
          for (var r2 = 0; r2 < t3.length; r2++)
            t3[r2].index === i2 && (a2.globals.axisCharts ? (s2[i2].data = t3[r2].data.slice(), t3.splice(r2, 1), e2.splice(r2, 1), a2.globals.risingSeries.push(i2)) : (s2[i2] = t3[r2].data, t3.splice(r2, 1), e2.splice(r2, 1), a2.globals.risingSeries.push(i2)));
          s2 = this._getSeriesBasedOnCollapsedState(s2), this.lgCtx.ctx.updateHelpers._updateSeries(s2, a2.config.chart.animations.dynamicAnimation.enabled);
        }
      } }, { key: "_getSeriesBasedOnCollapsedState", value: function(t3) {
        var e2 = this.w;
        return e2.globals.axisCharts ? t3.forEach(function(i2, a2) {
          e2.globals.collapsedSeriesIndices.indexOf(a2) > -1 && (t3[a2].data = []);
        }) : t3.forEach(function(i2, a2) {
          e2.globals.collapsedSeriesIndices.indexOf(a2) > -1 && (t3[a2] = 0);
        }), t3;
      } }]), t2;
    }();
    var lt = function() {
      function t2(e2, i2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.onLegendClick = this.onLegendClick.bind(this), this.onLegendHovered = this.onLegendHovered.bind(this), this.isBarsDistributed = "bar" === this.w.config.chart.type && this.w.config.plotOptions.bar.distributed && 1 === this.w.config.series.length, this.legendHelpers = new nt(this);
      }
      return r(t2, [{ key: "init", value: function() {
        var t3 = this.w, e2 = t3.globals, i2 = t3.config;
        if ((i2.legend.showForSingleSeries && 1 === e2.series.length || this.isBarsDistributed || e2.series.length > 1 || !e2.axisCharts) && i2.legend.show) {
          for (; e2.dom.elLegendWrap.firstChild; )
            e2.dom.elLegendWrap.removeChild(e2.dom.elLegendWrap.firstChild);
          this.drawLegends(), p.isIE11() ? document.getElementsByTagName("head")[0].appendChild(this.legendHelpers.getLegendStyles()) : this.legendHelpers.appendToForeignObject(), "bottom" === i2.legend.position || "top" === i2.legend.position ? this.legendAlignHorizontal() : "right" !== i2.legend.position && "left" !== i2.legend.position || this.legendAlignVertical();
        }
      } }, { key: "drawLegends", value: function() {
        var t3 = this, e2 = this.w, i2 = e2.config.legend.fontFamily, a2 = e2.globals.seriesNames, s2 = e2.globals.colors.slice();
        if ("heatmap" === e2.config.chart.type) {
          var r2 = e2.config.plotOptions.heatmap.colorScale.ranges;
          a2 = r2.map(function(t4) {
            return t4.name ? t4.name : t4.from + " - " + t4.to;
          }), s2 = r2.map(function(t4) {
            return t4.color;
          });
        } else
          this.isBarsDistributed && (a2 = e2.globals.labels.slice());
        e2.config.legend.customLegendItems.length && (a2 = e2.config.legend.customLegendItems);
        for (var o2 = e2.globals.legendFormatter, n2 = e2.config.legend.inverseOrder, l2 = n2 ? a2.length - 1 : 0; n2 ? l2 >= 0 : l2 <= a2.length - 1; n2 ? l2-- : l2++) {
          var h2 = o2(a2[l2], { seriesIndex: l2, w: e2 }), c2 = false, d2 = false;
          if (e2.globals.collapsedSeries.length > 0)
            for (var g2 = 0; g2 < e2.globals.collapsedSeries.length; g2++)
              e2.globals.collapsedSeries[g2].index === l2 && (c2 = true);
          if (e2.globals.ancillaryCollapsedSeriesIndices.length > 0)
            for (var u2 = 0; u2 < e2.globals.ancillaryCollapsedSeriesIndices.length; u2++)
              e2.globals.ancillaryCollapsedSeriesIndices[u2] === l2 && (d2 = true);
          var f2 = document.createElement("span");
          f2.classList.add("apexcharts-legend-marker");
          var x2 = e2.config.legend.markers.offsetX, v2 = e2.config.legend.markers.offsetY, m2 = e2.config.legend.markers.height, w2 = e2.config.legend.markers.width, k2 = e2.config.legend.markers.strokeWidth, A2 = e2.config.legend.markers.strokeColor, S2 = e2.config.legend.markers.radius, C2 = f2.style;
          C2.background = s2[l2], C2.color = s2[l2], C2.setProperty("background", s2[l2], "important"), e2.config.legend.markers.fillColors && e2.config.legend.markers.fillColors[l2] && (C2.background = e2.config.legend.markers.fillColors[l2]), void 0 !== e2.globals.seriesColors[l2] && (C2.background = e2.globals.seriesColors[l2], C2.color = e2.globals.seriesColors[l2]), C2.height = Array.isArray(m2) ? parseFloat(m2[l2]) + "px" : parseFloat(m2) + "px", C2.width = Array.isArray(w2) ? parseFloat(w2[l2]) + "px" : parseFloat(w2) + "px", C2.left = (Array.isArray(x2) ? parseFloat(x2[l2]) : parseFloat(x2)) + "px", C2.top = (Array.isArray(v2) ? parseFloat(v2[l2]) : parseFloat(v2)) + "px", C2.borderWidth = Array.isArray(k2) ? k2[l2] : k2, C2.borderColor = Array.isArray(A2) ? A2[l2] : A2, C2.borderRadius = Array.isArray(S2) ? parseFloat(S2[l2]) + "px" : parseFloat(S2) + "px", e2.config.legend.markers.customHTML && (Array.isArray(e2.config.legend.markers.customHTML) ? e2.config.legend.markers.customHTML[l2] && (f2.innerHTML = e2.config.legend.markers.customHTML[l2]()) : f2.innerHTML = e2.config.legend.markers.customHTML()), b.setAttrs(f2, { rel: l2 + 1, "data:collapsed": c2 || d2 }), (c2 || d2) && f2.classList.add("apexcharts-inactive-legend");
          var L2 = document.createElement("div"), P2 = document.createElement("span");
          P2.classList.add("apexcharts-legend-text"), P2.innerHTML = Array.isArray(h2) ? h2.join(" ") : h2;
          var T2 = e2.config.legend.labels.useSeriesColors ? e2.globals.colors[l2] : e2.config.legend.labels.colors;
          T2 || (T2 = e2.config.chart.foreColor), P2.style.color = T2, P2.style.fontSize = parseFloat(e2.config.legend.fontSize) + "px", P2.style.fontWeight = e2.config.legend.fontWeight, P2.style.fontFamily = i2 || e2.config.chart.fontFamily, b.setAttrs(P2, { rel: l2 + 1, i: l2, "data:default-text": encodeURIComponent(h2), "data:collapsed": c2 || d2 }), L2.appendChild(f2), L2.appendChild(P2);
          var M2 = new y(this.ctx);
          if (!e2.config.legend.showForZeroSeries)
            0 === M2.getSeriesTotalByIndex(l2) && M2.seriesHaveSameValues(l2) && !M2.isSeriesNull(l2) && -1 === e2.globals.collapsedSeriesIndices.indexOf(l2) && -1 === e2.globals.ancillaryCollapsedSeriesIndices.indexOf(l2) && L2.classList.add("apexcharts-hidden-zero-series");
          e2.config.legend.showForNullSeries || M2.isSeriesNull(l2) && -1 === e2.globals.collapsedSeriesIndices.indexOf(l2) && -1 === e2.globals.ancillaryCollapsedSeriesIndices.indexOf(l2) && L2.classList.add("apexcharts-hidden-null-series"), e2.globals.dom.elLegendWrap.appendChild(L2), e2.globals.dom.elLegendWrap.classList.add("apexcharts-align-".concat(e2.config.legend.horizontalAlign)), e2.globals.dom.elLegendWrap.classList.add("apx-legend-position-" + e2.config.legend.position), L2.classList.add("apexcharts-legend-series"), L2.style.margin = "".concat(e2.config.legend.itemMargin.vertical, "px ").concat(e2.config.legend.itemMargin.horizontal, "px"), e2.globals.dom.elLegendWrap.style.width = e2.config.legend.width ? e2.config.legend.width + "px" : "", e2.globals.dom.elLegendWrap.style.height = e2.config.legend.height ? e2.config.legend.height + "px" : "", b.setAttrs(L2, { rel: l2 + 1, seriesName: p.escapeString(a2[l2]), "data:collapsed": c2 || d2 }), (c2 || d2) && L2.classList.add("apexcharts-inactive-legend"), e2.config.legend.onItemClick.toggleDataSeries || L2.classList.add("apexcharts-no-click");
        }
        e2.globals.dom.elWrap.addEventListener("click", t3.onLegendClick, true), e2.config.legend.onItemHover.highlightDataSeries && 0 === e2.config.legend.customLegendItems.length && (e2.globals.dom.elWrap.addEventListener("mousemove", t3.onLegendHovered, true), e2.globals.dom.elWrap.addEventListener("mouseout", t3.onLegendHovered, true));
      } }, { key: "setLegendWrapXY", value: function(t3, e2) {
        var i2 = this.w, a2 = i2.globals.dom.baseEl.querySelector(".apexcharts-legend"), s2 = a2.getBoundingClientRect(), r2 = 0, o2 = 0;
        if ("bottom" === i2.config.legend.position)
          o2 += i2.globals.svgHeight - s2.height / 2;
        else if ("top" === i2.config.legend.position) {
          var n2 = new ot(this.ctx), l2 = n2.dimHelpers.getTitleSubtitleCoords("title").height, h2 = n2.dimHelpers.getTitleSubtitleCoords("subtitle").height;
          o2 = o2 + (l2 > 0 ? l2 - 10 : 0) + (h2 > 0 ? h2 - 10 : 0);
        }
        a2.style.position = "absolute", r2 = r2 + t3 + i2.config.legend.offsetX, o2 = o2 + e2 + i2.config.legend.offsetY, a2.style.left = r2 + "px", a2.style.top = o2 + "px", "bottom" === i2.config.legend.position ? (a2.style.top = "auto", a2.style.bottom = 5 - i2.config.legend.offsetY + "px") : "right" === i2.config.legend.position && (a2.style.left = "auto", a2.style.right = 25 + i2.config.legend.offsetX + "px");
        ["width", "height"].forEach(function(t4) {
          a2.style[t4] && (a2.style[t4] = parseInt(i2.config.legend[t4], 10) + "px");
        });
      } }, { key: "legendAlignHorizontal", value: function() {
        var t3 = this.w;
        t3.globals.dom.baseEl.querySelector(".apexcharts-legend").style.right = 0;
        var e2 = this.legendHelpers.getLegendBBox(), i2 = new ot(this.ctx), a2 = i2.dimHelpers.getTitleSubtitleCoords("title"), s2 = i2.dimHelpers.getTitleSubtitleCoords("subtitle"), r2 = 0;
        "bottom" === t3.config.legend.position ? r2 = -e2.clwh / 1.8 : "top" === t3.config.legend.position && (r2 = a2.height + s2.height + t3.config.title.margin + t3.config.subtitle.margin - 10), this.setLegendWrapXY(20, r2);
      } }, { key: "legendAlignVertical", value: function() {
        var t3 = this.w, e2 = this.legendHelpers.getLegendBBox(), i2 = 0;
        "left" === t3.config.legend.position && (i2 = 20), "right" === t3.config.legend.position && (i2 = t3.globals.svgWidth - e2.clww - 10), this.setLegendWrapXY(i2, 20);
      } }, { key: "onLegendHovered", value: function(t3) {
        var e2 = this.w, i2 = t3.target.classList.contains("apexcharts-legend-text") || t3.target.classList.contains("apexcharts-legend-marker");
        if ("heatmap" === e2.config.chart.type || this.isBarsDistributed) {
          if (i2) {
            var a2 = parseInt(t3.target.getAttribute("rel"), 10) - 1;
            this.ctx.events.fireEvent("legendHover", [this.ctx, a2, this.w]), new z(this.ctx).highlightRangeInSeries(t3, t3.target);
          }
        } else
          !t3.target.classList.contains("apexcharts-inactive-legend") && i2 && new z(this.ctx).toggleSeriesOnHover(t3, t3.target);
      } }, { key: "onLegendClick", value: function(t3) {
        var e2 = this.w;
        if (!e2.config.legend.customLegendItems.length && (t3.target.classList.contains("apexcharts-legend-text") || t3.target.classList.contains("apexcharts-legend-marker"))) {
          var i2 = parseInt(t3.target.getAttribute("rel"), 10) - 1, a2 = "true" === t3.target.getAttribute("data:collapsed"), s2 = this.w.config.chart.events.legendClick;
          "function" == typeof s2 && s2(this.ctx, i2, this.w), this.ctx.events.fireEvent("legendClick", [this.ctx, i2, this.w]);
          var r2 = this.w.config.legend.markers.onClick;
          "function" == typeof r2 && t3.target.classList.contains("apexcharts-legend-marker") && (r2(this.ctx, i2, this.w), this.ctx.events.fireEvent("legendMarkerClick", [this.ctx, i2, this.w])), "treemap" !== e2.config.chart.type && "heatmap" !== e2.config.chart.type && !this.isBarsDistributed && e2.config.legend.onItemClick.toggleDataSeries && this.legendHelpers.toggleDataSeries(i2, a2);
        }
      } }]), t2;
    }();
    var ht = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var i2 = this.w;
        this.ev = this.w.config.chart.events, this.selectedClass = "apexcharts-selected", this.localeValues = this.w.globals.locale.toolbar, this.minX = i2.globals.minX, this.maxX = i2.globals.maxX;
      }
      return r(t2, [{ key: "createToolbar", value: function() {
        var t3 = this, e2 = this.w, i2 = function() {
          return document.createElement("div");
        }, a2 = i2();
        if (a2.setAttribute("class", "apexcharts-toolbar"), a2.style.top = e2.config.chart.toolbar.offsetY + "px", a2.style.right = 3 - e2.config.chart.toolbar.offsetX + "px", e2.globals.dom.elWrap.appendChild(a2), this.elZoom = i2(), this.elZoomIn = i2(), this.elZoomOut = i2(), this.elPan = i2(), this.elSelection = i2(), this.elZoomReset = i2(), this.elMenuIcon = i2(), this.elMenu = i2(), this.elCustomIcons = [], this.t = e2.config.chart.toolbar.tools, Array.isArray(this.t.customIcons))
          for (var s2 = 0; s2 < this.t.customIcons.length; s2++)
            this.elCustomIcons.push(i2());
        var r2 = [], o2 = function(i3, a3, s3) {
          var o3 = i3.toLowerCase();
          t3.t[o3] && e2.config.chart.zoom.enabled && r2.push({ el: a3, icon: "string" == typeof t3.t[o3] ? t3.t[o3] : s3, title: t3.localeValues[i3], class: "apexcharts-".concat(o3, "-icon") });
        };
        o2("zoomIn", this.elZoomIn, '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">\n    <path d="M0 0h24v24H0z" fill="none"/>\n    <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>\n</svg>\n'), o2("zoomOut", this.elZoomOut, '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">\n    <path d="M0 0h24v24H0z" fill="none"/>\n    <path d="M7 11v2h10v-2H7zm5-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>\n</svg>\n');
        var n2 = function(i3) {
          t3.t[i3] && e2.config.chart[i3].enabled && r2.push({ el: "zoom" === i3 ? t3.elZoom : t3.elSelection, icon: "string" == typeof t3.t[i3] ? t3.t[i3] : "zoom" === i3 ? '<svg xmlns="http://www.w3.org/2000/svg" fill="#000000" height="24" viewBox="0 0 24 24" width="24">\n    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>\n    <path d="M0 0h24v24H0V0z" fill="none"/>\n    <path d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z"/>\n</svg>' : '<svg fill="#6E8192" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">\n    <path d="M0 0h24v24H0z" fill="none"/>\n    <path d="M3 5h2V3c-1.1 0-2 .9-2 2zm0 8h2v-2H3v2zm4 8h2v-2H7v2zM3 9h2V7H3v2zm10-6h-2v2h2V3zm6 0v2h2c0-1.1-.9-2-2-2zM5 21v-2H3c0 1.1.9 2 2 2zm-2-4h2v-2H3v2zM9 3H7v2h2V3zm2 18h2v-2h-2v2zm8-8h2v-2h-2v2zm0 8c1.1 0 2-.9 2-2h-2v2zm0-12h2V7h-2v2zm0 8h2v-2h-2v2zm-4 4h2v-2h-2v2zm0-16h2V3h-2v2z"/>\n</svg>', title: t3.localeValues["zoom" === i3 ? "selectionZoom" : "selection"], class: e2.globals.isTouchDevice ? "apexcharts-element-hidden" : "apexcharts-".concat(i3, "-icon") });
        };
        n2("zoom"), n2("selection"), this.t.pan && e2.config.chart.zoom.enabled && r2.push({ el: this.elPan, icon: "string" == typeof this.t.pan ? this.t.pan : '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="24" viewBox="0 0 24 24" width="24">\n    <defs>\n        <path d="M0 0h24v24H0z" id="a"/>\n    </defs>\n    <clipPath id="b">\n        <use overflow="visible" xlink:href="#a"/>\n    </clipPath>\n    <path clip-path="url(#b)" d="M23 5.5V20c0 2.2-1.8 4-4 4h-7.3c-1.08 0-2.1-.43-2.85-1.19L1 14.83s1.26-1.23 1.3-1.25c.22-.19.49-.29.79-.29.22 0 .42.06.6.16.04.01 4.31 2.46 4.31 2.46V4c0-.83.67-1.5 1.5-1.5S11 3.17 11 4v7h1V1.5c0-.83.67-1.5 1.5-1.5S15 .67 15 1.5V11h1V2.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V11h1V5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5z"/>\n</svg>', title: this.localeValues.pan, class: e2.globals.isTouchDevice ? "apexcharts-element-hidden" : "apexcharts-pan-icon" }), o2("reset", this.elZoomReset, '<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">\n    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>\n    <path d="M0 0h24v24H0z" fill="none"/>\n</svg>'), this.t.download && r2.push({ el: this.elMenuIcon, icon: "string" == typeof this.t.download ? this.t.download : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>', title: this.localeValues.menu, class: "apexcharts-menu-icon" });
        for (var l2 = 0; l2 < this.elCustomIcons.length; l2++)
          r2.push({ el: this.elCustomIcons[l2], icon: this.t.customIcons[l2].icon, title: this.t.customIcons[l2].title, index: this.t.customIcons[l2].index, class: "apexcharts-toolbar-custom-icon " + this.t.customIcons[l2].class });
        r2.forEach(function(t4, e3) {
          t4.index && p.moveIndexInArray(r2, e3, t4.index);
        });
        for (var h2 = 0; h2 < r2.length; h2++)
          b.setAttrs(r2[h2].el, { class: r2[h2].class, title: r2[h2].title }), r2[h2].el.innerHTML = r2[h2].icon, a2.appendChild(r2[h2].el);
        this._createHamburgerMenu(a2), e2.globals.zoomEnabled ? this.elZoom.classList.add(this.selectedClass) : e2.globals.panEnabled ? this.elPan.classList.add(this.selectedClass) : e2.globals.selectionEnabled && this.elSelection.classList.add(this.selectedClass), this.addToolbarEventListeners();
      } }, { key: "_createHamburgerMenu", value: function(t3) {
        this.elMenuItems = [], t3.appendChild(this.elMenu), b.setAttrs(this.elMenu, { class: "apexcharts-menu" });
        var e2 = [{ name: "exportSVG", title: this.localeValues.exportToSVG }, { name: "exportPNG", title: this.localeValues.exportToPNG }, { name: "exportCSV", title: this.localeValues.exportToCSV }];
        this.w.globals.allSeriesHasEqualX || e2.splice(2, 1);
        for (var i2 = 0; i2 < e2.length; i2++)
          this.elMenuItems.push(document.createElement("div")), this.elMenuItems[i2].innerHTML = e2[i2].title, b.setAttrs(this.elMenuItems[i2], { class: "apexcharts-menu-item ".concat(e2[i2].name), title: e2[i2].title }), this.elMenu.appendChild(this.elMenuItems[i2]);
      } }, { key: "addToolbarEventListeners", value: function() {
        var t3 = this;
        this.elZoomReset.addEventListener("click", this.handleZoomReset.bind(this)), this.elSelection.addEventListener("click", this.toggleZoomSelection.bind(this, "selection")), this.elZoom.addEventListener("click", this.toggleZoomSelection.bind(this, "zoom")), this.elZoomIn.addEventListener("click", this.handleZoomIn.bind(this)), this.elZoomOut.addEventListener("click", this.handleZoomOut.bind(this)), this.elPan.addEventListener("click", this.togglePanning.bind(this)), this.elMenuIcon.addEventListener("click", this.toggleMenu.bind(this)), this.elMenuItems.forEach(function(e3) {
          e3.classList.contains("exportSVG") ? e3.addEventListener("click", t3.handleDownload.bind(t3, "svg")) : e3.classList.contains("exportPNG") ? e3.addEventListener("click", t3.handleDownload.bind(t3, "png")) : e3.classList.contains("exportCSV") && e3.addEventListener("click", t3.handleDownload.bind(t3, "csv"));
        });
        for (var e2 = 0; e2 < this.t.customIcons.length; e2++)
          this.elCustomIcons[e2].addEventListener("click", this.t.customIcons[e2].click.bind(this, this.ctx, this.ctx.w));
      } }, { key: "toggleZoomSelection", value: function(t3) {
        this.ctx.getSyncedCharts().forEach(function(e2) {
          e2.ctx.toolbar.toggleOtherControls();
          var i2 = "selection" === t3 ? e2.ctx.toolbar.elSelection : e2.ctx.toolbar.elZoom, a2 = "selection" === t3 ? "selectionEnabled" : "zoomEnabled";
          e2.w.globals[a2] = !e2.w.globals[a2], i2.classList.contains(e2.ctx.toolbar.selectedClass) ? i2.classList.remove(e2.ctx.toolbar.selectedClass) : i2.classList.add(e2.ctx.toolbar.selectedClass);
        });
      } }, { key: "getToolbarIconsReference", value: function() {
        var t3 = this.w;
        this.elZoom || (this.elZoom = t3.globals.dom.baseEl.querySelector(".apexcharts-zoom-icon")), this.elPan || (this.elPan = t3.globals.dom.baseEl.querySelector(".apexcharts-pan-icon")), this.elSelection || (this.elSelection = t3.globals.dom.baseEl.querySelector(".apexcharts-selection-icon"));
      } }, { key: "enableZoomPanFromToolbar", value: function(t3) {
        this.toggleOtherControls(), "pan" === t3 ? this.w.globals.panEnabled = true : this.w.globals.zoomEnabled = true;
        var e2 = "pan" === t3 ? this.elPan : this.elZoom, i2 = "pan" === t3 ? this.elZoom : this.elPan;
        e2 && e2.classList.add(this.selectedClass), i2 && i2.classList.remove(this.selectedClass);
      } }, { key: "togglePanning", value: function() {
        this.ctx.getSyncedCharts().forEach(function(t3) {
          t3.ctx.toolbar.toggleOtherControls(), t3.w.globals.panEnabled = !t3.w.globals.panEnabled, t3.ctx.toolbar.elPan.classList.contains(t3.ctx.toolbar.selectedClass) ? t3.ctx.toolbar.elPan.classList.remove(t3.ctx.toolbar.selectedClass) : t3.ctx.toolbar.elPan.classList.add(t3.ctx.toolbar.selectedClass);
        });
      } }, { key: "toggleOtherControls", value: function() {
        var t3 = this, e2 = this.w;
        e2.globals.panEnabled = false, e2.globals.zoomEnabled = false, e2.globals.selectionEnabled = false, this.getToolbarIconsReference(), [this.elPan, this.elSelection, this.elZoom].forEach(function(e3) {
          e3 && e3.classList.remove(t3.selectedClass);
        });
      } }, { key: "handleZoomIn", value: function() {
        var t3 = this.w;
        t3.globals.isTimelineBar && (this.minX = t3.globals.minY, this.maxX = t3.globals.maxY);
        var e2 = (this.minX + this.maxX) / 2, i2 = (this.minX + e2) / 2, a2 = (this.maxX + e2) / 2, s2 = this._getNewMinXMaxX(i2, a2);
        t3.globals.disableZoomIn || this.zoomUpdateOptions(s2.minX, s2.maxX);
      } }, { key: "handleZoomOut", value: function() {
        var t3 = this.w;
        if (t3.globals.isTimelineBar && (this.minX = t3.globals.minY, this.maxX = t3.globals.maxY), !("datetime" === t3.config.xaxis.type && new Date(this.minX).getUTCFullYear() < 1e3)) {
          var e2 = (this.minX + this.maxX) / 2, i2 = this.minX - (e2 - this.minX), a2 = this.maxX - (e2 - this.maxX), s2 = this._getNewMinXMaxX(i2, a2);
          t3.globals.disableZoomOut || this.zoomUpdateOptions(s2.minX, s2.maxX);
        }
      } }, { key: "_getNewMinXMaxX", value: function(t3, e2) {
        var i2 = this.w.config.xaxis.convertedCatToNumeric;
        return { minX: i2 ? Math.floor(t3) : t3, maxX: i2 ? Math.floor(e2) : e2 };
      } }, { key: "zoomUpdateOptions", value: function(t3, e2) {
        var i2 = this.w;
        if (void 0 !== t3 || void 0 !== e2) {
          if (!(i2.config.xaxis.convertedCatToNumeric && (t3 < 1 && (t3 = 1, e2 = i2.globals.dataPoints), e2 - t3 < 2))) {
            var a2 = { min: t3, max: e2 }, s2 = this.getBeforeZoomRange(a2);
            s2 && (a2 = s2.xaxis);
            var r2 = { xaxis: a2 }, o2 = p.clone(i2.globals.initialConfig.yaxis);
            if (i2.config.chart.zoom.autoScaleYaxis)
              o2 = new j(this.ctx).autoScaleY(this.ctx, o2, { xaxis: a2 });
            i2.config.chart.group || (r2.yaxis = o2), this.w.globals.zoomed = true, this.ctx.updateHelpers._updateOptions(r2, false, this.w.config.chart.animations.dynamicAnimation.enabled), this.zoomCallback(a2, o2);
          }
        } else
          this.handleZoomReset();
      } }, { key: "zoomCallback", value: function(t3, e2) {
        "function" == typeof this.ev.zoomed && this.ev.zoomed(this.ctx, { xaxis: t3, yaxis: e2 });
      } }, { key: "getBeforeZoomRange", value: function(t3, e2) {
        var i2 = null;
        return "function" == typeof this.ev.beforeZoom && (i2 = this.ev.beforeZoom(this, { xaxis: t3, yaxis: e2 })), i2;
      } }, { key: "toggleMenu", value: function() {
        var t3 = this;
        window.setTimeout(function() {
          t3.elMenu.classList.contains("apexcharts-menu-open") ? t3.elMenu.classList.remove("apexcharts-menu-open") : t3.elMenu.classList.add("apexcharts-menu-open");
        }, 0);
      } }, { key: "handleDownload", value: function(t3) {
        var e2 = this.w, i2 = new V(this.ctx);
        switch (t3) {
          case "svg":
            i2.exportToSVG(this.ctx);
            break;
          case "png":
            i2.exportToPng(this.ctx);
            break;
          case "csv":
            i2.exportToCSV({ series: e2.config.series, columnDelimiter: e2.config.chart.toolbar.export.csv.columnDelimiter });
        }
      } }, { key: "handleZoomReset", value: function(t3) {
        this.ctx.getSyncedCharts().forEach(function(t4) {
          var e2 = t4.w;
          if (e2.globals.lastXAxis.min = void 0, e2.globals.lastXAxis.max = void 0, t4.updateHelpers.revertDefaultAxisMinMax(), "function" == typeof e2.config.chart.events.beforeResetZoom) {
            var i2 = e2.config.chart.events.beforeResetZoom(t4, e2);
            i2 && t4.updateHelpers.revertDefaultAxisMinMax(i2);
          }
          "function" == typeof e2.config.chart.events.zoomed && t4.ctx.toolbar.zoomCallback({ min: e2.config.xaxis.min, max: e2.config.xaxis.max }), e2.globals.zoomed = false;
          var a2 = t4.ctx.series.emptyCollapsedSeries(p.clone(e2.globals.initialSeries));
          t4.updateHelpers._updateSeries(a2, e2.config.chart.animations.dynamicAnimation.enabled);
        });
      } }, { key: "destroy", value: function() {
        this.elZoom = null, this.elZoomIn = null, this.elZoomOut = null, this.elPan = null, this.elSelection = null, this.elZoomReset = null, this.elMenuIcon = null;
      } }]), t2;
    }();
    var ct = function(t2) {
      n(i2, ht);
      var e2 = d(i2);
      function i2(t3) {
        var s2;
        return a(this, i2), (s2 = e2.call(this, t3)).ctx = t3, s2.w = t3.w, s2.dragged = false, s2.graphics = new b(s2.ctx), s2.eventList = ["mousedown", "mouseleave", "mousemove", "touchstart", "touchmove", "mouseup", "touchend"], s2.clientX = 0, s2.clientY = 0, s2.startX = 0, s2.endX = 0, s2.dragX = 0, s2.startY = 0, s2.endY = 0, s2.dragY = 0, s2.moveDirection = "none", s2;
      }
      return r(i2, [{ key: "init", value: function(t3) {
        var e3 = this, i3 = t3.xyRatios, a2 = this.w, s2 = this;
        this.xyRatios = i3, this.zoomRect = this.graphics.drawRect(0, 0, 0, 0), this.selectionRect = this.graphics.drawRect(0, 0, 0, 0), this.gridRect = a2.globals.dom.baseEl.querySelector(".apexcharts-grid"), this.zoomRect.node.classList.add("apexcharts-zoom-rect"), this.selectionRect.node.classList.add("apexcharts-selection-rect"), a2.globals.dom.elGraphical.add(this.zoomRect), a2.globals.dom.elGraphical.add(this.selectionRect), "x" === a2.config.chart.selection.type ? this.slDraggableRect = this.selectionRect.draggable({ minX: 0, minY: 0, maxX: a2.globals.gridWidth, maxY: a2.globals.gridHeight }).on("dragmove", this.selectionDragging.bind(this, "dragging")) : "y" === a2.config.chart.selection.type ? this.slDraggableRect = this.selectionRect.draggable({ minX: 0, maxX: a2.globals.gridWidth }).on("dragmove", this.selectionDragging.bind(this, "dragging")) : this.slDraggableRect = this.selectionRect.draggable().on("dragmove", this.selectionDragging.bind(this, "dragging")), this.preselectedSelection(), this.hoverArea = a2.globals.dom.baseEl.querySelector("".concat(a2.globals.chartClass, " .apexcharts-svg")), this.hoverArea.classList.add("apexcharts-zoomable"), this.eventList.forEach(function(t4) {
          e3.hoverArea.addEventListener(t4, s2.svgMouseEvents.bind(s2, i3), { capture: false, passive: true });
        });
      } }, { key: "destroy", value: function() {
        this.slDraggableRect && (this.slDraggableRect.draggable(false), this.slDraggableRect.off(), this.selectionRect.off()), this.selectionRect = null, this.zoomRect = null, this.gridRect = null;
      } }, { key: "svgMouseEvents", value: function(t3, e3) {
        var i3 = this.w, a2 = this, s2 = this.ctx.toolbar, r2 = i3.globals.zoomEnabled ? i3.config.chart.zoom.type : i3.config.chart.selection.type, o2 = i3.config.chart.toolbar.autoSelected;
        e3.shiftKey ? (this.shiftWasPressed = true, s2.enableZoomPanFromToolbar("pan" === o2 ? "zoom" : "pan")) : this.shiftWasPressed && (s2.enableZoomPanFromToolbar(o2), this.shiftWasPressed = false);
        var n2 = e3.target.classList;
        if (!(n2.contains("apexcharts-selection-rect") || n2.contains("apexcharts-legend-marker") || n2.contains("apexcharts-legend-text") || e3.target.parentNode.classList.contains("apexcharts-toolbar"))) {
          if (a2.clientX = "touchmove" === e3.type || "touchstart" === e3.type ? e3.touches[0].clientX : "touchend" === e3.type ? e3.changedTouches[0].clientX : e3.clientX, a2.clientY = "touchmove" === e3.type || "touchstart" === e3.type ? e3.touches[0].clientY : "touchend" === e3.type ? e3.changedTouches[0].clientY : e3.clientY, "mousedown" === e3.type && 1 === e3.which) {
            var l2 = a2.gridRect.getBoundingClientRect();
            a2.startX = a2.clientX - l2.left, a2.startY = a2.clientY - l2.top, a2.dragged = false, a2.w.globals.mousedown = true;
          }
          if (("mousemove" === e3.type && 1 === e3.which || "touchmove" === e3.type) && (a2.dragged = true, i3.globals.panEnabled ? (i3.globals.selection = null, a2.w.globals.mousedown && a2.panDragging({ context: a2, zoomtype: r2, xyRatios: t3 })) : (a2.w.globals.mousedown && i3.globals.zoomEnabled || a2.w.globals.mousedown && i3.globals.selectionEnabled) && (a2.selection = a2.selectionDrawing({ context: a2, zoomtype: r2 }))), "mouseup" === e3.type || "touchend" === e3.type || "mouseleave" === e3.type) {
            var h2 = a2.gridRect.getBoundingClientRect();
            a2.w.globals.mousedown && (a2.endX = a2.clientX - h2.left, a2.endY = a2.clientY - h2.top, a2.dragX = Math.abs(a2.endX - a2.startX), a2.dragY = Math.abs(a2.endY - a2.startY), (i3.globals.zoomEnabled || i3.globals.selectionEnabled) && a2.selectionDrawn({ context: a2, zoomtype: r2 }), i3.globals.panEnabled && i3.config.xaxis.convertedCatToNumeric && a2.delayedPanScrolled()), i3.globals.zoomEnabled && a2.hideSelectionRect(this.selectionRect), a2.dragged = false, a2.w.globals.mousedown = false;
          }
          this.makeSelectionRectDraggable();
        }
      } }, { key: "makeSelectionRectDraggable", value: function() {
        var t3 = this.w;
        if (this.selectionRect) {
          var e3 = this.selectionRect.node.getBoundingClientRect();
          e3.width > 0 && e3.height > 0 && this.slDraggableRect.selectize({ points: "l, r", pointSize: 8, pointType: "rect" }).resize({ constraint: { minX: 0, minY: 0, maxX: t3.globals.gridWidth, maxY: t3.globals.gridHeight } }).on("resizing", this.selectionDragging.bind(this, "resizing"));
        }
      } }, { key: "preselectedSelection", value: function() {
        var t3 = this.w, e3 = this.xyRatios;
        if (!t3.globals.zoomEnabled) {
          if (void 0 !== t3.globals.selection && null !== t3.globals.selection)
            this.drawSelectionRect(t3.globals.selection);
          else if (void 0 !== t3.config.chart.selection.xaxis.min && void 0 !== t3.config.chart.selection.xaxis.max) {
            var i3 = (t3.config.chart.selection.xaxis.min - t3.globals.minX) / e3.xRatio, a2 = { x: i3, y: 0, width: t3.globals.gridWidth - (t3.globals.maxX - t3.config.chart.selection.xaxis.max) / e3.xRatio - i3, height: t3.globals.gridHeight, translateX: 0, translateY: 0, selectionEnabled: true };
            this.drawSelectionRect(a2), this.makeSelectionRectDraggable(), "function" == typeof t3.config.chart.events.selection && t3.config.chart.events.selection(this.ctx, { xaxis: { min: t3.config.chart.selection.xaxis.min, max: t3.config.chart.selection.xaxis.max }, yaxis: {} });
          }
        }
      } }, { key: "drawSelectionRect", value: function(t3) {
        var e3 = t3.x, i3 = t3.y, a2 = t3.width, s2 = t3.height, r2 = t3.translateX, o2 = void 0 === r2 ? 0 : r2, n2 = t3.translateY, l2 = void 0 === n2 ? 0 : n2, h2 = this.w, c2 = this.zoomRect, d2 = this.selectionRect;
        if (this.dragged || null !== h2.globals.selection) {
          var g2 = { transform: "translate(" + o2 + ", " + l2 + ")" };
          h2.globals.zoomEnabled && this.dragged && (a2 < 0 && (a2 = 1), c2.attr({ x: e3, y: i3, width: a2, height: s2, fill: h2.config.chart.zoom.zoomedArea.fill.color, "fill-opacity": h2.config.chart.zoom.zoomedArea.fill.opacity, stroke: h2.config.chart.zoom.zoomedArea.stroke.color, "stroke-width": h2.config.chart.zoom.zoomedArea.stroke.width, "stroke-opacity": h2.config.chart.zoom.zoomedArea.stroke.opacity }), b.setAttrs(c2.node, g2)), h2.globals.selectionEnabled && (d2.attr({ x: e3, y: i3, width: a2 > 0 ? a2 : 0, height: s2 > 0 ? s2 : 0, fill: h2.config.chart.selection.fill.color, "fill-opacity": h2.config.chart.selection.fill.opacity, stroke: h2.config.chart.selection.stroke.color, "stroke-width": h2.config.chart.selection.stroke.width, "stroke-dasharray": h2.config.chart.selection.stroke.dashArray, "stroke-opacity": h2.config.chart.selection.stroke.opacity }), b.setAttrs(d2.node, g2));
        }
      } }, { key: "hideSelectionRect", value: function(t3) {
        t3 && t3.attr({ x: 0, y: 0, width: 0, height: 0 });
      } }, { key: "selectionDrawing", value: function(t3) {
        var e3 = t3.context, i3 = t3.zoomtype, a2 = this.w, s2 = e3, r2 = this.gridRect.getBoundingClientRect(), o2 = s2.startX - 1, n2 = s2.startY, l2 = false, h2 = false, c2 = s2.clientX - r2.left - o2, d2 = s2.clientY - r2.top - n2, g2 = {};
        return Math.abs(c2 + o2) > a2.globals.gridWidth ? c2 = a2.globals.gridWidth - o2 : s2.clientX - r2.left < 0 && (c2 = o2), o2 > s2.clientX - r2.left && (l2 = true, c2 = Math.abs(c2)), n2 > s2.clientY - r2.top && (h2 = true, d2 = Math.abs(d2)), g2 = "x" === i3 ? { x: l2 ? o2 - c2 : o2, y: 0, width: c2, height: a2.globals.gridHeight } : "y" === i3 ? { x: 0, y: h2 ? n2 - d2 : n2, width: a2.globals.gridWidth, height: d2 } : { x: l2 ? o2 - c2 : o2, y: h2 ? n2 - d2 : n2, width: c2, height: d2 }, s2.drawSelectionRect(g2), s2.selectionDragging("resizing"), g2;
      } }, { key: "selectionDragging", value: function(t3, e3) {
        var i3 = this, a2 = this.w, s2 = this.xyRatios, r2 = this.selectionRect, o2 = 0;
        "resizing" === t3 && (o2 = 30);
        var n2 = function(t4) {
          return parseFloat(r2.node.getAttribute(t4));
        }, l2 = { x: n2("x"), y: n2("y"), width: n2("width"), height: n2("height") };
        a2.globals.selection = l2, "function" == typeof a2.config.chart.events.selection && a2.globals.selectionEnabled && (clearTimeout(this.w.globals.selectionResizeTimer), this.w.globals.selectionResizeTimer = window.setTimeout(function() {
          var t4 = i3.gridRect.getBoundingClientRect(), e4 = r2.node.getBoundingClientRect(), o3 = { xaxis: { min: a2.globals.xAxisScale.niceMin + (e4.left - t4.left) * s2.xRatio, max: a2.globals.xAxisScale.niceMin + (e4.right - t4.left) * s2.xRatio }, yaxis: { min: a2.globals.yAxisScale[0].niceMin + (t4.bottom - e4.bottom) * s2.yRatio[0], max: a2.globals.yAxisScale[0].niceMax - (e4.top - t4.top) * s2.yRatio[0] } };
          a2.config.chart.events.selection(i3.ctx, o3), a2.config.chart.brush.enabled && void 0 !== a2.config.chart.events.brushScrolled && a2.config.chart.events.brushScrolled(i3.ctx, o3);
        }, o2));
      } }, { key: "selectionDrawn", value: function(t3) {
        var e3 = t3.context, i3 = t3.zoomtype, a2 = this.w, s2 = e3, r2 = this.xyRatios, o2 = this.ctx.toolbar;
        if (s2.startX > s2.endX) {
          var n2 = s2.startX;
          s2.startX = s2.endX, s2.endX = n2;
        }
        if (s2.startY > s2.endY) {
          var l2 = s2.startY;
          s2.startY = s2.endY, s2.endY = l2;
        }
        var h2 = void 0, c2 = void 0;
        a2.globals.isTimelineBar ? (h2 = a2.globals.yAxisScale[0].niceMin + s2.startX * r2.invertedYRatio, c2 = a2.globals.yAxisScale[0].niceMin + s2.endX * r2.invertedYRatio) : (h2 = a2.globals.xAxisScale.niceMin + s2.startX * r2.xRatio, c2 = a2.globals.xAxisScale.niceMin + s2.endX * r2.xRatio);
        var d2 = [], g2 = [];
        if (a2.config.yaxis.forEach(function(t4, e4) {
          d2.push(a2.globals.yAxisScale[e4].niceMax - r2.yRatio[e4] * s2.startY), g2.push(a2.globals.yAxisScale[e4].niceMax - r2.yRatio[e4] * s2.endY);
        }), s2.dragged && (s2.dragX > 10 || s2.dragY > 10) && h2 !== c2) {
          if (a2.globals.zoomEnabled) {
            var u2 = p.clone(a2.globals.initialConfig.yaxis), f2 = p.clone(a2.globals.initialConfig.xaxis);
            if (a2.globals.zoomed = true, a2.config.xaxis.convertedCatToNumeric && (h2 = Math.floor(h2), c2 = Math.floor(c2), h2 < 1 && (h2 = 1, c2 = a2.globals.dataPoints), c2 - h2 < 2 && (c2 = h2 + 1)), "xy" !== i3 && "x" !== i3 || (f2 = { min: h2, max: c2 }), "xy" !== i3 && "y" !== i3 || u2.forEach(function(t4, e4) {
              u2[e4].min = g2[e4], u2[e4].max = d2[e4];
            }), a2.config.chart.zoom.autoScaleYaxis) {
              var x2 = new j(s2.ctx);
              u2 = x2.autoScaleY(s2.ctx, u2, { xaxis: f2 });
            }
            if (o2) {
              var b2 = o2.getBeforeZoomRange(f2, u2);
              b2 && (f2 = b2.xaxis ? b2.xaxis : f2, u2 = b2.yaxis ? b2.yaxis : u2);
            }
            var v2 = { xaxis: f2 };
            a2.config.chart.group || (v2.yaxis = u2), s2.ctx.updateHelpers._updateOptions(v2, false, s2.w.config.chart.animations.dynamicAnimation.enabled), "function" == typeof a2.config.chart.events.zoomed && o2.zoomCallback(f2, u2);
          } else if (a2.globals.selectionEnabled) {
            var m2, y2 = null;
            m2 = { min: h2, max: c2 }, "xy" !== i3 && "y" !== i3 || (y2 = p.clone(a2.config.yaxis)).forEach(function(t4, e4) {
              y2[e4].min = g2[e4], y2[e4].max = d2[e4];
            }), a2.globals.selection = s2.selection, "function" == typeof a2.config.chart.events.selection && a2.config.chart.events.selection(s2.ctx, { xaxis: m2, yaxis: y2 });
          }
        }
      } }, { key: "panDragging", value: function(t3) {
        var e3 = t3.context, i3 = this.w, a2 = e3;
        if (void 0 !== i3.globals.lastClientPosition.x) {
          var s2 = i3.globals.lastClientPosition.x - a2.clientX, r2 = i3.globals.lastClientPosition.y - a2.clientY;
          Math.abs(s2) > Math.abs(r2) && s2 > 0 ? this.moveDirection = "left" : Math.abs(s2) > Math.abs(r2) && s2 < 0 ? this.moveDirection = "right" : Math.abs(r2) > Math.abs(s2) && r2 > 0 ? this.moveDirection = "up" : Math.abs(r2) > Math.abs(s2) && r2 < 0 && (this.moveDirection = "down");
        }
        i3.globals.lastClientPosition = { x: a2.clientX, y: a2.clientY };
        var o2 = i3.globals.isTimelineBar ? i3.globals.minY : i3.globals.minX, n2 = i3.globals.isTimelineBar ? i3.globals.maxY : i3.globals.maxX;
        i3.config.xaxis.convertedCatToNumeric || a2.panScrolled(o2, n2);
      } }, { key: "delayedPanScrolled", value: function() {
        var t3 = this.w, e3 = t3.globals.minX, i3 = t3.globals.maxX, a2 = (t3.globals.maxX - t3.globals.minX) / 2;
        "left" === this.moveDirection ? (e3 = t3.globals.minX + a2, i3 = t3.globals.maxX + a2) : "right" === this.moveDirection && (e3 = t3.globals.minX - a2, i3 = t3.globals.maxX - a2), e3 = Math.floor(e3), i3 = Math.floor(i3), this.updateScrolledChart({ xaxis: { min: e3, max: i3 } }, e3, i3);
      } }, { key: "panScrolled", value: function(t3, e3) {
        var i3 = this.w, a2 = this.xyRatios, s2 = p.clone(i3.globals.initialConfig.yaxis), r2 = a2.xRatio, o2 = i3.globals.minX, n2 = i3.globals.maxX;
        i3.globals.isTimelineBar && (r2 = a2.invertedYRatio, o2 = i3.globals.minY, n2 = i3.globals.maxY), "left" === this.moveDirection ? (t3 = o2 + i3.globals.gridWidth / 15 * r2, e3 = n2 + i3.globals.gridWidth / 15 * r2) : "right" === this.moveDirection && (t3 = o2 - i3.globals.gridWidth / 15 * r2, e3 = n2 - i3.globals.gridWidth / 15 * r2), i3.globals.isTimelineBar || (t3 < i3.globals.initialMinX || e3 > i3.globals.initialMaxX) && (t3 = o2, e3 = n2);
        var l2 = { min: t3, max: e3 };
        i3.config.chart.zoom.autoScaleYaxis && (s2 = new j(this.ctx).autoScaleY(this.ctx, s2, { xaxis: l2 }));
        var h2 = { xaxis: { min: t3, max: e3 } };
        i3.config.chart.group || (h2.yaxis = s2), this.updateScrolledChart(h2, t3, e3);
      } }, { key: "updateScrolledChart", value: function(t3, e3, i3) {
        var a2 = this.w;
        this.ctx.updateHelpers._updateOptions(t3, false, false), "function" == typeof a2.config.chart.events.scrolled && a2.config.chart.events.scrolled(this.ctx, { xaxis: { min: e3, max: i3 } });
      } }]), i2;
    }();
    var dt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.ttCtx = e2, this.ctx = e2.ctx;
      }
      return r(t2, [{ key: "getNearestValues", value: function(t3) {
        var e2 = t3.hoverArea, i2 = t3.elGrid, a2 = t3.clientX, s2 = t3.clientY, r2 = this.w, o2 = r2.globals.gridWidth, n2 = r2.globals.gridHeight, l2 = o2 / (r2.globals.dataPoints - 1), h2 = n2 / r2.globals.dataPoints, c2 = i2.getBoundingClientRect(), d2 = this.hasBars();
        !r2.globals.comboCharts && !d2 || r2.config.xaxis.convertedCatToNumeric || (l2 = o2 / r2.globals.dataPoints);
        var g2 = a2 - c2.left - r2.globals.barPadForNumericAxis, u2 = s2 - c2.top;
        g2 < 0 || u2 < 0 || g2 > r2.globals.gridWidth || u2 > r2.globals.gridHeight ? (e2.classList.remove("hovering-zoom"), e2.classList.remove("hovering-pan")) : r2.globals.zoomEnabled ? (e2.classList.remove("hovering-pan"), e2.classList.add("hovering-zoom")) : r2.globals.panEnabled && (e2.classList.remove("hovering-zoom"), e2.classList.add("hovering-pan"));
        var f2 = Math.round(g2 / l2), x2 = Math.floor(u2 / h2);
        d2 && !r2.config.xaxis.convertedCatToNumeric && (f2 = Math.ceil(g2 / l2), f2 -= 1);
        for (var b2, v2 = null, m2 = null, y2 = [], w2 = 0; w2 < r2.globals.seriesXvalues.length; w2++)
          y2.push([r2.globals.seriesXvalues[w2][0] - 1e-6].concat(r2.globals.seriesXvalues[w2]));
        return y2 = y2.map(function(t4) {
          return t4.filter(function(t5) {
            return t5;
          });
        }), b2 = r2.globals.seriesYvalues.map(function(t4) {
          return t4.filter(function(t5) {
            return p.isNumber(t5);
          });
        }), r2.globals.isXNumeric && (v2 = (m2 = this.closestInMultiArray(g2, u2, y2, b2)).index, f2 = m2.j, null !== v2 && (y2 = r2.globals.seriesXvalues[v2], f2 = (m2 = this.closestInArray(g2, y2)).index)), r2.globals.capturedSeriesIndex = null === v2 ? -1 : v2, (!f2 || f2 < 1) && (f2 = 0), r2.globals.isBarHorizontal ? r2.globals.capturedDataPointIndex = x2 : r2.globals.capturedDataPointIndex = f2, { capturedSeries: v2, j: r2.globals.isBarHorizontal ? x2 : f2, hoverX: g2, hoverY: u2 };
      } }, { key: "closestInMultiArray", value: function(t3, e2, i2, a2) {
        var s2 = this.w, r2 = 0, o2 = null, n2 = -1;
        s2.globals.series.length > 1 ? r2 = this.getFirstActiveXArray(i2) : o2 = 0;
        var l2 = a2[r2][0], h2 = i2[r2][0], c2 = Math.abs(t3 - h2), d2 = Math.abs(e2 - l2), g2 = d2 + c2;
        return a2.map(function(s3, r3) {
          s3.map(function(s4, l3) {
            var h3 = Math.abs(e2 - a2[r3][l3]), u2 = Math.abs(t3 - i2[r3][l3]), p2 = u2 + h3;
            p2 < g2 && (g2 = p2, c2 = u2, d2 = h3, o2 = r3, n2 = l3);
          });
        }), { index: o2, j: n2 };
      } }, { key: "getFirstActiveXArray", value: function(t3) {
        for (var e2 = 0, i2 = t3.map(function(t4, e3) {
          return t4.length > 0 ? e3 : -1;
        }), a2 = 0; a2 < i2.length; a2++)
          if (-1 !== i2[a2]) {
            e2 = i2[a2];
            break;
          }
        return e2;
      } }, { key: "closestInArray", value: function(t3, e2) {
        for (var i2 = e2[0], a2 = null, s2 = Math.abs(t3 - i2), r2 = 0; r2 < e2.length; r2++) {
          var o2 = Math.abs(t3 - e2[r2]);
          o2 < s2 && (s2 = o2, a2 = r2);
        }
        return { index: a2 };
      } }, { key: "isXoverlap", value: function(t3) {
        var e2 = [], i2 = this.w.globals.seriesX.filter(function(t4) {
          return void 0 !== t4[0];
        });
        if (i2.length > 0)
          for (var a2 = 0; a2 < i2.length - 1; a2++)
            void 0 !== i2[a2][t3] && void 0 !== i2[a2 + 1][t3] && i2[a2][t3] !== i2[a2 + 1][t3] && e2.push("unEqual");
        return 0 === e2.length;
      } }, { key: "isInitialSeriesSameLen", value: function() {
        for (var t3 = true, e2 = this.w.globals.initialSeries, i2 = 0; i2 < e2.length - 1; i2++)
          if (e2[i2].data.length !== e2[i2 + 1].data.length) {
            t3 = false;
            break;
          }
        return t3;
      } }, { key: "getBarsHeight", value: function(t3) {
        return g(t3).reduce(function(t4, e2) {
          return t4 + e2.getBBox().height;
        }, 0);
      } }, { key: "getElMarkers", value: function() {
        return this.w.globals.dom.baseEl.querySelectorAll(" .apexcharts-series-markers");
      } }, { key: "getAllMarkers", value: function() {
        var t3 = this.w.globals.dom.baseEl.querySelectorAll(".apexcharts-series-markers-wrap");
        (t3 = g(t3)).sort(function(t4, e3) {
          return Number(e3.getAttribute("data:realIndex")) < Number(t4.getAttribute("data:realIndex")) ? 0 : -1;
        });
        var e2 = [];
        return t3.forEach(function(t4) {
          e2.push(t4.querySelector(".apexcharts-marker"));
        }), e2;
      } }, { key: "hasMarkers", value: function() {
        return this.getElMarkers().length > 0;
      } }, { key: "getElBars", value: function() {
        return this.w.globals.dom.baseEl.querySelectorAll(".apexcharts-bar-series,  .apexcharts-candlestick-series, .apexcharts-boxPlot-series, .apexcharts-rangebar-series");
      } }, { key: "hasBars", value: function() {
        return this.getElBars().length > 0;
      } }, { key: "getHoverMarkerSize", value: function(t3) {
        var e2 = this.w, i2 = e2.config.markers.hover.size;
        return void 0 === i2 && (i2 = e2.globals.markers.size[t3] + e2.config.markers.hover.sizeOffset), i2;
      } }, { key: "toggleAllTooltipSeriesGroups", value: function(t3) {
        var e2 = this.w, i2 = this.ttCtx;
        0 === i2.allTooltipSeriesGroups.length && (i2.allTooltipSeriesGroups = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-tooltip-series-group"));
        for (var a2 = i2.allTooltipSeriesGroups, s2 = 0; s2 < a2.length; s2++)
          "enable" === t3 ? (a2[s2].classList.add("apexcharts-active"), a2[s2].style.display = e2.config.tooltip.items.display) : (a2[s2].classList.remove("apexcharts-active"), a2[s2].style.display = "none");
      } }]), t2;
    }();
    var gt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.ctx = e2.ctx, this.ttCtx = e2, this.tooltipUtil = new dt(e2);
      }
      return r(t2, [{ key: "drawSeriesTexts", value: function(t3) {
        var e2 = t3.shared, i2 = void 0 === e2 || e2, a2 = t3.ttItems, s2 = t3.i, r2 = void 0 === s2 ? 0 : s2, o2 = t3.j, n2 = void 0 === o2 ? null : o2, l2 = t3.y1, h2 = t3.y2, c2 = t3.e, d2 = this.w;
        void 0 !== d2.config.tooltip.custom ? this.handleCustomTooltip({ i: r2, j: n2, y1: l2, y2: h2, w: d2 }) : this.toggleActiveInactiveSeries(i2);
        var g2 = this.getValuesToPrint({ i: r2, j: n2 });
        this.printLabels({ i: r2, j: n2, values: g2, ttItems: a2, shared: i2, e: c2 });
        var u2 = this.ttCtx.getElTooltip();
        this.ttCtx.tooltipRect.ttWidth = u2.getBoundingClientRect().width, this.ttCtx.tooltipRect.ttHeight = u2.getBoundingClientRect().height;
      } }, { key: "printLabels", value: function(t3) {
        var i2, a2 = this, s2 = t3.i, r2 = t3.j, o2 = t3.values, n2 = t3.ttItems, l2 = t3.shared, h2 = t3.e, c2 = this.w, d2 = [], g2 = function(t4) {
          return c2.globals.seriesGoals[t4] && c2.globals.seriesGoals[t4][r2] && Array.isArray(c2.globals.seriesGoals[t4][r2]);
        }, u2 = o2.xVal, p2 = o2.zVal, f2 = o2.xAxisTTVal, x2 = "", b2 = c2.globals.colors[s2];
        null !== r2 && c2.config.plotOptions.bar.distributed && (b2 = c2.globals.colors[r2]);
        for (var v2 = function(t4, o3) {
          var v3 = a2.getFormatters(s2);
          x2 = a2.getSeriesName({ fn: v3.yLbTitleFormatter, index: s2, seriesIndex: s2, j: r2 }), "treemap" === c2.config.chart.type && (x2 = v3.yLbTitleFormatter(String(c2.config.series[s2].data[r2].x), { series: c2.globals.series, seriesIndex: s2, dataPointIndex: r2, w: c2 }));
          var m3 = c2.config.tooltip.inverseOrder ? o3 : t4;
          if (c2.globals.axisCharts) {
            var y3 = function(t5) {
              return v3.yLbFormatter(c2.globals.series[t5][r2], { series: c2.globals.series, seriesIndex: t5, dataPointIndex: r2, w: c2 });
            };
            l2 ? (v3 = a2.getFormatters(m3), x2 = a2.getSeriesName({ fn: v3.yLbTitleFormatter, index: m3, seriesIndex: s2, j: r2 }), b2 = c2.globals.colors[m3], i2 = y3(m3), g2(m3) && (d2 = c2.globals.seriesGoals[m3][r2].map(function(t5) {
              return { attrs: t5, val: v3.yLbFormatter(t5.value, { seriesIndex: m3, dataPointIndex: r2, w: c2 }) };
            }))) : (h2 && h2.target && h2.target.getAttribute("fill") && (b2 = h2.target.getAttribute("fill")), i2 = y3(s2), g2(s2) && Array.isArray(c2.globals.seriesGoals[s2][r2]) && (d2 = c2.globals.seriesGoals[s2][r2].map(function(t5) {
              return { attrs: t5, val: v3.yLbFormatter(t5.value, { seriesIndex: s2, dataPointIndex: r2, w: c2 }) };
            })));
          }
          null === r2 && (i2 = v3.yLbFormatter(c2.globals.series[s2], e(e({}, c2), {}, { seriesIndex: s2, dataPointIndex: s2 }))), a2.DOMHandling({ i: s2, t: m3, j: r2, ttItems: n2, values: { val: i2, goalVals: d2, xVal: u2, xAxisTTVal: f2, zVal: p2 }, seriesName: x2, shared: l2, pColor: b2 });
        }, m2 = 0, y2 = c2.globals.series.length - 1; m2 < c2.globals.series.length; m2++, y2--)
          v2(m2, y2);
      } }, { key: "getFormatters", value: function(t3) {
        var e2, i2 = this.w, a2 = i2.globals.yLabelFormatters[t3];
        return void 0 !== i2.globals.ttVal ? Array.isArray(i2.globals.ttVal) ? (a2 = i2.globals.ttVal[t3] && i2.globals.ttVal[t3].formatter, e2 = i2.globals.ttVal[t3] && i2.globals.ttVal[t3].title && i2.globals.ttVal[t3].title.formatter) : (a2 = i2.globals.ttVal.formatter, "function" == typeof i2.globals.ttVal.title.formatter && (e2 = i2.globals.ttVal.title.formatter)) : e2 = i2.config.tooltip.y.title.formatter, "function" != typeof a2 && (a2 = i2.globals.yLabelFormatters[0] ? i2.globals.yLabelFormatters[0] : function(t4) {
          return t4;
        }), "function" != typeof e2 && (e2 = function(t4) {
          return t4;
        }), { yLbFormatter: a2, yLbTitleFormatter: e2 };
      } }, { key: "getSeriesName", value: function(t3) {
        var e2 = t3.fn, i2 = t3.index, a2 = t3.seriesIndex, s2 = t3.j, r2 = this.w;
        return e2(String(r2.globals.seriesNames[i2]), { series: r2.globals.series, seriesIndex: a2, dataPointIndex: s2, w: r2 });
      } }, { key: "DOMHandling", value: function(t3) {
        t3.i;
        var e2 = t3.t, i2 = t3.j, a2 = t3.ttItems, s2 = t3.values, r2 = t3.seriesName, o2 = t3.shared, n2 = t3.pColor, l2 = this.w, h2 = this.ttCtx, c2 = s2.val, d2 = s2.goalVals, g2 = s2.xVal, u2 = s2.xAxisTTVal, p2 = s2.zVal, f2 = null;
        f2 = a2[e2].children, l2.config.tooltip.fillSeriesColor && (a2[e2].style.backgroundColor = n2, f2[0].style.display = "none"), h2.showTooltipTitle && (null === h2.tooltipTitle && (h2.tooltipTitle = l2.globals.dom.baseEl.querySelector(".apexcharts-tooltip-title")), h2.tooltipTitle.innerHTML = g2), h2.blxaxisTooltip && (h2.xaxisTooltipText.innerHTML = "" !== u2 ? u2 : g2);
        var x2 = a2[e2].querySelector(".apexcharts-tooltip-text-y-label");
        x2 && (x2.innerHTML = r2 || "");
        var b2 = a2[e2].querySelector(".apexcharts-tooltip-text-y-value");
        b2 && (b2.innerHTML = void 0 !== c2 ? c2 : ""), f2[0] && f2[0].classList.contains("apexcharts-tooltip-marker") && (l2.config.tooltip.marker.fillColors && Array.isArray(l2.config.tooltip.marker.fillColors) && (n2 = l2.config.tooltip.marker.fillColors[e2]), f2[0].style.backgroundColor = n2), l2.config.tooltip.marker.show || (f2[0].style.display = "none");
        var v2 = a2[e2].querySelector(".apexcharts-tooltip-text-goals-label"), m2 = a2[e2].querySelector(".apexcharts-tooltip-text-goals-value");
        if (d2.length && l2.globals.seriesGoals[e2]) {
          var y2 = function() {
            var t4 = "<div >", e3 = "<div>";
            d2.forEach(function(i3, a3) {
              t4 += ' <div style="display: flex"><span class="apexcharts-tooltip-marker" style="background-color: '.concat(i3.attrs.strokeColor, '; height: 3px; border-radius: 0; top: 5px;"></span> ').concat(i3.attrs.name, "</div>"), e3 += "<div>".concat(i3.val, "</div>");
            }), v2.innerHTML = t4 + "</div>", m2.innerHTML = e3 + "</div>";
          };
          o2 ? l2.globals.seriesGoals[e2][i2] && Array.isArray(l2.globals.seriesGoals[e2][i2]) ? y2() : (v2.innerHTML = "", m2.innerHTML = "") : y2();
        } else
          v2.innerHTML = "", m2.innerHTML = "";
        null !== p2 && (a2[e2].querySelector(".apexcharts-tooltip-text-z-label").innerHTML = l2.config.tooltip.z.title, a2[e2].querySelector(".apexcharts-tooltip-text-z-value").innerHTML = void 0 !== p2 ? p2 : "");
        o2 && f2[0] && (null == c2 || l2.globals.collapsedSeriesIndices.indexOf(e2) > -1 ? f2[0].parentNode.style.display = "none" : f2[0].parentNode.style.display = l2.config.tooltip.items.display);
      } }, { key: "toggleActiveInactiveSeries", value: function(t3) {
        var e2 = this.w;
        if (t3)
          this.tooltipUtil.toggleAllTooltipSeriesGroups("enable");
        else {
          this.tooltipUtil.toggleAllTooltipSeriesGroups("disable");
          var i2 = e2.globals.dom.baseEl.querySelector(".apexcharts-tooltip-series-group");
          i2 && (i2.classList.add("apexcharts-active"), i2.style.display = e2.config.tooltip.items.display);
        }
      } }, { key: "getValuesToPrint", value: function(t3) {
        var e2 = t3.i, i2 = t3.j, a2 = this.w, s2 = this.ctx.series.filteredSeriesX(), r2 = "", o2 = "", n2 = null, l2 = null, h2 = { series: a2.globals.series, seriesIndex: e2, dataPointIndex: i2, w: a2 }, c2 = a2.globals.ttZFormatter;
        null === i2 ? l2 = a2.globals.series[e2] : a2.globals.isXNumeric && "treemap" !== a2.config.chart.type ? (r2 = s2[e2][i2], 0 === s2[e2].length && (r2 = s2[this.tooltipUtil.getFirstActiveXArray(s2)][i2])) : r2 = void 0 !== a2.globals.labels[i2] ? a2.globals.labels[i2] : "";
        var d2 = r2;
        a2.globals.isXNumeric && "datetime" === a2.config.xaxis.type ? r2 = new W(this.ctx).xLabelFormat(a2.globals.ttKeyFormatter, d2, d2, { i: void 0, dateFormatter: new Y(this.ctx).formatDate, w: this.w }) : r2 = a2.globals.isBarHorizontal ? a2.globals.yLabelFormatters[0](d2, h2) : a2.globals.xLabelFormatter(d2, h2);
        return void 0 !== a2.config.tooltip.x.formatter && (r2 = a2.globals.ttKeyFormatter(d2, h2)), a2.globals.seriesZ.length > 0 && a2.globals.seriesZ[e2].length > 0 && (n2 = c2(a2.globals.seriesZ[e2][i2], a2)), o2 = "function" == typeof a2.config.xaxis.tooltip.formatter ? a2.globals.xaxisTooltipFormatter(d2, h2) : r2, { val: Array.isArray(l2) ? l2.join(" ") : l2, xVal: Array.isArray(r2) ? r2.join(" ") : r2, xAxisTTVal: Array.isArray(o2) ? o2.join(" ") : o2, zVal: n2 };
      } }, { key: "handleCustomTooltip", value: function(t3) {
        var e2 = t3.i, i2 = t3.j, a2 = t3.y1, s2 = t3.y2, r2 = t3.w, o2 = this.ttCtx.getElTooltip(), n2 = r2.config.tooltip.custom;
        Array.isArray(n2) && n2[e2] && (n2 = n2[e2]), o2.innerHTML = n2({ ctx: this.ctx, series: r2.globals.series, seriesIndex: e2, dataPointIndex: i2, y1: a2, y2: s2, w: r2 });
      } }]), t2;
    }();
    var ut = function() {
      function t2(e2) {
        a(this, t2), this.ttCtx = e2, this.ctx = e2.ctx, this.w = e2.w;
      }
      return r(t2, [{ key: "moveXCrosshairs", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null, i2 = this.ttCtx, a2 = this.w, s2 = i2.getElXCrosshairs(), r2 = t3 - i2.xcrosshairsWidth / 2, o2 = a2.globals.labels.slice().length;
        if (null !== e2 && (r2 = a2.globals.gridWidth / o2 * e2), null !== s2 && (s2.setAttribute("x", r2), s2.setAttribute("x1", r2), s2.setAttribute("x2", r2), s2.setAttribute("y2", a2.globals.gridHeight), s2.classList.add("apexcharts-active")), r2 < 0 && (r2 = 0), r2 > a2.globals.gridWidth && (r2 = a2.globals.gridWidth), i2.blxaxisTooltip) {
          var n2 = r2;
          "tickWidth" !== a2.config.xaxis.crosshairs.width && "barWidth" !== a2.config.xaxis.crosshairs.width || (n2 = r2 + i2.xcrosshairsWidth / 2), this.moveXAxisTooltip(n2);
        }
      } }, { key: "moveYCrosshairs", value: function(t3) {
        var e2 = this.ttCtx;
        null !== e2.ycrosshairs && b.setAttrs(e2.ycrosshairs, { y1: t3, y2: t3 }), null !== e2.ycrosshairsHidden && b.setAttrs(e2.ycrosshairsHidden, { y1: t3, y2: t3 });
      } }, { key: "moveXAxisTooltip", value: function(t3) {
        var e2 = this.w, i2 = this.ttCtx;
        if (null !== i2.xaxisTooltip) {
          i2.xaxisTooltip.classList.add("apexcharts-active");
          var a2 = i2.xaxisOffY + e2.config.xaxis.tooltip.offsetY + e2.globals.translateY + 1 + e2.config.xaxis.offsetY;
          if (t3 -= i2.xaxisTooltip.getBoundingClientRect().width / 2, !isNaN(t3)) {
            t3 += e2.globals.translateX;
            var s2;
            s2 = new b(this.ctx).getTextRects(i2.xaxisTooltipText.innerHTML), i2.xaxisTooltipText.style.minWidth = s2.width + "px", i2.xaxisTooltip.style.left = t3 + "px", i2.xaxisTooltip.style.top = a2 + "px";
          }
        }
      } }, { key: "moveYAxisTooltip", value: function(t3) {
        var e2 = this.w, i2 = this.ttCtx;
        null === i2.yaxisTTEls && (i2.yaxisTTEls = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-yaxistooltip"));
        var a2 = parseInt(i2.ycrosshairsHidden.getAttribute("y1"), 10), s2 = e2.globals.translateY + a2, r2 = i2.yaxisTTEls[t3].getBoundingClientRect().height, o2 = e2.globals.translateYAxisX[t3] - 2;
        e2.config.yaxis[t3].opposite && (o2 -= 26), s2 -= r2 / 2, -1 === e2.globals.ignoreYAxisIndexes.indexOf(t3) ? (i2.yaxisTTEls[t3].classList.add("apexcharts-active"), i2.yaxisTTEls[t3].style.top = s2 + "px", i2.yaxisTTEls[t3].style.left = o2 + e2.config.yaxis[t3].tooltip.offsetX + "px") : i2.yaxisTTEls[t3].classList.remove("apexcharts-active");
      } }, { key: "moveTooltip", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null, a2 = this.w, s2 = this.ttCtx, r2 = s2.getElTooltip(), o2 = s2.tooltipRect, n2 = null !== i2 ? parseFloat(i2) : 1, l2 = parseFloat(t3) + n2 + 5, h2 = parseFloat(e2) + n2 / 2;
        if (l2 > a2.globals.gridWidth / 2 && (l2 = l2 - o2.ttWidth - n2 - 15), l2 > a2.globals.gridWidth - o2.ttWidth - 10 && (l2 = a2.globals.gridWidth - o2.ttWidth), l2 < -20 && (l2 = -20), a2.config.tooltip.followCursor) {
          var c2 = s2.getElGrid(), d2 = c2.getBoundingClientRect();
          h2 = s2.e.clientY + a2.globals.translateY - d2.top - o2.ttHeight / 2;
        } else
          a2.globals.isBarHorizontal ? h2 -= o2.ttHeight : (o2.ttHeight / 2 + h2 > a2.globals.gridHeight && (h2 = a2.globals.gridHeight - o2.ttHeight + a2.globals.translateY), h2 < 0 && (h2 = 0));
        isNaN(l2) || (l2 += a2.globals.translateX, r2.style.left = l2 + "px", r2.style.top = h2 + "px");
      } }, { key: "moveMarkers", value: function(t3, e2) {
        var i2 = this.w, a2 = this.ttCtx;
        if (i2.globals.markers.size[t3] > 0)
          for (var s2 = i2.globals.dom.baseEl.querySelectorAll(" .apexcharts-series[data\\:realIndex='".concat(t3, "'] .apexcharts-marker")), r2 = 0; r2 < s2.length; r2++)
            parseInt(s2[r2].getAttribute("rel"), 10) === e2 && (a2.marker.resetPointsSize(), a2.marker.enlargeCurrentPoint(e2, s2[r2]));
        else
          a2.marker.resetPointsSize(), this.moveDynamicPointOnHover(e2, t3);
      } }, { key: "moveDynamicPointOnHover", value: function(t3, e2) {
        var i2, a2, s2 = this.w, r2 = this.ttCtx, o2 = s2.globals.pointsArray, n2 = r2.tooltipUtil.getHoverMarkerSize(e2), l2 = s2.config.series[e2].type;
        if (!l2 || "column" !== l2 && "candlestick" !== l2 && "boxPlot" !== l2) {
          i2 = o2[e2][t3][0], a2 = o2[e2][t3][1] ? o2[e2][t3][1] : 0;
          var h2 = s2.globals.dom.baseEl.querySelector(".apexcharts-series[data\\:realIndex='".concat(e2, "'] .apexcharts-series-markers circle"));
          h2 && a2 < s2.globals.gridHeight && a2 > 0 && (h2.setAttribute("r", n2), h2.setAttribute("cx", i2), h2.setAttribute("cy", a2)), this.moveXCrosshairs(i2), r2.fixedTooltip || this.moveTooltip(i2, a2, n2);
        }
      } }, { key: "moveDynamicPointsOnHover", value: function(t3) {
        var e2, i2 = this.ttCtx, a2 = i2.w, s2 = 0, r2 = 0, o2 = a2.globals.pointsArray;
        e2 = new z(this.ctx).getActiveConfigSeriesIndex(true);
        var n2 = i2.tooltipUtil.getHoverMarkerSize(e2);
        o2[e2] && (s2 = o2[e2][t3][0], r2 = o2[e2][t3][1]);
        var l2 = i2.tooltipUtil.getAllMarkers();
        if (null !== l2)
          for (var h2 = 0; h2 < a2.globals.series.length; h2++) {
            var c2 = o2[h2];
            if (a2.globals.comboCharts && void 0 === c2 && l2.splice(h2, 0, null), c2 && c2.length) {
              var d2 = o2[h2][t3][1];
              l2[h2].setAttribute("cx", s2), null !== d2 && !isNaN(d2) && d2 < a2.globals.gridHeight && d2 > 0 ? (l2[h2] && l2[h2].setAttribute("r", n2), l2[h2] && l2[h2].setAttribute("cy", d2)) : l2[h2] && l2[h2].setAttribute("r", 0);
            }
          }
        if (this.moveXCrosshairs(s2), !i2.fixedTooltip) {
          var g2 = r2 || a2.globals.gridHeight;
          this.moveTooltip(s2, g2, n2);
        }
      } }, { key: "moveStickyTooltipOverBars", value: function(t3) {
        var e2 = this.w, i2 = this.ttCtx, a2 = e2.globals.columnSeries ? e2.globals.columnSeries.length : e2.globals.series.length, s2 = a2 >= 2 && a2 % 2 == 0 ? Math.floor(a2 / 2) : Math.floor(a2 / 2) + 1;
        e2.globals.isBarHorizontal && (s2 = new z(this.ctx).getActiveConfigSeriesIndex(false, "desc") + 1);
        var r2 = e2.globals.dom.baseEl.querySelector(".apexcharts-bar-series .apexcharts-series[rel='".concat(s2, "'] path[j='").concat(t3, "'], .apexcharts-candlestick-series .apexcharts-series[rel='").concat(s2, "'] path[j='").concat(t3, "'], .apexcharts-boxPlot-series .apexcharts-series[rel='").concat(s2, "'] path[j='").concat(t3, "'], .apexcharts-rangebar-series .apexcharts-series[rel='").concat(s2, "'] path[j='").concat(t3, "']")), o2 = r2 ? parseFloat(r2.getAttribute("cx")) : 0, n2 = r2 ? parseFloat(r2.getAttribute("cy")) : 0, l2 = r2 ? parseFloat(r2.getAttribute("barWidth")) : 0, h2 = r2 ? parseFloat(r2.getAttribute("barHeight")) : 0, c2 = i2.getElGrid().getBoundingClientRect();
        if (e2.globals.isXNumeric ? (o2 -= a2 % 2 != 0 ? l2 / 2 : 0, r2 && (r2.classList.contains("apexcharts-candlestick-area") || r2.classList.contains("apexcharts-boxPlot-area")) && e2.globals.comboCharts && (o2 -= l2 / 2)) : e2.globals.isBarHorizontal || (o2 = i2.xAxisTicksPositions[t3 - 1] + i2.dataPointsDividedWidth / 2, isNaN(o2) && (o2 = i2.xAxisTicksPositions[t3] - i2.dataPointsDividedWidth / 2)), e2.globals.isBarHorizontal ? n2 += h2 / 3 : n2 = i2.e.clientY - c2.top - i2.tooltipRect.ttHeight / 2, e2.globals.isBarHorizontal || this.moveXCrosshairs(o2), !i2.fixedTooltip) {
          var d2 = n2 || e2.globals.gridHeight;
          this.moveTooltip(o2, d2);
        }
      } }]), t2;
    }();
    var pt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.ttCtx = e2, this.ctx = e2.ctx, this.tooltipPosition = new ut(e2);
      }
      return r(t2, [{ key: "drawDynamicPoints", value: function() {
        var t3 = this.w, e2 = new b(this.ctx), i2 = new P(this.ctx), a2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-series");
        a2 = g(a2), t3.config.chart.stacked && a2.sort(function(t4, e3) {
          return parseFloat(t4.getAttribute("data:realIndex")) - parseFloat(e3.getAttribute("data:realIndex"));
        });
        for (var s2 = 0; s2 < a2.length; s2++) {
          var r2 = a2[s2].querySelector(".apexcharts-series-markers-wrap");
          if (null !== r2) {
            var o2 = void 0, n2 = "apexcharts-marker w".concat((Math.random() + 1).toString(36).substring(4));
            "line" !== t3.config.chart.type && "area" !== t3.config.chart.type || t3.globals.comboCharts || t3.config.tooltip.intersect || (n2 += " no-pointer-events");
            var l2 = i2.getMarkerConfig({ cssClass: n2, seriesIndex: s2 });
            (o2 = e2.drawMarker(0, 0, l2)).node.setAttribute("default-marker-size", 0);
            var h2 = document.createElementNS(t3.globals.SVGNS, "g");
            h2.classList.add("apexcharts-series-markers"), h2.appendChild(o2.node), r2.appendChild(h2);
          }
        }
      } }, { key: "enlargeCurrentPoint", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null, a2 = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null, s2 = this.w;
        "bubble" !== s2.config.chart.type && this.newPointSize(t3, e2);
        var r2 = e2.getAttribute("cx"), o2 = e2.getAttribute("cy");
        if (null !== i2 && null !== a2 && (r2 = i2, o2 = a2), this.tooltipPosition.moveXCrosshairs(r2), !this.fixedTooltip) {
          if ("radar" === s2.config.chart.type) {
            var n2 = this.ttCtx.getElGrid(), l2 = n2.getBoundingClientRect();
            r2 = this.ttCtx.e.clientX - l2.left;
          }
          this.tooltipPosition.moveTooltip(r2, o2, s2.config.markers.hover.size);
        }
      } }, { key: "enlargePoints", value: function(t3) {
        for (var e2 = this.w, i2 = this, a2 = this.ttCtx, s2 = t3, r2 = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-series:not(.apexcharts-series-collapsed) .apexcharts-marker"), o2 = e2.config.markers.hover.size, n2 = 0; n2 < r2.length; n2++) {
          var l2 = r2[n2].getAttribute("rel"), h2 = r2[n2].getAttribute("index");
          if (void 0 === o2 && (o2 = e2.globals.markers.size[h2] + e2.config.markers.hover.sizeOffset), s2 === parseInt(l2, 10)) {
            i2.newPointSize(s2, r2[n2]);
            var c2 = r2[n2].getAttribute("cx"), d2 = r2[n2].getAttribute("cy");
            i2.tooltipPosition.moveXCrosshairs(c2), a2.fixedTooltip || i2.tooltipPosition.moveTooltip(c2, d2, o2);
          } else
            i2.oldPointSize(r2[n2]);
        }
      } }, { key: "newPointSize", value: function(t3, e2) {
        var i2 = this.w, a2 = i2.config.markers.hover.size, s2 = 0 === t3 ? e2.parentNode.firstChild : e2.parentNode.lastChild;
        if ("0" !== s2.getAttribute("default-marker-size")) {
          var r2 = parseInt(s2.getAttribute("index"), 10);
          void 0 === a2 && (a2 = i2.globals.markers.size[r2] + i2.config.markers.hover.sizeOffset), a2 < 0 && (a2 = 0), s2.setAttribute("r", a2);
        }
      } }, { key: "oldPointSize", value: function(t3) {
        var e2 = parseFloat(t3.getAttribute("default-marker-size"));
        t3.setAttribute("r", e2);
      } }, { key: "resetPointsSize", value: function() {
        for (var t3 = this.w.globals.dom.baseEl.querySelectorAll(".apexcharts-series:not(.apexcharts-series-collapsed) .apexcharts-marker"), e2 = 0; e2 < t3.length; e2++) {
          var i2 = parseFloat(t3[e2].getAttribute("default-marker-size"));
          p.isNumber(i2) && i2 >= 0 ? t3[e2].setAttribute("r", i2) : t3[e2].setAttribute("r", 0);
        }
      } }]), t2;
    }();
    var ft = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.ttCtx = e2;
      }
      return r(t2, [{ key: "getAttr", value: function(t3, e2) {
        return parseFloat(t3.target.getAttribute(e2));
      } }, { key: "handleHeatTreeTooltip", value: function(t3) {
        var e2 = t3.e, i2 = t3.opt, a2 = t3.x, s2 = t3.y, r2 = t3.type, o2 = this.ttCtx, n2 = this.w;
        if (e2.target.classList.contains("apexcharts-".concat(r2, "-rect"))) {
          var l2 = this.getAttr(e2, "i"), h2 = this.getAttr(e2, "j"), c2 = this.getAttr(e2, "cx"), d2 = this.getAttr(e2, "cy"), g2 = this.getAttr(e2, "width"), u2 = this.getAttr(e2, "height");
          if (o2.tooltipLabels.drawSeriesTexts({ ttItems: i2.ttItems, i: l2, j: h2, shared: false, e: e2 }), n2.globals.capturedSeriesIndex = l2, n2.globals.capturedDataPointIndex = h2, a2 = c2 + o2.tooltipRect.ttWidth / 2 + g2, s2 = d2 + o2.tooltipRect.ttHeight / 2 - u2 / 2, o2.tooltipPosition.moveXCrosshairs(c2 + g2 / 2), a2 > n2.globals.gridWidth / 2 && (a2 = c2 - o2.tooltipRect.ttWidth / 2 + g2), o2.w.config.tooltip.followCursor) {
            var p2 = n2.globals.dom.elWrap.getBoundingClientRect();
            a2 = n2.globals.clientX - p2.left - o2.tooltipRect.ttWidth / 2, s2 = n2.globals.clientY - p2.top - o2.tooltipRect.ttHeight - 5;
          }
        }
        return { x: a2, y: s2 };
      } }, { key: "handleMarkerTooltip", value: function(t3) {
        var e2, i2, a2 = t3.e, s2 = t3.opt, r2 = t3.x, o2 = t3.y, n2 = this.w, l2 = this.ttCtx;
        if (a2.target.classList.contains("apexcharts-marker")) {
          var h2 = parseInt(s2.paths.getAttribute("cx"), 10), c2 = parseInt(s2.paths.getAttribute("cy"), 10), d2 = parseFloat(s2.paths.getAttribute("val"));
          if (i2 = parseInt(s2.paths.getAttribute("rel"), 10), e2 = parseInt(s2.paths.parentNode.parentNode.parentNode.getAttribute("rel"), 10) - 1, l2.intersect) {
            var g2 = p.findAncestor(s2.paths, "apexcharts-series");
            g2 && (e2 = parseInt(g2.getAttribute("data:realIndex"), 10));
          }
          if (l2.tooltipLabels.drawSeriesTexts({ ttItems: s2.ttItems, i: e2, j: i2, shared: !l2.showOnIntersect && n2.config.tooltip.shared, e: a2 }), "mouseup" === a2.type && l2.markerClick(a2, e2, i2), n2.globals.capturedSeriesIndex = e2, n2.globals.capturedDataPointIndex = i2, r2 = h2, o2 = c2 + n2.globals.translateY - 1.4 * l2.tooltipRect.ttHeight, l2.w.config.tooltip.followCursor) {
            var u2 = l2.getElGrid().getBoundingClientRect();
            o2 = l2.e.clientY + n2.globals.translateY - u2.top;
          }
          d2 < 0 && (o2 = c2), l2.marker.enlargeCurrentPoint(i2, s2.paths, r2, o2);
        }
        return { x: r2, y: o2 };
      } }, { key: "handleBarTooltip", value: function(t3) {
        var e2, i2, a2 = t3.e, s2 = t3.opt, r2 = this.w, o2 = this.ttCtx, n2 = o2.getElTooltip(), l2 = 0, h2 = 0, c2 = 0, d2 = this.getBarTooltipXY({ e: a2, opt: s2 });
        e2 = d2.i;
        var g2 = d2.barHeight, u2 = d2.j;
        r2.globals.capturedSeriesIndex = e2, r2.globals.capturedDataPointIndex = u2, r2.globals.isBarHorizontal && o2.tooltipUtil.hasBars() || !r2.config.tooltip.shared ? (h2 = d2.x, c2 = d2.y, i2 = Array.isArray(r2.config.stroke.width) ? r2.config.stroke.width[e2] : r2.config.stroke.width, l2 = h2) : r2.globals.comboCharts || r2.config.tooltip.shared || (l2 /= 2), isNaN(c2) ? c2 = r2.globals.svgHeight - o2.tooltipRect.ttHeight : c2 < 0 && (c2 = 0);
        var p2 = parseInt(s2.paths.parentNode.getAttribute("data:realIndex"), 10), f2 = r2.globals.isMultipleYAxis ? r2.config.yaxis[p2] && r2.config.yaxis[p2].reversed : r2.config.yaxis[0].reversed;
        if (h2 + o2.tooltipRect.ttWidth > r2.globals.gridWidth && !f2 ? h2 -= o2.tooltipRect.ttWidth : h2 < 0 && (h2 = 0), o2.w.config.tooltip.followCursor) {
          var x2 = o2.getElGrid().getBoundingClientRect();
          c2 = o2.e.clientY - x2.top;
        }
        null === o2.tooltip && (o2.tooltip = r2.globals.dom.baseEl.querySelector(".apexcharts-tooltip")), r2.config.tooltip.shared || (r2.globals.comboBarCount > 0 ? o2.tooltipPosition.moveXCrosshairs(l2 + i2 / 2) : o2.tooltipPosition.moveXCrosshairs(l2)), !o2.fixedTooltip && (!r2.config.tooltip.shared || r2.globals.isBarHorizontal && o2.tooltipUtil.hasBars()) && (f2 && (h2 -= o2.tooltipRect.ttWidth) < 0 && (h2 = 0), n2.style.left = h2 + r2.globals.translateX + "px", !f2 || r2.globals.isBarHorizontal && o2.tooltipUtil.hasBars() || (c2 = c2 + g2 - 2 * (r2.globals.series[e2][u2] < 0 ? g2 : 0)), o2.tooltipRect.ttHeight + c2 > r2.globals.gridHeight ? (c2 = r2.globals.gridHeight - o2.tooltipRect.ttHeight + r2.globals.translateY, n2.style.top = c2 + "px") : n2.style.top = c2 + r2.globals.translateY - o2.tooltipRect.ttHeight / 2 + "px");
      } }, { key: "getBarTooltipXY", value: function(t3) {
        var e2 = t3.e, i2 = t3.opt, a2 = this.w, s2 = null, r2 = this.ttCtx, o2 = 0, n2 = 0, l2 = 0, h2 = 0, c2 = 0, d2 = e2.target.classList;
        if (d2.contains("apexcharts-bar-area") || d2.contains("apexcharts-candlestick-area") || d2.contains("apexcharts-boxPlot-area") || d2.contains("apexcharts-rangebar-area")) {
          var g2 = e2.target, u2 = g2.getBoundingClientRect(), p2 = i2.elGrid.getBoundingClientRect(), f2 = u2.height;
          c2 = u2.height;
          var x2 = u2.width, b2 = parseInt(g2.getAttribute("cx"), 10), v2 = parseInt(g2.getAttribute("cy"), 10);
          h2 = parseFloat(g2.getAttribute("barWidth"));
          var m2 = "touchmove" === e2.type ? e2.touches[0].clientX : e2.clientX;
          s2 = parseInt(g2.getAttribute("j"), 10), o2 = parseInt(g2.parentNode.getAttribute("rel"), 10) - 1;
          var y2 = g2.getAttribute("data-range-y1"), w2 = g2.getAttribute("data-range-y2");
          a2.globals.comboCharts && (o2 = parseInt(g2.parentNode.getAttribute("data:realIndex"), 10)), r2.tooltipLabels.drawSeriesTexts({ ttItems: i2.ttItems, i: o2, j: s2, y1: y2 ? parseInt(y2, 10) : null, y2: w2 ? parseInt(w2, 10) : null, shared: !r2.showOnIntersect && a2.config.tooltip.shared, e: e2 }), a2.config.tooltip.followCursor ? a2.globals.isBarHorizontal ? (n2 = m2 - p2.left + 15, l2 = v2 - r2.dataPointsDividedHeight + f2 / 2 - r2.tooltipRect.ttHeight / 2) : (n2 = a2.globals.isXNumeric ? b2 - x2 / 2 : b2 - r2.dataPointsDividedWidth + x2 / 2, l2 = e2.clientY - p2.top - r2.tooltipRect.ttHeight / 2 - 15) : a2.globals.isBarHorizontal ? ((n2 = b2) < r2.xyRatios.baseLineInvertedY && (n2 = b2 - r2.tooltipRect.ttWidth), l2 = v2 - r2.dataPointsDividedHeight + f2 / 2 - r2.tooltipRect.ttHeight / 2) : (n2 = a2.globals.isXNumeric ? b2 - x2 / 2 : b2 - r2.dataPointsDividedWidth + x2 / 2, l2 = v2);
        }
        return { x: n2, y: l2, barHeight: c2, barWidth: h2, i: o2, j: s2 };
      } }]), t2;
    }();
    var xt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.ttCtx = e2;
      }
      return r(t2, [{ key: "drawXaxisTooltip", value: function() {
        var t3 = this.w, e2 = this.ttCtx, i2 = "bottom" === t3.config.xaxis.position;
        e2.xaxisOffY = i2 ? t3.globals.gridHeight + 1 : -t3.globals.xAxisHeight - t3.config.xaxis.axisTicks.height + 3;
        var a2 = i2 ? "apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom" : "apexcharts-xaxistooltip apexcharts-xaxistooltip-top", s2 = t3.globals.dom.elWrap;
        e2.blxaxisTooltip && (null === t3.globals.dom.baseEl.querySelector(".apexcharts-xaxistooltip") && (e2.xaxisTooltip = document.createElement("div"), e2.xaxisTooltip.setAttribute("class", a2 + " apexcharts-theme-" + t3.config.tooltip.theme), s2.appendChild(e2.xaxisTooltip), e2.xaxisTooltipText = document.createElement("div"), e2.xaxisTooltipText.classList.add("apexcharts-xaxistooltip-text"), e2.xaxisTooltipText.style.fontFamily = t3.config.xaxis.tooltip.style.fontFamily || t3.config.chart.fontFamily, e2.xaxisTooltipText.style.fontSize = t3.config.xaxis.tooltip.style.fontSize, e2.xaxisTooltip.appendChild(e2.xaxisTooltipText)));
      } }, { key: "drawYaxisTooltip", value: function() {
        for (var t3 = this.w, e2 = this.ttCtx, i2 = function(i3) {
          var a3 = t3.config.yaxis[i3].opposite || t3.config.yaxis[i3].crosshairs.opposite;
          e2.yaxisOffX = a3 ? t3.globals.gridWidth + 1 : 1;
          var s2 = "apexcharts-yaxistooltip apexcharts-yaxistooltip-".concat(i3, a3 ? " apexcharts-yaxistooltip-right" : " apexcharts-yaxistooltip-left");
          t3.globals.yAxisSameScaleIndices.map(function(e3, a4) {
            e3.map(function(e4, a5) {
              a5 === i3 && (s2 += t3.config.yaxis[a5].show ? " " : " apexcharts-yaxistooltip-hidden");
            });
          });
          var r2 = t3.globals.dom.elWrap;
          null === t3.globals.dom.baseEl.querySelector(".apexcharts-yaxistooltip apexcharts-yaxistooltip-".concat(i3)) && (e2.yaxisTooltip = document.createElement("div"), e2.yaxisTooltip.setAttribute("class", s2 + " apexcharts-theme-" + t3.config.tooltip.theme), r2.appendChild(e2.yaxisTooltip), 0 === i3 && (e2.yaxisTooltipText = []), e2.yaxisTooltipText[i3] = document.createElement("div"), e2.yaxisTooltipText[i3].classList.add("apexcharts-yaxistooltip-text"), e2.yaxisTooltip.appendChild(e2.yaxisTooltipText[i3]));
        }, a2 = 0; a2 < t3.config.yaxis.length; a2++)
          i2(a2);
      } }, { key: "setXCrosshairWidth", value: function() {
        var t3 = this.w, e2 = this.ttCtx, i2 = e2.getElXCrosshairs();
        if (e2.xcrosshairsWidth = parseInt(t3.config.xaxis.crosshairs.width, 10), t3.globals.comboCharts) {
          var a2 = t3.globals.dom.baseEl.querySelector(".apexcharts-bar-area");
          if (null !== a2 && "barWidth" === t3.config.xaxis.crosshairs.width) {
            var s2 = parseFloat(a2.getAttribute("barWidth"));
            e2.xcrosshairsWidth = s2;
          } else if ("tickWidth" === t3.config.xaxis.crosshairs.width) {
            var r2 = t3.globals.labels.length;
            e2.xcrosshairsWidth = t3.globals.gridWidth / r2;
          }
        } else if ("tickWidth" === t3.config.xaxis.crosshairs.width) {
          var o2 = t3.globals.labels.length;
          e2.xcrosshairsWidth = t3.globals.gridWidth / o2;
        } else if ("barWidth" === t3.config.xaxis.crosshairs.width) {
          var n2 = t3.globals.dom.baseEl.querySelector(".apexcharts-bar-area");
          if (null !== n2) {
            var l2 = parseFloat(n2.getAttribute("barWidth"));
            e2.xcrosshairsWidth = l2;
          } else
            e2.xcrosshairsWidth = 1;
        }
        t3.globals.isBarHorizontal && (e2.xcrosshairsWidth = 0), null !== i2 && e2.xcrosshairsWidth > 0 && i2.setAttribute("width", e2.xcrosshairsWidth);
      } }, { key: "handleYCrosshair", value: function() {
        var t3 = this.w, e2 = this.ttCtx;
        e2.ycrosshairs = t3.globals.dom.baseEl.querySelector(".apexcharts-ycrosshairs"), e2.ycrosshairsHidden = t3.globals.dom.baseEl.querySelector(".apexcharts-ycrosshairs-hidden");
      } }, { key: "drawYaxisTooltipText", value: function(t3, e2, i2) {
        var a2 = this.ttCtx, s2 = this.w, r2 = s2.globals.yLabelFormatters[t3];
        if (a2.yaxisTooltips[t3]) {
          var o2 = a2.getElGrid().getBoundingClientRect(), n2 = (e2 - o2.top) * i2.yRatio[t3], l2 = s2.globals.maxYArr[t3] - s2.globals.minYArr[t3], h2 = s2.globals.minYArr[t3] + (l2 - n2);
          a2.tooltipPosition.moveYCrosshairs(e2 - o2.top), a2.yaxisTooltipText[t3].innerHTML = r2(h2), a2.tooltipPosition.moveYAxisTooltip(t3);
        }
      } }]), t2;
    }();
    var bt = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var i2 = this.w;
        this.tConfig = i2.config.tooltip, this.tooltipUtil = new dt(this), this.tooltipLabels = new gt(this), this.tooltipPosition = new ut(this), this.marker = new pt(this), this.intersect = new ft(this), this.axesTooltip = new xt(this), this.showOnIntersect = this.tConfig.intersect, this.showTooltipTitle = this.tConfig.x.show, this.fixedTooltip = this.tConfig.fixed.enabled, this.xaxisTooltip = null, this.yaxisTTEls = null, this.isBarShared = !i2.globals.isBarHorizontal && this.tConfig.shared;
      }
      return r(t2, [{ key: "getElTooltip", value: function(t3) {
        return t3 || (t3 = this), t3.w.globals.dom.baseEl.querySelector(".apexcharts-tooltip");
      } }, { key: "getElXCrosshairs", value: function() {
        return this.w.globals.dom.baseEl.querySelector(".apexcharts-xcrosshairs");
      } }, { key: "getElGrid", value: function() {
        return this.w.globals.dom.baseEl.querySelector(".apexcharts-grid");
      } }, { key: "drawTooltip", value: function(t3) {
        var e2 = this.w;
        this.xyRatios = t3, this.blxaxisTooltip = e2.config.xaxis.tooltip.enabled && e2.globals.axisCharts, this.yaxisTooltips = e2.config.yaxis.map(function(t4, i3) {
          return !!(t4.show && t4.tooltip.enabled && e2.globals.axisCharts);
        }), this.allTooltipSeriesGroups = [], e2.globals.axisCharts || (this.showTooltipTitle = false);
        var i2 = document.createElement("div");
        if (i2.classList.add("apexcharts-tooltip"), i2.classList.add("apexcharts-theme-".concat(this.tConfig.theme)), e2.globals.dom.elWrap.appendChild(i2), e2.globals.axisCharts) {
          this.axesTooltip.drawXaxisTooltip(), this.axesTooltip.drawYaxisTooltip(), this.axesTooltip.setXCrosshairWidth(), this.axesTooltip.handleYCrosshair();
          var a2 = new G(this.ctx);
          this.xAxisTicksPositions = a2.getXAxisTicksPositions();
        }
        if (!e2.globals.comboCharts && !this.tConfig.intersect && "rangeBar" !== e2.config.chart.type || this.tConfig.shared || (this.showOnIntersect = true), 0 !== e2.config.markers.size && 0 !== e2.globals.markers.largestSize || this.marker.drawDynamicPoints(this), e2.globals.collapsedSeries.length !== e2.globals.series.length) {
          this.dataPointsDividedHeight = e2.globals.gridHeight / e2.globals.dataPoints, this.dataPointsDividedWidth = e2.globals.gridWidth / e2.globals.dataPoints, this.showTooltipTitle && (this.tooltipTitle = document.createElement("div"), this.tooltipTitle.classList.add("apexcharts-tooltip-title"), this.tooltipTitle.style.fontFamily = this.tConfig.style.fontFamily || e2.config.chart.fontFamily, this.tooltipTitle.style.fontSize = this.tConfig.style.fontSize, i2.appendChild(this.tooltipTitle));
          var s2 = e2.globals.series.length;
          (e2.globals.xyCharts || e2.globals.comboCharts) && this.tConfig.shared && (s2 = this.showOnIntersect ? 1 : e2.globals.series.length), this.legendLabels = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-legend-text"), this.ttItems = this.createTTElements(s2), this.addSVGEvents();
        }
      } }, { key: "createTTElements", value: function(t3) {
        for (var e2 = this, i2 = this.w, a2 = [], s2 = this.getElTooltip(), r2 = function(r3) {
          var o3 = document.createElement("div");
          o3.classList.add("apexcharts-tooltip-series-group"), o3.style.order = i2.config.tooltip.inverseOrder ? t3 - r3 : r3 + 1, e2.tConfig.shared && e2.tConfig.enabledOnSeries && Array.isArray(e2.tConfig.enabledOnSeries) && e2.tConfig.enabledOnSeries.indexOf(r3) < 0 && o3.classList.add("apexcharts-tooltip-series-group-hidden");
          var n2 = document.createElement("span");
          n2.classList.add("apexcharts-tooltip-marker"), n2.style.backgroundColor = i2.globals.colors[r3], o3.appendChild(n2);
          var l2 = document.createElement("div");
          l2.classList.add("apexcharts-tooltip-text"), l2.style.fontFamily = e2.tConfig.style.fontFamily || i2.config.chart.fontFamily, l2.style.fontSize = e2.tConfig.style.fontSize, ["y", "goals", "z"].forEach(function(t4) {
            var e3 = document.createElement("div");
            e3.classList.add("apexcharts-tooltip-".concat(t4, "-group"));
            var i3 = document.createElement("span");
            i3.classList.add("apexcharts-tooltip-text-".concat(t4, "-label")), e3.appendChild(i3);
            var a3 = document.createElement("span");
            a3.classList.add("apexcharts-tooltip-text-".concat(t4, "-value")), e3.appendChild(a3), l2.appendChild(e3);
          }), o3.appendChild(l2), s2.appendChild(o3), a2.push(o3);
        }, o2 = 0; o2 < t3; o2++)
          r2(o2);
        return a2;
      } }, { key: "addSVGEvents", value: function() {
        var t3 = this.w, e2 = t3.config.chart.type, i2 = this.getElTooltip(), a2 = !("bar" !== e2 && "candlestick" !== e2 && "boxPlot" !== e2 && "rangeBar" !== e2), s2 = "area" === e2 || "line" === e2 || "scatter" === e2 || "bubble" === e2 || "radar" === e2, r2 = t3.globals.dom.Paper.node, o2 = this.getElGrid();
        o2 && (this.seriesBound = o2.getBoundingClientRect());
        var n2, l2 = [], h2 = [], c2 = { hoverArea: r2, elGrid: o2, tooltipEl: i2, tooltipY: l2, tooltipX: h2, ttItems: this.ttItems };
        if (t3.globals.axisCharts && (s2 ? n2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-series[data\\:longestSeries='true'] .apexcharts-marker") : a2 ? n2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-series .apexcharts-bar-area, .apexcharts-series .apexcharts-candlestick-area, .apexcharts-series .apexcharts-boxPlot-area, .apexcharts-series .apexcharts-rangebar-area") : "heatmap" !== e2 && "treemap" !== e2 || (n2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-series .apexcharts-heatmap, .apexcharts-series .apexcharts-treemap")), n2 && n2.length))
          for (var d2 = 0; d2 < n2.length; d2++)
            l2.push(n2[d2].getAttribute("cy")), h2.push(n2[d2].getAttribute("cx"));
        if (t3.globals.xyCharts && !this.showOnIntersect || t3.globals.comboCharts && !this.showOnIntersect || a2 && this.tooltipUtil.hasBars() && this.tConfig.shared)
          this.addPathsEventListeners([r2], c2);
        else if (a2 && !t3.globals.comboCharts || s2 && this.showOnIntersect)
          this.addDatapointEventsListeners(c2);
        else if (!t3.globals.axisCharts || "heatmap" === e2 || "treemap" === e2) {
          var g2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-series");
          this.addPathsEventListeners(g2, c2);
        }
        if (this.showOnIntersect) {
          var u2 = t3.globals.dom.baseEl.querySelectorAll(".apexcharts-line-series .apexcharts-marker, .apexcharts-area-series .apexcharts-marker");
          u2.length > 0 && this.addPathsEventListeners(u2, c2), this.tooltipUtil.hasBars() && !this.tConfig.shared && this.addDatapointEventsListeners(c2);
        }
      } }, { key: "drawFixedTooltipRect", value: function() {
        var t3 = this.w, e2 = this.getElTooltip(), i2 = e2.getBoundingClientRect(), a2 = i2.width + 10, s2 = i2.height + 10, r2 = this.tConfig.fixed.offsetX, o2 = this.tConfig.fixed.offsetY, n2 = this.tConfig.fixed.position.toLowerCase();
        return n2.indexOf("right") > -1 && (r2 = r2 + t3.globals.svgWidth - a2 + 10), n2.indexOf("bottom") > -1 && (o2 = o2 + t3.globals.svgHeight - s2 - 10), e2.style.left = r2 + "px", e2.style.top = o2 + "px", { x: r2, y: o2, ttWidth: a2, ttHeight: s2 };
      } }, { key: "addDatapointEventsListeners", value: function(t3) {
        var e2 = this.w.globals.dom.baseEl.querySelectorAll(".apexcharts-series-markers .apexcharts-marker, .apexcharts-bar-area, .apexcharts-candlestick-area, .apexcharts-boxPlot-area, .apexcharts-rangebar-area");
        this.addPathsEventListeners(e2, t3);
      } }, { key: "addPathsEventListeners", value: function(t3, e2) {
        for (var i2 = this, a2 = function(a3) {
          var s3 = { paths: t3[a3], tooltipEl: e2.tooltipEl, tooltipY: e2.tooltipY, tooltipX: e2.tooltipX, elGrid: e2.elGrid, hoverArea: e2.hoverArea, ttItems: e2.ttItems };
          ["mousemove", "mouseup", "touchmove", "mouseout", "touchend"].map(function(e3) {
            return t3[a3].addEventListener(e3, i2.seriesHover.bind(i2, s3), { capture: false, passive: true });
          });
        }, s2 = 0; s2 < t3.length; s2++)
          a2(s2);
      } }, { key: "seriesHover", value: function(t3, e2) {
        var i2 = this, a2 = [], s2 = this.w;
        s2.config.chart.group && (a2 = this.ctx.getGroupedCharts()), s2.globals.axisCharts && (s2.globals.minX === -1 / 0 && s2.globals.maxX === 1 / 0 || 0 === s2.globals.dataPoints) || (a2.length ? a2.forEach(function(a3) {
          var s3 = i2.getElTooltip(a3), r2 = { paths: t3.paths, tooltipEl: s3, tooltipY: t3.tooltipY, tooltipX: t3.tooltipX, elGrid: t3.elGrid, hoverArea: t3.hoverArea, ttItems: a3.w.globals.tooltip.ttItems };
          a3.w.globals.minX === i2.w.globals.minX && a3.w.globals.maxX === i2.w.globals.maxX && a3.w.globals.tooltip.seriesHoverByContext({ chartCtx: a3, ttCtx: a3.w.globals.tooltip, opt: r2, e: e2 });
        }) : this.seriesHoverByContext({ chartCtx: this.ctx, ttCtx: this.w.globals.tooltip, opt: t3, e: e2 }));
      } }, { key: "seriesHoverByContext", value: function(t3) {
        var e2 = t3.chartCtx, i2 = t3.ttCtx, a2 = t3.opt, s2 = t3.e, r2 = e2.w, o2 = this.getElTooltip();
        (i2.tooltipRect = { x: 0, y: 0, ttWidth: o2.getBoundingClientRect().width, ttHeight: o2.getBoundingClientRect().height }, i2.e = s2, !i2.tooltipUtil.hasBars() || r2.globals.comboCharts || i2.isBarShared) || this.tConfig.onDatasetHover.highlightDataSeries && new z(e2).toggleSeriesOnHover(s2, s2.target.parentNode);
        i2.fixedTooltip && i2.drawFixedTooltipRect(), r2.globals.axisCharts ? i2.axisChartsTooltips({ e: s2, opt: a2, tooltipRect: i2.tooltipRect }) : i2.nonAxisChartsTooltips({ e: s2, opt: a2, tooltipRect: i2.tooltipRect });
      } }, { key: "axisChartsTooltips", value: function(t3) {
        var e2, i2, a2 = t3.e, s2 = t3.opt, r2 = this.w, o2 = s2.elGrid.getBoundingClientRect(), n2 = "touchmove" === a2.type ? a2.touches[0].clientX : a2.clientX, l2 = "touchmove" === a2.type ? a2.touches[0].clientY : a2.clientY;
        if (this.clientY = l2, this.clientX = n2, r2.globals.capturedSeriesIndex = -1, r2.globals.capturedDataPointIndex = -1, l2 < o2.top || l2 > o2.top + o2.height)
          this.handleMouseOut(s2);
        else {
          if (Array.isArray(this.tConfig.enabledOnSeries) && !r2.config.tooltip.shared) {
            var h2 = parseInt(s2.paths.getAttribute("index"), 10);
            if (this.tConfig.enabledOnSeries.indexOf(h2) < 0)
              return void this.handleMouseOut(s2);
          }
          var c2 = this.getElTooltip(), d2 = this.getElXCrosshairs(), g2 = r2.globals.xyCharts || "bar" === r2.config.chart.type && !r2.globals.isBarHorizontal && this.tooltipUtil.hasBars() && this.tConfig.shared || r2.globals.comboCharts && this.tooltipUtil.hasBars();
          if ("mousemove" === a2.type || "touchmove" === a2.type || "mouseup" === a2.type) {
            null !== d2 && d2.classList.add("apexcharts-active");
            var u2 = this.yaxisTooltips.filter(function(t4) {
              return true === t4;
            });
            if (null !== this.ycrosshairs && u2.length && this.ycrosshairs.classList.add("apexcharts-active"), g2 && !this.showOnIntersect)
              this.handleStickyTooltip(a2, n2, l2, s2);
            else if ("heatmap" === r2.config.chart.type || "treemap" === r2.config.chart.type) {
              var p2 = this.intersect.handleHeatTreeTooltip({ e: a2, opt: s2, x: e2, y: i2, type: r2.config.chart.type });
              e2 = p2.x, i2 = p2.y, c2.style.left = e2 + "px", c2.style.top = i2 + "px";
            } else
              this.tooltipUtil.hasBars() && this.intersect.handleBarTooltip({ e: a2, opt: s2 }), this.tooltipUtil.hasMarkers() && this.intersect.handleMarkerTooltip({ e: a2, opt: s2, x: e2, y: i2 });
            if (this.yaxisTooltips.length)
              for (var f2 = 0; f2 < r2.config.yaxis.length; f2++)
                this.axesTooltip.drawYaxisTooltipText(f2, l2, this.xyRatios);
            s2.tooltipEl.classList.add("apexcharts-active");
          } else
            "mouseout" !== a2.type && "touchend" !== a2.type || this.handleMouseOut(s2);
        }
      } }, { key: "nonAxisChartsTooltips", value: function(t3) {
        var e2 = t3.e, i2 = t3.opt, a2 = t3.tooltipRect, s2 = this.w, r2 = i2.paths.getAttribute("rel"), o2 = this.getElTooltip(), n2 = s2.globals.dom.elWrap.getBoundingClientRect();
        if ("mousemove" === e2.type || "touchmove" === e2.type) {
          o2.classList.add("apexcharts-active"), this.tooltipLabels.drawSeriesTexts({ ttItems: i2.ttItems, i: parseInt(r2, 10) - 1, shared: false });
          var l2 = s2.globals.clientX - n2.left - a2.ttWidth / 2, h2 = s2.globals.clientY - n2.top - a2.ttHeight - 10;
          if (o2.style.left = l2 + "px", o2.style.top = h2 + "px", s2.config.legend.tooltipHoverFormatter) {
            var c2 = r2 - 1, d2 = (0, s2.config.legend.tooltipHoverFormatter)(this.legendLabels[c2].getAttribute("data:default-text"), { seriesIndex: c2, dataPointIndex: c2, w: s2 });
            this.legendLabels[c2].innerHTML = d2;
          }
        } else
          "mouseout" !== e2.type && "touchend" !== e2.type || (o2.classList.remove("apexcharts-active"), s2.config.legend.tooltipHoverFormatter && this.legendLabels.forEach(function(t4) {
            var e3 = t4.getAttribute("data:default-text");
            t4.innerHTML = decodeURIComponent(e3);
          }));
      } }, { key: "handleStickyTooltip", value: function(t3, e2, i2, a2) {
        var s2 = this.w, r2 = this.tooltipUtil.getNearestValues({ context: this, hoverArea: a2.hoverArea, elGrid: a2.elGrid, clientX: e2, clientY: i2 }), o2 = r2.j, n2 = r2.capturedSeries;
        r2.hoverX < 0 || r2.hoverX > s2.globals.gridWidth ? this.handleMouseOut(a2) : null !== n2 ? this.handleStickyCapturedSeries(t3, n2, a2, o2) : (this.tooltipUtil.isXoverlap(o2) || s2.globals.isBarHorizontal) && this.create(t3, this, 0, o2, a2.ttItems);
      } }, { key: "handleStickyCapturedSeries", value: function(t3, e2, i2, a2) {
        var s2 = this.w;
        null === s2.globals.series[e2][a2] ? this.handleMouseOut(i2) : void 0 !== s2.globals.series[e2][a2] ? this.tConfig.shared && this.tooltipUtil.isXoverlap(a2) && this.tooltipUtil.isInitialSeriesSameLen() ? this.create(t3, this, e2, a2, i2.ttItems) : this.create(t3, this, e2, a2, i2.ttItems, false) : this.tooltipUtil.isXoverlap(a2) && this.create(t3, this, 0, a2, i2.ttItems);
      } }, { key: "deactivateHoverFilter", value: function() {
        for (var t3 = this.w, e2 = new b(this.ctx), i2 = t3.globals.dom.Paper.select(".apexcharts-bar-area"), a2 = 0; a2 < i2.length; a2++)
          e2.pathMouseLeave(i2[a2]);
      } }, { key: "handleMouseOut", value: function(t3) {
        var e2 = this.w, i2 = this.getElXCrosshairs();
        if (t3.tooltipEl.classList.remove("apexcharts-active"), this.deactivateHoverFilter(), "bubble" !== e2.config.chart.type && this.marker.resetPointsSize(), null !== i2 && i2.classList.remove("apexcharts-active"), null !== this.ycrosshairs && this.ycrosshairs.classList.remove("apexcharts-active"), this.blxaxisTooltip && this.xaxisTooltip.classList.remove("apexcharts-active"), this.yaxisTooltips.length) {
          null === this.yaxisTTEls && (this.yaxisTTEls = e2.globals.dom.baseEl.querySelectorAll(".apexcharts-yaxistooltip"));
          for (var a2 = 0; a2 < this.yaxisTTEls.length; a2++)
            this.yaxisTTEls[a2].classList.remove("apexcharts-active");
        }
        e2.config.legend.tooltipHoverFormatter && this.legendLabels.forEach(function(t4) {
          var e3 = t4.getAttribute("data:default-text");
          t4.innerHTML = decodeURIComponent(e3);
        });
      } }, { key: "markerClick", value: function(t3, e2, i2) {
        var a2 = this.w;
        "function" == typeof a2.config.chart.events.markerClick && a2.config.chart.events.markerClick(t3, this.ctx, { seriesIndex: e2, dataPointIndex: i2, w: a2 }), this.ctx.events.fireEvent("markerClick", [t3, this.ctx, { seriesIndex: e2, dataPointIndex: i2, w: a2 }]);
      } }, { key: "create", value: function(t3, e2, i2, a2, s2) {
        var r2 = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : null, o2 = this.w, n2 = e2;
        "mouseup" === t3.type && this.markerClick(t3, i2, a2), null === r2 && (r2 = this.tConfig.shared);
        var l2 = this.tooltipUtil.hasMarkers(), h2 = this.tooltipUtil.getElBars();
        if (o2.config.legend.tooltipHoverFormatter) {
          var c2 = o2.config.legend.tooltipHoverFormatter, d2 = Array.from(this.legendLabels);
          d2.forEach(function(t4) {
            var e3 = t4.getAttribute("data:default-text");
            t4.innerHTML = decodeURIComponent(e3);
          });
          for (var g2 = 0; g2 < d2.length; g2++) {
            var u2 = d2[g2], p2 = parseInt(u2.getAttribute("i"), 10), f2 = decodeURIComponent(u2.getAttribute("data:default-text")), x2 = c2(f2, { seriesIndex: r2 ? p2 : i2, dataPointIndex: a2, w: o2 });
            if (r2)
              u2.innerHTML = o2.globals.collapsedSeriesIndices.indexOf(p2) < 0 ? x2 : f2;
            else if (u2.innerHTML = p2 === i2 ? x2 : f2, i2 === p2)
              break;
          }
        }
        if (r2) {
          if (n2.tooltipLabels.drawSeriesTexts({ ttItems: s2, i: i2, j: a2, shared: !this.showOnIntersect && this.tConfig.shared }), l2 && (o2.globals.markers.largestSize > 0 ? n2.marker.enlargePoints(a2) : n2.tooltipPosition.moveDynamicPointsOnHover(a2)), this.tooltipUtil.hasBars() && (this.barSeriesHeight = this.tooltipUtil.getBarsHeight(h2), this.barSeriesHeight > 0)) {
            var v2 = new b(this.ctx), m2 = o2.globals.dom.Paper.select(".apexcharts-bar-area[j='".concat(a2, "']"));
            this.deactivateHoverFilter(), this.tooltipPosition.moveStickyTooltipOverBars(a2);
            for (var y2 = 0; y2 < m2.length; y2++)
              v2.pathMouseEnter(m2[y2]);
          }
        } else
          n2.tooltipLabels.drawSeriesTexts({ shared: false, ttItems: s2, i: i2, j: a2 }), this.tooltipUtil.hasBars() && n2.tooltipPosition.moveStickyTooltipOverBars(a2), l2 && n2.tooltipPosition.moveMarkers(i2, a2);
      } }]), t2;
    }();
    var vt = function(t2) {
      n(s2, E);
      var i2 = d(s2);
      function s2() {
        return a(this, s2), i2.apply(this, arguments);
      }
      return r(s2, [{ key: "draw", value: function(t3, i3) {
        var a2 = this, s3 = this.w;
        this.graphics = new b(this.ctx), this.bar = new E(this.ctx, this.xyRatios);
        var r2 = new y(this.ctx, s3);
        t3 = r2.getLogSeries(t3), this.yRatio = r2.getLogYRatios(this.yRatio), this.barHelpers.initVariables(t3), "100%" === s3.config.chart.stackType && (t3 = s3.globals.seriesPercent.slice()), this.series = t3, this.totalItems = 0, this.prevY = [], this.prevX = [], this.prevYF = [], this.prevXF = [], this.prevYVal = [], this.prevXVal = [], this.xArrj = [], this.xArrjF = [], this.xArrjVal = [], this.yArrj = [], this.yArrjF = [], this.yArrjVal = [];
        for (var o2 = 0; o2 < t3.length; o2++)
          t3[o2].length > 0 && (this.totalItems += t3[o2].length);
        for (var n2 = this.graphics.group({ class: "apexcharts-bar-series apexcharts-plot-series" }), l2 = 0, h2 = 0, c2 = function(r3, o3) {
          var c3 = void 0, d3 = void 0, g3 = void 0, u2 = void 0, f2 = [], x2 = [], b2 = s3.globals.comboCharts ? i3[r3] : r3;
          a2.yRatio.length > 1 && (a2.yaxisIndex = b2), a2.isReversed = s3.config.yaxis[a2.yaxisIndex] && s3.config.yaxis[a2.yaxisIndex].reversed;
          var v2 = a2.graphics.group({ class: "apexcharts-series", seriesName: p.escapeString(s3.globals.seriesNames[b2]), rel: r3 + 1, "data:realIndex": b2 });
          a2.ctx.series.addCollapsedClassToSeries(v2, b2);
          var m2 = a2.graphics.group({ class: "apexcharts-datalabels", "data:realIndex": b2 }), y2 = 0, w2 = 0, k2 = a2.initialPositions(l2, h2, c3, d3, g3, u2);
          h2 = k2.y, y2 = k2.barHeight, d3 = k2.yDivision, u2 = k2.zeroW, l2 = k2.x, w2 = k2.barWidth, c3 = k2.xDivision, g3 = k2.zeroH, a2.yArrj = [], a2.yArrjF = [], a2.yArrjVal = [], a2.xArrj = [], a2.xArrjF = [], a2.xArrjVal = [], 1 === a2.prevY.length && a2.prevY[0].every(function(t4) {
            return isNaN(t4);
          }) && (a2.prevY[0] = a2.prevY[0].map(function(t4) {
            return g3;
          }), a2.prevYF[0] = a2.prevYF[0].map(function(t4) {
            return 0;
          }));
          for (var A2 = 0; A2 < s3.globals.dataPoints; A2++) {
            var S2 = a2.barHelpers.getStrokeWidth(r3, A2, b2), C2 = { indexes: { i: r3, j: A2, realIndex: b2, bc: o3 }, strokeWidth: S2, x: l2, y: h2, elSeries: v2 }, L2 = null;
            a2.isHorizontal ? (L2 = a2.drawStackedBarPaths(e(e({}, C2), {}, { zeroW: u2, barHeight: y2, yDivision: d3 })), w2 = a2.series[r3][A2] / a2.invertedYRatio) : (L2 = a2.drawStackedColumnPaths(e(e({}, C2), {}, { xDivision: c3, barWidth: w2, zeroH: g3 })), y2 = a2.series[r3][A2] / a2.yRatio[a2.yaxisIndex]), h2 = L2.y, l2 = L2.x, f2.push(l2), x2.push(h2);
            var P2 = a2.barHelpers.getPathFillColor(t3, r3, A2, b2);
            v2 = a2.renderSeries({ realIndex: b2, pathFill: P2, j: A2, i: r3, pathFrom: L2.pathFrom, pathTo: L2.pathTo, strokeWidth: S2, elSeries: v2, x: l2, y: h2, series: t3, barHeight: y2, barWidth: w2, elDataLabelsWrap: m2, type: "bar", visibleSeries: 0 });
          }
          s3.globals.seriesXvalues[b2] = f2, s3.globals.seriesYvalues[b2] = x2, a2.prevY.push(a2.yArrj), a2.prevYF.push(a2.yArrjF), a2.prevYVal.push(a2.yArrjVal), a2.prevX.push(a2.xArrj), a2.prevXF.push(a2.xArrjF), a2.prevXVal.push(a2.xArrjVal), n2.add(v2);
        }, d2 = 0, g2 = 0; d2 < t3.length; d2++, g2++)
          c2(d2, g2);
        return n2;
      } }, { key: "initialPositions", value: function(t3, e2, i3, a2, s3, r2) {
        var o2, n2, l2 = this.w;
        return this.isHorizontal ? (o2 = (o2 = a2 = l2.globals.gridHeight / l2.globals.dataPoints) * parseInt(l2.config.plotOptions.bar.barHeight, 10) / 100, r2 = this.baseLineInvertedY + l2.globals.padHorizontal + (this.isReversed ? l2.globals.gridWidth : 0) - (this.isReversed ? 2 * this.baseLineInvertedY : 0), e2 = (a2 - o2) / 2) : (n2 = i3 = l2.globals.gridWidth / l2.globals.dataPoints, n2 = l2.globals.isXNumeric && l2.globals.dataPoints > 1 ? (i3 = l2.globals.minXDiff / this.xRatio) * parseInt(this.barOptions.columnWidth, 10) / 100 : n2 * parseInt(l2.config.plotOptions.bar.columnWidth, 10) / 100, s3 = this.baseLineY[this.yaxisIndex] + (this.isReversed ? l2.globals.gridHeight : 0) - (this.isReversed ? 2 * this.baseLineY[this.yaxisIndex] : 0), t3 = l2.globals.padHorizontal + (i3 - n2) / 2), { x: t3, y: e2, yDivision: a2, xDivision: i3, barHeight: o2, barWidth: n2, zeroH: s3, zeroW: r2 };
      } }, { key: "drawStackedBarPaths", value: function(t3) {
        for (var e2, i3 = t3.indexes, a2 = t3.barHeight, s3 = t3.strokeWidth, r2 = t3.zeroW, o2 = t3.x, n2 = t3.y, l2 = t3.yDivision, h2 = t3.elSeries, c2 = this.w, d2 = n2, g2 = i3.i, u2 = i3.j, p2 = 0, f2 = 0; f2 < this.prevXF.length; f2++)
          p2 += this.prevXF[f2][u2];
        if (g2 > 0) {
          var x2 = r2;
          this.prevXVal[g2 - 1][u2] < 0 ? x2 = this.series[g2][u2] >= 0 ? this.prevX[g2 - 1][u2] + p2 - 2 * (this.isReversed ? p2 : 0) : this.prevX[g2 - 1][u2] : this.prevXVal[g2 - 1][u2] >= 0 && (x2 = this.series[g2][u2] >= 0 ? this.prevX[g2 - 1][u2] : this.prevX[g2 - 1][u2] - p2 + 2 * (this.isReversed ? p2 : 0)), e2 = x2;
        } else
          e2 = r2;
        o2 = null === this.series[g2][u2] ? e2 : e2 + this.series[g2][u2] / this.invertedYRatio - 2 * (this.isReversed ? this.series[g2][u2] / this.invertedYRatio : 0);
        var b2 = this.barHelpers.getBarpaths({ barYPosition: d2, barHeight: a2, x1: e2, x2: o2, strokeWidth: s3, series: this.series, realIndex: i3.realIndex, i: g2, j: u2, w: c2 });
        return this.barHelpers.barBackground({ j: u2, i: g2, y1: d2, y2: a2, elSeries: h2 }), n2 += l2, { pathTo: b2.pathTo, pathFrom: b2.pathFrom, x: o2, y: n2 };
      } }, { key: "drawStackedColumnPaths", value: function(t3) {
        var e2 = t3.indexes, i3 = t3.x, a2 = t3.y, s3 = t3.xDivision, r2 = t3.barWidth, o2 = t3.zeroH;
        t3.strokeWidth;
        var n2 = t3.elSeries, l2 = this.w, h2 = e2.i, c2 = e2.j, d2 = e2.bc;
        if (l2.globals.isXNumeric) {
          var g2 = l2.globals.seriesX[h2][c2];
          g2 || (g2 = 0), i3 = (g2 - l2.globals.minX) / this.xRatio - r2 / 2;
        }
        for (var u2, p2 = i3, f2 = 0, x2 = 0; x2 < this.prevYF.length; x2++)
          f2 += isNaN(this.prevYF[x2][c2]) ? 0 : this.prevYF[x2][c2];
        if (h2 > 0 && !l2.globals.isXNumeric || h2 > 0 && l2.globals.isXNumeric && l2.globals.seriesX[h2 - 1][c2] === l2.globals.seriesX[h2][c2]) {
          var b2, v2, m2 = Math.min(this.yRatio.length + 1, h2 + 1);
          if (void 0 !== this.prevY[h2 - 1]) {
            for (var y2 = 1; y2 < m2; y2++)
              if (!isNaN(this.prevY[h2 - y2][c2])) {
                v2 = this.prevY[h2 - y2][c2];
                break;
              }
          }
          for (var w2 = 1; w2 < m2; w2++) {
            if (this.prevYVal[h2 - w2][c2] < 0) {
              b2 = this.series[h2][c2] >= 0 ? v2 - f2 + 2 * (this.isReversed ? f2 : 0) : v2;
              break;
            }
            if (this.prevYVal[h2 - w2][c2] >= 0) {
              b2 = this.series[h2][c2] >= 0 ? v2 : v2 + f2 - 2 * (this.isReversed ? f2 : 0);
              break;
            }
          }
          void 0 === b2 && (b2 = l2.globals.gridHeight), u2 = this.prevYF[0].every(function(t4) {
            return 0 === t4;
          }) && this.prevYF.slice(1, h2).every(function(t4) {
            return t4.every(function(t5) {
              return isNaN(t5);
            });
          }) ? l2.globals.gridHeight - o2 : b2;
        } else
          u2 = l2.globals.gridHeight - o2;
        a2 = u2 - this.series[h2][c2] / this.yRatio[this.yaxisIndex] + 2 * (this.isReversed ? this.series[h2][c2] / this.yRatio[this.yaxisIndex] : 0);
        var k2 = this.barHelpers.getColumnPaths({ barXPosition: p2, barWidth: r2, y1: u2, y2: a2, yRatio: this.yRatio[this.yaxisIndex], strokeWidth: this.strokeWidth, series: this.series, realIndex: e2.realIndex, i: h2, j: c2, w: l2 });
        return this.barHelpers.barBackground({ bc: d2, j: c2, i: h2, x1: p2, x2: r2, elSeries: n2 }), i3 += s3, { pathTo: k2.pathTo, pathFrom: k2.pathFrom, x: l2.globals.isXNumeric ? i3 - s3 : i3, y: a2 };
      } }]), s2;
    }();
    var mt = function(t2) {
      n(i2, E);
      var e2 = d(i2);
      function i2() {
        return a(this, i2), e2.apply(this, arguments);
      }
      return r(i2, [{ key: "draw", value: function(t3, e3) {
        var i3 = this, a2 = this.w, s2 = new b(this.ctx), r2 = new L(this.ctx);
        this.candlestickOptions = this.w.config.plotOptions.candlestick, this.boxOptions = this.w.config.plotOptions.boxPlot;
        var o2 = new y(this.ctx, a2);
        t3 = o2.getLogSeries(t3), this.series = t3, this.yRatio = o2.getLogYRatios(this.yRatio), this.barHelpers.initVariables(t3);
        for (var n2 = s2.group({ class: "apexcharts-".concat(a2.config.chart.type, "-series apexcharts-plot-series") }), l2 = function(o3) {
          i3.isBoxPlot = "boxPlot" === a2.config.chart.type || "boxPlot" === a2.config.series[o3].type;
          var l3, h3, c2 = void 0, d2 = void 0, g2 = [], u2 = [], f2 = a2.globals.comboCharts ? e3[o3] : o3, x2 = s2.group({ class: "apexcharts-series", seriesName: p.escapeString(a2.globals.seriesNames[f2]), rel: o3 + 1, "data:realIndex": f2 });
          t3[o3].length > 0 && (i3.visibleI = i3.visibleI + 1);
          var b2, v2;
          i3.yRatio.length > 1 && (i3.yaxisIndex = f2);
          var m2 = i3.barHelpers.initialPositions();
          d2 = m2.y, b2 = m2.barHeight, c2 = m2.x, v2 = m2.barWidth, l3 = m2.xDivision, h3 = m2.zeroH, u2.push(c2 + v2 / 2);
          for (var y2 = s2.group({ class: "apexcharts-datalabels", "data:realIndex": f2 }), w2 = function(e4) {
            var s3 = i3.barHelpers.getStrokeWidth(o3, e4, f2), n3 = i3.drawBoxPaths({ indexes: { i: o3, j: e4, realIndex: f2 }, x: c2, y: d2, xDivision: l3, barWidth: v2, zeroH: h3, strokeWidth: s3, elSeries: x2 });
            d2 = n3.y, c2 = n3.x, e4 > 0 && u2.push(c2 + v2 / 2), g2.push(d2), n3.pathTo.forEach(function(l4, h4) {
              var g3 = !i3.isBoxPlot && i3.candlestickOptions.wick.useFillColor ? n3.color[h4] : a2.globals.stroke.colors[o3], u3 = r2.fillPath({ seriesNumber: f2, dataPointIndex: e4, color: n3.color[h4], value: t3[o3][e4] });
              i3.renderSeries({ realIndex: f2, pathFill: u3, lineFill: g3, j: e4, i: o3, pathFrom: n3.pathFrom, pathTo: l4, strokeWidth: s3, elSeries: x2, x: c2, y: d2, series: t3, barHeight: b2, barWidth: v2, elDataLabelsWrap: y2, visibleSeries: i3.visibleI, type: a2.config.chart.type });
            });
          }, k2 = 0; k2 < a2.globals.dataPoints; k2++)
            w2(k2);
          a2.globals.seriesXvalues[f2] = u2, a2.globals.seriesYvalues[f2] = g2, n2.add(x2);
        }, h2 = 0; h2 < t3.length; h2++)
          l2(h2);
        return n2;
      } }, { key: "drawBoxPaths", value: function(t3) {
        var e3 = t3.indexes, i3 = t3.x;
        t3.y;
        var a2 = t3.xDivision, s2 = t3.barWidth, r2 = t3.zeroH, o2 = t3.strokeWidth, n2 = this.w, l2 = new b(this.ctx), h2 = e3.i, c2 = e3.j, d2 = true, g2 = n2.config.plotOptions.candlestick.colors.upward, u2 = n2.config.plotOptions.candlestick.colors.downward, p2 = "";
        this.isBoxPlot && (p2 = [this.boxOptions.colors.lower, this.boxOptions.colors.upper]);
        var f2 = this.yRatio[this.yaxisIndex], x2 = e3.realIndex, v2 = this.getOHLCValue(x2, c2), m2 = r2, y2 = r2;
        v2.o > v2.c && (d2 = false);
        var w2 = Math.min(v2.o, v2.c), k2 = Math.max(v2.o, v2.c), A2 = v2.m;
        n2.globals.isXNumeric && (i3 = (n2.globals.seriesX[x2][c2] - n2.globals.minX) / this.xRatio - s2 / 2);
        var S2 = i3 + s2 * this.visibleI;
        void 0 === this.series[h2][c2] || null === this.series[h2][c2] ? (w2 = r2, k2 = r2) : (w2 = r2 - w2 / f2, k2 = r2 - k2 / f2, m2 = r2 - v2.h / f2, y2 = r2 - v2.l / f2, A2 = r2 - v2.m / f2);
        var C2 = l2.move(S2, r2), L2 = l2.move(S2 + s2 / 2, w2);
        return n2.globals.previousPaths.length > 0 && (L2 = this.getPreviousPath(x2, c2, true)), C2 = this.isBoxPlot ? [l2.move(S2, w2) + l2.line(S2 + s2 / 2, w2) + l2.line(S2 + s2 / 2, m2) + l2.line(S2 + s2 / 4, m2) + l2.line(S2 + s2 - s2 / 4, m2) + l2.line(S2 + s2 / 2, m2) + l2.line(S2 + s2 / 2, w2) + l2.line(S2 + s2, w2) + l2.line(S2 + s2, A2) + l2.line(S2, A2) + l2.line(S2, w2 + o2 / 2), l2.move(S2, A2) + l2.line(S2 + s2, A2) + l2.line(S2 + s2, k2) + l2.line(S2 + s2 / 2, k2) + l2.line(S2 + s2 / 2, y2) + l2.line(S2 + s2 - s2 / 4, y2) + l2.line(S2 + s2 / 4, y2) + l2.line(S2 + s2 / 2, y2) + l2.line(S2 + s2 / 2, k2) + l2.line(S2, k2) + l2.line(S2, A2) + "z"] : [l2.move(S2, k2) + l2.line(S2 + s2 / 2, k2) + l2.line(S2 + s2 / 2, m2) + l2.line(S2 + s2 / 2, k2) + l2.line(S2 + s2, k2) + l2.line(S2 + s2, w2) + l2.line(S2 + s2 / 2, w2) + l2.line(S2 + s2 / 2, y2) + l2.line(S2 + s2 / 2, w2) + l2.line(S2, w2) + l2.line(S2, k2 - o2 / 2)], L2 += l2.move(S2, w2), n2.globals.isXNumeric || (i3 += a2), { pathTo: C2, pathFrom: L2, x: i3, y: k2, barXPosition: S2, color: this.isBoxPlot ? p2 : d2 ? [g2] : [u2] };
      } }, { key: "getOHLCValue", value: function(t3, e3) {
        var i3 = this.w;
        return { o: this.isBoxPlot ? i3.globals.seriesCandleH[t3][e3] : i3.globals.seriesCandleO[t3][e3], h: this.isBoxPlot ? i3.globals.seriesCandleO[t3][e3] : i3.globals.seriesCandleH[t3][e3], m: i3.globals.seriesCandleM[t3][e3], l: this.isBoxPlot ? i3.globals.seriesCandleC[t3][e3] : i3.globals.seriesCandleL[t3][e3], c: this.isBoxPlot ? i3.globals.seriesCandleL[t3][e3] : i3.globals.seriesCandleC[t3][e3] };
      } }]), i2;
    }();
    var yt = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "checkColorRange", value: function() {
        var t3 = this.w, e2 = false, i2 = t3.config.plotOptions[t3.config.chart.type];
        return i2.colorScale.ranges.length > 0 && i2.colorScale.ranges.map(function(t4, i3) {
          t4.from <= 0 && (e2 = true);
        }), e2;
      } }, { key: "getShadeColor", value: function(t3, e2, i2, a2) {
        var s2 = this.w, r2 = 1, o2 = s2.config.plotOptions[t3].shadeIntensity, n2 = this.determineColor(t3, e2, i2);
        s2.globals.hasNegs || a2 ? r2 = s2.config.plotOptions[t3].reverseNegativeShade ? n2.percent < 0 ? n2.percent / 100 * (1.25 * o2) : (1 - n2.percent / 100) * (1.25 * o2) : n2.percent <= 0 ? 1 - (1 + n2.percent / 100) * o2 : (1 - n2.percent / 100) * o2 : (r2 = 1 - n2.percent / 100, "treemap" === t3 && (r2 = (1 - n2.percent / 100) * (1.25 * o2)));
        var l2 = n2.color, h2 = new p();
        return s2.config.plotOptions[t3].enableShades && (l2 = "dark" === this.w.config.theme.mode ? p.hexToRgba(h2.shadeColor(-1 * r2, n2.color), s2.config.fill.opacity) : p.hexToRgba(h2.shadeColor(r2, n2.color), s2.config.fill.opacity)), { color: l2, colorProps: n2 };
      } }, { key: "determineColor", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = a2.globals.series[e2][i2], r2 = a2.config.plotOptions[t3], o2 = r2.colorScale.inverse ? i2 : e2;
        a2.config.plotOptions[t3].distributed && (o2 = i2);
        var n2 = a2.globals.colors[o2], l2 = null, h2 = Math.min.apply(Math, g(a2.globals.series[e2])), c2 = Math.max.apply(Math, g(a2.globals.series[e2]));
        r2.distributed || "heatmap" !== t3 || (h2 = a2.globals.minY, c2 = a2.globals.maxY), void 0 !== r2.colorScale.min && (h2 = r2.colorScale.min < a2.globals.minY ? r2.colorScale.min : a2.globals.minY, c2 = r2.colorScale.max > a2.globals.maxY ? r2.colorScale.max : a2.globals.maxY);
        var d2 = Math.abs(c2) + Math.abs(h2), u2 = 100 * s2 / (0 === d2 ? d2 - 1e-6 : d2);
        r2.colorScale.ranges.length > 0 && r2.colorScale.ranges.map(function(t4, e3) {
          if (s2 >= t4.from && s2 <= t4.to) {
            n2 = t4.color, l2 = t4.foreColor ? t4.foreColor : null, h2 = t4.from, c2 = t4.to;
            var i3 = Math.abs(c2) + Math.abs(h2);
            u2 = 100 * s2 / (0 === i3 ? i3 - 1e-6 : i3);
          }
        });
        return { color: n2, foreColor: l2, percent: u2 };
      } }, { key: "calculateDataLabels", value: function(t3) {
        var e2 = t3.text, i2 = t3.x, a2 = t3.y, s2 = t3.i, r2 = t3.j, o2 = t3.colorProps, n2 = t3.fontSize, l2 = this.w.config.dataLabels, h2 = new b(this.ctx), c2 = new M(this.ctx), d2 = null;
        if (l2.enabled) {
          d2 = h2.group({ class: "apexcharts-data-labels" });
          var g2 = l2.offsetX, u2 = l2.offsetY, p2 = i2 + g2, f2 = a2 + parseFloat(l2.style.fontSize) / 3 + u2;
          c2.plotDataLabelsText({ x: p2, y: f2, text: e2, i: s2, j: r2, color: o2.foreColor, parent: d2, fontSize: n2, dataLabelsConfig: l2 });
        }
        return d2;
      } }, { key: "addListeners", value: function(t3) {
        var e2 = new b(this.ctx);
        t3.node.addEventListener("mouseenter", e2.pathMouseEnter.bind(this, t3)), t3.node.addEventListener("mouseleave", e2.pathMouseLeave.bind(this, t3)), t3.node.addEventListener("mousedown", e2.pathMouseDown.bind(this, t3));
      } }]), t2;
    }();
    var wt = function() {
      function t2(e2, i2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.xRatio = i2.xRatio, this.yRatio = i2.yRatio, this.dynamicAnim = this.w.config.chart.animations.dynamicAnimation, this.helpers = new yt(e2), this.rectRadius = this.w.config.plotOptions.heatmap.radius, this.strokeWidth = this.w.config.stroke.show ? this.w.config.stroke.width : 0;
      }
      return r(t2, [{ key: "draw", value: function(t3) {
        var e2 = this.w, i2 = new b(this.ctx), a2 = i2.group({ class: "apexcharts-heatmap" });
        a2.attr("clip-path", "url(#gridRectMask".concat(e2.globals.cuid, ")"));
        var s2 = e2.globals.gridWidth / e2.globals.dataPoints, r2 = e2.globals.gridHeight / e2.globals.series.length, o2 = 0, n2 = false;
        this.negRange = this.helpers.checkColorRange();
        var l2 = t3.slice();
        e2.config.yaxis[0].reversed && (n2 = true, l2.reverse());
        for (var h2 = n2 ? 0 : l2.length - 1; n2 ? h2 < l2.length : h2 >= 0; n2 ? h2++ : h2--) {
          var c2 = i2.group({ class: "apexcharts-series apexcharts-heatmap-series", seriesName: p.escapeString(e2.globals.seriesNames[h2]), rel: h2 + 1, "data:realIndex": h2 });
          if (this.ctx.series.addCollapsedClassToSeries(c2, h2), e2.config.chart.dropShadow.enabled) {
            var d2 = e2.config.chart.dropShadow;
            new x(this.ctx).dropShadow(c2, d2, h2);
          }
          for (var g2 = 0, u2 = e2.config.plotOptions.heatmap.shadeIntensity, f2 = 0; f2 < l2[h2].length; f2++) {
            var v2 = this.helpers.getShadeColor(e2.config.chart.type, h2, f2, this.negRange), m2 = v2.color, y2 = v2.colorProps;
            if ("image" === e2.config.fill.type)
              m2 = new L(this.ctx).fillPath({ seriesNumber: h2, dataPointIndex: f2, opacity: e2.globals.hasNegs ? y2.percent < 0 ? 1 - (1 + y2.percent / 100) : u2 + y2.percent / 100 : y2.percent / 100, patternID: p.randomId(), width: e2.config.fill.image.width ? e2.config.fill.image.width : s2, height: e2.config.fill.image.height ? e2.config.fill.image.height : r2 });
            var w2 = this.rectRadius, k2 = i2.drawRect(g2, o2, s2, r2, w2);
            if (k2.attr({ cx: g2, cy: o2 }), k2.node.classList.add("apexcharts-heatmap-rect"), c2.add(k2), k2.attr({ fill: m2, i: h2, index: h2, j: f2, val: l2[h2][f2], "stroke-width": this.strokeWidth, stroke: e2.config.plotOptions.heatmap.useFillColorAsStroke ? m2 : e2.globals.stroke.colors[0], color: m2 }), this.helpers.addListeners(k2), e2.config.chart.animations.enabled && !e2.globals.dataChanged) {
              var A2 = 1;
              e2.globals.resized || (A2 = e2.config.chart.animations.speed), this.animateHeatMap(k2, g2, o2, s2, r2, A2);
            }
            if (e2.globals.dataChanged) {
              var S2 = 1;
              if (this.dynamicAnim.enabled && e2.globals.shouldAnimate) {
                S2 = this.dynamicAnim.speed;
                var C2 = e2.globals.previousPaths[h2] && e2.globals.previousPaths[h2][f2] && e2.globals.previousPaths[h2][f2].color;
                C2 || (C2 = "rgba(255, 255, 255, 0)"), this.animateHeatColor(k2, p.isColorHex(C2) ? C2 : p.rgb2hex(C2), p.isColorHex(m2) ? m2 : p.rgb2hex(m2), S2);
              }
            }
            var P2 = (0, e2.config.dataLabels.formatter)(e2.globals.series[h2][f2], { value: e2.globals.series[h2][f2], seriesIndex: h2, dataPointIndex: f2, w: e2 }), T2 = this.helpers.calculateDataLabels({ text: P2, x: g2 + s2 / 2, y: o2 + r2 / 2, i: h2, j: f2, colorProps: y2, series: l2 });
            null !== T2 && c2.add(T2), g2 += s2;
          }
          o2 += r2, a2.add(c2);
        }
        var M2 = e2.globals.yAxisScale[0].result.slice();
        e2.config.yaxis[0].reversed ? M2.unshift("") : M2.push(""), e2.globals.yAxisScale[0].result = M2;
        var I2 = e2.globals.gridHeight / e2.globals.series.length;
        return e2.config.yaxis[0].labels.offsetY = -I2 / 2, a2;
      } }, { key: "animateHeatMap", value: function(t3, e2, i2, a2, s2, r2) {
        var o2 = new f(this.ctx);
        o2.animateRect(t3, { x: e2 + a2 / 2, y: i2 + s2 / 2, width: 0, height: 0 }, { x: e2, y: i2, width: a2, height: s2 }, r2, function() {
          o2.animationCompleted(t3);
        });
      } }, { key: "animateHeatColor", value: function(t3, e2, i2, a2) {
        t3.attr({ fill: e2 }).animate(a2).attr({ fill: i2 });
      } }]), t2;
    }();
    var kt = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "drawYAxisTexts", value: function(t3, e2, i2, a2) {
        var s2 = this.w, r2 = s2.config.yaxis[0], o2 = s2.globals.yLabelFormatters[0];
        return new b(this.ctx).drawText({ x: t3 + r2.labels.offsetX, y: e2 + r2.labels.offsetY, text: o2(a2, i2), textAnchor: "middle", fontSize: r2.labels.style.fontSize, fontFamily: r2.labels.style.fontFamily, foreColor: Array.isArray(r2.labels.style.colors) ? r2.labels.style.colors[i2] : r2.labels.style.colors });
      } }]), t2;
    }();
    var At = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
        var i2 = this.w;
        this.chartType = this.w.config.chart.type, this.initialAnim = this.w.config.chart.animations.enabled, this.dynamicAnim = this.initialAnim && this.w.config.chart.animations.dynamicAnimation.enabled, this.animBeginArr = [0], this.animDur = 0, this.donutDataLabels = this.w.config.plotOptions.pie.donut.labels, this.lineColorArr = void 0 !== i2.globals.stroke.colors ? i2.globals.stroke.colors : i2.globals.colors, this.defaultSize = Math.min(i2.globals.gridWidth, i2.globals.gridHeight), this.centerY = this.defaultSize / 2, this.centerX = i2.globals.gridWidth / 2, "radialBar" === i2.config.chart.type ? this.fullAngle = 360 : this.fullAngle = Math.abs(i2.config.plotOptions.pie.endAngle - i2.config.plotOptions.pie.startAngle), this.initialAngle = i2.config.plotOptions.pie.startAngle % this.fullAngle, i2.globals.radialSize = this.defaultSize / 2.05 - i2.config.stroke.width - (i2.config.chart.sparkline.enabled ? 0 : i2.config.chart.dropShadow.blur), this.donutSize = i2.globals.radialSize * parseInt(i2.config.plotOptions.pie.donut.size, 10) / 100, this.maxY = 0, this.sliceLabels = [], this.sliceSizes = [], this.prevSectorAngleArr = [];
      }
      return r(t2, [{ key: "draw", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = new b(this.ctx);
        if (this.ret = a2.group({ class: "apexcharts-pie" }), i2.globals.noData)
          return this.ret;
        for (var s2 = 0, r2 = 0; r2 < t3.length; r2++)
          s2 += p.negToZero(t3[r2]);
        var o2 = [], n2 = a2.group();
        0 === s2 && (s2 = 1e-5), t3.forEach(function(t4) {
          e2.maxY = Math.max(e2.maxY, t4);
        }), i2.config.yaxis[0].max && (this.maxY = i2.config.yaxis[0].max), "back" === i2.config.grid.position && "polarArea" === this.chartType && this.drawPolarElements(this.ret);
        for (var l2 = 0; l2 < t3.length; l2++) {
          var h2 = this.fullAngle * p.negToZero(t3[l2]) / s2;
          o2.push(h2), "polarArea" === this.chartType ? (o2[l2] = this.fullAngle / t3.length, this.sliceSizes.push(i2.globals.radialSize * t3[l2] / this.maxY)) : this.sliceSizes.push(i2.globals.radialSize);
        }
        if (i2.globals.dataChanged) {
          for (var c2, d2 = 0, g2 = 0; g2 < i2.globals.previousPaths.length; g2++)
            d2 += p.negToZero(i2.globals.previousPaths[g2]);
          for (var u2 = 0; u2 < i2.globals.previousPaths.length; u2++)
            c2 = this.fullAngle * p.negToZero(i2.globals.previousPaths[u2]) / d2, this.prevSectorAngleArr.push(c2);
        }
        this.donutSize < 0 && (this.donutSize = 0);
        var f2 = i2.config.plotOptions.pie.customScale, x2 = i2.globals.gridWidth / 2, v2 = i2.globals.gridHeight / 2, m2 = x2 - i2.globals.gridWidth / 2 * f2, y2 = v2 - i2.globals.gridHeight / 2 * f2;
        if ("donut" === this.chartType) {
          var w2 = a2.drawCircle(this.donutSize);
          w2.attr({ cx: this.centerX, cy: this.centerY, fill: i2.config.plotOptions.pie.donut.background ? i2.config.plotOptions.pie.donut.background : "transparent" }), n2.add(w2);
        }
        var k2 = this.drawArcs(o2, t3);
        if (this.sliceLabels.forEach(function(t4) {
          k2.add(t4);
        }), n2.attr({ transform: "translate(".concat(m2, ", ").concat(y2, ") scale(").concat(f2, ")") }), n2.add(k2), this.ret.add(n2), this.donutDataLabels.show) {
          var A2 = this.renderInnerDataLabels(this.donutDataLabels, { hollowSize: this.donutSize, centerX: this.centerX, centerY: this.centerY, opacity: this.donutDataLabels.show, translateX: m2, translateY: y2 });
          this.ret.add(A2);
        }
        return "front" === i2.config.grid.position && "polarArea" === this.chartType && this.drawPolarElements(this.ret), this.ret;
      } }, { key: "drawArcs", value: function(t3, e2) {
        var i2 = this.w, a2 = new x(this.ctx), s2 = new b(this.ctx), r2 = new L(this.ctx), o2 = s2.group({ class: "apexcharts-slices" }), n2 = this.initialAngle, l2 = this.initialAngle, h2 = this.initialAngle, c2 = this.initialAngle;
        this.strokeWidth = i2.config.stroke.show ? i2.config.stroke.width : 0;
        for (var d2 = 0; d2 < t3.length; d2++) {
          var g2 = s2.group({ class: "apexcharts-series apexcharts-pie-series", seriesName: p.escapeString(i2.globals.seriesNames[d2]), rel: d2 + 1, "data:realIndex": d2 });
          o2.add(g2), l2 = c2, h2 = (n2 = h2) + t3[d2], c2 = l2 + this.prevSectorAngleArr[d2];
          var u2 = h2 < n2 ? this.fullAngle + h2 - n2 : h2 - n2, f2 = r2.fillPath({ seriesNumber: d2, size: this.sliceSizes[d2], value: e2[d2] }), v2 = this.getChangedPath(l2, c2), m2 = s2.drawPath({ d: v2, stroke: Array.isArray(this.lineColorArr) ? this.lineColorArr[d2] : this.lineColorArr, strokeWidth: 0, fill: f2, fillOpacity: i2.config.fill.opacity, classes: "apexcharts-pie-area apexcharts-".concat(this.chartType.toLowerCase(), "-slice-").concat(d2) });
          if (m2.attr({ index: 0, j: d2 }), a2.setSelectionFilter(m2, 0, d2), i2.config.chart.dropShadow.enabled) {
            var y2 = i2.config.chart.dropShadow;
            a2.dropShadow(m2, y2, d2);
          }
          this.addListeners(m2, this.donutDataLabels), b.setAttrs(m2.node, { "data:angle": u2, "data:startAngle": n2, "data:strokeWidth": this.strokeWidth, "data:value": e2[d2] });
          var w2 = { x: 0, y: 0 };
          "pie" === this.chartType || "polarArea" === this.chartType ? w2 = p.polarToCartesian(this.centerX, this.centerY, i2.globals.radialSize / 1.25 + i2.config.plotOptions.pie.dataLabels.offset, (n2 + u2 / 2) % this.fullAngle) : "donut" === this.chartType && (w2 = p.polarToCartesian(this.centerX, this.centerY, (i2.globals.radialSize + this.donutSize) / 2 + i2.config.plotOptions.pie.dataLabels.offset, (n2 + u2 / 2) % this.fullAngle)), g2.add(m2);
          var k2 = 0;
          if (!this.initialAnim || i2.globals.resized || i2.globals.dataChanged ? this.animBeginArr.push(0) : (0 === (k2 = u2 / this.fullAngle * i2.config.chart.animations.speed) && (k2 = 1), this.animDur = k2 + this.animDur, this.animBeginArr.push(this.animDur)), this.dynamicAnim && i2.globals.dataChanged ? this.animatePaths(m2, { size: this.sliceSizes[d2], endAngle: h2, startAngle: n2, prevStartAngle: l2, prevEndAngle: c2, animateStartingPos: true, i: d2, animBeginArr: this.animBeginArr, shouldSetPrevPaths: true, dur: i2.config.chart.animations.dynamicAnimation.speed }) : this.animatePaths(m2, { size: this.sliceSizes[d2], endAngle: h2, startAngle: n2, i: d2, totalItems: t3.length - 1, animBeginArr: this.animBeginArr, dur: k2 }), i2.config.plotOptions.pie.expandOnClick && "polarArea" !== this.chartType && m2.click(this.pieClicked.bind(this, d2)), void 0 !== i2.globals.selectedDataPoints[0] && i2.globals.selectedDataPoints[0].indexOf(d2) > -1 && this.pieClicked(d2), i2.config.dataLabels.enabled) {
            var A2 = w2.x, S2 = w2.y, C2 = 100 * u2 / this.fullAngle + "%";
            if (0 !== u2 && i2.config.plotOptions.pie.dataLabels.minAngleToShowLabel < t3[d2]) {
              var P2 = i2.config.dataLabels.formatter;
              void 0 !== P2 && (C2 = P2(i2.globals.seriesPercent[d2][0], { seriesIndex: d2, w: i2 }));
              var T2 = i2.globals.dataLabels.style.colors[d2], M2 = s2.group({ class: "apexcharts-datalabels" }), I2 = s2.drawText({ x: A2, y: S2, text: C2, textAnchor: "middle", fontSize: i2.config.dataLabels.style.fontSize, fontFamily: i2.config.dataLabels.style.fontFamily, fontWeight: i2.config.dataLabels.style.fontWeight, foreColor: T2 });
              if (M2.add(I2), i2.config.dataLabels.dropShadow.enabled) {
                var z2 = i2.config.dataLabels.dropShadow;
                a2.dropShadow(I2, z2);
              }
              I2.node.classList.add("apexcharts-pie-label"), i2.config.chart.animations.animate && false === i2.globals.resized && (I2.node.classList.add("apexcharts-pie-label-delay"), I2.node.style.animationDelay = i2.config.chart.animations.speed / 940 + "s"), this.sliceLabels.push(M2);
            }
          }
        }
        return o2;
      } }, { key: "addListeners", value: function(t3, e2) {
        var i2 = new b(this.ctx);
        t3.node.addEventListener("mouseenter", i2.pathMouseEnter.bind(this, t3)), t3.node.addEventListener("mouseleave", i2.pathMouseLeave.bind(this, t3)), t3.node.addEventListener("mouseleave", this.revertDataLabelsInner.bind(this, t3.node, e2)), t3.node.addEventListener("mousedown", i2.pathMouseDown.bind(this, t3)), this.donutDataLabels.total.showAlways || (t3.node.addEventListener("mouseenter", this.printDataLabelsInner.bind(this, t3.node, e2)), t3.node.addEventListener("mousedown", this.printDataLabelsInner.bind(this, t3.node, e2)));
      } }, { key: "animatePaths", value: function(t3, e2) {
        var i2 = this.w, a2 = e2.endAngle < e2.startAngle ? this.fullAngle + e2.endAngle - e2.startAngle : e2.endAngle - e2.startAngle, s2 = a2, r2 = e2.startAngle, o2 = e2.startAngle;
        void 0 !== e2.prevStartAngle && void 0 !== e2.prevEndAngle && (r2 = e2.prevEndAngle, s2 = e2.prevEndAngle < e2.prevStartAngle ? this.fullAngle + e2.prevEndAngle - e2.prevStartAngle : e2.prevEndAngle - e2.prevStartAngle), e2.i === i2.config.series.length - 1 && (a2 + o2 > this.fullAngle ? e2.endAngle = e2.endAngle - (a2 + o2) : a2 + o2 < this.fullAngle && (e2.endAngle = e2.endAngle + (this.fullAngle - (a2 + o2)))), a2 === this.fullAngle && (a2 = this.fullAngle - 0.01), this.animateArc(t3, r2, o2, a2, s2, e2);
      } }, { key: "animateArc", value: function(t3, e2, i2, a2, s2, r2) {
        var o2, n2 = this, l2 = this.w, h2 = new f(this.ctx), c2 = r2.size;
        (isNaN(e2) || isNaN(s2)) && (e2 = i2, s2 = a2, r2.dur = 0);
        var d2 = a2, g2 = i2, u2 = e2 < i2 ? this.fullAngle + e2 - i2 : e2 - i2;
        l2.globals.dataChanged && r2.shouldSetPrevPaths && r2.prevEndAngle && (o2 = n2.getPiePath({ me: n2, startAngle: r2.prevStartAngle, angle: r2.prevEndAngle < r2.prevStartAngle ? this.fullAngle + r2.prevEndAngle - r2.prevStartAngle : r2.prevEndAngle - r2.prevStartAngle, size: c2 }), t3.attr({ d: o2 })), 0 !== r2.dur ? t3.animate(r2.dur, l2.globals.easing, r2.animBeginArr[r2.i]).afterAll(function() {
          "pie" !== n2.chartType && "donut" !== n2.chartType && "polarArea" !== n2.chartType || this.animate(l2.config.chart.animations.dynamicAnimation.speed).attr({ "stroke-width": n2.strokeWidth }), r2.i === l2.config.series.length - 1 && h2.animationCompleted(t3);
        }).during(function(l3) {
          d2 = u2 + (a2 - u2) * l3, r2.animateStartingPos && (d2 = s2 + (a2 - s2) * l3, g2 = e2 - s2 + (i2 - (e2 - s2)) * l3), o2 = n2.getPiePath({ me: n2, startAngle: g2, angle: d2, size: c2 }), t3.node.setAttribute("data:pathOrig", o2), t3.attr({ d: o2 });
        }) : (o2 = n2.getPiePath({ me: n2, startAngle: g2, angle: a2, size: c2 }), r2.isTrack || (l2.globals.animationEnded = true), t3.node.setAttribute("data:pathOrig", o2), t3.attr({ d: o2, "stroke-width": n2.strokeWidth }));
      } }, { key: "pieClicked", value: function(t3) {
        var e2, i2 = this.w, a2 = this, s2 = a2.sliceSizes[t3] + (i2.config.plotOptions.pie.expandOnClick ? 4 : 0), r2 = i2.globals.dom.Paper.select(".apexcharts-".concat(a2.chartType.toLowerCase(), "-slice-").concat(t3)).members[0];
        if ("true" !== r2.attr("data:pieClicked")) {
          var o2 = i2.globals.dom.baseEl.getElementsByClassName("apexcharts-pie-area");
          Array.prototype.forEach.call(o2, function(t4) {
            t4.setAttribute("data:pieClicked", "false");
            var e3 = t4.getAttribute("data:pathOrig");
            t4.setAttribute("d", e3);
          }), r2.attr("data:pieClicked", "true");
          var n2 = parseInt(r2.attr("data:startAngle"), 10), l2 = parseInt(r2.attr("data:angle"), 10);
          e2 = a2.getPiePath({ me: a2, startAngle: n2, angle: l2, size: s2 }), 360 !== l2 && r2.plot(e2);
        } else {
          r2.attr({ "data:pieClicked": "false" }), this.revertDataLabelsInner(r2.node, this.donutDataLabels);
          var h2 = r2.attr("data:pathOrig");
          r2.attr({ d: h2 });
        }
      } }, { key: "getChangedPath", value: function(t3, e2) {
        var i2 = "";
        return this.dynamicAnim && this.w.globals.dataChanged && (i2 = this.getPiePath({ me: this, startAngle: t3, angle: e2 - t3, size: this.size })), i2;
      } }, { key: "getPiePath", value: function(t3) {
        var e2 = t3.me, i2 = t3.startAngle, a2 = t3.angle, s2 = t3.size, r2 = i2, o2 = Math.PI * (r2 - 90) / 180, n2 = a2 + i2;
        Math.ceil(n2) >= this.fullAngle + this.w.config.plotOptions.pie.startAngle % this.fullAngle && (n2 = this.fullAngle + this.w.config.plotOptions.pie.startAngle % this.fullAngle - 0.01), Math.ceil(n2) > this.fullAngle && (n2 -= this.fullAngle);
        var l2 = Math.PI * (n2 - 90) / 180, h2 = e2.centerX + s2 * Math.cos(o2), c2 = e2.centerY + s2 * Math.sin(o2), d2 = e2.centerX + s2 * Math.cos(l2), g2 = e2.centerY + s2 * Math.sin(l2), u2 = p.polarToCartesian(e2.centerX, e2.centerY, e2.donutSize, n2), f2 = p.polarToCartesian(e2.centerX, e2.centerY, e2.donutSize, r2), x2 = a2 > 180 ? 1 : 0, b2 = ["M", h2, c2, "A", s2, s2, 0, x2, 1, d2, g2];
        return "donut" === e2.chartType ? [].concat(b2, ["L", u2.x, u2.y, "A", e2.donutSize, e2.donutSize, 0, x2, 0, f2.x, f2.y, "L", h2, c2, "z"]).join(" ") : "pie" === e2.chartType || "polarArea" === e2.chartType ? [].concat(b2, ["L", e2.centerX, e2.centerY, "L", h2, c2]).join(" ") : [].concat(b2).join(" ");
      } }, { key: "drawPolarElements", value: function(t3) {
        var e2 = this.w, i2 = new j(this.ctx), a2 = new b(this.ctx), s2 = new kt(this.ctx), r2 = a2.group(), o2 = a2.group(), n2 = i2.niceScale(0, Math.ceil(this.maxY), e2.config.yaxis[0].tickAmount, 0, true), l2 = n2.result.reverse(), h2 = n2.result.length;
        this.maxY = n2.niceMax;
        for (var c2 = e2.globals.radialSize, d2 = c2 / (h2 - 1), g2 = 0; g2 < h2 - 1; g2++) {
          var u2 = a2.drawCircle(c2);
          if (u2.attr({ cx: this.centerX, cy: this.centerY, fill: "none", "stroke-width": e2.config.plotOptions.polarArea.rings.strokeWidth, stroke: e2.config.plotOptions.polarArea.rings.strokeColor }), e2.config.yaxis[0].show) {
            var p2 = s2.drawYAxisTexts(this.centerX, this.centerY - c2 + parseInt(e2.config.yaxis[0].labels.style.fontSize, 10) / 2, g2, l2[g2]);
            o2.add(p2);
          }
          r2.add(u2), c2 -= d2;
        }
        this.drawSpokes(t3), t3.add(r2), t3.add(o2);
      } }, { key: "renderInnerDataLabels", value: function(t3, e2) {
        var i2 = this.w, a2 = new b(this.ctx), s2 = a2.group({ class: "apexcharts-datalabels-group", transform: "translate(".concat(e2.translateX ? e2.translateX : 0, ", ").concat(e2.translateY ? e2.translateY : 0, ") scale(").concat(i2.config.plotOptions.pie.customScale, ")") }), r2 = t3.total.show;
        s2.node.style.opacity = e2.opacity;
        var o2, n2, l2 = e2.centerX, h2 = e2.centerY;
        o2 = void 0 === t3.name.color ? i2.globals.colors[0] : t3.name.color;
        var c2 = t3.name.fontSize, d2 = t3.name.fontFamily, g2 = t3.value.fontWeight;
        n2 = void 0 === t3.value.color ? i2.config.chart.foreColor : t3.value.color;
        var u2 = t3.value.formatter, p2 = "", f2 = "";
        if (r2 ? (o2 = t3.total.color, c2 = t3.total.fontSize, d2 = t3.total.fontFamily, g2 = t3.total.fontWeight, f2 = t3.total.label, p2 = t3.total.formatter(i2)) : 1 === i2.globals.series.length && (p2 = u2(i2.globals.series[0], i2), f2 = i2.globals.seriesNames[0]), f2 && (f2 = t3.name.formatter(f2, t3.total.show, i2)), t3.name.show) {
          var x2 = a2.drawText({ x: l2, y: h2 + parseFloat(t3.name.offsetY), text: f2, textAnchor: "middle", foreColor: o2, fontSize: c2, fontWeight: g2, fontFamily: d2 });
          x2.node.classList.add("apexcharts-datalabel-label"), s2.add(x2);
        }
        if (t3.value.show) {
          var v2 = t3.name.show ? parseFloat(t3.value.offsetY) + 16 : t3.value.offsetY, m2 = a2.drawText({ x: l2, y: h2 + v2, text: p2, textAnchor: "middle", foreColor: n2, fontWeight: t3.value.fontWeight, fontSize: t3.value.fontSize, fontFamily: t3.value.fontFamily });
          m2.node.classList.add("apexcharts-datalabel-value"), s2.add(m2);
        }
        return s2;
      } }, { key: "printInnerLabels", value: function(t3, e2, i2, a2) {
        var s2, r2 = this.w;
        a2 ? s2 = void 0 === t3.name.color ? r2.globals.colors[parseInt(a2.parentNode.getAttribute("rel"), 10) - 1] : t3.name.color : r2.globals.series.length > 1 && t3.total.show && (s2 = t3.total.color);
        var o2 = r2.globals.dom.baseEl.querySelector(".apexcharts-datalabel-label"), n2 = r2.globals.dom.baseEl.querySelector(".apexcharts-datalabel-value");
        i2 = (0, t3.value.formatter)(i2, r2), a2 || "function" != typeof t3.total.formatter || (i2 = t3.total.formatter(r2));
        var l2 = e2 === t3.total.label;
        e2 = t3.name.formatter(e2, l2, r2), null !== o2 && (o2.textContent = e2), null !== n2 && (n2.textContent = i2), null !== o2 && (o2.style.fill = s2);
      } }, { key: "printDataLabelsInner", value: function(t3, e2) {
        var i2 = this.w, a2 = t3.getAttribute("data:value"), s2 = i2.globals.seriesNames[parseInt(t3.parentNode.getAttribute("rel"), 10) - 1];
        i2.globals.series.length > 1 && this.printInnerLabels(e2, s2, a2, t3);
        var r2 = i2.globals.dom.baseEl.querySelector(".apexcharts-datalabels-group");
        null !== r2 && (r2.style.opacity = 1);
      } }, { key: "drawSpokes", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = new b(this.ctx), s2 = i2.config.plotOptions.polarArea.spokes;
        if (0 !== s2.strokeWidth) {
          for (var r2 = [], o2 = 360 / i2.globals.series.length, n2 = 0; n2 < i2.globals.series.length; n2++)
            r2.push(p.polarToCartesian(this.centerX, this.centerY, i2.globals.radialSize, i2.config.plotOptions.pie.startAngle + o2 * n2));
          r2.forEach(function(i3, r3) {
            var o3 = a2.drawLine(i3.x, i3.y, e2.centerX, e2.centerY, Array.isArray(s2.connectorColors) ? s2.connectorColors[r3] : s2.connectorColors);
            t3.add(o3);
          });
        }
      } }, { key: "revertDataLabelsInner", value: function(t3, e2, i2) {
        var a2 = this, s2 = this.w, r2 = s2.globals.dom.baseEl.querySelector(".apexcharts-datalabels-group"), o2 = false, n2 = s2.globals.dom.baseEl.getElementsByClassName("apexcharts-pie-area"), l2 = function(t4) {
          var i3 = t4.makeSliceOut, s3 = t4.printLabel;
          Array.prototype.forEach.call(n2, function(t5) {
            "true" === t5.getAttribute("data:pieClicked") && (i3 && (o2 = true), s3 && a2.printDataLabelsInner(t5, e2));
          });
        };
        if (l2({ makeSliceOut: true, printLabel: false }), e2.total.show && s2.globals.series.length > 1)
          o2 && !e2.total.showAlways ? l2({ makeSliceOut: false, printLabel: true }) : this.printInnerLabels(e2, e2.total.label, e2.total.formatter(s2));
        else if (l2({ makeSliceOut: false, printLabel: true }), !o2)
          if (s2.globals.selectedDataPoints.length && s2.globals.series.length > 1)
            if (s2.globals.selectedDataPoints[0].length > 0) {
              var h2 = s2.globals.selectedDataPoints[0], c2 = s2.globals.dom.baseEl.querySelector(".apexcharts-".concat(this.chartType.toLowerCase(), "-slice-").concat(h2));
              this.printDataLabelsInner(c2, e2);
            } else
              r2 && s2.globals.selectedDataPoints.length && 0 === s2.globals.selectedDataPoints[0].length && (r2.style.opacity = 0);
          else
            r2 && s2.globals.series.length > 1 && (r2.style.opacity = 0);
      } }]), t2;
    }();
    var St = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.chartType = this.w.config.chart.type, this.initialAnim = this.w.config.chart.animations.enabled, this.dynamicAnim = this.initialAnim && this.w.config.chart.animations.dynamicAnimation.enabled, this.animDur = 0;
        var i2 = this.w;
        this.graphics = new b(this.ctx), this.lineColorArr = void 0 !== i2.globals.stroke.colors ? i2.globals.stroke.colors : i2.globals.colors, this.defaultSize = i2.globals.svgHeight < i2.globals.svgWidth ? i2.globals.gridHeight + 1.5 * i2.globals.goldenPadding : i2.globals.gridWidth, this.isLog = i2.config.yaxis[0].logarithmic, this.coreUtils = new y(this.ctx), this.maxValue = this.isLog ? this.coreUtils.getLogVal(i2.globals.maxY, 0) : i2.globals.maxY, this.minValue = this.isLog ? this.coreUtils.getLogVal(this.w.globals.minY, 0) : i2.globals.minY, this.polygons = i2.config.plotOptions.radar.polygons, this.strokeWidth = i2.config.stroke.show ? i2.config.stroke.width : 0, this.size = this.defaultSize / 2.1 - this.strokeWidth - i2.config.chart.dropShadow.blur, i2.config.xaxis.labels.show && (this.size = this.size - i2.globals.xAxisLabelsWidth / 1.75), void 0 !== i2.config.plotOptions.radar.size && (this.size = i2.config.plotOptions.radar.size), this.dataRadiusOfPercent = [], this.dataRadius = [], this.angleArr = [], this.yaxisLabelsTextsPos = [];
      }
      return r(t2, [{ key: "draw", value: function(t3) {
        var i2 = this, a2 = this.w, s2 = new L(this.ctx), r2 = [], o2 = new M(this.ctx);
        t3.length && (this.dataPointsLen = t3[a2.globals.maxValsInArrayIndex].length), this.disAngle = 2 * Math.PI / this.dataPointsLen;
        var n2 = a2.globals.gridWidth / 2, l2 = a2.globals.gridHeight / 2, h2 = n2 + a2.config.plotOptions.radar.offsetX, c2 = l2 + a2.config.plotOptions.radar.offsetY, d2 = this.graphics.group({ class: "apexcharts-radar-series apexcharts-plot-series", transform: "translate(".concat(h2 || 0, ", ").concat(c2 || 0, ")") }), g2 = [], u2 = null, f2 = null;
        if (this.yaxisLabels = this.graphics.group({ class: "apexcharts-yaxis" }), t3.forEach(function(t4, n3) {
          var l3 = t4.length === a2.globals.dataPoints, h3 = i2.graphics.group().attr({ class: "apexcharts-series", "data:longestSeries": l3, seriesName: p.escapeString(a2.globals.seriesNames[n3]), rel: n3 + 1, "data:realIndex": n3 });
          i2.dataRadiusOfPercent[n3] = [], i2.dataRadius[n3] = [], i2.angleArr[n3] = [], t4.forEach(function(t5, e2) {
            var a3 = Math.abs(i2.maxValue - i2.minValue);
            t5 += Math.abs(i2.minValue), i2.isLog && (t5 = i2.coreUtils.getLogVal(t5, 0)), i2.dataRadiusOfPercent[n3][e2] = t5 / a3, i2.dataRadius[n3][e2] = i2.dataRadiusOfPercent[n3][e2] * i2.size, i2.angleArr[n3][e2] = e2 * i2.disAngle;
          }), g2 = i2.getDataPointsPos(i2.dataRadius[n3], i2.angleArr[n3]);
          var c3 = i2.createPaths(g2, { x: 0, y: 0 });
          u2 = i2.graphics.group({ class: "apexcharts-series-markers-wrap apexcharts-element-hidden" }), f2 = i2.graphics.group({ class: "apexcharts-datalabels", "data:realIndex": n3 }), a2.globals.delayedElements.push({ el: u2.node, index: n3 });
          var d3 = { i: n3, realIndex: n3, animationDelay: n3, initialSpeed: a2.config.chart.animations.speed, dataChangeSpeed: a2.config.chart.animations.dynamicAnimation.speed, className: "apexcharts-radar", shouldClipToGrid: false, bindEventsOnPaths: false, stroke: a2.globals.stroke.colors[n3], strokeLineCap: a2.config.stroke.lineCap }, b3 = null;
          a2.globals.previousPaths.length > 0 && (b3 = i2.getPreviousPath(n3));
          for (var v2 = 0; v2 < c3.linePathsTo.length; v2++) {
            var m2 = i2.graphics.renderPaths(e(e({}, d3), {}, { pathFrom: null === b3 ? c3.linePathsFrom[v2] : b3, pathTo: c3.linePathsTo[v2], strokeWidth: Array.isArray(i2.strokeWidth) ? i2.strokeWidth[n3] : i2.strokeWidth, fill: "none", drawShadow: false }));
            h3.add(m2);
            var y2 = s2.fillPath({ seriesNumber: n3 }), w2 = i2.graphics.renderPaths(e(e({}, d3), {}, { pathFrom: null === b3 ? c3.areaPathsFrom[v2] : b3, pathTo: c3.areaPathsTo[v2], strokeWidth: 0, fill: y2, drawShadow: false }));
            if (a2.config.chart.dropShadow.enabled) {
              var k2 = new x(i2.ctx), A2 = a2.config.chart.dropShadow;
              k2.dropShadow(w2, Object.assign({}, A2, { noUserSpaceOnUse: true }), n3);
            }
            h3.add(w2);
          }
          t4.forEach(function(t5, s3) {
            var r3 = new P(i2.ctx).getMarkerConfig({ cssClass: "apexcharts-marker", seriesIndex: n3, dataPointIndex: s3 }), l4 = i2.graphics.drawMarker(g2[s3].x, g2[s3].y, r3);
            l4.attr("rel", s3), l4.attr("j", s3), l4.attr("index", n3), l4.node.setAttribute("default-marker-size", r3.pSize);
            var c4 = i2.graphics.group({ class: "apexcharts-series-markers" });
            c4 && c4.add(l4), u2.add(c4), h3.add(u2);
            var d4 = a2.config.dataLabels;
            if (d4.enabled) {
              var p2 = d4.formatter(a2.globals.series[n3][s3], { seriesIndex: n3, dataPointIndex: s3, w: a2 });
              o2.plotDataLabelsText({ x: g2[s3].x, y: g2[s3].y, text: p2, textAnchor: "middle", i: n3, j: n3, parent: f2, offsetCorrection: false, dataLabelsConfig: e({}, d4) });
            }
            h3.add(f2);
          }), r2.push(h3);
        }), this.drawPolygons({ parent: d2 }), a2.config.xaxis.labels.show) {
          var b2 = this.drawXAxisTexts();
          d2.add(b2);
        }
        return r2.forEach(function(t4) {
          d2.add(t4);
        }), d2.add(this.yaxisLabels), d2;
      } }, { key: "drawPolygons", value: function(t3) {
        for (var e2 = this, i2 = this.w, a2 = t3.parent, s2 = new kt(this.ctx), r2 = i2.globals.yAxisScale[0].result.reverse(), o2 = r2.length, n2 = [], l2 = this.size / (o2 - 1), h2 = 0; h2 < o2; h2++)
          n2[h2] = l2 * h2;
        n2.reverse();
        var c2 = [], d2 = [];
        n2.forEach(function(t4, i3) {
          var a3 = p.getPolygonPos(t4, e2.dataPointsLen), s3 = "";
          a3.forEach(function(t5, a4) {
            if (0 === i3) {
              var r3 = e2.graphics.drawLine(t5.x, t5.y, 0, 0, Array.isArray(e2.polygons.connectorColors) ? e2.polygons.connectorColors[a4] : e2.polygons.connectorColors);
              d2.push(r3);
            }
            0 === a4 && e2.yaxisLabelsTextsPos.push({ x: t5.x, y: t5.y }), s3 += t5.x + "," + t5.y + " ";
          }), c2.push(s3);
        }), c2.forEach(function(t4, s3) {
          var r3 = e2.polygons.strokeColors, o3 = e2.polygons.strokeWidth, n3 = e2.graphics.drawPolygon(t4, Array.isArray(r3) ? r3[s3] : r3, Array.isArray(o3) ? o3[s3] : o3, i2.globals.radarPolygons.fill.colors[s3]);
          a2.add(n3);
        }), d2.forEach(function(t4) {
          a2.add(t4);
        }), i2.config.yaxis[0].show && this.yaxisLabelsTextsPos.forEach(function(t4, i3) {
          var a3 = s2.drawYAxisTexts(t4.x, t4.y, i3, r2[i3]);
          e2.yaxisLabels.add(a3);
        });
      } }, { key: "drawXAxisTexts", value: function() {
        var t3 = this, i2 = this.w, a2 = i2.config.xaxis.labels, s2 = this.graphics.group({ class: "apexcharts-xaxis" }), r2 = p.getPolygonPos(this.size, this.dataPointsLen);
        return i2.globals.labels.forEach(function(o2, n2) {
          var l2 = i2.config.xaxis.labels.formatter, h2 = new M(t3.ctx);
          if (r2[n2]) {
            var c2 = t3.getTextPos(r2[n2], t3.size), d2 = l2(o2, { seriesIndex: -1, dataPointIndex: n2, w: i2 });
            h2.plotDataLabelsText({ x: c2.newX, y: c2.newY, text: d2, textAnchor: c2.textAnchor, i: n2, j: n2, parent: s2, color: Array.isArray(a2.style.colors) && a2.style.colors[n2] ? a2.style.colors[n2] : "#a8a8a8", dataLabelsConfig: e({ textAnchor: c2.textAnchor, dropShadow: { enabled: false } }, a2), offsetCorrection: false });
          }
        }), s2;
      } }, { key: "createPaths", value: function(t3, e2) {
        var i2 = this, a2 = [], s2 = [], r2 = [], o2 = [];
        if (t3.length) {
          s2 = [this.graphics.move(e2.x, e2.y)], o2 = [this.graphics.move(e2.x, e2.y)];
          var n2 = this.graphics.move(t3[0].x, t3[0].y), l2 = this.graphics.move(t3[0].x, t3[0].y);
          t3.forEach(function(e3, a3) {
            n2 += i2.graphics.line(e3.x, e3.y), l2 += i2.graphics.line(e3.x, e3.y), a3 === t3.length - 1 && (n2 += "Z", l2 += "Z");
          }), a2.push(n2), r2.push(l2);
        }
        return { linePathsFrom: s2, linePathsTo: a2, areaPathsFrom: o2, areaPathsTo: r2 };
      } }, { key: "getTextPos", value: function(t3, e2) {
        var i2 = "middle", a2 = t3.x, s2 = t3.y;
        return Math.abs(t3.x) >= 10 ? t3.x > 0 ? (i2 = "start", a2 += 10) : t3.x < 0 && (i2 = "end", a2 -= 10) : i2 = "middle", Math.abs(t3.y) >= e2 - 10 && (t3.y < 0 ? s2 -= 10 : t3.y > 0 && (s2 += 10)), { textAnchor: i2, newX: a2, newY: s2 };
      } }, { key: "getPreviousPath", value: function(t3) {
        for (var e2 = this.w, i2 = null, a2 = 0; a2 < e2.globals.previousPaths.length; a2++) {
          var s2 = e2.globals.previousPaths[a2];
          s2.paths.length > 0 && parseInt(s2.realIndex, 10) === parseInt(t3, 10) && void 0 !== e2.globals.previousPaths[a2].paths[0] && (i2 = e2.globals.previousPaths[a2].paths[0].d);
        }
        return i2;
      } }, { key: "getDataPointsPos", value: function(t3, e2) {
        var i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : this.dataPointsLen;
        t3 = t3 || [], e2 = e2 || [];
        for (var a2 = [], s2 = 0; s2 < i2; s2++) {
          var r2 = {};
          r2.x = t3[s2] * Math.sin(e2[s2]), r2.y = -t3[s2] * Math.cos(e2[s2]), a2.push(r2);
        }
        return a2;
      } }]), t2;
    }();
    var Ct = function(t2) {
      n(i2, At);
      var e2 = d(i2);
      function i2(t3) {
        var s2;
        a(this, i2), (s2 = e2.call(this, t3)).ctx = t3, s2.w = t3.w, s2.animBeginArr = [0], s2.animDur = 0;
        var r2 = s2.w;
        return s2.startAngle = r2.config.plotOptions.radialBar.startAngle, s2.endAngle = r2.config.plotOptions.radialBar.endAngle, s2.totalAngle = Math.abs(r2.config.plotOptions.radialBar.endAngle - r2.config.plotOptions.radialBar.startAngle), s2.trackStartAngle = r2.config.plotOptions.radialBar.track.startAngle, s2.trackEndAngle = r2.config.plotOptions.radialBar.track.endAngle, s2.radialDataLabels = r2.config.plotOptions.radialBar.dataLabels, s2.trackStartAngle || (s2.trackStartAngle = s2.startAngle), s2.trackEndAngle || (s2.trackEndAngle = s2.endAngle), 360 === s2.endAngle && (s2.endAngle = 359.99), s2.margin = parseInt(r2.config.plotOptions.radialBar.track.margin, 10), s2;
      }
      return r(i2, [{ key: "draw", value: function(t3) {
        var e3 = this.w, i3 = new b(this.ctx), a2 = i3.group({ class: "apexcharts-radialbar" });
        if (e3.globals.noData)
          return a2;
        var s2 = i3.group(), r2 = this.defaultSize / 2, o2 = e3.globals.gridWidth / 2, n2 = this.defaultSize / 2.05;
        e3.config.chart.sparkline.enabled || (n2 = n2 - e3.config.stroke.width - e3.config.chart.dropShadow.blur);
        var l2 = e3.globals.fill.colors;
        if (e3.config.plotOptions.radialBar.track.show) {
          var h2 = this.drawTracks({ size: n2, centerX: o2, centerY: r2, colorArr: l2, series: t3 });
          s2.add(h2);
        }
        var c2 = this.drawArcs({ size: n2, centerX: o2, centerY: r2, colorArr: l2, series: t3 }), d2 = 360;
        e3.config.plotOptions.radialBar.startAngle < 0 && (d2 = this.totalAngle);
        var g2 = (360 - d2) / 360;
        if (e3.globals.radialSize = n2 - n2 * g2, this.radialDataLabels.value.show) {
          var u2 = Math.max(this.radialDataLabels.value.offsetY, this.radialDataLabels.name.offsetY);
          e3.globals.radialSize += u2 * g2;
        }
        return s2.add(c2.g), "front" === e3.config.plotOptions.radialBar.hollow.position && (c2.g.add(c2.elHollow), c2.dataLabels && c2.g.add(c2.dataLabels)), a2.add(s2), a2;
      } }, { key: "drawTracks", value: function(t3) {
        var e3 = this.w, i3 = new b(this.ctx), a2 = i3.group({ class: "apexcharts-tracks" }), s2 = new x(this.ctx), r2 = new L(this.ctx), o2 = this.getStrokeWidth(t3);
        t3.size = t3.size - o2 / 2;
        for (var n2 = 0; n2 < t3.series.length; n2++) {
          var l2 = i3.group({ class: "apexcharts-radialbar-track apexcharts-track" });
          a2.add(l2), l2.attr({ rel: n2 + 1 }), t3.size = t3.size - o2 - this.margin;
          var h2 = e3.config.plotOptions.radialBar.track, c2 = r2.fillPath({ seriesNumber: 0, size: t3.size, fillColors: Array.isArray(h2.background) ? h2.background[n2] : h2.background, solid: true }), d2 = this.trackStartAngle, g2 = this.trackEndAngle;
          Math.abs(g2) + Math.abs(d2) >= 360 && (g2 = 360 - Math.abs(this.startAngle) - 0.1);
          var u2 = i3.drawPath({ d: "", stroke: c2, strokeWidth: o2 * parseInt(h2.strokeWidth, 10) / 100, fill: "none", strokeOpacity: h2.opacity, classes: "apexcharts-radialbar-area" });
          if (h2.dropShadow.enabled) {
            var p2 = h2.dropShadow;
            s2.dropShadow(u2, p2);
          }
          l2.add(u2), u2.attr("id", "apexcharts-radialbarTrack-" + n2), this.animatePaths(u2, { centerX: t3.centerX, centerY: t3.centerY, endAngle: g2, startAngle: d2, size: t3.size, i: n2, totalItems: 2, animBeginArr: 0, dur: 0, isTrack: true, easing: e3.globals.easing });
        }
        return a2;
      } }, { key: "drawArcs", value: function(t3) {
        var e3 = this.w, i3 = new b(this.ctx), a2 = new L(this.ctx), s2 = new x(this.ctx), r2 = i3.group(), o2 = this.getStrokeWidth(t3);
        t3.size = t3.size - o2 / 2;
        var n2 = e3.config.plotOptions.radialBar.hollow.background, l2 = t3.size - o2 * t3.series.length - this.margin * t3.series.length - o2 * parseInt(e3.config.plotOptions.radialBar.track.strokeWidth, 10) / 100 / 2, h2 = l2 - e3.config.plotOptions.radialBar.hollow.margin;
        void 0 !== e3.config.plotOptions.radialBar.hollow.image && (n2 = this.drawHollowImage(t3, r2, l2, n2));
        var c2 = this.drawHollow({ size: h2, centerX: t3.centerX, centerY: t3.centerY, fill: n2 || "transparent" });
        if (e3.config.plotOptions.radialBar.hollow.dropShadow.enabled) {
          var d2 = e3.config.plotOptions.radialBar.hollow.dropShadow;
          s2.dropShadow(c2, d2);
        }
        var g2 = 1;
        !this.radialDataLabels.total.show && e3.globals.series.length > 1 && (g2 = 0);
        var u2 = null;
        this.radialDataLabels.show && (u2 = this.renderInnerDataLabels(this.radialDataLabels, { hollowSize: l2, centerX: t3.centerX, centerY: t3.centerY, opacity: g2 })), "back" === e3.config.plotOptions.radialBar.hollow.position && (r2.add(c2), u2 && r2.add(u2));
        var f2 = false;
        e3.config.plotOptions.radialBar.inverseOrder && (f2 = true);
        for (var v2 = f2 ? t3.series.length - 1 : 0; f2 ? v2 >= 0 : v2 < t3.series.length; f2 ? v2-- : v2++) {
          var m2 = i3.group({ class: "apexcharts-series apexcharts-radial-series", seriesName: p.escapeString(e3.globals.seriesNames[v2]) });
          r2.add(m2), m2.attr({ rel: v2 + 1, "data:realIndex": v2 }), this.ctx.series.addCollapsedClassToSeries(m2, v2), t3.size = t3.size - o2 - this.margin;
          var y2 = a2.fillPath({ seriesNumber: v2, size: t3.size, value: t3.series[v2] }), w2 = this.startAngle, k2 = void 0, A2 = p.negToZero(t3.series[v2] > 100 ? 100 : t3.series[v2]) / 100, S2 = Math.round(this.totalAngle * A2) + this.startAngle, C2 = void 0;
          e3.globals.dataChanged && (k2 = this.startAngle, C2 = Math.round(this.totalAngle * p.negToZero(e3.globals.previousPaths[v2]) / 100) + k2), Math.abs(S2) + Math.abs(w2) >= 360 && (S2 -= 0.01), Math.abs(C2) + Math.abs(k2) >= 360 && (C2 -= 0.01);
          var P2 = S2 - w2, T2 = Array.isArray(e3.config.stroke.dashArray) ? e3.config.stroke.dashArray[v2] : e3.config.stroke.dashArray, M2 = i3.drawPath({ d: "", stroke: y2, strokeWidth: o2, fill: "none", fillOpacity: e3.config.fill.opacity, classes: "apexcharts-radialbar-area apexcharts-radialbar-slice-" + v2, strokeDashArray: T2 });
          if (b.setAttrs(M2.node, { "data:angle": P2, "data:value": t3.series[v2] }), e3.config.chart.dropShadow.enabled) {
            var I2 = e3.config.chart.dropShadow;
            s2.dropShadow(M2, I2, v2);
          }
          s2.setSelectionFilter(M2, 0, v2), this.addListeners(M2, this.radialDataLabels), m2.add(M2), M2.attr({ index: 0, j: v2 });
          var z2 = 0;
          !this.initialAnim || e3.globals.resized || e3.globals.dataChanged || (z2 = (S2 - w2) / 360 * e3.config.chart.animations.speed, this.animDur = z2 / (1.2 * t3.series.length) + this.animDur, this.animBeginArr.push(this.animDur)), e3.globals.dataChanged && (z2 = (S2 - w2) / 360 * e3.config.chart.animations.dynamicAnimation.speed, this.animDur = z2 / (1.2 * t3.series.length) + this.animDur, this.animBeginArr.push(this.animDur)), this.animatePaths(M2, { centerX: t3.centerX, centerY: t3.centerY, endAngle: S2, startAngle: w2, prevEndAngle: C2, prevStartAngle: k2, size: t3.size, i: v2, totalItems: 2, animBeginArr: this.animBeginArr, dur: z2, shouldSetPrevPaths: true, easing: e3.globals.easing });
        }
        return { g: r2, elHollow: c2, dataLabels: u2 };
      } }, { key: "drawHollow", value: function(t3) {
        var e3 = new b(this.ctx).drawCircle(2 * t3.size);
        return e3.attr({ class: "apexcharts-radialbar-hollow", cx: t3.centerX, cy: t3.centerY, r: t3.size, fill: t3.fill }), e3;
      } }, { key: "drawHollowImage", value: function(t3, e3, i3, a2) {
        var s2 = this.w, r2 = new L(this.ctx), o2 = p.randomId(), n2 = s2.config.plotOptions.radialBar.hollow.image;
        if (s2.config.plotOptions.radialBar.hollow.imageClipped)
          r2.clippedImgArea({ width: i3, height: i3, image: n2, patternID: "pattern".concat(s2.globals.cuid).concat(o2) }), a2 = "url(#pattern".concat(s2.globals.cuid).concat(o2, ")");
        else {
          var l2 = s2.config.plotOptions.radialBar.hollow.imageWidth, h2 = s2.config.plotOptions.radialBar.hollow.imageHeight;
          if (void 0 === l2 && void 0 === h2) {
            var c2 = s2.globals.dom.Paper.image(n2).loaded(function(e4) {
              this.move(t3.centerX - e4.width / 2 + s2.config.plotOptions.radialBar.hollow.imageOffsetX, t3.centerY - e4.height / 2 + s2.config.plotOptions.radialBar.hollow.imageOffsetY);
            });
            e3.add(c2);
          } else {
            var d2 = s2.globals.dom.Paper.image(n2).loaded(function(e4) {
              this.move(t3.centerX - l2 / 2 + s2.config.plotOptions.radialBar.hollow.imageOffsetX, t3.centerY - h2 / 2 + s2.config.plotOptions.radialBar.hollow.imageOffsetY), this.size(l2, h2);
            });
            e3.add(d2);
          }
        }
        return a2;
      } }, { key: "getStrokeWidth", value: function(t3) {
        var e3 = this.w;
        return t3.size * (100 - parseInt(e3.config.plotOptions.radialBar.hollow.size, 10)) / 100 / (t3.series.length + 1) - this.margin;
      } }]), i2;
    }();
    var Lt = function() {
      function t2(e2) {
        a(this, t2), this.w = e2.w, this.lineCtx = e2;
      }
      return r(t2, [{ key: "sameValueSeriesFix", value: function(t3, e2) {
        var i2 = this.w;
        if ("line" === i2.config.chart.type && ("gradient" === i2.config.fill.type || "gradient" === i2.config.fill.type[t3]) && new y(this.lineCtx.ctx, i2).seriesHaveSameValues(t3)) {
          var a2 = e2[t3].slice();
          a2[a2.length - 1] = a2[a2.length - 1] + 1e-6, e2[t3] = a2;
        }
        return e2;
      } }, { key: "calculatePoints", value: function(t3) {
        var e2 = t3.series, i2 = t3.realIndex, a2 = t3.x, s2 = t3.y, r2 = t3.i, o2 = t3.j, n2 = t3.prevY, l2 = this.w, h2 = [], c2 = [];
        if (0 === o2) {
          var d2 = this.lineCtx.categoryAxisCorrection + l2.config.markers.offsetX;
          l2.globals.isXNumeric && (d2 = (l2.globals.seriesX[i2][0] - l2.globals.minX) / this.lineCtx.xRatio + l2.config.markers.offsetX), h2.push(d2), c2.push(p.isNumber(e2[r2][0]) ? n2 + l2.config.markers.offsetY : null), h2.push(a2 + l2.config.markers.offsetX), c2.push(p.isNumber(e2[r2][o2 + 1]) ? s2 + l2.config.markers.offsetY : null);
        } else
          h2.push(a2 + l2.config.markers.offsetX), c2.push(p.isNumber(e2[r2][o2 + 1]) ? s2 + l2.config.markers.offsetY : null);
        return { x: h2, y: c2 };
      } }, { key: "checkPreviousPaths", value: function(t3) {
        for (var e2 = t3.pathFromLine, i2 = t3.pathFromArea, a2 = t3.realIndex, s2 = this.w, r2 = 0; r2 < s2.globals.previousPaths.length; r2++) {
          var o2 = s2.globals.previousPaths[r2];
          ("line" === o2.type || "area" === o2.type) && o2.paths.length > 0 && parseInt(o2.realIndex, 10) === parseInt(a2, 10) && ("line" === o2.type ? (this.lineCtx.appendPathFrom = false, e2 = s2.globals.previousPaths[r2].paths[0].d) : "area" === o2.type && (this.lineCtx.appendPathFrom = false, i2 = s2.globals.previousPaths[r2].paths[0].d, s2.config.stroke.show && s2.globals.previousPaths[r2].paths[1] && (e2 = s2.globals.previousPaths[r2].paths[1].d)));
        }
        return { pathFromLine: e2, pathFromArea: i2 };
      } }, { key: "determineFirstPrevY", value: function(t3) {
        var e2 = t3.i, i2 = t3.series, a2 = t3.prevY, s2 = t3.lineYPosition, r2 = this.w;
        if (void 0 !== i2[e2][0])
          a2 = (s2 = r2.config.chart.stacked && e2 > 0 ? this.lineCtx.prevSeriesY[e2 - 1][0] : this.lineCtx.zeroY) - i2[e2][0] / this.lineCtx.yRatio[this.lineCtx.yaxisIndex] + 2 * (this.lineCtx.isReversed ? i2[e2][0] / this.lineCtx.yRatio[this.lineCtx.yaxisIndex] : 0);
        else if (r2.config.chart.stacked && e2 > 0 && void 0 === i2[e2][0]) {
          for (var o2 = e2 - 1; o2 >= 0; o2--)
            if (null !== i2[o2][0] && void 0 !== i2[o2][0]) {
              a2 = s2 = this.lineCtx.prevSeriesY[o2][0];
              break;
            }
        }
        return { prevY: a2, lineYPosition: s2 };
      } }]), t2;
    }();
    var Pt = function() {
      function t2(e2, i2, s2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.xyRatios = i2, this.pointsChart = !("bubble" !== this.w.config.chart.type && "scatter" !== this.w.config.chart.type) || s2, this.scatter = new T(this.ctx), this.noNegatives = this.w.globals.minX === Number.MAX_VALUE, this.lineHelpers = new Lt(this), this.markers = new P(this.ctx), this.prevSeriesY = [], this.categoryAxisCorrection = 0, this.yaxisIndex = 0;
      }
      return r(t2, [{ key: "draw", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = new b(this.ctx), r2 = a2.globals.comboCharts ? e2 : a2.config.chart.type, o2 = s2.group({ class: "apexcharts-".concat(r2, "-series apexcharts-plot-series") }), n2 = new y(this.ctx, a2);
        this.yRatio = this.xyRatios.yRatio, this.zRatio = this.xyRatios.zRatio, this.xRatio = this.xyRatios.xRatio, this.baseLineY = this.xyRatios.baseLineY, t3 = n2.getLogSeries(t3), this.yRatio = n2.getLogYRatios(this.yRatio);
        for (var l2 = [], h2 = 0; h2 < t3.length; h2++) {
          t3 = this.lineHelpers.sameValueSeriesFix(h2, t3);
          var c2 = a2.globals.comboCharts ? i2[h2] : h2;
          this._initSerieVariables(t3, h2, c2);
          var d2 = [], g2 = [], u2 = a2.globals.padHorizontal + this.categoryAxisCorrection;
          this.ctx.series.addCollapsedClassToSeries(this.elSeries, c2), a2.globals.isXNumeric && a2.globals.seriesX.length > 0 && (u2 = (a2.globals.seriesX[c2][0] - a2.globals.minX) / this.xRatio), g2.push(u2);
          var p2, f2 = u2, x2 = f2, v2 = this.zeroY;
          v2 = this.lineHelpers.determineFirstPrevY({ i: h2, series: t3, prevY: v2, lineYPosition: 0 }).prevY, d2.push(v2), p2 = v2;
          var m2 = this._calculatePathsFrom({ series: t3, i: h2, realIndex: c2, prevX: x2, prevY: v2 }), w2 = this._iterateOverDataPoints({ series: t3, realIndex: c2, i: h2, x: u2, y: 1, pX: f2, pY: p2, pathsFrom: m2, linePaths: [], areaPaths: [], seriesIndex: i2, lineYPosition: 0, xArrj: g2, yArrj: d2 });
          this._handlePaths({ type: r2, realIndex: c2, i: h2, paths: w2 }), this.elSeries.add(this.elPointsMain), this.elSeries.add(this.elDataLabelsWrap), l2.push(this.elSeries);
        }
        if (a2.config.chart.stacked)
          for (var k2 = l2.length; k2 > 0; k2--)
            o2.add(l2[k2 - 1]);
        else
          for (var A2 = 0; A2 < l2.length; A2++)
            o2.add(l2[A2]);
        return o2;
      } }, { key: "_initSerieVariables", value: function(t3, e2, i2) {
        var a2 = this.w, s2 = new b(this.ctx);
        this.xDivision = a2.globals.gridWidth / (a2.globals.dataPoints - ("on" === a2.config.xaxis.tickPlacement ? 1 : 0)), this.strokeWidth = Array.isArray(a2.config.stroke.width) ? a2.config.stroke.width[i2] : a2.config.stroke.width, this.yRatio.length > 1 && (this.yaxisIndex = i2), this.isReversed = a2.config.yaxis[this.yaxisIndex] && a2.config.yaxis[this.yaxisIndex].reversed, this.zeroY = a2.globals.gridHeight - this.baseLineY[this.yaxisIndex] - (this.isReversed ? a2.globals.gridHeight : 0) + (this.isReversed ? 2 * this.baseLineY[this.yaxisIndex] : 0), this.areaBottomY = this.zeroY, (this.zeroY > a2.globals.gridHeight || "end" === a2.config.plotOptions.area.fillTo) && (this.areaBottomY = a2.globals.gridHeight), this.categoryAxisCorrection = this.xDivision / 2, this.elSeries = s2.group({ class: "apexcharts-series", seriesName: p.escapeString(a2.globals.seriesNames[i2]) }), this.elPointsMain = s2.group({ class: "apexcharts-series-markers-wrap", "data:realIndex": i2 }), this.elDataLabelsWrap = s2.group({ class: "apexcharts-datalabels", "data:realIndex": i2 });
        var r2 = t3[e2].length === a2.globals.dataPoints;
        this.elSeries.attr({ "data:longestSeries": r2, rel: e2 + 1, "data:realIndex": i2 }), this.appendPathFrom = true;
      } }, { key: "_calculatePathsFrom", value: function(t3) {
        var e2, i2, a2, s2, r2 = t3.series, o2 = t3.i, n2 = t3.realIndex, l2 = t3.prevX, h2 = t3.prevY, c2 = this.w, d2 = new b(this.ctx);
        if (null === r2[o2][0]) {
          for (var g2 = 0; g2 < r2[o2].length; g2++)
            if (null !== r2[o2][g2]) {
              l2 = this.xDivision * g2, h2 = this.zeroY - r2[o2][g2] / this.yRatio[this.yaxisIndex], e2 = d2.move(l2, h2), i2 = d2.move(l2, this.areaBottomY);
              break;
            }
        } else
          e2 = d2.move(l2, h2), i2 = d2.move(l2, this.areaBottomY) + d2.line(l2, h2);
        if (a2 = d2.move(-1, this.zeroY) + d2.line(-1, this.zeroY), s2 = d2.move(-1, this.zeroY) + d2.line(-1, this.zeroY), c2.globals.previousPaths.length > 0) {
          var u2 = this.lineHelpers.checkPreviousPaths({ pathFromLine: a2, pathFromArea: s2, realIndex: n2 });
          a2 = u2.pathFromLine, s2 = u2.pathFromArea;
        }
        return { prevX: l2, prevY: h2, linePath: e2, areaPath: i2, pathFromLine: a2, pathFromArea: s2 };
      } }, { key: "_handlePaths", value: function(t3) {
        var i2 = t3.type, a2 = t3.realIndex, s2 = t3.i, r2 = t3.paths, o2 = this.w, n2 = new b(this.ctx), l2 = new L(this.ctx);
        this.prevSeriesY.push(r2.yArrj), o2.globals.seriesXvalues[a2] = r2.xArrj, o2.globals.seriesYvalues[a2] = r2.yArrj;
        var h2 = o2.config.forecastDataPoints;
        if (h2.count > 0) {
          var c2 = o2.globals.seriesXvalues[a2][o2.globals.seriesXvalues[a2].length - h2.count - 1], d2 = n2.drawRect(c2, 0, o2.globals.gridWidth, o2.globals.gridHeight, 0);
          o2.globals.dom.elForecastMask.appendChild(d2.node);
          var g2 = n2.drawRect(0, 0, c2, o2.globals.gridHeight, 0);
          o2.globals.dom.elNonForecastMask.appendChild(g2.node);
        }
        this.pointsChart || o2.globals.delayedElements.push({ el: this.elPointsMain.node, index: a2 });
        var u2 = { i: s2, realIndex: a2, animationDelay: s2, initialSpeed: o2.config.chart.animations.speed, dataChangeSpeed: o2.config.chart.animations.dynamicAnimation.speed, className: "apexcharts-".concat(i2) };
        if ("area" === i2)
          for (var p2 = l2.fillPath({ seriesNumber: a2 }), f2 = 0; f2 < r2.areaPaths.length; f2++) {
            var x2 = n2.renderPaths(e(e({}, u2), {}, { pathFrom: r2.pathFromArea, pathTo: r2.areaPaths[f2], stroke: "none", strokeWidth: 0, strokeLineCap: null, fill: p2 }));
            this.elSeries.add(x2);
          }
        if (o2.config.stroke.show && !this.pointsChart) {
          var v2 = null;
          v2 = "line" === i2 ? l2.fillPath({ seriesNumber: a2, i: s2 }) : o2.globals.stroke.colors[a2];
          for (var m2 = 0; m2 < r2.linePaths.length; m2++) {
            var y2 = e(e({}, u2), {}, { pathFrom: r2.pathFromLine, pathTo: r2.linePaths[m2], stroke: v2, strokeWidth: this.strokeWidth, strokeLineCap: o2.config.stroke.lineCap, fill: "none" }), w2 = n2.renderPaths(y2);
            if (this.elSeries.add(w2), h2.count > 0) {
              var k2 = n2.renderPaths(y2);
              k2.node.setAttribute("stroke-dasharray", h2.dashArray), h2.strokeWidth && k2.node.setAttribute("stroke-width", h2.strokeWidth), this.elSeries.add(k2), k2.attr("clip-path", "url(#forecastMask".concat(o2.globals.cuid, ")")), w2.attr("clip-path", "url(#nonForecastMask".concat(o2.globals.cuid, ")"));
            }
          }
        }
      } }, { key: "_iterateOverDataPoints", value: function(t3) {
        for (var e2 = t3.series, i2 = t3.realIndex, a2 = t3.i, s2 = t3.x, r2 = t3.y, o2 = t3.pX, n2 = t3.pY, l2 = t3.pathsFrom, h2 = t3.linePaths, c2 = t3.areaPaths, d2 = t3.seriesIndex, g2 = t3.lineYPosition, u2 = t3.xArrj, f2 = t3.yArrj, x2 = this.w, v2 = new b(this.ctx), m2 = this.yRatio, y2 = l2.prevY, w2 = l2.linePath, k2 = l2.areaPath, A2 = l2.pathFromLine, S2 = l2.pathFromArea, C2 = p.isNumber(x2.globals.minYArr[i2]) ? x2.globals.minYArr[i2] : x2.globals.minY, L2 = x2.globals.dataPoints > 1 ? x2.globals.dataPoints - 1 : x2.globals.dataPoints, P2 = 0; P2 < L2; P2++) {
          var T2 = void 0 === e2[a2][P2 + 1] || null === e2[a2][P2 + 1];
          if (x2.globals.isXNumeric) {
            var M2 = x2.globals.seriesX[i2][P2 + 1];
            void 0 === x2.globals.seriesX[i2][P2 + 1] && (M2 = x2.globals.seriesX[i2][L2 - 1]), s2 = (M2 - x2.globals.minX) / this.xRatio;
          } else
            s2 += this.xDivision;
          if (x2.config.chart.stacked)
            if (a2 > 0 && x2.globals.collapsedSeries.length < x2.config.series.length - 1) {
              g2 = this.prevSeriesY[function(t4) {
                for (var e3 = t4, i3 = 0; i3 < x2.globals.series.length; i3++)
                  if (x2.globals.collapsedSeriesIndices.indexOf(t4) > -1) {
                    e3--;
                    break;
                  }
                return e3 >= 0 ? e3 : 0;
              }(a2 - 1)][P2 + 1];
            } else
              g2 = this.zeroY;
          else
            g2 = this.zeroY;
          r2 = T2 ? g2 - C2 / m2[this.yaxisIndex] + 2 * (this.isReversed ? C2 / m2[this.yaxisIndex] : 0) : g2 - e2[a2][P2 + 1] / m2[this.yaxisIndex] + 2 * (this.isReversed ? e2[a2][P2 + 1] / m2[this.yaxisIndex] : 0), u2.push(s2), f2.push(r2);
          var I2 = this.lineHelpers.calculatePoints({ series: e2, x: s2, y: r2, realIndex: i2, i: a2, j: P2, prevY: y2 }), z2 = this._createPaths({ series: e2, i: a2, realIndex: i2, j: P2, x: s2, y: r2, pX: o2, pY: n2, linePath: w2, areaPath: k2, linePaths: h2, areaPaths: c2, seriesIndex: d2 });
          c2 = z2.areaPaths, h2 = z2.linePaths, o2 = z2.pX, n2 = z2.pY, k2 = z2.areaPath, w2 = z2.linePath, this.appendPathFrom && (A2 += v2.line(s2, this.zeroY), S2 += v2.line(s2, this.zeroY)), this.handleNullDataPoints(e2, I2, a2, P2, i2), this._handleMarkersAndLabels({ pointsPos: I2, series: e2, x: s2, y: r2, prevY: y2, i: a2, j: P2, realIndex: i2 });
        }
        return { yArrj: f2, xArrj: u2, pathFromArea: S2, areaPaths: c2, pathFromLine: A2, linePaths: h2 };
      } }, { key: "_handleMarkersAndLabels", value: function(t3) {
        var e2 = t3.pointsPos;
        t3.series, t3.x, t3.y, t3.prevY;
        var i2 = t3.i, a2 = t3.j, s2 = t3.realIndex, r2 = this.w, o2 = new M(this.ctx);
        if (this.pointsChart)
          this.scatter.draw(this.elSeries, a2, { realIndex: s2, pointsPos: e2, zRatio: this.zRatio, elParent: this.elPointsMain });
        else {
          r2.globals.series[i2].length > 1 && this.elPointsMain.node.classList.add("apexcharts-element-hidden");
          var n2 = this.markers.plotChartMarkers(e2, s2, a2 + 1);
          null !== n2 && this.elPointsMain.add(n2);
        }
        var l2 = o2.drawDataLabel(e2, s2, a2 + 1, null);
        null !== l2 && this.elDataLabelsWrap.add(l2);
      } }, { key: "_createPaths", value: function(t3) {
        var e2 = t3.series, i2 = t3.i, a2 = t3.realIndex, s2 = t3.j, r2 = t3.x, o2 = t3.y, n2 = t3.pX, l2 = t3.pY, h2 = t3.linePath, c2 = t3.areaPath, d2 = t3.linePaths, g2 = t3.areaPaths, u2 = t3.seriesIndex, p2 = this.w, f2 = new b(this.ctx), x2 = p2.config.stroke.curve, v2 = this.areaBottomY;
        if (Array.isArray(p2.config.stroke.curve) && (x2 = Array.isArray(u2) ? p2.config.stroke.curve[u2[i2]] : p2.config.stroke.curve[i2]), "smooth" === x2) {
          var m2 = 0.35 * (r2 - n2);
          p2.globals.hasNullValues ? (null !== e2[i2][s2] && (null !== e2[i2][s2 + 1] ? (h2 = f2.move(n2, l2) + f2.curve(n2 + m2, l2, r2 - m2, o2, r2 + 1, o2), c2 = f2.move(n2 + 1, l2) + f2.curve(n2 + m2, l2, r2 - m2, o2, r2 + 1, o2) + f2.line(r2, v2) + f2.line(n2, v2) + "z") : (h2 = f2.move(n2, l2), c2 = f2.move(n2, l2) + "z")), d2.push(h2), g2.push(c2)) : (h2 += f2.curve(n2 + m2, l2, r2 - m2, o2, r2, o2), c2 += f2.curve(n2 + m2, l2, r2 - m2, o2, r2, o2)), n2 = r2, l2 = o2, s2 === e2[i2].length - 2 && (c2 = c2 + f2.curve(n2, l2, r2, o2, r2, v2) + f2.move(r2, o2) + "z", p2.globals.hasNullValues || (d2.push(h2), g2.push(c2)));
        } else {
          if (null === e2[i2][s2 + 1]) {
            h2 += f2.move(r2, o2);
            var y2 = p2.globals.isXNumeric ? (p2.globals.seriesX[a2][s2] - p2.globals.minX) / this.xRatio : r2 - this.xDivision;
            c2 = c2 + f2.line(y2, v2) + f2.move(r2, o2) + "z";
          }
          null === e2[i2][s2] && (h2 += f2.move(r2, o2), c2 += f2.move(r2, v2)), "stepline" === x2 ? (h2 = h2 + f2.line(r2, null, "H") + f2.line(null, o2, "V"), c2 = c2 + f2.line(r2, null, "H") + f2.line(null, o2, "V")) : "straight" === x2 && (h2 += f2.line(r2, o2), c2 += f2.line(r2, o2)), s2 === e2[i2].length - 2 && (c2 = c2 + f2.line(r2, v2) + f2.move(r2, o2) + "z", d2.push(h2), g2.push(c2));
        }
        return { linePaths: d2, areaPaths: g2, pX: n2, pY: l2, linePath: h2, areaPath: c2 };
      } }, { key: "handleNullDataPoints", value: function(t3, e2, i2, a2, s2) {
        var r2 = this.w;
        if (null === t3[i2][a2] && r2.config.markers.showNullDataPoints || 1 === t3[i2].length) {
          var o2 = this.markers.plotChartMarkers(e2, s2, a2 + 1, this.strokeWidth - r2.config.markers.strokeWidth / 2, true);
          null !== o2 && this.elPointsMain.add(o2);
        }
      } }]), t2;
    }();
    window.TreemapSquared = {}, window.TreemapSquared.generate = /* @__PURE__ */ function() {
      function t2(e3, i3, a3, s3) {
        this.xoffset = e3, this.yoffset = i3, this.height = s3, this.width = a3, this.shortestEdge = function() {
          return Math.min(this.height, this.width);
        }, this.getCoordinates = function(t3) {
          var e4, i4 = [], a4 = this.xoffset, s4 = this.yoffset, o3 = r2(t3) / this.height, n2 = r2(t3) / this.width;
          if (this.width >= this.height)
            for (e4 = 0; e4 < t3.length; e4++)
              i4.push([a4, s4, a4 + o3, s4 + t3[e4] / o3]), s4 += t3[e4] / o3;
          else
            for (e4 = 0; e4 < t3.length; e4++)
              i4.push([a4, s4, a4 + t3[e4] / n2, s4 + n2]), a4 += t3[e4] / n2;
          return i4;
        }, this.cutArea = function(e4) {
          var i4;
          if (this.width >= this.height) {
            var a4 = e4 / this.height, s4 = this.width - a4;
            i4 = new t2(this.xoffset + a4, this.yoffset, s4, this.height);
          } else {
            var r3 = e4 / this.width, o3 = this.height - r3;
            i4 = new t2(this.xoffset, this.yoffset + r3, this.width, o3);
          }
          return i4;
        };
      }
      function e2(e3, a3, s3, o3, n2) {
        return o3 = void 0 === o3 ? 0 : o3, n2 = void 0 === n2 ? 0 : n2, function(t3) {
          var e4, i3, a4 = [];
          for (e4 = 0; e4 < t3.length; e4++)
            for (i3 = 0; i3 < t3[e4].length; i3++)
              a4.push(t3[e4][i3]);
          return a4;
        }(i2(function(t3, e4) {
          var i3, a4 = [], s4 = e4 / r2(t3);
          for (i3 = 0; i3 < t3.length; i3++)
            a4[i3] = t3[i3] * s4;
          return a4;
        }(e3, a3 * s3), [], new t2(o3, n2, a3, s3), []));
      }
      function i2(t3, e3, s3, o3) {
        var n2, l2, h2;
        if (0 !== t3.length)
          return n2 = s3.shortestEdge(), function(t4, e4, i3) {
            var s4;
            if (0 === t4.length)
              return true;
            (s4 = t4.slice()).push(e4);
            var r3 = a2(t4, i3), o4 = a2(s4, i3);
            return r3 >= o4;
          }(e3, l2 = t3[0], n2) ? (e3.push(l2), i2(t3.slice(1), e3, s3, o3)) : (h2 = s3.cutArea(r2(e3), o3), o3.push(s3.getCoordinates(e3)), i2(t3, [], h2, o3)), o3;
        o3.push(s3.getCoordinates(e3));
      }
      function a2(t3, e3) {
        var i3 = Math.min.apply(Math, t3), a3 = Math.max.apply(Math, t3), s3 = r2(t3);
        return Math.max(Math.pow(e3, 2) * a3 / Math.pow(s3, 2), Math.pow(s3, 2) / (Math.pow(e3, 2) * i3));
      }
      function s2(t3) {
        return t3 && t3.constructor === Array;
      }
      function r2(t3) {
        var e3, i3 = 0;
        for (e3 = 0; e3 < t3.length; e3++)
          i3 += t3[e3];
        return i3;
      }
      function o2(t3) {
        var e3, i3 = 0;
        if (s2(t3[0]))
          for (e3 = 0; e3 < t3.length; e3++)
            i3 += o2(t3[e3]);
        else
          i3 = r2(t3);
        return i3;
      }
      return function t3(i3, a3, r3, n2, l2) {
        n2 = void 0 === n2 ? 0 : n2, l2 = void 0 === l2 ? 0 : l2;
        var h2, c2, d2 = [], g2 = [];
        if (s2(i3[0])) {
          for (c2 = 0; c2 < i3.length; c2++)
            d2[c2] = o2(i3[c2]);
          for (h2 = e2(d2, a3, r3, n2, l2), c2 = 0; c2 < i3.length; c2++)
            g2.push(t3(i3[c2], h2[c2][2] - h2[c2][0], h2[c2][3] - h2[c2][1], h2[c2][0], h2[c2][1]));
        } else
          g2 = e2(i3, a3, r3, n2, l2);
        return g2;
      };
    }();
    var Tt;
    var Mt;
    var It = function() {
      function t2(e2, i2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.strokeWidth = this.w.config.stroke.width, this.helpers = new yt(e2), this.dynamicAnim = this.w.config.chart.animations.dynamicAnimation, this.labels = [];
      }
      return r(t2, [{ key: "draw", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = new b(this.ctx), s2 = new L(this.ctx), r2 = a2.group({ class: "apexcharts-treemap" });
        if (i2.globals.noData)
          return r2;
        var o2 = [];
        return t3.forEach(function(t4) {
          var e3 = t4.map(function(t5) {
            return Math.abs(t5);
          });
          o2.push(e3);
        }), this.negRange = this.helpers.checkColorRange(), i2.config.series.forEach(function(t4, i3) {
          t4.data.forEach(function(t5) {
            Array.isArray(e2.labels[i3]) || (e2.labels[i3] = []), e2.labels[i3].push(t5.x);
          });
        }), window.TreemapSquared.generate(o2, i2.globals.gridWidth, i2.globals.gridHeight).forEach(function(o3, n2) {
          var l2 = a2.group({ class: "apexcharts-series apexcharts-treemap-series", seriesName: p.escapeString(i2.globals.seriesNames[n2]), rel: n2 + 1, "data:realIndex": n2 });
          if (i2.config.chart.dropShadow.enabled) {
            var h2 = i2.config.chart.dropShadow;
            new x(e2.ctx).dropShadow(r2, h2, n2);
          }
          var c2 = a2.group({ class: "apexcharts-data-labels" });
          o3.forEach(function(r3, o4) {
            var h3 = r3[0], c3 = r3[1], d2 = r3[2], g2 = r3[3], u2 = a2.drawRect(h3, c3, d2 - h3, g2 - c3, 0, "#fff", 1, e2.strokeWidth, i2.config.plotOptions.treemap.useFillColorAsStroke ? f2 : i2.globals.stroke.colors[n2]);
            u2.attr({ cx: h3, cy: c3, index: n2, i: n2, j: o4, width: d2 - h3, height: g2 - c3 });
            var p2 = e2.helpers.getShadeColor(i2.config.chart.type, n2, o4, e2.negRange), f2 = p2.color;
            void 0 !== i2.config.series[n2].data[o4] && i2.config.series[n2].data[o4].fillColor && (f2 = i2.config.series[n2].data[o4].fillColor);
            var x2 = s2.fillPath({ color: f2, seriesNumber: n2, dataPointIndex: o4 });
            u2.node.classList.add("apexcharts-treemap-rect"), u2.attr({ fill: x2 }), e2.helpers.addListeners(u2);
            var b2 = { x: h3 + (d2 - h3) / 2, y: c3 + (g2 - c3) / 2, width: 0, height: 0 }, v2 = { x: h3, y: c3, width: d2 - h3, height: g2 - c3 };
            if (i2.config.chart.animations.enabled && !i2.globals.dataChanged) {
              var m2 = 1;
              i2.globals.resized || (m2 = i2.config.chart.animations.speed), e2.animateTreemap(u2, b2, v2, m2);
            }
            if (i2.globals.dataChanged) {
              var y2 = 1;
              e2.dynamicAnim.enabled && i2.globals.shouldAnimate && (y2 = e2.dynamicAnim.speed, i2.globals.previousPaths[n2] && i2.globals.previousPaths[n2][o4] && i2.globals.previousPaths[n2][o4].rect && (b2 = i2.globals.previousPaths[n2][o4].rect), e2.animateTreemap(u2, b2, v2, y2));
            }
            var w2 = e2.getFontSize(r3), k2 = i2.config.dataLabels.formatter(e2.labels[n2][o4], { value: i2.globals.series[n2][o4], seriesIndex: n2, dataPointIndex: o4, w: i2 }), A2 = e2.helpers.calculateDataLabels({ text: k2, x: (h3 + d2) / 2, y: (c3 + g2) / 2 + e2.strokeWidth / 2 + w2 / 3, i: n2, j: o4, colorProps: p2, fontSize: w2, series: t3 });
            i2.config.dataLabels.enabled && A2 && e2.rotateToFitLabel(A2, k2, h3, c3, d2, g2), l2.add(u2), null !== A2 && l2.add(A2);
          }), l2.add(c2), r2.add(l2);
        }), r2;
      } }, { key: "getFontSize", value: function(t3) {
        var e2 = this.w;
        var i2, a2, s2, r2, o2 = function t4(e3) {
          var i3, a3 = 0;
          if (Array.isArray(e3[0]))
            for (i3 = 0; i3 < e3.length; i3++)
              a3 += t4(e3[i3]);
          else
            for (i3 = 0; i3 < e3.length; i3++)
              a3 += e3[i3].length;
          return a3;
        }(this.labels) / function t4(e3) {
          var i3, a3 = 0;
          if (Array.isArray(e3[0]))
            for (i3 = 0; i3 < e3.length; i3++)
              a3 += t4(e3[i3]);
          else
            for (i3 = 0; i3 < e3.length; i3++)
              a3 += 1;
          return a3;
        }(this.labels);
        return i2 = t3[2] - t3[0], a2 = t3[3] - t3[1], s2 = i2 * a2, r2 = Math.pow(s2, 0.5), Math.min(r2 / o2, parseInt(e2.config.dataLabels.style.fontSize, 10));
      } }, { key: "rotateToFitLabel", value: function(t3, e2, i2, a2, s2, r2) {
        var o2 = new b(this.ctx), n2 = o2.getTextRects(e2);
        if (n2.width + 5 > s2 - i2 && n2.width <= r2 - a2) {
          var l2 = o2.rotateAroundCenter(t3.node);
          t3.node.setAttribute("transform", "rotate(-90 ".concat(l2.x, " ").concat(l2.y, ")"));
        }
      } }, { key: "animateTreemap", value: function(t3, e2, i2, a2) {
        var s2 = new f(this.ctx);
        s2.animateRect(t3, { x: e2.x, y: e2.y, width: e2.width, height: e2.height }, { x: i2.x, y: i2.y, width: i2.width, height: i2.height }, a2, function() {
          s2.animationCompleted(t3);
        });
      } }]), t2;
    }();
    var zt = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w, this.timeScaleArray = [], this.utc = this.w.config.xaxis.labels.datetimeUTC;
      }
      return r(t2, [{ key: "calculateTimeScaleTicks", value: function(t3, i2) {
        var a2 = this, s2 = this.w;
        if (s2.globals.allSeriesCollapsed)
          return s2.globals.labels = [], s2.globals.timescaleLabels = [], [];
        var r2 = new Y(this.ctx), o2 = (i2 - t3) / 864e5;
        this.determineInterval(o2), s2.globals.disableZoomIn = false, s2.globals.disableZoomOut = false, o2 < 11574074074074075e-20 ? s2.globals.disableZoomIn = true : o2 > 5e4 && (s2.globals.disableZoomOut = true);
        var n2 = r2.getTimeUnitsfromTimestamp(t3, i2, this.utc), l2 = s2.globals.gridWidth / o2, h2 = l2 / 24, c2 = h2 / 60, d2 = c2 / 60, g2 = Math.floor(24 * o2), u2 = Math.floor(1440 * o2), p2 = Math.floor(86400 * o2), f2 = Math.floor(o2), x2 = Math.floor(o2 / 30), b2 = Math.floor(o2 / 365), v2 = { minMillisecond: n2.minMillisecond, minSecond: n2.minSecond, minMinute: n2.minMinute, minHour: n2.minHour, minDate: n2.minDate, minMonth: n2.minMonth, minYear: n2.minYear }, m2 = { firstVal: v2, currentMillisecond: v2.minMillisecond, currentSecond: v2.minSecond, currentMinute: v2.minMinute, currentHour: v2.minHour, currentMonthDate: v2.minDate, currentDate: v2.minDate, currentMonth: v2.minMonth, currentYear: v2.minYear, daysWidthOnXAxis: l2, hoursWidthOnXAxis: h2, minutesWidthOnXAxis: c2, secondsWidthOnXAxis: d2, numberOfSeconds: p2, numberOfMinutes: u2, numberOfHours: g2, numberOfDays: f2, numberOfMonths: x2, numberOfYears: b2 };
        switch (this.tickInterval) {
          case "years":
            this.generateYearScale(m2);
            break;
          case "months":
          case "half_year":
            this.generateMonthScale(m2);
            break;
          case "months_days":
          case "months_fortnight":
          case "days":
          case "week_days":
            this.generateDayScale(m2);
            break;
          case "hours":
            this.generateHourScale(m2);
            break;
          case "minutes_fives":
          case "minutes":
            this.generateMinuteScale(m2);
            break;
          case "seconds_tens":
          case "seconds_fives":
          case "seconds":
            this.generateSecondScale(m2);
        }
        var y2 = this.timeScaleArray.map(function(t4) {
          var i3 = { position: t4.position, unit: t4.unit, year: t4.year, day: t4.day ? t4.day : 1, hour: t4.hour ? t4.hour : 0, month: t4.month + 1 };
          return "month" === t4.unit ? e(e({}, i3), {}, { day: 1, value: t4.value + 1 }) : "day" === t4.unit || "hour" === t4.unit ? e(e({}, i3), {}, { value: t4.value }) : "minute" === t4.unit ? e(e({}, i3), {}, { value: t4.value, minute: t4.value }) : "second" === t4.unit ? e(e({}, i3), {}, { value: t4.value, minute: t4.minute, second: t4.second }) : t4;
        });
        return y2.filter(function(t4) {
          var e2 = 1, i3 = Math.ceil(s2.globals.gridWidth / 120), r3 = t4.value;
          void 0 !== s2.config.xaxis.tickAmount && (i3 = s2.config.xaxis.tickAmount), y2.length > i3 && (e2 = Math.floor(y2.length / i3));
          var o3 = false, n3 = false;
          switch (a2.tickInterval) {
            case "years":
              "year" === t4.unit && (o3 = true);
              break;
            case "half_year":
              e2 = 7, "year" === t4.unit && (o3 = true);
              break;
            case "months":
              e2 = 1, "year" === t4.unit && (o3 = true);
              break;
            case "months_fortnight":
              e2 = 15, "year" !== t4.unit && "month" !== t4.unit || (o3 = true), 30 === r3 && (n3 = true);
              break;
            case "months_days":
              e2 = 10, "month" === t4.unit && (o3 = true), 30 === r3 && (n3 = true);
              break;
            case "week_days":
              e2 = 8, "month" === t4.unit && (o3 = true);
              break;
            case "days":
              e2 = 1, "month" === t4.unit && (o3 = true);
              break;
            case "hours":
              "day" === t4.unit && (o3 = true);
              break;
            case "minutes_fives":
              r3 % 5 != 0 && (n3 = true);
              break;
            case "seconds_tens":
              r3 % 10 != 0 && (n3 = true);
              break;
            case "seconds_fives":
              r3 % 5 != 0 && (n3 = true);
          }
          if ("hours" === a2.tickInterval || "minutes_fives" === a2.tickInterval || "seconds_tens" === a2.tickInterval || "seconds_fives" === a2.tickInterval) {
            if (!n3)
              return true;
          } else if ((r3 % e2 == 0 || o3) && !n3)
            return true;
        });
      } }, { key: "recalcDimensionsBasedOnFormat", value: function(t3, e2) {
        var i2 = this.w, a2 = this.formatDates(t3), s2 = this.removeOverlappingTS(a2);
        i2.globals.timescaleLabels = s2.slice(), new ot(this.ctx).plotCoords();
      } }, { key: "determineInterval", value: function(t3) {
        var e2 = 24 * t3, i2 = 60 * e2;
        switch (true) {
          case t3 / 365 > 5:
            this.tickInterval = "years";
            break;
          case t3 > 800:
            this.tickInterval = "half_year";
            break;
          case t3 > 180:
            this.tickInterval = "months";
            break;
          case t3 > 90:
            this.tickInterval = "months_fortnight";
            break;
          case t3 > 60:
            this.tickInterval = "months_days";
            break;
          case t3 > 30:
            this.tickInterval = "week_days";
            break;
          case t3 > 2:
            this.tickInterval = "days";
            break;
          case e2 > 2.4:
            this.tickInterval = "hours";
            break;
          case i2 > 15:
            this.tickInterval = "minutes_fives";
            break;
          case i2 > 5:
            this.tickInterval = "minutes";
            break;
          case i2 > 1:
            this.tickInterval = "seconds_tens";
            break;
          case 60 * i2 > 20:
            this.tickInterval = "seconds_fives";
            break;
          default:
            this.tickInterval = "seconds";
        }
      } }, { key: "generateYearScale", value: function(t3) {
        var e2 = t3.firstVal, i2 = t3.currentMonth, a2 = t3.currentYear, s2 = t3.daysWidthOnXAxis, r2 = t3.numberOfYears, o2 = e2.minYear, n2 = 0, l2 = new Y(this.ctx), h2 = "year";
        if (e2.minDate > 1 || e2.minMonth > 0) {
          var c2 = l2.determineRemainingDaysOfYear(e2.minYear, e2.minMonth, e2.minDate);
          n2 = (l2.determineDaysOfYear(e2.minYear) - c2 + 1) * s2, o2 = e2.minYear + 1, this.timeScaleArray.push({ position: n2, value: o2, unit: h2, year: o2, month: p.monthMod(i2 + 1) });
        } else
          1 === e2.minDate && 0 === e2.minMonth && this.timeScaleArray.push({ position: n2, value: o2, unit: h2, year: a2, month: p.monthMod(i2 + 1) });
        for (var d2 = o2, g2 = n2, u2 = 0; u2 < r2; u2++)
          d2++, g2 = l2.determineDaysOfYear(d2 - 1) * s2 + g2, this.timeScaleArray.push({ position: g2, value: d2, unit: h2, year: d2, month: 1 });
      } }, { key: "generateMonthScale", value: function(t3) {
        var e2 = t3.firstVal, i2 = t3.currentMonthDate, a2 = t3.currentMonth, s2 = t3.currentYear, r2 = t3.daysWidthOnXAxis, o2 = t3.numberOfMonths, n2 = a2, l2 = 0, h2 = new Y(this.ctx), c2 = "month", d2 = 0;
        if (e2.minDate > 1) {
          l2 = (h2.determineDaysOfMonths(a2 + 1, e2.minYear) - i2 + 1) * r2, n2 = p.monthMod(a2 + 1);
          var g2 = s2 + d2, u2 = p.monthMod(n2), f2 = n2;
          0 === n2 && (c2 = "year", f2 = g2, u2 = 1, g2 += d2 += 1), this.timeScaleArray.push({ position: l2, value: f2, unit: c2, year: g2, month: u2 });
        } else
          this.timeScaleArray.push({ position: l2, value: n2, unit: c2, year: s2, month: p.monthMod(a2) });
        for (var x2 = n2 + 1, b2 = l2, v2 = 0, m2 = 1; v2 < o2; v2++, m2++) {
          0 === (x2 = p.monthMod(x2)) ? (c2 = "year", d2 += 1) : c2 = "month";
          var y2 = this._getYear(s2, x2, d2);
          b2 = h2.determineDaysOfMonths(x2, y2) * r2 + b2;
          var w2 = 0 === x2 ? y2 : x2;
          this.timeScaleArray.push({ position: b2, value: w2, unit: c2, year: y2, month: 0 === x2 ? 1 : x2 }), x2++;
        }
      } }, { key: "generateDayScale", value: function(t3) {
        var e2 = t3.firstVal, i2 = t3.currentMonth, a2 = t3.currentYear, s2 = t3.hoursWidthOnXAxis, r2 = t3.numberOfDays, o2 = new Y(this.ctx), n2 = "day", l2 = e2.minDate + 1, h2 = l2, c2 = function(t4, e3, i3) {
          return t4 > o2.determineDaysOfMonths(e3 + 1, i3) ? (h2 = 1, n2 = "month", g2 = e3 += 1, e3) : e3;
        }, d2 = (24 - e2.minHour) * s2, g2 = l2, u2 = c2(h2, i2, a2);
        0 === e2.minHour && 1 === e2.minDate ? (d2 = 0, g2 = p.monthMod(e2.minMonth), n2 = "month", h2 = e2.minDate, r2++) : 1 !== e2.minDate && 0 === e2.minHour && 0 === e2.minMinute && (d2 = 0, l2 = e2.minDate, g2 = l2, u2 = c2(h2 = l2, i2, a2)), this.timeScaleArray.push({ position: d2, value: g2, unit: n2, year: this._getYear(a2, u2, 0), month: p.monthMod(u2), day: h2 });
        for (var f2 = d2, x2 = 0; x2 < r2; x2++) {
          n2 = "day", u2 = c2(h2 += 1, u2, this._getYear(a2, u2, 0));
          var b2 = this._getYear(a2, u2, 0);
          f2 = 24 * s2 + f2;
          var v2 = 1 === h2 ? p.monthMod(u2) : h2;
          this.timeScaleArray.push({ position: f2, value: v2, unit: n2, year: b2, month: p.monthMod(u2), day: v2 });
        }
      } }, { key: "generateHourScale", value: function(t3) {
        var e2 = t3.firstVal, i2 = t3.currentDate, a2 = t3.currentMonth, s2 = t3.currentYear, r2 = t3.minutesWidthOnXAxis, o2 = t3.numberOfHours, n2 = new Y(this.ctx), l2 = "hour", h2 = function(t4, e3) {
          return t4 > n2.determineDaysOfMonths(e3 + 1, s2) && (x2 = 1, e3 += 1), { month: e3, date: x2 };
        }, c2 = function(t4, e3) {
          return t4 > n2.determineDaysOfMonths(e3 + 1, s2) ? e3 += 1 : e3;
        }, d2 = 60 - (e2.minMinute + e2.minSecond / 60), g2 = d2 * r2, u2 = e2.minHour + 1, f2 = u2 + 1;
        60 === d2 && (g2 = 0, f2 = (u2 = e2.minHour) + 1);
        var x2 = i2, b2 = c2(x2, a2);
        this.timeScaleArray.push({ position: g2, value: u2, unit: l2, day: x2, hour: f2, year: s2, month: p.monthMod(b2) });
        for (var v2 = g2, m2 = 0; m2 < o2; m2++) {
          if (l2 = "hour", f2 >= 24)
            f2 = 0, l2 = "day", b2 = h2(x2 += 1, b2).month, b2 = c2(x2, b2);
          var y2 = this._getYear(s2, b2, 0);
          v2 = 0 === f2 && 0 === m2 ? d2 * r2 : 60 * r2 + v2;
          var w2 = 0 === f2 ? x2 : f2;
          this.timeScaleArray.push({ position: v2, value: w2, unit: l2, hour: f2, day: x2, year: y2, month: p.monthMod(b2) }), f2++;
        }
      } }, { key: "generateMinuteScale", value: function(t3) {
        for (var e2 = t3.currentMillisecond, i2 = t3.currentSecond, a2 = t3.currentMinute, s2 = t3.currentHour, r2 = t3.currentDate, o2 = t3.currentMonth, n2 = t3.currentYear, l2 = t3.minutesWidthOnXAxis, h2 = t3.secondsWidthOnXAxis, c2 = t3.numberOfMinutes, d2 = a2 + 1, g2 = r2, u2 = o2, f2 = n2, x2 = s2, b2 = (60 - i2 - e2 / 1e3) * h2, v2 = 0; v2 < c2; v2++)
          d2 >= 60 && (d2 = 0, 24 === (x2 += 1) && (x2 = 0)), this.timeScaleArray.push({ position: b2, value: d2, unit: "minute", hour: x2, minute: d2, day: g2, year: this._getYear(f2, u2, 0), month: p.monthMod(u2) }), b2 += l2, d2++;
      } }, { key: "generateSecondScale", value: function(t3) {
        for (var e2 = t3.currentMillisecond, i2 = t3.currentSecond, a2 = t3.currentMinute, s2 = t3.currentHour, r2 = t3.currentDate, o2 = t3.currentMonth, n2 = t3.currentYear, l2 = t3.secondsWidthOnXAxis, h2 = t3.numberOfSeconds, c2 = i2 + 1, d2 = a2, g2 = r2, u2 = o2, f2 = n2, x2 = s2, b2 = (1e3 - e2) / 1e3 * l2, v2 = 0; v2 < h2; v2++)
          c2 >= 60 && (c2 = 0, ++d2 >= 60 && (d2 = 0, 24 === ++x2 && (x2 = 0))), this.timeScaleArray.push({ position: b2, value: c2, unit: "second", hour: x2, minute: d2, second: c2, day: g2, year: this._getYear(f2, u2, 0), month: p.monthMod(u2) }), b2 += l2, c2++;
      } }, { key: "createRawDateString", value: function(t3, e2) {
        var i2 = t3.year;
        return 0 === t3.month && (t3.month = 1), i2 += "-" + ("0" + t3.month.toString()).slice(-2), "day" === t3.unit ? i2 += "day" === t3.unit ? "-" + ("0" + e2).slice(-2) : "-01" : i2 += "-" + ("0" + (t3.day ? t3.day : "1")).slice(-2), "hour" === t3.unit ? i2 += "hour" === t3.unit ? "T" + ("0" + e2).slice(-2) : "T00" : i2 += "T" + ("0" + (t3.hour ? t3.hour : "0")).slice(-2), "minute" === t3.unit ? i2 += ":" + ("0" + e2).slice(-2) : i2 += ":" + (t3.minute ? ("0" + t3.minute).slice(-2) : "00"), "second" === t3.unit ? i2 += ":" + ("0" + e2).slice(-2) : i2 += ":00", this.utc && (i2 += ".000Z"), i2;
      } }, { key: "formatDates", value: function(t3) {
        var e2 = this, i2 = this.w;
        return t3.map(function(t4) {
          var a2 = t4.value.toString(), s2 = new Y(e2.ctx), r2 = e2.createRawDateString(t4, a2), o2 = s2.getDate(s2.parseDate(r2));
          if (e2.utc || (o2 = s2.getDate(s2.parseDateWithTimezone(r2))), void 0 === i2.config.xaxis.labels.format) {
            var n2 = "dd MMM", l2 = i2.config.xaxis.labels.datetimeFormatter;
            "year" === t4.unit && (n2 = l2.year), "month" === t4.unit && (n2 = l2.month), "day" === t4.unit && (n2 = l2.day), "hour" === t4.unit && (n2 = l2.hour), "minute" === t4.unit && (n2 = l2.minute), "second" === t4.unit && (n2 = l2.second), a2 = s2.formatDate(o2, n2);
          } else
            a2 = s2.formatDate(o2, i2.config.xaxis.labels.format);
          return { dateString: r2, position: t4.position, value: a2, unit: t4.unit, year: t4.year, month: t4.month };
        });
      } }, { key: "removeOverlappingTS", value: function(t3) {
        var e2, i2 = this, a2 = new b(this.ctx), s2 = false;
        t3.length > 0 && t3[0].value && t3.every(function(e3) {
          return e3.value.length === t3[0].value.length;
        }) && (s2 = true, e2 = a2.getTextRects(t3[0].value).width);
        var r2 = 0, o2 = t3.map(function(o3, n2) {
          if (n2 > 0 && i2.w.config.xaxis.labels.hideOverlappingLabels) {
            var l2 = s2 ? e2 : a2.getTextRects(t3[r2].value).width, h2 = t3[r2].position;
            return o3.position > h2 + l2 + 10 ? (r2 = n2, o3) : null;
          }
          return o3;
        });
        return o2 = o2.filter(function(t4) {
          return null !== t4;
        });
      } }, { key: "_getYear", value: function(t3, e2, i2) {
        return t3 + Math.floor(e2 / 12) + i2;
      } }]), t2;
    }();
    var Xt = function() {
      function t2(e2, i2) {
        a(this, t2), this.ctx = i2, this.w = i2.w, this.el = e2;
      }
      return r(t2, [{ key: "setupElements", value: function() {
        var t3 = this.w.globals, e2 = this.w.config, i2 = e2.chart.type;
        t3.axisCharts = ["line", "area", "bar", "rangeBar", "candlestick", "boxPlot", "scatter", "bubble", "radar", "heatmap", "treemap"].indexOf(i2) > -1, t3.xyCharts = ["line", "area", "bar", "rangeBar", "candlestick", "boxPlot", "scatter", "bubble"].indexOf(i2) > -1, t3.isBarHorizontal = ("bar" === e2.chart.type || "rangeBar" === e2.chart.type) && e2.plotOptions.bar.horizontal, t3.chartClass = ".apexcharts" + t3.chartID, t3.dom.baseEl = this.el, t3.dom.elWrap = document.createElement("div"), b.setAttrs(t3.dom.elWrap, { id: t3.chartClass.substring(1), class: "apexcharts-canvas " + t3.chartClass.substring(1) }), this.el.appendChild(t3.dom.elWrap), t3.dom.Paper = new window.SVG.Doc(t3.dom.elWrap), t3.dom.Paper.attr({ class: "apexcharts-svg", "xmlns:data": "ApexChartsNS", transform: "translate(".concat(e2.chart.offsetX, ", ").concat(e2.chart.offsetY, ")") }), t3.dom.Paper.node.style.background = e2.chart.background, this.setSVGDimensions(), t3.dom.elGraphical = t3.dom.Paper.group().attr({ class: "apexcharts-inner apexcharts-graphical" }), t3.dom.elAnnotations = t3.dom.Paper.group().attr({ class: "apexcharts-annotations" }), t3.dom.elDefs = t3.dom.Paper.defs(), t3.dom.elLegendWrap = document.createElement("div"), t3.dom.elLegendWrap.classList.add("apexcharts-legend"), t3.dom.elWrap.appendChild(t3.dom.elLegendWrap), t3.dom.Paper.add(t3.dom.elGraphical), t3.dom.elGraphical.add(t3.dom.elDefs);
      } }, { key: "plotChartType", value: function(t3, e2) {
        var i2 = this.w, a2 = i2.config, s2 = i2.globals, r2 = { series: [], i: [] }, o2 = { series: [], i: [] }, n2 = { series: [], i: [] }, l2 = { series: [], i: [] }, h2 = { series: [], i: [] }, c2 = { series: [], i: [] }, d2 = { series: [], i: [] };
        s2.series.map(function(e3, g3) {
          var u3 = 0;
          void 0 !== t3[g3].type ? ("column" === t3[g3].type || "bar" === t3[g3].type ? (s2.series.length > 1 && a2.plotOptions.bar.horizontal && console.warn("Horizontal bars are not supported in a mixed/combo chart. Please turn off `plotOptions.bar.horizontal`"), h2.series.push(e3), h2.i.push(g3), u3++, i2.globals.columnSeries = h2.series) : "area" === t3[g3].type ? (o2.series.push(e3), o2.i.push(g3), u3++) : "line" === t3[g3].type ? (r2.series.push(e3), r2.i.push(g3), u3++) : "scatter" === t3[g3].type ? (n2.series.push(e3), n2.i.push(g3)) : "bubble" === t3[g3].type ? (l2.series.push(e3), l2.i.push(g3), u3++) : "candlestick" === t3[g3].type ? (c2.series.push(e3), c2.i.push(g3), u3++) : "boxPlot" === t3[g3].type ? (d2.series.push(e3), d2.i.push(g3), u3++) : console.warn("You have specified an unrecognized chart type. Available types for this property are line/area/column/bar/scatter/bubble"), u3 > 1 && (s2.comboCharts = true)) : (r2.series.push(e3), r2.i.push(g3));
        });
        var g2 = new Pt(this.ctx, e2), u2 = new mt(this.ctx, e2);
        this.ctx.pie = new At(this.ctx);
        var p2 = new Ct(this.ctx);
        this.ctx.rangeBar = new F(this.ctx, e2);
        var f2 = new St(this.ctx), x2 = [];
        if (s2.comboCharts) {
          if (o2.series.length > 0 && x2.push(g2.draw(o2.series, "area", o2.i)), h2.series.length > 0)
            if (i2.config.chart.stacked) {
              var b2 = new vt(this.ctx, e2);
              x2.push(b2.draw(h2.series, h2.i));
            } else
              this.ctx.bar = new E(this.ctx, e2), x2.push(this.ctx.bar.draw(h2.series, h2.i));
          if (r2.series.length > 0 && x2.push(g2.draw(r2.series, "line", r2.i)), c2.series.length > 0 && x2.push(u2.draw(c2.series, c2.i)), d2.series.length > 0 && x2.push(u2.draw(d2.series, d2.i)), n2.series.length > 0) {
            var v2 = new Pt(this.ctx, e2, true);
            x2.push(v2.draw(n2.series, "scatter", n2.i));
          }
          if (l2.series.length > 0) {
            var m2 = new Pt(this.ctx, e2, true);
            x2.push(m2.draw(l2.series, "bubble", l2.i));
          }
        } else
          switch (a2.chart.type) {
            case "line":
              x2 = g2.draw(s2.series, "line");
              break;
            case "area":
              x2 = g2.draw(s2.series, "area");
              break;
            case "bar":
              if (a2.chart.stacked)
                x2 = new vt(this.ctx, e2).draw(s2.series);
              else
                this.ctx.bar = new E(this.ctx, e2), x2 = this.ctx.bar.draw(s2.series);
              break;
            case "candlestick":
              x2 = new mt(this.ctx, e2).draw(s2.series);
              break;
            case "boxPlot":
              x2 = new mt(this.ctx, e2).draw(s2.series);
              break;
            case "rangeBar":
              x2 = this.ctx.rangeBar.draw(s2.series);
              break;
            case "heatmap":
              x2 = new wt(this.ctx, e2).draw(s2.series);
              break;
            case "treemap":
              x2 = new It(this.ctx, e2).draw(s2.series);
              break;
            case "pie":
            case "donut":
            case "polarArea":
              x2 = this.ctx.pie.draw(s2.series);
              break;
            case "radialBar":
              x2 = p2.draw(s2.series);
              break;
            case "radar":
              x2 = f2.draw(s2.series);
              break;
            default:
              x2 = g2.draw(s2.series);
          }
        return x2;
      } }, { key: "setSVGDimensions", value: function() {
        var t3 = this.w.globals, e2 = this.w.config;
        t3.svgWidth = e2.chart.width, t3.svgHeight = e2.chart.height;
        var i2 = p.getDimensions(this.el), a2 = e2.chart.width.toString().split(/[0-9]+/g).pop();
        "%" === a2 ? p.isNumber(i2[0]) && (0 === i2[0].width && (i2 = p.getDimensions(this.el.parentNode)), t3.svgWidth = i2[0] * parseInt(e2.chart.width, 10) / 100) : "px" !== a2 && "" !== a2 || (t3.svgWidth = parseInt(e2.chart.width, 10));
        var s2 = e2.chart.height.toString().split(/[0-9]+/g).pop();
        if ("auto" !== t3.svgHeight && "" !== t3.svgHeight)
          if ("%" === s2) {
            var r2 = p.getDimensions(this.el.parentNode);
            t3.svgHeight = r2[1] * parseInt(e2.chart.height, 10) / 100;
          } else
            t3.svgHeight = parseInt(e2.chart.height, 10);
        else
          t3.axisCharts ? t3.svgHeight = t3.svgWidth / 1.61 : t3.svgHeight = t3.svgWidth / 1.2;
        if (t3.svgWidth < 0 && (t3.svgWidth = 0), t3.svgHeight < 0 && (t3.svgHeight = 0), b.setAttrs(t3.dom.Paper.node, { width: t3.svgWidth, height: t3.svgHeight }), "%" !== s2) {
          var o2 = e2.chart.sparkline.enabled ? 0 : t3.axisCharts ? e2.chart.parentHeightOffset : 0;
          t3.dom.Paper.node.parentNode.parentNode.style.minHeight = t3.svgHeight + o2 + "px";
        }
        t3.dom.elWrap.style.width = t3.svgWidth + "px", t3.dom.elWrap.style.height = t3.svgHeight + "px";
      } }, { key: "shiftGraphPosition", value: function() {
        var t3 = this.w.globals, e2 = t3.translateY, i2 = { transform: "translate(" + t3.translateX + ", " + e2 + ")" };
        b.setAttrs(t3.dom.elGraphical.node, i2);
      } }, { key: "resizeNonAxisCharts", value: function() {
        var t3 = this.w, e2 = t3.globals, i2 = 0, a2 = t3.config.chart.sparkline.enabled ? 1 : 15;
        a2 += t3.config.grid.padding.bottom, "top" !== t3.config.legend.position && "bottom" !== t3.config.legend.position || !t3.config.legend.show || t3.config.legend.floating || (i2 = new lt(this.ctx).legendHelpers.getLegendBBox().clwh + 10);
        var s2 = t3.globals.dom.baseEl.querySelector(".apexcharts-radialbar, .apexcharts-pie"), r2 = 2.05 * t3.globals.radialSize;
        if (s2 && !t3.config.chart.sparkline.enabled) {
          var o2 = p.getBoundingClientRect(s2);
          r2 = o2.bottom;
          var n2 = o2.bottom - o2.top;
          r2 = Math.max(2.05 * t3.globals.radialSize, n2);
        }
        var l2 = r2 + e2.translateY + i2 + a2;
        e2.dom.elLegendForeign && e2.dom.elLegendForeign.setAttribute("height", l2), e2.dom.elWrap.style.height = l2 + "px", b.setAttrs(e2.dom.Paper.node, { height: l2 }), e2.dom.Paper.node.parentNode.parentNode.style.minHeight = l2 + "px";
      } }, { key: "coreCalculations", value: function() {
        new U(this.ctx).init();
      } }, { key: "resetGlobals", value: function() {
        var t3 = this, e2 = function() {
          return t3.w.config.series.map(function(t4) {
            return [];
          });
        }, i2 = new D(), a2 = this.w.globals;
        i2.initGlobalVars(a2), a2.seriesXvalues = e2(), a2.seriesYvalues = e2();
      } }, { key: "isMultipleY", value: function() {
        if (this.w.config.yaxis.constructor === Array && this.w.config.yaxis.length > 1)
          return this.w.globals.isMultipleYAxis = true, true;
      } }, { key: "xySettings", value: function() {
        var t3 = null, e2 = this.w;
        if (e2.globals.axisCharts) {
          if ("back" === e2.config.xaxis.crosshairs.position)
            new Q(this.ctx).drawXCrosshairs();
          if ("back" === e2.config.yaxis[0].crosshairs.position)
            new Q(this.ctx).drawYCrosshairs();
          if ("datetime" === e2.config.xaxis.type && void 0 === e2.config.xaxis.labels.formatter) {
            this.ctx.timeScale = new zt(this.ctx);
            var i2 = [];
            isFinite(e2.globals.minX) && isFinite(e2.globals.maxX) && !e2.globals.isBarHorizontal ? i2 = this.ctx.timeScale.calculateTimeScaleTicks(e2.globals.minX, e2.globals.maxX) : e2.globals.isBarHorizontal && (i2 = this.ctx.timeScale.calculateTimeScaleTicks(e2.globals.minY, e2.globals.maxY)), this.ctx.timeScale.recalcDimensionsBasedOnFormat(i2);
          }
          t3 = new y(this.ctx).getCalculatedRatios();
        }
        return t3;
      } }, { key: "updateSourceChart", value: function(t3) {
        this.ctx.w.globals.selection = void 0, this.ctx.updateHelpers._updateOptions({ chart: { selection: { xaxis: { min: t3.w.globals.minX, max: t3.w.globals.maxX } } } }, false, false);
      } }, { key: "setupBrushHandler", value: function() {
        var t3 = this, i2 = this.w;
        if (i2.config.chart.brush.enabled && "function" != typeof i2.config.chart.events.selection) {
          var a2 = i2.config.chart.brush.targets || [i2.config.chart.brush.target];
          a2.forEach(function(e2) {
            var i3 = ApexCharts.getChartByID(e2);
            i3.w.globals.brushSource = t3.ctx, "function" != typeof i3.w.config.chart.events.zoomed && (i3.w.config.chart.events.zoomed = function() {
              t3.updateSourceChart(i3);
            }), "function" != typeof i3.w.config.chart.events.scrolled && (i3.w.config.chart.events.scrolled = function() {
              t3.updateSourceChart(i3);
            });
          }), i2.config.chart.events.selection = function(t4, s2) {
            a2.forEach(function(t5) {
              var a3 = ApexCharts.getChartByID(t5), r2 = p.clone(i2.config.yaxis);
              if (i2.config.chart.brush.autoScaleYaxis && 1 === a3.w.globals.series.length) {
                var o2 = new j(a3);
                r2 = o2.autoScaleY(a3, r2, s2);
              }
              var n2 = a3.w.config.yaxis.reduce(function(t6, i3, s3) {
                return [].concat(g(t6), [e(e({}, a3.w.config.yaxis[s3]), {}, { min: r2[0].min, max: r2[0].max })]);
              }, []);
              a3.ctx.updateHelpers._updateOptions({ xaxis: { min: s2.xaxis.min, max: s2.xaxis.max }, yaxis: n2 }, false, false, false, false);
            });
          };
        }
      } }]), t2;
    }();
    var Et = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "_updateOptions", value: function(t3) {
        var e2 = this, a2 = arguments.length > 1 && void 0 !== arguments[1] && arguments[1], s2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2], r2 = !(arguments.length > 3 && void 0 !== arguments[3]) || arguments[3], o2 = arguments.length > 4 && void 0 !== arguments[4] && arguments[4], n2 = [this.ctx];
        r2 && (n2 = this.ctx.getSyncedCharts()), this.ctx.w.globals.isExecCalled && (n2 = [this.ctx], this.ctx.w.globals.isExecCalled = false), n2.forEach(function(r3) {
          var n3 = r3.w;
          return n3.globals.shouldAnimate = s2, a2 || (n3.globals.resized = true, n3.globals.dataChanged = true, s2 && r3.series.getPreviousPaths()), t3 && "object" === i(t3) && (r3.config = new H(t3), t3 = y.extendArrayProps(r3.config, t3, n3), r3.w.globals.chartID !== e2.ctx.w.globals.chartID && delete t3.series, n3.config = p.extend(n3.config, t3), o2 && (n3.globals.lastXAxis = t3.xaxis ? p.clone(t3.xaxis) : [], n3.globals.lastYAxis = t3.yaxis ? p.clone(t3.yaxis) : [], n3.globals.initialConfig = p.extend({}, n3.config), n3.globals.initialSeries = p.clone(n3.config.series))), r3.update(t3);
        });
      } }, { key: "_updateSeries", value: function(t3, e2) {
        var i2, a2 = this, s2 = arguments.length > 2 && void 0 !== arguments[2] && arguments[2], r2 = this.w;
        return r2.globals.shouldAnimate = e2, r2.globals.dataChanged = true, e2 && this.ctx.series.getPreviousPaths(), r2.globals.axisCharts ? (0 === (i2 = t3.map(function(t4, e3) {
          return a2._extendSeries(t4, e3);
        })).length && (i2 = [{ data: [] }]), r2.config.series = i2) : r2.config.series = t3.slice(), s2 && (r2.globals.initialSeries = p.clone(r2.config.series)), this.ctx.update();
      } }, { key: "_extendSeries", value: function(t3, i2) {
        var a2 = this.w, s2 = a2.config.series[i2];
        return e(e({}, a2.config.series[i2]), {}, { name: t3.name ? t3.name : s2 && s2.name, color: t3.color ? t3.color : s2 && s2.color, type: t3.type ? t3.type : s2 && s2.type, data: t3.data ? t3.data : s2 && s2.data });
      } }, { key: "toggleDataPointSelection", value: function(t3, e2) {
        var i2 = this.w, a2 = null, s2 = ".apexcharts-series[data\\:realIndex='".concat(t3, "']");
        return i2.globals.axisCharts ? a2 = i2.globals.dom.Paper.select("".concat(s2, " path[j='").concat(e2, "'], ").concat(s2, " circle[j='").concat(e2, "'], ").concat(s2, " rect[j='").concat(e2, "']")).members[0] : void 0 === e2 && (a2 = i2.globals.dom.Paper.select("".concat(s2, " path[j='").concat(t3, "']")).members[0], "pie" !== i2.config.chart.type && "polarArea" !== i2.config.chart.type && "donut" !== i2.config.chart.type || this.ctx.pie.pieClicked(t3)), a2 ? (new b(this.ctx).pathMouseDown(a2, null), a2.node ? a2.node : null) : (console.warn("toggleDataPointSelection: Element not found"), null);
      } }, { key: "forceXAxisUpdate", value: function(t3) {
        var e2 = this.w;
        if (["min", "max"].forEach(function(i3) {
          void 0 !== t3.xaxis[i3] && (e2.config.xaxis[i3] = t3.xaxis[i3], e2.globals.lastXAxis[i3] = t3.xaxis[i3]);
        }), t3.xaxis.categories && t3.xaxis.categories.length && (e2.config.xaxis.categories = t3.xaxis.categories), e2.config.xaxis.convertedCatToNumeric) {
          var i2 = new R(t3);
          t3 = i2.convertCatToNumericXaxis(t3, this.ctx);
        }
        return t3;
      } }, { key: "forceYAxisUpdate", value: function(t3) {
        var e2 = this.w;
        return e2.config.chart.stacked && "100%" === e2.config.chart.stackType && (Array.isArray(t3.yaxis) ? t3.yaxis.forEach(function(e3, i2) {
          t3.yaxis[i2].min = 0, t3.yaxis[i2].max = 100;
        }) : (t3.yaxis.min = 0, t3.yaxis.max = 100)), t3;
      } }, { key: "revertDefaultAxisMinMax", value: function(t3) {
        var e2 = this, i2 = this.w, a2 = i2.globals.lastXAxis, s2 = i2.globals.lastYAxis;
        t3 && t3.xaxis && (a2 = t3.xaxis), t3 && t3.yaxis && (s2 = t3.yaxis), i2.config.xaxis.min = a2.min, i2.config.xaxis.max = a2.max;
        var r2 = function(t4) {
          void 0 !== s2[t4] && (i2.config.yaxis[t4].min = s2[t4].min, i2.config.yaxis[t4].max = s2[t4].max);
        };
        i2.config.yaxis.map(function(t4, a3) {
          i2.globals.zoomed || void 0 !== s2[a3] ? r2(a3) : void 0 !== e2.ctx.opts.yaxis[a3] && (t4.min = e2.ctx.opts.yaxis[a3].min, t4.max = e2.ctx.opts.yaxis[a3].max);
        });
      } }]), t2;
    }();
    Tt = "undefined" != typeof window ? window : void 0, Mt = function(t2, e2) {
      var a2 = (void 0 !== this ? this : t2).SVG = function(t3) {
        if (a2.supported)
          return t3 = new a2.Doc(t3), a2.parser.draw || a2.prepare(), t3;
      };
      if (a2.ns = "http://www.w3.org/2000/svg", a2.xmlns = "http://www.w3.org/2000/xmlns/", a2.xlink = "http://www.w3.org/1999/xlink", a2.svgjs = "http://svgjs.dev", a2.supported = true, !a2.supported)
        return false;
      a2.did = 1e3, a2.eid = function(t3) {
        return "Svgjs" + d2(t3) + a2.did++;
      }, a2.create = function(t3) {
        var i2 = e2.createElementNS(this.ns, t3);
        return i2.setAttribute("id", this.eid(t3)), i2;
      }, a2.extend = function() {
        var t3, e3;
        e3 = (t3 = [].slice.call(arguments)).pop();
        for (var i2 = t3.length - 1; i2 >= 0; i2--)
          if (t3[i2])
            for (var s3 in e3)
              t3[i2].prototype[s3] = e3[s3];
        a2.Set && a2.Set.inherit && a2.Set.inherit();
      }, a2.invent = function(t3) {
        var e3 = "function" == typeof t3.create ? t3.create : function() {
          this.constructor.call(this, a2.create(t3.create));
        };
        return t3.inherit && (e3.prototype = new t3.inherit()), t3.extend && a2.extend(e3, t3.extend), t3.construct && a2.extend(t3.parent || a2.Container, t3.construct), e3;
      }, a2.adopt = function(e3) {
        return e3 ? e3.instance ? e3.instance : ((i2 = "svg" == e3.nodeName ? e3.parentNode instanceof t2.SVGElement ? new a2.Nested() : new a2.Doc() : "linearGradient" == e3.nodeName ? new a2.Gradient("linear") : "radialGradient" == e3.nodeName ? new a2.Gradient("radial") : a2[d2(e3.nodeName)] ? new a2[d2(e3.nodeName)]() : new a2.Element(e3)).type = e3.nodeName, i2.node = e3, e3.instance = i2, i2 instanceof a2.Doc && i2.namespace().defs(), i2.setData(JSON.parse(e3.getAttribute("svgjs:data")) || {}), i2) : null;
        var i2;
      }, a2.prepare = function() {
        var t3 = e2.getElementsByTagName("body")[0], i2 = (t3 ? new a2.Doc(t3) : a2.adopt(e2.documentElement).nested()).size(2, 0);
        a2.parser = { body: t3 || e2.documentElement, draw: i2.style("opacity:0;position:absolute;left:-100%;top:-100%;overflow:hidden").node, poly: i2.polyline().node, path: i2.path().node, native: a2.create("svg") };
      }, a2.parser = { native: a2.create("svg") }, e2.addEventListener("DOMContentLoaded", function() {
        a2.parser.draw || a2.prepare();
      }, false), a2.regex = { numberAndUnit: /^([+-]?(\d+(\.\d*)?|\.\d+)(e[+-]?\d+)?)([a-z%]*)$/i, hex: /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i, rgb: /rgb\((\d+),(\d+),(\d+)\)/, reference: /#([a-z0-9\-_]+)/i, transforms: /\)\s*,?\s*/, whitespace: /\s/g, isHex: /^#[a-f0-9]{3,6}$/i, isRgb: /^rgb\(/, isCss: /[^:]+:[^;]+;?/, isBlank: /^(\s+)?$/, isNumber: /^[+-]?(\d+(\.\d*)?|\.\d+)(e[+-]?\d+)?$/i, isPercent: /^-?[\d\.]+%$/, isImage: /\.(jpg|jpeg|png|gif|svg)(\?[^=]+.*)?/i, delimiter: /[\s,]+/, hyphen: /([^e])\-/gi, pathLetters: /[MLHVCSQTAZ]/gi, isPathLetter: /[MLHVCSQTAZ]/i, numbersWithDots: /((\d?\.\d+(?:e[+-]?\d+)?)((?:\.\d+(?:e[+-]?\d+)?)+))+/gi, dots: /\./g }, a2.utils = { map: function(t3, e3) {
        for (var i2 = t3.length, a3 = [], s3 = 0; s3 < i2; s3++)
          a3.push(e3(t3[s3]));
        return a3;
      }, filter: function(t3, e3) {
        for (var i2 = t3.length, a3 = [], s3 = 0; s3 < i2; s3++)
          e3(t3[s3]) && a3.push(t3[s3]);
        return a3;
      }, filterSVGElements: function(e3) {
        return this.filter(e3, function(e4) {
          return e4 instanceof t2.SVGElement;
        });
      } }, a2.defaults = { attrs: { "fill-opacity": 1, "stroke-opacity": 1, "stroke-width": 0, "stroke-linejoin": "miter", "stroke-linecap": "butt", fill: "#000000", stroke: "#000000", opacity: 1, x: 0, y: 0, cx: 0, cy: 0, width: 0, height: 0, r: 0, rx: 0, ry: 0, offset: 0, "stop-opacity": 1, "stop-color": "#000000", "font-size": 16, "font-family": "Helvetica, Arial, sans-serif", "text-anchor": "start" } }, a2.Color = function(t3) {
        var e3, s3;
        this.r = 0, this.g = 0, this.b = 0, t3 && ("string" == typeof t3 ? a2.regex.isRgb.test(t3) ? (e3 = a2.regex.rgb.exec(t3.replace(a2.regex.whitespace, "")), this.r = parseInt(e3[1]), this.g = parseInt(e3[2]), this.b = parseInt(e3[3])) : a2.regex.isHex.test(t3) && (e3 = a2.regex.hex.exec(4 == (s3 = t3).length ? ["#", s3.substring(1, 2), s3.substring(1, 2), s3.substring(2, 3), s3.substring(2, 3), s3.substring(3, 4), s3.substring(3, 4)].join("") : s3), this.r = parseInt(e3[1], 16), this.g = parseInt(e3[2], 16), this.b = parseInt(e3[3], 16)) : "object" === i(t3) && (this.r = t3.r, this.g = t3.g, this.b = t3.b));
      }, a2.extend(a2.Color, { toString: function() {
        return this.toHex();
      }, toHex: function() {
        return "#" + g2(this.r) + g2(this.g) + g2(this.b);
      }, toRgb: function() {
        return "rgb(" + [this.r, this.g, this.b].join() + ")";
      }, brightness: function() {
        return this.r / 255 * 0.3 + this.g / 255 * 0.59 + this.b / 255 * 0.11;
      }, morph: function(t3) {
        return this.destination = new a2.Color(t3), this;
      }, at: function(t3) {
        return this.destination ? (t3 = t3 < 0 ? 0 : t3 > 1 ? 1 : t3, new a2.Color({ r: ~~(this.r + (this.destination.r - this.r) * t3), g: ~~(this.g + (this.destination.g - this.g) * t3), b: ~~(this.b + (this.destination.b - this.b) * t3) })) : this;
      } }), a2.Color.test = function(t3) {
        return t3 += "", a2.regex.isHex.test(t3) || a2.regex.isRgb.test(t3);
      }, a2.Color.isRgb = function(t3) {
        return t3 && "number" == typeof t3.r && "number" == typeof t3.g && "number" == typeof t3.b;
      }, a2.Color.isColor = function(t3) {
        return a2.Color.isRgb(t3) || a2.Color.test(t3);
      }, a2.Array = function(t3, e3) {
        0 == (t3 = (t3 || []).valueOf()).length && e3 && (t3 = e3.valueOf()), this.value = this.parse(t3);
      }, a2.extend(a2.Array, { toString: function() {
        return this.value.join(" ");
      }, valueOf: function() {
        return this.value;
      }, parse: function(t3) {
        return t3 = t3.valueOf(), Array.isArray(t3) ? t3 : this.split(t3);
      } }), a2.PointArray = function(t3, e3) {
        a2.Array.call(this, t3, e3 || [[0, 0]]);
      }, a2.PointArray.prototype = new a2.Array(), a2.PointArray.prototype.constructor = a2.PointArray;
      for (var s2 = { M: function(t3, e3, i2) {
        return e3.x = i2.x = t3[0], e3.y = i2.y = t3[1], ["M", e3.x, e3.y];
      }, L: function(t3, e3) {
        return e3.x = t3[0], e3.y = t3[1], ["L", t3[0], t3[1]];
      }, H: function(t3, e3) {
        return e3.x = t3[0], ["H", t3[0]];
      }, V: function(t3, e3) {
        return e3.y = t3[0], ["V", t3[0]];
      }, C: function(t3, e3) {
        return e3.x = t3[4], e3.y = t3[5], ["C", t3[0], t3[1], t3[2], t3[3], t3[4], t3[5]];
      }, Q: function(t3, e3) {
        return e3.x = t3[2], e3.y = t3[3], ["Q", t3[0], t3[1], t3[2], t3[3]];
      }, Z: function(t3, e3, i2) {
        return e3.x = i2.x, e3.y = i2.y, ["Z"];
      } }, r2 = "mlhvqtcsaz".split(""), o2 = 0, n2 = r2.length; o2 < n2; ++o2)
        s2[r2[o2]] = /* @__PURE__ */ function(t3) {
          return function(e3, i2, a3) {
            if ("H" == t3)
              e3[0] = e3[0] + i2.x;
            else if ("V" == t3)
              e3[0] = e3[0] + i2.y;
            else if ("A" == t3)
              e3[5] = e3[5] + i2.x, e3[6] = e3[6] + i2.y;
            else
              for (var r3 = 0, o3 = e3.length; r3 < o3; ++r3)
                e3[r3] = e3[r3] + (r3 % 2 ? i2.y : i2.x);
            return s2[t3](e3, i2, a3);
          };
        }(r2[o2].toUpperCase());
      a2.PathArray = function(t3, e3) {
        a2.Array.call(this, t3, e3 || [["M", 0, 0]]);
      }, a2.PathArray.prototype = new a2.Array(), a2.PathArray.prototype.constructor = a2.PathArray, a2.extend(a2.PathArray, { toString: function() {
        return function(t3) {
          for (var e3 = 0, i2 = t3.length, a3 = ""; e3 < i2; e3++)
            a3 += t3[e3][0], null != t3[e3][1] && (a3 += t3[e3][1], null != t3[e3][2] && (a3 += " ", a3 += t3[e3][2], null != t3[e3][3] && (a3 += " ", a3 += t3[e3][3], a3 += " ", a3 += t3[e3][4], null != t3[e3][5] && (a3 += " ", a3 += t3[e3][5], a3 += " ", a3 += t3[e3][6], null != t3[e3][7] && (a3 += " ", a3 += t3[e3][7])))));
          return a3 + " ";
        }(this.value);
      }, move: function(t3, e3) {
        var i2 = this.bbox();
        return i2.x, i2.y, this;
      }, at: function(t3) {
        if (!this.destination)
          return this;
        for (var e3 = this.value, i2 = this.destination.value, s3 = [], r3 = new a2.PathArray(), o3 = 0, n3 = e3.length; o3 < n3; o3++) {
          s3[o3] = [e3[o3][0]];
          for (var l3 = 1, h3 = e3[o3].length; l3 < h3; l3++)
            s3[o3][l3] = e3[o3][l3] + (i2[o3][l3] - e3[o3][l3]) * t3;
          "A" === s3[o3][0] && (s3[o3][4] = +(0 != s3[o3][4]), s3[o3][5] = +(0 != s3[o3][5]));
        }
        return r3.value = s3, r3;
      }, parse: function(t3) {
        if (t3 instanceof a2.PathArray)
          return t3.valueOf();
        var e3, i2 = { M: 2, L: 2, H: 1, V: 1, C: 6, S: 4, Q: 4, T: 2, A: 7, Z: 0 };
        t3 = "string" == typeof t3 ? t3.replace(a2.regex.numbersWithDots, h2).replace(a2.regex.pathLetters, " $& ").replace(a2.regex.hyphen, "$1 -").trim().split(a2.regex.delimiter) : t3.reduce(function(t4, e4) {
          return [].concat.call(t4, e4);
        }, []);
        var r3 = [], o3 = new a2.Point(), n3 = new a2.Point(), l3 = 0, c3 = t3.length;
        do {
          a2.regex.isPathLetter.test(t3[l3]) ? (e3 = t3[l3], ++l3) : "M" == e3 ? e3 = "L" : "m" == e3 && (e3 = "l"), r3.push(s2[e3].call(null, t3.slice(l3, l3 += i2[e3.toUpperCase()]).map(parseFloat), o3, n3));
        } while (c3 > l3);
        return r3;
      }, bbox: function() {
        return a2.parser.draw || a2.prepare(), a2.parser.path.setAttribute("d", this.toString()), a2.parser.path.getBBox();
      } }), a2.Number = a2.invent({ create: function(t3, e3) {
        this.value = 0, this.unit = e3 || "", "number" == typeof t3 ? this.value = isNaN(t3) ? 0 : isFinite(t3) ? t3 : t3 < 0 ? -34e37 : 34e37 : "string" == typeof t3 ? (e3 = t3.match(a2.regex.numberAndUnit)) && (this.value = parseFloat(e3[1]), "%" == e3[5] ? this.value /= 100 : "s" == e3[5] && (this.value *= 1e3), this.unit = e3[5]) : t3 instanceof a2.Number && (this.value = t3.valueOf(), this.unit = t3.unit);
      }, extend: { toString: function() {
        return ("%" == this.unit ? ~~(1e8 * this.value) / 1e6 : "s" == this.unit ? this.value / 1e3 : this.value) + this.unit;
      }, toJSON: function() {
        return this.toString();
      }, valueOf: function() {
        return this.value;
      }, plus: function(t3) {
        return t3 = new a2.Number(t3), new a2.Number(this + t3, this.unit || t3.unit);
      }, minus: function(t3) {
        return t3 = new a2.Number(t3), new a2.Number(this - t3, this.unit || t3.unit);
      }, times: function(t3) {
        return t3 = new a2.Number(t3), new a2.Number(this * t3, this.unit || t3.unit);
      }, divide: function(t3) {
        return t3 = new a2.Number(t3), new a2.Number(this / t3, this.unit || t3.unit);
      }, to: function(t3) {
        var e3 = new a2.Number(this);
        return "string" == typeof t3 && (e3.unit = t3), e3;
      }, morph: function(t3) {
        return this.destination = new a2.Number(t3), t3.relative && (this.destination.value += this.value), this;
      }, at: function(t3) {
        return this.destination ? new a2.Number(this.destination).minus(this).times(t3).plus(this) : this;
      } } }), a2.Element = a2.invent({ create: function(t3) {
        this._stroke = a2.defaults.attrs.stroke, this._event = null, this.dom = {}, (this.node = t3) && (this.type = t3.nodeName, this.node.instance = this, this._stroke = t3.getAttribute("stroke") || this._stroke);
      }, extend: { x: function(t3) {
        return this.attr("x", t3);
      }, y: function(t3) {
        return this.attr("y", t3);
      }, cx: function(t3) {
        return null == t3 ? this.x() + this.width() / 2 : this.x(t3 - this.width() / 2);
      }, cy: function(t3) {
        return null == t3 ? this.y() + this.height() / 2 : this.y(t3 - this.height() / 2);
      }, move: function(t3, e3) {
        return this.x(t3).y(e3);
      }, center: function(t3, e3) {
        return this.cx(t3).cy(e3);
      }, width: function(t3) {
        return this.attr("width", t3);
      }, height: function(t3) {
        return this.attr("height", t3);
      }, size: function(t3, e3) {
        var i2 = u2(this, t3, e3);
        return this.width(new a2.Number(i2.width)).height(new a2.Number(i2.height));
      }, clone: function(t3) {
        this.writeDataToDom();
        var e3 = x2(this.node.cloneNode(true));
        return t3 ? t3.add(e3) : this.after(e3), e3;
      }, remove: function() {
        return this.parent() && this.parent().removeElement(this), this;
      }, replace: function(t3) {
        return this.after(t3).remove(), t3;
      }, addTo: function(t3) {
        return t3.put(this);
      }, putIn: function(t3) {
        return t3.add(this);
      }, id: function(t3) {
        return this.attr("id", t3);
      }, show: function() {
        return this.style("display", "");
      }, hide: function() {
        return this.style("display", "none");
      }, visible: function() {
        return "none" != this.style("display");
      }, toString: function() {
        return this.attr("id");
      }, classes: function() {
        var t3 = this.attr("class");
        return null == t3 ? [] : t3.trim().split(a2.regex.delimiter);
      }, hasClass: function(t3) {
        return -1 != this.classes().indexOf(t3);
      }, addClass: function(t3) {
        if (!this.hasClass(t3)) {
          var e3 = this.classes();
          e3.push(t3), this.attr("class", e3.join(" "));
        }
        return this;
      }, removeClass: function(t3) {
        return this.hasClass(t3) && this.attr("class", this.classes().filter(function(e3) {
          return e3 != t3;
        }).join(" ")), this;
      }, toggleClass: function(t3) {
        return this.hasClass(t3) ? this.removeClass(t3) : this.addClass(t3);
      }, reference: function(t3) {
        return a2.get(this.attr(t3));
      }, parent: function(e3) {
        var i2 = this;
        if (!i2.node.parentNode)
          return null;
        if (i2 = a2.adopt(i2.node.parentNode), !e3)
          return i2;
        for (; i2 && i2.node instanceof t2.SVGElement; ) {
          if ("string" == typeof e3 ? i2.matches(e3) : i2 instanceof e3)
            return i2;
          if (!i2.node.parentNode || "#document" == i2.node.parentNode.nodeName)
            return null;
          i2 = a2.adopt(i2.node.parentNode);
        }
      }, doc: function() {
        return this instanceof a2.Doc ? this : this.parent(a2.Doc);
      }, parents: function(t3) {
        var e3 = [], i2 = this;
        do {
          if (!(i2 = i2.parent(t3)) || !i2.node)
            break;
          e3.push(i2);
        } while (i2.parent);
        return e3;
      }, matches: function(t3) {
        return function(t4, e3) {
          return (t4.matches || t4.matchesSelector || t4.msMatchesSelector || t4.mozMatchesSelector || t4.webkitMatchesSelector || t4.oMatchesSelector).call(t4, e3);
        }(this.node, t3);
      }, native: function() {
        return this.node;
      }, svg: function(t3) {
        var i2 = e2.createElement("svg");
        if (!(t3 && this instanceof a2.Parent))
          return i2.appendChild(t3 = e2.createElement("svg")), this.writeDataToDom(), t3.appendChild(this.node.cloneNode(true)), i2.innerHTML.replace(/^<svg>/, "").replace(/<\/svg>$/, "");
        i2.innerHTML = "<svg>" + t3.replace(/\n/, "").replace(/<([\w:-]+)([^<]+?)\/>/g, "<$1$2></$1>") + "</svg>";
        for (var s3 = 0, r3 = i2.firstChild.childNodes.length; s3 < r3; s3++)
          this.node.appendChild(i2.firstChild.firstChild);
        return this;
      }, writeDataToDom: function() {
        return (this.each || this.lines) && (this.each ? this : this.lines()).each(function() {
          this.writeDataToDom();
        }), this.node.removeAttribute("svgjs:data"), Object.keys(this.dom).length && this.node.setAttribute("svgjs:data", JSON.stringify(this.dom)), this;
      }, setData: function(t3) {
        return this.dom = t3, this;
      }, is: function(t3) {
        return function(t4, e3) {
          return t4 instanceof e3;
        }(this, t3);
      } } }), a2.easing = { "-": function(t3) {
        return t3;
      }, "<>": function(t3) {
        return -Math.cos(t3 * Math.PI) / 2 + 0.5;
      }, ">": function(t3) {
        return Math.sin(t3 * Math.PI / 2);
      }, "<": function(t3) {
        return 1 - Math.cos(t3 * Math.PI / 2);
      } }, a2.morph = function(t3) {
        return function(e3, i2) {
          return new a2.MorphObj(e3, i2).at(t3);
        };
      }, a2.Situation = a2.invent({ create: function(t3) {
        this.init = false, this.reversed = false, this.reversing = false, this.duration = new a2.Number(t3.duration).valueOf(), this.delay = new a2.Number(t3.delay).valueOf(), this.start = +/* @__PURE__ */ new Date() + this.delay, this.finish = this.start + this.duration, this.ease = t3.ease, this.loop = 0, this.loops = false, this.animations = {}, this.attrs = {}, this.styles = {}, this.transforms = [], this.once = {};
      } }), a2.FX = a2.invent({ create: function(t3) {
        this._target = t3, this.situations = [], this.active = false, this.situation = null, this.paused = false, this.lastPos = 0, this.pos = 0, this.absPos = 0, this._speed = 1;
      }, extend: { animate: function(t3, e3, s3) {
        "object" === i(t3) && (e3 = t3.ease, s3 = t3.delay, t3 = t3.duration);
        var r3 = new a2.Situation({ duration: t3 || 1e3, delay: s3 || 0, ease: a2.easing[e3 || "-"] || e3 });
        return this.queue(r3), this;
      }, target: function(t3) {
        return t3 && t3 instanceof a2.Element ? (this._target = t3, this) : this._target;
      }, timeToAbsPos: function(t3) {
        return (t3 - this.situation.start) / (this.situation.duration / this._speed);
      }, absPosToTime: function(t3) {
        return this.situation.duration / this._speed * t3 + this.situation.start;
      }, startAnimFrame: function() {
        this.stopAnimFrame(), this.animationFrame = t2.requestAnimationFrame((function() {
          this.step();
        }).bind(this));
      }, stopAnimFrame: function() {
        t2.cancelAnimationFrame(this.animationFrame);
      }, start: function() {
        return !this.active && this.situation && (this.active = true, this.startCurrent()), this;
      }, startCurrent: function() {
        return this.situation.start = +/* @__PURE__ */ new Date() + this.situation.delay / this._speed, this.situation.finish = this.situation.start + this.situation.duration / this._speed, this.initAnimations().step();
      }, queue: function(t3) {
        return ("function" == typeof t3 || t3 instanceof a2.Situation) && this.situations.push(t3), this.situation || (this.situation = this.situations.shift()), this;
      }, dequeue: function() {
        return this.stop(), this.situation = this.situations.shift(), this.situation && (this.situation instanceof a2.Situation ? this.start() : this.situation.call(this)), this;
      }, initAnimations: function() {
        var t3, e3 = this.situation;
        if (e3.init)
          return this;
        for (var i2 in e3.animations) {
          t3 = this.target()[i2](), Array.isArray(t3) || (t3 = [t3]), Array.isArray(e3.animations[i2]) || (e3.animations[i2] = [e3.animations[i2]]);
          for (var s3 = t3.length; s3--; )
            e3.animations[i2][s3] instanceof a2.Number && (t3[s3] = new a2.Number(t3[s3])), e3.animations[i2][s3] = t3[s3].morph(e3.animations[i2][s3]);
        }
        for (var i2 in e3.attrs)
          e3.attrs[i2] = new a2.MorphObj(this.target().attr(i2), e3.attrs[i2]);
        for (var i2 in e3.styles)
          e3.styles[i2] = new a2.MorphObj(this.target().style(i2), e3.styles[i2]);
        return e3.initialTransformation = this.target().matrixify(), e3.init = true, this;
      }, clearQueue: function() {
        return this.situations = [], this;
      }, clearCurrent: function() {
        return this.situation = null, this;
      }, stop: function(t3, e3) {
        var i2 = this.active;
        return this.active = false, e3 && this.clearQueue(), t3 && this.situation && (!i2 && this.startCurrent(), this.atEnd()), this.stopAnimFrame(), this.clearCurrent();
      }, after: function(t3) {
        var e3 = this.last();
        return this.target().on("finished.fx", function i2(a3) {
          a3.detail.situation == e3 && (t3.call(this, e3), this.off("finished.fx", i2));
        }), this._callStart();
      }, during: function(t3) {
        var e3 = this.last(), i2 = function(i3) {
          i3.detail.situation == e3 && t3.call(this, i3.detail.pos, a2.morph(i3.detail.pos), i3.detail.eased, e3);
        };
        return this.target().off("during.fx", i2).on("during.fx", i2), this.after(function() {
          this.off("during.fx", i2);
        }), this._callStart();
      }, afterAll: function(t3) {
        var e3 = function e4(i2) {
          t3.call(this), this.off("allfinished.fx", e4);
        };
        return this.target().off("allfinished.fx", e3).on("allfinished.fx", e3), this._callStart();
      }, last: function() {
        return this.situations.length ? this.situations[this.situations.length - 1] : this.situation;
      }, add: function(t3, e3, i2) {
        return this.last()[i2 || "animations"][t3] = e3, this._callStart();
      }, step: function(t3) {
        var e3, i2, a3;
        t3 || (this.absPos = this.timeToAbsPos(+/* @__PURE__ */ new Date())), false !== this.situation.loops ? (e3 = Math.max(this.absPos, 0), i2 = Math.floor(e3), true === this.situation.loops || i2 < this.situation.loops ? (this.pos = e3 - i2, a3 = this.situation.loop, this.situation.loop = i2) : (this.absPos = this.situation.loops, this.pos = 1, a3 = this.situation.loop - 1, this.situation.loop = this.situation.loops), this.situation.reversing && (this.situation.reversed = this.situation.reversed != Boolean((this.situation.loop - a3) % 2))) : (this.absPos = Math.min(this.absPos, 1), this.pos = this.absPos), this.pos < 0 && (this.pos = 0), this.situation.reversed && (this.pos = 1 - this.pos);
        var s3 = this.situation.ease(this.pos);
        for (var r3 in this.situation.once)
          r3 > this.lastPos && r3 <= s3 && (this.situation.once[r3].call(this.target(), this.pos, s3), delete this.situation.once[r3]);
        return this.active && this.target().fire("during", { pos: this.pos, eased: s3, fx: this, situation: this.situation }), this.situation ? (this.eachAt(), 1 == this.pos && !this.situation.reversed || this.situation.reversed && 0 == this.pos ? (this.stopAnimFrame(), this.target().fire("finished", { fx: this, situation: this.situation }), this.situations.length || (this.target().fire("allfinished"), this.situations.length || (this.target().off(".fx"), this.active = false)), this.active ? this.dequeue() : this.clearCurrent()) : !this.paused && this.active && this.startAnimFrame(), this.lastPos = s3, this) : this;
      }, eachAt: function() {
        var t3, e3 = this, i2 = this.target(), s3 = this.situation;
        for (var r3 in s3.animations)
          t3 = [].concat(s3.animations[r3]).map(function(t4) {
            return "string" != typeof t4 && t4.at ? t4.at(s3.ease(e3.pos), e3.pos) : t4;
          }), i2[r3].apply(i2, t3);
        for (var r3 in s3.attrs)
          t3 = [r3].concat(s3.attrs[r3]).map(function(t4) {
            return "string" != typeof t4 && t4.at ? t4.at(s3.ease(e3.pos), e3.pos) : t4;
          }), i2.attr.apply(i2, t3);
        for (var r3 in s3.styles)
          t3 = [r3].concat(s3.styles[r3]).map(function(t4) {
            return "string" != typeof t4 && t4.at ? t4.at(s3.ease(e3.pos), e3.pos) : t4;
          }), i2.style.apply(i2, t3);
        if (s3.transforms.length) {
          t3 = s3.initialTransformation, r3 = 0;
          for (var o3 = s3.transforms.length; r3 < o3; r3++) {
            var n3 = s3.transforms[r3];
            n3 instanceof a2.Matrix ? t3 = n3.relative ? t3.multiply(new a2.Matrix().morph(n3).at(s3.ease(this.pos))) : t3.morph(n3).at(s3.ease(this.pos)) : (n3.relative || n3.undo(t3.extract()), t3 = t3.multiply(n3.at(s3.ease(this.pos))));
          }
          i2.matrix(t3);
        }
        return this;
      }, once: function(t3, e3, i2) {
        var a3 = this.last();
        return i2 || (t3 = a3.ease(t3)), a3.once[t3] = e3, this;
      }, _callStart: function() {
        return setTimeout((function() {
          this.start();
        }).bind(this), 0), this;
      } }, parent: a2.Element, construct: { animate: function(t3, e3, i2) {
        return (this.fx || (this.fx = new a2.FX(this))).animate(t3, e3, i2);
      }, delay: function(t3) {
        return (this.fx || (this.fx = new a2.FX(this))).delay(t3);
      }, stop: function(t3, e3) {
        return this.fx && this.fx.stop(t3, e3), this;
      }, finish: function() {
        return this.fx && this.fx.finish(), this;
      } } }), a2.MorphObj = a2.invent({ create: function(t3, e3) {
        return a2.Color.isColor(e3) ? new a2.Color(t3).morph(e3) : a2.regex.delimiter.test(t3) ? a2.regex.pathLetters.test(t3) ? new a2.PathArray(t3).morph(e3) : new a2.Array(t3).morph(e3) : a2.regex.numberAndUnit.test(e3) ? new a2.Number(t3).morph(e3) : (this.value = t3, void (this.destination = e3));
      }, extend: { at: function(t3, e3) {
        return e3 < 1 ? this.value : this.destination;
      }, valueOf: function() {
        return this.value;
      } } }), a2.extend(a2.FX, { attr: function(t3, e3, a3) {
        if ("object" === i(t3))
          for (var s3 in t3)
            this.attr(s3, t3[s3]);
        else
          this.add(t3, e3, "attrs");
        return this;
      }, plot: function(t3, e3, i2, a3) {
        return 4 == arguments.length ? this.plot([t3, e3, i2, a3]) : this.add("plot", new (this.target()).morphArray(t3));
      } }), a2.Box = a2.invent({ create: function(t3, e3, s3, r3) {
        if (!("object" !== i(t3) || t3 instanceof a2.Element))
          return a2.Box.call(this, null != t3.left ? t3.left : t3.x, null != t3.top ? t3.top : t3.y, t3.width, t3.height);
        4 == arguments.length && (this.x = t3, this.y = e3, this.width = s3, this.height = r3), b2(this);
      } }), a2.BBox = a2.invent({ create: function(t3) {
        if (a2.Box.apply(this, [].slice.call(arguments)), t3 instanceof a2.Element) {
          var i2;
          try {
            if (!e2.documentElement.contains) {
              for (var s3 = t3.node; s3.parentNode; )
                s3 = s3.parentNode;
              if (s3 != e2)
                throw new Error("Element not in the dom");
            }
            i2 = t3.node.getBBox();
          } catch (e3) {
            if (t3 instanceof a2.Shape) {
              a2.parser.draw || a2.prepare();
              var r3 = t3.clone(a2.parser.draw.instance).show();
              i2 = r3.node.getBBox(), r3.remove();
            } else
              i2 = { x: t3.node.clientLeft, y: t3.node.clientTop, width: t3.node.clientWidth, height: t3.node.clientHeight };
          }
          a2.Box.call(this, i2);
        }
      }, inherit: a2.Box, parent: a2.Element, construct: { bbox: function() {
        return new a2.BBox(this);
      } } }), a2.BBox.prototype.constructor = a2.BBox, a2.Matrix = a2.invent({ create: function(t3) {
        var e3 = f2([1, 0, 0, 1, 0, 0]);
        t3 = null === t3 ? e3 : t3 instanceof a2.Element ? t3.matrixify() : "string" == typeof t3 ? f2(t3.split(a2.regex.delimiter).map(parseFloat)) : 6 == arguments.length ? f2([].slice.call(arguments)) : Array.isArray(t3) ? f2(t3) : t3 && "object" === i(t3) ? t3 : e3;
        for (var s3 = m2.length - 1; s3 >= 0; --s3)
          this[m2[s3]] = null != t3[m2[s3]] ? t3[m2[s3]] : e3[m2[s3]];
      }, extend: { extract: function() {
        var t3 = p2(this, 0, 1);
        p2(this, 1, 0);
        var e3 = 180 / Math.PI * Math.atan2(t3.y, t3.x) - 90;
        return { x: this.e, y: this.f, transformedX: (this.e * Math.cos(e3 * Math.PI / 180) + this.f * Math.sin(e3 * Math.PI / 180)) / Math.sqrt(this.a * this.a + this.b * this.b), transformedY: (this.f * Math.cos(e3 * Math.PI / 180) + this.e * Math.sin(-e3 * Math.PI / 180)) / Math.sqrt(this.c * this.c + this.d * this.d), rotation: e3, a: this.a, b: this.b, c: this.c, d: this.d, e: this.e, f: this.f, matrix: new a2.Matrix(this) };
      }, clone: function() {
        return new a2.Matrix(this);
      }, morph: function(t3) {
        return this.destination = new a2.Matrix(t3), this;
      }, multiply: function(t3) {
        return new a2.Matrix(this.native().multiply(function(t4) {
          return t4 instanceof a2.Matrix || (t4 = new a2.Matrix(t4)), t4;
        }(t3).native()));
      }, inverse: function() {
        return new a2.Matrix(this.native().inverse());
      }, translate: function(t3, e3) {
        return new a2.Matrix(this.native().translate(t3 || 0, e3 || 0));
      }, native: function() {
        for (var t3 = a2.parser.native.createSVGMatrix(), e3 = m2.length - 1; e3 >= 0; e3--)
          t3[m2[e3]] = this[m2[e3]];
        return t3;
      }, toString: function() {
        return "matrix(" + v2(this.a) + "," + v2(this.b) + "," + v2(this.c) + "," + v2(this.d) + "," + v2(this.e) + "," + v2(this.f) + ")";
      } }, parent: a2.Element, construct: { ctm: function() {
        return new a2.Matrix(this.node.getCTM());
      }, screenCTM: function() {
        if (this instanceof a2.Nested) {
          var t3 = this.rect(1, 1), e3 = t3.node.getScreenCTM();
          return t3.remove(), new a2.Matrix(e3);
        }
        return new a2.Matrix(this.node.getScreenCTM());
      } } }), a2.Point = a2.invent({ create: function(t3, e3) {
        var a3;
        a3 = Array.isArray(t3) ? { x: t3[0], y: t3[1] } : "object" === i(t3) ? { x: t3.x, y: t3.y } : null != t3 ? { x: t3, y: null != e3 ? e3 : t3 } : { x: 0, y: 0 }, this.x = a3.x, this.y = a3.y;
      }, extend: { clone: function() {
        return new a2.Point(this);
      }, morph: function(t3, e3) {
        return this.destination = new a2.Point(t3, e3), this;
      } } }), a2.extend(a2.Element, { point: function(t3, e3) {
        return new a2.Point(t3, e3).transform(this.screenCTM().inverse());
      } }), a2.extend(a2.Element, { attr: function(t3, e3, s3) {
        if (null == t3) {
          for (t3 = {}, s3 = (e3 = this.node.attributes).length - 1; s3 >= 0; s3--)
            t3[e3[s3].nodeName] = a2.regex.isNumber.test(e3[s3].nodeValue) ? parseFloat(e3[s3].nodeValue) : e3[s3].nodeValue;
          return t3;
        }
        if ("object" === i(t3))
          for (var r3 in t3)
            this.attr(r3, t3[r3]);
        else if (null === e3)
          this.node.removeAttribute(t3);
        else {
          if (null == e3)
            return null == (e3 = this.node.getAttribute(t3)) ? a2.defaults.attrs[t3] : a2.regex.isNumber.test(e3) ? parseFloat(e3) : e3;
          "stroke-width" == t3 ? this.attr("stroke", parseFloat(e3) > 0 ? this._stroke : null) : "stroke" == t3 && (this._stroke = e3), "fill" != t3 && "stroke" != t3 || (a2.regex.isImage.test(e3) && (e3 = this.doc().defs().image(e3, 0, 0)), e3 instanceof a2.Image && (e3 = this.doc().defs().pattern(0, 0, function() {
            this.add(e3);
          }))), "number" == typeof e3 ? e3 = new a2.Number(e3) : a2.Color.isColor(e3) ? e3 = new a2.Color(e3) : Array.isArray(e3) && (e3 = new a2.Array(e3)), "leading" == t3 ? this.leading && this.leading(e3) : "string" == typeof s3 ? this.node.setAttributeNS(s3, t3, e3.toString()) : this.node.setAttribute(t3, e3.toString()), !this.rebuild || "font-size" != t3 && "x" != t3 || this.rebuild(t3, e3);
        }
        return this;
      } }), a2.extend(a2.Element, { transform: function(t3, e3) {
        var s3;
        return "object" !== i(t3) ? (s3 = new a2.Matrix(this).extract(), "string" == typeof t3 ? s3[t3] : s3) : (s3 = new a2.Matrix(this), e3 = !!e3 || !!t3.relative, null != t3.a && (s3 = e3 ? s3.multiply(new a2.Matrix(t3)) : new a2.Matrix(t3)), this.attr("transform", s3));
      } }), a2.extend(a2.Element, { untransform: function() {
        return this.attr("transform", null);
      }, matrixify: function() {
        return (this.attr("transform") || "").split(a2.regex.transforms).slice(0, -1).map(function(t3) {
          var e3 = t3.trim().split("(");
          return [e3[0], e3[1].split(a2.regex.delimiter).map(function(t4) {
            return parseFloat(t4);
          })];
        }).reduce(function(t3, e3) {
          return "matrix" == e3[0] ? t3.multiply(f2(e3[1])) : t3[e3[0]].apply(t3, e3[1]);
        }, new a2.Matrix());
      }, toParent: function(t3) {
        if (this == t3)
          return this;
        var e3 = this.screenCTM(), i2 = t3.screenCTM().inverse();
        return this.addTo(t3).untransform().transform(i2.multiply(e3)), this;
      }, toDoc: function() {
        return this.toParent(this.doc());
      } }), a2.Transformation = a2.invent({ create: function(t3, e3) {
        if (arguments.length > 1 && "boolean" != typeof e3)
          return this.constructor.call(this, [].slice.call(arguments));
        if (Array.isArray(t3))
          for (var a3 = 0, s3 = this.arguments.length; a3 < s3; ++a3)
            this[this.arguments[a3]] = t3[a3];
        else if (t3 && "object" === i(t3))
          for (a3 = 0, s3 = this.arguments.length; a3 < s3; ++a3)
            this[this.arguments[a3]] = t3[this.arguments[a3]];
        this.inversed = false, true === e3 && (this.inversed = true);
      } }), a2.Translate = a2.invent({ parent: a2.Matrix, inherit: a2.Transformation, create: function(t3, e3) {
        this.constructor.apply(this, [].slice.call(arguments));
      }, extend: { arguments: ["transformedX", "transformedY"], method: "translate" } }), a2.extend(a2.Element, { style: function(t3, e3) {
        if (0 == arguments.length)
          return this.node.style.cssText || "";
        if (arguments.length < 2)
          if ("object" === i(t3))
            for (var s3 in t3)
              this.style(s3, t3[s3]);
          else {
            if (!a2.regex.isCss.test(t3))
              return this.node.style[c2(t3)];
            for (t3 = t3.split(/\s*;\s*/).filter(function(t4) {
              return !!t4;
            }).map(function(t4) {
              return t4.split(/\s*:\s*/);
            }); e3 = t3.pop(); )
              this.style(e3[0], e3[1]);
          }
        else
          this.node.style[c2(t3)] = null === e3 || a2.regex.isBlank.test(e3) ? "" : e3;
        return this;
      } }), a2.Parent = a2.invent({ create: function(t3) {
        this.constructor.call(this, t3);
      }, inherit: a2.Element, extend: { children: function() {
        return a2.utils.map(a2.utils.filterSVGElements(this.node.childNodes), function(t3) {
          return a2.adopt(t3);
        });
      }, add: function(t3, e3) {
        return null == e3 ? this.node.appendChild(t3.node) : t3.node != this.node.childNodes[e3] && this.node.insertBefore(t3.node, this.node.childNodes[e3]), this;
      }, put: function(t3, e3) {
        return this.add(t3, e3), t3;
      }, has: function(t3) {
        return this.index(t3) >= 0;
      }, index: function(t3) {
        return [].slice.call(this.node.childNodes).indexOf(t3.node);
      }, get: function(t3) {
        return a2.adopt(this.node.childNodes[t3]);
      }, first: function() {
        return this.get(0);
      }, last: function() {
        return this.get(this.node.childNodes.length - 1);
      }, each: function(t3, e3) {
        for (var i2 = this.children(), s3 = 0, r3 = i2.length; s3 < r3; s3++)
          i2[s3] instanceof a2.Element && t3.apply(i2[s3], [s3, i2]), e3 && i2[s3] instanceof a2.Container && i2[s3].each(t3, e3);
        return this;
      }, removeElement: function(t3) {
        return this.node.removeChild(t3.node), this;
      }, clear: function() {
        for (; this.node.hasChildNodes(); )
          this.node.removeChild(this.node.lastChild);
        return delete this._defs, this;
      }, defs: function() {
        return this.doc().defs();
      } } }), a2.extend(a2.Parent, { ungroup: function(t3, e3) {
        return 0 === e3 || this instanceof a2.Defs || this.node == a2.parser.draw || (t3 = t3 || (this instanceof a2.Doc ? this : this.parent(a2.Parent)), e3 = e3 || 1 / 0, this.each(function() {
          return this instanceof a2.Defs ? this : this instanceof a2.Parent ? this.ungroup(t3, e3 - 1) : this.toParent(t3);
        }), this.node.firstChild || this.remove()), this;
      }, flatten: function(t3, e3) {
        return this.ungroup(t3, e3);
      } }), a2.Container = a2.invent({ create: function(t3) {
        this.constructor.call(this, t3);
      }, inherit: a2.Parent }), a2.ViewBox = a2.invent({ parent: a2.Container, construct: {} }), ["click", "dblclick", "mousedown", "mouseup", "mouseover", "mouseout", "mousemove", "touchstart", "touchmove", "touchleave", "touchend", "touchcancel"].forEach(function(t3) {
        a2.Element.prototype[t3] = function(e3) {
          return a2.on(this.node, t3, e3), this;
        };
      }), a2.listeners = [], a2.handlerMap = [], a2.listenerId = 0, a2.on = function(t3, e3, i2, s3, r3) {
        var o3 = i2.bind(s3 || t3.instance || t3), n3 = (a2.handlerMap.indexOf(t3) + 1 || a2.handlerMap.push(t3)) - 1, l3 = e3.split(".")[0], h3 = e3.split(".")[1] || "*";
        a2.listeners[n3] = a2.listeners[n3] || {}, a2.listeners[n3][l3] = a2.listeners[n3][l3] || {}, a2.listeners[n3][l3][h3] = a2.listeners[n3][l3][h3] || {}, i2._svgjsListenerId || (i2._svgjsListenerId = ++a2.listenerId), a2.listeners[n3][l3][h3][i2._svgjsListenerId] = o3, t3.addEventListener(l3, o3, r3 || { passive: true });
      }, a2.off = function(t3, e3, i2) {
        var s3 = a2.handlerMap.indexOf(t3), r3 = e3 && e3.split(".")[0], o3 = e3 && e3.split(".")[1], n3 = "";
        if (-1 != s3)
          if (i2) {
            if ("function" == typeof i2 && (i2 = i2._svgjsListenerId), !i2)
              return;
            a2.listeners[s3][r3] && a2.listeners[s3][r3][o3 || "*"] && (t3.removeEventListener(r3, a2.listeners[s3][r3][o3 || "*"][i2], false), delete a2.listeners[s3][r3][o3 || "*"][i2]);
          } else if (o3 && r3) {
            if (a2.listeners[s3][r3] && a2.listeners[s3][r3][o3]) {
              for (var l3 in a2.listeners[s3][r3][o3])
                a2.off(t3, [r3, o3].join("."), l3);
              delete a2.listeners[s3][r3][o3];
            }
          } else if (o3)
            for (var h3 in a2.listeners[s3])
              for (var n3 in a2.listeners[s3][h3])
                o3 === n3 && a2.off(t3, [h3, o3].join("."));
          else if (r3) {
            if (a2.listeners[s3][r3]) {
              for (var n3 in a2.listeners[s3][r3])
                a2.off(t3, [r3, n3].join("."));
              delete a2.listeners[s3][r3];
            }
          } else {
            for (var h3 in a2.listeners[s3])
              a2.off(t3, h3);
            delete a2.listeners[s3], delete a2.handlerMap[s3];
          }
      }, a2.extend(a2.Element, { on: function(t3, e3, i2, s3) {
        return a2.on(this.node, t3, e3, i2, s3), this;
      }, off: function(t3, e3) {
        return a2.off(this.node, t3, e3), this;
      }, fire: function(e3, i2) {
        return e3 instanceof t2.Event ? this.node.dispatchEvent(e3) : this.node.dispatchEvent(e3 = new a2.CustomEvent(e3, { detail: i2, cancelable: true })), this._event = e3, this;
      }, event: function() {
        return this._event;
      } }), a2.Defs = a2.invent({ create: "defs", inherit: a2.Container }), a2.G = a2.invent({ create: "g", inherit: a2.Container, extend: { x: function(t3) {
        return null == t3 ? this.transform("x") : this.transform({ x: t3 - this.x() }, true);
      } }, construct: { group: function() {
        return this.put(new a2.G());
      } } }), a2.Doc = a2.invent({ create: function(t3) {
        t3 && ("svg" == (t3 = "string" == typeof t3 ? e2.getElementById(t3) : t3).nodeName ? this.constructor.call(this, t3) : (this.constructor.call(this, a2.create("svg")), t3.appendChild(this.node), this.size("100%", "100%")), this.namespace().defs());
      }, inherit: a2.Container, extend: { namespace: function() {
        return this.attr({ xmlns: a2.ns, version: "1.1" }).attr("xmlns:xlink", a2.xlink, a2.xmlns).attr("xmlns:svgjs", a2.svgjs, a2.xmlns);
      }, defs: function() {
        var t3;
        return this._defs || ((t3 = this.node.getElementsByTagName("defs")[0]) ? this._defs = a2.adopt(t3) : this._defs = new a2.Defs(), this.node.appendChild(this._defs.node)), this._defs;
      }, parent: function() {
        return this.node.parentNode && "#document" != this.node.parentNode.nodeName ? this.node.parentNode : null;
      }, remove: function() {
        return this.parent() && this.parent().removeChild(this.node), this;
      }, clear: function() {
        for (; this.node.hasChildNodes(); )
          this.node.removeChild(this.node.lastChild);
        return delete this._defs, a2.parser.draw && !a2.parser.draw.parentNode && this.node.appendChild(a2.parser.draw), this;
      }, clone: function(t3) {
        this.writeDataToDom();
        var e3 = this.node, i2 = x2(e3.cloneNode(true));
        return t3 ? (t3.node || t3).appendChild(i2.node) : e3.parentNode.insertBefore(i2.node, e3.nextSibling), i2;
      } } }), a2.extend(a2.Element, {}), a2.Gradient = a2.invent({ create: function(t3) {
        this.constructor.call(this, a2.create(t3 + "Gradient")), this.type = t3;
      }, inherit: a2.Container, extend: { at: function(t3, e3, i2) {
        return this.put(new a2.Stop()).update(t3, e3, i2);
      }, update: function(t3) {
        return this.clear(), "function" == typeof t3 && t3.call(this, this), this;
      }, fill: function() {
        return "url(#" + this.id() + ")";
      }, toString: function() {
        return this.fill();
      }, attr: function(t3, e3, i2) {
        return "transform" == t3 && (t3 = "gradientTransform"), a2.Container.prototype.attr.call(this, t3, e3, i2);
      } }, construct: { gradient: function(t3, e3) {
        return this.defs().gradient(t3, e3);
      } } }), a2.extend(a2.Gradient, a2.FX, { from: function(t3, e3) {
        return "radial" == (this._target || this).type ? this.attr({ fx: new a2.Number(t3), fy: new a2.Number(e3) }) : this.attr({ x1: new a2.Number(t3), y1: new a2.Number(e3) });
      }, to: function(t3, e3) {
        return "radial" == (this._target || this).type ? this.attr({ cx: new a2.Number(t3), cy: new a2.Number(e3) }) : this.attr({ x2: new a2.Number(t3), y2: new a2.Number(e3) });
      } }), a2.extend(a2.Defs, { gradient: function(t3, e3) {
        return this.put(new a2.Gradient(t3)).update(e3);
      } }), a2.Stop = a2.invent({ create: "stop", inherit: a2.Element, extend: { update: function(t3) {
        return ("number" == typeof t3 || t3 instanceof a2.Number) && (t3 = { offset: arguments[0], color: arguments[1], opacity: arguments[2] }), null != t3.opacity && this.attr("stop-opacity", t3.opacity), null != t3.color && this.attr("stop-color", t3.color), null != t3.offset && this.attr("offset", new a2.Number(t3.offset)), this;
      } } }), a2.Pattern = a2.invent({ create: "pattern", inherit: a2.Container, extend: { fill: function() {
        return "url(#" + this.id() + ")";
      }, update: function(t3) {
        return this.clear(), "function" == typeof t3 && t3.call(this, this), this;
      }, toString: function() {
        return this.fill();
      }, attr: function(t3, e3, i2) {
        return "transform" == t3 && (t3 = "patternTransform"), a2.Container.prototype.attr.call(this, t3, e3, i2);
      } }, construct: { pattern: function(t3, e3, i2) {
        return this.defs().pattern(t3, e3, i2);
      } } }), a2.extend(a2.Defs, { pattern: function(t3, e3, i2) {
        return this.put(new a2.Pattern()).update(i2).attr({ x: 0, y: 0, width: t3, height: e3, patternUnits: "userSpaceOnUse" });
      } }), a2.Shape = a2.invent({ create: function(t3) {
        this.constructor.call(this, t3);
      }, inherit: a2.Element }), a2.Symbol = a2.invent({ create: "symbol", inherit: a2.Container, construct: { symbol: function() {
        return this.put(new a2.Symbol());
      } } }), a2.Use = a2.invent({ create: "use", inherit: a2.Shape, extend: { element: function(t3, e3) {
        return this.attr("href", (e3 || "") + "#" + t3, a2.xlink);
      } }, construct: { use: function(t3, e3) {
        return this.put(new a2.Use()).element(t3, e3);
      } } }), a2.Rect = a2.invent({ create: "rect", inherit: a2.Shape, construct: { rect: function(t3, e3) {
        return this.put(new a2.Rect()).size(t3, e3);
      } } }), a2.Circle = a2.invent({ create: "circle", inherit: a2.Shape, construct: { circle: function(t3) {
        return this.put(new a2.Circle()).rx(new a2.Number(t3).divide(2)).move(0, 0);
      } } }), a2.extend(a2.Circle, a2.FX, { rx: function(t3) {
        return this.attr("r", t3);
      }, ry: function(t3) {
        return this.rx(t3);
      } }), a2.Ellipse = a2.invent({ create: "ellipse", inherit: a2.Shape, construct: { ellipse: function(t3, e3) {
        return this.put(new a2.Ellipse()).size(t3, e3).move(0, 0);
      } } }), a2.extend(a2.Ellipse, a2.Rect, a2.FX, { rx: function(t3) {
        return this.attr("rx", t3);
      }, ry: function(t3) {
        return this.attr("ry", t3);
      } }), a2.extend(a2.Circle, a2.Ellipse, { x: function(t3) {
        return null == t3 ? this.cx() - this.rx() : this.cx(t3 + this.rx());
      }, y: function(t3) {
        return null == t3 ? this.cy() - this.ry() : this.cy(t3 + this.ry());
      }, cx: function(t3) {
        return null == t3 ? this.attr("cx") : this.attr("cx", t3);
      }, cy: function(t3) {
        return null == t3 ? this.attr("cy") : this.attr("cy", t3);
      }, width: function(t3) {
        return null == t3 ? 2 * this.rx() : this.rx(new a2.Number(t3).divide(2));
      }, height: function(t3) {
        return null == t3 ? 2 * this.ry() : this.ry(new a2.Number(t3).divide(2));
      }, size: function(t3, e3) {
        var i2 = u2(this, t3, e3);
        return this.rx(new a2.Number(i2.width).divide(2)).ry(new a2.Number(i2.height).divide(2));
      } }), a2.Line = a2.invent({ create: "line", inherit: a2.Shape, extend: { array: function() {
        return new a2.PointArray([[this.attr("x1"), this.attr("y1")], [this.attr("x2"), this.attr("y2")]]);
      }, plot: function(t3, e3, i2, s3) {
        return null == t3 ? this.array() : (t3 = void 0 !== e3 ? { x1: t3, y1: e3, x2: i2, y2: s3 } : new a2.PointArray(t3).toLine(), this.attr(t3));
      }, move: function(t3, e3) {
        return this.attr(this.array().move(t3, e3).toLine());
      }, size: function(t3, e3) {
        var i2 = u2(this, t3, e3);
        return this.attr(this.array().size(i2.width, i2.height).toLine());
      } }, construct: { line: function(t3, e3, i2, s3) {
        return a2.Line.prototype.plot.apply(this.put(new a2.Line()), null != t3 ? [t3, e3, i2, s3] : [0, 0, 0, 0]);
      } } }), a2.Polyline = a2.invent({ create: "polyline", inherit: a2.Shape, construct: { polyline: function(t3) {
        return this.put(new a2.Polyline()).plot(t3 || new a2.PointArray());
      } } }), a2.Polygon = a2.invent({ create: "polygon", inherit: a2.Shape, construct: { polygon: function(t3) {
        return this.put(new a2.Polygon()).plot(t3 || new a2.PointArray());
      } } }), a2.extend(a2.Polyline, a2.Polygon, { array: function() {
        return this._array || (this._array = new a2.PointArray(this.attr("points")));
      }, plot: function(t3) {
        return null == t3 ? this.array() : this.clear().attr("points", "string" == typeof t3 ? t3 : this._array = new a2.PointArray(t3));
      }, clear: function() {
        return delete this._array, this;
      }, move: function(t3, e3) {
        return this.attr("points", this.array().move(t3, e3));
      }, size: function(t3, e3) {
        var i2 = u2(this, t3, e3);
        return this.attr("points", this.array().size(i2.width, i2.height));
      } }), a2.extend(a2.Line, a2.Polyline, a2.Polygon, { morphArray: a2.PointArray, x: function(t3) {
        return null == t3 ? this.bbox().x : this.move(t3, this.bbox().y);
      }, y: function(t3) {
        return null == t3 ? this.bbox().y : this.move(this.bbox().x, t3);
      }, width: function(t3) {
        var e3 = this.bbox();
        return null == t3 ? e3.width : this.size(t3, e3.height);
      }, height: function(t3) {
        var e3 = this.bbox();
        return null == t3 ? e3.height : this.size(e3.width, t3);
      } }), a2.Path = a2.invent({ create: "path", inherit: a2.Shape, extend: { morphArray: a2.PathArray, array: function() {
        return this._array || (this._array = new a2.PathArray(this.attr("d")));
      }, plot: function(t3) {
        return null == t3 ? this.array() : this.clear().attr("d", "string" == typeof t3 ? t3 : this._array = new a2.PathArray(t3));
      }, clear: function() {
        return delete this._array, this;
      } }, construct: { path: function(t3) {
        return this.put(new a2.Path()).plot(t3 || new a2.PathArray());
      } } }), a2.Image = a2.invent({ create: "image", inherit: a2.Shape, extend: { load: function(e3) {
        if (!e3)
          return this;
        var i2 = this, s3 = new t2.Image();
        return a2.on(s3, "load", function() {
          a2.off(s3);
          var t3 = i2.parent(a2.Pattern);
          null !== t3 && (0 == i2.width() && 0 == i2.height() && i2.size(s3.width, s3.height), t3 && 0 == t3.width() && 0 == t3.height() && t3.size(i2.width(), i2.height()), "function" == typeof i2._loaded && i2._loaded.call(i2, { width: s3.width, height: s3.height, ratio: s3.width / s3.height, url: e3 }));
        }), a2.on(s3, "error", function(t3) {
          a2.off(s3), "function" == typeof i2._error && i2._error.call(i2, t3);
        }), this.attr("href", s3.src = this.src = e3, a2.xlink);
      }, loaded: function(t3) {
        return this._loaded = t3, this;
      }, error: function(t3) {
        return this._error = t3, this;
      } }, construct: { image: function(t3, e3, i2) {
        return this.put(new a2.Image()).load(t3).size(e3 || 0, i2 || e3 || 0);
      } } }), a2.Text = a2.invent({ create: function() {
        this.constructor.call(this, a2.create("text")), this.dom.leading = new a2.Number(1.3), this._rebuild = true, this._build = false, this.attr("font-family", a2.defaults.attrs["font-family"]);
      }, inherit: a2.Shape, extend: { x: function(t3) {
        return null == t3 ? this.attr("x") : this.attr("x", t3);
      }, text: function(t3) {
        if (void 0 === t3) {
          t3 = "";
          for (var e3 = this.node.childNodes, i2 = 0, s3 = e3.length; i2 < s3; ++i2)
            0 != i2 && 3 != e3[i2].nodeType && 1 == a2.adopt(e3[i2]).dom.newLined && (t3 += "\n"), t3 += e3[i2].textContent;
          return t3;
        }
        if (this.clear().build(true), "function" == typeof t3)
          t3.call(this, this);
        else {
          i2 = 0;
          for (var r3 = (t3 = t3.split("\n")).length; i2 < r3; i2++)
            this.tspan(t3[i2]).newLine();
        }
        return this.build(false).rebuild();
      }, size: function(t3) {
        return this.attr("font-size", t3).rebuild();
      }, leading: function(t3) {
        return null == t3 ? this.dom.leading : (this.dom.leading = new a2.Number(t3), this.rebuild());
      }, lines: function() {
        var t3 = (this.textPath && this.textPath() || this).node, e3 = a2.utils.map(a2.utils.filterSVGElements(t3.childNodes), function(t4) {
          return a2.adopt(t4);
        });
        return new a2.Set(e3);
      }, rebuild: function(t3) {
        if ("boolean" == typeof t3 && (this._rebuild = t3), this._rebuild) {
          var e3 = this, i2 = 0, s3 = this.dom.leading * new a2.Number(this.attr("font-size"));
          this.lines().each(function() {
            this.dom.newLined && (e3.textPath() || this.attr("x", e3.attr("x")), "\n" == this.text() ? i2 += s3 : (this.attr("dy", s3 + i2), i2 = 0));
          }), this.fire("rebuild");
        }
        return this;
      }, build: function(t3) {
        return this._build = !!t3, this;
      }, setData: function(t3) {
        return this.dom = t3, this.dom.leading = new a2.Number(t3.leading || 1.3), this;
      } }, construct: { text: function(t3) {
        return this.put(new a2.Text()).text(t3);
      }, plain: function(t3) {
        return this.put(new a2.Text()).plain(t3);
      } } }), a2.Tspan = a2.invent({ create: "tspan", inherit: a2.Shape, extend: { text: function(t3) {
        return null == t3 ? this.node.textContent + (this.dom.newLined ? "\n" : "") : ("function" == typeof t3 ? t3.call(this, this) : this.plain(t3), this);
      }, dx: function(t3) {
        return this.attr("dx", t3);
      }, dy: function(t3) {
        return this.attr("dy", t3);
      }, newLine: function() {
        var t3 = this.parent(a2.Text);
        return this.dom.newLined = true, this.dy(t3.dom.leading * t3.attr("font-size")).attr("x", t3.x());
      } } }), a2.extend(a2.Text, a2.Tspan, { plain: function(t3) {
        return false === this._build && this.clear(), this.node.appendChild(e2.createTextNode(t3)), this;
      }, tspan: function(t3) {
        var e3 = (this.textPath && this.textPath() || this).node, i2 = new a2.Tspan();
        return false === this._build && this.clear(), e3.appendChild(i2.node), i2.text(t3);
      }, clear: function() {
        for (var t3 = (this.textPath && this.textPath() || this).node; t3.hasChildNodes(); )
          t3.removeChild(t3.lastChild);
        return this;
      }, length: function() {
        return this.node.getComputedTextLength();
      } }), a2.TextPath = a2.invent({ create: "textPath", inherit: a2.Parent, parent: a2.Text, construct: { morphArray: a2.PathArray, array: function() {
        var t3 = this.track();
        return t3 ? t3.array() : null;
      }, plot: function(t3) {
        var e3 = this.track(), i2 = null;
        return e3 && (i2 = e3.plot(t3)), null == t3 ? i2 : this;
      }, track: function() {
        var t3 = this.textPath();
        if (t3)
          return t3.reference("href");
      }, textPath: function() {
        if (this.node.firstChild && "textPath" == this.node.firstChild.nodeName)
          return a2.adopt(this.node.firstChild);
      } } }), a2.Nested = a2.invent({ create: function() {
        this.constructor.call(this, a2.create("svg")), this.style("overflow", "visible");
      }, inherit: a2.Container, construct: { nested: function() {
        return this.put(new a2.Nested());
      } } });
      var l2 = { stroke: ["color", "width", "opacity", "linecap", "linejoin", "miterlimit", "dasharray", "dashoffset"], fill: ["color", "opacity", "rule"], prefix: function(t3, e3) {
        return "color" == e3 ? t3 : t3 + "-" + e3;
      } };
      function h2(t3, e3, i2, s3) {
        return i2 + s3.replace(a2.regex.dots, " .");
      }
      function c2(t3) {
        return t3.toLowerCase().replace(/-(.)/g, function(t4, e3) {
          return e3.toUpperCase();
        });
      }
      function d2(t3) {
        return t3.charAt(0).toUpperCase() + t3.slice(1);
      }
      function g2(t3) {
        var e3 = t3.toString(16);
        return 1 == e3.length ? "0" + e3 : e3;
      }
      function u2(t3, e3, i2) {
        if (null == e3 || null == i2) {
          var a3 = t3.bbox();
          null == e3 ? e3 = a3.width / a3.height * i2 : null == i2 && (i2 = a3.height / a3.width * e3);
        }
        return { width: e3, height: i2 };
      }
      function p2(t3, e3, i2) {
        return { x: e3 * t3.a + i2 * t3.c + 0, y: e3 * t3.b + i2 * t3.d + 0 };
      }
      function f2(t3) {
        return { a: t3[0], b: t3[1], c: t3[2], d: t3[3], e: t3[4], f: t3[5] };
      }
      function x2(e3) {
        for (var i2 = e3.childNodes.length - 1; i2 >= 0; i2--)
          e3.childNodes[i2] instanceof t2.SVGElement && x2(e3.childNodes[i2]);
        return a2.adopt(e3).id(a2.eid(e3.nodeName));
      }
      function b2(t3) {
        return null == t3.x && (t3.x = 0, t3.y = 0, t3.width = 0, t3.height = 0), t3.w = t3.width, t3.h = t3.height, t3.x2 = t3.x + t3.width, t3.y2 = t3.y + t3.height, t3.cx = t3.x + t3.width / 2, t3.cy = t3.y + t3.height / 2, t3;
      }
      function v2(t3) {
        return Math.abs(t3) > 1e-37 ? t3 : 0;
      }
      ["fill", "stroke"].forEach(function(t3) {
        var e3 = {};
        e3[t3] = function(e4) {
          if (void 0 === e4)
            return this;
          if ("string" == typeof e4 || a2.Color.isRgb(e4) || e4 && "function" == typeof e4.fill)
            this.attr(t3, e4);
          else
            for (var i2 = l2[t3].length - 1; i2 >= 0; i2--)
              null != e4[l2[t3][i2]] && this.attr(l2.prefix(t3, l2[t3][i2]), e4[l2[t3][i2]]);
          return this;
        }, a2.extend(a2.Element, a2.FX, e3);
      }), a2.extend(a2.Element, a2.FX, { translate: function(t3, e3) {
        return this.transform({ x: t3, y: e3 });
      }, matrix: function(t3) {
        return this.attr("transform", new a2.Matrix(6 == arguments.length ? [].slice.call(arguments) : t3));
      }, opacity: function(t3) {
        return this.attr("opacity", t3);
      }, dx: function(t3) {
        return this.x(new a2.Number(t3).plus(this instanceof a2.FX ? 0 : this.x()), true);
      }, dy: function(t3) {
        return this.y(new a2.Number(t3).plus(this instanceof a2.FX ? 0 : this.y()), true);
      } }), a2.extend(a2.Path, { length: function() {
        return this.node.getTotalLength();
      }, pointAt: function(t3) {
        return this.node.getPointAtLength(t3);
      } }), a2.Set = a2.invent({ create: function(t3) {
        Array.isArray(t3) ? this.members = t3 : this.clear();
      }, extend: { add: function() {
        for (var t3 = [].slice.call(arguments), e3 = 0, i2 = t3.length; e3 < i2; e3++)
          this.members.push(t3[e3]);
        return this;
      }, remove: function(t3) {
        var e3 = this.index(t3);
        return e3 > -1 && this.members.splice(e3, 1), this;
      }, each: function(t3) {
        for (var e3 = 0, i2 = this.members.length; e3 < i2; e3++)
          t3.apply(this.members[e3], [e3, this.members]);
        return this;
      }, clear: function() {
        return this.members = [], this;
      }, length: function() {
        return this.members.length;
      }, has: function(t3) {
        return this.index(t3) >= 0;
      }, index: function(t3) {
        return this.members.indexOf(t3);
      }, get: function(t3) {
        return this.members[t3];
      }, first: function() {
        return this.get(0);
      }, last: function() {
        return this.get(this.members.length - 1);
      }, valueOf: function() {
        return this.members;
      } }, construct: { set: function(t3) {
        return new a2.Set(t3);
      } } }), a2.FX.Set = a2.invent({ create: function(t3) {
        this.set = t3;
      } }), a2.Set.inherit = function() {
        var t3 = [];
        for (var e3 in a2.Shape.prototype)
          "function" == typeof a2.Shape.prototype[e3] && "function" != typeof a2.Set.prototype[e3] && t3.push(e3);
        for (var e3 in t3.forEach(function(t4) {
          a2.Set.prototype[t4] = function() {
            for (var e4 = 0, i2 = this.members.length; e4 < i2; e4++)
              this.members[e4] && "function" == typeof this.members[e4][t4] && this.members[e4][t4].apply(this.members[e4], arguments);
            return "animate" == t4 ? this.fx || (this.fx = new a2.FX.Set(this)) : this;
          };
        }), t3 = [], a2.FX.prototype)
          "function" == typeof a2.FX.prototype[e3] && "function" != typeof a2.FX.Set.prototype[e3] && t3.push(e3);
        t3.forEach(function(t4) {
          a2.FX.Set.prototype[t4] = function() {
            for (var e4 = 0, i2 = this.set.members.length; e4 < i2; e4++)
              this.set.members[e4].fx[t4].apply(this.set.members[e4].fx, arguments);
            return this;
          };
        });
      }, a2.extend(a2.Element, {}), a2.extend(a2.Element, { remember: function(t3, e3) {
        if ("object" === i(arguments[0]))
          for (var a3 in t3)
            this.remember(a3, t3[a3]);
        else {
          if (1 == arguments.length)
            return this.memory()[t3];
          this.memory()[t3] = e3;
        }
        return this;
      }, forget: function() {
        if (0 == arguments.length)
          this._memory = {};
        else
          for (var t3 = arguments.length - 1; t3 >= 0; t3--)
            delete this.memory()[arguments[t3]];
        return this;
      }, memory: function() {
        return this._memory || (this._memory = {});
      } }), a2.get = function(t3) {
        var i2 = e2.getElementById(function(t4) {
          var e3 = (t4 || "").toString().match(a2.regex.reference);
          if (e3)
            return e3[1];
        }(t3) || t3);
        return a2.adopt(i2);
      }, a2.select = function(t3, i2) {
        return new a2.Set(a2.utils.map((i2 || e2).querySelectorAll(t3), function(t4) {
          return a2.adopt(t4);
        }));
      }, a2.extend(a2.Parent, { select: function(t3) {
        return a2.select(t3, this.node);
      } });
      var m2 = "abcdef".split("");
      if ("function" != typeof t2.CustomEvent) {
        var y2 = function(t3, i2) {
          i2 = i2 || { bubbles: false, cancelable: false, detail: void 0 };
          var a3 = e2.createEvent("CustomEvent");
          return a3.initCustomEvent(t3, i2.bubbles, i2.cancelable, i2.detail), a3;
        };
        y2.prototype = t2.Event.prototype, a2.CustomEvent = y2;
      } else
        a2.CustomEvent = t2.CustomEvent;
      return a2;
    }, "function" == typeof define && define.amd ? define(function() {
      return Mt(Tt, Tt.document);
    }) : "object" === ("undefined" == typeof exports ? "undefined" : i(exports)) && "undefined" != typeof module ? module.exports = Tt.document ? Mt(Tt, Tt.document) : function(t2) {
      return Mt(t2, t2.document);
    } : Tt.SVG = Mt(Tt, Tt.document), /*! svg.filter.js - v2.0.2 - 2016-02-24
    * https://github.com/wout/svg.filter.js
    * Copyright (c) 2016 Wout Fierens; Licensed MIT */
    (function() {
      SVG.Filter = SVG.invent({ create: "filter", inherit: SVG.Parent, extend: { source: "SourceGraphic", sourceAlpha: "SourceAlpha", background: "BackgroundImage", backgroundAlpha: "BackgroundAlpha", fill: "FillPaint", stroke: "StrokePaint", autoSetIn: true, put: function(t3, e3) {
        return this.add(t3, e3), !t3.attr("in") && this.autoSetIn && t3.attr("in", this.source), t3.attr("result") || t3.attr("result", t3), t3;
      }, blend: function(t3, e3, i3) {
        return this.put(new SVG.BlendEffect(t3, e3, i3));
      }, colorMatrix: function(t3, e3) {
        return this.put(new SVG.ColorMatrixEffect(t3, e3));
      }, convolveMatrix: function(t3) {
        return this.put(new SVG.ConvolveMatrixEffect(t3));
      }, componentTransfer: function(t3) {
        return this.put(new SVG.ComponentTransferEffect(t3));
      }, composite: function(t3, e3, i3) {
        return this.put(new SVG.CompositeEffect(t3, e3, i3));
      }, flood: function(t3, e3) {
        return this.put(new SVG.FloodEffect(t3, e3));
      }, offset: function(t3, e3) {
        return this.put(new SVG.OffsetEffect(t3, e3));
      }, image: function(t3) {
        return this.put(new SVG.ImageEffect(t3));
      }, merge: function() {
        var t3 = [void 0];
        for (var e3 in arguments)
          t3.push(arguments[e3]);
        return this.put(new (SVG.MergeEffect.bind.apply(SVG.MergeEffect, t3))());
      }, gaussianBlur: function(t3, e3) {
        return this.put(new SVG.GaussianBlurEffect(t3, e3));
      }, morphology: function(t3, e3) {
        return this.put(new SVG.MorphologyEffect(t3, e3));
      }, diffuseLighting: function(t3, e3, i3) {
        return this.put(new SVG.DiffuseLightingEffect(t3, e3, i3));
      }, displacementMap: function(t3, e3, i3, a3, s3) {
        return this.put(new SVG.DisplacementMapEffect(t3, e3, i3, a3, s3));
      }, specularLighting: function(t3, e3, i3, a3) {
        return this.put(new SVG.SpecularLightingEffect(t3, e3, i3, a3));
      }, tile: function() {
        return this.put(new SVG.TileEffect());
      }, turbulence: function(t3, e3, i3, a3, s3) {
        return this.put(new SVG.TurbulenceEffect(t3, e3, i3, a3, s3));
      }, toString: function() {
        return "url(#" + this.attr("id") + ")";
      } } }), SVG.extend(SVG.Defs, { filter: function(t3) {
        var e3 = this.put(new SVG.Filter());
        return "function" == typeof t3 && t3.call(e3, e3), e3;
      } }), SVG.extend(SVG.Container, { filter: function(t3) {
        return this.defs().filter(t3);
      } }), SVG.extend(SVG.Element, SVG.G, SVG.Nested, { filter: function(t3) {
        return this.filterer = t3 instanceof SVG.Element ? t3 : this.doc().filter(t3), this.doc() && this.filterer.doc() !== this.doc() && this.doc().defs().add(this.filterer), this.attr("filter", this.filterer), this.filterer;
      }, unfilter: function(t3) {
        return this.filterer && true === t3 && this.filterer.remove(), delete this.filterer, this.attr("filter", null);
      } }), SVG.Effect = SVG.invent({ create: function() {
        this.constructor.call(this);
      }, inherit: SVG.Element, extend: { in: function(t3) {
        return null == t3 ? this.parent() && this.parent().select('[result="' + this.attr("in") + '"]').get(0) || this.attr("in") : this.attr("in", t3);
      }, result: function(t3) {
        return null == t3 ? this.attr("result") : this.attr("result", t3);
      }, toString: function() {
        return this.result();
      } } }), SVG.ParentEffect = SVG.invent({ create: function() {
        this.constructor.call(this);
      }, inherit: SVG.Parent, extend: { in: function(t3) {
        return null == t3 ? this.parent() && this.parent().select('[result="' + this.attr("in") + '"]').get(0) || this.attr("in") : this.attr("in", t3);
      }, result: function(t3) {
        return null == t3 ? this.attr("result") : this.attr("result", t3);
      }, toString: function() {
        return this.result();
      } } });
      var t2 = { blend: function(t3, e3) {
        return this.parent() && this.parent().blend(this, t3, e3);
      }, colorMatrix: function(t3, e3) {
        return this.parent() && this.parent().colorMatrix(t3, e3).in(this);
      }, convolveMatrix: function(t3) {
        return this.parent() && this.parent().convolveMatrix(t3).in(this);
      }, componentTransfer: function(t3) {
        return this.parent() && this.parent().componentTransfer(t3).in(this);
      }, composite: function(t3, e3) {
        return this.parent() && this.parent().composite(this, t3, e3);
      }, flood: function(t3, e3) {
        return this.parent() && this.parent().flood(t3, e3);
      }, offset: function(t3, e3) {
        return this.parent() && this.parent().offset(t3, e3).in(this);
      }, image: function(t3) {
        return this.parent() && this.parent().image(t3);
      }, merge: function() {
        return this.parent() && this.parent().merge.apply(this.parent(), [this].concat(arguments));
      }, gaussianBlur: function(t3, e3) {
        return this.parent() && this.parent().gaussianBlur(t3, e3).in(this);
      }, morphology: function(t3, e3) {
        return this.parent() && this.parent().morphology(t3, e3).in(this);
      }, diffuseLighting: function(t3, e3, i3) {
        return this.parent() && this.parent().diffuseLighting(t3, e3, i3).in(this);
      }, displacementMap: function(t3, e3, i3, a3) {
        return this.parent() && this.parent().displacementMap(this, t3, e3, i3, a3);
      }, specularLighting: function(t3, e3, i3, a3) {
        return this.parent() && this.parent().specularLighting(t3, e3, i3, a3).in(this);
      }, tile: function() {
        return this.parent() && this.parent().tile().in(this);
      }, turbulence: function(t3, e3, i3, a3, s3) {
        return this.parent() && this.parent().turbulence(t3, e3, i3, a3, s3).in(this);
      } };
      SVG.extend(SVG.Effect, t2), SVG.extend(SVG.ParentEffect, t2), SVG.ChildEffect = SVG.invent({ create: function() {
        this.constructor.call(this);
      }, inherit: SVG.Element, extend: { in: function(t3) {
        this.attr("in", t3);
      } } });
      var e2 = { blend: function(t3, e3, i3) {
        this.attr({ in: t3, in2: e3, mode: i3 || "normal" });
      }, colorMatrix: function(t3, e3) {
        "matrix" == t3 && (e3 = s2(e3)), this.attr({ type: t3, values: void 0 === e3 ? null : e3 });
      }, convolveMatrix: function(t3) {
        t3 = s2(t3), this.attr({ order: Math.sqrt(t3.split(" ").length), kernelMatrix: t3 });
      }, composite: function(t3, e3, i3) {
        this.attr({ in: t3, in2: e3, operator: i3 });
      }, flood: function(t3, e3) {
        this.attr("flood-color", t3), null != e3 && this.attr("flood-opacity", e3);
      }, offset: function(t3, e3) {
        this.attr({ dx: t3, dy: e3 });
      }, image: function(t3) {
        this.attr("href", t3, SVG.xlink);
      }, displacementMap: function(t3, e3, i3, a3, s3) {
        this.attr({ in: t3, in2: e3, scale: i3, xChannelSelector: a3, yChannelSelector: s3 });
      }, gaussianBlur: function(t3, e3) {
        null != t3 || null != e3 ? this.attr("stdDeviation", r2(Array.prototype.slice.call(arguments))) : this.attr("stdDeviation", "0 0");
      }, morphology: function(t3, e3) {
        this.attr({ operator: t3, radius: e3 });
      }, tile: function() {
      }, turbulence: function(t3, e3, i3, a3, s3) {
        this.attr({ numOctaves: e3, seed: i3, stitchTiles: a3, baseFrequency: t3, type: s3 });
      } }, i2 = { merge: function() {
        var t3;
        if (arguments[0] instanceof SVG.Set) {
          var e3 = this;
          arguments[0].each(function(t4) {
            this instanceof SVG.MergeNode ? e3.put(this) : (this instanceof SVG.Effect || this instanceof SVG.ParentEffect) && e3.put(new SVG.MergeNode(this));
          });
        } else {
          t3 = Array.isArray(arguments[0]) ? arguments[0] : arguments;
          for (var i3 = 0; i3 < t3.length; i3++)
            t3[i3] instanceof SVG.MergeNode ? this.put(t3[i3]) : this.put(new SVG.MergeNode(t3[i3]));
        }
      }, componentTransfer: function(t3) {
        if (this.rgb = new SVG.Set(), ["r", "g", "b", "a"].forEach((function(t4) {
          this[t4] = new SVG["Func" + t4.toUpperCase()]("identity"), this.rgb.add(this[t4]), this.node.appendChild(this[t4].node);
        }).bind(this)), t3)
          for (var e3 in t3.rgb && (["r", "g", "b"].forEach((function(e4) {
            this[e4].attr(t3.rgb);
          }).bind(this)), delete t3.rgb), t3)
            this[e3].attr(t3[e3]);
      }, diffuseLighting: function(t3, e3, i3) {
        this.attr({ surfaceScale: t3, diffuseConstant: e3, kernelUnitLength: i3 });
      }, specularLighting: function(t3, e3, i3, a3) {
        this.attr({ surfaceScale: t3, diffuseConstant: e3, specularExponent: i3, kernelUnitLength: a3 });
      } }, a2 = { distantLight: function(t3, e3) {
        this.attr({ azimuth: t3, elevation: e3 });
      }, pointLight: function(t3, e3, i3) {
        this.attr({ x: t3, y: e3, z: i3 });
      }, spotLight: function(t3, e3, i3, a3, s3, r3) {
        this.attr({ x: t3, y: e3, z: i3, pointsAtX: a3, pointsAtY: s3, pointsAtZ: r3 });
      }, mergeNode: function(t3) {
        this.attr("in", t3);
      } };
      function s2(t3) {
        return Array.isArray(t3) && (t3 = new SVG.Array(t3)), t3.toString().replace(/^\s+/, "").replace(/\s+$/, "").replace(/\s+/g, " ");
      }
      function r2(t3) {
        if (!Array.isArray(t3))
          return t3;
        for (var e3 = 0, i3 = t3.length, a3 = []; e3 < i3; e3++)
          a3.push(t3[e3]);
        return a3.join(" ");
      }
      function o2() {
        var t3 = function() {
        };
        for (var e3 in "function" == typeof arguments[arguments.length - 1] && (t3 = arguments[arguments.length - 1], Array.prototype.splice.call(arguments, arguments.length - 1, 1)), arguments)
          for (var i3 in arguments[e3])
            t3(arguments[e3][i3], i3, arguments[e3]);
      }
      ["r", "g", "b", "a"].forEach(function(t3) {
        a2["Func" + t3.toUpperCase()] = function(t4) {
          switch (this.attr("type", t4), t4) {
            case "table":
              this.attr("tableValues", arguments[1]);
              break;
            case "linear":
              this.attr("slope", arguments[1]), this.attr("intercept", arguments[2]);
              break;
            case "gamma":
              this.attr("amplitude", arguments[1]), this.attr("exponent", arguments[2]), this.attr("offset", arguments[2]);
          }
        };
      }), o2(e2, function(t3, e3) {
        var i3 = e3.charAt(0).toUpperCase() + e3.slice(1);
        SVG[i3 + "Effect"] = SVG.invent({ create: function() {
          this.constructor.call(this, SVG.create("fe" + i3)), t3.apply(this, arguments), this.result(this.attr("id") + "Out");
        }, inherit: SVG.Effect, extend: {} });
      }), o2(i2, function(t3, e3) {
        var i3 = e3.charAt(0).toUpperCase() + e3.slice(1);
        SVG[i3 + "Effect"] = SVG.invent({ create: function() {
          this.constructor.call(this, SVG.create("fe" + i3)), t3.apply(this, arguments), this.result(this.attr("id") + "Out");
        }, inherit: SVG.ParentEffect, extend: {} });
      }), o2(a2, function(t3, e3) {
        var i3 = e3.charAt(0).toUpperCase() + e3.slice(1);
        SVG[i3] = SVG.invent({ create: function() {
          this.constructor.call(this, SVG.create("fe" + i3)), t3.apply(this, arguments);
        }, inherit: SVG.ChildEffect, extend: {} });
      }), SVG.extend(SVG.MergeEffect, { in: function(t3) {
        return t3 instanceof SVG.MergeNode ? this.add(t3, 0) : this.add(new SVG.MergeNode(t3), 0), this;
      } }), SVG.extend(SVG.CompositeEffect, SVG.BlendEffect, SVG.DisplacementMapEffect, { in2: function(t3) {
        return null == t3 ? this.parent() && this.parent().select('[result="' + this.attr("in2") + '"]').get(0) || this.attr("in2") : this.attr("in2", t3);
      } }), SVG.filter = { sepiatone: [0.343, 0.669, 0.119, 0, 0, 0.249, 0.626, 0.13, 0, 0, 0.172, 0.334, 0.111, 0, 0, 0, 0, 0, 1, 0] };
    }).call(void 0), function() {
      function t2(t3, s3, r2, o2, n2, l2, h2) {
        for (var c2 = t3.slice(s3, r2 || h2), d2 = o2.slice(n2, l2 || h2), g2 = 0, u2 = { pos: [0, 0], start: [0, 0] }, p2 = { pos: [0, 0], start: [0, 0] }; ; ) {
          if (c2[g2] = e2.call(u2, c2[g2]), d2[g2] = e2.call(p2, d2[g2]), c2[g2][0] != d2[g2][0] || "M" == c2[g2][0] || "A" == c2[g2][0] && (c2[g2][4] != d2[g2][4] || c2[g2][5] != d2[g2][5]) ? (Array.prototype.splice.apply(c2, [g2, 1].concat(a2.call(u2, c2[g2]))), Array.prototype.splice.apply(d2, [g2, 1].concat(a2.call(p2, d2[g2])))) : (c2[g2] = i2.call(u2, c2[g2]), d2[g2] = i2.call(p2, d2[g2])), ++g2 == c2.length && g2 == d2.length)
            break;
          g2 == c2.length && c2.push(["C", u2.pos[0], u2.pos[1], u2.pos[0], u2.pos[1], u2.pos[0], u2.pos[1]]), g2 == d2.length && d2.push(["C", p2.pos[0], p2.pos[1], p2.pos[0], p2.pos[1], p2.pos[0], p2.pos[1]]);
        }
        return { start: c2, dest: d2 };
      }
      function e2(t3) {
        switch (t3[0]) {
          case "z":
          case "Z":
            t3[0] = "L", t3[1] = this.start[0], t3[2] = this.start[1];
            break;
          case "H":
            t3[0] = "L", t3[2] = this.pos[1];
            break;
          case "V":
            t3[0] = "L", t3[2] = t3[1], t3[1] = this.pos[0];
            break;
          case "T":
            t3[0] = "Q", t3[3] = t3[1], t3[4] = t3[2], t3[1] = this.reflection[1], t3[2] = this.reflection[0];
            break;
          case "S":
            t3[0] = "C", t3[6] = t3[4], t3[5] = t3[3], t3[4] = t3[2], t3[3] = t3[1], t3[2] = this.reflection[1], t3[1] = this.reflection[0];
        }
        return t3;
      }
      function i2(t3) {
        var e3 = t3.length;
        return this.pos = [t3[e3 - 2], t3[e3 - 1]], -1 != "SCQT".indexOf(t3[0]) && (this.reflection = [2 * this.pos[0] - t3[e3 - 4], 2 * this.pos[1] - t3[e3 - 3]]), t3;
      }
      function a2(t3) {
        var e3 = [t3];
        switch (t3[0]) {
          case "M":
            return this.pos = this.start = [t3[1], t3[2]], e3;
          case "L":
            t3[5] = t3[3] = t3[1], t3[6] = t3[4] = t3[2], t3[1] = this.pos[0], t3[2] = this.pos[1];
            break;
          case "Q":
            t3[6] = t3[4], t3[5] = t3[3], t3[4] = 1 * t3[4] / 3 + 2 * t3[2] / 3, t3[3] = 1 * t3[3] / 3 + 2 * t3[1] / 3, t3[2] = 1 * this.pos[1] / 3 + 2 * t3[2] / 3, t3[1] = 1 * this.pos[0] / 3 + 2 * t3[1] / 3;
            break;
          case "A":
            t3 = (e3 = function(t4, e4) {
              var i3, a3, s3, r2, o2, n2, l2, h2, c2, d2, g2, u2, p2, f2, x2, b2, v2, m2, y2, w2, k2, A2, S2, C2, L2, P2, T2 = Math.abs(e4[1]), M2 = Math.abs(e4[2]), I2 = e4[3] % 360, z2 = e4[4], X2 = e4[5], E2 = e4[6], Y2 = e4[7], F2 = new SVG.Point(t4), R2 = new SVG.Point(E2, Y2), H2 = [];
              if (0 === T2 || 0 === M2 || F2.x === R2.x && F2.y === R2.y)
                return [["C", F2.x, F2.y, R2.x, R2.y, R2.x, R2.y]];
              i3 = new SVG.Point((F2.x - R2.x) / 2, (F2.y - R2.y) / 2).transform(new SVG.Matrix().rotate(I2)), (a3 = i3.x * i3.x / (T2 * T2) + i3.y * i3.y / (M2 * M2)) > 1 && (T2 *= a3 = Math.sqrt(a3), M2 *= a3);
              s3 = new SVG.Matrix().rotate(I2).scale(1 / T2, 1 / M2).rotate(-I2), F2 = F2.transform(s3), R2 = R2.transform(s3), r2 = [R2.x - F2.x, R2.y - F2.y], n2 = r2[0] * r2[0] + r2[1] * r2[1], o2 = Math.sqrt(n2), r2[0] /= o2, r2[1] /= o2, l2 = n2 < 4 ? Math.sqrt(1 - n2 / 4) : 0, z2 === X2 && (l2 *= -1);
              h2 = new SVG.Point((R2.x + F2.x) / 2 + l2 * -r2[1], (R2.y + F2.y) / 2 + l2 * r2[0]), c2 = new SVG.Point(F2.x - h2.x, F2.y - h2.y), d2 = new SVG.Point(R2.x - h2.x, R2.y - h2.y), g2 = Math.acos(c2.x / Math.sqrt(c2.x * c2.x + c2.y * c2.y)), c2.y < 0 && (g2 *= -1);
              u2 = Math.acos(d2.x / Math.sqrt(d2.x * d2.x + d2.y * d2.y)), d2.y < 0 && (u2 *= -1);
              X2 && g2 > u2 && (u2 += 2 * Math.PI);
              !X2 && g2 < u2 && (u2 -= 2 * Math.PI);
              for (f2 = Math.ceil(2 * Math.abs(g2 - u2) / Math.PI), b2 = [], v2 = g2, p2 = (u2 - g2) / f2, x2 = 4 * Math.tan(p2 / 4) / 3, k2 = 0; k2 <= f2; k2++)
                y2 = Math.cos(v2), m2 = Math.sin(v2), w2 = new SVG.Point(h2.x + y2, h2.y + m2), b2[k2] = [new SVG.Point(w2.x + x2 * m2, w2.y - x2 * y2), w2, new SVG.Point(w2.x - x2 * m2, w2.y + x2 * y2)], v2 += p2;
              for (b2[0][0] = b2[0][1].clone(), b2[b2.length - 1][2] = b2[b2.length - 1][1].clone(), s3 = new SVG.Matrix().rotate(I2).scale(T2, M2).rotate(-I2), k2 = 0, A2 = b2.length; k2 < A2; k2++)
                b2[k2][0] = b2[k2][0].transform(s3), b2[k2][1] = b2[k2][1].transform(s3), b2[k2][2] = b2[k2][2].transform(s3);
              for (k2 = 1, A2 = b2.length; k2 < A2; k2++)
                S2 = (w2 = b2[k2 - 1][2]).x, C2 = w2.y, L2 = (w2 = b2[k2][0]).x, P2 = w2.y, E2 = (w2 = b2[k2][1]).x, Y2 = w2.y, H2.push(["C", S2, C2, L2, P2, E2, Y2]);
              return H2;
            }(this.pos, t3))[0];
        }
        return t3[0] = "C", this.pos = [t3[5], t3[6]], this.reflection = [2 * t3[5] - t3[3], 2 * t3[6] - t3[4]], e3;
      }
      function s2(t3, e3) {
        if (false === e3)
          return false;
        for (var i3 = e3, a3 = t3.length; i3 < a3; ++i3)
          if ("M" == t3[i3][0])
            return i3;
        return false;
      }
      SVG.extend(SVG.PathArray, { morph: function(e3) {
        for (var i3 = this.value, a3 = this.parse(e3), r2 = 0, o2 = 0, n2 = false, l2 = false; false !== r2 || false !== o2; ) {
          var h2;
          n2 = s2(i3, false !== r2 && r2 + 1), l2 = s2(a3, false !== o2 && o2 + 1), false === r2 && (r2 = 0 == (h2 = new SVG.PathArray(c2.start).bbox()).height || 0 == h2.width ? i3.push(i3[0]) - 1 : i3.push(["M", h2.x + h2.width / 2, h2.y + h2.height / 2]) - 1), false === o2 && (o2 = 0 == (h2 = new SVG.PathArray(c2.dest).bbox()).height || 0 == h2.width ? a3.push(a3[0]) - 1 : a3.push(["M", h2.x + h2.width / 2, h2.y + h2.height / 2]) - 1);
          var c2 = t2(i3, r2, n2, a3, o2, l2);
          i3 = i3.slice(0, r2).concat(c2.start, false === n2 ? [] : i3.slice(n2)), a3 = a3.slice(0, o2).concat(c2.dest, false === l2 ? [] : a3.slice(l2)), r2 = false !== n2 && r2 + c2.start.length, o2 = false !== l2 && o2 + c2.dest.length;
        }
        return this.value = i3, this.destination = new SVG.PathArray(), this.destination.value = a3, this;
      } });
    }(), /*! svg.draggable.js - v2.2.2 - 2019-01-08
    * https://github.com/svgdotjs/svg.draggable.js
    * Copyright (c) 2019 Wout Fierens; Licensed MIT */
    (function() {
      function t2(t3) {
        t3.remember("_draggable", this), this.el = t3;
      }
      t2.prototype.init = function(t3, e2) {
        var i2 = this;
        this.constraint = t3, this.value = e2, this.el.on("mousedown.drag", function(t4) {
          i2.start(t4);
        }), this.el.on("touchstart.drag", function(t4) {
          i2.start(t4);
        });
      }, t2.prototype.transformPoint = function(t3, e2) {
        var i2 = (t3 = t3 || window.event).changedTouches && t3.changedTouches[0] || t3;
        return this.p.x = i2.clientX - (e2 || 0), this.p.y = i2.clientY, this.p.matrixTransform(this.m);
      }, t2.prototype.getBBox = function() {
        var t3 = this.el.bbox();
        return this.el instanceof SVG.Nested && (t3 = this.el.rbox()), (this.el instanceof SVG.G || this.el instanceof SVG.Use || this.el instanceof SVG.Nested) && (t3.x = this.el.x(), t3.y = this.el.y()), t3;
      }, t2.prototype.start = function(t3) {
        if ("click" != t3.type && "mousedown" != t3.type && "mousemove" != t3.type || 1 == (t3.which || t3.buttons)) {
          var e2 = this;
          if (this.el.fire("beforedrag", { event: t3, handler: this }), !this.el.event().defaultPrevented) {
            t3.preventDefault(), t3.stopPropagation(), this.parent = this.parent || this.el.parent(SVG.Nested) || this.el.parent(SVG.Doc), this.p = this.parent.node.createSVGPoint(), this.m = this.el.node.getScreenCTM().inverse();
            var i2, a2 = this.getBBox();
            if (this.el instanceof SVG.Text)
              switch (i2 = this.el.node.getComputedTextLength(), this.el.attr("text-anchor")) {
                case "middle":
                  i2 /= 2;
                  break;
                case "start":
                  i2 = 0;
              }
            this.startPoints = { point: this.transformPoint(t3, i2), box: a2, transform: this.el.transform() }, SVG.on(window, "mousemove.drag", function(t4) {
              e2.drag(t4);
            }), SVG.on(window, "touchmove.drag", function(t4) {
              e2.drag(t4);
            }), SVG.on(window, "mouseup.drag", function(t4) {
              e2.end(t4);
            }), SVG.on(window, "touchend.drag", function(t4) {
              e2.end(t4);
            }), this.el.fire("dragstart", { event: t3, p: this.startPoints.point, m: this.m, handler: this });
          }
        }
      }, t2.prototype.drag = function(t3) {
        var e2 = this.getBBox(), i2 = this.transformPoint(t3), a2 = this.startPoints.box.x + i2.x - this.startPoints.point.x, s2 = this.startPoints.box.y + i2.y - this.startPoints.point.y, r2 = this.constraint, o2 = i2.x - this.startPoints.point.x, n2 = i2.y - this.startPoints.point.y;
        if (this.el.fire("dragmove", { event: t3, p: i2, m: this.m, handler: this }), this.el.event().defaultPrevented)
          return i2;
        if ("function" == typeof r2) {
          var l2 = r2.call(this.el, a2, s2, this.m);
          "boolean" == typeof l2 && (l2 = { x: l2, y: l2 }), true === l2.x ? this.el.x(a2) : false !== l2.x && this.el.x(l2.x), true === l2.y ? this.el.y(s2) : false !== l2.y && this.el.y(l2.y);
        } else
          "object" == typeof r2 && (null != r2.minX && a2 < r2.minX ? o2 = (a2 = r2.minX) - this.startPoints.box.x : null != r2.maxX && a2 > r2.maxX - e2.width && (o2 = (a2 = r2.maxX - e2.width) - this.startPoints.box.x), null != r2.minY && s2 < r2.minY ? n2 = (s2 = r2.minY) - this.startPoints.box.y : null != r2.maxY && s2 > r2.maxY - e2.height && (n2 = (s2 = r2.maxY - e2.height) - this.startPoints.box.y), null != r2.snapToGrid && (a2 -= a2 % r2.snapToGrid, s2 -= s2 % r2.snapToGrid, o2 -= o2 % r2.snapToGrid, n2 -= n2 % r2.snapToGrid), this.el instanceof SVG.G ? this.el.matrix(this.startPoints.transform).transform({ x: o2, y: n2 }, true) : this.el.move(a2, s2));
        return i2;
      }, t2.prototype.end = function(t3) {
        var e2 = this.drag(t3);
        this.el.fire("dragend", { event: t3, p: e2, m: this.m, handler: this }), SVG.off(window, "mousemove.drag"), SVG.off(window, "touchmove.drag"), SVG.off(window, "mouseup.drag"), SVG.off(window, "touchend.drag");
      }, SVG.extend(SVG.Element, { draggable: function(e2, i2) {
        "function" != typeof e2 && "object" != typeof e2 || (i2 = e2, e2 = true);
        var a2 = this.remember("_draggable") || new t2(this);
        return (e2 = void 0 === e2 || e2) ? a2.init(i2 || {}, e2) : (this.off("mousedown.drag"), this.off("touchstart.drag")), this;
      } });
    }).call(void 0), function() {
      function t2(t3) {
        this.el = t3, t3.remember("_selectHandler", this), this.pointSelection = { isSelected: false }, this.rectSelection = { isSelected: false }, this.pointsList = { lt: [0, 0], rt: ["width", 0], rb: ["width", "height"], lb: [0, "height"], t: ["width", 0], r: ["width", "height"], b: ["width", "height"], l: [0, "height"] }, this.pointCoord = function(t4, e2, i2) {
          var a2 = "string" != typeof t4 ? t4 : e2[t4];
          return i2 ? a2 / 2 : a2;
        }, this.pointCoords = function(t4, e2) {
          var i2 = this.pointsList[t4];
          return { x: this.pointCoord(i2[0], e2, "t" === t4 || "b" === t4), y: this.pointCoord(i2[1], e2, "r" === t4 || "l" === t4) };
        };
      }
      t2.prototype.init = function(t3, e2) {
        var i2 = this.el.bbox();
        this.options = {};
        var a2 = this.el.selectize.defaults.points;
        for (var s2 in this.el.selectize.defaults)
          this.options[s2] = this.el.selectize.defaults[s2], void 0 !== e2[s2] && (this.options[s2] = e2[s2]);
        var r2 = ["points", "pointsExclude"];
        for (var s2 in r2) {
          var o2 = this.options[r2[s2]];
          "string" == typeof o2 ? o2 = o2.length > 0 ? o2.split(/\s*,\s*/i) : [] : "boolean" == typeof o2 && "points" === r2[s2] && (o2 = o2 ? a2 : []), this.options[r2[s2]] = o2;
        }
        this.options.points = [a2, this.options.points].reduce(function(t4, e3) {
          return t4.filter(function(t5) {
            return e3.indexOf(t5) > -1;
          });
        }), this.options.points = [this.options.points, this.options.pointsExclude].reduce(function(t4, e3) {
          return t4.filter(function(t5) {
            return e3.indexOf(t5) < 0;
          });
        }), this.parent = this.el.parent(), this.nested = this.nested || this.parent.group(), this.nested.matrix(new SVG.Matrix(this.el).translate(i2.x, i2.y)), this.options.deepSelect && -1 !== ["line", "polyline", "polygon"].indexOf(this.el.type) ? this.selectPoints(t3) : this.selectRect(t3), this.observe(), this.cleanup();
      }, t2.prototype.selectPoints = function(t3) {
        return this.pointSelection.isSelected = t3, this.pointSelection.set || (this.pointSelection.set = this.parent.set(), this.drawPoints()), this;
      }, t2.prototype.getPointArray = function() {
        var t3 = this.el.bbox();
        return this.el.array().valueOf().map(function(e2) {
          return [e2[0] - t3.x, e2[1] - t3.y];
        });
      }, t2.prototype.drawPoints = function() {
        for (var t3 = this, e2 = this.getPointArray(), i2 = 0, a2 = e2.length; i2 < a2; ++i2) {
          var s2 = /* @__PURE__ */ function(e3) {
            return function(i3) {
              (i3 = i3 || window.event).preventDefault ? i3.preventDefault() : i3.returnValue = false, i3.stopPropagation();
              var a3 = i3.pageX || i3.touches[0].pageX, s3 = i3.pageY || i3.touches[0].pageY;
              t3.el.fire("point", { x: a3, y: s3, i: e3, event: i3 });
            };
          }(i2), r2 = this.drawPoint(e2[i2][0], e2[i2][1]).addClass(this.options.classPoints).addClass(this.options.classPoints + "_point").on("touchstart", s2).on("mousedown", s2);
          this.pointSelection.set.add(r2);
        }
      }, t2.prototype.drawPoint = function(t3, e2) {
        var i2 = this.options.pointType;
        switch (i2) {
          case "circle":
            return this.drawCircle(t3, e2);
          case "rect":
            return this.drawRect(t3, e2);
          default:
            if ("function" == typeof i2)
              return i2.call(this, t3, e2);
            throw new Error("Unknown " + i2 + " point type!");
        }
      }, t2.prototype.drawCircle = function(t3, e2) {
        return this.nested.circle(this.options.pointSize).center(t3, e2);
      }, t2.prototype.drawRect = function(t3, e2) {
        return this.nested.rect(this.options.pointSize, this.options.pointSize).center(t3, e2);
      }, t2.prototype.updatePointSelection = function() {
        var t3 = this.getPointArray();
        this.pointSelection.set.each(function(e2) {
          this.cx() === t3[e2][0] && this.cy() === t3[e2][1] || this.center(t3[e2][0], t3[e2][1]);
        });
      }, t2.prototype.updateRectSelection = function() {
        var t3 = this, e2 = this.el.bbox();
        if (this.rectSelection.set.get(0).attr({ width: e2.width, height: e2.height }), this.options.points.length && this.options.points.map(function(i3, a2) {
          var s2 = t3.pointCoords(i3, e2);
          t3.rectSelection.set.get(a2 + 1).center(s2.x, s2.y);
        }), this.options.rotationPoint) {
          var i2 = this.rectSelection.set.length();
          this.rectSelection.set.get(i2 - 1).center(e2.width / 2, 20);
        }
      }, t2.prototype.selectRect = function(t3) {
        var e2 = this, i2 = this.el.bbox();
        function a2(t4) {
          return function(i3) {
            (i3 = i3 || window.event).preventDefault ? i3.preventDefault() : i3.returnValue = false, i3.stopPropagation();
            var a3 = i3.pageX || i3.touches[0].pageX, s3 = i3.pageY || i3.touches[0].pageY;
            e2.el.fire(t4, { x: a3, y: s3, event: i3 });
          };
        }
        if (this.rectSelection.isSelected = t3, this.rectSelection.set = this.rectSelection.set || this.parent.set(), this.rectSelection.set.get(0) || this.rectSelection.set.add(this.nested.rect(i2.width, i2.height).addClass(this.options.classRect)), this.options.points.length && this.rectSelection.set.length() < 2) {
          this.options.points.map(function(t4, s3) {
            var r3 = e2.pointCoords(t4, i2), o2 = e2.drawPoint(r3.x, r3.y).attr("class", e2.options.classPoints + "_" + t4).on("mousedown", a2(t4)).on("touchstart", a2(t4));
            e2.rectSelection.set.add(o2);
          }), this.rectSelection.set.each(function() {
            this.addClass(e2.options.classPoints);
          });
        }
        if (this.options.rotationPoint && (this.options.points && !this.rectSelection.set.get(9) || !this.options.points && !this.rectSelection.set.get(1))) {
          var s2 = function(t4) {
            (t4 = t4 || window.event).preventDefault ? t4.preventDefault() : t4.returnValue = false, t4.stopPropagation();
            var i3 = t4.pageX || t4.touches[0].pageX, a3 = t4.pageY || t4.touches[0].pageY;
            e2.el.fire("rot", { x: i3, y: a3, event: t4 });
          }, r2 = this.drawPoint(i2.width / 2, 20).attr("class", this.options.classPoints + "_rot").on("touchstart", s2).on("mousedown", s2);
          this.rectSelection.set.add(r2);
        }
      }, t2.prototype.handler = function() {
        var t3 = this.el.bbox();
        this.nested.matrix(new SVG.Matrix(this.el).translate(t3.x, t3.y)), this.rectSelection.isSelected && this.updateRectSelection(), this.pointSelection.isSelected && this.updatePointSelection();
      }, t2.prototype.observe = function() {
        var t3 = this;
        if (MutationObserver)
          if (this.rectSelection.isSelected || this.pointSelection.isSelected)
            this.observerInst = this.observerInst || new MutationObserver(function() {
              t3.handler();
            }), this.observerInst.observe(this.el.node, { attributes: true });
          else
            try {
              this.observerInst.disconnect(), delete this.observerInst;
            } catch (t4) {
            }
        else
          this.el.off("DOMAttrModified.select"), (this.rectSelection.isSelected || this.pointSelection.isSelected) && this.el.on("DOMAttrModified.select", function() {
            t3.handler();
          });
      }, t2.prototype.cleanup = function() {
        !this.rectSelection.isSelected && this.rectSelection.set && (this.rectSelection.set.each(function() {
          this.remove();
        }), this.rectSelection.set.clear(), delete this.rectSelection.set), !this.pointSelection.isSelected && this.pointSelection.set && (this.pointSelection.set.each(function() {
          this.remove();
        }), this.pointSelection.set.clear(), delete this.pointSelection.set), this.pointSelection.isSelected || this.rectSelection.isSelected || (this.nested.remove(), delete this.nested);
      }, SVG.extend(SVG.Element, { selectize: function(e2, i2) {
        return "object" == typeof e2 && (i2 = e2, e2 = true), (this.remember("_selectHandler") || new t2(this)).init(void 0 === e2 || e2, i2 || {}), this;
      } }), SVG.Element.prototype.selectize.defaults = { points: ["lt", "rt", "rb", "lb", "t", "r", "b", "l"], pointsExclude: [], classRect: "svg_select_boundingRect", classPoints: "svg_select_points", pointSize: 7, rotationPoint: true, deepSelect: false, pointType: "circle" };
    }(), function() {
      (function() {
        function t2(t3) {
          t3.remember("_resizeHandler", this), this.el = t3, this.parameters = {}, this.lastUpdateCall = null, this.p = t3.doc().node.createSVGPoint();
        }
        t2.prototype.transformPoint = function(t3, e2, i2) {
          return this.p.x = t3 - (this.offset.x - window.pageXOffset), this.p.y = e2 - (this.offset.y - window.pageYOffset), this.p.matrixTransform(i2 || this.m);
        }, t2.prototype._extractPosition = function(t3) {
          return { x: null != t3.clientX ? t3.clientX : t3.touches[0].clientX, y: null != t3.clientY ? t3.clientY : t3.touches[0].clientY };
        }, t2.prototype.init = function(t3) {
          var e2 = this;
          if (this.stop(), "stop" !== t3) {
            for (var i2 in this.options = {}, this.el.resize.defaults)
              this.options[i2] = this.el.resize.defaults[i2], void 0 !== t3[i2] && (this.options[i2] = t3[i2]);
            this.el.on("lt.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("rt.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("rb.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("lb.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("t.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("r.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("b.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("l.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("rot.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.el.on("point.resize", function(t4) {
              e2.resize(t4 || window.event);
            }), this.update();
          }
        }, t2.prototype.stop = function() {
          return this.el.off("lt.resize"), this.el.off("rt.resize"), this.el.off("rb.resize"), this.el.off("lb.resize"), this.el.off("t.resize"), this.el.off("r.resize"), this.el.off("b.resize"), this.el.off("l.resize"), this.el.off("rot.resize"), this.el.off("point.resize"), this;
        }, t2.prototype.resize = function(t3) {
          var e2 = this;
          this.m = this.el.node.getScreenCTM().inverse(), this.offset = { x: window.pageXOffset, y: window.pageYOffset };
          var i2 = this._extractPosition(t3.detail.event);
          if (this.parameters = { type: this.el.type, p: this.transformPoint(i2.x, i2.y), x: t3.detail.x, y: t3.detail.y, box: this.el.bbox(), rotation: this.el.transform().rotation }, "text" === this.el.type && (this.parameters.fontSize = this.el.attr()["font-size"]), void 0 !== t3.detail.i) {
            var a2 = this.el.array().valueOf();
            this.parameters.i = t3.detail.i, this.parameters.pointCoords = [a2[t3.detail.i][0], a2[t3.detail.i][1]];
          }
          switch (t3.type) {
            case "lt":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3);
                if (this.parameters.box.width - i3[0] > 0 && this.parameters.box.height - i3[1] > 0) {
                  if ("text" === this.parameters.type)
                    return this.el.move(this.parameters.box.x + i3[0], this.parameters.box.y), void this.el.attr("font-size", this.parameters.fontSize - i3[0]);
                  i3 = this.checkAspectRatio(i3), this.el.move(this.parameters.box.x + i3[0], this.parameters.box.y + i3[1]).size(this.parameters.box.width - i3[0], this.parameters.box.height - i3[1]);
                }
              };
              break;
            case "rt":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 2);
                if (this.parameters.box.width + i3[0] > 0 && this.parameters.box.height - i3[1] > 0) {
                  if ("text" === this.parameters.type)
                    return this.el.move(this.parameters.box.x - i3[0], this.parameters.box.y), void this.el.attr("font-size", this.parameters.fontSize + i3[0]);
                  i3 = this.checkAspectRatio(i3, true), this.el.move(this.parameters.box.x, this.parameters.box.y + i3[1]).size(this.parameters.box.width + i3[0], this.parameters.box.height - i3[1]);
                }
              };
              break;
            case "rb":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 0);
                if (this.parameters.box.width + i3[0] > 0 && this.parameters.box.height + i3[1] > 0) {
                  if ("text" === this.parameters.type)
                    return this.el.move(this.parameters.box.x - i3[0], this.parameters.box.y), void this.el.attr("font-size", this.parameters.fontSize + i3[0]);
                  i3 = this.checkAspectRatio(i3), this.el.move(this.parameters.box.x, this.parameters.box.y).size(this.parameters.box.width + i3[0], this.parameters.box.height + i3[1]);
                }
              };
              break;
            case "lb":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 1);
                if (this.parameters.box.width - i3[0] > 0 && this.parameters.box.height + i3[1] > 0) {
                  if ("text" === this.parameters.type)
                    return this.el.move(this.parameters.box.x + i3[0], this.parameters.box.y), void this.el.attr("font-size", this.parameters.fontSize - i3[0]);
                  i3 = this.checkAspectRatio(i3, true), this.el.move(this.parameters.box.x + i3[0], this.parameters.box.y).size(this.parameters.box.width - i3[0], this.parameters.box.height + i3[1]);
                }
              };
              break;
            case "t":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 2);
                if (this.parameters.box.height - i3[1] > 0) {
                  if ("text" === this.parameters.type)
                    return;
                  this.el.move(this.parameters.box.x, this.parameters.box.y + i3[1]).height(this.parameters.box.height - i3[1]);
                }
              };
              break;
            case "r":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 0);
                if (this.parameters.box.width + i3[0] > 0) {
                  if ("text" === this.parameters.type)
                    return;
                  this.el.move(this.parameters.box.x, this.parameters.box.y).width(this.parameters.box.width + i3[0]);
                }
              };
              break;
            case "b":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 0);
                if (this.parameters.box.height + i3[1] > 0) {
                  if ("text" === this.parameters.type)
                    return;
                  this.el.move(this.parameters.box.x, this.parameters.box.y).height(this.parameters.box.height + i3[1]);
                }
              };
              break;
            case "l":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, 1);
                if (this.parameters.box.width - i3[0] > 0) {
                  if ("text" === this.parameters.type)
                    return;
                  this.el.move(this.parameters.box.x + i3[0], this.parameters.box.y).width(this.parameters.box.width - i3[0]);
                }
              };
              break;
            case "rot":
              this.calc = function(t4, e3) {
                var i3 = t4 + this.parameters.p.x, a3 = e3 + this.parameters.p.y, s2 = Math.atan2(this.parameters.p.y - this.parameters.box.y - this.parameters.box.height / 2, this.parameters.p.x - this.parameters.box.x - this.parameters.box.width / 2), r2 = Math.atan2(a3 - this.parameters.box.y - this.parameters.box.height / 2, i3 - this.parameters.box.x - this.parameters.box.width / 2), o2 = this.parameters.rotation + 180 * (r2 - s2) / Math.PI + this.options.snapToAngle / 2;
                this.el.center(this.parameters.box.cx, this.parameters.box.cy).rotate(o2 - o2 % this.options.snapToAngle, this.parameters.box.cx, this.parameters.box.cy);
              };
              break;
            case "point":
              this.calc = function(t4, e3) {
                var i3 = this.snapToGrid(t4, e3, this.parameters.pointCoords[0], this.parameters.pointCoords[1]), a3 = this.el.array().valueOf();
                a3[this.parameters.i][0] = this.parameters.pointCoords[0] + i3[0], a3[this.parameters.i][1] = this.parameters.pointCoords[1] + i3[1], this.el.plot(a3);
              };
          }
          this.el.fire("resizestart", { dx: this.parameters.x, dy: this.parameters.y, event: t3 }), SVG.on(window, "touchmove.resize", function(t4) {
            e2.update(t4 || window.event);
          }), SVG.on(window, "touchend.resize", function() {
            e2.done();
          }), SVG.on(window, "mousemove.resize", function(t4) {
            e2.update(t4 || window.event);
          }), SVG.on(window, "mouseup.resize", function() {
            e2.done();
          });
        }, t2.prototype.update = function(t3) {
          if (t3) {
            var e2 = this._extractPosition(t3), i2 = this.transformPoint(e2.x, e2.y), a2 = i2.x - this.parameters.p.x, s2 = i2.y - this.parameters.p.y;
            this.lastUpdateCall = [a2, s2], this.calc(a2, s2), this.el.fire("resizing", { dx: a2, dy: s2, event: t3 });
          } else
            this.lastUpdateCall && this.calc(this.lastUpdateCall[0], this.lastUpdateCall[1]);
        }, t2.prototype.done = function() {
          this.lastUpdateCall = null, SVG.off(window, "mousemove.resize"), SVG.off(window, "mouseup.resize"), SVG.off(window, "touchmove.resize"), SVG.off(window, "touchend.resize"), this.el.fire("resizedone");
        }, t2.prototype.snapToGrid = function(t3, e2, i2, a2) {
          var s2;
          return void 0 !== a2 ? s2 = [(i2 + t3) % this.options.snapToGrid, (a2 + e2) % this.options.snapToGrid] : (i2 = null == i2 ? 3 : i2, s2 = [(this.parameters.box.x + t3 + (1 & i2 ? 0 : this.parameters.box.width)) % this.options.snapToGrid, (this.parameters.box.y + e2 + (2 & i2 ? 0 : this.parameters.box.height)) % this.options.snapToGrid]), t3 < 0 && (s2[0] -= this.options.snapToGrid), e2 < 0 && (s2[1] -= this.options.snapToGrid), t3 -= Math.abs(s2[0]) < this.options.snapToGrid / 2 ? s2[0] : s2[0] - (t3 < 0 ? -this.options.snapToGrid : this.options.snapToGrid), e2 -= Math.abs(s2[1]) < this.options.snapToGrid / 2 ? s2[1] : s2[1] - (e2 < 0 ? -this.options.snapToGrid : this.options.snapToGrid), this.constraintToBox(t3, e2, i2, a2);
        }, t2.prototype.constraintToBox = function(t3, e2, i2, a2) {
          var s2, r2, o2 = this.options.constraint || {};
          return void 0 !== a2 ? (s2 = i2, r2 = a2) : (s2 = this.parameters.box.x + (1 & i2 ? 0 : this.parameters.box.width), r2 = this.parameters.box.y + (2 & i2 ? 0 : this.parameters.box.height)), void 0 !== o2.minX && s2 + t3 < o2.minX && (t3 = o2.minX - s2), void 0 !== o2.maxX && s2 + t3 > o2.maxX && (t3 = o2.maxX - s2), void 0 !== o2.minY && r2 + e2 < o2.minY && (e2 = o2.minY - r2), void 0 !== o2.maxY && r2 + e2 > o2.maxY && (e2 = o2.maxY - r2), [t3, e2];
        }, t2.prototype.checkAspectRatio = function(t3, e2) {
          if (!this.options.saveAspectRatio)
            return t3;
          var i2 = t3.slice(), a2 = this.parameters.box.width / this.parameters.box.height, s2 = this.parameters.box.width + t3[0], r2 = this.parameters.box.height - t3[1], o2 = s2 / r2;
          return o2 < a2 ? (i2[1] = s2 / a2 - this.parameters.box.height, e2 && (i2[1] = -i2[1])) : o2 > a2 && (i2[0] = this.parameters.box.width - r2 * a2, e2 && (i2[0] = -i2[0])), i2;
        }, SVG.extend(SVG.Element, { resize: function(e2) {
          return (this.remember("_resizeHandler") || new t2(this)).init(e2 || {}), this;
        } }), SVG.Element.prototype.resize.defaults = { snapToAngle: 0.1, snapToGrid: 1, constraint: {}, saveAspectRatio: false };
      }).call(this);
    }();
    !function(t2, e2) {
      void 0 === e2 && (e2 = {});
      var i2 = e2.insertAt;
      if (t2 && "undefined" != typeof document) {
        var a2 = document.head || document.getElementsByTagName("head")[0], s2 = document.createElement("style");
        s2.type = "text/css", "top" === i2 && a2.firstChild ? a2.insertBefore(s2, a2.firstChild) : a2.appendChild(s2), s2.styleSheet ? s2.styleSheet.cssText = t2 : s2.appendChild(document.createTextNode(t2));
      }
    }('.apexcharts-canvas {\n  position: relative;\n  user-select: none;\n  /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */\n}\n\n\n/* scrollbar is not visible by default for legend, hence forcing the visibility */\n.apexcharts-canvas ::-webkit-scrollbar {\n  -webkit-appearance: none;\n  width: 6px;\n}\n\n.apexcharts-canvas ::-webkit-scrollbar-thumb {\n  border-radius: 4px;\n  background-color: rgba(0, 0, 0, .5);\n  box-shadow: 0 0 1px rgba(255, 255, 255, .5);\n  -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);\n}\n\n\n.apexcharts-inner {\n  position: relative;\n}\n\n.apexcharts-text tspan {\n  font-family: inherit;\n}\n\n.legend-mouseover-inactive {\n  transition: 0.15s ease all;\n  opacity: 0.20;\n}\n\n.apexcharts-series-collapsed {\n  opacity: 0;\n}\n\n.apexcharts-tooltip {\n  border-radius: 5px;\n  box-shadow: 2px 2px 6px -4px #999;\n  cursor: default;\n  font-size: 14px;\n  left: 62px;\n  opacity: 0;\n  pointer-events: none;\n  position: absolute;\n  top: 20px;\n  display: flex;\n  flex-direction: column;\n  overflow: hidden;\n  white-space: nowrap;\n  z-index: 12;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-tooltip.apexcharts-active {\n  opacity: 1;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-tooltip.apexcharts-theme-light {\n  border: 1px solid #e3e3e3;\n  background: rgba(255, 255, 255, 0.96);\n}\n\n.apexcharts-tooltip.apexcharts-theme-dark {\n  color: #fff;\n  background: rgba(30, 30, 30, 0.8);\n}\n\n.apexcharts-tooltip * {\n  font-family: inherit;\n}\n\n\n.apexcharts-tooltip-title {\n  padding: 6px;\n  font-size: 15px;\n  margin-bottom: 4px;\n}\n\n.apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {\n  background: #ECEFF1;\n  border-bottom: 1px solid #ddd;\n}\n\n.apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {\n  background: rgba(0, 0, 0, 0.7);\n  border-bottom: 1px solid #333;\n}\n\n.apexcharts-tooltip-text-y-value,\n.apexcharts-tooltip-text-goals-value,\n.apexcharts-tooltip-text-z-value {\n  display: inline-block;\n  font-weight: 600;\n  margin-left: 5px;\n}\n\n.apexcharts-tooltip-text-y-label:empty,\n.apexcharts-tooltip-text-y-value:empty,\n.apexcharts-tooltip-text-goals-label:empty,\n.apexcharts-tooltip-text-goals-value:empty,\n.apexcharts-tooltip-text-z-value:empty {\n  display: none;\n}\n\n.apexcharts-tooltip-text-y-value,\n.apexcharts-tooltip-text-goals-value,\n.apexcharts-tooltip-text-z-value {\n  font-weight: 600;\n}\n\n.apexcharts-tooltip-text-goals-label, \n.apexcharts-tooltip-text-goals-value {\n  padding: 6px 0 5px;\n}\n\n.apexcharts-tooltip-goals-group, \n.apexcharts-tooltip-text-goals-label, \n.apexcharts-tooltip-text-goals-value {\n  display: flex;\n}\n.apexcharts-tooltip-text-goals-label:not(:empty),\n.apexcharts-tooltip-text-goals-value:not(:empty) {\n  margin-top: -6px;\n}\n\n.apexcharts-tooltip-marker {\n  width: 12px;\n  height: 12px;\n  position: relative;\n  top: 0px;\n  margin-right: 10px;\n  border-radius: 50%;\n}\n\n.apexcharts-tooltip-series-group {\n  padding: 0 10px;\n  display: none;\n  text-align: left;\n  justify-content: left;\n  align-items: center;\n}\n\n.apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {\n  opacity: 1;\n}\n\n.apexcharts-tooltip-series-group.apexcharts-active,\n.apexcharts-tooltip-series-group:last-child {\n  padding-bottom: 4px;\n}\n\n.apexcharts-tooltip-series-group-hidden {\n  opacity: 0;\n  height: 0;\n  line-height: 0;\n  padding: 0 !important;\n}\n\n.apexcharts-tooltip-y-group {\n  padding: 6px 0 5px;\n}\n\n.apexcharts-tooltip-box, .apexcharts-custom-tooltip {\n  padding: 4px 8px;\n}\n\n.apexcharts-tooltip-boxPlot {\n  display: flex;\n  flex-direction: column-reverse;\n}\n\n.apexcharts-tooltip-box>div {\n  margin: 4px 0;\n}\n\n.apexcharts-tooltip-box span.value {\n  font-weight: bold;\n}\n\n.apexcharts-tooltip-rangebar {\n  padding: 5px 8px;\n}\n\n.apexcharts-tooltip-rangebar .category {\n  font-weight: 600;\n  color: #777;\n}\n\n.apexcharts-tooltip-rangebar .series-name {\n  font-weight: bold;\n  display: block;\n  margin-bottom: 5px;\n}\n\n.apexcharts-xaxistooltip {\n  opacity: 0;\n  padding: 9px 10px;\n  pointer-events: none;\n  color: #373d3f;\n  font-size: 13px;\n  text-align: center;\n  border-radius: 2px;\n  position: absolute;\n  z-index: 10;\n  background: #ECEFF1;\n  border: 1px solid #90A4AE;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-xaxistooltip.apexcharts-theme-dark {\n  background: rgba(0, 0, 0, 0.7);\n  border: 1px solid rgba(0, 0, 0, 0.5);\n  color: #fff;\n}\n\n.apexcharts-xaxistooltip:after,\n.apexcharts-xaxistooltip:before {\n  left: 50%;\n  border: solid transparent;\n  content: " ";\n  height: 0;\n  width: 0;\n  position: absolute;\n  pointer-events: none;\n}\n\n.apexcharts-xaxistooltip:after {\n  border-color: rgba(236, 239, 241, 0);\n  border-width: 6px;\n  margin-left: -6px;\n}\n\n.apexcharts-xaxistooltip:before {\n  border-color: rgba(144, 164, 174, 0);\n  border-width: 7px;\n  margin-left: -7px;\n}\n\n.apexcharts-xaxistooltip-bottom:after,\n.apexcharts-xaxistooltip-bottom:before {\n  bottom: 100%;\n}\n\n.apexcharts-xaxistooltip-top:after,\n.apexcharts-xaxistooltip-top:before {\n  top: 100%;\n}\n\n.apexcharts-xaxistooltip-bottom:after {\n  border-bottom-color: #ECEFF1;\n}\n\n.apexcharts-xaxistooltip-bottom:before {\n  border-bottom-color: #90A4AE;\n}\n\n.apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {\n  border-bottom-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {\n  border-bottom-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-xaxistooltip-top:after {\n  border-top-color: #ECEFF1\n}\n\n.apexcharts-xaxistooltip-top:before {\n  border-top-color: #90A4AE;\n}\n\n.apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {\n  border-top-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {\n  border-top-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-xaxistooltip.apexcharts-active {\n  opacity: 1;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-yaxistooltip {\n  opacity: 0;\n  padding: 4px 10px;\n  pointer-events: none;\n  color: #373d3f;\n  font-size: 13px;\n  text-align: center;\n  border-radius: 2px;\n  position: absolute;\n  z-index: 10;\n  background: #ECEFF1;\n  border: 1px solid #90A4AE;\n}\n\n.apexcharts-yaxistooltip.apexcharts-theme-dark {\n  background: rgba(0, 0, 0, 0.7);\n  border: 1px solid rgba(0, 0, 0, 0.5);\n  color: #fff;\n}\n\n.apexcharts-yaxistooltip:after,\n.apexcharts-yaxistooltip:before {\n  top: 50%;\n  border: solid transparent;\n  content: " ";\n  height: 0;\n  width: 0;\n  position: absolute;\n  pointer-events: none;\n}\n\n.apexcharts-yaxistooltip:after {\n  border-color: rgba(236, 239, 241, 0);\n  border-width: 6px;\n  margin-top: -6px;\n}\n\n.apexcharts-yaxistooltip:before {\n  border-color: rgba(144, 164, 174, 0);\n  border-width: 7px;\n  margin-top: -7px;\n}\n\n.apexcharts-yaxistooltip-left:after,\n.apexcharts-yaxistooltip-left:before {\n  left: 100%;\n}\n\n.apexcharts-yaxistooltip-right:after,\n.apexcharts-yaxistooltip-right:before {\n  right: 100%;\n}\n\n.apexcharts-yaxistooltip-left:after {\n  border-left-color: #ECEFF1;\n}\n\n.apexcharts-yaxistooltip-left:before {\n  border-left-color: #90A4AE;\n}\n\n.apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {\n  border-left-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {\n  border-left-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-yaxistooltip-right:after {\n  border-right-color: #ECEFF1;\n}\n\n.apexcharts-yaxistooltip-right:before {\n  border-right-color: #90A4AE;\n}\n\n.apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {\n  border-right-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {\n  border-right-color: rgba(0, 0, 0, 0.5);\n}\n\n.apexcharts-yaxistooltip.apexcharts-active {\n  opacity: 1;\n}\n\n.apexcharts-yaxistooltip-hidden {\n  display: none;\n}\n\n.apexcharts-xcrosshairs,\n.apexcharts-ycrosshairs {\n  pointer-events: none;\n  opacity: 0;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-xcrosshairs.apexcharts-active,\n.apexcharts-ycrosshairs.apexcharts-active {\n  opacity: 1;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-ycrosshairs-hidden {\n  opacity: 0;\n}\n\n.apexcharts-selection-rect {\n  cursor: move;\n}\n\n.svg_select_boundingRect, .svg_select_points_rot {\n  pointer-events: none;\n  opacity: 0;\n  visibility: hidden;\n}\n.apexcharts-selection-rect + g .svg_select_boundingRect,\n.apexcharts-selection-rect + g .svg_select_points_rot {\n  opacity: 0;\n  visibility: hidden;\n}\n\n.apexcharts-selection-rect + g .svg_select_points_l,\n.apexcharts-selection-rect + g .svg_select_points_r {\n  cursor: ew-resize;\n  opacity: 1;\n  visibility: visible;\n}\n\n.svg_select_points {\n  fill: #efefef;\n  stroke: #333;\n  rx: 2;\n}\n\n.apexcharts-svg.apexcharts-zoomable.hovering-zoom {\n  cursor: crosshair\n}\n\n.apexcharts-svg.apexcharts-zoomable.hovering-pan {\n  cursor: move\n}\n\n.apexcharts-zoom-icon,\n.apexcharts-zoomin-icon,\n.apexcharts-zoomout-icon,\n.apexcharts-reset-icon,\n.apexcharts-pan-icon,\n.apexcharts-selection-icon,\n.apexcharts-menu-icon,\n.apexcharts-toolbar-custom-icon {\n  cursor: pointer;\n  width: 20px;\n  height: 20px;\n  line-height: 24px;\n  color: #6E8192;\n  text-align: center;\n}\n\n.apexcharts-zoom-icon svg,\n.apexcharts-zoomin-icon svg,\n.apexcharts-zoomout-icon svg,\n.apexcharts-reset-icon svg,\n.apexcharts-menu-icon svg {\n  fill: #6E8192;\n}\n\n.apexcharts-selection-icon svg {\n  fill: #444;\n  transform: scale(0.76)\n}\n\n.apexcharts-theme-dark .apexcharts-zoom-icon svg,\n.apexcharts-theme-dark .apexcharts-zoomin-icon svg,\n.apexcharts-theme-dark .apexcharts-zoomout-icon svg,\n.apexcharts-theme-dark .apexcharts-reset-icon svg,\n.apexcharts-theme-dark .apexcharts-pan-icon svg,\n.apexcharts-theme-dark .apexcharts-selection-icon svg,\n.apexcharts-theme-dark .apexcharts-menu-icon svg,\n.apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {\n  fill: #f3f4f5;\n}\n\n.apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,\n.apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,\n.apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {\n  fill: #008FFB;\n}\n\n.apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,\n.apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,\n.apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,\n.apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,\n.apexcharts-theme-light .apexcharts-reset-icon:hover svg,\n.apexcharts-theme-light .apexcharts-menu-icon:hover svg {\n  fill: #333;\n}\n\n.apexcharts-selection-icon,\n.apexcharts-menu-icon {\n  position: relative;\n}\n\n.apexcharts-reset-icon {\n  margin-left: 5px;\n}\n\n.apexcharts-zoom-icon,\n.apexcharts-reset-icon,\n.apexcharts-menu-icon {\n  transform: scale(0.85);\n}\n\n.apexcharts-zoomin-icon,\n.apexcharts-zoomout-icon {\n  transform: scale(0.7)\n}\n\n.apexcharts-zoomout-icon {\n  margin-right: 3px;\n}\n\n.apexcharts-pan-icon {\n  transform: scale(0.62);\n  position: relative;\n  left: 1px;\n  top: 0px;\n}\n\n.apexcharts-pan-icon svg {\n  fill: #fff;\n  stroke: #6E8192;\n  stroke-width: 2;\n}\n\n.apexcharts-pan-icon.apexcharts-selected svg {\n  stroke: #008FFB;\n}\n\n.apexcharts-pan-icon:not(.apexcharts-selected):hover svg {\n  stroke: #333;\n}\n\n.apexcharts-toolbar {\n  position: absolute;\n  z-index: 11;\n  max-width: 176px;\n  text-align: right;\n  border-radius: 3px;\n  padding: 0px 6px 2px 6px;\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n\n.apexcharts-menu {\n  background: #fff;\n  position: absolute;\n  top: 100%;\n  border: 1px solid #ddd;\n  border-radius: 3px;\n  padding: 3px;\n  right: 10px;\n  opacity: 0;\n  min-width: 110px;\n  transition: 0.15s ease all;\n  pointer-events: none;\n}\n\n.apexcharts-menu.apexcharts-menu-open {\n  opacity: 1;\n  pointer-events: all;\n  transition: 0.15s ease all;\n}\n\n.apexcharts-menu-item {\n  padding: 6px 7px;\n  font-size: 12px;\n  cursor: pointer;\n}\n\n.apexcharts-theme-light .apexcharts-menu-item:hover {\n  background: #eee;\n}\n\n.apexcharts-theme-dark .apexcharts-menu {\n  background: rgba(0, 0, 0, 0.7);\n  color: #fff;\n}\n\n@media screen and (min-width: 768px) {\n  .apexcharts-canvas:hover .apexcharts-toolbar {\n    opacity: 1;\n  }\n}\n\n.apexcharts-datalabel.apexcharts-element-hidden {\n  opacity: 0;\n}\n\n.apexcharts-pie-label,\n.apexcharts-datalabels,\n.apexcharts-datalabel,\n.apexcharts-datalabel-label,\n.apexcharts-datalabel-value {\n  cursor: default;\n  pointer-events: none;\n}\n\n.apexcharts-pie-label-delay {\n  opacity: 0;\n  animation-name: opaque;\n  animation-duration: 0.3s;\n  animation-fill-mode: forwards;\n  animation-timing-function: ease;\n}\n\n.apexcharts-canvas .apexcharts-element-hidden {\n  opacity: 0;\n}\n\n.apexcharts-hide .apexcharts-series-points {\n  opacity: 0;\n}\n\n.apexcharts-gridline,\n.apexcharts-annotation-rect,\n.apexcharts-tooltip .apexcharts-marker,\n.apexcharts-area-series .apexcharts-area,\n.apexcharts-line,\n.apexcharts-zoom-rect,\n.apexcharts-toolbar svg,\n.apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,\n.apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,\n.apexcharts-radar-series path,\n.apexcharts-radar-series polygon {\n  pointer-events: none;\n}\n\n\n/* markers */\n\n.apexcharts-marker {\n  transition: 0.15s ease all;\n}\n\n@keyframes opaque {\n  0% {\n    opacity: 0;\n  }\n  100% {\n    opacity: 1;\n  }\n}\n\n\n/* Resize generated styles */\n\n@keyframes resizeanim {\n  from {\n    opacity: 0;\n  }\n  to {\n    opacity: 0;\n  }\n}\n\n.resize-triggers {\n  animation: 1ms resizeanim;\n  visibility: hidden;\n  opacity: 0;\n}\n\n.resize-triggers,\n.resize-triggers>div,\n.contract-trigger:before {\n  content: " ";\n  display: block;\n  position: absolute;\n  top: 0;\n  left: 0;\n  height: 100%;\n  width: 100%;\n  overflow: hidden;\n}\n\n.resize-triggers>div {\n  background: #eee;\n  overflow: auto;\n}\n\n.contract-trigger:before {\n  width: 200%;\n  height: 200%;\n}'), function() {
      function t2(t3) {
        var e3 = t3.__resizeTriggers__, i3 = e3.firstElementChild, a3 = e3.lastElementChild, s3 = i3 ? i3.firstElementChild : null;
        a3 && (a3.scrollLeft = a3.scrollWidth, a3.scrollTop = a3.scrollHeight), s3 && (s3.style.width = i3.offsetWidth + 1 + "px", s3.style.height = i3.offsetHeight + 1 + "px"), i3 && (i3.scrollLeft = i3.scrollWidth, i3.scrollTop = i3.scrollHeight);
      }
      function e2(e3) {
        var i3 = this;
        t2(this), this.__resizeRAF__ && r2(this.__resizeRAF__), this.__resizeRAF__ = s2(function() {
          (function(t3) {
            return t3.offsetWidth != t3.__resizeLast__.width || t3.offsetHeight != t3.__resizeLast__.height;
          })(i3) && (i3.__resizeLast__.width = i3.offsetWidth, i3.__resizeLast__.height = i3.offsetHeight, i3.__resizeListeners__.forEach(function(t3) {
            t3.call(e3);
          }));
        });
      }
      var i2, a2, s2 = (i2 = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || function(t3) {
        return window.setTimeout(t3, 20);
      }, function(t3) {
        return i2(t3);
      }), r2 = (a2 = window.cancelAnimationFrame || window.mozCancelAnimationFrame || window.webkitCancelAnimationFrame || window.clearTimeout, function(t3) {
        return a2(t3);
      }), o2 = false, n2 = "animationstart", l2 = "Webkit Moz O ms".split(" "), h2 = "webkitAnimationStart animationstart oAnimationStart MSAnimationStart".split(" "), c2 = document.createElement("fakeelement");
      if (void 0 !== c2.style.animationName && (o2 = true), false === o2) {
        for (var d2 = 0; d2 < l2.length; d2++)
          if (void 0 !== c2.style[l2[d2] + "AnimationName"]) {
            n2 = h2[d2];
            break;
          }
      }
      window.addResizeListener = function(i3, a3) {
        i3.__resizeTriggers__ || ("static" == getComputedStyle(i3).position && (i3.style.position = "relative"), i3.__resizeLast__ = {}, i3.__resizeListeners__ = [], (i3.__resizeTriggers__ = document.createElement("div")).className = "resize-triggers", i3.__resizeTriggers__.innerHTML = '<div class="expand-trigger"><div></div></div><div class="contract-trigger"></div>', i3.appendChild(i3.__resizeTriggers__), t2(i3), i3.addEventListener("scroll", e2, true), n2 && i3.__resizeTriggers__.addEventListener(n2, function(e3) {
          "resizeanim" == e3.animationName && t2(i3);
        })), i3.__resizeListeners__.push(a3);
      }, window.removeResizeListener = function(t3, i3) {
        t3 && (t3.__resizeListeners__.splice(t3.__resizeListeners__.indexOf(i3), 1), t3.__resizeListeners__.length || (t3.removeEventListener("scroll", e2), t3.__resizeTriggers__.parentNode && (t3.__resizeTriggers__ = !t3.removeChild(t3.__resizeTriggers__))));
      };
    }(), void 0 === window.Apex && (window.Apex = {});
    var Yt = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "initModules", value: function() {
        this.ctx.publicMethods = ["updateOptions", "updateSeries", "appendData", "appendSeries", "toggleSeries", "showSeries", "hideSeries", "setLocale", "resetSeries", "zoomX", "toggleDataPointSelection", "dataURI", "addXaxisAnnotation", "addYaxisAnnotation", "addPointAnnotation", "clearAnnotations", "removeAnnotation", "paper", "destroy"], this.ctx.eventList = ["click", "mousedown", "mousemove", "mouseleave", "touchstart", "touchmove", "touchleave", "mouseup", "touchend"], this.ctx.animations = new f(this.ctx), this.ctx.axes = new J(this.ctx), this.ctx.core = new Xt(this.ctx.el, this.ctx), this.ctx.config = new H({}), this.ctx.data = new O(this.ctx), this.ctx.grid = new _(this.ctx), this.ctx.graphics = new b(this.ctx), this.ctx.coreUtils = new y(this.ctx), this.ctx.crosshairs = new Q(this.ctx), this.ctx.events = new Z(this.ctx), this.ctx.exports = new V(this.ctx), this.ctx.localization = new $(this.ctx), this.ctx.options = new S(), this.ctx.responsive = new K(this.ctx), this.ctx.series = new z(this.ctx), this.ctx.theme = new tt(this.ctx), this.ctx.formatters = new W(this.ctx), this.ctx.titleSubtitle = new et(this.ctx), this.ctx.legend = new lt(this.ctx), this.ctx.toolbar = new ht(this.ctx), this.ctx.dimensions = new ot(this.ctx), this.ctx.updateHelpers = new Et(this.ctx), this.ctx.zoomPanSelection = new ct(this.ctx), this.ctx.w.globals.tooltip = new bt(this.ctx);
      } }]), t2;
    }();
    var Ft = function() {
      function t2(e2) {
        a(this, t2), this.ctx = e2, this.w = e2.w;
      }
      return r(t2, [{ key: "clear", value: function(t3) {
        var e2 = t3.isUpdating;
        this.ctx.zoomPanSelection && this.ctx.zoomPanSelection.destroy(), this.ctx.toolbar && this.ctx.toolbar.destroy(), this.ctx.animations = null, this.ctx.axes = null, this.ctx.annotations = null, this.ctx.core = null, this.ctx.data = null, this.ctx.grid = null, this.ctx.series = null, this.ctx.responsive = null, this.ctx.theme = null, this.ctx.formatters = null, this.ctx.titleSubtitle = null, this.ctx.legend = null, this.ctx.dimensions = null, this.ctx.options = null, this.ctx.crosshairs = null, this.ctx.zoomPanSelection = null, this.ctx.updateHelpers = null, this.ctx.toolbar = null, this.ctx.localization = null, this.ctx.w.globals.tooltip = null, this.clearDomElements({ isUpdating: e2 });
      } }, { key: "killSVG", value: function(t3) {
        t3.each(function(t4, e2) {
          this.removeClass("*"), this.off(), this.stop();
        }, true), t3.ungroup(), t3.clear();
      } }, { key: "clearDomElements", value: function(t3) {
        var e2 = this, i2 = t3.isUpdating, a2 = this.w.globals.dom.Paper.node;
        a2.parentNode && a2.parentNode.parentNode && !i2 && (a2.parentNode.parentNode.style.minHeight = "unset");
        var s2 = this.w.globals.dom.baseEl;
        s2 && this.ctx.eventList.forEach(function(t4) {
          s2.removeEventListener(t4, e2.ctx.events.documentEvent);
        });
        var r2 = this.w.globals.dom;
        if (null !== this.ctx.el)
          for (; this.ctx.el.firstChild; )
            this.ctx.el.removeChild(this.ctx.el.firstChild);
        this.killSVG(r2.Paper), r2.Paper.remove(), r2.elWrap = null, r2.elGraphical = null, r2.elAnnotations = null, r2.elLegendWrap = null, r2.baseEl = null, r2.elGridRect = null, r2.elGridRectMask = null, r2.elGridRectMarkerMask = null, r2.elForecastMask = null, r2.elNonForecastMask = null, r2.elDefs = null;
      } }]), t2;
    }();
    var Rt = function() {
      function t2(e2, i2) {
        a(this, t2), this.opts = i2, this.ctx = this, this.w = new N(i2).init(), this.el = e2, this.w.globals.cuid = p.randomId(), this.w.globals.chartID = this.w.config.chart.id ? p.escapeString(this.w.config.chart.id) : this.w.globals.cuid, new Yt(this).initModules(), this.create = p.bind(this.create, this), this.windowResizeHandler = this._windowResizeHandler.bind(this), this.parentResizeHandler = this._parentResizeCallback.bind(this);
      }
      return r(t2, [{ key: "render", value: function() {
        var t3 = this;
        return new Promise(function(e2, i2) {
          if (null !== t3.el) {
            void 0 === Apex._chartInstances && (Apex._chartInstances = []), t3.w.config.chart.id && Apex._chartInstances.push({ id: t3.w.globals.chartID, group: t3.w.config.chart.group, chart: t3 }), t3.setLocale(t3.w.config.chart.defaultLocale);
            var a2 = t3.w.config.chart.events.beforeMount;
            "function" == typeof a2 && a2(t3, t3.w), t3.events.fireEvent("beforeMount", [t3, t3.w]), window.addEventListener("resize", t3.windowResizeHandler), window.addResizeListener(t3.el.parentNode, t3.parentResizeHandler);
            var s2 = t3.create(t3.w.config.series, {});
            if (!s2)
              return e2(t3);
            t3.mount(s2).then(function() {
              "function" == typeof t3.w.config.chart.events.mounted && t3.w.config.chart.events.mounted(t3, t3.w), t3.events.fireEvent("mounted", [t3, t3.w]), e2(s2);
            }).catch(function(t4) {
              i2(t4);
            });
          } else
            i2(new Error("Element not found"));
        });
      } }, { key: "create", value: function(t3, e2) {
        var i2 = this.w;
        new Yt(this).initModules();
        var a2 = this.w.globals;
        (a2.noData = false, a2.animationEnded = false, this.responsive.checkResponsiveConfig(e2), i2.config.xaxis.convertedCatToNumeric) && new R(i2.config).convertCatToNumericXaxis(i2.config, this.ctx);
        if (null === this.el)
          return a2.animationEnded = true, null;
        if (this.core.setupElements(), "treemap" === i2.config.chart.type && (i2.config.grid.show = false, i2.config.yaxis[0].show = false), 0 === a2.svgWidth)
          return a2.animationEnded = true, null;
        var s2 = y.checkComboSeries(t3);
        a2.comboCharts = s2.comboCharts, a2.comboBarCount = s2.comboBarCount;
        var r2 = t3.every(function(t4) {
          return t4.data && 0 === t4.data.length;
        });
        (0 === t3.length || r2) && this.series.handleNoData(), this.events.setupEventHandlers(), this.data.parseData(t3), this.theme.init(), new P(this).setGlobalMarkerSize(), this.formatters.setLabelFormatters(), this.titleSubtitle.draw(), a2.noData && a2.collapsedSeries.length !== a2.series.length && !i2.config.legend.showForSingleSeries || this.legend.init(), this.series.hasAllSeriesEqualX(), a2.axisCharts && (this.core.coreCalculations(), "category" !== i2.config.xaxis.type && this.formatters.setLabelFormatters(), this.ctx.toolbar.minX = i2.globals.minX, this.ctx.toolbar.maxX = i2.globals.maxX), this.formatters.heatmapLabelFormatters(), this.dimensions.plotCoords();
        var o2 = this.core.xySettings();
        this.grid.createGridMask();
        var n2 = this.core.plotChartType(t3, o2), l2 = new M(this);
        l2.bringForward(), i2.config.dataLabels.background.enabled && l2.dataLabelsBackground(), this.core.shiftGraphPosition();
        var h2 = { plot: { left: i2.globals.translateX, top: i2.globals.translateY, width: i2.globals.gridWidth, height: i2.globals.gridHeight } };
        return { elGraph: n2, xyRatios: o2, elInner: i2.globals.dom.elGraphical, dimensions: h2 };
      } }, { key: "mount", value: function() {
        var t3 = this, e2 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null, i2 = this, a2 = i2.w;
        return new Promise(function(s2, r2) {
          if (null === i2.el)
            return r2(new Error("Not enough data to display or target element not found"));
          (null === e2 || a2.globals.allSeriesCollapsed) && i2.series.handleNoData(), "treemap" !== a2.config.chart.type && i2.axes.drawAxis(a2.config.chart.type, e2.xyRatios), i2.grid = new _(i2);
          var o2 = i2.grid.drawGrid();
          i2.annotations = new C(i2), i2.annotations.drawImageAnnos(), i2.annotations.drawTextAnnos(), "back" === a2.config.grid.position && o2 && a2.globals.dom.elGraphical.add(o2.el);
          var n2 = new G(t3.ctx), l2 = new q(t3.ctx);
          if (null !== o2 && (n2.xAxisLabelCorrections(o2.xAxisTickWidth), l2.setYAxisTextAlignments(), a2.config.yaxis.map(function(t4, e3) {
            -1 === a2.globals.ignoreYAxisIndexes.indexOf(e3) && l2.yAxisTitleRotate(e3, t4.opposite);
          })), "back" === a2.config.annotations.position && (a2.globals.dom.Paper.add(a2.globals.dom.elAnnotations), i2.annotations.drawAxesAnnotations()), Array.isArray(e2.elGraph))
            for (var h2 = 0; h2 < e2.elGraph.length; h2++)
              a2.globals.dom.elGraphical.add(e2.elGraph[h2]);
          else
            a2.globals.dom.elGraphical.add(e2.elGraph);
          if ("front" === a2.config.grid.position && o2 && a2.globals.dom.elGraphical.add(o2.el), "front" === a2.config.xaxis.crosshairs.position && i2.crosshairs.drawXCrosshairs(), "front" === a2.config.yaxis[0].crosshairs.position && i2.crosshairs.drawYCrosshairs(), "front" === a2.config.annotations.position && (a2.globals.dom.Paper.add(a2.globals.dom.elAnnotations), i2.annotations.drawAxesAnnotations()), !a2.globals.noData) {
            if (a2.config.tooltip.enabled && !a2.globals.noData && i2.w.globals.tooltip.drawTooltip(e2.xyRatios), a2.globals.axisCharts && (a2.globals.isXNumeric || a2.config.xaxis.convertedCatToNumeric || a2.globals.isTimelineBar))
              (a2.config.chart.zoom.enabled || a2.config.chart.selection && a2.config.chart.selection.enabled || a2.config.chart.pan && a2.config.chart.pan.enabled) && i2.zoomPanSelection.init({ xyRatios: e2.xyRatios });
            else {
              var c2 = a2.config.chart.toolbar.tools;
              ["zoom", "zoomin", "zoomout", "selection", "pan", "reset"].forEach(function(t4) {
                c2[t4] = false;
              });
            }
            a2.config.chart.toolbar.show && !a2.globals.allSeriesCollapsed && i2.toolbar.createToolbar();
          }
          a2.globals.memory.methodsToExec.length > 0 && a2.globals.memory.methodsToExec.forEach(function(t4) {
            t4.method(t4.params, false, t4.context);
          }), a2.globals.axisCharts || a2.globals.noData || i2.core.resizeNonAxisCharts(), s2(i2);
        });
      } }, { key: "destroy", value: function() {
        window.removeEventListener("resize", this.windowResizeHandler), window.removeResizeListener(this.el.parentNode, this.parentResizeHandler);
        var t3 = this.w.config.chart.id;
        t3 && Apex._chartInstances.forEach(function(e2, i2) {
          e2.id === p.escapeString(t3) && Apex._chartInstances.splice(i2, 1);
        }), new Ft(this.ctx).clear({ isUpdating: false });
      } }, { key: "updateOptions", value: function(t3) {
        var e2 = this, i2 = arguments.length > 1 && void 0 !== arguments[1] && arguments[1], a2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2], s2 = !(arguments.length > 3 && void 0 !== arguments[3]) || arguments[3], r2 = !(arguments.length > 4 && void 0 !== arguments[4]) || arguments[4], o2 = this.w;
        return o2.globals.selection = void 0, t3.series && (this.series.resetSeries(false, true, false), t3.series.length && t3.series[0].data && (t3.series = t3.series.map(function(t4, i3) {
          return e2.updateHelpers._extendSeries(t4, i3);
        })), this.updateHelpers.revertDefaultAxisMinMax()), t3.xaxis && (t3 = this.updateHelpers.forceXAxisUpdate(t3)), t3.yaxis && (t3 = this.updateHelpers.forceYAxisUpdate(t3)), o2.globals.collapsedSeriesIndices.length > 0 && this.series.clearPreviousPaths(), t3.theme && (t3 = this.theme.updateThemeOptions(t3)), this.updateHelpers._updateOptions(t3, i2, a2, s2, r2);
      } }, { key: "updateSeries", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [], e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2];
        return this.series.resetSeries(false), this.updateHelpers.revertDefaultAxisMinMax(), this.updateHelpers._updateSeries(t3, e2, i2);
      } }, { key: "appendSeries", value: function(t3) {
        var e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2], a2 = this.w.config.series.slice();
        return a2.push(t3), this.series.resetSeries(false), this.updateHelpers.revertDefaultAxisMinMax(), this.updateHelpers._updateSeries(a2, e2, i2);
      } }, { key: "appendData", value: function(t3) {
        var e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = this;
        i2.w.globals.dataChanged = true, i2.series.getPreviousPaths();
        for (var a2 = i2.w.config.series.slice(), s2 = 0; s2 < a2.length; s2++)
          if (null !== t3[s2] && void 0 !== t3[s2])
            for (var r2 = 0; r2 < t3[s2].data.length; r2++)
              a2[s2].data.push(t3[s2].data[r2]);
        return i2.w.config.series = a2, e2 && (i2.w.globals.initialSeries = p.clone(i2.w.config.series)), this.update();
      } }, { key: "update", value: function(t3) {
        var e2 = this;
        return new Promise(function(i2, a2) {
          new Ft(e2.ctx).clear({ isUpdating: true });
          var s2 = e2.create(e2.w.config.series, t3);
          if (!s2)
            return i2(e2);
          e2.mount(s2).then(function() {
            "function" == typeof e2.w.config.chart.events.updated && e2.w.config.chart.events.updated(e2, e2.w), e2.events.fireEvent("updated", [e2, e2.w]), e2.w.globals.isDirty = true, i2(e2);
          }).catch(function(t4) {
            a2(t4);
          });
        });
      } }, { key: "getSyncedCharts", value: function() {
        var t3 = this.getGroupedCharts(), e2 = [this];
        return t3.length && (e2 = [], t3.forEach(function(t4) {
          e2.push(t4);
        })), e2;
      } }, { key: "getGroupedCharts", value: function() {
        var t3 = this;
        return Apex._chartInstances.filter(function(t4) {
          if (t4.group)
            return true;
        }).map(function(e2) {
          return t3.w.config.chart.group === e2.group ? e2.chart : t3;
        });
      } }, { key: "toggleSeries", value: function(t3) {
        return this.series.toggleSeries(t3);
      } }, { key: "showSeries", value: function(t3) {
        this.series.showSeries(t3);
      } }, { key: "hideSeries", value: function(t3) {
        this.series.hideSeries(t3);
      } }, { key: "resetSeries", value: function() {
        var t3 = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0], e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
        this.series.resetSeries(t3, e2);
      } }, { key: "addEventListener", value: function(t3, e2) {
        this.events.addEventListener(t3, e2);
      } }, { key: "removeEventListener", value: function(t3, e2) {
        this.events.removeEventListener(t3, e2);
      } }, { key: "addXaxisAnnotation", value: function(t3) {
        var e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : void 0, a2 = this;
        i2 && (a2 = i2), a2.annotations.addXaxisAnnotationExternal(t3, e2, a2);
      } }, { key: "addYaxisAnnotation", value: function(t3) {
        var e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : void 0, a2 = this;
        i2 && (a2 = i2), a2.annotations.addYaxisAnnotationExternal(t3, e2, a2);
      } }, { key: "addPointAnnotation", value: function(t3) {
        var e2 = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1], i2 = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : void 0, a2 = this;
        i2 && (a2 = i2), a2.annotations.addPointAnnotationExternal(t3, e2, a2);
      } }, { key: "clearAnnotations", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : void 0, e2 = this;
        t3 && (e2 = t3), e2.annotations.clearAnnotations(e2);
      } }, { key: "removeAnnotation", value: function(t3) {
        var e2 = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : void 0, i2 = this;
        e2 && (i2 = e2), i2.annotations.removeAnnotation(i2, t3);
      } }, { key: "getChartArea", value: function() {
        return this.w.globals.dom.baseEl.querySelector(".apexcharts-inner");
      } }, { key: "getSeriesTotalXRange", value: function(t3, e2) {
        return this.coreUtils.getSeriesTotalsXRange(t3, e2);
      } }, { key: "getHighestValueInSeries", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0, e2 = new U(this.ctx);
        return e2.getMinYMaxY(t3).highestY;
      } }, { key: "getLowestValueInSeries", value: function() {
        var t3 = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0, e2 = new U(this.ctx);
        return e2.getMinYMaxY(t3).lowestY;
      } }, { key: "getSeriesTotal", value: function() {
        return this.w.globals.seriesTotals;
      } }, { key: "toggleDataPointSelection", value: function(t3, e2) {
        return this.updateHelpers.toggleDataPointSelection(t3, e2);
      } }, { key: "zoomX", value: function(t3, e2) {
        this.ctx.toolbar.zoomUpdateOptions(t3, e2);
      } }, { key: "setLocale", value: function(t3) {
        this.localization.setCurrentLocaleValues(t3);
      } }, { key: "dataURI", value: function(t3) {
        return new V(this.ctx).dataURI(t3);
      } }, { key: "paper", value: function() {
        return this.w.globals.dom.Paper;
      } }, { key: "_parentResizeCallback", value: function() {
        this.w.globals.animationEnded && this.w.config.chart.redrawOnParentResize && this._windowResize();
      } }, { key: "_windowResize", value: function() {
        var t3 = this;
        clearTimeout(this.w.globals.resizeTimer), this.w.globals.resizeTimer = window.setTimeout(function() {
          t3.w.globals.resized = true, t3.w.globals.dataChanged = false, t3.ctx.update();
        }, 150);
      } }, { key: "_windowResizeHandler", value: function() {
        var t3 = this.w.config.chart.redrawOnWindowResize;
        "function" == typeof t3 && (t3 = t3()), t3 && this._windowResize();
      } }], [{ key: "getChartByID", value: function(t3) {
        var e2 = p.escapeString(t3), i2 = Apex._chartInstances.filter(function(t4) {
          return t4.id === e2;
        })[0];
        return i2 && i2.chart;
      } }, { key: "initOnLoad", value: function() {
        for (var e2 = document.querySelectorAll("[data-apexcharts]"), i2 = 0; i2 < e2.length; i2++) {
          new t2(e2[i2], JSON.parse(e2[i2].getAttribute("data-options"))).render();
        }
      } }, { key: "exec", value: function(t3, e2) {
        var i2 = this.getChartByID(t3);
        if (i2) {
          i2.w.globals.isExecCalled = true;
          var a2 = null;
          if (-1 !== i2.publicMethods.indexOf(e2)) {
            for (var s2 = arguments.length, r2 = new Array(s2 > 2 ? s2 - 2 : 0), o2 = 2; o2 < s2; o2++)
              r2[o2 - 2] = arguments[o2];
            a2 = i2[e2].apply(i2, r2);
          }
          return a2;
        }
      } }, { key: "merge", value: function(t3, e2) {
        return p.extend(t3, e2);
      } }]), t2;
    }();
    module.exports = Rt;
  }
});
export default require_apexcharts_common();
/*! Bundled license information:

apexcharts-clevision/dist/apexcharts.common.js:
  (*!
   * ApexCharts v3.28.3
   * (c) 2018-2022 ApexCharts
   * Released under the MIT License.
   *)
*/
//# sourceMappingURL=apexcharts-clevision.js.map
