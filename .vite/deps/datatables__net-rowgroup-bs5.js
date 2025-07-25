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

// node_modules/datatables.net-rowgroup-bs5/js/rowGroup.bootstrap5.mjs
var import_jquery2 = __toESM(require_jquery(), 1);

// node_modules/datatables.net-rowgroup/js/dataTables.rowGroup.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
var RowGroup = function(dt, opts) {
  if (!jquery_dataTables_default.versionCheck || !jquery_dataTables_default.versionCheck("1.10.8")) {
    throw "RowGroup requires DataTables 1.10.8 or newer";
  }
  this.c = $.extend(true, {}, jquery_dataTables_default.defaults.rowGroup, RowGroup.defaults, opts);
  this.s = {
    dt: new jquery_dataTables_default.Api(dt)
  };
  this.dom = {};
  var settings = this.s.dt.settings()[0];
  var existing = settings.rowGroup;
  if (existing) {
    return existing;
  }
  settings.rowGroup = this;
  this._constructor();
};
$.extend(RowGroup.prototype, {
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * API methods for DataTables API interface
   */
  /**
   * Get/set the grouping data source - need to call draw after this is
   * executed as a setter
   * @returns string~RowGroup
   */
  dataSrc: function(val) {
    if (val === void 0) {
      return this.c.dataSrc;
    }
    var dt = this.s.dt;
    this.c.dataSrc = val;
    $(dt.table().node()).triggerHandler("rowgroup-datasrc.dt", [dt, val]);
    return this;
  },
  /**
   * Disable - need to call draw after this is executed
   * @returns RowGroup
   */
  disable: function() {
    this.c.enable = false;
    return this;
  },
  /**
   * Enable - need to call draw after this is executed
   * @returns RowGroup
   */
  enable: function(flag) {
    if (flag === false) {
      return this.disable();
    }
    this.c.enable = true;
    return this;
  },
  /**
   * Get enabled flag
   * @returns boolean
   */
  enabled: function() {
    return this.c.enable;
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Constructor
   */
  _constructor: function() {
    var that = this;
    var dt = this.s.dt;
    var hostSettings = dt.settings()[0];
    dt.on("draw.dtrg", function(e, s) {
      if (that.c.enable && hostSettings === s) {
        that._draw();
      }
    });
    dt.on("column-visibility.dt.dtrg responsive-resize.dt.dtrg", function() {
      that._adjustColspan();
    });
    dt.on("destroy", function() {
      dt.off(".dtrg");
    });
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Private methods
   */
  /**
   * Adjust column span when column visibility changes
   * @private
   */
  _adjustColspan: function() {
    $("tr." + this.c.className, this.s.dt.table().body()).find("th:visible, td:visible").attr("colspan", this._colspan());
  },
  /**
   * Get the number of columns that a grouping row should span
   * @private
   */
  _colspan: function() {
    return this.s.dt.columns().visible().reduce(function(a, b) {
      return a + b;
    }, 0);
  },
  /**
   * Update function that is called whenever we need to draw the grouping rows.
   * This is basically a bootstrap for the self iterative _group and _groupDisplay
   * methods
   * @private
   */
  _draw: function() {
    var dt = this.s.dt;
    var groupedRows = this._group(0, dt.rows({ page: "current" }).indexes());
    this._groupDisplay(0, groupedRows);
  },
  /**
   * Get the grouping information from a data set (index) of rows
   * @param {number} level Nesting level
   * @param {DataTables.Api} rows API of the rows to consider for this group
   * @returns {object[]} Nested grouping information - it is structured like this:
   *	{
   *		dataPoint: 'Edinburgh',
   *		rows: [ 1,2,3,4,5,6,7 ],
   *		children: [ {
   *			dataPoint: 'developer'
   *			rows: [ 1, 2, 3 ]
   *		},
   *		{
   *			dataPoint: 'support',
   *			rows: [ 4, 5, 6, 7 ]
   *		} ]
   *	}
   * @private
   */
  _group: function(level, rows) {
    var fns = Array.isArray(this.c.dataSrc) ? this.c.dataSrc : [this.c.dataSrc];
    var fn = jquery_dataTables_default.ext.oApi._fnGetObjectDataFn(fns[level]);
    var dt = this.s.dt;
    var group, last;
    var data = [];
    var that = this;
    for (var i = 0, ien = rows.length; i < ien; i++) {
      var rowIndex = rows[i];
      var rowData = dt.row(rowIndex).data();
      var group = fn(rowData);
      if (group === null || group === void 0) {
        group = that.c.emptyDataGroup;
      }
      if (last === void 0 || group !== last) {
        data.push({
          dataPoint: group,
          rows: []
        });
        last = group;
      }
      data[data.length - 1].rows.push(rowIndex);
    }
    if (fns[level + 1] !== void 0) {
      for (var i = 0, ien = data.length; i < ien; i++) {
        data[i].children = this._group(level + 1, data[i].rows);
      }
    }
    return data;
  },
  /**
   * Row group display - insert the rows into the document
   * @param {number} level Nesting level
   * @param {object[]} groups Takes the nested array from `_group`
   * @private
   */
  _groupDisplay: function(level, groups) {
    var dt = this.s.dt;
    var display;
    for (var i = 0, ien = groups.length; i < ien; i++) {
      var group = groups[i];
      var groupName = group.dataPoint;
      var row;
      var rows = group.rows;
      if (this.c.startRender) {
        display = this.c.startRender.call(this, dt.rows(rows), groupName, level);
        row = this._rowWrap(display, this.c.startClassName, level);
        if (row) {
          row.insertBefore(dt.row(rows[0]).node());
        }
      }
      if (this.c.endRender) {
        display = this.c.endRender.call(this, dt.rows(rows), groupName, level);
        row = this._rowWrap(display, this.c.endClassName, level);
        if (row) {
          row.insertAfter(dt.row(rows[rows.length - 1]).node());
        }
      }
      if (group.children) {
        this._groupDisplay(level + 1, group.children);
      }
    }
  },
  /**
   * Take a rendered value from an end user and make it suitable for display
   * as a row, by wrapping it in a row, or detecting that it is a row.
   * @param {node|jQuery|string} display Display value
   * @param {string} className Class to add to the row
   * @param {array} group
   * @param {number} group level
   * @private
   */
  _rowWrap: function(display, className, level) {
    var row;
    if (display === null || display === "") {
      display = this.c.emptyDataGroup;
    }
    if (display === void 0 || display === null) {
      return null;
    }
    if (typeof display === "object" && display.nodeName && display.nodeName.toLowerCase() === "tr") {
      row = $(display);
    } else if (display instanceof $ && display.length && display[0].nodeName.toLowerCase() === "tr") {
      row = display;
    } else {
      row = $("<tr/>").append(
        $("<th/>").attr("colspan", this._colspan()).attr("scope", "row").append(display)
      );
    }
    return row.addClass(this.c.className).addClass(className).addClass("dtrg-level-" + level);
  }
});
RowGroup.defaults = {
  /**
   * Class to apply to grouping rows - applied to both the start and
   * end grouping rows.
   * @type string
   */
  className: "dtrg-group",
  /**
   * Data property from which to read the grouping information
   * @type string|integer|array
   */
  dataSrc: 0,
  /**
   * Text to show if no data is found for a group
   * @type string
   */
  emptyDataGroup: "No group",
  /**
   * Initial enablement state
   * @boolean
   */
  enable: true,
  /**
   * Class name to give to the end grouping row
   * @type string
   */
  endClassName: "dtrg-end",
  /**
   * End grouping label function
   * @function
   */
  endRender: null,
  /**
   * Class name to give to the start grouping row
   * @type string
   */
  startClassName: "dtrg-start",
  /**
   * Start grouping label function
   * @function
   */
  startRender: function(rows, group) {
    return group;
  }
};
RowGroup.version = "1.4.1";
$.fn.dataTable.RowGroup = RowGroup;
$.fn.DataTable.RowGroup = RowGroup;
jquery_dataTables_default.Api.register("rowGroup()", function() {
  return this;
});
jquery_dataTables_default.Api.register("rowGroup().disable()", function() {
  return this.iterator("table", function(ctx) {
    if (ctx.rowGroup) {
      ctx.rowGroup.enable(false);
    }
  });
});
jquery_dataTables_default.Api.register("rowGroup().enable()", function(opts) {
  return this.iterator("table", function(ctx) {
    if (ctx.rowGroup) {
      ctx.rowGroup.enable(opts === void 0 ? true : opts);
    }
  });
});
jquery_dataTables_default.Api.register("rowGroup().enabled()", function() {
  var ctx = this.context;
  return ctx.length && ctx[0].rowGroup ? ctx[0].rowGroup.enabled() : false;
});
jquery_dataTables_default.Api.register("rowGroup().dataSrc()", function(val) {
  if (val === void 0) {
    return this.context[0].rowGroup.dataSrc();
  }
  return this.iterator("table", function(ctx) {
    if (ctx.rowGroup) {
      ctx.rowGroup.dataSrc(val);
    }
  });
});
$(document).on("preInit.dt.dtrg", function(e, settings, json) {
  if (e.namespace !== "dt") {
    return;
  }
  var init = settings.oInit.rowGroup;
  var defaults = jquery_dataTables_default.defaults.rowGroup;
  if (init || defaults) {
    var opts = $.extend({}, defaults, init);
    if (init !== false) {
      new RowGroup(settings, opts);
    }
  }
});

// node_modules/datatables.net-rowgroup-bs5/js/rowGroup.bootstrap5.mjs
var rowGroup_bootstrap5_default = dataTables_bootstrap5_default;
export {
  rowGroup_bootstrap5_default as default
};
/*! Bundled license information:

datatables.net-rowgroup/js/dataTables.rowGroup.mjs:
  (*! RowGroup 1.4.1
   * © SpryMedia Ltd - datatables.net/license
   *)

datatables.net-rowgroup-bs5/js/rowGroup.bootstrap5.mjs:
  (*! Bootstrap 5 styling wrapper for RowGroup
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=datatables__net-rowgroup-bs5.js.map
