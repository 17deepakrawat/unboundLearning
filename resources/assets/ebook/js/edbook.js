!(function (modules) {
  function __webpack_require__(moduleId) {
    if (installedModules[moduleId]) return installedModules[moduleId].exports;
    var module = (installedModules[moduleId] = {
      i: moduleId,
      l: !1,
      exports: {},
    });
    return (
      modules[moduleId].call(
        module.exports,
        module,
        module.exports,
        __webpack_require__
      ),
      (module.l = !0),
      module.exports
    );
  }
  var installedModules = {};
  (__webpack_require__.m = modules),
    (__webpack_require__.c = installedModules),
    (__webpack_require__.i = function (value) {
      return value;
    }),
    (__webpack_require__.d = function (exports, name, getter) {
      __webpack_require__.o(exports, name) ||
        Object.defineProperty(exports, name, {
          configurable: !1,
          enumerable: !0,
          get: getter,
        });
    }),
    (__webpack_require__.n = function (module) {
      var getter =
        module && module.__esModule
          ? function () {
              return module.default;
            }
          : function () {
              return module;
            };
      return __webpack_require__.d(getter, "a", getter), getter;
    }),
    (__webpack_require__.o = function (object, property) {
      return Object.prototype.hasOwnProperty.call(object, property);
    }),
    (__webpack_require__.p = ""),
    __webpack_require__((__webpack_require__.s = 76));
})([
  function (module, exports, __webpack_require__) {
    "use strict";
    exports.__esModule = !0;
    var _$ = window.jQuery,
      _html2canvas = window.html2canvas,
      _THREE = window.THREE,
      _React = window.React,
      _ReactDOM = window.ReactDOM,
      _PDFJS = window.pdfjsLib,
      _tr = function (s) {
        return ((window.iberezansky || {}).tr && window.iberezansky.tr(s)) || s;
      };
    (exports.$ = _$),
      (exports.html2canvas = _html2canvas),
      (exports.THREE = _THREE),
      (exports.React = _React),
      (exports.ReactDOM = _ReactDOM),
      (exports.PDFJS = _PDFJS),
      (exports.tr = _tr);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _$ = window.jQuery,
      _html2canvas = window.html2canvas,
      _THREE = window.THREE,
      _PDFJS = window.PDFJS,
      _tr = function (s) {
        return ((window.iberezansky || {}).tr && window.iberezansky.tr(s)) || s;
      };
    window.FB3D_LOCALE &&
      (window.iberezansky = _extends({}, window.iberezansky, {
        tr: function (s) {
          return (FB3D_LOCALE.dictionary || {})[s] || s;
        },
      })),
      (exports.$ = _$),
      (exports.html2canvas = _html2canvas),
      (exports.THREE = _THREE),
      (exports.PDFJS = _PDFJS),
      (exports.tr = _tr);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var BaseMathUtils = (function () {
      function BaseMathUtils() {
        _classCallCheck(this, BaseMathUtils);
      }
      return (
        (BaseMathUtils.sum1 = function (ka, a, kb, b) {
          return [ka * a[0] + kb * b[0]];
        }),
        (BaseMathUtils.sum2 = function (ka, a, kb, b) {
          return [ka * a[0] + kb * b[0], ka * a[1] + kb * b[1]];
        }),
        (BaseMathUtils.sum3 = function (ka, a, kb, b) {
          return [
            ka * a[0] + kb * b[0],
            ka * a[1] + kb * b[1],
            ka * a[2] + kb * b[2],
          ];
        }),
        (BaseMathUtils.sum4 = function (ka, a, kb, b) {
          return [
            ka * a[0] + kb * b[0],
            ka * a[1] + kb * b[1],
            ka * a[2] + kb * b[2],
            ka * a[3] + kb * b[3],
          ];
        }),
        (BaseMathUtils.rk4 = function (dy, t, dt, y) {
          var sum =
              arguments.length > 4 && void 0 !== arguments[4]
                ? arguments[4]
                : BaseMathUtils.sum[y.length - 1],
            k1 = dy(t, y),
            k2 = dy(t + dt / 2, sum(1, y, dt / 2, k1)),
            k3 = dy(t + dt / 2, sum(1, y, dt / 2, k2)),
            k4 = dy(t + dt, sum(1, y, dt, k3));
          return sum(
            1,
            y,
            dt / 6,
            sum(1, sum(1, k1, 2, k2), 1, sum(2, k3, 1, k4))
          );
        }),
        (BaseMathUtils.extrapolateLinear = function (x, y, xi) {
          return y[0] + ((y[1] - y[0]) / (x[1] - x[0])) * (xi - x[0]);
        }),
        (BaseMathUtils.interpolateLinear = function (x, y, xi) {
          return (
            x[0] > x[1] && ((x = x.reverse()), (y = y.reverse())),
            xi < x[0]
              ? y[0]
              : xi > x[1]
              ? y[1]
              : BaseMathUtils.extrapolateLinear(x, y, xi)
          );
        }),
        (BaseMathUtils.calcScale = function (srcW, srcH, dstW, dstH) {
          return dstW / srcW;
        }),
        (BaseMathUtils.mulM = function (a, b) {
          for (var r = [], i = 0; i < a.length; ++i) {
            r.push([]);
            for (var j = 0; j < b[0].length; ++j) {
              r[i][j] = 0;
              for (var k = 0; k < b.length; ++k) r[i][j] += a[i][k] * b[k][j];
            }
          }
          return r;
        }),
        (BaseMathUtils.transM = function (m) {
          for (var r = [], i = 0; i < m.length; ++i)
            for (var j = 0; j < m[0].length; ++j)
              r[j] || (r[j] = []), (r[j][i] = m[i][j]);
          return r;
        }),
        (BaseMathUtils.mat = function (data) {
          for (
            var s = 0,
              _iterator = data,
              _isArray = Array.isArray(_iterator),
              _i = 0,
              _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
            ;

          ) {
            var _ref;
            if (_isArray) {
              if (_i >= _iterator.length) break;
              _ref = _iterator[_i++];
            } else {
              if (((_i = _iterator.next()), _i.done)) break;
              _ref = _i.value;
            }
            s += _ref;
          }
          return s / data.length;
        }),
        (BaseMathUtils.disp = function (data) {
          for (
            var M = BaseMathUtils.mat(data),
              s = 0,
              _iterator2 = data,
              _isArray2 = Array.isArray(_iterator2),
              _i2 = 0,
              _iterator2 = _isArray2
                ? _iterator2
                : _iterator2[Symbol.iterator]();
            ;

          ) {
            var _ref2;
            if (_isArray2) {
              if (_i2 >= _iterator2.length) break;
              _ref2 = _iterator2[_i2++];
            } else {
              if (((_i2 = _iterator2.next()), _i2.done)) break;
              _ref2 = _i2.value;
            }
            var x = _ref2;
            s += (x - M) * (x - M);
          }
          return s / data.length;
        }),
        (BaseMathUtils.predict1 = function (data, num) {
          var r = [],
            l = data.length;
          if (BaseMathUtils.disp(data) < l && l > 1) {
            for (var am = [], bm = [], i = 0; i < l; ++i)
              am.push([i, 1]), bm.push([data[i]]);
            for (
              var ta = BaseMathUtils.transM(am),
                a = BaseMathUtils.mulM(ta, am),
                b = BaseMathUtils.mulM(ta, bm),
                d = a[0][0] * a[1][1] - a[1][0] * a[0][1],
                p = [
                  -(a[0][1] * b[1][0] - b[0][0] * a[1][1]) / d,
                  (a[0][0] * b[1][0] - a[1][0] * b[0][0]) / d,
                ],
                _i3 = 0;
              _i3 < num;
              ++_i3
            ) {
              var v = Math.round(p[0] * (_i3 + l) + p[1]);
              -1 === r.indexOf(v) && r.push(v);
            }
          }
          return r;
        }),
        (BaseMathUtils.predict = function (data, num) {
          for (var r = [], l = data.length, sgns = 0, i = 0; i < l - 1; ++i)
            sgns += Math.sign(data[i + 1] - data[i]);
          sgns = Math.abs(sgns) <= (l - 1) % 2 ? -1 : Math.sign(sgns);
          for (var _i4 = 0, cur = data[l - 1]; _i4 < num && cur > 0; ++_i4)
            (cur += sgns), r.push(cur);
          return r;
        }),
        (BaseMathUtils.getUnique = function () {
          return Math.ceil(1e9 * Math.random());
        }),
        (BaseMathUtils.setSplinePoints = function (spline, ps) {
          spline.points.length !== ps.x.length &&
            console.warn("setSplinePoints: bad points");
          for (var i = 0; i < spline.points.length; ++i)
            spline.points[i].set(ps.x[i], ps.y[i], ps.z ? ps.z[i] : 0);
        }),
        (BaseMathUtils.mapl2L = function (ls, len, n, f) {
          for (
            var dL = len / (n - 1), L = 0, i = 0, d = ls[0];
            i < ls.length - 1 && L < len + 0.1 * dL;
            ++i, d += ls[i]
          )
            Math.abs(L - d) < Math.abs(L - d - ls[i + 1]) &&
              (f(i, L), (L += dL));
          L < len + 0.1 * dL && console.warn("mapl2L: ls is not enought");
        }),
        (BaseMathUtils.det2 = function (a, b, c, d) {
          return a * d - b * c;
        }),
        (BaseMathUtils.solve2Lin = function (a1, b1, a2, b2) {
          var res = void 0,
            d = BaseMathUtils.det2(a1[0], a1[1], a2[0], a2[1]);
          if (Math.abs(d) > BaseMathUtils.eps) {
            res = {
              x: BaseMathUtils.det2(b1, a1[1], b2, a2[1]) / d,
              y: BaseMathUtils.det2(a1[0], b1, a2[0], b2) / d,
            };
          }
          return res;
        }),
        (BaseMathUtils.isInsidePoly = function (ps, p) {
          for (var done = !1, ct = void 0, i = 0; i < ps.length; ++i)
            if (BaseMathUtils.v2dist(p, ps[i]) < BaseMathUtils.eps) {
              (ct = 1), (done = !0);
              break;
            }
          for (; !done; ) {
            (done = !0), (ct = 0);
            for (
              var np = {
                  x: p.x + Math.random() - 0.5,
                  y: p.y + Math.random() - 0.5,
                },
                rn = { x: np.x - p.x, y: np.y - p.y },
                a1 = [rn.y, -rn.x],
                b1 = p.x * rn.y - p.y * rn.x,
                _i5 = 0;
              _i5 < ps.length;
              ++_i5
            ) {
              var p0 = ps[_i5],
                p1 = ps[(_i5 + 1) % ps.length],
                n = { x: p1.x - p0.x, y: p1.y - p0.y },
                a2 = [n.y, -n.x],
                b2 = p0.x * n.y - p0.y * n.x,
                ip = BaseMathUtils.solve2Lin(a1, b1, a2, b2);
              if (ip) {
                if (
                  BaseMathUtils.v2dist(ip, p0) < BaseMathUtils.eps ||
                  BaseMathUtils.v2dist(ip, p1) < BaseMathUtils.eps
                ) {
                  done = !1;
                  break;
                }
                if (
                  ip.x > Math.min(p0.x, p1.x) - BaseMathUtils.eps &&
                  ip.x < Math.max(p0.x, p1.x) + BaseMathUtils.eps &&
                  ip.y > Math.min(p0.y, p1.y) - BaseMathUtils.eps &&
                  ip.y < Math.max(p0.y, p1.y) + BaseMathUtils.eps
                ) {
                  if (BaseMathUtils.v2dist(ip, p) < BaseMathUtils.eps) {
                    ct = 1;
                    break;
                  }
                  var tn = { x: ip.x - p.x, y: ip.y - p.y };
                  ct += tn.x * rn.x + tn.y * rn.y > 0;
                }
              }
            }
          }
          return ct % 2;
        }),
        (BaseMathUtils.isInsideConvPoly = function (ps, p) {
          for (var sg = [0, 0], i = 0; i < ps.length; ++i) {
            var p0 = ps[i],
              p1 = ps[(i + 1) % ps.length],
              a = { x: p0.x - p.x, y: p0.y - p.y },
              b = { x: p1.x - p.x, y: p1.y - p.y };
            ++sg[(a.x * b.y - a.y * b.x < 0) + 0];
          }
          return ~sg.indexOf(ps.length);
        }),
        (BaseMathUtils.v2len = function (v2) {
          return Math.sqrt(v2.x * v2.x + v2.y * v2.y);
        }),
        (BaseMathUtils.v2dist = function (v21, v22) {
          return BaseMathUtils.v2len({ x: v22.x - v21.x, y: v22.y - v21.y });
        }),
        (BaseMathUtils.computeSquare = function (ps) {
          for (var a = [], p = 0, i = 0; i < ps.length; ++i)
            a.push(BaseMathUtils.v2dist(ps[i], ps[(i + 1) % ps.length])),
              (p += 0.5 * a[i]);
          return Math.sqrt(p * (p - a[0]) * (p - a[1]) * (p - a[2]));
        }),
        (BaseMathUtils.computeInterpCoefs = function (tri, p) {
          for (
            var s = BaseMathUtils.computeSquare(tri),
              coefs = [],
              l = tri.length,
              i = 0;
            i < l;
            ++i
          )
            coefs[i] =
              BaseMathUtils.computeSquare([
                p,
                tri[(i + 1) % l],
                tri[(i + 2) % l],
              ]) / s;
          return coefs;
        }),
        BaseMathUtils
      );
    })();
    (BaseMathUtils.sum = [
      BaseMathUtils.sum1,
      BaseMathUtils.sum2,
      BaseMathUtils.sum3,
      BaseMathUtils.sum4,
    ]),
      (BaseMathUtils.eps = 1e-4),
      (exports.default = BaseMathUtils);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var Utils = (function () {
      function Utils() {
        _classCallCheck(this, Utils);
      }
      return (
        (Utils.normalizeUrl = function (url) {
          function split(s) {
            return s.replace(/\\/g, "/").split("/");
          }
          var base = split(window.location.href);
          return (
            (url = split(url)),
            base[2] === url[2] && (url[0] = base[0]),
            url.join("/")
          );
        }),
        (Utils._escapeHTMLclb = function (c) {
          return Utils._escapeHTMLchars[c] || c;
        }),
        (Utils.escapeHTML = function (s) {
          return s.replace(/[&<>]/g, Utils._escapeHTMLclb);
        }),
        (Utils.extends = function (der, base) {
          for (var name in base)
            der.hasOwnProperty(name) || (der[name] = base[name]);
        }),
        (Utils.defaultCmp = function (a, b) {
          return a - b;
        }),
        (Utils.lowerBound = function (a, x, cmp) {
          cmp = cmp || Utils.defaultCmp;
          for (var l = 0, h = a.length - 1; h - l > 1; ) {
            var mid = Math.floor((l + h) / 2);
            cmp(x, a[mid]) < 0 ? (h = mid) : (l = mid);
          }
          return cmp(x, a[h]) >= 0 ? h : l;
        }),
        Utils
      );
    })();
    (Utils.MOBILE_DIAG = 11),
      (Utils._escapeHTMLchars = { "&": "&amp;", "<": "&lt;", ">": "&gt;" }),
      (exports.default = Utils);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var GraphUtils = (function () {
      function GraphUtils() {
        _classCallCheck(this, GraphUtils);
      }
      return (
        (GraphUtils.createCanvas = function (width, height) {
          var c = document.createElement("canvas");
          return width && (c.width = width), height && (c.height = height), c;
        }),
        (GraphUtils.extrapolateLinear = function (x, y, xi) {
          return y[0] + ((y[1] - y[0]) / (x[1] - x[0])) * (xi - x[0]);
        }),
        (GraphUtils.interpolate01 = function (y1, y2, t) {
          return GraphUtils.extrapolateLinear([0, 1], [y1, y2], t);
        }),
        (GraphUtils.getColorBytes = function (color) {
          return [(color >> 16) & 255, (color >> 8) & 255, 255 & color];
        }),
        (GraphUtils.inverseColor = function (color) {
          var t =
              arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : 1,
            bs = GraphUtils.getColorBytes(color),
            ibs = [255 - bs[0], 255 - bs[1], 255 - bs[2]],
            nbs = [
              Math.round(GraphUtils.interpolate01(bs[0], ibs[0], t)),
              Math.round(GraphUtils.interpolate01(bs[1], ibs[1], t)),
              Math.round(GraphUtils.interpolate01(bs[2], ibs[2], t)),
            ];
          return GraphUtils.bytes2Color(nbs);
        }),
        (GraphUtils.color2Rgba = function (color, a) {
          return GraphUtils.bytes2Rgba(GraphUtils.getColorBytes(color), a);
        }),
        (GraphUtils.bytes2Rgba = function (bs, a) {
          return "rgba(" + bs.join(",") + "," + a + ")";
        }),
        (GraphUtils.bytes2Color = function (bs) {
          return bs[2] | (bs[1] << 8) | (bs[0] << 16);
        }),
        GraphUtils
      );
    })();
    exports.default = GraphUtils;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _BaseMathUtils2 = __webpack_require__(2),
      _BaseMathUtils3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_BaseMathUtils2),
      MathUtils = (function (_BaseMathUtils) {
        function MathUtils() {
          return (
            _classCallCheck(this, MathUtils),
            _possibleConstructorReturn(
              this,
              _BaseMathUtils.apply(this, arguments)
            )
          );
        }
        return (
          _inherits(MathUtils, _BaseMathUtils),
          (MathUtils.splitSpline = function (spline, N) {
            for (var o = { len: 0, ls: [0] }, dl = 1 / N, i = 0; i <= N; ++i) {
              var p = spline.getPoint(i * dl);
              if (i) {
                var d = MathUtils.v1.distanceTo(p);
                (o.len += d), o.ls.push(d);
              }
              MathUtils.v1.copy(p);
            }
            return o;
          }),
          (MathUtils.getLinearIndeces = function (spline, n) {
            for (var ls = [0], l = 0, i = 0; i <= 5e3; ++i) {
              var p = spline.getPoint(2e-4 * i);
              if (i) {
                var d = MathUtils.v1.distanceTo(p);
                (l += d), ls.push(d);
              }
              MathUtils.v1.copy(p);
            }
            ls.push(1e7);
            for (
              var res = [], dl = l / (n - 1), _i = 0, L = 0, _d = ls[0];
              _i < ls.length - 1;
              ++_i, _d += ls[_i]
            )
              Math.abs(L - _d) < Math.abs(L - _d - ls[_i + 1]) &&
                (res.push(2e-4 * _i), (L += dl));
            return res;
          }),
          (MathUtils.refinePoly = function (poly, maxDl) {
            for (var res = [], i = 0; i < poly.length; ++i) {
              var p0 = poly[i],
                p1 = poly[(i + 1) % poly.length],
                l = _BaseMathUtils3.default.v2dist(p0, p1),
                n = Math.ceil(l / maxDl),
                dl = l / n;
              res.push(p0);
              for (var j = 1; j < n; ++j)
                res.push(
                  new _libs.THREE.Vector2(
                    p0.x + (j * dl * (p1.x - p0.x)) / l,
                    p0.y + (j * dl * (p1.y - p0.y)) / l
                  )
                );
            }
            return res;
          }),
          MathUtils
        );
      })(_BaseMathUtils3.default);
    (MathUtils.v1 = new _libs.THREE.Vector3()), (exports.default = MathUtils);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _GraphUtils = __webpack_require__(4),
      _GraphUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_GraphUtils),
      ImageBase = (function () {
        function ImageBase(context, width, height, color) {
          _classCallCheck(this, ImageBase),
            (this.renderPause = !1),
            (this.context = context),
            (this.wnd = context.wnd),
            (this.doc = context.doc),
            (this.element = context.element || context.doc.body),
            (this.c = context.renderCanvas || ImageBase.renderCanvas),
            (this.ctx = context.renderCanvasCtx || ImageBase.renderCanvasCtx),
            (this.resW = this.width = width),
            (this.resH = this.height = height),
            (this.color = color);
        }
        return (
          (ImageBase.prototype.setRenderCanvas = function (c, ctx) {
            (this.c = c), (this.ctx = ctx);
          }),
          (ImageBase.prototype.setResolution = function (res) {
            var k = res.width / this.resW;
            (this.resW = res.width), (this.resH = k * this.resH);
          }),
          (ImageBase.prototype.dispose = function () {}),
          (ImageBase.prototype.renderBlankPage = function () {
            this.ctx.beginPath(),
              (this.ctx.fillStyle = _GraphUtils2.default.color2Rgba(
                this.color,
                1
              )),
              this.ctx.rect(0, 0, this.c.width, this.c.height),
              this.ctx.fill();
          }),
          (ImageBase.prototype.setRenderPause = function (renderPause) {
            (this.renderPause = renderPause),
              !renderPause &&
                this.continueRender &&
                (this.continueRender(), delete this.continueRender);
          }),
          (ImageBase.prototype.cancelRender = function () {
            this.renderTask &&
              this.renderTask.cancel &&
              (this.renderTask.cancel(), delete this.renderTask);
          }),
          (ImageBase.prototype.renderImage = function (image) {
            this.pushCtx(),
              this.ctx.clearRect(0, 0, this.c.width, this.c.height),
              this.ctx.drawImage(image, 0, 0),
              this.popCtx();
          }),
          (ImageBase.prototype.normToConv = function (p) {
            return { x: p.x * this.c.width, y: (1 - p.y) * this.c.height };
          }),
          (ImageBase.prototype.renderHit = function (poly) {
            var ctx = this.ctx;
            (ctx.fillStyle = "rgba(255,255,0,0.4)"), ctx.beginPath();
            var p = this.normToConv(poly[0]);
            ctx.moveTo(p.x, p.y);
            for (var i = 1; i < poly.length; ++i)
              (p = this.normToConv(poly[i])), ctx.lineTo(p.x, p.y);
            ctx.closePath(), ctx.fill();
          }),
          (ImageBase.prototype.pushCtx = function () {
            return (
              Math.abs(this.resW - this.c.width) >= 1 &&
                (this.c.width = Math.ceil(this.resW)),
              Math.abs(this.resH - this.c.height) >= 1 &&
                (this.c.height = Math.ceil(this.resH)),
              this.ctx.save(),
              this.ctx.scale(
                this.c.width / this.width,
                this.c.height / this.height
              ),
              this.ctx
            );
          }),
          (ImageBase.prototype.popCtx = function () {
            this.ctx.restore();
          }),
          (ImageBase.prototype.renderNotFoundPage = function () {
            this.renderBlankPage();
          }),
          (ImageBase.prototype.finishRender = function () {
            var canceled =
              arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
            this.onChange && this.onChange(this.c, canceled);
          }),
          (ImageBase.prototype.finishLoad = function () {
            this.onLoad ? this.onLoad() : this.startRender();
          }),
          (ImageBase.prototype.getSimulatedDoc = function () {}),
          ImageBase
        );
      })();
    (ImageBase.renderCanvas = _GraphUtils2.default.createCanvas()),
      (ImageBase.renderCanvasCtx = ImageBase.renderCanvas.getContext("2d")),
      (exports.default = ImageBase);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0),
      EventConverter = (function () {
        function EventConverter(wnd, doc) {
          _classCallCheck(this, EventConverter),
            (this.wnd = wnd),
            (this.doc = doc),
            (this.enabled = !0);
        }
        return (
          (EventConverter.prototype.setEnable = function (vl) {
            vl ||
              (this.mCapObject &&
                (this.notify(
                  this.mCapObject,
                  _libs.$.Event("mouseup"),
                  "mouseup"
                ),
                (this.mCapObject = void 0)),
              this.mHovObject &&
                (this.notify(
                  this.mHovObject,
                  _libs.$.Event("mouseout"),
                  "mouseout"
                ),
                (this.mHovObject = void 0))),
              (this.enabled = vl);
          }),
          (EventConverter.prototype.getCallback = function (object) {}),
          (EventConverter.prototype.notify = function (object, e, type) {
            var callback = this.getCallback(object);
            if (callback) {
              var props = _extends({}, e, { type: type, view: this.wnd });
              callback(_libs.$.Event(type, props), object);
            }
          }),
          (EventConverter.prototype.convert = function (e, data) {
            if (this.enabled) {
              this.filter && (e = this.filter(this.element, e));
              var object = this.getObject(e, data);
              (~e.type.indexOf("touch")
                ? this.convertTouch(e, data, object)
                : this.convertMouse(e, data, object)) &&
                object &&
                this.notify(object, e, e.type);
            }
          }),
          (EventConverter.prototype.convertTouch = function (e, data, object) {
            var notify = !0;
            switch (e.type) {
              case "touchstart":
                this.tCapObject && this.notify(this.tCapObject, e, "touchend"),
                  (this.tCapObject = object);
                break;
              case "touchend":
                this.tCapObject && !this.test(this.tCapObject, object)
                  ? (this.notify(this.tCapObject, e, "touchend"), (notify = !1))
                  : object &&
                    this.test(this.tCapObject, object) &&
                    this.notify(object, e, "touchtap"),
                  (this.tCapObject = void 0);
                break;
              case "touchtap":
                notify = !1;
            }
            return notify;
          }),
          (EventConverter.prototype.convertMouse = function (e, data, object) {
            if (
              e.originalEvent &&
              e.originalEvent.sourceCapabilities &&
              e.originalEvent.sourceCapabilities.firesTouchEvents
            )
              return !1;
            var notify = !0;
            switch (e.type) {
              case "mousedown":
                this.mCapObject && this.notify(this.mCapObject, e, "mouseup"),
                  (this.mCapObject = object);
                break;
              case "mouseup":
                this.mCapObject &&
                  !this.test(this.mCapObject, object) &&
                  (this.notify(this.mCapObject, e, "mouseup"), (notify = !1));
                break;
              case "click":
                (notify = this.test(this.mCapObject, object)),
                  (this.mCapObject = void 0);
                break;
              case "mouseenter":
              case "mouseover":
              case "mousemove":
                !this.test(this.mHovObject, object) &&
                  this.mHovObject &&
                  (this.notify(this.mHovObject, e, "mouseout"),
                  (this.mHovObject = void 0)),
                  !this.mHovObject &&
                    object &&
                    (this.notify(object, e, "mouseover"),
                    (this.mHovObject = object)),
                  (notify = "mousemove" === e.type);
                break;
              case "mouseleave":
              case "mouseout":
                this.mHovObject &&
                  (this.notify(this.mHovObject, e, "mouseout"),
                  (this.mHovObject = void 0)),
                  (notify = !1);
            }
            return notify;
          }),
          EventConverter
        );
      })();
    exports.default = EventConverter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _Cache = __webpack_require__(14),
      _Cache2 = _interopRequireDefault(_Cache),
      _BlankImage = __webpack_require__(46),
      _BlankImage2 = _interopRequireDefault(_BlankImage),
      _StaticImage = __webpack_require__(62),
      _StaticImage2 = _interopRequireDefault(_StaticImage),
      _PdfImage = __webpack_require__(60),
      _PdfImage2 = _interopRequireDefault(_PdfImage),
      _InteractiveImage = __webpack_require__(54),
      _InteractiveImage2 = _interopRequireDefault(_InteractiveImage),
      ImageFactory = (function () {
        function ImageFactory(context, cache) {
          _classCallCheck(this, ImageFactory),
            (this.context = context),
            (this.cache = cache || new _Cache2.default());
        }
        return (
          (ImageFactory.prototype.build = function (info) {
            var n =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : 0,
              widthTexels =
                arguments.length > 2 && void 0 !== arguments[2]
                  ? arguments[2]
                  : 210,
              heightTexels =
                arguments.length > 3 && void 0 !== arguments[3]
                  ? arguments[3]
                  : 297,
              color =
                arguments.length > 4 && void 0 !== arguments[4]
                  ? arguments[4]
                  : 16777215,
              injector =
                arguments.length > 5 && void 0 !== arguments[5]
                  ? arguments[5]
                  : void 0,
              image = void 0;
            switch (info.type) {
              case "html":
                image = new _InteractiveImage2.default(
                  this.context,
                  widthTexels,
                  heightTexels,
                  color,
                  info.src,
                  this.cache,
                  injector
                );
                break;
              case "image":
                image = new _StaticImage2.default(
                  this.context,
                  widthTexels,
                  heightTexels,
                  color,
                  info.src
                );
                break;
              case "pdf":
                image = new _PdfImage2.default(
                  this.context,
                  widthTexels,
                  heightTexels,
                  color,
                  info.src,
                  n
                );
                break;
              case "blank":
              default:
                image = new _BlankImage2.default(
                  this.context,
                  widthTexels,
                  heightTexels,
                  color
                );
            }
            return image;
          }),
          ImageFactory
        );
      })();
    exports.default = ImageFactory;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _book = __webpack_require__(11),
      _BaseMathUtils = __webpack_require__(2),
      _BaseMathUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_BaseMathUtils),
      BookPropsBuilder = (function () {
        function BookPropsBuilder(onReady, style) {
          _classCallCheck(this, BookPropsBuilder),
            (this.onReady = onReady),
            (this.defaults = (0, _book.props)(style));
        }
        return (
          (BookPropsBuilder.prototype.dispose = function () {}),
          (BookPropsBuilder.prototype.calcSize = function (width, height) {
            var scale = _BaseMathUtils2.default.calcScale(
              width,
              height,
              this.defaults.width,
              this.defaults.height
            );
            return { width: scale * width, height: scale * height };
          }),
          (BookPropsBuilder.prototype.calcTexels = function (width, height) {
            var sheet = this.defaults.sheet,
              scale = _BaseMathUtils2.default.calcScale(
                width,
                height,
                sheet.widthTexels,
                sheet.heightTexels
              );
            return { widthTexels: scale * width, heightTexels: scale * height };
          }),
          (BookPropsBuilder.prototype.calcProps = function (width, height) {
            this.props = _extends(
              {},
              this.defaults,
              { pages: this.pages },
              this.calcSize(width, height),
              {
                sheet: _extends(
                  {},
                  this.defaults.sheet,
                  this.calcTexels(width, height)
                ),
                cover: _extends({}, this.defaults.cover),
                page: _extends({}, this.defaults.page),
              }
            );
          }),
          (BookPropsBuilder.prototype.calcSheets = function (pages) {
            return (this.sheets = Math.ceil(Math.max(0, pages - 4) / 2));
          }),
          (BookPropsBuilder.prototype.getSheets = function () {
            return this.sheets;
          }),
          (BookPropsBuilder.prototype.getProps = function () {
            return this.props;
          }),
          (BookPropsBuilder.prototype.getPageCallback = function () {
            return this.binds.pageCallback;
          }),
          (BookPropsBuilder.prototype.ready = function () {
            this.onReady &&
              this.onReady(
                this.getProps(),
                this.getSheets(),
                this.getPageCallback()
              );
          }),
          BookPropsBuilder
        );
      })();
    exports.default = BookPropsBuilder;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _typeof =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
          ? function (obj) {
              return typeof obj;
            }
          : function (obj) {
              return obj &&
                "function" == typeof Symbol &&
                obj.constructor === Symbol &&
                obj !== Symbol.prototype
                ? "symbol"
                : typeof obj;
            },
      _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(1),
      _sheetBlock = __webpack_require__(44),
      _sheetBlock2 = _interopRequireDefault(_sheetBlock),
      _MathUtils = __webpack_require__(5),
      _MathUtils2 = _interopRequireDefault(_MathUtils),
      _ThreeUtils = __webpack_require__(21),
      _ThreeUtils2 = _interopRequireDefault(_ThreeUtils),
      SheetBlock = (function () {
        function SheetBlock(visual, p, first, last) {
          var angle =
              arguments.length > 4 && void 0 !== arguments[4]
                ? arguments[4]
                : 0,
            _this = this,
            state =
              arguments.length > 5 && void 0 !== arguments[5]
                ? arguments[5]
                : "closed",
            height =
              arguments.length > 6 && void 0 !== arguments[6]
                ? arguments[6]
                : 0;
          _classCallCheck(this, SheetBlock),
            (this.visual = visual),
            (this.p = _extends({}, p, { first: first, last: last }));
          var props = this.getProps(),
            loadedPoints = this.loadPoints();
          Object.keys(loadedPoints).map(function (k) {
            _this[k] = loadedPoints[k][props.shape] || loadedPoints[k][0];
          }),
            (this.pSpline = new _libs.THREE.CatmullRomCurve3([]));
          for (var i = 0; i < this.interpolationPoints.x[0].length; ++i)
            this.pSpline.points.push(new _libs.THREE.Vector3());
          this.iSpline = new _libs.THREE.CatmullRomCurve3([]);
          for (var _i = 0; _i < _sheetBlock2.default.resX; ++_i)
            this.iSpline.points.push(new _libs.THREE.Vector3());
          if (
            ((this.aSplines = []),
            (this.geometry = _sheetBlock2.default.geometry.clone()),
            (this.p.sideFaces = [
              { first: 0, last: _sheetBlock2.default.faces[0] },
              {
                first: _sheetBlock2.default.faces[0],
                last: _sheetBlock2.default.faces[1],
              },
            ]),
            (this.sideTexture = new _libs.THREE.Texture()),
            (this.sideTexture.wrapT = _libs.THREE.RepeatWrapping),
            this.sideTexture.repeat.set(0, last - first),
            (this.sideTexture.image = props.sideTexture),
            (this.sideTexture.needsUpdate = !0),
            (this.materials = [
              new _libs.THREE.MeshPhongMaterial(),
              new _libs.THREE.MeshPhongMaterial(),
              new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture }),
              new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture }),
              new _libs.THREE.MeshPhongMaterial(),
              new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture }),
            ]),
            this.p.setTexture(this.materials[0], 2 * first),
            this.p.setTexture(this.materials[1], 2 * last - 1),
            (this.mesh = new _libs.THREE.Mesh(this.geometry, this.materials)),
            (this.mesh.castShadow = !0),
            (this.mesh.receiveShadow = !0),
            (this.three = this.mesh),
            (this.three.userData.self = this),
            (this.markers = []),
            this.p.marker.use)
          ) {
            var l = this.geometry.vertices.length,
              is = void 0;
            is = Array.apply(0, Array(l)).map(function (_, i) {
              return i;
            });
            for (
              var _iterator = is,
                _isArray = Array.isArray(_iterator),
                _i2 = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i2 >= _iterator.length) break;
                _ref = _iterator[_i2++];
              } else {
                if (((_i2 = _iterator.next()), _i2.done)) break;
                _ref = _i2.value;
              }
              var _i3 = _ref,
                marker = _ThreeUtils2.default.createMarker(
                  this.geometry.vertices[_i3],
                  _i3 < l / 2 ? 16711680 : 65280,
                  this.p.marker.size
                );
              this.markers.push({ marker: marker, vertex: _i3 }),
                this.three.add(marker);
            }
          }
          (this.corner = {
            use: !0,
            height: 0,
            maxDistance: 0,
            points: [],
            OZ: new _libs.THREE.Vector3(0, 0, 1),
            axis: new _libs.THREE.Vector3(),
          }),
            this.set(0, "closed", height, first, last),
            this.set(angle, state, height, first, last);
        }
        return (
          (SheetBlock.prototype.dispose = function () {
            for (
              var _iterator2 = this.materials,
                _isArray2 = Array.isArray(_iterator2),
                _i4 = 0,
                _iterator2 = _isArray2
                  ? _iterator2
                  : _iterator2[Symbol.iterator]();
              ;

            ) {
              var _ref2;
              if (_isArray2) {
                if (_i4 >= _iterator2.length) break;
                _ref2 = _iterator2[_i4++];
              } else {
                if (((_i4 = _iterator2.next()), _i4.done)) break;
                _ref2 = _i4.value;
              }
              var m = _ref2;
              m.map && ((m.map = null), (m.needsUpdate = !0)), m.dispose();
            }
            delete this.materials, this.geometry.dispose();
          }),
          (SheetBlock.prototype.getSize = function () {
            return this.p.last - this.p.first;
          }),
          (SheetBlock.prototype.getProps = function () {
            return _extends({}, this.p.page, {
              width:
                this.p.page.width -
                (this.reducedWidth ? 0.001 * this.p.page.width : 0),
              sheets: this.p.sheets,
            });
          }),
          (SheetBlock.prototype.reduceWidth = function (reducedWidth) {
            (this.reducedWidth = reducedWidth), this.set(this.angle);
          }),
          (SheetBlock.prototype.getTopCerners = function () {
            var off =
              this.angle > Math.PI / 2 ? 0 : this.geometry.vertices.length / 2;
            return [
              this.geometry.vertices[off],
              this.geometry.vertices[_sheetBlock2.default.resX - 1 + off],
              this.geometry.vertices[
                (_sheetBlock2.default.resZ - 1) * _sheetBlock2.default.resX +
                  off
              ],
              this.geometry.vertices[
                _sheetBlock2.default.resZ * _sheetBlock2.default.resX - 1 + off
              ],
            ];
          }),
          (SheetBlock.prototype.getTopSize = function () {
            var vs = this.getTopCerners(),
              w0 = new _libs.THREE.Vector3(),
              w1 = new _libs.THREE.Vector3();
            return (
              w0.copy(vs[0]),
              this.three.localToWorld(w0),
              w1.copy(vs[1]),
              this.three.localToWorld(w1),
              { width: Math.abs(w1.x - w0.x), height: vs[0].distanceTo(vs[2]) }
            );
          }),
          (SheetBlock.prototype.getTopWorldRotation = function (q) {
            return (q.x = -Math.PI / 2), q;
          }),
          (SheetBlock.prototype.getTopWorldPosition = function (v) {
            var vs = this.getTopCerners();
            v.set(0, -100, 0);
            for (
              var w = new _libs.THREE.Vector3(),
                _iterator3 = vs,
                _isArray3 = Array.isArray(_iterator3),
                _i5 = 0,
                _iterator3 = _isArray3
                  ? _iterator3
                  : _iterator3[Symbol.iterator]();
              ;

            ) {
              var _ref3;
              if (_isArray3) {
                if (_i5 >= _iterator3.length) break;
                _ref3 = _iterator3[_i5++];
              } else {
                if (((_i5 = _iterator3.next()), _i5.done)) break;
                _ref3 = _i5.value;
              }
              var vi = _ref3;
              w.copy(vi),
                this.three.localToWorld(w),
                (v.x += 0.25 * w.x),
                (v.y = Math.max(w.y, w.y)),
                (v.z += 0.25 * w.z);
            }
            return v;
          }),
          (SheetBlock.prototype.getInterpolationPoints = function (inds, mod) {
            for (
              var ps = { x: [], y: [] },
                K = this.getProps().wave,
                _iterator4 = inds,
                _isArray4 = Array.isArray(_iterator4),
                _i6 = 0,
                _iterator4 = _isArray4
                  ? _iterator4
                  : _iterator4[Symbol.iterator]();
              ;

            ) {
              var _ref4;
              if (_isArray4) {
                if (_i6 >= _iterator4.length) break;
                _ref4 = _iterator4[_i6++];
              } else {
                if (((_i6 = _iterator4.next()), _i6.done)) break;
                _ref4 = _i6.value;
              }
              var i = _ref4;
              ps.x.push([].concat(this.interpolationPoints.x[i])),
                ps.y.push(
                  ~mod.indexOf(i)
                    ? this.interpolationPoints.y[i].map(function (n) {
                        return K * n;
                      })
                    : [].concat(this.interpolationPoints.y[i])
                );
            }
            return ps;
          }),
          (SheetBlock.prototype.set = function (angle) {
            var state =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : this.state,
              height =
                arguments.length > 2 && void 0 !== arguments[2]
                  ? arguments[2]
                  : this.corner.height,
              first =
                arguments.length > 3 && void 0 !== arguments[3]
                  ? arguments[3]
                  : this.p.first,
              last =
                arguments.length > 4 && void 0 !== arguments[4]
                  ? arguments[4]
                  : this.p.last,
              flipDirection =
                arguments.length > 5 && void 0 !== arguments[5]
                  ? arguments[5]
                  : "right",
              PI = Math.PI;
            this.state = state;
            var closedAngle = void 0,
              binderTurn = void 0;
            "object" === (void 0 === angle ? "undefined" : _typeof(angle))
              ? ((this.angle = angle.openedAngle),
                (closedAngle = angle.closedAngle),
                (binderTurn =
                  angle.binderTurn > PI / 2
                    ? PI - angle.binderTurn
                    : angle.binderTurn))
              : (this.angle = angle),
              (this.corner.height = height),
              (this.p.first === first && this.p.last === last) ||
                (this.sideTexture.repeat.set(0, last - first),
                (this.sideTexture.needsUpdate = !0),
                this.p.first !== first &&
                  this.p.setTexture(this.materials[0], 2 * first),
                this.p.last !== last &&
                  this.p.setTexture(this.materials[1], 2 * last - 1)),
              (this.p.first = first),
              (this.p.last = last);
            var points = void 0,
              props = this.getProps();
            if ("closed" === this.state)
              points = this.getInterpolationPoints(
                this.closedInterpolationIndeces,
                this.closedInterpolationIndeces
              );
            else if ("opened" === this.state)
              if (
                void 0 !== closedAngle &&
                Math.abs(closedAngle - PI / 2) > 0.01
              ) {
                points = this.getInterpolationPoints(
                  this.flatInterpolationIndeces,
                  []
                );
                var ps = this.getPointsAtAngle(
                  this.getInterpolationPoints(
                    this.closedInterpolationIndeces,
                    this.closedInterpolationIndeces
                  ),
                  closedAngle > PI / 2 ? PI - closedAngle : closedAngle
                );
                (points.x = [ps.x].concat(points.x)),
                  (points.y = [ps.y].concat(points.y));
              } else
                points = this.getInterpolationPoints(
                  this.openedInterpolationIndeces[
                    "right" === flipDirection
                      ? this.angle > PI / 2
                        ? "left"
                        : "right"
                      : this.angle < PI / 2
                      ? "left"
                      : "right"
                  ],
                  this.closedInterpolationIndeces
                );
            var hl = void 0,
              hr = void 0,
              offset = 0.5 * props.sheets * props.depth;
            "closed" === this.state && (offset -= 7e-6 * this.p.scale),
              this.angle <= PI / 2
                ? ((hl = (props.sheets - first) * props.depth),
                  (hr = (props.sheets - last) * props.depth))
                : ((hl = first * props.depth), (hr = last * props.depth));
            var dDepth = 0.1 * props.depth;
            hl > hr
              ? ((hr -= dDepth), (hl += dDepth))
              : ((hr += dDepth), (hl -= dDepth));
            var inAngle = this.angle > PI / 2 ? PI - this.angle : this.angle,
              hAngle =
                "closed" === this.state
                  ? inAngle
                  : void 0 === binderTurn
                  ? PI / 2
                  : binderTurn,
              _getPointsAtAngleAndH = this.getPointsAtAngleAndHs(
                points,
                inAngle,
                hAngle,
                [hl / props.width, hr / props.width]
              ),
              left = _getPointsAtAngleAndH[0],
              right = _getPointsAtAngleAndH[1];
            this.angle > PI / 2 &&
              (this.inverse(left), this.inverse(right), (offset = -offset)),
              this.setPoints(left, right, offset);
          }),
          (SheetBlock.prototype.setPoints = function (left, right, offset) {
            for (
              var _this2 = this,
                p = this.getProps(),
                i = 0,
                ys = [right, left],
                y = 0;
              y < _sheetBlock2.default.resY;
              ++y
            )
              for (var z = 0; z < _sheetBlock2.default.resZ; ++z)
                for (var x = 0; x < _sheetBlock2.default.resX; ++x)
                  this.geometry.vertices[i++].set(
                    ys[y].x[x] * p.width + offset,
                    ys[y].y[x] * p.width,
                    (z * p.height) / (_sheetBlock2.default.resZ - 1) -
                      0.5 * p.height
                  );
            if (
              (i !== this.geometry.vertices.length &&
                console.warn("setPoints: bad mapping!"),
              this.corner.use && !this.corner.points.length)
            ) {
              var plane = new _libs.THREE.Plane(),
                normal = plane.normal,
                planeOffset =
                  (1 - this.getProps().flexibleCorner) *
                  Math.min(p.width, p.height),
                proj = new _libs.THREE.Vector3();
              plane.setFromNormalAndCoplanarPoint(
                new _libs.THREE.Vector3(-1, 0, -1).normalize(),
                new _libs.THREE.Vector3(planeOffset + offset, 0, 0.5 * p.height)
              );
              for (
                var _i7 = 0, l = this.geometry.vertices.length;
                _i7 < l;
                ++_i7
              )
                if (
                  (plane.projectPoint(this.geometry.vertices[_i7], proj),
                  proj.sub(this.geometry.vertices[_i7]),
                  proj.x * normal.x + proj.y * normal.y + proj.z * normal.z > 0)
                ) {
                  var d = proj.length() / planeOffset;
                  (this.corner.maxDistance = Math.max(
                    this.corner.maxDistance,
                    d
                  )),
                    this.corner.points.push({ vertex: _i7, distance: d });
                }
            }
            if (this.corner.use && Math.abs(this.corner.height) > 0.001) {
              this.corner.axis.set(-1, 0, 1).normalize(),
                this.corner.axis.applyAxisAngle(this.corner.OZ, this.angle);
              for (
                var _iterator5 = this.corner.points,
                  _isArray5 = Array.isArray(_iterator5),
                  _i8 = 0,
                  _iterator5 = _isArray5
                    ? _iterator5
                    : _iterator5[Symbol.iterator]();
                ;

              ) {
                var _ref5;
                if (_isArray5) {
                  if (_i8 >= _iterator5.length) break;
                  _ref5 = _iterator5[_i8++];
                } else {
                  if (((_i8 = _iterator5.next()), _i8.done)) break;
                  _ref5 = _i8.value;
                }
                var point = _ref5;
                this.geometry.vertices[point.vertex].applyAxisAngle(
                  this.corner.axis,
                  (function (d) {
                    return (
                      (p.cornerDeviation * _this2.corner.height) /
                      (1 +
                        Math.exp(
                          -p.bending * (d - 0.5 * _this2.corner.maxDistance)
                        ))
                    );
                  })(point.distance)
                );
              }
            }
            for (
              var _iterator6 = this.markers,
                _isArray6 = Array.isArray(_iterator6),
                _i9 = 0,
                _iterator6 = _isArray6
                  ? _iterator6
                  : _iterator6[Symbol.iterator]();
              ;

            ) {
              var _ref6;
              if (_isArray6) {
                if (_i9 >= _iterator6.length) break;
                _ref6 = _iterator6[_i9++];
              } else {
                if (((_i9 = _iterator6.next()), _i9.done)) break;
                _ref6 = _i9.value;
              }
              var m = _ref6;
              m.marker.position.copy(this.geometry.vertices[m.vertex]);
            }
            this.geometry.computeVertexNormals(),
              this.geometry.computeBoundingSphere(),
              (this.geometry.verticesNeedUpdate = !0),
              this.markup && this.markup.computeVertices();
          }),
          (SheetBlock.prototype.inverse = function (ps) {
            for (var i = 0; i < ps.x.length; ++i) ps.x[i] = -ps.x[i];
            return ps;
          }),
          (SheetBlock.prototype.getPointsAtHs = function (ps, angle, hs) {
            var _this3 = this,
              N = 1e3;
            _MathUtils2.default.setSplinePoints(this.pSpline, ps);
            var bl = void 0,
              r = [],
              p1 = _extends({}, this.pSpline.getPoint(0.999)),
              p2 = _extends({}, this.pSpline.getPoint(1)),
              dp = { x: p2.x - p1.x, y: p2.y - p1.y },
              ln = Math.sqrt(dp.x * dp.x + dp.y * dp.y),
              sp = this.pSpline.points[this.pSpline.points.length - 1];
            sp.set(sp.x + (0.2 * dp.x) / ln, sp.y + (0.2 * dp.y) / ln, 0),
              (bl = _MathUtils2.default.splitSpline(this.pSpline, N)),
              bl.ls.push(1e7),
              _MathUtils2.default.mapl2L(
                bl.ls,
                bl.len,
                _sheetBlock2.default.resX,
                function (i) {
                  for (var j = 0; j < hs.length; ++j)
                    if (i) {
                      var p0 = _extends(
                          {},
                          _this3.pSpline.getPoint((i - 1) / N)
                        ),
                        _p = _this3.pSpline.getPoint(i / N),
                        x = -(_p.y - p0.y),
                        y = _p.x - p0.x,
                        l = Math.sqrt(x * x + y * y);
                      r[j].x.push(_p.x + (x / l) * hs[j]),
                        r[j].y.push(_p.y + (y / l) * hs[j]);
                    } else
                      r[j] = {
                        x: [-hs[j] * Math.sin(angle)],
                        y: [hs[j] * Math.cos(angle)],
                      };
                }
              );
            for (var nps = [], j = 0; j < hs.length; ++j)
              !(function (j) {
                (nps[j] = { x: [], y: [] }),
                  _MathUtils2.default.setSplinePoints(_this3.iSpline, r[j]);
                var l = _MathUtils2.default.splitSpline(_this3.iSpline, N);
                l.ls.push(1e7),
                  _MathUtils2.default.mapl2L(
                    l.ls,
                    1,
                    _sheetBlock2.default.resX,
                    function (i) {
                      var p = _this3.iSpline.getPoint(i / N);
                      nps[j].x.push(p.x), nps[j].y.push(p.y);
                    }
                  );
              })(j);
            return nps;
          }),
          (SheetBlock.prototype.getPointsAtAngleAndHs = function (
            points,
            angle,
            hAngle,
            hs
          ) {
            var ps = this.getPointsAtAngle(points, angle);
            return this.getPointsAtHs(ps, hAngle, hs);
          }),
          (SheetBlock.prototype.getPointsAtAngle = function (points, angle) {
            var ps = { x: [], y: [] },
              angles = [];
            angle /= Math.PI / 2;
            for (var j = 0; j < points.x.length; ++j)
              angles.push(j / (points.x.length - 1));
            for (var i = 0; i < points.x[0].length; ++i) {
              for (var xps = [], yps = [], _j = 0; _j < points.x.length; ++_j)
                xps.push(points.x[_j][i]), yps.push(points.y[_j][i]);
              ps.x.push(this.interpolate(angles, xps, angle)),
                ps.y.push(this.interpolate(angles, yps, angle));
            }
            return ps;
          }),
          (SheetBlock.prototype.interpolate = function (x, y, xi) {
            if (!this.aSplines[x.length]) {
              this.aSplines[x.length] = new _libs.THREE.CatmullRomCurve3([]);
              for (
                var ps = this.aSplines[x.length].points, i = 0;
                i < x.length;
                ++i
              )
                ps.push(new _libs.THREE.Vector3());
            }
            for (
              var spline = this.aSplines[x.length], _i10 = 0;
              _i10 < x.length;
              ++_i10
            )
              spline.points[_i10].set(x[_i10], y[_i10], 0);
            return spline.getPoint(Math.min(1, Math.max(xi, 0))).y;
          }),
          (SheetBlock.prototype.loadPoints = function () {
            for (
              var x = [],
                y = [],
                _arr = [0, 0.2877, 0.6347, 0.8174, 1],
                _i11 = 0;
              _i11 < _arr.length;
              _i11++
            ) {
              var r = _arr[_i11];
              x.push(r * Math.cos((0.9 * Math.PI) / 4)),
                y.push(r * Math.sin((0.9 * Math.PI) / 4));
            }
            return {
              interpolationPoints: [
                {
                  x: [
                    [0, 0.25, 0.5, 0.75, 1],
                    [0, 0.2482, 0.4997, 0.75, 1],
                    [0, 0.2428, 0.4989, 0.75, 1],
                    [0, 0.125, 0.3214, 0.566, 0.8192],
                    [0, 0, 0, 0, 0],
                    x,
                  ],
                  y: [
                    [0, 0, 0, 0, 0],
                    [0, 0.03, 0.0166, 0.0033, 1e-4],
                    [0, 0.0596, 0.0331, 0.0065, 2e-4],
                    [0, 0.2165, 0.383, 0.492, 0.5736],
                    [0, 0.25, 0.5, 0.75, 1],
                    y,
                  ],
                },
                {
                  x: [
                    [0, 0.25, 0.5, 0.75, 1],
                    [0, 0.2482, 0.4997, 0.75, 1],
                    [0, 0.2428, 0.4989, 0.75, 1],
                    [0, 0.125, 0.3214, 0.5574, 0.8192],
                    [0, -0.0434, 0, 0.1302, 0.342],
                    [0, 0.0434, -0, -0.1302, -0.342],
                    [0, 0.1705, 0.341, 0.4821, 0.5736],
                    [0, 0, 0, 0, 0],
                    x,
                  ],
                  y: [
                    [0, 0, 0, 0, 0],
                    [0, 0.03, 0.0166, 0.0033, 1e-4],
                    [0, 0.0596, 0.0331, 0.0065, 2e-4],
                    [0, 0.2165, 0.383, 0.5018, 0.5736],
                    [0, 0.2462, 0.5, 0.7386, 0.9397],
                    [0, 0.2462, 0.5, 0.7386, 0.9397],
                    [0, 0.1828, 0.3657, 0.5745, 0.8192],
                    [0, 0.25, 0.5, 0.75, 1],
                    y,
                  ],
                },
                {
                  x: [
                    [0, 0.2877, 0.6347, 0.8174, 1],
                    [0, 0.286, 0.632, 0.815, 0.997],
                    [0, 0.279, 0.623, 0.806, 0.988],
                    [0, 0.126, 0.411, 0.593, 0.774],
                    [0, 0, 0, 0, 0],
                    x,
                  ],
                  y: [
                    [0, 0, 0, 0, 0],
                    [0, 0.03, 0.01, 0.002, 0],
                    [0, 0.06, 0.017, 0.004, 0],
                    [0, 0.259, 0.44, 0.446, 0.429],
                    [0, 0.2877, 0.6347, 0.8174, 1],
                    y,
                  ],
                },
              ],
              openedInterpolationIndeces: [
                { left: [2, 3, 4], right: [2, 3, 4] },
                { left: [2, 6, 5], right: [2, 3, 4] },
                { left: [2, 3, 4], right: [2, 3, 4] },
              ],
              closedInterpolationIndeces: [
                [0, 1, 2],
                [0, 1, 2],
                [0, 1, 2],
              ],
              flatInterpolationIndeces: [
                [5, 4],
                [8, 7],
                [5, 4],
              ],
            };
          }),
          SheetBlock
        );
      })();
    exports.default = SheetBlock;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function props() {
      var style =
          arguments.length > 0 && void 0 !== arguments[0]
            ? arguments[0]
            : "volume",
        def = {
          height: 0.297,
          width: 0.21,
          backgroundColor: "",
          backgroundImage: "",
          backgroundStyle: "",
          highlightLinks: !0,
          lighting: "mixed",
          gravity: 1,
          cachedPages: 50,
          renderInactivePages: !0,
          renderInactivePagesOnMobile: !0,
          renderWhileFlipping: !1,
          pagesForPredicting: 5,
          preloadPages: 5,
          autoPlayDuration: 5e3,
          rtl: !1,
          interactiveCorners: !0,
          maxDepth: 0.008,
          sheet: {
            startVelocity: 1.2,
            cornerDeviation: 0.15,
            flexibility: 10,
            flexibleCorner: 0.5,
            bending: 11,
            wave: 0.3,
            shape: 0,
            widthTexels: 1920,
            heightTexels: 1080,
            color: 16777215,
            side: "color",
          },
          cover: {
            side: "transparent",
            binderTexture: "",
            depth: 3e-4,
            padding: 0,
            mass: 0.001,
          },
          page: { depth: 1e-4, mass: 0.001 },
          cssLayerProps: { width: 1024 },
        },
        styles = {
          volume: def,
          flat: _extends({}, def, {
            lighting: "ambient",
            sheet: _extends({}, def.sheet, {
              wave: 0.05,
              side: "transparent",
              shape: 1,
            }),
            cover: _extends({}, def.cover, { depth: 2e-5 }),
            page: _extends({}, def.page, { depth: 1e-5 }),
          }),
          "volume-paddings": _extends({}, def, {
            cover: _extends({}, def.cover, { padding: 0.0025 }),
          }),
        };
      return (
        (styles["volume-unrolling"] = _extends({}, styles.volume, {
          sheet: _extends({}, styles.volume.sheet, { shape: 1 }),
        })),
        (styles["volume-paddings-unrolling"] = _extends(
          {},
          styles["volume-paddings"],
          { sheet: _extends({}, styles["volume-paddings"].sheet, { shape: 1 }) }
        )),
        styles[style] || def
      );
    }
    exports.__esModule = !0;
    var _extends =
      Object.assign ||
      function (target) {
        for (var i = 1; i < arguments.length; i++) {
          var source = arguments[i];
          for (var key in source)
            Object.prototype.hasOwnProperty.call(source, key) &&
              (target[key] = source[key]);
        }
        return target;
      };
    exports.props = props;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    (exports.__esModule = !0),
      (exports.CSS3DSprite = exports.CSS3DObject = void 0);
    var _libs = __webpack_require__(0);
    (_libs.THREE.CSS3DObject = (function (_THREE$Object3D) {
      function CSS3DObject() {
        var element =
          arguments.length > 0 && void 0 !== arguments[0]
            ? arguments[0]
            : void 0;
        _classCallCheck(this, CSS3DObject);
        var _this = _possibleConstructorReturn(
          this,
          _THREE$Object3D.call(this)
        );
        return element && _this.set(element), _this;
      }
      return (
        _inherits(CSS3DObject, _THREE$Object3D),
        (CSS3DObject.prototype.set = function (element) {
          (this.element = element),
            (this.element.style.position = "absolute"),
            this.addEventListener("removed", function () {
              null !== this.element.parentNode &&
                this.element.parentNode.removeChild(this.element);
            });
        }),
        CSS3DObject
      );
    })(_libs.THREE.Object3D)),
      (_libs.THREE.CSS3DSprite = (function (_THREE$CSS3DObject) {
        function CSS3DSprite(element) {
          return (
            _classCallCheck(this, CSS3DSprite),
            _possibleConstructorReturn(
              this,
              _THREE$CSS3DObject.call(this, element)
            )
          );
        }
        return _inherits(CSS3DSprite, _THREE$CSS3DObject), CSS3DSprite;
      })(_libs.THREE.CSS3DObject)),
      (_libs.THREE.CSS3DRenderer = function CSS3DRenderer() {
        function epsilon(value) {
          return Math.round(1e5 * (value + Number.EPSILON)) / 1e5;
        }
        function getCameraCSSMatrix(matrix) {
          var elements = matrix.elements;
          return (
            "matrix3d(" +
            [
              epsilon(elements[0]),
              epsilon(-elements[1]),
              epsilon(elements[2]),
              epsilon(elements[3]),
              epsilon(elements[4]),
              epsilon(-elements[5]),
              epsilon(elements[6]),
              epsilon(elements[7]),
              epsilon(elements[8]),
              epsilon(-elements[9]),
              epsilon(elements[10]),
              epsilon(elements[11]),
              epsilon(elements[12]),
              epsilon(-elements[13]),
              epsilon(elements[14]),
              epsilon(elements[15]),
            ].join(",") +
            ")"
          );
        }
        function getObjectCSSMatrix(matrix, cameraCSSMatrix) {
          var elements = matrix.elements,
            matrix3d =
              "matrix3d(" +
              [
                epsilon(elements[0]),
                epsilon(elements[1]),
                epsilon(elements[2]),
                epsilon(elements[3]),
                epsilon(-elements[4]),
                epsilon(-elements[5]),
                epsilon(-elements[6]),
                epsilon(-elements[7]),
                epsilon(elements[8]),
                epsilon(elements[9]),
                epsilon(elements[10]),
                epsilon(elements[11]),
                epsilon(elements[12]),
                epsilon(elements[13]),
                epsilon(elements[14]),
                epsilon(elements[15]),
              ].join(",") +
              ")";
          return isIE
            ? "translate(-50%,-50%)translate(" +
                _widthHalf +
                "px," +
                _heightHalf +
                "px)" +
                cameraCSSMatrix +
                matrix3d
            : "translate(-50%,-50%)" + matrix3d;
        }
        function renderObject(object, camera, cameraCSSMatrix) {
          if (object instanceof _libs.THREE.CSS3DObject) {
            var style;
            object instanceof _libs.THREE.CSS3DSprite
              ? (matrix.copy(camera.matrixWorldInverse),
                matrix.transpose(),
                matrix.copyPosition(object.matrixWorld),
                matrix.scale(object.scale),
                (matrix.elements[3] = 0),
                (matrix.elements[7] = 0),
                (matrix.elements[11] = 0),
                (matrix.elements[15] = 1),
                (style = getObjectCSSMatrix(matrix, cameraCSSMatrix)))
              : (style = getObjectCSSMatrix(
                  object.matrixWorld,
                  cameraCSSMatrix
                ));
            var element = object.element,
              cachedStyle =
                cache.objects[object.id] && cache.objects[object.id].style;
            (void 0 !== cachedStyle && cachedStyle === style) ||
              ((element.style.WebkitTransform = style),
              (element.style.MozTransform = style),
              (element.style.transform = style),
              (cache.objects[object.id] = { style: style }),
              isIE &&
                (cache.objects[object.id].distanceToCameraSquared =
                  getDistanceToSquared(camera, object))),
              element.parentNode !== cameraElement &&
                cameraElement.appendChild(element);
          }
          for (var i = 0, l = object.children.length; i < l; i++)
            renderObject(object.children[i], camera, cameraCSSMatrix);
        }
        function zOrder(scene) {
          var order = Object.keys(cache.objects).sort(function (a, b) {
              return (
                cache.objects[a].distanceToCameraSquared -
                cache.objects[b].distanceToCameraSquared
              );
            }),
            zMax = order.length;
          scene.traverse(function (object) {
            var index = order.indexOf(object.id + "");
            -1 !== index && (object.element.style.zIndex = zMax - index);
          });
        }
        _classCallCheck(this, CSS3DRenderer);
        var _width,
          _height,
          _widthHalf,
          _heightHalf,
          matrix = new _libs.THREE.Matrix4(),
          cache = { camera: { fov: 0, style: "" }, objects: {} },
          domElement = document.createElement("div");
        (domElement.style.overflow = "hidden"), (this.domElement = domElement);
        var cameraElement = document.createElement("div");
        (cameraElement.style.WebkitTransformStyle = "preserve-3d"),
          (cameraElement.style.MozTransformStyle = "preserve-3d"),
          (cameraElement.style.transformStyle = "preserve-3d"),
          domElement.appendChild(cameraElement);
        var isIE = 1;
        (this.setClearColor = function () {}),
          (this.getSize = function () {
            return { width: _width, height: _height };
          }),
          (this.setSize = function (width, height) {
            (_width = width),
              (_height = height),
              (_widthHalf = _width / 2),
              (_heightHalf = _height / 2),
              (domElement.style.width = width + "px"),
              (domElement.style.height = height + "px"),
              (cameraElement.style.width = width + "px"),
              (cameraElement.style.height = height + "px");
          });
        var getDistanceToSquared = (function () {
          var a = new _libs.THREE.Vector3(),
            b = new _libs.THREE.Vector3();
          return function (object1, object2) {
            return (
              a.setFromMatrixPosition(object1.matrixWorld),
              b.setFromMatrixPosition(object2.matrixWorld),
              a.distanceToSquared(b)
            );
          };
        })();
        this.render = function (scene, camera) {
          var fov = camera.projectionMatrix.elements[5] * _heightHalf;
          cache.camera.fov !== fov &&
            ((domElement.style.WebkitPerspective = fov + "px"),
            (domElement.style.MozPerspective = fov + "px"),
            (domElement.style.perspective = fov + "px"),
            (cache.camera.fov = fov)),
            scene.updateMatrixWorld(),
            null === camera.parent && camera.updateMatrixWorld();
          var cameraCSSMatrix =
              "translateZ(" +
              fov +
              "px)" +
              getCameraCSSMatrix(camera.matrixWorldInverse),
            style =
              cameraCSSMatrix +
              "translate(" +
              _widthHalf +
              "px," +
              _heightHalf +
              "px)";
          cache.camera.style === style ||
            isIE ||
            ((cameraElement.style.WebkitTransform = style),
            (cameraElement.style.MozTransform = style),
            (cameraElement.style.transform = style),
            (cache.camera.style = style)),
            renderObject(scene, camera, cameraCSSMatrix),
            isIE && zOrder(scene);
        };
      }),
      (exports.default = _libs.THREE.CSS3DRenderer);
    var _CSS3DObject = _libs.THREE.CSS3DObject,
      _CSS3DSprite = _libs.THREE.CSS3DSprite;
    (exports.CSS3DObject = _CSS3DObject), (exports.CSS3DSprite = _CSS3DSprite);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _CSS3DRenderer = __webpack_require__(12),
      CSSLayer = (function (_CSS3DObject) {
        function CSSLayer(width, height, props) {
          _classCallCheck(this, CSSLayer);
          var _this = _possibleConstructorReturn(this, _CSS3DObject.call(this));
          return (
            (_this.props = props),
            (_this.jContainer = (0, _libs.$)(
              '<div class="hidden css-layer"></div>'
            )),
            _this.setSize(width, height),
            _this.setData(),
            _this.set(_this.jContainer[0]),
            _this
          );
        }
        return (
          _inherits(CSSLayer, _CSS3DObject),
          (CSSLayer.init = function (doc) {
            var delay =
              arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : 150;
            (CSSLayer.delay = delay),
              (CSSLayer.style = (0, _libs.$)(
                (
                  "<style type=text/css>\n      .css-layer {\n    \t\topacity: 1;\n    \t\ttransition: opacity " +
                  delay +
                  "ms ease-out;\n        visibility: visible;\n        overflow: hidden;\n    \t}\n    \t.css-layer.hidden {\n    \t\ttransition: opacity " +
                  delay +
                  "ms ease-in, visibility " +
                  delay +
                  "ms step-end;\n    \t\topacity: 0;\n        visibility: hidden;\n        display: block;\n        pointer-events: none;\n      }\n      .fb3d-block {\n        position: absolute;\n      }\n      .fb3d-audio audio, .fb3d-link a, .fb3d-iframe iframe, .fb3d-video video, .fb3d-youtube .youtube {\n        display: block;\n        position: absolute;\n        left: 0;\n        top: 0;\n        width: 100%;\n        height: 100%;\n      }\n      .fb3d-image {\n        text-align: center;\n      }\n      .fb3d-link a {\n        cursor: pointer;\n        background-color: rgba(255,255,0,.1);\n        transition: background-color .15s ease-in;\n      }\n      .fb3d-link a:hover {\n        background-color: rgba(255,255,0,.2);\n        transition: background-color .15s ease-out;\n      }\n      .fb3d-iframe iframe {\n        border: 0;\n      }\n      .fb3d-image img {\n        max-width: 100%;\n        max-height: 100%;\n      }\n    </style>"
                ).fb3dQFilter()
              ).appendTo(doc.head));
          }),
          (CSSLayer.dispose = function () {
            CSSLayer.style.remove();
          }),
          (CSSLayer.prototype.setSize = function (width, height) {
            var widthPxs = this.props.width,
              heightPxs = (height / width) * widthPxs;
            this.jContainer.width(widthPxs).height(heightPxs),
              (this.scale.x = 1 / (widthPxs / width)),
              (this.scale.y = 1 / (widthPxs / width));
          }),
          (CSSLayer.prototype.callInternal = function (name) {
            if (this.object && this.object[name])
              try {
                this.object[name]();
              } catch (e) {
                console.error(e);
              }
          }),
          (CSSLayer.prototype.dispose = function () {
            this.clearInternals();
          }),
          (CSSLayer.prototype.clearInternals = function () {
            this.callInternal("dispose"),
              !this.css || this.css.remove(),
              !this.html || this.html.remove();
          }),
          (CSSLayer.prototype.setData = function setData() {
            var css =
                arguments.length > 0 && void 0 !== arguments[0]
                  ? arguments[0]
                  : "",
              html =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : "",
              js =
                arguments.length > 2 && void 0 !== arguments[2]
                  ? arguments[2]
                  : "";
            this.clearInternals(),
              (this.css = (0, _libs.$)(
                '<style type="text/css">' + css + "</style>"
              ).appendTo(this.jContainer)),
              (this.html = (0, _libs.$)(html).appendTo(this.jContainer));
            var init = eval(js);
            init && (this.object = init(this.jContainer, this.props) || {});
          }),
          (CSSLayer.prototype.pendedCall = function (clb) {
            var _this2 = this,
              timestamp = (this.timestamp = Date.now());
            setTimeout(function () {
              timestamp === _this2.timestamp && clb();
            }, 0.5 * CSSLayer.delay);
          }),
          (CSSLayer.prototype.isHidden = function () {
            return this.jContainer.hasClass("hidden");
          }),
          (CSSLayer.prototype.hide = function () {
            var _this3 = this,
              res = void 0;
            return (
              this.isHidden()
                ? (res = Promise.resolve())
                : (this.jContainer.addClass("hidden"),
                  this.callInternal("hide"),
                  (res = new Promise(function (resolve) {
                    _this3.pendedCall(function () {
                      _this3.callInternal("hidden"), resolve();
                    });
                  }))),
              res
            );
          }),
          (CSSLayer.prototype.show = function () {
            var _this4 = this,
              res = void 0;
            return (
              this.isHidden()
                ? (this.jContainer.removeClass("hidden"),
                  this.callInternal("show"),
                  (res = new Promise(function (resolve) {
                    _this4.pendedCall(function () {
                      _this4.callInternal("shown"), resolve();
                    });
                  })))
                : (res = Promise.resolve()),
              res
            );
          }),
          CSSLayer
        );
      })(_CSS3DRenderer.CSS3DObject);
    exports.default = CSSLayer;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var Cache = (function () {
      function Cache() {
        var maxSize =
            arguments.length > 0 && void 0 !== arguments[0]
              ? arguments[0]
              : 1 / 0,
          sizeof =
            arguments.length > 1 && void 0 !== arguments[1]
              ? arguments[1]
              : Cache.countSizeof;
        _classCallCheck(this, Cache),
          (this.os = new Map()),
          (this.sizeof = sizeof),
          (this.maxSize = maxSize),
          (this.size = 0);
      }
      return (
        (Cache.prototype.forEach = function (clb) {
          this.os.forEach(function (v, k) {
            return clb([k, v]);
          });
        }),
        (Cache.countSizeof = function (value) {
          return 1;
        }),
        (Cache.prototype.remove = function (k) {
          var res = !1,
            v = this.os.get(k);
          return (
            (v.locked && v.locked(k)) ||
              ((this.size -= this.sizeof(v)),
              v.dispose && v.dispose(),
              this.os.delete(k),
              (res = !0)),
            res
          );
        }),
        (Cache.prototype.freeSpace = function () {
          for (
            var arr = [],
              _iterator = this.os,
              _isArray = Array.isArray(_iterator),
              _i = 0,
              _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
            ;

          ) {
            var _ref;
            if (_isArray) {
              if (_i >= _iterator.length) break;
              _ref = _iterator[_i++];
            } else {
              if (((_i = _iterator.next()), _i.done)) break;
              _ref = _i.value;
            }
            var p = _ref;
            arr.push({ timestamp: p[1].timestamp, key: p[0] });
          }
          arr.sort(function (a, b) {
            return a.timestamp - b.timestamp;
          });
          for (
            var i = 0;
            i < arr.length && this.size > (3 * this.maxSize) / 4;
            ++i
          )
            this.remove(arr[i].key);
        }),
        (Cache.prototype.dispose = function () {
          for (
            var arr = [],
              _iterator2 = this.os,
              _isArray2 = Array.isArray(_iterator2),
              _i2 = 0,
              _iterator2 = _isArray2
                ? _iterator2
                : _iterator2[Symbol.iterator]();
            ;

          ) {
            var _ref2;
            if (_isArray2) {
              if (_i2 >= _iterator2.length) break;
              _ref2 = _iterator2[_i2++];
            } else {
              if (((_i2 = _iterator2.next()), _i2.done)) break;
              _ref2 = _i2.value;
            }
            var p = _ref2;
            arr.push({ v: p[1], k: p[0] });
          }
          for (
            var _iterator3 = arr,
              _isArray3 = Array.isArray(_iterator3),
              _i3 = 0,
              _iterator3 = _isArray3
                ? _iterator3
                : _iterator3[Symbol.iterator]();
            ;

          ) {
            var _ref3;
            if (_isArray3) {
              if (_i3 >= _iterator3.length) break;
              _ref3 = _iterator3[_i3++];
            } else {
              if (((_i3 = _iterator3.next()), _i3.done)) break;
              _ref3 = _i3.value;
            }
            var o = _ref3;
            o.v.dispose && o.v.dispose(), this.os.delete(o.k);
          }
        }),
        (Cache.recursionSizeof = function (value) {
          var size = 0;
          if (value) {
            ++size;
            var len = value.length;
            if (void 0 === len)
              for (var p in value)
                value.hasOwnProperty(p) &&
                  (size += Cache.recursionSizeof(value[p]));
            else size += len;
          }
          return size;
        }),
        (Cache.prototype.getTimestamp = function () {
          return Date.now();
        }),
        (Cache.prototype.get = function (key) {
          var value = this.os.get(key);
          return value && (value.timestamp = this.getTimestamp()), value;
        }),
        (Cache.prototype.put = function (key, value) {
          return (
            (value.timestamp = this.getTimestamp()),
            this.os.set(key, value),
            (this.size += this.sizeof(value)),
            this.size > this.maxSize && this.freeSpace(),
            value
          );
        }),
        Cache
      );
    })();
    exports.default = Cache;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      Controller = (function (_THREE$EventDispatche) {
        function Controller() {
          return (
            _classCallCheck(this, Controller),
            _possibleConstructorReturn(
              this,
              _THREE$EventDispatche.apply(this, arguments)
            )
          );
        }
        return (
          _inherits(Controller, _THREE$EventDispatche),
          (Controller.prototype.handleDefault = function (id, e, data) {}),
          (Controller.prototype.dispatchAsync = function (e) {
            var _this2 = this;
            Promise.resolve().then(function () {
              return _this2.dispatchEvent(e);
            });
          }),
          (Controller.prototype.dispose = function () {}),
          Controller
        );
      })(_libs.THREE.EventDispatcher);
    exports.default = Controller;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _EventConverter2 = __webpack_require__(7),
      _EventConverter3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_EventConverter2),
      CustomEventConverter = (function (_EventConverter) {
        function CustomEventConverter(wnd, doc) {
          var customTest =
              arguments.length > 2 && void 0 !== arguments[2]
                ? arguments[2]
                : function () {
                    return !1;
                  },
            eDoc = arguments[3];
          _classCallCheck(this, CustomEventConverter);
          var _this = _possibleConstructorReturn(
            this,
            _EventConverter.call(this, wnd, doc)
          );
          return (
            (_this.eDoc = eDoc),
            (_this.customTest = customTest),
            (_this.customs = []),
            _this
          );
        }
        return (
          _inherits(CustomEventConverter, _EventConverter),
          (CustomEventConverter.prototype.test = function (object1, object2) {
            return !(!object1 || !object2) && this.customTest(object1, object2);
          }),
          (CustomEventConverter.prototype.getCallback = function (object) {
            return object.target.callback;
          }),
          (CustomEventConverter.prototype.addCustom = function (custom) {
            this.customs.push(custom);
          }),
          (CustomEventConverter.prototype.getObject = function (e, data) {
            var object = void 0;
            if (data.doc === this.eDoc)
              for (
                var _iterator = this.customs,
                  _isArray = Array.isArray(_iterator),
                  _i = 0,
                  _iterator = _isArray
                    ? _iterator
                    : _iterator[Symbol.iterator]();
                ;

              ) {
                var _ref;
                if (_isArray) {
                  if (_i >= _iterator.length) break;
                  _ref = _iterator[_i++];
                } else {
                  if (((_i = _iterator.next()), _i.done)) break;
                  _ref = _i.value;
                }
                var custom = _ref;
                if ((object = custom.testIntersection(e, data))) break;
              }
            return object;
          }),
          CustomEventConverter
        );
      })(_EventConverter3.default);
    exports.default = CustomEventConverter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _Utils = __webpack_require__(3),
      _Utils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_Utils),
      Finder = (function () {
        function Finder(strs, pattern, props) {
          _classCallCheck(this, Finder),
            (this.props = _extends({}, Finder.defaults, props)),
            (this.strs = strs);
          this.merge(strs);
          (this.hits = []),
            (this.contexts = []),
            (this.pattern = pattern.toLowerCase()),
            (this.lstr = this.str.toLowerCase());
          for (var p = 0; ; ) {
            if (-1 === (p = this.lstr.indexOf(this.pattern, p))) break;
            this.addHits(p), this.addContext(p), (p += this.pattern.length);
          }
        }
        return (
          (Finder.isDelimetr = function (s) {
            return s === Finder.DELIMITER;
          }),
          (Finder.prototype.merge = function () {
            for (
              var as = [], map = [], strs = this.strs, p = 0, i = 0;
              i < strs.length;
              ++i
            )
              strs[i].length &&
                (map.push({ base: i, offset: p }),
                as.push(strs[i]),
                (p += strs[i].length),
                i < strs.length - 1 &&
                  !Finder.isDelimetr(strs[i].charAt(strs[i].length - 1)) &&
                  !Finder.isDelimetr(strs[i + 1].charAt(0)) &&
                  (as.push(Finder.DELIMITER), ++p));
            (this.map = map), (this.str = as.join(""));
          }),
          (Finder.prototype.addHits = function (p) {
            var info =
                this.map[
                  _Utils2.default.lowerBound(
                    this.map,
                    { offset: p },
                    function (a, b) {
                      return a.offset - b.offset;
                    }
                  )
                ],
              chars = this.pattern.length,
              i = info.base;
            for (p -= info.offset; chars; )
              if (this.strs[i].length) {
                var delimeter =
                    i < this.strs.length - 1 &&
                    !Finder.isDelimetr(
                      this.strs[i].charAt(this.strs[i].length - 1)
                    ) &&
                    !Finder.isDelimetr(this.strs[i + 1].charAt(0)),
                  length = Math.min(
                    this.strs[i].length + (delimeter ? 1 : 0) - p,
                    chars
                  );
                p < this.strs[i].length &&
                  this.hits.push({
                    index: i,
                    offset: p,
                    length: Math.min(length, this.strs[i].length - p),
                  }),
                  (chars -= length),
                  ++i,
                  (p = 0);
              }
          }),
          (Finder.prototype.addContext = function (p) {
            for (
              var f = p,
                l = p + this.pattern.length - 1,
                dels = this.props.contextLength,
                prevDels = dels + 1;
              dels && prevDels - dels;

            )
              if (((prevDels = dels), dels % 2)) {
                for (var i = f - 2; i >= 0; --i)
                  if (Finder.isDelimetr(this.str[i]) || 0 === i) {
                    (f = 0 === i ? 0 : i + 1), --dels;
                    break;
                  }
              } else
                for (var _i = l + 2; _i < this.str.length; ++_i)
                  if (
                    Finder.isDelimetr(this.str[_i]) ||
                    _i === this.str.length - 1
                  ) {
                    (l =
                      _i === this.str.length - 1
                        ? _i === this.str.length - 1
                        : _i - 1),
                      --dels;
                    break;
                  }
            this.contexts.push(this.str.substr(f, l - f + 1));
          }),
          (Finder.prototype.getHits = function () {
            return this.hits;
          }),
          (Finder.prototype.getContexts = function () {
            return this.contexts;
          }),
          Finder
        );
      })();
    (Finder.DELIMITER = " "),
      (Finder.defaults = { contextLength: 7, hits: !0, contexts: !0 }),
      (exports.default = Finder);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _FullScreen2 = __webpack_require__(53),
      _FullScreen3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_FullScreen2),
      FullScreenX = (function (_FullScreen) {
        function FullScreenX() {
          return (
            _classCallCheck(this, FullScreenX),
            _possibleConstructorReturn(this, _FullScreen.apply(this, arguments))
          );
        }
        return (
          _inherits(FullScreenX, _FullScreen),
          (FullScreenX.available = function () {
            return !0;
          }),
          (FullScreenX.activated = function () {
            return _FullScreen.available.call(this)
              ? _FullScreen.activated.call(this)
              : FullScreenX.node.hasClass(FullScreenX.classX);
          }),
          (FullScreenX.addEventListener = function (element, handler) {
            _FullScreen.available.call(this)
              ? _FullScreen.addEventListener.call(this, element, handler)
              : (FullScreenX.handler = handler);
          }),
          (FullScreenX.removeEventListener = function (element, handler) {
            _FullScreen.available.call(this)
              ? _FullScreen.removeEventListener.call(this, element, handler)
              : (FullScreenX.handler = FullScreenX.defHandler);
          }),
          (FullScreenX.request = function (element) {
            _FullScreen.available.call(this)
              ? _FullScreen.request.call(this, element)
              : FullScreenX.node.hasClass(FullScreenX.classX) ||
                ((FullScreenX.node = (0, _libs.$)(element || document.body)),
                FullScreenX.node.addClass(FullScreenX.classX),
                Promise.resolve().then(FullScreenX.handler));
          }),
          (FullScreenX.cancel = function () {
            _FullScreen.available.call(this)
              ? _FullScreen.cancel.call(this)
              : FullScreenX.node.hasClass(FullScreenX.classX) &&
                (FullScreenX.node.removeClass(FullScreenX.classX),
                (FullScreenX.node = FullScreenX.defNode),
                Promise.resolve().then(FullScreenX.handler));
          }),
          FullScreenX
        );
      })(_FullScreen3.default);
    (FullScreenX.defNode = (0, _libs.$)()),
      (FullScreenX.node = FullScreenX.defNode),
      (FullScreenX.defHandler = function () {}),
      (FullScreenX.handler = FullScreenX.defHandler),
      (FullScreenX.classX = "fb3d-fullscreenx"),
      (FullScreenX.style = (0, _libs.$)(
        (
          '\n\t\t<style type="text/css">\n      .' +
          FullScreenX.classX +
          " {\n        position: fixed !important;\n\t\t\t\tleft: 0 !important;\n        top: 0 !important;\n        width: 100% !important;\n        height: 100% !important;\n\t\t\t\tz-index: 2147483647 !important;\n\t\t\t\tmargin: 0 !important;\n\t\t\t\tbox-sizing: border-box !important;\n        background-color: #333;\n      }\n    </style>\n\t"
        ).fb3dQFilter()
      ).appendTo("head")),
      (exports.default = FullScreenX);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0),
      _Utils = __webpack_require__(3),
      _Utils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_Utils);
    (_libs.PDFJS.GlobalWorkerOptions.workerSrc = (
      window.PDFJS_LOCALE
        ? PDFJS_LOCALE
        : __webpack_require__.i({
            pdfJsWorker: "js/pdf.worker.js",
            pdfJsCMapUrl: "cmaps/",
          })
    ).pdfJsWorker),
      (_libs.PDFJS.cMapUrl = (
        window.PDFJS_LOCALE
          ? PDFJS_LOCALE
          : __webpack_require__.i({
              pdfJsWorker: "js/pdf.worker.js",
              pdfJsCMapUrl: "cmaps/",
            })
      ).pdfJsCMapUrl),
      (_libs.PDFJS.cMapPacked = !0),
      (_libs.PDFJS.disableAutoFetch = !0),
      (_libs.PDFJS.disableStream = !0),
      (_libs.PDFJS.disableRange = !1),
      (_libs.PDFJS.imageResourcesPath = "images/pdfjs/"),
      (_libs.PDFJS.externalLinkTarget = _libs.PDFJS.LinkTarget.BLANK),
      (_libs.PDFJS.disableFontFace = void 0);
    var Pdf = (function () {
      function Pdf(src, loadingProgress, openOptions) {
        var _this = this;
        _classCallCheck(this, Pdf),
          (this.src = _Utils2.default.normalizeUrl(src)),
          (this.handlerQueue = []),
          (this.progresData = { loaded: -1, total: 1 }),
          (this.loadingProgress = loadingProgress),
          (this.task = _libs.PDFJS.getDocument(
            _extends(
              {
                url: this.src,
                rangeChunkSize: 524288,
                cMapUrl: _libs.PDFJS.cMapUrl,
                cMapPacked: _libs.PDFJS.cMapPacked,
                disableAutoFetch: _libs.PDFJS.disableAutoFetch,
                disableStream: _libs.PDFJS.disableStream,
                disableRange: _libs.PDFJS.disableRange,
                imageResourcesPath: _libs.PDFJS.imageResourcesPath,
                externalLinkTarget: _libs.PDFJS.externalLinkTarget,
                disableFontFace: _libs.PDFJS.disableFontFace,
              },
              openOptions
            )
          )),
          (this.task.onProgress = function (data) {
            if (_this.loadingProgress) {
              var cur = Math.floor((100 * data.loaded) / data.total),
                old = Math.floor(
                  (100 * _this.progresData.loaded) / _this.progresData.total
                );
              cur !== old &&
                ((cur = isNaN(cur) ? 0 : cur),
                (cur = cur > 100 ? 100 : cur),
                Promise.resolve().then(function () {
                  _this.loadingProgress(cur);
                }));
            }
            _this.progresData = data;
          }),
          this.task.promise
            .then(function (handler) {
              handler.numPages > 1
                ? Promise.all([handler.getPage(1), handler.getPage(2)]).then(
                    function (pages) {
                      _this.init(handler, pages);
                    }
                  )
                : _this.init(handler);
            })
            .catch(function (e) {
              console.error(e), _this.errorHandler && _this.errorHandler(e);
            });
      }
      return (
        (Pdf.prototype.init = function (handler, pages) {
          if (((this.handler = handler), pages)) {
            var p0s = Pdf.getPageSize(pages[0]),
              p1s = Pdf.getPageSize(pages[1]);
            this.doubledPages =
              p0s.width / p0s.height / (p1s.width / p1s.height) < 0.75;
          } else this.doubledPages = !1;
          for (
            var done = Promise.resolve(handler),
              _iterator = this.handlerQueue.reverse(),
              _isArray = Array.isArray(_iterator),
              _i = 0,
              _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
            ;

          ) {
            var _ref;
            if (
              "break" ===
              (function () {
                if (_isArray) {
                  if (_i >= _iterator.length) return "break";
                  _ref = _iterator[_i++];
                } else {
                  if (((_i = _iterator.next()), _i.done)) return "break";
                  _ref = _i.value;
                }
                var clb = _ref;
                done = done.then(function (handler) {
                  return clb(handler), handler;
                });
              })()
            )
              break;
          }
        }),
        (Pdf.prototype.getPageType = function (n) {
          return this.doubledPages && 0 !== n && n !== this.getPagesNum() - 1
            ? 1 & n
              ? "left"
              : "right"
            : "full";
        }),
        (Pdf.prototype.getPage = function (n) {
          return this.handler.getPage(
            this.doubledPages ? Math.ceil(n / 2) + 1 : n + 1
          );
        }),
        (Pdf.prototype.getDestination = function (dest) {
          var _this2 = this,
            destPromise = void 0;
          return (
            (destPromise =
              "string" == typeof dest
                ? this.handler.getDestination(dest)
                : Promise.resolve(dest)),
            (destPromise = destPromise
              .then(function (dest) {
                return _this2.handler.getPageIndex(dest[0]);
              })
              .then(function (number) {
                return _this2.doubledPages
                  ? number < 1
                    ? number
                    : 1 + 2 * (number - 1)
                  : number;
              })
              .catch(function () {
                return console.error("Bad bookmark");
              }))
          );
        }),
        (Pdf.prototype.dispose = function () {
          this.handlerQueue.splice(0, this.handlerQueue.length),
            delete this.handler;
        }),
        (Pdf.prototype.setLoadingProgressClb = function (clb) {
          this.loadingProgress = clb;
        }),
        (Pdf.prototype.setErrorHandler = function (eh) {
          this.errorHandler = eh;
        }),
        (Pdf.prototype.getPagesNum = function () {
          return this.handler
            ? this.doubledPages
              ? 2 * (this.handler.numPages - 1)
              : this.handler.numPages
            : void 0;
        }),
        (Pdf.getPageSize = function (page) {
          var x = page.view[2] - page.view[0],
            y = page.view[3] - page.view[1],
            a = (page.rotate * Math.PI) / 180;
          return {
            width: Math.abs(x * Math.cos(a) - y * Math.sin(a)),
            height: Math.abs(x * Math.sin(a) + y * Math.cos(a)),
          };
        }),
        (Pdf.prototype.getHandler = function (clb) {
          this.handler ? clb(this.handler) : this.handlerQueue.push(clb);
        }),
        Pdf
      );
    })();
    exports.default = Pdf;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      ThreeEventConverterFs = (function () {
        function ThreeEventConverterFs(visualWorld) {
          var test =
            arguments.length > 1 && void 0 !== arguments[1]
              ? arguments[1]
              : ThreeEventConverterFs.objectsAndFacesTest;
          _classCallCheck(this, ThreeEventConverterFs),
            (this.visual = visualWorld),
            (this.coords = new _libs.THREE.Vector2()),
            (this.raycaster = this.visual.raycaster),
            (this.camera = this.visual.camera),
            (this.threes = []),
            (this.test = test);
        }
        return (
          (ThreeEventConverterFs.objectsTest = function (object1, object2) {
            return !(!object1 || !object2) && object1.object === object2.object;
          }),
          (ThreeEventConverterFs.objectsAndFacesTest = function (
            object1,
            object2
          ) {
            return (
              !(!object1 || !object2) &&
              object1.object === object2.object &&
              object1.face.materialIndex === object2.face.materialIndex
            );
          }),
          (ThreeEventConverterFs.prototype.addThree = function (three) {
            this.threes.push(three);
          }),
          (ThreeEventConverterFs.prototype.removeThree = function (three) {
            var i = this.threes.indexOf(three);
            ~i && this.threes.splice(i, 1);
          }),
          (ThreeEventConverterFs.prototype.getObject = function (e) {
            return (
              this.setCoordsFromEvent(e),
              this.raycaster.setFromCamera(this.coords, this.camera),
              this.raycaster.intersectObjects(this.threes)[0]
            );
          }),
          ThreeEventConverterFs
        );
      })();
    exports.default = ThreeEventConverterFs;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _BaseMathUtils = __webpack_require__(2),
      _BaseMathUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_BaseMathUtils),
      ThreeUtils = (function () {
        function ThreeUtils() {
          _classCallCheck(this, ThreeUtils);
        }
        return (
          (ThreeUtils.vertices2UVs = function (
            vertices,
            indeces,
            first,
            last,
            converClb
          ) {
            for (var r = [], i = first; i < last; ++i)
              for (
                var vis = [indeces[i].a, indeces[i].b, indeces[i].c], j = 0;
                j < vis.length;
                ++j
              )
                r[vis[j]] || (r[vis[j]] = converClb(vertices[vis[j]]));
            return r;
          }),
          (ThreeUtils.computeFaceVertexUvs = function (geometry, faces) {
            for (
              var uvs = [
                  ThreeUtils.vertices2UVs(
                    geometry.vertices,
                    geometry.faces,
                    0,
                    faces[0],
                    function (p) {
                      return new THREE.Vector2(p.x, 1 - p.z);
                    }
                  ),
                  ThreeUtils.vertices2UVs(
                    geometry.vertices,
                    geometry.faces,
                    faces[0],
                    faces[1],
                    function (p) {
                      return new THREE.Vector2(1 - p.x, 1 - p.z);
                    }
                  ),
                  ThreeUtils.vertices2UVs(
                    geometry.vertices,
                    geometry.faces,
                    faces[1],
                    faces[2],
                    function (p) {
                      return new THREE.Vector2(p.x, p.y);
                    }
                  ),
                  ThreeUtils.vertices2UVs(
                    geometry.vertices,
                    geometry.faces,
                    faces[2],
                    faces[3],
                    function (p) {
                      return new THREE.Vector2(1 - p.x, p.y);
                    }
                  ),
                  ThreeUtils.vertices2UVs(
                    geometry.vertices,
                    geometry.faces,
                    faces[3],
                    faces[4],
                    function (p) {
                      return new THREE.Vector2(p.z, p.y);
                    }
                  ),
                  ThreeUtils.vertices2UVs(
                    geometry.vertices,
                    geometry.faces,
                    faces[4],
                    geometry.faces.length,
                    function (p) {
                      return new THREE.Vector2(1 - p.z, p.y);
                    }
                  ),
                ],
                uvsi = 0,
                i = 0;
              i < geometry.faces.length;
              ++i
            ) {
              uvsi += faces[uvsi] === i;
              var f = geometry.faces[i];
              (f.materialIndex = uvsi),
                (geometry.faceVertexUvs[0][i] = [
                  uvs[uvsi][f.a],
                  uvs[uvsi][f.b],
                  uvs[uvsi][f.c],
                ]);
            }
          }),
          (ThreeUtils.createMarker = function (p, c, size) {
            var marker = new THREE.Mesh(
              new THREE.SphereGeometry(size),
              new THREE.MeshPhongMaterial({ color: c })
            );
            return marker.position.set(p.x, p.y, p.z), marker;
          }),
          (ThreeUtils.findUvTris = function (geometry, ps, first, last) {
            for (
              var res = [],
                _iterator = ps,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              for (
                var p = _ref, found = !1, i = first;
                i < last && !found;
                ++i
              ) {
                var tri = geometry.faceVertexUvs[0][i];
                _BaseMathUtils2.default.isInsideConvPoly(tri, p) &&
                  (res.push({
                    coefs: _BaseMathUtils2.default.computeInterpCoefs(tri, p),
                    i: i,
                  }),
                  (found = !0));
              }
              found || (console.error("Bad point"), res.push(void 0));
            }
            return res;
          }),
          (ThreeUtils.findInternalVertices = function (
            geometry,
            ps,
            first,
            last
          ) {
            for (var res = {}, i = first; i < last; ++i)
              for (
                var tri = geometry.faceVertexUvs[0][i],
                  f = geometry.faces[i],
                  vs = [f.a, f.b, f.c],
                  j = 0;
                j < tri.length;
                ++j
              )
                void 0 === res[vs[j]] &&
                  _BaseMathUtils2.default.isInsidePoly(ps, tri[j]) &&
                  (res[vs[j]] = { p: tri[j], i: vs[j], n: f.vertexNormals[j] });
            return Object.values(res);
          }),
          ThreeUtils
        );
      })();
    exports.default = ThreeUtils;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _Controller2 = __webpack_require__(15),
      _Controller3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_Controller2),
      WidgetController = (function (_Controller) {
        function WidgetController(view, name) {
          _classCallCheck(this, WidgetController);
          var _this = _possibleConstructorReturn(this, _Controller.call(this));
          return (
            (_this.name = name),
            (_this.view = view),
            (_this.visible = !1),
            _this
          );
        }
        return (
          _inherits(WidgetController, _Controller),
          (WidgetController.prototype.togle = function () {
            (this.visible = !this.visible), this.fireChange();
          }),
          (WidgetController.prototype.hide = function () {
            (this.visible = !1), this.fireChange();
          }),
          (WidgetController.prototype.fireChange = function () {
            this.onChange && this.onChange(), this.updateView();
          }),
          (WidgetController.prototype.updateView = function () {
            this.view &&
              this.view.setState(this.name, {
                enable: !0,
                visible: this.visible,
                active: !1,
              });
          }),
          WidgetController
        );
      })(_Controller3.default);
    exports.default = WidgetController;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var Target = (function () {
      function Target() {
        _classCallCheck(this, Target);
      }
      return (
        (Target.test = function (object1, object2) {
          return object1.target === object2.target;
        }),
        Target
      );
    })();
    exports.default = Target;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(1),
      _Detector = __webpack_require__(48),
      _Detector2 = _interopRequireDefault(_Detector),
      _VisualWorld = __webpack_require__(70),
      _VisualWorld2 = _interopRequireDefault(_VisualWorld),
      _PdfLinksHandler = __webpack_require__(37),
      _PdfLinksHandler2 = _interopRequireDefault(_PdfLinksHandler),
      _Book = __webpack_require__(28),
      _Book2 = _interopRequireDefault(_Book),
      _BookView = __webpack_require__(31),
      _BookView2 = _interopRequireDefault(_BookView),
      _BookController = __webpack_require__(29),
      _BookController2 = _interopRequireDefault(_BookController),
      _PdfBookPropsBuilder = __webpack_require__(36),
      _PdfBookPropsBuilder2 = _interopRequireDefault(_PdfBookPropsBuilder),
      _ClbBookPropsBuilder = __webpack_require__(32),
      _ClbBookPropsBuilder2 = _interopRequireDefault(_ClbBookPropsBuilder),
      _LoadingController = __webpack_require__(56),
      _LoadingController2 = _interopRequireDefault(_LoadingController),
      _UserMessageController = __webpack_require__(68),
      _UserMessageController2 = _interopRequireDefault(_UserMessageController),
      _Search = __webpack_require__(61),
      _Search2 = _interopRequireDefault(_Search),
      _Bookmarks = __webpack_require__(47),
      _Bookmarks2 = _interopRequireDefault(_Bookmarks),
      _Thumbnails = __webpack_require__(66),
      _Thumbnails2 = _interopRequireDefault(_Thumbnails),
      _TocController = __webpack_require__(43),
      _TocController2 = _interopRequireDefault(_TocController),
      _ShareController = __webpack_require__(39),
      _ShareController2 = _interopRequireDefault(_ShareController),
      _BookPrinter = __webpack_require__(30),
      _BookPrinter2 = _interopRequireDefault(_BookPrinter),
      _AutoNavigator = __webpack_require__(26),
      _AutoNavigator2 = _interopRequireDefault(_AutoNavigator),
      _SoundsEnviroment = __webpack_require__(42),
      _SoundsEnviroment2 = _interopRequireDefault(_SoundsEnviroment),
      _FullScreenX = __webpack_require__(18),
      _FullScreenX2 = _interopRequireDefault(_FullScreenX);
    (_libs.$.fn.FlipBook = function (options) {
      var scene = {
        dispose: function () {
          this.ready
            ? (!scene.pdfLinksHandler || scene.pdfLinksHandler.dispose(),
              delete scene.pdfLinksHandler,
              scene.sounds.dispose(),
              delete scene.sounds,
              scene.userMessageCtrl.dispose(),
              delete scene.userMessageCtrl,
              scene.tocCtrl.dispose(),
              delete scene.tocCtrl,
              scene.thumbnails.dispose(),
              delete scene.thumbnails,
              !scene.bookmarks || scene.bookmarks.dispose(),
              delete scene.bookmarks,
              scene.shareCtrl.dispose(),
              delete scene.shareCtrl,
              scene.ctrl.dispose(),
              delete scene.ctrl,
              scene.bookPrinter.dispose(),
              delete scene.bookPrinter,
              scene.book.dispose(),
              delete scene.book,
              scene.propsBuilder.dispose(),
              delete scene.propsBuilder,
              delete scene.bookBuilder,
              scene.visual.dispose(),
              delete scene.visual,
              scene.view.dispose(),
              delete scene.view,
              delete scene.dispose)
            : (this.pendingDispose = !0);
        },
      };
      options = _extends({}, options);
      var parentContainer = this.length
        ? this[0]
        : (0, _libs.$)("<div>").appendTo("body");
      return (
        options.activateFullScreen &&
          _FullScreenX2.default.request(parentContainer),
        (scene.view = new _BookView2.default(
          parentContainer,
          function () {
            if (_Detector2.default.webgl) {
              (scene.loadingCtrl = new _LoadingController2.default(
                scene.view,
                !0,
                function (progress) {
                  return 0 === progress
                    ? (0, _libs.tr)("Please wait... the Application is Loading")
                    : (0, _libs.tr)("PDF is Loading:") + " " + progress + "%";
                }
              )),
                (scene.userMessageCtrl = new _UserMessageController2.default(
                  scene.view
                )),
                (scene.visual = new _VisualWorld2.default(
                  scene.view.getContainer().ownerDocument.defaultView,
                  scene.view.getContainer().ownerDocument,
                  scene.view.getView()
                )),
                options.propertiesCallback &&
                  new _ClbBookPropsBuilder2.default(
                    scene.visual,
                    function () {
                      return { type: "blank" };
                    },
                    1,
                    function (props) {
                      props = options.propertiesCallback(props);
                      var style = [];
                      "" !== props.backgroundColor &&
                        style.push(
                          "background-color:#" +
                            new THREE.Color(
                              props.backgroundColor
                            ).getHexString()
                        ),
                        "" !== props.backgroundImage &&
                          style.push(
                            "background-image:url('" +
                              props.backgroundImage +
                              "')"
                          ),
                        "" !== props.backgroundStyle &&
                          style.push(props.backgroundStyle),
                        style.length &&
                          scene.view.getView().attr("style", style.join(";"));
                    }
                  ),
                (scene.bookBuilder = function (props, sheets, pageCallback) {
                  (props.cssLayerProps = _extends({}, props.cssLayerProps, {
                    scene: scene,
                  })),
                    options.propertiesCallback &&
                      (props = options.propertiesCallback(props)),
                    (scene.book = new _Book2.default(
                      scene.visual,
                      sheets,
                      pageCallback,
                      props
                    )),
                    (scene.bookPrinter = new _BookPrinter2.default(
                      scene.visual,
                      scene.book,
                      (options.template || {}).printStyle
                    )),
                    scene.loadingCtrl.dispose(),
                    delete scene.loadingCtrl,
                    (scene.ctrl = new _BookController2.default(
                      scene.book,
                      scene.view,
                      options.controlsProps
                    )),
                    scene.book.setInjector(function (w) {
                      (w.jQuery = w.$ = _libs.$),
                        (w.book = scene.book),
                        (w.bookCtrl = scene.ctrl),
                        props.injector && props.injector(w);
                    }),
                    scene.view.addHandler(scene.ctrl),
                    scene.ctrl.setPrinter(scene.bookPrinter);
                  var test = pageCallback(0);
                  (scene.thumbnails = new _Thumbnails2.default(
                    scene.visual,
                    scene.view.getThumbnailsView(),
                    pageCallback,
                    scene.book.getPages(),
                    { kWtoH: props.width / props.height }
                  )),
                    (scene.tocCtrl = new _TocController2.default(
                      scene.view,
                      scene.ctrl
                    )),
                    scene.tocCtrl.setThumbnails(scene.thumbnails),
                    options.outline &&
                      ((scene.bookmarks = new _Bookmarks2.default(
                        scene.view.getBookmarksView(),
                        options.outline
                      )),
                      scene.tocCtrl.setBookmarks(scene.bookmarks)),
                    scene.ctrl.setTocCtrl(scene.tocCtrl),
                    scene.view.addHandler(scene.tocCtrl),
                    "pdf" === test.type &&
                      ((scene.search = new _Search2.default(
                        scene.view.getSearchView(),
                        scene.book.getPages()
                      )),
                      (scene.search.onQuery = scene.book.setQuery.bind(
                        scene.book
                      )),
                      scene.book.addEventListener(
                        "searchResults",
                        function (e) {
                          scene.search.setResults(e.results, e.lastPage);
                        }
                      ),
                      scene.tocCtrl.setSearch(scene.search),
                      scene.ctrl.setTocCtrl(scene.tocCtrl),
                      (scene.pdfLinksHandler = new _PdfLinksHandler2.default(
                        test.src,
                        scene.ctrl,
                        scene.visual.element
                      )),
                      scene.book.addEventListener(
                        "pdfAnnotation",
                        scene.pdfLinksHandler.handleEvent.bind(
                          scene.pdfLinksHandler
                        )
                      ),
                      scene.bookmarks ||
                        test.src.getHandler(function (handler) {
                          handler.getOutline().then(function (outline) {
                            outline &&
                              outline.length &&
                              ((scene.bookmarks = new _Bookmarks2.default(
                                scene.view.getBookmarksView(),
                                outline
                              )),
                              scene.tocCtrl.setBookmarks(
                                scene.bookmarks,
                                test.src
                              ),
                              scene.ctrl.setTocCtrl(scene.tocCtrl));
                          });
                        }),
                      options.pdfLinks &&
                        options.pdfLinks.handler &&
                        scene.pdfLinksHandler.setHandler(
                          options.pdfLinks.handler
                        )),
                    (scene.sounds = new _SoundsEnviroment2.default(
                      options.template
                    )),
                    scene.ctrl.setSounds(scene.sounds),
                    scene.sounds.subscribeFlips(scene.ctrl),
                    (scene.ready = !0);
                  var autoNavigator = new _AutoNavigator2.default(
                    scene.visual,
                    scene.ctrl,
                    options.autoNavigation
                  );
                  (scene.shareCtrl = new _ShareController2.default(
                    scene.view,
                    scene.ctrl,
                    options.shareLinkBuilder
                      ? options.shareLinkBuilder
                      : function (page) {
                          return new RegExp(
                            "([?&])" + autoNavigator.urlParam + "=[0-9]+"
                          ).test(location.href)
                            ? location.href.replace(
                                new RegExp(
                                  "([?&])" + autoNavigator.urlParam + "=[0-9]+"
                                ),
                                "$1" + autoNavigator.urlParam + "=" + page
                              )
                            : location.href.split("#")[0] +
                                (~location.href.indexOf("?") ? "&" : "?") +
                                autoNavigator.urlParam +
                                "=" +
                                page +
                                location.hash;
                        }
                  )),
                    scene.ctrl.setShareCtrl(scene.shareCtrl),
                    scene.view.addHandler(scene.shareCtrl),
                    autoNavigator.dispose(),
                    options.ready && options.ready(scene),
                    scene.ctrl.ready(scene),
                    scene.pendingDispose && scene.dispose();
                });
              var onError = function (e) {
                !scene.loadingCtrl || scene.loadingCtrl.dispose(),
                  delete scene.loadingCtrl,
                  scene.userMessageCtrl.setError(e.message);
              };
              options.pdf
                ? ((scene.propsBuilder = new _PdfBookPropsBuilder2.default(
                    options.pdf,
                    scene.bookBuilder,
                    options.bookStyle,
                    options.pdfOpenOptions
                  )),
                  scene.propsBuilder.pdf.setLoadingProgressClb(
                    scene.loadingCtrl.setProgress.bind(scene.loadingCtrl)
                  ),
                  scene.propsBuilder.pdf.setErrorHandler(
                    options.error || onError
                  ))
                : options.pageCallback
                ? (options.onPageCallbackError &&
                    options.onPageCallbackError.push(options.error || onError),
                  (scene.propsBuilder = new _ClbBookPropsBuilder2.default(
                    scene.visual,
                    options.pageCallback,
                    options.pages,
                    scene.bookBuilder,
                    options.bookStyle
                  )))
                : (scene.propsBuilder = new _ClbBookPropsBuilder2.default(
                    scene.visual,
                    _Book2.default.pageCallback,
                    6,
                    scene.bookBuilder,
                    options.bookStyle
                  ));
            } else
              _Detector2.default.addGetWebGLMessage({
                parent: scene.view.getView(),
              });
          },
          options.template
        )),
        scene
      );
    }),
      (0, _libs.$)(function () {
        for (
          var containers = (0, _libs.$)(".flip-book-container"), i = 0;
          i < containers.length;
          ++i
        ) {
          var jContainer = (0, _libs.$)(containers[i]),
            src = jContainer.attr("src");
          src && jContainer.FlipBook({ pdf: src });
        }
      }),
      (window.jQuery = window.$ = _libs.$);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    Array.prototype.fill ||
      (Array.prototype.fill = function (value) {
        if (null == this) throw new TypeError("this is null or not defined");
        for (
          var O = Object(this),
            len = O.length >>> 0,
            start = arguments[1],
            relativeStart = start >> 0,
            k =
              relativeStart < 0
                ? Math.max(len + relativeStart, 0)
                : Math.min(relativeStart, len),
            end = arguments[2],
            relativeEnd = void 0 === end ? len : end >> 0,
            final =
              relativeEnd < 0
                ? Math.max(len + relativeEnd, 0)
                : Math.min(relativeEnd, len);
          k < final;

        )
          (O[k] = value), k++;
        return O;
      }),
      Array.prototype.find ||
        Object.defineProperty(Array.prototype, "find", {
          value: function (predicate) {
            if (null == this)
              throw new TypeError(
                "Array.prototype.find called on null or undefined"
              );
            if ("function" != typeof predicate)
              throw new TypeError("predicate must be a function");
            for (
              var value,
                list = Object(this),
                length = list.length >>> 0,
                thisArg = arguments[1],
                i = 0;
              i < length;
              i++
            )
              if (((value = list[i]), predicate.call(thisArg, value, i, list)))
                return value;
          },
        }),
      Array.prototype.findIndex ||
        (Array.prototype.findIndex = function (predicate) {
          if (null == this)
            throw new TypeError(
              "Array.prototype.findIndex called on null or undefined"
            );
          if ("function" != typeof predicate)
            throw new TypeError("predicate must be a function");
          for (
            var value,
              list = Object(this),
              length = list.length >>> 0,
              thisArg = arguments[1],
              i = 0;
            i < length;
            i++
          )
            if (((value = list[i]), predicate.call(thisArg, value, i, list)))
              return i;
          return -1;
        }),
      Object.values ||
        (Object.values = function (O) {
          return (
            Object.keys(O).map(function (name) {
              return O[name];
            }) || []
          );
        }),
      RegExp.escape ||
        (RegExp.escape = function (s) {
          return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
        }),
      String.prototype.replaceAll ||
        (String.prototype.replaceAll = function (search, replace) {
          return this.replace(new RegExp(RegExp.escape(search), "g"), replace);
        }),
      String.prototype.fb3dQFilter ||
        (String.prototype.fb3dQFilter = function () {
          return this.replace(/(\n|\t|  )/g, "");
        });
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      AutoNavigator = (function () {
        function AutoNavigator(context, bookCtrl) {
          var props =
            arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
          _classCallCheck(this, AutoNavigator),
            (props = _extends({}, props, {
              urlParam: props.urlParam || "fb3d-page",
              navigates: void 0 === props.navigates ? 1 : props.navigates,
              pageN: props.pageN || 0,
            })),
            (this.props = props),
            (this.context = context),
            (this.bookCtrl = bookCtrl),
            (this.urlParam = props.urlParam),
            (this.pageN = props.pageN),
            (this.wnd = context.wnd),
            (this.wnd.fb3d = _extends({}, this.wnd.fb3d)),
            (this.wnd.fb3d.navigator = _extends({}, this.wnd.fb3d.navigator)),
            (this.navigator = this.wnd.fb3d.navigator[this.urlParam] =
              _extends({}, this.wnd.fb3d.navigator[this.urlParam])),
            (this.navigator.instances = (this.navigator.instances || 0) + 1),
            this.navigator.instances <= this.props.navigates &&
              this.bookCtrl.goToPage(this.getPageNumber());
        }
        return (
          (AutoNavigator.prototype.dispose = function () {}),
          (AutoNavigator.prototype.getParameterByName = function (name, url) {
            url || (url = window.location.href),
              (name = name.replace(/[\[\]]/g, "\\$&"));
            var regex = new RegExp("[?&]" + name + "(=([^]*)|&|#|$)"),
              results = regex.exec(url);
            return results
              ? results[2]
                ? decodeURIComponent(results[2].replace(/\+/g, " "))
                : ""
              : null;
          }),
          (AutoNavigator.prototype.getPageNumber = function () {
            var number = parseInt(this.pageN);
            return (
              (isNaN(number) || 0 === number) &&
                ((number = this.getParameterByName(this.urlParam)),
                (number = parseInt(number)),
                isNaN(number) && (number = 1)),
              number - 1
            );
          }),
          AutoNavigator
        );
      })();
    exports.default = AutoNavigator;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(1),
      _MathUtils = __webpack_require__(5),
      _MathUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_MathUtils),
      Binder = (function () {
        function Binder(visual, p) {
          var _this = this,
            hidden =
              arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
          _classCallCheck(this, Binder),
            (this.visual = visual),
            (this.p = _extends({}, p, {
              backSize: 2 * p.cover.depth + p.sheets * p.page.depth,
            })),
            (this.OZ = new _libs.THREE.Vector3(0, 0, 1)),
            (this.backG = new _libs.THREE.BoxGeometry(
              0.001,
              this.p.backSize,
              p.cover.height
            ));
          var color = { color: p.cover.color },
            transparent = { opacity: 0, transparent: !0 };
          this.materials = [
            new _libs.THREE.MeshPhongMaterial(color),
            new _libs.THREE.MeshPhongMaterial(color),
            new _libs.THREE.MeshPhongMaterial(transparent),
            new _libs.THREE.MeshPhongMaterial(transparent),
            new _libs.THREE.MeshPhongMaterial(transparent),
            new _libs.THREE.MeshPhongMaterial(transparent),
          ];
          var backM = new _libs.THREE.Mesh(this.backG, this.materials);
          "" !== p.cover.binderTexture &&
            this.visual.textureLoader.load(
              p.cover.binderTexture,
              function (texture) {
                _this.materials[1].color.setHex(16777215),
                  (_this.materials[1].map = texture),
                  (texture.minFilter = _libs.THREE.LinearFilter),
                  (texture.needsUpdate = !0),
                  (_this.materials[1].needsUpdate = !0);
              }
            ),
            (this.three = new _libs.THREE.Object3D()),
            (this.back = new _libs.THREE.Object3D()),
            (this.backRT = new _libs.THREE.Object3D()),
            (this.backRR = new _libs.THREE.Object3D()),
            (this.backLT = new _libs.THREE.Object3D()),
            (this.backLR = new _libs.THREE.Object3D()),
            (this.leftPivot = new _libs.THREE.Object3D()),
            (this.rightPivot = new _libs.THREE.Object3D()),
            hidden ||
              (backM.position.set(0.5 * (p.cover.depth - 0.001), 0, 0),
              this.back.add(backM)),
            this.back.add(this.leftPivot),
            this.back.add(this.rightPivot),
            this.backRT.add(this.back),
            this.backRR.add(this.backRT),
            this.backLT.add(this.backRR),
            this.backLR.add(this.backLT),
            this.three.add(this.backLR);
        }
        return (
          (Binder.prototype.dispose = function () {
            for (
              var _iterator = this.materials,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var m = _ref;
              m.map && ((m.map = null), (m.needsUpdate = !0)), m.dispose();
            }
            delete this.materials, this.backG.dispose();
          }),
          (Binder.prototype.set = function (angle) {
            var right = void 0,
              left = void 0;
            angle > Math.PI / 2
              ? ((right = Math.PI / 2), (left = angle - Math.PI / 2))
              : ((right = angle), (left = 0));
            var p = this.p,
              tr1 = {
                x: -0.5 * p.cover.depth,
                y: 0.5 * p.backSize - p.cover.depth,
              };
            this.backRT.position.set(tr1.x, tr1.y, 0),
              this.backRR.position.set(-tr1.x, -tr1.y, 0),
              this.backRR.quaternion.setFromAxisAngle(this.OZ, right);
            var tr2 = {
              x: p.backSize - 2 * p.cover.depth - 0.5 * p.cover.depth,
              y: 0.5 * p.backSize - p.cover.depth,
            };
            this.backLT.position.set(tr2.x, tr2.y, 0),
              this.backLR.position.set(-tr2.x, -tr2.y, 0),
              this.backLR.quaternion.setFromAxisAngle(this.OZ, left);
          }),
          (Binder.prototype.setLeft = function (angle) {
            var PI = Math.PI;
            this.leftPivot.position.set(
              _MathUtils2.default.interpolateLinear(
                [-PI, -PI / 2],
                [0, this.p.cover.depth],
                angle
              ),
              0.5 * this.p.backSize - 0.5 * this.p.cover.depth,
              0
            ),
              this.leftPivot.quaternion.setFromAxisAngle(this.OZ, angle);
          }),
          (Binder.prototype.setRight = function (angle) {
            var PI = Math.PI;
            this.rightPivot.position.set(
              _MathUtils2.default.interpolateLinear(
                [-PI / 2, 0],
                [this.p.cover.depth, 0],
                angle
              ),
              -0.5 * this.p.backSize + 0.5 * this.p.cover.depth,
              0
            ),
              this.rightPivot.quaternion.setFromAxisAngle(this.OZ, angle);
          }),
          (Binder.prototype.joinLeftCover = function (cover) {
            cover.three.position.set(0, -0.5 * this.p.cover.depth, 0),
              this.leftPivot.add(cover.three);
          }),
          (Binder.prototype.disconnectLeftCover = function (cover) {
            this.leftPivot.remove(cover.three);
          }),
          (Binder.prototype.joinRightCover = function (cover) {
            cover.three.position.set(0, -0.5 * this.p.cover.depth, 0),
              this.rightPivot.add(cover.three);
          }),
          (Binder.prototype.disconnectRightCover = function (cover) {
            this.rightPivot.remove(cover.three);
          }),
          Binder
        );
      })();
    exports.default = Binder;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(1),
      _book = __webpack_require__(11),
      _GraphUtils = __webpack_require__(4),
      _GraphUtils2 = _interopRequireDefault(_GraphUtils),
      _Binder = __webpack_require__(27),
      _Binder2 = _interopRequireDefault(_Binder),
      _Cover = __webpack_require__(33),
      _Cover2 = _interopRequireDefault(_Cover),
      _SheetBlock = __webpack_require__(10),
      _SheetBlock2 = _interopRequireDefault(_SheetBlock),
      _SheetPhysics = __webpack_require__(41),
      _SheetPhysics2 = _interopRequireDefault(_SheetPhysics),
      _PageManager = __webpack_require__(35),
      _PageManager2 = _interopRequireDefault(_PageManager),
      _CSSLayer = __webpack_require__(13),
      _CSSLayer2 = _interopRequireDefault(_CSSLayer),
      _CssLayersManager = __webpack_require__(34),
      _CssLayersManager2 = _interopRequireDefault(_CssLayersManager),
      _SearchEngine = __webpack_require__(38),
      _SearchEngine2 = _interopRequireDefault(_SearchEngine),
      _CustomEventConverter = __webpack_require__(16),
      _CustomEventConverter2 = _interopRequireDefault(_CustomEventConverter),
      _CircleTarget = __webpack_require__(72),
      _CircleTarget2 = _interopRequireDefault(_CircleTarget),
      _YouTubeApi = __webpack_require__(71),
      _YouTubeApi2 = _interopRequireDefault(_YouTubeApi),
      Book = (function (_THREE$EventDispatche) {
        function Book(visual, sheets, pageCallback, props) {
          _classCallCheck(this, Book);
          var _this = _possibleConstructorReturn(
            this,
            _THREE$EventDispatche.call(this)
          );
          (_this.cssFs = {
            play: function (player) {
              if (player.play)
                (player.fb3dNoPlay = !1),
                  (player.play() || { catch: function () {} }).catch(function (
                    e
                  ) {
                    player.fb3dNoPlay ||
                      "NotAllowedError" !== e.name ||
                      (_this.pendingPlayers.push(player),
                      _this.dispatchEvent({ type: "pendingPlayers" }));
                  });
              else if ((0, _libs.$)(player).hasClass("youtube")) {
                var p = player.player;
                (player.fb3dNoPlay = !1),
                  p && p.playVideo
                    ? p.playVideo()
                    : setTimeout(function () {
                        player.fb3dNoPlay || _this.cssFs.play(player);
                      }, 200);
              }
            },
            pause: function (player) {
              if (player.pause) (player.fb3dNoPlay = !0), player.pause();
              else if ((0, _libs.$)(player).hasClass("youtube")) {
                var p = player.player;
                (player.fb3dNoPlay = !0), p && p.pauseVideo && p.pauseVideo();
              }
            },
          }),
            (_this.visual = visual),
            (_this.mouseController = !0),
            (_this.p = _extends(
              {},
              _this.prepareProps(_extends({}, props, { sheets: sheets })),
              {
                pageCallback: pageCallback,
                zoom: 1,
                singlePage: !1,
                autoResolution: { enabled: !1 },
              }
            )),
            (_this.userDirection = { lastTopPage: 0, direction: 1 }),
            (_this.pageManager = new _PageManager2.default(
              visual,
              _this,
              _this.p
            )),
            _CSSLayer2.default.init(visual.doc),
            (_this.layerManager = new _CssLayersManager2.default(_this)),
            (_this.searchEngine = new _SearchEngine2.default(
              pageCallback,
              2 * (sheets + 2)
            )),
            (_this.searchEngine.onPageHitsChanged = function (page, query) {
              _this.pageManager.refreshPageQuery(page, query),
                _this.dispatchEvent({
                  type: "searchResults",
                  results: _this.searchEngine.results,
                  lastPage: page,
                  query: query,
                });
            }),
            (_this.three = new _libs.THREE.Object3D()),
            (_this.binder = new _Binder2.default(
              visual,
              _this.p,
              _this.getPages() < 3
            )),
            _this.three.add(_this.binder.three);
          var coverP = { left: _this.p.cover, right: _this.p.cover };
          return (
            _this.enableMouse(_this.p.interactiveCorners),
            2 === _this.getPages() &&
              (_this.enableMouse(!1),
              (coverP[_this.p.rtl ? "left" : "right"] = _extends(
                {},
                _this.p.cover,
                { width: 1e-6, height: 1e-6 }
              ))),
            (_this.leftCover = new _Cover2.default(
              visual,
              _extends({}, _this.p, {
                cover: coverP.left,
                setTexture: _this.setLeftCoverTexture.bind(_this),
              }),
              Math.PI / 2,
              "opened"
            )),
            _this.binder.joinLeftCover(_this.leftCover),
            _this.subscribeSheetBlock(_this.leftCover, 0),
            (_this.rightCover = new _Cover2.default(
              visual,
              _extends({}, _this.p, {
                cover: coverP.right,
                setTexture: _this.setRightCoverTexture.bind(_this),
              }),
              0,
              "closed"
            )),
            _this.binder.joinRightCover(_this.rightCover),
            _this.subscribeSheetBlock(
              _this.rightCover,
              2 * (_this.p.sheets + 1)
            ),
            (_this.threeSheetBlocks = new _libs.THREE.Object3D()),
            _this.three.add(_this.threeSheetBlocks),
            _this.threeSheetBlocks.position.set(
              0.5 * _this.p.cover.depth - 0.5 * sheets * _this.p.page.depth,
              -0.5 * sheets * _this.p.page.depth,
              0
            ),
            (_this.sheetBlocks = []),
            sheets > 0 &&
              _this.addSheetBlock(
                0,
                new _SheetBlock2.default(
                  visual,
                  _extends({}, _this.p, {
                    setTexture: _this.setPageTexture.bind(_this),
                  }),
                  0,
                  sheets,
                  0,
                  "closed"
                )
              ),
            _this.reducePagesWidth(!0),
            _this.set(Math.PI / 2),
            (_this.openedBox = new _libs.THREE.Box3().setFromObject(
              _this.leftCover.three
            )),
            _this.openedBox.union(
              new _libs.THREE.Box3().setFromObject(_this.rightCover.three)
            ),
            (_this.angle = _this.p.rtl ? Math.PI : 0),
            (_this.closedAngle = 0),
            _this.set(_this.angle, 0),
            (_this.lastMousePos = { t: 0 }),
            (_this.pendingPlayers = []),
            _this.three.position.set(
              -0.5 * _this.p.cover.depth + 0.5 * sheets * _this.p.page.depth,
              0,
              0
            ),
            (_this.sheetPhysics = new _SheetPhysics2.default(
              _this.p.page.width / _this.p.scale,
              _this.p.gravity,
              _this.p.page.cornerDeviation
            )),
            (_this.binds = {
              update: _this.update.bind(_this),
              lastMousePos: function (e) {
                _this.lastMousePos = _extends({}, _this.lastMousePos, {
                  pageX: e.pageX,
                  pageY: e.pageY,
                });
              },
            }),
            _this.visual.addRenderCallback(_this.binds.update),
            (0, _libs.$)(_this.visual.element).on(
              "mousemove",
              _this.binds.lastMousePos
            ),
            (_this.binds.onPickCallback = _this.onPickCallback.bind(_this)),
            (_this.visual.drag.onPickCallback = _this.binds.onPickCallback),
            (_this.binds.onDragCallback = _this.onDragCallback.bind(_this)),
            (_this.visual.drag.onDragCallback = _this.binds.onDragCallback),
            (_this.binds.onReleaseCallback =
              _this.onReleaseCallback.bind(_this)),
            (_this.visual.drag.onReleaseCallback =
              _this.binds.onReleaseCallback),
            (_this.dragAngle = 0.05),
            (_this.tmp = {
              boxs: [new _libs.THREE.Box3(), new _libs.THREE.Box3()],
            }),
            _this.visual.addObject(_this.three),
            (_this.tmpBox = new _libs.THREE.Box3()),
            (_this.bookShadowMaterial = new _libs.THREE.MeshPhongMaterial({
              color: 0,
              side: _libs.THREE.DoubleSide,
              transparent: !0,
            })),
            (_this.bookShadow = new _libs.THREE.Mesh(
              new _libs.THREE.PlaneGeometry(1, 1).rotateX(-Math.PI / 2),
              _this.bookShadowMaterial
            )),
            _this.visual.addObject(_this.bookShadow),
            _this.calculateShadow(),
            _this.visual.addEventListener(
              "resize",
              _this.pageManager.refreshZoom.bind(_this.pageManager)
            ),
            setTimeout(function () {
              _this.isProcessing() ||
                (_this.notifyBeforeAnimation(), _this.notifyAfterAnimation());
            }, 100),
            _this.updateThree(),
            _this
          );
        }
        return (
          _inherits(Book, _THREE$EventDispatche),
          (Book.prototype.calculateShadow = function () {
            var box = this.tmpBox;
            box.setFromObject(this.three),
              this.bookShadow.scale.set(
                box.max.x - box.min.x,
                1,
                box.max.z - box.min.z
              );
            this.bookShadow.position.set(
              0.5 * (box.max.x + box.min.x) - 0.015,
              box.min.y - 0.0015,
              0.5 * (box.max.z + box.min.z) - 0.015
            ),
              (this.bookShadowMaterial.opacity = 0.03),
              this.visual.shadowPlace.position.set(0, box.min.y - 0.015, 0);
          }),
          (Book.prototype.dispose = function () {
            this.visual.removeObject(this.three),
              this.sheetPhysics.dispose(),
              delete this.visual.drag.onPickCallback,
              delete this.visual.drag.onDragCallback,
              delete this.visual.drag.onReleaseCallback,
              (0, _libs.$)(this.visual.element).off(
                "mousemove",
                this.binds.lastMousePos
              ),
              this.visual.removeRenderCallback(this.binds.update),
              this.removeSheetBlocks(0, this.sheetBlocks.length),
              this.binder.disconnectLeftCover(this.leftCover),
              this.removeSheetBlock(this.leftCover),
              this.binder.disconnectRightCover(this.rightCover),
              this.removeSheetBlock(this.rightCover),
              this.binder.dispose(),
              this.layerManager.dispose(),
              _CSSLayer2.default.dispose(),
              this.pageManager.dispose();
          }),
          (Book.prototype.hasPendingPlayers = function () {
            return this.pendingPlayers.length > 0;
          }),
          (Book.prototype.resolvePendingPlayers = function () {
            for (
              var _iterator = this.pendingPlayers,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              _ref.play();
            }
            (this.pendingPlayers = []),
              this.dispatchEvent({ type: "pendingPlayers" });
          }),
          (Book.prototype.updateThree = function () {
            this.three.userData.needsUpdate = !0;
          }),
          (Book.prototype.setAutoResolution = function (autoResolution) {
            this.p.autoResolution = _extends(
              {},
              this.p.autoResolution,
              autoResolution
            );
          }),
          (Book.prototype.setZoom = function (zoom, singlePage) {
            (Math.abs(this.p.zoom - zoom) > 0.001 ||
              singlePage !== this.p.singlePage) &&
              ((this.p.zoom = zoom),
              (this.p.singlePage = singlePage),
              this.pageManager.refreshZoom());
          }),
          (Book.prototype.getPageCallback = function () {
            return this.p.pageCallback;
          }),
          (Book.prototype.setQuery = function (query) {
            this.searchEngine.setQuery(query);
          }),
          (Book.prototype.isProcessing = function () {
            return 0 !== this.sheetPhysics.getSize();
          }),
          (Book.prototype.getPages = function () {
            return this.p.pages;
          }),
          (Book.prototype.getBookPages = function () {
            return 4 + 2 * this.p.sheets;
          }),
          (Book.prototype.setFlipProgressClb = function (clb) {
            this.p.flipProgressClb = clb;
          }),
          (Book.prototype.setInjector = function (injector) {
            this.p.injector = injector;
          }),
          (Book.prototype.isActivePage = function (n) {
            var res = !0;
            if (n > 1 && n < this.getBookPages() - 2)
              for (
                var _iterator2 = this.sheetBlocks,
                  _isArray2 = Array.isArray(_iterator2),
                  _i2 = 0,
                  _iterator2 = _isArray2
                    ? _iterator2
                    : _iterator2[Symbol.iterator]();
                ;

              ) {
                var _ref2;
                if (_isArray2) {
                  if (_i2 >= _iterator2.length) break;
                  _ref2 = _iterator2[_i2++];
                } else {
                  if (((_i2 = _iterator2.next()), _i2.done)) break;
                  _ref2 = _i2.value;
                }
                var b = _ref2;
                if (n - 2 > 2 * b.p.first && n - 2 < 2 * b.p.last - 1) {
                  res = !1;
                  break;
                }
              }
            return res;
          }),
          (Book.prototype.getBlockByPage = function (n) {
            var block = void 0;
            if (n < 2) block = this.leftCover;
            else if (n < 2 * (this.p.sheets + 1))
              for (
                var _iterator3 = this.sheetBlocks,
                  _isArray3 = Array.isArray(_iterator3),
                  _i3 = 0,
                  _iterator3 = _isArray3
                    ? _iterator3
                    : _iterator3[Symbol.iterator]();
                ;

              ) {
                var _ref3;
                if (_isArray3) {
                  if (_i3 >= _iterator3.length) break;
                  _ref3 = _iterator3[_i3++];
                } else {
                  if (((_i3 = _iterator3.next()), _i3.done)) break;
                  _ref3 = _i3.value;
                }
                var b = _ref3;
                if (n - 2 >= 2 * b.p.first && n - 2 < 2 * b.p.last) {
                  block = b;
                  break;
                }
              }
            else block = this.rightCover;
            return block;
          }),
          (Book.prototype.getBlockPages = function (block) {
            var range = void 0;
            switch (block) {
              case this.leftCover:
                range = [0, 1];
                break;
              case this.rightCover:
                range = [2 * (this.p.sheets + 1), 2 * (this.p.sheets + 1) + 1];
                break;
              default:
                range = block
                  ? [2 * (block.p.first + 1), 2 * (block.p.last + 1) - 1]
                  : void 0;
            }
            return range;
          }),
          (Book.prototype.getPage = function () {
            var PI = Math.PI,
              p = void 0;
            if (this.angle === PI / 2 || this.angle === (3 * PI) / 2) {
              for (
                var _iterator4 = this.sheetBlocks,
                  _isArray4 = Array.isArray(_iterator4),
                  _i4 = 0,
                  _iterator4 = _isArray4
                    ? _iterator4
                    : _iterator4[Symbol.iterator]();
                ;

              ) {
                var _ref4;
                if (_isArray4) {
                  if (_i4 >= _iterator4.length) break;
                  _ref4 = _iterator4[_i4++];
                } else {
                  if (((_i4 = _iterator4.next()), _i4.done)) break;
                  _ref4 = _i4.value;
                }
                var block = _ref4;
                if (block.angle <= PI / 2) {
                  p = this.getBlockPages(block)[0] - 1;
                  break;
                }
              }
              p || (p = this.getBookPages() - 3);
            } else
              this.angle < PI / 2
                ? (p = 0)
                : this.angle > (3 * PI) / 2
                ? (p = 1)
                : this.angle < PI
                ? (p = this.getBookPages() - 3)
                : this.angle >= PI && (p = this.getBookPages() - 1);
            return p;
          }),
          (Book.prototype.getTopPages = function () {
            var p = this.getPage();
            return 0 === p || p === this.getBookPages() - 1 ? [p] : [p, p + 1];
          }),
          (Book.prototype.getPageState = function (n) {
            return this.pageManager.getPageState(n);
          }),
          (Book.prototype.enableLoadingAnimation = function (enable) {
            this.pageManager.enableLoadingAnimation(enable);
          }),
          (Book.prototype.getLeftFlipping = function () {
            var block = void 0,
              left = this.sheetBlocks[0],
              PI = Math.PI;
            return (
              this.angle === PI
                ? this.getPages() > 1 && (block = this.rightCover)
                : left && "closed" === left.state && left.angle > PI / 2
                ? (block = left)
                : (this.angle !== PI / 2 && this.angle !== (3 * PI) / 2) ||
                  (this.p.rtl && this.getPages() !== this.getBookPages()) ||
                  (block = this.leftCover),
              block
            );
          }),
          (Book.prototype.getRightFlipping = function () {
            var block = void 0,
              right = this.sheetBlocks[this.sheetBlocks.length - 1],
              PI = Math.PI;
            return (
              0 === this.angle
                ? this.getPages() > 1 && (block = this.leftCover)
                : right && "closed" === right.state && right.angle <= PI / 2
                ? (block = right)
                : (this.angle !== PI / 2 && this.angle !== (3 * PI) / 2) ||
                  ((this.p.rtl || this.getPages() === this.getBookPages()) &&
                    (block = this.rightCover)),
              block
            );
          }),
          (Book.prototype.getClosedBlockAngle = function (angle) {
            var closedAngle = void 0,
              PI = Math.PI;
            if (this.leftCover.physicId) {
              var test = void 0;
              try {
                test = Math.abs(
                  this.sheetPhysics.getParametr(
                    this.leftCover.physicId,
                    "angle"
                  ) - angle
                );
              } catch (e) {
                test = 0;
              }
              closedAngle =
                angle > PI / 2 || test > PI / 6 ? PI / 2 : this.closedAngle;
            } else if (this.rightCover.physicId) {
              var _test = void 0;
              try {
                _test = Math.abs(
                  this.sheetPhysics.getParametr(
                    this.rightCover.physicId,
                    "angle"
                  ) - angle
                );
              } catch (e) {
                _test = 0;
              }
              closedAngle =
                angle < PI / 2 || _test > PI / 6
                  ? PI / 2 + 1e-7
                  : this.closedAngle;
            } else closedAngle = PI / 2 + 1e-7 * (0 !== angle);
            return {
              openedAngle: angle,
              closedAngle: closedAngle,
              binderTurn: this.closedAngle,
            };
          }),
          (Book.prototype.flipLeft = function () {
            var _this2 = this,
              size =
                arguments.length > 0 && void 0 !== arguments[0]
                  ? arguments[0]
                  : 1,
              progressClb =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : this.p.flipProgressClb;
            if (!this.flipDisabled) {
              this.sheetPhysics.getSize() || (this.flipDirection = "left");
              var block = void 0,
                res = void 0;
              if (this.sheetPhysics.getSize() < 25) {
                var left = this.sheetBlocks[0],
                  PI = Math.PI;
                this.angle === PI
                  ? (res = this.connectPhysics(
                      (block = this.rightCover),
                      this.p.cover.mass,
                      PI,
                      -this.p.cover.startVelocity,
                      this.p.cover.flexibility,
                      0,
                      function (angle, height) {
                        return _this2.set((3 * PI) / 2 - angle / 2, height);
                      },
                      function (angle, height) {
                        _this2.set((3 * PI) / 2 - angle / 2, 0),
                          _this2.setSheetBlocks(
                            angle ? PI : PI / 2 + 1e-7,
                            "closed"
                          );
                      },
                      progressClb
                    ))
                  : left && "closed" === left.state && left.angle > PI / 2
                  ? ((block =
                      size < left.getSize()
                        ? this.splitSheetBlock(0, left.getSize() - size)[1]
                        : left),
                    (res = this.connectPhysics(
                      block,
                      this.p.page.mass * block.getSize(),
                      PI,
                      -this.p.page.startVelocity,
                      this.p.page.flexibility,
                      0,
                      function (angle, height) {
                        return block.set(
                          _this2.getClosedBlockAngle(angle),
                          "opened",
                          height,
                          block.p.first,
                          block.p.last,
                          _this2.flipDirection
                        );
                      },
                      Book.finishAnimationClb.bind({
                        book: this,
                        block: block,
                      }),
                      progressClb
                    )))
                  : (this.angle !== PI / 2 && this.angle !== (3 * PI) / 2) ||
                    (res = this.connectPhysics(
                      (block = this.leftCover),
                      this.p.cover.mass,
                      PI,
                      -this.p.cover.startVelocity,
                      this.p.cover.flexibility,
                      0,
                      function (angle, height) {
                        _this2.set(2 * PI - angle / 2, height),
                          angle > PI / 2 &&
                            _this2.setSheetBlocks(angle ? PI / 2 : 0, "closed");
                      },
                      function (angle, height) {
                        return _this2.set(
                          0 === angle ? 0 : 2 * PI - angle / 2,
                          0
                        );
                      },
                      progressClb
                    ));
              }
              return res;
            }
          }),
          (Book.prototype.flipRight = function () {
            var _this3 = this,
              size =
                arguments.length > 0 && void 0 !== arguments[0]
                  ? arguments[0]
                  : 1,
              progressClb =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : this.p.flipProgressClb;
            if (!this.flipDisabled) {
              this.sheetPhysics.getSize() || (this.flipDirection = "right");
              var block = void 0,
                res = void 0;
              if (this.sheetPhysics.getSize() < 25) {
                var right = this.sheetBlocks[this.sheetBlocks.length - 1],
                  PI = Math.PI;
                0 === this.angle
                  ? (res = this.connectPhysics(
                      (block = this.leftCover),
                      this.p.cover.mass,
                      0,
                      this.p.cover.startVelocity,
                      this.p.cover.flexibility,
                      0,
                      function (angle, height) {
                        return _this3.set(angle / 2, height);
                      },
                      function (angle, height) {
                        _this3.set(angle / 2, 0),
                          _this3.setSheetBlocks(angle ? PI / 2 : 0, "closed");
                      },
                      progressClb
                    ))
                  : right && "closed" === right.state && right.angle <= PI / 2
                  ? ((block =
                      size < right.getSize()
                        ? this.splitSheetBlock(
                            this.sheetBlocks.length - 1,
                            size
                          )[0]
                        : right),
                    (res = this.connectPhysics(
                      block,
                      this.p.page.mass * block.getSize(),
                      0,
                      this.p.page.startVelocity,
                      this.p.page.flexibility,
                      0,
                      function (angle, height) {
                        return block.set(
                          _this3.getClosedBlockAngle(angle),
                          "opened",
                          height,
                          block.p.first,
                          block.p.last,
                          _this3.flipDirection
                        );
                      },
                      Book.finishAnimationClb.bind({
                        book: this,
                        block: block,
                      }),
                      progressClb
                    )))
                  : (this.angle !== PI / 2 && this.angle !== (3 * PI) / 2) ||
                    (res = this.connectPhysics(
                      (block = this.rightCover),
                      this.p.cover.mass,
                      0,
                      this.p.cover.startVelocity,
                      this.p.cover.flexibility,
                      0,
                      function (angle, height) {
                        _this3.set(PI / 2 + angle / 2, height),
                          angle < PI / 2 &&
                            _this3.setSheetBlocks(PI / 2 + 1e-7, "closed");
                      },
                      function (angle, height) {
                        return _this3.set(PI / 2 + angle / 2, 0);
                      },
                      progressClb
                    ));
              }
              return res;
            }
          }),
          (Book.prototype.clearHoverInfo = function () {
            this.pageManager.turnOnEvents(),
              delete this.hoverInfo.block.force,
              delete this.hoverInfo.block.cornerForce,
              delete this.hoverInfo;
          }),
          (Book.prototype.xSegment = function () {
            var boxs = this.tmp.boxs,
              res = {};
            return (
              this.leftCover.physicId
                ? (boxs[0].setFromObject(this.rightCover.three),
                  (res.min = -(res.max = boxs[0].max.x)))
                : this.rightCover.physicId
                ? (boxs[0].setFromObject(this.leftCover.three),
                  (res.max = -(res.min = boxs[0].min.x)))
                : (boxs[0].setFromObject(this.leftCover.three),
                  boxs[1].setFromObject(this.rightCover.three),
                  boxs[0].union(boxs[1]),
                  (res.min = boxs[0].min.x),
                  (res.max = boxs[0].max.x)),
              res
            );
          }),
          (Book.prototype.computeTarget = function (point) {
            var x = point.x,
              seg = (point.y, this.xSegment()),
              angle = void 0;
            return (
              (angle = ((seg.max - x) / (seg.max - seg.min)) * Math.PI),
              Math.max(
                this.dragAngle,
                Math.min(Math.PI - this.dragAngle, angle)
              )
            );
          }),
          (Book.prototype.onPickCallback = function (object) {
            var res = !1,
              block = object.object.userData.self,
              p = _extends({}, object.uv),
              i = object.face.materialIndex;
            return (
              i < 2 &&
                ((p.x = 0 === i ? p.x : 1 - p.x),
                block.cornerTarget.testIntersection(null, p) &&
                  block.physicId &&
                  (this.hoverInfo && this.clearHoverInfo(),
                  (block.force = _SheetPhysics2.default.dragForceClb),
                  (block.cornerForce =
                    _SheetPhysics2.default.getDragCornerForceClb(
                      this.computeTarget(object.point)
                    )),
                  (this.dragInfo = { object: object, block: block }),
                  (res = !0),
                  this.pageManager.turnOffEvents())),
              res
            );
          }),
          (Book.prototype.onDragCallback = function (point) {
            var block = this.dragInfo.block;
            block.getProps();
            return (
              (block.force = _SheetPhysics2.default.dragForceClb),
              (block.cornerForce = _SheetPhysics2.default.getDragCornerForceClb(
                this.computeTarget(point)
              )),
              !0
            );
          }),
          (Book.prototype.onReleaseCallback = function () {
            delete this.dragInfo.block.force,
              delete this.dragInfo.block.cornerForce,
              delete this.dragInfo,
              this.pageManager.turnOnEvents();
          }),
          (Book.prototype.getFlipping = function (i) {
            return i ? this.getLeftFlipping() : this.getRightFlipping();
          }),
          (Book.prototype.flip = function (i) {
            var size =
              arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : 1;
            return i ? this.flipLeft(size) : this.flipRight(size);
          }),
          (Book.prototype.enableMouse = function (enable) {
            this.mouseController = enable;
          }),
          (Book.prototype.cornerCallback = function (e, data) {
            var _this4 = this;
            if (this.mouseController) {
              var _data$data = data.data,
                i = _data$data.i,
                n = _data$data.n;
              if ("mouseover" === e.type) {
                if (this.hoverInfo && void 0 !== this.hoverInfo.pendings)
                  ++this.hoverInfo.pendings;
                else if (
                  (this.hoverInfo &&
                    (console.warn("Wrong state: element is already hover"),
                    this.hoverInfo.n !== n && this.clearHoverInfo()),
                  !this.hoverInfo && !this.dragInfo)
                ) {
                  var res = Promise.resolve(void 0),
                    hover = this.getBlockByPage(n),
                    possible = this.getFlipping(i);
                  if (
                    n > 1 &&
                    n < 2 * (this.p.sheets + 1) &&
                    hover.physicId &&
                    (hover.angle < 0.02 || hover.angle > Math.PI - 0.02)
                  )
                    res = Promise.resolve(hover);
                  else if (hover === possible) {
                    var sheetBlocks = [this.leftCover].concat(
                        this.sheetBlocks,
                        [this.rightCover]
                      ),
                      j = sheetBlocks.indexOf(hover),
                      nextBlock = ~j ? sheetBlocks[j + 2 * i - 1] : void 0;
                    (!nextBlock ||
                      !nextBlock.physicId ||
                      (nextBlock.angle > 0.02 &&
                        nextBlock.angle < Math.PI - 0.02)) &&
                      ((res = this.flip(i, 1).then(function (block) {
                        return (
                          block
                            ? _this4.sheetPhysics.setParametr(
                                block.physicId,
                                "velocity",
                                0
                              )
                            : delete _this4.hoverInfo,
                          block
                        );
                      })),
                      (this.hoverInfo = { pendings: 1 }));
                  }
                  res.then(function (block) {
                    if (
                      (_this4.hoverInfo &&
                        _this4.hoverInfo.pendings < 1 &&
                        ((block = void 0), delete _this4.hoverInfo),
                      block)
                    ) {
                      _this4.pageManager.turnOffEvents();
                      var p = block.getProps();
                      (block.force = _this4.sheetPhysics.getTargetForceClb(
                        p.mass * block.getSize(),
                        i ? Math.PI - 0.02 : 0.02
                      )),
                        (block.cornerForce = function () {
                          return (
                            (i ? -1 : 1) *
                            _SheetPhysics2.default.hoverCornerForceClb()
                          );
                        }),
                        _this4.sheetPhysics.setParametr(
                          block.physicId,
                          "angle",
                          i ? Math.PI - 0.01 : 0.01
                        ),
                        (_this4.hoverInfo = { n: n, block: block }),
                        _this4.update(1 / 30);
                    }
                  });
                }
              } else if (this.hoverInfo && "mouseout" === e.type)
                void 0 !== this.hoverInfo.pendings
                  ? --this.hoverInfo.pendings
                  : n === this.hoverInfo.n && this.clearHoverInfo();
              else if ("mousedown" === e.type)
                this.cornerClickData = { x: e.pageX, y: e.pageY };
              else if ("click" === e.type) {
                if (
                  Math.sqrt(
                    Math.pow(this.cornerClickData.x - e.pageX, 2) +
                      Math.pow(this.cornerClickData.y - e.pageY, 2)
                  ) < 5
                ) {
                  var _hover = this.getBlockByPage(n);
                  if (_hover.physicId) {
                    var id = _hover.physicId,
                      props = _hover.getProps();
                    this.sheetPhysics.setParametr(
                      id,
                      "velocity",
                      (i ? -1 : 1) * props.startVelocity
                    );
                  }
                }
                delete this.cornerClickData;
              }
            }
          }),
          (Book.prototype.addSheetBlock = function (p, block) {
            this.sheetBlocks.splice(p, 0, block),
              this.subscribeSheetBlock(block, 2),
              this.threeSheetBlocks.add(block.three);
          }),
          (Book.prototype.subscribeSheetBlock = function (block, offset) {
            var _this5 = this,
              eventConverter = new _CustomEventConverter2.default(
                this.visual.wnd,
                this.visual.doc,
                _CircleTarget2.default.test
              ),
              target = new _CircleTarget2.default(0.925, 0.075, 0.15);
            (target.block = block),
              (target.callback = this.cornerCallback.bind(this)),
              eventConverter.addCustom(target),
              (block.cornerTarget = target),
              (block.three.userData.mouseCallback = function (e, data) {
                var i = data.face.materialIndex;
                if (i < 2) {
                  var n =
                    0 === i
                      ? offset + 2 * block.p.first
                      : offset + 2 * block.p.last - 1;
                  eventConverter.convert(e, {
                    x: 0 === i ? data.uv.x : 1 - data.uv.x,
                    y: data.uv.y,
                    i: i,
                    n: n,
                  }),
                    _this5.pageManager.transferEventToTexture(n, e, data);
                }
              }),
              (block.three.userData.touchCallback = function (e, data) {
                var i = data.face.materialIndex;
                if (i < 2) {
                  var n =
                    0 === i
                      ? offset + 2 * block.p.first
                      : offset + 2 * block.p.last - 1;
                  _this5.pageManager.transferEventToTexture(n, e, data);
                }
              }),
              this.visual.drag.addThree(block.three),
              this.visual.mouseEvents.addThree(block.three),
              this.visual.touchEvents.addThree(block.three);
          }),
          (Book.prototype.removeSheetBlock = function (block) {
            this.visual.mouseEvents.removeThree(block.three),
              this.visual.touchEvents.removeThree(block.three),
              this.visual.drag.removeThree(block.three),
              this.threeSheetBlocks.remove(block.three),
              block.dispose();
          }),
          (Book.prototype.removeSheetBlocks = function (first, size) {
            for (
              var blocks = this.sheetBlocks.splice(first, size),
                _iterator5 = blocks,
                _isArray5 = Array.isArray(_iterator5),
                _i5 = 0,
                _iterator5 = _isArray5
                  ? _iterator5
                  : _iterator5[Symbol.iterator]();
              ;

            ) {
              var _ref5;
              if (_isArray5) {
                if (_i5 >= _iterator5.length) break;
                _ref5 = _iterator5[_i5++];
              } else {
                if (((_i5 = _iterator5.next()), _i5.done)) break;
                _ref5 = _i5.value;
              }
              var block = _ref5;
              this.removeSheetBlock(block);
            }
          }),
          (Book.prototype.setTexture = function (material, n) {
            this.pageManager.setTexture(material, n);
          }),
          (Book.prototype.setPageTexture = function (material, n) {
            this.setTexture(material, n + 2);
          }),
          (Book.prototype.setLeftCoverTexture = function (material, n) {
            this.setTexture(material, n);
          }),
          (Book.prototype.setRightCoverTexture = function (material, n) {
            this.setTexture(material, n + 2 * (this.p.sheets + 1));
          }),
          (Book.finishAnimationClb = function (angle) {
            this.block.set(
              this.book.getClosedBlockAngle(angle).closedAngle,
              "closed",
              0
            );
            var i = this.book.sheetBlocks.indexOf(this.block);
            ~i &&
              (0 === angle
                ? this.book.mergeSheetBlocks(
                    i,
                    this.book.sheetBlocks.length - i
                  )
                : this.book.mergeSheetBlocks(0, i + 1));
          }),
          (Book.prototype.calcBlockForce = function (
            block,
            object,
            angle,
            velocity,
            cornerHeight
          ) {
            return block.force
              ? block.force(object, angle, velocity, cornerHeight)
              : 0;
          }),
          (Book.prototype.calcBlockCornerForce = function (
            block,
            object,
            angle,
            velocity,
            cornerHeight
          ) {
            return block.cornerForce
              ? block.cornerForce(object, angle, velocity, cornerHeight)
              : 0;
          }),
          (Book.prototype.setVisualMode = function (mode) {
            for (
              var l = Book.lightModes[this.p.lighting][mode],
                bs = [this.leftCover].concat(this.sheetBlocks, [
                  this.rightCover,
                ]),
                _iterator6 = bs,
                _isArray6 = Array.isArray(_iterator6),
                _i6 = 0,
                _iterator6 = _isArray6
                  ? _iterator6
                  : _iterator6[Symbol.iterator]();
              ;

            ) {
              var _ref6;
              if (_isArray6) {
                if (_i6 >= _iterator6.length) break;
                _ref6 = _iterator6[_i6++];
              } else {
                if (((_i6 = _iterator6.next()), _i6.done)) break;
                _ref6 = _i6.value;
              }
              var b = _ref6;
              b.mesh.receiveShadow = "live" === mode;
              for (
                var _iterator7 = b.materials,
                  _isArray7 = Array.isArray(_iterator7),
                  _i7 = 0,
                  _iterator7 = _isArray7
                    ? _iterator7
                    : _iterator7[Symbol.iterator]();
                ;

              ) {
                var _ref7;
                if (_isArray7) {
                  if (_i7 >= _iterator7.length) break;
                  _ref7 = _iterator7[_i7++];
                } else {
                  if (((_i7 = _iterator7.next()), _i7.done)) break;
                  _ref7 = _i7.value;
                }
                _ref7.needsUpdate = !0;
              }
            }
            this.visual.setLight(l.ambient, l.directional);
          }),
          (Book.prototype.notifyBeforeAnimation = function () {
            var _this6 = this,
              res = void 0;
            return (
              this.animationNotification
                ? (res = Promise.reject())
                : ((this.animationNotification = !0),
                  this.dispatchEvent({ type: "beforeAnimation" }),
                  this.setVisualMode("live"),
                  (this.flipDisabled = !0),
                  (res = this.layerManager.hide().then(function () {
                    return delete _this6.flipDisabled;
                  }))),
              res
            );
          }),
          (Book.prototype.notifyAfterAnimation = function () {
            if (this.animationNotification) {
              var p = this.getPage();
              this.userDirection.lastTopPage !== p &&
                ((this.userDirection.direction = Math.sign(
                  p - this.userDirection.lastTopPage
                )),
                (this.userDirection.lastTopPage = p)),
                delete this.animationNotification,
                this.setVisualMode("static"),
                this.layerManager.show(),
                this.dispatchEvent({ type: "afterAnimation" });
            }
          }),
          (Book.prototype.getUserDirection = function () {
            return this.userDirection;
          }),
          (Book.prototype.reducePagesWidth = function (reduceWidth) {
            for (
              var _iterator8 = this.sheetBlocks,
                _isArray8 = Array.isArray(_iterator8),
                _i8 = 0,
                _iterator8 = _isArray8
                  ? _iterator8
                  : _iterator8[Symbol.iterator]();
              ;

            ) {
              var _ref8;
              if (_isArray8) {
                if (_i8 >= _iterator8.length) break;
                _ref8 = _iterator8[_i8++];
              } else {
                if (((_i8 = _iterator8.next()), _i8.done)) break;
                _ref8 = _i8.value;
              }
              _ref8.reduceWidth(reduceWidth);
            }
          }),
          (Book.prototype.connectPhysics = function (
            block,
            mass,
            angle,
            velocity,
            flexibility,
            coverHeight,
            simulateClb,
            removeClb,
            progressClb
          ) {
            var _this7 = this,
              type = function () {
                return _this7.hoverInfo
                  ? "hover"
                  : _this7.dragInfo
                  ? "drag"
                  : "free";
              },
              res = this.sheetPhysics.getSize()
                ? Promise.resolve()
                : this.notifyBeforeAnimation();
            return (
              (block !== this.leftCover && block !== this.rightCover) ||
                (this.bookShadowMaterial.opacity = 0),
              res
                .then(function () {
                  return (
                    (block.physicId = _this7.sheetPhysics.addObject(
                      mass,
                      angle,
                      velocity,
                      flexibility,
                      coverHeight,
                      function (angl, ch) {
                        simulateClb(angl, ch),
                          progressClb(
                            block,
                            Math.abs(angle - angl) / Math.PI,
                            "process",
                            type()
                          ),
                          _this7.calculateShadow(),
                          _this7.updateThree();
                      },
                      function (angl, ch) {
                        if (
                          (removeClb(angl, ch),
                          delete block.physicId,
                          progressClb(
                            block,
                            Math.abs(angle - angl) / Math.PI,
                            "finish",
                            type()
                          ),
                          !_this7.sheetPhysics.getSize())
                        ) {
                          var p = _this7.getPage();
                          (0 !== p && p !== _this7.getPages() - 1) ||
                            _this7.reducePagesWidth(!0);
                        }
                        Promise.resolve().then(function () {
                          _this7.sheetPhysics.getSize() ||
                            (_this7.notifyAfterAnimation(),
                            _this7.calculateShadow());
                        }),
                          _this7.updateThree();
                      },
                      function (object, angle, velocity, cornerHeight) {
                        return _this7.calcBlockForce(
                          block,
                          object,
                          angle,
                          velocity,
                          cornerHeight
                        );
                      },
                      function (object, angle, velocity, cornerHeight) {
                        return _this7.calcBlockCornerForce(
                          block,
                          object,
                          angle,
                          velocity,
                          cornerHeight
                        );
                      }
                    )),
                    progressClb(block, 0, "init", type()),
                    1 === _this7.sheetPhysics.getSize() &&
                      _this7.reducePagesWidth(!1),
                    block
                  );
                })
                .catch(function () {})
            );
          }),
          (Book.prototype.update = function (dt) {
            var _this8 = this;
            (this.lastMousePos.t += dt),
              this.isProcessing() &&
                void 0 !== this.lastMousePos.pageX &&
                this.lastMousePos.t - (this.lastMousePos.lastT || 0) > 0.25 &&
                !this.hoverInfo &&
                !this.dragInfo &&
                ((this.lastMousePos.lastT = this.lastMousePos.t),
                Promise.resolve().then(function () {
                  (0, _libs.$)(_this8.visual.element).trigger(
                    _libs.$.Event("mousemove", _this8.lastMousePos)
                  );
                })),
              this.sheetPhysics.simulate(dt);
          }),
          (Book.prototype.splitSheetBlock = function (i, leftSize) {
            var block = this.sheetBlocks[i];
            if (block && leftSize < block.getSize()) {
              var newBlock = new _SheetBlock2.default(
                this.visual,
                _extends({}, this.p, {
                  setTexture: this.setPageTexture.bind(this),
                }),
                block.p.first,
                block.p.first + leftSize,
                block.angle,
                block.state
              );
              return (
                block.set(
                  block.angle,
                  block.state,
                  block.corner.height,
                  block.p.first + leftSize,
                  block.p.last
                ),
                this.addSheetBlock(i, newBlock),
                [newBlock, block]
              );
            }
          }),
          (Book.prototype.mergeSheetBlocks = function (first, size) {
            if (first < this.sheetBlocks.length) {
              size = Math.min(this.sheetBlocks.length - first, size);
              var firstBlock = this.sheetBlocks[first],
                lastBlock = this.sheetBlocks[first + size - 1];
              firstBlock.set(
                firstBlock.angle,
                firstBlock.state,
                firstBlock.corner.height,
                firstBlock.p.first,
                lastBlock.p.last
              ),
                this.removeSheetBlocks(first + 1, size - 1);
            }
          }),
          (Book.prototype.setSheetBlocks = function (angle, state) {
            "closed" === state && (this.closedAngle = angle),
              this.sheetBlocks.forEach(function (s) {
                s.physicId || s.set(angle, state);
              });
          }),
          (Book.prototype.set = function (angle) {
            var height =
              arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : 0;
            this.angle = angle;
            var PI = Math.PI;
            if (angle < PI / 4)
              this.binder.set(0),
                this.binder.setLeft(-PI / 2 + 2 * angle),
                this.leftCover.set(PI / 2, "opened", height),
                this.setSheetBlocks(0, "closed"),
                this.binder.setRight(0),
                this.rightCover.set(0, "closed", 0);
            else if (angle < (2 * PI) / 4) {
              var a = 2 * (angle - PI / 4);
              this.binder.set(a),
                this.binder.setLeft(-a),
                this.leftCover.set(PI / 2 + a, "opened", height),
                this.setSheetBlocks(a, "closed"),
                this.binder.setRight(-a),
                this.rightCover.set(a, "closed", 0);
            } else if (angle < (3 * PI) / 4) {
              var _a = 2 * (angle - PI / 2);
              this.binder.set(PI / 2),
                this.binder.setLeft(-PI / 2),
                this.leftCover.set(PI, "opened", 0),
                this.binder.setRight(-PI / 2),
                this.rightCover.set(_a, "opened", height);
            } else if (angle < (4 * PI) / 4) {
              var _a2 = 2 * (angle - (3 * PI) / 4) + PI / 2;
              this.binder.set(_a2),
                this.binder.setLeft(-_a2),
                this.leftCover.set(_a2, "closed", 0),
                this.setSheetBlocks(_a2, "closed"),
                this.binder.setRight(-PI / 2),
                this.rightCover.set(PI / 2, "opened", height);
            } else if (angle < (5 * PI) / 4)
              this.binder.set(PI),
                this.binder.setLeft(-PI),
                this.leftCover.set(PI, "closed", 0),
                this.setSheetBlocks(PI, "closed"),
                this.binder.setRight(-PI / 2 - 2 * (angle - PI)),
                this.rightCover.set(PI / 2, "opened", height);
            else if (angle < (6 * PI) / 4) {
              var _a3 = 2 * (angle - (5 * PI) / 4);
              this.binder.set(PI - _a3),
                this.binder.setLeft(-PI + _a3),
                this.leftCover.set(PI - _a3, "closed", 0),
                this.setSheetBlocks(PI - _a3, "closed"),
                this.binder.setRight(-PI + _a3),
                this.rightCover.set(PI / 2 - _a3, "opened", height);
            } else if (angle < (7 * PI) / 4) {
              var _a4 = 2 * (angle - (6 * PI) / 4);
              this.binder.set(PI / 2),
                this.binder.setLeft(-PI / 2),
                this.leftCover.set(PI - _a4, "opened", height),
                this.binder.setRight(-PI / 2),
                this.rightCover.set(0, "opened", 0);
            } else if (angle < (8 * PI) / 4) {
              var _a5 = 2 * (angle - (7 * PI) / 4);
              this.binder.set(PI / 2 - _a5),
                this.binder.setLeft(-PI / 2),
                this.leftCover.set(PI / 2, "opened", height),
                this.setSheetBlocks(PI / 2 - _a5, "closed"),
                this.binder.setRight(-PI / 2 + _a5),
                this.rightCover.set(PI / 2 - _a5, "closed", 0);
            }
          }),
          (Book.createSideTexture = function (color, type) {
            var c = _GraphUtils2.default.createCanvas(8, 8);
            if ("color" === type) {
              var ctx = c.getContext("2d");
              ctx.beginPath(),
                (ctx.fillStyle = _GraphUtils2.default.color2Rgba(color, 1)),
                ctx.rect(0, 0, 8, 7),
                ctx.fill(),
                ctx.beginPath(),
                (ctx.fillStyle = _GraphUtils2.default.color2Rgba(
                  _GraphUtils2.default.inverseColor(color, 0.5),
                  1
                )),
                ctx.rect(0, 7, 8, 1),
                ctx.fill();
            }
            return c;
          }),
          (Book.prototype.prepareProps = function (props) {
            return this.calcProps(Book.mergeProps((0, _book.props)(), props));
          }),
          (Book.mergeProps = function (first, second) {
            return (
              (second = second || {}),
              _extends({}, first, second, {
                sheet: _extends({}, first.sheet, second.sheet),
                cover: _extends({}, first.cover, second.cover),
                page: _extends({}, first.page, second.page),
                cssLayerProps: _extends(
                  {},
                  first.cssLayerProps,
                  second.cssLayerProps
                ),
              })
            );
          }),
          (Book.prototype.calcProps = function (props) {
            var depth = props.maxDepth / (props.sheets + 6),
              p = _extends({}, props, {
                sheet: _extends({}, props.sheet),
                cover: _extends({}, props.sheet, props.cover),
                page: _extends({}, props.sheet, props.page),
                cssLayerProps: _extends({}, props.cssLayerProps, {
                  $: _libs.$,
                }),
              });
            (p.cover.depth = Math.min(p.cover.depth, 3 * depth)),
              (p.page.depth = Math.min(p.page.depth, depth));
            var height = 10 * p.height,
              width = 10 * p.width,
              flexibleCornerK = Math.min(height, width) / width,
              flipProgressClb = function () {},
              sheet = {
                sideTexture:
                  p.sheet.sideTexture ||
                  Book.createSideTexture(p.sheet.color, p.sheet.side),
              },
              cover = _extends({}, sheet, p.cover, {
                flexibleCorner: flexibleCornerK * p.cover.flexibleCorner,
                depth: 10 * p.cover.depth,
                width: width,
                height: height,
                padding: 10 * p.cover.padding,
              }),
              page = _extends({}, sheet, p.page, {
                flexibleCorner: flexibleCornerK * p.page.flexibleCorner,
                depth: 10 * p.page.depth,
                width: cover.width - cover.padding,
                height: cover.height - 2 * cover.padding,
              }),
              marker = { use: !1, color: 16711680, size: 0.01 };
            return (
              cover.color === sheet.color ||
                p.cover.sideTexture ||
                (cover.sideTexture = Book.createSideTexture(
                  cover.color,
                  cover.side
                )),
              page.color === sheet.color ||
                p.page.sideTexture ||
                (page.sideTexture = Book.createSideTexture(
                  page.color,
                  page.side
                )),
              p.cssLayersLoader &&
                (p.cssLayersLoader = this.cssLayersLoader(p.cssLayersLoader)),
              _extends({}, p, {
                scale: 10,
                height: height,
                width: width,
                flipProgressClb: flipProgressClb,
                cover: cover,
                page: page,
                marker: marker,
              })
            );
          }),
          (Book.prototype.cssLayersLoader = function (loader) {
            var _this9 = this;
            return function (n, clb) {
              return loader(n, function (ls) {
                for (
                  var nls = [],
                    _iterator9 = ls,
                    _isArray9 = Array.isArray(_iterator9),
                    _i9 = 0,
                    _iterator9 = _isArray9
                      ? _iterator9
                      : _iterator9[Symbol.iterator]();
                  ;

                ) {
                  var _ref9;
                  if (_isArray9) {
                    if (_i9 >= _iterator9.length) break;
                    _ref9 = _iterator9[_i9++];
                  } else {
                    if (((_i9 = _iterator9.next()), _i9.done)) break;
                    _ref9 = _i9.value;
                  }
                  var l = _ref9;
                  nls.push(_extends({}, l, { js: _this9.cssLayerJsObject(l) }));
                }
                return clb(nls);
              });
            };
          }),
          (Book.prototype.cssLayerJsObject = function cssLayerJsObject(l) {
            var _this10 = this,
              clIfEx = function (f) {
                var r = void 0;
                if (f)
                  try {
                    r = f();
                  } catch (e) {
                    console.error(e);
                  }
                return r;
              };
            return function (c, p) {
              var o = {};
              try {
                var init = eval(l.js);
                o = init ? init(c, p) || {} : {};
              } catch (e) {
                console.error(e);
              }
              for (
                var no = _this10.cssLayerJsObjectInit(c, p),
                  ro = {},
                  _arr = ["hide", "hidden", "show", "shown", "dispose"],
                  _loop = function () {
                    var n = _arr[_i10];
                    ro[n] = function () {
                      clIfEx(no[n]), clIfEx(o[n]);
                    };
                  },
                  _i10 = 0;
                _i10 < _arr.length;
                _i10++
              )
                _loop();
              return ro;
            };
          }),
          (Book.prototype.cssLayerJsObjectInit = function (c, p) {
            var _this11 = this;
            c.find(".go-to-page").on("click", function (e) {
              for (
                var n = (0, _libs.$)(e.target);
                n.length && !n.hasClass("go-to-page");

              )
                n = (0, _libs.$)(n[0].parentNode);
              (n = parseInt(n.attr("data-number"))),
                isNaN(n) || (e.preventDefault(), p.scene.ctrl.goToPage(n - 1));
            });
            var ys = c.find(".youtube");
            if (ys.length) {
              ys.html('<div style="width:100%;height:100%;"></div>');
              var p01 = function (n, nm, d) {
                return void 0 === n.attr(nm)
                  ? d
                  : "true" === n.attr(nm)
                  ? 1
                  : 0;
              };
              _YouTubeApi2.default.init().then(function () {
                for (var i = 0; i < ys.length; ++i) {
                  var _n = (0, _libs.$)(ys[i]),
                    playerVars = {
                      loop: p01(_n, "data-loop", 0),
                      controls: p01(_n, "data-controls", 1),
                      mute: p01(_n, "data-muted", 0),
                    };
                  playerVars.loop && (playerVars.playlist = _n.attr("data-id"));
                  var player = new YT.Player(_n.find("div")[0], {
                    videoId: _n.attr("data-id"),
                    playerVars: playerVars,
                  });
                  _n[0].player = player;
                }
              });
            }
            var ads = c.find(".adsbygoogle");
            if (ads.length && !this.visual.wnd.adsbygoogle) {
              this.visual.wnd.adsbygoogle = [];
              var script = this.visual.doc.createElement("script");
              (script.async = !0),
                (script.src =
                  "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=" +
                  ads.attr("data-ad-client")),
                this.visual.doc.body.appendChild(script);
            }
            return {
              hide: function () {
                _this11.pendingPlayers.length &&
                  ((_this11.pendingPlayers = []),
                  _this11.dispatchEvent({ type: "pendingPlayers" })),
                  c.find(".pause-on-hide").each(function (_, p) {
                    return _this11.cssFs.pause(p);
                  });
              },
              shown: function () {
                c.find(".play-on-shown").each(function (_, p) {
                  return _this11.cssFs.play(p);
                }),
                  setTimeout(function () {
                    var update = !1;
                    if (
                      (c.find(".adsbygoogle").each(function (_, ad) {
                        return (update =
                          update || "" === (0, _libs.$)(ad).html().trim());
                      }),
                      update)
                    )
                      try {
                        _this11.visual.wnd.adsbygoogle.push({});
                      } catch (e) {
                        console.error(e);
                      }
                  }, 100);
              },
              dispose: function () {
                return c.find(".pause-on-hide").each(function (_, p) {
                  return _this11.cssFs.pause(p);
                });
              },
            };
          }),
          Book
        );
      })(_libs.THREE.EventDispatcher);
    (Book.lightModes = {
      ambient: {
        static: { ambient: 16777215, directional: 0 },
        live: { ambient: 16316664, directional: 986895 },
      },
      mixed: {
        static: { ambient: 15790320, directional: 1052688 },
        live: { ambient: 15790320, directional: 1052688 },
      },
    }),
      (exports.default = Book);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _typeof =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
          ? function (obj) {
              return typeof obj;
            }
          : function (obj) {
              return obj &&
                "function" == typeof Symbol &&
                obj.constructor === Symbol &&
                obj !== Symbol.prototype
                ? "symbol"
                : typeof obj;
            },
      _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(1),
      _Controller2 = __webpack_require__(15),
      _Controller3 = _interopRequireDefault(_Controller2),
      _bookController = __webpack_require__(45),
      _EventsToActions = __webpack_require__(52),
      _EventsToActions2 = _interopRequireDefault(_EventsToActions),
      _stats = __webpack_require__(75),
      _stats2 = _interopRequireDefault(_stats),
      _Object3DWatcher = __webpack_require__(58),
      _Object3DWatcher2 = _interopRequireDefault(_Object3DWatcher),
      _FullScreenX = __webpack_require__(18),
      _FullScreenX2 = _interopRequireDefault(_FullScreenX),
      BookController = (function (_Controller) {
        function BookController(book, view, props) {
          _classCallCheck(this, BookController);
          var _this = _possibleConstructorReturn(this, _Controller.call(this));
          (_this.navigationControls = !0),
            (_this.book = book),
            (_this.visual = book.visual),
            (_this.p = BookController.prepareProps(props)),
            (_this.p.rtl = book.p.rtl),
            (_this.orbit = book.visual.getOrbit()),
            book.setFlipProgressClb(_this.updateViewIfState.bind(_this)),
            (_this.view = view),
            _this.bindActions(),
            (_this.state = {
              smartPan: !_this.actions.cmdSmartPan.active,
              singlePage:
                !!_this.isSinglePageAvailable() &&
                (_this.actions.cmdSinglePage.active ||
                  (_this.actions.cmdSinglePage.activeForMobile &&
                    _this.visual.isMobile())),
              stats: _this.actions.cmdStats.active,
              activeSide: 1,
              autoPlay: _this.actions.cmdAutoPlay.active,
            });
          var box0 = new _libs.THREE.Box3(),
            box1 = new _libs.THREE.Box3(),
            bookWidth = book.openedBox.max.x - book.openedBox.min.x;
          return (
            (_this.bookWatcher = new _Object3DWatcher2.default(
              _this.visual,
              function () {
                if (_this.state.singlePage)
                  _this.state.activeSide
                    ? box0.setFromObject(book.rightCover.three)
                    : box0.setFromObject(book.leftCover.three);
                else {
                  box0.setFromObject(book.leftCover.three),
                    box1.setFromObject(book.rightCover.three),
                    box0.union(box1);
                  var width = Math.max(box0.min.x - box0.min.x, bookWidth),
                    x0 = (box0.min.x + box0.max.x) / 2;
                  (box0.min.x = x0 - 0.5 * width),
                    (box0.max.x = x0 + 0.5 * width);
                }
                return box0;
              }
            )),
            (_this.bookWatcher.scale = _this.p.scale.default),
            _this.book.setZoom(_this.bookWatcher.scale, _this.state.singlePage),
            (_this.Stats = new _stats2.default()),
            (_this.Stats.domElement.style.position = "absolute"),
            (_this.Stats.domElement.style.top = "0px"),
            (_this.binds = {
              onScreenModeChanged: _this.onScreenModeChanged.bind(_this),
              stats: _this.Stats.update.bind(_this.Stats),
              onUpdateView: _this.updateView.bind(_this),
            }),
            _FullScreenX2.default.addEventListener(
              _this.view.getParentContainer().ownerDocument,
              _this.binds.onScreenModeChanged
            ),
            _this.cmdSmartPan(),
            _this.book.enableLoadingAnimation(_this.p.loadingAnimation.book),
            _this.p.loadingAnimation.skin && _this.initLoadingAnimation(),
            _this.book.enableLoadingAnimation(_this.p.loadingAnimation.book),
            _this.book.setAutoResolution(_this.p.autoResolution),
            _this.visual.addEventListener(
              "resize",
              _this.updateView.bind(_this)
            ),
            _this.book.addEventListener(
              "pendingPlayers",
              _this.updateView.bind(_this)
            ),
            _this.state.autoPlay && _this.autoPlay(),
            _this
          );
        }
        return (
          _inherits(BookController, _Controller),
          (BookController.prototype.dispose = function () {
            _FullScreenX2.default.removeEventListener(
              this.view.getParentContainer().ownerDocument,
              this.binds.onScreenModeChanged
            ),
              delete this.book,
              delete this.view,
              delete this.visual;
          }),
          (BookController.prototype.ready = function (scene) {
            var _this2 = this;
            this.view.templateObject.appLoaded &&
              Promise.resolve().then(function () {
                return _this2.view.templateObject.appLoaded(scene);
              });
          }),
          (BookController.prototype.loadingAnimationHandler = function () {
            for (
              var _this3 = this,
                pages = this.book.getTopPages(),
                visible = !1,
                _iterator = pages,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var n = _ref,
                state = this.book.getPageState(n);
              if ((visible = "active" !== state)) break;
            }
            (visible = visible || (this.printer && this.printer.loading)),
              visible
                ? this.pendingLoadingAnimation ||
                  ((this.pendingLoadingAnimation = !0),
                  setTimeout(function () {
                    _this3.pendingLoadingAnimation &&
                      _this3.view &&
                      _this3.view.setState("widLoading", { visible: visible });
                  }, 2e3))
                : (delete this.pendingLoadingAnimation,
                  this.view.setState("widLoading", { visible: visible }));
          }),
          (BookController.prototype.initLoadingAnimation = function () {
            var handler = this.loadingAnimationHandler.bind(this);
            this.book.addEventListener("beforeAnimation", handler),
              this.book.addEventListener("afterAnimation", handler),
              this.book.addEventListener("startRendering", handler),
              this.book.addEventListener("endRendering", handler);
          }),
          (BookController.prototype.enableNavigation = function (enable) {
            this.navigationControls = enable;
          }),
          (BookController.prototype.setTocCtrl = function (tocCtrl) {
            (this.tocCtrl = tocCtrl),
              (this.tocCtrl.onChange = this.updateView.bind(this)),
              this.tocCtrl.setActiveTab(this.actions.cmdToc.defaultTab),
              this.actions.cmdToc.active && !tocCtrl.visible && tocCtrl.togle();
          }),
          (BookController.prototype.setShareCtrl = function (shareCtrl) {
            (this.shareCtrl = shareCtrl),
              (this.shareCtrl.onChange = this.updateView.bind(this)),
              this.updateView();
          }),
          (BookController.prototype.setPrinter = function (printer) {
            this.printer = printer;
            var handler = this.loadingAnimationHandler.bind(this);
            this.printer.addEventListener("loading", handler),
              this.printer.addEventListener("loaded", handler),
              this.updateView();
          }),
          (BookController.prototype.setSounds = function (sounds) {
            (this.sounds = sounds),
              sounds.setEnabled(this.actions.cmdSounds.active),
              this.updateView();
          }),
          (BookController.prototype.onScreenModeChanged = function (e) {
            this.updateView();
          }),
          (BookController.prototype.canZoomIn = function () {
            return (
              !this.state.smartPan ||
              Math.abs(this.bookWatcher.scale - this.p.scale.max) > this.p.eps
            );
          }),
          (BookController.prototype.canZoomOut = function () {
            return (
              !this.state.smartPan ||
              Math.abs(this.bookWatcher.scale - this.p.scale.min) > this.p.eps
            );
          }),
          (BookController.prototype.canDefaultZoom = function () {
            return this.state.smartPan;
          }),
          (BookController.prototype.setBookZoom = function (scale) {
            this.book.setZoom(scale, this.state.singlePage);
          }),
          (BookController.prototype.cmdAutoPlay = function () {
            (this.state.autoPlay = !this.state.autoPlay),
              this.state.autoPlay && this.autoPlay(),
              this.updateView();
          }),
          (BookController.prototype.autoPlay = function () {
            var _this4 = this,
              pendingAutoPlay = Date.now();
            (this.pendingAutoPlay = pendingAutoPlay),
              setTimeout(function () {
                if (
                  _this4.pendingAutoPlay === pendingAutoPlay &&
                  _this4.state.autoPlay
                ) {
                  if (!_this4.book.isProcessing()) {
                    var flipped = void 0;
                    _this4.p.rtl
                      ? (flipped = _this4.canFlipLeft()) && _this4.cmdBackward()
                      : (flipped = _this4.canFlipRight()) &&
                        _this4.cmdForward(),
                      flipped || _this4.goToPage(0);
                  }
                  _this4.autoPlay();
                }
              }, this.book.p.autoPlayDuration);
          }),
          (BookController.prototype.cmdZoomIn = function () {
            this.state.smartPan
              ? ((this.bookWatcher.scale = Math.min(
                  this.p.scale.max,
                  this.bookWatcher.scale + this.p.scale.delta
                )),
                this.setBookZoom(this.bookWatcher.scale))
              : this.orbit.zoomIn((6.6 * this.p.scale.delta) / 0.32),
              this.updateView();
          }),
          (BookController.prototype.cmdZoomOut = function () {
            this.state.smartPan
              ? ((this.bookWatcher.scale = Math.max(
                  this.p.scale.min,
                  this.bookWatcher.scale - this.p.scale.delta
                )),
                this.setBookZoom(this.bookWatcher.scale))
              : this.orbit.zoomOut((6.6 * this.p.scale.delta) / 0.32),
              this.updateView();
          }),
          (BookController.prototype.setScale = function (scale) {
            (this.bookWatcher.scale = Math.min(
              this.p.scale.max,
              Math.max(this.p.scale.min, scale)
            )),
              this.setBookZoom(this.bookWatcher.scale),
              this.updateView();
          }),
          (BookController.prototype.cmdDefaultZoom = function () {
            this.state.smartPan &&
              ((this.bookWatcher.scale = this.p.scale.default),
              this.setBookZoom(this.bookWatcher.scale),
              this.updateView());
          }),
          (BookController.prototype.cmdToc = function () {
            this.tocCtrl && this.tocCtrl.togle();
          }),
          (BookController.prototype.cmdShare = function () {
            this.shareCtrl && this.shareCtrl.togle();
          }),
          (BookController.prototype.cmdBackward = function () {
            var _this5 = this;
            this.canFlipLeft() &&
              (this.state.singlePage
                ? ((this.state.activeSide = (this.getPage() + 1) % 2),
                  this.state.activeSide
                    ? ((this.state.activeSide = 0), this.updateView())
                    : this.startFlip(this.book.flipLeft(1)).then(function (
                        block
                      ) {
                        block && (_this5.state.activeSide = 1);
                      }))
                : this.startFlip(this.book.flipLeft(1)));
          }),
          (BookController.prototype.cmdBigBackward = function () {
            this.cmdBackward();
          }),
          (BookController.prototype.cmdForward = function () {
            var _this6 = this;
            this.canFlipRight() &&
              (this.state.singlePage
                ? ((this.state.activeSide = (this.getPage() + 1) % 2),
                  this.state.activeSide
                    ? this.startFlip(this.book.flipRight(1)).then(function (
                        block
                      ) {
                        block && (_this6.state.activeSide = 0);
                      })
                    : ((this.state.activeSide = 1), this.updateView()))
                : this.startFlip(this.book.flipRight(1)));
          }),
          (BookController.prototype.cmdBigForward = function () {
            this.cmdForward();
          }),
          (BookController.prototype.cmdSave = function () {
            var a = (0, _libs.$)(
              '<a href="' +
                this.p.downloadURL +
                '" download target="_blank"></a>'
            ).appendTo(this.view.getContainer());
            a[0].click(), a.remove();
          }),
          (BookController.prototype.cmdPrint = function () {
            this.printer.print();
          }),
          (BookController.prototype.cmdFullScreen = function () {
            _FullScreenX2.default.activated()
              ? _FullScreenX2.default.cancel()
              : _FullScreenX2.default.request(this.view.getParentContainer());
          }),
          (BookController.prototype.cmdSmartPan = function () {
            (this.state.smartPan = !this.state.smartPan),
              this.state.smartPan
                ? ((this.orbit.minAzimuthAngle = 0),
                  (this.orbit.maxAzimuthAngle = 0),
                  (this.orbit.minPolarAngle = 0),
                  (this.orbit.maxPolarAngle = Math.PI / 4),
                  (this.bookWatcher.enabled = !0))
                : ((this.orbit.minAzimuthAngle = -1 / 0),
                  (this.orbit.maxAzimuthAngle = 1 / 0),
                  (this.orbit.minPolarAngle = 0),
                  (this.orbit.maxPolarAngle = Math.PI),
                  (this.bookWatcher.enabled = !1)),
              this.updateView();
          }),
          (BookController.prototype.isSinglePageAvailable = function () {
            return 2 !== this.book.getPages();
          }),
          (BookController.prototype.cmdSinglePage = function () {
            this.isSinglePageAvailable() &&
              ((this.state.singlePage = !this.state.singlePage),
              this.setBookZoom(this.bookWatcher.scale),
              this.updateView(),
              this.dispatchAsync({
                type: "pageMode",
                value: this.state.singlePage ? "single" : "double",
              }));
          }),
          (BookController.prototype.cmdSounds = function () {
            this.sounds && this.sounds.togle(), this.updateView();
          }),
          (BookController.prototype.cmdStats = function () {
            (this.state.stats = !this.state.stats),
              this.state.stats
                ? ((0, _libs.$)(this.view.getContainer()).append(
                    this.Stats.domElement
                  ),
                  this.visual.addRenderCallback(this.binds.stats))
                : ((0, _libs.$)(this.view.getContainer())
                    .find(this.Stats.domElement)
                    .remove(),
                  this.visual.removeRenderCallback(this.binds.stats)),
              this.updateView();
          }),
          (BookController.prototype.cmdPendingPlay = function () {
            this.book.resolvePendingPlayers();
          }),
          (BookController.prototype.cmdGotoFirstPage = function () {
            this.goToPage(0);
          }),
          (BookController.prototype.cmdGotoLastPage = function () {
            this.goToPage(this.book.getBookPages() - 1);
          }),
          (BookController.prototype.goToPage = function (page) {
            var _this7 = this;
            (page = Math.max(Math.min(page, this.book.getPages() - 1), 0)),
              this.p.rtl && (page = this.book.getBookPages() - 1 - page);
            var pageNum = Math.max(
              Math.min(page, this.book.getBookPages() - 1),
              0
            );
            this.state.activeSide = (pageNum + 1) % 2;
            var target = Math.max(
                Math.min(page - 1 + (page % 2), this.book.getBookPages() - 1),
                0
              ),
              current = this.book.getPage(),
              flips = [],
              covs = 0;
            if (target != current) {
              0 === current
                ? (flips.push(1), (current += 1), ++covs)
                : current === this.book.getBookPages() - 1 &&
                  (flips.push(-1), (current -= 2), ++covs);
              var cv = 0;
              0 === target
                ? ((cv = -1), (target += 1), ++covs)
                : target === this.book.getBookPages() - 1 &&
                  ((cv = 1), (target -= 2), ++covs),
                target - current &&
                  flips.push(Math.ceil((target - current) / 2)),
                cv && flips.push(cv);
            }
            var setClb = function (fl, time, clb) {
              return new Promise(function (resolve) {
                setTimeout(function () {
                  fl < 0
                    ? _this7.startFlip(_this7.book.flipLeft(-fl, clb))
                    : _this7.startFlip(_this7.book.flipRight(fl, clb)),
                    resolve();
                }, time);
              });
            };
            if (2 === covs)
              setClb(flips[0], 0, function (block, progress, state) {
                "finish" == state &&
                  1 == progress &&
                  setClb(flips[flips.length - 1], 0);
              }).then(function () {
                return setClb(flips[1], 400);
              });
            else
              for (
                var next = Promise.resolve(),
                  time = 0,
                  _iterator2 = flips,
                  _isArray2 = Array.isArray(_iterator2),
                  _i2 = 0,
                  _iterator2 = _isArray2
                    ? _iterator2
                    : _iterator2[Symbol.iterator]();
                ;

              ) {
                var _ref2,
                  _ret = (function () {
                    if (_isArray2) {
                      if (_i2 >= _iterator2.length) return "break";
                      _ref2 = _iterator2[_i2++];
                    } else {
                      if (((_i2 = _iterator2.next()), _i2.done)) return "break";
                      _ref2 = _i2.value;
                    }
                    var fl = _ref2,
                      t = time;
                    (next = next.then(function () {
                      return setClb(fl, t);
                    })),
                      (time = 400);
                  })();
                if ("break" === _ret) break;
              }
          }),
          (BookController.prototype.startFlip = function (flipRes) {
            var _this8 = this;
            return flipRes
              ? flipRes.then(function (block) {
                  return (
                    block && _this8.dispatchAsync({ type: "startFlip" }), block
                  );
                })
              : Promise.resolve(void 0);
          }),
          (BookController.prototype.endFlip = function (block) {
            return this.dispatchAsync({ type: "endFlip" }), block;
          }),
          (BookController.prototype.getPage = function () {
            return this.book.getPage()
              ? Math.min(
                  this.book.getPage() + this.state.activeSide,
                  this.book.getBookPages() - 1
                )
              : 0;
          }),
          (BookController.prototype.getPageForGUI = function () {
            var n =
              (this.state.singlePage ? this.getPage() : this.book.getPage()) +
              1;
            return (
              this.p.rtl && (n = this.book.getBookPages() - n + 1),
              n > this.book.getPages() && (n = this.book.getPages()),
              n
            );
          }),
          (BookController.prototype.inpPage = function (e, data) {
            this.goToPage(data - 1);
          }),
          (BookController.prototype.updateViewIfState = function (
            block,
            progress,
            state,
            type
          ) {
            ("init" !== state && "finish" !== state) ||
              setTimeout(this.updateView.bind(this), 100),
              "finish" === state && this.endFlip(block);
          }),
          (BookController.prototype.isCmdVisible = function (name) {
            return (0, _libs.$)(this.visual.element).width() <
              this.p.narrowView.width
              ? void 0 === this.actions[name].enabledInNarrow
                ? this.actions[name].enabled
                : this.actions[name].enabledInNarrow
              : this.actions[name].enabled;
          }),
          (BookController.prototype.updateViewState = function () {
            this.viewState = {
              cmdZoomIn: {
                enable: this.canZoomIn(),
                visible: this.isCmdVisible("cmdZoomIn"),
                active: !1,
              },
              cmdZoomOut: {
                enable: this.canZoomOut(),
                visible: this.isCmdVisible("cmdZoomOut"),
                active: !1,
              },
              cmdDefaultZoom: {
                enable: this.canDefaultZoom(),
                visible: this.isCmdVisible("cmdDefaultZoom"),
                active:
                  this.canDefaultZoom() &&
                  Math.abs(this.bookWatcher.scale - this.p.scale.default) <
                    this.p.eps,
              },
              cmdToc: {
                enable: !!this.tocCtrl,
                visible: this.isCmdVisible("cmdToc") && this.tocCtrl,
                active: this.tocCtrl && this.tocCtrl.visible,
              },
              cmdShare: {
                enable: !!this.shareCtrl,
                visible: this.isCmdVisible("cmdShare") && this.shareCtrl,
                active: this.shareCtrl && this.shareCtrl.visible,
              },
              inpPages: { visible: !0, value: this.book.getPages() },
              inpPage: {
                visible: !0,
                enable: !this.book.isProcessing() && this.navigationControls,
                value: this.getPageForGUI(),
              },
              cmdSave: {
                enable: !0,
                visible: this.isCmdVisible("cmdSave") && !!this.p.downloadURL,
                active: !1,
              },
              cmdPrint: {
                enable: !0,
                visible: this.isCmdVisible("cmdPrint") && !!this.printer,
                active: !1,
              },
              cmdFullScreen: {
                enable: _FullScreenX2.default.available(),
                visible: this.isCmdVisible("cmdFullScreen"),
                active:
                  _FullScreenX2.default.available() &&
                  _FullScreenX2.default.activated(),
              },
              widControls: { enable: !0, visible: !0, active: !1 },
              widSettings: {
                enable: !0,
                visible: this.isCmdVisible("widSettings"),
                active: !1,
              },
              widToolbar: {
                enable: !0,
                visible: this.isCmdVisible("widToolbar"),
                active: !1,
              },
              cmdSmartPan: {
                enable: !0,
                visible: this.isCmdVisible("cmdSmartPan"),
                active: this.state.smartPan,
              },
              cmdSinglePage: {
                enable: this.isSinglePageAvailable(),
                visible: this.isCmdVisible("cmdSinglePage"),
                active: this.state.singlePage,
              },
              cmdSounds: {
                enable: !0,
                visible: this.isCmdVisible("cmdSounds") && !!this.sounds,
                active: !!this.sounds && this.sounds.enabled,
              },
              cmdStats: {
                enable: !0,
                visible: this.isCmdVisible("cmdStats"),
                active: this.state.stats,
              },
              cmdAutoPlay: {
                enable: !0,
                visible: this.isCmdVisible("cmdAutoPlay"),
                active: this.state.autoPlay,
              },
              cmdPendingPlay: { enable: !0, visible: !0, active: !1 },
              widPendingPlay: {
                enable: !0,
                visible: this.book.hasPendingPlayers(),
                active: !1,
              },
            };
            for (
              var left = this.canFlipLeft(),
                right = this.canFlipRight(),
                flippersEnable = {
                  cmdBackward: left,
                  cmdBigBackward: left,
                  cmdForward: right,
                  cmdBigForward: right,
                  cmdGotoFirstPage: left,
                  cmdGotoLastPage: right,
                },
                _iterator3 = Object.keys(flippersEnable),
                _isArray3 = Array.isArray(_iterator3),
                _i3 = 0,
                _iterator3 = _isArray3
                  ? _iterator3
                  : _iterator3[Symbol.iterator]();
              ;

            ) {
              var _ref3;
              if (_isArray3) {
                if (_i3 >= _iterator3.length) break;
                _ref3 = _iterator3[_i3++];
              } else {
                if (((_i3 = _iterator3.next()), _i3.done)) break;
                _ref3 = _i3.value;
              }
              var name = _ref3;
              this.viewState[name] = {
                enable: flippersEnable[name],
                visible: this.isCmdVisible(name),
                active: !1,
              };
            }
          }),
          (BookController.prototype.canFlipLeft = function () {
            return (
              this.navigationControls &&
              (!!this.book.getLeftFlipping() ||
                (this.state.singlePage && this.p.rtl && 2 === this.getPage()))
            );
          }),
          (BookController.prototype.canFlipRight = function () {
            return (
              this.navigationControls &&
              (!!this.book.getRightFlipping() ||
                (this.state.singlePage &&
                  !this.p.rtl &&
                  this.getPage() === this.book.getPages() - 2))
            );
          }),
          (BookController.prototype.updateView = function () {
            if (this.view) {
              this.updateViewState();
              for (
                var _iterator4 = Object.keys(this.viewState),
                  _isArray4 = Array.isArray(_iterator4),
                  _i4 = 0,
                  _iterator4 = _isArray4
                    ? _iterator4
                    : _iterator4[Symbol.iterator]();
                ;

              ) {
                var _ref4;
                if (_isArray4) {
                  if (_i4 >= _iterator4.length) break;
                  _ref4 = _iterator4[_i4++];
                } else {
                  if (((_i4 = _iterator4.next()), _i4.done)) break;
                  _ref4 = _i4.value;
                }
                var name = _ref4;
                this.view.setState(name, this.viewState[name]);
              }
            }
          }),
          (BookController.prototype.getActions = function () {
            var _this9 = this,
              isSwipping = function (name) {
                return (
                  _this9.actions.touchCmdSwipe.enabled &&
                  _this9.actions.touchCmdSwipe.code ===
                    _this9.actions[name].code &&
                  _this9.state.smartPan &&
                  _this9.bookWatcher.scale <= 1
                );
              },
              cmds = {};
            for (var name in this)
              !(function (name) {
                0 === name.indexOf("cmd") &&
                  (cmds[name] = {
                    activate: function () {
                      _this9.viewState &&
                        _this9.viewState[name].enable &&
                        _this9[name].apply(_this9, arguments);
                    },
                  });
              })(name);
            return _extends({}, cmds, {
              cmdPanLeft: {
                activate: function (e) {
                  return _this9.orbit.actions.pan(e, {
                    state: "move",
                    dx: -_this9.p.pan.speed,
                    dy: 0,
                  });
                },
              },
              cmdPanRight: {
                activate: function (e) {
                  return _this9.orbit.actions.pan(e, {
                    state: "move",
                    dx: _this9.p.pan.speed,
                    dy: 0,
                  });
                },
              },
              cmdPanUp: {
                activate: function (e) {
                  return _this9.orbit.actions.pan(e, {
                    state: "move",
                    dx: 0,
                    dy: -_this9.p.pan.speed,
                  });
                },
              },
              cmdPanDown: {
                activate: function (e) {
                  return _this9.orbit.actions.pan(e, {
                    state: "move",
                    dx: 0,
                    dy: _this9.p.pan.speed,
                  });
                },
              },
              mouseCmdRotate: { activate: this.orbit.actions.rotate },
              mouseCmdDragZoom: {
                activate: function (e, data) {
                  data.dy > 0
                    ? _this9.cmdZoomOut()
                    : data.dy < 0 && _this9.cmdZoomIn();
                },
              },
              mouseCmdPan: { activate: this.orbit.actions.pan },
              mouseCmdWheelZoom: {
                activate: function (e) {
                  var scale = _this9.bookWatcher.scale;
                  e.deltaY < 0
                    ? _this9.cmdZoomOut()
                    : e.deltaY > 0 && _this9.cmdZoomIn(),
                    (!_this9.state.smartPan ||
                      Math.abs(_this9.bookWatcher.scale - scale) > 1e-4) &&
                      e.preventDefault();
                },
              },
              touchCmdRotate: {
                activate: function (e, data) {
                  isSwipping("touchCmdRotate") ||
                    ("move" === data.state && e.preventDefault(),
                    _this9.orbit.actions.rotate(e, data));
                },
              },
              touchCmdZoom: {
                activate: function (e, data) {
                  if (!isSwipping("touchCmdZoom")) {
                    var l = function (v) {
                      return Math.sqrt(v.x * v.x + v.y * v.y);
                    };
                    "start" === data.state
                      ? (_this9.touchZoomData = {
                          l: l(data),
                          scale: _this9.bookWatcher.scale,
                        })
                      : "move" === data.state &&
                        (e.preventDefault(),
                        _this9.setScale(
                          (l(data) / _this9.touchZoomData.l) *
                            _this9.touchZoomData.scale
                        ));
                  }
                },
              },
              touchCmdPan: {
                activate: function (e, data) {
                  isSwipping("touchCmdPan") ||
                    ("move" === data.state &&
                      (!_this9.state.smartPan ||
                        _this9.bookWatcher.scale > 1) &&
                      (e.preventDefault(), _this9.orbit.actions.pan(e, data)));
                },
              },
              touchCmdSwipe: {
                activate: function (e, data) {
                  if (isSwipping("touchCmdSwipe"))
                    if ("start" === data.state) {
                      var touch = (e.touches || e.originalEvent.touches)[
                        _this9.actions.touchCmdSwipe.code - 1
                      ];
                      _this9.swipeData = {
                        handled: !1,
                        x0: touch.pageX,
                        y0: touch.pageY,
                        x: touch.pageX,
                        y: touch.pageY,
                      };
                    } else
                      "move" === data.state
                        ? _this9.swipeData.handled ||
                          ((_this9.swipeData = _extends({}, _this9.swipeData, {
                            x: _this9.swipeData.x + data.dx,
                            y: _this9.swipeData.y + data.dy,
                          })),
                          Math.abs(_this9.swipeData.x0 - _this9.swipeData.x) >
                            100 &&
                            (_this9.swipeData.x0 > _this9.swipeData.x
                              ? _this9.cmdForward()
                              : _this9.cmdBackward(),
                            (_this9.swipeData.handled = !0)))
                        : delete _this9.swipeData;
                },
              },
              widSettings: { activate: function () {} },
              widToolbar: { activate: function () {} },
            });
          }),
          (BookController.prototype.bindActions = function () {
            var _this10 = this;
            (this.eToA = new _EventsToActions2.default(
              (0, _libs.$)(this.visual.element)
            )),
              this.eToA.addAction(
                function (e) {
                  return e.preventDefault();
                },
                "contextmenu",
                _EventsToActions2.default.mouseButtons.Right,
                0
              ),
              this.eToA.addAction(
                function (e) {
                  return (0, _libs.$)(
                    _this10.view.getParentContainer()
                  ).trigger(e);
                },
                "keydown",
                27,
                0
              ),
              (this.actions = this.getActions());
            for (
              var _iterator5 = Object.keys(this.actions),
                _isArray5 = Array.isArray(_iterator5),
                _i5 = 0,
                _iterator5 = _isArray5
                  ? _iterator5
                  : _iterator5[Symbol.iterator]();
              ;

            ) {
              var _ref5;
              if (_isArray5) {
                if (_i5 >= _iterator5.length) break;
                _ref5 = _iterator5[_i5++];
              } else {
                if (((_i5 = _iterator5.next()), _i5.done)) break;
                _ref5 = _i5.value;
              }
              var name = _ref5,
                action = _extends({}, this.actions[name], this.p.actions[name]);
              if (
                ((this.actions[name] = action),
                (0 !== name.indexOf("mouseCmd") &&
                  0 !== name.indexOf("touchCmd")) ||
                  action.enabled)
              ) {
                var flags = action.flags || 0;
                action.type
                  ? this.eToA.addAction(
                      action.activate,
                      action.type,
                      action.code,
                      flags
                    )
                  : void 0 !== action.code &&
                    this.eToA.addAction(
                      action.activate,
                      "keydown",
                      action.code,
                      flags
                    );
              }
            }
          }),
          (BookController.prepareProps = function (props) {
            return BookController.calcProps(
              BookController.mergeProps((0, _bookController.props)(), props)
            );
          }),
          (BookController.setActions = function (props, actions) {
            for (
              var _iterator6 = Object.keys(actions || {}),
                _isArray6 = Array.isArray(_iterator6),
                _i6 = 0,
                _iterator6 = _isArray6
                  ? _iterator6
                  : _iterator6[Symbol.iterator]();
              ;

            ) {
              var _ref6;
              if (_isArray6) {
                if (_i6 >= _iterator6.length) break;
                _ref6 = _iterator6[_i6++];
              } else {
                if (((_i6 = _iterator6.next()), _i6.done)) break;
                _ref6 = _i6.value;
              }
              var name = _ref6;
              props.actions[name] = _extends(
                {},
                props.actions[name],
                actions[name]
              );
            }
          }),
          (BookController.mergeProps = function (first, second) {
            function merge(first, second) {
              second = second || {};
              for (
                var props = _extends({}, first, second),
                  _iterator7 = Object.keys(first),
                  _isArray7 = Array.isArray(_iterator7),
                  _i7 = 0,
                  _iterator7 = _isArray7
                    ? _iterator7
                    : _iterator7[Symbol.iterator]();
                ;

              ) {
                var _ref7;
                if (_isArray7) {
                  if (_i7 >= _iterator7.length) break;
                  _ref7 = _iterator7[_i7++];
                } else {
                  if (((_i7 = _iterator7.next()), _i7.done)) break;
                  _ref7 = _i7.value;
                }
                var name = _ref7;
                "object" === _typeof(first[name]) &&
                  (props[name] = merge(first[name], second[name]));
              }
              return props;
            }
            second = second || {};
            var props = merge(first, second);
            return (
              BookController.setActions(props, first.actions),
              BookController.setActions(props, second.actions),
              props
            );
          }),
          (BookController.calcProps = function (props) {
            return (
              (props.scale.delta =
                (props.scale.max - props.scale.min) / props.scale.levels),
              props
            );
          }),
          BookController
        );
      })(_Controller3.default);
    exports.default = BookController;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(1),
      BookPrinter = (function (_THREE$EventDispatche) {
        function BookPrinter(context, book, styleSheet) {
          _classCallCheck(this, BookPrinter);
          var _this = _possibleConstructorReturn(
            this,
            _THREE$EventDispatche.call(this)
          );
          (_this.book = book),
            (_this.styleSheet = styleSheet),
            (_this.wnd = context.wnd),
            (_this.doc = context.doc),
            (_this.pageCallback = book.getPageCallback());
          var test = _this.pageCallback(0);
          return (
            (_this.type = test.type),
            "pdf" === _this.type && (_this.pdfSrc = test.src.src),
            _this
          );
        }
        return (
          _inherits(BookPrinter, _THREE$EventDispatche),
          (BookPrinter.prototype.cancel = function () {
            this.canceled = !0;
          }),
          (BookPrinter.prototype.dispose = function () {
            this.frame && (this.frame.remove(), delete this.frame);
          }),
          (BookPrinter.prototype.print = function () {
            var _this2 = this;
            if (!this.loading)
              if ((delete this.canceled, "pdf" === this.type)) {
                var printWnd = void 0,
                  callManually = !1;
                this.useIFrame()
                  ? ((callManually = !!this.frame),
                    this.frame ||
                      (this.frame = (0, _libs.$)(
                        '<iframe src="' +
                          this.pdfSrc +
                          '" style="display: none;"></iframe>'
                      ).appendTo(document.body)),
                    (printWnd = this.frame[0].contentWindow))
                  : (printWnd = this.wnd.open(this.pdfSrc)),
                  callManually
                    ? printWnd.print()
                    : ((this.loading = !0),
                      this.dispatchEvent({ type: "loading" }),
                      (0, _libs.$)(this.frame).on("load", function () {
                        setTimeout(function () {
                          delete _this2.loading,
                            _this2.dispatchEvent({ type: "loaded" });
                          try {
                            printWnd.print();
                          } catch (e) {
                            console.error(e);
                          }
                        }, 1e3);
                      }));
              } else
                this.renderContent()
                  .then(function (content) {
                    var printWnd = _this2.wnd.open(),
                      printDoc = printWnd.document,
                      html = (
                        '\n            <!DOCTYPE html>\n            <html>\n              <head>\n                <meta charset="utf-8">\n                <title>3D FlipBook - Printing</title>\n                ' +
                        content.head +
                        '\n                <script type="text/javascript">\n                  function printDocument() {\n                    window.print();\n                    window.close();\n                  }\n                  function init() {\n                    setTimeout(printDocument, 100);\n                  }\n                </script>\n              </head>\n              <body onload="init()">\n                ' +
                        content.body +
                        "\n              </body>\n            </html>\n          "
                      ).fb3dQFilter();
                    printDoc.open(), printDoc.write(html), printDoc.close();
                  })
                  .catch(function (e) {
                    return console.warn("3D FlipBook - Printing was canceled");
                  });
          }),
          (BookPrinter.prototype.progress = function (v) {
            if (this.canceled) throw "Cancel Printing";
            this.onProgress && this.onProgress(Math.floor(100 * v));
          }),
          (BookPrinter.prototype.renderContent = function () {
            for (
              var _this3 = this,
                pages = this.book.getPages(),
                head = new Set(),
                body = [],
                done = Promise.resolve(),
                page = 0;
              page < pages;
              ++page
            )
              !(function (page) {
                var info = _this3.pageCallback(page);
                "image" === info.type
                  ? (done = done.then(function () {
                      return (
                        _this3.progress(page / pages),
                        _this3.renderImage(head, body, info.src)
                      );
                    }))
                  : "html" === info.type &&
                    (done = done.then(function () {
                      return (
                        _this3.progress(page / pages),
                        _this3.renderHtml(head, body, info.src)
                      );
                    }));
              })(page);
            return done.then(function () {
              return (
                _this3.progress(1),
                { head: _this3.renderHead(head), body: body.join("\n") }
              );
            });
          }),
          (BookPrinter.wrap = function (content) {
            return '<div class="fb3d-printer-page">' + content + "</div>";
          }),
          (BookPrinter.prototype.renderImage = function (head, body, src) {
            body.push(BookPrinter.wrap('<img src="' + src + '" />'));
          }),
          (BookPrinter.prototype.renderHtml = function (head, body, src) {
            return new Promise(function (resolve, reject) {
              _libs.$.get(src, function (html) {
                for (
                  var links = html.match(/<link.*?>/gi) || [],
                    _iterator = links,
                    _isArray = Array.isArray(_iterator),
                    _i = 0,
                    _iterator = _isArray
                      ? _iterator
                      : _iterator[Symbol.iterator]();
                  ;

                ) {
                  var _ref;
                  if (_isArray) {
                    if (_i >= _iterator.length) break;
                    _ref = _iterator[_i++];
                  } else {
                    if (((_i = _iterator.next()), _i.done)) break;
                    _ref = _i.value;
                  }
                  var link = _ref;
                  if (link.match(/stylesheet/i)) {
                    var href = link.match(/href\s*=\s*['"](.*)['"]/i);
                    href && head.add(href[1]);
                  }
                }
                var content = html.match(/<body.*?>([\S\s]*)<\/body>/i);
                content && body.push(BookPrinter.wrap(content[1])), resolve();
              }).fail(function (e) {
                console.error(e.responseText), reject();
              });
            });
          }),
          (BookPrinter.prototype.renderHead = function (head) {
            var content = [];
            return (
              head.forEach(function (k) {
                return content.push('<link rel="stylesheet" href="' + k + '">');
              }),
              content.push(
                this.styleSheet
                  ? '<link rel="stylesheet" href="' + this.styleSheet + '">'
                  : BookPrinter.defaultStyleSheet()
              ),
              content.join("\n")
            );
          }),
          (BookPrinter.prototype.useIFrame = function () {
            var isChromium = this.wnd.chrome,
              winNav = this.wnd.navigator,
              vendorName = winNav.vendor,
              isIEedge = winNav.userAgent.indexOf("Edge") > -1,
              isIOSChrome = winNav.userAgent.match("CriOS");
            return (
              !!isIOSChrome ||
                !(!isChromium || "Google Inc." !== vendorName || isIEedge),
              !0
            );
          }),
          (BookPrinter.defaultStyleSheet = function () {
            return '\n      <style type="text/css">\n        body {\n          margin: 0;\n          padding: 0;\n        }\n        .fb3d-printer-page {\n          page-break-after: always;\n        }\n      </style>\n    '.fb3dQFilter();
          }),
          BookPrinter
        );
      })(_libs.THREE.EventDispatcher);
    exports.default = BookPrinter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _View2 = (__webpack_require__(1), __webpack_require__(69)),
      _View3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_View2),
      BookView = (function (_View) {
        function BookView(container, onLoad, template, handler) {
          return (
            _classCallCheck(this, BookView),
            _possibleConstructorReturn(
              this,
              _View.call(this, container, onLoad, template, handler)
            )
          );
        }
        return (
          _inherits(BookView, _View),
          (BookView.prototype.initView = function () {
            (this.view = this.container.find(".view")),
              (this.bookmarksView = this.container.find(".widBookmarks")),
              (this.thumbnailsView = this.container.find(".widThumbnails")),
              (this.searchView = this.container.find(".widSearch"));
          }),
          (BookView.prototype.getHandlers = function (id) {
            var _this2 = this;
            return "inpPage" === id
              ? [
                  {
                    inpPage: function (e, data) {
                      return _this2.callLater(
                        _View.prototype.getHandlers.call(_this2, id),
                        id,
                        e,
                        data,
                        BookView.PAGE_HANDLER_DELAY
                      );
                    },
                  },
                ]
              : _View.prototype.getHandlers.call(this, id);
          }),
          (BookView.prototype.onItemStateChanged = function (id, state) {
            "cmdFullScreen" === id &&
              (state.active
                ? this.parentContainer.addClass("fullscreen")
                : this.parentContainer.removeClass("fullscreen"));
          }),
          (BookView.prototype.getView = function () {
            return this.view;
          }),
          (BookView.prototype.getBookmarksView = function () {
            return this.bookmarksView;
          }),
          (BookView.prototype.getThumbnailsView = function () {
            return this.thumbnailsView;
          }),
          (BookView.prototype.getSearchView = function () {
            return this.searchView;
          }),
          (BookView.prototype.getForms = function () {
            return [];
          }),
          (BookView.prototype.getLinks = function () {
            return [
              "cmdZoomIn",
              "cmdZoomOut",
              "cmdDefaultZoom",
              "cmdToc",
              "cmdBackward",
              "cmdBigBackward",
              "cmdForward",
              "cmdBigForward",
              "cmdSave",
              "cmdPrint",
              "cmdFullScreen",
              "cmdSmartPan",
              "cmdSinglePage",
              "cmdSounds",
              "cmdStats",
              "cmdShare",
              "cmdCloseToc",
              "cmdCloseShare",
              "cmdBookmarks",
              "cmdSearch",
              "cmdThumbnails",
              "cmdPendingPlay",
              "cmdFacebook",
              "cmdTwitter",
              "cmdEmail",
              "cmdAutoPlay",
              "cmdGotoFirstPage",
              "cmdGotoLastPage",
            ];
          }),
          (BookView.prototype.getWidgets = function () {
            return [
              "widLoadingProgress",
              "widUserMessage",
              "widFloatWnd",
              "widShare",
              "widTocMenu",
              "widBookmarks",
              "widThumbnails",
              "widSearch",
              "widControls",
              "widSettings",
              "widLoading",
              "widPendingPlay",
              "widToolbar",
            ];
          }),
          (BookView.prototype.getInputs = function () {
            return ["inpPage", "inpPages"];
          }),
          (BookView.prototype.getTexts = function () {
            return ["txtLoadingProgress", "txtUserMessage", "txtShareLink"];
          }),
          (BookView.prototype.getTemplate = function () {
            return {
              html: "templates/default-book-view.html",
              styles: ["css/black-book-view.css"],
              links: [{ rel: "stylesheet", href: "css/font-awesome.min.css" }],
              script: "js/default-book-view.js",
            };
          }),
          BookView
        );
      })(_View3.default);
    (BookView.PAGE_HANDLER_DELAY = 1e3), (exports.default = BookView);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _BookPropsBuilder2 = __webpack_require__(9),
      _BookPropsBuilder3 = _interopRequireDefault(_BookPropsBuilder2),
      _ImageFactory = __webpack_require__(8),
      _ImageFactory2 = _interopRequireDefault(_ImageFactory),
      ClbBookPropsBuilder = (function (_BookPropsBuilder) {
        function ClbBookPropsBuilder(
          context,
          pageCallback,
          pages,
          onReady,
          style
        ) {
          _classCallCheck(this, ClbBookPropsBuilder);
          var _this = _possibleConstructorReturn(
            this,
            _BookPropsBuilder.call(this, onReady, style)
          );
          if (
            (_this.calcSheets(pages),
            (_this.pages = pages),
            (_this.pageCallback = pageCallback),
            (_this.binds = { pageCallback: pageCallback.bind(_this) }),
            (_this.imageFactory = new _ImageFactory2.default(context)),
            pages > 0)
          ) {
            var test = _this.imageFactory.build(
              pageCallback(0),
              0,
              _this.defaults.sheet.widthTexels,
              _this.defaults.sheet.heightTexels,
              _this.defaults.sheet.color
            );
            test.onLoad = function () {
              _this.calcProps(test.width, test.height),
                test.dispose(),
                _this.ready();
            };
          } else (_this.props = _this.defaults), _this.ready();
          return _this;
        }
        return (
          _inherits(ClbBookPropsBuilder, _BookPropsBuilder), ClbBookPropsBuilder
        );
      })(_BookPropsBuilder3.default);
    exports.default = ClbBookPropsBuilder;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _SheetBlock2 = __webpack_require__(10),
      _SheetBlock3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_SheetBlock2),
      Cover = (function (_SheetBlock) {
        function Cover(visual, p, angle, state) {
          return (
            _classCallCheck(this, Cover),
            _possibleConstructorReturn(
              this,
              _SheetBlock.call(this, visual, p, 0, 1, angle, state)
            )
          );
        }
        return (
          _inherits(Cover, _SheetBlock),
          (Cover.prototype.getProps = function () {
            return _extends({}, this.p.cover, { sheets: 1 });
          }),
          (Cover.prototype.loadPoints = function () {
            return {
              interpolationPoints: [
                {
                  x: [
                    [0, 0.2877, 0.6347, 0.8174, 1],
                    [0, 0.2831, 0.6256, 0.8082, 0.9909],
                    [0, 0.2603, 0.5936, 0.7763, 0.9589],
                    [0, 0.137, 0.3881, 0.5342, 0.6758],
                    [0, 0, 0, 0, 0],
                  ],
                  y: [
                    [0, 0, 0, 0, 0],
                    [0, 0.02, 0.005, -0.001, -0.0025],
                    [0, 0.04, 0.01, -0.002, -0.005],
                    [0, 0.2466, 0.4795, 0.5708, 0.6758],
                    [0, 0.2877, 0.6347, 0.8174, 1],
                  ],
                },
              ],
              openedInterpolationIndeces: [
                { left: [2, 3, 4], right: [2, 3, 4] },
              ],
              closedInterpolationIndeces: [[0, 1, 2]],
            };
          }),
          Cover
        );
      })(_SheetBlock3.default);
    exports.default = Cover;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _SheetCssLayer = __webpack_require__(40),
      _SheetCssLayer2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_SheetCssLayer),
      CssLayersManager = (function () {
        function CssLayersManager(book) {
          _classCallCheck(this, CssLayersManager),
            (this.book = book),
            (this.props = book.p.cssLayerProps),
            (this.visual = book.visual),
            (this.pageManager = book.pageManager),
            (this.wrappers = {}),
            (this.pendings = []);
        }
        return (
          (CssLayersManager.prototype.getActives = function () {
            var page = this.book.getPage(),
              pages = this.book.getBookPages(),
              acs =
                0 === page || page === pages - 1 ? [page] : [page, page + 1];
            return (
              this.wrappers[0] || 0 === page || (acs = [0].concat(acs)), acs
            );
          }),
          (CssLayersManager.prototype.dispose = function () {
            for (
              var _iterator = Object.values(this.wrappers),
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              _ref.layers.forEach(function (l) {
                return l.dispose();
              });
            }
            delete this.wrappers;
          }),
          (CssLayersManager.prototype.show = function () {
            var _this = this;
            this.hidden = !1;
            for (
              var _iterator2 = this.getActives(),
                _isArray2 = Array.isArray(_iterator2),
                _i2 = 0,
                _iterator2 = _isArray2
                  ? _iterator2
                  : _iterator2[Symbol.iterator]();
              ;

            ) {
              var _ref2;
              if (
                "break" ===
                (function () {
                  if (_isArray2) {
                    if (_i2 >= _iterator2.length) return "break";
                    _ref2 = _iterator2[_i2++];
                  } else {
                    if (((_i2 = _iterator2.next()), _i2.done)) return "break";
                    _ref2 = _i2.value;
                  }
                  var n = _ref2,
                    w = _this.wrappers[n];
                  if (w) {
                    if ("ready" === w.state && w.layers.length) {
                      var block = _this.book.getBlockByPage(n);
                      w.layers.forEach(function (l) {
                        l.isHidden() && (l.update(block), l.show());
                      });
                    }
                  } else {
                    var _w = (_this.wrappers[n] = {
                      state: "loading",
                      layers: [],
                    });
                    Promise.resolve().then(function () {
                      _this.pageManager.getLayers(n, function (layers) {
                        var finish = function () {
                          if (layers.length && _this.wrappers) {
                            for (
                              var _block = _this.book.getBlockByPage(n),
                                _iterator3 = layers,
                                _isArray3 = Array.isArray(_iterator3),
                                _i3 = 0,
                                _iterator3 = _isArray3
                                  ? _iterator3
                                  : _iterator3[Symbol.iterator]();
                              ;

                            ) {
                              var _ref3;
                              if (_isArray3) {
                                if (_i3 >= _iterator3.length) break;
                                _ref3 = _iterator3[_i3++];
                              } else {
                                if (((_i3 = _iterator3.next()), _i3.done))
                                  break;
                                _ref3 = _i3.value;
                              }
                              var l = _ref3,
                                sl = new _SheetCssLayer2.default(
                                  _this.visual,
                                  _block,
                                  _extends({}, _this.props, { pageNumber: n })
                                );
                              _w.layers.push(sl), sl.set(l.css, l.html, l.js);
                            }
                            setTimeout(function () {
                              !_this.hidden &&
                                ~_this.getActives().indexOf(n) &&
                                _w.layers.forEach(function (l) {
                                  return l.show();
                                });
                            }, 10);
                          }
                          _w.state = "ready";
                        };
                        if (
                          !_this.wrappers ||
                          (0 !== n && "loading" === _this.wrappers[0].state)
                        )
                          _this.pendings.push(finish);
                        else if ((finish(), 0 === n)) {
                          for (
                            var _iterator4 = _this.pendings,
                              _isArray4 = Array.isArray(_iterator4),
                              _i4 = 0,
                              _iterator4 = _isArray4
                                ? _iterator4
                                : _iterator4[Symbol.iterator]();
                            ;

                          ) {
                            var _ref4;
                            if (_isArray4) {
                              if (_i4 >= _iterator4.length) break;
                              _ref4 = _iterator4[_i4++];
                            } else {
                              if (((_i4 = _iterator4.next()), _i4.done)) break;
                              _ref4 = _i4.value;
                            }
                            var f = _ref4;
                            f();
                          }
                          _this.pendings = [];
                        }
                      });
                    });
                  }
                })()
              )
                break;
            }
          }),
          (CssLayersManager.prototype.hide = function () {
            this.hidden = !0;
            for (
              var wait = [],
                _iterator5 = Object.values(this.wrappers),
                _isArray5 = Array.isArray(_iterator5),
                _i5 = 0,
                _iterator5 = _isArray5
                  ? _iterator5
                  : _iterator5[Symbol.iterator]();
              ;

            ) {
              var _ref5;
              if (_isArray5) {
                if (_i5 >= _iterator5.length) break;
                _ref5 = _iterator5[_i5++];
              } else {
                if (((_i5 = _iterator5.next()), _i5.done)) break;
                _ref5 = _i5.value;
              }
              _ref5.layers.forEach(function (l) {
                return wait.push(l.hide());
              });
            }
            return Promise.all(wait);
          }),
          CssLayersManager
        );
      })();
    exports.default = CssLayersManager;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(1),
      _Cache = __webpack_require__(14),
      _Cache2 = _interopRequireDefault(_Cache),
      _LoadingAnimation = __webpack_require__(55),
      _LoadingAnimation2 = _interopRequireDefault(_LoadingAnimation),
      _ImageFactory = __webpack_require__(8),
      _ImageFactory2 = _interopRequireDefault(_ImageFactory),
      _TextureAnimator = __webpack_require__(63),
      _TextureAnimator2 = _interopRequireDefault(_TextureAnimator),
      _GraphUtils = __webpack_require__(4),
      _GraphUtils2 = _interopRequireDefault(_GraphUtils),
      PageManager = (function () {
        function PageManager(visual, book, p) {
          _classCallCheck(this, PageManager),
            (this.visual = visual),
            (this.book = book),
            (this.pageQuery = ""),
            (this.p = p),
            (this.pageCache = new _Cache2.default(p.cachedPages)),
            (this.resourcesCache = new _Cache2.default()),
            (this.canvases = []);
          for (var i = 0; i < 5; ++i) {
            var c = _GraphUtils2.default.createCanvas();
            this.canvases.push({
              c: c,
              ctx: c.getContext("2d", {
                willReadFrequently: !0,
                desynchronized: !1,
              }),
            });
          }
          (this.nextCanvas = 0),
            (this.imageFactory = new _ImageFactory2.default(
              _extends({}, visual, {
                dispatchEvent: book.dispatchEvent.bind(book),
                renderCanvas: this.canvases[0].c,
                renderCanvasCtx: this.canvases[0].ctx,
              }),
              this.resourcesCache
            )),
            (this.loadings = []),
            (this.renderQueue = []),
            (this.predictedRequests = []),
            (this.tmpMaterial = new _libs.THREE.MeshBasicMaterial()),
            visual.addObject(
              new _libs.THREE.Mesh(
                new _libs.THREE.PlaneGeometry(0.001, 0.001),
                this.tmpMaterial
              )
            ),
            (this.loadingAnimation = !0),
            (this.loading = {}),
            (this.loading[p.cover.color] = this.createLoadingTexture(p.cover)),
            p.page.color !== p.cover.color &&
              (this.loading[p.page.color] = this.createLoadingTexture(p.page)),
            this.book.addEventListener(
              "afterAnimation",
              this.loadPredictedPages.bind(this)
            ),
            this.turnOnEvents(),
            visual.addRenderCallback(this.update.bind(this)),
            Promise.resolve().then(this.updateRenderQueue.bind(this));
        }
        return (
          (PageManager.prototype.createLoadingTexture = function (p) {
            var heightTexels = (p.height / p.width) * p.widthTexels,
              scale = Math.sqrt(1262992.5 / (p.widthTexels * heightTexels)),
              animation = new _LoadingAnimation2.default(
                scale * p.widthTexels,
                scale * heightTexels,
                p.color
              ),
              animator = new _TextureAnimator2.default(
                animation.createSprite(6),
                6,
                1,
                6,
                0.2
              );
            return animation.dispose(), animator;
          }),
          (PageManager.prototype.dispose = function () {
            this.turnOffEvents();
            for (
              var _iterator = Object.keys(this.loading),
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var color = _ref;
              this.loading[color].dispose();
            }
            delete this.loading,
              this.resourcesCache.dispose(),
              this.pageCache.dispose();
            for (
              var _iterator2 = this.canvases,
                _isArray2 = Array.isArray(_iterator2),
                _i2 = 0,
                _iterator2 = _isArray2
                  ? _iterator2
                  : _iterator2[Symbol.iterator]();
              ;

            ) {
              var _ref2;
              if (_isArray2) {
                if (_i2 >= _iterator2.length) break;
                _ref2 = _iterator2[_i2++];
              } else {
                if (((_i2 = _iterator2.next()), _i2.done)) break;
                _ref2 = _i2.value;
              }
              var o = _ref2;
              o.c.height = o.c.width = 0;
            }
            delete this.canvases;
          }),
          (PageManager.prototype.isCover = function (n) {
            return n < 2 || n >= 2 * (this.p.sheets + 1);
          }),
          (PageManager.prototype.isMobile = function () {
            return this.visual.isMobile();
          }),
          (PageManager.prototype.getPageState = function (n) {
            var object = this.pageCache.get(n);
            return object ? object.state : void 0;
          }),
          (PageManager.prototype.enableLoadingAnimation = function (enable) {
            this.loadingAnimation = enable;
            for (
              var _iterator3 = this.loadings,
                _isArray3 = Array.isArray(_iterator3),
                _i3 = 0,
                _iterator3 = _isArray3
                  ? _iterator3
                  : _iterator3[Symbol.iterator]();
              ;

            ) {
              var _ref3;
              if (_isArray3) {
                if (_i3 >= _iterator3.length) break;
                _ref3 = _iterator3[_i3++];
              } else {
                if (((_i3 = _iterator3.next()), _i3.done)) break;
                _ref3 = _i3.value;
              }
              var o = _ref3;
              this.setupMaterial(o);
            }
          }),
          (PageManager.prototype.update = function (dt) {
            if (this.loadingAnimation) {
              for (
                var loading = {},
                  _iterator4 = this.loadings,
                  _isArray4 = Array.isArray(_iterator4),
                  _i4 = 0,
                  _iterator4 = _isArray4
                    ? _iterator4
                    : _iterator4[Symbol.iterator]();
                ;

              ) {
                var _ref4;
                if (_isArray4) {
                  if (_i4 >= _iterator4.length) break;
                  _ref4 = _iterator4[_i4++];
                } else {
                  if (((_i4 = _iterator4.next()), _i4.done)) break;
                  _ref4 = _i4.value;
                }
                var o = _ref4;
                o.isActive() && (loading[o.color] = !0);
              }
              for (
                var _iterator5 = Object.keys(loading),
                  _isArray5 = Array.isArray(_iterator5),
                  _i5 = 0,
                  _iterator5 = _isArray5
                    ? _iterator5
                    : _iterator5[Symbol.iterator]();
                ;

              ) {
                var _ref5;
                if (_isArray5) {
                  if (_i5 >= _iterator5.length) break;
                  _ref5 = _iterator5[_i5++];
                } else {
                  if (((_i5 = _iterator5.next()), _i5.done)) break;
                  _ref5 = _i5.value;
                }
                var color = _ref5;
                this.loading[color].update(dt), this.book.updateThree();
              }
            }
          }),
          (PageManager.prototype.removeFromLoadings = function (o) {
            var i = this.loadings.indexOf(o);
            ~i && this.loadings.splice(i, 1);
          }),
          (PageManager.prototype.removeFromRenderQueue = function (o) {
            var i = this.renderQueue.indexOf(o);
            ~i && this.renderQueue.splice(i, 1);
          }),
          (PageManager.prototype.refreshPageQuery = function (n) {
            var query =
              arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : "";
            this.pageQuery = query;
            var object = this.pageCache.get(n);
            object &&
              object.wrapper &&
              object.wrapper.setQuery &&
              (this.pageCache.remove(n) ||
                (object.wrapper.setQuery(query),
                this.pushInRenderQueue(object)));
          }),
          (PageManager.prototype.refreshZoom = function () {
            var _this = this;
            if (this.p.autoResolution.enabled) {
              this.rendering &&
                this.rendering.wrapper &&
                this.rendering.wrapper.cancelRender();
              var es = [];
              this.pageCache.forEach(function (e) {
                es.push(e);
              }),
                es.forEach(function (e) {
                  var object = e[1];
                  object &&
                    object.wrapper &&
                    (_this.pageCache.remove(e[0]) ||
                      _this.pushInRenderQueue(object));
                });
            }
          }),
          (PageManager.prototype.getLayers = function (n, clb) {
            var _this2 = this;
            (this.p.cssLayersLoader
              ? this.p.cssLayersLoader
              : function (n, f) {
                  return f([]);
                })(n, function (layers) {
              var object = _this2.pageCache.get(n);
              object &&
                (object.wrapper.getCSSLayer && _this2.p.highlightLinks
                  ? object.wrapper.getCSSLayer()
                  : Promise.resolve()
                ).then(function (l) {
                  (l || layers[0]) &&
                    ((l = l || {}),
                    (layers[0] = layers[0] || {}),
                    (layers[0] = {
                      html: (l.html || "") + (layers[0].html || ""),
                      css: (l.css || "") + (layers[0].css || ""),
                      js: layers[0].js,
                    })),
                    "active" !== object.state
                      ? object.pendings.push({ clb: clb, args: [layers] })
                      : clb(layers);
                });
            });
          }),
          (PageManager.prototype.resolvePendings = function (pendings) {
            for (
              var _iterator6 = pendings,
                _isArray6 = Array.isArray(_iterator6),
                _i6 = 0,
                _iterator6 = _isArray6
                  ? _iterator6
                  : _iterator6[Symbol.iterator]();
              ;

            ) {
              var _ref6;
              if (_isArray6) {
                if (_i6 >= _iterator6.length) break;
                _ref6 = _iterator6[_i6++];
              } else {
                if (((_i6 = _iterator6.next()), _i6.done)) break;
                _ref6 = _i6.value;
              }
              var p = _ref6;
              try {
                p.clb.apply(p, p.args);
              } catch (e) {
                console.error(e);
              }
            }
            pendings.splice(0, pendings.length);
          }),
          (PageManager.prototype.rtlPageN = function (n) {
            return this.p.rtl ? this.book.getBookPages() - 1 - n : n;
          }),
          (PageManager.prototype.load = function (material, n) {
            var _this3 = this,
              pi =
                this.rtlPageN(n) < this.book.getPages()
                  ? this.p.pageCallback(this.rtlPageN(n))
                  : { type: "blank" },
              p = this.isCover(n) ? this.p.cover : this.p.page,
              o = {
                n: n,
                texture: new _libs.THREE.Texture(),
                wrapper: null,
                state: "loading",
                locked: function (n) {
                  return (
                    "loading" === o.state ||
                    "rendering" === o.state ||
                    _this3.book.isActivePage(n)
                  );
                },
                color: p.color,
                isActive: function () {
                  return _this3.book.isActivePage(n);
                },
                isTop: function () {
                  return ~_this3.book.getTopPages().indexOf(n);
                },
                dispose: function () {
                  _this3.removeFromLoadings(o),
                    _this3.removeFromRenderQueue(o),
                    o.wrapper && o.wrapper.dispose && o.wrapper.dispose(),
                    o.texture.dispose(),
                    delete o.texture,
                    delete o.wrapper;
                },
                pendings: [],
              };
            return (
              (o.texture.minFilter = _libs.THREE.LinearFilter),
              this.loadings.push(o),
              this.setMaterial(o, material),
              Promise.resolve().then(function () {
                if (o.texture) {
                  (o.widthTexels = pi.widthTexels || p.widthTexels),
                    (o.heightTexels = (p.height / p.width) * p.widthTexels);
                  var res = _this3.calcResolution(o);
                  (o.wrapper = _this3.imageFactory.build(
                    pi,
                    void 0 === pi.number ? _this3.rtlPageN(n) : pi.number,
                    res.width,
                    res.height,
                    p.color,
                    _this3.p.injector
                  )),
                    o.wrapper.setQuery && o.wrapper.setQuery(_this3.pageQuery),
                    (o.simulate = pi.interactive
                      ? (o.wrapper.simulate || function () {}).bind(o.wrapper)
                      : void 0),
                    (o.wrapper.onLoad = function () {
                      (o.state = "loaded"), _this3.pushInRenderQueue(o);
                    }),
                    (o.wrapper.onChange = function (image, canceled) {
                      canceled
                        ? ("queuedForRender" !== o.state &&
                            ((o.state = "loaded"),
                            o.wrapper &&
                              _this3.pushInRenderQueue(_this3.rendering)),
                          delete _this3.rendering)
                        : o.texture &&
                          (_this3.removeFromLoadings(o),
                          o.material &&
                            ((o.material.map = o.texture),
                            (o.material.color = new _libs.THREE.Color(
                              16777215
                            )),
                            (o.material.needsUpdate = !0)),
                          (o.texture.image = image),
                          (o.texture.needsUpdate = !0),
                          (o.texture.onUpdate = function () {
                            o.texture && (o.texture.onUpdate = null),
                              (_this3.tmpMaterial.map = null),
                              (_this3.tmpMaterial.needsUpdate = !0),
                              "queuedForRender" !== o.state &&
                                ((o.state = "active"),
                                _this3.resolvePendings(o.pendings)),
                              delete _this3.rendering,
                              _this3.book.dispatchEvent({
                                type: "endRendering",
                                page: o.n,
                              });
                          }),
                          (_this3.tmpMaterial.map = o.texture),
                          (_this3.tmpMaterial.needsUpdate = !0));
                    });
                }
              }),
              this.pageCache.put(n, o)
            );
          }),
          (PageManager.prototype.isSinglePage = function (o) {
            return this.p.singlePage;
          }),
          (PageManager.prototype.calcResolution = function (o) {
            var res = void 0;
            if (this.p.autoResolution.enabled) {
              var k =
                this.p.autoResolution.coefficient *
                this.p.zoom *
                Math.sqrt(this.visual.wnd.devicePixelRatio || 1) *
                Math.min(
                  ((this.isSinglePage(o) ? 1 : 0.5) * this.visual.width()) /
                    o.widthTexels,
                  this.visual.height() / o.heightTexels
                );
              res = { width: k * o.widthTexels, height: k * o.heightTexels };
              var minRes = this.p.autoResolution.min,
                maxRes = this.p.autoResolution.max;
              res.width < minRes &&
                (res = {
                  width: minRes,
                  height: (minRes * o.heightTexels) / o.widthTexels,
                }),
                res.height < minRes &&
                  (res = {
                    width: (minRes * o.widthTexels) / o.heightTexels,
                    height: minRes,
                  }),
                res.width > maxRes &&
                  (res = {
                    width: maxRes,
                    height: (maxRes * o.heightTexels) / o.widthTexels,
                  }),
                res.height > maxRes &&
                  (res = {
                    width: (maxRes * o.widthTexels) / o.heightTexels,
                    height: maxRes,
                  });
            } else res = { width: o.widthTexels, height: o.heightTexels };
            return res;
          }),
          (PageManager.prototype.pushInRenderQueue = function (o) {
            "queuedForRender" !== o.state &&
              "loading" !== o.state &&
              ((o.state = "queuedForRender"), this.renderQueue.push(o));
          }),
          (PageManager.prototype.updateRenderQueue = function () {
            if (this.canvases) {
              var p = this.p;
              if (this.rendering)
                this.rendering.wrapper &&
                  this.rendering.wrapper.setRenderPause(
                    !p.renderWhileFlipping &&
                      (this.book.isProcessing() ||
                        this.visual.getOrbit().isMoving())
                  ),
                  this.book.updateThree();
              else if (
                p.renderWhileFlipping ||
                (!this.book.isProcessing() &&
                  !this.visual.getOrbit().isMoving())
              ) {
                for (
                  var active = void 0,
                    top = void 0,
                    _iterator7 = this.renderQueue,
                    _isArray7 = Array.isArray(_iterator7),
                    _i7 = 0,
                    _iterator7 = _isArray7
                      ? _iterator7
                      : _iterator7[Symbol.iterator]();
                  ;

                ) {
                  var _ref7;
                  if (_isArray7) {
                    if (_i7 >= _iterator7.length) break;
                    _ref7 = _iterator7[_i7++];
                  } else {
                    if (((_i7 = _iterator7.next()), _i7.done)) break;
                    _ref7 = _i7.value;
                  }
                  var _o2 = _ref7;
                  if (
                    (!active && _o2.isActive() && (active = _o2), _o2.isTop())
                  ) {
                    top = _o2;
                    break;
                  }
                }
                if (
                  ((this.rendering = top || active),
                  ((this.isMobile() && p.renderInactivePagesOnMobile) ||
                    (!this.isMobile() && p.renderInactivePages)) &&
                    !this.rendering)
                )
                  for (
                    var ud = this.book.getUserDirection(),
                      near = {},
                      _iterator8 = this.renderQueue,
                      _isArray8 = Array.isArray(_iterator8),
                      _i8 = 0,
                      _iterator8 = _isArray8
                        ? _iterator8
                        : _iterator8[Symbol.iterator]();
                    ;

                  ) {
                    var _ref8;
                    if (_isArray8) {
                      if (_i8 >= _iterator8.length) break;
                      _ref8 = _iterator8[_i8++];
                    } else {
                      if (((_i8 = _iterator8.next()), _i8.done)) break;
                      _ref8 = _i8.value;
                    }
                    var o = _ref8,
                      id = ud.lastTopPage < o.n;
                    (!near[id] ||
                      Math.abs(near[id].n - ud.lastTopPage) >
                        Math.abs(o.n - ud.lastTopPage)) &&
                      (near[id] = o),
                      (this.rendering =
                        near[1 === ud.direction] || near[1 !== ud.direction]);
                  }
                if (this.rendering)
                  if (
                    this.rendering.wrapper &&
                    this.rendering.wrapper.startRender
                  ) {
                    this.removeFromRenderQueue(this.rendering),
                      (this.rendering.state = "rendering");
                    var _o = this.canvases[this.nextCanvas];
                    (this.nextCanvas =
                      (this.nextCanvas + 1) % this.canvases.length),
                      this.rendering.wrapper.setRenderCanvas(_o.c, _o.ctx),
                      this.rendering.wrapper.setResolution(
                        this.calcResolution(this.rendering)
                      ),
                      this.rendering.wrapper.startRender(),
                      this.book.dispatchEvent({
                        type: "startRendering",
                        page: _o.n,
                      });
                  } else delete this.rendering;
              }
              setTimeout(this.updateRenderQueue.bind(this), 100);
            }
          }),
          (PageManager.prototype.turnOnEvents = function () {
            this.transferEvents = !0;
          }),
          (PageManager.prototype.turnOffEvents = function () {
            var mouseup = _libs.$.Event("mouseup"),
              mouseout = _libs.$.Event("mouseout");
            this.pageCache.forEach(function (ent) {
              var object = ent[1];
              object.simulate &&
                (object.simulate(mouseup, void 0, 0, 0),
                object.simulate(mouseout, void 0, 0, 0));
            }),
              (this.transferEvents = !1);
          }),
          (PageManager.prototype.transferEventToTexture = function (
            n,
            e,
            data
          ) {
            if (this.transferEvents) {
              var toObject = this.getOrLoadTextureObject(void 0, n);
              if (toObject.wrapper) {
                var uv = data.uv,
                  toDoc = toObject.wrapper.getSimulatedDoc();
                this.pageCache.forEach(function (ent) {
                  var object = ent[1];
                  object.simulate && object.simulate(e, toDoc, uv.x, uv.y);
                });
              }
            }
          }),
          (PageManager.prototype.loadPredictedPages = function () {
            var _this4 = this;
            Promise.resolve().then(function () {
              var ud = _this4.book.getUserDirection();
              _this4.predictedRequests = [];
              for (
                var i = 0, p = ud.lastTopPage + ud.direction;
                i < _this4.p.preloadPages;
                ++i, p += ud.direction
              )
                _this4.predictedRequests.push(p);
              for (
                var _iterator9 = _this4.predictedRequests,
                  _isArray9 = Array.isArray(_iterator9),
                  _i9 = 0,
                  _iterator9 = _isArray9
                    ? _iterator9
                    : _iterator9[Symbol.iterator]();
                ;

              ) {
                var _ref9;
                if (_isArray9) {
                  if (_i9 >= _iterator9.length) break;
                  _ref9 = _iterator9[_i9++];
                } else {
                  if (((_i9 = _iterator9.next()), _i9.done)) break;
                  _ref9 = _i9.value;
                }
                var _p = _ref9;
                _p >= 0 &&
                  _p < _this4.book.getBookPages() &&
                  !_this4.pageCache.get(_p) &&
                  _this4.load(void 0, _p);
              }
            });
          }),
          (PageManager.prototype.setMaterial = function (o, material) {
            this.pageCache.forEach(function (e) {
              var ob = e[1];
              o !== ob && ob.material === material && delete ob.material;
            }),
              material &&
                material !== o.material &&
                ((o.material = material), this.setupMaterial(o));
          }),
          (PageManager.prototype.setupMaterial = function (o) {
            (o.material.map = o.texture.image
              ? o.texture
              : this.loadingAnimation
              ? this.loading[o.color].texture
              : null),
              o.material.map ||
                (o.material.color = new _libs.THREE.Color(o.color)),
              (o.material.needsUpdate = !0);
          }),
          (PageManager.prototype.getOrLoadTextureObject = function (
            material,
            n
          ) {
            var object = this.pageCache.get(n);
            return (
              object
                ? this.setMaterial(object, material)
                : (object = this.load(material, n)),
              object
            );
          }),
          (PageManager.prototype.setTexture = function (material, n) {
            this.getOrLoadTextureObject(material, n);
          }),
          PageManager
        );
      })();
    exports.default = PageManager;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _BookPropsBuilder2 = __webpack_require__(9),
      _BookPropsBuilder3 = _interopRequireDefault(_BookPropsBuilder2),
      _Pdf = __webpack_require__(19),
      _Pdf2 = _interopRequireDefault(_Pdf),
      PdfBookPropsBuilder = (function (_BookPropsBuilder) {
        function PdfBookPropsBuilder(src, onReady, style, pdfOpenOptions) {
          _classCallCheck(this, PdfBookPropsBuilder);
          var _this = _possibleConstructorReturn(
            this,
            _BookPropsBuilder.call(this, onReady, style)
          );
          return (
            (_this.pdf = new _Pdf2.default(src, void 0, pdfOpenOptions)),
            (_this.pageDescription = {
              type: "pdf",
              src: _this.pdf,
              interactive: !0,
            }),
            (_this.binds = { pageCallback: _this.pageCallback.bind(_this) }),
            _this.pdf.getHandler(_this.init.bind(_this)),
            _this
          );
        }
        return (
          _inherits(PdfBookPropsBuilder, _BookPropsBuilder),
          (PdfBookPropsBuilder.prototype.dispose = function () {
            this.pdf.dispose(), _BookPropsBuilder.prototype.dispose.call(this);
          }),
          (PdfBookPropsBuilder.prototype.init = function (handler) {
            var _this2 = this,
              pages = this.pdf.getPagesNum();
            (this.pages = pages),
              this.calcSheets(pages),
              pages > 0
                ? handler
                    .getPage(1)
                    .then(function (page) {
                      var viewport = page.getViewport({ scale: 1 }),
                        size = {
                          width: viewport.width,
                          height: viewport.height,
                        };
                      _this2.calcProps(size.width, size.height), _this2.ready();
                    })
                    .catch(function (e) {
                      console.error(e);
                    })
                : ((this.props = this.defaults), this.ready());
          }),
          (PdfBookPropsBuilder.prototype.pageCallback = function (n) {
            return this.pageDescription;
          }),
          PdfBookPropsBuilder
        );
      })(_BookPropsBuilder3.default);
    exports.default = PdfBookPropsBuilder;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(1),
      PdfLinksHandler = (function () {
        function PdfLinksHandler(pdf, ctrl, element) {
          _classCallCheck(this, PdfLinksHandler),
            (this.pdf = pdf),
            (this.ctrl = ctrl),
            (this.element = (0, _libs.$)(element)),
            (this.cursors = []);
        }
        return (
          (PdfLinksHandler.prototype.dispose = function () {}),
          (PdfLinksHandler.prototype.setHandler = function (handler) {
            this.handler = handler;
          }),
          (PdfLinksHandler.prototype.defaultHandler = function (
            type,
            destination
          ) {
            "internal" === type
              ? this.ctrl.goToPage(destination)
              : "external" === type && window.open(destination, "_blank");
          }),
          (PdfLinksHandler.prototype.callHandlers = function (
            type,
            destination
          ) {
            (this.handler && this.handler(type, destination)) ||
              this.defaultHandler(type, destination);
          }),
          (PdfLinksHandler.prototype.handleEvent = function (data) {
            var _this = this,
              e = data.event,
              anno = data.annotation;
            switch (e.type) {
              case "mouseover":
                this.cursors.push(this.element.css("cursor")),
                  this.element.css("cursor", "pointer");
                break;
              case "mouseout":
                this.element.css("cursor", this.cursors.pop() || "");
                break;
              case "touchtap":
              case "click":
                anno.url
                  ? this.callHandlers("external", anno.url)
                  : anno.dest &&
                    this.pdf.getDestination(anno.dest).then(function (number) {
                      return _this.callHandlers("internal", number);
                    });
            }
          }),
          PdfLinksHandler
        );
      })();
    exports.default = PdfLinksHandler;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _Finder = __webpack_require__(17),
      _Finder2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_Finder),
      SearchEngine = (function () {
        function SearchEngine(pageCallback, pages) {
          _classCallCheck(this, SearchEngine),
            (this.pageCallback = pageCallback),
            (this.pages = pages),
            (this.results = []);
        }
        return (
          (SearchEngine.prototype.setQuery = function (query) {
            (this.query = query), (this.update = !0), this.process();
          }),
          (SearchEngine.prototype.process = function () {
            var _this = this;
            if (this.update) {
              var results = this.results;
              if (((this.results = []), this.onPageHitsChanged))
                for (
                  var _iterator = results,
                    _isArray = Array.isArray(_iterator),
                    _i = 0,
                    _iterator = _isArray
                      ? _iterator
                      : _iterator[Symbol.iterator]();
                  ;

                ) {
                  if (_isArray) {
                    if (_i >= _iterator.length) break;
                    _iterator[_i++];
                  } else {
                    if (((_i = _iterator.next()), _i.done)) break;
                    _i.value;
                  }
                  this.onPageHitsChanged(void 0, "");
                }
              (this.update = !1),
                (this.page = 0),
                (this.stamp = Date.now()),
                this.query.length > 1 && this.process();
            } else if (this.page < this.pages) {
              var stamp = this.stamp;
              this.find(this.pageCallback(this.page)).then(function (contexts) {
                stamp === _this.stamp &&
                  (contexts.length &&
                    _this.results.push({
                      page: _this.page,
                      contexts: contexts,
                    }),
                  _this.onPageHitsChanged &&
                    _this.onPageHitsChanged(_this.page, _this.query),
                  ++_this.page,
                  _this.process());
              });
            }
          }),
          (SearchEngine.prototype.find = function (pi) {
            var _this2 = this;
            return "pdf" === pi.type
              ? new Promise(function (resolve) {
                  pi.src.getHandler(function () {
                    var n = void 0 === pi.number ? _this2.page : pi.number;
                    "right" === pi.src.getPageType(n)
                      ? resolve([])
                      : pi.src
                          .getPage(n)
                          .then(function (page) {
                            page.getTextContent().then(function (textContent) {
                              resolve(
                                new _Finder2.default(
                                  textContent.items.map(function (item) {
                                    return item.str;
                                  }),
                                  _this2.query,
                                  { hits: !1 }
                                ).getContexts()
                              );
                            });
                          })
                          .catch(function () {
                            return resolve([]);
                          });
                  });
                })
              : Promise.resolve([]);
          }),
          SearchEngine
        );
      })();
    exports.default = SearchEngine;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(1),
      _WidgetController2 = __webpack_require__(22),
      _WidgetController3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_WidgetController2),
      ShareController = (function (_WidgetController) {
        function ShareController(view, bookCtrl) {
          var linkBuilder =
            arguments.length > 2 && void 0 !== arguments[2]
              ? arguments[2]
              : function (page) {
                  return page;
                };
          _classCallCheck(this, ShareController);
          var _this = _possibleConstructorReturn(
            this,
            _WidgetController.call(this, view, "widShare")
          );
          return (
            (_this.bookCtrl = bookCtrl),
            (_this.linkBuilder = linkBuilder),
            bookCtrl.addEventListener("endFlip", _this.updateView.bind(_this)),
            _this
          );
        }
        return (
          _inherits(ShareController, _WidgetController),
          (ShareController.prototype.cmdCloseShare = function () {
            this.hide();
          }),
          (ShareController.prototype.clickLink = function (u) {
            var blank =
                !(arguments.length > 1 && void 0 !== arguments[1]) ||
                arguments[1],
              a = (0, _libs.$)(
                '<a href="' +
                  u +
                  '"' +
                  (blank ? ' target="_blank"' : "") +
                  "></a>"
              ).appendTo(this.view.getContainer());
            a[0].click(), a.remove();
          }),
          (ShareController.prototype.cmdFacebook = function () {
            this.clickLink(
              "https://www.facebook.com/sharer/sharer.php?u=" +
                encodeURIComponent(this.getLink())
            );
          }),
          (ShareController.prototype.cmdTwitter = function () {
            this.clickLink(
              "http://twitter.com/share?url=" +
                encodeURIComponent(this.getLink())
            );
          }),
          (ShareController.prototype.cmdEmail = function () {
            this.clickLink(
              "mailto:?subject=" +
                (0, _libs.tr)("We wanted you to see this book") +
                "&body=" +
                (0, _libs.tr)("Check out this site") +
                " " +
                encodeURIComponent(this.getLink()),
              !1
            );
          }),
          (ShareController.prototype.getLink = function () {
            return this.linkBuilder(this.bookCtrl.getPageForGUI());
          }),
          (ShareController.prototype.updateView = function () {
            if (this.view) {
              for (
                var _arr = [
                    "cmdCloseShare",
                    "cmdFacebook",
                    "cmdTwitter",
                    "cmdEmail",
                  ],
                  _i = 0;
                _i < _arr.length;
                _i++
              ) {
                var cmd = _arr[_i];
                this.view.setState(cmd, {
                  enable: !0,
                  visible: !0,
                  active: !1,
                });
              }
              this.view.setState("txtShareLink", {
                value: this.getLink(),
                visible: !0,
              }),
                _WidgetController.prototype.updateView.call(this);
            }
          }),
          ShareController
        );
      })(_WidgetController3.default);
    exports.default = ShareController;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _CSSLayer = __webpack_require__(13),
      _CSSLayer2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_CSSLayer),
      SheetCssLayer = (function () {
        function SheetCssLayer(visual, block, props) {
          _classCallCheck(this, SheetCssLayer), (this.visual = visual);
          var size = block.getTopSize();
          (this.layer = new _CSSLayer2.default(size.width, size.height, props)),
            this.update(block),
            this.visual.addCssObject(this.layer);
        }
        return (
          (SheetCssLayer.prototype.dispose = function () {
            this.layer.dispose(), this.visual.removeCssObject(this.layer);
          }),
          (SheetCssLayer.prototype.isHidden = function () {
            return this.layer.isHidden();
          }),
          (SheetCssLayer.prototype.hide = function () {
            return this.layer.hide();
          }),
          (SheetCssLayer.prototype.show = function () {
            return this.layer.show();
          }),
          (SheetCssLayer.prototype.set = function (css, html, js) {
            this.layer.setData(css, html, js);
          }),
          (SheetCssLayer.prototype.update = function (block) {
            this.block = block;
            var size = block.getTopSize();
            this.layer.setSize(size.width, size.height),
              this.block.getTopWorldRotation(this.layer.rotation),
              this.block.getTopWorldPosition(this.layer.position);
          }),
          SheetCssLayer
        );
      })();
    exports.default = SheetCssLayer;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _MathUtils = __webpack_require__(5),
      _MathUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_MathUtils),
      SheetPhysics = (function () {
        function SheetPhysics() {
          var r =
              arguments.length > 0 && void 0 !== arguments[0]
                ? arguments[0]
                : 1,
            gravity =
              arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : 1,
            cornerDeviation =
              arguments.length > 2 && void 0 !== arguments[2]
                ? arguments[2]
                : 0.15,
            fps =
              arguments.length > 3 && void 0 !== arguments[3]
                ? arguments[3]
                : 240;
          _classCallCheck(this, SheetPhysics),
            (this.p = {
              r: r,
              cornerDeviation: cornerDeviation,
              l: Math.PI * r,
              startDt: 1 / fps,
              gravity: gravity,
              margin: 0.002 * r,
              infM: 1e4,
              attempts: 16,
              maxIterations: 100,
            }),
            (this.os = []);
        }
        return (
          (SheetPhysics.targetForceClb = function (o, a, v, ch) {
            var l = a * this.r;
            return (
              100 *
                this.m *
                this.g *
                (2 / (1 + Math.exp(10 * (l - this.tl))) - 1) -
              40 * this.m * v
            );
          }),
          (SheetPhysics.hoverCornerForceClb = function (o, v, l, ch) {
            return 5;
          }),
          (SheetPhysics.prototype.getTargetForceClb = function (
            mass,
            targetAngle
          ) {
            return SheetPhysics.targetForceClb.bind({
              g: this.p.gravity,
              m: mass,
              tl: targetAngle * this.p.r,
              r: this.p.r,
            });
          }),
          (SheetPhysics.dragForceClb = function (o, a, v, ch) {
            return (
              o.flbt *
              o.m *
              (10 * o.g * ch - (50 * v) / (1 + Math.exp(3.5 * Math.abs(ch))))
            );
          }),
          (SheetPhysics.dragCornerForceClb = function (o, a, v, ch) {
            return 15 * (2 / (1 + Math.exp(10 * (a - this.ta) * o.r)) - 1);
          }),
          (SheetPhysics.getDragCornerForceClb = function (targetAngle) {
            return SheetPhysics.dragCornerForceClb.bind({ ta: targetAngle });
          }),
          (SheetPhysics.prototype.dispose = function () {
            this.os = [];
          }),
          (SheetPhysics.prototype.getSize = function () {
            return this.os.length;
          }),
          (SheetPhysics.prototype.addObject = function (
            mass,
            angle,
            velocity,
            flexibility,
            cornerHeight,
            simulateClb,
            removeClb
          ) {
            var forceClb =
                arguments.length > 7 && void 0 !== arguments[7]
                  ? arguments[7]
                  : function () {
                      return 0;
                    },
              cornerForceClb =
                arguments.length > 8 && void 0 !== arguments[8]
                  ? arguments[8]
                  : function () {
                      return 0;
                    },
              no = {
                id: _MathUtils2.default.getUnique(),
                m: mass,
                v: velocity,
                l: angle * this.p.r,
                f: forceClb,
                cf: cornerForceClb,
                ch: cornerHeight,
                flbt: flexibility,
                simulateClb: simulateClb,
                removeClb: removeClb,
              },
              i = this.os.findIndex(function (o) {
                return no.l <= o.l;
              });
            return (
              (i = ~i ? i : this.os.length), this.os.splice(i, 0, no), no.id
            );
          }),
          (SheetPhysics.prototype.getParametrMap = function (name) {
            return {
              mass: "m",
              velocity: "v",
              flexibility: "flbt",
              cornerHeight: "ch",
              simulateClb: "simulateClb",
              removeClb: "removeClb",
              forceClb: "f",
              cornerForceClb: "cf",
            }[name];
          }),
          (SheetPhysics.prototype.setParametr = function (id, name, value) {
            var o = this.os.find(function (o) {
              return o.id === id;
            });
            "angle" === name
              ? (o.l = value * this.p.r)
              : (o[this.getParametrMap(name)] = value);
          }),
          (SheetPhysics.prototype.getParametr = function (id, name) {
            var o = this.os.find(function (o) {
              return o.id === id;
            });
            return "angle" === name
              ? o.l / this.p.r
              : o[this.getParametrMap(name)];
          }),
          (SheetPhysics.prototype.simulate = function (T) {
            for (
              var t = 0, dt = this.p.startDt, attempt = 0, it = 0;
              t < T && it < this.p.maxIterations;

            ) {
              dt > T - t && (dt = T - t);
              var nos = this.integrate(this.os, dt),
                ci = this.findCollisions(nos);
              if (ci.num > 1 && attempt < this.p.attempts) (dt /= 2), ++attempt;
              else {
                if (1 === ci.num) {
                  var scos = this.solveCollision(
                    nos[ci.last - 1],
                    nos[ci.last]
                  );
                  (nos[ci.last - 1] = scos[0]), (nos[ci.last] = scos[1]);
                } else if (ci.num > 1) {
                  for (
                    var gs = [],
                      last = -2,
                      _iterator = ci.all,
                      _isArray = Array.isArray(_iterator),
                      _i = 0,
                      _iterator = _isArray
                        ? _iterator
                        : _iterator[Symbol.iterator]();
                    ;

                  ) {
                    var _ref;
                    if (_isArray) {
                      if (_i >= _iterator.length) break;
                      _ref = _iterator[_i++];
                    } else {
                      if (((_i = _iterator.next()), _i.done)) break;
                      _ref = _i.value;
                    }
                    var i = _ref;
                    i - last > 1 && gs.push([]),
                      gs[gs.length - 1].push(i),
                      (last = i);
                  }
                  for (
                    var _iterator2 = gs,
                      _isArray2 = Array.isArray(_iterator2),
                      _i2 = 0,
                      _iterator2 = _isArray2
                        ? _iterator2
                        : _iterator2[Symbol.iterator]();
                    ;

                  ) {
                    var _ref2;
                    if (_isArray2) {
                      if (_i2 >= _iterator2.length) break;
                      _ref2 = _iterator2[_i2++];
                    } else {
                      if (((_i2 = _iterator2.next()), _i2.done)) break;
                      _ref2 = _i2.value;
                    }
                    var g = _ref2,
                      sg = void 0,
                      i0 = void 0;
                    nos[g[0]].l > (Math.PI / 2) * this.p.r
                      ? ((sg = -1), (i0 = g[g.length - 1]))
                      : ((sg = 1), (i0 = g[0]));
                    for (
                      var _i3 = i0;
                      _i3 < nos.length && _i3 > -1;
                      _i3 += sg
                    ) {
                      var o = nos[_i3 + sg];
                      if (!(o && sg * (o.l - nos[_i3].l) <= this.p.margin))
                        break;
                      (o.l = nos[_i3].l + 2 * sg * this.p.margin),
                        (o.l > this.p.l || o.l < 0) &&
                          ((o.l = o.l > this.p.l ? this.p.l : 0),
                          (o.ch = 0),
                          (o.v = 0),
                          console.error("Bad collision"));
                    }
                  }
                }
                (this.os = nos),
                  this.findAndSolveCornerCollisions(),
                  (t += dt),
                  (dt = this.p.startDt),
                  (attempt = 0);
              }
              ++it;
            }
            this.removeStatics();
          }),
          (SheetPhysics.prototype.removeStatics = function () {
            for (
              var nos = [],
                notify = [[], []],
                _iterator3 = this.os,
                _isArray3 = Array.isArray(_iterator3),
                _i4 = 0,
                _iterator3 = _isArray3
                  ? _iterator3
                  : _iterator3[Symbol.iterator]();
              ;

            ) {
              var _ref3;
              if (_isArray3) {
                if (_i4 >= _iterator3.length) break;
                _ref3 = _iterator3[_i4++];
              } else {
                if (((_i4 = _iterator3.next()), _i4.done)) break;
                _ref3 = _i4.value;
              }
              var o = _ref3;
              o.simulateClb && o.simulateClb(o.l / this.p.r, o.ch),
                (o.l !== this.p.l && 0 !== o.l) || 0 !== o.v
                  ? nos.push(o)
                  : void 0 !== o.removeClb &&
                    notify[(o.l !== this.p.l) + 0].push(o);
            }
            this.os = nos;
            for (
              var _iterator4 = notify[0].reverse(),
                _isArray4 = Array.isArray(_iterator4),
                _i5 = 0,
                _iterator4 = _isArray4
                  ? _iterator4
                  : _iterator4[Symbol.iterator]();
              ;

            ) {
              var _ref4;
              if (_isArray4) {
                if (_i5 >= _iterator4.length) break;
                _ref4 = _iterator4[_i5++];
              } else {
                if (((_i5 = _iterator4.next()), _i5.done)) break;
                _ref4 = _i5.value;
              }
              var _o = _ref4;
              _o.removeClb(Math.PI, _o.ch);
            }
            for (
              var _iterator5 = notify[1],
                _isArray5 = Array.isArray(_iterator5),
                _i6 = 0,
                _iterator5 = _isArray5
                  ? _iterator5
                  : _iterator5[Symbol.iterator]();
              ;

            ) {
              var _ref5;
              if (_isArray5) {
                if (_i6 >= _iterator5.length) break;
                _ref5 = _iterator5[_i6++];
              } else {
                if (((_i6 = _iterator5.next()), _i6.done)) break;
                _ref5 = _i6.value;
              }
              var _o2 = _ref5;
              _o2.removeClb(0, _o2.ch);
            }
          }),
          (SheetPhysics.prototype.findAndSolveCornerCollisions = function () {
            if (this.os.length)
              for (
                var os = [
                    _extends({}, this.os[0], { l: 0, m: this.p.infM, ch: 0 }),
                  ].concat(this.os, [
                    _extends({}, this.os[0], {
                      l: 1.05 * this.p.l,
                      m: this.p.infM,
                      ch: 0,
                    }),
                  ]),
                  i = 1;
                i < os.length;
                ++i
              ) {
                var a = os[i - 1],
                  b = os[i],
                  al = a.l + this.p.cornerDeviation * a.ch * this.p.r,
                  bl = b.l + this.p.cornerDeviation * b.ch * this.p.r;
                if (1.05 * al > bl && a.ch > b.ch) {
                  var dCh = a.ch - b.ch,
                    dv = a.m / a.flbt + b.m / b.flbt,
                    ka = a.m / a.flbt / dv,
                    kb = b.m / b.flbt / dv;
                  (a.ch = a.ch - kb * dCh), (b.ch = b.ch + ka * dCh);
                }
              }
          }),
          (SheetPhysics.prototype.solveCollision = function (a, b) {
            var mm = b.m + a.m,
              av = (-a.v * b.m + a.m * a.v + 2 * b.m * b.v) / mm,
              bv = (b.m * b.v - b.v * a.m + 2 * a.m * a.v) / mm;
            return [_extends({}, a, { v: av }), _extends({}, b, { v: bv })];
          }),
          (SheetPhysics.prototype.findCollisions = function (os) {
            for (
              var ci = { num: 0, last: 0, all: [] }, i = 1;
              i < os.length && ci.num < 2;
              ++i
            )
              (os[i - 1].l > os[i].l || this.isCollision(os[i - 1], os[i])) &&
                (os[i - 1].l > os[i].l && ++ci.num,
                ++ci.num,
                (ci.last = i),
                -1 === ci.all.indexOf(i - 1) && ci.all.push(i - 1),
                -1 === ci.all.indexOf(i) && ci.all.push(i));
            return ci;
          }),
          (SheetPhysics.prototype.isCollision = function (a, b) {
            return Math.abs(a.l - b.l) < this.p.margin && a.v > b.v;
          }),
          (SheetPhysics.prototype.integrate = function (os, dt) {
            for (
              var nos = [],
                _iterator6 = os,
                _isArray6 = Array.isArray(_iterator6),
                _i7 = 0,
                _iterator6 = _isArray6
                  ? _iterator6
                  : _iterator6[Symbol.iterator]();
              ;

            ) {
              var _ref6;
              if (_isArray6) {
                if (_i7 >= _iterator6.length) break;
                _ref6 = _iterator6[_i7++];
              } else {
                if (((_i7 = _iterator6.next()), _i7.done)) break;
                _ref6 = _i7.value;
              }
              var o = _ref6,
                vl = _MathUtils2.default.rk4(
                  this.dy.bind({
                    g: this.p.gravity,
                    r: this.p.r,
                    m: o.m,
                    f: o.f,
                    cf: o.cf,
                    ch: o.ch,
                    flbt: o.flbt,
                  }),
                  0,
                  dt,
                  [o.v, o.l, o.ch]
                ),
                no = _extends({}, o, { v: vl[0], l: vl[1], ch: vl[2] });
              (no.l <= 0 || no.l >= this.p.l) &&
                ((no.l = no.l <= 0 ? 0 : this.p.l), (no.v = 0), (no.ch = 0)),
                nos.push(no);
            }
            return nos;
          }),
          (SheetPhysics.prototype.dy = function (t, y) {
            var v = y[0],
              l = y[1],
              ch = y[2],
              alf = l / this.r,
              f = this.f(this, alf, v, ch),
              cf = this.cf(this, alf, v, ch),
              cosAlf = Math.cos(alf),
              brf =
                6.65 *
                Math.abs((Math.sign(cosAlf) - Math.sign(v)) * v) *
                Math.pow(cosAlf, 5);
            return [
              -this.g * cosAlf + brf + f / this.m,
              v + 0.01 * (Math.random() - 0.5),
              this.flbt *
                ((2 / (1 + Math.exp(-0.2 * cf)) - 1) *
                  (1 - 2 / (1 + Math.exp(-5 * (Math.abs(ch) - 2)))) -
                  ch),
            ];
          }),
          SheetPhysics
        );
      })();
    exports.default = SheetPhysics;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var SoundsEnviroment = (function () {
      function SoundsEnviroment() {
        var template =
          arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
        _classCallCheck(this, SoundsEnviroment),
          (template = "function" == typeof template ? template() : template),
          (this.sounds = template.sounds || {}),
          (this.audio = {}),
          this.sounds.startFlip &&
            ((this.audio.startFlip = new Audio(this.sounds.startFlip)),
            (this.audio.startFlip.volume = 0.5)),
          this.sounds.endFlip &&
            ((this.audio.endFlip = new Audio(this.sounds.endFlip)),
            (this.audio.endFlip.volume = 0.5));
      }
      return (
        (SoundsEnviroment.prototype.setEnabled = function (enabled) {
          this.enabled = enabled;
        }),
        (SoundsEnviroment.prototype.togle = function () {
          this.enabled = !this.enabled;
        }),
        (SoundsEnviroment.prototype.dispose = function () {
          delete this.audio.startFlip, delete this.audio.endFlip;
        }),
        (SoundsEnviroment.prototype.play = function (player) {
          player.play().catch(function () {});
        }),
        (SoundsEnviroment.prototype.startFlip = function () {
          this.enabled &&
            this.audio.startFlip &&
            this.play(this.audio.startFlip);
        }),
        (SoundsEnviroment.prototype.endFlip = function () {
          this.enabled &&
            this.audio.startFlip &&
            (this.audio.startFlip.pause(),
            (this.audio.startFlip.currentTime = 0)),
            this.enabled && this.audio.endFlip && this.play(this.audio.endFlip);
        }),
        (SoundsEnviroment.prototype.subscribeFlips = function (emitter) {
          emitter.addEventListener("startFlip", this.startFlip.bind(this)),
            emitter.addEventListener("endFlip", this.endFlip.bind(this));
        }),
        SoundsEnviroment
      );
    })();
    exports.default = SoundsEnviroment;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _WidgetController2 = __webpack_require__(22),
      _WidgetController3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_WidgetController2),
      TocController = (function (_WidgetController) {
        function TocController(view, bookCtrl) {
          _classCallCheck(this, TocController);
          var _this = _possibleConstructorReturn(
            this,
            _WidgetController.call(this, view, "widFloatWnd")
          );
          return (_this.bookCtrl = bookCtrl), (_this.tab = "none"), _this;
        }
        return (
          _inherits(TocController, _WidgetController),
          (TocController.prototype.setThumbnails = function (thumbnails) {
            (this.thumbnails = thumbnails),
              (thumbnails.onNavigate = this.navigateThumbnails.bind(this)),
              "none" === this.tab && (this.tab = "thumbnails"),
              this.fireChange();
          }),
          (TocController.prototype.setSearch = function (search) {
            (this.search = search),
              (search.onNavigate = this.navigateSearch.bind(this)),
              this.fireChange();
          }),
          (TocController.prototype.setBookmarks = function (bookmarks, pdf) {
            bookmarks.getSize() &&
              ((this.bookmarks = bookmarks),
              (this.pdf = pdf),
              (bookmarks.onNavigate = this.navigateBookmarks.bind(this)),
              (this.isBookmarks = !0),
              this.fireChange());
          }),
          (TocController.prototype.cmdBookmarks = function () {
            this.setActiveTab("bookmarks");
          }),
          (TocController.prototype.cmdThumbnails = function () {
            this.setActiveTab("thumbnails");
          }),
          (TocController.prototype.cmdSearch = function () {
            this.setActiveTab("search");
          }),
          (TocController.prototype.setActiveTab = function (tab) {
            this[tab] && ((this.tab = tab), this.fireChange());
          }),
          (TocController.prototype.cmdCloseToc = function () {
            this.hide();
          }),
          (TocController.prototype.navigateThumbnails = function (number) {
            this.goToPage(number);
          }),
          (TocController.prototype.navigateSearch = function (number) {
            this.goToPage(number);
          }),
          (TocController.prototype.openUrl = function (url) {
            window.open(url, "_blank");
          }),
          (TocController.prototype.goToPage = function (number) {
            this.bookCtrl.goToPage(number);
          }),
          (TocController.prototype.dstDataHandler = function (data) {
            data = (data + "").trim();
            var number = void 0;
            (number = parseInt(data)) == data
              ? this.goToPage(number)
              : this.openUrl(data);
          }),
          (TocController.prototype.navigateBookmarks = function (item) {
            var _this2 = this;
            item.url
              ? this.openUrl(item.url)
              : item.dest
              ? this.pdf.getDestination(item.dest).then(function (number) {
                  return _this2.goToPage(number);
                })
              : void 0 !== item.dstData && this.dstDataHandler(item.dstData);
          }),
          (TocController.prototype.updateView = function () {
            var _this3 = this;
            this.view &&
              (this.view.setState("widTocMenu", {
                enable: !0,
                visible: !0,
                active: !1,
              }),
              this.view.setState("widThumbnails", {
                enable: !0,
                visible: "thumbnails" === this.tab,
                active: !1,
              }),
              this.view.setState("widSearch", {
                enable: !0,
                visible: "search" === this.tab,
                active: !1,
              }),
              this.view.setState("widBookmarks", {
                enable: !0,
                visible: "bookmarks" === this.tab,
                active: !1,
              }),
              this.view.setState("cmdBookmarks", {
                enable: !0,
                visible: !!this.bookmarks,
                active: "bookmarks" === this.tab,
              }),
              this.view.setState("cmdCloseToc", {
                enable: !0,
                visible: !0,
                active: !1,
              }),
              this.view.setState("cmdThumbnails", {
                enable: !0,
                visible: !(
                  !this.thumbnails ||
                  (!this.search && !this.bookmarks)
                ),
                active: "thumbnails" === this.tab,
              }),
              this.view.setState("cmdSearch", {
                enable: !0,
                visible: !!this.search,
                active: "search" === this.tab,
              }),
              Promise.resolve().then(function () {
                return _this3.thumbnails.setEnable(
                  _this3.visible && "thumbnails" === _this3.tab
                );
              }),
              _WidgetController.prototype.updateView.call(this));
          }),
          TocController
        );
      })(_WidgetController3.default);
    exports.default = TocController;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    exports.__esModule = !0;
    var _libs = __webpack_require__(1),
      _ThreeUtils = __webpack_require__(21),
      _ThreeUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_ThreeUtils),
      faces = [],
      frontGeometry = new _libs.THREE.PlaneGeometry(1, 1, 10, 1);
    frontGeometry.translate(0.5, 0.5, 1);
    var backGeometry = new _libs.THREE.PlaneGeometry(1, 1, 10, 1);
    backGeometry.rotateY(Math.PI), backGeometry.translate(0.5, 0.5, 0);
    var leftGeometry = new _libs.THREE.PlaneGeometry(1, 1, 14, 1);
    leftGeometry.rotateY(-Math.PI / 2), leftGeometry.translate(0, 0.5, 0.5);
    var rightGeometry = new _libs.THREE.PlaneGeometry(1, 1, 14, 1);
    rightGeometry.rotateY(Math.PI / 2), rightGeometry.translate(1, 0.5, 0.5);
    var topGeometry = new _libs.THREE.PlaneGeometry(1, 1, 10, 14);
    topGeometry.rotateX(-Math.PI / 2), topGeometry.translate(0.5, 1, 0.5);
    var bottomGeometry = topGeometry.clone();
    bottomGeometry.translate(0, -1, 0);
    for (
      var _iterator = bottomGeometry.faces,
        _isArray = Array.isArray(_iterator),
        _i = 0,
        _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
      ;

    ) {
      var _ref;
      if (_isArray) {
        if (_i >= _iterator.length) break;
        _ref = _iterator[_i++];
      } else {
        if (((_i = _iterator.next()), _i.done)) break;
        _ref = _i.value;
      }
      var f = _ref,
        _ref3 = [f.b, f.a];
      (f.a = _ref3[0]), (f.b = _ref3[1]);
    }
    var geometry = new _libs.THREE.Geometry();
    geometry.vertices = [].concat(
      bottomGeometry.vertices,
      topGeometry.vertices
    );
    var addFaces = function (fs, map) {
        for (
          var _iterator2 = fs,
            _isArray2 = Array.isArray(_iterator2),
            _i2 = 0,
            _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();
          ;

        ) {
          var _ref2;
          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            if (((_i2 = _iterator2.next()), _i2.done)) break;
            _ref2 = _i2.value;
          }
          var f = _ref2;
          geometry.faces.push(
            new _libs.THREE.Face3(map(f.a), map(f.b), map(f.c))
          );
        }
        faces.push(geometry.faces.length);
      },
      mapVertices = function (src, dst) {
        for (var map = [], i = 0; i < src.length; ++i)
          for (var j = 0; j < dst.length; ++j)
            if (
              (function (a, b) {
                return (
                  Math.abs(a.x - b.x) +
                    Math.abs(a.y - b.y) +
                    Math.abs(a.z - b.z) <
                  1e-4
                );
              })(src[i], dst[j])
            ) {
              map[i] = j;
              break;
            }
        return map;
      },
      frontMap = mapVertices(frontGeometry.vertices, geometry.vertices),
      backMap = mapVertices(backGeometry.vertices, geometry.vertices),
      leftMap = mapVertices(leftGeometry.vertices, geometry.vertices),
      rightMap = mapVertices(rightGeometry.vertices, geometry.vertices);
    addFaces(topGeometry.faces, function (i) {
      return i + bottomGeometry.vertices.length;
    }),
      addFaces(bottomGeometry.faces, function (i) {
        return i;
      }),
      addFaces(frontGeometry.faces, function (i) {
        return frontMap[i];
      }),
      addFaces(backGeometry.faces, function (i) {
        return backMap[i];
      }),
      addFaces(leftGeometry.faces, function (i) {
        return leftMap[i];
      }),
      addFaces(rightGeometry.faces, function (i) {
        return rightMap[i];
      }),
      faces.pop(),
      _ThreeUtils2.default.computeFaceVertexUvs(geometry, faces),
      geometry.computeVertexNormals(),
      geometry.computeBoundingSphere(),
      (geometry.verticesNeedUpdate = !0),
      (exports.default = {
        resX: 11,
        resY: 2,
        resZ: 15,
        faces: faces,
        geometry: geometry,
      });
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function props() {
      return {
        eps: 1e-4,
        scale: { default: 0.9, min: 0.9, max: 2, levels: 5 },
        pan: { speed: 50 },
        loadingAnimation: { skin: !0, book: !1 },
        autoResolution: { enabled: !0, coefficient: 1.5, min: 800, max: 1920 },
        narrowView: { width: 500 },
        actions: {
          cmdZoomIn: { enabled: !0, enabledInNarrow: !0 },
          cmdZoomOut: { enabled: !0, enabledInNarrow: !0 },
          cmdDefaultZoom: {
            enabled: !1,
            enabledInNarrow: !1,
            type: "dblclick",
            code: 0,
          },
          cmdToc: {
            enabled: !0,
            enabledInNarrow: !0,
            active: !1,
            defaultTab: "bookmarks",
          },
          cmdAutoPlay: { enabled: !1, enabledInNarrow: !1, active: !1 },
          cmdBackward: { enabled: !0, enabledInNarrow: !1, code: 37 },
          cmdBigBackward: { enabled: !0, enabledInNarrow: !0 },
          cmdForward: { enabled: !0, enabledInNarrow: !1, code: 39 },
          cmdBigForward: { enabled: !0, enabledInNarrow: !0 },
          cmdSave: { enabled: !0, enabledInNarrow: !0 },
          cmdPrint: { enabled: !0, enabledInNarrow: !0 },
          cmdFullScreen: { enabled: !0, enabledInNarrow: !0 },
          widSettings: { enabled: !0, enabledInNarrow: !0 },
          widToolbar: { enabled: !0, enabledInNarrow: !0 },
          cmdSmartPan: { enabled: !1, enabledInNarrow: !1, active: !0 },
          cmdSinglePage: {
            enabled: !0,
            enabledInNarrow: !0,
            active: !1,
            activeForMobile: !0,
          },
          cmdSounds: { enabled: !0, enabledInNarrow: !0, active: !0 },
          cmdStats: { enabled: !1, enabledInNarrow: !1, active: !1 },
          cmdGotoFirstPage: { enabled: !0, enabledInNarrow: !0 },
          cmdGotoLastPage: { enabled: !0, enabledInNarrow: !0 },
          cmdShare: { enabled: !0, enabledInNarrow: !0 },
          cmdPanLeft: { enabled: !1 },
          cmdPanRight: { enabled: !1 },
          cmdPanUp: { enabled: !1 },
          cmdPanDown: { enabled: !1 },
          mouseCmdRotate: {
            enabled: !0,
            type: "mousedrag",
            code: mouseButtons.Right,
          },
          mouseCmdDragZoom: {
            enabled: !0,
            type: "mousedrag",
            code: mouseButtons.Middle,
          },
          mouseCmdPan: {
            enabled: !0,
            type: "mousedrag",
            code: mouseButtons.Left,
          },
          mouseCmdWheelZoom: { enabled: !0, type: "mousewheel", code: 0 },
          touchCmdRotate: { enabled: !0, type: "touchdrag", code: 3 },
          touchCmdZoom: { enabled: !0, type: "touchdrag", code: 2 },
          touchCmdPan: { enabled: !0, type: "touchdrag", code: 1 },
          touchCmdSwipe: { enabled: !0, type: "touchdrag", code: 1 },
        },
      };
    }
    (exports.__esModule = !0), (exports.props = props);
    var mouseButtons = { Left: 0, Middle: 1, Right: 2 };
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _ImageBase2 = (__webpack_require__(0), __webpack_require__(6)),
      _ImageBase3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_ImageBase2),
      BlankImage = (function (_ImageBase) {
        function BlankImage(context, width, height, color) {
          _classCallCheck(this, BlankImage);
          var _this = _possibleConstructorReturn(
            this,
            _ImageBase.call(this, context, width, height, color)
          );
          return (
            Promise.resolve().then(function () {
              (_this.startRender = function () {
                _this.renderBlankPage(), _this.finishRender();
              }),
                _this.finishLoad();
            }),
            _this
          );
        }
        return _inherits(BlankImage, _ImageBase), BlankImage;
      })(_ImageBase3.default);
    exports.default = BlankImage;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      Bookmarks = (function () {
        function Bookmarks(container, items) {
          var _this = this,
            getTitle =
              arguments.length > 2 && void 0 !== arguments[2]
                ? arguments[2]
                : function (i) {
                    return i.title;
                  },
            getItems =
              arguments.length > 3 && void 0 !== arguments[3]
                ? arguments[3]
                : function (i) {
                    return i.items;
                  };
          _classCallCheck(this, Bookmarks),
            (this.container = container),
            (this.map = []),
            (this.getTitle = getTitle),
            (this.getItems = getItems),
            (this.nodes = this.mapNodes(items, this.map)),
            (this.binds = {
              togle: function (e) {
                e.preventDefault();
                for (
                  var li = (0, _libs.$)(e.target);
                  li[0] && li[0] !== container[0] && !li.hasClass("item");

                )
                  li = (0, _libs.$)(li[0].parentNode);
                if (li.hasClass("item")) {
                  for (
                    var cmd = (0, _libs.$)(e.target);
                    cmd[0] && cmd[0] !== li[0] && !cmd.hasClass("cmd");

                  )
                    cmd = (0, _libs.$)(cmd[0].parentNode);
                  if (cmd.hasClass("cmd")) {
                    var node = _this.map[li.attr("data-id")];
                    cmd.hasClass("togle")
                      ? ((node.minimized = !node.minimized),
                        node.minimized
                          ? (li.find("ul").remove(),
                            li.find(".togle").addClass("minimized"))
                          : (li.find(".togle").removeClass("minimized"),
                            li.append(
                              (_this
                                .renderNode(node)
                                .match(/<ul(.|\n)*<\/ul>/g) || [""])[0]
                            )))
                      : _this.onNavigate && _this.onNavigate(node.item);
                  }
                }
              },
            }),
            container.on("click", this.binds.togle),
            this.update();
        }
        return (
          (Bookmarks.prototype.getSize = function () {
            return this.map.length;
          }),
          (Bookmarks.prototype.dispose = function () {
            this.container.off("click", this.binds.togle),
              this.container.html("");
          }),
          (Bookmarks.prototype.update = function () {
            this.container.html(this.renderNodes(this.nodes));
          }),
          (Bookmarks.prototype.forEach = function (f) {
            for (
              var nodes =
                  arguments.length > 1 && void 0 !== arguments[1]
                    ? arguments[1]
                    : this.nodes,
                _iterator = nodes || [],
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var node = _ref;
              f(node), this.forEach(f, node.children);
            }
          }),
          (Bookmarks.prototype.expand = function () {
            this.forEach(function (n) {
              return (n.minimized = !1);
            }),
              this.update();
          }),
          (Bookmarks.prototype.minimize = function () {
            this.forEach(function (n) {
              return (n.minimized = !0);
            }),
              this.update();
          }),
          (Bookmarks.prototype.renderNode = function (node) {
            return [
              '<div class="area">',
              node.children
                ? '<a class="cmd togle' +
                  (node.minimized ? " minimized" : "") +
                  '"><i class="fa fa-angle-right"></i></a> '
                : '<i class="white-space"></i> ',
              '<a class="cmd" title="',
              node.title,
              '">',
              node.title,
              "</a></div>",
              node.minimized ? "" : this.renderNodes(node.children),
            ].join("");
          }),
          (Bookmarks.prototype.renderNodes = function (nodes) {
            var res = ['<div class="bookmarks">'];
            if (nodes && nodes.length) {
              res.push('<ul class="level-', nodes[0].level, '">');
              for (
                var _iterator2 = nodes,
                  _isArray2 = Array.isArray(_iterator2),
                  _i2 = 0,
                  _iterator2 = _isArray2
                    ? _iterator2
                    : _iterator2[Symbol.iterator]();
                ;

              ) {
                var _ref2;
                if (_isArray2) {
                  if (_i2 >= _iterator2.length) break;
                  _ref2 = _iterator2[_i2++];
                } else {
                  if (((_i2 = _iterator2.next()), _i2.done)) break;
                  _ref2 = _i2.value;
                }
                var node = _ref2;
                res.push(
                  [
                    '<li class="item" data-id="',
                    node.id,
                    '">',
                    this.renderNode(node),
                    "</li>",
                  ].join("")
                );
              }
              res.push("</ul>");
            }
            return res.push("</div>"), res.join("");
          }),
          (Bookmarks.prototype.mapNodes = function (items) {
            var map =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : [],
              level =
                arguments.length > 2 && void 0 !== arguments[2]
                  ? arguments[2]
                  : 0,
              nodes = null;
            if (items && items.length) {
              nodes = [];
              for (
                var _iterator3 = items,
                  _isArray3 = Array.isArray(_iterator3),
                  _i3 = 0,
                  _iterator3 = _isArray3
                    ? _iterator3
                    : _iterator3[Symbol.iterator]();
                ;

              ) {
                var _ref3;
                if (_isArray3) {
                  if (_i3 >= _iterator3.length) break;
                  _ref3 = _iterator3[_i3++];
                } else {
                  if (((_i3 = _iterator3.next()), _i3.done)) break;
                  _ref3 = _i3.value;
                }
                var item = _ref3,
                  id = map.length;
                map.push(void 0);
                var node = {
                  id: id,
                  title: this.getTitle(item),
                  level: level,
                  item: item,
                  minimized: !0,
                  children: this.mapNodes(this.getItems(item), map, level + 1),
                };
                nodes.push(node), (map[id] = node);
              }
            }
            return nodes;
          }),
          Bookmarks
        );
      })();
    exports.default = Bookmarks;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      Detector = (function () {
        function Detector() {
          _classCallCheck(this, Detector);
        }
        return (
          (Detector.getWebGLErrorMessage = function () {
            var element = document.createElement("div");
            return (
              (element.id = "webgl-error-message"),
              (element.style.fontFamily = "monospace"),
              (element.style.fontSize = "13px"),
              (element.style.fontWeight = "normal"),
              (element.style.textAlign = "center"),
              (element.style.background = "#fff"),
              (element.style.color = "#000"),
              (element.style.padding = "1.5em"),
              (element.style.width = "400px"),
              (element.style.margin = "5em auto 0"),
              Detector.webgl ||
                (element.innerHTML = window.WebGLRenderingContext
                  ? [
                      'Your graphics card does not seem to support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation" style="color:#000">WebGL</a>.<br />',
                      'Find out how to get it <a href="http://get.webgl.org/" style="color:#000">here</a>.',
                    ].join("\n")
                  : [
                      'Your browser does not seem to support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation" style="color:#000">WebGL</a>.<br/>',
                      'Find out how to get it <a href="http://get.webgl.org/" style="color:#000">here</a>.',
                    ].join("\n")),
              element
            );
          }),
          (Detector.addGetWebGLMessage = function (parameters) {
            var parent = void 0,
              element = void 0;
            (parameters = parameters || {}),
              (parent = parameters.parent || (0, _libs.$)(document.body)),
              parameters.id,
              (element = Detector.getWebGLErrorMessage()),
              parent.append(element);
          }),
          Detector
        );
      })();
    (Detector.canvas = !!window.CanvasRenderingContext2D),
      (Detector.webgl = (function () {
        try {
          var canvas = document.createElement("canvas");
          return !(
            !window.WebGLRenderingContext ||
            (!canvas.getContext("webgl") &&
              !canvas.getContext("experimental-webgl"))
          );
        } catch (e) {
          return !1;
        }
      })()),
      (Detector.workers = !!window.Worker),
      (Detector.fileapi =
        window.File && window.FileReader && window.FileList && window.Blob),
      (exports.default = Detector);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      DocMouseSimulator = (function () {
        function DocMouseSimulator(jFrame, element) {
          var bElement =
            arguments.length > 2 && void 0 !== arguments[2]
              ? arguments[2]
              : document.body;
          _classCallCheck(this, DocMouseSimulator),
            (this.jFrame = jFrame),
            (this.wnd = jFrame[0].contentWindow),
            (this.doc = jFrame[0].contentDocument),
            (this.element = element || doc.body),
            (this.bElement = bElement),
            (this.resendProperties = this.getDefaultResendProperties()),
            (this.undefinedProperties = this.getDefaultUndefinedProperties()),
            (this.cursors = []),
            (this.onDocChangeClbs = []);
          for (
            var terms = [
                { find: ":hover", replace: "." + DocMouseSimulator.HOVER },
                { find: ":active", replace: "." + DocMouseSimulator.ACTIVE },
              ],
              style = ['<style type="text/css">'],
              i = 0;
            i < this.doc.styleSheets.length;
            ++i
          )
            for (
              var ss = this.doc.styleSheets[i], j = 0;
              j < ss.cssRules.length;
              ++j
            ) {
              for (
                var r = ss.cssRules[j],
                  cssText = void 0,
                  _iterator = terms,
                  _isArray = Array.isArray(_iterator),
                  _i = 0,
                  _iterator = _isArray
                    ? _iterator
                    : _iterator[Symbol.iterator]();
                ;

              ) {
                var _ref;
                if (_isArray) {
                  if (_i >= _iterator.length) break;
                  _ref = _iterator[_i++];
                } else {
                  if (((_i = _iterator.next()), _i.done)) break;
                  _ref = _i.value;
                }
                var term = _ref;
                ~r.selectorText.indexOf(term.find) &&
                  (cssText = (cssText || r.cssText).replace(
                    new RegExp(term.find, "g"),
                    term.replace
                  ));
              }
              cssText && style.push(cssText);
            }
          style.push("</style>"),
            (0, _libs.$)(this.doc.head).append((0, _libs.$)(style.join("")));
        }
        return (
          (DocMouseSimulator.prototype.convertCoords = function (x, y) {
            var jElement = (0, _libs.$)(this.element),
              offset = jElement.offset();
            return {
              x: offset.left + jElement.width() * x,
              y: offset.top + jElement.height() * (1 - y),
            };
          }),
          (DocMouseSimulator.prototype.triggerEvent = function (
            element,
            e,
            p,
            type,
            advancedProps
          ) {
            for (
              var props = {},
                _iterator2 = this.resendProperties,
                _isArray2 = Array.isArray(_iterator2),
                _i2 = 0,
                _iterator2 = _isArray2
                  ? _iterator2
                  : _iterator2[Symbol.iterator]();
              ;

            ) {
              var _ref2;
              if (_isArray2) {
                if (_i2 >= _iterator2.length) break;
                _ref2 = _iterator2[_i2++];
              } else {
                if (((_i2 = _iterator2.next()), _i2.done)) break;
                _ref2 = _i2.value;
              }
              var _n = _ref2;
              props[_n] = e[_n];
            }
            for (
              var _iterator3 = this.undefinedProperties,
                _isArray3 = Array.isArray(_iterator3),
                _i3 = 0,
                _iterator3 = _isArray3
                  ? _iterator3
                  : _iterator3[Symbol.iterator]();
              ;

            ) {
              var _ref3;
              if (_isArray3) {
                if (_i3 >= _iterator3.length) break;
                _ref3 = _iterator3[_i3++];
              } else {
                if (((_i3 = _iterator3.next()), _i3.done)) break;
                _ref3 = _i3.value;
              }
              props[_ref3] = void 0;
            }
            for (var n in advancedProps)
              advancedProps.hasOwnProperty(n) && (props[n] = advancedProps[n]);
            (props.view = this.wnd), (props.pageX = p.x), (props.pageY = p.y);
            var jE = _libs.$.Event(type, props);
            (jE.timeStamp = e.timeStamp), (0, _libs.$)(element).trigger(jE);
          }),
          (DocMouseSimulator.prototype.addClass = function (element, name) {
            (0, _libs.$)(element).addClass(name);
            var style = this.wnd.getComputedStyle(element);
            this.cursors.push((0, _libs.$)(this.bElement).css("cursor")),
              (0, _libs.$)(this.bElement).css(
                "cursor",
                style.getPropertyValue("cursor")
              );
          }),
          (DocMouseSimulator.prototype.removeClass = function (element, name) {
            (0, _libs.$)(element).removeClass(name),
              (0, _libs.$)(this.bElement).css("cursor", this.cursors.pop());
          }),
          (DocMouseSimulator.prototype.enterElement = function (element) {
            this.addClass(element, DocMouseSimulator.HOVER);
          }),
          (DocMouseSimulator.prototype.leaveElement = function (element) {
            this.removeClass(element, DocMouseSimulator.HOVER);
          }),
          (DocMouseSimulator.prototype.activateElement = function (element) {
            this.addClass(element, DocMouseSimulator.ACTIVE);
          }),
          (DocMouseSimulator.prototype.deactivateElement = function (element) {
            this.removeClass(element, DocMouseSimulator.ACTIVE);
          }),
          (DocMouseSimulator.prototype.addDocChangeClb = function (clb) {
            this.onDocChangeClbs.push(clb);
          }),
          (DocMouseSimulator.prototype.notify = function () {
            for (
              var _iterator4 = this.onDocChangeClbs,
                _isArray4 = Array.isArray(_iterator4),
                _i4 = 0,
                _iterator4 = _isArray4
                  ? _iterator4
                  : _iterator4[Symbol.iterator]();
              ;

            ) {
              var _ref4;
              if (_isArray4) {
                if (_i4 >= _iterator4.length) break;
                _ref4 = _iterator4[_i4++];
              } else {
                if (((_i4 = _iterator4.next()), _i4.done)) break;
                _ref4 = _i4.value;
              }
              _ref4(this.wnd, this.doc);
            }
          }),
          (DocMouseSimulator.prototype.elementFromPoint = function (p) {
            for (var node = this.doc.body, next = !0; next; ) {
              next = !1;
              for (var i = 0; i < node.childNodes.length; ++i) {
                var child = node.childNodes[i];
                if (child instanceof this.wnd.Element) {
                  var jC = (0, _libs.$)(child),
                    offset = jC.offset(),
                    height = jC.height(),
                    width = jC.width();
                  if (
                    p.x > offset.left &&
                    p.x < offset.left + width &&
                    p.y > offset.top &&
                    p.y < offset.top + height
                  ) {
                    (node = child), (next = !0);
                    break;
                  }
                }
              }
            }
            return node;
          }),
          (DocMouseSimulator.prototype.getElement = function (p) {
            var off0 = this.jFrame.offset();
            this.jFrame.offset({
              left: 0.5 * window.innerWidth - p.x,
              top: 0.5 * window.innerHeight - p.y,
            });
            var element = this.doc.elementFromPoint(p.x, p.y);
            return (
              element || (element = this.doc.elementFromPoint(p.x, p.y)),
              this.jFrame.offset(off0),
              element || this.elementFromPoint(p)
            );
          }),
          (DocMouseSimulator.prototype.simulate = function (e, doc, x, y) {
            var p = this.convertCoords(x, y),
              element = doc === this.doc ? this.getElement(p) : void 0,
              trigger = void 0 !== element,
              notify = !1;
            switch (e.type) {
              case "mousedown":
                this.capElement &&
                  (this.deactivateElement(this.capElement), (notify = !0)),
                  (this.capElement = element),
                  this.capElement &&
                    (this.activateElement(this.capElement), (notify = !0));
                break;
              case "mouseup":
                this.capElement &&
                  (this.deactivateElement(this.capElement), (notify = !0)),
                  (this.timeStamp = e.timeStamp);
                break;
              case "click":
                (trigger = element && this.capElement === element),
                  (this.capElement = void 0);
                break;
              case "mouseenter":
              case "mouseover":
              case "mousemove":
                var leaved = null;
                this.hovElement !== element &&
                  this.hovElement &&
                  (this.triggerEvent(this.hovElement, e, p, "mouseout", {
                    relatedTarget: element || null,
                  }),
                  this.leaveElement(this.hovElement),
                  (leaved = this.hovElement),
                  (this.hovElement = void 0),
                  (notify = !0)),
                  !this.hovElement &&
                    element &&
                    (this.triggerEvent(element, e, p, "mouseover", {
                      relatedTarget: leaved,
                    }),
                    this.enterElement(element),
                    (this.hovElement = element),
                    (notify = !0)),
                  (trigger = element && "mousemove" === e.type);
                break;
              case "mouseleave":
              case "mouseout":
                this.hovElement &&
                  (this.triggerEvent(this.hovElement, e, p, "mouseout", {
                    relatedTarget: e.relatedTarget,
                  }),
                  this.leaveElement(this.hovElement),
                  (this.hovElement = void 0),
                  (notify = !0)),
                  (trigger = !1);
            }
            trigger && this.triggerEvent(element, e, p, e.type),
              notify && this.notify();
          }),
          (DocMouseSimulator.prototype.getDefaultUndefinedProperties =
            function () {
              return [
                "clientX",
                "clientY",
                "offsetX",
                "offsetY",
                "screenX",
                "screenY",
              ];
            }),
          (DocMouseSimulator.prototype.getDefaultResendProperties =
            function () {
              return [
                "altKey",
                "bubbles",
                "button",
                "buttons",
                "cancelable",
                "changedTouches",
                "char",
                "charCode",
                "ctrlKey",
                "data",
                "detail",
                "eventPhase",
                "isDefaultPrevented",
                "key",
                "keyCode",
                "metaKey",
                "pointerId",
                "pointerType",
                "shiftKey",
                "targetTouches",
                "touches",
                "which",
              ];
            }),
          DocMouseSimulator
        );
      })();
    (DocMouseSimulator.HOVER = "SIMULATED-HOVER"),
      (DocMouseSimulator.ACTIVE = "SIMULATED-ACTIVE"),
      (exports.default = DocMouseSimulator);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var Dom2Image = function Dom2Image(wnd, doc, cache) {
      function toSvg(node, options) {
        function applyOptions(clone) {
          return (
            options.bgcolor && (clone.style.backgroundColor = options.bgcolor),
            options.width && (clone.style.width = options.width + "px"),
            options.height && (clone.style.height = options.height + "px"),
            options.style &&
              self.window.Object.keys(options.style).forEach(function (
                property
              ) {
                clone.style[property] = options.style[property];
              }),
            clone
          );
        }
        return (
          (options = options || {}),
          Promise.resolve(node)
            .then(function (node) {
              return cloneNode(node, options.filter, !0);
            })
            .then(embedFonts)
            .then(inlineImages)
            .then(applyOptions)
            .then(function (clone) {
              return makeSvgDataUri(
                clone,
                options.width || util.width(node),
                options.height || util.height(node)
              );
            })
        );
      }
      function toPixelData(node, options) {
        return draw(node, options || {}).then(function (canvas) {
          return canvas
            .getContext("2d")
            .getImageData(0, 0, util.width(node), util.height(node)).data;
        });
      }
      function toPng(node, options) {
        return draw(node, options || {}).then(function (canvas) {
          return canvas.toDataURL();
        });
      }
      function toJpeg(node, options) {
        return (
          (options = options || {}),
          draw(node, options).then(function (canvas) {
            return canvas.toDataURL("image/jpeg", options.quality || 1);
          })
        );
      }
      function toBlob(node, options) {
        return draw(node, options || {}).then(util.canvasToBlob);
      }
      function draw(domNode, options) {
        function newCanvas(domNode) {
          var canvas = self.document.createElement("canvas");
          if (
            ((canvas.width = options.width || util.width(domNode)),
            (canvas.height = options.height || util.height(domNode)),
            options.bgcolor)
          ) {
            var ctx = canvas.getContext("2d");
            (ctx.fillStyle = options.bgcolor),
              ctx.fillRect(0, 0, canvas.width, canvas.height);
          }
          return canvas;
        }
        return toSvg(domNode, options)
          .then(util.makeImage)
          .then(util.delay(100))
          .then(function (image) {
            var canvas = newCanvas(domNode);
            return canvas.getContext("2d").drawImage(image, 0, 0), canvas;
          });
      }
      function cloneNode(node, filter, root) {
        function makeNodeCopy(node) {
          return util.isCanvas(node)
            ? util.makeImage(node.toDataURL())
            : node.cloneNode(!1);
        }
        function cloneChildren(original, clone, filter) {
          var children = original.childNodes;
          return 0 === children.length
            ? Promise.resolve(clone)
            : (function (parent, children, filter) {
                var done = Promise.resolve();
                return (
                  children.forEach(function (child) {
                    done = done
                      .then(function () {
                        return cloneNode(child, filter);
                      })
                      .then(function (childClone) {
                        childClone && parent.appendChild(childClone);
                      });
                  }),
                  done
                );
              })(clone, util.asArray(children), filter).then(function () {
                return clone;
              });
        }
        function processClone(original, clone) {
          function cloneStyle() {
            !(function (source, target) {
              source.cssText
                ? (target.cssText = source.cssText)
                : (function (source, target) {
                    util.asArray(source).forEach(function (name) {
                      target.setProperty(
                        name,
                        source.getPropertyValue(name),
                        source.getPropertyPriority(name)
                      );
                    });
                  })(source, target);
            })(self.window.getComputedStyle(original), clone.style);
          }
          function clonePseudoElements() {
            function clonePseudoElement(element) {
              var style = self.window.getComputedStyle(original, element),
                content = style.getPropertyValue("content");
              if ("" !== content && "none" !== content) {
                var className = util.uid();
                clone.className = clone.className + " " + className;
                var styleElement = self.document.createElement("style");
                styleElement.appendChild(
                  (function (className, element, style) {
                    var selector = "." + className + ":" + element,
                      cssText = style.cssText
                        ? (function (style) {
                            var content = style.getPropertyValue("content");
                            return style.cssText + " content: " + content + ";";
                          })(style)
                        : (function (style) {
                            function formatProperty(name) {
                              return (
                                name +
                                ": " +
                                style.getPropertyValue(name) +
                                (style.getPropertyPriority(name)
                                  ? " !important"
                                  : "")
                              );
                            }
                            return (
                              util
                                .asArray(style)
                                .map(formatProperty)
                                .join("; ") + ";"
                            );
                          })(style);
                    return self.document.createTextNode(
                      selector + "{" + cssText + "}"
                    );
                  })(className, element, style)
                ),
                  clone.appendChild(styleElement);
              }
            }
            [":before", ":after"].forEach(function (element) {
              clonePseudoElement(element);
            });
          }
          function copyUserInput() {
            util.isTextArea(original) && (clone.innerHTML = original.value),
              util.isInput(original) &&
                clone.setAttribute("value", original.value);
          }
          function fixSvg() {
            util.isSVG(clone) &&
              (clone.setAttribute("xmlns", "http://www.w3.org/2000/svg"),
              util.isSVGRect(clone) &&
                ["width", "height"].forEach(function (attribute) {
                  var value = clone.getAttribute(attribute);
                  value && clone.style.setProperty(attribute, value);
                }));
          }
          return util.isElement(clone)
            ? Promise.resolve()
                .then(cloneStyle)
                .then(clonePseudoElements)
                .then(copyUserInput)
                .then(fixSvg)
                .then(function () {
                  return clone;
                })
            : clone;
        }
        return root || !filter || filter(node)
          ? Promise.resolve(node)
              .then(makeNodeCopy)
              .then(function (clone) {
                return cloneChildren(node, clone, filter);
              })
              .then(function (clone) {
                return processClone(node, clone);
              })
          : Promise.resolve();
      }
      function embedFonts(node) {
        return fontFaces.resolveAll().then(function (cssText) {
          var styleNode = self.document.createElement("style");
          return (
            node.appendChild(styleNode),
            styleNode.appendChild(self.document.createTextNode(cssText)),
            node
          );
        });
      }
      function inlineImages(node) {
        return images.inlineAll(node).then(function () {
          return node;
        });
      }
      function makeSvgDataUri(node, width, height) {
        return Promise.resolve(node)
          .then(function (node) {
            return (
              node.setAttribute("xmlns", "http://www.w3.org/1999/xhtml"),
              new self.window.XMLSerializer().serializeToString(node)
            );
          })
          .then(util.escapeXhtml)
          .then(function (xhtml) {
            return [
              "data:image/svg+xml;charset=utf-8,",
              '<svg xmlns="http://www.w3.org/2000/svg" width="',
              width,
              '" height="',
              height,
              '">',
              '<foreignObject x="0" y="0" width="100%" height="100%">',
              xhtml,
              "</foreignObject>",
              "</svg>",
            ].join("");
          });
      }
      _classCallCheck(this, Dom2Image);
      var self = this;
      (this.window = wnd), (this.document = doc), (this.cache = cache);
      var util = (function () {
          function mimes() {
            var WOFF = "application/font-woff";
            return {
              woff: WOFF,
              woff2: WOFF,
              ttf: "application/font-truetype",
              eot: "application/vnd.ms-fontobject",
              png: "image/png",
              jpg: "image/jpeg",
              jpeg: "image/jpeg",
              gif: "image/gif",
              tiff: "image/tiff",
              svg: "image/svg+xml",
            };
          }
          function parseExtension(url) {
            var match = /\.([^\.\/]*?)$/g.exec(url);
            return match ? match[1] : "";
          }
          function mimeType(url) {
            var extension = parseExtension(url).toLowerCase();
            return mimes()[extension] || "";
          }
          function isDataUrl(url) {
            return -1 !== url.search(/^(data:)/);
          }
          function toBlob(canvas) {
            return new Promise(function (resolve) {
              for (
                var binaryString = self.window.atob(
                    canvas.toDataURL().split(",")[1]
                  ),
                  length = binaryString.length,
                  binaryArray = new self.window.Uint8Array(length),
                  i = 0;
                i < length;
                i++
              )
                binaryArray[i] = binaryString.charCodeAt(i);
              resolve(
                new self.window.Blob([binaryArray], { type: "image/png" })
              );
            });
          }
          function canvasToBlob(canvas) {
            return canvas.toBlob
              ? new Promise(function (resolve) {
                  canvas.toBlob(resolve);
                })
              : toBlob(canvas);
          }
          function resolveUrl(url, baseUrl) {
            var doc = self.document.implementation.createHTMLDocument(),
              base = doc.createElement("base");
            doc.head.appendChild(base);
            var a = doc.createElement("a");
            return (
              doc.body.appendChild(a),
              (base.href = baseUrl),
              (a.href = url),
              a.href
            );
          }
          function makeImage(uri) {
            return new Promise(function (resolve, reject) {
              var image = new self.window.Image();
              (image.onload = function () {
                resolve(image);
              }),
                (image.onerror = reject),
                (image.src = uri);
            });
          }
          function getAndEncode(url) {
            var data = self.cache.get(url);
            if (data)
              return data.content
                ? data.content
                : new Promise(function (resolve) {
                    data.content
                      ? resolve(data.content)
                      : data.pendings.push(resolve);
                  });
            data = self.cache.put(url, { pendings: [] });
            var TIMEOUT = 3e4;
            return new Promise(function (resolve) {
              function done() {
                if (4 === request.readyState) {
                  if (200 !== request.status)
                    return void fail(
                      "cannot fetch resource: " +
                        url +
                        ", status: " +
                        request.status
                    );
                  var encoder = new self.window.FileReader();
                  (encoder.onloadend = function () {
                    data.content = encoder.result.split(/,/)[1];
                    for (
                      var _iterator = data.pendings,
                        _isArray = Array.isArray(_iterator),
                        _i = 0,
                        _iterator = _isArray
                          ? _iterator
                          : _iterator[Symbol.iterator]();
                      ;

                    ) {
                      var _ref;
                      if (_isArray) {
                        if (_i >= _iterator.length) break;
                        _ref = _iterator[_i++];
                      } else {
                        if (((_i = _iterator.next()), _i.done)) break;
                        _ref = _i.value;
                      }
                      _ref(data.content);
                    }
                    (data.pendings = []), resolve(data.content);
                  }),
                    encoder.readAsDataURL(request.response);
                }
              }
              function timeout() {
                fail(
                  "timeout of " +
                    TIMEOUT +
                    "ms occured while fetching resource: " +
                    url
                );
              }
              function fail(message) {
                console.error(message), resolve("");
              }
              var request = new self.window.XMLHttpRequest();
              (request.onreadystatechange = done),
                (request.ontimeout = timeout),
                (request.responseType = "blob"),
                (request.timeout = TIMEOUT),
                request.open("GET", url, !0),
                request.send();
            });
          }
          function dataAsUrl(content, type) {
            return ["data:", type, ";base64,", content].join("");
          }
          function escape(string) {
            return string.replace(/([.*+?^${}()|\[\]\/\\])/g, "\\$1");
          }
          function delay(ms) {
            return function (arg) {
              return new Promise(function (resolve) {
                setTimeout(function () {
                  resolve(arg);
                }, ms);
              });
            };
          }
          function asArray(arrayLike) {
            for (
              var array = [], length = arrayLike.length, i = 0;
              i < length;
              i++
            )
              array.push(arrayLike[i]);
            return array;
          }
          function escapeXhtml(string) {
            return string.replace(/(#|\n)/g, function (c) {
              return "#" === c ? "%23" : "%0A";
            });
          }
          function width(node) {
            var leftBorder = px(node, "border-left-width"),
              rightBorder = px(node, "border-right-width");
            return node.scrollWidth + leftBorder + rightBorder;
          }
          function height(node) {
            var topBorder = px(node, "border-top-width"),
              bottomBorder = px(node, "border-bottom-width");
            return node.scrollHeight + topBorder + bottomBorder;
          }
          function px(node, styleProperty) {
            var value = self.window
              .getComputedStyle(node)
              .getPropertyValue(styleProperty);
            return parseFloat(value.replace("px", ""));
          }
          function isElement(node) {
            return node instanceof self.window.Element;
          }
          function isCanvas(node) {
            return node instanceof self.window.HTMLCanvasElement;
          }
          function isTextArea(node) {
            return node instanceof self.window.HTMLTextAreaElement;
          }
          function isInput(node) {
            return node instanceof self.window.HTMLInputElement;
          }
          function isSVG(node) {
            return node instanceof self.window.SVGElement;
          }
          function isSVGRect(node) {
            return node instanceof self.window.SVGRectElement;
          }
          function isImage(node) {
            return node instanceof self.window.HTMLImageElement;
          }
          return {
            escape: escape,
            parseExtension: parseExtension,
            mimeType: mimeType,
            dataAsUrl: dataAsUrl,
            isDataUrl: isDataUrl,
            canvasToBlob: canvasToBlob,
            resolveUrl: resolveUrl,
            getAndEncode: getAndEncode,
            uid: (function () {
              var index = 0;
              return function () {
                return (
                  "u" +
                  (function () {
                    return (
                      "0000" +
                      (
                        (self.window.Math.random() *
                          self.window.Math.pow(36, 4)) <<
                        0
                      ).toString(36)
                    ).slice(-4);
                  })() +
                  index++
                );
              };
            })(),
            delay: delay,
            asArray: asArray,
            escapeXhtml: escapeXhtml,
            makeImage: makeImage,
            width: width,
            height: height,
            isElement: isElement,
            isCanvas: isCanvas,
            isTextArea: isTextArea,
            isInput: isInput,
            isSVG: isSVG,
            isSVGRect: isSVGRect,
            isImage: isImage,
          };
        })(),
        inliner = (function () {
          function shouldProcess(string) {
            return -1 !== string.search(URL_REGEX);
          }
          function readUrls(string) {
            for (
              var result = [], match = void 0;
              null !== (match = URL_REGEX.exec(string));

            )
              result.push(match[1]);
            return result.filter(function (url) {
              return !util.isDataUrl(url);
            });
          }
          function inline(string, url, baseUrl, get) {
            function urlAsRegex(url) {
              return new self.window.RegExp(
                ["(url\\(['\"]?)(", util.escape(url), ")(['\"]?\\))"].join(""),
                "g"
              );
            }
            return Promise.resolve(url)
              .then(function (url) {
                return baseUrl ? util.resolveUrl(url, baseUrl) : url;
              })
              .then(get || util.getAndEncode)
              .then(function (data) {
                return util.dataAsUrl(data, util.mimeType(url));
              })
              .then(function (dataUrl) {
                return string.replace(
                  urlAsRegex(url),
                  ["$1", dataUrl, "$3"].join("")
                );
              });
          }
          function inlineAll(string, baseUrl, get) {
            return (function () {
              return !shouldProcess(string);
            })()
              ? Promise.resolve(string)
              : Promise.resolve(string)
                  .then(readUrls)
                  .then(function (urls) {
                    var done = Promise.resolve(string);
                    return (
                      urls.forEach(function (url) {
                        done = done.then(function (string) {
                          return inline(string, url, baseUrl, get);
                        });
                      }),
                      done
                    );
                  });
          }
          var URL_REGEX = /url\(['"]?([^'"]+?)['"]?\)/g;
          return {
            inlineAll: inlineAll,
            shouldProcess: shouldProcess,
            impl: { readUrls: readUrls, inline: inline },
          };
        })(),
        fontFaces = (function () {
          function resolveAll() {
            return readAll(self.document)
              .then(function (webFonts) {
                return Promise.all(
                  webFonts.map(function (webFont) {
                    return webFont.resolve();
                  })
                );
              })
              .then(function (cssStrings) {
                return cssStrings.join("\n");
              });
          }
          function readAll() {
            function selectWebFontRules(cssRules) {
              return cssRules
                .filter(function (rule) {
                  return rule.type === CSSRule.FONT_FACE_RULE;
                })
                .filter(function (rule) {
                  return inliner.shouldProcess(
                    rule.style.getPropertyValue("src")
                  );
                });
            }
            function getCssRules(styleSheets) {
              var cssRules = [];
              return (
                styleSheets.forEach(function (sheet) {
                  try {
                    util
                      .asArray(sheet.cssRules || [])
                      .forEach(cssRules.push.bind(cssRules));
                  } catch (e) {
                    console.log(
                      "Error while reading CSS rules from " + sheet.href,
                      e.toString()
                    );
                  }
                }),
                cssRules
              );
            }
            function newWebFont(webFontRule) {
              return {
                resolve: function () {
                  var baseUrl = (webFontRule.parentStyleSheet || {}).href;
                  return inliner.inlineAll(webFontRule.cssText, baseUrl);
                },
                src: function () {
                  return webFontRule.style.getPropertyValue("src");
                },
              };
            }
            return Promise.resolve(util.asArray(self.document.styleSheets))
              .then(getCssRules)
              .then(selectWebFontRules)
              .then(function (rules) {
                return rules.map(newWebFont);
              });
          }
          return { resolveAll: resolveAll, impl: { readAll: readAll } };
        })(),
        images = (function () {
          function newImage(element) {
            function inline(get) {
              return util.isDataUrl(element.src)
                ? Promise.resolve()
                : Promise.resolve(element.src)
                    .then(get || util.getAndEncode)
                    .then(function (data) {
                      return util.dataAsUrl(data, util.mimeType(element.src));
                    })
                    .then(function (dataUrl) {
                      return new Promise(function (resolve, reject) {
                        (element.onload = resolve),
                          (element.onerror = reject),
                          (element.src = dataUrl);
                      });
                    });
            }
            return { inline: inline };
          }
          function inlineAll(node) {
            return util.isElement(node)
              ? (function (node) {
                  var background = node.style.getPropertyValue("background");
                  return background
                    ? inliner
                        .inlineAll(background)
                        .then(function (inlined) {
                          node.style.setProperty(
                            "background",
                            inlined,
                            node.style.getPropertyPriority("background")
                          );
                        })
                        .then(function () {
                          return node;
                        })
                    : Promise.resolve(node);
                })(node).then(function () {
                  return util.isImage(node)
                    ? newImage(node).inline()
                    : Promise.all(
                        util.asArray(node.childNodes).map(function (child) {
                          return inlineAll(child);
                        })
                      );
                })
              : Promise.resolve(node);
          }
          return { inlineAll: inlineAll, impl: { newImage: newImage } };
        })();
      (this.toSvg = toSvg),
        (this.toPng = toPng),
        (this.toJpeg = toJpeg),
        (this.toBlob = toBlob),
        (this.toPixelData = toPixelData),
        (this.impl = {
          fontFaces: fontFaces,
          images: images,
          util: util,
          inliner: inliner,
        });
    };
    exports.default = Dom2Image;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      Drag = (function () {
        function Drag(wnd, doc, visualWorld) {
          _classCallCheck(this, Drag),
            (this.wnd = wnd),
            (this.doc = doc),
            (this.visual = visualWorld),
            (this.coords = new _libs.THREE.Vector2()),
            (this.intersection = new _libs.THREE.Vector3()),
            (this.raycaster = this.visual.raycaster),
            (this.camera = this.visual.camera),
            (this.plane = new _libs.THREE.Plane()),
            (this.threes = []),
            (this.selected = null),
            (this.enabled = !0),
            (this.controlsState = this.visual.getControlsState()),
            (this.element = this.visual.element),
            (this.binds = {
              onMouseMove: this.onMouseMove.bind(this),
              onMouseDown: this.onMouseDown.bind(this),
              onMouseUp: this.onMouseUp.bind(this),
            }),
            (0, _libs.$)(this.element).on("mousemove", this.binds.onMouseMove),
            (0, _libs.$)(this.element).on("mousedown", this.binds.onMouseDown),
            (0, _libs.$)(this.doc).on("mouseup", this.binds.onMouseUp);
        }
        return (
          (Drag.prototype.addThree = function (three) {
            this.threes.push(three);
          }),
          (Drag.prototype.removeThree = function (three) {
            var i = this.threes.indexOf(three);
            ~i && this.threes.splice(i, 1);
          }),
          (Drag.prototype.onPickCallback = function () {
            return !0;
          }),
          (Drag.prototype.onDragCallback = function () {
            return !0;
          }),
          (Drag.prototype.onReleaseCallback = function () {}),
          (Drag.prototype.dispose = function () {
            (0, _libs.$)(this.element).off("mousemove", this.binds.onMouseMove),
              (0, _libs.$)(this.element).off(
                "mousedown",
                this.binds.onMouseDown
              ),
              (0, _libs.$)(this.doc).off("mouseup", this.binds.onMouseUp);
          }),
          (Drag.prototype.setCoordsFromEvent = function (e) {
            var jElement = (0, _libs.$)(this.element),
              offset = jElement.offset();
            return (
              (this.coords.x =
                ((e.pageX - offset.left) / jElement.width()) * 2 - 1),
              (this.coords.y =
                (-(e.pageY - offset.top) / jElement.height()) * 2 + 1),
              this.coords
            );
          }),
          (Drag.prototype.onMouseDown = function (e) {
            if (this.enabled) {
              this.selected && this.onMouseUp(e),
                this.setCoordsFromEvent(e),
                this.raycaster.setFromCamera(this.coords, this.camera);
              var intersects = this.raycaster.intersectObjects(this.threes);
              if (intersects.length > 0) {
                var selected = intersects[0].object;
                if (!this.onPickCallback(intersects[0])) return;
                var v = intersects[0].point.clone();
                (this.distance = v.sub(this.raycaster.ray.origin).length()),
                  (this.controlsState = this.visual.getControlsState()),
                  this.visual.setControlsState(!1),
                  this.plane.setFromNormalAndCoplanarPoint(
                    this.visual.camera.getWorldDirection(this.plane.normal),
                    intersects[0].point
                  ),
                  (this.selected = selected);
              }
            }
          }),
          (Drag.prototype.onMouseMove = function (e) {
            this.enabled &&
              (e.preventDefault(),
              this.selected &&
                (this.setCoordsFromEvent(e),
                this.raycaster.setFromCamera(this.coords, this.camera),
                this.raycaster.ray.intersectPlane(
                  this.plane,
                  this.intersection
                ) &&
                  (this.onDragCallback(this.intersection) ||
                    this.onMouseUp(e))));
          }),
          (Drag.prototype.onMouseUp = function (e) {
            this.selected &&
              (this.onReleaseCallback(),
              (this.selected = null),
              this.visual.setControlsState(this.controlsState)),
              this.enabled && e.preventDefault();
          }),
          Drag
        );
      })();
    exports.default = Drag;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0);
    __webpack_require__(74)(_libs.$);
    var EventsToActions = (function () {
      function EventsToActions(element, actions) {
        _classCallCheck(this, EventsToActions),
          (this.actions = actions || {}),
          (this.element = element),
          (this.doc = element[0].ownerDocument),
          (this.wnd = this.doc.defaultView),
          (this.enabled = !0),
          (this.binds = {
            contextMenu: this.contextMenu.bind(this),
            mouseDown: this.mouseDown.bind(this),
            mouseMove: this.mouseMove.bind(this),
            mouseUp: this.mouseUp.bind(this),
            mouseWheel: this.mouseWheel.bind(this),
            mouseMoveDoc: this.mouseMoveDoc.bind(this),
            mouseUpDoc: this.mouseUpDoc.bind(this),
            click: this.click.bind(this),
            dblclick: this.dblclick.bind(this),
            touchStart: this.touchStart.bind(this),
            touchMove: this.touchMove.bind(this),
            touchEnd: this.touchEnd.bind(this),
            keyDown: this.keyDown.bind(this),
            keyPress: this.keyPress.bind(this),
            keyUp: this.keyUp.bind(this),
          }),
          this.element.on("contextmenu", this.binds.contextMenu),
          this.element.on("mousedown", this.binds.mouseDown),
          this.element.on("mousemove", this.binds.mouseMove),
          this.element.on("mouseup", this.binds.mouseUp),
          this.element.on("mousewheel", this.binds.mouseWheel),
          (0, _libs.$)(this.doc).on("mousemove", this.binds.mouseMoveDoc),
          (0, _libs.$)(this.doc).on("mouseup", this.binds.mouseUpDoc),
          this.element.on("click", this.binds.click),
          this.element.on("dblclick", this.binds.dblclick),
          this.element.on("touchstart", this.binds.touchStart),
          this.element.on("touchmove", this.binds.touchMove),
          this.element.on("touchend", this.binds.touchEnd),
          (0, _libs.$)(this.wnd).on("keydown", this.binds.keyDown),
          (0, _libs.$)(this.wnd).on("keypress", this.binds.keyPress),
          (0, _libs.$)(this.wnd).on("keyup", this.binds.keyUp);
      }
      return (
        (EventsToActions.getEventFlags = function (e) {
          return (e.ctrlKey << 0) | (e.shiftKey << 1) | (e.altKey << 2);
        }),
        (EventsToActions.getPosition = function (touches) {
          var x = void 0,
            y = void 0;
          return (
            2 === touches.length
              ? ((x = touches[1].pageX - touches[0].pageX),
                (y = touches[1].pageY - touches[0].pageY))
              : ((x = touches[0].pageX), (y = touches[0].pageY)),
            { x: x, y: y }
          );
        }),
        (EventsToActions.prototype.addAction = function (
          action,
          type,
          code,
          flags
        ) {
          (type = type.toLowerCase()),
            this.actions[type] || (this.actions[type] = {}),
            this.actions[type][code] || (this.actions[type][code] = {}),
            this.actions[type][code][flags] ||
              (this.actions[type][code][flags] = []),
            this.actions[type][code][flags].push(action);
        }),
        (EventsToActions.prototype.getActions = function (type, code, flags) {
          return ((this.actions[type] || {})[code] || {})[flags] || [];
        }),
        (EventsToActions.prototype.fireActions = function (actions, e, data) {
          for (
            var _iterator = actions,
              _isArray = Array.isArray(_iterator),
              _i = 0,
              _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
            ;

          ) {
            var _ref;
            if (_isArray) {
              if (_i >= _iterator.length) break;
              _ref = _iterator[_i++];
            } else {
              if (((_i = _iterator.next()), _i.done)) break;
              _ref = _i.value;
            }
            _ref(e, data);
          }
        }),
        (EventsToActions.prototype.contextMenu = function (e) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(
              this.getActions("contextmenu", e.button, flags),
              e
            );
          }
        }),
        (EventsToActions.prototype.mouseDown = function (e) {
          if ((this.picked && this.mouseUpDoc(), this.enabled)) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(this.getActions("mousedown", e.button, flags), e),
              (this.picked = {
                x: e.pageX,
                y: e.pageY,
                actions: this.getActions("mousedrag", e.button, flags),
              }),
              this.fireActions(this.picked.actions, e, { state: "start" });
          }
        }),
        (EventsToActions.prototype.mouseMove = function (e) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(this.getActions("mousemove", e.button, flags), e);
          }
        }),
        (EventsToActions.prototype.mouseMoveDoc = function (e) {
          this.enabled &&
            this.picked &&
            (this.fireActions(this.picked.actions, e, {
              state: "move",
              dx: e.pageX - this.picked.x,
              dy: e.pageY - this.picked.y,
            }),
            (this.picked = {
              x: e.pageX,
              y: e.pageY,
              actions: this.picked.actions,
            }));
        }),
        (EventsToActions.prototype.mouseUp = function (e) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(this.getActions("mouseup", e.button, flags), e);
          }
        }),
        (EventsToActions.prototype.mouseUpDoc = function (e) {
          this.picked &&
            (this.fireActions(this.picked.actions, e, { state: "end" }),
            delete this.picked);
        }),
        (EventsToActions.prototype.mouseWheel = function (e) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(this.getActions("mousewheel", 0, flags), e);
          }
        }),
        (EventsToActions.prototype.clicks = function (e, type) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(this.getActions(type, e.button, flags), e);
          }
        }),
        (EventsToActions.prototype.click = function (e) {
          this.clicks(e, "click");
        }),
        (EventsToActions.prototype.dblclick = function (e) {
          this.clicks(e, "dblclick");
        }),
        (EventsToActions.prototype.touchPick = function (e, flags, touches) {
          var pos = EventsToActions.getPosition(touches);
          (this.touchPicked = _extends({}, pos, {
            actions: this.getActions("touchdrag", touches.length, flags),
            code: touches.length,
            flags: flags,
          })),
            this.fireActions(
              this.touchPicked.actions,
              e,
              _extends({ state: "start" }, pos)
            );
        }),
        (EventsToActions.prototype.touchStart = function (e) {
          if ((this.touchPicked && this.touchEnd(e), this.enabled)) {
            var flags = EventsToActions.getEventFlags(e),
              touches = e.touches || e.originalEvent.touches;
            this.fireActions(
              this.getActions("touchstart", touches.length, flags),
              e
            ),
              this.touchPick(e, flags, touches);
          }
        }),
        (EventsToActions.prototype.touchMove = function (e) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e),
              touches = e.touches || e.originalEvent.touches;
            if (
              (this.fireActions(
                this.getActions("touchmove", touches.length, flags),
                e
              ),
              this.touchPicked)
            )
              if (
                this.touchPicked.code === touches.length &&
                this.touchPicked.flags === flags
              ) {
                var pos = EventsToActions.getPosition(touches);
                this.fireActions(
                  this.touchPicked.actions,
                  e,
                  _extends(
                    {
                      state: "move",
                      dx: pos.x - this.touchPicked.x,
                      dy: pos.y - this.touchPicked.y,
                    },
                    pos
                  )
                ),
                  (this.touchPicked = _extends({}, this.touchPicked, pos));
              } else this.touchEnd(e), this.touchPick(e, flags, touches);
          }
        }),
        (EventsToActions.prototype.touchEnd = function (e) {
          this.touchPicked &&
            (this.fireActions(this.touchPicked.actions, e, { state: "end" }),
            delete this.touchPicked);
        }),
        (EventsToActions.prototype.key = function (e, type) {
          if (this.enabled) {
            var flags = EventsToActions.getEventFlags(e);
            this.fireActions(this.getActions(type, e.keyCode, flags), e);
          }
        }),
        (EventsToActions.prototype.keyDown = function (e) {
          this.key(e, "keydown");
        }),
        (EventsToActions.prototype.keyPress = function (e) {
          this.key(e, "keypress");
        }),
        (EventsToActions.prototype.keyUp = function (e) {
          this.key(e, "keyup");
        }),
        (EventsToActions.prototype.dispose = function () {
          this.element.off("contextmenu", this.binds.contextMenu),
            this.element.off("mousedown", this.binds.mouseDown),
            this.element.off("mousemove", this.binds.mouseMove),
            this.element.off("mouseup", this.binds.mouseUp),
            this.element.off("mousewheel", this.binds.mouseWheel),
            (0, _libs.$)(this.doc).off("mousemove", this.binds.mouseMoveDoc),
            (0, _libs.$)(this.doc).off("mouseup", this.binds.mouseUpDoc),
            this.element.off("click", this.binds.click),
            this.element.off("dblclick", this.binds.dblclick),
            this.element.off("touchstart", this.binds.touchStart),
            this.element.off("touchmove", this.binds.touchMove),
            this.element.off("touchend", this.binds.touchEnd),
            (0, _libs.$)(this.wnd).off("keydown", this.binds.keyDown),
            (0, _libs.$)(this.wnd).off("keypress", this.binds.keyPress),
            (0, _libs.$)(this.wnd).off("keyup", this.binds.keyUp);
        }),
        EventsToActions
      );
    })();
    (EventsToActions.modKeys = { Ctrl: 1, Shift: 2, Alt: 4 }),
      (EventsToActions.mouseButtons = { Left: 0, Middle: 1, Right: 2 }),
      (exports.default = EventsToActions);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var FullScreen = (function () {
      function FullScreen() {
        _classCallCheck(this, FullScreen);
      }
      return (
        (FullScreen.available = function () {
          return (
            FullScreen._hasWebkitFullScreen ||
            FullScreen._hasMozFullScreen ||
            FullScreen._hasMsFullscreen
          );
        }),
        (FullScreen.activated = function () {
          return FullScreen._hasWebkitFullScreen
            ? document.webkitIsFullScreen
            : FullScreen._hasMozFullScreen
            ? document.mozFullScreen
            : FullScreen._hasMsFullscreen
            ? !!document.msFullscreenElement
            : void console.assert(!1);
        }),
        (FullScreen.addEventListener = function (element, handler) {
          element.addEventListener &&
            (element.addEventListener("webkitfullscreenchange", handler, !1),
            element.addEventListener("mozfullscreenchange", handler, !1),
            element.addEventListener("fullscreenchange", handler, !1),
            element.addEventListener("MSFullscreenChange", handler, !1));
        }),
        (FullScreen.removeEventListener = function (element, handler) {
          element.removeEventListener &&
            (element.removeEventListener("webkitfullscreenchange", handler, !1),
            element.removeEventListener("mozfullscreenchange", handler, !1),
            element.removeEventListener("fullscreenchange", handler, !1),
            element.removeEventListener("MSFullscreenChange", handler, !1));
        }),
        (FullScreen.request = function (element) {
          (element = element || document.body),
            FullScreen._hasWebkitFullScreen
              ? element.webkitRequestFullScreen()
              : FullScreen._hasMozFullScreen
              ? element.mozRequestFullScreen()
              : FullScreen._hasMsFullscreen
              ? element.msRequestFullscreen()
              : console.assert(!1);
        }),
        (FullScreen.cancel = function () {
          FullScreen._hasWebkitFullScreen
            ? document.webkitCancelFullScreen()
            : FullScreen._hasMozFullScreen
            ? document.mozCancelFullScreen()
            : FullScreen._hasMsFullscreen
            ? document.msExitFullscreen()
            : console.assert(!1);
        }),
        FullScreen
      );
    })();
    (FullScreen._hasWebkitFullScreen = !!document.webkitCancelFullScreen),
      (FullScreen._hasMozFullScreen = !!document.mozCancelFullScreen),
      (FullScreen._hasMsFullscreen =
        !!document.documentElement.msRequestFullscreen),
      (exports.default = FullScreen);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _ImageBase2 = __webpack_require__(6),
      _ImageBase3 = _interopRequireDefault(_ImageBase2),
      _BaseMathUtils = __webpack_require__(2),
      _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils),
      _Dom2Image = __webpack_require__(50),
      _Dom2Image2 = _interopRequireDefault(_Dom2Image),
      _DocMouseSimulator = __webpack_require__(49),
      _DocMouseSimulator2 = _interopRequireDefault(_DocMouseSimulator),
      InteractiveImage = (function (_ImageBase) {
        function InteractiveImage(
          context,
          width,
          height,
          color,
          src,
          cache,
          injector
        ) {
          _classCallCheck(this, InteractiveImage);
          var _this = _possibleConstructorReturn(
            this,
            _ImageBase.call(this, context, width, height, color)
          );
          _this.iId = "i" + _BaseMathUtils2.default.getUnique();
          var jFrame = (0, _libs.$)(
            '<iframe id="' +
              _this.iId +
              '" src="' +
              src +
              '" style="position: fixed; left: -1000px;"></iframe>'
          );
          return (
            (0, _libs.$)(_this.doc.body).append(jFrame),
            (_this.frame = jFrame[0]),
            (_this.binds = {}),
            injector && injector(_this.frame.contentWindow),
            _this.doc.implementation.hasFeature(
              "www.http://w3.org/TR/SVG11/feature#Extensibility",
              "1.1"
            ) &&
              ((_this.image = new Image()),
              (_this.binds.imageLoad = function () {
                _this.renderImage(_this.image), _this.finishRender();
              }),
              (0, _libs.$)(_this.image).on("load", _this.binds.imageLoad),
              (_this.svgRender = new _Dom2Image2.default(
                _this.frame.contentWindow,
                _this.frame.contentDocument,
                cache
              ))),
            (_this.binds.frameLoad = function () {
              ~_this.frame.contentDocument.title.indexOf("404")
                ? ((_this.startRender = function () {
                    _this.renderNotFoundPage(), _this.finishRender();
                  }),
                  _this.finishLoad())
                : setTimeout(function () {
                    _this.frame &&
                      ((_this.width = (0, _libs.$)(
                        _this.frame.contentDocument.body
                      ).width()),
                      (_this.height = (0, _libs.$)(
                        _this.frame.contentDocument.body
                      ).height()),
                      (_this.resH = (_this.height / _this.width) * _this.resW),
                      jFrame
                        .css("width", _this.width + "px")
                        .css("height", _this.height + "px"),
                      jFrame.offset({ left: -_this.width - 100, top: 0 }),
                      _this.svgRender &&
                        ((_this.simulator = new _DocMouseSimulator2.default(
                          jFrame,
                          _this.frame.contentDocument.body,
                          _this.element
                        )),
                        _this.simulator.addDocChangeClb(
                          _this.finishLoad.bind(_this)
                        )),
                      (_this.startRender = function () {
                        _this.render();
                      }),
                      _this.finishLoad());
                  }, 500);
            }),
            (0, _libs.$)(_this.frame.contentWindow).on(
              "load",
              _this.binds.frameLoad
            ),
            _this
          );
        }
        return (
          _inherits(InteractiveImage, _ImageBase),
          (InteractiveImage.prototype.getSimulatedDoc = function () {
            return this.frame.contentDocument;
          }),
          (InteractiveImage.prototype.render = function () {
            var _this2 = this;
            this.svgRender
              ? this.svgRender
                  .toSvg(this.simulator.element, {
                    height: this.height + "px",
                    width: this.width + "px",
                  })
                  .then(function (dataUrl) {
                    _this2.image.src = dataUrl;
                  })
                  .catch(function (error) {
                    console.error("Dom2Image: ", error),
                      _this2.renderBlankPage(),
                      _this2.finishRender();
                  })
              : (0, _libs.html2canvas)(this.frame.contentDocument.body, {
                  timeout: 3e4,
                }).then(function (canvas) {
                  _this2.renderImage(canvas), _this2.finishRender();
                });
          }),
          (InteractiveImage.prototype.dispose = function () {
            (0, _libs.$)(this.image).off("load", this.binds.imageLoad),
              (0, _libs.$)(this.frame.contentWindow).off(
                "load",
                this.binds.frameLoad
              ),
              (0, _libs.$)(this.doc.body)
                .find("#" + this.iId)
                .remove(),
              this.image && ((this.image.src = ""), delete this.image),
              (this.frame.src = ""),
              delete this.frame,
              _ImageBase.prototype.dispose.call(this);
          }),
          (InteractiveImage.prototype.simulate = function (e, doc, x, y) {
            this.simulator && this.simulator.simulate(e, doc, x, y);
          }),
          InteractiveImage
        );
      })(_ImageBase3.default);
    exports.default = InteractiveImage;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _GraphUtils = __webpack_require__(4),
      _GraphUtils2 = _interopRequireDefault(_GraphUtils),
      _MathUtils = __webpack_require__(5),
      _MathUtils2 = _interopRequireDefault(_MathUtils),
      LoadingAnimation = (function () {
        function LoadingAnimation(width, height, color) {
          _classCallCheck(this, LoadingAnimation),
            (this.c = _GraphUtils2.default.createCanvas(width, height)),
            (this.p = {
              g: 9.8,
              dt: 1 / 60,
              color: color,
              updateInterval: 0.25,
            }),
            (this.ctx = this.c.getContext("2d")),
            (this.os = [-2, Math.PI / 2]),
            (this.t = this.p.updateInterval);
        }
        return (
          (LoadingAnimation.prototype.dy = function (t, y) {
            var w = y[0],
              a = y[1];
            return [-this.g * Math.cos(a), w];
          }),
          (LoadingAnimation.prototype.integrate = function (T) {
            for (var t = 0, dt = this.p.dt, os = this.os; t < T; )
              t + dt > T && (dt = T - t),
                (os = _MathUtils2.default.rk4(
                  this.dy.bind({ g: this.p.g }),
                  0,
                  dt,
                  os
                )),
                (t += dt);
            return os;
          }),
          (LoadingAnimation.prototype.calcTimeTo = function (target) {
            for (
              var t = 0, dt = this.p.dt, os = this.os;
              Math.abs(os[1] - target) > 1e-4;

            ) {
              var nos = _MathUtils2.default.rk4(
                this.dy.bind({ g: this.p.g }),
                0,
                dt,
                os
              );
              (nos[0] < 0 && nos[1] < target) || (nos[0] > 0 && nos[1] > target)
                ? (dt /= 2)
                : ((os = nos), (t += dt));
            }
            return t;
          }),
          (LoadingAnimation.prototype.update = function (T) {
            if (
              ((this.os = this.integrate(T)),
              (this.t += T),
              this.t >= this.p.updateInterval)
            ) {
              this.t = 0;
              var r = 0.04 * Math.min(this.c.width, this.c.height),
                a = this.os[1],
                x0 = 0.5 * this.c.width,
                y0 = 0.5 * this.c.height,
                ctx = this.ctx;
              ctx.clearRect(0, 0, this.c.width, this.c.height),
                ctx.beginPath(),
                (ctx.fillStyle = _GraphUtils2.default.color2Rgba(
                  this.p.color,
                  1
                )),
                ctx.rect(0, 0, this.c.width, this.c.height),
                ctx.fill(),
                ctx.beginPath(),
                (ctx.shadowBlur = 50),
                (ctx.fillStyle = _GraphUtils2.default.color2Rgba(
                  _GraphUtils2.default.inverseColor(this.p.color, 0.9),
                  Math.abs(this.os[0] / 6.36)
                )),
                (ctx.shadowColor = _GraphUtils2.default.color2Rgba(
                  _GraphUtils2.default.inverseColor(this.p.color, 1),
                  0.9
                )),
                (ctx.shadowOffsetX = 0),
                (ctx.shadowOffsetY = 0),
                (ctx.font = "bold " + Math.round(0.25 * r) + "px Arial"),
                (ctx.textAlign = "center"),
                (ctx.textBaseline = "middle"),
                ctx.fillText((0, _libs.tr)("Loading..."), x0, y0);
              var da = (2 * Math.PI) / 10;
              ctx.shadowColor = _GraphUtils2.default.color2Rgba(
                _GraphUtils2.default.inverseColor(this.p.color, 1),
                0.7
              );
              for (
                var i = 0, _a = a, _r = 0.2 * r;
                i < 10;
                ++i, _r *= 0.9, _a += da
              ) {
                ctx.beginPath(),
                  (ctx.fillStyle = _GraphUtils2.default.color2Rgba(
                    _GraphUtils2.default.inverseColor(
                      this.p.color,
                      (10 - i) / 10
                    ),
                    (0.7 * (10 - i)) / 10
                  ));
                var cx = x0 + r * Math.cos(_a),
                  cy = y0 - r * Math.sin(_a),
                  nx = x0 + r * Math.cos(_a + da),
                  ny = y0 - r * Math.sin(_a + da);
                (ctx.shadowOffsetX = 0.2 * (nx - cx)),
                  (ctx.shadowOffsetY = 0.2 * (ny - cy)),
                  ctx.arc(cx, cy, _r, 0, 2 * Math.PI, 1),
                  ctx.fill();
              }
              this.onChange && this.onChange(this.c, this.p.color);
            }
          }),
          (LoadingAnimation.prototype.getImage = function () {
            return this.c;
          }),
          (LoadingAnimation.prototype.dispose = function () {
            (this.c.width = 0),
              (this.c.height = 0),
              delete this.ctx,
              delete this.c;
          }),
          (LoadingAnimation.prototype.createSprite = function (n) {
            var c = _GraphUtils2.default.createCanvas(
                this.c.width * n,
                this.c.height
              ),
              ctx = c.getContext("2d"),
              t = this.calcTimeTo(
                this.os[1] + 2 * Math.sign(this.os[0]) * Math.PI
              ),
              dt = t / (n + 1),
              updateInterval = this.p.updateInterval;
            this.p.updateInterval = 0;
            for (var i = 0; i < n; ++i)
              this.update(dt), ctx.drawImage(this.c, i * this.c.width, 0);
            return (this.p.updateInterval = updateInterval), c;
          }),
          LoadingAnimation
        );
      })();
    exports.default = LoadingAnimation;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var LoadingController =
      (__webpack_require__(0),
      (function () {
        function LoadingController(view) {
          var showProgress =
              !(arguments.length > 1 && void 0 !== arguments[1]) ||
              arguments[1],
            loadingMsg =
              arguments.length > 2 && void 0 !== arguments[2]
                ? arguments[2]
                : void 0;
          _classCallCheck(this, LoadingController),
            (this.view = view),
            (this.progress = 0),
            (this.showProgress = showProgress),
            (this.getLoadingMsg =
              loadingMsg || LoadingController.defaultLoadingMsg),
            this.updateView();
        }
        return (
          (LoadingController.defaultLoadingMsg = function (progress) {
            return [
              "Please wait... the Application is Loading: ",
              progress,
              "%",
            ].join("");
          }),
          (LoadingController.prototype.dispose = function () {
            (this.showProgress = !1), this.updateView(), delete this.view;
          }),
          (LoadingController.prototype.setProgress = function (v) {
            (this.progress = v), this.updateView();
          }),
          (LoadingController.prototype.updateView = function () {
            if (this.view) {
              this.view.setState("widLoadingProgress", {
                enable: !0,
                visible: this.showProgress,
                active: !1,
              }),
                this.view.setState("txtLoadingProgress", {
                  value: this.getLoadingMsg(this.progress),
                  visible: !0,
                });
              for (
                var _iterator = this.view.getLinks(),
                  _isArray = Array.isArray(_iterator),
                  _i = 0,
                  _iterator = _isArray
                    ? _iterator
                    : _iterator[Symbol.iterator]();
                ;

              ) {
                var _ref;
                if (_isArray) {
                  if (_i >= _iterator.length) break;
                  _ref = _iterator[_i++];
                } else {
                  if (((_i = _iterator.next()), _i.done)) break;
                  _ref = _i.value;
                }
                var name = _ref;
                this.view.setState(name, {
                  enable: !1,
                  visible: !0,
                  active: !1,
                });
              }
              this.view.setState("inpPages", { visible: !0, value: "" }),
                this.view.setState("inpPage", {
                  visible: !0,
                  enable: !1,
                  value: "",
                });
            }
          }),
          LoadingController
        );
      })());
    exports.default = LoadingController;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _EventConverter2 = __webpack_require__(7),
      _EventConverter3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_EventConverter2),
      MouseEventConverter = (function (_EventConverter) {
        function MouseEventConverter(wnd, doc, element) {
          _classCallCheck(this, MouseEventConverter);
          var _this = _possibleConstructorReturn(
            this,
            _EventConverter.call(this, wnd, doc)
          );
          return (
            (_this.element = element),
            (_this.binds = { convert: _this.convert.bind(_this) }),
            (0, _libs.$)(_this.element).on(
              "mousemove mousedown mouseover mouseout click",
              _this.binds.convert
            ),
            (0, _libs.$)(_this.doc).on("mouseup", _this.binds.convert),
            _this
          );
        }
        return (
          _inherits(MouseEventConverter, _EventConverter),
          (MouseEventConverter.prototype.dispose = function () {
            (0, _libs.$)(this.element).off(
              "mousemove mousedown mouseover mouseout click",
              this.binds.convert
            ),
              (0, _libs.$)(this.doc).off("mouseup", this.binds.convert);
          }),
          MouseEventConverter
        );
      })(_EventConverter3.default);
    exports.default = MouseEventConverter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0),
      _MathUtils = __webpack_require__(5),
      _MathUtils2 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_MathUtils),
      Object3DWatcher = (function () {
        function Object3DWatcher(visual, boundBoxClb) {
          var testScale =
            arguments.length > 2 && void 0 !== arguments[2]
              ? arguments[2]
              : this.testScale;
          _classCallCheck(this, Object3DWatcher),
            (this.visual = visual),
            (this.boundBoxClb = boundBoxClb),
            (this.testScale = testScale),
            (this.camera = visual.camera),
            (this.element = this.visual.element),
            (this.elementSize = { w: 1, h: 1 }),
            (this.orbit = visual.getOrbit()),
            (this.scale = 1),
            (this.padding = 0),
            (this.eps = 1e-4),
            (this.v = new _libs.THREE.Vector3()),
            (this.dv = new _libs.THREE.Vector2()),
            (this.enabled = !1),
            visual.addRenderCallback(this.update.bind(this)),
            (this.os = { vx: 0, vy: 0, x: 0, y: 0 }),
            this.orbit.update(),
            this.camera.updateMatrixWorld();
          var box = this.computeClientBoundBox();
          this.movePan({ x: -1.11 * box.mid.x, y: -1.11 * box.mid.y });
        }
        return (
          (Object3DWatcher.prototype.setPadding = function (padding) {
            this.padding = padding;
          }),
          (Object3DWatcher.prototype.movePan = function (dv) {
            this.orbit.pan(
              dv.x * this.visual.width(),
              -dv.y * this.visual.height()
            );
          }),
          (Object3DWatcher.prototype.vToCamera = function (v) {
            return v.project(this.camera), { x: 0.5 * v.x, y: 0.5 * v.y };
          }),
          (Object3DWatcher.prototype.computeClientBoundBox = function () {
            for (
              var box = this.boundBoxClb(),
                xs = [box.min.x, box.max.x],
                ys = [0, 0],
                zs = [box.min.z, box.max.z],
                ps = [],
                res = { max: {}, min: {} },
                _iterator = xs,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              for (
                var x = _ref,
                  _iterator2 = ys,
                  _isArray2 = Array.isArray(_iterator2),
                  _i2 = 0,
                  _iterator2 = _isArray2
                    ? _iterator2
                    : _iterator2[Symbol.iterator]();
                ;

              ) {
                var _ref2;
                if (_isArray2) {
                  if (_i2 >= _iterator2.length) break;
                  _ref2 = _iterator2[_i2++];
                } else {
                  if (((_i2 = _iterator2.next()), _i2.done)) break;
                  _ref2 = _i2.value;
                }
                for (
                  var y = _ref2,
                    _iterator3 = zs,
                    _isArray3 = Array.isArray(_iterator3),
                    _i3 = 0,
                    _iterator3 = _isArray3
                      ? _iterator3
                      : _iterator3[Symbol.iterator]();
                  ;

                ) {
                  var _ref3;
                  if (_isArray3) {
                    if (_i3 >= _iterator3.length) break;
                    _ref3 = _iterator3[_i3++];
                  } else {
                    if (((_i3 = _iterator3.next()), _i3.done)) break;
                    _ref3 = _i3.value;
                  }
                  var z = _ref3;
                  ps.push(this.vToCamera(this.v.set(x, y, z)));
                }
              }
            }
            return (
              ps.sort(function (p1, p2) {
                return p1.x - p2.x;
              }),
              (res.min.x = ps[0].x),
              (res.max.x = ps[ps.length - 1].x),
              ps.sort(function (p1, p2) {
                return p1.y - p2.y;
              }),
              (res.min.y = ps[0].y),
              (res.max.y = ps[ps.length - 1].y),
              (res.width = res.max.x - res.min.x),
              (res.height = res.max.y - res.min.y),
              (res.mid = {
                x: 0.5 * (res.max.x + res.min.x),
                y: 0.5 * (res.max.y + res.min.y),
              }),
              res
            );
          }),
          (Object3DWatcher.prototype.setObject = function (boundBoxClb) {
            this.boundBoxClb = boundBoxClb;
          }),
          (Object3DWatcher.prototype.testScale = function () {
            return !0;
          }),
          (Object3DWatcher.prototype.computeCorr = function (K, min, max) {
            var corr = 0;
            return (
              K < 1
                ? min > -0.5
                  ? (corr = -0.5 - min)
                  : max < 0.5 && (corr = 0.5 - max)
                : min < -0.5
                ? (corr = -0.5 - min)
                : max > 0.5 && (corr = 0.5 - max),
              corr
            );
          }),
          (Object3DWatcher.prototype.centerView = function (T) {
            var box = this.computeClientBoundBox(),
              Kx = this.elementSize.w / box.width,
              Ky = this.elementSize.h / box.height,
              K = Math.min(Kx, Ky),
              moving = !1;
            if (this.testScale() && Math.abs(1 / K - this.scale) > this.eps) {
              var scale = 1 / K + 0.2 * (this.scale - 1 / K);
              this.orbit.setScale(this.orbit.getScale() / (K * scale)),
                this.orbit.update(),
                this.camera.updateMatrixWorld(),
                (box = this.computeClientBoundBox()),
                (Kx = this.elementSize.w / box.width),
                (Ky = this.elementSize.h / box.height),
                (K = Math.min(Kx, Ky)),
                (moving = !0);
            }
            var dv = this.dv;
            if (K > 1 - this.eps)
              if (this.padding) {
                var height = this.visual.height(),
                  marg = (0.5 * (Ky - 1)) / Ky,
                  pad = this.padding / height,
                  dpad = Math.max(0, Math.abs(pad) - marg);
                dv.set(
                  -box.mid.x,
                  -Math.sign(pad) *
                    Math.min(Math.max(0, marg - 20 / height), dpad) -
                    box.mid.y
                );
              } else dv.set(-box.mid.x, -box.mid.y);
            else {
              var px = 70 / this.visual.width(),
                py = 70 / this.visual.height();
              dv.set(
                this.computeCorr(Kx, box.min.x - px, box.max.x + px),
                this.computeCorr(Ky, box.min.y - py, box.max.y + py)
              );
            }
            if (
              Math.sqrt(this.os.vx * this.os.vx + this.os.vy * this.os.vy) >
                0.003 ||
              dv.length() > 0.003
            ) {
              var dt = 1 / 60,
                t = 0,
                os = _extends({}, this.os, { x: 0, y: 0 });
              for (
                os.tf = function (vx, vy, x, y) {
                  return { x: 75 * (dv.x - x), y: 75 * (dv.y - y) };
                };
                t < T;

              )
                t + dt > T && (dt = T - t),
                  (os = this.integrate(os, dt)),
                  (t += dt);
              this.movePan(os), (this.os = os), (moving = !0);
            }
            this.orbit.setMoving(moving);
          }),
          (Object3DWatcher.prototype.integrate = function (os, dt) {
            var _MathUtils$rk = _MathUtils2.default.rk4(
                this.dy.bind(os),
                0,
                dt,
                [os.vx, os.vy, os.x, os.y]
              ),
              vx = _MathUtils$rk[0],
              vy = _MathUtils$rk[1],
              x = _MathUtils$rk[2],
              y = _MathUtils$rk[3];
            return _extends({}, os, { vx: vx, vy: vy, x: x, y: y });
          }),
          (Object3DWatcher.prototype.dy = function (t, Y) {
            var vx = Y[0],
              vy = Y[1],
              x = Y[2],
              y = Y[3],
              tf = this.tf(vx, vy, x, y);
            return [tf.x - 15 * vx, tf.y - 15 * vy, vx, vy];
          }),
          (Object3DWatcher.prototype.update = function (dt) {
            this.enabled && this.boundBoxClb && this.centerView(dt);
          }),
          Object3DWatcher
        );
      })();
    exports.default = Object3DWatcher;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      Orbit = (function (_THREE$EventDispatche) {
        function Orbit(object, world) {
          function getAutoRotationAngle() {
            return ((2 * Math.PI) / 60 / 60) * scope.autoRotateSpeed;
          }
          function getZoomScale() {
            return Math.pow(0.95, scope.zoomSpeed);
          }
          function rotateLeft(angle) {
            sphericalDelta.theta -= angle;
          }
          function rotateUp(angle) {
            sphericalDelta.phi -= angle;
          }
          function dollyIn(dollyScale) {
            scope.object instanceof _libs.THREE.PerspectiveCamera
              ? (scale /= dollyScale)
              : scope.object instanceof _libs.THREE.OrthographicCamera
              ? ((scope.object.zoom = Math.max(
                  scope.minZoom,
                  Math.min(scope.maxZoom, scope.object.zoom * dollyScale)
                )),
                scope.object.updateProjectionMatrix(),
                (zoomChanged = !0))
              : (console.warn(
                  "WARNING: OrbitControls.js encountered an unknown camera type-dolly/zoom disabled."
                ),
                (scope.enableZoom = !1));
          }
          function dollyOut(dollyScale) {
            scope.object instanceof _libs.THREE.PerspectiveCamera
              ? (scale *= dollyScale)
              : scope.object instanceof _libs.THREE.OrthographicCamera
              ? ((scope.object.zoom = Math.max(
                  scope.minZoom,
                  Math.min(scope.maxZoom, scope.object.zoom / dollyScale)
                )),
                scope.object.updateProjectionMatrix(),
                (zoomChanged = !0))
              : (console.warn(
                  "WARNING: OrbitControls.js encountered an unknown camera type-dolly/zoom disabled."
                ),
                (scope.enableZoom = !1));
          }
          function rotate(event, data) {
            if (scope.enabled && scope.enableRotate && "move" === data.state) {
              var clientWidth = scope.world.width(),
                clientHeight = scope.world.height();
              rotateLeft(
                ((2 * Math.PI * data.dx) / clientWidth) * scope.rotateSpeed
              ),
                rotateUp(
                  ((2 * Math.PI * data.dy) / clientHeight) * scope.rotateSpeed
                ),
                scope.update();
            }
          }
          function pan(event, data) {
            scope.enabled &&
              scope.enablePan &&
              "move" === data.state &&
              (scope.pan(data.dx, data.dy), scope.update());
          }
          function offsetDolly(event, data) {
            scope.enabled &&
              scope.enableZoom &&
              "move" === data.state &&
              (data.dy > 0
                ? dollyIn(getZoomScale())
                : data.dy < 0 && dollyOut(getZoomScale()),
              scope.update());
          }
          function wheelDolly(event) {
            scope.enabled &&
              scope.enableZoom &&
              (event.deltaY > 0
                ? dollyOut(getZoomScale())
                : event.deltaY < 0 && dollyIn(getZoomScale()),
              scope.update());
          }
          _classCallCheck(this, Orbit);
          var _this = _possibleConstructorReturn(
            this,
            _THREE$EventDispatche.call(this)
          );
          (_this.moving = !1),
            (_this.object = object),
            (_this.world = world),
            (_this.enabled = !0),
            (_this.target = new _libs.THREE.Vector3()),
            (_this.minDistance = 0),
            (_this.maxDistance = 1 / 0),
            (_this.minZoom = 0),
            (_this.maxZoom = 1 / 0),
            (_this.minPolarAngle = 0),
            (_this.maxPolarAngle = Math.PI),
            (_this.minAzimuthAngle = -1 / 0),
            (_this.maxAzimuthAngle = 1 / 0),
            (_this.enableDamping = !1),
            (_this.dampingFactor = 0.25),
            (_this.enableZoom = !0),
            (_this.zoomSpeed = 1),
            (_this.enableRotate = !0),
            (_this.rotateSpeed = 1),
            (_this.enablePan = !0),
            (_this.autoRotate = !1),
            (_this.autoRotateSpeed = 2),
            (_this.target0 = _this.target.clone()),
            (_this.position0 = _this.object.position.clone()),
            (_this.zoom0 = _this.object.zoom),
            (_this.getPolarAngle = function () {
              return spherical.phi;
            }),
            (_this.getAzimuthalAngle = function () {
              return spherical.theta;
            }),
            (_this.reset = function () {
              scope.target.copy(scope.target0),
                scope.object.position.copy(scope.position0),
                (scope.object.zoom = scope.zoom0),
                scope.object.updateProjectionMatrix(),
                scope.dispatchEvent(changeEvent),
                scope.update();
            }),
            (_this.zoomOut = function () {
              var speed =
                  arguments.length > 0 && void 0 !== arguments[0]
                    ? arguments[0]
                    : this.zoomSpeed,
                _speed = this.zoomSpeed;
              (this.zoomSpeed = speed),
                dollyIn(getZoomScale()),
                (this.zoomSpeed = _speed);
            }),
            (_this.zoomIn = function () {
              var speed =
                  arguments.length > 0 && void 0 !== arguments[0]
                    ? arguments[0]
                    : this.zoomSpeed,
                _speed = this.zoomSpeed;
              (this.zoomSpeed = speed),
                dollyOut(getZoomScale()),
                (this.zoomSpeed = _speed);
            }),
            (_this.getScale = function () {
              return scale;
            }),
            (_this.setScale = function (newScale) {
              scale = newScale;
            }),
            (_this.update = (function () {
              var offset = new _libs.THREE.Vector3(),
                quat = new _libs.THREE.Quaternion().setFromUnitVectors(
                  object.up,
                  new _libs.THREE.Vector3(0, 1, 0)
                ),
                quatInverse = quat.clone().inverse(),
                lastPosition = new _libs.THREE.Vector3(),
                lastQuaternion = new _libs.THREE.Quaternion();
              return function () {
                var position = scope.object.position;
                return (
                  offset.copy(position).sub(scope.target),
                  offset.applyQuaternion(quat),
                  spherical.setFromVector3(offset),
                  scope.autoRotate && rotateLeft(getAutoRotationAngle()),
                  (spherical.theta += sphericalDelta.theta),
                  (spherical.phi += sphericalDelta.phi),
                  (spherical.theta = Math.max(
                    scope.minAzimuthAngle,
                    Math.min(scope.maxAzimuthAngle, spherical.theta)
                  )),
                  (spherical.phi = Math.max(
                    scope.minPolarAngle,
                    Math.min(scope.maxPolarAngle, spherical.phi)
                  )),
                  spherical.makeSafe(),
                  (spherical.radius *= scale),
                  (spherical.radius = Math.max(
                    scope.minDistance,
                    Math.min(scope.maxDistance, spherical.radius)
                  )),
                  scope.target.add(panOffset),
                  offset.setFromSpherical(spherical),
                  offset.applyQuaternion(quatInverse),
                  position.copy(scope.target).add(offset),
                  scope.object.lookAt(scope.target),
                  !0 === scope.enableDamping
                    ? ((sphericalDelta.theta *= 1 - scope.dampingFactor),
                      (sphericalDelta.phi *= 1 - scope.dampingFactor))
                    : sphericalDelta.set(0, 0, 0),
                  (scale = 1),
                  panOffset.set(0, 0, 0),
                  !!(
                    zoomChanged ||
                    lastPosition.distanceToSquared(scope.object.position) >
                      EPS ||
                    8 * (1 - lastQuaternion.dot(scope.object.quaternion)) > EPS
                  ) &&
                    (scope.dispatchEvent(changeEvent),
                    lastPosition.copy(scope.object.position),
                    lastQuaternion.copy(scope.object.quaternion),
                    (zoomChanged = !1),
                    !0)
                );
              };
            })()),
            (_this.dispose = function () {});
          var scope = _this,
            changeEvent = { type: "change" },
            EPS = 1e-6,
            spherical = new _libs.THREE.Spherical(),
            sphericalDelta = new _libs.THREE.Spherical(),
            scale = 1,
            panOffset = new _libs.THREE.Vector3(),
            zoomChanged = !1,
            panLeft = (function () {
              var v = new _libs.THREE.Vector3();
              return function (distance, objectMatrix) {
                v.setFromMatrixColumn(objectMatrix, 0),
                  v.multiplyScalar(-distance),
                  panOffset.add(v);
              };
            })(),
            panUp = (function () {
              var v = new _libs.THREE.Vector3();
              return function (distance, objectMatrix) {
                v.setFromMatrixColumn(objectMatrix, 1),
                  v.multiplyScalar(distance),
                  panOffset.add(v);
              };
            })();
          return (
            (scope.pan = (function () {
              var offset = new _libs.THREE.Vector3();
              return function (deltaX, deltaY) {
                var clientWidth = scope.world.width(),
                  clientHeight = scope.world.height();
                if (scope.object instanceof _libs.THREE.PerspectiveCamera) {
                  var position = scope.object.position;
                  offset.copy(position).sub(scope.target);
                  var targetDistance = offset.length();
                  (targetDistance *= Math.tan(
                    ((scope.object.fov / 2) * Math.PI) / 180
                  )),
                    panLeft(
                      (2 * deltaX * targetDistance) / clientHeight,
                      scope.object.matrix
                    ),
                    panUp(
                      (2 * deltaY * targetDistance) / clientHeight,
                      scope.object.matrix
                    );
                } else
                  scope.object instanceof _libs.THREE.OrthographicCamera
                    ? (panLeft(
                        (deltaX * (scope.object.right - scope.object.left)) /
                          scope.object.zoom /
                          clientWidth,
                        scope.object.matrix
                      ),
                      panUp(
                        (deltaY * (scope.object.top - scope.object.bottom)) /
                          scope.object.zoom /
                          clientHeight,
                        scope.object.matrix
                      ))
                    : (console.warn(
                        "WARNING: OrbitControls.js encountered an unknown camera type-pan disabled."
                      ),
                      (scope.enablePan = !1));
              };
            })()),
            (_this.actions = {
              rotate: rotate,
              pan: pan,
              offsetDolly: offsetDolly,
              wheelDolly: wheelDolly,
            }),
            _this.update(),
            _this
          );
        }
        return (
          _inherits(Orbit, _THREE$EventDispatche),
          (Orbit.prototype.setMoving = function (moving) {
            this.moving = moving;
          }),
          (Orbit.prototype.isMoving = function () {
            return this.moving;
          }),
          Orbit
        );
      })(_libs.THREE.EventDispatcher);
    exports.default = Orbit;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _ImageBase2 = __webpack_require__(6),
      _ImageBase3 = _interopRequireDefault(_ImageBase2),
      _Pdf = __webpack_require__(19),
      _Pdf2 = _interopRequireDefault(_Pdf),
      _BaseMathUtils = __webpack_require__(2),
      _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils),
      _CustomEventConverter = __webpack_require__(16),
      _CustomEventConverter2 = _interopRequireDefault(_CustomEventConverter),
      _PolyTarget = __webpack_require__(73),
      _PolyTarget2 = _interopRequireDefault(_PolyTarget),
      _Finder = __webpack_require__(17),
      _Finder2 = _interopRequireDefault(_Finder),
      PdfImage = (function (_ImageBase) {
        function PdfImage(context, width, height, color, pdf, n) {
          _classCallCheck(this, PdfImage);
          var _this = _possibleConstructorReturn(
            this,
            _ImageBase.call(this, context, width, height, color)
          );
          return (
            (_this.query = ""),
            (_this.n = n),
            (_this.pdf = pdf),
            (_this.v = {
              x: 0,
              y: 0,
              z: 0,
              set: function (x, y, z) {
                return (this.x = x), (this.y = y), (this.z = z), this;
              },
              transform: function (m) {
                var x =
                    m.m[0][0] * this.x +
                    m.m[1][0] * this.y +
                    m.m[2][0] * this.z,
                  y =
                    m.m[0][1] * this.x +
                    m.m[1][1] * this.y +
                    m.m[2][1] * this.z,
                  z =
                    m.m[0][2] * this.x +
                    m.m[0][2] * this.y +
                    m.m[2][0] * this.z;
                return (this.x = x), (this.y = y), (this.z = z), this;
              },
            }),
            (_this.m = {
              m: [
                [1, 0, 0],
                [0, 1, 0],
                [0, 0, 1],
              ],
              set: function (m00, m01, m02, m10, m11, m12, m20, m21, m22) {
                return (
                  (this.m = [
                    [m00, m01, m02],
                    [m10, m11, m12],
                    [m20, m21, m22],
                  ]),
                  this
                );
              },
            }),
            (_this.startRender = function () {
              _this.pdf.getHandler(_this.render.bind(_this));
            }),
            Promise.resolve().then(function () {
              return _this.pdf.getHandler(_this.init.bind(_this));
            }),
            (_this.cssLayerRequests = []),
            _this
          );
        }
        return (
          _inherits(PdfImage, _ImageBase),
          (PdfImage.prototype.setQuery = function (query) {
            (this.query = query.trim()),
              this.textContent && this.setHits(this.textContent);
          }),
          (PdfImage.prototype.rectSize = function (r) {
            return { width: r[2] - r[0], height: r[3] - r[1] };
          }),
          (PdfImage.prototype.createPoly = function (m, p, s) {
            var poly = [],
              v = this.v;
            return (
              v.set(p.x, p.y, 1).transform(m),
              poly.push({ x: v.x, y: v.y }),
              v.set(p.x, p.y + s.height, 1).transform(m),
              poly.push({ x: v.x, y: v.y }),
              v.set(p.x + s.width, p.y + s.height, 1).transform(m),
              poly.push({ x: v.x, y: v.y }),
              v.set(p.x + s.width, p.y, 1).transform(m),
              poly.push({ x: v.x, y: v.y }),
              poly
            );
          }),
          (PdfImage.prototype.getSimulatedDoc = function () {
            return this;
          }),
          (PdfImage.prototype.simulate = function (e, doc, x, y) {
            this.eventConverter &&
              this.eventConverter.convert(e, { doc: doc, x: x, y: y });
          }),
          (PdfImage.prototype.setAnnotations = function (annos) {
            var _this2 = this,
              t = this.viewport.transform,
              htmls = [],
              r = function (n) {
                return (100 * n + "").substr(0, 5);
              },
              targets = [];
            this.m.set(t[0], t[1], 0, t[2], t[3], 0, t[4], t[5], 1);
            for (
              var _iterator = annos,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var anno = _ref;
              if ("Link" === anno.subtype || "Widget" === anno.subtype) {
                var rect = anno.rect,
                  aPos = { x: rect[0], y: rect[1] },
                  aSz = this.rectSize(rect),
                  _target = new _PolyTarget2.default(
                    this.createPoly(this.m, aPos, aSz).map(function (p) {
                      return {
                        x: p.x / _this2.viewport.width,
                        y: 1 - p.y / _this2.viewport.height,
                      };
                    })
                  );
                (_target.anno = anno),
                  (_target.callback = this.annoClb.bind(this)),
                  targets.push(_target);
                var p = _target.poly;
                htmls.push(
                  '<div class="fb3d-block fb3d-link" style="top: ' +
                    r(1 - p[2].y) +
                    "%; left: " +
                    r(p[0].x) +
                    "%; width: " +
                    r(p[2].x - p[0].x) +
                    "%; height: " +
                    r(p[2].y - p[0].y) +
                    '%;"><a></a></div>'
                );
              }
            }
            if (targets.length) {
              this.eventConverter = new _CustomEventConverter2.default(
                this.wnd,
                this.doc,
                _PolyTarget2.default.test,
                this.getSimulatedDoc()
              );
              for (
                var _iterator2 = targets,
                  _isArray2 = Array.isArray(_iterator2),
                  _i2 = 0,
                  _iterator2 = _isArray2
                    ? _iterator2
                    : _iterator2[Symbol.iterator]();
                ;

              ) {
                var _ref2;
                if (_isArray2) {
                  if (_i2 >= _iterator2.length) break;
                  _ref2 = _iterator2[_i2++];
                } else {
                  if (((_i2 = _iterator2.next()), _i2.done)) break;
                  _ref2 = _i2.value;
                }
                var target = _ref2;
                this.eventConverter.addCustom(target);
              }
            }
            (this.cssLayer = {
              html: htmls.length
                ? "<pdf-layer>" + htmls.join("") + "</pdf-layer>"
                : void 0,
            }),
              this.resolveCssLayerRequests();
          }),
          (PdfImage.prototype.resolveCssLayerRequests = function () {
            if (this.cssLayer)
              for (
                var _iterator3 = this.cssLayerRequests,
                  _isArray3 = Array.isArray(_iterator3),
                  _i3 = 0,
                  _iterator3 = _isArray3
                    ? _iterator3
                    : _iterator3[Symbol.iterator]();
                ;

              ) {
                var _ref3;
                if (_isArray3) {
                  if (_i3 >= _iterator3.length) break;
                  _ref3 = _iterator3[_i3++];
                } else {
                  if (((_i3 = _iterator3.next()), _i3.done)) break;
                  _ref3 = _i3.value;
                }
                var r = _ref3;
                r(this.cssLayer.html ? this.cssLayer : void 0);
              }
          }),
          (PdfImage.prototype.getCSSLayer = function () {
            var _this3 = this;
            return new Promise(function (resolve) {
              _this3.cssLayerRequests.push(resolve),
                _this3.resolveCssLayerRequests();
            });
          }),
          (PdfImage.prototype.setHits = function (textContent) {
            (this.textContent = textContent),
              "" !== this.query &&
                (this.finder = new _Finder2.default(
                  textContent.items.map(function (item) {
                    return item.str;
                  }),
                  this.query,
                  { contexts: !1 }
                ));
          }),
          (PdfImage.prototype.renderHits = function () {
            var _this4 = this;
            if (this.finder) {
              for (
                var testSz =
                    (this.page.view,
                    (0, _libs.$)(
                      '<div style="position: absolute; visibility: hidden;"></div>'
                    ).appendTo("body")),
                  textDiv = testSz[0],
                  baseOffset = testSz.offset().left,
                  _iterator4 = this.finder.getHits(),
                  _isArray4 = Array.isArray(_iterator4),
                  _i4 = 0,
                  _iterator4 = _isArray4
                    ? _iterator4
                    : _iterator4[Symbol.iterator]();
                ;

              ) {
                var _ref4;
                if (_isArray4) {
                  if (_i4 >= _iterator4.length) break;
                  _ref4 = _iterator4[_i4++];
                } else {
                  if (((_i4 = _iterator4.next()), _i4.done)) break;
                  _ref4 = _i4.value;
                }
                var hit = _ref4,
                  item = this.textContent.items[hit.index],
                  t = _libs.PDFJS.Util.transform(
                    this.viewport.transform,
                    item.transform
                  ),
                  style = this.textContent.styles[item.fontName],
                  angle =
                    Math.atan2(t[1], t[0]) + (style.vertical ? Math.PI / 2 : 0),
                  fontHeight = Math.sqrt(t[2] * t[2] + t[3] * t[3]),
                  fontAscent = style.ascent
                    ? style.ascent * fontHeight
                    : style.descent
                    ? (1 + style.descent) * fontHeight
                    : fontHeight;
                testSz.html(
                  item.str.substr(0, hit.offset) +
                    "<span>" +
                    item.str.substr(hit.offset, hit.length) +
                    "</span>" +
                    item.str.substr(hit.offset + hit.length)
                ),
                  (textDiv.style.fontSize = fontHeight + "px"),
                  (textDiv.style.fontFamily = style.fontFamily);
                var testSpan = testSz.find("span"),
                  iwidth = style.vertical
                    ? item.height * this.viewport.scale
                    : item.width * this.viewport.scale,
                  width = testSz.width(),
                  relativeOffset =
                    (testSpan.offset().left - baseOffset) / width;
                this.m.set(
                  1,
                  0,
                  0,
                  0,
                  1,
                  0,
                  t[4] + fontAscent * Math.sin(angle),
                  t[5] - fontAscent * Math.cos(angle),
                  1
                );
                var poly = this.createPoly(
                  this.m,
                  { x: relativeOffset * iwidth, y: 0 },
                  {
                    width: (iwidth * testSpan.width()) / width,
                    height: testSpan.height(),
                  }
                );
                (poly = poly.map(function (p) {
                  return {
                    x: p.x / _this4.viewport.width,
                    y: 1 - p.y / _this4.viewport.height,
                  };
                })),
                  this.renderHit(poly);
              }
              testSz.remove();
            }
          }),
          (PdfImage.prototype.annoClb = function (e, data) {
            this.context.dispatchEvent &&
              this.context.dispatchEvent({
                type: "pdfAnnotation",
                event: e,
                annotation: data.target.anno,
              });
          }),
          (PdfImage.prototype.calcViewport = function () {
            var scale = _BaseMathUtils2.default.calcScale(
              this.size.width,
              this.size.height,
              this.resW,
              this.resH
            );
            (!this.viewport || Math.abs(this.viewport.scale - scale) > 1e-4) &&
              ((this.viewport = this.page.getViewport({ scale: scale })),
              "full" !== this.type &&
                ("right" === this.type
                  ? ((this.viewport.offsetX +=
                      0.5 * this.viewport.width * 1.0005),
                    (this.viewport.transform[4] -=
                      0.5 * this.viewport.width * 1.0005),
                    (this.viewport.width *= 0.5 / 1.0005))
                  : (this.viewport.width /= 2)),
              (this.resW = this.width = this.viewport.width),
              (this.resH = this.height = this.viewport.height));
          }),
          (PdfImage.prototype.init = function () {
            var _this5 = this;
            (this.type = this.pdf.getPageType(this.n)),
              this.pdf
                .getPage(this.n)
                .then(function (page) {
                  (_this5.page = page),
                    (_this5.size = _Pdf2.default.getPageSize(page)),
                    "full" !== _this5.type && (_this5.size.width /= 2),
                    page
                      .getAnnotations()
                      .then(_this5.setAnnotations.bind(_this5)),
                    page.getTextContent().then(_this5.setHits.bind(_this5)),
                    _this5.calcViewport(),
                    _this5.finishLoad();
                })
                .catch(function (e) {
                  console.error("Cannot load PDF page: " + (_this5.n + 1)),
                    console.error(e),
                    _this5.finishLoad();
                });
          }),
          (PdfImage.prototype.setResolution = function (res) {
            _ImageBase.prototype.setResolution.call(this, res),
              this.page && this.calcViewport();
          }),
          (PdfImage.prototype.render = function (handler) {
            var _this6 = this;
            if (this.page) {
              this.pushCtx();
              this.ctx.clearRect(0, 0, this.c.width, this.c.height),
                (this.renderTask = this.page.render({
                  canvasContext: this.ctx,
                  viewport: this.viewport,
                })),
                (this.renderTask.onContinue = function (continueRender) {
                  _this6.renderPause
                    ? (_this6.continueRender = continueRender)
                    : continueRender();
                }),
                this.renderTask.promise
                  .then(function () {
                    _this6.renderHits(), _this6.popCtx(), _this6.finishRender();
                  })
                  .catch(function (e) {
                    _this6.popCtx(), _this6.finishRender(!0);
                  });
            } else this.renderBlankPage(), this.finishRender();
          }),
          PdfImage
        );
      })(_ImageBase3.default);
    exports.default = PdfImage;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      Search = (function () {
        function Search(container, pages) {
          _classCallCheck(this, Search),
            (this.container = container),
            (this.pages = pages),
            (this.prevResults = []),
            container.html(
              '\n      <div class="search">\n        <div class="query">\n          <input class="inpQuery" type="text" maxlength="30" value="" />\n        </div>\n        <div class="results">\n        </div>\n        <div class="status">\n\n        </div>\n      </div>\n    '.fb3dQFilter()
            ),
            (this.query = container.find(".query input")),
            (this.results = container.find(".results")),
            (this.status = container.find(".status")),
            (this.binds = {
              navigate: this.navigate.bind(this),
              doQuery: this.doQuery.bind(this),
            }),
            this.query.on("keydown", this.binds.doQuery),
            this.results.on("click", this.binds.navigate);
        }
        return (
          (Search.prototype.dispose = function () {
            this.results.off("click", this.binds.navigate),
              this.query.off("keydown", this.binds.doQuery);
          }),
          (Search.prototype.navigate = function (e) {
            if ((e.preventDefault(), void 0 !== this.onNavigate)) {
              var target = (0, _libs.$)(e.target);
              if (!target.hasClass("result")) {
                var t = target.find(".result");
                if (t.length) target = t;
                else
                  for (; target.length && !target.hasClass("result"); )
                    target = (0, _libs.$)(target[0].parentNode);
              }
              var page = target.attr("data");
              void 0 !== page && this.onNavigate(parseInt(page));
            }
          }),
          (Search.prototype.doQuery = function () {
            var _this = this;
            if (this.onQuery) {
              var queryStamp = (this.queryStamp = Date.now());
              setTimeout(function () {
                queryStamp === _this.queryStamp &&
                  _this.onQuery(_this.query[0].value.trim());
              }, 1e3);
            }
          }),
          (Search.prototype.setResults = function (results, lastPage) {
            this.prevResults.length &&
              results[0] !== this.prevResults[0] &&
              ((this.prevResults = []), this.results.html(""));
            for (
              var htmls = [], i = this.prevResults.length;
              i < results.length;
              ++i
            ) {
              var result = results[i];
              htmls.push('<div class="result" data="' + result.page + '">'),
                htmls.push("<a>"),
                htmls.push(
                  "<div>" + result.contexts.join("</div><div>") + "</div>"
                ),
                htmls.push("</a>"),
                htmls.push("</div>");
            }
            (0, _libs.$)(htmls.join("")).appendTo(this.results),
              (this.prevResults = [].concat(results)),
              void 0 === lastPage
                ? this.status.html("")
                : this.status.html(lastPage + 1 + " of " + this.pages);
          }),
          Search
        );
      })();
    exports.default = Search;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _ImageBase2 = __webpack_require__(6),
      _ImageBase3 = _interopRequireDefault(_ImageBase2),
      _Utils = __webpack_require__(3),
      _Utils2 = _interopRequireDefault(_Utils),
      StaticImage = (function (_ImageBase) {
        function StaticImage(context, width, height, color, src) {
          _classCallCheck(this, StaticImage);
          var _this = _possibleConstructorReturn(
            this,
            _ImageBase.call(this, context, width, height, color)
          );
          return (
            (_this.binds = {}),
            (_this.image = new Image()),
            (_this.image.crossOrigin = "Anonymous"),
            (_this.binds.imageLoad = function () {
              (_this.width = _this.image.width),
                (_this.height = _this.image.height),
                (_this.resH = (_this.height / _this.width) * _this.resW),
                (_this.startRender = function () {
                  _this.renderImage(_this.image), _this.finishRender();
                }),
                _this.finishLoad();
            }),
            (_this.binds.imageError = function () {
              (_this.startRender = function () {
                _this.renderNotFoundPage(), _this.finishRender();
              }),
                _this.finishLoad();
            }),
            (0, _libs.$)(_this.image)
              .on("load", _this.binds.imageLoad)
              .on("error", _this.binds.imageError),
            (_this.image.src = _Utils2.default.normalizeUrl(src)),
            _this
          );
        }
        return (
          _inherits(StaticImage, _ImageBase),
          (StaticImage.prototype.dispose = function () {
            (0, _libs.$)(this.image)
              .off("load", this.binds.imageLoad)
              .off("error", this.binds.imageError),
              (this.image.src = ""),
              delete this.image,
              _ImageBase.prototype.dispose.call(this);
          }),
          StaticImage
        );
      })(_ImageBase3.default);
    exports.default = StaticImage;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      TextureAnimator = (function () {
        function TextureAnimator(
          img,
          tilesHoriz,
          tilesVert,
          numTiles,
          tileDispDuration
        ) {
          _classCallCheck(this, TextureAnimator);
          var texture = new _libs.THREE.Texture();
          (texture.minFilter = _libs.THREE.LinearFilter),
            (texture.image = img),
            (texture.needsUpdate = !0),
            (this.texture = texture),
            (this.tilesHorizontal = tilesHoriz),
            (this.tilesVertical = tilesVert),
            (this.numberOfTiles = numTiles),
            texture.repeat.set(
              1 / this.tilesHorizontal,
              1 / this.tilesVertical
            ),
            (this.tileDisplayDuration = tileDispDuration),
            (this.currentDisplayTime = 0),
            (this.currentTile = 0);
        }
        return (
          (TextureAnimator.prototype.update = function (milliSec) {
            for (
              this.currentDisplayTime += milliSec;
              this.currentDisplayTime > this.tileDisplayDuration;

            ) {
              (this.currentDisplayTime -= this.tileDisplayDuration),
                ++this.currentTile,
                this.currentTile == this.numberOfTiles &&
                  (this.currentTile = 0);
              var currentColumn = this.currentTile % this.tilesHorizontal;
              this.texture.offset.x = currentColumn / this.tilesHorizontal;
              var currentRow = Math.floor(
                this.currentTile / this.tilesHorizontal
              );
              this.texture.offset.y = currentRow / this.tilesVertical;
            }
          }),
          (TextureAnimator.prototype.dispose = function () {
            var img = this.texture.image;
            (img.height = img.width = 0), this.texture.dispose();
          }),
          TextureAnimator
        );
      })();
    exports.default = TextureAnimator;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _Utils = __webpack_require__(3),
      _Utils2 = _interopRequireDefault(_Utils),
      _MouseEventConverter2 = __webpack_require__(57),
      _MouseEventConverter3 = _interopRequireDefault(_MouseEventConverter2),
      _ThreeEventConverter = __webpack_require__(20),
      _ThreeEventConverter2 = _interopRequireDefault(_ThreeEventConverter),
      ThreeMouseEventConverter = (function (_MouseEventConverter) {
        function ThreeMouseEventConverter(wnd, doc, visualWorld, test) {
          _classCallCheck(this, ThreeMouseEventConverter);
          var _this = _possibleConstructorReturn(
            this,
            _MouseEventConverter.call(this, wnd, doc, visualWorld.element)
          );
          return (
            _Utils2.default.extends(
              _this,
              new _ThreeEventConverter2.default(visualWorld, test)
            ),
            _this
          );
        }
        return (
          _inherits(ThreeMouseEventConverter, _MouseEventConverter),
          (ThreeMouseEventConverter.prototype.getCallback = function (object) {
            return object.object.userData.mouseCallback;
          }),
          (ThreeMouseEventConverter.prototype.setCoordsFromEvent = function (
            e
          ) {
            var jElement = (0, _libs.$)(this.element),
              offset = jElement.offset();
            return (
              (this.coords.x =
                ((e.pageX - offset.left) / jElement.width()) * 2 - 1),
              (this.coords.y =
                (-(e.pageY - offset.top) / jElement.height()) * 2 + 1),
              this.coords
            );
          }),
          ThreeMouseEventConverter
        );
      })(_MouseEventConverter3.default);
    exports.default = ThreeMouseEventConverter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _Utils = __webpack_require__(3),
      _Utils2 = _interopRequireDefault(_Utils),
      _TouchEventConverter2 = __webpack_require__(67),
      _TouchEventConverter3 = _interopRequireDefault(_TouchEventConverter2),
      _ThreeEventConverter = __webpack_require__(20),
      _ThreeEventConverter2 = _interopRequireDefault(_ThreeEventConverter),
      ThreeTouchEventConverter = (function (_TouchEventConverter) {
        function ThreeTouchEventConverter(wnd, doc, visualWorld, test) {
          _classCallCheck(this, ThreeTouchEventConverter);
          var _this = _possibleConstructorReturn(
            this,
            _TouchEventConverter.call(this, wnd, doc, visualWorld.element)
          );
          return (
            _Utils2.default.extends(
              _this,
              new _ThreeEventConverter2.default(visualWorld, test)
            ),
            _this
          );
        }
        return (
          _inherits(ThreeTouchEventConverter, _TouchEventConverter),
          (ThreeTouchEventConverter.prototype.getCallback = function (object) {
            return object.object.userData.touchCallback;
          }),
          (ThreeTouchEventConverter.prototype.setCoordsFromEvent = function (
            e
          ) {
            var jElement = (0, _libs.$)(this.element),
              offset = jElement.offset(),
              touches = e.touches || e.originalEvent.touches,
              touch = touches.length
                ? touches[0]
                : (this.lastTouches || [{ pageX: 0, pageY: 0 }])[0],
              pageX = touch.pageX,
              pageY = touch.pageY;
            return (
              (this.lastTouches = touches.length ? touches : this.lastTouches),
              (this.coords.x =
                ((pageX - offset.left) / jElement.width()) * 2 - 1),
              (this.coords.y =
                (-(pageY - offset.top) / jElement.height()) * 2 + 1),
              this.coords
            );
          }),
          ThreeTouchEventConverter
        );
      })(_TouchEventConverter3.default);
    exports.default = ThreeTouchEventConverter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0),
      _ImageFactory = __webpack_require__(8),
      _ImageFactory2 = _interopRequireDefault(_ImageFactory),
      _GraphUtils = __webpack_require__(4),
      _GraphUtils2 = _interopRequireDefault(_GraphUtils),
      Thumbnails = (function () {
        function Thumbnails(context, container, thumbnailsClb, size) {
          var _this = this,
            props =
              arguments.length > 4 && void 0 !== arguments[4]
                ? arguments[4]
                : { kWtoH: 210 / 297 };
          _classCallCheck(this, Thumbnails),
            (this.container = container),
            (this.p = props),
            (this.thumbnailsClb = thumbnailsClb),
            (this.size = size),
            (this.queue = { first: 0, len: 0 }),
            (this.canvas = _GraphUtils2.default.createCanvas()),
            (this.imageFactory = new _ImageFactory2.default(
              _extends({}, context, {
                renderCanvas: this.canvas,
                renderCanvasCtx: this.canvas.getContext("2d"),
              })
            )),
            (this.thumbnails = []);
          for (var i = 0; i < size; ++i) {
            var info = this.thumbnailsClb(i);
            this.thumbnails.push(
              _extends({}, info, {
                index: i,
                loaded: "thumbnail-image" === info.type,
                heading: null,
                thumbnail: null,
                title: info.title || i,
              })
            );
          }
          (this.binds = {
            update: this.update.bind(this),
            navigate: function (e) {
              if ((e.preventDefault(), _this.onNavigate)) {
                for (var node = e.target; node && !node.dataThumbnail; )
                  node = node.parentNode;
                _this.onNavigate(node.dataThumbnail.index);
              }
            },
          }),
            this.container.on("scroll", this.binds.update);
        }
        return (
          (Thumbnails.prototype.getSize = function () {
            return this.size;
          }),
          (Thumbnails.prototype.setEnable = function (enable) {
            (this.enable = enable), this.update();
          }),
          (Thumbnails.prototype.dispose = function () {
            this.container.find("a").off("click", this.binds.navigate),
              this.container.off("scroll", this.binds.update),
              this.container.html(""),
              (this.canvas.height = this.canvas.width = 0),
              delete this.canvas;
          }),
          (Thumbnails.prototype.setLoadQueue = function (first, len) {
            var _this2 = this;
            (first = Math.min(first, this.size - 1)),
              (len = Math.min(len, this.size - first)),
              (this.queue = { first: first, len: len }),
              Promise.resolve().then(function () {
                return _this2.update();
              });
          }),
          (Thumbnails.prototype.load = function (thumbnail) {
            var _this3 = this;
            this.loading = !0;
            var wrapper = this.imageFactory.build(
              thumbnail,
              void 0 === thumbnail.number ? thumbnail.index : thumbnail.number,
              300 * this.p.kWtoH,
              300
            );
            wrapper.onChange = function (canvas) {
              _this3.setImage(thumbnail, canvas.toDataURL("image/png")),
                (thumbnail.loaded = !0),
                wrapper.dispose(),
                (_this3.loading = !1),
                Promise.resolve().then(function () {
                  return _this3.update();
                });
            };
          }),
          (Thumbnails.prototype.getActive = function () {
            for (
              var first = this.container.scrollTop(),
                last = first + this.container.height(),
                res = [],
                _iterator = this.thumbnails,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var thumbnail = _ref;
              Math.max(thumbnail.first, first) <
                Math.min(thumbnail.last, last) && res.push(thumbnail);
            }
            return res;
          }),
          (Thumbnails.prototype.update = function () {
            if (!this.loading && this.canvas) {
              if (this.enable) {
                this.built || this.render();
                for (
                  var active = this.getActive(),
                    _iterator2 = active,
                    _isArray2 = Array.isArray(_iterator2),
                    _i2 = 0,
                    _iterator2 = _isArray2
                      ? _iterator2
                      : _iterator2[Symbol.iterator]();
                  ;

                ) {
                  var _ref2;
                  if (_isArray2) {
                    if (_i2 >= _iterator2.length) break;
                    _ref2 = _iterator2[_i2++];
                  } else {
                    if (((_i2 = _iterator2.next()), _i2.done)) break;
                    _ref2 = _i2.value;
                  }
                  var thumbnail = _ref2;
                  if (!thumbnail.loaded) {
                    this.load(thumbnail);
                    break;
                  }
                }
              }
              if (!this.loading)
                for (
                  var i = this.queue.first;
                  i < this.queue.first + this.queue.len;
                  ++i
                ) {
                  var t = this.thumbnails[i];
                  if (!t.loaded) {
                    this.load(t);
                    break;
                  }
                }
            }
          }),
          (Thumbnails.prototype.setImage = function (thumbnail, img) {
            var trigger = thumbnail.img !== img;
            (thumbnail.img = img),
              thumbnail.thumbnail &&
                (thumbnail.thumbnail.css(
                  "background-image",
                  ["url('", img, "')"].join("")
                ),
                thumbnail.thumbnail.removeClass("loading")),
              trigger &&
                this.container.trigger("fb3d.thumbnails.thumbnailLoaded", [
                  thumbnail,
                ]);
          }),
          (Thumbnails.prototype.render = function () {
            for (
              var elements = ['<div class="thumbnails">'], i = 0;
              i < this.size;
              ++i
            )
              elements.push(
                [
                  '<div class="item"><a><div class="thumbnail loading" style="padding-top:' +
                    Math.round(100 / this.p.kWtoH) +
                    '%;"></div></a><div class="heading"><a title="',
                  i + 1,
                  '">',
                  i + 1,
                  "</a></div></div>",
                ].join("")
              );
            elements.push("</div>"), this.container.append(elements.join(""));
            for (
              var items = this.container.find(".item"),
                base = this.container.find(".thumbnails").offset().top,
                _i3 = 0;
              _i3 < items.length;
              ++_i3
            ) {
              var item = (0, _libs.$)(items[_i3]);
              (this.thumbnails[_i3].heading = item.find(".heading")),
                (this.thumbnails[_i3].thumbnail = item.find(".thumbnail")),
                (this.thumbnails[_i3].first = item.offset().top - base),
                (this.thumbnails[_i3].last =
                  this.thumbnails[_i3].first + item.height()),
                this.thumbnails[_i3].loaded &&
                  this.setImage(
                    this.thumbnails[_i3],
                    this.thumbnails[_i3].img || this.thumbnails[_i3].src
                  );
              for (var as = item.find("a"), j = 0; j < as.length; ++j) {
                as[j].dataThumbnail = this.thumbnails[_i3];
              }
            }
            this.container.find("a").on("click", this.binds.navigate),
              (this.built = !0);
          }),
          Thumbnails
        );
      })();
    exports.default = Thumbnails;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _libs = __webpack_require__(0),
      _EventConverter2 = __webpack_require__(7),
      _EventConverter3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_EventConverter2),
      TouchConverter = (function (_EventConverter) {
        function TouchConverter(wnd, doc, element) {
          _classCallCheck(this, TouchConverter);
          var _this = _possibleConstructorReturn(
            this,
            _EventConverter.call(this, wnd, doc)
          );
          return (
            (_this.element = element),
            (_this.binds = { convert: _this.convert.bind(_this) }),
            (0, _libs.$)(_this.element).on(
              "touchstart touchmove",
              _this.binds.convert
            ),
            (0, _libs.$)(_this.doc).on("touchend", _this.binds.convert),
            _this
          );
        }
        return (
          _inherits(TouchConverter, _EventConverter),
          (TouchConverter.prototype.dispose = function () {
            (0, _libs.$)(this.element).off(
              "touchstart touchmove",
              this.binds.convert
            ),
              (0, _libs.$)(this.doc).off("touchend", this.binds.convert);
          }),
          TouchConverter
        );
      })(_EventConverter3.default);
    exports.default = TouchConverter;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var UserMessageController =
      (__webpack_require__(0),
      (function () {
        function UserMessageController(view) {
          _classCallCheck(this, UserMessageController),
            (this.view = view),
            (this.showMessage = !1),
            (this.message = ""),
            this.updateView();
        }
        return (
          (UserMessageController.prototype.dispose = function () {
            this.updateView(), delete this.view;
          }),
          (UserMessageController.prototype.setError = function (text) {
            (this.showMessage = !0),
              (this.message = ['<div class="text error">', text, "</div>"].join(
                ""
              )),
              this.updateView();
          }),
          (UserMessageController.prototype.updateView = function () {
            this.view &&
              (this.view.setState("widUserMessage", {
                enable: !0,
                visible: this.showMessage,
                active: !1,
              }),
              this.view.setState("txtUserMessage", {
                value: this.message,
                visible: !0,
              }));
          }),
          UserMessageController
        );
      })());
    exports.default = UserMessageController;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0),
      View = (function () {
        function View(parentContainer, onLoad) {
          var _this3 = this,
            template =
              arguments.length > 2 && void 0 !== arguments[2]
                ? arguments[2]
                : {};
          _classCallCheck(this, View),
            (this.pendings = {}),
            (this.binds = { onResize: this.onResize.bind(this) }),
            (this.parentContainer = (0, _libs.$)(parentContainer)),
            (this.isIOS =
              /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream),
            (this.isSafari = /^((?!chrome|android).)*safari/i.test(
              navigator.userAgent
            ));
          var initUrl = this.isSafari ? View.initUrl : void 0;
          this.parentContainer.html(
            '<iframe title="View" style="border: 0;' +
              (this.isIOS ? "" : " width: 65%; height: 100%") +
              '" ' +
              (initUrl ? ' src="' + initUrl + '"' : "") +
              ' scrolling="no"></iframe>'
          ),
            (this.frame = this.parentContainer.find("iframe")[0]);
          var build = function build() {
            _this3.isIOS &&
              ((0, _libs.$)(
                _this3.parentContainer[0].ownerDocument.defaultView
              ).on("resize", _this3.binds.onResize),
              _this3.onResize(),
              setTimeout(_this3.checkIframeSize.bind(_this3), 250)),
              (_this3.container = (0, _libs.$)(
                _this3.frame.contentDocument.body
              )),
              _this3.container.css("margin", "0"),
              (_this3.head = (0, _libs.$)(_this3.frame.contentDocument.head)),
              (_this3.onLoad = onLoad),
              (_this3.handlers = []),
              (_this3.styleData = {});
            var script = template.html
                ? template.script
                : _this3.getTemplate().script,
              urls = void 0,
              files = void 0,
              links = void 0,
              templateName = void 0;
            "function" == typeof template
              ? ((urls = {}),
                (files = template()),
                (links = []),
                (templateName = files.name))
              : ((links = template.links || _this3.getTemplate().links),
                (urls = {
                  styles: template.styles || _this3.getTemplate().styles,
                  html: [template.html || _this3.getTemplate().html],
                  script: script ? [script] : [],
                }),
                (templateName = template.name),
                (files = {})),
              templateName && _this3.container.addClass(templateName),
              _this3
                .loadFiles(urls, files)
                .then(function () {
                  for (
                    var _loop4 = function () {
                        if (_isArray7) {
                          if (_i7 >= _iterator7.length) return "break";
                          _ref7 = _iterator7[_i7++];
                        } else {
                          if (((_i7 = _iterator7.next()), _i7.done))
                            return "break";
                          _ref7 = _i7.value;
                        }
                        var style = _ref7,
                          textCss = style.data,
                          url = style.url;
                        (textCss = textCss.replace(
                          /url\(['"](.*?)["']\)/g,
                          function (r, r1) {
                            return [
                              "url('",
                              _this3.urlResolver(url, r1),
                              "')",
                            ].join("");
                          }
                        )),
                          (0, _libs.$)(
                            '<style type="text/css">' + textCss + "</style>"
                          ).appendTo(_this3.head);
                        var match = textCss.match(
                          /\/\*json-data:(([\n\r]|.)*?)\*\//
                        );
                        if (match)
                          try {
                            _this3.styleData = _extends(
                              {},
                              _this3.styleData,
                              JSON.parse(match[1])
                            );
                          } catch (e) {
                            console.error(e);
                          }
                      },
                      _iterator7 = files.styles,
                      _isArray7 = Array.isArray(_iterator7),
                      _i7 = 0,
                      _iterator7 = _isArray7
                        ? _iterator7
                        : _iterator7[Symbol.iterator]();
                    ;

                  ) {
                    var _ref7,
                      _ret4 = _loop4();
                    if ("break" === _ret4) break;
                  }
                  _this3.container.html(_this3.translate(files.html[0].data)),
                    (_this3.jLinks = []);
                  for (
                    var _iterator8 = links,
                      _isArray8 = Array.isArray(_iterator8),
                      _i8 = 0,
                      _iterator8 = _isArray8
                        ? _iterator8
                        : _iterator8[Symbol.iterator]();
                    ;

                  ) {
                    var _ref8;
                    if (_isArray8) {
                      if (_i8 >= _iterator8.length) break;
                      _ref8 = _iterator8[_i8++];
                    } else {
                      if (((_i8 = _iterator8.next()), _i8.done)) break;
                      _ref8 = _i8.value;
                    }
                    var _link = _ref8;
                    _this3.jLinks.push(
                      (0, _libs.$)(
                        [
                          "<link ",
                          _this3.objToAttrsStr(
                            _extends({}, _link, {
                              href: _this3.urlResolver(
                                _this3.getCurrentUrl(),
                                _link.href
                              ),
                            })
                          ),
                          ">",
                        ].join("")
                      ).appendTo(_this3.head)
                    );
                  }
                  if (files.script[0]) {
                    var init = eval(files.script[0].data);
                    _this3.templateObject = init(_this3.container);
                  } else _this3.templateObject = {};
                  _this3.linkControls = {};
                  for (
                    var _iterator9 = _this3.getLinks(),
                      _isArray9 = Array.isArray(_iterator9),
                      _i9 = 0,
                      _iterator9 = _isArray9
                        ? _iterator9
                        : _iterator9[Symbol.iterator]();
                    ;

                  ) {
                    var _ref9;
                    if (_isArray9) {
                      if (_i9 >= _iterator9.length) break;
                      _ref9 = _iterator9[_i9++];
                    } else {
                      if (((_i9 = _iterator9.next()), _i9.done)) break;
                      _ref9 = _i9.value;
                    }
                    var id = _ref9;
                    (_this3.linkControls[id] = _this3.container.find("." + id)),
                      (_this3.binds[id] = View.handleLinkEvent.bind({
                        getHandlers: _this3.getHandlers.bind(_this3),
                        id: id,
                        ctrl: _this3.linkControls[id],
                      })),
                      _this3.linkControls[id].on("click", _this3.binds[id]);
                  }
                  _this3.widgetControls = {};
                  for (
                    var _iterator10 = _this3.getWidgets(),
                      _isArray10 = Array.isArray(_iterator10),
                      _i10 = 0,
                      _iterator10 = _isArray10
                        ? _iterator10
                        : _iterator10[Symbol.iterator]();
                    ;

                  ) {
                    var _ref10;
                    if (_isArray10) {
                      if (_i10 >= _iterator10.length) break;
                      _ref10 = _iterator10[_i10++];
                    } else {
                      if (((_i10 = _iterator10.next()), _i10.done)) break;
                      _ref10 = _i10.value;
                    }
                    var _id = _ref10;
                    _this3.widgetControls[_id] = _this3.container.find(
                      "." + _id
                    );
                  }
                  _this3.inputControls = {};
                  for (
                    var _iterator11 = _this3.getInputs(),
                      _isArray11 = Array.isArray(_iterator11),
                      _i11 = 0,
                      _iterator11 = _isArray11
                        ? _iterator11
                        : _iterator11[Symbol.iterator]();
                    ;

                  ) {
                    var _ref11;
                    if (_isArray11) {
                      if (_i11 >= _iterator11.length) break;
                      _ref11 = _iterator11[_i11++];
                    } else {
                      if (((_i11 = _iterator11.next()), _i11.done)) break;
                      _ref11 = _i11.value;
                    }
                    var _id2 = _ref11;
                    (_this3.inputControls[_id2] = _this3.container.find(
                      "." + _id2
                    )),
                      (_this3.binds[_id2] = View.handleInputEvent.bind({
                        getHandlers: _this3.getHandlers.bind(_this3),
                        id: _id2,
                        ctrl: _this3.inputControls[_id2],
                      })),
                      _this3.inputControls[_id2].on(
                        "keyup",
                        _this3.binds[_id2]
                      );
                  }
                  _this3.formControls = {};
                  for (
                    var _iterator12 = _this3.getForms(),
                      _isArray12 = Array.isArray(_iterator12),
                      _i12 = 0,
                      _iterator12 = _isArray12
                        ? _iterator12
                        : _iterator12[Symbol.iterator]();
                    ;

                  ) {
                    var _ref12;
                    if (_isArray12) {
                      if (_i12 >= _iterator12.length) break;
                      _ref12 = _iterator12[_i12++];
                    } else {
                      if (((_i12 = _iterator12.next()), _i12.done)) break;
                      _ref12 = _i12.value;
                    }
                    var _id3 = _ref12;
                    (_this3.formControls[_id3] = _this3.container.find(
                      "." + _id3
                    )),
                      (_this3.binds[_id3] = View.handleFormEvent.bind({
                        getHandlers: _this3.getHandlers.bind(_this3),
                        id: _id3,
                        ctrl: _this3.formControls[_id3],
                      })),
                      _this3.formControls[_id3].on(
                        "submit",
                        _this3.binds[_id3]
                      );
                  }
                  _this3.textControls = {};
                  for (
                    var _iterator13 = _this3.getTexts(),
                      _isArray13 = Array.isArray(_iterator13),
                      _i13 = 0,
                      _iterator13 = _isArray13
                        ? _iterator13
                        : _iterator13[Symbol.iterator]();
                    ;

                  ) {
                    var _ref13;
                    if (_isArray13) {
                      if (_i13 >= _iterator13.length) break;
                      _ref13 = _iterator13[_i13++];
                    } else {
                      if (((_i13 = _iterator13.next()), _i13.done)) break;
                      _ref13 = _i13.value;
                    }
                    var _id4 = _ref13;
                    _this3.textControls[_id4] = _this3.container.find(
                      "." + _id4
                    );
                  }
                  (_this3.stateSetters = [
                    {
                      map: _this3.linkControls,
                      setter: _this3.setLinkControlState.bind(_this3),
                    },
                    {
                      map: _this3.widgetControls,
                      setter: _this3.setWidgetControlState.bind(_this3),
                    },
                    {
                      map: _this3.inputControls,
                      setter: _this3.setInputControlState.bind(_this3),
                    },
                    {
                      map: _this3.textControls,
                      setter: _this3.setTextControlState.bind(_this3),
                    },
                  ]),
                    _this3.initView(),
                    _this3.onLoad && _this3.onLoad(),
                    _this3.fireLinksOnLoadEvent();
                })
                .catch(function (res) {
                  return console.error(res);
                });
          };
          initUrl
            ? (0, _libs.$)(this.frame.contentWindow).on("load", build)
            : (this.frame.contentWindow.stop && this.frame.contentWindow.stop(),
              build());
        }
        return (
          (View.classProperty = function (ctrl, className, value) {
            value ? ctrl.addClass(className) : ctrl.removeClass(className);
          }),
          (View.attributeProperty = function (ctrl, attributeName, value) {
            value
              ? ctrl.attr(attributeName, value)
              : ctrl.removeAttr(attributeName);
          }),
          (View.callHandlers = function (handlers, id, e, data) {
            for (
              var _iterator = handlers,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              var handler = _ref;
              handler[id]
                ? handler[id](e, data)
                : handler.handleDefault && handler.handleDefault(id, e, data);
            }
          }),
          (View.handleEvent = function (id, getHandlers, e, data) {
            View.callHandlers(getHandlers(id), id, e, data);
          }),
          (View.handleLinkEvent = function (e) {
            e.preventDefault(),
              this.ctrl.hasClass("disabled") ||
                View.handleEvent(this.id, this.getHandlers, e);
          }),
          (View.handleInputEvent = function (e) {
            View.handleEvent(this.id, this.getHandlers, e, e.target.value);
          }),
          (View.handleFormEvent = function (e) {
            e.preventDefault(), View.handleEvent(this.id, this.getHandlers, e);
          }),
          (View.prototype.getLinks = function () {
            return null;
          }),
          (View.prototype.getWidgets = function () {
            return null;
          }),
          (View.prototype.getInputs = function () {
            return null;
          }),
          (View.prototype.getTexts = function () {
            return null;
          }),
          (View.prototype.getTemplate = function () {
            return {};
          }),
          (View.prototype.getHandlers = function (id) {
            return this.handlers;
          }),
          (View.prototype.callLater = function (handlers, id, e, data, ms) {
            var _this = this;
            (this.pendings[id] = { timestamp: new Date().getTime() }),
              setTimeout(function () {
                var timestamp = new Date().getTime(),
                  pending = _this.pendings[id];
                pending &&
                  timestamp - pending.timestamp >= ms &&
                  (View.callHandlers(handlers, id, e, data),
                  delete _this.pendings[id]);
              }, ms);
          }),
          (View.prototype.loadFiles = function (urls, files) {
            for (
              var tasks = [],
                _iterator2 = Object.keys(urls),
                _isArray2 = Array.isArray(_iterator2),
                _i2 = 0,
                _iterator2 = _isArray2
                  ? _iterator2
                  : _iterator2[Symbol.iterator]();
              ;

            ) {
              var _ref2;
              if (
                "break" ===
                (function () {
                  if (_isArray2) {
                    if (_i2 >= _iterator2.length) return "break";
                    _ref2 = _iterator2[_i2++];
                  } else {
                    if (((_i2 = _iterator2.next()), _i2.done)) return "break";
                    _ref2 = _i2.value;
                  }
                  var name = _ref2;
                  files[name] = [];
                  for (
                    var _iterator3 = urls[name],
                      _isArray3 = Array.isArray(_iterator3),
                      _i3 = 0,
                      _iterator3 = _isArray3
                        ? _iterator3
                        : _iterator3[Symbol.iterator]();
                    ;

                  ) {
                    var _ref3;
                    if (
                      "break" ===
                      (function () {
                        if (_isArray3) {
                          if (_i3 >= _iterator3.length) return "break";
                          _ref3 = _iterator3[_i3++];
                        } else {
                          if (((_i3 = _iterator3.next()), _i3.done))
                            return "break";
                          _ref3 = _i3.value;
                        }
                        var url = _ref3;
                        tasks.push(
                          new Promise(function (resolve, reject) {
                            _libs.$.get(url, function (data) {
                              files[name].push({ url: url, data: data }),
                                resolve();
                            }).fail(function (res) {
                              reject(res);
                            });
                          })
                        );
                      })()
                    )
                      break;
                  }
                })()
              )
                break;
            }
            return Promise.all(tasks);
          }),
          (View.prototype.getRootUrl = function () {
            return location.origin + "/";
          }),
          (View.prototype.getCurrentUrl = function () {
            return location.href.substr(0, location.href.lastIndexOf("/") + 1);
          }),
          (View.prototype.urlResolver = function (baseUrl, url) {
            if (
              ((url = url.replace(/\\/g, "/")),
              "/" === url.charAt(0) &&
                ((baseUrl = this.getRootUrl()), (url = url.substr(1))),
              baseUrl.match(/^https{0,1}:/i) ||
                (baseUrl = this.urlResolver(this.getCurrentUrl(), baseUrl)),
              !url.match(/^(data|blob|http|https):/i))
            ) {
              baseUrl = baseUrl.replace(/\\/g, "/");
              var p = baseUrl.lastIndexOf("/");
              url = (~p ? baseUrl.substr(0, p + 1) : "") + url;
              var parts = url.split("/");
              url = [];
              for (
                var _iterator4 = parts,
                  _isArray4 = Array.isArray(_iterator4),
                  _i4 = 0,
                  _iterator4 = _isArray4
                    ? _iterator4
                    : _iterator4[Symbol.iterator]();
                ;

              ) {
                var _ref4;
                if (_isArray4) {
                  if (_i4 >= _iterator4.length) break;
                  _ref4 = _iterator4[_i4++];
                } else {
                  if (((_i4 = _iterator4.next()), _i4.done)) break;
                  _ref4 = _i4.value;
                }
                var part = _ref4;
                "." === part ||
                  (".." === part
                    ? url.length > 3 && url.pop()
                    : url.push(part));
              }
              url = url.join("/");
            }
            return url;
          }),
          (View.prototype.objToAttrsStr = function (o) {
            for (
              var res = [],
                _iterator5 = Object.keys(o),
                _isArray5 = Array.isArray(_iterator5),
                _i5 = 0,
                _iterator5 = _isArray5
                  ? _iterator5
                  : _iterator5[Symbol.iterator]();
              ;

            ) {
              var _ref5;
              if (_isArray5) {
                if (_i5 >= _iterator5.length) break;
                _ref5 = _iterator5[_i5++];
              } else {
                if (((_i5 = _iterator5.next()), _i5.done)) break;
                _ref5 = _i5.value;
              }
              var _name = _ref5;
              res.push([_name, '="', o[_name], '"'].join(""));
            }
            return res.join(" ");
          }),
          (View.prototype.checkIframeSize = function () {
            this.frame &&
              ((Math.abs(this.frame.width - this.parentContainer.width()) > 1 ||
                Math.abs(this.frame.height - this.parentContainer.height()) >
                  1) &&
                this.onResize(),
              setTimeout(this.checkIframeSize.bind(this), 250));
          }),
          (View.prototype.onResize = function () {
            (this.frame.width = this.parentContainer.width()),
              (this.frame.height = this.parentContainer.height());
          }),
          (View.prototype.translate = function (html) {
            return html.replace(/<\$tr>(.*)<\/\$tr>/gi, function (s0, s1) {
              return (0, _libs.tr)(s1);
            });
          }),
          (View.prototype.fireLinksOnLoadEvent = function () {
            var _this2 = this;
            if (this.templateObject && this.templateObject.linkLoaded)
              for (
                var _iterator6 = this.jLinks,
                  _isArray6 = Array.isArray(_iterator6),
                  _i6 = 0,
                  _iterator6 = _isArray6
                    ? _iterator6
                    : _iterator6[Symbol.iterator]();
                ;

              ) {
                var _ref6,
                  _ret3 = (function () {
                    if (_isArray6) {
                      if (_i6 >= _iterator6.length) return "break";
                      _ref6 = _iterator6[_i6++];
                    } else {
                      if (((_i6 = _iterator6.next()), _i6.done)) return "break";
                      _ref6 = _i6.value;
                    }
                    var jLink = _ref6,
                      link = jLink[0],
                      img = new Image();
                    (img.onerror = function () {
                      return _this2.templateObject.linkLoaded(link);
                    }),
                      (img.src = link.href);
                  })();
                if ("break" === _ret3) break;
              }
          }),
          (View.prototype.dispose = function () {
            delete this.textControls;
            for (
              var _iterator14 = this.getLinks(),
                _isArray14 = Array.isArray(_iterator14),
                _i14 = 0,
                _iterator14 = _isArray14
                  ? _iterator14
                  : _iterator14[Symbol.iterator]();
              ;

            ) {
              var _ref14;
              if (_isArray14) {
                if (_i14 >= _iterator14.length) break;
                _ref14 = _iterator14[_i14++];
              } else {
                if (((_i14 = _iterator14.next()), _i14.done)) break;
                _ref14 = _i14.value;
              }
              var id = _ref14;
              this.linkControls[id].off("click", this.binds[id]);
            }
            delete this.linkControls, delete this.widgetControls;
            for (
              var _iterator15 = this.getInputs(),
                _isArray15 = Array.isArray(_iterator15),
                _i15 = 0,
                _iterator15 = _isArray15
                  ? _iterator15
                  : _iterator15[Symbol.iterator]();
              ;

            ) {
              var _ref15;
              if (_isArray15) {
                if (_i15 >= _iterator15.length) break;
                _ref15 = _iterator15[_i15++];
              } else {
                if (((_i15 = _iterator15.next()), _i15.done)) break;
                _ref15 = _i15.value;
              }
              var _id5 = _ref15;
              this.inputControls[_id5].off("keyup", this.binds[_id5]);
            }
            delete this.inputControls;
            for (
              var _iterator16 = this.getForms(),
                _isArray16 = Array.isArray(_iterator16),
                _i16 = 0,
                _iterator16 = _isArray16
                  ? _iterator16
                  : _iterator16[Symbol.iterator]();
              ;

            ) {
              var _ref16;
              if (_isArray16) {
                if (_i16 >= _iterator16.length) break;
                _ref16 = _iterator16[_i16++];
              } else {
                if (((_i16 = _iterator16.next()), _i16.done)) break;
                _ref16 = _i16.value;
              }
              var _id6 = _ref16;
              this.formControls[_id6].off("submit", this.binds[_id6]);
            }
            delete this.formControls,
              !this.templateObject.dispose || this.templateObject.dispose(),
              delete this.templateObject,
              this.isIOS &&
                (0, _libs.$)(
                  this.parentContainer[0].ownerDocument.defaultView
                ).off("resize", this.binds.onResize),
              this.parentContainer.html(""),
              delete this.frame;
          }),
          (View.prototype.getStyleData = function () {
            return this.styleData;
          }),
          (View.prototype.getContainer = function () {
            return this.container[0];
          }),
          (View.prototype.getParentContainer = function () {
            return this.parentContainer[0];
          }),
          (View.prototype.addHandler = function (handler) {
            this.handlers.push(handler);
          }),
          (View.prototype.initView = function () {}),
          (View.setControlState = function (
            ctrl,
            defaults,
            state,
            stateHandlers
          ) {
            if (ctrl && ctrl[0]) {
              var st = _extends({}, defaults, state);
              for (var _name2 in st)
                st.hasOwnProperty(_name2) &&
                  stateHandlers[_name2] &&
                  stateHandlers[_name2](ctrl, st[_name2]);
            }
          }),
          (View.prototype.setLinkControlState = function (id, state) {
            View.setControlState(
              this.linkControls[id],
              { visible: !0, active: !1, enable: !0 },
              state,
              View.linkStateHandlers
            );
          }),
          (View.prototype.setWidgetControlState = function (id, state) {
            View.setControlState(
              this.widgetControls[id],
              { visible: !0, active: !1, enable: !0 },
              state,
              View.widgetStateHandlers
            );
          }),
          (View.prototype.setInputControlState = function (id, state) {
            View.setControlState(
              this.inputControls[id],
              { visible: !0, enable: !0, value: "" },
              state,
              View.inputStateHandlers
            );
          }),
          (View.prototype.setTextControlState = function (id, state) {
            View.setControlState(
              this.textControls[id],
              { visible: !0, value: "" },
              state,
              View.textStateHandlers
            );
          }),
          (View.prototype.onItemStateChanged = function () {}),
          (View.prototype.setState = function (id, state) {
            for (
              var _iterator17 = this.stateSetters,
                _isArray17 = Array.isArray(_iterator17),
                _i17 = 0,
                _iterator17 = _isArray17
                  ? _iterator17
                  : _iterator17[Symbol.iterator]();
              ;

            ) {
              var _ref17;
              if (_isArray17) {
                if (_i17 >= _iterator17.length) break;
                _ref17 = _iterator17[_i17++];
              } else {
                if (((_i17 = _iterator17.next()), _i17.done)) break;
                _ref17 = _i17.value;
              }
              var item = _ref17;
              if (item.map[id]) {
                item.setter(id, state), this.onItemStateChanged(id, state);
                break;
              }
            }
          }),
          View
        );
      })();
    (View.initUrl = URL.createObjectURL(
      new Blob(
        [
          '\n    <!DOCTYPE html>\n    <html lang="en">\n      <head>\n        <meta charset="utf-8">\n      </head>\n      <body style="height: 100vh">\n      </body>\n    </html>\n  ',
        ],
        { type: "text/html" }
      )
    )),
      (View.linkStateHandlers = {
        visible: function (ctrl, value) {
          return View.classProperty(ctrl, "hidden", !value);
        },
        active: function (ctrl, value) {
          return View.classProperty(ctrl, "active", value);
        },
        enable: function (ctrl, value) {
          return View.classProperty(ctrl, "disabled", !value);
        },
      }),
      (View.widgetStateHandlers = {
        visible: function (ctrl, value) {
          return View.classProperty(ctrl, "hidden", !value);
        },
        active: function (ctrl, value) {
          return View.classProperty(ctrl, "active", value);
        },
        enable: function (ctrl, value) {
          return View.classProperty(ctrl, "disabled", !value);
        },
      }),
      (View.inputStateHandlers = {
        visible: function (ctrl, value) {
          return View.classProperty(ctrl, "hidden", !value);
        },
        value: function (ctrl, _value) {
          return (ctrl[0].value = _value);
        },
        enable: function (ctrl, value) {
          return View.attributeProperty(ctrl, "disabled", !value);
        },
      }),
      (View.textStateHandlers = {
        visible: function (ctrl, value) {
          return View.classProperty(ctrl, "hidden", !value);
        },
        value: function (ctrl, _value2) {
          return ctrl.html(_value2);
        },
      }),
      (exports.default = View);
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _extends =
        Object.assign ||
        function (target) {
          for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            for (var key in source)
              Object.prototype.hasOwnProperty.call(source, key) &&
                (target[key] = source[key]);
          }
          return target;
        },
      _libs = __webpack_require__(0),
      _Utils = __webpack_require__(3),
      _Utils2 = _interopRequireDefault(_Utils),
      _Orbit = __webpack_require__(59),
      _Orbit2 = _interopRequireDefault(_Orbit),
      _ThreeMouseEventConverter = __webpack_require__(64),
      _ThreeMouseEventConverter2 = _interopRequireDefault(
        _ThreeMouseEventConverter
      ),
      _ThreeTouchEventConverter = __webpack_require__(65),
      _ThreeTouchEventConverter2 = _interopRequireDefault(
        _ThreeTouchEventConverter
      ),
      _Drag = __webpack_require__(51),
      _Drag2 = _interopRequireDefault(_Drag),
      _CSS3DRenderer = __webpack_require__(12),
      _CSS3DRenderer2 = _interopRequireDefault(_CSS3DRenderer),
      VisualWorld = (function (_THREE$EventDispatche) {
        function VisualWorld(wnd, doc, container) {
          var useHelpers =
            arguments.length > 3 && void 0 !== arguments[3] && arguments[3];
          _classCallCheck(this, VisualWorld);
          var _this = _possibleConstructorReturn(
            this,
            _THREE$EventDispatche.call(this)
          );
          (_this.checkUpdateFlag = !0),
            (_this.wnd = wnd),
            (_this.doc = doc),
            (_this.jContainer = container),
            (_this.renderCallbacks = []),
            (_this.diag = _this.getDiag()),
            (_this.clock = new _libs.THREE.Clock()),
            (_this.raycaster = new _libs.THREE.Raycaster()),
            (_this.scene = new _libs.THREE.Scene()),
            (_this.cssScene = new _libs.THREE.Scene()),
            (_this.camera = new _libs.THREE.PerspectiveCamera(
              30,
              _this.width() / _this.height(),
              0.2,
              2e3
            ));
          (_this.camera.position.x = 0),
            (_this.camera.position.y = 5.5),
            (_this.camera.position.z = 0),
            (_this.renderer = new _libs.THREE.WebGLRenderer({
              alpha: !0,
              precision: VisualWorld.getPrecision(),
              antialias: !0,
            })),
            (_this.renderer.shadowMap.enabled = !0),
            (_this.renderer.shadowMap.type = _libs.THREE.PCFSoftShadowMap),
            _this.renderer.setClearColor(0, 0),
            _this.renderer.setPixelRatio(
              Math.sqrt(_this.wnd.devicePixelRatio || 1)
            ),
            _this.renderer.setSize(_this.width(), _this.height()),
            _this.jContainer.append(_this.renderer.domElement),
            (_this.cssRenderer = new _CSS3DRenderer2.default()),
            _this.cssRenderer.setSize(_this.width(), _this.height()),
            (0, _libs.$)(_this.cssRenderer.domElement).css({
              position: "absolute",
              top: 0,
              margin: 0,
              padding: 0,
            }),
            _this.jContainer.append(_this.cssRenderer.domElement),
            (_this.element = _this.cssRenderer.domElement),
            (_this.textureLoader = new _libs.THREE.TextureLoader()),
            (_this.ambientLight = new _libs.THREE.AmbientLight(16777215)),
            _this.scene.add(_this.ambientLight),
            (_this.light = new _libs.THREE.DirectionalLight(0, 1)),
            _this.light.position.set(-6, 6, -3);
          (_this.light.castShadow = !0),
            (_this.light.shadow.camera.left = -3),
            (_this.light.shadow.camera.right = 3),
            (_this.light.shadow.camera.top = 3),
            (_this.light.shadow.camera.bottom = -3),
            (_this.light.shadow.camera.near = 0.5),
            (_this.light.shadow.camera.far = 20),
            (_this.light.shadow.mapSize.x = 512),
            (_this.light.shadow.mapSize.y = 512),
            _this.scene.add(_this.light),
            (_this.shadowPlace = new _libs.THREE.Mesh(
              new _libs.THREE.PlaneGeometry(10, 10).rotateX(-Math.PI / 2),
              new _libs.THREE.ShadowMaterial({
                color: 0,
                transparent: !0,
                opacity: 0.2,
              })
            )),
            _this.shadowPlace.position.set(0, 0, 0),
            (_this.shadowPlace.receiveShadow = !0),
            (_this.shadowPlace.castShadow = !1),
            _this.scene.add(_this.shadowPlace),
            (_this.controls = new _Orbit2.default(_this.camera, _this)),
            (_this.controls.target.y = 0.5);
          var cssScene = (0, _libs.$)(_this.cssRenderer.domElement).find("div"),
            tmpVector = new _libs.THREE.Vector3();
          _this.controls.addEventListener("change", function () {
            _this.camera.getWorldDirection(tmpVector),
              cssScene.css(
                "display",
                tmpVector.y - _this.camera.position.y > 0 ? "none" : "block"
              ),
              _this.updateThree();
          }),
            useHelpers && _this.scene.add(new _libs.THREE.AxisHelper(5)),
            (_this.binds = {
              onWindowResize: _this.onWindowResize.bind(_this),
              animate: _this.animate.bind(_this),
            }),
            (0, _libs.$)(_this.wnd).on("resize", _this.binds.onWindowResize),
            (_this.mouseEvents = new _ThreeMouseEventConverter2.default(
              _this.wnd,
              _this.doc,
              _this
            )),
            (_this.touchEvents = new _ThreeTouchEventConverter2.default(
              _this.wnd,
              _this.doc,
              _this
            ));
          var filterData = { type: "mousemove" };
          return (
            (_this.mouseEvents.filter = function (element, e) {
              var types = ["mouseenter", "mouseover", "mouseleave", "mouseout"],
                contains = function (p, c) {
                  return p === c || _libs.$.contains(p, c);
                };
              return (
                "mousemove" === e.type &&
                  ((filterData.pageX = e.pageX), (filterData.pageY = e.pageY)),
                e.relatedTarget &&
                ~types.indexOf(e.type) &&
                contains(element, e.target) &&
                contains(element, e.relatedTarget)
                  ? _extends({}, e, filterData)
                  : e
              );
            }),
            (_this.drag = new _Drag2.default(_this.wnd, _this.doc, _this)),
            _this.onWindowResize(),
            _this.animate(),
            _this
          );
        }
        return (
          _inherits(VisualWorld, _THREE$EventDispatche),
          (VisualWorld.prototype.getDiag = function () {
            var test = (0, _libs.$)(
                '<div style="height: 1in; width: 1in; display: none;"></div>'
              ).appendTo(this.jContainer),
              r = new _libs.THREE.Vector2(
                screen.width / test.width(),
                screen.height / test.height()
              );
            return test.remove(), r.length();
          }),
          (VisualWorld.prototype.updateThree = function () {
            this.light.userData.needsUpdate = !0;
          }),
          (VisualWorld.prototype.setLight = function (ambient, directional) {
            this.ambientLight.color.set(ambient),
              this.light.color.set(directional),
              this.updateThree();
          }),
          (VisualWorld.prototype.dispose = function () {
            delete this.binds.animate,
              (0, _libs.$)(this.wnd).off("resize", this.binds.onWindowResize),
              this.mouseEvents.dispose(),
              this.touchEvents.dispose(),
              this.drag.dispose(),
              this.controls.dispose();
          }),
          (VisualWorld.prototype.width = function () {
            return this.jContainer.width() || 200;
          }),
          (VisualWorld.prototype.height = function () {
            return this.jContainer.height() || 200;
          }),
          (VisualWorld.prototype.setExtraLighting = function (v) {
            this.light.intensity = v;
          }),
          (VisualWorld.prototype.isMobile = function () {
            return this.diag < _Utils2.default.MOBILE_DIAG;
          }),
          (VisualWorld.prototype.getOrbit = function () {
            return this.controls;
          }),
          (VisualWorld.prototype.setControlsState = function (state) {
            this.controls.enabled = state;
          }),
          (VisualWorld.prototype.getControlsState = function () {
            return this.controls.enabled;
          }),
          (VisualWorld.prototype.onWindowResize = function () {
            var _this2 = this,
              width = this.width(),
              height = this.height();
            if (width > 1 && height > 1) {
              var updateCamera = function (camera) {
                  (camera.aspect = width / height),
                    camera.updateProjectionMatrix();
                },
                updateRenderer = function (renderer) {
                  renderer.setSize(width, height);
                };
              if (
                !this.lastResize ||
                Math.abs(this.lastResize.width - width) +
                  Math.abs(this.lastResize.height - height) >
                  1
              ) {
                this.lastResize = { width: width, height: height };
                var resizeStamp = (this.resizeStamp = Date.now());
                setTimeout(function () {
                  resizeStamp === _this2.resizeStamp &&
                    (updateCamera(_this2.camera),
                    updateRenderer(_this2.renderer),
                    updateRenderer(_this2.cssRenderer),
                    _this2.updateThree(),
                    _this2.dispatchEvent({ type: "resize" }));
                }, 10);
              }
            } else
              setTimeout(function () {
                _this2.onWindowResize();
              }, 250);
          }),
          (VisualWorld.prototype.addObject = function (object) {
            this.scene.add(object);
          }),
          (VisualWorld.prototype.addCssObject = function (object) {
            this.cssScene.add(object);
          }),
          (VisualWorld.prototype.removeCssObject = function (object) {
            this.cssScene.remove(object);
          }),
          (VisualWorld.prototype.removeObject = function (object) {
            this.scene.remove(object);
          }),
          (VisualWorld.prototype.animate = function () {
            this.binds.animate && requestAnimationFrame(this.binds.animate),
              this.render();
          }),
          (VisualWorld.prototype.addRenderCallback = function (clb) {
            this.renderCallbacks.push(clb);
          }),
          (VisualWorld.prototype.removeRenderCallback = function (clb) {
            var i = this.renderCallbacks.indexOf(clb);
            ~i && this.renderCallbacks.splice(i, 1);
          }),
          (VisualWorld.prototype.render = function () {
            var deltaTime = Math.min(this.clock.getDelta(), 0.034);
            this.controls.update(deltaTime);
            for (
              var _iterator = this.renderCallbacks,
                _isArray = Array.isArray(_iterator),
                _i = 0,
                _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();
              ;

            ) {
              var _ref;
              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                if (((_i = _iterator.next()), _i.done)) break;
                _ref = _i.value;
              }
              _ref(deltaTime);
            }
            this.cssRenderer.render(this.cssScene, this.camera);
            var render = !0;
            if (this.checkUpdateFlag) {
              render = !1;
              for (
                var _iterator2 = this.scene.children,
                  _isArray2 = Array.isArray(_iterator2),
                  _i2 = 0,
                  _iterator2 = _isArray2
                    ? _iterator2
                    : _iterator2[Symbol.iterator]();
                ;

              ) {
                var _ref2;
                if (_isArray2) {
                  if (_i2 >= _iterator2.length) break;
                  _ref2 = _iterator2[_i2++];
                } else {
                  if (((_i2 = _iterator2.next()), _i2.done)) break;
                  _ref2 = _i2.value;
                }
                var o = _ref2;
                (render = render || o.userData.needsUpdate),
                  (o.userData.needsUpdate = !1);
              }
            }
            render && this.renderer.render(this.scene, this.camera);
          }),
          (VisualWorld.getPrecision = function () {
            var scene = new _libs.THREE.Scene();
            scene.add(new _libs.THREE.AmbientLight(16777215));
            var camera = new _libs.THREE.PerspectiveCamera(30, 1, 1, 100);
            camera.position.set(0, 0, 1), camera.lookAt(0, 0, 0);
            var renderer = new _libs.THREE.WebGLRenderer();
            renderer.setClearColor(16777215), renderer.setSize(1, 1);
            var c = document.createElement("canvas"),
              ctx = c.getContext("2d");
            (c.width = c.height = 1),
              (ctx.fillStyle = "#ff0000"),
              ctx.fillRect(0, 0, c.width, c.height);
            var t = new _libs.THREE.Texture(c);
            (t.needsUpdate = !0),
              scene.add(
                new _libs.THREE.Mesh(
                  new _libs.THREE.PlaneGeometry(1, 1, 1, 1),
                  new _libs.THREE.MeshPhongMaterial({ map: t })
                )
              ),
              renderer.render(scene, camera);
            var p = (function (c, x, y) {
              var ps = new Uint8Array(4);
              return c.readPixels(x, y, 1, 1, c.RGBA, c.UNSIGNED_BYTE, ps), ps;
            })(
              renderer.domElement.getContext("webgl") ||
                renderer.domElement.getContext("experimental-webgl"),
              0,
              0
            );
            return 255 === p[0] && 0 === p[1] && 0 === p[2]
              ? "highp"
              : "mediump";
          }),
          VisualWorld
        );
      })(_libs.THREE.EventDispatcher);
    exports.default = VisualWorld;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    exports.__esModule = !0;
    var YouTubeApi = (function () {
      function YouTubeApi() {
        _classCallCheck(this, YouTubeApi);
      }
      return (
        (YouTubeApi.init = function () {
          return (
            YouTubeApi.task ||
              (YouTubeApi.task = new Promise(function (resolve) {
                window.YT || (window.YT = { loading: 0, loaded: 0 }),
                  window.YTConfig ||
                    (window.YTConfig = { host: "http://www.youtube.com" }),
                  YT.loading ||
                    ((YT.loading = 1),
                    (function () {
                      var l = [];
                      (YT.ready = function (f) {
                        YT.loaded ? f() : l.push(f);
                      }),
                        (window.onYTReady = function () {
                          YT.loaded = 1;
                          for (var i = 0; i < l.length; i++)
                            try {
                              l[i]();
                            } catch (e) {}
                          resolve();
                        }),
                        (YT.setConfig = function (c) {
                          for (var k in c)
                            c.hasOwnProperty(k) && (YTConfig[k] = c[k]);
                        });
                      var a = document.createElement("script");
                      (a.type = "text/javascript"),
                        (a.id = "www-widgetapi-script"),
                        (a.src =
                          "https://s.ytimg.com/yts/jsbin/www-widgetapi-vfldn1jRM/www-widgetapi.js"),
                        (a.async = !1);
                      var c = document.currentScript;
                      if (c) {
                        var n = c.nonce || c.getAttribute("nonce");
                        n && a.setAttribute("nonce", n);
                      }
                      var b = document.getElementsByTagName("script")[0];
                      b.parentNode.insertBefore(a, b);
                    })());
              })),
            YouTubeApi.task
          );
        }),
        YouTubeApi
      );
    })();
    exports.default = YouTubeApi;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _Target2 = __webpack_require__(23),
      _Target3 = (function (obj) {
        return obj && obj.__esModule ? obj : { default: obj };
      })(_Target2),
      CircleTarget = (function (_Target) {
        function CircleTarget(x, y, r) {
          _classCallCheck(this, CircleTarget);
          var _this = _possibleConstructorReturn(this, _Target.call(this));
          return (_this.p = { x: x, y: y, r: r }), _this;
        }
        return (
          _inherits(CircleTarget, _Target),
          (CircleTarget.prototype.testIntersection = function (e, data) {
            var res = void 0,
              x = data.x,
              y = data.y,
              p = this.p;
            return (
              (x - p.x) * (x - p.x) + (y - p.y) * (y - p.y) <= p.r * p.r &&
                (res = { target: this, data: data }),
              res
            );
          }),
          CircleTarget
        );
      })(_Target3.default);
    exports.default = CircleTarget;
  },
  function (module, exports, __webpack_require__) {
    "use strict";
    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : { default: obj };
    }
    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function");
    }
    function _possibleConstructorReturn(self, call) {
      if (!self)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !call || ("object" != typeof call && "function" != typeof call)
        ? self
        : call;
    }
    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass)
        throw new TypeError(
          "Super expression must either be null or a function, not " +
            typeof superClass
        );
      (subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          enumerable: !1,
          writable: !0,
          configurable: !0,
        },
      })),
        superClass &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(subClass, superClass)
            : (subClass.__proto__ = superClass));
    }
    exports.__esModule = !0;
    var _Target2 = __webpack_require__(23),
      _Target3 = _interopRequireDefault(_Target2),
      _BaseMathUtils = __webpack_require__(2),
      _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils),
      PolyTarget = (function (_Target) {
        function PolyTarget(poly) {
          _classCallCheck(this, PolyTarget);
          var _this = _possibleConstructorReturn(this, _Target.call(this));
          return (_this.poly = poly), _this;
        }
        return (
          _inherits(PolyTarget, _Target),
          (PolyTarget.prototype.testIntersection = function (e, p) {
            return _BaseMathUtils2.default.isInsidePoly(this.poly, p)
              ? { target: this, data: p }
              : void 0;
          }),
          PolyTarget
        );
      })(_Target3.default);
    exports.default = PolyTarget;
  },
  function (module, exports, __webpack_require__) {
    var define = !1;
    /*!
     * jQuery Mousewheel 3.1.13
     *
     * Copyright jQuery Foundation and other contributors
     * Released under the MIT license
     * http://jquery.org/license
     */
    !(function (factory) {
      "function" == typeof define && define.amd
        ? define(["jquery"], factory)
        : (module.exports = factory);
    })(function ($) {
      function handler(event) {
        var orgEvent = event || window.event,
          args = slice.call(arguments, 1),
          delta = 0,
          deltaX = 0,
          deltaY = 0,
          absDelta = 0,
          offsetX = 0,
          offsetY = 0;
        if (
          ((event = $.event.fix(orgEvent)),
          (event.type = "mousewheel"),
          "detail" in orgEvent && (deltaY = -1 * orgEvent.detail),
          "wheelDelta" in orgEvent && (deltaY = orgEvent.wheelDelta),
          "wheelDeltaY" in orgEvent && (deltaY = orgEvent.wheelDeltaY),
          "wheelDeltaX" in orgEvent && (deltaX = -1 * orgEvent.wheelDeltaX),
          "axis" in orgEvent &&
            orgEvent.axis === orgEvent.HORIZONTAL_AXIS &&
            ((deltaX = -1 * deltaY), (deltaY = 0)),
          (delta = 0 === deltaY ? deltaX : deltaY),
          "deltaY" in orgEvent &&
            ((deltaY = -1 * orgEvent.deltaY), (delta = deltaY)),
          "deltaX" in orgEvent &&
            ((deltaX = orgEvent.deltaX), 0 === deltaY && (delta = -1 * deltaX)),
          0 !== deltaY || 0 !== deltaX)
        ) {
          if (1 === orgEvent.deltaMode) {
            var lineHeight = $.data(this, "mousewheel-line-height");
            (delta *= lineHeight),
              (deltaY *= lineHeight),
              (deltaX *= lineHeight);
          } else if (2 === orgEvent.deltaMode) {
            var pageHeight = $.data(this, "mousewheel-page-height");
            (delta *= pageHeight),
              (deltaY *= pageHeight),
              (deltaX *= pageHeight);
          }
          if (
            ((absDelta = Math.max(Math.abs(deltaY), Math.abs(deltaX))),
            (!lowestDelta || absDelta < lowestDelta) &&
              ((lowestDelta = absDelta),
              shouldAdjustOldDeltas(orgEvent, absDelta) && (lowestDelta /= 40)),
            shouldAdjustOldDeltas(orgEvent, absDelta) &&
              ((delta /= 40), (deltaX /= 40), (deltaY /= 40)),
            (delta = Math[delta >= 1 ? "floor" : "ceil"](delta / lowestDelta)),
            (deltaX = Math[deltaX >= 1 ? "floor" : "ceil"](
              deltaX / lowestDelta
            )),
            (deltaY = Math[deltaY >= 1 ? "floor" : "ceil"](
              deltaY / lowestDelta
            )),
            special.settings.normalizeOffset && this.getBoundingClientRect)
          ) {
            var boundingRect = this.getBoundingClientRect();
            (offsetX = event.clientX - boundingRect.left),
              (offsetY = event.clientY - boundingRect.top);
          }
          return (
            (event.deltaX = deltaX),
            (event.deltaY = deltaY),
            (event.deltaFactor = lowestDelta),
            (event.offsetX = offsetX),
            (event.offsetY = offsetY),
            (event.deltaMode = 0),
            args.unshift(event, delta, deltaX, deltaY),
            nullLowestDeltaTimeout && clearTimeout(nullLowestDeltaTimeout),
            (nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200)),
            ($.event.dispatch || $.event.handle).apply(this, args)
          );
        }
      }
      function nullLowestDelta() {
        lowestDelta = null;
      }
      function shouldAdjustOldDeltas(orgEvent, absDelta) {
        return (
          special.settings.adjustOldDeltas &&
          "mousewheel" === orgEvent.type &&
          absDelta % 120 == 0
        );
      }
      var nullLowestDeltaTimeout,
        lowestDelta,
        toFix = [
          "wheel",
          "mousewheel",
          "DOMMouseScroll",
          "MozMousePixelScroll",
        ],
        toBind =
          "onwheel" in document || document.documentMode >= 9
            ? ["wheel"]
            : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
        slice = Array.prototype.slice;
      if ($.event.fixHooks)
        for (var i = toFix.length; i; )
          $.event.fixHooks[toFix[--i]] = $.event.mouseHooks;
      var special = ($.event.special.mousewheel = {
        version: "3.1.12",
        setup: function () {
          if (this.addEventListener)
            for (var i = toBind.length; i; )
              this.addEventListener(toBind[--i], handler, !1);
          else this.onmousewheel = handler;
          $.data(this, "mousewheel-line-height", special.getLineHeight(this)),
            $.data(this, "mousewheel-page-height", special.getPageHeight(this));
        },
        teardown: function () {
          if (this.removeEventListener)
            for (var i = toBind.length; i; )
              this.removeEventListener(toBind[--i], handler, !1);
          else this.onmousewheel = null;
          $.removeData(this, "mousewheel-line-height"),
            $.removeData(this, "mousewheel-page-height");
        },
        getLineHeight: function (elem) {
          var $elem = $(elem),
            $parent =
              $elem["offsetParent" in $.fn ? "offsetParent" : "parent"]();
          return (
            $parent.length || ($parent = $("body")),
            parseInt($parent.css("fontSize"), 10) ||
              parseInt($elem.css("fontSize"), 10) ||
              16
          );
        },
        getPageHeight: function (elem) {
          return $(elem).height();
        },
        settings: { adjustOldDeltas: !0, normalizeOffset: !0 },
      });
      $.fn.extend({
        mousewheel: function (fn) {
          return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
        },
        unmousewheel: function (fn) {
          return this.unbind("mousewheel", fn);
        },
      });
    });
  },
  function (module, exports, __webpack_require__) {
    !(function (f, e) {
      module.exports = e();
    })(0, function () {
      var f = function () {
        function e(a) {
          return c.appendChild(a.dom), a;
        }
        function u(a) {
          for (var d = 0; d < c.children.length; d++)
            c.children[d].style.display = d === a ? "block" : "none";
          l = a;
        }
        var l = 0,
          c = document.createElement("div");
        (c.style.cssText =
          "position:fixed;top:0;left:0;cursor:pointer;opacity:0.9;z-index:10000"),
          c.addEventListener(
            "click",
            function (a) {
              a.preventDefault(), u(++l % c.children.length);
            },
            !1
          );
        var k = (performance || Date).now(),
          g = k,
          a = 0,
          r = e(new f.Panel("FPS", "#0ff", "#002")),
          h = e(new f.Panel("MS", "#0f0", "#020"));
        if (self.performance && self.performance.memory)
          var t = e(new f.Panel("MB", "#f08", "#201"));
        return (
          u(0),
          {
            REVISION: 16,
            dom: c,
            addPanel: e,
            showPanel: u,
            begin: function () {
              k = (performance || Date).now();
            },
            end: function () {
              a++;
              var c = (performance || Date).now();
              if (
                (h.update(c - k, 200),
                c > g + 1e3 &&
                  (r.update((1e3 * a) / (c - g), 100), (g = c), (a = 0), t))
              ) {
                var d = performance.memory;
                t.update(
                  d.usedJSHeapSize / 1048576,
                  d.jsHeapSizeLimit / 1048576
                );
              }
              return c;
            },
            update: function () {
              k = this.end();
            },
            domElement: c,
            setMode: u,
          }
        );
      };
      return (
        (f.Panel = function (e, f, l) {
          var c = 1 / 0,
            k = 0,
            g = Math.round,
            a = g(window.devicePixelRatio || 1),
            r = 80 * a,
            h = 48 * a,
            t = 3 * a,
            v = 2 * a,
            d = 3 * a,
            m = 15 * a,
            n = 74 * a,
            p = 30 * a,
            q = document.createElement("canvas");
          (q.width = r),
            (q.height = h),
            (q.style.cssText = "width:80px;height:48px");
          var b = q.getContext("2d");
          return (
            (b.font = "bold " + 9 * a + "px Helvetica,Arial,sans-serif"),
            (b.textBaseline = "top"),
            (b.fillStyle = l),
            b.fillRect(0, 0, r, h),
            (b.fillStyle = f),
            b.fillText(e, t, v),
            b.fillRect(d, m, n, p),
            (b.fillStyle = l),
            (b.globalAlpha = 0.9),
            b.fillRect(d, m, n, p),
            {
              dom: q,
              update: function (h, w) {
                (c = Math.min(c, h)),
                  (k = Math.max(k, h)),
                  (b.fillStyle = l),
                  (b.globalAlpha = 1),
                  b.fillRect(0, 0, r, m),
                  (b.fillStyle = f),
                  b.fillText(
                    g(h) + " " + e + " (" + g(c) + "-" + g(k) + ")",
                    t,
                    v
                  ),
                  b.drawImage(q, d + a, m, n - a, p, d, m, n - a, p),
                  b.fillRect(d + n - a, m, a, p),
                  (b.fillStyle = l),
                  (b.globalAlpha = 0.9),
                  b.fillRect(d + n - a, m, a, g((1 - h / w) * p));
              },
            }
          );
        }),
        f
      );
    });
  },
  function (module, exports, __webpack_require__) {
    __webpack_require__(25), (module.exports = __webpack_require__(24));
  },
]);
