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

// node_modules/datatables.net-bs5/js/dataTables.bootstrap5.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
$.extend(true, jquery_dataTables_default.defaults, {
  dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row dt-row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  renderer: "bootstrap"
});
$.extend(jquery_dataTables_default.ext.classes, {
  sWrapper: "dataTables_wrapper dt-bootstrap5",
  sFilterInput: "form-control form-control-sm",
  sLengthSelect: "form-select form-select-sm",
  sProcessing: "dataTables_processing card",
  sPageButton: "paginate_button page-item"
});
jquery_dataTables_default.ext.renderer.pageButton.bootstrap = function(settings, host, idx, buttons, page, pages) {
  var api = new jquery_dataTables_default.Api(settings);
  var classes = settings.oClasses;
  var lang = settings.oLanguage.oPaginate;
  var aria = settings.oLanguage.oAria.paginate || {};
  var btnDisplay, btnClass;
  var attach = function(container, buttons2) {
    var i, ien, node, button;
    var clickHandler = function(e) {
      e.preventDefault();
      if (!$(e.currentTarget).hasClass("disabled") && api.page() != e.data.action) {
        api.page(e.data.action).draw("page");
      }
    };
    for (i = 0, ien = buttons2.length; i < ien; i++) {
      button = buttons2[i];
      if (Array.isArray(button)) {
        attach(container, button);
      } else {
        btnDisplay = "";
        btnClass = "";
        switch (button) {
          case "ellipsis":
            btnDisplay = "&#x2026;";
            btnClass = "disabled";
            break;
          case "first":
            btnDisplay = lang.sFirst;
            btnClass = button + (page > 0 ? "" : " disabled");
            break;
          case "previous":
            btnDisplay = lang.sPrevious;
            btnClass = button + (page > 0 ? "" : " disabled");
            break;
          case "next":
            btnDisplay = lang.sNext;
            btnClass = button + (page < pages - 1 ? "" : " disabled");
            break;
          case "last":
            btnDisplay = lang.sLast;
            btnClass = button + (page < pages - 1 ? "" : " disabled");
            break;
          default:
            btnDisplay = button + 1;
            btnClass = page === button ? "active" : "";
            break;
        }
        if (btnDisplay) {
          var disabled = btnClass.indexOf("disabled") !== -1;
          node = $("<li>", {
            "class": classes.sPageButton + " " + btnClass,
            "id": idx === 0 && typeof button === "string" ? settings.sTableId + "_" + button : null
          }).append(
            $("<a>", {
              "href": disabled ? null : "#",
              "aria-controls": settings.sTableId,
              "aria-disabled": disabled ? "true" : null,
              "aria-label": aria[button],
              "role": "link",
              "aria-current": btnClass === "active" ? "page" : null,
              "data-dt-idx": button,
              "tabindex": disabled ? -1 : settings.iTabIndex,
              "class": "page-link"
            }).html(btnDisplay)
          ).appendTo(container);
          settings.oApi._fnBindAction(
            node,
            { action: button },
            clickHandler
          );
        }
      }
    }
  };
  var hostEl = $(host);
  var activeEl;
  try {
    activeEl = hostEl.find(document.activeElement).data("dt-idx");
  } catch (e) {
  }
  var paginationEl = hostEl.children("ul.pagination");
  if (paginationEl.length) {
    paginationEl.empty();
  } else {
    paginationEl = hostEl.html("<ul/>").children("ul").addClass("pagination");
  }
  attach(
    paginationEl,
    buttons
  );
  if (activeEl !== void 0) {
    hostEl.find("[data-dt-idx=" + activeEl + "]").trigger("focus");
  }
};
var dataTables_bootstrap5_default = jquery_dataTables_default;

export {
  dataTables_bootstrap5_default
};
/*! Bundled license information:

datatables.net-bs5/js/dataTables.bootstrap5.mjs:
  (*! DataTables Bootstrap 5 integration
   * 2020 SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=chunk-CAYPXQDN.js.map
