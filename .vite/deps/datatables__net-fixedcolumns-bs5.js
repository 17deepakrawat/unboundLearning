import {
  dataTables_bootstrap5_default
} from "./chunk-CAYPXQDN.js";
import {
  init_jquery_dataTables,
  jquery_dataTables_default
} from "./chunk-BLVVVJWX.js";
import {
  require_jquery
} from "./chunk-DNMGBOI2.js";
import {
  __toESM
} from "./chunk-GFT2G5UO.js";

// node_modules/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.mjs
var import_jquery2 = __toESM(require_jquery(), 1);

// node_modules/datatables.net-fixedcolumns/js/dataTables.fixedColumns.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
(function() {
  "use strict";
  var $$1;
  var dataTable;
  function setJQuery(jq) {
    $$1 = jq;
    dataTable = $$1.fn.dataTable;
  }
  var FixedColumns = (
    /** @class */
    function() {
      function FixedColumns2(settings, opts) {
        var _this = this;
        if (!dataTable || !dataTable.versionCheck || !dataTable.versionCheck("1.10.0")) {
          throw new Error("FixedColumns requires DataTables 1.10 or newer");
        }
        var table = new dataTable.Api(settings);
        this.classes = $$1.extend(true, {}, FixedColumns2.classes);
        this.c = $$1.extend(true, {}, FixedColumns2.defaults, opts);
        if ((!opts || opts.left === void 0) && this.c.leftColumns !== void 0) {
          this.c.left = this.c.leftColumns;
        }
        if ((!opts || opts.right === void 0) && this.c.rightColumns !== void 0) {
          this.c.right = this.c.rightColumns;
        }
        this.s = {
          barWidth: 0,
          dt: table,
          rtl: $$1("body").css("direction") === "rtl"
        };
        var blockerCSS = {
          "bottom": "0px",
          "display": "block",
          "position": "absolute",
          "width": this.s.barWidth + 1 + "px"
        };
        this.dom = {
          leftBottomBlocker: $$1("<div>").css(blockerCSS).css("left", 0).addClass(this.classes.leftBottomBlocker),
          leftTopBlocker: $$1("<div>").css(blockerCSS).css({
            left: 0,
            top: 0
          }).addClass(this.classes.leftTopBlocker),
          rightBottomBlocker: $$1("<div>").css(blockerCSS).css("right", 0).addClass(this.classes.rightBottomBlocker),
          rightTopBlocker: $$1("<div>").css(blockerCSS).css({
            right: 0,
            top: 0
          }).addClass(this.classes.rightTopBlocker)
        };
        if (this.s.dt.settings()[0]._bInitComplete) {
          this._addStyles();
          this._setKeyTableListener();
        } else {
          table.one("init.dt.dtfc", function() {
            _this._addStyles();
            _this._setKeyTableListener();
          });
        }
        table.on("column-sizing.dt.dtfc", function() {
          return _this._addStyles();
        });
        table.settings()[0]._fixedColumns = this;
        table.on("destroy", function() {
          return _this._destroy();
        });
        return this;
      }
      FixedColumns2.prototype.left = function(newVal) {
        if (newVal !== void 0) {
          if (newVal >= 0 && newVal <= this.s.dt.columns().count()) {
            this.c.left = newVal;
            this._addStyles();
          }
          return this;
        }
        return this.c.left;
      };
      FixedColumns2.prototype.right = function(newVal) {
        if (newVal !== void 0) {
          if (newVal >= 0 && newVal <= this.s.dt.columns().count()) {
            this.c.right = newVal;
            this._addStyles();
          }
          return this;
        }
        return this.c.right;
      };
      FixedColumns2.prototype._addStyles = function() {
        if (this.s.dt.settings()[0].oScroll.sY) {
          var scroll_1 = $$1(this.s.dt.table().node()).closest("div.dataTables_scrollBody")[0];
          var barWidth = this.s.dt.settings()[0].oBrowser.barWidth;
          if (scroll_1.offsetWidth - scroll_1.clientWidth >= barWidth) {
            this.s.barWidth = barWidth;
          } else {
            this.s.barWidth = 0;
          }
          this.dom.rightTopBlocker.css("width", this.s.barWidth + 1);
          this.dom.leftTopBlocker.css("width", this.s.barWidth + 1);
          this.dom.rightBottomBlocker.css("width", this.s.barWidth + 1);
          this.dom.leftBottomBlocker.css("width", this.s.barWidth + 1);
        }
        var parentDiv = null;
        var header = this.s.dt.column(0).header();
        var headerHeight = null;
        if (header !== null) {
          header = $$1(header);
          headerHeight = header.outerHeight() + 1;
          parentDiv = $$1(header.closest("div.dataTables_scroll")).css("position", "relative");
        }
        var footer = this.s.dt.column(0).footer();
        var footerHeight = null;
        if (footer !== null) {
          footer = $$1(footer);
          footerHeight = footer.outerHeight();
          if (parentDiv === null) {
            parentDiv = $$1(footer.closest("div.dataTables_scroll")).css("position", "relative");
          }
        }
        var numCols = this.s.dt.columns().data().toArray().length;
        var distLeft = 0;
        var headLeft = 0;
        var rows = $$1(this.s.dt.table().node()).children("tbody").children("tr");
        var invisibles = 0;
        var prevInvisible = /* @__PURE__ */ new Map();
        for (var i = 0; i < numCols; i++) {
          var column = this.s.dt.column(i);
          if (i > 0) {
            prevInvisible.set(i - 1, invisibles);
          }
          if (!column.visible()) {
            invisibles++;
            continue;
          }
          var colHeader = $$1(column.header());
          var colFooter = $$1(column.footer());
          if (i - invisibles < this.c.left) {
            $$1(this.s.dt.table().node()).addClass(this.classes.tableFixedLeft);
            parentDiv.addClass(this.classes.tableFixedLeft);
            if (i - invisibles > 0) {
              var prevIdx = i;
              while (prevIdx + 1 < numCols) {
                var prevCol = this.s.dt.column(prevIdx - 1, { page: "current" });
                if (prevCol.visible()) {
                  distLeft += $$1(prevCol.nodes()[0]).outerWidth();
                  headLeft += prevCol.header() ? $$1(prevCol.header()).outerWidth() : prevCol.footer() ? $$1(prevCol.header()).outerWidth() : 0;
                  break;
                }
                prevIdx--;
              }
            }
            for (var _i = 0, rows_1 = rows; _i < rows_1.length; _i++) {
              var row = rows_1[_i];
              $$1($$1(row).children()[i - invisibles]).css(this._getCellCSS(false, distLeft, "left")).addClass(this.classes.fixedLeft);
            }
            colHeader.css(this._getCellCSS(true, headLeft, "left")).addClass(this.classes.fixedLeft);
            colFooter.css(this._getCellCSS(true, headLeft, "left")).addClass(this.classes.fixedLeft);
          } else {
            for (var _a = 0, rows_2 = rows; _a < rows_2.length; _a++) {
              var row = rows_2[_a];
              var cell = $$1($$1(row).children()[i - invisibles]);
              if (cell.hasClass(this.classes.fixedLeft)) {
                cell.css(this._clearCellCSS("left")).removeClass(this.classes.fixedLeft);
              }
            }
            if (colHeader.hasClass(this.classes.fixedLeft)) {
              colHeader.css(this._clearCellCSS("left")).removeClass(this.classes.fixedLeft);
            }
            if (colFooter.hasClass(this.classes.fixedLeft)) {
              colFooter.css(this._clearCellCSS("left")).removeClass(this.classes.fixedLeft);
            }
          }
        }
        var distRight = 0;
        var headRight = 0;
        var rightInvisibles = 0;
        for (var i = numCols - 1; i >= 0; i--) {
          var column = this.s.dt.column(i);
          if (!column.visible()) {
            rightInvisibles++;
            continue;
          }
          var colHeader = $$1(column.header());
          var colFooter = $$1(column.footer());
          var prev = prevInvisible.get(i);
          if (prev === void 0) {
            prev = invisibles;
          }
          if (i + rightInvisibles >= numCols - this.c.right) {
            $$1(this.s.dt.table().node()).addClass(this.classes.tableFixedRight);
            parentDiv.addClass(this.classes.tableFixedRight);
            if (i + 1 + rightInvisibles < numCols) {
              var prevIdx = i;
              while (prevIdx + 1 < numCols) {
                var prevCol = this.s.dt.column(prevIdx + 1, { page: "current" });
                if (prevCol.visible()) {
                  distRight += $$1(prevCol.nodes()[0]).outerWidth();
                  headRight += prevCol.header() ? $$1(prevCol.header()).outerWidth() : prevCol.footer() ? $$1(prevCol.header()).outerWidth() : 0;
                  break;
                }
                prevIdx++;
              }
            }
            for (var _b = 0, rows_3 = rows; _b < rows_3.length; _b++) {
              var row = rows_3[_b];
              $$1($$1(row).children()[i - prev]).css(this._getCellCSS(false, distRight, "right")).addClass(this.classes.fixedRight);
            }
            colHeader.css(this._getCellCSS(true, headRight, "right")).addClass(this.classes.fixedRight);
            colFooter.css(this._getCellCSS(true, headRight, "right")).addClass(this.classes.fixedRight);
          } else {
            for (var _c = 0, rows_4 = rows; _c < rows_4.length; _c++) {
              var row = rows_4[_c];
              var cell = $$1($$1(row).children()[i - prev]);
              if (cell.hasClass(this.classes.fixedRight)) {
                cell.css(this._clearCellCSS("right")).removeClass(this.classes.fixedRight);
              }
            }
            if (colHeader.hasClass(this.classes.fixedRight)) {
              colHeader.css(this._clearCellCSS("right")).removeClass(this.classes.fixedRight);
            }
            if (colFooter.hasClass(this.classes.fixedRight)) {
              colFooter.css(this._clearCellCSS("right")).removeClass(this.classes.fixedRight);
            }
          }
        }
        if (header) {
          if (!this.s.rtl) {
            this.dom.rightTopBlocker.outerHeight(headerHeight);
            parentDiv.append(this.dom.rightTopBlocker);
          } else {
            this.dom.leftTopBlocker.outerHeight(headerHeight);
            parentDiv.append(this.dom.leftTopBlocker);
          }
        }
        if (footer) {
          if (!this.s.rtl) {
            this.dom.rightBottomBlocker.outerHeight(footerHeight);
            parentDiv.append(this.dom.rightBottomBlocker);
          } else {
            this.dom.leftBottomBlocker.outerHeight(footerHeight);
            parentDiv.append(this.dom.leftBottomBlocker);
          }
        }
      };
      FixedColumns2.prototype._destroy = function() {
        this.s.dt.off(".dtfc");
        this.dom.leftBottomBlocker.remove();
        this.dom.leftTopBlocker.remove();
        this.dom.rightBottomBlocker.remove();
        this.dom.rightTopBlocker.remove();
      };
      FixedColumns2.prototype._getCellCSS = function(header, dist, lr) {
        if (lr === "left") {
          return this.s.rtl ? {
            position: "sticky",
            right: dist + "px"
          } : {
            left: dist + "px",
            position: "sticky"
          };
        } else {
          return this.s.rtl ? {
            left: dist + (header ? this.s.barWidth : 0) + "px",
            position: "sticky"
          } : {
            position: "sticky",
            right: dist + (header ? this.s.barWidth : 0) + "px"
          };
        }
      };
      FixedColumns2.prototype._clearCellCSS = function(lr) {
        if (lr === "left") {
          return !this.s.rtl ? {
            left: "",
            position: ""
          } : {
            position: "",
            right: ""
          };
        } else {
          return !this.s.rtl ? {
            position: "",
            right: ""
          } : {
            left: "",
            position: ""
          };
        }
      };
      FixedColumns2.prototype._setKeyTableListener = function() {
        var _this = this;
        this.s.dt.on("key-focus.dt.dtfc", function(e, dt, cell) {
          var cellPos = $$1(cell.node()).offset();
          var scroll = $$1($$1(_this.s.dt.table().node()).closest("div.dataTables_scrollBody"));
          if (_this.c.left > 0) {
            var rightMost = $$1(_this.s.dt.column(_this.c.left - 1).header());
            var rightMostPos = rightMost.offset();
            var rightMostWidth = rightMost.outerWidth();
            if (cellPos.left < rightMostPos.left + rightMostWidth) {
              var currScroll = scroll.scrollLeft();
              scroll.scrollLeft(currScroll - (rightMostPos.left + rightMostWidth - cellPos.left));
            }
          }
          if (_this.c.right > 0) {
            var numCols = _this.s.dt.columns().data().toArray().length;
            var cellWidth = $$1(cell.node()).outerWidth();
            var leftMost = $$1(_this.s.dt.column(numCols - _this.c.right).header());
            var leftMostPos = leftMost.offset();
            if (cellPos.left + cellWidth > leftMostPos.left) {
              var currScroll = scroll.scrollLeft();
              scroll.scrollLeft(currScroll - (leftMostPos.left - (cellPos.left + cellWidth)));
            }
          }
        });
        this.s.dt.on("draw.dt.dtfc", function() {
          _this._addStyles();
        });
        this.s.dt.on("column-reorder.dt.dtfc", function() {
          _this._addStyles();
        });
        this.s.dt.on("column-visibility.dt.dtfc", function(e, settings, column, state, recalc) {
          if (recalc && !settings.bDestroying) {
            setTimeout(function() {
              _this._addStyles();
            }, 50);
          }
        });
      };
      FixedColumns2.version = "4.3.0";
      FixedColumns2.classes = {
        fixedLeft: "dtfc-fixed-left",
        fixedRight: "dtfc-fixed-right",
        leftBottomBlocker: "dtfc-left-bottom-blocker",
        leftTopBlocker: "dtfc-left-top-blocker",
        rightBottomBlocker: "dtfc-right-bottom-blocker",
        rightTopBlocker: "dtfc-right-top-blocker",
        tableFixedLeft: "dtfc-has-left",
        tableFixedRight: "dtfc-has-right"
      };
      FixedColumns2.defaults = {
        i18n: {
          button: "FixedColumns"
        },
        left: 1,
        right: 0
      };
      return FixedColumns2;
    }()
  );
  setJQuery($);
  $.fn.dataTable.FixedColumns = FixedColumns;
  $.fn.DataTable.FixedColumns = FixedColumns;
  var apiRegister = jquery_dataTables_default.Api.register;
  apiRegister("fixedColumns()", function() {
    return this;
  });
  apiRegister("fixedColumns().left()", function(newVal) {
    var ctx = this.context[0];
    if (newVal !== void 0) {
      ctx._fixedColumns.left(newVal);
      return this;
    } else {
      return ctx._fixedColumns.left();
    }
  });
  apiRegister("fixedColumns().right()", function(newVal) {
    var ctx = this.context[0];
    if (newVal !== void 0) {
      ctx._fixedColumns.right(newVal);
      return this;
    } else {
      return ctx._fixedColumns.right();
    }
  });
  jquery_dataTables_default.ext.buttons.fixedColumns = {
    action: function(e, dt, node, config) {
      if ($(node).attr("active")) {
        $(node).removeAttr("active").removeClass("active");
        dt.fixedColumns().left(0);
        dt.fixedColumns().right(0);
      } else {
        $(node).attr("active", "true").addClass("active");
        dt.fixedColumns().left(config.config.left);
        dt.fixedColumns().right(config.config.right);
      }
    },
    config: {
      left: 1,
      right: 0
    },
    init: function(dt, node, config) {
      if (dt.settings()[0]._fixedColumns === void 0) {
        _init(dt.settings(), config);
      }
      $(node).attr("active", "true").addClass("active");
      dt.button(node).text(config.text || dt.i18n("buttons.fixedColumns", dt.settings()[0]._fixedColumns.c.i18n.button));
    },
    text: null
  };
  function _init(settings, options) {
    if (options === void 0) {
      options = null;
    }
    var api = new jquery_dataTables_default.Api(settings);
    var opts = options ? options : api.init().fixedColumns || jquery_dataTables_default.defaults.fixedColumns;
    var fixedColumns = new FixedColumns(api, opts);
    return fixedColumns;
  }
  $(document).on("plugin-init.dt", function(e, settings) {
    if (e.namespace !== "dt") {
      return;
    }
    if (settings.oInit.fixedColumns || jquery_dataTables_default.defaults.fixedColumns) {
      if (!settings._fixedColumns) {
        _init(settings, null);
      }
    }
  });
})();

// node_modules/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.mjs
var fixedColumns_bootstrap5_default = dataTables_bootstrap5_default;
export {
  fixedColumns_bootstrap5_default as default
};
/*! Bundled license information:

datatables.net-fixedcolumns/js/dataTables.fixedColumns.mjs:
  (*! FixedColumns 4.3.0
   * © SpryMedia Ltd - datatables.net/license
   *)

datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.mjs:
  (*! Bootstrap 5 integration for DataTables' FixedColumns
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=datatables__net-fixedcolumns-bs5.js.map
