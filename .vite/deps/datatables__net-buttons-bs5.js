import "./chunk-72AF6TIL.js";
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

// node_modules/datatables.net-buttons-bs5/js/buttons.bootstrap5.mjs
var import_jquery = __toESM(require_jquery(), 1);
var $ = import_jquery.default;
$.extend(true, dataTables_bootstrap5_default.Buttons.defaults, {
  dom: {
    container: {
      className: "dt-buttons btn-group flex-wrap"
    },
    button: {
      className: "btn btn-secondary",
      active: "active"
    },
    collection: {
      action: {
        dropHtml: ""
      },
      container: {
        tag: "div",
        className: "dropdown-menu dt-button-collection"
      },
      closeButton: false,
      button: {
        tag: "a",
        className: "dt-button dropdown-item",
        active: "dt-button-active",
        disabled: "disabled",
        spacer: {
          className: "dropdown-divider",
          tag: "hr"
        }
      }
    },
    split: {
      action: {
        tag: "a",
        className: "btn btn-secondary dt-button-split-drop-button",
        closeButton: false
      },
      dropdown: {
        tag: "button",
        dropHtml: "",
        className: "btn btn-secondary dt-button-split-drop dropdown-toggle dropdown-toggle-split",
        closeButton: false,
        align: "split-left",
        splitAlignClass: "dt-button-split-left"
      },
      wrapper: {
        tag: "div",
        className: "dt-button-split btn-group",
        closeButton: false
      }
    }
  },
  buttonCreated: function(config, button) {
    return config.buttons ? $('<div class="btn-group"/>').append(button) : button;
  }
});
dataTables_bootstrap5_default.ext.buttons.collection.className += " dropdown-toggle";
dataTables_bootstrap5_default.ext.buttons.collection.rightAlignClassName = "dropdown-menu-right";
var buttons_bootstrap5_default = dataTables_bootstrap5_default;
export {
  buttons_bootstrap5_default as default
};
/*! Bundled license information:

datatables.net-buttons-bs5/js/buttons.bootstrap5.mjs:
  (*! Bootstrap integration for DataTables' Buttons
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=datatables__net-buttons-bs5.js.map
