import "./chunk-K2H5754N.js";
import {
  dataTables_bootstrap5_default
} from "./chunk-CAYPXQDN.js";
import "./chunk-BLVVVJWX.js";
import {
  require_jquery
} from "./chunk-DNMGBOI2.js";
import {
  __toESM
} from "./chunk-GFT2G5UO.js";

// node_modules/datatables.net-responsive-bs5/js/responsive.bootstrap5.mjs
var import_jquery = __toESM(require_jquery(), 1);
var $ = import_jquery.default;
var _display = dataTables_bootstrap5_default.Responsive.display;
var _original = _display.modal;
var _modal = $(
  '<div class="modal fade dtr-bs-modal" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"/></div></div></div>'
);
var modal;
var _bs = window.bootstrap;
dataTables_bootstrap5_default.Responsive.bootstrap = function(bs) {
  _bs = bs;
};
_display.modal = function(options) {
  if (!modal) {
    modal = new _bs.Modal(_modal[0]);
  }
  return function(row, update, render, closeCallback) {
    if (!$.fn.modal) {
      return _original(row, update, render, closeCallback);
    } else {
      if (!update) {
        if (options && options.header) {
          var header = _modal.find("div.modal-header");
          var button = header.find("button").detach();
          header.empty().append('<h4 class="modal-title">' + options.header(row) + "</h4>").append(button);
        }
        _modal.find("div.modal-body").empty().append(render());
        _modal.data("dtr-row-idx", row.index()).one("hidden.bs.modal", closeCallback).appendTo("body").modal();
        modal.show();
      } else {
        if ($.contains(document, _modal[0]) && row.index() === _modal.data("dtr-row-idx")) {
          _modal.find("div.modal-body").empty().append(render());
        } else {
          return null;
        }
      }
      return true;
    }
  };
};
var responsive_bootstrap5_default = dataTables_bootstrap5_default;
export {
  responsive_bootstrap5_default as default
};
/*! Bundled license information:

datatables.net-responsive-bs5/js/responsive.bootstrap5.mjs:
  (*! Bootstrap 5 integration for DataTables' Responsive
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=datatables__net-responsive-bs5.js.map
