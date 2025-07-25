import {
  require_lib
} from "./chunk-ZKBBKPD4.js";
import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/@form-validation/plugin-message/lib/cjs/index.js
var require_cjs = __commonJS({
  "node_modules/@form-validation/plugin-message/lib/cjs/index.js"(exports) {
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
    var classSet = core.utils.classSet;
    var Message = (
      /** @class */
      function(_super) {
        __extends(Message2, _super);
        function Message2(opts) {
          var _this = _super.call(this, opts) || this;
          _this.useDefaultContainer = false;
          _this.messages = /* @__PURE__ */ new Map();
          _this.defaultContainer = document.createElement("div");
          _this.useDefaultContainer = !opts || !opts.container;
          _this.opts = Object.assign({}, {
            container: function(_field, _element) {
              return _this.defaultContainer;
            }
          }, opts);
          _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
          _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
          _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
          _this.validatorValidatedHandler = _this.onValidatorValidated.bind(_this);
          _this.validatorNotValidatedHandler = _this.onValidatorNotValidated.bind(_this);
          return _this;
        }
        Message2.getClosestContainer = function(element, upper, pattern) {
          var ele = element;
          while (ele) {
            if (ele === upper) {
              break;
            }
            ele = ele.parentElement;
            if (pattern.test(ele.className)) {
              break;
            }
          }
          return ele;
        };
        Message2.prototype.install = function() {
          if (this.useDefaultContainer) {
            this.core.getFormElement().appendChild(this.defaultContainer);
          }
          this.core.on("core.element.ignored", this.elementIgnoredHandler).on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler).on("core.validator.validated", this.validatorValidatedHandler).on("core.validator.notvalidated", this.validatorNotValidatedHandler);
        };
        Message2.prototype.uninstall = function() {
          if (this.useDefaultContainer) {
            this.core.getFormElement().removeChild(this.defaultContainer);
          }
          this.messages.forEach(function(message) {
            return message.parentNode.removeChild(message);
          });
          this.messages.clear();
          this.core.off("core.element.ignored", this.elementIgnoredHandler).off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler).off("core.validator.validated", this.validatorValidatedHandler).off("core.validator.notvalidated", this.validatorNotValidatedHandler);
        };
        Message2.prototype.onEnabled = function() {
          this.messages.forEach(function(_element, message, _map) {
            classSet(message, {
              "fv-plugins-message-container--enabled": true,
              "fv-plugins-message-container--disabled": false
            });
          });
        };
        Message2.prototype.onDisabled = function() {
          this.messages.forEach(function(_element, message, _map) {
            classSet(message, {
              "fv-plugins-message-container--enabled": false,
              "fv-plugins-message-container--disabled": true
            });
          });
        };
        Message2.prototype.onFieldAdded = function(e) {
          var _this = this;
          var elements = e.elements;
          if (elements) {
            elements.forEach(function(ele) {
              var msg = _this.messages.get(ele);
              if (msg) {
                msg.parentNode.removeChild(msg);
                _this.messages.delete(ele);
              }
            });
            this.prepareFieldContainer(e.field, elements);
          }
        };
        Message2.prototype.onFieldRemoved = function(e) {
          var _this = this;
          if (!e.elements.length || !e.field) {
            return;
          }
          var type = e.elements[0].getAttribute("type");
          var elements = "radio" === type || "checkbox" === type ? [e.elements[0]] : e.elements;
          elements.forEach(function(ele) {
            if (_this.messages.has(ele)) {
              var container = _this.messages.get(ele);
              container.parentNode.removeChild(container);
              _this.messages.delete(ele);
            }
          });
        };
        Message2.prototype.prepareFieldContainer = function(field, elements) {
          var _this = this;
          if (elements.length) {
            var type = elements[0].getAttribute("type");
            if ("radio" === type || "checkbox" === type) {
              this.prepareElementContainer(field, elements[0], elements);
            } else {
              elements.forEach(function(ele) {
                return _this.prepareElementContainer(field, ele, elements);
              });
            }
          }
        };
        Message2.prototype.prepareElementContainer = function(field, element, elements) {
          var container;
          if ("string" === typeof this.opts.container) {
            var selector = "#" === this.opts.container.charAt(0) ? '[id="'.concat(this.opts.container.substring(1), '"]') : this.opts.container;
            container = this.core.getFormElement().querySelector(selector);
          } else {
            container = this.opts.container(field, element);
          }
          var message = document.createElement("div");
          container.appendChild(message);
          classSet(message, {
            "fv-plugins-message-container": true,
            "fv-plugins-message-container--enabled": this.isEnabled,
            "fv-plugins-message-container--disabled": !this.isEnabled
          });
          this.core.emit("plugins.message.placed", {
            element,
            elements,
            field,
            messageElement: message
          });
          this.messages.set(element, message);
        };
        Message2.prototype.getMessage = function(result) {
          return typeof result.message === "string" ? result.message : result.message[this.core.getLocale()];
        };
        Message2.prototype.onValidatorValidated = function(e) {
          var _a;
          var elements = e.elements;
          var type = e.element.getAttribute("type");
          var element = ("radio" === type || "checkbox" === type) && elements.length > 0 ? elements[0] : e.element;
          if (this.messages.has(element)) {
            var container = this.messages.get(element);
            var messageEle = container.querySelector('[data-field="'.concat(e.field.replace(/"/g, '\\"'), '"][data-validator="').concat(e.validator.replace(/"/g, '\\"'), '"]'));
            if (!messageEle && !e.result.valid) {
              var ele = document.createElement("div");
              ele.innerHTML = this.getMessage(e.result);
              ele.setAttribute("data-field", e.field);
              ele.setAttribute("data-validator", e.validator);
              if (this.opts.clazz) {
                classSet(ele, (_a = {}, _a[this.opts.clazz] = true, _a));
              }
              container.appendChild(ele);
              this.core.emit("plugins.message.displayed", {
                element: e.element,
                field: e.field,
                message: e.result.message,
                messageElement: ele,
                meta: e.result.meta,
                validator: e.validator
              });
            } else if (messageEle && !e.result.valid) {
              messageEle.innerHTML = this.getMessage(e.result);
              this.core.emit("plugins.message.displayed", {
                element: e.element,
                field: e.field,
                message: e.result.message,
                messageElement: messageEle,
                meta: e.result.meta,
                validator: e.validator
              });
            } else if (messageEle && e.result.valid) {
              container.removeChild(messageEle);
            }
          }
        };
        Message2.prototype.onValidatorNotValidated = function(e) {
          var elements = e.elements;
          var type = e.element.getAttribute("type");
          var element = "radio" === type || "checkbox" === type ? elements[0] : e.element;
          if (this.messages.has(element)) {
            var container = this.messages.get(element);
            var messageEle = container.querySelector('[data-field="'.concat(e.field.replace(/"/g, '\\"'), '"][data-validator="').concat(e.validator.replace(/"/g, '\\"'), '"]'));
            if (messageEle) {
              container.removeChild(messageEle);
            }
          }
        };
        Message2.prototype.onElementIgnored = function(e) {
          var elements = e.elements;
          var type = e.element.getAttribute("type");
          var element = "radio" === type || "checkbox" === type ? elements[0] : e.element;
          if (this.messages.has(element)) {
            var container_1 = this.messages.get(element);
            var messageElements = [].slice.call(container_1.querySelectorAll('[data-field="'.concat(e.field.replace(/"/g, '\\"'), '"]')));
            messageElements.forEach(function(messageEle) {
              container_1.removeChild(messageEle);
            });
          }
        };
        return Message2;
      }(core.Plugin)
    );
    exports.Message = Message;
  }
});

// node_modules/@form-validation/plugin-message/lib/index.js
var require_lib2 = __commonJS({
  "node_modules/@form-validation/plugin-message/lib/index.js"(exports, module) {
    "use strict";
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_cjs();
    }
  }
});

// node_modules/@form-validation/plugin-framework/lib/cjs/index.js
var require_cjs2 = __commonJS({
  "node_modules/@form-validation/plugin-framework/lib/cjs/index.js"(exports) {
    "use strict";
    var core = require_lib();
    var pluginMessage = require_lib2();
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
    var classSet = core.utils.classSet;
    var closest = core.utils.closest;
    var Framework = (
      /** @class */
      function(_super) {
        __extends(Framework2, _super);
        function Framework2(opts) {
          var _this = _super.call(this, opts) || this;
          _this.results = /* @__PURE__ */ new Map();
          _this.containers = /* @__PURE__ */ new Map();
          _this.opts = Object.assign({}, {
            defaultMessageContainer: true,
            eleInvalidClass: "",
            eleValidClass: "",
            rowClasses: "",
            rowValidatingClass: ""
          }, opts);
          _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
          _this.elementValidatingHandler = _this.onElementValidating.bind(_this);
          _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
          _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_this);
          _this.iconPlacedHandler = _this.onIconPlaced.bind(_this);
          _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
          _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
          _this.messagePlacedHandler = _this.onMessagePlaced.bind(_this);
          return _this;
        }
        Framework2.prototype.install = function() {
          var _a;
          var _this = this;
          classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = true, _a["fv-plugins-framework"] = true, _a));
          this.core.on("core.element.ignored", this.elementIgnoredHandler).on("core.element.validating", this.elementValidatingHandler).on("core.element.validated", this.elementValidatedHandler).on("core.element.notvalidated", this.elementNotValidatedHandler).on("plugins.icon.placed", this.iconPlacedHandler).on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler);
          if (this.opts.defaultMessageContainer) {
            this.core.registerPlugin(Framework2.MESSAGE_PLUGIN, new pluginMessage.Message({
              clazz: this.opts.messageClass,
              container: function(field, element) {
                var selector = "string" === typeof _this.opts.rowSelector ? _this.opts.rowSelector : _this.opts.rowSelector(field, element);
                var groupEle = closest(element, selector);
                return pluginMessage.Message.getClosestContainer(element, groupEle, _this.opts.rowPattern);
              }
            }));
            this.core.on("plugins.message.placed", this.messagePlacedHandler);
          }
        };
        Framework2.prototype.uninstall = function() {
          var _a;
          this.results.clear();
          this.containers.clear();
          classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = false, _a["fv-plugins-framework"] = false, _a));
          this.core.off("core.element.ignored", this.elementIgnoredHandler).off("core.element.validating", this.elementValidatingHandler).off("core.element.validated", this.elementValidatedHandler).off("core.element.notvalidated", this.elementNotValidatedHandler).off("plugins.icon.placed", this.iconPlacedHandler).off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler);
          if (this.opts.defaultMessageContainer) {
            this.core.deregisterPlugin(Framework2.MESSAGE_PLUGIN);
            this.core.off("plugins.message.placed", this.messagePlacedHandler);
          }
        };
        Framework2.prototype.onEnabled = function() {
          var _a;
          classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = true, _a));
          if (this.opts.defaultMessageContainer) {
            this.core.enablePlugin(Framework2.MESSAGE_PLUGIN);
          }
        };
        Framework2.prototype.onDisabled = function() {
          var _a;
          classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = false, _a));
          if (this.opts.defaultMessageContainer) {
            this.core.disablePlugin(Framework2.MESSAGE_PLUGIN);
          }
        };
        Framework2.prototype.onIconPlaced = function(_e) {
        };
        Framework2.prototype.onMessagePlaced = function(_e) {
        };
        Framework2.prototype.onFieldAdded = function(e) {
          var _this = this;
          var elements = e.elements;
          if (elements) {
            elements.forEach(function(ele) {
              var _a;
              var groupEle = _this.containers.get(ele);
              if (groupEle) {
                classSet(groupEle, (_a = {}, _a[_this.opts.rowInvalidClass] = false, _a[_this.opts.rowValidatingClass] = false, _a[_this.opts.rowValidClass] = false, _a["fv-plugins-icon-container"] = false, _a));
                _this.containers.delete(ele);
              }
            });
            this.prepareFieldContainer(e.field, elements);
          }
        };
        Framework2.prototype.onFieldRemoved = function(e) {
          var _this = this;
          e.elements.forEach(function(ele) {
            var _a;
            var groupEle = _this.containers.get(ele);
            if (groupEle) {
              classSet(groupEle, (_a = {}, _a[_this.opts.rowInvalidClass] = false, _a[_this.opts.rowValidatingClass] = false, _a[_this.opts.rowValidClass] = false, _a));
            }
          });
        };
        Framework2.prototype.prepareFieldContainer = function(field, elements) {
          var _this = this;
          if (elements.length) {
            var type = elements[0].getAttribute("type");
            if ("radio" === type || "checkbox" === type) {
              this.prepareElementContainer(field, elements[0]);
            } else {
              elements.forEach(function(ele) {
                return _this.prepareElementContainer(field, ele);
              });
            }
          }
        };
        Framework2.prototype.prepareElementContainer = function(field, element) {
          var _a;
          var selector = "string" === typeof this.opts.rowSelector ? this.opts.rowSelector : this.opts.rowSelector(field, element);
          var groupEle = closest(element, selector);
          if (groupEle !== element) {
            classSet(groupEle, (_a = {}, _a[this.opts.rowClasses] = true, _a["fv-plugins-icon-container"] = true, _a));
            this.containers.set(element, groupEle);
          }
        };
        Framework2.prototype.onElementValidating = function(e) {
          this.removeClasses(e.element, e.elements);
        };
        Framework2.prototype.onElementNotValidated = function(e) {
          this.removeClasses(e.element, e.elements);
        };
        Framework2.prototype.onElementIgnored = function(e) {
          this.removeClasses(e.element, e.elements);
        };
        Framework2.prototype.removeClasses = function(element, elements) {
          var _a;
          var _this = this;
          var type = element.getAttribute("type");
          var ele = "radio" === type || "checkbox" === type ? elements[0] : element;
          elements.forEach(function(ele2) {
            var _a2;
            classSet(ele2, (_a2 = {}, _a2[_this.opts.eleValidClass] = false, _a2[_this.opts.eleInvalidClass] = false, _a2));
          });
          var groupEle = this.containers.get(ele);
          if (groupEle) {
            classSet(groupEle, (_a = {}, _a[this.opts.rowInvalidClass] = false, _a[this.opts.rowValidatingClass] = false, _a[this.opts.rowValidClass] = false, _a));
          }
        };
        Framework2.prototype.onElementValidated = function(e) {
          var _a, _b;
          var _this = this;
          var elements = e.elements;
          var type = e.element.getAttribute("type");
          var element = "radio" === type || "checkbox" === type ? elements[0] : e.element;
          elements.forEach(function(ele) {
            var _a2;
            classSet(ele, (_a2 = {}, _a2[_this.opts.eleValidClass] = e.valid, _a2[_this.opts.eleInvalidClass] = !e.valid, _a2));
          });
          var groupEle = this.containers.get(element);
          if (groupEle) {
            if (!e.valid) {
              this.results.set(element, false);
              classSet(groupEle, (_a = {}, _a[this.opts.rowInvalidClass] = true, _a[this.opts.rowValidatingClass] = false, _a[this.opts.rowValidClass] = false, _a));
            } else {
              this.results.delete(element);
              var isValid_1 = true;
              this.containers.forEach(function(value, key) {
                if (value === groupEle && _this.results.get(key) === false) {
                  isValid_1 = false;
                }
              });
              if (isValid_1) {
                classSet(groupEle, (_b = {}, _b[this.opts.rowInvalidClass] = false, _b[this.opts.rowValidatingClass] = false, _b[this.opts.rowValidClass] = true, _b));
              }
            }
          }
        };
        Framework2.MESSAGE_PLUGIN = "___frameworkMessage";
        return Framework2;
      }(core.Plugin)
    );
    exports.Framework = Framework;
  }
});

// node_modules/@form-validation/plugin-framework/lib/index.js
var require_lib3 = __commonJS({
  "node_modules/@form-validation/plugin-framework/lib/index.js"(exports, module) {
    "use strict";
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_cjs2();
    }
  }
});

// node_modules/@form-validation/plugin-bootstrap5/lib/cjs/index.js
var require_cjs3 = __commonJS({
  "node_modules/@form-validation/plugin-bootstrap5/lib/cjs/index.js"(exports) {
    "use strict";
    var core = require_lib();
    var pluginFramework = require_lib3();
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
    var classSet = core.utils.classSet;
    var hasClass = core.utils.hasClass;
    var Bootstrap5 = (
      /** @class */
      function(_super) {
        __extends(Bootstrap52, _super);
        function Bootstrap52(opts) {
          var _this = _super.call(this, Object.assign({}, {
            eleInvalidClass: "is-invalid",
            eleValidClass: "is-valid",
            formClass: "fv-plugins-bootstrap5",
            rowInvalidClass: "fv-plugins-bootstrap5-row-invalid",
            rowPattern: /^(.*)(col|offset)(-(sm|md|lg|xl))*-[0-9]+(.*)$/,
            rowSelector: ".row",
            rowValidClass: "fv-plugins-bootstrap5-row-valid"
          }, opts)) || this;
          _this.eleValidatedHandler = _this.handleElementValidated.bind(_this);
          return _this;
        }
        Bootstrap52.prototype.install = function() {
          _super.prototype.install.call(this);
          this.core.on("core.element.validated", this.eleValidatedHandler);
        };
        Bootstrap52.prototype.uninstall = function() {
          _super.prototype.uninstall.call(this);
          this.core.off("core.element.validated", this.eleValidatedHandler);
        };
        Bootstrap52.prototype.handleElementValidated = function(e) {
          var type = e.element.getAttribute("type");
          if (("checkbox" === type || "radio" === type) && e.elements.length > 1 && hasClass(e.element, "form-check-input")) {
            var inputParent = e.element.parentElement;
            if (hasClass(inputParent, "form-check") && hasClass(inputParent, "form-check-inline")) {
              classSet(inputParent, {
                "is-invalid": !e.valid,
                "is-valid": e.valid
              });
            }
          }
        };
        Bootstrap52.prototype.onIconPlaced = function(e) {
          classSet(e.element, {
            "fv-plugins-icon-input": true
          });
          var parent = e.element.parentElement;
          if (hasClass(parent, "input-group")) {
            parent.parentElement.insertBefore(e.iconElement, parent.nextSibling);
            if (e.element.nextElementSibling && hasClass(e.element.nextElementSibling, "input-group-text")) {
              classSet(e.iconElement, {
                "fv-plugins-icon-input-group": true
              });
            }
          }
          var type = e.element.getAttribute("type");
          if ("checkbox" === type || "radio" === type) {
            var grandParent = parent.parentElement;
            if (hasClass(parent, "form-check")) {
              classSet(e.iconElement, {
                "fv-plugins-icon-check": true
              });
              parent.parentElement.insertBefore(e.iconElement, parent.nextSibling);
            } else if (hasClass(parent.parentElement, "form-check")) {
              classSet(e.iconElement, {
                "fv-plugins-icon-check": true
              });
              grandParent.parentElement.insertBefore(e.iconElement, grandParent.nextSibling);
            }
          }
        };
        Bootstrap52.prototype.onMessagePlaced = function(e) {
          e.messageElement.classList.add("invalid-feedback");
          var inputParent = e.element.parentElement;
          if (hasClass(inputParent, "input-group")) {
            inputParent.appendChild(e.messageElement);
            classSet(inputParent, {
              "has-validation": true
            });
            return;
          }
          var type = e.element.getAttribute("type");
          if (("checkbox" === type || "radio" === type) && hasClass(e.element, "form-check-input") && hasClass(inputParent, "form-check") && !hasClass(inputParent, "form-check-inline")) {
            e.elements[e.elements.length - 1].parentElement.appendChild(e.messageElement);
          }
        };
        return Bootstrap52;
      }(pluginFramework.Framework)
    );
    exports.Bootstrap5 = Bootstrap5;
  }
});

// node_modules/@form-validation/plugin-bootstrap5/lib/index.js
var require_lib4 = __commonJS({
  "node_modules/@form-validation/plugin-bootstrap5/lib/index.js"(exports, module) {
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_cjs3();
    }
  }
});
export default require_lib4();
//# sourceMappingURL=@form-validation_plugin-bootstrap5.js.map
