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

// node_modules/datatables.net-responsive/js/dataTables.responsive.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
var Responsive = function(settings, opts) {
  if (!jquery_dataTables_default.versionCheck || !jquery_dataTables_default.versionCheck("1.10.10")) {
    throw "DataTables Responsive requires DataTables 1.10.10 or newer";
  }
  this.s = {
    childNodeStore: {},
    columns: [],
    current: [],
    dt: new jquery_dataTables_default.Api(settings)
  };
  if (this.s.dt.settings()[0].responsive) {
    return;
  }
  if (opts && typeof opts.details === "string") {
    opts.details = { type: opts.details };
  } else if (opts && opts.details === false) {
    opts.details = { type: false };
  } else if (opts && opts.details === true) {
    opts.details = { type: "inline" };
  }
  this.c = $.extend(true, {}, Responsive.defaults, jquery_dataTables_default.defaults.responsive, opts);
  settings.responsive = this;
  this._constructor();
};
$.extend(Responsive.prototype, {
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Constructor
   */
  /**
   * Initialise the Responsive instance
   *
   * @private
   */
  _constructor: function() {
    var that = this;
    var dt = this.s.dt;
    var dtPrivateSettings = dt.settings()[0];
    var oldWindowWidth = $(window).innerWidth();
    dt.settings()[0]._responsive = this;
    $(window).on(
      "resize.dtr orientationchange.dtr",
      jquery_dataTables_default.util.throttle(function() {
        var width = $(window).innerWidth();
        if (width !== oldWindowWidth) {
          that._resize();
          oldWindowWidth = width;
        }
      })
    );
    dtPrivateSettings.oApi._fnCallbackReg(
      dtPrivateSettings,
      "aoRowCreatedCallback",
      function(tr, data, idx) {
        if ($.inArray(false, that.s.current) !== -1) {
          $(">td, >th", tr).each(function(i) {
            var idx2 = dt.column.index("toData", i);
            if (that.s.current[idx2] === false) {
              $(this).css("display", "none");
            }
          });
        }
      }
    );
    dt.on("destroy.dtr", function() {
      dt.off(".dtr");
      $(dt.table().body()).off(".dtr");
      $(window).off("resize.dtr orientationchange.dtr");
      dt.cells(".dtr-control").nodes().to$().removeClass("dtr-control");
      $.each(that.s.current, function(i, val) {
        if (val === false) {
          that._setColumnVis(i, true);
        }
      });
    });
    this.c.breakpoints.sort(function(a, b) {
      return a.width < b.width ? 1 : a.width > b.width ? -1 : 0;
    });
    this._classLogic();
    this._resizeAuto();
    var details = this.c.details;
    if (details.type !== false) {
      that._detailsInit();
      dt.on("column-visibility.dtr", function() {
        if (that._timer) {
          clearTimeout(that._timer);
        }
        that._timer = setTimeout(function() {
          that._timer = null;
          that._classLogic();
          that._resizeAuto();
          that._resize(true);
          that._redrawChildren();
        }, 100);
      });
      dt.on("draw.dtr", function() {
        that._redrawChildren();
      });
      $(dt.table().node()).addClass("dtr-" + details.type);
    }
    dt.on("column-reorder.dtr", function(e, settings, details2) {
      that._classLogic();
      that._resizeAuto();
      that._resize(true);
    });
    dt.on("column-sizing.dtr", function() {
      that._resizeAuto();
      that._resize();
    });
    dt.on("column-calc.dt", function(e, d) {
      var curr = that.s.current;
      for (var i = 0; i < curr.length; i++) {
        var idx = d.visible.indexOf(i);
        if (curr[i] === false && idx >= 0) {
          d.visible.splice(idx, 1);
        }
      }
    });
    dt.on("preXhr.dtr", function() {
      var rowIds = [];
      dt.rows().every(function() {
        if (this.child.isShown()) {
          rowIds.push(this.id(true));
        }
      });
      dt.one("draw.dtr", function() {
        that._resizeAuto();
        that._resize();
        dt.rows(rowIds).every(function() {
          that._detailsDisplay(this, false);
        });
      });
    });
    dt.on("draw.dtr", function() {
      that._controlClass();
    }).on("init.dtr", function(e, settings, details2) {
      if (e.namespace !== "dt") {
        return;
      }
      that._resizeAuto();
      that._resize();
      if ($.inArray(false, that.s.current)) {
        dt.columns.adjust();
      }
    });
    this._resize();
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Private methods
   */
  /**
   * Get and store nodes from a cell - use for node moving renderers
   *
   * @param {*} dt DT instance
   * @param {*} row Row index
   * @param {*} col Column index
   */
  _childNodes: function(dt, row, col) {
    var name = row + "-" + col;
    if (this.s.childNodeStore[name]) {
      return this.s.childNodeStore[name];
    }
    var nodes = [];
    var children = dt.cell(row, col).node().childNodes;
    for (var i = 0, ien = children.length; i < ien; i++) {
      nodes.push(children[i]);
    }
    this.s.childNodeStore[name] = nodes;
    return nodes;
  },
  /**
   * Restore nodes from the cache to a table cell
   *
   * @param {*} dt DT instance
   * @param {*} row Row index
   * @param {*} col Column index
   */
  _childNodesRestore: function(dt, row, col) {
    var name = row + "-" + col;
    if (!this.s.childNodeStore[name]) {
      return;
    }
    var node = dt.cell(row, col).node();
    var store = this.s.childNodeStore[name];
    var parent = store[0].parentNode;
    var parentChildren = parent.childNodes;
    var a = [];
    for (var i = 0, ien = parentChildren.length; i < ien; i++) {
      a.push(parentChildren[i]);
    }
    for (var j = 0, jen = a.length; j < jen; j++) {
      node.appendChild(a[j]);
    }
    this.s.childNodeStore[name] = void 0;
  },
  /**
   * Calculate the visibility for the columns in a table for a given
   * breakpoint. The result is pre-determined based on the class logic if
   * class names are used to control all columns, but the width of the table
   * is also used if there are columns which are to be automatically shown
   * and hidden.
   *
   * @param  {string} breakpoint Breakpoint name to use for the calculation
   * @return {array} Array of boolean values initiating the visibility of each
   *   column.
   *  @private
   */
  _columnsVisiblity: function(breakpoint) {
    var dt = this.s.dt;
    var columns = this.s.columns;
    var i, ien;
    var order = columns.map(function(col, idx) {
      return {
        columnIdx: idx,
        priority: col.priority
      };
    }).sort(function(a, b) {
      if (a.priority !== b.priority) {
        return a.priority - b.priority;
      }
      return a.columnIdx - b.columnIdx;
    });
    var display = $.map(columns, function(col, i2) {
      if (dt.column(i2).visible() === false) {
        return "not-visible";
      }
      return col.auto && col.minWidth === null ? false : col.auto === true ? "-" : $.inArray(breakpoint, col.includeIn) !== -1;
    });
    var requiredWidth = 0;
    for (i = 0, ien = display.length; i < ien; i++) {
      if (display[i] === true) {
        requiredWidth += columns[i].minWidth;
      }
    }
    var scrolling = dt.settings()[0].oScroll;
    var bar = scrolling.sY || scrolling.sX ? scrolling.iBarWidth : 0;
    var widthAvailable = dt.table().container().offsetWidth - bar;
    var usedWidth = widthAvailable - requiredWidth;
    for (i = 0, ien = display.length; i < ien; i++) {
      if (columns[i].control) {
        usedWidth -= columns[i].minWidth;
      }
    }
    var empty = false;
    for (i = 0, ien = order.length; i < ien; i++) {
      var colIdx = order[i].columnIdx;
      if (display[colIdx] === "-" && !columns[colIdx].control && columns[colIdx].minWidth) {
        if (empty || usedWidth - columns[colIdx].minWidth < 0) {
          empty = true;
          display[colIdx] = false;
        } else {
          display[colIdx] = true;
        }
        usedWidth -= columns[colIdx].minWidth;
      }
    }
    var showControl = false;
    for (i = 0, ien = columns.length; i < ien; i++) {
      if (!columns[i].control && !columns[i].never && display[i] === false) {
        showControl = true;
        break;
      }
    }
    for (i = 0, ien = columns.length; i < ien; i++) {
      if (columns[i].control) {
        display[i] = showControl;
      }
      if (display[i] === "not-visible") {
        display[i] = false;
      }
    }
    if ($.inArray(true, display) === -1) {
      display[0] = true;
    }
    return display;
  },
  /**
   * Create the internal `columns` array with information about the columns
   * for the table. This includes determining which breakpoints the column
   * will appear in, based upon class names in the column, which makes up the
   * vast majority of this method.
   *
   * @private
   */
  _classLogic: function() {
    var that = this;
    var calc = {};
    var breakpoints = this.c.breakpoints;
    var dt = this.s.dt;
    var columns = dt.columns().eq(0).map(function(i) {
      var column2 = this.column(i);
      var className = column2.header().className;
      var priority = dt.settings()[0].aoColumns[i].responsivePriority;
      var dataPriority = column2.header().getAttribute("data-priority");
      if (priority === void 0) {
        priority = dataPriority === void 0 || dataPriority === null ? 1e4 : dataPriority * 1;
      }
      return {
        className,
        includeIn: [],
        auto: false,
        control: false,
        never: className.match(/\b(dtr\-)?never\b/) ? true : false,
        priority
      };
    });
    var add = function(colIdx, name) {
      var includeIn = columns[colIdx].includeIn;
      if ($.inArray(name, includeIn) === -1) {
        includeIn.push(name);
      }
    };
    var column = function(colIdx, name, operator, matched) {
      var size, i, ien;
      if (!operator) {
        columns[colIdx].includeIn.push(name);
      } else if (operator === "max-") {
        size = that._find(name).width;
        for (i = 0, ien = breakpoints.length; i < ien; i++) {
          if (breakpoints[i].width <= size) {
            add(colIdx, breakpoints[i].name);
          }
        }
      } else if (operator === "min-") {
        size = that._find(name).width;
        for (i = 0, ien = breakpoints.length; i < ien; i++) {
          if (breakpoints[i].width >= size) {
            add(colIdx, breakpoints[i].name);
          }
        }
      } else if (operator === "not-") {
        for (i = 0, ien = breakpoints.length; i < ien; i++) {
          if (breakpoints[i].name.indexOf(matched) === -1) {
            add(colIdx, breakpoints[i].name);
          }
        }
      }
    };
    columns.each(function(col, i) {
      var classNames = col.className.split(" ");
      var hasClass = false;
      for (var k = 0, ken = classNames.length; k < ken; k++) {
        var className = classNames[k].trim();
        if (className === "all" || className === "dtr-all") {
          hasClass = true;
          col.includeIn = $.map(breakpoints, function(a) {
            return a.name;
          });
          return;
        } else if (className === "none" || className === "dtr-none" || col.never) {
          hasClass = true;
          return;
        } else if (className === "control" || className === "dtr-control") {
          hasClass = true;
          col.control = true;
          return;
        }
        $.each(breakpoints, function(j, breakpoint) {
          var brokenPoint = breakpoint.name.split("-");
          var re = new RegExp(
            "(min\\-|max\\-|not\\-)?(" + brokenPoint[0] + ")(\\-[_a-zA-Z0-9])?"
          );
          var match = className.match(re);
          if (match) {
            hasClass = true;
            if (match[2] === brokenPoint[0] && match[3] === "-" + brokenPoint[1]) {
              column(i, breakpoint.name, match[1], match[2] + match[3]);
            } else if (match[2] === brokenPoint[0] && !match[3]) {
              column(i, breakpoint.name, match[1], match[2]);
            }
          }
        });
      }
      if (!hasClass) {
        col.auto = true;
      }
    });
    this.s.columns = columns;
  },
  /**
   * Update the cells to show the correct control class / button
   * @private
   */
  _controlClass: function() {
    if (this.c.details.type === "inline") {
      var dt = this.s.dt;
      var columnsVis = this.s.current;
      var firstVisible = $.inArray(true, columnsVis);
      dt.cells(
        null,
        function(idx) {
          return idx !== firstVisible;
        },
        { page: "current" }
      ).nodes().to$().filter(".dtr-control").removeClass("dtr-control");
      dt.cells(null, firstVisible, { page: "current" }).nodes().to$().addClass("dtr-control");
    }
  },
  /**
   * Show the details for the child row
   *
   * @param  {DataTables.Api} row    API instance for the row
   * @param  {boolean}        update Update flag
   * @private
   */
  _detailsDisplay: function(row, update) {
    var that = this;
    var dt = this.s.dt;
    var details = this.c.details;
    var event = function(res2) {
      $(row.node()).toggleClass("parent", res2 !== false);
      $(dt.table().node()).triggerHandler("responsive-display.dt", [dt, row, res2, update]);
    };
    if (details && details.type !== false) {
      var renderer = typeof details.renderer === "string" ? Responsive.renderer[details.renderer]() : details.renderer;
      var res = details.display(
        row,
        update,
        function() {
          return renderer.call(that, dt, row[0], that._detailsObj(row[0]));
        },
        function() {
          event(false);
        }
      );
      if (typeof res === "boolean") {
        event(res);
      }
    }
  },
  /**
   * Initialisation for the details handler
   *
   * @private
   */
  _detailsInit: function() {
    var that = this;
    var dt = this.s.dt;
    var details = this.c.details;
    if (details.type === "inline") {
      details.target = "td.dtr-control, th.dtr-control";
    }
    dt.on("draw.dtr", function() {
      that._tabIndexes();
    });
    that._tabIndexes();
    $(dt.table().body()).on("keyup.dtr", "td, th", function(e) {
      if (e.keyCode === 13 && $(this).data("dtr-keyboard")) {
        $(this).click();
      }
    });
    var target = details.target;
    var selector = typeof target === "string" ? target : "td, th";
    if (target !== void 0 || target !== null) {
      $(dt.table().body()).on("click.dtr mousedown.dtr mouseup.dtr", selector, function(e) {
        if (!$(dt.table().node()).hasClass("collapsed")) {
          return;
        }
        if ($.inArray($(this).closest("tr").get(0), dt.rows().nodes().toArray()) === -1) {
          return;
        }
        if (typeof target === "number") {
          var targetIdx = target < 0 ? dt.columns().eq(0).length + target : target;
          if (dt.cell(this).index().column !== targetIdx) {
            return;
          }
        }
        var row = dt.row($(this).closest("tr"));
        if (e.type === "click") {
          that._detailsDisplay(row, false);
        } else if (e.type === "mousedown") {
          $(this).css("outline", "none");
        } else if (e.type === "mouseup") {
          $(this).trigger("blur").css("outline", "");
        }
      });
    }
  },
  /**
   * Get the details to pass to a renderer for a row
   * @param  {int} rowIdx Row index
   * @private
   */
  _detailsObj: function(rowIdx) {
    var that = this;
    var dt = this.s.dt;
    return $.map(this.s.columns, function(col, i) {
      if (col.never || col.control) {
        return;
      }
      var dtCol = dt.settings()[0].aoColumns[i];
      return {
        className: dtCol.sClass,
        columnIndex: i,
        data: dt.cell(rowIdx, i).render(that.c.orthogonal),
        hidden: dt.column(i).visible() && !that.s.current[i],
        rowIndex: rowIdx,
        title: dtCol.sTitle !== null ? dtCol.sTitle : $(dt.column(i).header()).text()
      };
    });
  },
  /**
   * Find a breakpoint object from a name
   *
   * @param  {string} name Breakpoint name to find
   * @return {object}      Breakpoint description object
   * @private
   */
  _find: function(name) {
    var breakpoints = this.c.breakpoints;
    for (var i = 0, ien = breakpoints.length; i < ien; i++) {
      if (breakpoints[i].name === name) {
        return breakpoints[i];
      }
    }
  },
  /**
   * Re-create the contents of the child rows as the display has changed in
   * some way.
   *
   * @private
   */
  _redrawChildren: function() {
    var that = this;
    var dt = this.s.dt;
    dt.rows({ page: "current" }).iterator("row", function(settings, idx) {
      that._detailsDisplay(dt.row(idx), true);
    });
  },
  /**
   * Alter the table display for a resized viewport. This involves first
   * determining what breakpoint the window currently is in, getting the
   * column visibilities to apply and then setting them.
   *
   * @param  {boolean} forceRedraw Force a redraw
   * @private
   */
  _resize: function(forceRedraw) {
    var that = this;
    var dt = this.s.dt;
    var width = $(window).innerWidth();
    var breakpoints = this.c.breakpoints;
    var breakpoint = breakpoints[0].name;
    var columns = this.s.columns;
    var i, ien;
    var oldVis = this.s.current.slice();
    for (i = breakpoints.length - 1; i >= 0; i--) {
      if (width <= breakpoints[i].width) {
        breakpoint = breakpoints[i].name;
        break;
      }
    }
    var columnsVis = this._columnsVisiblity(breakpoint);
    this.s.current = columnsVis;
    var collapsedClass = false;
    for (i = 0, ien = columns.length; i < ien; i++) {
      if (columnsVis[i] === false && !columns[i].never && !columns[i].control && !dt.column(i).visible() === false) {
        collapsedClass = true;
        break;
      }
    }
    $(dt.table().node()).toggleClass("collapsed", collapsedClass);
    var changed = false;
    var visible = 0;
    dt.columns().eq(0).each(function(colIdx, i2) {
      if (columnsVis[i2] === true) {
        visible++;
      }
      if (forceRedraw || columnsVis[i2] !== oldVis[i2]) {
        changed = true;
        that._setColumnVis(colIdx, columnsVis[i2]);
      }
    });
    this._redrawChildren();
    if (changed) {
      $(dt.table().node()).trigger("responsive-resize.dt", [dt, this.s.current]);
      if (dt.page.info().recordsDisplay === 0) {
        $("td", dt.table().body()).eq(0).attr("colspan", visible);
      }
    }
    that._controlClass();
  },
  /**
   * Determine the width of each column in the table so the auto column hiding
   * has that information to work with. This method is never going to be 100%
   * perfect since column widths can change slightly per page, but without
   * seriously compromising performance this is quite effective.
   *
   * @private
   */
  _resizeAuto: function() {
    var dt = this.s.dt;
    var columns = this.s.columns;
    var that = this;
    if (!this.c.auto) {
      return;
    }
    if ($.inArray(
      true,
      $.map(columns, function(c) {
        return c.auto;
      })
    ) === -1) {
      return;
    }
    if (!$.isEmptyObject(this.s.childNodeStore)) {
      $.each(this.s.childNodeStore, function(key) {
        var idx = key.split("-");
        that._childNodesRestore(dt, idx[0] * 1, idx[1] * 1);
      });
    }
    var tableWidth = dt.table().node().offsetWidth;
    var columnWidths = dt.columns;
    var clonedTable = dt.table().node().cloneNode(false);
    var clonedHeader = $(dt.table().header().cloneNode(false)).appendTo(clonedTable);
    var clonedBody = $(dt.table().body()).clone(false, false).empty().appendTo(clonedTable);
    clonedTable.style.width = "auto";
    var headerCells = dt.columns().header().filter(function(idx) {
      return dt.column(idx).visible();
    }).to$().clone(false).css("display", "table-cell").css("width", "auto").css("min-width", 0);
    $(clonedBody).append($(dt.rows({ page: "current" }).nodes()).clone(false)).find("th, td").css("display", "");
    var footer = dt.table().footer();
    if (footer) {
      var clonedFooter = $(footer.cloneNode(false)).appendTo(clonedTable);
      var footerCells = dt.columns().footer().filter(function(idx) {
        return dt.column(idx).visible();
      }).to$().clone(false).css("display", "table-cell");
      $("<tr/>").append(footerCells).appendTo(clonedFooter);
    }
    $("<tr/>").append(headerCells).appendTo(clonedHeader);
    if (this.c.details.type === "inline") {
      $(clonedTable).addClass("dtr-inline collapsed");
    }
    $(clonedTable).find("[name]").removeAttr("name");
    $(clonedTable).css("position", "relative");
    var inserted = $("<div/>").css({
      width: 1,
      height: 1,
      overflow: "hidden",
      clear: "both"
    }).append(clonedTable);
    inserted.insertBefore(dt.table().node());
    headerCells.each(function(i) {
      var idx = dt.column.index("fromVisible", i);
      columns[idx].minWidth = this.offsetWidth || 0;
    });
    inserted.remove();
  },
  /**
   * Get the state of the current hidden columns - controlled by Responsive only
   */
  _responsiveOnlyHidden: function() {
    var dt = this.s.dt;
    return $.map(this.s.current, function(v, i) {
      if (dt.column(i).visible() === false) {
        return true;
      }
      return v;
    });
  },
  /**
   * Set a column's visibility.
   *
   * We don't use DataTables' column visibility controls in order to ensure
   * that column visibility can Responsive can no-exist. Since only IE8+ is
   * supported (and all evergreen browsers of course) the control of the
   * display attribute works well.
   *
   * @param {integer} col      Column index
   * @param {boolean} showHide Show or hide (true or false)
   * @private
   */
  _setColumnVis: function(col, showHide) {
    var that = this;
    var dt = this.s.dt;
    var display = showHide ? "" : "none";
    $(dt.column(col).header()).css("display", display).toggleClass("dtr-hidden", !showHide);
    $(dt.column(col).footer()).css("display", display).toggleClass("dtr-hidden", !showHide);
    dt.column(col).nodes().to$().css("display", display).toggleClass("dtr-hidden", !showHide);
    if (!$.isEmptyObject(this.s.childNodeStore)) {
      dt.cells(null, col).indexes().each(function(idx) {
        that._childNodesRestore(dt, idx.row, idx.column);
      });
    }
  },
  /**
   * Update the cell tab indexes for keyboard accessibility. This is called on
   * every table draw - that is potentially inefficient, but also the least
   * complex option given that column visibility can change on the fly. Its a
   * shame user-focus was removed from CSS 3 UI, as it would have solved this
   * issue with a single CSS statement.
   *
   * @private
   */
  _tabIndexes: function() {
    var dt = this.s.dt;
    var cells = dt.cells({ page: "current" }).nodes().to$();
    var ctx = dt.settings()[0];
    var target = this.c.details.target;
    cells.filter("[data-dtr-keyboard]").removeData("[data-dtr-keyboard]");
    if (typeof target === "number") {
      dt.cells(null, target, { page: "current" }).nodes().to$().attr("tabIndex", ctx.iTabIndex).data("dtr-keyboard", 1);
    } else {
      if (target === "td:first-child, th:first-child") {
        target = ">td:first-child, >th:first-child";
      }
      $(target, dt.rows({ page: "current" }).nodes()).attr("tabIndex", ctx.iTabIndex).data("dtr-keyboard", 1);
    }
  }
});
Responsive.breakpoints = [
  { name: "desktop", width: Infinity },
  { name: "tablet-l", width: 1024 },
  { name: "tablet-p", width: 768 },
  { name: "mobile-l", width: 480 },
  { name: "mobile-p", width: 320 }
];
Responsive.display = {
  childRow: function(row, update, render) {
    if (update) {
      if ($(row.node()).hasClass("parent")) {
        row.child(render(), "child").show();
        return true;
      }
    } else {
      if (!row.child.isShown()) {
        row.child(render(), "child").show();
        return true;
      } else {
        row.child(false);
        return false;
      }
    }
  },
  childRowImmediate: function(row, update, render) {
    if (!update && row.child.isShown() || !row.responsive.hasHidden()) {
      row.child(false);
      return false;
    } else {
      row.child(render(), "child").show();
      return true;
    }
  },
  // This is a wrapper so the modal options for Bootstrap and jQuery UI can
  // have options passed into them. This specific one doesn't need to be a
  // function but it is for consistency in the `modal` name
  modal: function(options) {
    return function(row, update, render, closeCallback) {
      if (!update) {
        var close = function() {
          modal.remove();
          $(document).off("keypress.dtr");
          $(row.node()).removeClass("parent");
          closeCallback();
        };
        var modal = $('<div class="dtr-modal"/>').append(
          $('<div class="dtr-modal-display"/>').append(
            $('<div class="dtr-modal-content"/>').data("dtr-row-idx", row.index()).append(render())
          ).append(
            $('<div class="dtr-modal-close">&times;</div>').click(function() {
              close();
            })
          )
        ).append(
          $('<div class="dtr-modal-background"/>').click(function() {
            close();
          })
        ).appendTo("body");
        $(row.node()).addClass("parent");
        $(document).on("keyup.dtr", function(e) {
          if (e.keyCode === 27) {
            e.stopPropagation();
            close();
          }
        });
      } else {
        var modal = $("div.dtr-modal-content");
        if (modal.length && row.index() === modal.data("dtr-row-idx")) {
          modal.empty().append(render());
        } else {
          return null;
        }
      }
      if (options && options.header) {
        $("div.dtr-modal-content").prepend("<h2>" + options.header(row) + "</h2>");
      }
      return true;
    };
  }
};
Responsive.renderer = {
  listHiddenNodes: function() {
    return function(api, rowIdx, columns) {
      var that = this;
      var ul = $('<ul data-dtr-index="' + rowIdx + '" class="dtr-details"/>');
      var found = false;
      var data = $.each(columns, function(i, col) {
        if (col.hidden) {
          var klass = col.className ? 'class="' + col.className + '"' : "";
          $(
            "<li " + klass + ' data-dtr-index="' + col.columnIndex + '" data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '"><span class="dtr-title">' + col.title + "</span> </li>"
          ).append(
            $('<span class="dtr-data"/>').append(
              that._childNodes(api, col.rowIndex, col.columnIndex)
            )
          ).appendTo(ul);
          found = true;
        }
      });
      return found ? ul : false;
    };
  },
  listHidden: function() {
    return function(api, rowIdx, columns) {
      var data = $.map(columns, function(col) {
        var klass = col.className ? 'class="' + col.className + '"' : "";
        return col.hidden ? "<li " + klass + ' data-dtr-index="' + col.columnIndex + '" data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '"><span class="dtr-title">' + col.title + '</span> <span class="dtr-data">' + col.data + "</span></li>" : "";
      }).join("");
      return data ? $('<ul data-dtr-index="' + rowIdx + '" class="dtr-details"/>').append(data) : false;
    };
  },
  tableAll: function(options) {
    options = $.extend(
      {
        tableClass: ""
      },
      options
    );
    return function(api, rowIdx, columns) {
      var data = $.map(columns, function(col) {
        var klass = col.className ? 'class="' + col.className + '"' : "";
        return "<tr " + klass + ' data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '"><td>' + col.title + ":</td> <td>" + col.data + "</td></tr>";
      }).join("");
      return $('<table class="' + options.tableClass + ' dtr-details" width="100%"/>').append(
        data
      );
    };
  }
};
Responsive.defaults = {
  /**
   * List of breakpoints for the instance. Note that this means that each
   * instance can have its own breakpoints. Additionally, the breakpoints
   * cannot be changed once an instance has been creased.
   *
   * @type {Array}
   * @default Takes the value of `Responsive.breakpoints`
   */
  breakpoints: Responsive.breakpoints,
  /**
   * Enable / disable auto hiding calculations. It can help to increase
   * performance slightly if you disable this option, but all columns would
   * need to have breakpoint classes assigned to them
   *
   * @type {Boolean}
   * @default  `true`
   */
  auto: true,
  /**
   * Details control. If given as a string value, the `type` property of the
   * default object is set to that value, and the defaults used for the rest
   * of the object - this is for ease of implementation.
   *
   * The object consists of the following properties:
   *
   * * `display` - A function that is used to show and hide the hidden details
   * * `renderer` - function that is called for display of the child row data.
   *   The default function will show the data from the hidden columns
   * * `target` - Used as the selector for what objects to attach the child
   *   open / close to
   * * `type` - `false` to disable the details display, `inline` or `column`
   *   for the two control types
   *
   * @type {Object|string}
   */
  details: {
    display: Responsive.display.childRow,
    renderer: Responsive.renderer.listHidden(),
    target: 0,
    type: "inline"
  },
  /**
   * Orthogonal data request option. This is used to define the data type
   * requested when Responsive gets the data to show in the child row.
   *
   * @type {String}
   */
  orthogonal: "display"
};
var Api = $.fn.dataTable.Api;
Api.register("responsive()", function() {
  return this;
});
Api.register("responsive.index()", function(li) {
  li = $(li);
  return {
    column: li.data("dtr-index"),
    row: li.parent().data("dtr-index")
  };
});
Api.register("responsive.rebuild()", function() {
  return this.iterator("table", function(ctx) {
    if (ctx._responsive) {
      ctx._responsive._classLogic();
    }
  });
});
Api.register("responsive.recalc()", function() {
  return this.iterator("table", function(ctx) {
    if (ctx._responsive) {
      ctx._responsive._resizeAuto();
      ctx._responsive._resize();
    }
  });
});
Api.register("responsive.hasHidden()", function() {
  var ctx = this.context[0];
  return ctx._responsive ? $.inArray(false, ctx._responsive._responsiveOnlyHidden()) !== -1 : false;
});
Api.registerPlural("columns().responsiveHidden()", "column().responsiveHidden()", function() {
  return this.iterator(
    "column",
    function(settings, column) {
      return settings._responsive ? settings._responsive._responsiveOnlyHidden()[column] : false;
    },
    1
  );
});
Responsive.version = "2.5.0";
$.fn.dataTable.Responsive = Responsive;
$.fn.DataTable.Responsive = Responsive;
$(document).on("preInit.dt.dtr", function(e, settings, json) {
  if (e.namespace !== "dt") {
    return;
  }
  if ($(settings.nTable).hasClass("responsive") || $(settings.nTable).hasClass("dt-responsive") || settings.oInit.responsive || jquery_dataTables_default.defaults.responsive) {
    var init = settings.oInit.responsive;
    if (init !== false) {
      new Responsive(settings, $.isPlainObject(init) ? init : {});
    }
  }
});
var dataTables_responsive_default = jquery_dataTables_default;

export {
  dataTables_responsive_default
};
/*! Bundled license information:

datatables.net-responsive/js/dataTables.responsive.mjs:
  (*! Responsive 2.5.0
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=chunk-K2H5754N.js.map
