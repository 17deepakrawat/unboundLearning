import "./chunk-72AF6TIL.js";
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

// node_modules/datatables.net-buttons/js/buttons.html5.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
var useJszip;
var usePdfmake;
function _jsZip() {
  return useJszip || window.JSZip;
}
function _pdfMake() {
  return usePdfmake || window.pdfMake;
}
jquery_dataTables_default.Buttons.pdfMake = function(_) {
  if (!_) {
    return _pdfMake();
  }
  usePdfmake = _;
};
jquery_dataTables_default.Buttons.jszip = function(_) {
  if (!_) {
    return _jsZip();
  }
  useJszip = _;
};
var _saveAs = function(view) {
  "use strict";
  if (typeof view === "undefined" || typeof navigator !== "undefined" && /MSIE [1-9]\./.test(navigator.userAgent)) {
    return;
  }
  var doc = view.document, get_URL = function() {
    return view.URL || view.webkitURL || view;
  }, save_link = doc.createElementNS("http://www.w3.org/1999/xhtml", "a"), can_use_save_link = "download" in save_link, click = function(node) {
    var event = new MouseEvent("click");
    node.dispatchEvent(event);
  }, is_safari = /constructor/i.test(view.HTMLElement) || view.safari, is_chrome_ios = /CriOS\/[\d]+/.test(navigator.userAgent), throw_outside = function(ex) {
    (view.setImmediate || view.setTimeout)(function() {
      throw ex;
    }, 0);
  }, force_saveable_type = "application/octet-stream", arbitrary_revoke_timeout = 1e3 * 40, revoke = function(file) {
    var revoker = function() {
      if (typeof file === "string") {
        get_URL().revokeObjectURL(file);
      } else {
        file.remove();
      }
    };
    setTimeout(revoker, arbitrary_revoke_timeout);
  }, dispatch = function(filesaver, event_types, event) {
    event_types = [].concat(event_types);
    var i = event_types.length;
    while (i--) {
      var listener = filesaver["on" + event_types[i]];
      if (typeof listener === "function") {
        try {
          listener.call(filesaver, event || filesaver);
        } catch (ex) {
          throw_outside(ex);
        }
      }
    }
  }, auto_bom = function(blob) {
    if (/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(
      blob.type
    )) {
      return new Blob([String.fromCharCode(65279), blob], { type: blob.type });
    }
    return blob;
  }, FileSaver = function(blob, name, no_auto_bom) {
    if (!no_auto_bom) {
      blob = auto_bom(blob);
    }
    var filesaver = this, type = blob.type, force = type === force_saveable_type, object_url, dispatch_all = function() {
      dispatch(filesaver, "writestart progress write writeend".split(" "));
    }, fs_error = function() {
      if ((is_chrome_ios || force && is_safari) && view.FileReader) {
        var reader = new FileReader();
        reader.onloadend = function() {
          var url = is_chrome_ios ? reader.result : reader.result.replace(/^data:[^;]*;/, "data:attachment/file;");
          var popup = view.open(url, "_blank");
          if (!popup)
            view.location.href = url;
          url = void 0;
          filesaver.readyState = filesaver.DONE;
          dispatch_all();
        };
        reader.readAsDataURL(blob);
        filesaver.readyState = filesaver.INIT;
        return;
      }
      if (!object_url) {
        object_url = get_URL().createObjectURL(blob);
      }
      if (force) {
        view.location.href = object_url;
      } else {
        var opened = view.open(object_url, "_blank");
        if (!opened) {
          view.location.href = object_url;
        }
      }
      filesaver.readyState = filesaver.DONE;
      dispatch_all();
      revoke(object_url);
    };
    filesaver.readyState = filesaver.INIT;
    if (can_use_save_link) {
      object_url = get_URL().createObjectURL(blob);
      setTimeout(function() {
        save_link.href = object_url;
        save_link.download = name;
        click(save_link);
        dispatch_all();
        revoke(object_url);
        filesaver.readyState = filesaver.DONE;
      });
      return;
    }
    fs_error();
  }, FS_proto = FileSaver.prototype, saveAs = function(blob, name, no_auto_bom) {
    return new FileSaver(blob, name || blob.name || "download", no_auto_bom);
  };
  if (typeof navigator !== "undefined" && navigator.msSaveOrOpenBlob) {
    return function(blob, name, no_auto_bom) {
      name = name || blob.name || "download";
      if (!no_auto_bom) {
        blob = auto_bom(blob);
      }
      return navigator.msSaveOrOpenBlob(blob, name);
    };
  }
  FS_proto.abort = function() {
  };
  FS_proto.readyState = FS_proto.INIT = 0;
  FS_proto.WRITING = 1;
  FS_proto.DONE = 2;
  FS_proto.error = FS_proto.onwritestart = FS_proto.onprogress = FS_proto.onwrite = FS_proto.onabort = FS_proto.onerror = FS_proto.onwriteend = null;
  return saveAs;
}(
  typeof self !== "undefined" && self || typeof window !== "undefined" && window || (void 0).content
);
jquery_dataTables_default.fileSave = _saveAs;
var _sheetname = function(config) {
  var sheetName = "Sheet1";
  if (config.sheetName) {
    sheetName = config.sheetName.replace(/[\[\]\*\/\\\?\:]/g, "");
  }
  return sheetName;
};
var _newLine = function(config) {
  return config.newline ? config.newline : navigator.userAgent.match(/Windows/) ? "\r\n" : "\n";
};
var _exportData = function(dt, config) {
  var newLine = _newLine(config);
  var data = dt.buttons.exportData(config.exportOptions);
  var boundary = config.fieldBoundary;
  var separator = config.fieldSeparator;
  var reBoundary = new RegExp(boundary, "g");
  var escapeChar = config.escapeChar !== void 0 ? config.escapeChar : "\\";
  var join = function(a) {
    var s = "";
    for (var i2 = 0, ien2 = a.length; i2 < ien2; i2++) {
      if (i2 > 0) {
        s += separator;
      }
      s += boundary ? boundary + ("" + a[i2]).replace(reBoundary, escapeChar + boundary) + boundary : a[i2];
    }
    return s;
  };
  var header = config.header ? join(data.header) + newLine : "";
  var footer = config.footer && data.footer ? newLine + join(data.footer) : "";
  var body = [];
  for (var i = 0, ien = data.body.length; i < ien; i++) {
    body.push(join(data.body[i]));
  }
  return {
    str: header + body.join(newLine) + footer,
    rows: body.length
  };
};
var _isDuffSafari = function() {
  var safari = navigator.userAgent.indexOf("Safari") !== -1 && navigator.userAgent.indexOf("Chrome") === -1 && navigator.userAgent.indexOf("Opera") === -1;
  if (!safari) {
    return false;
  }
  var version = navigator.userAgent.match(/AppleWebKit\/(\d+\.\d+)/);
  if (version && version.length > 1 && version[1] * 1 < 603.1) {
    return true;
  }
  return false;
};
function createCellPos(n) {
  var ordA = "A".charCodeAt(0);
  var ordZ = "Z".charCodeAt(0);
  var len = ordZ - ordA + 1;
  var s = "";
  while (n >= 0) {
    s = String.fromCharCode(n % len + ordA) + s;
    n = Math.floor(n / len) - 1;
  }
  return s;
}
try {
  _serialiser = new XMLSerializer();
} catch (t) {
}
var _serialiser;
var _ieExcel;
function _addToZip(zip, obj) {
  if (_ieExcel === void 0) {
    _ieExcel = _serialiser.serializeToString(
      new window.DOMParser().parseFromString(
        excelStrings["xl/worksheets/sheet1.xml"],
        "text/xml"
      )
    ).indexOf("xmlns:r") === -1;
  }
  $.each(obj, function(name, val) {
    if ($.isPlainObject(val)) {
      var newDir = zip.folder(name);
      _addToZip(newDir, val);
    } else {
      if (_ieExcel) {
        var worksheet = val.childNodes[0];
        var i, ien;
        var attrs = [];
        for (i = worksheet.attributes.length - 1; i >= 0; i--) {
          var attrName = worksheet.attributes[i].nodeName;
          var attrValue = worksheet.attributes[i].nodeValue;
          if (attrName.indexOf(":") !== -1) {
            attrs.push({ name: attrName, value: attrValue });
            worksheet.removeAttribute(attrName);
          }
        }
        for (i = 0, ien = attrs.length; i < ien; i++) {
          var attr = val.createAttribute(
            attrs[i].name.replace(":", "_dt_b_namespace_token_")
          );
          attr.value = attrs[i].value;
          worksheet.setAttributeNode(attr);
        }
      }
      var str = _serialiser.serializeToString(val);
      if (_ieExcel) {
        if (str.indexOf("<?xml") === -1) {
          str = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' + str;
        }
        str = str.replace(/_dt_b_namespace_token_/g, ":");
        str = str.replace(/xmlns:NS[\d]+="" NS[\d]+:/g, "");
      }
      str = str.replace(/<([^<>]*?) xmlns=""([^<>]*?)>/g, "<$1 $2>");
      zip.file(name, str);
    }
  });
}
function _createNode(doc, nodeName, opts) {
  var tempNode = doc.createElement(nodeName);
  if (opts) {
    if (opts.attr) {
      $(tempNode).attr(opts.attr);
    }
    if (opts.children) {
      $.each(opts.children, function(key, value) {
        tempNode.appendChild(value);
      });
    }
    if (opts.text !== null && opts.text !== void 0) {
      tempNode.appendChild(doc.createTextNode(opts.text));
    }
  }
  return tempNode;
}
function _excelColWidth(data, col) {
  var max = data.header[col].length;
  var len, lineSplit, str;
  if (data.footer && data.footer[col].length > max) {
    max = data.footer[col].length;
  }
  for (var i = 0, ien = data.body.length; i < ien; i++) {
    var point = data.body[i][col];
    str = point !== null && point !== void 0 ? point.toString() : "";
    if (str.indexOf("\n") !== -1) {
      lineSplit = str.split("\n");
      lineSplit.sort(function(a, b) {
        return b.length - a.length;
      });
      len = lineSplit[0].length;
    } else {
      len = str.length;
    }
    if (len > max) {
      max = len;
    }
    if (max > 40) {
      return 54;
    }
  }
  max *= 1.35;
  return max > 6 ? max : 6;
}
var excelStrings = {
  "_rels/.rels": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>',
  "xl/_rels/workbook.xml.rels": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>',
  "[Content_Types].xml": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="xml" ContentType="application/xml" /><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml" /><Default Extension="jpeg" ContentType="image/jpeg" /><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" /><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" /><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" /></Types>',
  "xl/workbook.xml": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/><workbookPr showInkAnnotation="0" autoCompressPictures="0"/><bookViews><workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/></bookViews><sheets><sheet name="Sheet1" sheetId="1" r:id="rId1"/></sheets><definedNames/></workbook>',
  "xl/worksheets/sheet1.xml": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><sheetData/><mergeCells count="0"/></worksheet>',
  "xl/styles.xml": '<?xml version="1.0" encoding="UTF-8"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><numFmts count="6"><numFmt numFmtId="164" formatCode="#,##0.00_- [$$-45C]"/><numFmt numFmtId="165" formatCode="&quot;£&quot;#,##0.00"/><numFmt numFmtId="166" formatCode="[$€-2] #,##0.00"/><numFmt numFmtId="167" formatCode="0.0%"/><numFmt numFmtId="168" formatCode="#,##0;(#,##0)"/><numFmt numFmtId="169" formatCode="#,##0.00;(#,##0.00)"/></numFmts><fonts count="5" x14ac:knownFonts="1"><font><sz val="11" /><name val="Calibri" /></font><font><sz val="11" /><name val="Calibri" /><color rgb="FFFFFFFF" /></font><font><sz val="11" /><name val="Calibri" /><b /></font><font><sz val="11" /><name val="Calibri" /><i /></font><font><sz val="11" /><name val="Calibri" /><u /></font></fonts><fills count="6"><fill><patternFill patternType="none" /></fill><fill><patternFill patternType="none" /></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD9D9D9" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD99795" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6efce" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6cfef" /><bgColor indexed="64" /></patternFill></fill></fills><borders count="2"><border><left /><right /><top /><bottom /><diagonal /></border><border diagonalUp="false" diagonalDown="false"><left style="thin"><color auto="1" /></left><right style="thin"><color auto="1" /></right><top style="thin"><color auto="1" /></top><bottom style="thin"><color auto="1" /></bottom><diagonal /></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" /></cellStyleXfs><cellXfs count="68"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="left"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="center"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="right"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="fill"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment textRotation="90"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment wrapText="1"/></xf><xf numFmtId="9"   fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="164" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="165" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="166" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="167" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="168" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="169" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="3" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="4" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="1" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="2" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="14" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0" /></cellStyles><dxfs count="0" /><tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" /></styleSheet>'
};
var _excelSpecials = [
  {
    match: /^\-?\d+\.\d%$/,
    style: 60,
    fmt: function(d) {
      return d / 100;
    }
  },
  // Percent with d.p.
  {
    match: /^\-?\d+\.?\d*%$/,
    style: 56,
    fmt: function(d) {
      return d / 100;
    }
  },
  // Percent
  { match: /^\-?\$[\d,]+.?\d*$/, style: 57 },
  // Dollars
  { match: /^\-?£[\d,]+.?\d*$/, style: 58 },
  // Pounds
  { match: /^\-?€[\d,]+.?\d*$/, style: 59 },
  // Euros
  { match: /^\-?\d+$/, style: 65 },
  // Numbers without thousand separators
  { match: /^\-?\d+\.\d{2}$/, style: 66 },
  // Numbers 2 d.p. without thousands separators
  {
    match: /^\([\d,]+\)$/,
    style: 61,
    fmt: function(d) {
      return -1 * d.replace(/[\(\)]/g, "");
    }
  },
  // Negative numbers indicated by brackets
  {
    match: /^\([\d,]+\.\d{2}\)$/,
    style: 62,
    fmt: function(d) {
      return -1 * d.replace(/[\(\)]/g, "");
    }
  },
  // Negative numbers indicated by brackets - 2d.p.
  { match: /^\-?[\d,]+$/, style: 63 },
  // Numbers with thousand separators
  { match: /^\-?[\d,]+\.\d{2}$/, style: 64 },
  {
    match: /^[\d]{4}\-[01][\d]\-[0123][\d]$/,
    style: 67,
    fmt: function(d) {
      return Math.round(25569 + Date.parse(d) / (86400 * 1e3));
    }
  }
  //Date yyyy-mm-dd
];
jquery_dataTables_default.ext.buttons.copyHtml5 = {
  className: "buttons-copy buttons-html5",
  text: function(dt) {
    return dt.i18n("buttons.copy", "Copy");
  },
  action: function(e, dt, button, config) {
    this.processing(true);
    var that = this;
    var exportData = _exportData(dt, config);
    var info = dt.buttons.exportInfo(config);
    var newline = _newLine(config);
    var output = exportData.str;
    var hiddenDiv = $("<div/>").css({
      height: 1,
      width: 1,
      overflow: "hidden",
      position: "fixed",
      top: 0,
      left: 0
    });
    if (info.title) {
      output = info.title + newline + newline + output;
    }
    if (info.messageTop) {
      output = info.messageTop + newline + newline + output;
    }
    if (info.messageBottom) {
      output = output + newline + newline + info.messageBottom;
    }
    if (config.customize) {
      output = config.customize(output, config, dt);
    }
    var textarea = $("<textarea readonly/>").val(output).appendTo(hiddenDiv);
    if (document.queryCommandSupported("copy")) {
      hiddenDiv.appendTo(dt.table().container());
      textarea[0].focus();
      textarea[0].select();
      try {
        var successful = document.execCommand("copy");
        hiddenDiv.remove();
        if (successful) {
          dt.buttons.info(
            dt.i18n("buttons.copyTitle", "Copy to clipboard"),
            dt.i18n(
              "buttons.copySuccess",
              {
                1: "Copied one row to clipboard",
                _: "Copied %d rows to clipboard"
              },
              exportData.rows
            ),
            2e3
          );
          this.processing(false);
          return;
        }
      } catch (t) {
      }
    }
    var message = $(
      "<span>" + dt.i18n(
        "buttons.copyKeys",
        "Press <i>ctrl</i> or <i>⌘</i> + <i>C</i> to copy the table data<br>to your system clipboard.<br><br>To cancel, click this message or press escape."
      ) + "</span>"
    ).append(hiddenDiv);
    dt.buttons.info(dt.i18n("buttons.copyTitle", "Copy to clipboard"), message, 0);
    textarea[0].focus();
    textarea[0].select();
    var container = $(message).closest(".dt-button-info");
    var close = function() {
      container.off("click.buttons-copy");
      $(document).off(".buttons-copy");
      dt.buttons.info(false);
    };
    container.on("click.buttons-copy", close);
    $(document).on("keydown.buttons-copy", function(e2) {
      if (e2.keyCode === 27) {
        close();
        that.processing(false);
      }
    }).on("copy.buttons-copy cut.buttons-copy", function() {
      close();
      that.processing(false);
    });
  },
  exportOptions: {},
  fieldSeparator: "	",
  fieldBoundary: "",
  header: true,
  footer: false,
  title: "*",
  messageTop: "*",
  messageBottom: "*"
};
jquery_dataTables_default.ext.buttons.csvHtml5 = {
  bom: false,
  className: "buttons-csv buttons-html5",
  available: function() {
    return window.FileReader !== void 0 && window.Blob;
  },
  text: function(dt) {
    return dt.i18n("buttons.csv", "CSV");
  },
  action: function(e, dt, button, config) {
    this.processing(true);
    var output = _exportData(dt, config).str;
    var info = dt.buttons.exportInfo(config);
    var charset = config.charset;
    if (config.customize) {
      output = config.customize(output, config, dt);
    }
    if (charset !== false) {
      if (!charset) {
        charset = document.characterSet || document.charset;
      }
      if (charset) {
        charset = ";charset=" + charset;
      }
    } else {
      charset = "";
    }
    if (config.bom) {
      output = String.fromCharCode(65279) + output;
    }
    _saveAs(new Blob([output], { type: "text/csv" + charset }), info.filename, true);
    this.processing(false);
  },
  filename: "*",
  extension: ".csv",
  exportOptions: {},
  fieldSeparator: ",",
  fieldBoundary: '"',
  escapeChar: '"',
  charset: null,
  header: true,
  footer: false
};
jquery_dataTables_default.ext.buttons.excelHtml5 = {
  className: "buttons-excel buttons-html5",
  available: function() {
    return window.FileReader !== void 0 && _jsZip() !== void 0 && !_isDuffSafari() && _serialiser;
  },
  text: function(dt) {
    return dt.i18n("buttons.excel", "Excel");
  },
  action: function(e, dt, button, config) {
    this.processing(true);
    var that = this;
    var rowPos = 0;
    var dataStartRow, dataEndRow;
    var getXml = function(type) {
      var str = excelStrings[type];
      return $.parseXML(str);
    };
    var rels = getXml("xl/worksheets/sheet1.xml");
    var relsGet = rels.getElementsByTagName("sheetData")[0];
    var xlsx = {
      _rels: {
        ".rels": getXml("_rels/.rels")
      },
      xl: {
        _rels: {
          "workbook.xml.rels": getXml("xl/_rels/workbook.xml.rels")
        },
        "workbook.xml": getXml("xl/workbook.xml"),
        "styles.xml": getXml("xl/styles.xml"),
        worksheets: {
          "sheet1.xml": rels
        }
      },
      "[Content_Types].xml": getXml("[Content_Types].xml")
    };
    var data = dt.buttons.exportData(config.exportOptions);
    var currentRow, rowNode;
    var addRow = function(row) {
      currentRow = rowPos + 1;
      rowNode = _createNode(rels, "row", { attr: { r: currentRow } });
      for (var i2 = 0, ien2 = row.length; i2 < ien2; i2++) {
        var cellId = createCellPos(i2) + "" + currentRow;
        var cell = null;
        if (row[i2] === null || row[i2] === void 0 || row[i2] === "") {
          if (config.createEmptyCells === true) {
            row[i2] = "";
          } else {
            continue;
          }
        }
        var originalContent = row[i2];
        row[i2] = typeof row[i2].trim === "function" ? row[i2].trim() : row[i2];
        for (var j = 0, jen = _excelSpecials.length; j < jen; j++) {
          var special = _excelSpecials[j];
          if (row[i2].match && !row[i2].match(/^0\d+/) && row[i2].match(special.match)) {
            var val = row[i2].replace(/[^\d\.\-]/g, "");
            if (special.fmt) {
              val = special.fmt(val);
            }
            cell = _createNode(rels, "c", {
              attr: {
                r: cellId,
                s: special.style
              },
              children: [_createNode(rels, "v", { text: val })]
            });
            break;
          }
        }
        if (!cell) {
          if (typeof row[i2] === "number" || row[i2].match && row[i2].match(/^-?\d+(\.\d+)?([eE]\-?\d+)?$/) && // Includes exponential format
          !row[i2].match(/^0\d+/)) {
            cell = _createNode(rels, "c", {
              attr: {
                t: "n",
                r: cellId
              },
              children: [_createNode(rels, "v", { text: row[i2] })]
            });
          } else {
            var text = !originalContent.replace ? originalContent : originalContent.replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g, "");
            cell = _createNode(rels, "c", {
              attr: {
                t: "inlineStr",
                r: cellId
              },
              children: {
                row: _createNode(rels, "is", {
                  children: {
                    row: _createNode(rels, "t", {
                      text,
                      attr: {
                        "xml:space": "preserve"
                      }
                    })
                  }
                })
              }
            });
          }
        }
        rowNode.appendChild(cell);
      }
      relsGet.appendChild(rowNode);
      rowPos++;
    };
    if (config.customizeData) {
      config.customizeData(data);
    }
    var mergeCells = function(row, colspan) {
      var mergeCells2 = $("mergeCells", rels);
      mergeCells2[0].appendChild(
        _createNode(rels, "mergeCell", {
          attr: {
            ref: "A" + row + ":" + createCellPos(colspan) + row
          }
        })
      );
      mergeCells2.attr("count", parseFloat(mergeCells2.attr("count")) + 1);
      $("row:eq(" + (row - 1) + ") c", rels).attr("s", "51");
    };
    var exportInfo = dt.buttons.exportInfo(config);
    if (exportInfo.title) {
      addRow([exportInfo.title], rowPos);
      mergeCells(rowPos, data.header.length - 1);
    }
    if (exportInfo.messageTop) {
      addRow([exportInfo.messageTop], rowPos);
      mergeCells(rowPos, data.header.length - 1);
    }
    if (config.header) {
      addRow(data.header, rowPos);
      $("row:last c", rels).attr("s", "2");
    }
    dataStartRow = rowPos;
    for (var n = 0, ie = data.body.length; n < ie; n++) {
      addRow(data.body[n], rowPos);
    }
    dataEndRow = rowPos;
    if (config.footer && data.footer) {
      addRow(data.footer, rowPos);
      $("row:last c", rels).attr("s", "2");
    }
    if (exportInfo.messageBottom) {
      addRow([exportInfo.messageBottom], rowPos);
      mergeCells(rowPos, data.header.length - 1);
    }
    var cols = _createNode(rels, "cols");
    $("worksheet", rels).prepend(cols);
    for (var i = 0, ien = data.header.length; i < ien; i++) {
      cols.appendChild(
        _createNode(rels, "col", {
          attr: {
            min: i + 1,
            max: i + 1,
            width: _excelColWidth(data, i),
            customWidth: 1
          }
        })
      );
    }
    var workbook = xlsx.xl["workbook.xml"];
    $("sheets sheet", workbook).attr("name", _sheetname(config));
    if (config.autoFilter) {
      $("mergeCells", rels).before(
        _createNode(rels, "autoFilter", {
          attr: {
            ref: "A" + dataStartRow + ":" + createCellPos(data.header.length - 1) + dataEndRow
          }
        })
      );
      $("definedNames", workbook).append(
        _createNode(workbook, "definedName", {
          attr: {
            name: "_xlnm._FilterDatabase",
            localSheetId: "0",
            hidden: 1
          },
          text: _sheetname(config) + "!$A$" + dataStartRow + ":" + createCellPos(data.header.length - 1) + dataEndRow
        })
      );
    }
    if (config.customize) {
      config.customize(xlsx, config, dt);
    }
    if ($("mergeCells", rels).children().length === 0) {
      $("mergeCells", rels).remove();
    }
    var jszip = _jsZip();
    var zip = new jszip();
    var zipConfig = {
      compression: "DEFLATE",
      type: "blob",
      mimeType: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    };
    _addToZip(zip, xlsx);
    var filename = exportInfo.filename;
    if (filename > 175) {
      filename = filename.substr(0, 175);
    }
    if (zip.generateAsync) {
      zip.generateAsync(zipConfig).then(function(blob) {
        _saveAs(blob, filename);
        that.processing(false);
      });
    } else {
      _saveAs(zip.generate(zipConfig), filename);
      this.processing(false);
    }
  },
  filename: "*",
  extension: ".xlsx",
  exportOptions: {},
  header: true,
  footer: false,
  title: "*",
  messageTop: "*",
  messageBottom: "*",
  createEmptyCells: false,
  autoFilter: false,
  sheetName: ""
};
jquery_dataTables_default.ext.buttons.pdfHtml5 = {
  className: "buttons-pdf buttons-html5",
  available: function() {
    return window.FileReader !== void 0 && _pdfMake();
  },
  text: function(dt) {
    return dt.i18n("buttons.pdf", "PDF");
  },
  action: function(e, dt, button, config) {
    this.processing(true);
    var that = this;
    var data = dt.buttons.exportData(config.exportOptions);
    var info = dt.buttons.exportInfo(config);
    var rows = [];
    if (config.header) {
      rows.push(
        $.map(data.header, function(d) {
          return {
            text: typeof d === "string" ? d : d + "",
            style: "tableHeader"
          };
        })
      );
    }
    for (var i = 0, ien = data.body.length; i < ien; i++) {
      rows.push(
        $.map(data.body[i], function(d) {
          if (d === null || d === void 0) {
            d = "";
          }
          return {
            text: typeof d === "string" ? d : d + "",
            style: i % 2 ? "tableBodyEven" : "tableBodyOdd"
          };
        })
      );
    }
    if (config.footer && data.footer) {
      rows.push(
        $.map(data.footer, function(d) {
          return {
            text: typeof d === "string" ? d : d + "",
            style: "tableFooter"
          };
        })
      );
    }
    var doc = {
      pageSize: config.pageSize,
      pageOrientation: config.orientation,
      content: [
        {
          table: {
            headerRows: 1,
            body: rows
          },
          layout: "noBorders"
        }
      ],
      styles: {
        tableHeader: {
          bold: true,
          fontSize: 11,
          color: "white",
          fillColor: "#2d4154",
          alignment: "center"
        },
        tableBodyEven: {},
        tableBodyOdd: {
          fillColor: "#f3f3f3"
        },
        tableFooter: {
          bold: true,
          fontSize: 11,
          color: "white",
          fillColor: "#2d4154"
        },
        title: {
          alignment: "center",
          fontSize: 15
        },
        message: {}
      },
      defaultStyle: {
        fontSize: 10
      }
    };
    if (info.messageTop) {
      doc.content.unshift({
        text: info.messageTop,
        style: "message",
        margin: [0, 0, 0, 12]
      });
    }
    if (info.messageBottom) {
      doc.content.push({
        text: info.messageBottom,
        style: "message",
        margin: [0, 0, 0, 12]
      });
    }
    if (info.title) {
      doc.content.unshift({
        text: info.title,
        style: "title",
        margin: [0, 0, 0, 12]
      });
    }
    if (config.customize) {
      config.customize(doc, config, dt);
    }
    var pdf = _pdfMake().createPdf(doc);
    if (config.download === "open" && !_isDuffSafari()) {
      pdf.open();
    } else {
      pdf.download(info.filename);
    }
    this.processing(false);
  },
  title: "*",
  filename: "*",
  extension: ".pdf",
  exportOptions: {},
  orientation: "portrait",
  pageSize: "A4",
  header: true,
  footer: false,
  messageTop: "*",
  messageBottom: "*",
  customize: null,
  download: "download"
};
var buttons_html5_default = jquery_dataTables_default;
export {
  buttons_html5_default as default
};
/*! Bundled license information:

datatables.net-buttons/js/buttons.html5.mjs:
  (*!
   * HTML5 export buttons for Buttons and DataTables.
   * © SpryMedia Ltd - datatables.net/license
   *
   * FileSaver.js (1.3.3) - MIT license
   * Copyright © 2016 Eli Grey - http://eligrey.com
   *)
*/
//# sourceMappingURL=datatables__net-buttons_js_buttons__html5.js.map
