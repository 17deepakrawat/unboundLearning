import {
  init_jquery_dataTables,
  jquery_dataTables_exports
} from "./chunk-BLVVVJWX.js";
import "./chunk-DNMGBOI2.js";
import {
  __commonJS,
  __toCommonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/jquery-datatables-checkboxes/js/dataTables.checkboxes.js
var require_dataTables_checkboxes = __commonJS({
  "node_modules/jquery-datatables-checkboxes/js/dataTables.checkboxes.js"(exports, module) {
    (function(factory) {
      if (typeof define === "function" && define.amd) {
        define(["jquery", "datatables.net"], function($) {
          return factory($, window, document);
        });
      } else if (typeof exports === "object") {
        module.exports = function(root, $) {
          if (!root) {
            root = window;
          }
          if (!$ || !$.fn.dataTable) {
            $ = (init_jquery_dataTables(), __toCommonJS(jquery_dataTables_exports))(root, $).$;
          }
          return factory($, root, root.document);
        };
      } else {
        factory(jQuery, window, document);
      }
    })(function($, window2, document2) {
      "use strict";
      var DataTable = $.fn.dataTable;
      var Checkboxes = function(settings) {
        if (!DataTable.versionCheck || !DataTable.versionCheck("1.10.8")) {
          throw "DataTables Checkboxes requires DataTables 1.10.8 or newer";
        }
        this.s = {
          dt: new DataTable.Api(settings),
          columns: [],
          data: {},
          dataDisabled: {},
          ignoreSelect: false
        };
        this.s.ctx = this.s.dt.settings()[0];
        if (this.s.ctx.checkboxes) {
          return;
        }
        settings.checkboxes = this;
        this._constructor();
      };
      Checkboxes.prototype = {
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * Constructor
        */
        /**
        * Initialise the Checkboxes instance
        *
        * @private
        */
        _constructor: function() {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          var hasCheckboxes = false;
          var hasCheckboxesSelectRow = false;
          for (var i = 0; i < ctx.aoColumns.length; i++) {
            if (ctx.aoColumns[i].checkboxes) {
              var $colHeader = $(dt.column(i).header());
              hasCheckboxes = true;
              if (!$.isPlainObject(ctx.aoColumns[i].checkboxes)) {
                ctx.aoColumns[i].checkboxes = {};
              }
              ctx.aoColumns[i].checkboxes = $.extend(
                {},
                Checkboxes.defaults,
                ctx.aoColumns[i].checkboxes
              );
              var colOptions = {
                "searchable": false,
                "orderable": false
              };
              if (ctx.aoColumns[i].sClass === "") {
                colOptions["className"] = "dt-checkboxes-cell";
              } else {
                colOptions["className"] = ctx.aoColumns[i].sClass + " dt-checkboxes-cell";
              }
              if (ctx.aoColumns[i].sWidthOrig === null) {
                colOptions["width"] = "1%";
              }
              if (ctx.aoColumns[i].mRender === null) {
                colOptions["render"] = function() {
                  return '<input type="checkbox" class="dt-checkboxes" autocomplete="off">';
                };
              }
              DataTable.ext.internal._fnColumnOptions(ctx, i, colOptions);
              $colHeader.removeClass("sorting");
              $colHeader.off(".dt");
              if (ctx.sAjaxSource === null) {
                var cells = dt.cells("tr", i);
                cells.invalidate("data");
                $(cells.nodes()).addClass(colOptions["className"]);
              }
              self.s.data[i] = {};
              self.s.dataDisabled[i] = {};
              self.s.columns.push(i);
              if (ctx.aoColumns[i].checkboxes.selectRow) {
                if (ctx._select) {
                  hasCheckboxesSelectRow = true;
                } else {
                  ctx.aoColumns[i].checkboxes.selectRow = false;
                }
              }
              if (ctx.aoColumns[i].checkboxes.selectAll) {
                $colHeader.data("html", $colHeader.html());
                if (ctx.aoColumns[i].checkboxes.selectAllRender !== null) {
                  var selectAllHtml = "";
                  if ($.isFunction(ctx.aoColumns[i].checkboxes.selectAllRender)) {
                    selectAllHtml = ctx.aoColumns[i].checkboxes.selectAllRender();
                  } else if (typeof ctx.aoColumns[i].checkboxes.selectAllRender === "string") {
                    selectAllHtml = ctx.aoColumns[i].checkboxes.selectAllRender;
                  }
                  $colHeader.html(selectAllHtml).addClass("dt-checkboxes-select-all").attr("data-col", i);
                }
              }
            }
          }
          if (hasCheckboxes) {
            self.loadState();
            var $table = $(dt.table().node());
            var $tableBody = $(dt.table().body());
            var $tableContainer = $(dt.table().container());
            if (hasCheckboxesSelectRow) {
              $table.addClass("dt-checkboxes-select");
              $table.on("user-select.dt.dtCheckboxes", function(e, dt2, type, cell, originalEvent) {
                self.onDataTablesUserSelect(e, dt2, type, cell, originalEvent);
              });
              $table.on("select.dt.dtCheckboxes deselect.dt.dtCheckboxes", function(e, api, type, indexes) {
                self.onDataTablesSelectDeselect(e, type, indexes);
              });
              if (ctx._select.info) {
                dt.select.info(false);
                $table.on("draw.dt.dtCheckboxes select.dt.dtCheckboxes deselect.dt.dtCheckboxes", function() {
                  self.showInfoSelected();
                });
              }
            }
            $table.on("draw.dt.dtCheckboxes", function(e) {
              self.onDataTablesDraw(e);
            });
            $tableBody.on("click.dtCheckboxes", "input.dt-checkboxes", function(e) {
              self.onClick(e, this);
            });
            $tableContainer.on("click.dtCheckboxes", 'thead th.dt-checkboxes-select-all input[type="checkbox"]', function(e) {
              self.onClickSelectAll(e, this);
            });
            $tableContainer.on("click.dtCheckboxes", "thead th.dt-checkboxes-select-all", function() {
              $('input[type="checkbox"]', this).not(":disabled").trigger("click");
            });
            if (!hasCheckboxesSelectRow) {
              $tableContainer.on("click.dtCheckboxes", "tbody td.dt-checkboxes-cell", function() {
                $('input[type="checkbox"]', this).not(":disabled").trigger("click");
              });
            }
            $tableContainer.on("click.dtCheckboxes", "thead th.dt-checkboxes-select-all label, tbody td.dt-checkboxes-cell label", function(e) {
              e.preventDefault();
            });
            $(document2).on("click.dtCheckboxes", '.fixedHeader-floating thead th.dt-checkboxes-select-all input[type="checkbox"]', function(e) {
              if (ctx._fixedHeader) {
                if (ctx._fixedHeader.dom["header"].floating) {
                  self.onClickSelectAll(e, this);
                }
              }
            });
            $(document2).on("click.dtCheckboxes", ".fixedHeader-floating thead th.dt-checkboxes-select-all", function() {
              if (ctx._fixedHeader) {
                if (ctx._fixedHeader.dom["header"].floating) {
                  $('input[type="checkbox"]', this).trigger("click");
                }
              }
            });
            $table.on("init.dt.dtCheckboxes", function() {
              setTimeout(function() {
                self.onDataTablesInit();
              }, 0);
            });
            $table.on("stateSaveParams.dt.dtCheckboxes", function(e, settings, data) {
              self.onDataTablesStateSave(e, settings, data);
            });
            $table.one("destroy.dt.dtCheckboxes", function(e, settings) {
              self.onDataTablesDestroy(e, settings);
            });
          }
        },
        // Handles DataTables initialization event
        onDataTablesInit: function() {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (!ctx.oFeatures.bServerSide) {
            if (ctx.oFeatures.bStateSave) {
              self.updateState();
            }
            $(dt.table().node()).on("xhr.dt.dtCheckboxes", function(e, settings, json, xhr) {
              self.onDataTablesXhr(e.settings, json, xhr);
            });
          }
        },
        // Handles DataTables user initiated select event
        onDataTablesUserSelect: function(e, dt, type, cell) {
          var self = this;
          var cellIdx = cell.index();
          var rowIdx = cellIdx.row;
          var colIdx = self.getSelectRowColIndex();
          var cellData = dt.cell({ row: rowIdx, column: colIdx }).data();
          if (!self.isCellSelectable(colIdx, cellData)) {
            e.preventDefault();
          }
        },
        // Handles DataTables row select/deselect event
        onDataTablesSelectDeselect: function(e, type, indexes) {
          var self = this;
          var dt = self.s.dt;
          if (self.s.ignoreSelect) {
            return;
          }
          if (type === "row") {
            var colIdx = self.getSelectRowColIndex();
            if (colIdx !== null) {
              var cells = dt.cells(indexes, colIdx);
              self.updateData(cells, colIdx, e.type === "select" ? true : false);
              self.updateCheckbox(cells, colIdx, e.type === "select" ? true : false);
              self.updateSelectAll(colIdx);
            }
          }
        },
        // Handles DataTables state save event
        onDataTablesStateSave: function(e, settings, data) {
          var self = this;
          var ctx = self.s.ctx;
          $.each(self.s.columns, function(index, colIdx) {
            if (ctx.aoColumns[colIdx].checkboxes.stateSave) {
              if (!Object.prototype.hasOwnProperty.call(data, "checkboxes")) {
                data.checkboxes = [];
              }
              data.checkboxes[colIdx] = self.s.data[colIdx];
            }
          });
        },
        // Handles DataTables destroy event
        onDataTablesDestroy: function() {
          var self = this;
          var dt = self.s.dt;
          var $table = $(dt.table().node());
          var $tableBody = $(dt.table().body());
          var $tableContainer = $(dt.table().container());
          $(document2).off("click.dtCheckboxes");
          $tableContainer.off(".dtCheckboxes");
          $tableBody.off(".dtCheckboxes");
          $table.off(".dtCheckboxes");
          self.s.data = {};
          self.s.dataDisabled = {};
          $(".dt-checkboxes-select-all", $table).each(function(index, el) {
            $(el).html($(el).data("html")).removeClass("dt-checkboxes-select-all");
          });
        },
        // Handles DataTables draw event
        onDataTablesDraw: function() {
          var self = this;
          var ctx = self.s.ctx;
          if (ctx.oFeatures.bServerSide || ctx.oFeatures.bDeferRender) {
            self.updateStateCheckboxes({ page: "current", search: "none" });
          }
          $.each(self.s.columns, function(index, colIdx) {
            self.updateSelectAll(colIdx);
          });
        },
        // Handles DataTables Ajax request completion event
        onDataTablesXhr: function() {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          var $table = $(dt.table().node());
          $.each(self.s.columns, function(index, colIdx) {
            self.s.data[colIdx] = {};
            self.s.dataDisabled[colIdx] = {};
          });
          if (ctx.oFeatures.bStateSave) {
            self.loadState();
            $table.one("draw.dt.dtCheckboxes", function() {
              self.updateState();
            });
          }
        },
        // Updates array holding data for selected checkboxes
        updateData: function(cells, colIdx, isSelected) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (ctx.aoColumns[colIdx].checkboxes) {
            var cellsData = cells.data();
            cellsData.each(function(cellData) {
              if (isSelected) {
                ctx.checkboxes.s.data[colIdx][cellData] = 1;
              } else {
                delete ctx.checkboxes.s.data[colIdx][cellData];
              }
            });
            if (ctx.oFeatures.bStateSave) {
              if (ctx.aoColumns[colIdx].checkboxes.stateSave) {
                dt.state.save();
              }
            }
          }
        },
        // Updates row selection
        updateSelect: function(selector, isSelected) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (ctx._select) {
            self.s.ignoreSelect = true;
            if (isSelected) {
              dt.rows(selector).select();
            } else {
              dt.rows(selector).deselect();
            }
            self.s.ignoreSelect = false;
          }
        },
        // Updates state of single checkbox
        updateCheckbox: function(cells, colIdx, isSelected) {
          var self = this;
          var ctx = self.s.ctx;
          var cellNodes = cells.nodes();
          if (cellNodes.length) {
            $("input.dt-checkboxes", cellNodes).not(":disabled").prop("checked", isSelected);
            if ($.isFunction(ctx.aoColumns[colIdx].checkboxes.selectCallback)) {
              ctx.aoColumns[colIdx].checkboxes.selectCallback(cellNodes, isSelected);
            }
          }
        },
        // Update table state
        updateState: function() {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          self.updateStateCheckboxes({ page: "all", search: "none" });
          if (ctx._oFixedColumns) {
            setTimeout(function() {
              $.each(self.s.columns, function(index, colIdx) {
                self.updateSelectAll(colIdx);
              });
            }, 0);
          }
        },
        // Updates state of multiple checkboxes
        updateStateCheckboxes: function(opts) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          dt.cells("tr", self.s.columns, opts).every(function(rowIdx, colIdx) {
            var cellData = this.data();
            var isCellSelectable = self.isCellSelectable(colIdx, cellData);
            if (Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data, colIdx) && Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data[colIdx], cellData)) {
              if (ctx.aoColumns[colIdx].checkboxes.selectRow && isCellSelectable) {
                self.updateSelect(rowIdx, true);
              }
              self.updateCheckbox(this, colIdx, true);
            }
            if (!isCellSelectable) {
              $("input.dt-checkboxes", this.node()).prop("disabled", true);
            }
          });
        },
        // Handles checkbox click event
        onClick: function(e, ctrl) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          var cellSelector;
          var $cell = $(ctrl).closest("td");
          if ($cell.parents(".DTFC_Cloned").length) {
            cellSelector = dt.fixedColumns().cellIndex($cell);
          } else {
            cellSelector = $cell;
          }
          var cell = dt.cell(cellSelector);
          var cellIdx = cell.index();
          var colIdx = cellIdx.column;
          var rowIdx = cellIdx.row;
          if (!ctx.aoColumns[colIdx].checkboxes.selectRow) {
            cell.checkboxes.select(ctrl.checked);
            e.stopPropagation();
          } else {
            if (ctx._select) {
              if (ctx._select.style === "os") {
                e.stopPropagation();
                cell.checkboxes.select(ctrl.checked);
              } else {
                setTimeout(function() {
                  var cellData = cell.data();
                  var hasData = Object.prototype.hasOwnProperty.call(self.s.data, colIdx) && Object.prototype.hasOwnProperty.call(self.s.data[colIdx], cellData);
                  if (hasData !== ctrl.checked) {
                    self.updateCheckbox(cell, colIdx, hasData);
                    self.updateSelectAll(colIdx);
                  }
                }, 0);
              }
            }
          }
        },
        // Handles checkbox click event
        onClickSelectAll: function(e, ctrl) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          var colIdx = null;
          var $th = $(ctrl).closest("th");
          if ($th.parents(".DTFC_Cloned").length) {
            var cellIdx = dt.fixedColumns().cellIndex($th);
            colIdx = cellIdx.column;
          } else {
            colIdx = dt.column($th).index();
          }
          $(ctrl).data("is-changed", true);
          dt.column(colIdx, {
            page: ctx.aoColumns[colIdx].checkboxes && ctx.aoColumns[colIdx].checkboxes.selectAllPages ? "all" : "current",
            search: "applied"
          }).checkboxes.select(ctrl.checked);
          e.stopPropagation();
        },
        // Loads previosly saved sate
        loadState: function() {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (ctx.oFeatures.bStateSave) {
            var state = dt.state.loaded();
            $.each(self.s.columns, function(index, colIdx) {
              if (state && state.checkboxes && state.checkboxes.hasOwnProperty(colIdx)) {
                if (ctx.aoColumns[colIdx].checkboxes.stateSave) {
                  self.s.data[colIdx] = state.checkboxes[colIdx];
                }
              }
            });
          }
        },
        // Updates state of the "Select all" controls
        updateSelectAll: function(colIdx) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (ctx.aoColumns[colIdx].checkboxes && ctx.aoColumns[colIdx].checkboxes.selectAll) {
            var cells = dt.cells("tr", colIdx, {
              page: ctx.aoColumns[colIdx].checkboxes.selectAllPages ? "all" : "current",
              search: "applied"
            });
            var $tableContainer = dt.table().container();
            var $checkboxesSelectAll = $('.dt-checkboxes-select-all[data-col="' + colIdx + '"] input[type="checkbox"]', $tableContainer);
            var countChecked = 0;
            var countDisabled = 0;
            var cellsData = cells.data();
            $.each(cellsData, function(index, cellData) {
              if (self.isCellSelectable(colIdx, cellData)) {
                if (Object.prototype.hasOwnProperty.call(self.s.data, colIdx) && Object.prototype.hasOwnProperty.call(self.s.data[colIdx], cellData)) {
                  countChecked++;
                }
              } else {
                countDisabled++;
              }
            });
            if (ctx._fixedHeader) {
              if (ctx._fixedHeader.dom["header"].floating) {
                $checkboxesSelectAll = $('.fixedHeader-floating .dt-checkboxes-select-all[data-col="' + colIdx + '"] input[type="checkbox"]');
              }
            }
            var isSelected;
            var isIndeterminate;
            if (countChecked === 0) {
              isSelected = false;
              isIndeterminate = false;
            } else if (countChecked + countDisabled === cellsData.length) {
              isSelected = true;
              isIndeterminate = false;
            } else {
              isSelected = true;
              isIndeterminate = true;
            }
            var isChanged = $checkboxesSelectAll.data("is-changed");
            var isSelectedNow = $checkboxesSelectAll.prop("checked");
            var isIndeterminateNow = $checkboxesSelectAll.prop("indeterminate");
            if (isChanged || isSelectedNow !== isSelected || isIndeterminateNow !== isIndeterminate) {
              $checkboxesSelectAll.data("is-changed", false);
              $checkboxesSelectAll.prop({
                // NOTE: If checkbox has indeterminate state,
                // "checked" property must be set to false.
                "checked": isIndeterminate ? false : isSelected,
                "indeterminate": isIndeterminate
              });
              if ($.isFunction(ctx.aoColumns[colIdx].checkboxes.selectAllCallback)) {
                ctx.aoColumns[colIdx].checkboxes.selectAllCallback($checkboxesSelectAll.closest("th").get(0), isSelected, isIndeterminate);
              }
            }
          }
        },
        // Updates the information element of the DataTable showing information about the
        // items selected. Based on info() method of Select extension.
        showInfoSelected: function() {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (!ctx.aanFeatures.i) {
            return;
          }
          var colIdx = self.getSelectRowColIndex();
          if (colIdx !== null) {
            var countRows = 0;
            for (var cellData in ctx.checkboxes.s.data[colIdx]) {
              if (Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data, colIdx) && Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data[colIdx], cellData)) {
                countRows++;
              }
            }
            var add = function($el, name, num) {
              $el.append($('<span class="select-item"/>').append(dt.i18n(
                "select." + name + "s",
                { _: "%d " + name + "s selected", 0: "", 1: "1 " + name + " selected" },
                num
              )));
            };
            $.each(ctx.aanFeatures.i, function(i, el) {
              var $el = $(el);
              var $output = $('<span class="select-info"/>');
              add($output, "row", countRows);
              var $existing = $el.children("span.select-info");
              if ($existing.length) {
                $existing.remove();
              }
              if ($output.text() !== "") {
                $el.append($output);
              }
            });
          }
        },
        // Determines whether checkbox in the cell can be checked
        isCellSelectable: function(colIdx, cellData) {
          var self = this;
          var ctx = self.s.ctx;
          if (Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.dataDisabled, colIdx) && Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.dataDisabled[colIdx], cellData)) {
            return false;
          } else {
            return true;
          }
        },
        // Gets cell index
        getCellIndex: function(cell) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (ctx._oFixedColumns) {
            return dt.fixedColumns().cellIndex(cell);
          } else {
            return dt.cell(cell).index();
          }
        },
        // Gets index of the first column that has checkbox and row selection enabled
        getSelectRowColIndex: function() {
          var self = this;
          var ctx = self.s.ctx;
          var colIdx = null;
          for (var i = 0; i < ctx.aoColumns.length; i++) {
            if (ctx.aoColumns[i].checkboxes && ctx.aoColumns[i].checkboxes.selectRow) {
              colIdx = i;
              break;
            }
          }
          return colIdx;
        },
        // Updates fixed column if FixedColumns extension is enabled
        // and given column is inside a fixed column
        updateFixedColumn: function(colIdx) {
          var self = this;
          var dt = self.s.dt;
          var ctx = self.s.ctx;
          if (ctx._oFixedColumns) {
            var leftCols = ctx._oFixedColumns.s.iLeftColumns;
            var rightCols = ctx.aoColumns.length - ctx._oFixedColumns.s.iRightColumns - 1;
            if (colIdx < leftCols || colIdx > rightCols) {
              dt.fixedColumns().update();
              setTimeout(function() {
                $.each(self.s.columns, function(index, colIdx2) {
                  self.updateSelectAll(colIdx2);
                });
              }, 0);
            }
          }
        }
      };
      Checkboxes.defaults = {
        /**
        * Enable / disable checkbox state loading/saving if state saving is enabled globally
        *
        * @type {Boolean}
        * @default `true`
        */
        stateSave: true,
        /**
        * Enable / disable row selection
        *
        * @type {Boolean}
        * @default `false`
        */
        selectRow: false,
        /**
        * Enable / disable "select all" control in the header
        *
        * @type {Boolean}
        * @default `true`
        */
        selectAll: true,
        /**
        * Enable / disable ability to select checkboxes from all pages
        *
        * @type {Boolean}
        * @default `true`
        */
        selectAllPages: true,
        /**
        * Checkbox select/deselect callback
        *
        * @type {Function}
        * @default  `null`
        */
        selectCallback: null,
        /**
        * "Select all" control select/deselect callback
        *
        * @type {Function}
        * @default  `null`
        */
        selectAllCallback: null,
        /**
        * "Select all" control markup
        *
        * @type {mixed}
        * @default `<input type="checkbox">`
        */
        selectAllRender: '<input type="checkbox" autocomplete="off">'
      };
      var Api = $.fn.dataTable.Api;
      Api.register("checkboxes()", function() {
        return this;
      });
      Api.registerPlural("columns().checkboxes.select()", "column().checkboxes.select()", function(state) {
        if (typeof state === "undefined") {
          state = true;
        }
        return this.iterator("column-rows", function(ctx, colIdx, i, j, rowsIdx) {
          if (ctx.aoColumns[colIdx].checkboxes) {
            var selector = [];
            $.each(rowsIdx, function(index, rowIdx) {
              selector.push({ row: rowIdx, column: colIdx });
            });
            var cells = this.cells(selector);
            var cellsData = cells.data();
            var rowsSelectableIdx = [];
            selector = [];
            $.each(cellsData, function(index, cellData) {
              if (ctx.checkboxes.isCellSelectable(colIdx, cellData)) {
                selector.push({ row: rowsIdx[index], column: colIdx });
                rowsSelectableIdx.push(rowsIdx[index]);
              }
            });
            cells = this.cells(selector);
            ctx.checkboxes.updateData(cells, colIdx, state);
            if (ctx.aoColumns[colIdx].checkboxes.selectRow) {
              ctx.checkboxes.updateSelect(rowsSelectableIdx, state);
            }
            ctx.checkboxes.updateCheckbox(cells, colIdx, state);
            ctx.checkboxes.updateSelectAll(colIdx);
            ctx.checkboxes.updateFixedColumn(colIdx);
          }
        }, 1);
      });
      Api.registerPlural("cells().checkboxes.select()", "cell().checkboxes.select()", function(state) {
        if (typeof state === "undefined") {
          state = true;
        }
        return this.iterator("cell", function(ctx, rowIdx, colIdx) {
          if (ctx.aoColumns[colIdx].checkboxes) {
            var cells = this.cells([{ row: rowIdx, column: colIdx }]);
            var cellData = this.cell({ row: rowIdx, column: colIdx }).data();
            if (ctx.checkboxes.isCellSelectable(colIdx, cellData)) {
              ctx.checkboxes.updateData(cells, colIdx, state);
              if (ctx.aoColumns[colIdx].checkboxes.selectRow) {
                ctx.checkboxes.updateSelect(rowIdx, state);
              }
              ctx.checkboxes.updateCheckbox(cells, colIdx, state);
              ctx.checkboxes.updateSelectAll(colIdx);
              ctx.checkboxes.updateFixedColumn(colIdx);
            }
          }
        }, 1);
      });
      Api.registerPlural("cells().checkboxes.enable()", "cell().checkboxes.enable()", function(state) {
        if (typeof state === "undefined") {
          state = true;
        }
        return this.iterator("cell", function(ctx, rowIdx, colIdx) {
          if (ctx.aoColumns[colIdx].checkboxes) {
            var cell = this.cell({ row: rowIdx, column: colIdx });
            var cellData = cell.data();
            if (state) {
              delete ctx.checkboxes.s.dataDisabled[colIdx][cellData];
            } else {
              ctx.checkboxes.s.dataDisabled[colIdx][cellData] = 1;
            }
            var cellNode = cell.node();
            if (cellNode) {
              $("input.dt-checkboxes", cellNode).prop("disabled", !state);
            }
            if (ctx.aoColumns[colIdx].checkboxes.selectRow) {
              if (Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data, colIdx) && Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data[colIdx], cellData)) {
                ctx.checkboxes.updateSelect(rowIdx, state);
              }
            }
          }
        }, 1);
      });
      Api.registerPlural("cells().checkboxes.disable()", "cell().checkboxes.disable()", function(state) {
        if (typeof state === "undefined") {
          state = true;
        }
        return this.checkboxes.enable(!state);
      });
      Api.registerPlural("columns().checkboxes.deselect()", "column().checkboxes.deselect()", function(state) {
        if (typeof state === "undefined") {
          state = true;
        }
        return this.checkboxes.select(!state);
      });
      Api.registerPlural("cells().checkboxes.deselect()", "cell().checkboxes.deselect()", function(state) {
        if (typeof state === "undefined") {
          state = true;
        }
        return this.checkboxes.select(!state);
      });
      Api.registerPlural("columns().checkboxes.deselectAll()", "column().checkboxes.deselectAll()", function() {
        return this.iterator("column", function(ctx, colIdx) {
          if (ctx.aoColumns[colIdx].checkboxes) {
            ctx.checkboxes.s.data[colIdx] = {};
            this.column(colIdx).checkboxes.select(false);
          }
        }, 1);
      });
      Api.registerPlural("columns().checkboxes.selected()", "column().checkboxes.selected()", function() {
        return this.iterator("column-rows", function(ctx, colIdx, i, j, rowsIdx) {
          if (ctx.aoColumns[colIdx].checkboxes) {
            var data = [];
            if (ctx.oFeatures.bServerSide) {
              $.each(ctx.checkboxes.s.data[colIdx], function(cellData) {
                if (ctx.checkboxes.isCellSelectable(colIdx, cellData)) {
                  data.push(cellData);
                }
              });
            } else {
              var selector = [];
              $.each(rowsIdx, function(index, rowIdx) {
                selector.push({ row: rowIdx, column: colIdx });
              });
              var cells = this.cells(selector);
              var cellsData = cells.data();
              $.each(cellsData, function(index, cellData) {
                if (Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data, colIdx) && Object.prototype.hasOwnProperty.call(ctx.checkboxes.s.data[colIdx], cellData)) {
                  if (ctx.checkboxes.isCellSelectable(colIdx, cellData)) {
                    data.push(cellData);
                  }
                }
              });
            }
            return data;
          } else {
            return [];
          }
        }, 1);
      });
      Checkboxes.version = "1.2.14";
      $.fn.DataTable.Checkboxes = Checkboxes;
      $.fn.dataTable.Checkboxes = Checkboxes;
      $(document2).on("preInit.dt.dtCheckboxes", function(e, settings) {
        if (e.namespace !== "dt") {
          return;
        }
        new Checkboxes(settings);
      });
      return Checkboxes;
    });
  }
});
export default require_dataTables_checkboxes();
/*! Bundled license information:

jquery-datatables-checkboxes/js/dataTables.checkboxes.js:
  (*!
   * jQuery DataTables Checkboxes (https://www.gyrocode.com/projects/jquery-datatables-checkboxes/)
   * Checkboxes extension for jQuery DataTables
   *
   * @version     1.2.14
   * @author      Gyrocode LLC (https://www.gyrocode.com)
   * @copyright   (c) Gyrocode LLC
   * @license     MIT
   *)
*/
//# sourceMappingURL=jquery-datatables-checkboxes.js.map
