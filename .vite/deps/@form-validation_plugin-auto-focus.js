import {
  require_lib
} from "./chunk-ZKBBKPD4.js";
import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/@form-validation/plugin-field-status/lib/cjs/index.js
var require_cjs = __commonJS({
  "node_modules/@form-validation/plugin-field-status/lib/cjs/index.js"(exports) {
    "use strict";
    var core = require_lib();
    var extendStatics = function(d, b) {
      extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
        d2.__proto__ = b2;
      } || function(d2, b2) {
        for (var p in b2)
          if (Object.prototype.hasOwnProperty.call(b2, p))
            d2[p] = b2[p];
      };
      return extendStatics(d, b);
    };
    function __extends(d, b) {
      if (typeof b !== "function" && b !== null)
        throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
      extendStatics(d, b);
      function __() {
        this.constructor = d;
      }
      d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    }
    var FieldStatus = (
      /** @class */
      function(_super) {
        __extends(FieldStatus2, _super);
        function FieldStatus2(opts) {
          var _this = _super.call(this, opts) || this;
          _this.statuses = /* @__PURE__ */ new Map();
          _this.opts = Object.assign({}, {
            onStatusChanged: function() {
            }
          }, opts);
          _this.elementValidatingHandler = _this.onElementValidating.bind(_this);
          _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
          _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_this);
          _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
          _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
          _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
          return _this;
        }
        FieldStatus2.prototype.install = function() {
          this.core.on("core.element.validating", this.elementValidatingHandler).on("core.element.validated", this.elementValidatedHandler).on("core.element.notvalidated", this.elementNotValidatedHandler).on("core.element.ignored", this.elementIgnoredHandler).on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler);
        };
        FieldStatus2.prototype.uninstall = function() {
          this.statuses.clear();
          this.core.off("core.element.validating", this.elementValidatingHandler).off("core.element.validated", this.elementValidatedHandler).off("core.element.notvalidated", this.elementNotValidatedHandler).off("core.element.ignored", this.elementIgnoredHandler).off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler);
        };
        FieldStatus2.prototype.areFieldsValid = function() {
          return Array.from(this.statuses.values()).every(function(value) {
            return value === "Valid" || value === "NotValidated" || value === "Ignored";
          });
        };
        FieldStatus2.prototype.getStatuses = function() {
          return this.isEnabled ? this.statuses : /* @__PURE__ */ new Map();
        };
        FieldStatus2.prototype.onFieldAdded = function(e) {
          this.statuses.set(e.field, "NotValidated");
        };
        FieldStatus2.prototype.onFieldRemoved = function(e) {
          if (this.statuses.has(e.field)) {
            this.statuses.delete(e.field);
          }
          this.handleStatusChanged(this.areFieldsValid());
        };
        FieldStatus2.prototype.onElementValidating = function(e) {
          this.statuses.set(e.field, "Validating");
          this.handleStatusChanged(false);
        };
        FieldStatus2.prototype.onElementValidated = function(e) {
          this.statuses.set(e.field, e.valid ? "Valid" : "Invalid");
          if (e.valid) {
            this.handleStatusChanged(this.areFieldsValid());
          } else {
            this.handleStatusChanged(false);
          }
        };
        FieldStatus2.prototype.onElementNotValidated = function(e) {
          this.statuses.set(e.field, "NotValidated");
          this.handleStatusChanged(false);
        };
        FieldStatus2.prototype.onElementIgnored = function(e) {
          this.statuses.set(e.field, "Ignored");
          this.handleStatusChanged(this.areFieldsValid());
        };
        FieldStatus2.prototype.handleStatusChanged = function(areFieldsValid) {
          if (this.isEnabled) {
            this.opts.onStatusChanged(areFieldsValid);
          }
        };
        return FieldStatus2;
      }(core.Plugin)
    );
    exports.FieldStatus = FieldStatus;
  }
});

// node_modules/@form-validation/plugin-field-status/lib/index.js
var require_lib2 = __commonJS({
  "node_modules/@form-validation/plugin-field-status/lib/index.js"(exports, module) {
    "use strict";
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_cjs();
    }
  }
});

// node_modules/@form-validation/plugin-auto-focus/lib/cjs/index.js
var require_cjs2 = __commonJS({
  "node_modules/@form-validation/plugin-auto-focus/lib/cjs/index.js"(exports) {
    "use strict";
    var core = require_lib();
    var pluginFieldStatus = require_lib2();
    var extendStatics = function(d, b) {
      extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
        d2.__proto__ = b2;
      } || function(d2, b2) {
        for (var p in b2)
          if (Object.prototype.hasOwnProperty.call(b2, p))
            d2[p] = b2[p];
      };
      return extendStatics(d, b);
    };
    function __extends(d, b) {
      if (typeof b !== "function" && b !== null)
        throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
      extendStatics(d, b);
      function __() {
        this.constructor = d;
      }
      d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    }
    var AutoFocus = (
      /** @class */
      function(_super) {
        __extends(AutoFocus2, _super);
        function AutoFocus2(opts) {
          var _this = _super.call(this, opts) || this;
          _this.opts = Object.assign({}, {
            onPrefocus: function() {
            }
          }, opts);
          _this.invalidFormHandler = _this.onFormInvalid.bind(_this);
          return _this;
        }
        AutoFocus2.prototype.install = function() {
          this.core.on("core.form.invalid", this.invalidFormHandler).registerPlugin(AutoFocus2.FIELD_STATUS_PLUGIN, new pluginFieldStatus.FieldStatus());
        };
        AutoFocus2.prototype.uninstall = function() {
          this.core.off("core.form.invalid", this.invalidFormHandler).deregisterPlugin(AutoFocus2.FIELD_STATUS_PLUGIN);
        };
        AutoFocus2.prototype.onEnabled = function() {
          this.core.enablePlugin(AutoFocus2.FIELD_STATUS_PLUGIN);
        };
        AutoFocus2.prototype.onDisabled = function() {
          this.core.disablePlugin(AutoFocus2.FIELD_STATUS_PLUGIN);
        };
        AutoFocus2.prototype.onFormInvalid = function() {
          if (!this.isEnabled) {
            return;
          }
          var plugin = this.core.getPlugin(AutoFocus2.FIELD_STATUS_PLUGIN);
          var statuses = plugin.getStatuses();
          var invalidFields = Object.keys(this.core.getFields()).filter(function(key) {
            return statuses.get(key) === "Invalid";
          });
          if (invalidFields.length > 0) {
            var firstInvalidField = invalidFields[0];
            var elements = this.core.getElements(firstInvalidField);
            if (elements.length > 0) {
              var firstElement = elements[0];
              var e = {
                firstElement,
                field: firstInvalidField
              };
              this.core.emit("plugins.autofocus.prefocus", e);
              this.opts.onPrefocus(e);
              firstElement.focus();
            }
          }
        };
        AutoFocus2.FIELD_STATUS_PLUGIN = "___autoFocusFieldStatus";
        return AutoFocus2;
      }(core.Plugin)
    );
    exports.AutoFocus = AutoFocus;
  }
});

// node_modules/@form-validation/plugin-auto-focus/lib/index.js
var require_lib3 = __commonJS({
  "node_modules/@form-validation/plugin-auto-focus/lib/index.js"(exports, module) {
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_cjs2();
    }
  }
});
export default require_lib3();
//# sourceMappingURL=@form-validation_plugin-auto-focus.js.map
