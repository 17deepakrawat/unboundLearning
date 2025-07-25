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

// node_modules/datatables.net-buttons/js/buttons.print.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
var _link = document.createElement("a");
var _styleToAbs = function(el) {
  var url;
  var clone = $(el).clone()[0];
  var linkHost;
  if (clone.nodeName.toLowerCase() === "link") {
    clone.href = _relToAbs(clone.href);
  }
  return clone.outerHTML;
};
var _relToAbs = function(href) {
  _link.href = href;
  var linkHost = _link.host;
  if (linkHost.indexOf("/") === -1 && _link.pathname.indexOf("/") !== 0) {
    linkHost += "/";
  }
  return _link.protocol + "//" + linkHost + _link.pathname + _link.search;
};
jquery_dataTables_default.ext.buttons.print = {
  className: "buttons-print",
  text: function(dt) {
    return dt.i18n("buttons.print", "Print");
  },
  action: function(e, dt, button, config) {
    var data = dt.buttons.exportData(
      $.extend({ decodeEntities: false }, config.exportOptions)
      // XSS protection
    );
    var exportInfo = dt.buttons.exportInfo(config);
    var columnClasses = dt.columns(config.exportOptions.columns).flatten().map(function(idx) {
      return dt.settings()[0].aoColumns[dt.column(idx).index()].sClass;
    }).toArray();
    var addRow = function(d, tag) {
      var str = "<tr>";
      for (var i2 = 0, ien2 = d.length; i2 < ien2; i2++) {
        var dataOut = d[i2] === null || d[i2] === void 0 ? "" : d[i2];
        var classAttr = columnClasses[i2] ? 'class="' + columnClasses[i2] + '"' : "";
        str += "<" + tag + " " + classAttr + ">" + dataOut + "</" + tag + ">";
      }
      return str + "</tr>";
    };
    var html = '<table class="' + dt.table().node().className + '">';
    if (config.header) {
      html += "<thead>" + addRow(data.header, "th") + "</thead>";
    }
    html += "<tbody>";
    for (var i = 0, ien = data.body.length; i < ien; i++) {
      html += addRow(data.body[i], "td");
    }
    html += "</tbody>";
    if (config.footer && data.footer) {
      html += "<tfoot>" + addRow(data.footer, "th") + "</tfoot>";
    }
    html += "</table>";
    var win = window.open("", "");
    if (!win) {
      dt.buttons.info(
        dt.i18n("buttons.printErrorTitle", "Unable to open print view"),
        dt.i18n(
          "buttons.printErrorMsg",
          "Please allow popups in your browser for this site to be able to view the print view."
        ),
        5e3
      );
      return;
    }
    win.document.close();
    var head = "<title>" + exportInfo.title + "</title>";
    $("style, link").each(function() {
      head += _styleToAbs(this);
    });
    try {
      win.document.head.innerHTML = head;
    } catch (e2) {
      $(win.document.head).html(head);
    }
    win.document.body.innerHTML = "<h1>" + exportInfo.title + "</h1><div>" + (exportInfo.messageTop || "") + "</div>" + html + "<div>" + (exportInfo.messageBottom || "") + "</div>";
    $(win.document.body).addClass("dt-print-view");
    $("img", win.document.body).each(function(i2, img) {
      img.setAttribute("src", _relToAbs(img.getAttribute("src")));
    });
    if (config.customize) {
      config.customize(win, config, dt);
    }
    var autoPrint = function() {
      if (config.autoPrint) {
        win.print();
        win.close();
      }
    };
    if (navigator.userAgent.match(/Trident\/\d.\d/)) {
      autoPrint();
    } else {
      win.setTimeout(autoPrint, 1e3);
    }
  },
  title: "*",
  messageTop: "*",
  messageBottom: "*",
  exportOptions: {},
  header: true,
  footer: false,
  autoPrint: true,
  customize: null
};
var buttons_print_default = jquery_dataTables_default;
export {
  buttons_print_default as default
};
/*! Bundled license information:

datatables.net-buttons/js/buttons.print.mjs:
  (*!
   * Print button for Buttons and DataTables.
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=datatables__net-buttons_js_buttons__print.js.map
