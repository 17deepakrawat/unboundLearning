import {
  require_jquery
} from "./chunk-DNMGBOI2.js";
import {
  __esm,
  __export,
  __toESM
} from "./chunk-GFT2G5UO.js";

// node_modules/datatables.net/js/jquery.dataTables.mjs
var jquery_dataTables_exports = {};
__export(jquery_dataTables_exports, {
  default: () => jquery_dataTables_default
});
function _fnHungarianMap(o) {
  var hungarian = "a aa ai ao as b fn i m o s ", match, newKey, map = {};
  $.each(o, function(key, val) {
    match = key.match(/^([^A-Z]+?)([A-Z])/);
    if (match && hungarian.indexOf(match[1] + " ") !== -1) {
      newKey = key.replace(match[0], match[2].toLowerCase());
      map[newKey] = key;
      if (match[1] === "o") {
        _fnHungarianMap(o[key]);
      }
    }
  });
  o._hungarianMap = map;
}
function _fnCamelToHungarian(src, user, force) {
  if (!src._hungarianMap) {
    _fnHungarianMap(src);
  }
  var hungarianKey;
  $.each(user, function(key, val) {
    hungarianKey = src._hungarianMap[key];
    if (hungarianKey !== void 0 && (force || user[hungarianKey] === void 0)) {
      if (hungarianKey.charAt(0) === "o") {
        if (!user[hungarianKey]) {
          user[hungarianKey] = {};
        }
        $.extend(true, user[hungarianKey], user[key]);
        _fnCamelToHungarian(src[hungarianKey], user[hungarianKey], force);
      } else {
        user[hungarianKey] = user[key];
      }
    }
  });
}
function _fnLanguageCompat(lang) {
  var defaults = DataTable.defaults.oLanguage;
  var defaultDecimal = defaults.sDecimal;
  if (defaultDecimal) {
    _addNumericSort(defaultDecimal);
  }
  if (lang) {
    var zeroRecords = lang.sZeroRecords;
    if (!lang.sEmptyTable && zeroRecords && defaults.sEmptyTable === "No data available in table") {
      _fnMap(lang, lang, "sZeroRecords", "sEmptyTable");
    }
    if (!lang.sLoadingRecords && zeroRecords && defaults.sLoadingRecords === "Loading...") {
      _fnMap(lang, lang, "sZeroRecords", "sLoadingRecords");
    }
    if (lang.sInfoThousands) {
      lang.sThousands = lang.sInfoThousands;
    }
    var decimal = lang.sDecimal;
    if (decimal && defaultDecimal !== decimal) {
      _addNumericSort(decimal);
    }
  }
}
function _fnCompatOpts(init) {
  _fnCompatMap(init, "ordering", "bSort");
  _fnCompatMap(init, "orderMulti", "bSortMulti");
  _fnCompatMap(init, "orderClasses", "bSortClasses");
  _fnCompatMap(init, "orderCellsTop", "bSortCellsTop");
  _fnCompatMap(init, "order", "aaSorting");
  _fnCompatMap(init, "orderFixed", "aaSortingFixed");
  _fnCompatMap(init, "paging", "bPaginate");
  _fnCompatMap(init, "pagingType", "sPaginationType");
  _fnCompatMap(init, "pageLength", "iDisplayLength");
  _fnCompatMap(init, "searching", "bFilter");
  if (typeof init.sScrollX === "boolean") {
    init.sScrollX = init.sScrollX ? "100%" : "";
  }
  if (typeof init.scrollX === "boolean") {
    init.scrollX = init.scrollX ? "100%" : "";
  }
  var searchCols = init.aoSearchCols;
  if (searchCols) {
    for (var i = 0, ien = searchCols.length; i < ien; i++) {
      if (searchCols[i]) {
        _fnCamelToHungarian(DataTable.models.oSearch, searchCols[i]);
      }
    }
  }
}
function _fnCompatCols(init) {
  _fnCompatMap(init, "orderable", "bSortable");
  _fnCompatMap(init, "orderData", "aDataSort");
  _fnCompatMap(init, "orderSequence", "asSorting");
  _fnCompatMap(init, "orderDataType", "sortDataType");
  var dataSort = init.aDataSort;
  if (typeof dataSort === "number" && !Array.isArray(dataSort)) {
    init.aDataSort = [dataSort];
  }
}
function _fnBrowserDetect(settings) {
  if (!DataTable.__browser) {
    var browser = {};
    DataTable.__browser = browser;
    var n = $("<div/>").css({
      position: "fixed",
      top: 0,
      left: $(window).scrollLeft() * -1,
      // allow for scrolling
      height: 1,
      width: 1,
      overflow: "hidden"
    }).append(
      $("<div/>").css({
        position: "absolute",
        top: 1,
        left: 1,
        width: 100,
        overflow: "scroll"
      }).append(
        $("<div/>").css({
          width: "100%",
          height: 10
        })
      )
    ).appendTo("body");
    var outer = n.children();
    var inner = outer.children();
    browser.barWidth = outer[0].offsetWidth - outer[0].clientWidth;
    browser.bScrollOversize = inner[0].offsetWidth === 100 && outer[0].clientWidth !== 100;
    browser.bScrollbarLeft = Math.round(inner.offset().left) !== 1;
    browser.bBounding = n[0].getBoundingClientRect().width ? true : false;
    n.remove();
  }
  $.extend(settings.oBrowser, DataTable.__browser);
  settings.oScroll.iBarWidth = DataTable.__browser.barWidth;
}
function _fnReduce(that, fn, init, start, end, inc) {
  var i = start, value, isSet = false;
  if (init !== void 0) {
    value = init;
    isSet = true;
  }
  while (i !== end) {
    if (!that.hasOwnProperty(i)) {
      continue;
    }
    value = isSet ? fn(value, that[i], i, that) : that[i];
    isSet = true;
    i += inc;
  }
  return value;
}
function _fnAddColumn(oSettings, nTh) {
  var oDefaults = DataTable.defaults.column;
  var iCol = oSettings.aoColumns.length;
  var oCol = $.extend({}, DataTable.models.oColumn, oDefaults, {
    "nTh": nTh ? nTh : document.createElement("th"),
    "sTitle": oDefaults.sTitle ? oDefaults.sTitle : nTh ? nTh.innerHTML : "",
    "aDataSort": oDefaults.aDataSort ? oDefaults.aDataSort : [iCol],
    "mData": oDefaults.mData ? oDefaults.mData : iCol,
    idx: iCol
  });
  oSettings.aoColumns.push(oCol);
  var searchCols = oSettings.aoPreSearchCols;
  searchCols[iCol] = $.extend({}, DataTable.models.oSearch, searchCols[iCol]);
  _fnColumnOptions(oSettings, iCol, $(nTh).data());
}
function _fnColumnOptions(oSettings, iCol, oOptions) {
  var oCol = oSettings.aoColumns[iCol];
  var oClasses = oSettings.oClasses;
  var th = $(oCol.nTh);
  if (!oCol.sWidthOrig) {
    oCol.sWidthOrig = th.attr("width") || null;
    var t = (th.attr("style") || "").match(/width:\s*(\d+[pxem%]+)/);
    if (t) {
      oCol.sWidthOrig = t[1];
    }
  }
  if (oOptions !== void 0 && oOptions !== null) {
    _fnCompatCols(oOptions);
    _fnCamelToHungarian(DataTable.defaults.column, oOptions, true);
    if (oOptions.mDataProp !== void 0 && !oOptions.mData) {
      oOptions.mData = oOptions.mDataProp;
    }
    if (oOptions.sType) {
      oCol._sManualType = oOptions.sType;
    }
    if (oOptions.className && !oOptions.sClass) {
      oOptions.sClass = oOptions.className;
    }
    if (oOptions.sClass) {
      th.addClass(oOptions.sClass);
    }
    var origClass = oCol.sClass;
    $.extend(oCol, oOptions);
    _fnMap(oCol, oOptions, "sWidth", "sWidthOrig");
    if (origClass !== oCol.sClass) {
      oCol.sClass = origClass + " " + oCol.sClass;
    }
    if (oOptions.iDataSort !== void 0) {
      oCol.aDataSort = [oOptions.iDataSort];
    }
    _fnMap(oCol, oOptions, "aDataSort");
    if (!oCol.ariaTitle) {
      oCol.ariaTitle = th.attr("aria-label");
    }
  }
  var mDataSrc = oCol.mData;
  var mData = _fnGetObjectDataFn(mDataSrc);
  var mRender = oCol.mRender ? _fnGetObjectDataFn(oCol.mRender) : null;
  var attrTest = function(src) {
    return typeof src === "string" && src.indexOf("@") !== -1;
  };
  oCol._bAttrSrc = $.isPlainObject(mDataSrc) && (attrTest(mDataSrc.sort) || attrTest(mDataSrc.type) || attrTest(mDataSrc.filter));
  oCol._setter = null;
  oCol.fnGetData = function(rowData, type, meta) {
    var innerData = mData(rowData, type, void 0, meta);
    return mRender && type ? mRender(innerData, type, rowData, meta) : innerData;
  };
  oCol.fnSetData = function(rowData, val, meta) {
    return _fnSetObjectDataFn(mDataSrc)(rowData, val, meta);
  };
  if (typeof mDataSrc !== "number" && !oCol._isArrayHost) {
    oSettings._rowReadObject = true;
  }
  if (!oSettings.oFeatures.bSort) {
    oCol.bSortable = false;
    th.addClass(oClasses.sSortableNone);
  }
  var bAsc = $.inArray("asc", oCol.asSorting) !== -1;
  var bDesc = $.inArray("desc", oCol.asSorting) !== -1;
  if (!oCol.bSortable || !bAsc && !bDesc) {
    oCol.sSortingClass = oClasses.sSortableNone;
    oCol.sSortingClassJUI = "";
  } else if (bAsc && !bDesc) {
    oCol.sSortingClass = oClasses.sSortableAsc;
    oCol.sSortingClassJUI = oClasses.sSortJUIAscAllowed;
  } else if (!bAsc && bDesc) {
    oCol.sSortingClass = oClasses.sSortableDesc;
    oCol.sSortingClassJUI = oClasses.sSortJUIDescAllowed;
  } else {
    oCol.sSortingClass = oClasses.sSortable;
    oCol.sSortingClassJUI = oClasses.sSortJUI;
  }
}
function _fnAdjustColumnSizing(settings) {
  if (settings.oFeatures.bAutoWidth !== false) {
    var columns = settings.aoColumns;
    _fnCalculateColumnWidths(settings);
    for (var i = 0, iLen = columns.length; i < iLen; i++) {
      columns[i].nTh.style.width = columns[i].sWidth;
    }
  }
  var scroll = settings.oScroll;
  if (scroll.sY !== "" || scroll.sX !== "") {
    _fnScrollDraw(settings);
  }
  _fnCallbackFire(settings, null, "column-sizing", [settings]);
}
function _fnVisibleToColumnIndex(oSettings, iMatch) {
  var aiVis = _fnGetColumns(oSettings, "bVisible");
  return typeof aiVis[iMatch] === "number" ? aiVis[iMatch] : null;
}
function _fnColumnIndexToVisible(oSettings, iMatch) {
  var aiVis = _fnGetColumns(oSettings, "bVisible");
  var iPos = $.inArray(iMatch, aiVis);
  return iPos !== -1 ? iPos : null;
}
function _fnVisbleColumns(oSettings) {
  var vis = 0;
  $.each(oSettings.aoColumns, function(i, col) {
    if (col.bVisible && $(col.nTh).css("display") !== "none") {
      vis++;
    }
  });
  return vis;
}
function _fnGetColumns(oSettings, sParam) {
  var a = [];
  $.map(oSettings.aoColumns, function(val, i) {
    if (val[sParam]) {
      a.push(i);
    }
  });
  return a;
}
function _fnColumnTypes(settings) {
  var columns = settings.aoColumns;
  var data = settings.aoData;
  var types = DataTable.ext.type.detect;
  var i, ien, j, jen, k, ken;
  var col, cell, detectedType, cache;
  for (i = 0, ien = columns.length; i < ien; i++) {
    col = columns[i];
    cache = [];
    if (!col.sType && col._sManualType) {
      col.sType = col._sManualType;
    } else if (!col.sType) {
      for (j = 0, jen = types.length; j < jen; j++) {
        for (k = 0, ken = data.length; k < ken; k++) {
          if (cache[k] === void 0) {
            cache[k] = _fnGetCellData(settings, k, i, "type");
          }
          detectedType = types[j](cache[k], settings);
          if (!detectedType && j !== types.length - 1) {
            break;
          }
          if (detectedType === "html" && !_empty(cache[k])) {
            break;
          }
        }
        if (detectedType) {
          col.sType = detectedType;
          break;
        }
      }
      if (!col.sType) {
        col.sType = "string";
      }
    }
  }
}
function _fnApplyColumnDefs(oSettings, aoColDefs, aoCols, fn) {
  var i, iLen, j, jLen, k, kLen, def;
  var columns = oSettings.aoColumns;
  if (aoColDefs) {
    for (i = aoColDefs.length - 1; i >= 0; i--) {
      def = aoColDefs[i];
      var aTargets = def.target !== void 0 ? def.target : def.targets !== void 0 ? def.targets : def.aTargets;
      if (!Array.isArray(aTargets)) {
        aTargets = [aTargets];
      }
      for (j = 0, jLen = aTargets.length; j < jLen; j++) {
        if (typeof aTargets[j] === "number" && aTargets[j] >= 0) {
          while (columns.length <= aTargets[j]) {
            _fnAddColumn(oSettings);
          }
          fn(aTargets[j], def);
        } else if (typeof aTargets[j] === "number" && aTargets[j] < 0) {
          fn(columns.length + aTargets[j], def);
        } else if (typeof aTargets[j] === "string") {
          for (k = 0, kLen = columns.length; k < kLen; k++) {
            if (aTargets[j] == "_all" || $(columns[k].nTh).hasClass(aTargets[j])) {
              fn(k, def);
            }
          }
        }
      }
    }
  }
  if (aoCols) {
    for (i = 0, iLen = aoCols.length; i < iLen; i++) {
      fn(i, aoCols[i]);
    }
  }
}
function _fnAddData(oSettings, aDataIn, nTr, anTds) {
  var iRow = oSettings.aoData.length;
  var oData = $.extend(true, {}, DataTable.models.oRow, {
    src: nTr ? "dom" : "data",
    idx: iRow
  });
  oData._aData = aDataIn;
  oSettings.aoData.push(oData);
  var nTd, sThisType;
  var columns = oSettings.aoColumns;
  for (var i = 0, iLen = columns.length; i < iLen; i++) {
    columns[i].sType = null;
  }
  oSettings.aiDisplayMaster.push(iRow);
  var id = oSettings.rowIdFn(aDataIn);
  if (id !== void 0) {
    oSettings.aIds[id] = oData;
  }
  if (nTr || !oSettings.oFeatures.bDeferRender) {
    _fnCreateTr(oSettings, iRow, nTr, anTds);
  }
  return iRow;
}
function _fnAddTr(settings, trs) {
  var row;
  if (!(trs instanceof $)) {
    trs = $(trs);
  }
  return trs.map(function(i, el) {
    row = _fnGetRowElements(settings, el);
    return _fnAddData(settings, row.data, el, row.cells);
  });
}
function _fnNodeToDataIndex(oSettings, n) {
  return n._DT_RowIndex !== void 0 ? n._DT_RowIndex : null;
}
function _fnNodeToColumnIndex(oSettings, iRow, n) {
  return $.inArray(n, oSettings.aoData[iRow].anCells);
}
function _fnGetCellData(settings, rowIdx, colIdx, type) {
  if (type === "search") {
    type = "filter";
  } else if (type === "order") {
    type = "sort";
  }
  var draw = settings.iDraw;
  var col = settings.aoColumns[colIdx];
  var rowData = settings.aoData[rowIdx]._aData;
  var defaultContent = col.sDefaultContent;
  var cellData = col.fnGetData(rowData, type, {
    settings,
    row: rowIdx,
    col: colIdx
  });
  if (cellData === void 0) {
    if (settings.iDrawError != draw && defaultContent === null) {
      _fnLog(settings, 0, "Requested unknown parameter " + (typeof col.mData == "function" ? "{function}" : "'" + col.mData + "'") + " for row " + rowIdx + ", column " + colIdx, 4);
      settings.iDrawError = draw;
    }
    return defaultContent;
  }
  if ((cellData === rowData || cellData === null) && defaultContent !== null && type !== void 0) {
    cellData = defaultContent;
  } else if (typeof cellData === "function") {
    return cellData.call(rowData);
  }
  if (cellData === null && type === "display") {
    return "";
  }
  if (type === "filter") {
    var fomatters = DataTable.ext.type.search;
    if (fomatters[col.sType]) {
      cellData = fomatters[col.sType](cellData);
    }
  }
  return cellData;
}
function _fnSetCellData(settings, rowIdx, colIdx, val) {
  var col = settings.aoColumns[colIdx];
  var rowData = settings.aoData[rowIdx]._aData;
  col.fnSetData(rowData, val, {
    settings,
    row: rowIdx,
    col: colIdx
  });
}
function _fnSplitObjNotation(str) {
  return $.map(str.match(/(\\.|[^\.])+/g) || [""], function(s) {
    return s.replace(/\\\./g, ".");
  });
}
function _fnGetDataMaster(settings) {
  return _pluck(settings.aoData, "_aData");
}
function _fnClearTable(settings) {
  settings.aoData.length = 0;
  settings.aiDisplayMaster.length = 0;
  settings.aiDisplay.length = 0;
  settings.aIds = {};
}
function _fnDeleteIndex(a, iTarget, splice) {
  var iTargetIndex = -1;
  for (var i = 0, iLen = a.length; i < iLen; i++) {
    if (a[i] == iTarget) {
      iTargetIndex = i;
    } else if (a[i] > iTarget) {
      a[i]--;
    }
  }
  if (iTargetIndex != -1 && splice === void 0) {
    a.splice(iTargetIndex, 1);
  }
}
function _fnInvalidate(settings, rowIdx, src, colIdx) {
  var row = settings.aoData[rowIdx];
  var i, ien;
  var cellWrite = function(cell, col) {
    while (cell.childNodes.length) {
      cell.removeChild(cell.firstChild);
    }
    cell.innerHTML = _fnGetCellData(settings, rowIdx, col, "display");
  };
  if (src === "dom" || (!src || src === "auto") && row.src === "dom") {
    row._aData = _fnGetRowElements(
      settings,
      row,
      colIdx,
      colIdx === void 0 ? void 0 : row._aData
    ).data;
  } else {
    var cells = row.anCells;
    if (cells) {
      if (colIdx !== void 0) {
        cellWrite(cells[colIdx], colIdx);
      } else {
        for (i = 0, ien = cells.length; i < ien; i++) {
          cellWrite(cells[i], i);
        }
      }
    }
  }
  row._aSortData = null;
  row._aFilterData = null;
  var cols = settings.aoColumns;
  if (colIdx !== void 0) {
    cols[colIdx].sType = null;
  } else {
    for (i = 0, ien = cols.length; i < ien; i++) {
      cols[i].sType = null;
    }
    _fnRowAttributes(settings, row);
  }
}
function _fnGetRowElements(settings, row, colIdx, d) {
  var tds = [], td = row.firstChild, name, col, o, i = 0, contents, columns = settings.aoColumns, objectRead = settings._rowReadObject;
  d = d !== void 0 ? d : objectRead ? {} : [];
  var attr = function(str, td2) {
    if (typeof str === "string") {
      var idx = str.indexOf("@");
      if (idx !== -1) {
        var attr2 = str.substring(idx + 1);
        var setter = _fnSetObjectDataFn(str);
        setter(d, td2.getAttribute(attr2));
      }
    }
  };
  var cellProcess = function(cell) {
    if (colIdx === void 0 || colIdx === i) {
      col = columns[i];
      contents = cell.innerHTML.trim();
      if (col && col._bAttrSrc) {
        var setter = _fnSetObjectDataFn(col.mData._);
        setter(d, contents);
        attr(col.mData.sort, cell);
        attr(col.mData.type, cell);
        attr(col.mData.filter, cell);
      } else {
        if (objectRead) {
          if (!col._setter) {
            col._setter = _fnSetObjectDataFn(col.mData);
          }
          col._setter(d, contents);
        } else {
          d[i] = contents;
        }
      }
    }
    i++;
  };
  if (td) {
    while (td) {
      name = td.nodeName.toUpperCase();
      if (name == "TD" || name == "TH") {
        cellProcess(td);
        tds.push(td);
      }
      td = td.nextSibling;
    }
  } else {
    tds = row.anCells;
    for (var j = 0, jen = tds.length; j < jen; j++) {
      cellProcess(tds[j]);
    }
  }
  var rowNode = row.firstChild ? row : row.nTr;
  if (rowNode) {
    var id = rowNode.getAttribute("id");
    if (id) {
      _fnSetObjectDataFn(settings.rowId)(d, id);
    }
  }
  return {
    data: d,
    cells: tds
  };
}
function _fnCreateTr(oSettings, iRow, nTrIn, anTds) {
  var row = oSettings.aoData[iRow], rowData = row._aData, cells = [], nTr, nTd, oCol, i, iLen, create;
  if (row.nTr === null) {
    nTr = nTrIn || document.createElement("tr");
    row.nTr = nTr;
    row.anCells = cells;
    nTr._DT_RowIndex = iRow;
    _fnRowAttributes(oSettings, row);
    for (i = 0, iLen = oSettings.aoColumns.length; i < iLen; i++) {
      oCol = oSettings.aoColumns[i];
      create = nTrIn ? false : true;
      nTd = create ? document.createElement(oCol.sCellType) : anTds[i];
      if (!nTd) {
        _fnLog(oSettings, 0, "Incorrect column count", 18);
      }
      nTd._DT_CellIndex = {
        row: iRow,
        column: i
      };
      cells.push(nTd);
      if (create || (oCol.mRender || oCol.mData !== i) && (!$.isPlainObject(oCol.mData) || oCol.mData._ !== i + ".display")) {
        nTd.innerHTML = _fnGetCellData(oSettings, iRow, i, "display");
      }
      if (oCol.sClass) {
        nTd.className += " " + oCol.sClass;
      }
      if (oCol.bVisible && !nTrIn) {
        nTr.appendChild(nTd);
      } else if (!oCol.bVisible && nTrIn) {
        nTd.parentNode.removeChild(nTd);
      }
      if (oCol.fnCreatedCell) {
        oCol.fnCreatedCell.call(
          oSettings.oInstance,
          nTd,
          _fnGetCellData(oSettings, iRow, i),
          rowData,
          iRow,
          i
        );
      }
    }
    _fnCallbackFire(oSettings, "aoRowCreatedCallback", null, [nTr, rowData, iRow, cells]);
  }
}
function _fnRowAttributes(settings, row) {
  var tr = row.nTr;
  var data = row._aData;
  if (tr) {
    var id = settings.rowIdFn(data);
    if (id) {
      tr.id = id;
    }
    if (data.DT_RowClass) {
      var a = data.DT_RowClass.split(" ");
      row.__rowc = row.__rowc ? _unique(row.__rowc.concat(a)) : a;
      $(tr).removeClass(row.__rowc.join(" ")).addClass(data.DT_RowClass);
    }
    if (data.DT_RowAttr) {
      $(tr).attr(data.DT_RowAttr);
    }
    if (data.DT_RowData) {
      $(tr).data(data.DT_RowData);
    }
  }
}
function _fnBuildHead(oSettings) {
  var i, ien, cell, row, column;
  var thead = oSettings.nTHead;
  var tfoot = oSettings.nTFoot;
  var createHeader = $("th, td", thead).length === 0;
  var classes = oSettings.oClasses;
  var columns = oSettings.aoColumns;
  if (createHeader) {
    row = $("<tr/>").appendTo(thead);
  }
  for (i = 0, ien = columns.length; i < ien; i++) {
    column = columns[i];
    cell = $(column.nTh).addClass(column.sClass);
    if (createHeader) {
      cell.appendTo(row);
    }
    if (oSettings.oFeatures.bSort) {
      cell.addClass(column.sSortingClass);
      if (column.bSortable !== false) {
        cell.attr("tabindex", oSettings.iTabIndex).attr("aria-controls", oSettings.sTableId);
        _fnSortAttachListener(oSettings, column.nTh, i);
      }
    }
    if (column.sTitle != cell[0].innerHTML) {
      cell.html(column.sTitle);
    }
    _fnRenderer(oSettings, "header")(
      oSettings,
      cell,
      column,
      classes
    );
  }
  if (createHeader) {
    _fnDetectHeader(oSettings.aoHeader, thead);
  }
  $(thead).children("tr").children("th, td").addClass(classes.sHeaderTH);
  $(tfoot).children("tr").children("th, td").addClass(classes.sFooterTH);
  if (tfoot !== null) {
    var cells = oSettings.aoFooter[0];
    for (i = 0, ien = cells.length; i < ien; i++) {
      column = columns[i];
      if (column) {
        column.nTf = cells[i].cell;
        if (column.sClass) {
          $(column.nTf).addClass(column.sClass);
        }
      } else {
        _fnLog(oSettings, 0, "Incorrect column count", 18);
      }
    }
  }
}
function _fnDrawHead(oSettings, aoSource, bIncludeHidden) {
  var i, iLen, j, jLen, k, kLen, n, nLocalTr;
  var aoLocal = [];
  var aApplied = [];
  var iColumns = oSettings.aoColumns.length;
  var iRowspan, iColspan;
  if (!aoSource) {
    return;
  }
  if (bIncludeHidden === void 0) {
    bIncludeHidden = false;
  }
  for (i = 0, iLen = aoSource.length; i < iLen; i++) {
    aoLocal[i] = aoSource[i].slice();
    aoLocal[i].nTr = aoSource[i].nTr;
    for (j = iColumns - 1; j >= 0; j--) {
      if (!oSettings.aoColumns[j].bVisible && !bIncludeHidden) {
        aoLocal[i].splice(j, 1);
      }
    }
    aApplied.push([]);
  }
  for (i = 0, iLen = aoLocal.length; i < iLen; i++) {
    nLocalTr = aoLocal[i].nTr;
    if (nLocalTr) {
      while (n = nLocalTr.firstChild) {
        nLocalTr.removeChild(n);
      }
    }
    for (j = 0, jLen = aoLocal[i].length; j < jLen; j++) {
      iRowspan = 1;
      iColspan = 1;
      if (aApplied[i][j] === void 0) {
        nLocalTr.appendChild(aoLocal[i][j].cell);
        aApplied[i][j] = 1;
        while (aoLocal[i + iRowspan] !== void 0 && aoLocal[i][j].cell == aoLocal[i + iRowspan][j].cell) {
          aApplied[i + iRowspan][j] = 1;
          iRowspan++;
        }
        while (aoLocal[i][j + iColspan] !== void 0 && aoLocal[i][j].cell == aoLocal[i][j + iColspan].cell) {
          for (k = 0; k < iRowspan; k++) {
            aApplied[i + k][j + iColspan] = 1;
          }
          iColspan++;
        }
        $(aoLocal[i][j].cell).attr("rowspan", iRowspan).attr("colspan", iColspan);
      }
    }
  }
}
function _fnDraw(oSettings, ajaxComplete) {
  _fnStart(oSettings);
  var aPreDraw = _fnCallbackFire(oSettings, "aoPreDrawCallback", "preDraw", [oSettings]);
  if ($.inArray(false, aPreDraw) !== -1) {
    _fnProcessingDisplay(oSettings, false);
    return;
  }
  var anRows = [];
  var iRowCount = 0;
  var asStripeClasses = oSettings.asStripeClasses;
  var iStripes = asStripeClasses.length;
  var oLang = oSettings.oLanguage;
  var bServerSide = _fnDataSource(oSettings) == "ssp";
  var aiDisplay = oSettings.aiDisplay;
  var iDisplayStart = oSettings._iDisplayStart;
  var iDisplayEnd = oSettings.fnDisplayEnd();
  oSettings.bDrawing = true;
  if (oSettings.bDeferLoading) {
    oSettings.bDeferLoading = false;
    oSettings.iDraw++;
    _fnProcessingDisplay(oSettings, false);
  } else if (!bServerSide) {
    oSettings.iDraw++;
  } else if (!oSettings.bDestroying && !ajaxComplete) {
    _fnAjaxUpdate(oSettings);
    return;
  }
  if (aiDisplay.length !== 0) {
    var iStart = bServerSide ? 0 : iDisplayStart;
    var iEnd = bServerSide ? oSettings.aoData.length : iDisplayEnd;
    for (var j = iStart; j < iEnd; j++) {
      var iDataIndex = aiDisplay[j];
      var aoData = oSettings.aoData[iDataIndex];
      if (aoData.nTr === null) {
        _fnCreateTr(oSettings, iDataIndex);
      }
      var nRow = aoData.nTr;
      if (iStripes !== 0) {
        var sStripe = asStripeClasses[iRowCount % iStripes];
        if (aoData._sRowStripe != sStripe) {
          $(nRow).removeClass(aoData._sRowStripe).addClass(sStripe);
          aoData._sRowStripe = sStripe;
        }
      }
      _fnCallbackFire(
        oSettings,
        "aoRowCallback",
        null,
        [nRow, aoData._aData, iRowCount, j, iDataIndex]
      );
      anRows.push(nRow);
      iRowCount++;
    }
  } else {
    var sZero = oLang.sZeroRecords;
    if (oSettings.iDraw == 1 && _fnDataSource(oSettings) == "ajax") {
      sZero = oLang.sLoadingRecords;
    } else if (oLang.sEmptyTable && oSettings.fnRecordsTotal() === 0) {
      sZero = oLang.sEmptyTable;
    }
    anRows[0] = $("<tr/>", { "class": iStripes ? asStripeClasses[0] : "" }).append($("<td />", {
      "valign": "top",
      "colSpan": _fnVisbleColumns(oSettings),
      "class": oSettings.oClasses.sRowEmpty
    }).html(sZero))[0];
  }
  _fnCallbackFire(oSettings, "aoHeaderCallback", "header", [
    $(oSettings.nTHead).children("tr")[0],
    _fnGetDataMaster(oSettings),
    iDisplayStart,
    iDisplayEnd,
    aiDisplay
  ]);
  _fnCallbackFire(oSettings, "aoFooterCallback", "footer", [
    $(oSettings.nTFoot).children("tr")[0],
    _fnGetDataMaster(oSettings),
    iDisplayStart,
    iDisplayEnd,
    aiDisplay
  ]);
  var body = $(oSettings.nTBody);
  body.children().detach();
  body.append($(anRows));
  _fnCallbackFire(oSettings, "aoDrawCallback", "draw", [oSettings]);
  oSettings.bSorted = false;
  oSettings.bFiltered = false;
  oSettings.bDrawing = false;
}
function _fnReDraw(settings, holdPosition) {
  var features = settings.oFeatures, sort = features.bSort, filter = features.bFilter;
  if (sort) {
    _fnSort(settings);
  }
  if (filter) {
    _fnFilterComplete(settings, settings.oPreviousSearch);
  } else {
    settings.aiDisplay = settings.aiDisplayMaster.slice();
  }
  if (holdPosition !== true) {
    settings._iDisplayStart = 0;
  }
  settings._drawHold = holdPosition;
  _fnDraw(settings);
  settings._drawHold = false;
}
function _fnAddOptionsHtml(oSettings) {
  var classes = oSettings.oClasses;
  var table = $(oSettings.nTable);
  var holding = $("<div/>").insertBefore(table);
  var features = oSettings.oFeatures;
  var insert = $("<div/>", {
    id: oSettings.sTableId + "_wrapper",
    "class": classes.sWrapper + (oSettings.nTFoot ? "" : " " + classes.sNoFooter)
  });
  oSettings.nHolding = holding[0];
  oSettings.nTableWrapper = insert[0];
  oSettings.nTableReinsertBefore = oSettings.nTable.nextSibling;
  var aDom = oSettings.sDom.split("");
  var featureNode, cOption, nNewNode, cNext, sAttr, j;
  for (var i = 0; i < aDom.length; i++) {
    featureNode = null;
    cOption = aDom[i];
    if (cOption == "<") {
      nNewNode = $("<div/>")[0];
      cNext = aDom[i + 1];
      if (cNext == "'" || cNext == '"') {
        sAttr = "";
        j = 2;
        while (aDom[i + j] != cNext) {
          sAttr += aDom[i + j];
          j++;
        }
        if (sAttr == "H") {
          sAttr = classes.sJUIHeader;
        } else if (sAttr == "F") {
          sAttr = classes.sJUIFooter;
        }
        if (sAttr.indexOf(".") != -1) {
          var aSplit = sAttr.split(".");
          nNewNode.id = aSplit[0].substr(1, aSplit[0].length - 1);
          nNewNode.className = aSplit[1];
        } else if (sAttr.charAt(0) == "#") {
          nNewNode.id = sAttr.substr(1, sAttr.length - 1);
        } else {
          nNewNode.className = sAttr;
        }
        i += j;
      }
      insert.append(nNewNode);
      insert = $(nNewNode);
    } else if (cOption == ">") {
      insert = insert.parent();
    } else if (cOption == "l" && features.bPaginate && features.bLengthChange) {
      featureNode = _fnFeatureHtmlLength(oSettings);
    } else if (cOption == "f" && features.bFilter) {
      featureNode = _fnFeatureHtmlFilter(oSettings);
    } else if (cOption == "r" && features.bProcessing) {
      featureNode = _fnFeatureHtmlProcessing(oSettings);
    } else if (cOption == "t") {
      featureNode = _fnFeatureHtmlTable(oSettings);
    } else if (cOption == "i" && features.bInfo) {
      featureNode = _fnFeatureHtmlInfo(oSettings);
    } else if (cOption == "p" && features.bPaginate) {
      featureNode = _fnFeatureHtmlPaginate(oSettings);
    } else if (DataTable.ext.feature.length !== 0) {
      var aoFeatures = DataTable.ext.feature;
      for (var k = 0, kLen = aoFeatures.length; k < kLen; k++) {
        if (cOption == aoFeatures[k].cFeature) {
          featureNode = aoFeatures[k].fnInit(oSettings);
          break;
        }
      }
    }
    if (featureNode) {
      var aanFeatures = oSettings.aanFeatures;
      if (!aanFeatures[cOption]) {
        aanFeatures[cOption] = [];
      }
      aanFeatures[cOption].push(featureNode);
      insert.append(featureNode);
    }
  }
  holding.replaceWith(insert);
  oSettings.nHolding = null;
}
function _fnDetectHeader(aLayout, nThead) {
  var nTrs = $(nThead).children("tr");
  var nTr, nCell;
  var i, k, l, iLen, jLen, iColShifted, iColumn, iColspan, iRowspan;
  var bUnique;
  var fnShiftCol = function(a, i2, j) {
    var k2 = a[i2];
    while (k2[j]) {
      j++;
    }
    return j;
  };
  aLayout.splice(0, aLayout.length);
  for (i = 0, iLen = nTrs.length; i < iLen; i++) {
    aLayout.push([]);
  }
  for (i = 0, iLen = nTrs.length; i < iLen; i++) {
    nTr = nTrs[i];
    iColumn = 0;
    nCell = nTr.firstChild;
    while (nCell) {
      if (nCell.nodeName.toUpperCase() == "TD" || nCell.nodeName.toUpperCase() == "TH") {
        iColspan = nCell.getAttribute("colspan") * 1;
        iRowspan = nCell.getAttribute("rowspan") * 1;
        iColspan = !iColspan || iColspan === 0 || iColspan === 1 ? 1 : iColspan;
        iRowspan = !iRowspan || iRowspan === 0 || iRowspan === 1 ? 1 : iRowspan;
        iColShifted = fnShiftCol(aLayout, i, iColumn);
        bUnique = iColspan === 1 ? true : false;
        for (l = 0; l < iColspan; l++) {
          for (k = 0; k < iRowspan; k++) {
            aLayout[i + k][iColShifted + l] = {
              "cell": nCell,
              "unique": bUnique
            };
            aLayout[i + k].nTr = nTr;
          }
        }
      }
      nCell = nCell.nextSibling;
    }
  }
}
function _fnGetUniqueThs(oSettings, nHeader, aLayout) {
  var aReturn = [];
  if (!aLayout) {
    aLayout = oSettings.aoHeader;
    if (nHeader) {
      aLayout = [];
      _fnDetectHeader(aLayout, nHeader);
    }
  }
  for (var i = 0, iLen = aLayout.length; i < iLen; i++) {
    for (var j = 0, jLen = aLayout[i].length; j < jLen; j++) {
      if (aLayout[i][j].unique && (!aReturn[j] || !oSettings.bSortCellsTop)) {
        aReturn[j] = aLayout[i][j].cell;
      }
    }
  }
  return aReturn;
}
function _fnStart(oSettings) {
  var bServerSide = _fnDataSource(oSettings) == "ssp";
  var iInitDisplayStart = oSettings.iInitDisplayStart;
  if (iInitDisplayStart !== void 0 && iInitDisplayStart !== -1) {
    oSettings._iDisplayStart = bServerSide ? iInitDisplayStart : iInitDisplayStart >= oSettings.fnRecordsDisplay() ? 0 : iInitDisplayStart;
    oSettings.iInitDisplayStart = -1;
  }
}
function _fnBuildAjax(oSettings, data, fn) {
  _fnCallbackFire(oSettings, "aoServerParams", "serverParams", [data]);
  if (data && Array.isArray(data)) {
    var tmp = {};
    var rbracket = /(.*?)\[\]$/;
    $.each(data, function(key, val) {
      var match = val.name.match(rbracket);
      if (match) {
        var name = match[0];
        if (!tmp[name]) {
          tmp[name] = [];
        }
        tmp[name].push(val.value);
      } else {
        tmp[val.name] = val.value;
      }
    });
    data = tmp;
  }
  var ajaxData;
  var ajax = oSettings.ajax;
  var instance = oSettings.oInstance;
  var callback = function(json) {
    var status = oSettings.jqXHR ? oSettings.jqXHR.status : null;
    if (json === null || typeof status === "number" && status == 204) {
      json = {};
      _fnAjaxDataSrc(oSettings, json, []);
    }
    var error = json.error || json.sError;
    if (error) {
      _fnLog(oSettings, 0, error);
    }
    oSettings.json = json;
    _fnCallbackFire(oSettings, null, "xhr", [oSettings, json, oSettings.jqXHR]);
    fn(json);
  };
  if ($.isPlainObject(ajax) && ajax.data) {
    ajaxData = ajax.data;
    var newData = typeof ajaxData === "function" ? ajaxData(data, oSettings) : (
      // fn can manipulate data or return
      ajaxData
    );
    data = typeof ajaxData === "function" && newData ? newData : $.extend(true, data, newData);
    delete ajax.data;
  }
  var baseAjax = {
    "data": data,
    "success": callback,
    "dataType": "json",
    "cache": false,
    "type": oSettings.sServerMethod,
    "error": function(xhr, error, thrown) {
      var ret = _fnCallbackFire(oSettings, null, "xhr", [oSettings, null, oSettings.jqXHR]);
      if ($.inArray(true, ret) === -1) {
        if (error == "parsererror") {
          _fnLog(oSettings, 0, "Invalid JSON response", 1);
        } else if (xhr.readyState === 4) {
          _fnLog(oSettings, 0, "Ajax error", 7);
        }
      }
      _fnProcessingDisplay(oSettings, false);
    }
  };
  oSettings.oAjaxData = data;
  _fnCallbackFire(oSettings, null, "preXhr", [oSettings, data]);
  if (oSettings.fnServerData) {
    oSettings.fnServerData.call(
      instance,
      oSettings.sAjaxSource,
      $.map(data, function(val, key) {
        return { name: key, value: val };
      }),
      callback,
      oSettings
    );
  } else if (oSettings.sAjaxSource || typeof ajax === "string") {
    oSettings.jqXHR = $.ajax($.extend(baseAjax, {
      url: ajax || oSettings.sAjaxSource
    }));
  } else if (typeof ajax === "function") {
    oSettings.jqXHR = ajax.call(instance, data, callback, oSettings);
  } else {
    oSettings.jqXHR = $.ajax($.extend(baseAjax, ajax));
    ajax.data = ajaxData;
  }
}
function _fnAjaxUpdate(settings) {
  settings.iDraw++;
  _fnProcessingDisplay(settings, true);
  var drawHold = settings._drawHold;
  _fnBuildAjax(
    settings,
    _fnAjaxParameters(settings),
    function(json) {
      settings._drawHold = drawHold;
      _fnAjaxUpdateDraw(settings, json);
      settings._drawHold = false;
    }
  );
}
function _fnAjaxParameters(settings) {
  var columns = settings.aoColumns, columnCount = columns.length, features = settings.oFeatures, preSearch = settings.oPreviousSearch, preColSearch = settings.aoPreSearchCols, i, data = [], dataProp, column, columnSearch, sort = _fnSortFlatten(settings), displayStart = settings._iDisplayStart, displayLength = features.bPaginate !== false ? settings._iDisplayLength : -1;
  var param = function(name, value) {
    data.push({ "name": name, "value": value });
  };
  param("sEcho", settings.iDraw);
  param("iColumns", columnCount);
  param("sColumns", _pluck(columns, "sName").join(","));
  param("iDisplayStart", displayStart);
  param("iDisplayLength", displayLength);
  var d = {
    draw: settings.iDraw,
    columns: [],
    order: [],
    start: displayStart,
    length: displayLength,
    search: {
      value: preSearch.sSearch,
      regex: preSearch.bRegex
    }
  };
  for (i = 0; i < columnCount; i++) {
    column = columns[i];
    columnSearch = preColSearch[i];
    dataProp = typeof column.mData == "function" ? "function" : column.mData;
    d.columns.push({
      data: dataProp,
      name: column.sName,
      searchable: column.bSearchable,
      orderable: column.bSortable,
      search: {
        value: columnSearch.sSearch,
        regex: columnSearch.bRegex
      }
    });
    param("mDataProp_" + i, dataProp);
    if (features.bFilter) {
      param("sSearch_" + i, columnSearch.sSearch);
      param("bRegex_" + i, columnSearch.bRegex);
      param("bSearchable_" + i, column.bSearchable);
    }
    if (features.bSort) {
      param("bSortable_" + i, column.bSortable);
    }
  }
  if (features.bFilter) {
    param("sSearch", preSearch.sSearch);
    param("bRegex", preSearch.bRegex);
  }
  if (features.bSort) {
    $.each(sort, function(i2, val) {
      d.order.push({ column: val.col, dir: val.dir });
      param("iSortCol_" + i2, val.col);
      param("sSortDir_" + i2, val.dir);
    });
    param("iSortingCols", sort.length);
  }
  var legacy = DataTable.ext.legacy.ajax;
  if (legacy === null) {
    return settings.sAjaxSource ? data : d;
  }
  return legacy ? data : d;
}
function _fnAjaxUpdateDraw(settings, json) {
  var compat = function(old, modern) {
    return json[old] !== void 0 ? json[old] : json[modern];
  };
  var data = _fnAjaxDataSrc(settings, json);
  var draw = compat("sEcho", "draw");
  var recordsTotal = compat("iTotalRecords", "recordsTotal");
  var recordsFiltered = compat("iTotalDisplayRecords", "recordsFiltered");
  if (draw !== void 0) {
    if (draw * 1 < settings.iDraw) {
      return;
    }
    settings.iDraw = draw * 1;
  }
  if (!data) {
    data = [];
  }
  _fnClearTable(settings);
  settings._iRecordsTotal = parseInt(recordsTotal, 10);
  settings._iRecordsDisplay = parseInt(recordsFiltered, 10);
  for (var i = 0, ien = data.length; i < ien; i++) {
    _fnAddData(settings, data[i]);
  }
  settings.aiDisplay = settings.aiDisplayMaster.slice();
  _fnDraw(settings, true);
  if (!settings._bInitComplete) {
    _fnInitComplete(settings, json);
  }
  _fnProcessingDisplay(settings, false);
}
function _fnAjaxDataSrc(oSettings, json, write) {
  var dataSrc = $.isPlainObject(oSettings.ajax) && oSettings.ajax.dataSrc !== void 0 ? oSettings.ajax.dataSrc : oSettings.sAjaxDataProp;
  if (!write) {
    if (dataSrc === "data") {
      return json.aaData || json[dataSrc];
    }
    return dataSrc !== "" ? _fnGetObjectDataFn(dataSrc)(json) : json;
  }
  _fnSetObjectDataFn(dataSrc)(json, write);
}
function _fnFeatureHtmlFilter(settings) {
  var classes = settings.oClasses;
  var tableId = settings.sTableId;
  var language = settings.oLanguage;
  var previousSearch = settings.oPreviousSearch;
  var features = settings.aanFeatures;
  var input = '<input type="search" class="' + classes.sFilterInput + '"/>';
  var str = language.sSearch;
  str = str.match(/_INPUT_/) ? str.replace("_INPUT_", input) : str + input;
  var filter = $("<div/>", {
    "id": !features.f ? tableId + "_filter" : null,
    "class": classes.sFilter
  }).append($("<label/>").append(str));
  var searchFn = function(event) {
    var n = features.f;
    var val = !this.value ? "" : this.value;
    if (previousSearch["return"] && event.key !== "Enter") {
      return;
    }
    if (val != previousSearch.sSearch) {
      _fnFilterComplete(settings, {
        "sSearch": val,
        "bRegex": previousSearch.bRegex,
        "bSmart": previousSearch.bSmart,
        "bCaseInsensitive": previousSearch.bCaseInsensitive,
        "return": previousSearch["return"]
      });
      settings._iDisplayStart = 0;
      _fnDraw(settings);
    }
  };
  var searchDelay = settings.searchDelay !== null ? settings.searchDelay : _fnDataSource(settings) === "ssp" ? 400 : 0;
  var jqFilter = $("input", filter).val(previousSearch.sSearch).attr("placeholder", language.sSearchPlaceholder).on(
    "keyup.DT search.DT input.DT paste.DT cut.DT",
    searchDelay ? _fnThrottle(searchFn, searchDelay) : searchFn
  ).on("mouseup.DT", function(e) {
    setTimeout(function() {
      searchFn.call(jqFilter[0], e);
    }, 10);
  }).on("keypress.DT", function(e) {
    if (e.keyCode == 13) {
      return false;
    }
  }).attr("aria-controls", tableId);
  $(settings.nTable).on("search.dt.DT", function(ev, s) {
    if (settings === s) {
      try {
        if (jqFilter[0] !== document.activeElement) {
          jqFilter.val(previousSearch.sSearch);
        }
      } catch (e) {
      }
    }
  });
  return filter[0];
}
function _fnFilterComplete(oSettings, oInput, iForce) {
  var oPrevSearch = oSettings.oPreviousSearch;
  var aoPrevSearch = oSettings.aoPreSearchCols;
  var fnSaveFilter = function(oFilter) {
    oPrevSearch.sSearch = oFilter.sSearch;
    oPrevSearch.bRegex = oFilter.bRegex;
    oPrevSearch.bSmart = oFilter.bSmart;
    oPrevSearch.bCaseInsensitive = oFilter.bCaseInsensitive;
    oPrevSearch["return"] = oFilter["return"];
  };
  var fnRegex = function(o) {
    return o.bEscapeRegex !== void 0 ? !o.bEscapeRegex : o.bRegex;
  };
  _fnColumnTypes(oSettings);
  if (_fnDataSource(oSettings) != "ssp") {
    _fnFilter(oSettings, oInput.sSearch, iForce, fnRegex(oInput), oInput.bSmart, oInput.bCaseInsensitive);
    fnSaveFilter(oInput);
    for (var i = 0; i < aoPrevSearch.length; i++) {
      _fnFilterColumn(
        oSettings,
        aoPrevSearch[i].sSearch,
        i,
        fnRegex(aoPrevSearch[i]),
        aoPrevSearch[i].bSmart,
        aoPrevSearch[i].bCaseInsensitive
      );
    }
    _fnFilterCustom(oSettings);
  } else {
    fnSaveFilter(oInput);
  }
  oSettings.bFiltered = true;
  _fnCallbackFire(oSettings, null, "search", [oSettings]);
}
function _fnFilterCustom(settings) {
  var filters = DataTable.ext.search;
  var displayRows = settings.aiDisplay;
  var row, rowIdx;
  for (var i = 0, ien = filters.length; i < ien; i++) {
    var rows = [];
    for (var j = 0, jen = displayRows.length; j < jen; j++) {
      rowIdx = displayRows[j];
      row = settings.aoData[rowIdx];
      if (filters[i](settings, row._aFilterData, rowIdx, row._aData, j)) {
        rows.push(rowIdx);
      }
    }
    displayRows.length = 0;
    $.merge(displayRows, rows);
  }
}
function _fnFilterColumn(settings, searchStr, colIdx, regex, smart, caseInsensitive) {
  if (searchStr === "") {
    return;
  }
  var data;
  var out = [];
  var display = settings.aiDisplay;
  var rpSearch = _fnFilterCreateSearch(searchStr, regex, smart, caseInsensitive);
  for (var i = 0; i < display.length; i++) {
    data = settings.aoData[display[i]]._aFilterData[colIdx];
    if (rpSearch.test(data)) {
      out.push(display[i]);
    }
  }
  settings.aiDisplay = out;
}
function _fnFilter(settings, input, force, regex, smart, caseInsensitive) {
  var rpSearch = _fnFilterCreateSearch(input, regex, smart, caseInsensitive);
  var prevSearch = settings.oPreviousSearch.sSearch;
  var displayMaster = settings.aiDisplayMaster;
  var display, invalidated, i;
  var filtered = [];
  if (DataTable.ext.search.length !== 0) {
    force = true;
  }
  invalidated = _fnFilterData(settings);
  if (input.length <= 0) {
    settings.aiDisplay = displayMaster.slice();
  } else {
    if (invalidated || force || regex || prevSearch.length > input.length || input.indexOf(prevSearch) !== 0 || settings.bSorted) {
      settings.aiDisplay = displayMaster.slice();
    }
    display = settings.aiDisplay;
    for (i = 0; i < display.length; i++) {
      if (rpSearch.test(settings.aoData[display[i]]._sFilterRow)) {
        filtered.push(display[i]);
      }
    }
    settings.aiDisplay = filtered;
  }
}
function _fnFilterCreateSearch(search, regex, smart, caseInsensitive) {
  search = regex ? search : _fnEscapeRegex(search);
  if (smart) {
    var a = $.map(search.match(/["\u201C][^"\u201D]+["\u201D]|[^ ]+/g) || [""], function(word) {
      if (word.charAt(0) === '"') {
        var m = word.match(/^"(.*)"$/);
        word = m ? m[1] : word;
      } else if (word.charAt(0) === "“") {
        var m = word.match(/^\u201C(.*)\u201D$/);
        word = m ? m[1] : word;
      }
      return word.replace('"', "");
    });
    search = "^(?=.*?" + a.join(")(?=.*?") + ").*$";
  }
  return new RegExp(search, caseInsensitive ? "i" : "");
}
function _fnFilterData(settings) {
  var columns = settings.aoColumns;
  var column;
  var i, j, ien, jen, filterData, cellData, row;
  var wasInvalidated = false;
  for (i = 0, ien = settings.aoData.length; i < ien; i++) {
    row = settings.aoData[i];
    if (!row._aFilterData) {
      filterData = [];
      for (j = 0, jen = columns.length; j < jen; j++) {
        column = columns[j];
        if (column.bSearchable) {
          cellData = _fnGetCellData(settings, i, j, "filter");
          if (cellData === null) {
            cellData = "";
          }
          if (typeof cellData !== "string" && cellData.toString) {
            cellData = cellData.toString();
          }
        } else {
          cellData = "";
        }
        if (cellData.indexOf && cellData.indexOf("&") !== -1) {
          __filter_div.innerHTML = cellData;
          cellData = __filter_div_textContent ? __filter_div.textContent : __filter_div.innerText;
        }
        if (cellData.replace) {
          cellData = cellData.replace(/[\r\n\u2028]/g, "");
        }
        filterData.push(cellData);
      }
      row._aFilterData = filterData;
      row._sFilterRow = filterData.join("  ");
      wasInvalidated = true;
    }
  }
  return wasInvalidated;
}
function _fnSearchToCamel(obj) {
  return {
    search: obj.sSearch,
    smart: obj.bSmart,
    regex: obj.bRegex,
    caseInsensitive: obj.bCaseInsensitive
  };
}
function _fnSearchToHung(obj) {
  return {
    sSearch: obj.search,
    bSmart: obj.smart,
    bRegex: obj.regex,
    bCaseInsensitive: obj.caseInsensitive
  };
}
function _fnFeatureHtmlInfo(settings) {
  var tid = settings.sTableId, nodes = settings.aanFeatures.i, n = $("<div/>", {
    "class": settings.oClasses.sInfo,
    "id": !nodes ? tid + "_info" : null
  });
  if (!nodes) {
    settings.aoDrawCallback.push({
      "fn": _fnUpdateInfo,
      "sName": "information"
    });
    n.attr("role", "status").attr("aria-live", "polite");
    $(settings.nTable).attr("aria-describedby", tid + "_info");
  }
  return n[0];
}
function _fnUpdateInfo(settings) {
  var nodes = settings.aanFeatures.i;
  if (nodes.length === 0) {
    return;
  }
  var lang = settings.oLanguage, start = settings._iDisplayStart + 1, end = settings.fnDisplayEnd(), max = settings.fnRecordsTotal(), total = settings.fnRecordsDisplay(), out = total ? lang.sInfo : lang.sInfoEmpty;
  if (total !== max) {
    out += " " + lang.sInfoFiltered;
  }
  out += lang.sInfoPostFix;
  out = _fnInfoMacros(settings, out);
  var callback = lang.fnInfoCallback;
  if (callback !== null) {
    out = callback.call(
      settings.oInstance,
      settings,
      start,
      end,
      max,
      total,
      out
    );
  }
  $(nodes).html(out);
}
function _fnInfoMacros(settings, str) {
  var formatter = settings.fnFormatNumber, start = settings._iDisplayStart + 1, len = settings._iDisplayLength, vis = settings.fnRecordsDisplay(), all = len === -1;
  return str.replace(/_START_/g, formatter.call(settings, start)).replace(/_END_/g, formatter.call(settings, settings.fnDisplayEnd())).replace(/_MAX_/g, formatter.call(settings, settings.fnRecordsTotal())).replace(/_TOTAL_/g, formatter.call(settings, vis)).replace(/_PAGE_/g, formatter.call(settings, all ? 1 : Math.ceil(start / len))).replace(/_PAGES_/g, formatter.call(settings, all ? 1 : Math.ceil(vis / len)));
}
function _fnInitialise(settings) {
  var i, iLen, iAjaxStart = settings.iInitDisplayStart;
  var columns = settings.aoColumns, column;
  var features = settings.oFeatures;
  var deferLoading = settings.bDeferLoading;
  if (!settings.bInitialised) {
    setTimeout(function() {
      _fnInitialise(settings);
    }, 200);
    return;
  }
  _fnAddOptionsHtml(settings);
  _fnBuildHead(settings);
  _fnDrawHead(settings, settings.aoHeader);
  _fnDrawHead(settings, settings.aoFooter);
  _fnProcessingDisplay(settings, true);
  if (features.bAutoWidth) {
    _fnCalculateColumnWidths(settings);
  }
  for (i = 0, iLen = columns.length; i < iLen; i++) {
    column = columns[i];
    if (column.sWidth) {
      column.nTh.style.width = _fnStringToCss(column.sWidth);
    }
  }
  _fnCallbackFire(settings, null, "preInit", [settings]);
  _fnReDraw(settings);
  var dataSrc = _fnDataSource(settings);
  if (dataSrc != "ssp" || deferLoading) {
    if (dataSrc == "ajax") {
      _fnBuildAjax(settings, [], function(json) {
        var aData = _fnAjaxDataSrc(settings, json);
        for (i = 0; i < aData.length; i++) {
          _fnAddData(settings, aData[i]);
        }
        settings.iInitDisplayStart = iAjaxStart;
        _fnReDraw(settings);
        _fnProcessingDisplay(settings, false);
        _fnInitComplete(settings, json);
      }, settings);
    } else {
      _fnProcessingDisplay(settings, false);
      _fnInitComplete(settings);
    }
  }
}
function _fnInitComplete(settings, json) {
  settings._bInitComplete = true;
  if (json || settings.oInit.aaData) {
    _fnAdjustColumnSizing(settings);
  }
  _fnCallbackFire(settings, null, "plugin-init", [settings, json]);
  _fnCallbackFire(settings, "aoInitComplete", "init", [settings, json]);
}
function _fnLengthChange(settings, val) {
  var len = parseInt(val, 10);
  settings._iDisplayLength = len;
  _fnLengthOverflow(settings);
  _fnCallbackFire(settings, null, "length", [settings, len]);
}
function _fnFeatureHtmlLength(settings) {
  var classes = settings.oClasses, tableId = settings.sTableId, menu = settings.aLengthMenu, d2 = Array.isArray(menu[0]), lengths = d2 ? menu[0] : menu, language = d2 ? menu[1] : menu;
  var select = $("<select/>", {
    "name": tableId + "_length",
    "aria-controls": tableId,
    "class": classes.sLengthSelect
  });
  for (var i = 0, ien = lengths.length; i < ien; i++) {
    select[0][i] = new Option(
      typeof language[i] === "number" ? settings.fnFormatNumber(language[i]) : language[i],
      lengths[i]
    );
  }
  var div = $("<div><label/></div>").addClass(classes.sLength);
  if (!settings.aanFeatures.l) {
    div[0].id = tableId + "_length";
  }
  div.children().append(
    settings.oLanguage.sLengthMenu.replace("_MENU_", select[0].outerHTML)
  );
  $("select", div).val(settings._iDisplayLength).on("change.DT", function(e) {
    _fnLengthChange(settings, $(this).val());
    _fnDraw(settings);
  });
  $(settings.nTable).on("length.dt.DT", function(e, s, len) {
    if (settings === s) {
      $("select", div).val(len);
    }
  });
  return div[0];
}
function _fnFeatureHtmlPaginate(settings) {
  var type = settings.sPaginationType, plugin = DataTable.ext.pager[type], modern = typeof plugin === "function", redraw = function(settings2) {
    _fnDraw(settings2);
  }, node = $("<div/>").addClass(settings.oClasses.sPaging + type)[0], features = settings.aanFeatures;
  if (!modern) {
    plugin.fnInit(settings, node, redraw);
  }
  if (!features.p) {
    node.id = settings.sTableId + "_paginate";
    settings.aoDrawCallback.push({
      "fn": function(settings2) {
        if (modern) {
          var start = settings2._iDisplayStart, len = settings2._iDisplayLength, visRecords = settings2.fnRecordsDisplay(), all = len === -1, page = all ? 0 : Math.ceil(start / len), pages = all ? 1 : Math.ceil(visRecords / len), buttons = plugin(page, pages), i, ien;
          for (i = 0, ien = features.p.length; i < ien; i++) {
            _fnRenderer(settings2, "pageButton")(
              settings2,
              features.p[i],
              i,
              buttons,
              page,
              pages
            );
          }
        } else {
          plugin.fnUpdate(settings2, redraw);
        }
      },
      "sName": "pagination"
    });
  }
  return node;
}
function _fnPageChange(settings, action, redraw) {
  var start = settings._iDisplayStart, len = settings._iDisplayLength, records = settings.fnRecordsDisplay();
  if (records === 0 || len === -1) {
    start = 0;
  } else if (typeof action === "number") {
    start = action * len;
    if (start > records) {
      start = 0;
    }
  } else if (action == "first") {
    start = 0;
  } else if (action == "previous") {
    start = len >= 0 ? start - len : 0;
    if (start < 0) {
      start = 0;
    }
  } else if (action == "next") {
    if (start + len < records) {
      start += len;
    }
  } else if (action == "last") {
    start = Math.floor((records - 1) / len) * len;
  } else {
    _fnLog(settings, 0, "Unknown paging action: " + action, 5);
  }
  var changed = settings._iDisplayStart !== start;
  settings._iDisplayStart = start;
  if (changed) {
    _fnCallbackFire(settings, null, "page", [settings]);
    if (redraw) {
      _fnDraw(settings);
    }
  } else {
    _fnCallbackFire(settings, null, "page-nc", [settings]);
  }
  return changed;
}
function _fnFeatureHtmlProcessing(settings) {
  return $("<div/>", {
    "id": !settings.aanFeatures.r ? settings.sTableId + "_processing" : null,
    "class": settings.oClasses.sProcessing,
    "role": "status"
  }).html(settings.oLanguage.sProcessing).append("<div><div></div><div></div><div></div><div></div></div>").insertBefore(settings.nTable)[0];
}
function _fnProcessingDisplay(settings, show) {
  if (settings.oFeatures.bProcessing) {
    $(settings.aanFeatures.r).css("display", show ? "block" : "none");
  }
  _fnCallbackFire(settings, null, "processing", [settings, show]);
}
function _fnFeatureHtmlTable(settings) {
  var table = $(settings.nTable);
  var scroll = settings.oScroll;
  if (scroll.sX === "" && scroll.sY === "") {
    return settings.nTable;
  }
  var scrollX = scroll.sX;
  var scrollY = scroll.sY;
  var classes = settings.oClasses;
  var caption = table.children("caption");
  var captionSide = caption.length ? caption[0]._captionSide : null;
  var headerClone = $(table[0].cloneNode(false));
  var footerClone = $(table[0].cloneNode(false));
  var footer = table.children("tfoot");
  var _div = "<div/>";
  var size = function(s) {
    return !s ? null : _fnStringToCss(s);
  };
  if (!footer.length) {
    footer = null;
  }
  var scroller = $(_div, { "class": classes.sScrollWrapper }).append(
    $(_div, { "class": classes.sScrollHead }).css({
      overflow: "hidden",
      position: "relative",
      border: 0,
      width: scrollX ? size(scrollX) : "100%"
    }).append(
      $(_div, { "class": classes.sScrollHeadInner }).css({
        "box-sizing": "content-box",
        width: scroll.sXInner || "100%"
      }).append(
        headerClone.removeAttr("id").css("margin-left", 0).append(captionSide === "top" ? caption : null).append(
          table.children("thead")
        )
      )
    )
  ).append(
    $(_div, { "class": classes.sScrollBody }).css({
      position: "relative",
      overflow: "auto",
      width: size(scrollX)
    }).append(table)
  );
  if (footer) {
    scroller.append(
      $(_div, { "class": classes.sScrollFoot }).css({
        overflow: "hidden",
        border: 0,
        width: scrollX ? size(scrollX) : "100%"
      }).append(
        $(_div, { "class": classes.sScrollFootInner }).append(
          footerClone.removeAttr("id").css("margin-left", 0).append(captionSide === "bottom" ? caption : null).append(
            table.children("tfoot")
          )
        )
      )
    );
  }
  var children = scroller.children();
  var scrollHead = children[0];
  var scrollBody = children[1];
  var scrollFoot = footer ? children[2] : null;
  if (scrollX) {
    $(scrollBody).on("scroll.DT", function(e) {
      var scrollLeft = this.scrollLeft;
      scrollHead.scrollLeft = scrollLeft;
      if (footer) {
        scrollFoot.scrollLeft = scrollLeft;
      }
    });
  }
  $(scrollBody).css("max-height", scrollY);
  if (!scroll.bCollapse) {
    $(scrollBody).css("height", scrollY);
  }
  settings.nScrollHead = scrollHead;
  settings.nScrollBody = scrollBody;
  settings.nScrollFoot = scrollFoot;
  settings.aoDrawCallback.push({
    "fn": _fnScrollDraw,
    "sName": "scrolling"
  });
  return scroller[0];
}
function _fnScrollDraw(settings) {
  var scroll = settings.oScroll, scrollX = scroll.sX, scrollXInner = scroll.sXInner, scrollY = scroll.sY, barWidth = scroll.iBarWidth, divHeader = $(settings.nScrollHead), divHeaderStyle = divHeader[0].style, divHeaderInner = divHeader.children("div"), divHeaderInnerStyle = divHeaderInner[0].style, divHeaderTable = divHeaderInner.children("table"), divBodyEl = settings.nScrollBody, divBody = $(divBodyEl), divBodyStyle = divBodyEl.style, divFooter = $(settings.nScrollFoot), divFooterInner = divFooter.children("div"), divFooterTable = divFooterInner.children("table"), header = $(settings.nTHead), table = $(settings.nTable), tableEl = table[0], tableStyle = tableEl.style, footer = settings.nTFoot ? $(settings.nTFoot) : null, browser = settings.oBrowser, ie67 = browser.bScrollOversize, dtHeaderCells = _pluck(settings.aoColumns, "nTh"), headerTrgEls, footerTrgEls, headerSrcEls, footerSrcEls, headerCopy, footerCopy, headerWidths = [], footerWidths = [], headerContent = [], footerContent = [], idx, correction, sanityWidth, zeroOut = function(nSizer) {
    var style = nSizer.style;
    style.paddingTop = "0";
    style.paddingBottom = "0";
    style.borderTopWidth = "0";
    style.borderBottomWidth = "0";
    style.height = 0;
  };
  var scrollBarVis = divBodyEl.scrollHeight > divBodyEl.clientHeight;
  if (settings.scrollBarVis !== scrollBarVis && settings.scrollBarVis !== void 0) {
    settings.scrollBarVis = scrollBarVis;
    _fnAdjustColumnSizing(settings);
    return;
  } else {
    settings.scrollBarVis = scrollBarVis;
  }
  table.children("thead, tfoot").remove();
  if (footer) {
    footerCopy = footer.clone().prependTo(table);
    footerTrgEls = footer.find("tr");
    footerSrcEls = footerCopy.find("tr");
    footerCopy.find("[id]").removeAttr("id");
  }
  headerCopy = header.clone().prependTo(table);
  headerTrgEls = header.find("tr");
  headerSrcEls = headerCopy.find("tr");
  headerCopy.find("th, td").removeAttr("tabindex");
  headerCopy.find("[id]").removeAttr("id");
  if (!scrollX) {
    divBodyStyle.width = "100%";
    divHeader[0].style.width = "100%";
  }
  $.each(_fnGetUniqueThs(settings, headerCopy), function(i, el) {
    idx = _fnVisibleToColumnIndex(settings, i);
    el.style.width = settings.aoColumns[idx].sWidth;
  });
  if (footer) {
    _fnApplyToChildren(function(n) {
      n.style.width = "";
    }, footerSrcEls);
  }
  sanityWidth = table.outerWidth();
  if (scrollX === "") {
    tableStyle.width = "100%";
    if (ie67 && (table.find("tbody").height() > divBodyEl.offsetHeight || divBody.css("overflow-y") == "scroll")) {
      tableStyle.width = _fnStringToCss(table.outerWidth() - barWidth);
    }
    sanityWidth = table.outerWidth();
  } else if (scrollXInner !== "") {
    tableStyle.width = _fnStringToCss(scrollXInner);
    sanityWidth = table.outerWidth();
  }
  _fnApplyToChildren(zeroOut, headerSrcEls);
  _fnApplyToChildren(function(nSizer) {
    var style = window.getComputedStyle ? window.getComputedStyle(nSizer).width : _fnStringToCss($(nSizer).width());
    headerContent.push(nSizer.innerHTML);
    headerWidths.push(style);
  }, headerSrcEls);
  _fnApplyToChildren(function(nToSize, i) {
    nToSize.style.width = headerWidths[i];
  }, headerTrgEls);
  $(headerSrcEls).css("height", 0);
  if (footer) {
    _fnApplyToChildren(zeroOut, footerSrcEls);
    _fnApplyToChildren(function(nSizer) {
      footerContent.push(nSizer.innerHTML);
      footerWidths.push(_fnStringToCss($(nSizer).css("width")));
    }, footerSrcEls);
    _fnApplyToChildren(function(nToSize, i) {
      nToSize.style.width = footerWidths[i];
    }, footerTrgEls);
    $(footerSrcEls).height(0);
  }
  _fnApplyToChildren(function(nSizer, i) {
    nSizer.innerHTML = '<div class="dataTables_sizing">' + headerContent[i] + "</div>";
    nSizer.childNodes[0].style.height = "0";
    nSizer.childNodes[0].style.overflow = "hidden";
    nSizer.style.width = headerWidths[i];
  }, headerSrcEls);
  if (footer) {
    _fnApplyToChildren(function(nSizer, i) {
      nSizer.innerHTML = '<div class="dataTables_sizing">' + footerContent[i] + "</div>";
      nSizer.childNodes[0].style.height = "0";
      nSizer.childNodes[0].style.overflow = "hidden";
      nSizer.style.width = footerWidths[i];
    }, footerSrcEls);
  }
  if (Math.round(table.outerWidth()) < Math.round(sanityWidth)) {
    correction = divBodyEl.scrollHeight > divBodyEl.offsetHeight || divBody.css("overflow-y") == "scroll" ? sanityWidth + barWidth : sanityWidth;
    if (ie67 && (divBodyEl.scrollHeight > divBodyEl.offsetHeight || divBody.css("overflow-y") == "scroll")) {
      tableStyle.width = _fnStringToCss(correction - barWidth);
    }
    if (scrollX === "" || scrollXInner !== "") {
      _fnLog(settings, 1, "Possible column misalignment", 6);
    }
  } else {
    correction = "100%";
  }
  divBodyStyle.width = _fnStringToCss(correction);
  divHeaderStyle.width = _fnStringToCss(correction);
  if (footer) {
    settings.nScrollFoot.style.width = _fnStringToCss(correction);
  }
  if (!scrollY) {
    if (ie67) {
      divBodyStyle.height = _fnStringToCss(tableEl.offsetHeight + barWidth);
    }
  }
  var iOuterWidth = table.outerWidth();
  divHeaderTable[0].style.width = _fnStringToCss(iOuterWidth);
  divHeaderInnerStyle.width = _fnStringToCss(iOuterWidth);
  var bScrolling = table.height() > divBodyEl.clientHeight || divBody.css("overflow-y") == "scroll";
  var padding = "padding" + (browser.bScrollbarLeft ? "Left" : "Right");
  divHeaderInnerStyle[padding] = bScrolling ? barWidth + "px" : "0px";
  if (footer) {
    divFooterTable[0].style.width = _fnStringToCss(iOuterWidth);
    divFooterInner[0].style.width = _fnStringToCss(iOuterWidth);
    divFooterInner[0].style[padding] = bScrolling ? barWidth + "px" : "0px";
  }
  table.children("colgroup").insertBefore(table.children("thead"));
  divBody.trigger("scroll");
  if ((settings.bSorted || settings.bFiltered) && !settings._drawHold) {
    divBodyEl.scrollTop = 0;
  }
}
function _fnApplyToChildren(fn, an1, an2) {
  var index = 0, i = 0, iLen = an1.length;
  var nNode1, nNode2;
  while (i < iLen) {
    nNode1 = an1[i].firstChild;
    nNode2 = an2 ? an2[i].firstChild : null;
    while (nNode1) {
      if (nNode1.nodeType === 1) {
        if (an2) {
          fn(nNode1, nNode2, index);
        } else {
          fn(nNode1, index);
        }
        index++;
      }
      nNode1 = nNode1.nextSibling;
      nNode2 = an2 ? nNode2.nextSibling : null;
    }
    i++;
  }
}
function _fnCalculateColumnWidths(oSettings) {
  var table = oSettings.nTable, columns = oSettings.aoColumns, scroll = oSettings.oScroll, scrollY = scroll.sY, scrollX = scroll.sX, scrollXInner = scroll.sXInner, columnCount = columns.length, visibleColumns = _fnGetColumns(oSettings, "bVisible"), headerCells = $("th", oSettings.nTHead), tableWidthAttr = table.getAttribute("width"), tableContainer = table.parentNode, userInputs = false, i, column, columnIdx, width, outerWidth, browser = oSettings.oBrowser, ie67 = browser.bScrollOversize;
  var styleWidth = table.style.width;
  if (styleWidth && styleWidth.indexOf("%") !== -1) {
    tableWidthAttr = styleWidth;
  }
  var sizes = _fnConvertToWidth(_pluck(columns, "sWidthOrig"), tableContainer);
  for (i = 0; i < visibleColumns.length; i++) {
    column = columns[visibleColumns[i]];
    if (column.sWidth !== null) {
      column.sWidth = sizes[i];
      userInputs = true;
    }
  }
  if (ie67 || !userInputs && !scrollX && !scrollY && columnCount == _fnVisbleColumns(oSettings) && columnCount == headerCells.length) {
    for (i = 0; i < columnCount; i++) {
      var colIdx = _fnVisibleToColumnIndex(oSettings, i);
      if (colIdx !== null) {
        columns[colIdx].sWidth = _fnStringToCss(headerCells.eq(i).width());
      }
    }
  } else {
    var tmpTable = $(table).clone().css("visibility", "hidden").removeAttr("id");
    tmpTable.find("tbody tr").remove();
    var tr = $("<tr/>").appendTo(tmpTable.find("tbody"));
    tmpTable.find("thead, tfoot").remove();
    tmpTable.append($(oSettings.nTHead).clone()).append($(oSettings.nTFoot).clone());
    tmpTable.find("tfoot th, tfoot td").css("width", "");
    headerCells = _fnGetUniqueThs(oSettings, tmpTable.find("thead")[0]);
    for (i = 0; i < visibleColumns.length; i++) {
      column = columns[visibleColumns[i]];
      headerCells[i].style.width = column.sWidthOrig !== null && column.sWidthOrig !== "" ? _fnStringToCss(column.sWidthOrig) : "";
      if (column.sWidthOrig && scrollX) {
        $(headerCells[i]).append($("<div/>").css({
          width: column.sWidthOrig,
          margin: 0,
          padding: 0,
          border: 0,
          height: 1
        }));
      }
    }
    if (oSettings.aoData.length) {
      for (i = 0; i < visibleColumns.length; i++) {
        columnIdx = visibleColumns[i];
        column = columns[columnIdx];
        $(_fnGetWidestNode(oSettings, columnIdx)).clone(false).append(column.sContentPadding).appendTo(tr);
      }
    }
    $("[name]", tmpTable).removeAttr("name");
    var holder = $("<div/>").css(
      scrollX || scrollY ? {
        position: "absolute",
        top: 0,
        left: 0,
        height: 1,
        right: 0,
        overflow: "hidden"
      } : {}
    ).append(tmpTable).appendTo(tableContainer);
    if (scrollX && scrollXInner) {
      tmpTable.width(scrollXInner);
    } else if (scrollX) {
      tmpTable.css("width", "auto");
      tmpTable.removeAttr("width");
      if (tmpTable.width() < tableContainer.clientWidth && tableWidthAttr) {
        tmpTable.width(tableContainer.clientWidth);
      }
    } else if (scrollY) {
      tmpTable.width(tableContainer.clientWidth);
    } else if (tableWidthAttr) {
      tmpTable.width(tableWidthAttr);
    }
    var total = 0;
    for (i = 0; i < visibleColumns.length; i++) {
      var cell = $(headerCells[i]);
      var border = cell.outerWidth() - cell.width();
      var bounding = browser.bBounding ? Math.ceil(headerCells[i].getBoundingClientRect().width) : cell.outerWidth();
      total += bounding;
      columns[visibleColumns[i]].sWidth = _fnStringToCss(bounding - border);
    }
    table.style.width = _fnStringToCss(total);
    holder.remove();
  }
  if (tableWidthAttr) {
    table.style.width = _fnStringToCss(tableWidthAttr);
  }
  if ((tableWidthAttr || scrollX) && !oSettings._reszEvt) {
    var bindResize = function() {
      $(window).on("resize.DT-" + oSettings.sInstance, _fnThrottle(function() {
        _fnAdjustColumnSizing(oSettings);
      }));
    };
    if (ie67) {
      setTimeout(bindResize, 1e3);
    } else {
      bindResize();
    }
    oSettings._reszEvt = true;
  }
}
function _fnConvertToWidth(widths, parent) {
  var els = [];
  var results = [];
  for (var i = 0; i < widths.length; i++) {
    if (widths[i]) {
      els.push(
        $("<div/>").css("width", _fnStringToCss(widths[i])).appendTo(parent || document.body)
      );
    } else {
      els.push(null);
    }
  }
  for (var i = 0; i < widths.length; i++) {
    results.push(els[i] ? els[i][0].offsetWidth : null);
  }
  $(els).remove();
  return results;
}
function _fnGetWidestNode(settings, colIdx) {
  var idx = _fnGetMaxLenString(settings, colIdx);
  if (idx < 0) {
    return null;
  }
  var data = settings.aoData[idx];
  return !data.nTr ? (
    // Might not have been created when deferred rendering
    $("<td/>").html(_fnGetCellData(settings, idx, colIdx, "display"))[0]
  ) : data.anCells[colIdx];
}
function _fnGetMaxLenString(settings, colIdx) {
  var s, max = -1, maxIdx = -1;
  for (var i = 0, ien = settings.aoData.length; i < ien; i++) {
    s = _fnGetCellData(settings, i, colIdx, "display") + "";
    s = s.replace(__re_html_remove, "");
    s = s.replace(/&nbsp;/g, " ");
    if (s.length > max) {
      max = s.length;
      maxIdx = i;
    }
  }
  return maxIdx;
}
function _fnStringToCss(s) {
  if (s === null) {
    return "0px";
  }
  if (typeof s == "number") {
    return s < 0 ? "0px" : s + "px";
  }
  return s.match(/\d$/) ? s + "px" : s;
}
function _fnSortFlatten(settings) {
  var i, iLen, k, kLen, aSort = [], aiOrig = [], aoColumns = settings.aoColumns, aDataSort, iCol, sType, srcCol, fixed = settings.aaSortingFixed, fixedObj = $.isPlainObject(fixed), nestedSort = [], add = function(a) {
    if (a.length && !Array.isArray(a[0])) {
      nestedSort.push(a);
    } else {
      $.merge(nestedSort, a);
    }
  };
  if (Array.isArray(fixed)) {
    add(fixed);
  }
  if (fixedObj && fixed.pre) {
    add(fixed.pre);
  }
  add(settings.aaSorting);
  if (fixedObj && fixed.post) {
    add(fixed.post);
  }
  for (i = 0; i < nestedSort.length; i++) {
    srcCol = nestedSort[i][0];
    aDataSort = aoColumns[srcCol].aDataSort;
    for (k = 0, kLen = aDataSort.length; k < kLen; k++) {
      iCol = aDataSort[k];
      sType = aoColumns[iCol].sType || "string";
      if (nestedSort[i]._idx === void 0) {
        nestedSort[i]._idx = $.inArray(nestedSort[i][1], aoColumns[iCol].asSorting);
      }
      aSort.push({
        src: srcCol,
        col: iCol,
        dir: nestedSort[i][1],
        index: nestedSort[i]._idx,
        type: sType,
        formatter: DataTable.ext.type.order[sType + "-pre"]
      });
    }
  }
  return aSort;
}
function _fnSort(oSettings) {
  var i, ien, iLen, j, jLen, k, kLen, sDataType, nTh, aiOrig = [], oExtSort = DataTable.ext.type.order, aoData = oSettings.aoData, aoColumns = oSettings.aoColumns, aDataSort, data, iCol, sType, oSort, formatters = 0, sortCol, displayMaster = oSettings.aiDisplayMaster, aSort;
  _fnColumnTypes(oSettings);
  aSort = _fnSortFlatten(oSettings);
  for (i = 0, ien = aSort.length; i < ien; i++) {
    sortCol = aSort[i];
    if (sortCol.formatter) {
      formatters++;
    }
    _fnSortData(oSettings, sortCol.col);
  }
  if (_fnDataSource(oSettings) != "ssp" && aSort.length !== 0) {
    for (i = 0, iLen = displayMaster.length; i < iLen; i++) {
      aiOrig[displayMaster[i]] = i;
    }
    if (formatters === aSort.length) {
      displayMaster.sort(function(a, b) {
        var x, y, k2, test, sort, len = aSort.length, dataA = aoData[a]._aSortData, dataB = aoData[b]._aSortData;
        for (k2 = 0; k2 < len; k2++) {
          sort = aSort[k2];
          x = dataA[sort.col];
          y = dataB[sort.col];
          test = x < y ? -1 : x > y ? 1 : 0;
          if (test !== 0) {
            return sort.dir === "asc" ? test : -test;
          }
        }
        x = aiOrig[a];
        y = aiOrig[b];
        return x < y ? -1 : x > y ? 1 : 0;
      });
    } else {
      displayMaster.sort(function(a, b) {
        var x, y, k2, l, test, sort, fn, len = aSort.length, dataA = aoData[a]._aSortData, dataB = aoData[b]._aSortData;
        for (k2 = 0; k2 < len; k2++) {
          sort = aSort[k2];
          x = dataA[sort.col];
          y = dataB[sort.col];
          fn = oExtSort[sort.type + "-" + sort.dir] || oExtSort["string-" + sort.dir];
          test = fn(x, y);
          if (test !== 0) {
            return test;
          }
        }
        x = aiOrig[a];
        y = aiOrig[b];
        return x < y ? -1 : x > y ? 1 : 0;
      });
    }
  }
  oSettings.bSorted = true;
}
function _fnSortAria(settings) {
  var label;
  var nextSort;
  var columns = settings.aoColumns;
  var aSort = _fnSortFlatten(settings);
  var oAria = settings.oLanguage.oAria;
  for (var i = 0, iLen = columns.length; i < iLen; i++) {
    var col = columns[i];
    var asSorting = col.asSorting;
    var sTitle = col.ariaTitle || col.sTitle.replace(/<.*?>/g, "");
    var th = col.nTh;
    th.removeAttribute("aria-sort");
    if (col.bSortable) {
      if (aSort.length > 0 && aSort[0].col == i) {
        th.setAttribute("aria-sort", aSort[0].dir == "asc" ? "ascending" : "descending");
        nextSort = asSorting[aSort[0].index + 1] || asSorting[0];
      } else {
        nextSort = asSorting[0];
      }
      label = sTitle + (nextSort === "asc" ? oAria.sSortAscending : oAria.sSortDescending);
    } else {
      label = sTitle;
    }
    th.setAttribute("aria-label", label);
  }
}
function _fnSortListener(settings, colIdx, append, callback) {
  var col = settings.aoColumns[colIdx];
  var sorting = settings.aaSorting;
  var asSorting = col.asSorting;
  var nextSortIdx;
  var next = function(a, overflow) {
    var idx = a._idx;
    if (idx === void 0) {
      idx = $.inArray(a[1], asSorting);
    }
    return idx + 1 < asSorting.length ? idx + 1 : overflow ? null : 0;
  };
  if (typeof sorting[0] === "number") {
    sorting = settings.aaSorting = [sorting];
  }
  if (append && settings.oFeatures.bSortMulti) {
    var sortIdx = $.inArray(colIdx, _pluck(sorting, "0"));
    if (sortIdx !== -1) {
      nextSortIdx = next(sorting[sortIdx], true);
      if (nextSortIdx === null && sorting.length === 1) {
        nextSortIdx = 0;
      }
      if (nextSortIdx === null) {
        sorting.splice(sortIdx, 1);
      } else {
        sorting[sortIdx][1] = asSorting[nextSortIdx];
        sorting[sortIdx]._idx = nextSortIdx;
      }
    } else {
      sorting.push([colIdx, asSorting[0], 0]);
      sorting[sorting.length - 1]._idx = 0;
    }
  } else if (sorting.length && sorting[0][0] == colIdx) {
    nextSortIdx = next(sorting[0]);
    sorting.length = 1;
    sorting[0][1] = asSorting[nextSortIdx];
    sorting[0]._idx = nextSortIdx;
  } else {
    sorting.length = 0;
    sorting.push([colIdx, asSorting[0]]);
    sorting[0]._idx = 0;
  }
  _fnReDraw(settings);
  if (typeof callback == "function") {
    callback(settings);
  }
}
function _fnSortAttachListener(settings, attachTo, colIdx, callback) {
  var col = settings.aoColumns[colIdx];
  _fnBindAction(attachTo, {}, function(e) {
    if (col.bSortable === false) {
      return;
    }
    if (settings.oFeatures.bProcessing) {
      _fnProcessingDisplay(settings, true);
      setTimeout(function() {
        _fnSortListener(settings, colIdx, e.shiftKey, callback);
        if (_fnDataSource(settings) !== "ssp") {
          _fnProcessingDisplay(settings, false);
        }
      }, 0);
    } else {
      _fnSortListener(settings, colIdx, e.shiftKey, callback);
    }
  });
}
function _fnSortingClasses(settings) {
  var oldSort = settings.aLastSort;
  var sortClass = settings.oClasses.sSortColumn;
  var sort = _fnSortFlatten(settings);
  var features = settings.oFeatures;
  var i, ien, colIdx;
  if (features.bSort && features.bSortClasses) {
    for (i = 0, ien = oldSort.length; i < ien; i++) {
      colIdx = oldSort[i].src;
      $(_pluck(settings.aoData, "anCells", colIdx)).removeClass(sortClass + (i < 2 ? i + 1 : 3));
    }
    for (i = 0, ien = sort.length; i < ien; i++) {
      colIdx = sort[i].src;
      $(_pluck(settings.aoData, "anCells", colIdx)).addClass(sortClass + (i < 2 ? i + 1 : 3));
    }
  }
  settings.aLastSort = sort;
}
function _fnSortData(settings, idx) {
  var column = settings.aoColumns[idx];
  var customSort = DataTable.ext.order[column.sSortDataType];
  var customData;
  if (customSort) {
    customData = customSort.call(
      settings.oInstance,
      settings,
      idx,
      _fnColumnIndexToVisible(settings, idx)
    );
  }
  var row, cellData;
  var formatter = DataTable.ext.type.order[column.sType + "-pre"];
  for (var i = 0, ien = settings.aoData.length; i < ien; i++) {
    row = settings.aoData[i];
    if (!row._aSortData) {
      row._aSortData = [];
    }
    if (!row._aSortData[idx] || customSort) {
      cellData = customSort ? customData[i] : (
        // If there was a custom sort function, use data from there
        _fnGetCellData(settings, i, idx, "sort")
      );
      row._aSortData[idx] = formatter ? formatter(cellData) : cellData;
    }
  }
}
function _fnSaveState(settings) {
  if (settings._bLoadingState) {
    return;
  }
  var state = {
    time: +/* @__PURE__ */ new Date(),
    start: settings._iDisplayStart,
    length: settings._iDisplayLength,
    order: $.extend(true, [], settings.aaSorting),
    search: _fnSearchToCamel(settings.oPreviousSearch),
    columns: $.map(settings.aoColumns, function(col, i) {
      return {
        visible: col.bVisible,
        search: _fnSearchToCamel(settings.aoPreSearchCols[i])
      };
    })
  };
  settings.oSavedState = state;
  _fnCallbackFire(settings, "aoStateSaveParams", "stateSaveParams", [settings, state]);
  if (settings.oFeatures.bStateSave && !settings.bDestroying) {
    settings.fnStateSaveCallback.call(settings.oInstance, settings, state);
  }
}
function _fnLoadState(settings, oInit, callback) {
  if (!settings.oFeatures.bStateSave) {
    callback();
    return;
  }
  var loaded = function(state2) {
    _fnImplementState(settings, state2, callback);
  };
  var state = settings.fnStateLoadCallback.call(settings.oInstance, settings, loaded);
  if (state !== void 0) {
    _fnImplementState(settings, state, callback);
  }
  return true;
}
function _fnImplementState(settings, s, callback) {
  var i, ien;
  var columns = settings.aoColumns;
  settings._bLoadingState = true;
  var api = settings._bInitComplete ? new DataTable.Api(settings) : null;
  if (!s || !s.time) {
    settings._bLoadingState = false;
    callback();
    return;
  }
  var abStateLoad = _fnCallbackFire(settings, "aoStateLoadParams", "stateLoadParams", [settings, s]);
  if ($.inArray(false, abStateLoad) !== -1) {
    settings._bLoadingState = false;
    callback();
    return;
  }
  var duration = settings.iStateDuration;
  if (duration > 0 && s.time < +/* @__PURE__ */ new Date() - duration * 1e3) {
    settings._bLoadingState = false;
    callback();
    return;
  }
  if (s.columns && columns.length !== s.columns.length) {
    settings._bLoadingState = false;
    callback();
    return;
  }
  settings.oLoadedState = $.extend(true, {}, s);
  if (s.length !== void 0) {
    if (api) {
      api.page.len(s.length);
    } else {
      settings._iDisplayLength = s.length;
    }
  }
  if (s.start !== void 0) {
    if (api === null) {
      settings._iDisplayStart = s.start;
      settings.iInitDisplayStart = s.start;
    } else {
      _fnPageChange(settings, s.start / settings._iDisplayLength);
    }
  }
  if (s.order !== void 0) {
    settings.aaSorting = [];
    $.each(s.order, function(i2, col2) {
      settings.aaSorting.push(
        col2[0] >= columns.length ? [0, col2[1]] : col2
      );
    });
  }
  if (s.search !== void 0) {
    $.extend(settings.oPreviousSearch, _fnSearchToHung(s.search));
  }
  if (s.columns) {
    for (i = 0, ien = s.columns.length; i < ien; i++) {
      var col = s.columns[i];
      if (col.visible !== void 0) {
        if (api) {
          api.column(i).visible(col.visible, false);
        } else {
          columns[i].bVisible = col.visible;
        }
      }
      if (col.search !== void 0) {
        $.extend(settings.aoPreSearchCols[i], _fnSearchToHung(col.search));
      }
    }
    if (api) {
      api.columns.adjust();
    }
  }
  settings._bLoadingState = false;
  _fnCallbackFire(settings, "aoStateLoaded", "stateLoaded", [settings, s]);
  callback();
}
function _fnSettingsFromNode(table) {
  var settings = DataTable.settings;
  var idx = $.inArray(table, _pluck(settings, "nTable"));
  return idx !== -1 ? settings[idx] : null;
}
function _fnLog(settings, level, msg, tn) {
  msg = "DataTables warning: " + (settings ? "table id=" + settings.sTableId + " - " : "") + msg;
  if (tn) {
    msg += ". For more information about this error, please see https://datatables.net/tn/" + tn;
  }
  if (!level) {
    var ext = DataTable.ext;
    var type = ext.sErrMode || ext.errMode;
    if (settings) {
      _fnCallbackFire(settings, null, "error", [settings, tn, msg]);
    }
    if (type == "alert") {
      alert(msg);
    } else if (type == "throw") {
      throw new Error(msg);
    } else if (typeof type == "function") {
      type(settings, tn, msg);
    }
  } else if (window.console && console.log) {
    console.log(msg);
  }
}
function _fnMap(ret, src, name, mappedName) {
  if (Array.isArray(name)) {
    $.each(name, function(i, val) {
      if (Array.isArray(val)) {
        _fnMap(ret, src, val[0], val[1]);
      } else {
        _fnMap(ret, src, val);
      }
    });
    return;
  }
  if (mappedName === void 0) {
    mappedName = name;
  }
  if (src[name] !== void 0) {
    ret[mappedName] = src[name];
  }
}
function _fnExtend(out, extender, breakRefs) {
  var val;
  for (var prop in extender) {
    if (extender.hasOwnProperty(prop)) {
      val = extender[prop];
      if ($.isPlainObject(val)) {
        if (!$.isPlainObject(out[prop])) {
          out[prop] = {};
        }
        $.extend(true, out[prop], val);
      } else if (breakRefs && prop !== "data" && prop !== "aaData" && Array.isArray(val)) {
        out[prop] = val.slice();
      } else {
        out[prop] = val;
      }
    }
  }
  return out;
}
function _fnBindAction(n, oData, fn) {
  $(n).on("click.DT", oData, function(e) {
    $(n).trigger("blur");
    fn(e);
  }).on("keypress.DT", oData, function(e) {
    if (e.which === 13) {
      e.preventDefault();
      fn(e);
    }
  }).on("selectstart.DT", function() {
    return false;
  });
}
function _fnCallbackReg(oSettings, sStore, fn, sName) {
  if (fn) {
    oSettings[sStore].push({
      "fn": fn,
      "sName": sName
    });
  }
}
function _fnCallbackFire(settings, callbackArr, eventName, args) {
  var ret = [];
  if (callbackArr) {
    ret = $.map(settings[callbackArr].slice().reverse(), function(val, i) {
      return val.fn.apply(settings.oInstance, args);
    });
  }
  if (eventName !== null) {
    var e = $.Event(eventName + ".dt");
    var table = $(settings.nTable);
    table.trigger(e, args);
    if (table.parents("body").length === 0) {
      $("body").trigger(e, args);
    }
    ret.push(e.result);
  }
  return ret;
}
function _fnLengthOverflow(settings) {
  var start = settings._iDisplayStart, end = settings.fnDisplayEnd(), len = settings._iDisplayLength;
  if (start >= end) {
    start = end - len;
  }
  start -= start % len;
  if (len === -1 || start < 0) {
    start = 0;
  }
  settings._iDisplayStart = start;
}
function _fnRenderer(settings, type) {
  var renderer = settings.renderer;
  var host = DataTable.ext.renderer[type];
  if ($.isPlainObject(renderer) && renderer[type]) {
    return host[renderer[type]] || host._;
  } else if (typeof renderer === "string") {
    return host[renderer] || host._;
  }
  return host._;
}
function _fnDataSource(settings) {
  if (settings.oFeatures.bServerSide) {
    return "ssp";
  } else if (settings.ajax || settings.sAjaxSource) {
    return "ajax";
  }
  return "dom";
}
function _numbers(page, pages) {
  var numbers = [], buttons = extPagination.numbers_length, half = Math.floor(buttons / 2), i = 1;
  if (pages <= buttons) {
    numbers = _range(0, pages);
  } else if (page <= half) {
    numbers = _range(0, buttons - 2);
    numbers.push("ellipsis");
    numbers.push(pages - 1);
  } else if (page >= pages - 1 - half) {
    numbers = _range(pages - (buttons - 2), pages);
    numbers.splice(0, 0, "ellipsis");
    numbers.splice(0, 0, 0);
  } else {
    numbers = _range(page - half + 2, page + half - 1);
    numbers.push("ellipsis");
    numbers.push(pages - 1);
    numbers.splice(0, 0, "ellipsis");
    numbers.splice(0, 0, 0);
  }
  numbers.DT_el = "span";
  return numbers;
}
function _addNumericSort(decimalPlace) {
  $.each(
    {
      // Plain numbers
      "num": function(d) {
        return __numericReplace(d, decimalPlace);
      },
      // Formatted numbers
      "num-fmt": function(d) {
        return __numericReplace(d, decimalPlace, _re_formatted_numeric);
      },
      // HTML numeric
      "html-num": function(d) {
        return __numericReplace(d, decimalPlace, _re_html);
      },
      // HTML numeric, formatted
      "html-num-fmt": function(d) {
        return __numericReplace(d, decimalPlace, _re_html, _re_formatted_numeric);
      }
    },
    function(key, fn) {
      _ext.type.order[key + decimalPlace + "-pre"] = fn;
      if (key.match(/^html\-/)) {
        _ext.type.search[key + decimalPlace] = _ext.type.search.html;
      }
    }
  );
}
function __mld(dt, momentFn, luxonFn, dateFn, arg1) {
  if (window.moment) {
    return dt[momentFn](arg1);
  } else if (window.luxon) {
    return dt[luxonFn](arg1);
  }
  return dateFn ? dt[dateFn](arg1) : dt;
}
function __mldObj(d, format, locale) {
  var dt;
  if (window.moment) {
    dt = window.moment.utc(d, format, locale, true);
    if (!dt.isValid()) {
      return null;
    }
  } else if (window.luxon) {
    dt = format && typeof d === "string" ? window.luxon.DateTime.fromFormat(d, format) : window.luxon.DateTime.fromISO(d);
    if (!dt.isValid) {
      return null;
    }
    dt.setLocale(locale);
  } else if (!format) {
    dt = new Date(d);
  } else {
    if (!__mlWarning) {
      alert("DataTables warning: Formatted date without Moment.js or Luxon - https://datatables.net/tn/17");
    }
    __mlWarning = true;
  }
  return dt;
}
function __mlHelper(localeString) {
  return function(from, to, locale, def) {
    if (arguments.length === 0) {
      locale = "en";
      to = null;
      from = null;
    } else if (arguments.length === 1) {
      locale = "en";
      to = from;
      from = null;
    } else if (arguments.length === 2) {
      locale = to;
      to = from;
      from = null;
    }
    var typeName = "datetime-" + to;
    if (!DataTable.ext.type.order[typeName]) {
      DataTable.ext.type.detect.unshift(function(d) {
        return d === typeName ? typeName : false;
      });
      DataTable.ext.type.order[typeName + "-asc"] = function(a, b) {
        var x = a.valueOf();
        var y = b.valueOf();
        return x === y ? 0 : x < y ? -1 : 1;
      };
      DataTable.ext.type.order[typeName + "-desc"] = function(a, b) {
        var x = a.valueOf();
        var y = b.valueOf();
        return x === y ? 0 : x > y ? -1 : 1;
      };
    }
    return function(d, type) {
      if (d === null || d === void 0) {
        if (def === "--now") {
          var local = /* @__PURE__ */ new Date();
          d = new Date(Date.UTC(
            local.getFullYear(),
            local.getMonth(),
            local.getDate(),
            local.getHours(),
            local.getMinutes(),
            local.getSeconds()
          ));
        } else {
          d = "";
        }
      }
      if (type === "type") {
        return typeName;
      }
      if (d === "") {
        return type !== "sort" ? "" : __mldObj("0000-01-01 00:00:00", null, locale);
      }
      if (to !== null && from === to && type !== "sort" && type !== "type" && !(d instanceof Date)) {
        return d;
      }
      var dt = __mldObj(d, from, locale);
      if (dt === null) {
        return d;
      }
      if (type === "sort") {
        return dt;
      }
      var formatted = to === null ? __mld(dt, "toDate", "toJSDate", "")[localeString]() : __mld(dt, "format", "toFormat", "toISOString", to);
      return type === "display" ? __htmlEscapeEntities(formatted) : formatted;
    };
  };
}
function _fnExternApiFunc(fn) {
  return function() {
    var args = [_fnSettingsFromNode(this[DataTable.ext.iApiIndex])].concat(
      Array.prototype.slice.call(arguments)
    );
    return DataTable.ext.internal[fn].apply(this, args);
  };
}
var import_jquery, $, DataTable, _ext, _Api, _api_register, _api_registerPlural, _re_dic, _re_new_lines, _re_html, _re_date, _re_escape_regex, _re_formatted_numeric, _empty, _intVal, _numToDecimal, _isNumber, _isHtml, _htmlNumeric, _pluck, _pluck_order, _range, _removeEmpty, _stripHtml, _areAllUnique, _unique, _flatten, _includes, _fnCompatMap, __reArray, __reFn, _fnGetObjectDataFn, _fnSetObjectDataFn, _fnEscapeRegex, __filter_div, __filter_div_textContent, __re_html_remove, _fnThrottle, __apiStruct, __arrayProto, _toSettings, __table_selector, __reload, _selector_run, _selector_opts, _selector_first, _selector_row_indexes, __row_selector, __details_add, __details_state, __details_remove, __details_display, __details_events, _emp, _child_obj, _child_mth, __re_column_selector, __columnData, __column_selector, __setColumnVis, __cell_selector, extPagination, __numericReplace, __htmlEscapeEntities, __mlWarning, __thousands, __decimal, num, i, jquery_dataTables_default;
var init_jquery_dataTables = __esm({
  "node_modules/datatables.net/js/jquery.dataTables.mjs"() {
    import_jquery = __toESM(require_jquery(), 1);
    $ = import_jquery.default;
    DataTable = function(selector, options) {
      if (DataTable.factory(selector, options)) {
        return DataTable;
      }
      if (this instanceof DataTable) {
        return $(selector).DataTable(options);
      } else {
        options = selector;
      }
      this.$ = function(sSelector, oOpts) {
        return this.api(true).$(sSelector, oOpts);
      };
      this._ = function(sSelector, oOpts) {
        return this.api(true).rows(sSelector, oOpts).data();
      };
      this.api = function(traditional) {
        return traditional ? new _Api(
          _fnSettingsFromNode(this[_ext.iApiIndex])
        ) : new _Api(this);
      };
      this.fnAddData = function(data, redraw) {
        var api = this.api(true);
        var rows = Array.isArray(data) && (Array.isArray(data[0]) || $.isPlainObject(data[0])) ? api.rows.add(data) : api.row.add(data);
        if (redraw === void 0 || redraw) {
          api.draw();
        }
        return rows.flatten().toArray();
      };
      this.fnAdjustColumnSizing = function(bRedraw) {
        var api = this.api(true).columns.adjust();
        var settings = api.settings()[0];
        var scroll = settings.oScroll;
        if (bRedraw === void 0 || bRedraw) {
          api.draw(false);
        } else if (scroll.sX !== "" || scroll.sY !== "") {
          _fnScrollDraw(settings);
        }
      };
      this.fnClearTable = function(bRedraw) {
        var api = this.api(true).clear();
        if (bRedraw === void 0 || bRedraw) {
          api.draw();
        }
      };
      this.fnClose = function(nTr) {
        this.api(true).row(nTr).child.hide();
      };
      this.fnDeleteRow = function(target, callback, redraw) {
        var api = this.api(true);
        var rows = api.rows(target);
        var settings = rows.settings()[0];
        var data = settings.aoData[rows[0][0]];
        rows.remove();
        if (callback) {
          callback.call(this, settings, data);
        }
        if (redraw === void 0 || redraw) {
          api.draw();
        }
        return data;
      };
      this.fnDestroy = function(remove) {
        this.api(true).destroy(remove);
      };
      this.fnDraw = function(complete) {
        this.api(true).draw(complete);
      };
      this.fnFilter = function(sInput, iColumn, bRegex, bSmart, bShowGlobal, bCaseInsensitive) {
        var api = this.api(true);
        if (iColumn === null || iColumn === void 0) {
          api.search(sInput, bRegex, bSmart, bCaseInsensitive);
        } else {
          api.column(iColumn).search(sInput, bRegex, bSmart, bCaseInsensitive);
        }
        api.draw();
      };
      this.fnGetData = function(src, col) {
        var api = this.api(true);
        if (src !== void 0) {
          var type = src.nodeName ? src.nodeName.toLowerCase() : "";
          return col !== void 0 || type == "td" || type == "th" ? api.cell(src, col).data() : api.row(src).data() || null;
        }
        return api.data().toArray();
      };
      this.fnGetNodes = function(iRow) {
        var api = this.api(true);
        return iRow !== void 0 ? api.row(iRow).node() : api.rows().nodes().flatten().toArray();
      };
      this.fnGetPosition = function(node) {
        var api = this.api(true);
        var nodeName = node.nodeName.toUpperCase();
        if (nodeName == "TR") {
          return api.row(node).index();
        } else if (nodeName == "TD" || nodeName == "TH") {
          var cell = api.cell(node).index();
          return [
            cell.row,
            cell.columnVisible,
            cell.column
          ];
        }
        return null;
      };
      this.fnIsOpen = function(nTr) {
        return this.api(true).row(nTr).child.isShown();
      };
      this.fnOpen = function(nTr, mHtml, sClass) {
        return this.api(true).row(nTr).child(mHtml, sClass).show().child()[0];
      };
      this.fnPageChange = function(mAction, bRedraw) {
        var api = this.api(true).page(mAction);
        if (bRedraw === void 0 || bRedraw) {
          api.draw(false);
        }
      };
      this.fnSetColumnVis = function(iCol, bShow, bRedraw) {
        var api = this.api(true).column(iCol).visible(bShow);
        if (bRedraw === void 0 || bRedraw) {
          api.columns.adjust().draw();
        }
      };
      this.fnSettings = function() {
        return _fnSettingsFromNode(this[_ext.iApiIndex]);
      };
      this.fnSort = function(aaSort) {
        this.api(true).order(aaSort).draw();
      };
      this.fnSortListener = function(nNode, iColumn, fnCallback) {
        this.api(true).order.listener(nNode, iColumn, fnCallback);
      };
      this.fnUpdate = function(mData, mRow, iColumn, bRedraw, bAction) {
        var api = this.api(true);
        if (iColumn === void 0 || iColumn === null) {
          api.row(mRow).data(mData);
        } else {
          api.cell(mRow, iColumn).data(mData);
        }
        if (bAction === void 0 || bAction) {
          api.columns.adjust();
        }
        if (bRedraw === void 0 || bRedraw) {
          api.draw();
        }
        return 0;
      };
      this.fnVersionCheck = _ext.fnVersionCheck;
      var _that = this;
      var emptyInit = options === void 0;
      var len = this.length;
      if (emptyInit) {
        options = {};
      }
      this.oApi = this.internal = _ext.internal;
      for (var fn in DataTable.ext.internal) {
        if (fn) {
          this[fn] = _fnExternApiFunc(fn);
        }
      }
      this.each(function() {
        var o = {};
        var oInit = len > 1 ? (
          // optimisation for single table case
          _fnExtend(o, options, true)
        ) : options;
        var i = 0, iLen, j, jLen, k, kLen;
        var sId = this.getAttribute("id");
        var bInitHandedOff = false;
        var defaults = DataTable.defaults;
        var $this = $(this);
        if (this.nodeName.toLowerCase() != "table") {
          _fnLog(null, 0, "Non-table node initialisation (" + this.nodeName + ")", 2);
          return;
        }
        _fnCompatOpts(defaults);
        _fnCompatCols(defaults.column);
        _fnCamelToHungarian(defaults, defaults, true);
        _fnCamelToHungarian(defaults.column, defaults.column, true);
        _fnCamelToHungarian(defaults, $.extend(oInit, $this.data()), true);
        var allSettings = DataTable.settings;
        for (i = 0, iLen = allSettings.length; i < iLen; i++) {
          var s = allSettings[i];
          if (s.nTable == this || s.nTHead && s.nTHead.parentNode == this || s.nTFoot && s.nTFoot.parentNode == this) {
            var bRetrieve = oInit.bRetrieve !== void 0 ? oInit.bRetrieve : defaults.bRetrieve;
            var bDestroy = oInit.bDestroy !== void 0 ? oInit.bDestroy : defaults.bDestroy;
            if (emptyInit || bRetrieve) {
              return s.oInstance;
            } else if (bDestroy) {
              s.oInstance.fnDestroy();
              break;
            } else {
              _fnLog(s, 0, "Cannot reinitialise DataTable", 3);
              return;
            }
          }
          if (s.sTableId == this.id) {
            allSettings.splice(i, 1);
            break;
          }
        }
        if (sId === null || sId === "") {
          sId = "DataTables_Table_" + DataTable.ext._unique++;
          this.id = sId;
        }
        var oSettings = $.extend(true, {}, DataTable.models.oSettings, {
          "sDestroyWidth": $this[0].style.width,
          "sInstance": sId,
          "sTableId": sId
        });
        oSettings.nTable = this;
        oSettings.oApi = _that.internal;
        oSettings.oInit = oInit;
        allSettings.push(oSettings);
        oSettings.oInstance = _that.length === 1 ? _that : $this.dataTable();
        _fnCompatOpts(oInit);
        _fnLanguageCompat(oInit.oLanguage);
        if (oInit.aLengthMenu && !oInit.iDisplayLength) {
          oInit.iDisplayLength = Array.isArray(oInit.aLengthMenu[0]) ? oInit.aLengthMenu[0][0] : oInit.aLengthMenu[0];
        }
        oInit = _fnExtend($.extend(true, {}, defaults), oInit);
        _fnMap(oSettings.oFeatures, oInit, [
          "bPaginate",
          "bLengthChange",
          "bFilter",
          "bSort",
          "bSortMulti",
          "bInfo",
          "bProcessing",
          "bAutoWidth",
          "bSortClasses",
          "bServerSide",
          "bDeferRender"
        ]);
        _fnMap(oSettings, oInit, [
          "asStripeClasses",
          "ajax",
          "fnServerData",
          "fnFormatNumber",
          "sServerMethod",
          "aaSorting",
          "aaSortingFixed",
          "aLengthMenu",
          "sPaginationType",
          "sAjaxSource",
          "sAjaxDataProp",
          "iStateDuration",
          "sDom",
          "bSortCellsTop",
          "iTabIndex",
          "fnStateLoadCallback",
          "fnStateSaveCallback",
          "renderer",
          "searchDelay",
          "rowId",
          ["iCookieDuration", "iStateDuration"],
          // backwards compat
          ["oSearch", "oPreviousSearch"],
          ["aoSearchCols", "aoPreSearchCols"],
          ["iDisplayLength", "_iDisplayLength"]
        ]);
        _fnMap(oSettings.oScroll, oInit, [
          ["sScrollX", "sX"],
          ["sScrollXInner", "sXInner"],
          ["sScrollY", "sY"],
          ["bScrollCollapse", "bCollapse"]
        ]);
        _fnMap(oSettings.oLanguage, oInit, "fnInfoCallback");
        _fnCallbackReg(oSettings, "aoDrawCallback", oInit.fnDrawCallback, "user");
        _fnCallbackReg(oSettings, "aoServerParams", oInit.fnServerParams, "user");
        _fnCallbackReg(oSettings, "aoStateSaveParams", oInit.fnStateSaveParams, "user");
        _fnCallbackReg(oSettings, "aoStateLoadParams", oInit.fnStateLoadParams, "user");
        _fnCallbackReg(oSettings, "aoStateLoaded", oInit.fnStateLoaded, "user");
        _fnCallbackReg(oSettings, "aoRowCallback", oInit.fnRowCallback, "user");
        _fnCallbackReg(oSettings, "aoRowCreatedCallback", oInit.fnCreatedRow, "user");
        _fnCallbackReg(oSettings, "aoHeaderCallback", oInit.fnHeaderCallback, "user");
        _fnCallbackReg(oSettings, "aoFooterCallback", oInit.fnFooterCallback, "user");
        _fnCallbackReg(oSettings, "aoInitComplete", oInit.fnInitComplete, "user");
        _fnCallbackReg(oSettings, "aoPreDrawCallback", oInit.fnPreDrawCallback, "user");
        oSettings.rowIdFn = _fnGetObjectDataFn(oInit.rowId);
        _fnBrowserDetect(oSettings);
        var oClasses = oSettings.oClasses;
        $.extend(oClasses, DataTable.ext.classes, oInit.oClasses);
        $this.addClass(oClasses.sTable);
        if (oSettings.iInitDisplayStart === void 0) {
          oSettings.iInitDisplayStart = oInit.iDisplayStart;
          oSettings._iDisplayStart = oInit.iDisplayStart;
        }
        if (oInit.iDeferLoading !== null) {
          oSettings.bDeferLoading = true;
          var tmp = Array.isArray(oInit.iDeferLoading);
          oSettings._iRecordsDisplay = tmp ? oInit.iDeferLoading[0] : oInit.iDeferLoading;
          oSettings._iRecordsTotal = tmp ? oInit.iDeferLoading[1] : oInit.iDeferLoading;
        }
        var oLanguage = oSettings.oLanguage;
        $.extend(true, oLanguage, oInit.oLanguage);
        if (oLanguage.sUrl) {
          $.ajax({
            dataType: "json",
            url: oLanguage.sUrl,
            success: function(json) {
              _fnCamelToHungarian(defaults.oLanguage, json);
              _fnLanguageCompat(json);
              $.extend(true, oLanguage, json, oSettings.oInit.oLanguage);
              _fnCallbackFire(oSettings, null, "i18n", [oSettings]);
              _fnInitialise(oSettings);
            },
            error: function() {
              _fnInitialise(oSettings);
            }
          });
          bInitHandedOff = true;
        } else {
          _fnCallbackFire(oSettings, null, "i18n", [oSettings]);
        }
        if (oInit.asStripeClasses === null) {
          oSettings.asStripeClasses = [
            oClasses.sStripeOdd,
            oClasses.sStripeEven
          ];
        }
        var stripeClasses = oSettings.asStripeClasses;
        var rowOne = $this.children("tbody").find("tr").eq(0);
        if ($.inArray(true, $.map(stripeClasses, function(el, i2) {
          return rowOne.hasClass(el);
        })) !== -1) {
          $("tbody tr", this).removeClass(stripeClasses.join(" "));
          oSettings.asDestroyStripes = stripeClasses.slice();
        }
        var anThs = [];
        var aoColumnsInit;
        var nThead = this.getElementsByTagName("thead");
        if (nThead.length !== 0) {
          _fnDetectHeader(oSettings.aoHeader, nThead[0]);
          anThs = _fnGetUniqueThs(oSettings);
        }
        if (oInit.aoColumns === null) {
          aoColumnsInit = [];
          for (i = 0, iLen = anThs.length; i < iLen; i++) {
            aoColumnsInit.push(null);
          }
        } else {
          aoColumnsInit = oInit.aoColumns;
        }
        for (i = 0, iLen = aoColumnsInit.length; i < iLen; i++) {
          _fnAddColumn(oSettings, anThs ? anThs[i] : null);
        }
        _fnApplyColumnDefs(oSettings, oInit.aoColumnDefs, aoColumnsInit, function(iCol, oDef) {
          _fnColumnOptions(oSettings, iCol, oDef);
        });
        if (rowOne.length) {
          var a = function(cell, name) {
            return cell.getAttribute("data-" + name) !== null ? name : null;
          };
          $(rowOne[0]).children("th, td").each(function(i2, cell) {
            var col = oSettings.aoColumns[i2];
            if (!col) {
              _fnLog(oSettings, 0, "Incorrect column count", 18);
            }
            if (col.mData === i2) {
              var sort = a(cell, "sort") || a(cell, "order");
              var filter = a(cell, "filter") || a(cell, "search");
              if (sort !== null || filter !== null) {
                col.mData = {
                  _: i2 + ".display",
                  sort: sort !== null ? i2 + ".@data-" + sort : void 0,
                  type: sort !== null ? i2 + ".@data-" + sort : void 0,
                  filter: filter !== null ? i2 + ".@data-" + filter : void 0
                };
                col._isArrayHost = true;
                _fnColumnOptions(oSettings, i2);
              }
            }
          });
        }
        var features = oSettings.oFeatures;
        var loadedInit = function() {
          if (oInit.aaSorting === void 0) {
            var sorting = oSettings.aaSorting;
            for (i = 0, iLen = sorting.length; i < iLen; i++) {
              sorting[i][1] = oSettings.aoColumns[i].asSorting[0];
            }
          }
          _fnSortingClasses(oSettings);
          if (features.bSort) {
            _fnCallbackReg(oSettings, "aoDrawCallback", function() {
              if (oSettings.bSorted) {
                var aSort = _fnSortFlatten(oSettings);
                var sortedColumns = {};
                $.each(aSort, function(i2, val) {
                  sortedColumns[val.src] = val.dir;
                });
                _fnCallbackFire(oSettings, null, "order", [oSettings, aSort, sortedColumns]);
                _fnSortAria(oSettings);
              }
            });
          }
          _fnCallbackReg(oSettings, "aoDrawCallback", function() {
            if (oSettings.bSorted || _fnDataSource(oSettings) === "ssp" || features.bDeferRender) {
              _fnSortingClasses(oSettings);
            }
          }, "sc");
          var captions = $this.children("caption").each(function() {
            this._captionSide = $(this).css("caption-side");
          });
          var thead = $this.children("thead");
          if (thead.length === 0) {
            thead = $("<thead/>").appendTo($this);
          }
          oSettings.nTHead = thead[0];
          var tbody = $this.children("tbody");
          if (tbody.length === 0) {
            tbody = $("<tbody/>").insertAfter(thead);
          }
          oSettings.nTBody = tbody[0];
          var tfoot = $this.children("tfoot");
          if (tfoot.length === 0 && captions.length > 0 && (oSettings.oScroll.sX !== "" || oSettings.oScroll.sY !== "")) {
            tfoot = $("<tfoot/>").appendTo($this);
          }
          if (tfoot.length === 0 || tfoot.children().length === 0) {
            $this.addClass(oClasses.sNoFooter);
          } else if (tfoot.length > 0) {
            oSettings.nTFoot = tfoot[0];
            _fnDetectHeader(oSettings.aoFooter, oSettings.nTFoot);
          }
          if (oInit.aaData) {
            for (i = 0; i < oInit.aaData.length; i++) {
              _fnAddData(oSettings, oInit.aaData[i]);
            }
          } else if (oSettings.bDeferLoading || _fnDataSource(oSettings) == "dom") {
            _fnAddTr(oSettings, $(oSettings.nTBody).children("tr"));
          }
          oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
          oSettings.bInitialised = true;
          if (bInitHandedOff === false) {
            _fnInitialise(oSettings);
          }
        };
        _fnCallbackReg(oSettings, "aoDrawCallback", _fnSaveState, "state_save");
        if (oInit.bStateSave) {
          features.bStateSave = true;
          _fnLoadState(oSettings, oInit, loadedInit);
        } else {
          loadedInit();
        }
      });
      _that = null;
      return this;
    };
    _re_dic = {};
    _re_new_lines = /[\r\n\u2028]/g;
    _re_html = /<.*?>/g;
    _re_date = /^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/;
    _re_escape_regex = new RegExp("(\\" + ["/", ".", "*", "+", "?", "|", "(", ")", "[", "]", "{", "}", "\\", "$", "^", "-"].join("|\\") + ")", "g");
    _re_formatted_numeric = /['\u00A0,$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi;
    _empty = function(d) {
      return !d || d === true || d === "-" ? true : false;
    };
    _intVal = function(s) {
      var integer = parseInt(s, 10);
      return !isNaN(integer) && isFinite(s) ? integer : null;
    };
    _numToDecimal = function(num, decimalPoint) {
      if (!_re_dic[decimalPoint]) {
        _re_dic[decimalPoint] = new RegExp(_fnEscapeRegex(decimalPoint), "g");
      }
      return typeof num === "string" && decimalPoint !== "." ? num.replace(/\./g, "").replace(_re_dic[decimalPoint], ".") : num;
    };
    _isNumber = function(d, decimalPoint, formatted) {
      var type = typeof d;
      var strType = type === "string";
      if (type === "number" || type === "bigint") {
        return true;
      }
      if (_empty(d)) {
        return true;
      }
      if (decimalPoint && strType) {
        d = _numToDecimal(d, decimalPoint);
      }
      if (formatted && strType) {
        d = d.replace(_re_formatted_numeric, "");
      }
      return !isNaN(parseFloat(d)) && isFinite(d);
    };
    _isHtml = function(d) {
      return _empty(d) || typeof d === "string";
    };
    _htmlNumeric = function(d, decimalPoint, formatted) {
      if (_empty(d)) {
        return true;
      }
      var html = _isHtml(d);
      return !html ? null : _isNumber(_stripHtml(d), decimalPoint, formatted) ? true : null;
    };
    _pluck = function(a, prop, prop2) {
      var out = [];
      var i = 0, ien = a.length;
      if (prop2 !== void 0) {
        for (; i < ien; i++) {
          if (a[i] && a[i][prop]) {
            out.push(a[i][prop][prop2]);
          }
        }
      } else {
        for (; i < ien; i++) {
          if (a[i]) {
            out.push(a[i][prop]);
          }
        }
      }
      return out;
    };
    _pluck_order = function(a, order, prop, prop2) {
      var out = [];
      var i = 0, ien = order.length;
      if (prop2 !== void 0) {
        for (; i < ien; i++) {
          if (a[order[i]][prop]) {
            out.push(a[order[i]][prop][prop2]);
          }
        }
      } else {
        for (; i < ien; i++) {
          out.push(a[order[i]][prop]);
        }
      }
      return out;
    };
    _range = function(len, start) {
      var out = [];
      var end;
      if (start === void 0) {
        start = 0;
        end = len;
      } else {
        end = start;
        start = len;
      }
      for (var i = start; i < end; i++) {
        out.push(i);
      }
      return out;
    };
    _removeEmpty = function(a) {
      var out = [];
      for (var i = 0, ien = a.length; i < ien; i++) {
        if (a[i]) {
          out.push(a[i]);
        }
      }
      return out;
    };
    _stripHtml = function(d) {
      return d.replace(_re_html, "").replace(/<script/i, "");
    };
    _areAllUnique = function(src) {
      if (src.length < 2) {
        return true;
      }
      var sorted = src.slice().sort();
      var last = sorted[0];
      for (var i = 1, ien = sorted.length; i < ien; i++) {
        if (sorted[i] === last) {
          return false;
        }
        last = sorted[i];
      }
      return true;
    };
    _unique = function(src) {
      if (_areAllUnique(src)) {
        return src.slice();
      }
      var out = [], val, i, ien = src.length, j, k = 0;
      again:
        for (i = 0; i < ien; i++) {
          val = src[i];
          for (j = 0; j < k; j++) {
            if (out[j] === val) {
              continue again;
            }
          }
          out.push(val);
          k++;
        }
      return out;
    };
    _flatten = function(out, val) {
      if (Array.isArray(val)) {
        for (var i = 0; i < val.length; i++) {
          _flatten(out, val[i]);
        }
      } else {
        out.push(val);
      }
      return out;
    };
    _includes = function(search, start) {
      if (start === void 0) {
        start = 0;
      }
      return this.indexOf(search, start) !== -1;
    };
    if (!Array.isArray) {
      Array.isArray = function(arg) {
        return Object.prototype.toString.call(arg) === "[object Array]";
      };
    }
    if (!Array.prototype.includes) {
      Array.prototype.includes = _includes;
    }
    if (!String.prototype.trim) {
      String.prototype.trim = function() {
        return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
      };
    }
    if (!String.prototype.includes) {
      String.prototype.includes = _includes;
    }
    DataTable.util = {
      /**
       * Throttle the calls to a function. Arguments and context are maintained
       * for the throttled function.
       *
       * @param {function} fn Function to be called
       * @param {integer} freq Call frequency in mS
       * @return {function} Wrapped function
       */
      throttle: function(fn, freq) {
        var frequency = freq !== void 0 ? freq : 200, last, timer;
        return function() {
          var that = this, now = +/* @__PURE__ */ new Date(), args = arguments;
          if (last && now < last + frequency) {
            clearTimeout(timer);
            timer = setTimeout(function() {
              last = void 0;
              fn.apply(that, args);
            }, frequency);
          } else {
            last = now;
            fn.apply(that, args);
          }
        };
      },
      /**
       * Escape a string such that it can be used in a regular expression
       *
       *  @param {string} val string to escape
       *  @returns {string} escaped string
       */
      escapeRegex: function(val) {
        return val.replace(_re_escape_regex, "\\$1");
      },
      /**
       * Create a function that will write to a nested object or array
       * @param {*} source JSON notation string
       * @returns Write function
       */
      set: function(source) {
        if ($.isPlainObject(source)) {
          return DataTable.util.set(source._);
        } else if (source === null) {
          return function() {
          };
        } else if (typeof source === "function") {
          return function(data, val, meta) {
            source(data, "set", val, meta);
          };
        } else if (typeof source === "string" && (source.indexOf(".") !== -1 || source.indexOf("[") !== -1 || source.indexOf("(") !== -1)) {
          var setData = function(data, val, src) {
            var a = _fnSplitObjNotation(src), b;
            var aLast = a[a.length - 1];
            var arrayNotation, funcNotation, o, innerSrc;
            for (var i = 0, iLen = a.length - 1; i < iLen; i++) {
              if (a[i] === "__proto__" || a[i] === "constructor") {
                throw new Error("Cannot set prototype values");
              }
              arrayNotation = a[i].match(__reArray);
              funcNotation = a[i].match(__reFn);
              if (arrayNotation) {
                a[i] = a[i].replace(__reArray, "");
                data[a[i]] = [];
                b = a.slice();
                b.splice(0, i + 1);
                innerSrc = b.join(".");
                if (Array.isArray(val)) {
                  for (var j = 0, jLen = val.length; j < jLen; j++) {
                    o = {};
                    setData(o, val[j], innerSrc);
                    data[a[i]].push(o);
                  }
                } else {
                  data[a[i]] = val;
                }
                return;
              } else if (funcNotation) {
                a[i] = a[i].replace(__reFn, "");
                data = data[a[i]](val);
              }
              if (data[a[i]] === null || data[a[i]] === void 0) {
                data[a[i]] = {};
              }
              data = data[a[i]];
            }
            if (aLast.match(__reFn)) {
              data = data[aLast.replace(__reFn, "")](val);
            } else {
              data[aLast.replace(__reArray, "")] = val;
            }
          };
          return function(data, val) {
            return setData(data, val, source);
          };
        } else {
          return function(data, val) {
            data[source] = val;
          };
        }
      },
      /**
       * Create a function that will read nested objects from arrays, based on JSON notation
       * @param {*} source JSON notation string
       * @returns Value read
       */
      get: function(source) {
        if ($.isPlainObject(source)) {
          var o = {};
          $.each(source, function(key, val) {
            if (val) {
              o[key] = DataTable.util.get(val);
            }
          });
          return function(data, type, row, meta) {
            var t = o[type] || o._;
            return t !== void 0 ? t(data, type, row, meta) : data;
          };
        } else if (source === null) {
          return function(data) {
            return data;
          };
        } else if (typeof source === "function") {
          return function(data, type, row, meta) {
            return source(data, type, row, meta);
          };
        } else if (typeof source === "string" && (source.indexOf(".") !== -1 || source.indexOf("[") !== -1 || source.indexOf("(") !== -1)) {
          var fetchData = function(data, type, src) {
            var arrayNotation, funcNotation, out, innerSrc;
            if (src !== "") {
              var a = _fnSplitObjNotation(src);
              for (var i = 0, iLen = a.length; i < iLen; i++) {
                arrayNotation = a[i].match(__reArray);
                funcNotation = a[i].match(__reFn);
                if (arrayNotation) {
                  a[i] = a[i].replace(__reArray, "");
                  if (a[i] !== "") {
                    data = data[a[i]];
                  }
                  out = [];
                  a.splice(0, i + 1);
                  innerSrc = a.join(".");
                  if (Array.isArray(data)) {
                    for (var j = 0, jLen = data.length; j < jLen; j++) {
                      out.push(fetchData(data[j], type, innerSrc));
                    }
                  }
                  var join = arrayNotation[0].substring(1, arrayNotation[0].length - 1);
                  data = join === "" ? out : out.join(join);
                  break;
                } else if (funcNotation) {
                  a[i] = a[i].replace(__reFn, "");
                  data = data[a[i]]();
                  continue;
                }
                if (data === null || data[a[i]] === null) {
                  return null;
                } else if (data === void 0 || data[a[i]] === void 0) {
                  return void 0;
                }
                data = data[a[i]];
              }
            }
            return data;
          };
          return function(data, type) {
            return fetchData(data, type, source);
          };
        } else {
          return function(data, type) {
            return data[source];
          };
        }
      }
    };
    _fnCompatMap = function(o, knew, old) {
      if (o[knew] !== void 0) {
        o[old] = o[knew];
      }
    };
    __reArray = /\[.*?\]$/;
    __reFn = /\(\)$/;
    _fnGetObjectDataFn = DataTable.util.get;
    _fnSetObjectDataFn = DataTable.util.set;
    _fnEscapeRegex = DataTable.util.escapeRegex;
    __filter_div = $("<div>")[0];
    __filter_div_textContent = __filter_div.textContent !== void 0;
    __re_html_remove = /<.*?>/g;
    _fnThrottle = DataTable.util.throttle;
    __apiStruct = [];
    __arrayProto = Array.prototype;
    _toSettings = function(mixed) {
      var idx, jq;
      var settings = DataTable.settings;
      var tables = $.map(settings, function(el, i) {
        return el.nTable;
      });
      if (!mixed) {
        return [];
      } else if (mixed.nTable && mixed.oApi) {
        return [mixed];
      } else if (mixed.nodeName && mixed.nodeName.toLowerCase() === "table") {
        idx = $.inArray(mixed, tables);
        return idx !== -1 ? [settings[idx]] : null;
      } else if (mixed && typeof mixed.settings === "function") {
        return mixed.settings().toArray();
      } else if (typeof mixed === "string") {
        jq = $(mixed);
      } else if (mixed instanceof $) {
        jq = mixed;
      }
      if (jq) {
        return jq.map(function(i) {
          idx = $.inArray(this, tables);
          return idx !== -1 ? settings[idx] : null;
        }).toArray();
      }
    };
    _Api = function(context, data) {
      if (!(this instanceof _Api)) {
        return new _Api(context, data);
      }
      var settings = [];
      var ctxSettings = function(o) {
        var a = _toSettings(o);
        if (a) {
          settings.push.apply(settings, a);
        }
      };
      if (Array.isArray(context)) {
        for (var i = 0, ien = context.length; i < ien; i++) {
          ctxSettings(context[i]);
        }
      } else {
        ctxSettings(context);
      }
      this.context = _unique(settings);
      if (data) {
        $.merge(this, data);
      }
      this.selector = {
        rows: null,
        cols: null,
        opts: null
      };
      _Api.extend(this, this, __apiStruct);
    };
    DataTable.Api = _Api;
    $.extend(_Api.prototype, {
      any: function() {
        return this.count() !== 0;
      },
      concat: __arrayProto.concat,
      context: [],
      // array of table settings objects
      count: function() {
        return this.flatten().length;
      },
      each: function(fn) {
        for (var i = 0, ien = this.length; i < ien; i++) {
          fn.call(this, this[i], i, this);
        }
        return this;
      },
      eq: function(idx) {
        var ctx = this.context;
        return ctx.length > idx ? new _Api(ctx[idx], this[idx]) : null;
      },
      filter: function(fn) {
        var a = [];
        if (__arrayProto.filter) {
          a = __arrayProto.filter.call(this, fn, this);
        } else {
          for (var i = 0, ien = this.length; i < ien; i++) {
            if (fn.call(this, this[i], i, this)) {
              a.push(this[i]);
            }
          }
        }
        return new _Api(this.context, a);
      },
      flatten: function() {
        var a = [];
        return new _Api(this.context, a.concat.apply(a, this.toArray()));
      },
      join: __arrayProto.join,
      indexOf: __arrayProto.indexOf || function(obj, start) {
        for (var i = start || 0, ien = this.length; i < ien; i++) {
          if (this[i] === obj) {
            return i;
          }
        }
        return -1;
      },
      iterator: function(flatten, type, fn, alwaysNew) {
        var a = [], ret, i, ien, j, jen, context = this.context, rows, items, item, selector = this.selector;
        if (typeof flatten === "string") {
          alwaysNew = fn;
          fn = type;
          type = flatten;
          flatten = false;
        }
        for (i = 0, ien = context.length; i < ien; i++) {
          var apiInst = new _Api(context[i]);
          if (type === "table") {
            ret = fn.call(apiInst, context[i], i);
            if (ret !== void 0) {
              a.push(ret);
            }
          } else if (type === "columns" || type === "rows") {
            ret = fn.call(apiInst, context[i], this[i], i);
            if (ret !== void 0) {
              a.push(ret);
            }
          } else if (type === "column" || type === "column-rows" || type === "row" || type === "cell") {
            items = this[i];
            if (type === "column-rows") {
              rows = _selector_row_indexes(context[i], selector.opts);
            }
            for (j = 0, jen = items.length; j < jen; j++) {
              item = items[j];
              if (type === "cell") {
                ret = fn.call(apiInst, context[i], item.row, item.column, i, j);
              } else {
                ret = fn.call(apiInst, context[i], item, i, j, rows);
              }
              if (ret !== void 0) {
                a.push(ret);
              }
            }
          }
        }
        if (a.length || alwaysNew) {
          var api = new _Api(context, flatten ? a.concat.apply([], a) : a);
          var apiSelector = api.selector;
          apiSelector.rows = selector.rows;
          apiSelector.cols = selector.cols;
          apiSelector.opts = selector.opts;
          return api;
        }
        return this;
      },
      lastIndexOf: __arrayProto.lastIndexOf || function(obj, start) {
        return this.indexOf.apply(this.toArray.reverse(), arguments);
      },
      length: 0,
      map: function(fn) {
        var a = [];
        if (__arrayProto.map) {
          a = __arrayProto.map.call(this, fn, this);
        } else {
          for (var i = 0, ien = this.length; i < ien; i++) {
            a.push(fn.call(this, this[i], i));
          }
        }
        return new _Api(this.context, a);
      },
      pluck: function(prop) {
        var fn = DataTable.util.get(prop);
        return this.map(function(el) {
          return fn(el);
        });
      },
      pop: __arrayProto.pop,
      push: __arrayProto.push,
      // Does not return an API instance
      reduce: __arrayProto.reduce || function(fn, init) {
        return _fnReduce(this, fn, init, 0, this.length, 1);
      },
      reduceRight: __arrayProto.reduceRight || function(fn, init) {
        return _fnReduce(this, fn, init, this.length - 1, -1, -1);
      },
      reverse: __arrayProto.reverse,
      // Object with rows, columns and opts
      selector: null,
      shift: __arrayProto.shift,
      slice: function() {
        return new _Api(this.context, this);
      },
      sort: __arrayProto.sort,
      // ? name - order?
      splice: __arrayProto.splice,
      toArray: function() {
        return __arrayProto.slice.call(this);
      },
      to$: function() {
        return $(this);
      },
      toJQuery: function() {
        return $(this);
      },
      unique: function() {
        return new _Api(this.context, _unique(this));
      },
      unshift: __arrayProto.unshift
    });
    _Api.extend = function(scope, obj, ext) {
      if (!ext.length || !obj || !(obj instanceof _Api) && !obj.__dt_wrapper) {
        return;
      }
      var i, ien, struct, methodScoping = function(scope2, fn, struc) {
        return function() {
          var ret = fn.apply(scope2, arguments);
          _Api.extend(ret, ret, struc.methodExt);
          return ret;
        };
      };
      for (i = 0, ien = ext.length; i < ien; i++) {
        struct = ext[i];
        obj[struct.name] = struct.type === "function" ? methodScoping(scope, struct.val, struct) : struct.type === "object" ? {} : struct.val;
        obj[struct.name].__dt_wrapper = true;
        _Api.extend(scope, obj[struct.name], struct.propExt);
      }
    };
    _Api.register = _api_register = function(name, val) {
      if (Array.isArray(name)) {
        for (var j = 0, jen = name.length; j < jen; j++) {
          _Api.register(name[j], val);
        }
        return;
      }
      var i, ien, heir = name.split("."), struct = __apiStruct, key, method;
      var find = function(src2, name2) {
        for (var i2 = 0, ien2 = src2.length; i2 < ien2; i2++) {
          if (src2[i2].name === name2) {
            return src2[i2];
          }
        }
        return null;
      };
      for (i = 0, ien = heir.length; i < ien; i++) {
        method = heir[i].indexOf("()") !== -1;
        key = method ? heir[i].replace("()", "") : heir[i];
        var src = find(struct, key);
        if (!src) {
          src = {
            name: key,
            val: {},
            methodExt: [],
            propExt: [],
            type: "object"
          };
          struct.push(src);
        }
        if (i === ien - 1) {
          src.val = val;
          src.type = typeof val === "function" ? "function" : $.isPlainObject(val) ? "object" : "other";
        } else {
          struct = method ? src.methodExt : src.propExt;
        }
      }
    };
    _Api.registerPlural = _api_registerPlural = function(pluralName, singularName, val) {
      _Api.register(pluralName, val);
      _Api.register(singularName, function() {
        var ret = val.apply(this, arguments);
        if (ret === this) {
          return this;
        } else if (ret instanceof _Api) {
          return ret.length ? Array.isArray(ret[0]) ? new _Api(ret.context, ret[0]) : (
            // Array results are 'enhanced'
            ret[0]
          ) : void 0;
        }
        return ret;
      });
    };
    __table_selector = function(selector, a) {
      if (Array.isArray(selector)) {
        return $.map(selector, function(item) {
          return __table_selector(item, a);
        });
      }
      if (typeof selector === "number") {
        return [a[selector]];
      }
      var nodes = $.map(a, function(el, i) {
        return el.nTable;
      });
      return $(nodes).filter(selector).map(function(i) {
        var idx = $.inArray(this, nodes);
        return a[idx];
      }).toArray();
    };
    _api_register("tables()", function(selector) {
      return selector !== void 0 && selector !== null ? new _Api(__table_selector(selector, this.context)) : this;
    });
    _api_register("table()", function(selector) {
      var tables = this.tables(selector);
      var ctx = tables.context;
      return ctx.length ? new _Api(ctx[0]) : tables;
    });
    _api_registerPlural("tables().nodes()", "table().node()", function() {
      return this.iterator("table", function(ctx) {
        return ctx.nTable;
      }, 1);
    });
    _api_registerPlural("tables().body()", "table().body()", function() {
      return this.iterator("table", function(ctx) {
        return ctx.nTBody;
      }, 1);
    });
    _api_registerPlural("tables().header()", "table().header()", function() {
      return this.iterator("table", function(ctx) {
        return ctx.nTHead;
      }, 1);
    });
    _api_registerPlural("tables().footer()", "table().footer()", function() {
      return this.iterator("table", function(ctx) {
        return ctx.nTFoot;
      }, 1);
    });
    _api_registerPlural("tables().containers()", "table().container()", function() {
      return this.iterator("table", function(ctx) {
        return ctx.nTableWrapper;
      }, 1);
    });
    _api_register("draw()", function(paging) {
      return this.iterator("table", function(settings) {
        if (paging === "page") {
          _fnDraw(settings);
        } else {
          if (typeof paging === "string") {
            paging = paging === "full-hold" ? false : true;
          }
          _fnReDraw(settings, paging === false);
        }
      });
    });
    _api_register("page()", function(action) {
      if (action === void 0) {
        return this.page.info().page;
      }
      return this.iterator("table", function(settings) {
        _fnPageChange(settings, action);
      });
    });
    _api_register("page.info()", function(action) {
      if (this.context.length === 0) {
        return void 0;
      }
      var settings = this.context[0], start = settings._iDisplayStart, len = settings.oFeatures.bPaginate ? settings._iDisplayLength : -1, visRecords = settings.fnRecordsDisplay(), all = len === -1;
      return {
        "page": all ? 0 : Math.floor(start / len),
        "pages": all ? 1 : Math.ceil(visRecords / len),
        "start": start,
        "end": settings.fnDisplayEnd(),
        "length": len,
        "recordsTotal": settings.fnRecordsTotal(),
        "recordsDisplay": visRecords,
        "serverSide": _fnDataSource(settings) === "ssp"
      };
    });
    _api_register("page.len()", function(len) {
      if (len === void 0) {
        return this.context.length !== 0 ? this.context[0]._iDisplayLength : void 0;
      }
      return this.iterator("table", function(settings) {
        _fnLengthChange(settings, len);
      });
    });
    __reload = function(settings, holdPosition, callback) {
      if (callback) {
        var api = new _Api(settings);
        api.one("draw", function() {
          callback(api.ajax.json());
        });
      }
      if (_fnDataSource(settings) == "ssp") {
        _fnReDraw(settings, holdPosition);
      } else {
        _fnProcessingDisplay(settings, true);
        var xhr = settings.jqXHR;
        if (xhr && xhr.readyState !== 4) {
          xhr.abort();
        }
        _fnBuildAjax(settings, [], function(json) {
          _fnClearTable(settings);
          var data = _fnAjaxDataSrc(settings, json);
          for (var i = 0, ien = data.length; i < ien; i++) {
            _fnAddData(settings, data[i]);
          }
          _fnReDraw(settings, holdPosition);
          _fnProcessingDisplay(settings, false);
        });
      }
    };
    _api_register("ajax.json()", function() {
      var ctx = this.context;
      if (ctx.length > 0) {
        return ctx[0].json;
      }
    });
    _api_register("ajax.params()", function() {
      var ctx = this.context;
      if (ctx.length > 0) {
        return ctx[0].oAjaxData;
      }
    });
    _api_register("ajax.reload()", function(callback, resetPaging) {
      return this.iterator("table", function(settings) {
        __reload(settings, resetPaging === false, callback);
      });
    });
    _api_register("ajax.url()", function(url) {
      var ctx = this.context;
      if (url === void 0) {
        if (ctx.length === 0) {
          return void 0;
        }
        ctx = ctx[0];
        return ctx.ajax ? $.isPlainObject(ctx.ajax) ? ctx.ajax.url : ctx.ajax : ctx.sAjaxSource;
      }
      return this.iterator("table", function(settings) {
        if ($.isPlainObject(settings.ajax)) {
          settings.ajax.url = url;
        } else {
          settings.ajax = url;
        }
      });
    });
    _api_register("ajax.url().load()", function(callback, resetPaging) {
      return this.iterator("table", function(ctx) {
        __reload(ctx, resetPaging === false, callback);
      });
    });
    _selector_run = function(type, selector, selectFn, settings, opts) {
      var out = [], res, a, i, ien, j, jen, selectorType = typeof selector;
      if (!selector || selectorType === "string" || selectorType === "function" || selector.length === void 0) {
        selector = [selector];
      }
      for (i = 0, ien = selector.length; i < ien; i++) {
        a = selector[i] && selector[i].split && !selector[i].match(/[\[\(:]/) ? selector[i].split(",") : [selector[i]];
        for (j = 0, jen = a.length; j < jen; j++) {
          res = selectFn(typeof a[j] === "string" ? a[j].trim() : a[j]);
          if (res && res.length) {
            out = out.concat(res);
          }
        }
      }
      var ext = _ext.selector[type];
      if (ext.length) {
        for (i = 0, ien = ext.length; i < ien; i++) {
          out = ext[i](settings, opts, out);
        }
      }
      return _unique(out);
    };
    _selector_opts = function(opts) {
      if (!opts) {
        opts = {};
      }
      if (opts.filter && opts.search === void 0) {
        opts.search = opts.filter;
      }
      return $.extend({
        search: "none",
        order: "current",
        page: "all"
      }, opts);
    };
    _selector_first = function(inst) {
      for (var i = 0, ien = inst.length; i < ien; i++) {
        if (inst[i].length > 0) {
          inst[0] = inst[i];
          inst[0].length = 1;
          inst.length = 1;
          inst.context = [inst.context[i]];
          return inst;
        }
      }
      inst.length = 0;
      return inst;
    };
    _selector_row_indexes = function(settings, opts) {
      var i, ien, tmp, a = [], displayFiltered = settings.aiDisplay, displayMaster = settings.aiDisplayMaster;
      var search = opts.search, order = opts.order, page = opts.page;
      if (_fnDataSource(settings) == "ssp") {
        return search === "removed" ? [] : _range(0, displayMaster.length);
      } else if (page == "current") {
        for (i = settings._iDisplayStart, ien = settings.fnDisplayEnd(); i < ien; i++) {
          a.push(displayFiltered[i]);
        }
      } else if (order == "current" || order == "applied") {
        if (search == "none") {
          a = displayMaster.slice();
        } else if (search == "applied") {
          a = displayFiltered.slice();
        } else if (search == "removed") {
          var displayFilteredMap = {};
          for (var i = 0, ien = displayFiltered.length; i < ien; i++) {
            displayFilteredMap[displayFiltered[i]] = null;
          }
          a = $.map(displayMaster, function(el) {
            return !displayFilteredMap.hasOwnProperty(el) ? el : null;
          });
        }
      } else if (order == "index" || order == "original") {
        for (i = 0, ien = settings.aoData.length; i < ien; i++) {
          if (search == "none") {
            a.push(i);
          } else {
            tmp = $.inArray(i, displayFiltered);
            if (tmp === -1 && search == "removed" || tmp >= 0 && search == "applied") {
              a.push(i);
            }
          }
        }
      }
      return a;
    };
    __row_selector = function(settings, selector, opts) {
      var rows;
      var run = function(sel) {
        var selInt = _intVal(sel);
        var i, ien;
        var aoData = settings.aoData;
        if (selInt !== null && !opts) {
          return [selInt];
        }
        if (!rows) {
          rows = _selector_row_indexes(settings, opts);
        }
        if (selInt !== null && $.inArray(selInt, rows) !== -1) {
          return [selInt];
        } else if (sel === null || sel === void 0 || sel === "") {
          return rows;
        }
        if (typeof sel === "function") {
          return $.map(rows, function(idx) {
            var row = aoData[idx];
            return sel(idx, row._aData, row.nTr) ? idx : null;
          });
        }
        if (sel.nodeName) {
          var rowIdx = sel._DT_RowIndex;
          var cellIdx = sel._DT_CellIndex;
          if (rowIdx !== void 0) {
            return aoData[rowIdx] && aoData[rowIdx].nTr === sel ? [rowIdx] : [];
          } else if (cellIdx) {
            return aoData[cellIdx.row] && aoData[cellIdx.row].nTr === sel.parentNode ? [cellIdx.row] : [];
          } else {
            var host = $(sel).closest("*[data-dt-row]");
            return host.length ? [host.data("dt-row")] : [];
          }
        }
        if (typeof sel === "string" && sel.charAt(0) === "#") {
          var rowObj = settings.aIds[sel.replace(/^#/, "")];
          if (rowObj !== void 0) {
            return [rowObj.idx];
          }
        }
        var nodes = _removeEmpty(
          _pluck_order(settings.aoData, rows, "nTr")
        );
        return $(nodes).filter(sel).map(function() {
          return this._DT_RowIndex;
        }).toArray();
      };
      return _selector_run("row", selector, run, settings, opts);
    };
    _api_register("rows()", function(selector, opts) {
      if (selector === void 0) {
        selector = "";
      } else if ($.isPlainObject(selector)) {
        opts = selector;
        selector = "";
      }
      opts = _selector_opts(opts);
      var inst = this.iterator("table", function(settings) {
        return __row_selector(settings, selector, opts);
      }, 1);
      inst.selector.rows = selector;
      inst.selector.opts = opts;
      return inst;
    });
    _api_register("rows().nodes()", function() {
      return this.iterator("row", function(settings, row) {
        return settings.aoData[row].nTr || void 0;
      }, 1);
    });
    _api_register("rows().data()", function() {
      return this.iterator(true, "rows", function(settings, rows) {
        return _pluck_order(settings.aoData, rows, "_aData");
      }, 1);
    });
    _api_registerPlural("rows().cache()", "row().cache()", function(type) {
      return this.iterator("row", function(settings, row) {
        var r = settings.aoData[row];
        return type === "search" ? r._aFilterData : r._aSortData;
      }, 1);
    });
    _api_registerPlural("rows().invalidate()", "row().invalidate()", function(src) {
      return this.iterator("row", function(settings, row) {
        _fnInvalidate(settings, row, src);
      });
    });
    _api_registerPlural("rows().indexes()", "row().index()", function() {
      return this.iterator("row", function(settings, row) {
        return row;
      }, 1);
    });
    _api_registerPlural("rows().ids()", "row().id()", function(hash) {
      var a = [];
      var context = this.context;
      for (var i = 0, ien = context.length; i < ien; i++) {
        for (var j = 0, jen = this[i].length; j < jen; j++) {
          var id = context[i].rowIdFn(context[i].aoData[this[i][j]]._aData);
          a.push((hash === true ? "#" : "") + id);
        }
      }
      return new _Api(context, a);
    });
    _api_registerPlural("rows().remove()", "row().remove()", function() {
      var that = this;
      this.iterator("row", function(settings, row, thatIdx) {
        var data = settings.aoData;
        var rowData = data[row];
        var i, ien, j, jen;
        var loopRow, loopCells;
        data.splice(row, 1);
        for (i = 0, ien = data.length; i < ien; i++) {
          loopRow = data[i];
          loopCells = loopRow.anCells;
          if (loopRow.nTr !== null) {
            loopRow.nTr._DT_RowIndex = i;
          }
          if (loopCells !== null) {
            for (j = 0, jen = loopCells.length; j < jen; j++) {
              loopCells[j]._DT_CellIndex.row = i;
            }
          }
        }
        _fnDeleteIndex(settings.aiDisplayMaster, row);
        _fnDeleteIndex(settings.aiDisplay, row);
        _fnDeleteIndex(that[thatIdx], row, false);
        if (settings._iRecordsDisplay > 0) {
          settings._iRecordsDisplay--;
        }
        _fnLengthOverflow(settings);
        var id = settings.rowIdFn(rowData._aData);
        if (id !== void 0) {
          delete settings.aIds[id];
        }
      });
      this.iterator("table", function(settings) {
        for (var i = 0, ien = settings.aoData.length; i < ien; i++) {
          settings.aoData[i].idx = i;
        }
      });
      return this;
    });
    _api_register("rows.add()", function(rows) {
      var newRows = this.iterator("table", function(settings) {
        var row, i, ien;
        var out = [];
        for (i = 0, ien = rows.length; i < ien; i++) {
          row = rows[i];
          if (row.nodeName && row.nodeName.toUpperCase() === "TR") {
            out.push(_fnAddTr(settings, row)[0]);
          } else {
            out.push(_fnAddData(settings, row));
          }
        }
        return out;
      }, 1);
      var modRows = this.rows(-1);
      modRows.pop();
      $.merge(modRows, newRows);
      return modRows;
    });
    _api_register("row()", function(selector, opts) {
      return _selector_first(this.rows(selector, opts));
    });
    _api_register("row().data()", function(data) {
      var ctx = this.context;
      if (data === void 0) {
        return ctx.length && this.length ? ctx[0].aoData[this[0]]._aData : void 0;
      }
      var row = ctx[0].aoData[this[0]];
      row._aData = data;
      if (Array.isArray(data) && row.nTr && row.nTr.id) {
        _fnSetObjectDataFn(ctx[0].rowId)(data, row.nTr.id);
      }
      _fnInvalidate(ctx[0], this[0], "data");
      return this;
    });
    _api_register("row().node()", function() {
      var ctx = this.context;
      return ctx.length && this.length ? ctx[0].aoData[this[0]].nTr || null : null;
    });
    _api_register("row.add()", function(row) {
      if (row instanceof $ && row.length) {
        row = row[0];
      }
      var rows = this.iterator("table", function(settings) {
        if (row.nodeName && row.nodeName.toUpperCase() === "TR") {
          return _fnAddTr(settings, row)[0];
        }
        return _fnAddData(settings, row);
      });
      return this.row(rows[0]);
    });
    $(document).on("plugin-init.dt", function(e, context) {
      var api = new _Api(context);
      var namespace = "on-plugin-init";
      var stateSaveParamsEvent = "stateSaveParams." + namespace;
      var destroyEvent = "destroy. " + namespace;
      api.on(stateSaveParamsEvent, function(e2, settings, d) {
        var idFn = settings.rowIdFn;
        var data = settings.aoData;
        var ids = [];
        for (var i = 0; i < data.length; i++) {
          if (data[i]._detailsShow) {
            ids.push("#" + idFn(data[i]._aData));
          }
        }
        d.childRows = ids;
      });
      api.on(destroyEvent, function() {
        api.off(stateSaveParamsEvent + " " + destroyEvent);
      });
      var loaded = api.state.loaded();
      if (loaded && loaded.childRows) {
        api.rows($.map(loaded.childRows, function(id) {
          return id.replace(/:/g, "\\:");
        })).every(function() {
          _fnCallbackFire(context, null, "requestChild", [this]);
        });
      }
    });
    __details_add = function(ctx, row, data, klass) {
      var rows = [];
      var addRow = function(r, k) {
        if (Array.isArray(r) || r instanceof $) {
          for (var i = 0, ien = r.length; i < ien; i++) {
            addRow(r[i], k);
          }
          return;
        }
        if (r.nodeName && r.nodeName.toLowerCase() === "tr") {
          rows.push(r);
        } else {
          var created = $("<tr><td></td></tr>").addClass(k);
          $("td", created).addClass(k).html(r)[0].colSpan = _fnVisbleColumns(ctx);
          rows.push(created[0]);
        }
      };
      addRow(data, klass);
      if (row._details) {
        row._details.detach();
      }
      row._details = $(rows);
      if (row._detailsShow) {
        row._details.insertAfter(row.nTr);
      }
    };
    __details_state = DataTable.util.throttle(
      function(ctx) {
        _fnSaveState(ctx[0]);
      },
      500
    );
    __details_remove = function(api, idx) {
      var ctx = api.context;
      if (ctx.length) {
        var row = ctx[0].aoData[idx !== void 0 ? idx : api[0]];
        if (row && row._details) {
          row._details.remove();
          row._detailsShow = void 0;
          row._details = void 0;
          $(row.nTr).removeClass("dt-hasChild");
          __details_state(ctx);
        }
      }
    };
    __details_display = function(api, show) {
      var ctx = api.context;
      if (ctx.length && api.length) {
        var row = ctx[0].aoData[api[0]];
        if (row._details) {
          row._detailsShow = show;
          if (show) {
            row._details.insertAfter(row.nTr);
            $(row.nTr).addClass("dt-hasChild");
          } else {
            row._details.detach();
            $(row.nTr).removeClass("dt-hasChild");
          }
          _fnCallbackFire(ctx[0], null, "childRow", [show, api.row(api[0])]);
          __details_events(ctx[0]);
          __details_state(ctx);
        }
      }
    };
    __details_events = function(settings) {
      var api = new _Api(settings);
      var namespace = ".dt.DT_details";
      var drawEvent = "draw" + namespace;
      var colvisEvent = "column-sizing" + namespace;
      var destroyEvent = "destroy" + namespace;
      var data = settings.aoData;
      api.off(drawEvent + " " + colvisEvent + " " + destroyEvent);
      if (_pluck(data, "_details").length > 0) {
        api.on(drawEvent, function(e, ctx) {
          if (settings !== ctx) {
            return;
          }
          api.rows({ page: "current" }).eq(0).each(function(idx) {
            var row = data[idx];
            if (row._detailsShow) {
              row._details.insertAfter(row.nTr);
            }
          });
        });
        api.on(colvisEvent, function(e, ctx, idx, vis) {
          if (settings !== ctx) {
            return;
          }
          var row, visible = _fnVisbleColumns(ctx);
          for (var i = 0, ien = data.length; i < ien; i++) {
            row = data[i];
            if (row._details) {
              row._details.each(function() {
                var el = $(this).children("td");
                if (el.length == 1) {
                  el.attr("colspan", visible);
                }
              });
            }
          }
        });
        api.on(destroyEvent, function(e, ctx) {
          if (settings !== ctx) {
            return;
          }
          for (var i = 0, ien = data.length; i < ien; i++) {
            if (data[i]._details) {
              __details_remove(api, i);
            }
          }
        });
      }
    };
    _emp = "";
    _child_obj = _emp + "row().child";
    _child_mth = _child_obj + "()";
    _api_register(_child_mth, function(data, klass) {
      var ctx = this.context;
      if (data === void 0) {
        return ctx.length && this.length ? ctx[0].aoData[this[0]]._details : void 0;
      } else if (data === true) {
        this.child.show();
      } else if (data === false) {
        __details_remove(this);
      } else if (ctx.length && this.length) {
        __details_add(ctx[0], ctx[0].aoData[this[0]], data, klass);
      }
      return this;
    });
    _api_register([
      _child_obj + ".show()",
      _child_mth + ".show()"
      // only when `child()` was called with parameters (without
    ], function(show) {
      __details_display(this, true);
      return this;
    });
    _api_register([
      _child_obj + ".hide()",
      _child_mth + ".hide()"
      // only when `child()` was called with parameters (without
    ], function() {
      __details_display(this, false);
      return this;
    });
    _api_register([
      _child_obj + ".remove()",
      _child_mth + ".remove()"
      // only when `child()` was called with parameters (without
    ], function() {
      __details_remove(this);
      return this;
    });
    _api_register(_child_obj + ".isShown()", function() {
      var ctx = this.context;
      if (ctx.length && this.length) {
        return ctx[0].aoData[this[0]]._detailsShow || false;
      }
      return false;
    });
    __re_column_selector = /^([^:]+):(name|visIdx|visible)$/;
    __columnData = function(settings, column, r1, r2, rows) {
      var a = [];
      for (var row = 0, ien = rows.length; row < ien; row++) {
        a.push(_fnGetCellData(settings, rows[row], column));
      }
      return a;
    };
    __column_selector = function(settings, selector, opts) {
      var columns = settings.aoColumns, names = _pluck(columns, "sName"), nodes = _pluck(columns, "nTh");
      var run = function(s) {
        var selInt = _intVal(s);
        if (s === "") {
          return _range(columns.length);
        }
        if (selInt !== null) {
          return [
            selInt >= 0 ? selInt : (
              // Count from left
              columns.length + selInt
            )
            // Count from right (+ because its a negative value)
          ];
        }
        if (typeof s === "function") {
          var rows = _selector_row_indexes(settings, opts);
          return $.map(columns, function(col, idx2) {
            return s(
              idx2,
              __columnData(settings, idx2, 0, 0, rows),
              nodes[idx2]
            ) ? idx2 : null;
          });
        }
        var match = typeof s === "string" ? s.match(__re_column_selector) : "";
        if (match) {
          switch (match[2]) {
            case "visIdx":
            case "visible":
              var idx = parseInt(match[1], 10);
              if (idx < 0) {
                var visColumns = $.map(columns, function(col, i) {
                  return col.bVisible ? i : null;
                });
                return [visColumns[visColumns.length + idx]];
              }
              return [_fnVisibleToColumnIndex(settings, idx)];
            case "name":
              return $.map(names, function(name, i) {
                return name === match[1] ? i : null;
              });
            default:
              return [];
          }
        }
        if (s.nodeName && s._DT_CellIndex) {
          return [s._DT_CellIndex.column];
        }
        var jqResult = $(nodes).filter(s).map(function() {
          return $.inArray(this, nodes);
        }).toArray();
        if (jqResult.length || !s.nodeName) {
          return jqResult;
        }
        var host = $(s).closest("*[data-dt-column]");
        return host.length ? [host.data("dt-column")] : [];
      };
      return _selector_run("column", selector, run, settings, opts);
    };
    __setColumnVis = function(settings, column, vis) {
      var cols = settings.aoColumns, col = cols[column], data = settings.aoData, row, cells, i, ien, tr;
      if (vis === void 0) {
        return col.bVisible;
      }
      if (col.bVisible === vis) {
        return;
      }
      if (vis) {
        var insertBefore = $.inArray(true, _pluck(cols, "bVisible"), column + 1);
        for (i = 0, ien = data.length; i < ien; i++) {
          tr = data[i].nTr;
          cells = data[i].anCells;
          if (tr) {
            tr.insertBefore(cells[column], cells[insertBefore] || null);
          }
        }
      } else {
        $(_pluck(settings.aoData, "anCells", column)).detach();
      }
      col.bVisible = vis;
    };
    _api_register("columns()", function(selector, opts) {
      if (selector === void 0) {
        selector = "";
      } else if ($.isPlainObject(selector)) {
        opts = selector;
        selector = "";
      }
      opts = _selector_opts(opts);
      var inst = this.iterator("table", function(settings) {
        return __column_selector(settings, selector, opts);
      }, 1);
      inst.selector.cols = selector;
      inst.selector.opts = opts;
      return inst;
    });
    _api_registerPlural("columns().header()", "column().header()", function(selector, opts) {
      return this.iterator("column", function(settings, column) {
        return settings.aoColumns[column].nTh;
      }, 1);
    });
    _api_registerPlural("columns().footer()", "column().footer()", function(selector, opts) {
      return this.iterator("column", function(settings, column) {
        return settings.aoColumns[column].nTf;
      }, 1);
    });
    _api_registerPlural("columns().data()", "column().data()", function() {
      return this.iterator("column-rows", __columnData, 1);
    });
    _api_registerPlural("columns().dataSrc()", "column().dataSrc()", function() {
      return this.iterator("column", function(settings, column) {
        return settings.aoColumns[column].mData;
      }, 1);
    });
    _api_registerPlural("columns().cache()", "column().cache()", function(type) {
      return this.iterator("column-rows", function(settings, column, i, j, rows) {
        return _pluck_order(
          settings.aoData,
          rows,
          type === "search" ? "_aFilterData" : "_aSortData",
          column
        );
      }, 1);
    });
    _api_registerPlural("columns().nodes()", "column().nodes()", function() {
      return this.iterator("column-rows", function(settings, column, i, j, rows) {
        return _pluck_order(settings.aoData, rows, "anCells", column);
      }, 1);
    });
    _api_registerPlural("columns().visible()", "column().visible()", function(vis, calc) {
      var that = this;
      var ret = this.iterator("column", function(settings, column) {
        if (vis === void 0) {
          return settings.aoColumns[column].bVisible;
        }
        __setColumnVis(settings, column, vis);
      });
      if (vis !== void 0) {
        this.iterator("table", function(settings) {
          _fnDrawHead(settings, settings.aoHeader);
          _fnDrawHead(settings, settings.aoFooter);
          if (!settings.aiDisplay.length) {
            $(settings.nTBody).find("td[colspan]").attr("colspan", _fnVisbleColumns(settings));
          }
          _fnSaveState(settings);
          that.iterator("column", function(settings2, column) {
            _fnCallbackFire(settings2, null, "column-visibility", [settings2, column, vis, calc]);
          });
          if (calc === void 0 || calc) {
            that.columns.adjust();
          }
        });
      }
      return ret;
    });
    _api_registerPlural("columns().indexes()", "column().index()", function(type) {
      return this.iterator("column", function(settings, column) {
        return type === "visible" ? _fnColumnIndexToVisible(settings, column) : column;
      }, 1);
    });
    _api_register("columns.adjust()", function() {
      return this.iterator("table", function(settings) {
        _fnAdjustColumnSizing(settings);
      }, 1);
    });
    _api_register("column.index()", function(type, idx) {
      if (this.context.length !== 0) {
        var ctx = this.context[0];
        if (type === "fromVisible" || type === "toData") {
          return _fnVisibleToColumnIndex(ctx, idx);
        } else if (type === "fromData" || type === "toVisible") {
          return _fnColumnIndexToVisible(ctx, idx);
        }
      }
    });
    _api_register("column()", function(selector, opts) {
      return _selector_first(this.columns(selector, opts));
    });
    __cell_selector = function(settings, selector, opts) {
      var data = settings.aoData;
      var rows = _selector_row_indexes(settings, opts);
      var cells = _removeEmpty(_pluck_order(data, rows, "anCells"));
      var allCells = $(_flatten([], cells));
      var row;
      var columns = settings.aoColumns.length;
      var a, i, ien, j, o, host;
      var run = function(s) {
        var fnSelector = typeof s === "function";
        if (s === null || s === void 0 || fnSelector) {
          a = [];
          for (i = 0, ien = rows.length; i < ien; i++) {
            row = rows[i];
            for (j = 0; j < columns; j++) {
              o = {
                row,
                column: j
              };
              if (fnSelector) {
                host = data[row];
                if (s(o, _fnGetCellData(settings, row, j), host.anCells ? host.anCells[j] : null)) {
                  a.push(o);
                }
              } else {
                a.push(o);
              }
            }
          }
          return a;
        }
        if ($.isPlainObject(s)) {
          return s.column !== void 0 && s.row !== void 0 && $.inArray(s.row, rows) !== -1 ? [s] : [];
        }
        var jqResult = allCells.filter(s).map(function(i2, el) {
          return {
            // use a new object, in case someone changes the values
            row: el._DT_CellIndex.row,
            column: el._DT_CellIndex.column
          };
        }).toArray();
        if (jqResult.length || !s.nodeName) {
          return jqResult;
        }
        host = $(s).closest("*[data-dt-row]");
        return host.length ? [{
          row: host.data("dt-row"),
          column: host.data("dt-column")
        }] : [];
      };
      return _selector_run("cell", selector, run, settings, opts);
    };
    _api_register("cells()", function(rowSelector, columnSelector, opts) {
      if ($.isPlainObject(rowSelector)) {
        if (rowSelector.row === void 0) {
          opts = rowSelector;
          rowSelector = null;
        } else {
          opts = columnSelector;
          columnSelector = null;
        }
      }
      if ($.isPlainObject(columnSelector)) {
        opts = columnSelector;
        columnSelector = null;
      }
      if (columnSelector === null || columnSelector === void 0) {
        return this.iterator("table", function(settings) {
          return __cell_selector(settings, rowSelector, _selector_opts(opts));
        });
      }
      var internalOpts = opts ? {
        page: opts.page,
        order: opts.order,
        search: opts.search
      } : {};
      var columns = this.columns(columnSelector, internalOpts);
      var rows = this.rows(rowSelector, internalOpts);
      var i, ien, j, jen;
      var cellsNoOpts = this.iterator("table", function(settings, idx) {
        var a = [];
        for (i = 0, ien = rows[idx].length; i < ien; i++) {
          for (j = 0, jen = columns[idx].length; j < jen; j++) {
            a.push({
              row: rows[idx][i],
              column: columns[idx][j]
            });
          }
        }
        return a;
      }, 1);
      var cells = opts && opts.selected ? this.cells(cellsNoOpts, opts) : cellsNoOpts;
      $.extend(cells.selector, {
        cols: columnSelector,
        rows: rowSelector,
        opts
      });
      return cells;
    });
    _api_registerPlural("cells().nodes()", "cell().node()", function() {
      return this.iterator("cell", function(settings, row, column) {
        var data = settings.aoData[row];
        return data && data.anCells ? data.anCells[column] : void 0;
      }, 1);
    });
    _api_register("cells().data()", function() {
      return this.iterator("cell", function(settings, row, column) {
        return _fnGetCellData(settings, row, column);
      }, 1);
    });
    _api_registerPlural("cells().cache()", "cell().cache()", function(type) {
      type = type === "search" ? "_aFilterData" : "_aSortData";
      return this.iterator("cell", function(settings, row, column) {
        return settings.aoData[row][type][column];
      }, 1);
    });
    _api_registerPlural("cells().render()", "cell().render()", function(type) {
      return this.iterator("cell", function(settings, row, column) {
        return _fnGetCellData(settings, row, column, type);
      }, 1);
    });
    _api_registerPlural("cells().indexes()", "cell().index()", function() {
      return this.iterator("cell", function(settings, row, column) {
        return {
          row,
          column,
          columnVisible: _fnColumnIndexToVisible(settings, column)
        };
      }, 1);
    });
    _api_registerPlural("cells().invalidate()", "cell().invalidate()", function(src) {
      return this.iterator("cell", function(settings, row, column) {
        _fnInvalidate(settings, row, src, column);
      });
    });
    _api_register("cell()", function(rowSelector, columnSelector, opts) {
      return _selector_first(this.cells(rowSelector, columnSelector, opts));
    });
    _api_register("cell().data()", function(data) {
      var ctx = this.context;
      var cell = this[0];
      if (data === void 0) {
        return ctx.length && cell.length ? _fnGetCellData(ctx[0], cell[0].row, cell[0].column) : void 0;
      }
      _fnSetCellData(ctx[0], cell[0].row, cell[0].column, data);
      _fnInvalidate(ctx[0], cell[0].row, "data", cell[0].column);
      return this;
    });
    _api_register("order()", function(order, dir) {
      var ctx = this.context;
      if (order === void 0) {
        return ctx.length !== 0 ? ctx[0].aaSorting : void 0;
      }
      if (typeof order === "number") {
        order = [[order, dir]];
      } else if (order.length && !Array.isArray(order[0])) {
        order = Array.prototype.slice.call(arguments);
      }
      return this.iterator("table", function(settings) {
        settings.aaSorting = order.slice();
      });
    });
    _api_register("order.listener()", function(node, column, callback) {
      return this.iterator("table", function(settings) {
        _fnSortAttachListener(settings, node, column, callback);
      });
    });
    _api_register("order.fixed()", function(set) {
      if (!set) {
        var ctx = this.context;
        var fixed = ctx.length ? ctx[0].aaSortingFixed : void 0;
        return Array.isArray(fixed) ? { pre: fixed } : fixed;
      }
      return this.iterator("table", function(settings) {
        settings.aaSortingFixed = $.extend(true, {}, set);
      });
    });
    _api_register([
      "columns().order()",
      "column().order()"
    ], function(dir) {
      var that = this;
      return this.iterator("table", function(settings, i) {
        var sort = [];
        $.each(that[i], function(j, col) {
          sort.push([col, dir]);
        });
        settings.aaSorting = sort;
      });
    });
    _api_register("search()", function(input, regex, smart, caseInsen) {
      var ctx = this.context;
      if (input === void 0) {
        return ctx.length !== 0 ? ctx[0].oPreviousSearch.sSearch : void 0;
      }
      return this.iterator("table", function(settings) {
        if (!settings.oFeatures.bFilter) {
          return;
        }
        _fnFilterComplete(settings, $.extend({}, settings.oPreviousSearch, {
          "sSearch": input + "",
          "bRegex": regex === null ? false : regex,
          "bSmart": smart === null ? true : smart,
          "bCaseInsensitive": caseInsen === null ? true : caseInsen
        }), 1);
      });
    });
    _api_registerPlural(
      "columns().search()",
      "column().search()",
      function(input, regex, smart, caseInsen) {
        return this.iterator("column", function(settings, column) {
          var preSearch = settings.aoPreSearchCols;
          if (input === void 0) {
            return preSearch[column].sSearch;
          }
          if (!settings.oFeatures.bFilter) {
            return;
          }
          $.extend(preSearch[column], {
            "sSearch": input + "",
            "bRegex": regex === null ? false : regex,
            "bSmart": smart === null ? true : smart,
            "bCaseInsensitive": caseInsen === null ? true : caseInsen
          });
          _fnFilterComplete(settings, settings.oPreviousSearch, 1);
        });
      }
    );
    _api_register("state()", function() {
      return this.context.length ? this.context[0].oSavedState : null;
    });
    _api_register("state.clear()", function() {
      return this.iterator("table", function(settings) {
        settings.fnStateSaveCallback.call(settings.oInstance, settings, {});
      });
    });
    _api_register("state.loaded()", function() {
      return this.context.length ? this.context[0].oLoadedState : null;
    });
    _api_register("state.save()", function() {
      return this.iterator("table", function(settings) {
        _fnSaveState(settings);
      });
    });
    DataTable.use = function(module, type) {
      if (type === "lib" || module.fn) {
        $ = module;
      } else if (type == "win" || module.document) {
        window = module;
        document = module.document;
      } else if (type === "datetime" || module.type === "DateTime") {
        DataTable.DateTime = module;
      }
    };
    DataTable.factory = function(root, jq) {
      var is = false;
      if (root && root.document) {
        window = root;
        document = root.document;
      }
      if (jq && jq.fn && jq.fn.jquery) {
        $ = jq;
        is = true;
      }
      return is;
    };
    DataTable.versionCheck = DataTable.fnVersionCheck = function(version) {
      var aThis = DataTable.version.split(".");
      var aThat = version.split(".");
      var iThis, iThat;
      for (var i = 0, iLen = aThat.length; i < iLen; i++) {
        iThis = parseInt(aThis[i], 10) || 0;
        iThat = parseInt(aThat[i], 10) || 0;
        if (iThis === iThat) {
          continue;
        }
        return iThis > iThat;
      }
      return true;
    };
    DataTable.isDataTable = DataTable.fnIsDataTable = function(table) {
      var t = $(table).get(0);
      var is = false;
      if (table instanceof DataTable.Api) {
        return true;
      }
      $.each(DataTable.settings, function(i, o) {
        var head = o.nScrollHead ? $("table", o.nScrollHead)[0] : null;
        var foot = o.nScrollFoot ? $("table", o.nScrollFoot)[0] : null;
        if (o.nTable === t || head === t || foot === t) {
          is = true;
        }
      });
      return is;
    };
    DataTable.tables = DataTable.fnTables = function(visible) {
      var api = false;
      if ($.isPlainObject(visible)) {
        api = visible.api;
        visible = visible.visible;
      }
      var a = $.map(DataTable.settings, function(o) {
        if (!visible || visible && $(o.nTable).is(":visible")) {
          return o.nTable;
        }
      });
      return api ? new _Api(a) : a;
    };
    DataTable.camelToHungarian = _fnCamelToHungarian;
    _api_register("$()", function(selector, opts) {
      var rows = this.rows(opts).nodes(), jqRows = $(rows);
      return $([].concat(
        jqRows.filter(selector).toArray(),
        jqRows.find(selector).toArray()
      ));
    });
    $.each(["on", "one", "off"], function(i, key) {
      _api_register(key + "()", function() {
        var args = Array.prototype.slice.call(arguments);
        args[0] = $.map(args[0].split(/\s/), function(e) {
          return !e.match(/\.dt\b/) ? e + ".dt" : e;
        }).join(" ");
        var inst = $(this.tables().nodes());
        inst[key].apply(inst, args);
        return this;
      });
    });
    _api_register("clear()", function() {
      return this.iterator("table", function(settings) {
        _fnClearTable(settings);
      });
    });
    _api_register("settings()", function() {
      return new _Api(this.context, this.context);
    });
    _api_register("init()", function() {
      var ctx = this.context;
      return ctx.length ? ctx[0].oInit : null;
    });
    _api_register("data()", function() {
      return this.iterator("table", function(settings) {
        return _pluck(settings.aoData, "_aData");
      }).flatten();
    });
    _api_register("destroy()", function(remove) {
      remove = remove || false;
      return this.iterator("table", function(settings) {
        var classes = settings.oClasses;
        var table = settings.nTable;
        var tbody = settings.nTBody;
        var thead = settings.nTHead;
        var tfoot = settings.nTFoot;
        var jqTable = $(table);
        var jqTbody = $(tbody);
        var jqWrapper = $(settings.nTableWrapper);
        var rows = $.map(settings.aoData, function(r) {
          return r.nTr;
        });
        var i, ien;
        settings.bDestroying = true;
        _fnCallbackFire(settings, "aoDestroyCallback", "destroy", [settings]);
        if (!remove) {
          new _Api(settings).columns().visible(true);
        }
        jqWrapper.off(".DT").find(":not(tbody *)").off(".DT");
        $(window).off(".DT-" + settings.sInstance);
        if (table != thead.parentNode) {
          jqTable.children("thead").detach();
          jqTable.append(thead);
        }
        if (tfoot && table != tfoot.parentNode) {
          jqTable.children("tfoot").detach();
          jqTable.append(tfoot);
        }
        settings.aaSorting = [];
        settings.aaSortingFixed = [];
        _fnSortingClasses(settings);
        $(rows).removeClass(settings.asStripeClasses.join(" "));
        $("th, td", thead).removeClass(
          classes.sSortable + " " + classes.sSortableAsc + " " + classes.sSortableDesc + " " + classes.sSortableNone
        );
        jqTbody.children().detach();
        jqTbody.append(rows);
        var orig = settings.nTableWrapper.parentNode;
        var removedMethod = remove ? "remove" : "detach";
        jqTable[removedMethod]();
        jqWrapper[removedMethod]();
        if (!remove && orig) {
          orig.insertBefore(table, settings.nTableReinsertBefore);
          jqTable.css("width", settings.sDestroyWidth).removeClass(classes.sTable);
          ien = settings.asDestroyStripes.length;
          if (ien) {
            jqTbody.children().each(function(i2) {
              $(this).addClass(settings.asDestroyStripes[i2 % ien]);
            });
          }
        }
        var idx = $.inArray(settings, DataTable.settings);
        if (idx !== -1) {
          DataTable.settings.splice(idx, 1);
        }
      });
    });
    $.each(["column", "row", "cell"], function(i, type) {
      _api_register(type + "s().every()", function(fn) {
        var opts = this.selector.opts;
        var api = this;
        return this.iterator(type, function(settings, arg1, arg2, arg3, arg4) {
          fn.call(
            api[type](
              arg1,
              type === "cell" ? arg2 : opts,
              type === "cell" ? opts : void 0
            ),
            arg1,
            arg2,
            arg3,
            arg4
          );
        });
      });
    });
    _api_register("i18n()", function(token, def, plural) {
      var ctx = this.context[0];
      var resolved = _fnGetObjectDataFn(token)(ctx.oLanguage);
      if (resolved === void 0) {
        resolved = def;
      }
      if (plural !== void 0 && $.isPlainObject(resolved)) {
        resolved = resolved[plural] !== void 0 ? resolved[plural] : resolved._;
      }
      return typeof resolved === "string" ? resolved.replace("%d", plural) : resolved;
    });
    DataTable.version = "1.13.11";
    DataTable.settings = [];
    DataTable.models = {};
    DataTable.models.oSearch = {
      /**
       * Flag to indicate if the filtering should be case insensitive or not
       *  @type boolean
       *  @default true
       */
      "bCaseInsensitive": true,
      /**
       * Applied search term
       *  @type string
       *  @default <i>Empty string</i>
       */
      "sSearch": "",
      /**
       * Flag to indicate if the search term should be interpreted as a
       * regular expression (true) or not (false) and therefore and special
       * regex characters escaped.
       *  @type boolean
       *  @default false
       */
      "bRegex": false,
      /**
       * Flag to indicate if DataTables is to use its smart filtering or not.
       *  @type boolean
       *  @default true
       */
      "bSmart": true,
      /**
       * Flag to indicate if DataTables should only trigger a search when
       * the return key is pressed.
       *  @type boolean
       *  @default false
       */
      "return": false
    };
    DataTable.models.oRow = {
      /**
       * TR element for the row
       *  @type node
       *  @default null
       */
      "nTr": null,
      /**
       * Array of TD elements for each row. This is null until the row has been
       * created.
       *  @type array nodes
       *  @default []
       */
      "anCells": null,
      /**
       * Data object from the original data source for the row. This is either
       * an array if using the traditional form of DataTables, or an object if
       * using mData options. The exact type will depend on the passed in
       * data from the data source, or will be an array if using DOM a data
       * source.
       *  @type array|object
       *  @default []
       */
      "_aData": [],
      /**
       * Sorting data cache - this array is ostensibly the same length as the
       * number of columns (although each index is generated only as it is
       * needed), and holds the data that is used for sorting each column in the
       * row. We do this cache generation at the start of the sort in order that
       * the formatting of the sort data need be done only once for each cell
       * per sort. This array should not be read from or written to by anything
       * other than the master sorting methods.
       *  @type array
       *  @default null
       *  @private
       */
      "_aSortData": null,
      /**
       * Per cell filtering data cache. As per the sort data cache, used to
       * increase the performance of the filtering in DataTables
       *  @type array
       *  @default null
       *  @private
       */
      "_aFilterData": null,
      /**
       * Filtering data cache. This is the same as the cell filtering cache, but
       * in this case a string rather than an array. This is easily computed with
       * a join on `_aFilterData`, but is provided as a cache so the join isn't
       * needed on every search (memory traded for performance)
       *  @type array
       *  @default null
       *  @private
       */
      "_sFilterRow": null,
      /**
       * Cache of the class name that DataTables has applied to the row, so we
       * can quickly look at this variable rather than needing to do a DOM check
       * on className for the nTr property.
       *  @type string
       *  @default <i>Empty string</i>
       *  @private
       */
      "_sRowStripe": "",
      /**
       * Denote if the original data source was from the DOM, or the data source
       * object. This is used for invalidating data, so DataTables can
       * automatically read data from the original source, unless uninstructed
       * otherwise.
       *  @type string
       *  @default null
       *  @private
       */
      "src": null,
      /**
       * Index in the aoData array. This saves an indexOf lookup when we have the
       * object, but want to know the index
       *  @type integer
       *  @default -1
       *  @private
       */
      "idx": -1
    };
    DataTable.models.oColumn = {
      /**
       * Column index. This could be worked out on-the-fly with $.inArray, but it
       * is faster to just hold it as a variable
       *  @type integer
       *  @default null
       */
      "idx": null,
      /**
       * A list of the columns that sorting should occur on when this column
       * is sorted. That this property is an array allows multi-column sorting
       * to be defined for a column (for example first name / last name columns
       * would benefit from this). The values are integers pointing to the
       * columns to be sorted on (typically it will be a single integer pointing
       * at itself, but that doesn't need to be the case).
       *  @type array
       */
      "aDataSort": null,
      /**
       * Define the sorting directions that are applied to the column, in sequence
       * as the column is repeatedly sorted upon - i.e. the first value is used
       * as the sorting direction when the column if first sorted (clicked on).
       * Sort it again (click again) and it will move on to the next index.
       * Repeat until loop.
       *  @type array
       */
      "asSorting": null,
      /**
       * Flag to indicate if the column is searchable, and thus should be included
       * in the filtering or not.
       *  @type boolean
       */
      "bSearchable": null,
      /**
       * Flag to indicate if the column is sortable or not.
       *  @type boolean
       */
      "bSortable": null,
      /**
       * Flag to indicate if the column is currently visible in the table or not
       *  @type boolean
       */
      "bVisible": null,
      /**
       * Store for manual type assignment using the `column.type` option. This
       * is held in store so we can manipulate the column's `sType` property.
       *  @type string
       *  @default null
       *  @private
       */
      "_sManualType": null,
      /**
       * Flag to indicate if HTML5 data attributes should be used as the data
       * source for filtering or sorting. True is either are.
       *  @type boolean
       *  @default false
       *  @private
       */
      "_bAttrSrc": false,
      /**
       * Developer definable function that is called whenever a cell is created (Ajax source,
       * etc) or processed for input (DOM source). This can be used as a compliment to mRender
       * allowing you to modify the DOM element (add background colour for example) when the
       * element is available.
       *  @type function
       *  @param {element} nTd The TD node that has been created
       *  @param {*} sData The Data for the cell
       *  @param {array|object} oData The data for the whole row
       *  @param {int} iRow The row index for the aoData data store
       *  @default null
       */
      "fnCreatedCell": null,
      /**
       * Function to get data from a cell in a column. You should <b>never</b>
       * access data directly through _aData internally in DataTables - always use
       * the method attached to this property. It allows mData to function as
       * required. This function is automatically assigned by the column
       * initialisation method
       *  @type function
       *  @param {array|object} oData The data array/object for the array
       *    (i.e. aoData[]._aData)
       *  @param {string} sSpecific The specific data type you want to get -
       *    'display', 'type' 'filter' 'sort'
       *  @returns {*} The data for the cell from the given row's data
       *  @default null
       */
      "fnGetData": null,
      /**
       * Function to set data for a cell in the column. You should <b>never</b>
       * set the data directly to _aData internally in DataTables - always use
       * this method. It allows mData to function as required. This function
       * is automatically assigned by the column initialisation method
       *  @type function
       *  @param {array|object} oData The data array/object for the array
       *    (i.e. aoData[]._aData)
       *  @param {*} sValue Value to set
       *  @default null
       */
      "fnSetData": null,
      /**
       * Property to read the value for the cells in the column from the data
       * source array / object. If null, then the default content is used, if a
       * function is given then the return from the function is used.
       *  @type function|int|string|null
       *  @default null
       */
      "mData": null,
      /**
       * Partner property to mData which is used (only when defined) to get
       * the data - i.e. it is basically the same as mData, but without the
       * 'set' option, and also the data fed to it is the result from mData.
       * This is the rendering method to match the data method of mData.
       *  @type function|int|string|null
       *  @default null
       */
      "mRender": null,
      /**
       * Unique header TH/TD element for this column - this is what the sorting
       * listener is attached to (if sorting is enabled.)
       *  @type node
       *  @default null
       */
      "nTh": null,
      /**
       * Unique footer TH/TD element for this column (if there is one). Not used
       * in DataTables as such, but can be used for plug-ins to reference the
       * footer for each column.
       *  @type node
       *  @default null
       */
      "nTf": null,
      /**
       * The class to apply to all TD elements in the table's TBODY for the column
       *  @type string
       *  @default null
       */
      "sClass": null,
      /**
       * When DataTables calculates the column widths to assign to each column,
       * it finds the longest string in each column and then constructs a
       * temporary table and reads the widths from that. The problem with this
       * is that "mmm" is much wider then "iiii", but the latter is a longer
       * string - thus the calculation can go wrong (doing it properly and putting
       * it into an DOM object and measuring that is horribly(!) slow). Thus as
       * a "work around" we provide this option. It will append its value to the
       * text that is found to be the longest string for the column - i.e. padding.
       *  @type string
       */
      "sContentPadding": null,
      /**
       * Allows a default value to be given for a column's data, and will be used
       * whenever a null data source is encountered (this can be because mData
       * is set to null, or because the data source itself is null).
       *  @type string
       *  @default null
       */
      "sDefaultContent": null,
      /**
       * Name for the column, allowing reference to the column by name as well as
       * by index (needs a lookup to work by name).
       *  @type string
       */
      "sName": null,
      /**
       * Custom sorting data type - defines which of the available plug-ins in
       * afnSortData the custom sorting will use - if any is defined.
       *  @type string
       *  @default std
       */
      "sSortDataType": "std",
      /**
       * Class to be applied to the header element when sorting on this column
       *  @type string
       *  @default null
       */
      "sSortingClass": null,
      /**
       * Class to be applied to the header element when sorting on this column -
       * when jQuery UI theming is used.
       *  @type string
       *  @default null
       */
      "sSortingClassJUI": null,
      /**
       * Title of the column - what is seen in the TH element (nTh).
       *  @type string
       */
      "sTitle": null,
      /**
       * Column sorting and filtering type
       *  @type string
       *  @default null
       */
      "sType": null,
      /**
       * Width of the column
       *  @type string
       *  @default null
       */
      "sWidth": null,
      /**
       * Width of the column when it was first "encountered"
       *  @type string
       *  @default null
       */
      "sWidthOrig": null
    };
    DataTable.defaults = {
      /**
       * An array of data to use for the table, passed in at initialisation which
       * will be used in preference to any data which is already in the DOM. This is
       * particularly useful for constructing tables purely in Javascript, for
       * example with a custom Ajax call.
       *  @type array
       *  @default null
       *
       *  @dtopt Option
       *  @name DataTable.defaults.data
       *
       *  @example
       *    // Using a 2D array data source
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "data": [
       *          ['Trident', 'Internet Explorer 4.0', 'Win 95+', 4, 'X'],
       *          ['Trident', 'Internet Explorer 5.0', 'Win 95+', 5, 'C'],
       *        ],
       *        "columns": [
       *          { "title": "Engine" },
       *          { "title": "Browser" },
       *          { "title": "Platform" },
       *          { "title": "Version" },
       *          { "title": "Grade" }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using an array of objects as a data source (`data`)
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "data": [
       *          {
       *            "engine":   "Trident",
       *            "browser":  "Internet Explorer 4.0",
       *            "platform": "Win 95+",
       *            "version":  4,
       *            "grade":    "X"
       *          },
       *          {
       *            "engine":   "Trident",
       *            "browser":  "Internet Explorer 5.0",
       *            "platform": "Win 95+",
       *            "version":  5,
       *            "grade":    "C"
       *          }
       *        ],
       *        "columns": [
       *          { "title": "Engine",   "data": "engine" },
       *          { "title": "Browser",  "data": "browser" },
       *          { "title": "Platform", "data": "platform" },
       *          { "title": "Version",  "data": "version" },
       *          { "title": "Grade",    "data": "grade" }
       *        ]
       *      } );
       *    } );
       */
      "aaData": null,
      /**
       * If ordering is enabled, then DataTables will perform a first pass sort on
       * initialisation. You can define which column(s) the sort is performed
       * upon, and the sorting direction, with this variable. The `sorting` array
       * should contain an array for each column to be sorted initially containing
       * the column's index and a direction string ('asc' or 'desc').
       *  @type array
       *  @default [[0,'asc']]
       *
       *  @dtopt Option
       *  @name DataTable.defaults.order
       *
       *  @example
       *    // Sort by 3rd column first, and then 4th column
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "order": [[2,'asc'], [3,'desc']]
       *      } );
       *    } );
       *
       *    // No initial sorting
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "order": []
       *      } );
       *    } );
       */
      "aaSorting": [[0, "asc"]],
      /**
       * This parameter is basically identical to the `sorting` parameter, but
       * cannot be overridden by user interaction with the table. What this means
       * is that you could have a column (visible or hidden) which the sorting
       * will always be forced on first - any sorting after that (from the user)
       * will then be performed as required. This can be useful for grouping rows
       * together.
       *  @type array
       *  @default null
       *
       *  @dtopt Option
       *  @name DataTable.defaults.orderFixed
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "orderFixed": [[0,'asc']]
       *      } );
       *    } )
       */
      "aaSortingFixed": [],
      /**
       * DataTables can be instructed to load data to display in the table from a
       * Ajax source. This option defines how that Ajax call is made and where to.
       *
       * The `ajax` property has three different modes of operation, depending on
       * how it is defined. These are:
       *
       * * `string` - Set the URL from where the data should be loaded from.
       * * `object` - Define properties for `jQuery.ajax`.
       * * `function` - Custom data get function
       *
       * `string`
       * --------
       *
       * As a string, the `ajax` property simply defines the URL from which
       * DataTables will load data.
       *
       * `object`
       * --------
       *
       * As an object, the parameters in the object are passed to
       * [jQuery.ajax](https://api.jquery.com/jQuery.ajax/) allowing fine control
       * of the Ajax request. DataTables has a number of default parameters which
       * you can override using this option. Please refer to the jQuery
       * documentation for a full description of the options available, although
       * the following parameters provide additional options in DataTables or
       * require special consideration:
       *
       * * `data` - As with jQuery, `data` can be provided as an object, but it
       *   can also be used as a function to manipulate the data DataTables sends
       *   to the server. The function takes a single parameter, an object of
       *   parameters with the values that DataTables has readied for sending. An
       *   object may be returned which will be merged into the DataTables
       *   defaults, or you can add the items to the object that was passed in and
       *   not return anything from the function. This supersedes `fnServerParams`
       *   from DataTables 1.9-.
       *
       * * `dataSrc` - By default DataTables will look for the property `data` (or
       *   `aaData` for compatibility with DataTables 1.9-) when obtaining data
       *   from an Ajax source or for server-side processing - this parameter
       *   allows that property to be changed. You can use Javascript dotted
       *   object notation to get a data source for multiple levels of nesting, or
       *   it my be used as a function. As a function it takes a single parameter,
       *   the JSON returned from the server, which can be manipulated as
       *   required, with the returned value being that used by DataTables as the
       *   data source for the table. This supersedes `sAjaxDataProp` from
       *   DataTables 1.9-.
       *
       * * `success` - Should not be overridden it is used internally in
       *   DataTables. To manipulate / transform the data returned by the server
       *   use `ajax.dataSrc`, or use `ajax` as a function (see below).
       *
       * `function`
       * ----------
       *
       * As a function, making the Ajax call is left up to yourself allowing
       * complete control of the Ajax request. Indeed, if desired, a method other
       * than Ajax could be used to obtain the required data, such as Web storage
       * or an AIR database.
       *
       * The function is given four parameters and no return is required. The
       * parameters are:
       *
       * 1. _object_ - Data to send to the server
       * 2. _function_ - Callback function that must be executed when the required
       *    data has been obtained. That data should be passed into the callback
       *    as the only parameter
       * 3. _object_ - DataTables settings object for the table
       *
       * Note that this supersedes `fnServerData` from DataTables 1.9-.
       *
       *  @type string|object|function
       *  @default null
       *
       *  @dtopt Option
       *  @name DataTable.defaults.ajax
       *  @since 1.10.0
       *
       * @example
       *   // Get JSON data from a file via Ajax.
       *   // Note DataTables expects data in the form `{ data: [ ...data... ] }` by default).
       *   $('#example').dataTable( {
       *     "ajax": "data.json"
       *   } );
       *
       * @example
       *   // Get JSON data from a file via Ajax, using `dataSrc` to change
       *   // `data` to `tableData` (i.e. `{ tableData: [ ...data... ] }`)
       *   $('#example').dataTable( {
       *     "ajax": {
       *       "url": "data.json",
       *       "dataSrc": "tableData"
       *     }
       *   } );
       *
       * @example
       *   // Get JSON data from a file via Ajax, using `dataSrc` to read data
       *   // from a plain array rather than an array in an object
       *   $('#example').dataTable( {
       *     "ajax": {
       *       "url": "data.json",
       *       "dataSrc": ""
       *     }
       *   } );
       *
       * @example
       *   // Manipulate the data returned from the server - add a link to data
       *   // (note this can, should, be done using `render` for the column - this
       *   // is just a simple example of how the data can be manipulated).
       *   $('#example').dataTable( {
       *     "ajax": {
       *       "url": "data.json",
       *       "dataSrc": function ( json ) {
       *         for ( var i=0, ien=json.length ; i<ien ; i++ ) {
       *           json[i][0] = '<a href="/message/'+json[i][0]+'>View message</a>';
       *         }
       *         return json;
       *       }
       *     }
       *   } );
       *
       * @example
       *   // Add data to the request
       *   $('#example').dataTable( {
       *     "ajax": {
       *       "url": "data.json",
       *       "data": function ( d ) {
       *         return {
       *           "extra_search": $('#extra').val()
       *         };
       *       }
       *     }
       *   } );
       *
       * @example
       *   // Send request as POST
       *   $('#example').dataTable( {
       *     "ajax": {
       *       "url": "data.json",
       *       "type": "POST"
       *     }
       *   } );
       *
       * @example
       *   // Get the data from localStorage (could interface with a form for
       *   // adding, editing and removing rows).
       *   $('#example').dataTable( {
       *     "ajax": function (data, callback, settings) {
       *       callback(
       *         JSON.parse( localStorage.getItem('dataTablesData') )
       *       );
       *     }
       *   } );
       */
      "ajax": null,
      /**
       * This parameter allows you to readily specify the entries in the length drop
       * down menu that DataTables shows when pagination is enabled. It can be
       * either a 1D array of options which will be used for both the displayed
       * option and the value, or a 2D array which will use the array in the first
       * position as the value, and the array in the second position as the
       * displayed options (useful for language strings such as 'All').
       *
       * Note that the `pageLength` property will be automatically set to the
       * first value given in this array, unless `pageLength` is also provided.
       *  @type array
       *  @default [ 10, 25, 50, 100 ]
       *
       *  @dtopt Option
       *  @name DataTable.defaults.lengthMenu
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
       *      } );
       *    } );
       */
      "aLengthMenu": [10, 25, 50, 100],
      /**
       * The `columns` option in the initialisation parameter allows you to define
       * details about the way individual columns behave. For a full list of
       * column options that can be set, please see
       * {@link DataTable.defaults.column}. Note that if you use `columns` to
       * define your columns, you must have an entry in the array for every single
       * column that you have in your table (these can be null if you don't which
       * to specify any options).
       *  @member
       *
       *  @name DataTable.defaults.column
       */
      "aoColumns": null,
      /**
       * Very similar to `columns`, `columnDefs` allows you to target a specific
       * column, multiple columns, or all columns, using the `targets` property of
       * each object in the array. This allows great flexibility when creating
       * tables, as the `columnDefs` arrays can be of any length, targeting the
       * columns you specifically want. `columnDefs` may use any of the column
       * options available: {@link DataTable.defaults.column}, but it _must_
       * have `targets` defined in each object in the array. Values in the `targets`
       * array may be:
       *   <ul>
       *     <li>a string - class name will be matched on the TH for the column</li>
       *     <li>0 or a positive integer - column index counting from the left</li>
       *     <li>a negative integer - column index counting from the right</li>
       *     <li>the string "_all" - all columns (i.e. assign a default)</li>
       *   </ul>
       *  @member
       *
       *  @name DataTable.defaults.columnDefs
       */
      "aoColumnDefs": null,
      /**
       * Basically the same as `search`, this parameter defines the individual column
       * filtering state at initialisation time. The array must be of the same size
       * as the number of columns, and each element be an object with the parameters
       * `search` and `escapeRegex` (the latter is optional). 'null' is also
       * accepted and the default will be used.
       *  @type array
       *  @default []
       *
       *  @dtopt Option
       *  @name DataTable.defaults.searchCols
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "searchCols": [
       *          null,
       *          { "search": "My filter" },
       *          null,
       *          { "search": "^[0-9]", "escapeRegex": false }
       *        ]
       *      } );
       *    } )
       */
      "aoSearchCols": [],
      /**
       * An array of CSS classes that should be applied to displayed rows. This
       * array may be of any length, and DataTables will apply each class
       * sequentially, looping when required.
       *  @type array
       *  @default null <i>Will take the values determined by the `oClasses.stripe*`
       *    options</i>
       *
       *  @dtopt Option
       *  @name DataTable.defaults.stripeClasses
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stripeClasses": [ 'strip1', 'strip2', 'strip3' ]
       *      } );
       *    } )
       */
      "asStripeClasses": null,
      /**
       * Enable or disable automatic column width calculation. This can be disabled
       * as an optimisation (it takes some time to calculate the widths) if the
       * tables widths are passed in using `columns`.
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.autoWidth
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "autoWidth": false
       *      } );
       *    } );
       */
      "bAutoWidth": true,
      /**
       * Deferred rendering can provide DataTables with a huge speed boost when you
       * are using an Ajax or JS data source for the table. This option, when set to
       * true, will cause DataTables to defer the creation of the table elements for
       * each row until they are needed for a draw - saving a significant amount of
       * time.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Features
       *  @name DataTable.defaults.deferRender
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "ajax": "sources/arrays.txt",
       *        "deferRender": true
       *      } );
       *    } );
       */
      "bDeferRender": false,
      /**
       * Replace a DataTable which matches the given selector and replace it with
       * one which has the properties of the new initialisation object passed. If no
       * table matches the selector, then the new DataTable will be constructed as
       * per normal.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Options
       *  @name DataTable.defaults.destroy
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "srollY": "200px",
       *        "paginate": false
       *      } );
       *
       *      // Some time later....
       *      $('#example').dataTable( {
       *        "filter": false,
       *        "destroy": true
       *      } );
       *    } );
       */
      "bDestroy": false,
      /**
       * Enable or disable filtering of data. Filtering in DataTables is "smart" in
       * that it allows the end user to input multiple words (space separated) and
       * will match a row containing those words, even if not in the order that was
       * specified (this allow matching across multiple columns). Note that if you
       * wish to use filtering in DataTables this must remain 'true' - to remove the
       * default filtering input box and retain filtering abilities, please use
       * {@link DataTable.defaults.dom}.
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.searching
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "searching": false
       *      } );
       *    } );
       */
      "bFilter": true,
      /**
       * Enable or disable the table information display. This shows information
       * about the data that is currently visible on the page, including information
       * about filtered data if that action is being performed.
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.info
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "info": false
       *      } );
       *    } );
       */
      "bInfo": true,
      /**
       * Allows the end user to select the size of a formatted page from a select
       * menu (sizes are 10, 25, 50 and 100). Requires pagination (`paginate`).
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.lengthChange
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "lengthChange": false
       *      } );
       *    } );
       */
      "bLengthChange": true,
      /**
       * Enable or disable pagination.
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.paging
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "paging": false
       *      } );
       *    } );
       */
      "bPaginate": true,
      /**
       * Enable or disable the display of a 'processing' indicator when the table is
       * being processed (e.g. a sort). This is particularly useful for tables with
       * large amounts of data where it can take a noticeable amount of time to sort
       * the entries.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Features
       *  @name DataTable.defaults.processing
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "processing": true
       *      } );
       *    } );
       */
      "bProcessing": false,
      /**
       * Retrieve the DataTables object for the given selector. Note that if the
       * table has already been initialised, this parameter will cause DataTables
       * to simply return the object that has already been set up - it will not take
       * account of any changes you might have made to the initialisation object
       * passed to DataTables (setting this parameter to true is an acknowledgement
       * that you understand this). `destroy` can be used to reinitialise a table if
       * you need.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Options
       *  @name DataTable.defaults.retrieve
       *
       *  @example
       *    $(document).ready( function() {
       *      initTable();
       *      tableActions();
       *    } );
       *
       *    function initTable ()
       *    {
       *      return $('#example').dataTable( {
       *        "scrollY": "200px",
       *        "paginate": false,
       *        "retrieve": true
       *      } );
       *    }
       *
       *    function tableActions ()
       *    {
       *      var table = initTable();
       *      // perform API operations with oTable
       *    }
       */
      "bRetrieve": false,
      /**
       * When vertical (y) scrolling is enabled, DataTables will force the height of
       * the table's viewport to the given height at all times (useful for layout).
       * However, this can look odd when filtering data down to a small data set,
       * and the footer is left "floating" further down. This parameter (when
       * enabled) will cause DataTables to collapse the table's viewport down when
       * the result set will fit within the given Y height.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Options
       *  @name DataTable.defaults.scrollCollapse
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "scrollY": "200",
       *        "scrollCollapse": true
       *      } );
       *    } );
       */
      "bScrollCollapse": false,
      /**
       * Configure DataTables to use server-side processing. Note that the
       * `ajax` parameter must also be given in order to give DataTables a
       * source to obtain the required data for each draw.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Features
       *  @dtopt Server-side
       *  @name DataTable.defaults.serverSide
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "serverSide": true,
       *        "ajax": "xhr.php"
       *      } );
       *    } );
       */
      "bServerSide": false,
      /**
       * Enable or disable sorting of columns. Sorting of individual columns can be
       * disabled by the `sortable` option for each column.
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.ordering
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "ordering": false
       *      } );
       *    } );
       */
      "bSort": true,
      /**
       * Enable or display DataTables' ability to sort multiple columns at the
       * same time (activated by shift-click by the user).
       *  @type boolean
       *  @default true
       *
       *  @dtopt Options
       *  @name DataTable.defaults.orderMulti
       *
       *  @example
       *    // Disable multiple column sorting ability
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "orderMulti": false
       *      } );
       *    } );
       */
      "bSortMulti": true,
      /**
       * Allows control over whether DataTables should use the top (true) unique
       * cell that is found for a single column, or the bottom (false - default).
       * This is useful when using complex headers.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Options
       *  @name DataTable.defaults.orderCellsTop
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "orderCellsTop": true
       *      } );
       *    } );
       */
      "bSortCellsTop": false,
      /**
       * Enable or disable the addition of the classes `sorting\_1`, `sorting\_2` and
       * `sorting\_3` to the columns which are currently being sorted on. This is
       * presented as a feature switch as it can increase processing time (while
       * classes are removed and added) so for large data sets you might want to
       * turn this off.
       *  @type boolean
       *  @default true
       *
       *  @dtopt Features
       *  @name DataTable.defaults.orderClasses
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "orderClasses": false
       *      } );
       *    } );
       */
      "bSortClasses": true,
      /**
       * Enable or disable state saving. When enabled HTML5 `localStorage` will be
       * used to save table display information such as pagination information,
       * display length, filtering and sorting. As such when the end user reloads
       * the page the display display will match what thy had previously set up.
       *
       * Due to the use of `localStorage` the default state saving is not supported
       * in IE6 or 7. If state saving is required in those browsers, use
       * `stateSaveCallback` to provide a storage solution such as cookies.
       *  @type boolean
       *  @default false
       *
       *  @dtopt Features
       *  @name DataTable.defaults.stateSave
       *
       *  @example
       *    $(document).ready( function () {
       *      $('#example').dataTable( {
       *        "stateSave": true
       *      } );
       *    } );
       */
      "bStateSave": false,
      /**
       * This function is called when a TR element is created (and all TD child
       * elements have been inserted), or registered if using a DOM source, allowing
       * manipulation of the TR element (adding classes etc).
       *  @type function
       *  @param {node} row "TR" element for the current row
       *  @param {array} data Raw data array for this row
       *  @param {int} dataIndex The index of this row in the internal aoData array
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.createdRow
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "createdRow": function( row, data, dataIndex ) {
       *          // Bold the grade for all 'A' grade browsers
       *          if ( data[4] == "A" )
       *          {
       *            $('td:eq(4)', row).html( '<b>A</b>' );
       *          }
       *        }
       *      } );
       *    } );
       */
      "fnCreatedRow": null,
      /**
       * This function is called on every 'draw' event, and allows you to
       * dynamically modify any aspect you want about the created DOM.
       *  @type function
       *  @param {object} settings DataTables settings object
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.drawCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "drawCallback": function( settings ) {
       *          alert( 'DataTables has redrawn the table' );
       *        }
       *      } );
       *    } );
       */
      "fnDrawCallback": null,
      /**
       * Identical to fnHeaderCallback() but for the table footer this function
       * allows you to modify the table footer on every 'draw' event.
       *  @type function
       *  @param {node} foot "TR" element for the footer
       *  @param {array} data Full table data (as derived from the original HTML)
       *  @param {int} start Index for the current display starting point in the
       *    display array
       *  @param {int} end Index for the current display ending point in the
       *    display array
       *  @param {array int} display Index array to translate the visual position
       *    to the full data array
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.footerCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "footerCallback": function( tfoot, data, start, end, display ) {
       *          tfoot.getElementsByTagName('th')[0].innerHTML = "Starting index is "+start;
       *        }
       *      } );
       *    } )
       */
      "fnFooterCallback": null,
      /**
       * When rendering large numbers in the information element for the table
       * (i.e. "Showing 1 to 10 of 57 entries") DataTables will render large numbers
       * to have a comma separator for the 'thousands' units (e.g. 1 million is
       * rendered as "1,000,000") to help readability for the end user. This
       * function will override the default method DataTables uses.
       *  @type function
       *  @member
       *  @param {int} toFormat number to be formatted
       *  @returns {string} formatted string for DataTables to show the number
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.formatNumber
       *
       *  @example
       *    // Format a number using a single quote for the separator (note that
       *    // this can also be done with the language.thousands option)
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "formatNumber": function ( toFormat ) {
       *          return toFormat.toString().replace(
       *            /\B(?=(\d{3})+(?!\d))/g, "'"
       *          );
       *        };
       *      } );
       *    } );
       */
      "fnFormatNumber": function(toFormat) {
        return toFormat.toString().replace(
          /\B(?=(\d{3})+(?!\d))/g,
          this.oLanguage.sThousands
        );
      },
      /**
       * This function is called on every 'draw' event, and allows you to
       * dynamically modify the header row. This can be used to calculate and
       * display useful information about the table.
       *  @type function
       *  @param {node} head "TR" element for the header
       *  @param {array} data Full table data (as derived from the original HTML)
       *  @param {int} start Index for the current display starting point in the
       *    display array
       *  @param {int} end Index for the current display ending point in the
       *    display array
       *  @param {array int} display Index array to translate the visual position
       *    to the full data array
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.headerCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "fheaderCallback": function( head, data, start, end, display ) {
       *          head.getElementsByTagName('th')[0].innerHTML = "Displaying "+(end-start)+" records";
       *        }
       *      } );
       *    } )
       */
      "fnHeaderCallback": null,
      /**
       * The information element can be used to convey information about the current
       * state of the table. Although the internationalisation options presented by
       * DataTables are quite capable of dealing with most customisations, there may
       * be times where you wish to customise the string further. This callback
       * allows you to do exactly that.
       *  @type function
       *  @param {object} oSettings DataTables settings object
       *  @param {int} start Starting position in data for the draw
       *  @param {int} end End position in data for the draw
       *  @param {int} max Total number of rows in the table (regardless of
       *    filtering)
       *  @param {int} total Total number of rows in the data set, after filtering
       *  @param {string} pre The string that DataTables has formatted using it's
       *    own rules
       *  @returns {string} The string to be displayed in the information element.
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.infoCallback
       *
       *  @example
       *    $('#example').dataTable( {
       *      "infoCallback": function( settings, start, end, max, total, pre ) {
       *        return start +" to "+ end;
       *      }
       *    } );
       */
      "fnInfoCallback": null,
      /**
       * Called when the table has been initialised. Normally DataTables will
       * initialise sequentially and there will be no need for this function,
       * however, this does not hold true when using external language information
       * since that is obtained using an async XHR call.
       *  @type function
       *  @param {object} settings DataTables settings object
       *  @param {object} json The JSON object request from the server - only
       *    present if client-side Ajax sourced data is used
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.initComplete
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "initComplete": function(settings, json) {
       *          alert( 'DataTables has finished its initialisation.' );
       *        }
       *      } );
       *    } )
       */
      "fnInitComplete": null,
      /**
       * Called at the very start of each table draw and can be used to cancel the
       * draw by returning false, any other return (including undefined) results in
       * the full draw occurring).
       *  @type function
       *  @param {object} settings DataTables settings object
       *  @returns {boolean} False will cancel the draw, anything else (including no
       *    return) will allow it to complete.
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.preDrawCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "preDrawCallback": function( settings ) {
       *          if ( $('#test').val() == 1 ) {
       *            return false;
       *          }
       *        }
       *      } );
       *    } );
       */
      "fnPreDrawCallback": null,
      /**
       * This function allows you to 'post process' each row after it have been
       * generated for each table draw, but before it is rendered on screen. This
       * function might be used for setting the row class name etc.
       *  @type function
       *  @param {node} row "TR" element for the current row
       *  @param {array} data Raw data array for this row
       *  @param {int} displayIndex The display index for the current table draw
       *  @param {int} displayIndexFull The index of the data in the full list of
       *    rows (after filtering)
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.rowCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "rowCallback": function( row, data, displayIndex, displayIndexFull ) {
       *          // Bold the grade for all 'A' grade browsers
       *          if ( data[4] == "A" ) {
       *            $('td:eq(4)', row).html( '<b>A</b>' );
       *          }
       *        }
       *      } );
       *    } );
       */
      "fnRowCallback": null,
      /**
       * __Deprecated__ The functionality provided by this parameter has now been
       * superseded by that provided through `ajax`, which should be used instead.
       *
       * This parameter allows you to override the default function which obtains
       * the data from the server so something more suitable for your application.
       * For example you could use POST data, or pull information from a Gears or
       * AIR database.
       *  @type function
       *  @member
       *  @param {string} source HTTP source to obtain the data from (`ajax`)
       *  @param {array} data A key/value pair object containing the data to send
       *    to the server
       *  @param {function} callback to be called on completion of the data get
       *    process that will draw the data on the page.
       *  @param {object} settings DataTables settings object
       *
       *  @dtopt Callbacks
       *  @dtopt Server-side
       *  @name DataTable.defaults.serverData
       *
       *  @deprecated 1.10. Please use `ajax` for this functionality now.
       */
      "fnServerData": null,
      /**
       * __Deprecated__ The functionality provided by this parameter has now been
       * superseded by that provided through `ajax`, which should be used instead.
       *
       *  It is often useful to send extra data to the server when making an Ajax
       * request - for example custom filtering information, and this callback
       * function makes it trivial to send extra information to the server. The
       * passed in parameter is the data set that has been constructed by
       * DataTables, and you can add to this or modify it as you require.
       *  @type function
       *  @param {array} data Data array (array of objects which are name/value
       *    pairs) that has been constructed by DataTables and will be sent to the
       *    server. In the case of Ajax sourced data with server-side processing
       *    this will be an empty array, for server-side processing there will be a
       *    significant number of parameters!
       *  @returns {undefined} Ensure that you modify the data array passed in,
       *    as this is passed by reference.
       *
       *  @dtopt Callbacks
       *  @dtopt Server-side
       *  @name DataTable.defaults.serverParams
       *
       *  @deprecated 1.10. Please use `ajax` for this functionality now.
       */
      "fnServerParams": null,
      /**
       * Load the table state. With this function you can define from where, and how, the
       * state of a table is loaded. By default DataTables will load from `localStorage`
       * but you might wish to use a server-side database or cookies.
       *  @type function
       *  @member
       *  @param {object} settings DataTables settings object
       *  @param {object} callback Callback that can be executed when done. It
       *    should be passed the loaded state object.
       *  @return {object} The DataTables state object to be loaded
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.stateLoadCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateSave": true,
       *        "stateLoadCallback": function (settings, callback) {
       *          $.ajax( {
       *            "url": "/state_load",
       *            "dataType": "json",
       *            "success": function (json) {
       *              callback( json );
       *            }
       *          } );
       *        }
       *      } );
       *    } );
       */
      "fnStateLoadCallback": function(settings) {
        try {
          return JSON.parse(
            (settings.iStateDuration === -1 ? sessionStorage : localStorage).getItem(
              "DataTables_" + settings.sInstance + "_" + location.pathname
            )
          );
        } catch (e) {
          return {};
        }
      },
      /**
       * Callback which allows modification of the saved state prior to loading that state.
       * This callback is called when the table is loading state from the stored data, but
       * prior to the settings object being modified by the saved state. Note that for
       * plug-in authors, you should use the `stateLoadParams` event to load parameters for
       * a plug-in.
       *  @type function
       *  @param {object} settings DataTables settings object
       *  @param {object} data The state object that is to be loaded
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.stateLoadParams
       *
       *  @example
       *    // Remove a saved filter, so filtering is never loaded
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateSave": true,
       *        "stateLoadParams": function (settings, data) {
       *          data.oSearch.sSearch = "";
       *        }
       *      } );
       *    } );
       *
       *  @example
       *    // Disallow state loading by returning false
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateSave": true,
       *        "stateLoadParams": function (settings, data) {
       *          return false;
       *        }
       *      } );
       *    } );
       */
      "fnStateLoadParams": null,
      /**
       * Callback that is called when the state has been loaded from the state saving method
       * and the DataTables settings object has been modified as a result of the loaded state.
       *  @type function
       *  @param {object} settings DataTables settings object
       *  @param {object} data The state object that was loaded
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.stateLoaded
       *
       *  @example
       *    // Show an alert with the filtering value that was saved
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateSave": true,
       *        "stateLoaded": function (settings, data) {
       *          alert( 'Saved filter was: '+data.oSearch.sSearch );
       *        }
       *      } );
       *    } );
       */
      "fnStateLoaded": null,
      /**
       * Save the table state. This function allows you to define where and how the state
       * information for the table is stored By default DataTables will use `localStorage`
       * but you might wish to use a server-side database or cookies.
       *  @type function
       *  @member
       *  @param {object} settings DataTables settings object
       *  @param {object} data The state object to be saved
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.stateSaveCallback
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateSave": true,
       *        "stateSaveCallback": function (settings, data) {
       *          // Send an Ajax request to the server with the state object
       *          $.ajax( {
       *            "url": "/state_save",
       *            "data": data,
       *            "dataType": "json",
       *            "method": "POST"
       *            "success": function () {}
       *          } );
       *        }
       *      } );
       *    } );
       */
      "fnStateSaveCallback": function(settings, data) {
        try {
          (settings.iStateDuration === -1 ? sessionStorage : localStorage).setItem(
            "DataTables_" + settings.sInstance + "_" + location.pathname,
            JSON.stringify(data)
          );
        } catch (e) {
        }
      },
      /**
       * Callback which allows modification of the state to be saved. Called when the table
       * has changed state a new state save is required. This method allows modification of
       * the state saving object prior to actually doing the save, including addition or
       * other state properties or modification. Note that for plug-in authors, you should
       * use the `stateSaveParams` event to save parameters for a plug-in.
       *  @type function
       *  @param {object} settings DataTables settings object
       *  @param {object} data The state object to be saved
       *
       *  @dtopt Callbacks
       *  @name DataTable.defaults.stateSaveParams
       *
       *  @example
       *    // Remove a saved filter, so filtering is never saved
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateSave": true,
       *        "stateSaveParams": function (settings, data) {
       *          data.oSearch.sSearch = "";
       *        }
       *      } );
       *    } );
       */
      "fnStateSaveParams": null,
      /**
       * Duration for which the saved state information is considered valid. After this period
       * has elapsed the state will be returned to the default.
       * Value is given in seconds.
       *  @type int
       *  @default 7200 <i>(2 hours)</i>
       *
       *  @dtopt Options
       *  @name DataTable.defaults.stateDuration
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "stateDuration": 60*60*24; // 1 day
       *      } );
       *    } )
       */
      "iStateDuration": 7200,
      /**
       * When enabled DataTables will not make a request to the server for the first
       * page draw - rather it will use the data already on the page (no sorting etc
       * will be applied to it), thus saving on an XHR at load time. `deferLoading`
       * is used to indicate that deferred loading is required, but it is also used
       * to tell DataTables how many records there are in the full table (allowing
       * the information element and pagination to be displayed correctly). In the case
       * where a filtering is applied to the table on initial load, this can be
       * indicated by giving the parameter as an array, where the first element is
       * the number of records available after filtering and the second element is the
       * number of records without filtering (allowing the table information element
       * to be shown correctly).
       *  @type int | array
       *  @default null
       *
       *  @dtopt Options
       *  @name DataTable.defaults.deferLoading
       *
       *  @example
       *    // 57 records available in the table, no filtering applied
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "serverSide": true,
       *        "ajax": "scripts/server_processing.php",
       *        "deferLoading": 57
       *      } );
       *    } );
       *
       *  @example
       *    // 57 records after filtering, 100 without filtering (an initial filter applied)
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "serverSide": true,
       *        "ajax": "scripts/server_processing.php",
       *        "deferLoading": [ 57, 100 ],
       *        "search": {
       *          "search": "my_filter"
       *        }
       *      } );
       *    } );
       */
      "iDeferLoading": null,
      /**
       * Number of rows to display on a single page when using pagination. If
       * feature enabled (`lengthChange`) then the end user will be able to override
       * this to a custom setting using a pop-up menu.
       *  @type int
       *  @default 10
       *
       *  @dtopt Options
       *  @name DataTable.defaults.pageLength
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "pageLength": 50
       *      } );
       *    } )
       */
      "iDisplayLength": 10,
      /**
       * Define the starting point for data display when using DataTables with
       * pagination. Note that this parameter is the number of records, rather than
       * the page number, so if you have 10 records per page and want to start on
       * the third page, it should be "20".
       *  @type int
       *  @default 0
       *
       *  @dtopt Options
       *  @name DataTable.defaults.displayStart
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "displayStart": 20
       *      } );
       *    } )
       */
      "iDisplayStart": 0,
      /**
       * By default DataTables allows keyboard navigation of the table (sorting, paging,
       * and filtering) by adding a `tabindex` attribute to the required elements. This
       * allows you to tab through the controls and press the enter key to activate them.
       * The tabindex is default 0, meaning that the tab follows the flow of the document.
       * You can overrule this using this parameter if you wish. Use a value of -1 to
       * disable built-in keyboard navigation.
       *  @type int
       *  @default 0
       *
       *  @dtopt Options
       *  @name DataTable.defaults.tabIndex
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "tabIndex": 1
       *      } );
       *    } );
       */
      "iTabIndex": 0,
      /**
       * Classes that DataTables assigns to the various components and features
       * that it adds to the HTML table. This allows classes to be configured
       * during initialisation in addition to through the static
       * {@link DataTable.ext.oStdClasses} object).
       *  @namespace
       *  @name DataTable.defaults.classes
       */
      "oClasses": {},
      /**
       * All strings that DataTables uses in the user interface that it creates
       * are defined in this object, allowing you to modified them individually or
       * completely replace them all as required.
       *  @namespace
       *  @name DataTable.defaults.language
       */
      "oLanguage": {
        /**
         * Strings that are used for WAI-ARIA labels and controls only (these are not
         * actually visible on the page, but will be read by screenreaders, and thus
         * must be internationalised as well).
         *  @namespace
         *  @name DataTable.defaults.language.aria
         */
        "oAria": {
          /**
           * ARIA label that is added to the table headers when the column may be
           * sorted ascending by activing the column (click or return when focused).
           * Note that the column header is prefixed to this string.
           *  @type string
           *  @default : activate to sort column ascending
           *
           *  @dtopt Language
           *  @name DataTable.defaults.language.aria.sortAscending
           *
           *  @example
           *    $(document).ready( function() {
           *      $('#example').dataTable( {
           *        "language": {
           *          "aria": {
           *            "sortAscending": " - click/return to sort ascending"
           *          }
           *        }
           *      } );
           *    } );
           */
          "sSortAscending": ": activate to sort column ascending",
          /**
           * ARIA label that is added to the table headers when the column may be
           * sorted descending by activing the column (click or return when focused).
           * Note that the column header is prefixed to this string.
           *  @type string
           *  @default : activate to sort column ascending
           *
           *  @dtopt Language
           *  @name DataTable.defaults.language.aria.sortDescending
           *
           *  @example
           *    $(document).ready( function() {
           *      $('#example').dataTable( {
           *        "language": {
           *          "aria": {
           *            "sortDescending": " - click/return to sort descending"
           *          }
           *        }
           *      } );
           *    } );
           */
          "sSortDescending": ": activate to sort column descending"
        },
        /**
         * Pagination string used by DataTables for the built-in pagination
         * control types.
         *  @namespace
         *  @name DataTable.defaults.language.paginate
         */
        "oPaginate": {
          /**
           * Text to use when using the 'full_numbers' type of pagination for the
           * button to take the user to the first page.
           *  @type string
           *  @default First
           *
           *  @dtopt Language
           *  @name DataTable.defaults.language.paginate.first
           *
           *  @example
           *    $(document).ready( function() {
           *      $('#example').dataTable( {
           *        "language": {
           *          "paginate": {
           *            "first": "First page"
           *          }
           *        }
           *      } );
           *    } );
           */
          "sFirst": "First",
          /**
           * Text to use when using the 'full_numbers' type of pagination for the
           * button to take the user to the last page.
           *  @type string
           *  @default Last
           *
           *  @dtopt Language
           *  @name DataTable.defaults.language.paginate.last
           *
           *  @example
           *    $(document).ready( function() {
           *      $('#example').dataTable( {
           *        "language": {
           *          "paginate": {
           *            "last": "Last page"
           *          }
           *        }
           *      } );
           *    } );
           */
          "sLast": "Last",
          /**
           * Text to use for the 'next' pagination button (to take the user to the
           * next page).
           *  @type string
           *  @default Next
           *
           *  @dtopt Language
           *  @name DataTable.defaults.language.paginate.next
           *
           *  @example
           *    $(document).ready( function() {
           *      $('#example').dataTable( {
           *        "language": {
           *          "paginate": {
           *            "next": "Next page"
           *          }
           *        }
           *      } );
           *    } );
           */
          "sNext": "Next",
          /**
           * Text to use for the 'previous' pagination button (to take the user to
           * the previous page).
           *  @type string
           *  @default Previous
           *
           *  @dtopt Language
           *  @name DataTable.defaults.language.paginate.previous
           *
           *  @example
           *    $(document).ready( function() {
           *      $('#example').dataTable( {
           *        "language": {
           *          "paginate": {
           *            "previous": "Previous page"
           *          }
           *        }
           *      } );
           *    } );
           */
          "sPrevious": "Previous"
        },
        /**
         * This string is shown in preference to `zeroRecords` when the table is
         * empty of data (regardless of filtering). Note that this is an optional
         * parameter - if it is not given, the value of `zeroRecords` will be used
         * instead (either the default or given value).
         *  @type string
         *  @default No data available in table
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.emptyTable
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "emptyTable": "No data available in table"
         *        }
         *      } );
         *    } );
         */
        "sEmptyTable": "No data available in table",
        /**
         * This string gives information to the end user about the information
         * that is current on display on the page. The following tokens can be
         * used in the string and will be dynamically replaced as the table
         * display updates. This tokens can be placed anywhere in the string, or
         * removed as needed by the language requires:
         *
         * * `\_START\_` - Display index of the first record on the current page
         * * `\_END\_` - Display index of the last record on the current page
         * * `\_TOTAL\_` - Number of records in the table after filtering
         * * `\_MAX\_` - Number of records in the table without filtering
         * * `\_PAGE\_` - Current page number
         * * `\_PAGES\_` - Total number of pages of data in the table
         *
         *  @type string
         *  @default Showing _START_ to _END_ of _TOTAL_ entries
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.info
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "info": "Showing page _PAGE_ of _PAGES_"
         *        }
         *      } );
         *    } );
         */
        "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
        /**
         * Display information string for when the table is empty. Typically the
         * format of this string should match `info`.
         *  @type string
         *  @default Showing 0 to 0 of 0 entries
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.infoEmpty
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "infoEmpty": "No entries to show"
         *        }
         *      } );
         *    } );
         */
        "sInfoEmpty": "Showing 0 to 0 of 0 entries",
        /**
         * When a user filters the information in a table, this string is appended
         * to the information (`info`) to give an idea of how strong the filtering
         * is. The variable _MAX_ is dynamically updated.
         *  @type string
         *  @default (filtered from _MAX_ total entries)
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.infoFiltered
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "infoFiltered": " - filtering from _MAX_ records"
         *        }
         *      } );
         *    } );
         */
        "sInfoFiltered": "(filtered from _MAX_ total entries)",
        /**
         * If can be useful to append extra information to the info string at times,
         * and this variable does exactly that. This information will be appended to
         * the `info` (`infoEmpty` and `infoFiltered` in whatever combination they are
         * being used) at all times.
         *  @type string
         *  @default <i>Empty string</i>
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.infoPostFix
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "infoPostFix": "All records shown are derived from real information."
         *        }
         *      } );
         *    } );
         */
        "sInfoPostFix": "",
        /**
         * This decimal place operator is a little different from the other
         * language options since DataTables doesn't output floating point
         * numbers, so it won't ever use this for display of a number. Rather,
         * what this parameter does is modify the sort methods of the table so
         * that numbers which are in a format which has a character other than
         * a period (`.`) as a decimal place will be sorted numerically.
         *
         * Note that numbers with different decimal places cannot be shown in
         * the same table and still be sortable, the table must be consistent.
         * However, multiple different tables on the page can use different
         * decimal place characters.
         *  @type string
         *  @default 
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.decimal
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "decimal": ","
         *          "thousands": "."
         *        }
         *      } );
         *    } );
         */
        "sDecimal": "",
        /**
         * DataTables has a build in number formatter (`formatNumber`) which is
         * used to format large numbers that are used in the table information.
         * By default a comma is used, but this can be trivially changed to any
         * character you wish with this parameter.
         *  @type string
         *  @default ,
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.thousands
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "thousands": "'"
         *        }
         *      } );
         *    } );
         */
        "sThousands": ",",
        /**
         * Detail the action that will be taken when the drop down menu for the
         * pagination length option is changed. The '_MENU_' variable is replaced
         * with a default select list of 10, 25, 50 and 100, and can be replaced
         * with a custom select box if required.
         *  @type string
         *  @default Show _MENU_ entries
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.lengthMenu
         *
         *  @example
         *    // Language change only
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "lengthMenu": "Display _MENU_ records"
         *        }
         *      } );
         *    } );
         *
         *  @example
         *    // Language and options change
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "lengthMenu": 'Display <select>'+
         *            '<option value="10">10</option>'+
         *            '<option value="20">20</option>'+
         *            '<option value="30">30</option>'+
         *            '<option value="40">40</option>'+
         *            '<option value="50">50</option>'+
         *            '<option value="-1">All</option>'+
         *            '</select> records'
         *        }
         *      } );
         *    } );
         */
        "sLengthMenu": "Show _MENU_ entries",
        /**
         * When using Ajax sourced data and during the first draw when DataTables is
         * gathering the data, this message is shown in an empty row in the table to
         * indicate to the end user the the data is being loaded. Note that this
         * parameter is not used when loading data by server-side processing, just
         * Ajax sourced data with client-side processing.
         *  @type string
         *  @default Loading...
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.loadingRecords
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "loadingRecords": "Please wait - loading..."
         *        }
         *      } );
         *    } );
         */
        "sLoadingRecords": "Loading...",
        /**
         * Text which is displayed when the table is processing a user action
         * (usually a sort command or similar).
         *  @type string
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.processing
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "processing": "DataTables is currently busy"
         *        }
         *      } );
         *    } );
         */
        "sProcessing": "",
        /**
         * Details the actions that will be taken when the user types into the
         * filtering input text box. The variable "_INPUT_", if used in the string,
         * is replaced with the HTML text box for the filtering input allowing
         * control over where it appears in the string. If "_INPUT_" is not given
         * then the input box is appended to the string automatically.
         *  @type string
         *  @default Search:
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.search
         *
         *  @example
         *    // Input text box will be appended at the end automatically
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "search": "Filter records:"
         *        }
         *      } );
         *    } );
         *
         *  @example
         *    // Specify where the filter should appear
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "search": "Apply filter _INPUT_ to table"
         *        }
         *      } );
         *    } );
         */
        "sSearch": "Search:",
        /**
         * Assign a `placeholder` attribute to the search `input` element
         *  @type string
         *  @default 
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.searchPlaceholder
         */
        "sSearchPlaceholder": "",
        /**
         * All of the language information can be stored in a file on the
         * server-side, which DataTables will look up if this parameter is passed.
         * It must store the URL of the language file, which is in a JSON format,
         * and the object has the same properties as the oLanguage object in the
         * initialiser object (i.e. the above parameters). Please refer to one of
         * the example language files to see how this works in action.
         *  @type string
         *  @default <i>Empty string - i.e. disabled</i>
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.url
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "url": "https://www.sprymedia.co.uk/dataTables/lang.txt"
         *        }
         *      } );
         *    } );
         */
        "sUrl": "",
        /**
         * Text shown inside the table records when the is no information to be
         * displayed after filtering. `emptyTable` is shown when there is simply no
         * information in the table at all (regardless of filtering).
         *  @type string
         *  @default No matching records found
         *
         *  @dtopt Language
         *  @name DataTable.defaults.language.zeroRecords
         *
         *  @example
         *    $(document).ready( function() {
         *      $('#example').dataTable( {
         *        "language": {
         *          "zeroRecords": "No records to display"
         *        }
         *      } );
         *    } );
         */
        "sZeroRecords": "No matching records found"
      },
      /**
       * This parameter allows you to have define the global filtering state at
       * initialisation time. As an object the `search` parameter must be
       * defined, but all other parameters are optional. When `regex` is true,
       * the search string will be treated as a regular expression, when false
       * (default) it will be treated as a straight string. When `smart`
       * DataTables will use it's smart filtering methods (to word match at
       * any point in the data), when false this will not be done.
       *  @namespace
       *  @extends DataTable.models.oSearch
       *
       *  @dtopt Options
       *  @name DataTable.defaults.search
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "search": {"search": "Initial search"}
       *      } );
       *    } )
       */
      "oSearch": $.extend({}, DataTable.models.oSearch),
      /**
       * __Deprecated__ The functionality provided by this parameter has now been
       * superseded by that provided through `ajax`, which should be used instead.
       *
       * By default DataTables will look for the property `data` (or `aaData` for
       * compatibility with DataTables 1.9-) when obtaining data from an Ajax
       * source or for server-side processing - this parameter allows that
       * property to be changed. You can use Javascript dotted object notation to
       * get a data source for multiple levels of nesting.
       *  @type string
       *  @default data
       *
       *  @dtopt Options
       *  @dtopt Server-side
       *  @name DataTable.defaults.ajaxDataProp
       *
       *  @deprecated 1.10. Please use `ajax` for this functionality now.
       */
      "sAjaxDataProp": "data",
      /**
       * __Deprecated__ The functionality provided by this parameter has now been
       * superseded by that provided through `ajax`, which should be used instead.
       *
       * You can instruct DataTables to load data from an external
       * source using this parameter (use aData if you want to pass data in you
       * already have). Simply provide a url a JSON object can be obtained from.
       *  @type string
       *  @default null
       *
       *  @dtopt Options
       *  @dtopt Server-side
       *  @name DataTable.defaults.ajaxSource
       *
       *  @deprecated 1.10. Please use `ajax` for this functionality now.
       */
      "sAjaxSource": null,
      /**
       * This initialisation variable allows you to specify exactly where in the
       * DOM you want DataTables to inject the various controls it adds to the page
       * (for example you might want the pagination controls at the top of the
       * table). DIV elements (with or without a custom class) can also be added to
       * aid styling. The follow syntax is used:
       *   <ul>
       *     <li>The following options are allowed:
       *       <ul>
       *         <li>'l' - Length changing</li>
       *         <li>'f' - Filtering input</li>
       *         <li>'t' - The table!</li>
       *         <li>'i' - Information</li>
       *         <li>'p' - Pagination</li>
       *         <li>'r' - pRocessing</li>
       *       </ul>
       *     </li>
       *     <li>The following constants are allowed:
       *       <ul>
       *         <li>'H' - jQueryUI theme "header" classes ('fg-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix')</li>
       *         <li>'F' - jQueryUI theme "footer" classes ('fg-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix')</li>
       *       </ul>
       *     </li>
       *     <li>The following syntax is expected:
       *       <ul>
       *         <li>'&lt;' and '&gt;' - div elements</li>
       *         <li>'&lt;"class" and '&gt;' - div with a class</li>
       *         <li>'&lt;"#id" and '&gt;' - div with an ID</li>
       *       </ul>
       *     </li>
       *     <li>Examples:
       *       <ul>
       *         <li>'&lt;"wrapper"flipt&gt;'</li>
       *         <li>'&lt;lf&lt;t&gt;ip&gt;'</li>
       *       </ul>
       *     </li>
       *   </ul>
       *  @type string
       *  @default lfrtip <i>(when `jQueryUI` is false)</i> <b>or</b>
       *    <"H"lfr>t<"F"ip> <i>(when `jQueryUI` is true)</i>
       *
       *  @dtopt Options
       *  @name DataTable.defaults.dom
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "dom": '&lt;"top"i&gt;rt&lt;"bottom"flp&gt;&lt;"clear"&gt;'
       *      } );
       *    } );
       */
      "sDom": "lfrtip",
      /**
       * Search delay option. This will throttle full table searches that use the
       * DataTables provided search input element (it does not effect calls to
       * `dt-api search()`, providing a delay before the search is made.
       *  @type integer
       *  @default 0
       *
       *  @dtopt Options
       *  @name DataTable.defaults.searchDelay
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "searchDelay": 200
       *      } );
       *    } )
       */
      "searchDelay": null,
      /**
       * DataTables features six different built-in options for the buttons to
       * display for pagination control:
       *
       * * `numbers` - Page number buttons only
       * * `simple` - 'Previous' and 'Next' buttons only
       * * 'simple_numbers` - 'Previous' and 'Next' buttons, plus page numbers
       * * `full` - 'First', 'Previous', 'Next' and 'Last' buttons
       * * `full_numbers` - 'First', 'Previous', 'Next' and 'Last' buttons, plus page numbers
       * * `first_last_numbers` - 'First' and 'Last' buttons, plus page numbers
       *  
       * Further methods can be added using {@link DataTable.ext.oPagination}.
       *  @type string
       *  @default simple_numbers
       *
       *  @dtopt Options
       *  @name DataTable.defaults.pagingType
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "pagingType": "full_numbers"
       *      } );
       *    } )
       */
      "sPaginationType": "simple_numbers",
      /**
       * Enable horizontal scrolling. When a table is too wide to fit into a
       * certain layout, or you have a large number of columns in the table, you
       * can enable x-scrolling to show the table in a viewport, which can be
       * scrolled. This property can be `true` which will allow the table to
       * scroll horizontally when needed, or any CSS unit, or a number (in which
       * case it will be treated as a pixel measurement). Setting as simply `true`
       * is recommended.
       *  @type boolean|string
       *  @default <i>blank string - i.e. disabled</i>
       *
       *  @dtopt Features
       *  @name DataTable.defaults.scrollX
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "scrollX": true,
       *        "scrollCollapse": true
       *      } );
       *    } );
       */
      "sScrollX": "",
      /**
       * This property can be used to force a DataTable to use more width than it
       * might otherwise do when x-scrolling is enabled. For example if you have a
       * table which requires to be well spaced, this parameter is useful for
       * "over-sizing" the table, and thus forcing scrolling. This property can by
       * any CSS unit, or a number (in which case it will be treated as a pixel
       * measurement).
       *  @type string
       *  @default <i>blank string - i.e. disabled</i>
       *
       *  @dtopt Options
       *  @name DataTable.defaults.scrollXInner
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "scrollX": "100%",
       *        "scrollXInner": "110%"
       *      } );
       *    } );
       */
      "sScrollXInner": "",
      /**
       * Enable vertical scrolling. Vertical scrolling will constrain the DataTable
       * to the given height, and enable scrolling for any data which overflows the
       * current viewport. This can be used as an alternative to paging to display
       * a lot of data in a small area (although paging and scrolling can both be
       * enabled at the same time). This property can be any CSS unit, or a number
       * (in which case it will be treated as a pixel measurement).
       *  @type string
       *  @default <i>blank string - i.e. disabled</i>
       *
       *  @dtopt Features
       *  @name DataTable.defaults.scrollY
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "scrollY": "200px",
       *        "paginate": false
       *      } );
       *    } );
       */
      "sScrollY": "",
      /**
       * __Deprecated__ The functionality provided by this parameter has now been
       * superseded by that provided through `ajax`, which should be used instead.
       *
       * Set the HTTP method that is used to make the Ajax call for server-side
       * processing or Ajax sourced data.
       *  @type string
       *  @default GET
       *
       *  @dtopt Options
       *  @dtopt Server-side
       *  @name DataTable.defaults.serverMethod
       *
       *  @deprecated 1.10. Please use `ajax` for this functionality now.
       */
      "sServerMethod": "GET",
      /**
       * DataTables makes use of renderers when displaying HTML elements for
       * a table. These renderers can be added or modified by plug-ins to
       * generate suitable mark-up for a site. For example the Bootstrap
       * integration plug-in for DataTables uses a paging button renderer to
       * display pagination buttons in the mark-up required by Bootstrap.
       *
       * For further information about the renderers available see
       * DataTable.ext.renderer
       *  @type string|object
       *  @default null
       *
       *  @name DataTable.defaults.renderer
       *
       */
      "renderer": null,
      /**
       * Set the data property name that DataTables should use to get a row's id
       * to set as the `id` property in the node.
       *  @type string
       *  @default DT_RowId
       *
       *  @name DataTable.defaults.rowId
       */
      "rowId": "DT_RowId"
    };
    _fnHungarianMap(DataTable.defaults);
    DataTable.defaults.column = {
      /**
       * Define which column(s) an order will occur on for this column. This
       * allows a column's ordering to take multiple columns into account when
       * doing a sort or use the data from a different column. For example first
       * name / last name columns make sense to do a multi-column sort over the
       * two columns.
       *  @type array|int
       *  @default null <i>Takes the value of the column index automatically</i>
       *
       *  @name DataTable.defaults.column.orderData
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "orderData": [ 0, 1 ], "targets": [ 0 ] },
       *          { "orderData": [ 1, 0 ], "targets": [ 1 ] },
       *          { "orderData": 2, "targets": [ 2 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "orderData": [ 0, 1 ] },
       *          { "orderData": [ 1, 0 ] },
       *          { "orderData": 2 },
       *          null,
       *          null
       *        ]
       *      } );
       *    } );
       */
      "aDataSort": null,
      "iDataSort": -1,
      /**
       * You can control the default ordering direction, and even alter the
       * behaviour of the sort handler (i.e. only allow ascending ordering etc)
       * using this parameter.
       *  @type array
       *  @default [ 'asc', 'desc' ]
       *
       *  @name DataTable.defaults.column.orderSequence
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "orderSequence": [ "asc" ], "targets": [ 1 ] },
       *          { "orderSequence": [ "desc", "asc", "asc" ], "targets": [ 2 ] },
       *          { "orderSequence": [ "desc" ], "targets": [ 3 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          null,
       *          { "orderSequence": [ "asc" ] },
       *          { "orderSequence": [ "desc", "asc", "asc" ] },
       *          { "orderSequence": [ "desc" ] },
       *          null
       *        ]
       *      } );
       *    } );
       */
      "asSorting": ["asc", "desc"],
      /**
       * Enable or disable filtering on the data in this column.
       *  @type boolean
       *  @default true
       *
       *  @name DataTable.defaults.column.searchable
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "searchable": false, "targets": [ 0 ] }
       *        ] } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "searchable": false },
       *          null,
       *          null,
       *          null,
       *          null
       *        ] } );
       *    } );
       */
      "bSearchable": true,
      /**
       * Enable or disable ordering on this column.
       *  @type boolean
       *  @default true
       *
       *  @name DataTable.defaults.column.orderable
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "orderable": false, "targets": [ 0 ] }
       *        ] } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "orderable": false },
       *          null,
       *          null,
       *          null,
       *          null
       *        ] } );
       *    } );
       */
      "bSortable": true,
      /**
       * Enable or disable the display of this column.
       *  @type boolean
       *  @default true
       *
       *  @name DataTable.defaults.column.visible
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "visible": false, "targets": [ 0 ] }
       *        ] } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "visible": false },
       *          null,
       *          null,
       *          null,
       *          null
       *        ] } );
       *    } );
       */
      "bVisible": true,
      /**
       * Developer definable function that is called whenever a cell is created (Ajax source,
       * etc) or processed for input (DOM source). This can be used as a compliment to mRender
       * allowing you to modify the DOM element (add background colour for example) when the
       * element is available.
       *  @type function
       *  @param {element} td The TD node that has been created
       *  @param {*} cellData The Data for the cell
       *  @param {array|object} rowData The data for the whole row
       *  @param {int} row The row index for the aoData data store
       *  @param {int} col The column index for aoColumns
       *
       *  @name DataTable.defaults.column.createdCell
       *  @dtopt Columns
       *
       *  @example
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [3],
       *          "createdCell": function (td, cellData, rowData, row, col) {
       *            if ( cellData == "1.7" ) {
       *              $(td).css('color', 'blue')
       *            }
       *          }
       *        } ]
       *      });
       *    } );
       */
      "fnCreatedCell": null,
      /**
       * This parameter has been replaced by `data` in DataTables to ensure naming
       * consistency. `dataProp` can still be used, as there is backwards
       * compatibility in DataTables for this option, but it is strongly
       * recommended that you use `data` in preference to `dataProp`.
       *  @name DataTable.defaults.column.dataProp
       */
      /**
       * This property can be used to read data from any data source property,
       * including deeply nested objects / properties. `data` can be given in a
       * number of different ways which effect its behaviour:
       *
       * * `integer` - treated as an array index for the data source. This is the
       *   default that DataTables uses (incrementally increased for each column).
       * * `string` - read an object property from the data source. There are
       *   three 'special' options that can be used in the string to alter how
       *   DataTables reads the data from the source object:
       *    * `.` - Dotted Javascript notation. Just as you use a `.` in
       *      Javascript to read from nested objects, so to can the options
       *      specified in `data`. For example: `browser.version` or
       *      `browser.name`. If your object parameter name contains a period, use
       *      `\\` to escape it - i.e. `first\\.name`.
       *    * `[]` - Array notation. DataTables can automatically combine data
       *      from and array source, joining the data with the characters provided
       *      between the two brackets. For example: `name[, ]` would provide a
       *      comma-space separated list from the source array. If no characters
       *      are provided between the brackets, the original array source is
       *      returned.
       *    * `()` - Function notation. Adding `()` to the end of a parameter will
       *      execute a function of the name given. For example: `browser()` for a
       *      simple function on the data source, `browser.version()` for a
       *      function in a nested property or even `browser().version` to get an
       *      object property if the function called returns an object. Note that
       *      function notation is recommended for use in `render` rather than
       *      `data` as it is much simpler to use as a renderer.
       * * `null` - use the original data source for the row rather than plucking
       *   data directly from it. This action has effects on two other
       *   initialisation options:
       *    * `defaultContent` - When null is given as the `data` option and
       *      `defaultContent` is specified for the column, the value defined by
       *      `defaultContent` will be used for the cell.
       *    * `render` - When null is used for the `data` option and the `render`
       *      option is specified for the column, the whole data source for the
       *      row is used for the renderer.
       * * `function` - the function given will be executed whenever DataTables
       *   needs to set or get the data for a cell in the column. The function
       *   takes three parameters:
       *    * Parameters:
       *      * `{array|object}` The data source for the row
       *      * `{string}` The type call data requested - this will be 'set' when
       *        setting data or 'filter', 'display', 'type', 'sort' or undefined
       *        when gathering data. Note that when `undefined` is given for the
       *        type DataTables expects to get the raw data for the object back<
       *      * `{*}` Data to set when the second parameter is 'set'.
       *    * Return:
       *      * The return value from the function is not required when 'set' is
       *        the type of call, but otherwise the return is what will be used
       *        for the data requested.
       *
       * Note that `data` is a getter and setter option. If you just require
       * formatting of data for output, you will likely want to use `render` which
       * is simply a getter and thus simpler to use.
       *
       * Note that prior to DataTables 1.9.2 `data` was called `mDataProp`. The
       * name change reflects the flexibility of this property and is consistent
       * with the naming of mRender. If 'mDataProp' is given, then it will still
       * be used by DataTables, as it automatically maps the old name to the new
       * if required.
       *
       *  @type string|int|function|null
       *  @default null <i>Use automatically calculated column index</i>
       *
       *  @name DataTable.defaults.column.data
       *  @dtopt Columns
       *
       *  @example
       *    // Read table data from objects
       *    // JSON structure for each row:
       *    //   {
       *    //      "engine": {value},
       *    //      "browser": {value},
       *    //      "platform": {value},
       *    //      "version": {value},
       *    //      "grade": {value}
       *    //   }
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "ajaxSource": "sources/objects.txt",
       *        "columns": [
       *          { "data": "engine" },
       *          { "data": "browser" },
       *          { "data": "platform" },
       *          { "data": "version" },
       *          { "data": "grade" }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Read information from deeply nested objects
       *    // JSON structure for each row:
       *    //   {
       *    //      "engine": {value},
       *    //      "browser": {value},
       *    //      "platform": {
       *    //         "inner": {value}
       *    //      },
       *    //      "details": [
       *    //         {value}, {value}
       *    //      ]
       *    //   }
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "ajaxSource": "sources/deep.txt",
       *        "columns": [
       *          { "data": "engine" },
       *          { "data": "browser" },
       *          { "data": "platform.inner" },
       *          { "data": "details.0" },
       *          { "data": "details.1" }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `data` as a function to provide different information for
       *    // sorting, filtering and display. In this case, currency (price)
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "data": function ( source, type, val ) {
       *            if (type === 'set') {
       *              source.price = val;
       *              // Store the computed display and filter values for efficiency
       *              source.price_display = val=="" ? "" : "$"+numberFormat(val);
       *              source.price_filter  = val=="" ? "" : "$"+numberFormat(val)+" "+val;
       *              return;
       *            }
       *            else if (type === 'display') {
       *              return source.price_display;
       *            }
       *            else if (type === 'filter') {
       *              return source.price_filter;
       *            }
       *            // 'sort', 'type' and undefined all just use the integer
       *            return source.price;
       *          }
       *        } ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using default content
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "data": null,
       *          "defaultContent": "Click to edit"
       *        } ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using array notation - outputting a list from an array
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "data": "name[, ]"
       *        } ]
       *      } );
       *    } );
       *
       */
      "mData": null,
      /**
       * This property is the rendering partner to `data` and it is suggested that
       * when you want to manipulate data for display (including filtering,
       * sorting etc) without altering the underlying data for the table, use this
       * property. `render` can be considered to be the the read only companion to
       * `data` which is read / write (then as such more complex). Like `data`
       * this option can be given in a number of different ways to effect its
       * behaviour:
       *
       * * `integer` - treated as an array index for the data source. This is the
       *   default that DataTables uses (incrementally increased for each column).
       * * `string` - read an object property from the data source. There are
       *   three 'special' options that can be used in the string to alter how
       *   DataTables reads the data from the source object:
       *    * `.` - Dotted Javascript notation. Just as you use a `.` in
       *      Javascript to read from nested objects, so to can the options
       *      specified in `data`. For example: `browser.version` or
       *      `browser.name`. If your object parameter name contains a period, use
       *      `\\` to escape it - i.e. `first\\.name`.
       *    * `[]` - Array notation. DataTables can automatically combine data
       *      from and array source, joining the data with the characters provided
       *      between the two brackets. For example: `name[, ]` would provide a
       *      comma-space separated list from the source array. If no characters
       *      are provided between the brackets, the original array source is
       *      returned.
       *    * `()` - Function notation. Adding `()` to the end of a parameter will
       *      execute a function of the name given. For example: `browser()` for a
       *      simple function on the data source, `browser.version()` for a
       *      function in a nested property or even `browser().version` to get an
       *      object property if the function called returns an object.
       * * `object` - use different data for the different data types requested by
       *   DataTables ('filter', 'display', 'type' or 'sort'). The property names
       *   of the object is the data type the property refers to and the value can
       *   defined using an integer, string or function using the same rules as
       *   `render` normally does. Note that an `_` option _must_ be specified.
       *   This is the default value to use if you haven't specified a value for
       *   the data type requested by DataTables.
       * * `function` - the function given will be executed whenever DataTables
       *   needs to set or get the data for a cell in the column. The function
       *   takes three parameters:
       *    * Parameters:
       *      * {array|object} The data source for the row (based on `data`)
       *      * {string} The type call data requested - this will be 'filter',
       *        'display', 'type' or 'sort'.
       *      * {array|object} The full data source for the row (not based on
       *        `data`)
       *    * Return:
       *      * The return value from the function is what will be used for the
       *        data requested.
       *
       *  @type string|int|function|object|null
       *  @default null Use the data source value.
       *
       *  @name DataTable.defaults.column.render
       *  @dtopt Columns
       *
       *  @example
       *    // Create a comma separated list from an array of objects
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "ajaxSource": "sources/deep.txt",
       *        "columns": [
       *          { "data": "engine" },
       *          { "data": "browser" },
       *          {
       *            "data": "platform",
       *            "render": "[, ].name"
       *          }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Execute a function to obtain data
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "data": null, // Use the full data source object for the renderer's source
       *          "render": "browserName()"
       *        } ]
       *      } );
       *    } );
       *
       *  @example
       *    // As an object, extracting different data for the different types
       *    // This would be used with a data source such as:
       *    //   { "phone": 5552368, "phone_filter": "5552368 555-2368", "phone_display": "555-2368" }
       *    // Here the `phone` integer is used for sorting and type detection, while `phone_filter`
       *    // (which has both forms) is used for filtering for if a user inputs either format, while
       *    // the formatted phone number is the one that is shown in the table.
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "data": null, // Use the full data source object for the renderer's source
       *          "render": {
       *            "_": "phone",
       *            "filter": "phone_filter",
       *            "display": "phone_display"
       *          }
       *        } ]
       *      } );
       *    } );
       *
       *  @example
       *    // Use as a function to create a link from the data source
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "data": "download_link",
       *          "render": function ( data, type, full ) {
       *            return '<a href="'+data+'">Download</a>';
       *          }
       *        } ]
       *      } );
       *    } );
       */
      "mRender": null,
      /**
       * Change the cell type created for the column - either TD cells or TH cells. This
       * can be useful as TH cells have semantic meaning in the table body, allowing them
       * to act as a header for a row (you may wish to add scope='row' to the TH elements).
       *  @type string
       *  @default td
       *
       *  @name DataTable.defaults.column.cellType
       *  @dtopt Columns
       *
       *  @example
       *    // Make the first column use TH cells
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [ {
       *          "targets": [ 0 ],
       *          "cellType": "th"
       *        } ]
       *      } );
       *    } );
       */
      "sCellType": "td",
      /**
       * Class to give to each cell in this column.
       *  @type string
       *  @default <i>Empty string</i>
       *
       *  @name DataTable.defaults.column.class
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "class": "my_class", "targets": [ 0 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "class": "my_class" },
       *          null,
       *          null,
       *          null,
       *          null
       *        ]
       *      } );
       *    } );
       */
      "sClass": "",
      /**
       * When DataTables calculates the column widths to assign to each column,
       * it finds the longest string in each column and then constructs a
       * temporary table and reads the widths from that. The problem with this
       * is that "mmm" is much wider then "iiii", but the latter is a longer
       * string - thus the calculation can go wrong (doing it properly and putting
       * it into an DOM object and measuring that is horribly(!) slow). Thus as
       * a "work around" we provide this option. It will append its value to the
       * text that is found to be the longest string for the column - i.e. padding.
       * Generally you shouldn't need this!
       *  @type string
       *  @default <i>Empty string<i>
       *
       *  @name DataTable.defaults.column.contentPadding
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          null,
       *          null,
       *          null,
       *          {
       *            "contentPadding": "mmm"
       *          }
       *        ]
       *      } );
       *    } );
       */
      "sContentPadding": "",
      /**
       * Allows a default value to be given for a column's data, and will be used
       * whenever a null data source is encountered (this can be because `data`
       * is set to null, or because the data source itself is null).
       *  @type string
       *  @default null
       *
       *  @name DataTable.defaults.column.defaultContent
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          {
       *            "data": null,
       *            "defaultContent": "Edit",
       *            "targets": [ -1 ]
       *          }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          null,
       *          null,
       *          null,
       *          {
       *            "data": null,
       *            "defaultContent": "Edit"
       *          }
       *        ]
       *      } );
       *    } );
       */
      "sDefaultContent": null,
      /**
       * This parameter is only used in DataTables' server-side processing. It can
       * be exceptionally useful to know what columns are being displayed on the
       * client side, and to map these to database fields. When defined, the names
       * also allow DataTables to reorder information from the server if it comes
       * back in an unexpected order (i.e. if you switch your columns around on the
       * client-side, your server-side code does not also need updating).
       *  @type string
       *  @default <i>Empty string</i>
       *
       *  @name DataTable.defaults.column.name
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "name": "engine", "targets": [ 0 ] },
       *          { "name": "browser", "targets": [ 1 ] },
       *          { "name": "platform", "targets": [ 2 ] },
       *          { "name": "version", "targets": [ 3 ] },
       *          { "name": "grade", "targets": [ 4 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "name": "engine" },
       *          { "name": "browser" },
       *          { "name": "platform" },
       *          { "name": "version" },
       *          { "name": "grade" }
       *        ]
       *      } );
       *    } );
       */
      "sName": "",
      /**
       * Defines a data source type for the ordering which can be used to read
       * real-time information from the table (updating the internally cached
       * version) prior to ordering. This allows ordering to occur on user
       * editable elements such as form inputs.
       *  @type string
       *  @default std
       *
       *  @name DataTable.defaults.column.orderDataType
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "orderDataType": "dom-text", "targets": [ 2, 3 ] },
       *          { "type": "numeric", "targets": [ 3 ] },
       *          { "orderDataType": "dom-select", "targets": [ 4 ] },
       *          { "orderDataType": "dom-checkbox", "targets": [ 5 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          null,
       *          null,
       *          { "orderDataType": "dom-text" },
       *          { "orderDataType": "dom-text", "type": "numeric" },
       *          { "orderDataType": "dom-select" },
       *          { "orderDataType": "dom-checkbox" }
       *        ]
       *      } );
       *    } );
       */
      "sSortDataType": "std",
      /**
       * The title of this column.
       *  @type string
       *  @default null <i>Derived from the 'TH' value for this column in the
       *    original HTML table.</i>
       *
       *  @name DataTable.defaults.column.title
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "title": "My column title", "targets": [ 0 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "title": "My column title" },
       *          null,
       *          null,
       *          null,
       *          null
       *        ]
       *      } );
       *    } );
       */
      "sTitle": null,
      /**
       * The type allows you to specify how the data for this column will be
       * ordered. Four types (string, numeric, date and html (which will strip
       * HTML tags before ordering)) are currently available. Note that only date
       * formats understood by Javascript's Date() object will be accepted as type
       * date. For example: "Mar 26, 2008 5:03 PM". May take the values: 'string',
       * 'numeric', 'date' or 'html' (by default). Further types can be adding
       * through plug-ins.
       *  @type string
       *  @default null <i>Auto-detected from raw data</i>
       *
       *  @name DataTable.defaults.column.type
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "type": "html", "targets": [ 0 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "type": "html" },
       *          null,
       *          null,
       *          null,
       *          null
       *        ]
       *      } );
       *    } );
       */
      "sType": null,
      /**
       * Defining the width of the column, this parameter may take any CSS value
       * (3em, 20px etc). DataTables applies 'smart' widths to columns which have not
       * been given a specific width through this interface ensuring that the table
       * remains readable.
       *  @type string
       *  @default null <i>Automatic</i>
       *
       *  @name DataTable.defaults.column.width
       *  @dtopt Columns
       *
       *  @example
       *    // Using `columnDefs`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columnDefs": [
       *          { "width": "20%", "targets": [ 0 ] }
       *        ]
       *      } );
       *    } );
       *
       *  @example
       *    // Using `columns`
       *    $(document).ready( function() {
       *      $('#example').dataTable( {
       *        "columns": [
       *          { "width": "20%" },
       *          null,
       *          null,
       *          null,
       *          null
       *        ]
       *      } );
       *    } );
       */
      "sWidth": null
    };
    _fnHungarianMap(DataTable.defaults.column);
    DataTable.models.oSettings = {
      /**
       * Primary features of DataTables and their enablement state.
       *  @namespace
       */
      "oFeatures": {
        /**
         * Flag to say if DataTables should automatically try to calculate the
         * optimum table and columns widths (true) or not (false).
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bAutoWidth": null,
        /**
         * Delay the creation of TR and TD elements until they are actually
         * needed by a driven page draw. This can give a significant speed
         * increase for Ajax source and Javascript source data, but makes no
         * difference at all for DOM and server-side processing tables.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bDeferRender": null,
        /**
         * Enable filtering on the table or not. Note that if this is disabled
         * then there is no filtering at all on the table, including fnFilter.
         * To just remove the filtering input use sDom and remove the 'f' option.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bFilter": null,
        /**
         * Table information element (the 'Showing x of y records' div) enable
         * flag.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bInfo": null,
        /**
         * Present a user control allowing the end user to change the page size
         * when pagination is enabled.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bLengthChange": null,
        /**
         * Pagination enabled or not. Note that if this is disabled then length
         * changing must also be disabled.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bPaginate": null,
        /**
         * Processing indicator enable flag whenever DataTables is enacting a
         * user request - typically an Ajax request for server-side processing.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bProcessing": null,
        /**
         * Server-side processing enabled flag - when enabled DataTables will
         * get all data from the server for every draw - there is no filtering,
         * sorting or paging done on the client-side.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bServerSide": null,
        /**
         * Sorting enablement flag.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bSort": null,
        /**
         * Multi-column sorting
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bSortMulti": null,
        /**
         * Apply a class to the columns which are being sorted to provide a
         * visual highlight or not. This can slow things down when enabled since
         * there is a lot of DOM interaction.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bSortClasses": null,
        /**
         * State saving enablement flag.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bStateSave": null
      },
      /**
       * Scrolling settings for a table.
       *  @namespace
       */
      "oScroll": {
        /**
         * When the table is shorter in height than sScrollY, collapse the
         * table container down to the height of the table (when true).
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type boolean
         */
        "bCollapse": null,
        /**
         * Width of the scrollbar for the web-browser's platform. Calculated
         * during table initialisation.
         *  @type int
         *  @default 0
         */
        "iBarWidth": 0,
        /**
         * Viewport width for horizontal scrolling. Horizontal scrolling is
         * disabled if an empty string.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type string
         */
        "sX": null,
        /**
         * Width to expand the table to when using x-scrolling. Typically you
         * should not need to use this.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type string
         *  @deprecated
         */
        "sXInner": null,
        /**
         * Viewport height for vertical scrolling. Vertical scrolling is disabled
         * if an empty string.
         * Note that this parameter will be set by the initialisation routine. To
         * set a default use {@link DataTable.defaults}.
         *  @type string
         */
        "sY": null
      },
      /**
       * Language information for the table.
       *  @namespace
       *  @extends DataTable.defaults.oLanguage
       */
      "oLanguage": {
        /**
         * Information callback function. See
         * {@link DataTable.defaults.fnInfoCallback}
         *  @type function
         *  @default null
         */
        "fnInfoCallback": null
      },
      /**
       * Browser support parameters
       *  @namespace
       */
      "oBrowser": {
        /**
         * Indicate if the browser incorrectly calculates width:100% inside a
         * scrolling element (IE6/7)
         *  @type boolean
         *  @default false
         */
        "bScrollOversize": false,
        /**
         * Determine if the vertical scrollbar is on the right or left of the
         * scrolling container - needed for rtl language layout, although not
         * all browsers move the scrollbar (Safari).
         *  @type boolean
         *  @default false
         */
        "bScrollbarLeft": false,
        /**
         * Flag for if `getBoundingClientRect` is fully supported or not
         *  @type boolean
         *  @default false
         */
        "bBounding": false,
        /**
         * Browser scrollbar width
         *  @type integer
         *  @default 0
         */
        "barWidth": 0
      },
      "ajax": null,
      /**
       * Array referencing the nodes which are used for the features. The
       * parameters of this object match what is allowed by sDom - i.e.
       *   <ul>
       *     <li>'l' - Length changing</li>
       *     <li>'f' - Filtering input</li>
       *     <li>'t' - The table!</li>
       *     <li>'i' - Information</li>
       *     <li>'p' - Pagination</li>
       *     <li>'r' - pRocessing</li>
       *   </ul>
       *  @type array
       *  @default []
       */
      "aanFeatures": [],
      /**
       * Store data information - see {@link DataTable.models.oRow} for detailed
       * information.
       *  @type array
       *  @default []
       */
      "aoData": [],
      /**
       * Array of indexes which are in the current display (after filtering etc)
       *  @type array
       *  @default []
       */
      "aiDisplay": [],
      /**
       * Array of indexes for display - no filtering
       *  @type array
       *  @default []
       */
      "aiDisplayMaster": [],
      /**
       * Map of row ids to data indexes
       *  @type object
       *  @default {}
       */
      "aIds": {},
      /**
       * Store information about each column that is in use
       *  @type array
       *  @default []
       */
      "aoColumns": [],
      /**
       * Store information about the table's header
       *  @type array
       *  @default []
       */
      "aoHeader": [],
      /**
       * Store information about the table's footer
       *  @type array
       *  @default []
       */
      "aoFooter": [],
      /**
       * Store the applied global search information in case we want to force a
       * research or compare the old search to a new one.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @namespace
       *  @extends DataTable.models.oSearch
       */
      "oPreviousSearch": {},
      /**
       * Store the applied search for each column - see
       * {@link DataTable.models.oSearch} for the format that is used for the
       * filtering information for each column.
       *  @type array
       *  @default []
       */
      "aoPreSearchCols": [],
      /**
       * Sorting that is applied to the table. Note that the inner arrays are
       * used in the following manner:
       * <ul>
       *   <li>Index 0 - column number</li>
       *   <li>Index 1 - current sorting direction</li>
       * </ul>
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type array
       *  @todo These inner arrays should really be objects
       */
      "aaSorting": null,
      /**
       * Sorting that is always applied to the table (i.e. prefixed in front of
       * aaSorting).
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type array
       *  @default []
       */
      "aaSortingFixed": [],
      /**
       * Classes to use for the striping of a table.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type array
       *  @default []
       */
      "asStripeClasses": null,
      /**
       * If restoring a table - we should restore its striping classes as well
       *  @type array
       *  @default []
       */
      "asDestroyStripes": [],
      /**
       * If restoring a table - we should restore its width
       *  @type int
       *  @default 0
       */
      "sDestroyWidth": 0,
      /**
       * Callback functions array for every time a row is inserted (i.e. on a draw).
       *  @type array
       *  @default []
       */
      "aoRowCallback": [],
      /**
       * Callback functions for the header on each draw.
       *  @type array
       *  @default []
       */
      "aoHeaderCallback": [],
      /**
       * Callback function for the footer on each draw.
       *  @type array
       *  @default []
       */
      "aoFooterCallback": [],
      /**
       * Array of callback functions for draw callback functions
       *  @type array
       *  @default []
       */
      "aoDrawCallback": [],
      /**
       * Array of callback functions for row created function
       *  @type array
       *  @default []
       */
      "aoRowCreatedCallback": [],
      /**
       * Callback functions for just before the table is redrawn. A return of
       * false will be used to cancel the draw.
       *  @type array
       *  @default []
       */
      "aoPreDrawCallback": [],
      /**
       * Callback functions for when the table has been initialised.
       *  @type array
       *  @default []
       */
      "aoInitComplete": [],
      /**
       * Callbacks for modifying the settings to be stored for state saving, prior to
       * saving state.
       *  @type array
       *  @default []
       */
      "aoStateSaveParams": [],
      /**
       * Callbacks for modifying the settings that have been stored for state saving
       * prior to using the stored values to restore the state.
       *  @type array
       *  @default []
       */
      "aoStateLoadParams": [],
      /**
       * Callbacks for operating on the settings object once the saved state has been
       * loaded
       *  @type array
       *  @default []
       */
      "aoStateLoaded": [],
      /**
       * Cache the table ID for quick access
       *  @type string
       *  @default <i>Empty string</i>
       */
      "sTableId": "",
      /**
       * The TABLE node for the main table
       *  @type node
       *  @default null
       */
      "nTable": null,
      /**
       * Permanent ref to the thead element
       *  @type node
       *  @default null
       */
      "nTHead": null,
      /**
       * Permanent ref to the tfoot element - if it exists
       *  @type node
       *  @default null
       */
      "nTFoot": null,
      /**
       * Permanent ref to the tbody element
       *  @type node
       *  @default null
       */
      "nTBody": null,
      /**
       * Cache the wrapper node (contains all DataTables controlled elements)
       *  @type node
       *  @default null
       */
      "nTableWrapper": null,
      /**
       * Indicate if when using server-side processing the loading of data
       * should be deferred until the second draw.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type boolean
       *  @default false
       */
      "bDeferLoading": false,
      /**
       * Indicate if all required information has been read in
       *  @type boolean
       *  @default false
       */
      "bInitialised": false,
      /**
       * Information about open rows. Each object in the array has the parameters
       * 'nTr' and 'nParent'
       *  @type array
       *  @default []
       */
      "aoOpenRows": [],
      /**
       * Dictate the positioning of DataTables' control elements - see
       * {@link DataTable.model.oInit.sDom}.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type string
       *  @default null
       */
      "sDom": null,
      /**
       * Search delay (in mS)
       *  @type integer
       *  @default null
       */
      "searchDelay": null,
      /**
       * Which type of pagination should be used.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type string
       *  @default two_button
       */
      "sPaginationType": "two_button",
      /**
       * The state duration (for `stateSave`) in seconds.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type int
       *  @default 0
       */
      "iStateDuration": 0,
      /**
       * Array of callback functions for state saving. Each array element is an
       * object with the following parameters:
       *   <ul>
       *     <li>function:fn - function to call. Takes two parameters, oSettings
       *       and the JSON string to save that has been thus far created. Returns
       *       a JSON string to be inserted into a json object
       *       (i.e. '"param": [ 0, 1, 2]')</li>
       *     <li>string:sName - name of callback</li>
       *   </ul>
       *  @type array
       *  @default []
       */
      "aoStateSave": [],
      /**
       * Array of callback functions for state loading. Each array element is an
       * object with the following parameters:
       *   <ul>
       *     <li>function:fn - function to call. Takes two parameters, oSettings
       *       and the object stored. May return false to cancel state loading</li>
       *     <li>string:sName - name of callback</li>
       *   </ul>
       *  @type array
       *  @default []
       */
      "aoStateLoad": [],
      /**
       * State that was saved. Useful for back reference
       *  @type object
       *  @default null
       */
      "oSavedState": null,
      /**
       * State that was loaded. Useful for back reference
       *  @type object
       *  @default null
       */
      "oLoadedState": null,
      /**
       * Source url for AJAX data for the table.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type string
       *  @default null
       */
      "sAjaxSource": null,
      /**
       * Property from a given object from which to read the table data from. This
       * can be an empty string (when not server-side processing), in which case
       * it is  assumed an an array is given directly.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type string
       */
      "sAjaxDataProp": null,
      /**
       * The last jQuery XHR object that was used for server-side data gathering.
       * This can be used for working with the XHR information in one of the
       * callbacks
       *  @type object
       *  @default null
       */
      "jqXHR": null,
      /**
       * JSON returned from the server in the last Ajax request
       *  @type object
       *  @default undefined
       */
      "json": void 0,
      /**
       * Data submitted as part of the last Ajax request
       *  @type object
       *  @default undefined
       */
      "oAjaxData": void 0,
      /**
       * Function to get the server-side data.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type function
       */
      "fnServerData": null,
      /**
       * Functions which are called prior to sending an Ajax request so extra
       * parameters can easily be sent to the server
       *  @type array
       *  @default []
       */
      "aoServerParams": [],
      /**
       * Send the XHR HTTP method - GET or POST (could be PUT or DELETE if
       * required).
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type string
       */
      "sServerMethod": null,
      /**
       * Format numbers for display.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type function
       */
      "fnFormatNumber": null,
      /**
       * List of options that can be used for the user selectable length menu.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type array
       *  @default []
       */
      "aLengthMenu": null,
      /**
       * Counter for the draws that the table does. Also used as a tracker for
       * server-side processing
       *  @type int
       *  @default 0
       */
      "iDraw": 0,
      /**
       * Indicate if a redraw is being done - useful for Ajax
       *  @type boolean
       *  @default false
       */
      "bDrawing": false,
      /**
       * Draw index (iDraw) of the last error when parsing the returned data
       *  @type int
       *  @default -1
       */
      "iDrawError": -1,
      /**
       * Paging display length
       *  @type int
       *  @default 10
       */
      "_iDisplayLength": 10,
      /**
       * Paging start point - aiDisplay index
       *  @type int
       *  @default 0
       */
      "_iDisplayStart": 0,
      /**
       * Server-side processing - number of records in the result set
       * (i.e. before filtering), Use fnRecordsTotal rather than
       * this property to get the value of the number of records, regardless of
       * the server-side processing setting.
       *  @type int
       *  @default 0
       *  @private
       */
      "_iRecordsTotal": 0,
      /**
       * Server-side processing - number of records in the current display set
       * (i.e. after filtering). Use fnRecordsDisplay rather than
       * this property to get the value of the number of records, regardless of
       * the server-side processing setting.
       *  @type boolean
       *  @default 0
       *  @private
       */
      "_iRecordsDisplay": 0,
      /**
       * The classes to use for the table
       *  @type object
       *  @default {}
       */
      "oClasses": {},
      /**
       * Flag attached to the settings object so you can check in the draw
       * callback if filtering has been done in the draw. Deprecated in favour of
       * events.
       *  @type boolean
       *  @default false
       *  @deprecated
       */
      "bFiltered": false,
      /**
       * Flag attached to the settings object so you can check in the draw
       * callback if sorting has been done in the draw. Deprecated in favour of
       * events.
       *  @type boolean
       *  @default false
       *  @deprecated
       */
      "bSorted": false,
      /**
       * Indicate that if multiple rows are in the header and there is more than
       * one unique cell per column, if the top one (true) or bottom one (false)
       * should be used for sorting / title by DataTables.
       * Note that this parameter will be set by the initialisation routine. To
       * set a default use {@link DataTable.defaults}.
       *  @type boolean
       */
      "bSortCellsTop": null,
      /**
       * Initialisation object that is used for the table
       *  @type object
       *  @default null
       */
      "oInit": null,
      /**
       * Destroy callback functions - for plug-ins to attach themselves to the
       * destroy so they can clean up markup and events.
       *  @type array
       *  @default []
       */
      "aoDestroyCallback": [],
      /**
       * Get the number of records in the current record set, before filtering
       *  @type function
       */
      "fnRecordsTotal": function() {
        return _fnDataSource(this) == "ssp" ? this._iRecordsTotal * 1 : this.aiDisplayMaster.length;
      },
      /**
       * Get the number of records in the current record set, after filtering
       *  @type function
       */
      "fnRecordsDisplay": function() {
        return _fnDataSource(this) == "ssp" ? this._iRecordsDisplay * 1 : this.aiDisplay.length;
      },
      /**
       * Get the display end point - aiDisplay index
       *  @type function
       */
      "fnDisplayEnd": function() {
        var len = this._iDisplayLength, start = this._iDisplayStart, calc = start + len, records = this.aiDisplay.length, features = this.oFeatures, paginate = features.bPaginate;
        if (features.bServerSide) {
          return paginate === false || len === -1 ? start + records : Math.min(start + len, this._iRecordsDisplay);
        } else {
          return !paginate || calc > records || len === -1 ? records : calc;
        }
      },
      /**
       * The DataTables object for this table
       *  @type object
       *  @default null
       */
      "oInstance": null,
      /**
       * Unique identifier for each instance of the DataTables object. If there
       * is an ID on the table node, then it takes that value, otherwise an
       * incrementing internal counter is used.
       *  @type string
       *  @default null
       */
      "sInstance": null,
      /**
       * tabindex attribute value that is added to DataTables control elements, allowing
       * keyboard navigation of the table and its controls.
       */
      "iTabIndex": 0,
      /**
       * DIV container for the footer scrolling table if scrolling
       */
      "nScrollHead": null,
      /**
       * DIV container for the footer scrolling table if scrolling
       */
      "nScrollFoot": null,
      /**
       * Last applied sort
       *  @type array
       *  @default []
       */
      "aLastSort": [],
      /**
       * Stored plug-in instances
       *  @type object
       *  @default {}
       */
      "oPlugins": {},
      /**
       * Function used to get a row's id from the row's data
       *  @type function
       *  @default null
       */
      "rowIdFn": null,
      /**
       * Data location where to store a row's id
       *  @type string
       *  @default null
       */
      "rowId": null
    };
    DataTable.ext = _ext = {
      /**
       * Buttons. For use with the Buttons extension for DataTables. This is
       * defined here so other extensions can define buttons regardless of load
       * order. It is _not_ used by DataTables core.
       *
       *  @type object
       *  @default {}
       */
      buttons: {},
      /**
       * Element class names
       *
       *  @type object
       *  @default {}
       */
      classes: {},
      /**
       * DataTables build type (expanded by the download builder)
       *
       *  @type string
       */
      builder: "-source-",
      /**
       * Error reporting.
       * 
       * How should DataTables report an error. Can take the value 'alert',
       * 'throw', 'none' or a function.
       *
       *  @type string|function
       *  @default alert
       */
      errMode: "alert",
      /**
       * Feature plug-ins.
       * 
       * This is an array of objects which describe the feature plug-ins that are
       * available to DataTables. These feature plug-ins are then available for
       * use through the `dom` initialisation option.
       * 
       * Each feature plug-in is described by an object which must have the
       * following properties:
       * 
       * * `fnInit` - function that is used to initialise the plug-in,
       * * `cFeature` - a character so the feature can be enabled by the `dom`
       *   instillation option. This is case sensitive.
       *
       * The `fnInit` function has the following input parameters:
       *
       * 1. `{object}` DataTables settings object: see
       *    {@link DataTable.models.oSettings}
       *
       * And the following return is expected:
       * 
       * * {node|null} The element which contains your feature. Note that the
       *   return may also be void if your plug-in does not require to inject any
       *   DOM elements into DataTables control (`dom`) - for example this might
       *   be useful when developing a plug-in which allows table control via
       *   keyboard entry
       *
       *  @type array
       *
       *  @example
       *    $.fn.dataTable.ext.features.push( {
       *      "fnInit": function( oSettings ) {
       *        return new TableTools( { "oDTSettings": oSettings } );
       *      },
       *      "cFeature": "T"
       *    } );
       */
      feature: [],
      /**
       * Row searching.
       * 
       * This method of searching is complimentary to the default type based
       * searching, and a lot more comprehensive as it allows you complete control
       * over the searching logic. Each element in this array is a function
       * (parameters described below) that is called for every row in the table,
       * and your logic decides if it should be included in the searching data set
       * or not.
       *
       * Searching functions have the following input parameters:
       *
       * 1. `{object}` DataTables settings object: see
       *    {@link DataTable.models.oSettings}
       * 2. `{array|object}` Data for the row to be processed (same as the
       *    original format that was passed in as the data source, or an array
       *    from a DOM data source
       * 3. `{int}` Row index ({@link DataTable.models.oSettings.aoData}), which
       *    can be useful to retrieve the `TR` element if you need DOM interaction.
       *
       * And the following return is expected:
       *
       * * {boolean} Include the row in the searched result set (true) or not
       *   (false)
       *
       * Note that as with the main search ability in DataTables, technically this
       * is "filtering", since it is subtractive. However, for consistency in
       * naming we call it searching here.
       *
       *  @type array
       *  @default []
       *
       *  @example
       *    // The following example shows custom search being applied to the
       *    // fourth column (i.e. the data[3] index) based on two input values
       *    // from the end-user, matching the data in a certain range.
       *    $.fn.dataTable.ext.search.push(
       *      function( settings, data, dataIndex ) {
       *        var min = document.getElementById('min').value * 1;
       *        var max = document.getElementById('max').value * 1;
       *        var version = data[3] == "-" ? 0 : data[3]*1;
       *
       *        if ( min == "" && max == "" ) {
       *          return true;
       *        }
       *        else if ( min == "" && version < max ) {
       *          return true;
       *        }
       *        else if ( min < version && "" == max ) {
       *          return true;
       *        }
       *        else if ( min < version && version < max ) {
       *          return true;
       *        }
       *        return false;
       *      }
       *    );
       */
      search: [],
      /**
       * Selector extensions
       *
       * The `selector` option can be used to extend the options available for the
       * selector modifier options (`selector-modifier` object data type) that
       * each of the three built in selector types offer (row, column and cell +
       * their plural counterparts). For example the Select extension uses this
       * mechanism to provide an option to select only rows, columns and cells
       * that have been marked as selected by the end user (`{selected: true}`),
       * which can be used in conjunction with the existing built in selector
       * options.
       *
       * Each property is an array to which functions can be pushed. The functions
       * take three attributes:
       *
       * * Settings object for the host table
       * * Options object (`selector-modifier` object type)
       * * Array of selected item indexes
       *
       * The return is an array of the resulting item indexes after the custom
       * selector has been applied.
       *
       *  @type object
       */
      selector: {
        cell: [],
        column: [],
        row: []
      },
      /**
       * Internal functions, exposed for used in plug-ins.
       * 
       * Please note that you should not need to use the internal methods for
       * anything other than a plug-in (and even then, try to avoid if possible).
       * The internal function may change between releases.
       *
       *  @type object
       *  @default {}
       */
      internal: {},
      /**
       * Legacy configuration options. Enable and disable legacy options that
       * are available in DataTables.
       *
       *  @type object
       */
      legacy: {
        /**
         * Enable / disable DataTables 1.9 compatible server-side processing
         * requests
         *
         *  @type boolean
         *  @default null
         */
        ajax: null
      },
      /**
       * Pagination plug-in methods.
       * 
       * Each entry in this object is a function and defines which buttons should
       * be shown by the pagination rendering method that is used for the table:
       * {@link DataTable.ext.renderer.pageButton}. The renderer addresses how the
       * buttons are displayed in the document, while the functions here tell it
       * what buttons to display. This is done by returning an array of button
       * descriptions (what each button will do).
       *
       * Pagination types (the four built in options and any additional plug-in
       * options defined here) can be used through the `paginationType`
       * initialisation parameter.
       *
       * The functions defined take two parameters:
       *
       * 1. `{int} page` The current page index
       * 2. `{int} pages` The number of pages in the table
       *
       * Each function is expected to return an array where each element of the
       * array can be one of:
       *
       * * `first` - Jump to first page when activated
       * * `last` - Jump to last page when activated
       * * `previous` - Show previous page when activated
       * * `next` - Show next page when activated
       * * `{int}` - Show page of the index given
       * * `{array}` - A nested array containing the above elements to add a
       *   containing 'DIV' element (might be useful for styling).
       *
       * Note that DataTables v1.9- used this object slightly differently whereby
       * an object with two functions would be defined for each plug-in. That
       * ability is still supported by DataTables 1.10+ to provide backwards
       * compatibility, but this option of use is now decremented and no longer
       * documented in DataTables 1.10+.
       *
       *  @type object
       *  @default {}
       *
       *  @example
       *    // Show previous, next and current page buttons only
       *    $.fn.dataTableExt.oPagination.current = function ( page, pages ) {
       *      return [ 'previous', page, 'next' ];
       *    };
       */
      pager: {},
      renderer: {
        pageButton: {},
        header: {}
      },
      /**
       * Ordering plug-ins - custom data source
       * 
       * The extension options for ordering of data available here is complimentary
       * to the default type based ordering that DataTables typically uses. It
       * allows much greater control over the the data that is being used to
       * order a column, but is necessarily therefore more complex.
       * 
       * This type of ordering is useful if you want to do ordering based on data
       * live from the DOM (for example the contents of an 'input' element) rather
       * than just the static string that DataTables knows of.
       * 
       * The way these plug-ins work is that you create an array of the values you
       * wish to be ordering for the column in question and then return that
       * array. The data in the array much be in the index order of the rows in
       * the table (not the currently ordering order!). Which order data gathering
       * function is run here depends on the `dt-init columns.orderDataType`
       * parameter that is used for the column (if any).
       *
       * The functions defined take two parameters:
       *
       * 1. `{object}` DataTables settings object: see
       *    {@link DataTable.models.oSettings}
       * 2. `{int}` Target column index
       *
       * Each function is expected to return an array:
       *
       * * `{array}` Data for the column to be ordering upon
       *
       *  @type array
       *
       *  @example
       *    // Ordering using `input` node values
       *    $.fn.dataTable.ext.order['dom-text'] = function  ( settings, col )
       *    {
       *      return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
       *        return $('input', td).val();
       *      } );
       *    }
       */
      order: {},
      /**
       * Type based plug-ins.
       *
       * Each column in DataTables has a type assigned to it, either by automatic
       * detection or by direct assignment using the `type` option for the column.
       * The type of a column will effect how it is ordering and search (plug-ins
       * can also make use of the column type if required).
       *
       * @namespace
       */
      type: {
        /**
         * Type detection functions.
         *
         * The functions defined in this object are used to automatically detect
         * a column's type, making initialisation of DataTables super easy, even
         * when complex data is in the table.
         *
         * The functions defined take two parameters:
         *
            *  1. `{*}` Data from the column cell to be analysed
            *  2. `{settings}` DataTables settings object. This can be used to
            *     perform context specific type detection - for example detection
            *     based on language settings such as using a comma for a decimal
            *     place. Generally speaking the options from the settings will not
            *     be required
         *
         * Each function is expected to return:
         *
         * * `{string|null}` Data type detected, or null if unknown (and thus
         *   pass it on to the other type detection functions.
         *
         *  @type array
         *
         *  @example
         *    // Currency type detection plug-in:
         *    $.fn.dataTable.ext.type.detect.push(
         *      function ( data, settings ) {
         *        // Check the numeric part
         *        if ( ! data.substring(1).match(/[0-9]/) ) {
         *          return null;
         *        }
         *
         *        // Check prefixed by currency
         *        if ( data.charAt(0) == '$' || data.charAt(0) == '&pound;' ) {
         *          return 'currency';
         *        }
         *        return null;
         *      }
         *    );
         */
        detect: [],
        /**
         * Type based search formatting.
         *
         * The type based searching functions can be used to pre-format the
         * data to be search on. For example, it can be used to strip HTML
         * tags or to de-format telephone numbers for numeric only searching.
         *
         * Note that is a search is not defined for a column of a given type,
         * no search formatting will be performed.
         * 
         * Pre-processing of searching data plug-ins - When you assign the sType
         * for a column (or have it automatically detected for you by DataTables
         * or a type detection plug-in), you will typically be using this for
         * custom sorting, but it can also be used to provide custom searching
         * by allowing you to pre-processing the data and returning the data in
         * the format that should be searched upon. This is done by adding
         * functions this object with a parameter name which matches the sType
         * for that target column. This is the corollary of <i>afnSortData</i>
         * for searching data.
         *
         * The functions defined take a single parameter:
         *
            *  1. `{*}` Data from the column cell to be prepared for searching
         *
         * Each function is expected to return:
         *
         * * `{string|null}` Formatted string that will be used for the searching.
         *
         *  @type object
         *  @default {}
         *
         *  @example
         *    $.fn.dataTable.ext.type.search['title-numeric'] = function ( d ) {
         *      return d.replace(/\n/g," ").replace( /<.*?>/g, "" );
         *    }
         */
        search: {},
        /**
         * Type based ordering.
         *
         * The column type tells DataTables what ordering to apply to the table
         * when a column is sorted upon. The order for each type that is defined,
         * is defined by the functions available in this object.
         *
         * Each ordering option can be described by three properties added to
         * this object:
         *
         * * `{type}-pre` - Pre-formatting function
         * * `{type}-asc` - Ascending order function
         * * `{type}-desc` - Descending order function
         *
         * All three can be used together, only `{type}-pre` or only
         * `{type}-asc` and `{type}-desc` together. It is generally recommended
         * that only `{type}-pre` is used, as this provides the optimal
         * implementation in terms of speed, although the others are provided
         * for compatibility with existing Javascript sort functions.
         *
         * `{type}-pre`: Functions defined take a single parameter:
         *
            *  1. `{*}` Data from the column cell to be prepared for ordering
         *
         * And return:
         *
         * * `{*}` Data to be sorted upon
         *
         * `{type}-asc` and `{type}-desc`: Functions are typical Javascript sort
         * functions, taking two parameters:
         *
            *  1. `{*}` Data to compare to the second parameter
            *  2. `{*}` Data to compare to the first parameter
         *
         * And returning:
         *
         * * `{*}` Ordering match: <0 if first parameter should be sorted lower
         *   than the second parameter, ===0 if the two parameters are equal and
         *   >0 if the first parameter should be sorted height than the second
         *   parameter.
         * 
         *  @type object
         *  @default {}
         *
         *  @example
         *    // Numeric ordering of formatted numbers with a pre-formatter
         *    $.extend( $.fn.dataTable.ext.type.order, {
         *      "string-pre": function(x) {
         *        a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
         *        return parseFloat( a );
         *      }
         *    } );
         *
         *  @example
         *    // Case-sensitive string ordering, with no pre-formatting method
         *    $.extend( $.fn.dataTable.ext.order, {
         *      "string-case-asc": function(x,y) {
         *        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
         *      },
         *      "string-case-desc": function(x,y) {
         *        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
         *      }
         *    } );
         */
        order: {}
      },
      /**
       * Unique DataTables instance counter
       *
       * @type int
       * @private
       */
      _unique: 0,
      //
      // Depreciated
      // The following properties are retained for backwards compatibility only.
      // The should not be used in new projects and will be removed in a future
      // version
      //
      /**
       * Version check function.
       *  @type function
       *  @depreciated Since 1.10
       */
      fnVersionCheck: DataTable.fnVersionCheck,
      /**
       * Index for what 'this' index API functions should use
       *  @type int
       *  @deprecated Since v1.10
       */
      iApiIndex: 0,
      /**
       * jQuery UI class container
       *  @type object
       *  @deprecated Since v1.10
       */
      oJUIClasses: {},
      /**
       * Software version
       *  @type string
       *  @deprecated Since v1.10
       */
      sVersion: DataTable.version
    };
    $.extend(_ext, {
      afnFiltering: _ext.search,
      aTypes: _ext.type.detect,
      ofnSearch: _ext.type.search,
      oSort: _ext.type.order,
      afnSortData: _ext.order,
      aoFeatures: _ext.feature,
      oApi: _ext.internal,
      oStdClasses: _ext.classes,
      oPagination: _ext.pager
    });
    $.extend(DataTable.ext.classes, {
      "sTable": "dataTable",
      "sNoFooter": "no-footer",
      /* Paging buttons */
      "sPageButton": "paginate_button",
      "sPageButtonActive": "current",
      "sPageButtonDisabled": "disabled",
      /* Striping classes */
      "sStripeOdd": "odd",
      "sStripeEven": "even",
      /* Empty row */
      "sRowEmpty": "dataTables_empty",
      /* Features */
      "sWrapper": "dataTables_wrapper",
      "sFilter": "dataTables_filter",
      "sInfo": "dataTables_info",
      "sPaging": "dataTables_paginate paging_",
      /* Note that the type is postfixed */
      "sLength": "dataTables_length",
      "sProcessing": "dataTables_processing",
      /* Sorting */
      "sSortAsc": "sorting_asc",
      "sSortDesc": "sorting_desc",
      "sSortable": "sorting",
      /* Sortable in both directions */
      "sSortableAsc": "sorting_desc_disabled",
      "sSortableDesc": "sorting_asc_disabled",
      "sSortableNone": "sorting_disabled",
      "sSortColumn": "sorting_",
      /* Note that an int is postfixed for the sorting order */
      /* Filtering */
      "sFilterInput": "",
      /* Page length */
      "sLengthSelect": "",
      /* Scrolling */
      "sScrollWrapper": "dataTables_scroll",
      "sScrollHead": "dataTables_scrollHead",
      "sScrollHeadInner": "dataTables_scrollHeadInner",
      "sScrollBody": "dataTables_scrollBody",
      "sScrollFoot": "dataTables_scrollFoot",
      "sScrollFootInner": "dataTables_scrollFootInner",
      /* Misc */
      "sHeaderTH": "",
      "sFooterTH": "",
      // Deprecated
      "sSortJUIAsc": "",
      "sSortJUIDesc": "",
      "sSortJUI": "",
      "sSortJUIAscAllowed": "",
      "sSortJUIDescAllowed": "",
      "sSortJUIWrapper": "",
      "sSortIcon": "",
      "sJUIHeader": "",
      "sJUIFooter": ""
    });
    extPagination = DataTable.ext.pager;
    $.extend(extPagination, {
      simple: function(page, pages) {
        return ["previous", "next"];
      },
      full: function(page, pages) {
        return ["first", "previous", "next", "last"];
      },
      numbers: function(page, pages) {
        return [_numbers(page, pages)];
      },
      simple_numbers: function(page, pages) {
        return ["previous", _numbers(page, pages), "next"];
      },
      full_numbers: function(page, pages) {
        return ["first", "previous", _numbers(page, pages), "next", "last"];
      },
      first_last_numbers: function(page, pages) {
        return ["first", _numbers(page, pages), "last"];
      },
      // For testing and plug-ins to use
      _numbers,
      // Number of number buttons (including ellipsis) to show. _Must be odd!_
      numbers_length: 7
    });
    $.extend(true, DataTable.ext.renderer, {
      pageButton: {
        _: function(settings, host, idx, buttons, page, pages) {
          var classes = settings.oClasses;
          var lang = settings.oLanguage.oPaginate;
          var aria = settings.oLanguage.oAria.paginate || {};
          var btnDisplay, btnClass;
          var attach = function(container, buttons2) {
            var i, ien, node, button;
            var disabledClass = classes.sPageButtonDisabled;
            var clickHandler = function(e) {
              _fnPageChange(settings, e.data.action, true);
            };
            for (i = 0, ien = buttons2.length; i < ien; i++) {
              button = buttons2[i];
              if (Array.isArray(button)) {
                var inner = $("<" + (button.DT_el || "div") + "/>").appendTo(container);
                attach(inner, button);
              } else {
                var disabled = false;
                btnDisplay = null;
                btnClass = button;
                switch (button) {
                  case "ellipsis":
                    container.append('<span class="ellipsis">&#x2026;</span>');
                    break;
                  case "first":
                    btnDisplay = lang.sFirst;
                    if (page === 0) {
                      disabled = true;
                    }
                    break;
                  case "previous":
                    btnDisplay = lang.sPrevious;
                    if (page === 0) {
                      disabled = true;
                    }
                    break;
                  case "next":
                    btnDisplay = lang.sNext;
                    if (pages === 0 || page === pages - 1) {
                      disabled = true;
                    }
                    break;
                  case "last":
                    btnDisplay = lang.sLast;
                    if (pages === 0 || page === pages - 1) {
                      disabled = true;
                    }
                    break;
                  default:
                    btnDisplay = settings.fnFormatNumber(button + 1);
                    btnClass = page === button ? classes.sPageButtonActive : "";
                    break;
                }
                if (btnDisplay !== null) {
                  var tag = settings.oInit.pagingTag || "a";
                  if (disabled) {
                    btnClass += " " + disabledClass;
                  }
                  node = $("<" + tag + ">", {
                    "class": classes.sPageButton + " " + btnClass,
                    "aria-controls": settings.sTableId,
                    "aria-disabled": disabled ? "true" : null,
                    "aria-label": aria[button],
                    "role": "link",
                    "aria-current": btnClass === classes.sPageButtonActive ? "page" : null,
                    "data-dt-idx": button,
                    "tabindex": disabled ? -1 : settings.iTabIndex,
                    "id": idx === 0 && typeof button === "string" ? settings.sTableId + "_" + button : null
                  }).html(btnDisplay).appendTo(container);
                  _fnBindAction(
                    node,
                    { action: button },
                    clickHandler
                  );
                }
              }
            }
          };
          var activeEl;
          try {
            activeEl = $(host).find(document.activeElement).data("dt-idx");
          } catch (e) {
          }
          attach($(host).empty(), buttons);
          if (activeEl !== void 0) {
            $(host).find("[data-dt-idx=" + activeEl + "]").trigger("focus");
          }
        }
      }
    });
    $.extend(DataTable.ext.type.detect, [
      // Plain numbers - first since V8 detects some plain numbers as dates
      // e.g. Date.parse('55') (but not all, e.g. Date.parse('22')...).
      function(d, settings) {
        var decimal = settings.oLanguage.sDecimal;
        return _isNumber(d, decimal) ? "num" + decimal : null;
      },
      // Dates (only those recognised by the browser's Date.parse)
      function(d, settings) {
        if (d && !(d instanceof Date) && !_re_date.test(d)) {
          return null;
        }
        var parsed = Date.parse(d);
        return parsed !== null && !isNaN(parsed) || _empty(d) ? "date" : null;
      },
      // Formatted numbers
      function(d, settings) {
        var decimal = settings.oLanguage.sDecimal;
        return _isNumber(d, decimal, true) ? "num-fmt" + decimal : null;
      },
      // HTML numeric
      function(d, settings) {
        var decimal = settings.oLanguage.sDecimal;
        return _htmlNumeric(d, decimal) ? "html-num" + decimal : null;
      },
      // HTML numeric, formatted
      function(d, settings) {
        var decimal = settings.oLanguage.sDecimal;
        return _htmlNumeric(d, decimal, true) ? "html-num-fmt" + decimal : null;
      },
      // HTML (this is strict checking - there must be html)
      function(d, settings) {
        return _empty(d) || typeof d === "string" && d.indexOf("<") !== -1 ? "html" : null;
      }
    ]);
    $.extend(DataTable.ext.type.search, {
      html: function(data) {
        return _empty(data) ? data : typeof data === "string" ? data.replace(_re_new_lines, " ").replace(_re_html, "") : "";
      },
      string: function(data) {
        return _empty(data) ? data : typeof data === "string" ? data.replace(_re_new_lines, " ") : data;
      }
    });
    __numericReplace = function(d, decimalPlace, re1, re2) {
      if (d !== 0 && (!d || d === "-")) {
        return -Infinity;
      }
      var type = typeof d;
      if (type === "number" || type === "bigint") {
        return d;
      }
      if (decimalPlace) {
        d = _numToDecimal(d, decimalPlace);
      }
      if (d.replace) {
        if (re1) {
          d = d.replace(re1, "");
        }
        if (re2) {
          d = d.replace(re2, "");
        }
      }
      return d * 1;
    };
    $.extend(_ext.type.order, {
      // Dates
      "date-pre": function(d) {
        var ts = Date.parse(d);
        return isNaN(ts) ? -Infinity : ts;
      },
      // html
      "html-pre": function(a) {
        return _empty(a) ? "" : a.replace ? a.replace(/<.*?>/g, "").toLowerCase() : a + "";
      },
      // string
      "string-pre": function(a) {
        return _empty(a) ? "" : typeof a === "string" ? a.toLowerCase() : !a.toString ? "" : a.toString();
      },
      // string-asc and -desc are retained only for compatibility with the old
      // sort methods
      "string-asc": function(x, y) {
        return x < y ? -1 : x > y ? 1 : 0;
      },
      "string-desc": function(x, y) {
        return x < y ? 1 : x > y ? -1 : 0;
      }
    });
    _addNumericSort("");
    $.extend(true, DataTable.ext.renderer, {
      header: {
        _: function(settings, cell, column, classes) {
          $(settings.nTable).on("order.dt.DT", function(e, ctx, sorting, columns) {
            if (settings !== ctx) {
              return;
            }
            var colIdx = column.idx;
            cell.removeClass(
              classes.sSortAsc + " " + classes.sSortDesc
            ).addClass(
              columns[colIdx] == "asc" ? classes.sSortAsc : columns[colIdx] == "desc" ? classes.sSortDesc : column.sSortingClass
            );
          });
        },
        jqueryui: function(settings, cell, column, classes) {
          $("<div/>").addClass(classes.sSortJUIWrapper).append(cell.contents()).append(
            $("<span/>").addClass(classes.sSortIcon + " " + column.sSortingClassJUI)
          ).appendTo(cell);
          $(settings.nTable).on("order.dt.DT", function(e, ctx, sorting, columns) {
            if (settings !== ctx) {
              return;
            }
            var colIdx = column.idx;
            cell.removeClass(classes.sSortAsc + " " + classes.sSortDesc).addClass(
              columns[colIdx] == "asc" ? classes.sSortAsc : columns[colIdx] == "desc" ? classes.sSortDesc : column.sSortingClass
            );
            cell.find("span." + classes.sSortIcon).removeClass(
              classes.sSortJUIAsc + " " + classes.sSortJUIDesc + " " + classes.sSortJUI + " " + classes.sSortJUIAscAllowed + " " + classes.sSortJUIDescAllowed
            ).addClass(
              columns[colIdx] == "asc" ? classes.sSortJUIAsc : columns[colIdx] == "desc" ? classes.sSortJUIDesc : column.sSortingClassJUI
            );
          });
        }
      }
    });
    __htmlEscapeEntities = function(d) {
      if (Array.isArray(d)) {
        d = d.join(",");
      }
      return typeof d === "string" ? d.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;") : d;
    };
    __mlWarning = false;
    __thousands = ",";
    __decimal = ".";
    if (window.Intl !== void 0) {
      try {
        num = new Intl.NumberFormat().formatToParts(100000.1);
        for (i = 0; i < num.length; i++) {
          if (num[i].type === "group") {
            __thousands = num[i].value;
          } else if (num[i].type === "decimal") {
            __decimal = num[i].value;
          }
        }
      } catch (e) {
      }
    }
    DataTable.datetime = function(format, locale) {
      var typeName = "datetime-detect-" + format;
      if (!locale) {
        locale = "en";
      }
      if (!DataTable.ext.type.order[typeName]) {
        DataTable.ext.type.detect.unshift(function(d) {
          var dt = __mldObj(d, format, locale);
          return d === "" || dt ? typeName : false;
        });
        DataTable.ext.type.order[typeName + "-pre"] = function(d) {
          return __mldObj(d, format, locale) || 0;
        };
      }
    };
    DataTable.render = {
      date: __mlHelper("toLocaleDateString"),
      datetime: __mlHelper("toLocaleString"),
      time: __mlHelper("toLocaleTimeString"),
      number: function(thousands, decimal, precision, prefix, postfix) {
        if (thousands === null || thousands === void 0) {
          thousands = __thousands;
        }
        if (decimal === null || decimal === void 0) {
          decimal = __decimal;
        }
        return {
          display: function(d) {
            if (typeof d !== "number" && typeof d !== "string") {
              return d;
            }
            if (d === "" || d === null) {
              return d;
            }
            var negative = d < 0 ? "-" : "";
            var flo = parseFloat(d);
            if (isNaN(flo)) {
              return __htmlEscapeEntities(d);
            }
            flo = flo.toFixed(precision);
            d = Math.abs(flo);
            var intPart = parseInt(d, 10);
            var floatPart = precision ? decimal + (d - intPart).toFixed(precision).substring(2) : "";
            if (intPart === 0 && parseFloat(floatPart) === 0) {
              negative = "";
            }
            return negative + (prefix || "") + intPart.toString().replace(
              /\B(?=(\d{3})+(?!\d))/g,
              thousands
            ) + floatPart + (postfix || "");
          }
        };
      },
      text: function() {
        return {
          display: __htmlEscapeEntities,
          filter: __htmlEscapeEntities
        };
      }
    };
    $.extend(DataTable.ext.internal, {
      _fnExternApiFunc,
      _fnBuildAjax,
      _fnAjaxUpdate,
      _fnAjaxParameters,
      _fnAjaxUpdateDraw,
      _fnAjaxDataSrc,
      _fnAddColumn,
      _fnColumnOptions,
      _fnAdjustColumnSizing,
      _fnVisibleToColumnIndex,
      _fnColumnIndexToVisible,
      _fnVisbleColumns,
      _fnGetColumns,
      _fnColumnTypes,
      _fnApplyColumnDefs,
      _fnHungarianMap,
      _fnCamelToHungarian,
      _fnLanguageCompat,
      _fnBrowserDetect,
      _fnAddData,
      _fnAddTr,
      _fnNodeToDataIndex,
      _fnNodeToColumnIndex,
      _fnGetCellData,
      _fnSetCellData,
      _fnSplitObjNotation,
      _fnGetObjectDataFn,
      _fnSetObjectDataFn,
      _fnGetDataMaster,
      _fnClearTable,
      _fnDeleteIndex,
      _fnInvalidate,
      _fnGetRowElements,
      _fnCreateTr,
      _fnBuildHead,
      _fnDrawHead,
      _fnDraw,
      _fnReDraw,
      _fnAddOptionsHtml,
      _fnDetectHeader,
      _fnGetUniqueThs,
      _fnFeatureHtmlFilter,
      _fnFilterComplete,
      _fnFilterCustom,
      _fnFilterColumn,
      _fnFilter,
      _fnFilterCreateSearch,
      _fnEscapeRegex,
      _fnFilterData,
      _fnFeatureHtmlInfo,
      _fnUpdateInfo,
      _fnInfoMacros,
      _fnInitialise,
      _fnInitComplete,
      _fnLengthChange,
      _fnFeatureHtmlLength,
      _fnFeatureHtmlPaginate,
      _fnPageChange,
      _fnFeatureHtmlProcessing,
      _fnProcessingDisplay,
      _fnFeatureHtmlTable,
      _fnScrollDraw,
      _fnApplyToChildren,
      _fnCalculateColumnWidths,
      _fnThrottle,
      _fnConvertToWidth,
      _fnGetWidestNode,
      _fnGetMaxLenString,
      _fnStringToCss,
      _fnSortFlatten,
      _fnSort,
      _fnSortAria,
      _fnSortListener,
      _fnSortAttachListener,
      _fnSortingClasses,
      _fnSortData,
      _fnSaveState,
      _fnLoadState,
      _fnImplementState,
      _fnSettingsFromNode,
      _fnLog,
      _fnMap,
      _fnBindAction,
      _fnCallbackReg,
      _fnCallbackFire,
      _fnLengthOverflow,
      _fnRenderer,
      _fnDataSource,
      _fnRowAttributes,
      _fnExtend,
      _fnCalculateEnd: function() {
      }
      // Used by a lot of plug-ins, but redundant
      // in 1.10, so this dead-end function is
      // added to prevent errors
    });
    $.fn.dataTable = DataTable;
    DataTable.$ = $;
    $.fn.dataTableSettings = DataTable.settings;
    $.fn.dataTableExt = DataTable.ext;
    $.fn.DataTable = function(opts) {
      return $(this).dataTable(opts).api();
    };
    $.each(DataTable, function(prop, val) {
      $.fn.DataTable[prop] = val;
    });
    jquery_dataTables_default = DataTable;
  }
});

export {
  jquery_dataTables_default,
  jquery_dataTables_exports,
  init_jquery_dataTables
};
/*! Bundled license information:

datatables.net/js/jquery.dataTables.mjs:
  (*! DataTables 1.13.11
   * ©2008-2024 SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=chunk-BLVVVJWX.js.map
